@extends('users.layouts.default')

@section('content')

@if(isset($registro->ListingID))	

<div class="content">

    <div class="container-fluid">

		<div class="row">

			<div class=" col-xs-12 col-md-12">

				<div class="card">

	                <div class="header">

	                    <h4 class="title"> 
	                    	{{ $registro->Title }} - 
	                    	{{ formataMoney($registro->Details->ListPrice) }} |

	                    	<strong> ( {{ __("imovels.$registro->TransactionType") }} )</strong>

	                    	 
	                    </h4>
	                   	   
	                   	 <hr>

						<div class="row">

							<div class="col-xs-6 col-md-4">
								<dl>
								<dt>Tipo de Imóvel</dt>
								<dd>{!! __('imovels.'.$registro->Details->PropertyType) !!}</dd>
								</dl>
							</div>
							<div class="col-xs-6 col-md-8">
								<dl>
								<dt>Url para detalhes:</dt>
								<dt><a href="{!! $registro->DetailViewUrl !!}"> {!! $registro->DetailViewUrl !!}</a></dt>
								</dl> 
							</div>

						</div>	


	                </div>

	                <div class="content">

	                	<div class="row">
	                		<div class="col-xs-12 col-md-12">
	                			<h4 class="title"> Endereço: </h4>
	                			<br>

	                			<address>
								  <strong>{{ $registro->Location->Address }}</strong><br>
								  {{ $registro->Location->Neighborhood }}, {{ $registro->Location->StreetNumber }}<br>
								  {{ $registro->Location->City }},  <abbr title="Estado">{{ $registro->Location->State }}</abbr> - {{ $registro->Location->PostalCode}}<br>								 
								</address>


	                		</div>
	                	</div>

	                	<div class="row">

	                		<div class="col-xs-12 col-md-12">

	                			<h4 class="title"> Descrição: </h4>  

	                			<br>             			

	                			<div class="panel panel-default">
  									<div class="panel-body">
  										<p class="text-justify">
	                						{{ $registro->Details->Description }}
	                					</p>
	                				</div>
	                			</div>

	                		</div>
	                	</div>



	                	@if(isset($registro->Details->Features))

	                	<div class="row">
	                		
	                		<div class="col-xs-12 col-md-12">
	                			
	                			<h4 class="title">Caracteristicas / Adicionais</h4>

	                			<br>

	                			<div class="panel panel-default">
  									<div class="panel-body">	                			

			                			<ul class="list-inline">
				                			
				                			@foreach($registro->Details->Features->Feature as $feature)

				                				<li>
				                					{{ __("imovels.$feature")  }}
				                				</li>

				                			@endforeach

			                			</ul>

			                		</div>

			                	</div>		

	                		</div>

	                	</div>

	                	<hr>

	                	@endif

						@if(isset($registro->Media))
	                	<div class="row">

	                		<div class="col-xs-12 col-md-12">

	                			<h4 class="title"> Imagens do Anúncio </h4>

	                			

								@foreach($registro->Media->Item as $key => $item)
									<div class="col-md-3 col-xs-6 thumbnail">
										<img src="{{$item}}" class="img-responsive img-preview">
									</div>	
								@endforeach

							</div>

						</div>

						@endif

					</div>

				</div>

			</div>

		</div>

	</div>

</div>

@elseif(isset($registro->CodigoImovel))

