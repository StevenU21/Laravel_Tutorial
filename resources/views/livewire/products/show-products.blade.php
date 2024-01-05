<div class="container mt-5">
    <h1 class="mb-4">Detalles del Producto</h1>

    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title text-primary">
                <i class="fas fa-heading"></i> {{ $product->name }}
            </h5>
            <p class="card-text text-secondary">
                <i class="fas fa-info-circle"></i> {{ $product->description }}
            </p>

            <div class="card-content mt-3">
                <img src="{{ $product->url() }}" alt="{{ $product->name }}" class="img-fluid rounded" style="width: 300px;">
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

</div>