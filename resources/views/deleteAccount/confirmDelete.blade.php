
@extends('layouts.plantilla')
@section('title')
   Borrar Cuenta - MyFakeList
@endsection
@section('content')
    <br>
    @if(isset($errorExist))
        <div class="alert alert-danger" role="alert">
            @lang('deleteAccount.errorExist')
        </div>
    @endif
    @if(isset($errorLog))
        <div class="alert alert-danger" role="alert">
            @lang('deleteAccount.errorLog')
        </div>
    @endif
    @if(isset($success))
        <div class="alert alert-success" role="alert">
            @lang('deleteAccount.success')
        </div>
    @endif
    @if(isset($token))
    <div class="row justify-content-md-center">
        <div class="w-50 text-center" >
            <form action="{{route('perfil.delConfirm',['token' => $token])}}" method="post" >
                @csrf
                <div class="alert alert-danger" role="alert">
                 @lang('deleteAccount.info')
                </div>
                <br>
                <input type="hidden" name="delete" value="ok">

                <button type="submit" class="btn btn-danger">@lang('deleteAccount.delete')</button>
                <a class="btn btn-primary" href="{{ route('inicio') }}" role="button">@lang('deleteAccount.cancel')</a>
            </form>
        </div>

    </div>
    @endif

@endsection
