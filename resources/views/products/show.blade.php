@extends('layouts.app')

@section('content')
        @livewire('products.show-products', ['id' => $product->id])
@endsection
