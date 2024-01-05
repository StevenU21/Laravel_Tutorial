@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Bienvenido a Laravel Tutorial</div>

                    <div class="card-body">
                        <p>En este proyecto, aprenderás paso a paso cómo realizar un CRUD básico en Laravel.</p>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('rents.index') }}"
                                    title="Aqui irás directamente al resultado del Proyecto para que lo Pruebes"
                                    class="btn btn-primary">
                                    <i class="fas fa-rocket"></i> Ir al Proyecto
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="https://github.com/StevenU21" target="_blank"
                                    title="En el Repositorio estará el Paso a Paso de la Creación del Proyecto"
                                    class="btn btn-secondary">
                                    <i class="fab fa-github"></i> Ir al Repositorio del Creador
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
