@extends('layout.master')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4 text-primary">Layanan Order Saya</h4>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                    <thead class="table-info text-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Status</th>
                            <th>Tanggal Pesan</th>
                            <th>Layanan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Total Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($orders as $order)
                            @foreach ($order->orderServices as $os)
                                <tr class="text-center align-middle">
                                    <td>{{ $no++ }}</td>
                                    <td>#{{ $order->id }}</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</td>
                                    <td>{{ $os->service->name ?? 'Layanan tidak ditemukan' }}</td>
                                    <td>{{ $os->quantity }}x</td>
                                    <td>Rp {{ number_format($os->subtotal, 0, ',', '.') }}</td>
                                    <td class="fw-bold text-success">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
               <a href="{{ url('/') }}" class="btn btn-secondary mb-3">
    ← Kembali ke Beranda
</a>

            </div>
        </div>
    </div>
</div>
@endsection
