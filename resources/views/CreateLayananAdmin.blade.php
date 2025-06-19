<!-- resources/views/CreateLayanan.blade.php -->

@extends('layout.master') {{-- Ganti sesuai layout utama kamu --}}
@section('content')
<div class="container">
    <h2>Tambah Layanan Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Layanan</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tersedia" class="form-label">Jumlah Tersedia</label>
            <input type="number" name="tersedia" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi (Opsional)</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('services.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
