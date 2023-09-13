@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-3"><strong>Compras</strong></div>

                <div class="card-body">
                    <div class="row">
                        @foreach($transactions as $transaction)
                            <div class="col-md-4 mb-1">
                                <div class="card" style="width: 18rem;">
                                    <img src="/img/images.png" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$transaction->product->name}}</h5>
                                        <p class="card-text">{{$transaction->product->description}}</p>
                                        <p class="card-text">${{$transaction->price}} / {{$transaction->amount}}</p>
                                        <p class="card-text">Total: ${{$transaction->price * $transaction->amount}}</p>
                                        <p class="card-text">{{$transaction->created_at}}</p>
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