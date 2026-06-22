<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = HomeBanner::with('event')
            ->orderBy('sort_order')
            ->paginate(10);

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::where('date', '>=', now())
            ->orderBy('date')
            ->get();

        return view('admin.banners.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'desktop_image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'mobile_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'event_id' => 'nullable|exists:events,id',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'required|integer|min:0',
        ]);

        // Upload Desktop Image
        if ($request->hasFile('desktop_image')) {
            $validated['desktop_image'] = $request->file('desktop_image')
                ->store('banners', 'public');
        }

        // Upload Mobile Image (optional)
        if ($request->hasFile('mobile_image')) {
            $validated['mobile_image'] = $request->file('mobile_image')
                ->store('banners', 'public');
        }

        HomeBanner::create($validated);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeBanner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeBanner $banner)
    {
        $events = Event::where('date', '>=', now())
            ->orderBy('date')
            ->get();

        return view('admin.banners.edit', compact('banner', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeBanner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'desktop_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'mobile_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'event_id' => 'nullable|exists:events,id',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'required|integer|min:0',
        ]);

        // Update Desktop Image
        if ($request->hasFile('desktop_image')) {
            // Delete old image
            if ($banner->desktop_image) {
                Storage::disk('public')->delete($banner->desktop_image);
            }
            $validated['desktop_image'] = $request->file('desktop_image')
                ->store('banners', 'public');
        }

        // Update Mobile Image
        if ($request->hasFile('mobile_image')) {
            // Delete old image
            if ($banner->mobile_image) {
                Storage::disk('public')->delete($banner->mobile_image);
            }
            $validated['mobile_image'] = $request->file('mobile_image')
                ->store('banners', 'public');
        }

        $banner->update($validated);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeBanner $banner)
    {
        // Delete images from storage
        if ($banner->desktop_image) {
            Storage::disk('public')->delete($banner->desktop_image);
        }
        if ($banner->mobile_image) {
            Storage::disk('public')->delete($banner->mobile_image);
        }

        $banner->delete();

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil dihapus!');
    }
}
