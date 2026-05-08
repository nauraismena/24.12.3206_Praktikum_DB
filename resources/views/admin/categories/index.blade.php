@extends('layouts.admin')

@section('content')

<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manajemen Kategori</h1>

        <a href="{{ route('admin.categories.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
            + Tambah Kategori
        </a>
    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-3">No</th>
                    <th>Nama Kategori</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $index => $category)
                <tr class="border-b">
                    <td class="py-3">{{ $index + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td class="text-right space-x-2">

                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                           class="bg-yellow-400 px-3 py-1 rounded">
                           Edit
                        </a>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                              method="POST" class="inline">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Yakin hapus?')"
                                class="bg-red-500 text-white px-3 py-1 rounded">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">
                        Belum ada kategori
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection