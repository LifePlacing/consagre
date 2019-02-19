@extends('users.layouts.default')

@section('content')

	<div class="row">

	@if(isset($propriedade))

	<div class="col-xs-12 col-sm-12 col-md-12">

		<div class="panel panel-default">
		
		<div class="panel-body" id="lista-de-imoveis">

				<div class="panel panel-primary">

					<div class="panel-heading">
						<h5>Título do anúncio: {{$propriedade->titulo}}</h5>
					</div>					
				    	
				   <div class="panel-body"> 	

					  	<div class="col-sm-12 col-md-4 ">

					  		<p>Imagens do Anúncio: </p>

							<ul class="media-list">  
							@foreach($propriedade->media as $key => $medias)
								<li>
									<img src="{{asset($medias->source)}}" >	
								</li>							
							@endforeach
							</ul>

					  	</div>

					  	<div class="col-sm-12 col-md-8">

					  		<div class="panel panel-default">

					  			<div class="panel-heading">
					  				CÓDIGO DO IMÓVEL: <span class="badge"> {{ formatCodigo($propriedade->codigo) }}</span>				  				
					  					<small> 
											Atualizado em : {!! (date('d/m/Y',strtotime($propriedade->updated_at))) !!}
										</small>
					  			</div>

					  		</div>

					  		<div class="imovel-meta">
					  			<h3>{{ $propriedade->meta }}</h3><span class="aba"></span>
					  		</div>

					  		<div class="panel-body">

							<ul class="opcionais" style="padding-left:0%; list-style-type:none; ">
								<li>
									<i class="fa fa-bed fa-lg" aria-hidden="true"></i>
									{{ $propriedade->quartos }}@if($propriedade->quartos > 1) quartos @else quarto @endif
									
								</li>
								<li><i class="fa fa-bath fa-lg" aria-hidden="true"></i>
									@if($propriedade->suites != 0 && $propriedade->suites === 1) {{ $propriedade->suites }} suíte @else  {{ $propriedade->suites }} suítes @endif
								</li>
								<li><i class="fa fa-car fa-lg" aria-hidden="true"></i>
									@if($propriedade->garagem != 0 && $propriedade->garagem === 1) {{ $propriedade->garagem }} vaga @else  {{ $propriedade->garagem }} vagas @endif
								</li>
								<li><i class="fa fa-area-chart fa-lg" aria-hidden="true"></i>
									{{ $propriedade->area_util }} m<sup>2</sup>	
								</li>
							</ul>
								
								<div class="localizacao">
									<h4>Localização</h4><span></span>

									<div class="dados">
										
											<div>
												<h5>{{$propriedade->bairro}}</h5>
												<p>{{$propriedade->logradouro}}
													<i class="fa fa-angle-double-right" ></i>
													 {{$propriedade->cidade->nome}}
													 <i class="fa fa-angle-double-right"></i>
													 {{$propriedade->estado}} 
												</p>
											</div>
											<div>
												<h4>CEP: {{ $propriedade->cep }} </h4>
											</div>

									</div>	


								</div>

								<div class="meta-preco">

						  			@if( $propriedade->meta == 'aluguel')						  				
						  				<p>Valor Mensal:  {{ formataMoney($propriedade->preco_venda) }} </p>
							  			<p>Preço Anual:  {{ formataMoney($propriedade->preco) }}	</p>			  			
							  		@else						  				
						  				<p>Valor sem comissão:  {{ formataMoney($propriedade->preco_venda) }} </p>
							  			<p>Preço com Comissão:  {{ formataMoney($propriedade->preco) }} </p>

							  		@endif									
									
								</div>

								<div class="descricao">
									<pre>{{ $propriedade->descricao }}</pre>
								</div>

					  		</div>

					  		
					  	</div>

				  	</div>				  	

				 </div> 



			</div>

		
		</div>

	</div>

		@else



		@endif


	</div>

@endsection