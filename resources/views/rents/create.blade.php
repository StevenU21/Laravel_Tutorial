@extends('layouts.app')
@section('title', 'Registrar Nueva Renta')
@section('content')
    <div class="container">
        <h1>Registrar Nueva Renta</h1>

        <form action="{{ route('rents.store') }}" method="POST">
            @csrf

            <!-- Selección de Libro -->
            <div class="mb-3">
                <label for="book_id" class="form-label">
                    <i class="fas fa-book text-success"></i> Seleccionar Libro
                </label>
                <select class="form-control" id="book_id" name="book_id" required>
                    <option value="">Seleccionar Libro</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Detalles del Libro (Stock, Autor, Fecha de Publicación y el Estado) -->
            <div class="row" id="book-details" style="display: none;">
                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">
                        <i class="fas fa-cubes text-info"></i> Stock Disponible
                    </label>
                    <input type="text" class="form-control" id="stock" name="stock" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="author" class="form-label">
                        <i class="fas fa-user text-secondary"></i> Autor
                    </label>
                    <input type="text" class="form-control" id="author" name="author" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="publication_date" class="form-label">
                        <i class="fas fa-calendar-alt text-warning"></i> Fecha de Publicación
                    </label>
                    <input type="text" class="form-control" id="publication_date" name="publication_date" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="publication_date" class="form-label">
                        <i class="fas fa-calendar-alt text-warning"></i> Estado
                    </label>
                    <input type="text" class="form-control" id="status" name="status" disabled>
                </div>
            </div>

            <!-- Selección de Usuario y Cantidad de Días en la misma línea -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="user_id" class="form-label">
                        <i class="fas fa-user text-primary"></i> Seleccionar Usuario
                    </label>
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="">Seleccionar Usuario</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="rent_days" class="form-label">
                        <i class="fas fa-calendar-alt text-info"></i> Cantidad de Días de Renta
                    </label>
                    <input type="number" class="form-control" id="rent_days" name="rent_days" required>
                </div>
            </div>

            <!-- Fecha de Renta y Fecha de Retorno en la misma línea -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="rent_date" class="form-label">
                        <i class="far fa-calendar-alt text-success"></i> Fecha de Renta
                    </label>
                    <input type="text" class="form-control" id="rent_date" name="rent_date" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="return_date" class="form-label">
                        <i class="far fa-calendar-alt text-warning"></i> Fecha de Retorno
                    </label>
                    <input type="text" class="form-control" id="return_date" name="return_date" disabled>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar Renta
            </button>
            <a href="{{ route('rents.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </form>
    </div>

    <!-- Incluir moment.js para facilitar el manejo de fechas en JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- Script para actualizar detalles del libro y calcular la fecha de retorno automáticamente -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener elementos del DOM
            var bookDetails = document.getElementById('book-details');
            var stockInput = document.getElementById("stock");
            var authorInput = document.getElementById("author");
            var publicationDateInput = document.getElementById("publication_date");
            var rentDateInput = document.getElementById("rent_date");
            var returnDateInput = document.getElementById("return_date");
            var rentDaysInput = document.getElementById("rent_days");
            var bookSelect = document.getElementById("book_id");
            var statusInput = document.getElementById("status");

            // Evento de cambio en la selección de libro
            bookSelect.addEventListener("change", function() {
                // Obtener el libro seleccionado
                var selectedBook = {!! json_encode($books->keyBy('id')->toArray(), JSON_HEX_QUOT) !!}[bookSelect.value];

                if (selectedBook) {
                    // Actualizar detalles del libro
                    stockInput.value = selectedBook.stock;
                    authorInput.value = selectedBook.author;
                    publicationDateInput.value = selectedBook.publication_date;
                    statusInput.value = selectedBook.status;

                    // Mostrar los detalles del libro
                    bookDetails.style.display = '';
                } else {
                    // Ocultar los detalles del libro si no se selecciona ningún libro
                    bookDetails.style.display = 'none';
                }
            });

            // Evento de cambio en la cantidad de días
            rentDaysInput.addEventListener("change", function() {
                // Obtener la fecha actual
                var currentDate = moment();

                // Calcular la fecha de retorno sumando la cantidad de días ingresada
                var returnDate = currentDate.clone().add(rentDaysInput.value, "days");

                // Formatear las fechas y establecerlas en los campos de entrada
                rentDateInput.value = currentDate.format("YYYY-MM-DD");
                returnDateInput.value = returnDate.format("YYYY-MM-DD");
            });
        });
    </script>
@endsection
