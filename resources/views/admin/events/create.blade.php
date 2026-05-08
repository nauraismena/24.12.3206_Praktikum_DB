@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        Form Tambah Event
    </h2>

    {{-- 🔥 ERROR GLOBAL --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded border border-red-300">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.store') }}" method="POST"
          class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mt-2">

        @csrf

        {{-- Judul --}}
        <div class="mb-4">
            <label class="block mb-2 font-medium text-gray-700">Judul Event</label>
            <input type="text" name="title"
                   value="{{ old('title') }}"
                   class="w-full border border-gray-300 p-2.5 rounded">

            @error('title')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <label class="block mb-2 font-medium text-gray-700">Kategori Event</label>
            <select name="category_id"
                    class="w-full border border-gray-300 p-2.5 rounded">

                <option value="">-- Pilih Kategori --</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label class="block mb-2 font-medium text-gray-700">Deskripsi Pendek</label>
            <textarea name="description"
                      class="w-full border border-gray-300 p-2.5 rounded"
                      rows="3">{{ old('description') }}</textarea>

            @error('description')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-4">

            {{-- Tanggal --}}
            <div>
                <label class="block mb-2 font-medium text-gray-700">Tanggal & Waktu</label>
                <input type="datetime-local" name="date"
                       value="{{ old('date') }}"
                       class="w-full border border-gray-300 p-2.5 rounded">

                @error('date')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Harga --}}
            <div>
                <label class="block mb-2 font-medium text-gray-700">Harga Tiket (Rp)</label>
                <input type="number" name="price"
                       value="{{ old('price') }}"
                       class="w-full border border-gray-300 p-2.5 rounded">

                @error('price')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Stok --}}
            <div>
                <label class="block mb-2 font-medium text-gray-700">Kapasitas Stok</label>
                <input type="number" name="stock"
                       value="{{ old('stock') }}"
                       class="w-full border border-gray-300 p-2.5 rounded">

                @error('stock')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

        </div>

        {{-- Lokasi --}}
        <div class="mb-6">
            <label class="block mb-2 font-medium text-gray-700">Lokasi / Gedung</label>
            <input type="text" name="location"
                   value="{{ old('location') }}"
                   class="w-full border border-gray-300 p-2.5 rounded">

            @error('location')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="flex justify-end border-t pt-4">
            <button type="submit"
                    class="bg-indigo-600 text-white px-8 py-2.5 rounded font-semibold hover:bg-indigo-700 shadow">
                Simpan Data
            </button>
        </div>

    </form>
</div>
@endsection