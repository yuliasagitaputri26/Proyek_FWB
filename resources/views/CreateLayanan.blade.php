@extends('layoutLayanan')

@section('content')
    <h1>Tambah Layanan</h1>

    {{-- Tampilkan pesan error jika ada --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form tambah layanan --}}
    <form action="{{ route('services.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
        </div>

        <div>
            <label for="tersedia">Stok:</label>
            <input type="number" id="tersedia" name="tersedia" value="{{ old('tersedia') }}">
        </div>

        <div>
            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="price">Harga:</label>
            <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}">
        </div>

        <button type="submit">Simpan</button>
    </form>
@endsection
