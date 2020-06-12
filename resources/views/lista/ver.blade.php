@extends('layouts.plantilla')
@section('title')
    Lista de {{ $aliasUsu->alias }}
@endsection
@section('head')
    <script src="https://kit.fontawesome.com/b873749123.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/lista.js') }}"></script>
@endsection


@section('content')
    <br>
    <div class="alert alert-primary" role="alert">

        @lang('list.list',['name' =>  $aliasUsu->alias])

    </div>
    <br>
    @if($lista == false)
        <p>@lang('list.listNo')</p>
    @else

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">@lang('list.img')</th>
            <th scope="col">@lang('list.title')</th>
            <th scope="col">@lang('list.score')</th>
            <th scope="col">@lang('list.type')</th>
            <th scope="col">@lang('list.progress')</th>
            <th scope="col">@lang('list.comment')</th>
        </tr>
        </thead>
        <tbody>


        @if( $user == false || $user->idUsu != $lista[0]->idUsu)

            @foreach($lista as $ser)

        <tr>
            <th class="{{$ser->status}}" scope="row">{{$loop->iteration}}</th>
            <td> <img class="w-25" src="{{ $ser->img }}"> </td>
            <td> <a href={{ route('serie.ver',['idSe'=> $ser->idSe,'titulo'=>$ser->titulo]) }} > {{ $ser->titulo  }}</a>  </td>
            <td>{{ $ser->score == NULL ? "-" : $ser->score}} </td>
            <td>{{ $ser->tipo }} </td>

            @if( $ser->status == "Completada")

            <td> {{ $ser->capitulo }}  </td>
            @else
            <td>{{ $ser->capitulo }} / {{ $ser->episodios }} </td>
            @endif
              <td>  {{$ser->review == "" ? "---" : $ser->review }}   </td>
        </tr>
            @endforeach
        @else
            @foreach($lista as $ser)

            <tr>
                <th class="{{ $ser->status }}" scope="row">{{$loop->iteration}}</th>
                <td>  <p class="text-justify"><img class="w-25" src="{{ $ser->img }}">
                        <a class="edit" href="#"
                        data-idse="{{$ser->idSe}}" data-titulo="{{$ser->titulo}}" data-sts="{{$ser->status}}"
                           data-fav="{{$ser->favorita}}" data-cap="{{$ser->capitulo}}" data-ini="{{$ser->fec_add}}" data-fin="{{$ser->fec_end}}"
                           data-rev="{{$ser->review}}"
                        >@lang('list.edit')</a> </p>  </td>
                <td> <a href="{{ route('serie.ver',['idSe'=> $ser->idSe,'titulo'=>$ser->titulo]) }}" > {{ $ser->titulo }} </a>  </td>
                <td>
                    <span class="sco1" id="sco1{{$loop->iteration}}" data-idsc="{{$loop->iteration}}">{{ $ser->score == NULL ? "-" : $ser->score}}  </span>
                    <div class="form-group sco" hidden id="sco{{$loop->iteration}}" >
                        <select class="form-control score"  data-idscore="{{$loop->iteration}}" data-se="{{ $ser->idSe }}" data-usu="{{ $ser->idUsu }}">
                                <option>-</option>
                            @for($x=0; $x<=10;$x++)
                                <option>{{$x}}</option>
                            @endfor
                        </select>
                    </div>
                </td>
                <td> {{ $ser->tipo }}</td>
                @if($ser->status == "Completada")
                    <td><span id="cap{{ $ser->idSe }}"> {{  $ser->episodios  }}  </td>
                @else
                    <td><span id="cap{{ $ser->idSe }}"> {{ $ser->capitulo }}  </span> / {{$ser->episodios}} <i class="fas fa-plus-circle" data-se="{{ $ser->idSe }}" data-usu="{{ $ser->idUsu }}"></i></td>
                @endif

                <td> <span class="spanre" id="s{{$loop->iteration}}" data-ids="{{$loop->iteration}}" data-re="{{ $ser->review }}">{{  $ser->review == "" ? "---" : $ser->review }}  </span>
                    <textarea id="txt{{$loop->iteration}}" class="form-control tex1" hidden name="des" data-idt="{{$loop->iteration}}"  data-se="{{$ser->idSe}}" data-usu="{{ $ser->idUsu }}" maxlength="999" rows="2"></textarea>
                </td>
            </tr>

            @endforeach
            @include('lista.editar')
        @endif




        </tbody>
    </table>

    @endif

@endsection


