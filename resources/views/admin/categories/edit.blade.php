@extends('layouts.admin')

@section('content')
<div class="p-6">
    {{-- Header / Judul Halaman --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Kategori</h1>
        <p class="text-sm text-gray-500 mt-1">Ubah nama kategori sesuai dengan kebutuhan event.</p>
    </div>

    {{-- Box Form Edit Kategori --}}
    <div class="max-w-xl bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <div class="flex items-center gap-2 mb-6 pb-4 border-b border-gray-100">
            {{-- Icon Pencil --}}
            <div class="bg-indigo-50 text-indigo-600 p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Edit Nama Kategori</h2>
            </div>
        </div>

        {{-- Form Proses --}}
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Input Nama --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $category->name) }}" 
                       required 
                       class="w-full border px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50 border-gray-300 text-gray-900 @error('name') border-red-500 focus:ring-red-500 @enderror">
                
                {{-- Validasi Error --}}
                @error('name')
                    <p class="text-sm text-red-600 mt-2 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex gap-3 pt-2 border-t border-gray-100">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition duration-150 shadow-sm">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.categories.index') }}" class="bg-white border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium hover:bg-gray-50 transition duration-150">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection