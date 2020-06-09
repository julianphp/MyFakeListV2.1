
@extends('layouts.plantilla')
@section('title')
    Inicio - MyFakeList
@endsection
@section('content')

    <div class="alert alert-danger" role="alert">
        Pagina no encontrada. <a href="{{ route('inicio') }}">Haga click aqui para ir al incio.</a>
    </div>
    <img src="{{ asset('storage/404.png') }}"  class="img-fluid rounded mx-auto d-block" alt="Foto error 404 sin mas">
@endsection
