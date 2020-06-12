<html>
<head>
    <title>@yield('title') </title>
    <link rel="icon" href="{{ asset('storage/favicon.ico') }}" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">

    <script src="{{ asset('js/busqueda.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content= "index, follow">
    <meta name="description" content= "La mejor pagina de seguimiento de anime" />
    <meta property="og:title" content="Tu nueva web de seguimiento de anime." />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="myfakelist.kumiko.es" />
    <meta property="og:image" content="https://i.imgur.com/1nViyok.jpg" />
    <meta property="og:site_name" content="My Fake List" />
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>
    @yield('head')
</head>
<body>

<div class="container">

    @if  (!\Illuminate\Support\Facades\Auth::check())
        @include('layouts.navbarVisitante')
    @else
        @include('layouts.navBarLogeado')
    @endif
    <div id="resultadoBus">

    </div>
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
</body>
</html>
