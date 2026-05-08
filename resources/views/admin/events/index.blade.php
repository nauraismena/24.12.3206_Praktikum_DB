@extends('layouts.admin')

@section('content')
<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manajemen Event</h2>

        <a href="{{ route('admin.events.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded font-semibold hover:bg-indigo-700">
           Tambah Event
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-5 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full bg-white rounded-lg shadow-sm border border-gray-200 text-left">
            
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="p-4">Judul</th>
                    <th class="p-4">Kategori</th>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Lokasi</th>
                    <th class="p-4">Harga</th>
                    <th class="p-4">Stok</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($events as $event)
                <tr class="border-b hover:bg-gray-50 transition">

                    <td class="p-4 font-medium">{{ $event->title }}</td>

                    <td class="p-4">
                        {{ $event->category->name ?? '-' }}
                    </td>

                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}
                    </td>

                    <td class="p-4">{{ $event->location }}</td>

                    <td class="p-4 font-semibold text-green-600">
                        Rp {{ number_format($event->price, 0, ',', '.') }}
                    </td>

                    <td class="p-4">
                        @if($event->stock > 0)
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">
                                {{ $event->stock }} tersedia
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm">
                                Habis
                            </span>
                        @endif
                    </td>

                    <td class="p-4 flex justify-center gap-2">

                        <!-- EDIT -->
                        <a href="{{ route('admin.events.edit', $event->id) }}"
                           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                           Edit
                        </a>

                        <!-- DELETE -->
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Yakin hapus data ini?')"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">
                        Data event belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $events->links() }}
    </div>

</div>
@endsection