@extends('layouts.admin')

@section('title', 'Laporan Transaksi - Admin')
@section('page_title', 'Laporan Transaksi')
@section('page_subtitle', 'Pantau arus kas dan penjualan tiket Anda.')

@section('content')
<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="px-8 py-6 border-b border-slate-50 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-bold text-slate-800">Daftar Transaksi</h2>
            <p class="text-sm text-slate-400">Total ada {{ $transactions->total() }} transaksi masuk</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/50 text-slate-400 uppercase text-[11px] font-black tracking-wider">
                <tr>
                    <th class="px-8 py-5">Order ID</th>
                    <th class="px-8 py-5">Nama Pembeli</th>
                    <th class="px-8 py-5">Email</th>
                    <th class="px-8 py-5">No. HP</th>
                    <th class="px-8 py-5">Event</th>
                    <th class="px-8 py-5">Tanggal</th>
                    <th class="px-8 py-5">Status</th>
                    <th class="px-8 py-5 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($transactions as $trx)
                <tr class="hover:bg-indigo-50/30 transition-colors duration-200 group">
                    <td class="px-8 py-5">
                        <span class="font-mono font-bold text-xs text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-md">
                            {{ $trx->order_id }}
                        </span>
                    </td>
                    <td class="px-8 py-5 font-bold text-slate-800 text-sm">
                        {{ $trx->customer_name }}
                    </td>
                    <td class="px-8 py-5 text-slate-600 text-sm">
                        {{ $trx->customer_email }}
                    </td>
                    <td class="px-8 py-5 text-slate-600 text-sm">
                        {{ $trx->customer_phone }}
                    </td>
                    <td class="px-8 py-5 font-medium text-slate-600 text-sm">
                        {{ $trx->event->title ?? '-' }}
                    </td>
                    <td class="px-8 py-5 text-sm text-slate-500">
                        {{ $trx->created_at->format('d M Y') }}
                        <span class="block text-[10px] text-slate-400">{{ $trx->created_at->format('H:i') }}</span>
                    </td>
                    <td class="px-8 py-5">
                        @if($trx->status === 'success' || $trx->status === 'settlement')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wide bg-emerald-50 text-emerald-600 ring-1 ring-emerald-200/50">Success</span>
                        @elseif($trx->status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wide bg-amber-50 text-amber-600 ring-1 ring-amber-200/50">Pending</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wide bg-rose-50 text-rose-600 ring-1 ring-rose-200/50">{{ $trx->status }}</span>
                        @endif
                    </td>
                    <td class="px-8 py-5 text-right font-black text-slate-800">
                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-8 py-16 text-center text-slate-400 font-medium">
                        Belum ada data transaksi yang tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="px-8 py-5 bg-slate-50/50 border-t border-slate-50">
        {{ $transactions->links() }}
    </div>
</div>
@endsection