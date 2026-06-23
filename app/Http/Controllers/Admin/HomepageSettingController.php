<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageSettingController extends Controller
{
    /**
     * Display the homepage settings form
     */
    public function index()
    {
        $settings = HomepageSetting::getSettings();
        return view('admin.homepage-settings.index', compact('settings'));
    }

    /**
     * Update homepage settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Logo & Branding
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',

            // Hero Banner
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string|max:500',

            // Features Section
            'show_features' => 'nullable|boolean',
            'feature_1_title' => 'nullable|string|max:255',
            'feature_1_subtitle' => 'nullable|string|max:255',
            'feature_2_title' => 'nullable|string|max:255',
            'feature_2_subtitle' => 'nullable|string|max:255',
            'feature_3_title' => 'nullable|string|max:255',
            'feature_3_subtitle' => 'nullable|string|max:255',
            'feature_4_title' => 'nullable|string|max:255',
            'feature_4_subtitle' => 'nullable|string|max:255',

            // Rekomendasi Event
            'show_recommended_events' => 'nullable|boolean',
            'recommended_events_title' => 'required|string|max:255',
            'recommended_events_subtitle' => 'nullable|string|max:255',

            // Event Terdekat
            'show_nearest_events' => 'nullable|boolean',
            'nearest_events_title' => 'required|string|max:255',
            'nearest_events_subtitle' => 'nullable|string|max:255',

            // Upcoming Event
            'show_upcoming_events' => 'nullable|boolean',
            'upcoming_events_title' => 'required|string|max:255',
            'upcoming_events_subtitle' => 'nullable|string|max:255',

            // Popular Event
            'show_popular_events' => 'nullable|boolean',
            'popular_events_title' => 'required|string|max:255',
            'popular_events_subtitle' => 'nullable|string|max:255',

            // Kategori
            'show_categories' => 'nullable|boolean',
            'categories_title' => 'required|string|max:255',
            'categories_subtitle' => 'nullable|string|max:255',

            // Regions
            'show_regions' => 'nullable|boolean',
            'regions_title' => 'required|string|max:255',
            'regions_subtitle' => 'nullable|string|max:255',

            // · NEW: Footer Settings
            'footer_tagline' => 'nullable|string|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_tiktok' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'social_facebook' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_whatsapp' => 'nullable|string|max:255',
            'footer_copyright' => 'nullable|string|max:255',
            'footer_menu_about' => 'nullable|json',
            'footer_menu_info' => 'nullable|json',
            'footer_menu_categories' => 'nullable|json',
        ]);

        $settings = HomepageSetting::getSettings();

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($settings->logo && Storage::disk('public')->exists($settings->logo)) {
                Storage::disk('public')->delete($settings->logo);
            }

            // Store new logo in storage/app/public/logos/
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        // Convert checkbox values (if unchecked, they won't be in request)
        $validated['show_features'] = $request->has('show_features') ? 1 : 0;
        $validated['show_recommended_events'] = $request->has('show_recommended_events') ? 1 : 0;
        $validated['show_nearest_events'] = $request->has('show_nearest_events') ? 1 : 0;
        $validated['show_upcoming_events'] = $request->has('show_upcoming_events') ? 1 : 0;
        $validated['show_popular_events'] = $request->has('show_popular_events') ? 1 : 0;
        $validated['show_categories'] = $request->has('show_categories') ? 1 : 0;
        $validated['show_regions'] = $request->has('show_regions') ? 1 : 0;

        // · NEW: Handle Footer Menu JSON arrays
        if ($request->has('footer_menu_about')) {
            $validated['footer_menu_about'] = json_decode($request->footer_menu_about, true);
        }
        if ($request->has('footer_menu_info')) {
            $validated['footer_menu_info'] = json_decode($request->footer_menu_info, true);
        }
        if ($request->has('footer_menu_categories')) {
            $validated['footer_menu_categories'] = json_decode($request->footer_menu_categories, true);
        }

        $settings->update($validated);

        return redirect()
            ->route('admin.homepage-settings.index')
            ->with('success', '✓ Homepage & Footer settings berhasil diperbarui!');
    }
}
