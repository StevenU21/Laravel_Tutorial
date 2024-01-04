@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Producto</h1>

        @livewire('products.edit-products', ['product' => $product])
    </div>
@endsection
