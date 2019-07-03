<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HEMS</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                /* background-image: linear-gradient(5deg, #486581, #243B53); */
                /* background-color: #fff; */
                /* color: rgb(16, 42, 66); */
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                /* font-size: 84px; */
            }

            .links > a {
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body class="bg-grey-050">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class="text-cyan-700 uppercase no-underline" href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a class="text-cyan-700 uppercase no-underline" href="{{ route('login') }}">Iniciar sesión</a>

                        @if (Route::has('register'))
                            <a class="text-cyan-700 uppercase no-underline" href="{{ route('register') }}">Crear cuenta</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md text-cyan-700 text-4xl md:text-5xl lg:text-8xl">
                    Home Energy Management System
                </div>
                <div class="flex">
                    <div class="links flex flex-col md:flex-row mx-auto">
                        <a class="text-cyan-700 uppercase no-underline my-1 md:py-0" href="{{ url('/dashboard') }}">Dashboard</a>
                        <a class="text-cyan-700 uppercase no-underline my-1 md:py-0" href="{{ url('/historical') }}">Historico</a>
                        <a class="text-cyan-700 uppercase no-underline my-1 md:py-0" href="{{ url('/trends') }}">Gráficas</a>
                        <a class="text-cyan-700 uppercase no-underline my-1 md:py-0" href="{{ url('/appliances') }}">Mi instalación</a>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
