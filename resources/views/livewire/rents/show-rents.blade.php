<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h2>Detalles de la Renta</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-user text-primary"></i> Usuario: {{ $rent->user->name }}
                    </h5>
                    <p class="card-text">
                        <i class="fas fa-book text-warning"></i> Título: {{ $rent->book->title }}
                    </p>
                
                    <p class="card-text">
                        <i class="fas fa-pen text-warning"></i> Autor: {{ $rent->book->author }}
                    </p>
                
                    <p class="card-text">
                        <i class="fas fa-calendar-alt text-warning"></i> Fecha de Publicación: {{ $rent->book->publication_date }}
                    </p>
                
                    <p class="card-text">
                        <i class="fas fa-info-circle text-warning"></i> Estado: {{ $rent->book->status }}
                    </p>
                
                    <p class="card-text">
                        <i class="fas fa-layer-group text-warning"></i> Stock: {{ $rent->book->stock }}
                    </p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('rents.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>