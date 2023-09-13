@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-3"><strong>Productos</strong></div>

                <div class="card-body">
                    @if (session('status') == 'Pago realizado con exito')
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @elseif(session('status') == 'Pago cancelado')
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-3 mb-1">
                                <div class="card" style="width: 15rem;">
                                    <img src="/img/images.png" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$product->name}}</h5>
                                        <p class="card-text">{{$product->description}}</p>
                                        <p class="card-text">${{$product->price}}</p>
                                        <form action="{{route('pay')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="number" name="amount" placeholder="Cantidad" min="1" required>
                                            <button type="submit" class="btn btn-primary mt-1">Comprar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
