@extends('layouts.plantilla')
@section('title')
    Olvide mi Contraseña - MyFakeList
@endsection
@section('content')
    <br>
    @isset($error)
        <div class="alert alert-danger" role="alert">
            @lang('resetPassword.error')
        </div>
    @endisset
    @isset($errorSend)
        <div class="alert alert-danger" role="alert">
            @lang('resetPassword.errorSend')
        </div>
    @endisset
    @isset($send)
        <div class="alert alert-success" role="alert">
            @lang('resetPassword.send')
        </div>
    @endisset

    <div class="row justify-content-md-center">
        <div class="w-50">
            <form method="post" action="{{ route('olvidemicontrasenia') }}" >
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">@lang('resetPassword.email').</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <button type="submit" class="btn btn-primary">@lang('signup.send')</button>
            </form>
        </div>

    </div>

@endsection
