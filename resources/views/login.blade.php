@extends('layouts.plantilla')
@section('content')

    @if($error == true)
        <div class="alert alert-danger" role="alert">
           @lang('login.incorrect')
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            @lang('login.change')
        </div>
    @endif
    <div class="row justify-content-md-center">
        <div class="w-50">
            <form action="{{route('login')}}" method="post" >
                @csrf
            <div class="form-group">
                <label for="correo">@lang('login.email')</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">
                <label for="contrasenia">@lang('login.pass')</label>
                <input type="password" class="form-control" name="password"  required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="recordar" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">@lang('login.session')</label>
            </div>
            <button type="submit" class="btn btn-primary">@lang('login.login')</button>
            <a class="btn btn-info" href="{{route('olvidemicontrasenia')}}" role="button">@lang('login.forgot')</a>
            </form>
        </div>
    </div>

@endsection
