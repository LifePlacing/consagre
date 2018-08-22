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
	                   	<a class="button" href="{{url('planos', ['anuncio'])}}">
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

	<div class="search">

		<div class="busca-filtro">

			<form>
				<div class="form-inline">
					<div class="form-group col-sm-4 col-xs-12 xs-12">
						<span>Do que você precisa?</span>
						<div class="btn-group btn-group-toggle col-sm-12" data-toggle="buttons">
							  <label class="btn btn-primary active">
							    <input type="radio" name="options" id="comprar" value="comprar"autocomplete="off"> Comprar
							  </label>
							  <label class="btn btn-primary">
							    <input type="radio" name="options" value="alugar" id="alugar" autocomplete="off"> Alugar
							  </label>
							  <label class="btn btn-primary">
							    <input type="radio" name="options" id="destaques" autocomplete="off"> Destaques
							  </label>

						</div>
					</div>

					<div class="form-group col-sm-4 col-xs-12 xs-6">
						<span>Qual tipo?</span>
						<select class=" dropdown-toggle custom-select col-sm-12" >
						  <option selected>Escolha o tipo de imóvel</option>
						  @if($tipos)
							@foreach($tipos as $tipo => $id)
						  		<option value="{{ $id }}">{{ $tipo }}</option>
						  	@endforeach
						  @endif
						</select>
					</div>

				    <div class="form-group col-sm-4 col-xs-12 xs-6">
				    	<span>Onde?</span>
				       	<input type="text" class="form-control col-sm-12" id="cidade" placeholder="Qual cidade do Litoral Paulista?">
				    </div>

					<button type="submit" class="btn-buscar">BUSCAR</button>
				</div>			

			</form>
		</div>	

		<div class="planos">
			<h4 class="center">Confira nossos planos</h4>
			<button class="anunciar">Anunciar meu imóvel</button>
		</div>	

		</div>

	</div>
		


        <main class="py-4">
            @yield('content')            
        </main>
        
<footer>
	<div class="anuncie">
		<span>Conheça nossos planos de anúncio</span>
		<button onclick="location.href='/planos/anuncio'">Anunciar meu imóvel</button>		
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
</body>
</html>    