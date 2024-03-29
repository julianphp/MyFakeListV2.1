@extends('layouts.plantilla')
@section('title')
    Serie {{ $serie->titulo }} - MyFakeList
@endsection
@section('content')

    <br>
    <div class="alert alert-primary" role="alert">
        {{ $serie->titulo }}
    </div>
    <br>

    <div class="row">

        <div class="col-4 linea">
            <img src="{{ $serie->img }}" class="rounded mx-auto d-block" alt="Portada Serie">
                <div class="infoSerie">
                    <p>@lang('anime.details')</p>
                    <hr>
                    <ul>
                        <li><b>@lang('anime.jTitle')</b> {{  $serie->tituloJap != "NULL" ? $serie->tituloJap : trans('anime.notAvalaible') }} </li>

                        <li><b>@lang('anime.study')</b>  {{ $estudio->NombreEstudio }} </li>
                        <li><b>@lang('anime.status')</b> {{  $serie->estado != "NULL" ? $serie->estado : trans('anime.notAvalaible') }} </li>
                        <li><b>@lang('anime.type')</b> {{ $serie->tipo != "NULL" ? $serie->tipo : trans('anime.notAvalaible')  }} </li>
                        <li><b>@lang('anime.episodes')</b> {{  $serie->episodios != "NULL" ? $serie->episodios : trans('anime.notAvalaible') }} </li>
                        <li><b>@lang('anime.duration')</b> {{ $serie->duracion != "Unknown" ? $serie->duracion : trans('anime.notAvalaible')}}  </li>

                        <li><b>@lang('anime.fecEmi')</b> {{ $serie->fec_ini != NULL ? \Carbon\Carbon::parse($serie->fec_ini)->format('d-m-Y')  : trans('anime.notAvalaible') }} </li>
                        <li><b>@lang('anime.fecEnd')</b> {{ $serie->fec_fin != NULL ? \Carbon\Carbon::parse($serie->fec_fin)->format('d-m-Y') : trans('anime.notAvalaible') }} </li>



                        <li><b>@lang('anime.genre')</b>
                             @foreach($gen as $item)
                            {{$item->genero}}@if($loop->last). @else, @endif

                        @endforeach
                        </li>

                        <li><b>PEGI:</b> {{ $serie->pegi != "NULL" ? $serie->pegi : __('anime.notAvalaible')}} </li>


                    </ul>
                </div>
        </div> <!-- end col 4 -->

        <div class="col-8">


            @if($user)
                <input type="hidden" id="idUser" value="{{ $user->idUsu }}">
                <input type="hidden" id="idUsuM" value="{{ $user->idUsu }}">
                <input type="hidden" id="idSeM" value="{{ $serie->idSe }}">
                <div id="addser">


                    @if(!$serieUsu)
                        <div>
                            <button type="button" class="btn btn-info" id="btnAddToUserList" data-usu="{{$user->idUsu}}"
                                    data-ser="{{$serie->idSe}}">@lang('anime.add')</button>

                        </div>
                    @else
                        {{-- Mostramos en el desplegable con el estado en que tiene la serie--}}
                        <div class="form-group">
                            <p>@lang('anime.statusUser')</p>
                            <select id="selectStatus" class="form-select selEst" data-ser="{{$serie->idSe}}">

                                @foreach($estados as $estado)
                                    @if($estado == $serieUsu[0]->status)


                                        <option selected
                                                class="p-3 mb-2 bg-success text-white">{{ $estado === "Para_Ver" ? "Para Ver" : $estado }} </option>
                                    @else
                                        <option>{{ $estado === "Para_Ver" ? "Para Ver" : $estado }} </option>
                                    @endif
                                @endforeach


                            </select>
                        </div>
                        <!-- SACAMOS LA SERIE QUE ESTA SIGUIENDO EL USUARIO -->

                        <p>@lang('anime.episodesUser')</p>
                        @if($serieUsu[0]->status === "Completada")
                            <span id="cap{{$serie->idSe}}">{{$serieUsu[0]->capitulo}}</span>
                        @else
                            <span id="cap{{$serie->idSe}}">{{$serieUsu[0]->capitulo}}</span> /  {{$serie->episodios}}<i
                                class="fas fa-plus-circle" data-se="{{$serie->idSe}}" data-usu="{{$user->idUsu}}"></i>
                        @endif
                        <script src="{{ asset('js/librarys/kit-fontawesome.js') }}"></script>

                        <!-- SELECTOR DE PUNTUACION -->
                        <div class="form-group">
                            <p>@lang('anime.score')</p>
                            <select class="form-select score selectScoreUser" data-ser="{{$serie->idSe}}" data-usu="{{$user->idUsu}}">

                                @for($x = 0; $x <=10;$x++)
                                    @if((int)$serieUsu[0]->score === $x)
                                        <option selected>{{$x}}</option>

                                    @else

                                        <option>{{$x}}</option>
                                    @endif
                                @endfor
                                @if($serieUsu[0]->score === null)
                                    <option selected>@lang('messages.choose_score')</option>
                                @endif
                            </select>
                        </div>
                        <button type="button" class="btn btn-danger" id="btnd" data-til="{{$serie->titulo}}"
                                data-ser="{{$serie->idSe}}" data-usu="{{$user->idUsu}}">@lang('anime.delete')</button>

                        @if($serieUsu[0]->favorita == 1)
                            <button type="button" class="btn btn-danger" id="fav" data-ser="{{$serie->idSe}}"
                                    data-usu="{{$user->idUsu}}" data-ope="0">@lang('anime.deleteFav')</button>

                        @else

                            <button type="button" class="btn btn-info" id="fav" data-ser="{{$serie->idSe}}"
                                    data-usu="{{$user->idUsu}}" data-ope="1">@lang('anime.favorite')</button>

                        @endif

                    @endif


                </div>
            @endif

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @if( $serie->trailer != "NULL")
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="trailer-tab" data-bs-toggle="tab" data-bs-target="#trailer"
                                    type="button" role="tab" aria-controls="Trailer" aria-selected="true">Trailer
                            </button>
                        </li>
                    @endif
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $serie->trailer == "NULL" ? "active" : "" }}" id="description-tab" data-bs-toggle="tab" data-bs-target="#description"
                                type="button" role="tab" aria-controls="@lang('anime.description')"
                                aria-selected="false">
                            @lang('anime.description')
                        </button>
                    </li>
                        @if($rel != false)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="related-tab" data-bs-toggle="tab" data-bs-target="#related"
                                        type="button" role="tab" aria-controls="@lang('anime.related')"
                                        aria-selected="false">
                                    @lang('anime.related')
                                </button>
                            </li>
                        @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    @if($serie->trailer != "NULL")
                    <div class="tab-pane fade show active" id="trailer" role="tabpanel" aria-labelledby="trailer-tab">
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $serie->trailer}}" title="YouTube video" allowfullscreen></iframe>
                        </div>
                    </div>
                    @endif
                        <div class="tab-pane fade {{ $serie->trailer == "NULL" ? "show active" : "" }}" id="description"
                             role="tabpanel" aria-labelledby="description-tab">
                            {{$serie->descripcion != "" ? $serie->descripcion : trans('anime.no_description') }}
                        </div>
                        @if($rel != false)
                            <div class="tab-pane fade" id="related" role="tabpanel" aria-labelledby="related-tab">
                                @foreach($rel as $item)  {{--recorremos los animes relacionados--}}
                                <ul>


                                    <li><b>{{ $item->tipo }}</b><br></li> <p>

                                        @foreach($serRel as $rel) {{-- entramos en el array con la info de las series concretas [x][] --}}
                                        @foreach($rel as $serie)  {{-- entramos en el array [x][y] --}}
                                        @if($item->idRel == $serie->idSe)
                                            <a href="{{ route('serie.ver', ['idSe' => $serie->idSe, 'titulo' => $serie->titulo])  }}">{{$serie->titulo}} </a>
                                        @endif
                                        @endforeach
                                        @endforeach


                                        <a href=""><br></a>

                                    </p>

                                </ul>
                                @endforeach
                            </div>
                        @endif
                </div>
        </div>

    </div> <!-- end row -->

@include('serie.borradoConfirmacion')

@endsection
@section('footer-script')
    <script src="{{ asset('js/librarys/kit-fontawesome.js') }}"></script>
    <script src="{{ asset('js/serie/setStatusFromUserList.js') }}"></script>
    <script src="{{ asset('js/list/modalEdit/deleteSerieFromUserList.js') }}"></script>
    <script src="{{ asset('js/serie/setFavoriteFromUserList.js') }}"></script>
    <script src="{{ asset('js/list/chapter.js') }}"></script>
    <script src="{{ asset('js/list/score.js') }}"></script>
    <script src="{{ asset('js/serie/addSeriesToUserList.js') }}"></script>
@endsection
