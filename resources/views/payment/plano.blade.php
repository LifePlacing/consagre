@extends('layouts.head')

@section('header_styles')

	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script>

		var $jquery = jQuery.noConflict();

		$jquery( function() {
    		$jquery( "#vencimento" ).datepicker({
    			minDate: 0,
    			maxDate:5,
    			dateFormat: 'yy-mm-dd',
    		});
  		});

	</script>

@endsection

@section('breadcrumbs')

	@parent
	@include('app.inc.breadcrumbs')

@endsection


@section('content')


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(isset($expired) && $expired == false)
<div class="container">

	<div class="col-12">
	
			<div class="row justify-content-md-center col-tablets">

				<div class="col-md-6 col-sm-12 ">

						<div class="text-center h2"><h2>Informações do produto/serviço</h2><span></span></div>

						<div class="pagina-planos">

							@if(isset($planos))

								@foreach($planos as $key => $plano)

								<div class="col-md-6 col-sm-12 text-center plano" id="plan_{{ $key }}">

									<div class="plan-title"> {{ $plano->nome }} </div>
									<hr>
									<p class="azul"><strong>Publicado por 12 meses</strong></p>
									<p>{{ $plano->quant_anuncios == 0 ? "Anúncios Ilimitados" :  $plano->quant_anuncios." anuncios" }} </p>
									<p><strong>*Bônus ({{ $plano->super_destaques }} SUPER DESTAQUE )</strong></p>
									<p>{{ $plano->destaques }} destaques e {{ $plano->quant_anuncios }} simples</p>

									@php 
										$p = (floatval($plano->valor_mensal) / 100)*2 ;
										$v = (floatval($plano->valor_mensal) / 100);
										$valor_promo = number_format( $p, 2, '.', ',' );

										$valor_mes = number_format($v, 2, ',', '.');
									
									@endphp

									<p>De <del>R$ {{$valor_promo}}</del>/mês por</p>

									<h2  id="valor_{{ $key }}" >R$ {{ $valor_mes  }}/mês</h2>

									<div class="col-12">

										<input type="hidden" id="plano_id_{{ $key }}" value="{{ $plano->id }}">				
										<input type="hidden" id="plano_nome_{{ $key }}" value="{{ $plano->nome }}">				
										<label class="btn btn-plan"> 
											<input type="radio" name="plano" value="plan_{{ $key }}">Contratar
										</label>
									</div>

								</div>

								@endforeach

							@endif

						</div>
					
				</div>


			@if($anunciante != null && !empty($anunciante))
				<div class="col-md-6 col-sm-12">
					
					<div class="text-center h2"><h2 class="text-center">Informações do Cliente</h2><span></span></div>					

						<div class="pagina-planos">
							

							<table class="table">

								<tr>
									<td scope="row"><strong>Tipo de anunciante:</strong></td>
									<td> {{ $anunciante->tipo }} </td>
								</tr>
								<tr>
									<td scope="row"><strong>Nome:</strong></td>
									<td>{{ $anunciante->nome }}</td>
								</tr>
								<tr>
									<td scope="row"><strong>E-mail</strong></td>
									<td>{{ escondeEmail($anunciante->email) }}</td>
								</tr>

							</table>

						</div>	

						<h3 class="text-center">Endereço de Correspondência</h3>

						<table class="table">
							<tr>
								<td scope="row"><strong>Rua:</strong></td>
								<td>{{ $anunciante->logradouro }}</td>
								<td scope="row"><strong>Numero:</strong></td>
								<td>{{ $anunciante->unidade }}</td>
								
							</tr>
							<tr>
								<td scope="row"><strong>Bairro:</strong></td>
								<td>{{ $anunciante->bairro }}</td>
								<td scope="row"></td>
								<td></td>
							</tr>
							<tr>
								<td scope="row"><strong>Cidade:</strong></td>
								<td>{{ $anunciante->cidade }}</td>
								<td scope="row"></td>
								<td></td>
							</tr>
						</table>



				</div>
				
				<div class="col-12 d-none" id="formas_de_pagamento">

					<h3 class="text-center line"><i class="fa fa-credit-card" aria-hidden="true"></i>
						Formas de Pagamento</h3>

						<div class="container clearfix">
						

						<p class="text-monospace text-muted text-center">Escolha como deseja pagar sua fatura do serviço Consagre Imoveis</p>
						
						<div class="row">
							<div class="col-md-4 col-sm-12"> 
								<div class="metodospag" onclick="boleto()">
									<img src="{{asset('/images/boleto.svg')}}" class="formapagamento"> <br>
									<label>Boleto Bancário</label>
									<div class="change-pag" >
										<span class="text-monospace"> Selecionar</span>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-12">															
								
								<div class="metodospag" id="metodocartao">
									<img src="{{asset('/images/credit-card.svg')}}" class="formapagamento"><br>
									<label>Cartão de Crédito</label>
									<div class="change-pag">
										<span class="text-monospace">Selecionar</span>
									</div>									
								</div>
								
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="metodospag" onclick="banco()">
									<img src="{{asset('/images/transferencia.svg')}}" class="formapagamento"><br>
									<label>Transferência Bancária</label>
									<div class="change-pag" >
										<span class="text-monospace">Selecionar</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				

				@else

					<div class="col-md-6 col-sm-12">
							Cadastre-se para contratar um plano!
					</div>

				@endif

			</div>	
	

	</div>	

