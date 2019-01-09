@extends('users.layouts.default')

@section('content')

@if(isset($registro))	

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
	
@else

	<h2>Nao informado</h2>	
	
@endif

@endsection