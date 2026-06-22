<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\HomeBanner;
use App\Models\HomepageSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // LOAD HOMEPAGE SETTINGS
        $settings = HomepageSetting::getSettings();

        // LOAD BANNERS FROM DATABASE (from home_banners table)
        try {
            $banners = HomeBanner::where('status', 'active')
                ->orderBy('sort_order')
                ->get();
        } catch (\Exception $e) {
            // If home_banners table doesn't exist, use empty collection
            $banners = collect([]);
        }

        // ALL EVENTS (fallback)
        $events = Event::where('date', '>=', now())
            ->latest()
            ->take(8)
            ->get();

        // SECTION-BASED EVENTS
        $recommendedEvents = Event::where('show_in_recommended', true)
            ->where('date', '>=', now())
            ->latest()
            ->take(8)
            ->get();

        $nearestEvents = Event::where('show_in_nearest', true)
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->take(8)
            ->get();

        $upcomingEvents = Event::where('show_in_upcoming', true)
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->take(8)
            ->get();

        $popularEvents = Event::where('show_in_popular', true)
            ->where('date', '>=', now())
            ->orderByDesc('views')
            ->take(8)
            ->get();

        return view('welcome', compact(
            'settings',
            'banners',
            'events',
            'recommendedEvents',
            'nearestEvents',
            'upcomingEvents',
            'popularEvents'
        ));
    }
}
