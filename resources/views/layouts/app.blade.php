<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEOMeta::generate(true) !!}
    {!! OpenGraph::generate(true) !!}
    {!! Twitter::generate(true) !!}

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    @if(request()->is('/'))
        @include('layouts._index_header')
    @else
        @include('layouts._header')
    @endif

    @include('layouts._toast')

    <main>
        @if( isset($noContainer) && $noContainer == true )
            @yield('content')
        @else
            @include('layouts._frame')
        @endif
        <div style="height: 96px;"></div>
    </main>
</div>

@include('layouts._scripts')
</body>
</html>
