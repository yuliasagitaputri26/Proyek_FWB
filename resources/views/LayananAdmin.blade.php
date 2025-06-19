@extends('layout.master')

@section('content')
<div class="container py-5" style="font-family: 'Segoe UI', sans-serif;">
    <div class="card shadow-lg border-0 rounded-4 p-4" style="background-color: #ffffffee;">
        <h2 class="mb-4 text-center text-secondary fw-bold">
            🧺 Daftar Layanan
        </h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="text-end mb-3">
            <a href="{{ route('services.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                + Tambah Layanan
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr class="text-muted">
                        <th>Nama Layanan</th>
                        <th>Tersedia</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->tersedia }}</td>
                            <td>{{ $service->description }}</td>
                            <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('services.edit', $service->id) }}"
                                   class="btn btn-warning btn-sm rounded-pill px-3">
                                    Edit
                                </a>
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin hapus layanan ini?')"
                                            class="btn btn-danger btn-sm rounded-pill px-3">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada layanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary rounded-pill px-4">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
