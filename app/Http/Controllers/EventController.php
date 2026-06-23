<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::with(['organizer', 'category'])
            ->latest()
            ->paginate(12);
        
        return view('events.index', compact('events'));
    }

    public function show(Event $event): View
    {
        // Eager load relationships
        $event->load(['organizer', 'category', 'ticketCategories']);
        
        return view('events.show', compact('event'));
    }
}
