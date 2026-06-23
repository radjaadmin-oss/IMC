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
        $events = Event::with(['organizer', 'category'])
            ->where('status', 'approved')
            ->where('date', '>=', now())
            ->latest()
            ->take(4)
            ->get();

        // SECTION-BASED EVENTS (only show where admin checked the box)
        $recommendedEvents = Event::with(['organizer', 'category'])
            ->where('status', 'approved')
            ->where('show_in_recommended', true)
            ->where('date', '>=', now())
            ->latest()
            ->take(4)
            ->get();

        $nearestEvents = Event::with(['organizer', 'category'])
            ->where('status', 'approved')
            ->where('show_in_nearest', true)
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->take(4)
            ->get();

        $upcomingEvents = Event::with(['organizer', 'category'])
            ->where('status', 'approved')
            ->where('show_in_upcoming', true)
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->take(4)
            ->get();

        $popularEvents = Event::with(['organizer', 'category'])
            ->where('status', 'approved')
            ->where('show_in_popular', true)
            ->where('date', '>=', now())
            ->orderByDesc('sold_count') // Sort by sold count, not views
            ->take(4)
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
