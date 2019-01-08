@extends('layouts.head')

@section('title', 'Anuncie seu imóvel Grátis')

@section('search')
	@parent
	@include('app.search.form')
@endsection

@section('content')

<div class="container" id="conteudo">

	<section id="lancamentos">

	<div class="text-center h2">

		<h2>Lançamentos</h2><span></span>

	</div>

	<ul id="tabLanc" class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<a id="venda-tab" href="#avenda" class="nav-link active" data-toggle="tab" role="tab" aria-controls="avenda" aria-selected="true"> Venda</a>
		</li>
		<li class="nav-item">
			<a id="aluguel-tab" href="#aluguel" class="nav-link" data-toggle="tab" role="tab" aria-controls="aluguel" aria-selected="false"> Aluguel</a>
		</li>

	</ul>

	<div class="tab-content" id="ContentLanc">

	  	<div class="tab-pane fade show active" id="avenda" role="tabpanel" aria-labelledby="avenda-tab">

			@if($imoveisVenda->count() > 0)

			<div class="row">

		  		@foreach($imoveisVenda as $v => $venda)
  				
  				@php 
					$titulo  = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $venda->titulo));
                	$slug =  str_replace(' ', '-', $titulo);
                	$slugTitulo =  strtolower($slug); 
  				@endphp

			  	<div class="col-sm-6 col-md-3">
		  				<div class="card card-imoveis" onclick="window.location='/{{$slugTitulo}}/{{$venda->id}}/{{$venda->meta}}/{{$venda->cidade->slug}}'" >

					 	@foreach($venda->media as $m => $medias)

					 		@if($m == 0)
		                    <img class="thumb" src="{{asset($medias->source)}}">
		                	@endif    

		            	@endforeach

		 				<div class="card-title">			 				 
			 				{{ formataMoney($venda->preco) }}
			 			</div>
			 			<div class="card-content">

			 				<h3>{{$venda->cidade->nome}}</h3>

			 				<div class="row">
			 					<div class="col">
			 						<i class="fa fa-bed" aria-hidden="true"></i> {{$venda->quartos}} 
			 					</div>
			 					<span>|</span>
			 					<div class="col">
			 						<i class="fa fa-bath" aria-hidden="true"></i>
									{{$venda->banheiros}}
								</div>
								<span>|</span>
								<div class="col">
									{{$venda->area_util}}m&#178;
								</div>

			 				</div>

			 			</div>

		                </div>
		            </div>                 

		  		@endforeach	

		  		
			</div>	

				@if ($imoveisVenda->count() == 4)

				<div class="btn-vertodos">
		  			<a href="{{ route('buscaTodos', 'venda') }}" class="text-primary vertodos ">Ver Todos</a>
		  		</div>

		  		@endif


			  	@else	

			  	<p>Sem Imoveis Cadastrados</p>

			  	@endif		
		</div>


	  <div class="tab-pane fade" id="aluguel" role="tabpanel" aria-labelledby="aluguel-tab">
	  	
	  	@if($imoveisAluguel->count() > 0)

	  	<div class="row">
  			@foreach($imoveisAluguel as $a => $aluguel)

  				@php 
					$titulo  = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $aluguel->titulo));
                	$slug =  str_replace(' ', '-', $titulo);
                	$slugTitulo =  strtolower($slug); 
  				@endphp

  			<div class="col-sm-3">
  				<div class="card card-imoveis" onclick="window.location='/{{$slugTitulo}}/{{$aluguel->id}}/{{$aluguel->meta}}/{{$aluguel->cidade->slug}}'">
  					 	@foreach($aluguel->media as $m => $medias)
  					 		@if($m == 0)
                                <img class="thumb" src="{{asset($medias->source)}}">
                            @endif
                        @endforeach 
                    	<div class="card-title">			 				 
			 				{{ formataMoney($aluguel->preco_venda) }}
			 			</div>
			 			<div class="card-content">

			 				<h3>{{$aluguel->cidade->nome}}</h3>
			 				<div class="row">
			 					<div class="col">
			 						<i class="fa fa-bed" aria-hidden="true"></i> {{$aluguel->quartos}} 
			 					</div>
			 					<span>|</span>
			 					<div class="col">
			 						<i class="fa fa-bath" aria-hidden="true"></i>
									{{$aluguel->banheiros}}
								</div>
								<span>|</span>
								<div class="col">
									{{$aluguel->area_util}}m&#178;
								</div>

			 				</div>
			 			</div> 
                </div>
            </div>            

			@endforeach	

				@if ($imoveisAluguel->count() == 4)
					<div class="btn-vertodos">
			  			<a href="{{ route('buscaTodos', 'aluguel') }}" class="text-primary vertodos">Ver Todos</a>
			  		</div>
		  		@endif


		</div>		

		@else
		
			<p>Sem imoveis para Aluguel</p>	

		@endif				

	  </div>	  

	</div>	

	</section>

	<section id="cidades">

		<div class="text-center h2">
			<h2>Buscar por Cidade</h2><span></span>
		</div>

	<ul class="nav nav-tabs" id="myTab" role="tablist">
	  <li class="nav-item">
	    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#sul" role="tab" aria-controls="sul" aria-selected="true">Litoral Sul</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#regiao_santos" role="tab" aria-controls="regiao_santos" aria-selected="false">Região de Santos</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#outras" role="tab" aria-controls="outras" aria-selected="false">Outras Cidades</a>
	  </li>
	</ul>

	<div class="tab-content" id="myTabContent">

	  <div class="tab-pane fade show active" id="sul" role="tabpanel" aria-labelledby="home-tab">

	  	<ul class="list-unstyled">
	  		<li class="media" onclick="window.location='/busca/imoveis/cananeia' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_cananeia.jpg')}}" alt="Imoveis para venda e aluguel em Cananeia - SP">
	  			<div class="media-body align-self-center ">
	  				<h5 class="mt-0 mb-1">Cananeia</h5>
	  			</div>	  			
	  		</li>

	  		<li class="media my-4" onclick="window.location='/busca/imoveis/iguape' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_iguape.jpg')}}" alt="Imoveis para venda e aluguel em Iguape - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Iguape</h5>
	  			</div>
	  		</li>

	  		<li class="media" onclick="window.location='/busca/imoveis/ilha_comprida' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_ilha_comprida.jpg')}}" alt="Imoveis para venda e aluguel em Ilha Comprida - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Ilha Comprida</h5>
	  			</div>	
	  		</li>

	  	</ul>

	  	<ul class="list-unstyled">

	  		<li class="media"  onclick="window.location='/busca/imoveis/itanhaem' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_Itanhaem.jpg')}}" alt="Imoveis para venda e aluguel em Itanhaém - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Itanhaém</h5>
	  			</div>	
	  		</li>

	  		<li class="media my-4" onclick="window.location='/busca/imoveis/mongagua' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_mongagua.jpg')}}" alt="Imoveis para venda e aluguel em Mongaguá - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1 ">Mongaguá</h5>
	  			</div>	
	  		</li>
	  		<li class="media" onclick="window.location='/busca/imoveis/pedro_de_toledo' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/pedro_de_toledo.jpg')}}" alt="Imoveis para venda e aluguel em Pedro de Toledo - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Pedro de Toledo</h5>
	  			</div>	
	  		</li>
	  	</ul>

	  	<ul class="list-unstyled">
	  		<li class="media" onclick="window.location='/busca/imoveis/peruibe' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_peruibe.jpg')}}" alt="Imoveis para venda e aluguel em Peruíbe - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Peruíbe</h5>
	  			</div>	
	  		</li> 
	  	</ul>

	  </div>
	  <div class="tab-pane fade" id="regiao_santos" role="tabpanel" aria-labelledby="profile-tab">

	   	<ul class="list-unstyled">
	  		<li class="media" onclick="window.location='/busca/imoveis/bertioga' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_bertioga.jpg')}}" alt=" Imoveis para venda e aluguel em Bertioga - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1 ">Bertioga</h5>
	  			</div>	
	  		</li>
	  		<li class="media my-4" onclick="window.location='/busca/imoveis/cubatao' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_cubatao.jpg')}}" alt="Imoveis para venda e aluguel em Cubatão - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Cubatão</h5>
	  			</div>	
	  		</li>
	  		<li class="media" onclick="window.location='/busca/imoveis/guaruja' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_guaruja.jpg')}}" alt="Imoveis para venda e aluguel no Guarujá - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Guarujá</h5>
	  			</div>	
	  		</li>
	  	</ul>

	  	<ul class="list-unstyled">

	  		<li class="media" onclick="window.location='/busca/imoveis/praia_grande' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_praia_grande.jpg')}}" alt="Imoveis para venda e aluguel na Praia Grande - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Praia Grande</h5>
	  			</div>
	  		</li>

	  		<li class="media my-4" onclick="window.location='/busca/imoveis/santos' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_santos.jpg')}}" alt="Imoveis para venda e aluguel em Santos - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Santos</h5>
	  			</div>
	  		</li>

	  		<li class="media" onclick="window.location='/busca/imoveis/sao_vicente' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade-sao-vicente.jpg')}}" alt="Imoveis para venda e aluguel em São Vicente - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">São Vicente</h5>
	  			</div>
	  		</li>
	  	</ul>
	  </div>

	  <div class="tab-pane fade" id="outras" role="tabpanel" aria-labelledby="contact-tab">

	  	<ul class="list-unstyled">
	  		<li class="media" onclick="window.location='/busca/imoveis/7barras' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_sete_barras.jpg')}}" alt="Imoveis para venda e aluguel em Sete Barras - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">7Barras</h5>
	  			</div>
	  		</li>
	  		<li class="media my-4" onclick="window.location='/busca/imoveis/cajati' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_cajati.jpg')}}" alt="">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Cajati</h5>
	  			</div>
	  		</li>
	  		<li class="media" onclick="window.location='/busca/imoveis/eldorado' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_eldorado.jpg')}}" alt="Imoveis para aluguel e venda na cidade de Eldorado - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Eldorado</h5>
	  			</div>
	  		</li>
	  		
	  	</ul>

	  	<ul class="list-unstyled">	

	  		<li class="media" onclick="window.location='/busca/imoveis/itariri' ">	  			
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_itariri.jpg')}}" alt="Imoveis para venda e aluguel em Itariri - SP">	  			
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Itariri</h5>
	  			</div>	  				  			
	  		</li>
	  		
	  		<li class="media my-4" onclick="window.location='/busca/imoveis/jacupiranga' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_jacupiranga.jpg')}}" alt="">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Jacupiranga</h5>
	  			</div>
	  		</li>


	  		<li class="media" onclick="window.location='/busca/imoveis/juquia' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_juquia.jpg')}}" alt="Imoveis a venda e aluguel em Juquiá - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Juquiá</h5>
	  			</div>
	  		</li>

		</ul>
		<ul class="list-unstyled">

	  		<li class="media" onclick="window.location='/busca/imoveis/miracatu' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_miracatu.jpg')}}" alt="Imoveis para venda e aluguel em Miracatú - SP">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Miracatú</h5>
	  			</div>
	  		</li>
	  		<li class="media my-4" onclick="window.location='/busca/imoveis/pariquera_acu' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_pariqueracu.jpg')}}" alt="">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Pariquera Açu</h5>
	  			</div>
	  		</li>
	  		<li class="media" onclick="window.location='/busca/imoveis/registro' ">
	  			<img class="rounded-circle" src="{{asset('imagens/cidades/cidade_registro.jpg')}}" alt="">
	  			<div class="media-body align-self-center">
	  				<h5 class="mt-0 mb-1">Registro</h5>
	  			</div>
	  		</li>

	  	</ul>

	  </div>

	</div>
	</section>
</div>


@endsection

