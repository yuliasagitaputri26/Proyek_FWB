@extends('layout.master')

@section('content')
<div class="container">
    <h1>Edit Status Pesanan</h1>
    <form action="{{ route('admin.status.update', $status->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Pilih Order --}}
        <div class="mb-3">
            <label for="order_id" class="form-label">Pilih Order</label>
            <select name="order_id" id="order_id" class="form-select" required>
                <option value="">-- Pilih Order --</option>
                @foreach($orders as $order)
                    <option value="{{ $order->id }}" {{ $status->order_id == $order->id ? 'selected' : '' }}>
                        Order #{{ $order->id }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Input Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Nama Status</label>
            <input type="text" name="status" id="status" class="form-control" value="{{ $status->status }}" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Perbarui
        </button>
    </form>
</div>
@endsection
