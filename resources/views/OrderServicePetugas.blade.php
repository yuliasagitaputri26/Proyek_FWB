@extends('layout.master')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Layanan Order Saya</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Layanan</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orderServices as $os)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>#{{ $os->order->id }}</td>
                            <td>{{ $os->service->name }}</td>
                            <td>{{ $os->quantity }}</td>
                            <td>Rp {{ number_format($os->subtotal, 0, ',', '.') }}</td>
                            <td>{{ $os->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">Tidak ada data layanan untuk Anda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">
        ← Kembali ke Beranda
    </a>
        </div>
    </div>
</div>
@endsection
