@extends('layouts.app')

@section('content')
    @livewire('rents.update-rents', ['rent' => $rent])
@endsection
