@extends('users.layouts.default')

@section('content')



	<div class="panel panel-default">

		<div class="panel-heading">
			<h3 class="panel-title">Anuncios Ativos @if(isset($contador)) <span class="badge"> 
				{{ $contador }}</span> @endif </h3>
		</div>

		<div class="panel-body" id="lista-de-imoveis">
			
			@if(isset($ativos))

				@foreach($ativos as $key => $imovel)

				<div class="panel panel-primary">

					<div class="panel-heading">
						<h5>Título do anúncio: {{$imovel->titulo}}</h5>
					</div>					
				    	
				   <div class="panel-body"> 	

					  	<div class="col-sm-12 col-md-4 ">

					  		<p>Imagens do Anúncio: </p>

							<ul class="media-list">  
							@foreach($imovel->media as $key => $medias)
								<li>
									<img src="{{asset($medias->source)}}" >	
								</li>							
							@endforeach
							</ul>

					  	</div>

					  	<div class="col-sm-12 col-md-8">

					  		<div class="panel panel-default">

					  			<div class="panel-heading">
					  				CÓDIGO DO IMÓVEL: <span class="badge"> {{ formatCodigo($imovel->codigo) }}</span>				  				
					  					<small> 
											Atualizado em : {!! (date('d/m/Y',strtotime($imovel->updated_at))) !!}
										</small>
					  			</div>

					  		</div>

					  		<div class="imovel-meta">
					  			<h3>{{ $imovel->meta }}</h3><span class="aba"></span>
					  		</div>

					  		<div class="panel-body">

							<ul class="opcionais" style="padding-left:0%; list-style-type:none; ">
								<li>
									<i class="fa fa-bed fa-lg" aria-hidden="true"></i>
									{{ $imovel->quartos }}@if($imovel->quartos > 1) quartos @else quarto @endif
									
								</li>
								<li><i class="fa fa-bath fa-lg" aria-hidden="true"></i>
									@if($imovel->suites != 0 && $imovel->suites === 1) {{ $imovel->suites }} suíte @else  {{ $imovel->suites }} suítes @endif
								</li>
								<li><i class="fa fa-car fa-lg" aria-hidden="true"></i>
									@if($imovel->garagem != 0 && $imovel->garagem === 1) {{ $imovel->garagem }} vaga @else  {{ $imovel->garagem }} vagas @endif
								</li>
								<li><i class="fa fa-area-chart fa-lg" aria-hidden="true"></i>
									{{ $imovel->area_util }} m<sup>2</sup>	
								</li>
							</ul>
								
								<div class="localizacao">
									<h4>Localização</h4><span></span>

									<div class="dados">
										
											<div>
												<h5>{{$imovel->bairro}}</h5>
												<p>{{$imovel->logradouro}}
													<i class="fa fa-angle-double-right" ></i>
													 {{$imovel->cidade->nome}}
													 <i class="fa fa-angle-double-right"></i>
													 {{$imovel->estado}} 
												</p>
											</div>
											<div>
												<h4>CEP: {{ $imovel->cep }} </h4>
											</div>

									</div>	


								</div>

								<div class="meta-preco">

						  			@if( $imovel->meta == 'aluguel')						  				
						  				<p>Valor Mensal:  {{ formataMoney($imovel->preco_venda) }} </p>
							  			<p>Preço Anual:  {{ formataMoney($imovel->preco) }}	</p>			  			
							  		@else						  				
						  				<p>Valor sem comissão:  {{ formataMoney($imovel->preco_venda) }} </p>
							  			<p>Preço com Comissão:  {{ formataMoney($imovel->preco) }} </p>

							  		@endif									
									
								</div>

								<div class="descricao">
									<pre>{{ $imovel->descricao }}</pre>
								</div>

					  		</div>

					  		
					  	</div>

				  	</div>

				  	<a href="#" onclick="window.location='/{{ slugTitulo($imovel->titulo)}}/{{$imovel->id}}/{{$imovel->meta}}/{{$imovel->cidade->slug}}'" > Visualizar </a>

				 </div> 



				@endforeach


				{!! $ativos->links() !!}


			@else

				<div class="alert alert-info" role="alert">
					Sem anuncios ativos no momento!
				</div>

			@endif

		</div>


	</div>

 
@endsection