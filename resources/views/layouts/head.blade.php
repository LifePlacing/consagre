<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags Obrigatórias -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, 
    shrink-to-fit=no">

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
    <link href="{{ asset('css/consagre.css') }}" rel="stylesheet">

</head>
<body>
	
	<div id="app">

		<div class="position-ref">
			<div class="top">
			<div class="navbar-superior">

				<div class="container">
			
					@if (Route::has('login'))
		                <div class="top-right links">
		                    @auth
		                        <a href="{{ url('/home') }}">Home</a>
		                    @else
		                        <a href="{{ route('login') }}">Login</a>
		                        <span class="marc">|</span>
		                        <a href="{{ route('register') }}">Cadastre-se</a>
		                        <button>Anunciar meu imóvel</button>
		                    @endauth
		                </div>
		            @endif

	        	</div>
				
			</div>

			<div class="navbar navbar-expand-md navbar-top" id="nav-top">

				<div class="container">

	                <a class="navbar-brand" href="{{ url('/') }}">	          
	                	<img src="{{asset('imagens/logomarca-consagre-vetor.svg')}}">
	                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                	<!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto menu">

                    	<li class="nav-item">
                    		<a href="{{ url('/') }}">HOME</a> 
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

					<div class="row linha">
						<div class="col-sm-4">
							<span>Do que você precisa?</span>
						</div>
						<div class="col-sm-4">
							<span>Qual tipo?</span>
						</div>
						<div class="col-sm-4">
							<span>Onde?</span>
						</div>
					</div>

					<form>
						<div class="form-inline">
							<div class="btn-group btn-group-lg col-sm-4" role="group" aria-label="Do que você precisa">	
								  <button type="button" class="btn bt-group active" id="comprar" value="Comprar">Comprar</button>
								  <button type="button" class="btn bt-group" id="alugar" value="Alugar">Alugar</button>
								  <button type="button" class="btn bt-group" id="destaques" value="Destaques">Destaques</button>
							</div>

							<div class="form-group col-sm-4">
								<select class="custom-select">
								  <option selected>Escolha o tipo de imóvel</option>
								  <option value="1">One</option>
								  <option value="2">Two</option>
								  <option value="3">Three</option>
								</select>
							</div>

						    <div class="form-group col-sm-4">
						       	<input type="text" class="form-control col-sm-12" id="cidade" placeholder="Qual cidade do Litoral Paulista?">
						    </div>

						</div>
						<div class="form-inline">
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
        
@extends('layouts.footer')        