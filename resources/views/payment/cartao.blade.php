@extends('layouts.head')


@section('content')

<div class="container">	

	<div class="seguro">
		<div class="alert alert-success " role="alert">
		  <i class="fa fa-lock fa-lg" aria-hidden="true"></i> Você está em um ambiente seguro.
		</div>
	</div>	


	<div class="col-12">
		<div class="text-center h2"> <h2>Pagamento com Cartão de Crédito: {{ formataMoedaInteiro($plano->valor_mensal) }}</h2><span></span></div>
	</div>



	<form autocomplete="off" id="form" method="post">

		<input type="hidden" name="valor" id="valor" value="{{ $plano->valor_mensal }}">
		<input type="hidden" name="plan_id" id="plan_id" value="{{ $plano->id }}">
		<input type="hidden" name="descricao" id="descricao" value="{{ $plano->nome }}">
		<input type="hidden" name="amount" id="quantidade" value="1">
		<input type="hidden" name="anunciante" id="cod_anunciante" value="{{ $anunciante->id }}">
	
		<div class="informacoes">

			<section id="info-important">

				<span>1</span><h5>Informações Importantes</h5>

				<div class="dados">
				
					<div class="form-row">

					  <div class="form-group col-md-6 col-sm-12">
					    <label for="anunciante-nome">Nome:</label>
					    <input type="text" class="form-control" id="anunciante-nome" name="anunciante-nome" value="{{ $anunciante->nome }}"  required="required">				    			    
					  </div>

					  <div class="form-group col-md-6 col-sm-12">
					  	<label for="email">Email:</label>
					  	<input required="required" type="text" class="form-control" id="email" placeholder="Email" value="{{ $anunciante->email }}">
					  </div>

					</div>

				  <div class="form-row">

				  	  	<div class="form-group col-md-4 col-sm-12">
    					<label for="cpf">CPF</label>
    					<input type="phone" class="form-control" id="cpf" value="{{ $anunciante->cpf }}"  required="required">
  						</div>

				  	  	<div class="form-group col-md-4 col-sm-6">
    					<label for="telefone">Telefone</label>
    					<input type="phone" class="form-control" id="telefone" value="{{ $anunciante->celular }}"  required="required">
  						</div>

				  	  	<div class="form-group col-md-4 col-sm-12">
    					<label for="nascimento">Data de Nascimento</label>
    					<input type="date" class="form-control" id="nascimento" required="required">
  						</div>


				  </div>						

				</div>
				
			</section>

			<section id="info-pessoal">

				<span>2</span><h5>Informações Pessoais</h5>

				<div class="dados">
				
				<div class="form-row">
					<div class="col-md-4 col-sm-8">
						<div class="form-group">
							<label for="cep_imobi">CEP</label>
							 <input type="phone" id="cep_imobi" class="form-control"  name="cep" size="8" maxlength="8"  onblur="pesquisacep(this.value);" required="required" autocomplete='off'>
						</div>
					</div>
				</div>	

				<div class="form-row">

					<div class="col-md-4 col-sm-8">				
						<div class="form-group">
						    <label for="rua_imobi">Rua/Avenida:</label>
						    <input type="text" class="form-control" id="rua_imobi"  required="required" autocomplete="off">	
						    
						</div>	
					</div>
					<div class="col-md-2 col-sm-4">
						<div class="form-group">
							<label for="numero">Numero:</label>
							<input type="phone" name="numero" class="form-control" id="numero" required="required" autocomplete="off">
						</div>
					</div>
					<div class="col-md-3 col-sm-12">	
						<div class="form-group">
						    <label for="bairro_imobi">Bairro:</label>
						    <input type="text" class="form-control" id="bairro_imobi" required="required" autocomplete="off">	
						    	
						</div>	
					</div>

					<div class="col-md-3 col-sm-12">
						<div class="form-group">
							<label for="cidade_imobi">Cidade:</label> 
							<input type="text" name="cidade" id="city_imobi" class="form-control" autocomplete="off">
							<input type="hidden" name="estado" id="estado">
						</div>
					</div>

				</div>

				</div>
				
			</section>

			<section id="info-cartao">

				<span>3</span><h5>Informações do Cartão</h5>

				<div class="dados">

					<div class="form-row">

						<div class="col-md-6 col-sm-12">
							
							<div class="form-group">
							<label for="nome_cliente">Titular do Cartão </label>	
							<small id="copiar" class="btn text-danger">*Clique para o mesmo!</small>
							<input type="text" name="nome_cliente" class="form-control" required="required" placeholder="Nome conforme consta no cartão" id="nome_cliente" autocomplete="off">
							</div>

						</div>

						<div class="col-md-4 col-8">
							<div class="form-group">
								<label for="cc-number">Número do Cartão</label>
								<input type="phone" class="form-control cc-number" name="cc-number" id="cc-number" required onpaste="return false;" maxlength="20" size="20" >
								<div class="invalid-feedback">Cartão inválido</div>
								<input type="hidden" name="bandeira" id="bandeira">
							</div>

						</div>

						<div class="col-md-2 col-4 bandeiras">

							<div class="bandeira" >
								
								<div id="visa" class="d-none item"> <img src="{{ asset('/images/visa.svg')}}"/> </div>
								<div id="mastercard" class="d-none item"> <img src="{{ asset('/images/master.svg')}}"/></div>
								<div id="diners" class="d-none item"> <img src="{{ asset('/images/diners.svg')}}"/></div>
								<div id="amex" class="d-none item"> <img src="{{ asset('/images/amex.svg')}}"/></div>
								<div id="elo" class="d-none item"> <img src="{{ asset('/images/elo.svg')}}"/></div>
								<div id="hipercard" class="d-none item"> Hipercard</div>

							</div>

						</div>

					</div>

					<div class="form-row">

						<div class="col-md-3 col-sm-12">

							<label for="cvv">Código de Segurança</label>
							<div class="input-group ">
									<div class="input-group-prepend">
							          <span class="input-group-text" id="inputGroupPrepend">
							          	<i class="fa fa-lock fa-2x" aria-hidden="true"></i>
							          </span>
							        </div>
									<input type="phone" name="codigo_seguranca" id="codigo_seguranca" maxlength="4" size="4" class="form-control form-control-lg" placeholder="CVV" autocomplete="off" onpaste="return false;">
							</div>							

						</div>

						<div class="col-md-3 col-sm-12">
							<label for="cvv">Data de Expiração</label>
							<div class="form-row">
								<div class="col-6">
									<input type="phone" name="mes" id="mes_vencimento" class="form-control form-control-lg" placeholder="mm" maxlength="2" size="2">
								</div>								
								<div class="col-6">
									<input type="phone" name="ano" id="ano_vencimento" class="form-control form-control-lg" placeholder="yyyy" maxlength="4" size="4">
								</div>
							</div>

						</div>

						<div class="col-md-6 col-sm-12">

						    <div id="div_installments" class="form-group d-none">
	                            <label for="installments">Número de parcelas: </label>
	                            <select required style="color: black" id="installments" class="form-control" >
	                                <option>Selecione uma opção</option>
	                            </select>
	                        </div>

                   		 </div>
						
					</div>

					<div class="my-4 mx-0"> 
						                 	
                        	<button id="ver_parcelas" type="button" class="btn btn-primary btn-lg"> Definir número de parcelas </button>
                        	<button id="btn_pg_cartao" type="button" class="btn btn-success btn-lg d-none"> Confirmar pagamento </button>
                    	

                    </div>

					

				</div>
				
			</section>

		</div>

	</form>



