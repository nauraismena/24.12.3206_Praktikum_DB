@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard')

@section('content')

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

    <div class="bg-white p-6 rounded-3xl shadow-sm">
        <p class="text-sm text-slate-400">Total Pendapatan</p>
        <h3 class="text-2xl font-bold">Rp 12.450.000</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm">
        <p class="text-sm text-slate-400">Tiket Terjual</p>
        <h3 class="text-2xl font-bold">1.284</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm">
        <p class="text-sm text-slate-400">Event Aktif</p>
        <h3 class="text-2xl font-bold">8 Event</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm">
        <p class="text-sm text-slate-400">Pesanan Pending</p>
        <h3 class="text-2xl font-bold">12</h3>
    </div>

</div>

<!-- Table -->
<div class="bg-white rounded-3xl shadow-sm overflow-hidden">
    <div class="p-6 border-b">
        <h3 class="font-bold text-lg">Transaksi Terakhir</h3>
    </div>

    <table class="w-full text-left">
        <thead class="bg-slate-100 text-sm">
            <tr>
                <th class="p-4">Pembeli</th>
                <th class="p-4">Event</th>
                <th class="p-4">Status</th>
                <th class="p-4">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="p-4">Donni</td>
                <td class="p-4">Jazz Night</td>
                <td class="p-4 text-green-600">Success</td>
                <td class="p-4">Rp 155.000</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection