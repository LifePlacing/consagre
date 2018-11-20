@extends('layouts.head')

@section('content')

	<div class="col-12">

	
			<div class="row justify-content-md-center">

				<div class="col-md-6 col-sm-12">

						<h3 class="text-center">Informações do produto/serviço</h3>

						<div class="pagina-planos">

							<div class="col-md-6 col-sm-12 text-center plano" id="plan_basico">

								<div class="plan-title">Plano Básico</div>
								<hr>
								<p class="azul"><strong>Publicado por 12 meses</strong></p>
								<p>50 anúncios</p>
								<p><strong>*Bônus (1 SUPER DESTAQUE )</strong></p>
								<p>5 destaques e 50 simples</p>
								<p>De <del>R$ 49,00</del>/mês por</p>
								<h2 id="valor_basico">R$ 29,00/mês</h2>
								<div class="col-12">						
									<label class="btn btn-plan"> 
										<input type="radio" name="plano" value="plano_basico">Contratar
									</label>
								</div>

							</div>

							<div class="col-md-6 col-sm-12 text-center plano" id="plan_pro">

								<div class="plan-title">Plano Pro-100</div>
								<hr>
								<p class="azul"><strong>Publicado por 12 meses</strong></p>
								<p>100 anúncios</p>
								<p><strong>*Bônus (10 SUPER DESTAQUE )</strong></p>
								<p>5 destaques e 100 simples</p>
								<p>De <del>R$ 99,00</del>/mês por</p>
								<h2 id="valor_pro">R$ 40,00/mês</h2>
								<div class="col-12">						
									<label class="btn btn-plan"> 
										<input type="radio" name="plano" value="plano_pro">Contratar
									</label>
								</div>

							</div>


						</div>
					
				</div>


			@if($anunciante != null && !empty($anunciante))
				<div class="col-md-6 col-sm-12">
					
					<h3 class="text-center">Informações do Cliente</h3>					

						<div class="pagina-planos">
							

							<table class="table">

								<tr>
									<td scope="row"><strong>Tipo de anunciante:</strong></td>
									<td>{{ $anunciante->tipo }}</td>
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
				
				<div class="col-12">

					<h3 class="text-center line"><i class="fa fa-credit-card" aria-hidden="true"></i>
						Formas de Pagamento</h3>


					
					<div class="container clearfix">
						
						<p class="text-monospace text-muted text-center">Escolha como deseja pagar sua fatura do serviço Consagre Imoveis</p>
						
						<div class="row">
							<div class="col"> 
								<div class="metodospag">
									<img src="{{asset('/images/boleto.svg')}}" class="formapagamento"> <br>
									<label>Boleto Bancário</label>
									<div class="change-pag" data-toggle="modal" data-target="#boleto-bancario">
										<span class="text-monospace"> Selecionar</span>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="metodospag">
									<img src="{{asset('/images/credit-card.svg')}}" class="formapagamento"><br>
									<label>Cartão de Crédito</label>
									<div class="change-pag" data-toggle="modal" data-target="#cartao">
										<span class="text-monospace">Selecionar</span>
									</div>									
								</div>
							</div>
							<div class="col">
								<div class="metodospag">
									<img src="{{asset('/images/transferencia.svg')}}" class="formapagamento"><br>
									<label>Transferência Bancária</label>
									<div class="change-pag" data-toggle="modal" data-target="#transferencia-banco">
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

@endsection

@section('footer_scripts')

<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>

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


<div class="modal fade" id="cartao" tabindex="-1" role="dialog" aria-labelledby="CartaodeCredito" aria-hidden="true">

	<div class="modal-dialog" role="document">
		
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CartaodeCredito">Cartão de Credito</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        ...
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
	
	<form  method="get">
		@csrf
		<div class="modal-dialog" role="document">
			
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="BoletoBancario">Boleto Bancário</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <div class="modal-body" id="modalboleto">
	      	
	      		<input type="hidden" name="id" value="{{$anunciante->id}}">
	      		<input type="hidden" name="plano_id" id="plano_id">

	      		<table>
	      			<tr>
	      				<td scope="row">Cliente:</td> <td>{{ $anunciante->nome }}</td>
	      			</tr>

	      			<tr>
	      				<td scope="row">CPF: </td><td><input type="text" name="cpf" class="form-control" id="cpf" required="required"></td>
	      			</tr>
	      			<tr>
	      				<td scope="row">Data de Vencimento:</td>
	      				<td><input type="date" name="vencimento" id="vencimento"></td>
	      			</tr>

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
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <input type="submit" class="btn btn-primary" value="Gerar Boleto">
	      </div>			

	  	</div>

		</div>
	</form>
</div>

@endif

@endsection