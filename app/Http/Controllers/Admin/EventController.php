<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['category', 'organizer']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by featured
        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->is_featured);
        }

        $events = $query->orderBy('date', 'desc')->paginate(15);
        $categories = \App\Models\EventCategory::all();

        return view('admin.events.index', compact('events', 'categories'));
    }

    /**
     * Show pending events for approval
     */
    public function pending(Request $request)
    {
        $query = Event::with(['category', 'organizer'])->where('status', 'pending');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $events = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.events.pending', compact('events'));
    }

    /**
     * Approve event
     */
    public function approve(Event $event)
    {
        $event->update(['status' => 'approved']);

        return back()->with('success', 'Event berhasil diapprove!');
    }

    /**
     * Reject event
     */
    public function reject(Event $event, Request $request)
    {
        $request->validate([
            'rejection_reason' => 'nullable|string|max:500'
        ]);

        $event->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason
        ]);

        return back()->with('success', 'Event berhasil direject!');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Event $event)
    {
        $event->update(['is_featured' => !$event->is_featured]);

        $message = $event->is_featured 
            ? 'Event berhasil ditandai sebagai Featured!' 
            : 'Event berhasil dihapus dari Featured!';

        return back()->with('success', $message);
    }

    /**
     * Duplicate event
     */
    public function duplicate(Event $event)
    {
        DB::beginTransaction();
        try {
            // Duplicate event
            $newEvent = $event->replicate();
            $newEvent->title = $event->title . ' (Copy)';
            $newEvent->status = 'pending';
            $newEvent->is_featured = false;
            $newEvent->sold_count = 0;
            $newEvent->views = 0;
            $newEvent->save();

            // Duplicate ticket categories if exists
            if ($event->has_ticket_categories) {
                foreach ($event->ticketCategories as $category) {
                    $newCategory = $category->replicate();
                    $newCategory->event_id = $newEvent->id;
                    $newCategory->save();
                }
            }

            DB::commit();
            return redirect()->route('admin.events.edit', $newEvent)
                ->with('success', 'Event berhasil diduplikasi! Silakan edit dan publish.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menduplikasi event: ' . $e->getMessage());
        }
    }

    /**
     * Show featured events
     */
    public function featured(Request $request)
    {
        $query = Event::with(['category', 'organizer'])
            ->where('is_featured', true)
            ->where('status', 'approved');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $events = $query->orderBy('date', 'desc')->paginate(15);
        $categories = \App\Models\EventCategory::all();

        return view('admin.events.featured', compact('events', 'categories'));
    }

    public function create()
    {
        $event = null;
        return view('admin.events.create', compact('event'));
    }

    public function store(Request $request)
    {
        // Convert checkbox values to boolean BEFORE validation
        $request->merge([
            'has_ticket_categories' => $request->has('has_ticket_categories'),
            'show_in_recommended' => $request->has('show_in_recommended'),
            'show_in_nearest' => $request->has('show_in_nearest'),
            'show_in_upcoming' => $request->has('show_in_upcoming'),
            'show_in_popular' => $request->has('show_in_popular'),
        ]);

        $validated = $request->validate([
            'title'                  => 'required|string|max:255',
            'location'               => 'required|string|max:255',
            'date'                   => 'required|date',
            'time'                   => 'nullable|string|max:50',
            'price'                  => 'required_if:has_ticket_categories,false|nullable|numeric|min:0',
            'quota'                  => 'required_if:has_ticket_categories,false|nullable|integer|min:1',
            'description'            => 'nullable|string',
            'image'                  => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'has_ticket_categories'  => 'boolean',
            'categories'             => 'required_if:has_ticket_categories,true|array|min:1',
            'categories.*.name'      => 'required_if:has_ticket_categories,true|string|max:255',
            'categories.*.description' => 'nullable|string',
            'categories.*.price'     => 'required_if:has_ticket_categories,true|numeric|min:0',
            'categories.*.quota'     => 'required_if:has_ticket_categories,true|integer|min:1',
            // Section Placement
            'show_in_recommended'    => 'boolean',
            'show_in_nearest'        => 'boolean',
            'show_in_upcoming'       => 'boolean',
            'show_in_popular'        => 'boolean',
        ]);

        DB::beginTransaction();
        try {
            // Upload image
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('events', 'public');
            }

            // Jika tidak pakai kategori, set price & quota dari form
            if (!$validated['has_ticket_categories']) {
                $validated['price'] = $request->price ?? 0;
                $validated['quota'] = $request->quota ?? 0;
            } else {
                $validated['price'] = 0;
                $validated['quota'] = 0;
            }

            $event = Event::create($validated);

            // Simpan ticket categories jika ada
            if ($validated['has_ticket_categories'] && !empty($request->categories)) {
                foreach ($request->categories as $index => $category) {
                    TicketCategory::create([
                        'event_id'    => $event->id,
                        'name'        => $category['name'],
                        'description' => $category['description'] ?? null,
                        'price'       => $category['price'],
                        'quota'       => $category['quota'],
                        'sort_order'  => $index,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.events.index')
                ->with('success', 'Event berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($validated['image'])) {
                Storage::disk('public')->delete($validated['image']);
            }
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan event: ' . $e->getMessage()]);
        }
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $event->load('ticketCategories');
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        // Convert checkbox values to boolean BEFORE validation
        $request->merge([
            'has_ticket_categories' => $request->has('has_ticket_categories'),
            'show_in_recommended' => $request->has('show_in_recommended'),
            'show_in_nearest' => $request->has('show_in_nearest'),
            'show_in_upcoming' => $request->has('show_in_upcoming'),
            'show_in_popular' => $request->has('show_in_popular'),
        ]);

        $validated = $request->validate([
            'title'                  => 'required|string|max:255',
            'location'               => 'required|string|max:255',
            'date'                   => 'required|date',
            'time'                   => 'nullable|string|max:50',
            'price'                  => 'required_if:has_ticket_categories,false|nullable|numeric|min:0',
            'quota'                  => 'required_if:has_ticket_categories,false|nullable|integer|min:1',
            'description'            => 'nullable|string',
            'image'                  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'has_ticket_categories'  => 'boolean',
            'categories'             => 'required_if:has_ticket_categories,true|array|min:1',
            'categories.*.name'      => 'required_if:has_ticket_categories,true|string|max:255',
            'categories.*.description' => 'nullable|string',
            'categories.*.price'     => 'required_if:has_ticket_categories,true|numeric|min:0',
            'categories.*.quota'     => 'required_if:has_ticket_categories,true|integer|min:1',
            // Section Placement
            'show_in_recommended'    => 'boolean',
            'show_in_nearest'        => 'boolean',
            'show_in_upcoming'       => 'boolean',
            'show_in_popular'        => 'boolean',
        ]);

        DB::beginTransaction();
        try {
            // Upload new image if exists
            if ($request->hasFile('image')) {
                if ($event->image) {
                    Storage::disk('public')->delete($event->image);
                }
                $validated['image'] = $request->file('image')->store('events', 'public');
            }

            // Jika tidak pakai kategori, set price & quota dari form
            if (!$validated['has_ticket_categories']) {
                $validated['price'] = $request->price ?? 0;
                $validated['quota'] = $request->quota ?? 0;
            } else {
                $validated['price'] = 0;
                $validated['quota'] = 0;
            }

            $event->update($validated);

            // Update ticket categories
            if ($validated['has_ticket_categories'] && !empty($request->categories)) {
                // Hapus kategori lama
                $event->ticketCategories()->delete();
                
                // Buat kategori baru
                foreach ($request->categories as $index => $category) {
                    TicketCategory::create([
                        'event_id'    => $event->id,
                        'name'        => $category['name'],
                        'description' => $category['description'] ?? null,
                        'price'       => $category['price'],
                        'quota'       => $category['quota'],
                        'sort_order'  => $index,
                    ]);
                }
            } else {
                // Hapus semua kategori jika tidak pakai
                $event->ticketCategories()->delete();
            }

            DB::commit();
            return redirect()->route('admin.events.index')
                ->with('success', 'Event berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Gagal update event: ' . $e->getMessage()]);
        }
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus!');
    }
}
