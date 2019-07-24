<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CEC</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
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
                position: absolute;
            }

            .title {
                font-size: 84px;
            }
            
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            #particles-js{
                position:inherit;
            }
        </style>
    </head>
    <body >
        
        <div class="flex-center position-ref full-height" id="particles-js"> 
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Inicio</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registro</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    CEC
                </div>
                <h2 style="margin:0px;">Centro de Espcializacion en Computacion y Estudios Comerciales</h2>
                <p style="margin:0px;">Telf. 334234 </p>
                <p style="margin:0px;">Paraguay 233 - Tartagal, Salta.</p>    
            </div>
        </div>
    </body>

{{-- <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
// particlesJS.load(@dom-id, @path-json, @callback (optional));
particlesJS.load('particles-js', '{{ asset('js/particles.json') }}', function() {
    console.log('callback - particles.min.js config loaded');
});
</script>
</html>
