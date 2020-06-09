<h3>@lang('messages.search.result')</h3>

<h2>Series:</h2>
@if($ser != false)
    @foreach($ser as $item)
        <a href="{{ route('serie.ver',['idSe' => $item->idSe,'titulo'=> $item->titulo]) }}">
            <h6 class="card-title"><img src="{{ $item->img }}" alt="Foto Serie" class="img-thumbnail" width="70vw" > {{ $item->titulo }}</h6> </a>
     @endforeach
@else

<h4>@lang('messages.search.anime.no')</h4>
@endif

<h2>Usuarios:</h2>
@if($usu != false)
    @foreach($usu as $item)
<a href="{{ route('perfil.ver',['idUsu' => $item->idUsu,'alias' => $item->alias]) }}">
    <h6 class="card-title"><img src="{{asset('storage/'.$item->avatar)}}" alt="Foto Usuario" class="img-thumbnail" width="70vw" >{{ $item->alias }}</h6> </a>
    @endforeach
@else

<h4>@lang('messages.search.users.no')</h4>
@endif
