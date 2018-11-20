<div class="h2">
	<h2>Mais imóveis como este</h2> <span></span>
</div>
<div class="container-fluid gray">

	<div id="relacionados">

		<div class="slider">

	@if($relacionados->count() > 0)

			<div id="SliderRelacionados" class="carousel slide" data-ride="carousel">

				<div class="carousel-inner">
					
					<!-- Item do Slide -->

					<div class="carousel-item active">
						<div class="row">
	
				@foreach($relacionados as $i => $imovel )

					

					@if($i <= 2)

						<div class="col-sm-4 col-md-4">
							<div class="card card-imoveis" onclick="window.location='/{{ slugTitulo($imovel->titulo) }}/{{$imovel->id}}/{{$imovel->meta}}/{{$imovel->cidade->slug}}'">

								@foreach($imovel->media as $m => $medias)

									@if($m == 0)
										<img class="thumb" src="{{asset($medias->source)}}">
									@endif

								@endforeach

				 				<div class="card-title">	 				 
					 			{{ formataMoney($imovel->preco) }}
					 			</div>
					 			<div class="card-content">
					 				<h3>{{ $imovel->cidade->nome }}</h3>
					 				<div class="row">
					 					<div class="col">
					 						<i class="fa fa-bed" aria-hidden="true"></i> {{$imovel->quartos}} 
					 					</div>
					 					<span>|</span>
					 					<div class="col">
					 						<i class="fa fa-bath" aria-hidden="true"></i>
											{{$imovel->banheiros}}
										</div>
										<span>|</span>
										<div class="col">
											{{$imovel->area_total}}m&#178;
										</div>
					 				</div>
					 			</div>								
							</div>
						</div>

					@endif

					@endforeach
											
					</div> <!-- Fim da Row -->

					</div> <!-- Fim Item do Slide -->

			@endif		

			@if($relacionados->count() > 2)

					<!-- Item do Slide -->

					<div class="carousel-item">
						<div class="row">


				@foreach( $relacionados as $i => $imovel )

						@if( $i > 3 )

							<div class="col-sm-4 col-md-4">

								<div class="card card-imoveis" onclick="window.location='/{{ slugTitulo($imovel->titulo) }}/{{$imovel->id}}/{{$imovel->meta}}/{{$imovel->cidade->slug}}'">

									@foreach($imovel->media as $m => $medias)

										@if($m == 0)
										<img class="thumb" src="{{asset($medias->source)}}">
										@endif

									@endforeach

					 				<div class="card-title">
						 				{{ formataMoney($imovel->preco) }}
						 			</div>
						 			<div class="card-content">
						 				<h3>{{ $imovel->cidade->nome }}</h3>
						 				<div class="row">
						 					<div class="col">
						 						<i class="fa fa-bed" aria-hidden="true"></i> {{$imovel->quartos}}
						 					</div>
						 					<span>|</span>
						 					<div class="col">
						 						<i class="fa fa-bath" aria-hidden="true"></i>
												{{$imovel->banheiros}}
											</div>
											<span>|</span>
											<div class="col">
												{{$imovel->area_total}}m&#178;
											</div>
						 				</div>
						 			</div>								
								</div>
							</div>

						@endif	

					@endforeach

																		
					</div> <!-- Fim da Row -->

					</div> <!-- Fim Item do Slide -->

			@endif

				</div>

			<!-- Botões de controle -->

			  <a class="carousel-control-prev" href="#SliderRelacionados" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Anterior</span>
			  </a>
			  <a class="carousel-control-next" href="#SliderRelacionados" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Próximo</span>
			  </a>

			  <!-- Fim Botões de controle -->
			
			</div>

		</div>

	</div>

</div>