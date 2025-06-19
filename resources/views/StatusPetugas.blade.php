@extends('layout.master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4"><i class="bi bi-card-checklist"></i> Daftar Status Pemesanan</h2>

    <a href="{{ route('order-status.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Status
    </a>

    <table class="table table-bordered table-hover shadow-sm bg-white text-center">
        <thead class="table-primary text-dark">
            <tr>
                <th>#</th>
                <th>ID Pesanan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($statuses as $status)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>#{{ $status->order_id }}</td>
                    <td>
                        <span class="badge bg-info text-dark">{{ $status->status }}</span>
                    </td>
                    <td>
                        <a href="{{ route('order-status.edit', $status->id) }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('order-status.destroy', $status->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-muted">Belum ada status pemesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">
        ← Kembali ke Beranda
    </a>
</div>
@endsection
