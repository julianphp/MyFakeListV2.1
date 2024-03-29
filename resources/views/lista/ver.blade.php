@extends('layouts.plantilla')
@section('title')
    @lang('list.list_title', ['name' => $aliasUsu->alias])
@endsection
@section('head')

@endsection


@section('content')
    <br>
    <div class="alert alert-primary" role="alert">

        @lang('list.list',['name' =>  $aliasUsu->alias])

    </div>
    <br>
    @if($lista === false)
        <p>@lang('list.listNo')</p>
    @else

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="text-center" style="width: 7%">#</th>
            <th scope="col" class="text-center" style="width: 15%">@lang('list.img')</th>
            <th scope="col" class="text-center" style="width: 15%">@lang('list.title')</th>
            <th scope="col" class="text-center" style="width: 10%">@lang('list.score')</th>
            <th scope="col" class="text-center" style="width: 10%">@lang('list.type')</th>
            <th scope="col" class="text-center" style="width: 10%">@lang('list.progress')</th>
            <th scope="col" class="text-center" style="width: 20%">@lang('list.comment')</th>
        </tr>
        </thead>
        <tbody>


        @if( $user === false || $user->idUsu !== $lista[0]->idUsu)

            @foreach($lista as $ser)

        <tr>
            <th class="align-middle text-center {{$ser->status}}" scope="row">{{$loop->iteration}}</th>
            <td class="align-middle text-center"> <img class="w-25" src="{{ $ser->img }}"> </td>
            <td class="align-middle text-center"> <a href={{ route('serie.ver',['idSe'=> $ser->idSe,'titulo'=>$ser->titulo]) }} > {{ $ser->titulo  }}</a>  </td>
            <td class="align-middle text-center">{{ $ser->score == NULL ? "-" : $ser->score}} </td>
            <td class="align-middle text-center">{{ $ser->tipo }} </td>

            @if( $ser->status === "Completada")

            <td class="align-middle text-center"> {{ $ser->capitulo }}  </td>
            @else
            <td class="align-middle text-center">{{ $ser->capitulo }} / {{ $ser->episodios }} </td>
            @endif
              <td class="align-middle text-center">  {{$ser->review == "" ? "---" : $ser->review }}   </td>
        </tr>
            @endforeach
        @else
            @foreach($lista as $ser)

            <tr>
                <th class="align-middle text-center {{ $ser->status }}" scope="row">{{$loop->iteration}}</th>
                <td class="align-middle text-center">
                    <p class="text-justify"><img alt="{{ $ser->titulo }}" src="{{ $ser->img }}" width="40%">
                        <a class="edit" href="#"
                           data-idse="{{$ser->idSe}}" data-titulo="{{$ser->titulo}}" data-sts="{{$ser->status}}"
                           data-fav="{{$ser->favorita}}" data-cap="{{$ser->capitulo}}" data-ini="{{$ser->fec_add}}"
                           data-fin="{{$ser->fec_end}}" data-caplast="{{ $ser->episodios }}"
                           data-rev="{{$ser->review}}"
                        >@lang('list.edit')</a>
                    </p>
                </td>
                <td class="align-middle text-center"> <a href="{{ route('serie.ver',['idSe'=> $ser->idSe,'titulo'=>$ser->titulo]) }}" > {{ $ser->titulo }} </a>  </td>
                <td class="align-middle text-center">
                    <span class="spanScoreUser" id="spanIdScoreUser-{{$loop->iteration}}" data-idsc="{{$loop->iteration}}">{{ $ser->score == NULL ? "-" : $ser->score}}  </span>
                    <div class="form-group selectScoreUser" hidden id="selectScoreUser-{{$loop->iteration}}" >
                        <select class="form-control score"  data-idscore="{{$loop->iteration}}" data-ser="{{ $ser->idSe }}" data-usu="{{ $ser->idUsu }}">
                                <option>-</option>
                            @for($x=0; $x<=10;$x++)
                                <option>{{$x}}</option>
                            @endfor
                        </select>
                    </div>
                </td>
                <td class="align-middle text-center"> {{ $ser->tipo }}</td>
                @if($ser->status === "Completada")
                    <td class="align-middle text-center"><span id="cap{{ $ser->idSe }}"> {{  $ser->episodios  }}  </td>
                @else
                    <td class="align-middle text-center"><span id="cap{{ $ser->idSe }}"> {{ $ser->capitulo }}  </span> / {{$ser->episodios}} <i class="fas fa-plus-circle" data-se="{{ $ser->idSe }}" data-usu="{{ $ser->idUsu }}"></i></td>
                @endif

                <td class="align-middle text-center">
                    <span class="spanCommentUser" id="spanCommentUser-{{$loop->iteration}}" data-idrow="{{$loop->iteration}}">{{  $ser->review == "" ? "---" : $ser->review }}  </span>
                    <textarea id="textareaCommentUser-{{$loop->iteration}}" class="form-control textareaCommentUser" hidden name="des" data-idrow="{{$loop->iteration}}"  data-ser="{{$ser->idSe}}" data-usu="{{ $ser->idUsu }}" maxlength="254" rows="2"></textarea>
                </td>
            </tr>

            @endforeach
            @include('lista.modals.editar')
        @endif




        </tbody>
    </table>

    @endif

@endsection
@section('footer-script')
    <script src="{{ asset('js/librarys/kit-fontawesome.js') }}"></script>
     @if($user && $lista && $user->idUsu === $lista[0]->idUsu )
        <script src="{{ asset('js/list/locateList.js') }}"></script>
        <script src="{{ asset('js/list/score.js') }}"></script>
        <script src="{{ asset('js/list/chapter.js') }}"></script>
        <script src="{{ asset('js/list/comment.js') }}"></script>
        <script src="{{ asset('js/list/modalEdit/changeFavoriteSerieUserList.js') }}"></script>
        <script src="{{ asset('js/list/modalEdit/deleteSerieFromUserList.js') }}"></script>
        <script src="{{ asset('js/list/showModalEditSeriesUser.js') }}"></script>
     @endif
@endsection
