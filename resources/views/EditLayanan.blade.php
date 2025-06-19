@extends('layoutLayanan')

@section('content')
    <h1>Edit Layanan</h1>

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

    {{-- Form edit layanan --}}
    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $service->name) }}">
        </div>

        <div>
            <label for="tersedia">Stok:</label>
            <input type="number" id="tersedia" name="tersedia" value="{{ old('tersedia', $service->tersedia) }}">
        </div>

        <div>
            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description">{{ old('description', $service->description) }}</textarea>
        </div>

        <div>
            <label for="price">Harga:</label>
            <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $service->price) }}">
        </div>

        <button type="submit">Perbarui</button>
    </form>
@endsection
