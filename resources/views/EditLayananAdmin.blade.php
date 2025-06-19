<!-- resources/views/EditLayanan.blade.php -->

@extends('layout.master') {{-- Sesuaikan dengan layout utama --}}
@section('content')
<div class="container">
    <h2>Edit Layanan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Layanan</label>
            <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
        </div>

        <div class="mb-3">
            <label for="tersedia" class="form-label">Jumlah Tersedia</label>
            <input type="number" name="tersedia" class="form-control" value="{{ $service->tersedia }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ $service->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" value="{{ $service->price }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('services.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
