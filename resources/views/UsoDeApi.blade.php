@extends('layouts.plantilla')
@section('title')
    Uso de la Api - MyFakeList
@endsection
@section('head')
    <script src="https://kit.fontawesome.com/b873749123.js" crossorigin="anonymous"></script>
@endsection
@section('content')
    <br>
    <div class="alert alert-success" role="alert">
        Información sobre uso de la API de MyFakeList.
    </div>
    <br>
    <div class="card">
        <div class="card-body">
           Por ser usuario registrado de MyFakeList tienes disponible para tu libre uso el servicio API para realizar diverdas consultas que se
            detallan mas adelante.
        </div>
        <div class="card-body">
            <ol><li><h3><i class="fas fa-chevron-right">Requisitos:</i></h3></li>
            <i class="fas fa-long-arrow-alt-right"></i>Unicamente estar registrado en MyfakeList tendras libre acceso a la API.
            </ol>

        </div>
        <div class="card-body">
            <ol><li><h3><i class="fas fa-chevron-right">Acceso y Uso:</i></h3></li>
            <i class="fas fa-long-arrow-alt-right"></i>Para acceder a las funciones, deberemos contar con un cliente para realizar peticiones a la API.
                En esta guia se usara <b>Postman</b> para los ejemplos. Todas las peticiones son devueltas en formato JSON.
            <br>
            <i class="fas fa-long-arrow-alt-right"></i>Para operar es necesario usar un <b> Beareng Token</b>, el cual sera recibido al loguearnos, mediante
            POST y enviando nuestro <b>email</b> y <b>password</b> a traves del body de la siguiente forma a traves de la url:
                <img class="rounded mx-auto d-block w-100" src="{{ asset('storage/API/auth.png') }}">
            Si todo esta correcto, recibiremos nuestro Bearer ToKen para poder realizar las peticiones.
                !! Para hacer login y logout es necesario enviarlo como tipo POST.
                Para el resto de operaciones con GET.
            Para poder usarlo, al realizar una peticion sera necesario incluir el token en el apartado "Authorization" de Postman y pegarlo en el campo de bearen token.

            </ol>
            <ol><li><h3><i class="fas fa-chevron-right">Diferentes operaciones:</i></h3></li>
                <i class="fas fa-long-arrow-alt-right">Inicio de sesion.</i> <div class="badge badge-primary text-wrap">
                    /api/login
                </div> Realizaremos en inicio de sesion para obtener nuestro token.
                <br>
                <i class="fas fa-long-arrow-alt-right">Cierre de sesion.</i> <div class="badge badge-primary text-wrap">
                    /api/logout
                </div> Cerramos la sesion y con ello nuestro token expirara.
                <br>
                <i class="fas fa-long-arrow-alt-right">Busca una serie por id.</i> <div class="badge badge-primary text-wrap">
                    /api/series/{id}
                </div> Muestra la serie que se corresponda al id introducido.
                <br>
                <i class="fas fa-long-arrow-alt-right">Busca series que se correspando con ese tipo .</i> <div class="badge badge-primary text-wrap">
                    /api/series/tipo/{tipo}
                </div> Muestra las series que correspondando con ese tipo(TV,OVA, MOVIE, SPECIAL...).
                <br>
                <i class="fas fa-long-arrow-alt-right">Busca una serie por titulo.</i> <div class="badge badge-primary text-wrap">
                    /api/series/titulo/{titulo}
                </div> Muestra las series que contengan el titulo introducido.(No es necesario estar logueado para consultar esta URL)
                <hr>
                <i class="fas fa-long-arrow-alt-right">Busca un usuario por id.</i> <div class="badge badge-primary text-wrap">
                    /api/usario/{id}
                </div> Muestra la informacion del usuaro introducido.
                <br>
                <i class="fas fa-long-arrow-alt-right">Busca un usuario por su alias.</i> <div class="badge badge-primary text-wrap">
                    /api/usario/nick/{nick}
                </div> Muestra la informacion del usuaro introducido.

            </ol>
        </div>
    </div>
@endsection
