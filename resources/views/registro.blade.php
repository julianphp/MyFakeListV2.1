
@extends('layouts.plantilla')
@section('title')
   Registro - MyFakeList
@endsection
@section('head')
    <script src="{{ asset('js/registro.js') }}"></script>
@endsection
@section('content')

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            @lang('signup.success',['url' => route('login')])
        </div>

    @endif
    @if(session('nickError'))
        <div class="alert alert-danger" role="alert">
            @lang('signup.nickerror')
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
           @lang('signup.error')
        </div>
    @endif
    @if(session('email'))
        <div class="alert alert-danger" role="alert">
           @lang('signup.errorMail')
        </div>
    @endif
<div class="row justify-content-md-center">
    <div class="w-50">
        <form action="{{ route('registro') }}" method="post">
                @csrf
            <div class="mb-2">
                <label class="form-label" for="correo">@lang('signup.mail')</label>
                <input type="email" class="form-control mail" name="correo"  aria-describedby="emailHelp" required>

            </div>
            <div class="mb-2">
                <label class="form-label" for="contrasenia">@lang('signup.pass')</label>
                <input type="password" class="form-control pass" name="contrasenia" required>
                <button type="button" class="btn btn-danger passreq" hidden>@lang('signup.passV')</button>
            </div>
            <div class="mb-2">
                <label class="form-label" for="confircontrasenia">@lang('signup.pass1')</label>
                <input type="password" class="form-control passcon"  name="confircontrasenia" required>
                <button type="button" class="btn btn-danger passfail" hidden>@lang('signup.passC')</button>
            </div>
            <div class="mb-2">
                <label class="form-label" for="nick">@lang('signup.nick')</label>
                <input type="text" class="form-control nick"  name="nick" required>
                <button type="button" class="btn btn-danger rep1" hidden>@lang('signup.nickN')</button>
                <button type="button" class="btn btn-danger nickcheck" hidden>@lang('signup.nickL')</button>
                <div id="rep"></div>
            </div>

            <button type="submit" class="btn btn-primary" id="env" >@lang('signup.send')</button>
        </form>
    </div>
</div>
@endsection
