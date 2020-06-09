@extends('layouts.plantilla')
@section('title')
    Resetear Contraseña - MyFakeList
@endsection
@section('head')
    <script src="{{ asset('js/registro.js') }}"></script>
@endsection
@section('content')
    <br>
    @if($token == false)
    <div class="alert alert-danger" role="alert">
       @lang('resetPassword.errorToken')
    </div>
    @else
        @if(session('errorPass'))
            <div class="alert alert-danger" role="alert">
                @lang('resetPassword.errorChange')

            </div>
        @endif
        <div class="row justify-content-md-center">
            <div class="w-50">
                <form method="post" action="{{ route('nuevacontrasenia',['token' => $token]) }}" >
                    @csrf
                    <div class="form-group">
                        <label for="pass">@lang('resetPassword.newPass')</label>
                        <input type="password" class="form-control pass" id="pass" name="pass"  maxlength="50">
                        <button type="button" class="btn btn-danger passreq" hidden>@lang('messages.register.passV')</button>
                    </div>
                    <div class="form-group">
                        <label for="pass1">@lang('resetPassword.repeatPass')</label>
                        <input type="password" class="form-control passcon" id="pass1" name="pass1"  maxlength="50">
                        <button type="button" class="btn btn-danger passfail" hidden>@lang('messages.register.passC')</button>
                    </div>
                    <button type="submit" class="btn btn-primary" id="env">@lang('messages.save')</button>
                </form>
            </div>

        </div>
    @endif


@endsection

