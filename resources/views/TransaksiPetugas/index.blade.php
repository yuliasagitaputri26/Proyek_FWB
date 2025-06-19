@extends('layout.master')

@section('content')
<div class="max-w-6xl mx-auto mt-12 bg-white p-8 rounded-xl shadow border border-gray-200">
    <h2 class="text-2xl font-bold text-indigo-600 mb-6">📋 Daftar Transaksi Pembayaran</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4 shadow">{{ session('success') }}</div>
    @endif

    <table class="min-w-full table-auto border border-gray-300">
        <thead class="bg-gray-100">
            <tr class="text-left text-gray-700">
                <th class="p-3 border">#</th>
                <th class="p-3 border">Nama Customer</th>
                <th class="p-3 border">Order ID</th>
                <th class="p-3 border">Metode Pembayaran</th>
                <th class="p-3 border">Jumlah</th>
                <th class="p-3 border">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksis as $item)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3 border">{{ $loop->iteration }}</td>
                    <td class="p-3 border">{{ $item->order->user->name ?? '-' }}</td>
                    <td class="p-3 border">#{{ $item->order_id }}</td>
                    <td class="p-3 border">{{ $item->payment_method }}</td>
                    <td class="p-3 border">Rp {{ number_format($item->amount_paid, 0, ',', '.') }}</td>
                    <td class="p-3 border">{{ \Carbon\Carbon::parse($item->transaction_date)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-6">Belum ada transaksi</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Beranda
            </a>
</div>
@endsection
