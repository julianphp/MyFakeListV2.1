<html>
<head>
    <title>@yield('title') </title>
    <link rel="icon" href="{{ asset('storage/favicon.ico') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/librarys/bootstrap4-6.css') }}">
    <script
        src="{{ asset('js/librarys/jquery3-6.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">

    <script src="{{ asset('js/busqueda.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content= "index, follow">
    <meta name="title" content="@lang('messages.meta_title')">
    <meta name="description" content= "@lang('messages.meta_description')" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://myfakelist.kumiko.es/">
    <meta property="og:title" content="@lang('messages.meta_title')">
    <meta property="og:description" content="@lang('messages.meta_description')">
    <meta property="og:image" content="https://i.imgur.com/1nViyok.jpg">
    <meta property="og:site_name" content="My Fake List" />
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://myfakelist.kumiko.es/">
    <meta property="twitter:title" content="@lang('messages.meta_title')">
    <meta property="twitter:description" content="@lang('messages.meta_description')">
    <meta property="twitter:image" content="https://i.imgur.com/1nViyok.jpg">
    <meta property="twitter:site_name" content="My Fake List" />

    <script type="text/javascript">
        const APP_URL = {!! json_encode(url('/')) !!};
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

<script>
    const language = '{{ App::getLocale() }}';
</script>
<script src="{{ asset('js/globalFunctions/sendRequest.js') }}"></script>
<script src="{{ asset('js/librarys/popper-1-16.js') }}"></script>
<script src="{{ asset('js/librarys/bootstrap4-6.js') }}"></script>
<script src="{{ asset('js/language/langGeneric.js') }}"></script>
    @yield('footer-script')

</body>
</html>
