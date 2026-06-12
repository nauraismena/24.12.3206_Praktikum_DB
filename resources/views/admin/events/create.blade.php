@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Event Baru</h1>
        <p class="text-sm text-gray-500 mt-1">Isi formulir di bawah ini untuk menambahkan acara baru.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-3xl">
        {{-- Poin 9.4.2: Menambahkan atribut enctype="multipart/form-data" agar form bisa mengirim file poster --}}
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Judul Event</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                       class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror" 
                       placeholder="Masukkan judul acara" required>
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                <select name="category_id" id="category_id" 
                        class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('category_id') border-red-500 @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Acara</label>
                <textarea name="description" id="description" rows="4" 
                          class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror" 
                          placeholder="Tuliskan deskripsi lengkap acara...">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="date" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal & Waktu</label>
                    <input type="datetime-local" name="date" id="date" value="{{ old('date') }}" 
                           class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('date') border-red-500 @enderror" required>
                    @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-semibold text-gray-700 mb-1">Lokasi Tempat</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" 
                           class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('location') border-red-500 @enderror" 
                           placeholder="Contoh: Auditorium Amikom" required>
                    @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Harga Tiket (Rp)</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" 
                           class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('price') border-red-500 @enderror" 
                           placeholder="Contoh: 150000" required>
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-semibold text-gray-700 mb-1">Kuota / Stok Tiket</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock') }}" 
                           class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('stock') border-red-500 @enderror" 
                           placeholder="Contoh: 100" required>
                    @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="poster" class="block text-sm font-semibold text-gray-700 mb-2">Poster Event (Opsional)</label>
                <input type="file" name="poster" id="poster" accept="image/*" 
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-lg p-2 @error('poster') border-red-500 @enderror">
                <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG. Maksimal ukuran 2MB.</p>
                @error('poster') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" 
                        class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-indigo-700 transition duration-150 shadow-sm">
                    Simpan Event
                </button>
                <a href="{{ route('admin.events.index') }}" 
                   class="bg-gray-100 text-gray-600 px-5 py-2.5 rounded-lg font-semibold hover:bg-gray-200 transition duration-150">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection