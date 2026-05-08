<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('event.show', compact('event'));
    }
}