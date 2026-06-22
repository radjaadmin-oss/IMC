<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // LOAD BANNERS FROM DATABASE
        $banners = Banner::where('is_active', true)
            ->orderBy('order')
            ->get();

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
            'banners',
            'events',
            'recommendedEvents',
            'nearestEvents',
            'upcomingEvents',
            'popularEvents'
        ));
    }
}
