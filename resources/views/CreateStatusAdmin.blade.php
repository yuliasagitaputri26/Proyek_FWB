@extends('layout.master')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Tambah Status Pesanan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.status.store') }}" method="POST">
                @csrf

                {{-- Pilih Order --}}
                <div class="mb-3">
                    <label for="order_id" class="form-label">Pilih Order</label>
                    <select name="order_id" class="form-select" required>
                        <option value="">-- Pilih Order --</option>
                        @foreach($orders as $order)
                            <option value="{{ $order->id }}" {{ old('order_id') == $order->id ? 'selected' : '' }}>
                                Order #{{ $order->id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Input Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label">Nama Status</label>
                    <input type="text" name="status" class="form-control" placeholder="Contoh: Diproses" value="{{ old('status') }}" required>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.status') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form> {{-- ← INI HARUS ADA --}}
        </div>
    </div>
</div>
@endsection
