@extends('admin/layouts/default')

    @section('title')
        Consagre Imoveis Admin
    @parent

    @section('header_styles')
    	<link href="{{ asset('admin/icon_fonts_assets/picons-thin/style.css') }}" rel="stylesheet">
    @stop

@stop
@section('content')

<div class="element-wrapper">

	<h6 class="element-header">
      Integrações de Pagamentos
    </h6>
    <div class="element-box">

	@if($errors->any())
		@foreach ($errors->all() as $error)
			<div class="alert alert-danger" role="alert">
				<strong>Ops!</strong>{{ $error }}.
			</div>
		@endforeach
	@endif

	@if(session()->has('message'))
	    <div class="alert alert-success">
	        {{ session()->get('message') }}
	    </div>
	@endif

	@if( isset($gateways) && $gateways->count() > 0 )
		
		<h5 class="form-header">
            Lista forma de pagamentos ativas
    	</h5>

		<div class="form-desc">
			O status <strong> Modo Produção </strong> significa que a forma de pagamento está ativa e todas as cobranças geradas serão registradas. 
		</div>



		<div class="table-responsive">

			<table id="dataTable1" class="table table-striped table-lightfont" width="100%" >

          		<thead>
          			<tr>
          				<th>Nome</th> <th>client_secret ou token</th><th>status</th><th>ação</th>
          			</tr>
          		</thead>

          		<tbody>
          			@foreach($gateways as $gtw)
          			<tr>
	          			<td>{{ $gtw->nome }}</td>          			
	          			<td>{{ $gtw->nome == 'Gerencia Net' ? $gtw->cliente_id : $gtw->token }}</td>         			
	         			<td>
	          			<span class="{{ $gtw->cliente_sandbox == true ? 'text-danger' : 'text-success' }}">{{ $gtw->cliente_sandbox == true ? 'Modo Teste' : 'Modo Produção' }}</span>
	          			</td>
	          			<td>
	          				<a href="{{ route('options.admin', ['payment_methods', $gtw->nome]) }}">Editar</a>
	          				<a href="" data-id="{{ $gtw->id }}" data-gtwnome="{{$gtw->nome}}" class="btn-del">Excluir</a>
	          			</td>
          			</tr>
          			@endforeach
          		</tbody>

			</table>
		</div>
		 
	@endif	

	@if(isset($action) || isset($gateways) && $gateways->count() == 0)		


			<form id="formValidate" method="POST" action="{{ route('integracoes.gateway') }}">
				
				@csrf

				<div class="row">

					<div class="col-sm-2">
						<div class="form-group">
							<label for="">Status</label>
		                    <select name="cliente_sandbox" class="form-control" required="required">
		                    	<option value="1">Modo Teste</option>
		                    	<option value="0">Modo Produção</option>
		                    </select> 
						</div>
					</div>                     
				</div>

				<div class="row">

					<div class="col-sm-4">
		              <div class="form-group">
		                <label for="">Gateway de Pagamento</label>
		                <select name="nome" class="form-control" required="required">
		                	<option value="Gerencia Net">Gerencia Net</option>
		                	<option value="Pag Seguro">Pag Seguro</option>
		                </select> 
		              </div> 
		            </div>

		            <div class="col-sm-4">
		              <div class="form-group">
		                <label for=""> Email de Integração</label>
		                <input class="form-control" name="email" placeholder="Email da Conta" type="email" 
		                id="email" autocomplete="off" required="required"> 

		                  <div class="help-block form-text with-errors form-control-feedback" id="helpEmail">
		                  </div>                        
		              </div> 
		            </div> 

		            <div class="col-sm-4">
		              <div class="form-group">
		                <label for=""> Token</label>
		                <input class="form-control" name="token" placeholder="Apenas para Pag Seguro" type="text" 
		                id="token" autocomplete="off" > 
		                                       
		                  <div class="help-block form-text with-errors form-control-feedback" id="helptoken">
		                  </div>                        
		              </div> 
		            </div> 
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="">Client_id</label>
							<input class="form-control" name="cliente_id" type="text" 
		                id="client_id" autocomplete="off" > 
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label for="">Client_secret</label>
							<input class="form-control" name="cliente_secret" type="text" 
		                id="client_secret" autocomplete="off" > 
						</div>
					</div>

				</div>
				<div class="row">
					<button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
				</div>

			</form>		

	@endif

	@if(isset($gateway) && $method == 'update')

			<form id="formValidate" method="POST" action="{{ route('update.integracoes') }}">
				
				@csrf

				<input type="hidden" name="id" value="{{ $gateway->id }}">

				<div class="row">

					<div class="col-sm-2">
						<div class="form-group">
							<label for="">Status</label>
		                    <select name="cliente_sandbox" class="form-control" required="required">
		                    	
		                    	@if($gateway->cliente_sandbox === 1)
			                    	<option value="1" selected="selected">Modo Teste </option>
			                    	<option value="0" >Modo Produção </option>
		                    	@else
			                    	<option value="1" >Modo Teste </option>
			                    	<option value="0" selected="selected" >Modo Produção </option>
		                    	@endif
		                    	
		                    </select> 
						</div>
					</div>                     
				</div>

				<div class="row">

					<div class="col-sm-4">
		              <div class="form-group">
		                <label for="">Gateway de Pagamento</label>
		                <select name="nome" class="form-control" required="required">
	                		@if($gateway->nome == 'Gerencia Net')
		                		<option value="Gerencia Net" selected="selected">Gerencia Net</option>
		                		<option value="Pag Seguro">Pag Seguro</option>
	                    	@else
			                	<option value="Gerencia Net">Gerencia Net</option>
			                	<option value="Pag Seguro" selected="selected">Pag Seguro</option>
	                    	@endif

		                </select> 
		              </div> 
		            </div>

		            <div class="col-sm-4">
		              <div class="form-group">
		                <label for=""> Email de Integração</label>
		                <input class="form-control" name="email" placeholder="Email da Conta" type="email" 
		                id="email" autocomplete="off" required="required" value="{{ $gateway->email ? $gateway->email : ''}}"> 

		                  <div class="help-block form-text with-errors form-control-feedback" id="helpEmail">
		                  </div>                        
		              </div> 
		            </div> 

		            <div class="col-sm-4">
		              <div class="form-group">
		                <label for=""> Token</label>
		                <input class="form-control" name="token" placeholder="Apenas para Pag Seguro" type="text" 
		                id="token" autocomplete="off" value="{{ $gateway->token ? $gateway->token : ''}}"> 
		                                       
		                  <div class="help-block form-text with-errors form-control-feedback" id="helptoken">
		                  </div>                        
		              </div> 
		            </div> 
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="">Client_id</label>
							<input class="form-control" name="cliente_id" type="text" 
		                id="client_id" autocomplete="off" value="{{ $gateway->cliente_id ? $gateway->cliente_id : ''}}" > 
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label for="">Client_secret</label>
							<input class="form-control" name="cliente_secret" type="text" 
		                id="client_secret" autocomplete="off" value="{{ $gateway->cliente_secret ? $gateway->cliente_secret : ''}}"> 
						</div>
					</div>

				</div>
				<div class="row">
					<button type="submit" class="btn btn-primary btn-lg">Atualizar</button>
				</div>

			</form>			

	@endif

	</div>	
