<div class="container">
    <h1>Editar Renta</h1>

    <form wire:submit.prevent="update">
        <!-- Selección de Libro -->
        <div class="mb-3">
            <label for="book_id" class="form-label">
                <i class="fas fa-book text-success"></i> Seleccionar Libro
            </label>
            <select class="form-control" id="book_id" wire:model="book_id" wire:change="updateBookDetails" required>
                <option value="">Seleccionar Libro</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>

        <!-- Detalles del Libro (Stock, Autor, Fecha de Publicación y el Estado) -->
        <div class="row" id="book-details"
            @if ($showBookDetails) style="display: '';" @else style="display: none;" @endif>
            <!-- Muestra los detalles del libro usando las propiedades de Livewire -->
            @if ($selectedBookDetails)
                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">
                        <i class="fas fa-cubes text-info"></i> Stock Disponible
                    </label>
                    <input type="text" class="form-control" id="stock" name="stock" disabled
                        value="{{ $selectedBookDetails->stock }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="author" class="form-label">
                        <i class="fas fa-user text-secondary"></i> Autor
                    </label>
                    <input type="text" class="form-control" id="author" name="author"
                        value="{{ $selectedBookDetails->author }}" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="publication_date" class="form-label">
                        <i class="fas fa-calendar-alt text-warning"></i> Fecha de Publicación
                    </label>
                    <input type="text" class="form-control" id="publication_date" name="publication_date"
                        value="{{ $selectedBookDetails->publication_date }}" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="publication_date" class="form-label">
                        <i class="fas fa-calendar-alt text-warning"></i> Estado
                    </label>
                    <input type="text" class="form-control" id="status" name="status"
                        value="{{ $selectedBookDetails->status }}" disabled>
                </div>
            @endif
        </div>

        <!-- Selección de Usuario y Cantidad de Días en la misma línea -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="user_id" class="form-label">
                    <i class="fas fa-user text-primary"></i> Seleccionar Usuario
                </label>
                <select class="form-control" id="user_id" wire:model="user_id" required>
                    <option value="">Seleccionar Usuario</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="rent_days" class="form-label">
                    <i class="fas fa-calendar-alt text-info"></i> Días a Rentar
                </label>
                <input type="number" class="form-control" id="rent_days" wire:model="rent_days" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Actualizar Renta
        </button>
        <a href="{{ route('rents.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </form>
</div>
