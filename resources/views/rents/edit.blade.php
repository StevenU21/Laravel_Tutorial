@extends('layouts.app')
@section('title', 'Editar Renta')
@section('content')
    <div class="container">
        <h1>Editar Renta</h1>

        <form action="{{ route('rents.update', $rent->id ) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Selección de Libro -->
            <div class="mb-3">
                <label for="book_id" class="form-label">
                    <i class="fas fa-book text-success"></i> Seleccionar Libro
                </label>
                <select class="form-control" id="book_id" name="book_id" required>
                    <option value="{{ $rent->book_id }}">{{ $rent->book->title }}</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Detalles del Libro (Stock, Autor, Fecha de Publicación y Estado) -->
            <div class="row" id="book-details">
                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">
                        <i class="fas fa-cubes text-info"></i> Stock Disponible
                    </label>
                    <input type="text" class="form-control" id="stock" name="stock" value="{{ $rent->book->stock }}" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="author" class="form-label">
                        <i class="fas fa-user text-secondary"></i> Autor
                    </label>
                    <input type="text" class="form-control" id="author" name="author" value="{{ $rent->book->author }}" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="publication_date" class="form-label">
                        <i class="fas fa-calendar-alt text-warning"></i> Fecha de Publicación
                    </label>
                    <input type="text" class="form-control" id="publication_date" name="publication_date" value="{{ $rent->book->publication_date }}" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">
                        <i class="fas fa-info-circle text-primary"></i> Estado
                    </label>
                    <input type="text" class="form-control" id="status" name="status" value="{{ $rent->book->status }}" disabled>
                </div>
            </div>

            <!-- Selección de Usuario y Cantidad de Días en la misma línea -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="user_id" class="form-label">
                        <i class="fas fa-user text-primary"></i> Seleccionar Usuario
                    </label>
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="{{ $rent->user_id }}">{{ $rent->user->name }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="rent_days" class="form-label">
                        <i class="fas fa-calendar-alt text-info"></i> Cantidad de Días de Renta
                    </label>
                    <input type="number" class="form-control" id="rent_days" name="rent_days" value="{{ $rentDays }}" required>
                </div>
            </div>

            <!-- Fecha de Renta y Fecha de Retorno en la misma línea -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="rent_date" class="form-label">
                        <i class="far fa-calendar-alt text-success"></i> Fecha de Renta
                    </label>
                    <input type="text" class="form-control" id="rent_date" name="rent_date" value="{{ $rent->rent_date }}" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="return_date" class="form-label">
                        <i class="far fa-calendar-alt text-warning"></i> Fecha de Retorno
                    </label>
                    <input type="text" class="form-control" id="return_date" name="return_date" value="{{ $rent->return_date }}" disabled>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar Cambios
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
        document.addEventListener("DOMContentLoaded", function () {
            // Obtener elementos del DOM
            var stockInput = document.getElementById("stock");
            var authorInput = document.getElementById("author");
            var publicationDateInput = document.getElementById("publication_date");
            var statusInput = document.getElementById("status");
            var rentDateInput = document.getElementById("rent_date");
            var returnDateInput = document.getElementById("return_date");
            var rentDaysInput = document.getElementById("rent_days");
            var bookSelect = document.getElementById("book_id");

            // Evento de cambio en la selección de libro
            bookSelect.addEventListener("change", function () {
                // Obtener el libro seleccionado
                var selectedBook = {!! json_encode($books->keyBy('id')->toArray(), JSON_HEX_QUOT) !!}[bookSelect.value];

                // Actualizar detalles del libro
                stockInput.value = selectedBook ? selectedBook.stock : '';
                authorInput.value = selectedBook ? selectedBook.author : '';
                publicationDateInput.value = selectedBook ? selectedBook.publication_date : '';
                statusInput.value = selectedBook ? selectedBook.status : '';
            });

            // Evento de cambio en la cantidad de días
            rentDaysInput.addEventListener("change", function () {
                // Obtener la fecha actual
                var currentDate = moment();

                // Calcular la fecha de retorno sumando la cantidad de días ingresada
                var returnDate = currentDate.clone().add(rentDaysInput.value, "days");

                // Formatear las fechas y establecerlas en los campos de entrada
                rentDateInput.value = currentDate.format("YYYY-MM-DD");
                returnDateInput.value = returnDate.format("YYYY-MM-DD");
            });

            // Mostrar detalles del libro al cargar la página
            bookSelect.dispatchEvent(new Event('change'));
        });
    </script>
@endsection
