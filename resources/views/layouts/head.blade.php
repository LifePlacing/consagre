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
    <!-- <link href="{{ asset('css/consagre.css') }}" rel="stylesheet"> -->
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
	                        <a href="{{ url('/home') }}">Home</a>
	                    @else
	                        <a href="{{ route('login') }}">Login</a>
	                        <span class="marc">|</span>
	                        <a href="{{ route('register') }}">Cadastre-se</a>
	                    </div>  	                    

	                    <button>Anunciar meu imóvel</button>

	                    @endauth

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
					<div class="form-group col-sm-4 col-xs-12">
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

					<div class="form-group col-sm-4 col-xs-12">
						<span>Qual tipo?</span>
						<select class="custom-select col-sm-12">
						  <option selected>Escolha o tipo de imóvel</option>
						  <option value="1">One</option>
						  <option value="2">Two</option>
						  <option value="3">Three</option>
						</select>
					</div>

				    <div class="form-group col-sm-4 col-xs-12">
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
        
@extends('layouts.footer')        