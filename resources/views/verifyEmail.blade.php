@extends('layouts.plantilla')
@section('title')
    Verificar Cambio Correo - MyFakeList
@endsection

@section('content')
    <br>

    @if(isset($error))
        <div class="alert alert-warning" role="alert">
           @lang('changeEmail.error')

        </div>
    @endif
    @if ( isset($success))
        <div class="alert alert-success">
            @lang('changeEmail.success')
        </div>
    @endif


    @if (isset($errorToken))
        <div class="alert alert-warning">
            @lang('changeEmail.errorToken')
        </div>
    @endif


@endsection
