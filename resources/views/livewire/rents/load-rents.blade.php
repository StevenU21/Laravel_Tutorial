<div class="container">
    <h1 class="mb-4">Rentas</h1>

    @if ($rents->isEmpty())
        <div class="alert alert-warning" role="alert">
            No se han Registrado Rentas.
        </div>
        <a href="{{ route('rents.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Agregar Nueva Renta
        </a>
    @else
        <a href="/" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Volver a la vista de bienvenida
        </a>

        <a href="{{ route('rents.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Agregar Nueva Renta
        </a>

        @if (session('success'))
            <!-- Mensaje de éxito después de crear -->
            <div class="alert alert-primary">
                <i class="fas fa-check-circle text-primary"></i> {{ session('success') }}
            </div>
        @elseif (session('message'))
            <!-- Mensaje después de actualizar -->
            <div class="alert alert-success">
                <i class="fas fa-check-circle text-success"></i> {{ session('message') }}
            </div>
        @elseif (session('alert'))
            <!-- Mensaje después de eliminar -->
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle text-danger"></i> {{ session('alert') }}
            </div>
        @endif

        <div class="table-responsive">
            <div class="d-flex justify-content-center">
                {{ $rents->links() }}
            </div>
            <table class="table table-bordered table-hover fixed-header">
                <thead>
                    <tr>
                        <th><i class="fas fa-heading text-primary"></i> Cliente</th>
                        <th><i class="fas fa-info-circle text-warning"></i> Libro</th>
                        <th><i class="fas fa-cogs text-secondary"></i> Fecha de Renta</th>
                        <th><i class="fas fa-cogs text-secondary"></i> Fecha de Devolución</th>
                        <th><i class="fas fa-cogs text-secondary"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rents as $rent)
                        <tr>
                            <td>{{ $rent->user->name }}</td>
                            <td>{{ $rent->book->title }}</td>
                            <td>{{ $rent->rent_date }}</td>
                            <td>{{ $rent->return_date }}</td>
                            <td>
                                <a href="{{ route('rents.show', $rent->id) }}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('rents.edit', $rent->id) }}" class="btn btn-success">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <button wire:click="deleteRent({{ $rent->id }})" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