</div>


    <!-- Este componente é utilizando para exibir um alerta(modal) para o usuário aguardar as consultas via API.  -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

			<div class="modal-header">			
				<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
					Fechar Janela
				</button>
			</div>

                <div class="modal-body">

				<div class="text-center loader">
					<h5>  Um momento! Estamos processando a requisição </h5>
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
			<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
			Fechar Janela
			</button>
			</div>
	       <div class="modal-body" id="modalretorno">

		       <!--div responsável por exibir o resultado da emissão do cartão-->
		        <div id="boleto" class="container">

		            <div class="panel">

		                <div class="panel-body">

		                	<h5>Transação Segura via GerenciaNet</h5>
		                	<div class="check">
		                		<i class="fa fa-chevron-circle-down fa-3x" aria-hidden="true"></i>
		                	</div>		                	

		                	<div id="produto"></div>
		                	
		                	<table class="table">
		                		<tr>
			                		<th>Parcelas</th>
			                		<th>Valor da Parcela</th>
			                		<th>Valor Total</th>
		                		</tr>
		                		<tr id="installments_value"></tr>
		                	</table> 

		                	<blockquote class="alert alert-success" role="alert">
							  <p class="mb-0">Correu tudo certo até aqui! Em breve você receberá confirmação no seu email, para ter acesso ao seu painel administrativo.</p>							  
							</blockquote>           	
		                	

		                </div>            
		            </div>            
		        </div> 

	   		 </div>

		</div>   

	</div>	       

</div>



@endsection

@section('footer_scripts')

	@if(config('app.sandbox_gerencianet') == true)

	<script type='text/javascript'>var s=document.createElement('script');s.type='text/javascript';var v=parseInt(Math.random()*1000000);s.src='https://sandbox.gerencianet.com.br/v1/cdn/8f58430d584fa262580504250dc126e6/'+v;s.async=false;s.id='8f58430d584fa262580504250dc126e6';if(!document.getElementById('8f58430d584fa262580504250dc126e6')){document.getElementsByTagName('head')[0].appendChild(s);};$gn={validForm:true,processed:false,done:{},ready:function(fn){$gn.done=fn;}};</script>

	@else

	<script type='text/javascript'>var s=document.createElement('script');s.type='text/javascript';var v=parseInt(Math.random()*1000000);s.src='https://api.gerencianet.com.br/v1/cdn/8f58430d584fa262580504250dc126e6/'+v;s.async=false;s.id='8f58430d584fa262580504250dc126e6';if(!document.getElementById('8f58430d584fa262580504250dc126e6')){document.getElementsByTagName('head')[0].appendChild(s);};$gn={validForm:true,processed:false,done:{},ready:function(fn){$gn.done=fn;}};</script>

	@endif

<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js/gerencianet_cartao.js')}}?<?php echo time(); ?>"></script>
<script src="{{asset('js/scripts.js')}}?<?php echo time(); ?>"></script>

@endsection