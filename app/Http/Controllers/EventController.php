<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category; // Memanggil model Category agar tidak error

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    public function show(Event $event) 
    {
        // Mengambil daftar kategori untuk keperluan menu navigasi/footer
        $categories = Category::all();

        // Me-render view dengan membawa data kategori dan data spesifik acara tersebut
        return view('event-detail', compact('categories', 'event'));
    }
}