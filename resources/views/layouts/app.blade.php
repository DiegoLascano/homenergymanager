<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="flex flex-col min-h-screen">
        <header class="fixed w-full">
            @include('partials.topbar')
        </header>
        <div class="md:flex md:flex-1 mt-16">
            @include('partials.sidebar')
            <main class="flex-1 flex flex-col justify-between {{Request::is('login', 'register') ? 'md:ml-0' : 'md:ml-64'}}">
                @yield('content')
                @include('partials.footer')
            </main>
        </div>
    </div>
</body>
</html>
