@extends('layout.master')

@section('content')
<div class="container py-5" style="font-family: 'Segoe UI', sans-serif;">
    <div class="card shadow-lg border-0 rounded-4 p-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-secondary fw-bold mb-0">
                📦 Daftar Status Pesanan
            </h3>
            <a href="{{ route('admin.status.create') }}" class="btn btn-success rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-circle"></i> Tambah Status
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr class="text-muted">
                        <th style="width: 60%">Nama Status</th>
                        <th style="width: 40%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statuses as $status)
                        <tr>
                            <td>
                                <span class="badge bg-primary text-white fw-bold fs-6 px-4 py-2 rounded-pill shadow-sm">
                                    {{ $status->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.status.edit', $status->id) }}"
                                   class="btn btn-outline-warning btn-sm rounded-pill px-3 me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                <form action="{{ route('admin.status.destroy', $status->id) }}" method="POST"
                                      class="d-inline" onsubmit="return confirm('Yakin ingin menghapus status ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-muted">Belum ada status yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 text-start">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary rounded-pill px-4">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
