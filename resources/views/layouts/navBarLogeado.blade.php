<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('inicio') }}">MyFakeList</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('inicio') }}">@lang('messages.home')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('lista.ver', ['idUsu' => Auth::id(), 'alias' => Auth::user()->alias]) }}">@lang('messages.list')</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('messages.profile')
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"  href="{{route('perfil.ver',['idUsu' => Auth::id(), 'alias' => Auth::user()->alias])}}">@lang('messages.profile')</a>
                        <a class="dropdown-item" href="{{route('logout')}}">@lang('messages.closeSesion')</a>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary active" href="{{ route('perfil.ver',['idUsu' => Auth::id(), 'alias'=> Auth::user()->alias])}}" role="button"> @lang('messages.welcome', ['name' => Auth::user()->alias])</a>   </li>
                </li>
            </ul>
            <ul class="navbar-nav mr-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        @lang('messages.language')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('setlocale/es')}}"><img class="w-25" src="{{ asset('storage/flags/espana.svg') }}" alt="@lang('messages.language_flag_spain')"> Español </a>
                        <a class="dropdown-item" href="{{url('setlocale/en')}}"><img class="w-25" src="{{ asset('storage/flags/uk.svg') }}" alt="@lang('messages.language_flag_uk')"> Ingles</a>
                    </div>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control" type="text" name="busqueda" id="busqueda" placeholder="@lang('messages.search')" aria-label="Search">
            </form>
        </div>
    </div>
</nav>
