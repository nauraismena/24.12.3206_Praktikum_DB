@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        Menyunting Pengaturan Event
    </h2>

    <form action="{{ route('admin.events.update', $event->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-medium text-gray-700">
                Judul Event
            </label>
            <input type="text"
                   name="title"
                   value="{{ $event->title }}"
                   class="w-full border border-gray-300 p-2.5 rounded focus:ring focus:ring-blue-200"
                   required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium text-gray-700">
                Kategori Event
            </label>

            <select name="category_id"
                    class="w-full border border-gray-300 p-2.5 rounded"
                    required>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $event->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium text-gray-700">
                Deskripsi Pendek
            </label>

            <textarea name="description"
                      class="w-full border border-gray-300 p-2.5 rounded"
                      rows="3"
                      required>{{ $event->description }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-4">

            <div>
                <label class="block mb-2 font-medium text-gray-700">
                    Tanggal & Waktu
                </label>

                <input type="datetime-local"
                       name="date"
                       value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d\TH:i') }}"
                       class="w-full border border-gray-300 p-2.5 rounded"
                       required>
            </div>

            <div>
                <label class="block mb-2 font-medium text-gray-700">
                    Harga (Rp)
                </label>

                <input type="number"
                       name="price"
                       value="{{ $event->price }}"
                       class="w-full border border-gray-300 p-2.5 rounded"
                       required>
            </div>

            <div>
                <label class="block mb-2 font-medium text-gray-700">
                    Stok
                </label>

                <input type="number"
                       name="stock"
                       value="{{ $event->stock }}"
                       class="w-full border border-gray-300 p-2.5 rounded"
                       required>
            </div>
        </div>

        <div class="mb-6">
            <label class="block mb-2 font-medium text-gray-700">
                Lokasi / Gedung
            </label>

            <input type="text"
                   name="location"
                   value="{{ $event->location }}"
                   class="w-full border border-gray-300 p-2.5 rounded"
                   required>
        </div>

        <div class="mb-6">
            <label class="block mb-2 font-medium text-gray-700">
                Poster Event (Opsional)
            </label>
            <input type="file" 
                   name="poster" 
                   accept="image/*" 
                   class="w-full border border-gray-300 p-2.5 rounded text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            
            @if($event->poster_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($event->poster_path))
                <div class="mt-3">
                    <p class="text-xs text-gray-500 mb-1">Poster saat ini:</p>
                    <img src="{{ asset('storage/' . $event->poster_path) }}" 
                         class="w-24 h-32 object-cover rounded-lg shadow-sm border border-gray-200">
                </div>
            @endif
        </div>

        <div class="flex justify-end border-t pt-4">
            <button type="submit"
                class="bg-blue-600 text-white px-8 py-2.5 rounded font-semibold hover:bg-blue-700 shadow-md">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>
@endsection