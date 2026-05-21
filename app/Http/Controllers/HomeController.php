<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Partner; // 💡 TAMBAHKAN INI: Impor Model Partner (Soal 4)
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua kategori untuk filter tab button
        $categories = Category::all();

        // 2. Query dasar event
        $query = Event::with('category')
            ->where('date', '>=', now())
            ->orderBy('date', 'asc');

        // 3. Filter berdasarkan kategori (slug)
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        // 4. Eksekusi query event
        $events = $query->get();

        // 5. AMBIL DATA PARTNER (Memenuhi Soal 4 UTS)
        $partners = Partner::all();

        // 6. Kirim data hasilnya ke template Blade (Tambahkan 'partners')
        return view('welcome', compact('events', 'categories', 'partners'));
    }
}