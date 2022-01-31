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


        @if( $user === false || $user->idUsu != $lista[0]->idUsu)

            @foreach($lista as $ser)

        <tr>
            <th class="{{$ser->status}}" scope="row">{{$loop->iteration}}</th>
            <td> <img class="w-25" src="{{ $ser->img }}"> </td>
            <td> <a href={{ route('serie.ver',['idSe'=> $ser->idSe,'titulo'=>$ser->titulo]) }} > {{ $ser->titulo  }}</a>  </td>
            <td>{{ $ser->score == NULL ? "-" : $ser->score}} </td>
            <td>{{ $ser->tipo }} </td>

            @if( $ser->status === "Completada")

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
                @if($ser->status === "Completada")
                    <td><span id="cap{{ $ser->idSe }}"> {{  $ser->episodios  }}  </td>
                @else
                    <td><span id="cap{{ $ser->idSe }}"> {{ $ser->capitulo }}  </span> / {{$ser->episodios}} <i class="fas fa-plus-circle" data-se="{{ $ser->idSe }}" data-usu="{{ $ser->idUsu }}"></i></td>
                @endif

                <td>
                    <span class="spanCommentUser" id="spanCommentUser-{{$loop->iteration}}" data-idrow="{{$loop->iteration}}">{{  $ser->review === "" ? "---" : $ser->review }}  </span>
                    <textarea id="textareaCommentUser-{{$loop->iteration}}" class="form-control textareaCommentUser" hidden name="des" data-idrow="{{$loop->iteration}}"  data-ser="{{$ser->idSe}}" data-usu="{{ $ser->idUsu }}" maxlength="999" rows="2"></textarea>
                </td>
            </tr>

            @endforeach
            @include('lista.editar')
        @endif




        </tbody>
    </table>

    @endif

@endsection
@section('footer-script')
    <script src="{{ asset('js/librarys/kit-fontawesome.js') }}"></script>
    <script src="{{ asset('js/lista.js') }}"></script>
    <script src="{{ asset('js/language/list/lang.js') }}"></script>
    <script>
        window.addEventListener('load', function () {

            let addCap = document.querySelectorAll('.fa-plus-circle');

            addCap.forEach( item => {
                item.addEventListener('click', function (e){
                    sendRequest('/lista/cap',{
                        'usu': e.target.dataset.usu,
                        'ser': e.target.dataset.se
                    }).then( data => {
                        if (!data.error){
                            document.getElementById('cap' + e.target.dataset.se).innerText = data.cap;
                        } else {
                            alert(lang[language].error_generic);
                        }
                    });
                })
            })

            let editCommentUser = document.querySelectorAll('.spanCommentUser');
            editCommentUser.forEach(item => {
               item.addEventListener('click', function (e){
                   console.log(e.target.innerText,e.target.dataset.idrow );
                   let textarea = document.getElementById('textareaCommentUser-' + e.target.dataset.idrow);
                   textarea.value = e.target.innerText;
                   textarea.hidden = false;
                   e.target.style.display = 'none';
               });
            });

            let setCommentUser = document.querySelectorAll('.textareaCommentUser');
            setCommentUser.forEach( item => {
                item.addEventListener('focusout', function (e){
                   let id = e.target.dataset.idrow;
                   let text = e.target.value;

                   sendRequest('/lista/review',{
                       'usu': e.target.dataset.usu,
                       'ser': e.target.dataset.ser,
                       'text': e.target.value,
                   }).then( data => {
                       if( data.error){
                           alert(lang[language].error_generic);
                       } else {
                           let spanCommentUser = document.getElementById('spanCommentUser-' + id)
                           spanCommentUser.innerText = text;
                           document.getElementById('textareaCommentUser-' + id).hidden = true;
                           spanCommentUser.style.display = 'block';
                       }
                   });
                });
            })

        }, false);
    </script>

@endsection
