@extends('layout.master')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Daftar Transaksi</h2>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3 border">#</th>
                <th class="p-3 border">Order ID</th>
                <th class="p-3 border">Metode</th>
                <th class="p-3 border">Jumlah</th>
                <th class="p-3 border">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $trx)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border">{{ $loop->iteration }}</td>
                    <td class="p-3 border">#{{ $trx->order_id }}</td>
                    <td class="p-3 border">{{ $trx->payment_method }}</td>
                    <td class="p-3 border">Rp {{ number_format($trx->amount_paid, 0, ',', '.') }}</td>
                    <td class="p-3 border">{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
