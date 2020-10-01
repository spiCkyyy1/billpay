<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bill Pay</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
<div>
    @if(Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register' ||
        Route::currentRouteName() == 'verification.notice' || Route::currentRouteName() == 'password.request' ||
        Route::currentRouteName() == 'password.reset' || Route::currentRouteName() == 'password.update')
        @yield('content')
    @else
        <div id="wrapper">
            @include('layouts.navigation')
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    @include('layouts.header')
                    @yield('content')
                </div>
            </div>
        </div>
    @endif
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@stack('script')
</body>
</html>
