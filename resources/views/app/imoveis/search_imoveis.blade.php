@extends('layouts.head')

@section('title', 'Encontre seu imóvel')

@section('breadcrumbs')
	@parent
	@include('app.inc.breadcrumbs')
@endsection

@section('sidebar')

<div class="container-grid" >

		<div class="sidebar">

			@include('app.inc.searchForm')
			
		</div>

	@endsection

	@section('content')

	<div class="wrap">

		<div class="h2">
			<h2>Resultados para pesquisa:</h2><span></span>			
		</div>


		@if(isset($total_resultados) && !empty($total_resultados)) 
			@if($total_resultados > 0)
				<p class="text-center"> Total de resultados: {{ $total_resultados }} </p> 
			@endif 

		@elseif(empty($total_resultados))
			<p class="text-center">Não encontramos resultados</p>
		@endif


		@if($errors->any())
			<div class="alert alert-danger" role="alert">
				{{$errors->first()}}
			</div>
			
			@if(isset($super) && count($super) > 0)
				<h2>Quem sabe interesse a você, algum destes resultados ?</h2>

				@foreach ($super as $item)
			
			<div class="card-imovel" onclick="window.location='/{{ slugTitulo($item->titulo)}}/{{$item->id}}/{{$item->meta}}/{{$item->cidade->slug}}'">	
			    @foreach($item->media as $medias)

			    	@if($medias->position == 0)
			    	<img class="img-fluid img-dest" src="{{asset($medias->source)}}">			    	
			    	@endif
			    	
			    @endforeach

				<div class="card-imovel-box">
					
					<div class="col-pesquisa">

						<div class="valor-preco">
							{{ formataMoney($item->preco) }}
						</div>


						<div class="titulo">
							<h5>{{$item->bairro}}</h5>
							<p>{{$item->logradouro}}
								<i class="fa fa-angle-double-right" ></i>
								 {{$item->cidade->nome}}
								 <i class="fa fa-angle-double-right"></i>
								 {{$item->estado}} 
							</p>
						</div>

					</div>

					<div class="corpo">

						<pre>{{ str_limit($item->descricao, $limit = 140, $end = '...') }}</pre>
						<small> 
							Atualizado em : {!! (date('d/m/Y',strtotime($item->updated_at))) !!}
						</small>

						<ul>
							<li><i class="fa fa-bed fa-lg" aria-hidden="true"></i><br>
								{{ $item->quartos }}@if($item->quartos > 1) quartos @else quarto @endif
								
							</li>
							<li><i class="fa fa-bath fa-lg" aria-hidden="true"></i><br>
								@if($item->suites != 0 && $item->suites === 1) {{ $item->suites }} suíte @else  {{ $item->suites }} suítes @endif
							</li>
							<li><i class="fa fa-car fa-lg" aria-hidden="true"></i><br>
								@if($item->garagem != 0 && $item->garagem === 1) {{ $item->garagem }} vaga @else  {{ $item->garagem }} vagas @endif
							</li>
							<li><i class="fa fa-area-chart fa-lg" aria-hidden="true"></i><br>
								{{ $item->area_total }} m<sup>2</sup>	
							</li>
						</ul>

					</div>

					<div class="card-bottom">
						<a href="#">Ver telefone</a>
						<button class="btn">MENSAGEM</button> 						
					</div>


				</div>
			    	
			</div>

				@endforeach
			@endif

		@endif

		@if(isset($super))

			@include('app.inc.superDestaques')

		@endif


		@if(isset($search) && count($search) > 0)

			@foreach($search as $item)

					@if($item->tipo_de_anuncio == 'destaque')
						
						<div class="card-imovel" onclick="window.location='/{{ slugTitulo($item->titulo)}}/{{$item->id}}/{{$item->meta}}/{{$item->cidade->slug}}'">	
						    @foreach($item->media as $medias)
						    	@if($medias->position == 0)
						    	<img class="img-fluid img-dest" src="{{asset($medias->source)}}">
						    	@endif

						    @endforeach

							<div class="card-imovel-box">
								
								<div class="col-pesquisa">

									<div class="valor-preco">
										{{ formataMoney($item->preco) }}
									</div>

									@if($item->tipo_de_anuncio == 'destaque' || $item->tipo_de_anuncio == 'super')
										<div class="etiqueta">{{ $item->tipo_de_anuncio == 'super' ? 'Super Destaque' : $item->tipo_de_anuncio }}</div>
									@endif
									<div class="titulo">
										<h5>{{$item->bairro}}</h5>
										<p>{{$item->logradouro}}
											<i class="fa fa-angle-double-right" ></i>
											 {{$item->cidade->nome}}
											 <i class="fa fa-angle-double-right"></i>
											 {{$item->estado}} 
										</p>
									</div>

								</div>

								<div class="corpo">

									<pre>{{ str_limit($item->descricao, $limit = 140, $end = '...') }}</pre>
									<small> 
										Atualizado em : {!! (date('d/m/Y',strtotime($item->updated_at))) !!}
									</small>

									<ul>
										<li><i class="fa fa-bed fa-lg" aria-hidden="true"></i><br>
											{{ $item->quartos }}@if($item->quartos > 1) quartos @else quarto @endif
											
										</li>
										<li><i class="fa fa-bath fa-lg" aria-hidden="true"></i><br>
											@if($item->suites != 0 && $item->suites === 1) {{ $item->suites }} suíte @else  {{ $item->suites }} suítes @endif
										</li>
										<li><i class="fa fa-car fa-lg" aria-hidden="true"></i><br>
											@if($item->garagem != 0 && $item->garagem === 1) {{ $item->garagem }} vaga @else  {{ $item->garagem }} vagas @endif
										</li>
										<li><i class="fa fa-area-chart fa-lg" aria-hidden="true"></i><br>
											{{ $item->area_total }} m<sup>2</sup>	
										</li>
									</ul>

								</div>

								<div class="card-bottom">
									<a href="#">Ver telefone</a>
									<button class="btn">MENSAGEM</button> 						
								</div>


							</div>
						    	
						</div>									
						
					@endif

			@endforeach	
			
			@foreach($search as $item)	

					@if($item->tipo_de_anuncio == 'simples')

					<div class="card-imovel" onclick="window.location='/{{ slugTitulo($item->titulo)}}/{{$item->id}}/{{$item->meta}}/{{$item->cidade->slug}}'">	
					    @foreach($item->media as $key => $medias)
					    	@if($medias->position == 0)
					    	<img class="img-fluid img-dest" src="{{asset($medias->source)}}">
					    	@endif

					    @endforeach

						<div class="card-imovel-box">
							
							<div class="col-pesquisa">

								<div class="valor-preco">
									{{ formataMoney($item->preco) }}
								</div>

								@if($item->tipo_de_anuncio == 'destaque' || $item->tipo_de_anuncio == 'super')
									<div class="etiqueta">{{ $item->tipo_de_anuncio == 'super' ? 'Super Destaque' : $item->tipo_de_anuncio }}</div>
								@endif
								<div class="titulo">
									<h5>{{$item->bairro}}</h5>
									<p>{{$item->logradouro}}
										<i class="fa fa-angle-double-right" ></i>
										 {{$item->cidade->nome}}
										 <i class="fa fa-angle-double-right"></i>
										 {{$item->estado}} 
									</p>
								</div>

							</div>

							<div class="corpo">

								<pre>{{ str_limit($item->descricao, $limit = 140, $end = '...') }}</pre>
								<small> 
									Atualizado em : {!! (date('d/m/Y',strtotime($item->updated_at))) !!}
								</small>

								<ul>
									<li><i class="fa fa-bed fa-lg" aria-hidden="true"></i><br>
										{{ $item->quartos }}@if($item->quartos > 1) quartos @else quarto @endif
										
									</li>
									<li><i class="fa fa-bath fa-lg" aria-hidden="true"></i><br>
										@if($item->suites != 0 && $item->suites === 1) {{ $item->suites }} suíte @else  {{ $item->suites }} suítes @endif
									</li>
									<li><i class="fa fa-car fa-lg" aria-hidden="true"></i><br>
										@if($item->garagem != 0 && $item->garagem === 1) {{ $item->garagem }} vaga @else  {{ $item->garagem }} vagas @endif
									</li>
									<li><i class="fa fa-area-chart fa-lg" aria-hidden="true"></i><br>
										{{ $item->area_total }} m<sup>2</sup>	
									</li>
								</ul>

							</div>

							<div class="card-bottom">
								<a href="#">Ver telefone</a>
								<button class="btn">MENSAGEM</button> 						
							</div>


						</div>
					    	
					</div>					

					@endif

			@endforeach


			{{ $search->appends($pesquisa)->links() }}			

		@endif

	</div>

</div>

	@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript">
jQuery(window).scroll(function () {
	 
	 var div_heigh = $(".sidebar").height();
	 var win_heigh = window.innerHeight;
	 var div_topo  = $(".sidebar").offset().top;

	 var distancia = div_topo - jQuery(this).scrollTop() - win_heigh;
	 console.log( distancia );

 if(distancia <= -div_heigh) {     
     jQuery(".widget").removeClass("fixo");
     $(this).off("scroll");
 }else {
 	
 	if(jQuery(this).scrollTop() > 275){
     jQuery(".widget").addClass("fixo");
 	}else{
 		jQuery(".widget").removeClass("fixo");
 		$(this).off("scroll");
 	}

 }
});
</script>

