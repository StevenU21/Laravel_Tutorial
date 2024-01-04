@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Agregar Nuevo Producto</h1>

        @livewire('products.create-product')
    </div>
@endsection
