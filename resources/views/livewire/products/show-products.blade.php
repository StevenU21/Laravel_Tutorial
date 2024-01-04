<div class="container">
    <h1>Detalles del Producto</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <i class="fas fa-heading text-primary"></i> {{ $product->name }}
            </h5>
            <p class="card-text">
                <i class="fas fa-info-circle text-warning"></i> {{ $product->description }}
            </p>

            <p class="card-text">
                <i class="fas fa-dollar-sign text-success"></i> {{ $product->brand->name }}
            </p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
</div>