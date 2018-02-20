﻿<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        @include('layouts.partials.favicon')

        {{--<link rel="stylesheet" href="/css/monte.css">--}}

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
                'apiPrefix' => '/api/v1',
            ]) !!};
        </script>

        <script defer src="https://use.fontawesome.com/releases/v5.0.1/js/all.js"></script>

        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/parla.css">
    </head>

    <body class="bg-grey-light">
        <div id="vue-parla">
            @include('layouts.partials.nav')

            @include('layouts.partials.header')

            <div v-cloak>
                @yield('contents')
            </div>

            @include('layouts.partials.footer')
        </div>

        <script src="/js/app.js"></script>

        @include('layouts.partials.livereload')

        @include('layouts.partials.google-analytics')
    </body>
</html>
