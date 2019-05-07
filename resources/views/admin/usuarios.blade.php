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

		
	@isset($action)

		    <h6 class="element-header">
		      Adicionar Novo Usuário
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


			    
			    <form id="formValidate" method="POST" action="{{ route('adicionar.user') }}">

			    @csrf

			      <div class="steps-w">

			        <div class="step-triggers">
			          <a class="step-trigger active" href="#stepContent1">Dados do Usuário</a>
			          <a class="step-trigger" href="#stepContent2">Informações de Login</a>
			        </div>
			        <div class="step-contents">
			          <div class="step-content active" id="stepContent1">
			            <div class="row">

			            <div class="col-sm-6">
			                <div class="form-group">
			                  <label> Tipo de Anunciante</label>
			                  	<select class="form-control" required="required" name="tipo" data-error="Você precisa escolher um perfil pro anunciante.">
					                <option value="imobiliaria">
					                  	Imobiliária
					                </option>
					                <option value="corretor">
					                  	Corretor
					                </option>
			              		</select>
			              		<div class="help-block form-text with-errors form-control-feedback"></div>
			                </div>
			            </div>

			            <div class="col-sm-6">
			                <div class="form-group">
			                  <label>Nome Completo</label>
			                  <input class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="Nome Completo ou Razão Social" type="text" 
			                  required="required" name="nome" data-error="Preenchimento inválido!" data-minlength="6" value="{{ old('nome') }}">
			                  <div class="help-block form-text with-errors form-control-feedback"></div>
			                </div>
			              </div>
			            </div>

			            <div class="row">

			              <div class="col-sm-6">
			                <div class="form-group">
			                  <label for=""> Telefone</label>
			                  <input class="form-control{{ $errors->has('phone_fixo') ? ' is-invalid' : '' }}" placeholder="Telefone Comercial" type="tel" maxlength="10" name="phone_fixo" required="required" data-error="Informe um telefone válido!" value="{{ old('phone_fixo') }}">
			                  <div class="help-block form-text with-errors form-control-feedback"></div>
			                </div>
			              </div>
			              <div class="col-sm-6">
			                <div class="form-group">
			                  <label for="">Celular</label>
			                  <input class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" placeholder="Celular ou Whatsapp" type="tel" maxlength="11" name="celular" value="{{ old('celular') }}">
			                </div>
			              </div>

			            </div>

			 
			            <div class="row">
			 				
			 				<div class="col-sm-6">
					             <div class="form-group">
									<label for="">CEP Comercial</label>
					                  <div class="input-group">
					                    <div class="input-group-prepend">
					                      <div class="input-group-text">
					                         <div class="os-icon os-icon-home"></div>
					                      </div>
					                    </div>
					                    <input type="tel" name="cep" maxlength="8"  class="form-control" required="required"  data-error="CEP precisa no minimo de 8 digitos" id="cep" value="{{ old('cep') }}">		                    
					                  </div> 
					                  <div class="help-block form-text with-errors form-control-feedback">           	
					                   </div>
					            </div>
				            </div> 
				            <div class="col-sm-6">
				            	<div class="form-group">
				            		<div class="alert alert-success" role="alert">
									  <h6 class="alert-heading">Preencha o CEP!</h6>
									   <p>Para um cadastro mais seguro preencha o cep comercial corretamente.</p>
									  						 
									</div>
				            	</div>
				            </div>




			            </div>

			            <div class="row">

				            <div class="col-sm-4">
				            	<div class="form-group">
				            		<label for="">Rua</label>
				            		<input type="text" readonly name="logradouro" required="required" class="form-control{{ $errors->has('logradouro') ? ' is-invalid' : '' }}" id="rua" value="{{ old('logradouro') }}">
				            	</div>
				            </div>		
				            <div class="col-sm-2">
				            		<div class="form-group">
					            		<label for="">Numero</label>
					            		<input type="tel" name="unidade" required="required" class="form-control{{ $errors->has('unidade') ? ' is-invalid' : '' }}" data-error="Número Obrigatório" value="{{ old('unidade') }}">
					            		<div class="help-block form-text with-errors form-control-feedback"></div>
					            	</div> 
				            </div>   

				            <div class="col-sm-3">
				            	<div class="form-group">
				            		<label for="">Cidade</label>
				            		<input type="text" readonly name="cidade" required="required" class="form-control{{ $errors->has('cidade') ? ' is-invalid' : '' }} " id="cidade" value="{{ old('cidade') }}">
				            	</div>
				            </div> 

				  	        <div class="col-sm-3">
				            	<div class="form-group">
				            		<label for="">Bairro</label>
				            		<input type="text" readonly name="bairro" required="required" class="form-control{{ $errors->has('bairro') ? ' is-invalid' : '' }}" id="bairro" value="{{ old('bairro') }}">
				            	</div>
				            </div> 

				            <input type="hidden" name="uf" id="uf" value="{{ old('uf') }}">         

			            	
			            </div>



			            <div class="form-buttons-w text-right">
			              <a class="btn btn-primary step-trigger-btn" href="#stepContent2"> Continue</a>
			            </div>
			          </div>

			          <div class="step-content" id="stepContent2">

			            <div class="row">

			            	<div class="col-sm-4">
				            	<div class="form-group">
				              
					              	<label for=""> Plano de anuncios</label>

					              	<select class="form-control" name="plano_id">
						               

						                @foreach($planos as $plano)
							                <option value="{{ $plano->id }}">
							                  {{ $plano->nome }}
							                </option>
						                @endforeach

					              	</select>

				            	</div>
			            	</div>

			            	<div class="col-sm-8">
			            		
			            		<div class="form-group">
					              <label for=""> Email</label>
					              <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Digite o email" type="email" required="required" data-error="Email é requerido!" name="email" value="{{ old('email') }}">
					              @if ($errors->has('email'))
					              	<div class="help-block form-text with-errors form-control-feedback">
					              	{{ $errors->first('email') }}
					              	</div>
					              @endif
					            </div>

			            	</div>

			            </div>



			            <div class="row">
			              <div class="col-sm-6">
			                <div class="form-group">
			                  <label for="">Senha</label>
			                  <input class="form-control" placeholder="Senha Minimo de 6 digitos" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
			                  
			                  @if ($errors->has('password'))
			                    <span class="help-block form-text with-errors form-control-feedback" role="alert">
			                        <strong>{{ $errors->first('password') }}</strong>
			                    </span>
			                   @endif

			                </div>
			              </div>
			              <div class="col-sm-6">
			                <div class="form-group">
			                  <label for="">Confirmar Senha</label>
			                  <input class="form-control" placeholder="Confirmar Senha" type="password" name="password_confirmation" required id="password-confirm">
			                </div>
			              </div>
			            </div>


			            <div class="form-buttons-w text-right">
			              <button class="btn btn-primary" type="submit">Cadastrar Anunciante</button>
			            </div>


			          </div>

			        </div>
			      </div>
			    </form>
			  </div>
				

	@endif

	@isset($list)

				@switch($list)

					@case('anunciantes')

						<h6 class="element-header">
					      Imobiliárias e Corretores Cadastrados
					    </h6>

					    <div class="element-box">


						    <div class="table-responsive">
						    
							    <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
			                      
			                      <thead>
			                        	<tr>
			                        	<th>id</th><th>Tipo </th><th> Nome </th> <th> Email</th><th>Telefone Fixo</th>
			                        	<th>Ações</th> </tr>
			                      </thead>

		                        <tfoot>
			                          <tr>
			                          	<th>id</th><th>Tipo </th><th> Nome </th> <th> Email</th><th>Telefone Fixo</th><th>Ações</th>
			                          </tr>
		                        </tfoot>			                      

				                    <tbody>

										@foreach($anunciantes as $key => $usuario )

											<tr>
												<td>{{ $usuario->id }}</td>
												<td>{{ $usuario->tipo }}</td>
												<td>{{ $usuario->nome }}</td>
												<td>{{ $usuario->email }}</td>
												<td>{{ formataPhone($usuario->phone_fixo) }}</td>
												<td>

													<a href="{{ route('options.admin', ['update_anunciante', $usuario->id ] ) }}" alt="Editar" class="btn_icon btn-lg" data-toggle="tooltip" data-placement="top" title="Editar">
														&nbsp
														<i class="picons-thin-icon-thin-0002_write_pencil_new_edit"></i>&nbsp 
													</a>												
														
												</td>
												
											</tr>											
											
										@endforeach

									</tbody>	

								</table>
							
							</div>	

						</div>


					@break


					@case('simples')

					<h6 class="element-header">
				      Usuários Básicos e Administrativos
				    </h6>

					    <div class="element-box">


						    <div class="table-responsive">
						    
							    <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
			                      
			                      <thead>
			                        	<tr>
			                        	<th>id</th><th>Tipo </th><th> Nome </th> <th> Email</th><th>Telefone Fixo</th>
			                        	<th>Ações</th> </tr>
			                      </thead>

		                        <tfoot>
			                          <tr>
			                          	<th>id</th><th>Tipo </th><th> Nome </th> <th> Email</th><th>Telefone Fixo</th><th>Ações</th>
			                          </tr>
		                        </tfoot>			                      

				                    <tbody>

										@foreach($usuarios as $key => $usuario )

											<tr>
												<td>{{ $usuario->id }}</td>
												<td>{{ $usuario->role }}</td>
												<td>{{ $usuario->name }}</td>
												<td>{{ $usuario->email }}</td>
												<td>{{ $usuario->phone }}</td>
												<td>

													<a href="" alt="Editar" class="btn_icon">
														&nbsp<i class="picons-thin-icon-thin-0002_write_pencil_new_edit"></i>&nbsp 
													</a>
													
													<a href="" alt="Detalhes" class="btn_icon">
														&nbsp<i class="picons-thin-icon-thin-0043_eye_visibility_show_visible"></i>&nbsp
													</a>
														
												</td>
												
											</tr>											
											
										@endforeach

									</tbody>	

								</table>
							
							</div>	

						</div>


					@break



				@endswitch

	@endif

	@isset($option)

		@if($option == 'update_anunciante')

			<h6 class="element-header">
		      Editar Usuário
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

				<form id="formValidate" method="POST" action="{{ route('update.anunciante') }}">
					@csrf
					<input type="hidden" name="id" value="{{ $usuario->id }}"/>

					<div class="row">

						<div class="col-sm-2">
			                <div class="form-group">
			                  <label> Tipo de Anunciante</label>

			                  	<select class="form-control" required="required" name="tipo" data-error="Você precisa escolher um perfil pro anunciante.">
			                  		@if($usuario->tipo == 'imobiliaria')
						                <option value="imobiliaria" selected="selected">
						                  	Imobiliária
						                </option>
						                <option value="corretor">
						                  	Corretor
						                </option>
					                @else
						                <option value="imobiliaria" >
						                  	Imobiliária
						                </option>
						                <option value="corretor" selected="selected">
						                  	Corretor
						                </option>
					                @endif
			              		</select>
			              		<div class="help-block form-text with-errors form-control-feedback"></div>
			                </div>
			            </div>

			            <div class="col-sm-4">
			            	
			            	<div class="form-group">
			            		<label>CPF</label>
			            		<input type="tel" name="cpf" value="{{ $usuario->cpf }}" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" required data-error="CPF inválido!" maxlength="11">
			            		@if ($errors->has('cpf'))
				              		<div class="help-block form-text with-errors form-control-feedback">
				              		{{ $errors->first('cpf') }}
				              		</div>
				              	@endif			            		
			            	</div>
			            </div>

			            <div class="col-sm-6">
			                <div class="form-group">
			                  <label>Nome Completo</label>
			                  <input class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="Nome Completo ou Razão Social" type="text" 
			                  required="required" name="nome" data-error="Preenchimento inválido!" data-minlength="6" value="{{ $usuario->nome }}">
			                  <div class="help-block form-text with-errors form-control-feedback"></div>
			                </div>
			              </div>
			        </div>

		            <div class="row">

		              <div class="col-sm-4">
		                <div class="form-group">
		                  <label for=""> Telefone</label>
		                  <input class="form-control{{ $errors->has('phone_fixo') ? ' is-invalid' : '' }}" placeholder="Telefone Comercial" type="tel" maxlength="10" name="phone_fixo" required="required" data-error="Informe um telefone válido!" 
		                  value="{{ $usuario->phone_fixo }}">
		                  <div class="help-block form-text with-errors form-control-feedback"></div>
		                </div>
		              </div>
		              <div class="col-sm-4">
		                <div class="form-group">
		                  <label for="">Celular</label>
		                  <input class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" placeholder="Celular ou Whatsapp" type="tel" maxlength="11" name="celular" value="{{ $usuario->celular }}">
		                </div>
		              </div>

		              <div class="col-sm-4">
		              	<div class="form-group">
		              		<label for="">CRECI</label>
		              		<input type="tel" name="creci" placeholder="CRECI OPCIONAL" class="form-control{{ $errors->has('creci') ? ' is-invalid' : '' }}" value="{{ $usuario->creci }}">
		              	</div>
		              </div>

		            </div>

		            <div class="row">
			 				
			 				<div class="col-sm-6">
					             <div class="form-group">
									<label for="">CEP Comercial</label>
					                  <div class="input-group">
					                    <div class="input-group-prepend">
					                      <div class="input-group-text">
					                         <div class="os-icon os-icon-home"></div>
					                      </div>
					                    </div>
					                    <input type="tel" name="cep" maxlength="8"  class="form-control" required="required"  data-error="CEP precisa no minimo de 8 digitos" id="cep" value="{{ $usuario->cep }}"/>		                    
					                  </div> 
					                  <div class="help-block form-text with-errors form-control-feedback">
					                   </div>
					            </div>
				            </div> 

				            <div class="col-sm-6">
				            	<div class="form-group">
				            		<div class="alert alert-success" role="alert">
									  <h6 class="alert-heading">Preencha o CEP!</h6>
									   <p>Prencha novamente o cep, somente em caso de mudança de endereço. A alteração da cidade está vinculada ao CEP</p>									  						 
									</div>
				            	</div>
				            </div>

		            </div>

		            <div class="row">

			            <div class="col-sm-4">
			            	<div class="form-group">
			            		<label for="">Rua</label>
			            		<input type="text" name="logradouro" required="required" class="form-control{{ $errors->has('logradouro') ? ' is-invalid' : '' }}" id="rua" value="{{ $usuario->logradouro }}">
			            	</div>
			            </div>

			            <div class="col-sm-2">
			            		<div class="form-group">
				            		<label for="">Numero</label>
				            		<input type="tel" name="unidade" required="required" class="form-control{{ $errors->has('unidade') ? ' is-invalid' : '' }}" data-error="Número Obrigatório" value="{{ $usuario->unidade }}">
				            		<div class="help-block form-text with-errors form-control-feedback"></div>
				            	</div> 
			            </div>   

			            <div class="col-sm-3">
			            	<div class="form-group">
			            		<label for="">Cidade</label>
			            		<input type="text" readonly="readonly" name="cidade" required="required" class="form-control{{ $errors->has('cidade') ? ' is-invalid' : '' }} " id="cidade" value="{{ $usuario->cidade }}">
			            	</div>
			            </div> 

			  	        <div class="col-sm-3">
			            	<div class="form-group">
			            		<label for="">Bairro</label>
			            		<input type="text" name="bairro" required="required" class="form-control{{ $errors->has('bairro') ? ' is-invalid' : '' }}" id="bairro" value="{{ $usuario->bairro }}">
			            	</div>
			            </div> 
		            	
		            </div>

		        <br/>
            	<h6>Informações de Plano e Login</h6>
            	<hr/>

		            <div class="row">

		            	<div class="col-sm-4">
			            	<div class="form-group">
			              
				              	<label for=""> Plano de anuncios</label>

				              	<select class="form-control" name="plano_id">
					            
					            @if( !empty($usuario->plano) )    
					                <option value="{{$usuario->plano_id}}">
					                	{{$usuario->plano->nome}}
					                </option>
					                
					                @foreach($planos as $plano)

					                	@if($plano->id !== $usuario->plano_id )
							                <option value="{{ $plano->id }}" >
							                  {{ $plano->nome }}
							                </option>
						                @endif

					                @endforeach

					             @else
						             @foreach($planos as $plano)
						             	<option value="{{ $plano->id }}" >
							                  {{ $plano->nome }}
							            </option>
						             @endforeach
					             @endif   

				              	</select>

			            	</div>
		            	</div>

		            	<div class="col-sm-4">		            		
		            		<div class="form-group">
				              <label for=""> Email</label>
				              <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Digite o email" type="email" required="required" data-error="Email é requerido!" name="email" value="{{ $usuario->email }}">
				              @if ($errors->has('email'))
				              	<div class="help-block form-text with-errors form-control-feedback">
				              	{{ $errors->first('email') }}
				              	</div>
				              @endif
				            </div>
		            	</div>

		            	<div class="col-sm-4">
		            		<div class="form-group">
				              <label for="">Site</label>
				              <input type="text" name="site" class="form-control{{ $errors->has('site') ? ' is-invalid' : '' }}" placeholder="Site da Imobiliária ou Corretor" value="{{ $usuario->site }}">
				          	</div>
		            	</div>

		            </div>

			      	<div class="form-buttons-w text-right">
			            <button class="btn btn-primary btn-lg" type="submit">Atualizar Cadastro</button>
			        </div>
					
				</form>
		    	
		    </div>

		@elseif($option == 'update_user')



		@endif

	@endif


</div>


	
@stop

@section('footer_scripts')

 <script type="text/javascript" src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}" >  </script>
 <script type="text/javascript" src="{{ asset('admin/js/busca_cep.js') }}" >  </script>

@stop