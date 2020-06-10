@extends('layouts.plantilla')
@section('title')
   Perfil de {{ $usuario->alias }} - MyFakeList
@endsection
@section('head')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/js/mdb.min.js"></script>
    <script src="https://kit.fontawesome.com/b873749123.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/perfil.js') }}"></script>
    <script src="{{ asset('js/registro.js') }}"></script>
@endsection
@section('content')
    <br>
    <div class="alert alert-primary" role="alert">
        @lang('profile.profile',['name' => $usuario->alias])
    </div>
    @if (session('errorPhoto'))
        <div class="alert alert-danger">
            @lang('profile.edit.photoError')
        </div>
    @endif
    @if (session('errorEmail'))
        <div class="alert alert-danger">
           @lang('profile.errorEmail')
        </div>
    @endif
    @if (session('errorEmailSend'))
        <div class="alert alert-danger">
           @lang('profile.errorEmailSend')
        </div>
    @endif
    @if (session('successEmail'))
        <div class="alert alert-info">
           @lang('profile.successEmail',['email' => session('successEmail')])
        </div>
    @endif
    @if (session('successPhoto') == true)
        <div class="alert alert-info">
            @lang('profile.successPhoto')
        </div>
    @endif


            @if(session('pass') == 'ok')
                <div class="alert alert-info">
                @lang('profile.successPass')
                </div>
                @endif
            @if(session('pass') == 'no')
                <div class="alert alert-danger">
                @lang('profile.successError')
                </div>
            @endif


<div class="row">

    <div class="col-4 linea">

        <img src="{{ asset('storage/'.$usuario->avatar) }}" class="rounded mx-auto d-block w-100"  alt="Foto usuario">


        <div class="infoSerie">
            <p class="infoSerietit">
                @lang('profile.details')</p>

            <hr>
            <li><b>@lang('profile.location')</b> {{ $usuario->location }} </li>
            <li><b>@lang('profile.member')</b>   {{ \Carbon\Carbon::parse($usuario->created_at)->format('d-m-Y') }} </li>

            <hr>
               <p class="infoSerietit">Estadisticas de Anime</p>

            <li><b>@lang('profile.all')</b>  <span id="all"></span></li>
            <li><b>@lang('profile.watch')</b>   <span id="viendo"></span> </li>
            <li><b>@lang('profile.completed')</b>   <span id="completed"></span> </li>
            <li><b>@lang('profile.drop')</b>  <span id="drop"></span> </li>
            <li><b>@lang('profile.plantowach')</b>  <span id="ptw"></span>   </li>
            <hr>
        </div>
        <div><a class="btn btn-primary" href="{{ route('lista.ver',['idUsu'=> $usuario->idUsu,'alias' => $usuario->alias]) }}" role="button">@lang('profile.list')</a>       </div>

    @if( $edit == true)
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#infoUsu">
                @lang('profile.edit.profile')
            </button>
            @if( $usuario->is_admin == 1)

                    <a class="btn btn-info" href="{{ route('administracion') }}" role="button">@lang('profile.admin')</a>

            @endif
        @endif





    </div>
    <div class="col-8">
        <div><p>{{ $usuario->about }}</p></div>
        <div class="infoSerietit"><p>@lang('profile.fav')</p>
            <hr>

            <ul>
                @if($seriesFav != false)
                     @foreach($seriesFav as $item)
                        <li><img src="{{ $item->img }}" alt="Foto Serie" class="img-thumbnail" width="70vw" >  <a href="{{ route('serie.ver',['idSe' => $item->idSe,'titulo' => $item->titulo]) }}"> {{ $item->titulo }}</a></li>



                    @endforeach

                @else
                    <p>@lang('profile.favNo')</p>
                @endif

            </ul>


        </div>
        <hr>
        <div>
            <div class="infoSerietit">@lang('profile.stats')</div>
            <input type="text" id="123" name="idUsu" value="{{ $usuario->idUsu }}" hidden>
            <p class="text-center" id="nochartjs"></p>
        <canvas id="pieChart"></canvas>
        </div>


    </div>
</div>



@if($edit == true)
@include('perfil.ajustes')
@endif
    <script src="{{ asset('js/chart.js') }}"></script>
@endsection
