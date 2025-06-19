@extends('layout.master')

@section('content')
<div class="max-w-2xl mx-auto mt-14 bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
    <h2 class="text-2xl font-extrabold text-indigo-600 mb-6 flex items-center gap-3">
        <i class="fas fa-money-bill-wave text-green-500 text-2xl"></i> Tambah Transaksi
    </h2>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow-md flex items-center gap-2">
            <i class="fas fa-check-circle text-green-600 text-lg"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg shadow-md flex items-center gap-2">
            <i class="fas fa-times-circle text-red-600 text-lg"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fas fa-receipt text-indigo-500 mr-1"></i> Order
            </label>
            <select name="order_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 shadow-sm">
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">Order #{{ $order->id }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fas fa-wallet text-blue-500 mr-1"></i> Metode Pembayaran
            </label>
            <input type="text" name="payment_method" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 shadow-sm" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fas fa-money-check-alt text-yellow-500 mr-1"></i> Jumlah Bayar
            </label>
            <input type="number" name="amount_paid" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-400 shadow-sm" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fas fa-calendar-alt text-pink-500 mr-1"></i> Tanggal Transaksi
            </label>
            <input type="date" name="transaction_date" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-400 shadow-sm" required>
        </div>

        <div class="flex justify-between items-center pt-6">
           <button type="submit"
    class="flex items-center gap-2 px-6 py-2 bg-gradient-to-r from-green-400 to-emerald-500 text-black rounded-full shadow-md hover:brightness-110 transition duration-200 ease-in-out font-semibold">
    <i class="fas fa-save text-black"></i> Simpan
</button>

            <a href="{{ route('home') }}"
                class="flex items-center gap-2 px-6 py-2 bg-gradient-to-r from-gray-300 to-gray-500 text-black rounded-full hover:scale-105 transform transition duration-200 ease-in-out font-semibold">
                <i class="fas fa-home"></i> Beranda
            </a>
        </div>
    </form>
</div>
@endsection
