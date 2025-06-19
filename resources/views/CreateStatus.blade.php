@extends('layout.master')

@section('content')
<div class="container">
    <h2>Tambah Status Pesanan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('order-status.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="order_id">Pilih Pesanan</label>
            <select name="order_id" class="form-control" required>
    <option value="">-- Pilih Pesanan --</option>
    @foreach($orders as $order)
        <option value="{{ $order->id }}">#{{ $order->id }} - {{ $order->status }}</option>
    @endforeach
</select>

        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" required placeholder="Masukkan status pesanan">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
