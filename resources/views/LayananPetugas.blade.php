@extends('layout.master')

@section('content')
<div class="container mt-4">

    <!-- Header dengan ikon -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <i class="bi bi-basket-fill fs-3 text-primary me-2"></i>
            <h4 class="mb-0 text-dark fw-semibold"> 🧺 Daftar Layanan Laundry (Petugas)</h4>
        </div>
        <a href="{{ route('services.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle-fill me-1"></i> Tambah Layanan
        </a>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabel Layanan -->
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-secondary">
                        <tr>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td class="fw-semibold">{{ $service->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $service->tersedia > 0 ? 'success' : 'secondary' }}">
                                        {{ $service->tersedia }} unit
                                    </span>
                                </td>
                                <td class="text-muted">{{ $service->description ?? '-' }}</td>
                                <td class="text-primary fw-semibold">
                                    Rp {{ number_format($service->price, 0, ',', '.') }}
                                </td>
                                <td>
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-outline-primary btn-sm me-1">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted">Belum ada layanan tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
