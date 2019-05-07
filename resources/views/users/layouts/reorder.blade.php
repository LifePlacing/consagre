<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	
    <!-- Meta tags Obrigatórias -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <meta name="robots" content="noindex">

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('users/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ asset('users/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('users/css/demo.css') }}" rel="stylesheet" />

    <link href="{{asset('css/cube-btn.css') }}" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset('users/css/light-bootstrap-dashboard.css?v=1.4.0') }}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="{{ asset('users/css/font-awesome.min.css')}}" rel="stylesheet">
    
    <link href='https://fonts.googleapis.com/css?family=Abril+Fatface|Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('users/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />



	<title>{{ config('app.name', 'Consagre Imoveis') }}</title>

	<script src="{{ asset('users/js/jquery.min.js')}}"></script>
    <script src="{{ asset('users/js/jquery-ui.min.js') }}"></script>



</head>

<body>

    <div id="app">

      
        <div class="wrapper">

            <!-- Sidebar -->
                @include('users.inc._left')
            <!-- Fim Sidebar -->        

            <main class="py-4">

                <div class="main-panel">
                    <nav class="navbar navbar-default navbar-fixed">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="{{ Auth::user()->tipo ? route('anunciante.dashboard'): route('home') }}">Painel do  {{ Auth::user()->tipo ? Auth::user()->tipo : " Usuário " }} </a>
                            </div>
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav navbar-left">

                                    <li>
                                       <a href="">
                                            <i class="fa fa-search"></i>
                                            <p class="hidden-lg hidden-md">Buscar</p>
                                        </a>
                                    </li>

                                </ul>

                                <ul class="nav navbar-nav navbar-right">

                                    <li>
                                        @if( verificaMensagens(Auth::user()->id) > 0) 

                                            <a href="{{ route('listar.mensagens') }}" style="color: #d9534f;">
                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                <span class="badge" style="background: #d9534f; color:#fff;">
                                                    {{ verificaMensagens(Auth::user()->id) }}
                                                </span>
                                            </a>

                                        @else
                                            <a href="#" style="color: #049F0C;" >
                                                <i class="fa fa-envelope-open-o" aria-hidden="true"></i>
                                                <span class="badge" style="background:#049F0C; color:#fff; ">0</span>
                                            </a>
                                        @endif
                                        
                                    </li>

                                    <li>
                                       <a href="{{ isset(Auth::user()->tipo) ? route('anunciante.profile') : route('account.show') }}">
                                           Minha Conta
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <p>Sair</p>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                    </li>
                                    <li class="separator hidden-lg"></li>


                                </ul>
                            </div>
                        </div>
                    </nav>


                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                @yield('content')                            
                            </div>
                        </div>
                    </div>

                    <footer class="footer">
                        <div class="container-fluid">
                            <p class="copyright pull-right">&copy;  <a href="#">Consagre Imoveis</a>    </p>
                        </div>
                    </footer>

                </div>


            </main>

        </div>

    </div> 


</body>


<script src="{{ asset('users/js/bootstrap.min.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="{{ asset('users/js/reorder_images.js?v=1.4.0') }}"></script>

<!--  Notifications Plugin    -->
<script src="{{ asset('users/js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('users/js/notifica.js')}}"></script>

</html>