</div>	


      <!-- Alerta de deletar Gtw -->


        <div aria-hidden="true" aria-labelledby="Atenção" class="modal" tabindex="-1" id="deleteGtw" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="alert alert-warning fade show" role="alert" style="margin-bottom: 0rem"> 

                  <h6><strong>Atenção!!</strong>Você tem certeza que deseja remover este Metodo de Pagamento? </h6>
                  <br>
                  <p id="plan_nome_remove" class="text-monospace font-weight-bold"></p>

                  <hr>

                  <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg">
                    CANCELAR
                  </button>

                  <a class="btn btn-danger btn-lg" href="" id="aceitar">Sim quero remover !</a>
                      
                  <form method="POST" action="{{ route('destroy.integracoes') }}" style="display: none;" id="del_plan_form">
                     @csrf
                      <input type="hidden" name="id" id="delGtwId">                    
                  </form>
              </div>

            </div>
          </div>          
        </div>

@stop

@section('footer_scripts')
 <script type="text/javascript" src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}" >  </script>

 <script type="text/javascript">

   $('.btn-del').on('mousedown', function(){

        $('#deleteGtw').modal('toggle');

        var nomeGtw = $(this).data('gtwnome');
        var id = $(this).data('id');

        $('#plan_nome_remove').text('Gateway de Pagamento: ' + nomeGtw);

        $('#delGtwId').val(id);

        $('#aceitar').on('click', function(event){
          
          event.preventDefault();

          $('#del_plan_form').submit(); 

        });

    });

 </script>
@stop