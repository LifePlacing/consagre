<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags Obrigatórias -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height">

    <title>   	
    		{{ config('app.name', 'Consagre Imoveis') }} - @yield('title')    	
    </title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cube-btn.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mobile.css?ver=1.1') }}" rel="stylesheet">  

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
	                    @auth('web')

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
						@endauth

						@auth('anuncios')

							<div class="dropdown">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Conta Anunciante
							  	</a>
							  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="{{ route('admin.dashboard') }}">
									Painel de Anuncios
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

						@endauth	

						@auth('admin')

							<div class="dropdown">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Administrador
							  	</a>
							  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="{{ route('anunciante.dashboard') }}">
									Painel Admnistrativo
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
	                        <a href="{{ route('cadastro.usuarios') }}">Cadastre-se</a>
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
                	<img src="{{asset('imagens/logomarca-consagre-vetor.svg')}}" class="logomarca">
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

		

	<div class="recursos">

		
		<div class="social">	
			<h4>Redes Sociais</h4>		
			<a href=""><div class="rounded-circle item f"><i class="fa fa-facebook-f "></i></div></a>
			<a href=""><div class="rounded-circle item t"><i class="fa fa-twitter "></i></div></a>
			<a href=""><div class="rounded-circle item g"><i class="fa fa-google-plus "></i></div></a>
			<a href=""><div class="rounded-circle item y"><i class="fa fa-youtube "></i></div></a>
			<a href=""><div class="rounded-circle item p"><i class="fa fa-pinterest-p "></i></div></a>
			<a href=""><div class="rounded-circle item i"><i class="fa fa-instagram "></i></div></a>

		</div>			

		<div class="aplicativos">
			<h4> Baixe o Aplicativo </h4> 
			<i class="fa fa-apple fa-4x"></i> 
			<i class="fa fa-android fa-4x"></i>

		</div>

	</div>

	<div class="copyright">Copyright <code>c</code> {{date('Y')}} |  Marcos Vinicius Nunes - (13)98101-1263 </div>

</footer>

</div>


@hasSection('footer_scripts')
	@yield('footer_scripts')
@endif	

<div class="modal fade bd-example-modal-sm" id="erros" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" 
aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content content-erros">

      	<div class="alert alert-danger d-none" role="alert" id="msg_error">
  			
		</div>

    </div>
  </div>
</div> 

</body>
</html>    