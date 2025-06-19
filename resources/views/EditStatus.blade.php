@extends('layout.master')

@section('content')
<div class="container mt-4">
    <h2>Edit Status Pemesanan</h2>
    <form action="{{ route('order-status.update', $status->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="order_id">ID Pesanan</label>
            <!-- Tampilkan order_id untuk dilihat -->
            <input type="text" class="form-control" value="{{ $status->order_id }}" disabled>
            <!-- Kirim order_id dengan hidden agar tetap tersubmit -->
            <input type="hidden" name="order_id" value="{{ $status->order_id }}">
        </div>

        <div class="form-group mt-3">
            <label for="status">Status Pemesanan</label>
            <select name="status" class="form-control" required>
                <option value="Dikemas" {{ $status->status == 'Dikemas' ? 'selected' : '' }}>Dikemas</option>
                <option value="Dalam Proses" {{ $status->status == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                <option value="Dikirim" {{ $status->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="Selesai" {{ $status->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('order-status.index') }}" class="btn btn-secondary mt-3">Batal</a>
        <a href="{{ route('dashboard') }}" class="btn btn-info mt-3">Kembali ke Dashboard</a>

    </form>
</div>
@endsection