</div>	




@if($anunciante != null && !empty($anunciante))

<!--========== Modal para Pagamento Transferencia Bancaria ================-->

<div class="modal fade" id="transferencia-banco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

	<div class="modal-dialog" role="document">
		
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Transferencia Bancaria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>

  	</div>

	</div>

</div>


<!--========== Modal para Pagamento Transferencia Bancaria ================-->


<div class="modal fade" id="boleto-bancario" tabindex="-1" role="dialog" aria-labelledby="BoletoBancario" aria-hidden="true">
	

		<div class="modal-dialog modal-lg" role="document">

		<form action="{{route('contratar.planos')}}" method="post" id="form-boleto">
			 @csrf	

	    <div class="modal-content">

	      <div class="modal-header">
	        <h5 class="modal-title" id="BoletoBancario">Boleto Bancário</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <div class="modal-body" id="modalboleto">
	      	
	      		<input type="hidden" name="id" value="{{$anunciante->id}}" id="id">
	      		<input type="hidden" name="plan_id" id="plan_id">

	      		<div class="wrap-pg">

		      		<div class="tela-ps"> 

		      				<div class="detalhes">
		      					<h2>Detalhes Importantes</h2>
		      				</div>

		      				<div class="form-group">
		      					<label for="inputCliente">Nome:</label>
		      					<input type="text" class="form-control" readonly id="inputClientet"  value="{{ $anunciante->nome }}">
		      				</div>

		      				<div class="form-row">
			      				<div class="form-group">
			      					<label for="inputTelefone">Telefone:</label>
			      					<input type="text" class="form-control" id="inputTelefone"  value="{{ $anunciante->celular }}">
			      				</div>

			      				<div class="form-group">
			      					<label for="cpf">CPF:</label>
			      					<input type="text" class="form-control" id="cpf" name="cpf" required="required" autocomplete="off">
			      				</div>

		      				</div>

		      		</div>

		      		<hr>

		      		<div class="tela-pg">
		      				
		      				<div class="detalhes">
		      					<h2>Informações de Pagamento</h2>
		      				</div>

								<div class="alert alert-primary" role="alert">
								  Pagamento por Boleto Bancário
								</div>

		      				<div class="form-group">
			      				<label for="cpf">Data de Vencimento:</label>
			      				<input type="text" class="form-control" id="vencimento" name="vencimento" required="required" autocomplete="off" readonly="readonly" style="background-color:#fff; cursor:pointer;">
			      			</div>


		      		</div>

	      		</div>	

	      		<div class="info-prod">
	      		
	      		<table>

	      			<tr>    				

		      			<table class="table">

			      			<thead class="thead-dark">
			      				<th scope="col" class="text-white"> Plano Selecionado </th> 
			      				<th scope="col" class="text-white">Valor do Plano</th>
			      			</thead>
			      			<tbody>	
			      				<td><p id="plano_selecionado"></p></td>
			      				<td><p id="valor_do_plano"></p></td>
			      			</tbody>

		      			</table>

	      			</tr>

	      		</table>


	      		</div>

	      </div>


	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        
	        <button type="button" id="btn_emitir_boleto" class="btn btn-primary">Gerar Boleto</button>
	      </div>			

	  	</div>

		</div>
	</form>
</div>


<div class="modal fade" id="processando" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="BoletoRetorno">
	
	<div class="modal-dialog modal-lg" role="document">

		<div class="modal-content">

			<div class="modal-header">			
				<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
					Fechar Janela
				</button>
			</div>

			<div class="modal-body" id="modalprocessando">

				<div class="text-center loader">
					<h5> Um momento! Estamos processando a requisição </h5>
					<img src="{{ asset('images/loader.gif') }}">
				</div>

			</div>

		</div>	

	</div>		


</div>




<div class="modal fade" id="retorno" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="BoletoRetorno">

	<div class="modal-dialog modal-lg" role="document">

		<div class="modal-content">

			<div class="modal-header">			
			<button type="button" class="btn" data-dismiss="modal" aria-label="Close" id="fechar">
			Fechar Janela
			</button>
			</div>
	       <div class="modal-body" id="modalretorno">

		       <!--div responsável por exibir o resultado da emissão do boleto-->
		        <div id="boleto" class="container">

		            <div class="panel">

		                <div class="panel-body">

		                	<h5>Transação Segura via GerenciaNet</h5>
		                	<div class="check">
		                		<i class="fa fa-chevron-circle-down fa-3x" aria-hidden="true"></i>
		                	</div>

		                	<div id="transacao"> </div>
		                	<div id="barras"> </div>
		                	<div id="imprimir"> </div>

		                </div>            
		            </div>            
		        </div> 

	   		 </div>

		</div>   

	</div>	       

</div>


@endif

@else

<div class="alert alert-danger" role="alert">
 	Este link expirou!!
</div>

@endif



@endsection

@section('footer_scripts')

<script type="text/javascript">
	
	function boleto(){
		$('#boleto-bancario').modal('show');
	}

	function banco(){
		$('#transferencia-banco').modal('show');
	}

</script>


<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>

<script src="{{asset('js/scripts.js')}}?<?php echo time(); ?>"></script>


@endsection