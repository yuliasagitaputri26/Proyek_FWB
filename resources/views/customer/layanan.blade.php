@extends('layout.master')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Layanan Tersedia</h3>

    <div class="row">
        @foreach ($services as $service)
            <div class="col-md-4 mb-3">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5>{{ $service->name }}</h5>
                        <p class="text-muted">Rp {{ number_format($service->price, 0, ',', '.') }}</p>

                        <a href="{{ route('customer.create', $service->id) }}" class="btn btn-primary btn-sm">Pesan</a>


                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
