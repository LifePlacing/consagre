<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @section('title')
            | {{ config('app.name') }}
        @show
    </title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('assets/img/logo-ico.svg')}}"/>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- global styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset('css/mobile.css')}}"/>
    <!-- end of global styles-->
    @yield('header_styles')

</head>

<body>

<div id="app">
    
    <div class="position-ref">
        
        <div class="top">

            <div class="navbar-superior">
        
                    @if (Route::has('login'))
                        <div class="top-right">

                            
                            @auth
                            <div class="links">
                                <a href="{{ route('home') }}">Home</a>
                            </div>    
                            @else
                            <div class="links">
                                <a href="{{ route('login') }}">Login</a>
                                <span class="marc">|</span>
                                <a href="{{ route('register') }}">Cadastre-se</a>
                            </div>
                            @endauth

                            <a class="button" href="{{url('planos', ['anuncio'])}}">
                            Anunciar meu imóvel
                            </a>


                        </div>
                    @endif
                
            </div>
        <div class="navbar navbar-expand-md navbar-top ">

            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">            
                    <img src="{{asset('imagens/logomarca-consagre-vetor.svg')}}">
                </a>

            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar-top" aria-controls="navbar-top" aria-expanded="false" aria-label="{{ __('Menu') }}">
                <i class="fa fa-bars fa-3x"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbar-top" aria-hidden="true">

                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto menu">

                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="active">HOME</a> 
                    </li>

                    <li class="nav-item">
                        <a href="">BUSCAR</a>
                    </li>

                    <li class="nav-item">
                        <a href="">COMPRAR</a>
                    </li>

                    <li class="nav-item">
                        <a href="">ALUGAR</a>
                    </li>

                    <li class="nav-item">
                        <a href="">TEMPORADA</a>
                    </li>

                </ul>


            </div>                  

            </div>
            
        </div>


        </div>

@section('wizard')
@show        

                    <main class="py-4">

                        @yield('content')

                    </main>
       

    </div>

</div> 

<footer>
    <div class="anuncie">
        <span>Conheça nossos planos de anúncio</span>
        <button>Anunciar meu imóvel</button>        
    </div>
    <div class="container"> 
        <div class="row">
            <div class="col-xs-12 col-sm-7">
                <div class="social">
                    <h4>Redes Sociais</h4>
                    <a href=""><div class="rounded-circle item f"><i class="fa fa-facebook-f fa-3x"></i></div></a>
                    <a href=""><div class="rounded-circle item t"><i class="fa fa-twitter fa-3x"></i></div></a>
                    <a href=""><div class="rounded-circle item g"><i class="fa fa-google-plus fa-3x"></i></div></a>
                    <a href=""><div class="rounded-circle item y"><i class="fa fa-youtube fa-3x"></i></div></a>
                    <a href=""><div class="rounded-circle item p"><i class="fa fa-pinterest-p fa-3x"></i></div></a>
                    <a href=""><div class="rounded-circle item i"><i class="fa fa-instagram fa-3x"></i></div></a>

                </div>          
            </div>          
            <div class="col-sm-3">  
                <div class="aplicativos">
                    <h4> Baixe o Aplicativo </h4> 
                    <i class="fa fa-apple fa-4x"></i> 
                    <i class="fa fa-android fa-4x"></i>

                </div>
            </div>  

        </div>
    </div>
    <div class="container">
        <div class="copyright">Copyright <code>c</code> {{date('Y')}} |  Marcos Vinicius Nunes - (13)98101-1263 </div>
    </div>
</footer>

@yield('footer_scripts') 

</body>
</html>