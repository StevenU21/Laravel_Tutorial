@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalles del Producto</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-heading text-primary"></i> {{ $products->name }}
                </h5>

                <h6 class="card-subtitle mb-2 text-muted">
                    <i class="fas fa-tag text-info"></i> {{ $brand->name }}
                </h6>

                <p class="card-text">
                    <i class="fas fa-info-circle text-warning"></i> {{ $products->description }}
                </p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

    </div>
@endsection
