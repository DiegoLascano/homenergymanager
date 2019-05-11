<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/resources/svg/icon-launch.svg" type="image/png">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-grey-700">
    <div id="app">
        <h1>Testing Broadcasting</h1>
        {{-- <ul class="list-reset">
            <li>
                <sidebar-item icon="icon-application" name="application" :selected="true">application</sidebar-item>
            </li>
            <li>
                <sidebar-item class="text-grey-900" icon="icon-dashboard" name="dashboard">dashboard</sidebar-item>
            </li>
            <li>
                <sidebar-item icon="icon-calendar" name="calendar">calendar</sidebar-item>
            </li>
        </ul> --}}
        {{-- <sidebar-list>
                <sidebar-item icon="icon-application" name="application" :selected="true">application</sidebar-item>
                <sidebar-item class="text-grey-900" icon="icon-dashboard" name="dashboard">dashboard</sidebar-item>
                <sidebar-item icon="icon-calendar" name="calendar">calendar</sidebar-item>
        </sidebar-list> --}}
        
    </div>
</body>
</html>