@extends('layouts.head')

@section('title', 'Cadastre-se e Anuncie seu imóvel')

@section('breadcrumbs')
	@parent
	@include('app.inc.breadcrumbs')
@endsection

@section('content')

	<div class="container">

		<h2 class="laranja">Faça seu Cadastro <strong> Agora </strong> na Consagre Imóveis</h2>
		<p class="text-muted">Selecione o seu perfil e faça seu cadastro</p>
		
		<ul class="perfil">


			<li>
				<a href="{{route('register')}}">
					<i class="fa fa-home fa-5x"></i> 
					<h4 class="azul">Proprietário</h4>
				</a>
			</li>

			<li>
				<a href="{{route('anunciante.cadastro', 'imobiliaria')}}">
					<i class="fa fa-building-o fa-5x" ></i> 
					<h4 class="azul">Imobiliaria</h4>
				</a>	
			</li>

			<li>
				<a href="{{route('anunciante.cadastro', 'corretor')}}">
					<i class="fa fa-user fa-5x" aria-hidden="true"></i> 
					<h4 class="azul">Corretor</h4>
				</a>
			</li>

		</ul>

		<span class="text-informativo" ><i class="fa fa-exclamation-triangle fa-4x"></i> <p class="text-muted"> 
	Sr(a). Proprietário(a), seu cadastro será liberado gratuitamente e você poderá anunciar imóveis ilimitados. É importante esclarecer que seus anuncios passarão por aprovação e serão direcionados a uma imobiliária parceira que entrará em contato através do seu email cadastrado.<strong>" Seu Anúncio é totalmente Gratuito".</strong></p> </span> 
		<br>
		<p>
			<small>* Preencha o formulário com informações válidas e com o máximo de detalhes. Obrigado</small>
		</p>

	</div>
	

@endsection