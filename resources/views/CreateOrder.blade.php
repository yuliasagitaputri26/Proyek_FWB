@extends('layout.master')

@section('content')
<div class="container">
    <h2>Buat Pesanan Baru</h2>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="user_id">Pilih Pengguna</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- Pilih Pengguna --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <label for="order_date">Tanggal Pesanan</label>
            <input type="date" name="order_date" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label for="total_price">Total Harga</label>
            <input type="number" name="total_price" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" value="Menunggu Konfirmasi" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
