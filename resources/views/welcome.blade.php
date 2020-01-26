<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FitBit</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
        <link href="{{asset('/fontawesome/css/all.css')}}" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                font-family: 'Open Sans', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;

            }

            body {
                background-image: url(imagenes/fondosimple.jpg);
                background-position: center center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                background-color: #66999;
            }

            .full-height {
                height: 89vh;
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
                font-size: 84px;
            }

            .links > a {
                color: #545454;
                padding: 0 25px;
                font-size: 23px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .botonLogin{
                display: block;
                background-color: white;
                color: #3E639F;
                border-radius: 50px;
                width: 116px;
                height: 24px;
                text-decoration: inherit;
                font-size: 15pt;
                padding: 5px;
                font-family: sans-serif;
                font-weight: 100;
                text-align: center;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}"><i class="far fa-user sizeIcon"></i></a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"></a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img src="{{asset('/imagenes/logo-login.png')}}">
                    <a href="{{ route('login') }}" class="botonLogin">Acceder</a>
                </div>

               <!-- <div class="links">
                    <a href="https://www.fiware.org/" target="_blank">Docs</a>
                    <a href="https://swagger.lab.fiware.org/?url=https://raw.githubusercontent.com/Fiware/specifications/master/OpenAPI/ngsiv2/ngsiv2-openapi.json#/API%20Entry%20Point/Retrieve%20API%20Resources" target="_blank">API FIWARE</a>
                    <a href="https://fiware-tutorials.readthedocs.io/en/latest/iot-agent/index.html" target="_blank">DOCS IOT AGENTS</a>

                </div>-->
                <div>



                </div>
            </div>

        </div>
        <footer class="main-footer" style="text-align: center">
                <!--<strong>Copyright © 2016 <a href="#">Company</a>.</strong> All rights reserved.-->
                <img src="{{asset('/imagenes/innobonos.png')}}" width="50%">
            </footer>
        <!-- Main Footer -->

        <script defer src="{{asset('/fontawesomejs/all.js')}}"></script>

    </body>


