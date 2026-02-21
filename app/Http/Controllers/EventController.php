<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('is_approved', 1)
            ->where('status', '!=', 'cancelled')
            ->latest('event_date')->paginate(12);
        return view('events.index', compact('events'));
    }

    public function show(int $id)
    {
        $event = Event::where('is_approved', 1)->findOrFail($id);
        $event->increment('views');
        return view('events.show', compact('event'));
    }
}
