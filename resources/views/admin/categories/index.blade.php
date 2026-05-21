@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Kategori</h1>
        
        {{-- Form Pencarian --}}
        <form action="{{ route('admin.categories.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari kategori..." 
                   class="border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Cari</button>
            
            {{-- Tombol Reset jika sedang mencari --}}
            @if(request('search'))
                <a href="{{ route('admin.categories.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                    Reset
                </a>
            @endif
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">{{ session('success') }}</div>
    @endif

    {{-- Form Tambah Kategori (Sama seperti punyamu) --}}
    <div class="bg-white p-6 rounded-xl shadow-sm mb-6 border border-gray-200">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Tambah Kategori Baru</h2>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="flex gap-4 items-end">
            @csrf
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <input type="text" name="name" required class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium">Simpan</button>
        </form>
    </div>

    {{-- Tabel Kategori --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4 text-sm font-semibold text-gray-600 w-20">ID</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Nama Kategori</th>
                    <th class="p-4 text-sm font-semibold text-gray-600 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              @forelse($categories as $category)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 text-sm text-gray-500">{{ $category->id }}</td>
                    <td class="p-4 text-sm font-medium text-gray-900">{{ $category->name }}</td>
                    <td class="p-4 text-center">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" 
                               class="bg-blue-50 text-blue-600 hover:bg-blue-100 p-2 rounded-lg transition duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>

                            <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Yakin ingin hapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-50 text-red-600 hover:bg-red-100 p-2 rounded-lg transition duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
              @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">
                        {{ request('search') ? 'Kategori tidak ditemukan.' : 'Data belum ada.' }}
                    </td>
                </tr>
              @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection