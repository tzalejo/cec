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

    {{-- calendario --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="chrome-extension://aadgmnobpdmgmigaicncghmmoeflnamj/ng-inspector.js"></script>
    <script src="{{asset('js/calendar.js')}}"></script>
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
    {{-- calendario --}}

    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}"> <!--font-awesome-->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    {{-- icons Ionicons --}}
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    {{-- icons Ionicons --}}

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.1.3/darkly/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        #particles-js{
            position:inherit;
            width: 100%;
            height: 100%;
           
            }
        canvas.particles-js-canvas-el {
            position: absolute;
            top: 48px;
            left: 0px;
        
        }
        .count-particles{
            position: absolute;
            top: 48px;
            left: 0;
            width: 80px;
        }

        .js-count-particles{
            font-size: 1.1em;
        }

        @keyframes swing {
            0% {
                transform: rotate(0deg);
            }
            10% {
                transform: rotate(10deg);
            }
            30% {
                transform: rotate(0deg);
            }
            40% {
                transform: rotate(-10deg);
            }
            50% {
                transform: rotate(0deg);
            }
            60% {
                transform: rotate(5deg);
            }
            70% {
                transform: rotate(0deg);
            }
            80% {
                transform: rotate(-5deg);
            }
            100% {
                transform: rotate(0deg);
            }
        }

        @keyframes sonar {
            0% {
                transform: scale(0.9);
                opacity: 1;
            }
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }
        body {
            font-size: 0.9rem;
            }
        .page-wrapper .sidebar-wrapper,
        .sidebar-wrapper .sidebar-brand > a,
        .sidebar-wrapper .sidebar-dropdown > a:after,
        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a:before,
        .sidebar-wrapper ul li a i,
        .page-wrapper .page-content,
        .sidebar-wrapper .sidebar-search input.search-menu,
        .sidebar-wrapper .sidebar-search .input-group-text,
        .sidebar-wrapper .sidebar-menu ul li a,
        #show-sidebar,
        #close-sidebar {
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        /*----------------page-wrapper----------------*/

        .page-wrapper {
            height: 100vh;
        }

        .page-wrapper .theme {
            width: 40px;
            height: 40px;
            display: inline-block;
            border-radius: 4px;
            margin: 2px;
        }

        .page-wrapper .theme.chiller-theme {
            background: #1e2229;
        }

        /*----------------toggeled sidebar----------------*/

        .page-wrapper.toggled .sidebar-wrapper {
            left: 0px;
        }

        @media screen and (min-width: 768px) {
            .page-wrapper.toggled .page-content {
                padding-left: 300px;
            }
        }
        /*----------------show sidebar button----------------*/
        #show-sidebar {
            position: fixed;
            left: 0;
            top: 10px;
            border-radius: 0 4px 4px 0px;
            width: 35px;
            transition-delay: 0.3s;
        }
        .page-wrapper.toggled #show-sidebar {
            left: -40px;
        }
        /*----------------sidebar-wrapper----------------*/

        .sidebar-wrapper {
            
            width: 260px;
            height: 100%;
            max-height: 100%;
            position: fixed;
            top: 0;
            left: -300px;
            z-index: 999;
        }

        .sidebar-wrapper ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-wrapper a {
            text-decoration: none;
        }

        /*----------------sidebar-content----------------*/

        .sidebar-content {
            max-height: calc(100% - 30px);
            height: calc(100% - 30px);
            overflow-y: auto;
            position: relative;
        }

        .sidebar-content.desktop {
            overflow-y: hidden; 
        }

        /*--------------------sidebar-brand----------------------*/

        .sidebar-wrapper .sidebar-brand {
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }

        .sidebar-wrapper .sidebar-brand > a {
            text-transform: uppercase;
            font-weight: bold;
            flex-grow: 1;
        }

        .sidebar-wrapper .sidebar-brand #close-sidebar {
            cursor: pointer;
            font-size: 20px;
        }
        /*--------------------sidebar-header----------------------*/

        .sidebar-wrapper .sidebar-header {
            padding: 20px;
            overflow: hidden;
        }

        .sidebar-wrapper .sidebar-header .user-pic {
            float: left;
            width: 60px;
            padding: 2px;
            border-radius: 12px;
            margin-right: 15px;
            overflow: hidden;
        }

        .sidebar-wrapper .sidebar-header .user-pic img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }

        .sidebar-wrapper .sidebar-header .user-info {
            float: left;
        }

        .sidebar-wrapper .sidebar-header .user-info > span {
            display: block;
        }

        .sidebar-wrapper .sidebar-header .user-info .user-role {
            font-size: 12px;
        }

        .sidebar-wrapper .sidebar-header .user-info .user-status {
            font-size: 11px;
            margin-top: 4px;
        }

        .sidebar-wrapper .sidebar-header .user-info .user-status i {
            font-size: 8px;
            margin-right: 4px;
            color: #5cb85c;
        }

        /*-----------------------sidebar-search------------------------*/

        .sidebar-wrapper .sidebar-search > div {
            padding: 10px 20px;
        }

        /*----------------------sidebar-menu izq-------------------------*/

        #sidebar {
            background-image: url({{ asset('img/imagenCEC.jpg') }});
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-sizing: border-box;
        }

        .sidebar-wrapper .sidebar-menu {
            padding-bottom: 10px;
        }

        .sidebar-wrapper .sidebar-menu .header-menu span {
            font-weight: bold;
            font-size: 14px;
            padding: 15px 20px 5px 20px;
            display: inline-block;
        }

        .sidebar-wrapper .sidebar-menu ul li a {
            display: inline-block;
            width: 100%;
            text-decoration: none;
            position: relative;
            padding: 8px 30px 8px 20px;
        
        }

        .sidebar-wrapper .sidebar-menu ul li a i {
            margin-right: 10px;
            font-size: 12px;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 4px;
        }
        /* #miBtn:hover > #miBtn:before{
            display: inline-block;
            animation: swing ease-in-out 0.5s 1 alternate;   /* movimiento de los botons.. */ 
        } */
        .sidebar-wrapper .sidebar-menu ul li a:hover > i::before {
            display: inline-block;
            animation: swing ease-in-out 0.5s 1 alternate;  /* movimiento de los botons.. */ 
        }
        .sidebar-wrapper .sidebar-menu .sidebar-dropdown > a:after {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: ">";
            font-style: normal;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-align: center;
            background: 0 0;
            position: absolute;
            right: 15px;
            top: 14px;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu ul {
            padding: 5px 0;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li {
            padding-left: 25px;
            font-size: 13px;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li :before {
            /* content contiene los icono(submenu), pero no se aun usarlo */
            content: ""; 
            font-family: "Font Awesome 5 Free";
            font-weight: 400;
            font-style: normal;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            margin-right: 10px;
            font-size: 8px;
        }

        .sidebar-wrapper .sidebar-menu ul li a span.label,
        .sidebar-wrapper .sidebar-menu ul li a span.badge {
            float: right;
            margin-top: 8px;
            margin-left: 5px;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .badge,
        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .label {
            float: right;
            margin-top: 0px;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-submenu {
            display: none;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active > a:after {
            transform: rotate(90deg);
            right: 17px;
        }

        /*--------------------------side-footer------------------------------*/

        
        /*- footer para barra lateral izq-*/
        .sidebar-footer {
            position: absolute;
            width: 100%;
            bottom: 0;
            display: flex;
        }

        .sidebar-footer > a {
            flex-grow: 1;
            text-align: center;
            height: 30px;
            line-height: 30px;
            position: relative;
        }

        .sidebar-footer > a .notification {
            position: absolute;
            top: 0;
        }
        /*- footer para barra lateral izq-*/

        .badge-sonar {
            display: inline-block;
            background: #980303;
            border-radius: 50%;
            height: 8px;
            width: 8px;
            position: absolute;
            top: 0;
        }

        .badge-sonar:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            border: 2px solid #980303;
            opacity: 0;
            border-radius: 50%;
            width: 100%;
            height: 100%;
            animation: sonar 1.5s infinite;
        }

        /*--------------------------page-content-----------------------------*/

        .page-wrapper .page-content {
            display: inline-block;
            width: 100%;
            padding-left: 0px;
            padding-top: 20px;
        }

        .page-wrapper .page-content > div {
            padding: 20px 40px;
        }

        .page-wrapper .page-content {
            overflow-x: hidden;
        }

        /*------scroll bar---------------------*/

        ::-webkit-scrollbar {
            width: 5px;
            height: 7px;
        }
        ::-webkit-scrollbar-button {
            width: 0px;
            height: 0px;
        }
        ::-webkit-scrollbar-thumb {
            background: #525965;
            border: 0px none #ffffff;
            border-radius: 0px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #525965;
        }
        ::-webkit-scrollbar-thumb:active {
            background: #525965;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
            border: 0px none #ffffff;
            border-radius: 50px;
        }
        ::-webkit-scrollbar-track:hover {
            background: transparent;
        }
        ::-webkit-scrollbar-track:active {
            background: transparent;
        }
        ::-webkit-scrollbar-corner {
            background: transparent;
        }


        /*-----------------------------chiller-theme-------------------------------------------------*/

        .page-wrapper .sidebar-wrapper {
            background: #31353D;
        }

        .page-wrapper .sidebar-wrapper .sidebar-header,
        .page-wrapper .sidebar-wrapper .sidebar-search,
        .page-wrapper .sidebar-wrapper .sidebar-menu {
            border-top: 1px solid #3a3f48;
        }

        .page-wrapper .sidebar-wrapper .sidebar-search input.search-menu,
        .page-wrapper .sidebar-wrapper .sidebar-search .input-group-text {
            border-color: transparent;
            box-shadow: none;
        }

        .page-wrapper .sidebar-wrapper .sidebar-header .user-info .user-role,
        .page-wrapper .sidebar-wrapper .sidebar-header .user-info .user-status,
        .page-wrapper .sidebar-wrapper .sidebar-search input.search-menu,
        .page-wrapper .sidebar-wrapper .sidebar-search .input-group-text,
        .page-wrapper .sidebar-wrapper .sidebar-brand>a,
        .page-wrapper .sidebar-wrapper .sidebar-menu ul li a,
        .page-wrapper .sidebar-footer>a {
            color: #818896;
        }

        .page-wrapper .sidebar-wrapper .sidebar-menu ul li:hover>a,
        .page-wrapper .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active>a,
        .page-wrapper .sidebar-wrapper .sidebar-header .user-info,
        .page-wrapper .sidebar-wrapper .sidebar-brand>a:hover,
        .page-wrapper .sidebar-footer>a:hover i {
            color: #b8bfce;
        }

        .page-wrapper.toggled #close-sidebar {
            color: #bdbdbd; /* la X de cerrar*/
        }

        .page-wrapper .toggled #close-sidebar:hover {
            color: #ffffff;
        }

        .page-wrapper .sidebar-wrapper ul li:hover a i,
        .page-wrapper .sidebar-wrapper .sidebar-dropdown .sidebar-submenu li a:hover:before,
        .page-wrapper .sidebar-wrapper .sidebar-search input.search-menu:focus+span,
        .page-wrapper .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active a i {
            color: #16c7ff;
            text-shadow:0px 0px 10px rgba(22, 199, 255, 0.5);
        }

        .sidebar-dropdown .sidebar-submenu ul li {
            background-color: rgba(255,255,255,.1);
        }

        /* .chiller-theme .sidebar-wrapper .sidebar-menu ul li a i,
        .chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown div,
        .chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
        .chiller-theme .sidebar-wrapper .sidebar-search .input-group-text {
            background: #3a3f48;
            
        } */

        /* .chiller-theme .sidebar-wrapper .sidebar-menu .header-menu span */
        .page-wrapper .sidebar-wrapper .sidebar-content .sidebar-menu ul .header-menu span {
            color: #6c7b88;
        }

        /* scroll para crear curso */
        .my-custom-scrollbar {
            position: relative;
            height: 350px;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }
        /* scroll termina*/

    </style>
</head>
<body>
    @guest {{-- si no estoy legueado --}}
        {{-- barra de arriba --}}
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" >
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        @guest
                        {{ config('app.name', 'Laravel') }}
                    
                        @endguest
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                {{-- <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->userNombre }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                <!-- Image and text -->
                                <img src="{{Auth::user()->userImagen}}" width="30" height="30" class="d-inline-block align-top" > --}}
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div> 
        @yield('content')
    @else {{-- si estoy legueado --}}
        <div class="page-wrapper toggled" >
            {{-- icon al cerar la --}}
            <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
            {{-- barra laterarl izq --}}
            <nav id="sidebar" class="sidebar-wrapper" data-toggle="collapse">
                <div class="sidebar-content">
                    {{-- <perfect-scrollbar> --}}
                        <div class="sidebar-brand">
                            <a href="{{route('home')}}">sistema cec</a>
                            <div id="close-sidebar">
                                <i class="fa fa-times" aria-hidden="false"></i>
                            </div>
                        </div>
                        <div class="sidebar-header">
                            <div class="user-pic">
                                <img class="img-responsive img-rounded" src=" @if(is_null(Auth::user()->userImagen)) {{asset('img/default.png')}} @else {{asset('img/')}}/{{Auth::user()->userImagen}}  @endif" alt="User picture">
                            </div>
                            <div class="user-info">
                                <span class="user-name">{{ strtoupper(Auth::user()->userNombre) }}
                                    <strong></strong>
                                </span>
                                <span class="user-role">{{ Auth::user()->role->roleDescripcion }}</span>
                                <span class="user-status">
                                    <i class="fa fa-circle"></i>
                                    <span>Online</span>
                                </span>
                            </div>
                        </div>
                   {{--.page-wrapper .sidebar-wrapper .sidebar-content .sidebar-menu ul .header-menu span --}}
                        <div class="sidebar-menu">
                            <ul >
                                <li class="header-menu">
                                    <span>Alumno</span>
                                </li>
                                <li>
                                    <a href="{{route('alumnos.inscripcion')}}">
                                        <i class="miBtn  fa fa">
                                            <ion-icon name="person-add"></ion-icon>
                                        </i>
                                        <span>Inscripción</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('alumnos.reinscripcion')}}">
                                        <i class="fa fa-retweet"></i>
                                        <span>Re Inscripción</span>
                                    </a>
                                </li>
                                
                                <li class="sidebar-dropdown">
                                    <a href="#">
                                        <i class="fa fa-usd"></i>
                                        <span>Pago</span>
                                        {{-- <span class="badge badge-pill badge-warning">New</span> --}}
                                    </a>
                                    <div class="sidebar-submenu">
                                        <ul>
                                            {{-- <li><a href="#">Inscripción</a></li> --}}
                                            <li><a href="{{route('alumnos.mostrar')}}">Curso</a></li>
                                            <li><a href="#">Seminario</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="sidebar-dropdown">
                                    <a href="#">
                                        <i class="fa fa-line-chart"></i>
                                        <span>Estadística</span>
                                    </a>
                                    <div class="sidebar-submenu">
                                        <ul>
                                            <li><a href="#">Alumnos</a></li>
                                            <li><a href="#">Cursos</a></li>
                                            <li><a href="#">Cuotas</a></li>
                                            <li><a href="#">Egresados</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="sidebar-dropdown">
                                    <a href="#">
                                        <i class="fas fa-fw fa-cog"></i>
                                        <span>Administración</span>
                                    </a>
                                    <div class="sidebar-submenu">
                                        <ul>
                                            <li><a href="#">Asistencia</a></li>
                                            <li><a href="#">Exámenes</a></li>
                                            <li><a href="#">Legajo</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="header-menu">
                                    <span>Gerencia</span>
                                </li>
                                <li class="sidebar-dropdown">
                                    <a href="#">
                                        <i class="fa fa-book"></i>
                                        <span>Comisión</span>
                                    </a>
                                    <div class="sidebar-submenu">
                                        <ul>
                                            <li><a href="#">Abrir</a></li>
                                            <li><a href="#">Cerrar</a></li>
                                            <li><a href="#">Modificar</a></li>
                                            <li><a href="#">Unificar</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="sidebar-dropdown">
                                    <a href="#">
                                        <i class="fa fa-calendar"></i>
                                        <span>Curso</span>
                                    </a>
                                    <div class="sidebar-submenu">
                                        <ul>
                                            <li><a href="{{route('curso.crear')}}">Crear Nuevo</a></li>
                                            <li><a href="#">Materia</a></li>
                                            <li><a href="#">Modificar</a></li>
                                            <li><a href="#">Impresiones</a></li>
                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    {{-- </perfect-scrollbar> --}}
                    <!-- sidebar-menu  -->
                </div>
                <!-- sidebar-content  -->
                <div class="sidebar-footer">
                    <a href="#">
                        <i class="fa fa-bell"></i>
                        <span class="badge badge-pill badge-warning notification">3</span>
                    </a>
                    <a href="#">
                        <i class="fa fa-envelope"></i>
                        <span class="badge badge-pill badge-success notification">7</span>
                    </a>
                    <a href="#">
                        <i class="fa fa-cog"></i>
                        <span class="badge-sonar"></span>
                    </a>
                    <a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off"></i>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </div>
            </nav>
            <main class="page-content">
                <div class="container">
                    @yield('content')
                </div>
                <!-- Footer font-small mdb-color pt-4-->
                <footer class="container page-footer pt-0" style="padding-right: 4%;padding-left: 4%;">
                    <hr class="mt-2">
                    <!-- Grid row -->
                    <div class="row d-flex align-items-center container">
                        <!-- Grid column -->
                        <div class="col-md-6">
                            <!--Copyright-->
                            <p class="text-center text-md-left">© 2018 Copyright:  
                                <strong> Alejandro Valenzuela</strong>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <!-- Social buttons -->
                            <div class="text-center text-md-right">
                                <ul class="list-unstyled list-inline">
                                    <li class="list-inline-item">
                                        <a class="btn-floating btn-lg rgba-white-slight mx-0" href="https://www.facebook.com/pabloa.valenzuela.10" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn-floating btn-lg rgba-white-slight mx-0" href="https://github.com/tzalejo" target="_blank">
                                            <i class="fab fa-github"></i>
                                        </a>
                                    </li>
                                   {{--  <li class="list-inline-item">
                                        <a class="btn-floating btn-lg rgba-white-slight mx-0">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                    </li> --}}
                                    <li class="list-inline-item">
                                        <a class="btn-floating btn-lg rgba-white-slight mx-0" href="https://www.linkedin.com/in/pablo-alejandro-valenzuela-611a0570/" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Grid row -->
                </footer><!-- Footer -->
            </main> 
            <!--end-page-content" -->
        </div>
    @endguest
</body>
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

<script>
    particlesJS.load('particles-js', '{{ asset('js/particles.json') }}', function() {
        console.log('Llamando configuracion particles.min.js');
    });
</script>


{{-- Este escript es para el menu izq --}}
<script>
    $(".sidebar-dropdown > a").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if (
                $(this)
                .parent()
                .hasClass("active")
            ) {
                $(".sidebar-dropdown").removeClass("active");
                $(this)
                .parent()
                .removeClass("active");
            } else {
                $(".sidebar-dropdown").removeClass("active");
                $(this)
                .next(".sidebar-submenu")
                .slideDown(200);
                $(this)
                .parent()
                .addClass("active");
        }
    });

    $("#close-sidebar").click(function() {
    $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function() {
    $(".page-wrapper").addClass("toggled");
    });


</script><!-- using online scripts -->
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
</script>

{{-- calendario --}}
<script>
    // var mivalores = new Array(new Array(),new Array());
    $(document).ready(function(e){
        // console.log('se instancia caledarYvv');
        // calendar = new CalendarYvv("#calendar", moment().format("Y-M-D"), "Monday");
        calendar = new CalendarYvv("#calendar", moment().format("Y-M-D"), "Lunes");
        
        // console.log('window.calendar.currentSelected');
        // console.log(window.calendar.currentSelected);
        calendar.funcPer = function(ev){
            // console.log(ev);
            // console.log(window.calendar.currentSelected);
            // miMes = new Date(window.calendar.currentSelected).getMonth(); // 0,1,2,3,4,5,6,7,8,9,10,11 ()
            // console.log('miMes',miMes);
            // diaSemana = new Date(window.calendar.currentSelected).getDay(); // 0,1,2,3,4,5,6(dom,lun,mar,...,sab)
            // console.log('diaSemana',diaSemana);
            // console.log('midia',midia);   
            // calendar.diaSeleccionado = window.calendar.currentSelected; 
            // mivalores[parseInt(miMes)][parseInt(miDia)] = midia; 
            // calendar.diasResal = mivalores.slice();
            // calendar.createDayTag();
            // calendar.createDaysMont();
            // calendar.ordenarDiasMes();
            // calendar.corregirMesA();
            // calendar.diasResal = mivalores[miMes][midia]
        };      
        
        midia = new Date(window.calendar.currentSelected).getDate(); // dia 1..31
        calendar.diasResal = [midia];
        // preselected dates

        // background color of preselected dates
        calendar.colorResal = "#28a7454d"

        // // text color of preselected dates
        calendar.textResalt = "#28a745"

        // background class
        calendar.bg = "bg-dark";

        // text color class
        calendar.textColor = "text-white";

        // class for normal buttons
        calendar.btnH = "btn-outline-light";

        // button class when hovering over
        calendar.btnD = "btn-rounded-success";
        console.log('se ejecuta createCalandar');
        calendar.createCalendar();
    });
</script>

{{-- script para la seleccion de materia en el alta de curso --}}
<script>
    $(document).ready(function() {
        $('#example tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('bg-primary') ) {
                $(this).removeClass('bg-primary');
                const mi_id=$(this)[0].id;
                document.getElementById('checkbox'+mi_id).checked = false;
            }else {
                $(this).addClass('bg-primary');
                const mi_id=$(this)[0].id;
                document.getElementById('checkbox'+mi_id).checked = true;
            }
        });
    });
</script>


{{-- <script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; 
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script> --}}
{{-- calendario --}}


</html>
