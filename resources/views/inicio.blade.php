
@extends('layouts.plantilla')
@section('title')
    Inicio - MyFakeList
@endsection
@section('content')
<br>
<div id="app">
    <espacio></espacio>
</div>
<hr>
<h2>@lang('messages.romance')</h2>
<br>
    <div class="card-group">

            @foreach($romance as $item)

                <div class="card">
                    <img src=" {{ $item->img }} " class="card-img-top img-fluid rounded mx-auto w-100 d-block" alt="...">
                    <div class="card-body"><a href="{{ route('serie.ver',['idSe' => $item->idSe,'titulo' => $item->titulo]) }}">
                            <h5 class="card-title"> {{ $item->titulo }}</h5> </a>
                    </div>
                </div>

            @endforeach


    </div>
    <hr>
<h2>@lang('messages.sol')</h2>
<br>
    <div class="card-group">

            @foreach($slice as $item)

                <div class="card">
                    <img src=" {{ $item->img }} " class="card-img-top img-fluid rounded mx-auto w-100 d-block" alt="...">
                    <div class="card-body"><a href="{{ route('serie.ver',['idSe' => $item->idSe,'titulo' => $item->titulo]) }}">
                            <h5 class="card-title"> {{ $item->titulo }}</h5> </a>
                    </div>
                </div>

            @endforeach


    </div>
@if($users != false)
<h2>@lang('messages.lasrtuserregistrer')</h2>
<br>
    <div class="card-group">

            @foreach($users as $item)

                <div class="card">
                    <img src=" {{ asset('storage/'.$item->avatar) }} " class="card-img-top img-fluid rounded mx-auto w-100 d-block" alt="...">
                    <div class="card-body"><a href="{{ route('perfil.ver',['idUsu' => $item->idUsu,'alias' => $item->alias]) }}">
                            <h5 class="card-title"> {{ $item->alias }}</h5> </a>
                    </div>
                </div>

            @endforeach


    </div>
@endif
@routes
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
</script>
@endsection
