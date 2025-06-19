@extends('layout.master')

@section('content')
<div class="container mt-4">
    <h3>Form Pemesanan Layanan</h3>

    <div class="card shadow p-4">
       <form action="{{ route('customer.pesan.store') }}" method="POST">
    @csrf
    <input type="hidden" name="service_id" value="{{ $service->id }}">

    <div class="form-group">
        <label>Layanan</label>
        <input type="text" class="form-control" value="{{ $service->name }}" readonly>
    </div>

    <div class="form-group mt-2">
        <label>Jumlah (kg/satuan)</label>
        <input type="number" name="quantity" class="form-control" value="1" min="1" required>
    </div>

    <div class="form-group mt-2">
        <label>Catatan (Opsional)</label>
        <textarea name="notes" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Pesan Sekarang</button>
</form>

    </div>
</div>
@endsection
