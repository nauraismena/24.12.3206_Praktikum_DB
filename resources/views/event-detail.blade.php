@extends('layouts.app')

@section('content')

<section class="max-w-5xl mx-auto px-6 py-20">

    {{-- UPDATE TERBARU: Penyesuaian class Tailwind untuk gambar Hero (border, shadow, aspect-ratio) --}}
    <img src="{{ ($event->poster_path && \Storage::disk('public')->exists($event->poster_path)) 
                ? asset('storage/' . $event->poster_path) 
                : 'https://placehold.co/600x800' }}" 
         alt="{{ $event->title }}" 
         class="w-full rounded-[2.5rem] shadow-2xl border-8 border-white object-cover aspect-[3/4] mb-8">

    {{-- 9.4.6 Poin 4.a: Menampilkan Kategori Acara --}}
    <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold rounded-lg uppercase tracking-wider mb-3">
        {{ $event->category->name }}
    </span>

    {{-- 9.4.6 Poin 4.b: Menampilkan Judul Acara secara dinamis --}}
    <h1 class="text-4xl font-bold mb-4">{{ $event->title }}</h1>

    {{-- 9.4.6 Poin 4.e: Menampilkan Deskripsi Acara secara dinamis --}}
    <p class="text-gray-500 mb-6 whitespace-pre-line leading-relaxed">
        {{ $event->description ?? 'Tidak ada deskripsi untuk acara ini.' }}
    </p>

    {{-- 9.4.6 Poin 4.c & 4.d: Informasi Tanggal, Waktu, Lokasi, dan Sisa Stok --}}
    <div class="mb-6 space-y-2 text-gray-700 bg-slate-50 p-6 rounded-2xl border border-slate-100">
        <p class="flex items-center gap-2">
            <b class="w-32 inline-block">Tanggal & Waktu</b> 
            <span>: {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }} WIB</span>
        </p>
        <p class="flex items-center gap-2">
            <b class="w-32 inline-block">Lokasi</b> 
            <span>: {{ $event->location }}</span>
        </p>
        {{-- 9.4.6 Poin 4.g: Menampilkan Sisa Stok Tiket --}}
        <p class="flex items-center gap-2">
            <b class="w-32 inline-block">Sisa Stok</b> 
            <span>: <span class="text-emerald-600 font-bold">{{ $event->stock }} Tiket lagi!</span></span>
        </p>
    </div>

    <div class="flex justify-between items-center pt-4 border-t border-slate-100">
        {{-- 9.4.6 Poin 4.f: Menampilkan Harga Tiket Terformat Rupiah --}}
        <div class="flex flex-col">
            <span class="text-sm text-gray-400 font-medium">Harga Tiket</span>
            <span class="text-3xl font-black text-indigo-600">
                Rp {{ number_format($event->price, 0, ',', '.') }}
            </span>
        </div>

        {{-- 9.4.6 Poin 4.h: Link Tautan Checkout Dinamis Menggunakan ID Event --}}
        <a href="{{ url('checkout/' . $event->id) }}"
           class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:scale-105 active:scale-95 transition duration-200">
             Pesan Sekarang
        </a>
    </div>

</section>

@endsection