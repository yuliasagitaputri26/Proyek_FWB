@extends('layout.master')

@section('content')
<div class="container mt-4">
    <!-- Judul dengan ikon -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold text-dark">
            👥 Daftar Pengguna
        </h4>
    </div>

     @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center shadow-sm bg-white">
            <thead style="background-color: #5ce9b1;" class="text-dark fw-semibold">
                <tr>
                    <th><i class="bi bi-person-circle me-1"></i>Nama</th>
                    <th><i class="bi bi-envelope me-1"></i>Email</th>
                    <th><i class="bi bi-person-badge me-1"></i>Role</th>
                    <th><i class="bi bi-gear me-1"></i>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @php
                            $roleColors = [
                                'admin' => 'danger',
                                'petugas' => 'primary',
                                'customer' => 'success',
                            ];
                            $color = $roleColors[$user->role] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $color }} text-light px-3 py-2">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                              onsubmit="return confirm('Yakin ingin hapus akun ini?')"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill me-1"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-muted">Belum ada pengguna yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Beranda
        </a>
    </div>
</div>
@endsection