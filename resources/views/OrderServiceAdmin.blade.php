@extends('layout.master')

@section('content')
<div class="container mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold text-dark">
            <i class="bi bi-list-check me-2 text-primary"></i> <!-- Ikon tambahan -->
            Layanan dalam Order
        </h4>
        <a href="{{ route('admin.order_service.create') }}" class="btn btn-success btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Order
        </a>
    </div>

    <!-- Tabel -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle bg-white shadow-sm">
            <thead style="background-color: #9fcaf5;"> <!-- Warna background navbar -->
                <tr class="text-dark fw-semibold">
                    <th>#</th>
                    <th><i class="bi bi-receipt me-1"></i>Order ID</th>
                    <th><i class="bi bi-basket me-1"></i>Layanan</th>
                    <th><i class="bi bi-hash me-1"></i>Jumlah</th>
                    <th><i class="bi bi-currency-dollar me-1"></i>Subtotal</th>
                    <th><i class="bi bi-gear me-1"></i>Aksi</th>
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
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.order_service.edit', $os->id) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>
                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.order_service.destroy', $os->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted text-center">Belum ada layanan dalam order.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
        </a>
    </div>
</div>
@endsection
