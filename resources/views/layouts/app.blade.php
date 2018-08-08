<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
            <meta content="width=device-width, initial-scale=1" name="viewport">
            <meta content="{{ csrf_token() }}" name="csrf-token">
            <title>@yield("title")</title>
            <link href="{{ mix('css/app.css') }}" rel="stylesheet">
            @stack('css')
            @section("header")
            @show
        </meta>
    </head>
    <body>
        <div id="app">
            @include("partials.menu")
            <main class="py-4">
                @include('layouts.alert')
                @yield('content')
            </main>
        </div>
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="https://cdn.bootcss.com/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>

        @stack('js')
        @section("footer")
        @show
    </body>
</html>
