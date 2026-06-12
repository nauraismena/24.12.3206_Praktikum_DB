@extends('layouts.admin')

@section('content')
<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Event</h2>

        <a href="{{ route('admin.events.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-150 shadow-sm">
            + Tambah Event
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-5 border border-green-200 flex items-center gap-2">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-200">
        <table class="w-full text-left border-collapse">
            
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-sm font-semibold">
                    <th class="p-4 w-24">Poster</th>
                    <th class="p-4">Judul</th>
                    <th class="p-4">Kategori</th>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Lokasi</th>
                    <th class="p-4">Harga</th>
                    <th class="p-4">Stok</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 text-gray-700 text-sm">
                @forelse($events as $event)
                <tr class="hover:bg-gray-50/75 transition duration-150">

                    <td class="p-4">
                        <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path))
                                    ? asset('storage/' . $event->poster_path)
                                    : 'https://placehold.co/16x20' }}" class="w-16 h-20 rounded-xl object-cover shadow-sm">
                    </td>

                    <td class="p-4 font-semibold text-gray-900">{{ $event->title }}</td>

                    <td class="p-4">
                        <span class="bg-slate-100 text-slate-700 px-2.5 py-1 rounded-md text-xs font-medium">
                            {{ $event->category->name ?? '-' }}
                        </span>
                    </td>

                    <td class="p-4 text-gray-600">
                        {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}
                    </td>

                    <td class="p-4 text-gray-600">{{ $event->location }}</td>

                    <td class="p-4 font-bold text-green-600">
                        Rp {{ number_format($event->price, 0, ',', '.') }}
                    </td>

                    <td class="p-4">
                        @if($event->stock > 0)
                            <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-md text-xs font-semibold">
                                {{ $event->stock }} tersedia
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-md text-xs font-semibold">
                                Habis
                            </span>
                        @endif
                    </td>

                    <td class="p-4">
                        <div class="flex justify-center items-center gap-2">

                            <a href="{{ route('admin.events.edit', $event->id) }}"
                               class="bg-blue-50 text-blue-600 hover:bg-blue-100 p-2 rounded-lg transition duration-150 flex items-center justify-center w-9 h-9"
                               title="Edit Event">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>

                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline m-0 p-0">
                                @csrf
                                @method('DELETE')

                                <button type="submit" 
                                        onclick="return confirm('Yakin ingin menghapus data event ini?')"
                                        class="bg-red-50 text-red-600 hover:bg-red-100 p-2 rounded-lg transition duration-150 flex items-center justify-center w-9 h-9"
                                        title="Hapus Event">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="8" class="p-8 text-center text-gray-400 font-medium">
                        Data event belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $events->links() }}
    </div>

</div>
@endsection