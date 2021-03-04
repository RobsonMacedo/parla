<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="apple-mobile-web-app-capable" content="yes" />

        <meta content="" name="description">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="icon" href="favicon.ico" />

        <link rel="stylesheet" type="text/css" href="{{ mix('/css/app.css') }}">
        <link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/get_route(/css/font-awesome.min.css">

        @if (request()->get('client') == 'app')
            <link rel="stylesheet" href="/css/client-app.css">
        @endif

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
                'api_token' => \Auth::user()->api_token ?? '',
            ]) !!};
        </script>
    </head>

    <body>
        @yield('body')

        @include('layouts.partials.google-analytics')
    </body>
</html>
