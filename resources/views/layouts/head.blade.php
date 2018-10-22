<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags Obrigatórias -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Consagre Imoveis') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mobile.css') }}" rel="stylesheet"> 

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

	                	<div class="links">
	                    @auth

							<div class="dropdown">

							  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Minha Conta
							  </a>

							  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="{{ route('home') }}">
								Home
								</a>  

								<a class="dropdown-item" href="{{ route('logout') }}" 
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
									Logout
								</a>  

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								    @csrf
								</form>
							  </div>

							</div>

	                    @else
	                        <a href="{{ route('login') }}">Login</a>
	                        <span class="marc">|</span>
	                        <a href="{{ route('register') }}">Cadastre-se</a>
	                    @endauth                            
	                    </div>
	                   	<a class="button" href="{{route('anuncio')}}">
	                   	Anunciar meu Imóvel
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
	                		<a href="">COMPRAR</a>
	                	</li>

	                	<li class="nav-item">
	                		<a href="">ALUGAR</a>
	                	</li>

	                	<li class="nav-item">
	                		<a href="">TODOS</a>
	                	</li>                	

	                </ul>


	            </div>					

			</div>
			
		</div>

		</div>

<!-- ===== Mostrar Breadcrumbs ========-->
	@section('breadcrumbs')
	@show

<!-- ===== Inicio sessão de buscas ========-->
	@section('search')
	@show
<!-- ======= Mostrar para Cadastro ==========-->
	@section('wizard')
	@show   

	</div>
        <main class="py-4">
        	@yield('sidebar')
            @yield('content')
            @yield('sidebar-right')            
        </main>

	@section('relacionados')
	@show        
        
<footer>
	<div class="anuncie">
		<span>Conheça nossos planos de anúncio</span>
		<button onclick="location.href='/perfil/anuncio'">Anunciar meu imóvel</button>		
	</div>
	<div class="container">	
		<div class="row">
			<div class="col-xs-12 col-sm-7 xs-12">
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

</div>

@yield('footer_scripts') 

</body>
</html>    