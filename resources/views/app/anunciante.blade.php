@extends('layouts.head')

@section('breadcrumbs')
	@parent
	@include('app.inc.breadcrumbs')
@endsection

@section('content')

	<div class="container">

		<h2 class="laranja">Anuncie seu imóvel <strong>Grátis</strong> na Consagre Imóveis</h2>
		<p class="text-muted">Selecione o seu perfil e anuncie com o já consagrado melhor portal de imóveis do Litoral Paulista</p>
		
		<ul class="perfil">


			<li>
				<a href="{{route('anunciar')}}">
					<i class="fa fa-home fa-5x"></i> 
					<h4 class="azul">Proprietário</h4>
				</a>
			</li>

			<li>
				<a href="">
					<i class="fa fa-building-o fa-5x" ></i> 
					<h4 class="azul">Imobiliaria</h4>
				</a>	
			</li>

			<li>
				<a href="">
					<i class="fa fa-user fa-5x" aria-hidden="true"></i> 
					<h4 class="azul">Corretor</h4>
				</a>
			</li>
		</ul>

		<span class="text-informativo" ><i class="fa fa-exclamation-triangle fa-4x"></i> <p class="text-muted"> 
	Sr(a). Proprietário(a), seu imóvel ficará disponível às imobiliárias conveniadas ao Portal para intermediação da venda ou locação. O anúncio é gratuito, porem não é divulgado ao consumidor final. <strong>"Anúncio Gratuito".</strong></p> </span> <small>* Temos planos para anuncios premium disponivel. Confira</small>

	</div>
	

@endsection