@extends('layouts.app')

@section('content')

<section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">

    <div class="flex-1 space-y-8">

        <span
            class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">
            #1 Event Platform
        </span>

        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
            Temukan & Pesan
            <span class="text-indigo-600">Tiket Event</span>
            Impianmu.
        </h1>

        <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
            Dari konser musik hingga workshop teknologi,
            semua ada di genggamanmu.
            Pesan aman & cepat dengan Midtrans.
        </p>

        <div class="flex gap-4">

            <a href="#events"
                class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform flex items-center gap-2">

                <i class="fa-solid fa-arrow-right w-5 h-5"></i>
                Mulai Jelajah

            </a>

            <a href="#"
                class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition flex items-center gap-2">

                <i class="fa-solid fa-circle-info w-5 h-5"></i>
                Cara Pesan

            </a>

        </div>

    </div>

    <div class="flex-1 relative">

        <div
            class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>

        <div
            class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>

        <img src="{{ asset('assets/concert.png') }}"
            alt="Concert"
            class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

        <div
            class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">

            <div class="flex items-center gap-4">

                <div
                    class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">

                    <i class="fa-solid fa-check text-xl"></i>

                </div>

                <div>
                    <p class="text-xs text-slate-500 font-bold uppercase">
                        Terverifikasi
                    </p>

                    <p class="font-bold">
                        Pembayaran Aman via Midtrans
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>


<section id="events" class="max-w-7xl mx-auto px-6 py-20">

    <div class="text-center mb-14">

        <h2 class="text-4xl font-extrabold mb-3">
            Event Terdekat
        </h2>

        <p class="text-slate-500 font-medium text-lg">
            Jangan sampai ketinggalan acara seru minggu ini!
        </p>

    </div>


    <div class="flex flex-wrap items-center justify-center gap-4 mb-14">

        <a href="/"
            class="px-6 py-3 rounded-2xl bg-indigo-600 text-white font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:scale-105 active:scale-95 transition duration-200">

            Semua

        </a>

        @foreach($categories as $cat)

            <a href="?category={{ $cat->slug }}"
                class="px-6 py-3 rounded-2xl bg-white border border-slate-200 text-slate-700 font-semibold shadow-sm hover:bg-indigo-50 hover:border-indigo-400 hover:text-indigo-600 hover:shadow-md hover:-translate-y-0.5 transition duration-200">

                {{ $cat->name }}

            </a>

        @endforeach

    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($events as $event)

            <div
                class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">

                <div class="relative overflow-hidden aspect-[3/4]">

                    {{-- Menampilkan poster dinamis dari storage --}}
                    <img src="{{ ($event->poster_path && \Storage::disk('public')->exists($event->poster_path))
                                ? asset('storage/' . $event->poster_path)
                                : 'https://placehold.co/600x800' }}"
                        alt="{{ $event->title }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                    <div
                        class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">

                        {{ $event->category->name }}

                    </div>

                </div>

                <div class="p-6">

                    <h3
                        class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">

                        {{ $event->title }}

                    </h3>

                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">

                        <i class="fa-solid fa-clock w-4 h-4 text-center"></i>

                        <span>{{ $event->date }}</span>

                    </div>

                    <div class="flex justify-between items-center pt-4 border-t">

                        <span class="text-2xl font-black text-indigo-600">

                            Rp {{ number_format($event->price, 0, ',', '.') }}

                        </span>

                        {{-- Tautan Dinamis Detail Event --}}
                        <a href="{{ route('events.show', $event->id) }}"
                            class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition flex items-center gap-2">

                            <i class="fa-solid fa-eye w-4 h-4"></i>

                            Lihat Detail

                        </a>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</section>


<section class="bg-slate-50 border-t border-slate-100 py-16">
    <div class="max-w-7xl mx-auto px-6 text-center">
        
        <h2 class="text-3xl font-extrabold text-slate-800 mb-2">
            Official Partners
        </h2>
        <p class="text-slate-500 font-medium mb-10">
            AmikomEventHub didukung oleh instansi dan korporasi terpercaya
        </p>

        <div class="flex flex-wrap justify-center items-center gap-6">
            @forelse($partners as $partner)
                <div class="bg-white py-5 px-4 rounded-2xl shadow-sm border border-slate-100 w-36 flex flex-col items-center justify-center group hover:shadow-md transition-all duration-200">
                    
                    <div class="h-10 flex items-center justify-center mb-2">
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform">
                    </div>
                    
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block text-center w-full leading-tight">
                        {{ $partner->name }}
                    </span>

                </div>
            @empty
                <p class="text-sm text-slate-400 italic">
                    Belum ada partner resmi terdaftar saat ini.
                </p>
            @endforelse
        </div>

    </div>
</section>

@endsection