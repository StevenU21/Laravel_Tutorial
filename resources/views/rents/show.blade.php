@extends('layouts.app')

@section('content')
    @livewire('rents.show-rents', ['rent' => $rent])
@endsection
