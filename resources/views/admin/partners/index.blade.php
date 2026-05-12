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

    {{-- FORM --}}
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">

        <h2 class="text-xl font-semibold mb-4">
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
                class="mt-5 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow transition duration-200">

                Simpan Partner

            </button>

        </form>

    </div>

    {{-- TABEL --}}
    <div class="bg-white rounded-xl shadow-md p-6">

        <div class="flex justify-between items-center mb-4">

            <h2 class="text-xl font-semibold text-gray-800">
                Daftar Partner
            </h2>

            <span class="text-sm text-gray-500">
                Total: {{ $partners->count() }} Partner
            </span>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full border-collapse overflow-hidden rounded-lg">

                {{-- HEADER TABLE --}}
                <thead>

                    <tr class="bg-indigo-600 text-white">

                        <th class="p-3 text-left">No</th>
                        <th class="p-3 text-left">Logo</th>
                        <th class="p-3 text-left">Nama Partner</th>
                        <th class="p-3 text-left">URL Logo</th>
                        <th class="p-3 text-left">Tanggal Dibuat</th>
                        <th class="p-3 text-center">Aksi</th>

                    </tr>

                </thead>

                {{-- BODY --}}
                <tbody class="bg-white">

                    @forelse($partners as $partner)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- NO --}}
                        <td class="p-3 border-b">
                            {{ $loop->iteration }}
                        </td>

                        {{-- LOGO --}}
                        <td class="p-3 border-b">

                            <img src="{{ $partner->logo_url }}"
                                alt="Logo"
                                class="w-16 h-16 object-contain rounded-lg border p-1 bg-white shadow-sm">

                        </td>

                        {{-- NAMA --}}
                        <td class="p-3 border-b font-medium text-gray-800">
                            {{ $partner->name }}
                        </td>

                        {{-- URL --}}
                        <td class="p-3 border-b text-sm text-blue-600 break-all">
                            {{ $partner->logo_url }}
                        </td>

                        {{-- CREATED --}}
                        <td class="p-3 border-b text-gray-600">
                            {{ $partner->created_at->format('d M Y') }}
                        </td>

                        {{-- AKSI --}}
                        <td class="p-3 border-b text-center">

                            <div class="flex justify-center gap-2">

                                {{-- EDIT --}}
                                <button
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white p-2 rounded-lg transition duration-200 shadow-sm">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11 5h2m-1-1v2m-7 9l9-9 4 4-9 9H5v-4z"/>

                                    </svg>

                                </button>

                                {{-- HAPUS --}}
                                <button
                                    class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition duration-200 shadow-sm">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8"/>

                                    </svg>

                                </button>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6"
                            class="text-center p-6 text-gray-500">

                            Data partner belum tersedia.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection