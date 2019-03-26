<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'HEMS')}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    {{-- Este layout es para probar el diseño responsive usando Tailwind CSS --}}
    <header>
        <div class="container flex justify-between p-3">
            <a class="text-grey no-underline hover:text-white" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <a href="#" class="text-grey no-underline hover:text-white uppercase text-sm">Sign in</a>
        </div>
        <div class="container mx-auto p-3">
            <p class="header-title text-white text-2xl text-center uppercase">Home Energy Management System</p>
        </div>
        <nav class="container flex justify-center p-3">
            <a href="#" class="text-grey no-underline hover:text-white text-sm uppercase mx-3">Dashboard</a>
            <a href="#" class="text-grey no-underline hover:text-white text-sm uppercase mx-3">Queries</a>
            <a href="#" class="text-grey no-underline hover:text-white text-sm uppercase mx-3">information</a>
        </nav>
    </header>
    <div class="container">
        <div class="md:min-h-screen md:flex md:flex-col">
            <div class="md:flex md:flex-1">
                <aside class="bg-blue p-3">
                    Space for Widgets
                </aside>
                <main class="bg-red md:flex-1 p-3">
                    <div class="flex flex-wrap">
                        <div class="w-full p-3">
                            <div class="bg-grey-light p-3 md:mb-2 md:mx-2">
                                <p>Graph from vue-chart.js</p>
                            </div>
                        </div>
    
                        <div class="w-full sm:w-1/2 md:w-1/4 p-3">
                            <div class="bg-grey-light p-3 md:mb-2 md:mx-2">
                                <p>Product Feature</p>
                            </div>
                        </div>
    
                        <div class="w-full sm:w-1/2 md:w-1/4 p-3">
                            <div class="bg-grey-light p-3 md:mb-2 md:mx-2">
                                <p>Product Feature</p>
                            </div>
                        </div>
    
                        <div class="w-full sm:w-1/2 md:w-1/4 p-3">
                            <div class="bg-grey-light p-3 md:mb-2 md:mx-2">
                                <p>Product Feature</p>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <footer class="bg-grey p-3">
                Copyright 2018
            </footer>
        </div>
    </div>
</body>
</html>