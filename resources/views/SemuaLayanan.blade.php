@extends('layoutLayanan')

@section('content')
    <h1>Daftar Layanan</h1>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol tambah layanan --}}
    <a href="{{ route('services.create') }}" style="margin-bottom: 10px; display: inline-block;">+ Tambah Layanan</a>

    {{-- Tabel layanan --}}
    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%;">
        <thead>
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
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->tersedia }}</td>
                    <td>{{ $service->description ?? '-' }}</td>
                    <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                    <td>
                        {{-- Tombol Edit --}}
                        <a href="{{ route('services.edit', $service->id) }}">Edit</a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus layanan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Belum ada layanan tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
