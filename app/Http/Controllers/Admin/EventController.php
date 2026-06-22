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
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $event = null;
        return view('admin.events.create', compact('event'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                  => 'required|string|max:255',
            'location'               => 'required|string|max:255',
            'date'                   => 'required|date',
            'time'                   => 'nullable|string|max:50',
            'price'                  => 'required_if:has_ticket_categories,0|nullable|numeric|min:0',
            'quota'                  => 'required_if:has_ticket_categories,0|nullable|integer|min:1',
            'description'            => 'nullable|string',
            'image'                  => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'has_ticket_categories'  => 'boolean',
            'categories'             => 'required_if:has_ticket_categories,1|array|min:1',
            'categories.*.name'      => 'required_if:has_ticket_categories,1|string|max:255',
            'categories.*.description' => 'nullable|string',
            'categories.*.price'     => 'required_if:has_ticket_categories,1|numeric|min:0',
            'categories.*.quota'     => 'required_if:has_ticket_categories,1|integer|min:1',
            // Section Placement
            'show_in_recommended'    => 'nullable|boolean',
            'show_in_nearest'        => 'nullable|boolean',
            'show_in_upcoming'       => 'nullable|boolean',
            'show_in_popular'        => 'nullable|boolean',
        ]);

        DB::beginTransaction();
        try {
            // Upload image
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('events', 'public');
            }

            // Set has_ticket_categories
            $validated['has_ticket_categories'] = $request->has('has_ticket_categories');

            // Set section placement (default false jika tidak dicentang)
            $validated['show_in_recommended'] = $request->has('show_in_recommended');
            $validated['show_in_nearest'] = $request->has('show_in_nearest');
            $validated['show_in_upcoming'] = $request->has('show_in_upcoming');
            $validated['show_in_popular'] = $request->has('show_in_popular');

            // Jika tidak pakai kategori, set price & quota default
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
        $validated = $request->validate([
            'title'                  => 'required|string|max:255',
            'location'               => 'required|string|max:255',
            'date'                   => 'required|date',
            'time'                   => 'nullable|string|max:50',
            'price'                  => 'required_if:has_ticket_categories,0|nullable|numeric|min:0',
            'quota'                  => 'required_if:has_ticket_categories,0|nullable|integer|min:1',
            'description'            => 'nullable|string',
            'image'                  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'has_ticket_categories'  => 'boolean',
            'categories'             => 'required_if:has_ticket_categories,1|array|min:1',
            'categories.*.name'      => 'required_if:has_ticket_categories,1|string|max:255',
            'categories.*.description' => 'nullable|string',
            'categories.*.price'     => 'required_if:has_ticket_categories,1|numeric|min:0',
            'categories.*.quota'     => 'required_if:has_ticket_categories,1|integer|min:1',
            // Section Placement
            'show_in_recommended'    => 'nullable|boolean',
            'show_in_nearest'        => 'nullable|boolean',
            'show_in_upcoming'       => 'nullable|boolean',
            'show_in_popular'        => 'nullable|boolean',
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

            // Set has_ticket_categories
            $validated['has_ticket_categories'] = $request->has('has_ticket_categories');

            // Set section placement (default false jika tidak dicentang)
            $validated['show_in_recommended'] = $request->has('show_in_recommended');
            $validated['show_in_nearest'] = $request->has('show_in_nearest');
            $validated['show_in_upcoming'] = $request->has('show_in_upcoming');
            $validated['show_in_popular'] = $request->has('show_in_popular');

            // Jika tidak pakai kategori, set price & quota default
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
