@extends('layout.master')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Edit Order Service</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.order_service.update', $orderService->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="order_id" class="form-label">Pilih Order</label>
                    <select name="order_id" class="form-select" required>
                        @foreach($orders as $order)
                            <option value="{{ $order->id }}" {{ $order->id == $orderService->order_id ? 'selected' : '' }}>
                                Order #{{ $order->id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="service_id" class="form-label">Pilih Layanan</label>
                    <select name="service_id" class="form-select" required>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ $service->id == $orderService->service_id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Jumlah</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $orderService->quantity }}" required>
                </div>

                <div class="mb-3">
                    <label for="subtotal" class="form-label">Subtotal</label>
                    <input type="number" step="0.01" name="subtotal" class="form-control" value="{{ $orderService->subtotal }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.order_service.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
