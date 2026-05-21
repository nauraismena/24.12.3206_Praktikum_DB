@extends('layouts.admin')

@section('content')

<div class="p-6">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Kelola Partner
        </h1>

        <p class="text-gray-500 mt-1">
            Kelola data partner untuk platform AmikomEventHub.
        </p>
    </div>

    {{-- FORM TAMBAH PARTNER --}}
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">

        <h2 class="text-xl font-semibold mb-4 text-gray-800">
            Tambah Partner
        </h2>

        <form action="/admin/partners" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- NAMA --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        Nama Partner
                    </label>

                    <input type="text"
                        name="name"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Masukkan nama partner"
                        required>
                </div>

                {{-- URL LOGO --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        Logo URL
                    </label>

                    <input type="text"
                        name="logo_url"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="https://logo.clearbit.com/google.com"
                        required>
                </div>

            </div>

            {{-- BUTTON --}}
            <button type="submit"
                class="mt-5 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow transition duration-200 font-semibold">
                Simpan Partner
            </button>

        </form>

    </div>

    {{-- TABEL --}}
    <div class="bg-white rounded-xl shadow-md p-6">

        {{-- HEADER TABEL & FORM SEARCH --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 border-b pb-4">

            <div class="flex items-center gap-3">
                <h2 class="text-xl font-semibold text-gray-800">
                    Daftar Partner
                </h2>

                <span class="text-sm bg-slate-100 text-slate-600 px-3 py-1 rounded-full font-medium border border-slate-200">
                    Total: {{ $partners->count() }} Partner
                </span>
            </div>

            {{-- 💡 FITUR PENCARIAN (SEARCH) --}}
            <form action="{{ route('admin.partners.index') }}" method="GET" class="flex w-full md:w-auto gap-2">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Cari partner..." 
                       class="w-full md:w-64 border border-gray-300 px-4 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition font-medium">
                    Cari
                </button>

                {{-- Tombol Reset Tampil Jika Sedang Mencari --}}
                @if(request('search'))
                    <a href="{{ route('admin.partners.index') }}" class="bg-slate-100 text-slate-600 border border-slate-300 px-4 py-2 rounded-lg text-sm hover:bg-slate-200 transition font-medium flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </form>

        </div>

        <div class="overflow-x-auto bg-white rounded-xl border border-gray-200">

            <table class="w-full border-collapse text-left">

                {{-- HEADER TABLE --}}
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-sm font-semibold">
                        <th class="p-4 w-20">No.</th>
                        <th class="p-4 w-28">Logo</th>
                        <th class="p-4">Nama Partner</th>
                        <th class="p-4">URL Logo</th>
                        <th class="p-4">Tanggal Dibuat</th>
                        <th class="p-4 text-center w-32">Aksi</th>
                    </tr>
                </thead>

                {{-- BODY --}}
                <tbody class="divide-y divide-gray-100 text-gray-700 text-sm">

                    @forelse($partners as $partner)

                    <tr class="hover:bg-gray-50/75 transition duration-150">

                        {{-- NO --}}
                        <td class="p-4 font-medium text-gray-500">
                            {{ $loop->iteration }}
                        </td>

                        {{-- LOGO --}}
                        <td class="p-4">
                            <img src="{{ $partner->logo_url }}"
                                alt="Logo"
                                class="w-12 h-12 object-contain rounded-lg border p-1 bg-white shadow-sm">
                        </td>

                        {{-- NAMA --}}
                        <td class="p-4 font-semibold text-gray-900">
                            {{ $partner->name }}
                        </td>

                        {{-- URL --}}
                        <td class="p-4 text-xs text-blue-600 break-all font-mono max-w-xs">
                            {{ $partner->logo_url }}
                        </td>

                        {{-- CREATED --}}
                        <td class="p-4 text-gray-500">
                            {{ $partner->created_at->format('d M Y') }}
                        </td>

                        {{-- AKSI --}}
                        <td class="p-4">

                            <div class="flex justify-center items-center gap-2">

                                {{-- EDIT (Ikon SVG) --}}
                                <a href="/admin/partners/{{ $partner->id }}/edit"
                                    class="bg-blue-50 text-blue-600 hover:bg-blue-100 p-2 rounded-lg transition duration-150 flex items-center justify-center w-9 h-9"
                                    title="Edit Partner">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>

                                {{-- HAPUS (Ikon SVG) --}}
                                <form action="/admin/partners/{{ $partner->id }}"
                                    method="POST"
                                    class="inline m-0 p-0"
                                    onsubmit="return confirm('Yakin ingin menghapus partner ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="bg-red-50 text-red-600 hover:bg-red-100 p-2 rounded-lg transition duration-150 flex items-center justify-center w-9 h-9"
                                        title="Hapus Partner">
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
                        <td colspan="6" class="text-center p-8 text-gray-400 font-medium">
                            @if(request('search'))
                                Partner dengan nama "{{ request('search') }}" tidak ditemukan.
                            @else
                                Data partner belum tersedia.
                            @endif
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection