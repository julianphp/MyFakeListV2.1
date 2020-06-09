<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="{{ route('inicio') }}">MyFakeList</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('inicio') }}">@lang('messages.home') <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{route('login')}}">@lang('messages.login')</a>
            </li>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @lang('messages.profile')
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="{{route('login')}}">@lang('messages.list')</a>
                    <a class="dropdown-item" href="{{route('login')}}">@lang('messages.profile')</a>
                </div>
            </li>
            <li class="nav-item ">
                <a class="btn btn-primary" href="{{ route('registro') }}" role="button">@lang('messages.register') </a>   </li>
        </ul>
        <ul class="navbar-nav mr-right">
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Lang
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{url('setlocale/es')}}"><img class="w-25" src="{{ asset('storage/flags/espana.svg') }}"> Español </a>
                    <a class="dropdown-item" href="{{url('setlocale/en')}}"><img class="w-25" src="{{ asset('storage/flags/uk.svg') }}"> Ingles</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-4 my-lg-0" method="get">
            <input class="form-control mr-sm-4" type="text" name="busqueda" id="busqueda" placeholder="@lang('messages.search')" aria-label="Search">



        </form>
        <br>
    </div>
</nav>