<div class="content">

	<div class="container-fluid">

		<div class="row">
			
			<div class=" col-xs-12 col-md-12">
				
				<div class="card">

					<div class="header">

						<h4 class="title"> 

	                    	{{ $registro->TituloImovel }} - 

	                    	@if(isset($registro->PrecoVenda) && !empty($registro->PrecoVenda))
	                    		{{ "Venda( ".formataMoney($registro->PrecoVenda)." )"}} 
	                    	@endif

	                    	@if(isset($registro->PrecoLocacaoTemporada) && !empty($registro->PrecoLocacaoTemporada))
	                    		{{ "Temporada( ".formataMoney($registro->PrecoLocacaoTemporada)." )" }}
	                    	@endif
	                    		
	                    	@if(isset($registro->PrecoLocacao) && !empty($registro->PrecoLocacao) && $registro->PrecoLocacao > 0)
								{{ "Aluguel( ".formataMoney($registro->PrecoLocacao)." )" }} 
							@endif	                    	

						</h4>

	                   	 <hr>

						<div class="row">

							<div class="col-xs-6 col-md-4">
								<dl>
								<dt>Tipo de Imóvel</dt>
								<dd>{!! $registro->TipoImovel !!}</dd>
								</dl>
							</div>
							<div class="col-xs-6 col-md-8">
								<dl>
								<dt>Url para detalhes:</dt>
								@if(isset($registro->URLGaiaSite))
									<dt><a href="{!! $registro->URLGaiaSite !!}"> {!! $registro->URLGaiaSite !!}</a></dt>
								@endif
								</dl> 
							</div>

						</div>



					</div>

					<div class="content">
						
						<div class="row">
	                		<div class="col-xs-12 col-md-12">
	                			<h4 class="title"> Endereço: </h4>
	                			<br>

	                			<address>
								  <strong>{{ $registro->Endereco }}</strong><br>
								  {{ $registro->Bairro }}, {{ $registro->Numero }}<br>
								  {{ $registro->Cidade }},  <abbr title="Estado">{{ $registro->Estado }}</abbr> - {{ $registro->CEP}}<br>								 
								</address>


	                		</div>
	                	</div>

	                	<div class="row">

	                		<div class="col-xs-12 col-md-12">

	                			<h4 class="title"> Descrição: </h4>  

	                			<br>             			

	                			<div class="panel panel-default">
  									<div class="panel-body">
  										<p class="text-justify">
	                						{{ $registro->TipoImovel." - ".$registro->CategoriaImovel }} {{ $registro->Finalidade }} em {{ $registro->Cidade }} 
	                						{{ isset($registro->FrenteMar) && $registro->FrenteMar == 1 ? ", com vista para o mar" : ''}} com 
	                						{{ isset($registro->QtdDormitorios) ? $registro->QtdDormitorios ." quartos" : '' }} , {{ $registro->QtdBanheiros }} banheiros
	                						@isset($registro->QtdSuites) 	
	                							e $registro->QtdSuites < 2 ? $registro->QtdSuites."  suite" : $registro->QtdSuites." suites"
	                						@endif

	                						<br>
	                						{{ isset($registro->QtdVagas) && $registro->QtdVagas > 0 ? "Possui  ".$registro->QtdVagas." vagas de garagem" : ''}} <br>
	                						{!! isset($registro->Observacao) ? $registro->Observacao : ''!!}
	                					</p>
	                				</div>
	                			</div>

	                		</div>

	                	</div>


	                	<div class="row">
	                		
	                		<div class="col-xs-12 col-md-12">
	                			
	                			<h4 class="title">Caracteristicas / Adicionais</h4>

	                			<br>

	                			<div class="panel panel-default">
  									<div class="panel-body">	                			

			                			<ul class="list-inline">

			                			@if(isset($registro->Piscina) && $registro->Piscina != 0)
			                				<li>Piscina</li>
			                			@endif	

			                			@if(isset($registro->Sauna) && $registro->Sauna != 0)
			                				<li>Sauna</li>
			                			@endif
				                			
		                				@if(isset($registro->DormitorioEmpregada) && $registro->DormitorioEmpregada != 0)
			                				<li>
					                			Quarto de Hospedes
					                		</li>
				                		@endif
				                		@if(isset($registro->PortaoEletronico) && $registro->PortaoEletronico != 0)
				                			<li>
				                				Portão Eletrônico
				                			</li>
				                		@endif

				                		@if(isset($registro->Adega) && $registro->Adega != 0)
				                			<li>Adega</li>
				                		@endif

				                		@if(isset($registro->Lavabo) && $registro->Lavabo != 0)
				                			<li>Lavabo</li>
				                		@endif

				                		@if(isset($registro->ArmarioCloset) && $registro->ArmarioCloset != 0)
				                			<li>Closet</li>
				                		@endif

				                		@if(isset($registro->PisoEmborrachado) && $registro->PisoEmborrachado != 0)
				                			<li>Piso Emborrachado</li>
				                		@endif

				                		@if(isset($registro->PisoGranito) && $registro->PisoGranito != 0)
				                			<li>Piso Granito</li>
				                		@endif

				                		@if(isset($registro->PisoMarmore) && $registro->PisoMarmore != 0)
				                			<li>Piso Marmore</li>
				                		@endif

				                		@if(isset($registro->PisoPorcelanato) && $registro->PisoPorcelanato != 0)
				                			<li>Piso Porcelanato</li>
				                		@endif				                		

			                			</ul>

			                		</div>

			                	</div>		

	                		</div>

	                	</div>

	                	<hr>

						@if(isset($registro->Fotos))

		                	<div class="row">

		                		<div class="col-xs-12 col-md-12">

		                			<h4 class="title"> Imagens do Anúncio </h4>

		                				
		                			@if(is_array($registro->Fotos->Foto))
		                				
									
										@foreach($registro->Fotos->Foto as $item)


											<div class="col-md-3 col-xs-6 thumbnail">
												<img src="{!! $item->URLArquivo !!}" class="img-responsive img-preview" title="
												{{ isset($item->FotoTitulo) && !empty($item->FotoTitulo) ? $item->FotoTitulo : ''}}">
											</div>



										@endforeach

									@else

										@foreach($registro->Fotos as $item)


											<div class="col-md-3 col-xs-6 thumbnail">
												<img src="{!! $item->URLArquivo !!}" class="img-responsive img-preview" title="
												{{ isset($item->FotoTitulo) && !empty($item->FotoTitulo) ? $item->FotoTitulo : ''}}">
											</div>



										@endforeach



									@endif	

									

								</div>

							</div>

						@endif





					</div>

				</div>

			</div>
		
		</div>

	</div>

</div>
	
@else

	
	
@endif

@endsection