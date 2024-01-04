<div class="container">
    <h1 class="mb-4">Productos</h1>

    @if ($products->isNotEmpty())
        <a href="/" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Volver a la vista de bienvenida
        </a>

        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Agregar Nuevo Producto
        </a>

        <div class="table-responsive">
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
            <table class="table table-bordered table-hover fixed-header">
                <thead>
                    <tr>
                        <th><i class="fas fa-heading text-primary"></i> Nombre</th>
                        <th><i class="fas fa-info-circle text-warning"></i> Descripción</th>
                        <th><i class="fas fa-cogs text-secondary"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <button wire:click="destroy({{ $product->id }})" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            No se encontraron productos.
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Agregar Nuevo Producto
        </a>
    @endif
</div>
