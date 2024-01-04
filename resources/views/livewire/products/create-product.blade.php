<form wire:submit.prevent="save">
    @csrf
    <!-- Token de seguridad -->
    <div class="mb-3">
        <label for="name" class="form-label">
            <i class="fas fa-heading text-primary"></i> Nombre
        </label>
        <input type="text" class="form-control" id="name" wire:model="name" required>
    </div>

    <div class="mb-3">
        <label for="brand_id" class="form-label">
            <i class="fas fa-tags text-success"></i> Marca
        </label>
        <select class="form-select" id="brand_id" wire:model="brand_id" required>
            <option value="">Seleccionar Marca</option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">
            <i class="fas fa-info-circle text-warning"></i> Descripción
        </label>
        <textarea class="form-control" id="description" wire:model="description" rows="4" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Guardar
    </button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</form>
