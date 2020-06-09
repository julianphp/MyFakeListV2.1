@extends('layouts.plantilla')
@section('title')
    Administracion
@endsection
@section('head')
    <script src="{{ asset('js/administracion.js') }}"></script>
    @endsection

@section('content')
    <br>
    <div class="alert alert-primary" role="alert">
        Usuarios Activos
    </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">alias</th>
                <th scope="col">email</th>
                <th scope="col">Creado el</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($listUsu as $list)
            <tr>
                <th scope="row">{{ $list->idUsu }}</th>
                <td>{{ $list->alias }}</td>
                <td>{{ $list->email }}</td>
                <td>{{ $list->created_at }}</td>
                @if( ($list->is_admin != 1) )
                <td><button type="button" class="btn btn-danger btn1" data-id="{{$list->idUsu}}" data-nick="{{$list->alias}}" data-email="{{$list->email}}">Borrar</button></td>
                @endif
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="alert alert-primary" role="alert">
           Usuarios Borrados
        </div>
        @if($listDel == false)
           <P>No hay usuarios Borrados</P>
        @else

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">alias</th>
                <th scope="col">email</th>
                <th scope="col">Creado el</th>
                <th scope="col">Borrado</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($listDel as $list)
                <tr>
                    <th scope="row">{{ $list->idUsu }}</th>
                    <td>{{ $list->alias }}</td>
                    <td>{{ $list->email }}</td>
                    <td>{{ $list->created_at }}</td>
                    <td>{{ $list->updated_at }}</td>
                    <td><button type="button" class="btn btn-warning btnR" data-id="{{$list->idUsu}}" data-nick="{{$list->alias}}" data-email="{{$list->email}}">Recuperar</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
@endsection
<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Borrado de Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estas seguro de querer <span id="txt"></span> <b><span id="nick"></span></b>, con el correo
                <b><span id="email"></span></b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="del btn btn-danger ">Borrar</button>
                <button type="button" class="rec btn btn-danger ">Recuperar</button>
            </div>
        </div>
    </div>
</div>
