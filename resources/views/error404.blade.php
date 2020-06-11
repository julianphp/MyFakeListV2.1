
@extends('layouts.plantilla')
@section('title')
    Error 404 - MyFakeList
@endsection
@section('content')

    <div class="alert alert-danger" role="alert">
        Pagina no encontrada. <a href="{{ route('inicio') }}">Haga click aqui para ir al incio.</a>
    </div>
    <img src="{{ asset('storage/error404/'.$error.'.png') }}"  class="img-fluid rounded mx-auto d-block" alt="Foto error 404 sin mas">
@endsection
