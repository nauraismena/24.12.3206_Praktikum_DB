@extends('layouts.admin')

@section('content')

<div class="p-6 max-w-3xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">

        <h1 class="text-3xl font-bold text-gray-800">
            Edit Partner
        </h1>

        <p class="text-gray-500 mt-1">
            Ubah data partner AmikomEventHub.
        </p>

    </div>

    {{-- CARD --}}
    <div class="bg-white rounded-xl shadow-md p-6">

        <form action="/admin/partners/{{ $partner->id }}" method="POST">

            @csrf
            @method('PUT')

            {{-- NAMA --}}
            <div class="mb-4">

                <label class="block mb-2 font-medium text-gray-700">
                    Nama Partner
                </label>

                <input type="text"
                    name="name"
                    value="{{ $partner->name }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required>

            </div>

            {{-- URL LOGO --}}
            <div class="mb-4">

                <label class="block mb-2 font-medium text-gray-700">
                    Logo URL
                </label>

                <input type="text"
                    name="logo_url"
                    value="{{ $partner->logo_url }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required>

            </div>

            {{-- PREVIEW LOGO --}}
            <div class="mb-6">

                <label class="block mb-2 font-medium text-gray-700">
                    Preview Logo
                </label>

                <img src="{{ $partner->logo_url }}"
                    class="w-24 h-24 object-contain border rounded-lg p-2 bg-white shadow-sm">

            </div>

            {{-- BUTTON --}}
            <div class="flex gap-3">

                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow transition">

                    Update Partner

                </button>

                <a href="/admin/partners"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-lg transition">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection