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
    @include('partials.navbar')
    <div id="app" class="container">
        <div class="md:min-h-screen md:flex md:flex-col">
            <div class="md:flex md:flex-1">
                <aside class="bg-blue p-3">
                    Space for Widgets
                </aside>
                <main class="bg-grey-100 md:flex-1 p-3">
                    <div class="flex flex-wrap">
                        <div class="w-full p-3">
                            <div class="md:mb-2 md:mx-2">
                                <div class="graph-container bg-white border-2 border-solid border-grey rounded-lg">
                                    <cost-graph url="/api/getEnergyCost" day="1"></cost-graph>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="w-full p-3">
                            <div class="md:mb-2 md:mx-2">
                                <div class="graph-container bg-white border-2 border-solid border-grey rounded-lg">
                                    <line-graph url="/api/getEnergyCost"></line-graph>
                                </div>
                            </div>
                        </div> --}}
    
                        <div class="w-full sm:w-1/2 md:w-1/4 p-3">
                            <div class="bg-grey-light md:mb-2 md:mx-2">
                                <p>Product Feature</p>
                            </div>
                        </div>
    
                        <div class="w-full sm:w-1/2 md:w-1/4 p-3">
                            <div class="bg-grey-light md:mb-2 md:mx-2">
                                <p>Product Feature</p>
                            </div>
                        </div>
    
                        <div class="w-full sm:w-1/2 md:w-1/4 p-3">
                            <div class="bg-grey-light md:mb-2 md:mx-2">
                                <p>Product Feature</p>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <footer class="text-white p-3">
        <div class="container text-center p-3">
            Copyright 2018
        </div>
    </footer>
</body>
</html>