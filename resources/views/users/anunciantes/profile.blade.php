@extends('users.layouts.default')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class=" col-xs-12 col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar Perfil</h4>
                            </div>
                            <div class="content">
								<form method="post" action="{{ route('anunciante.profile.update') }}" autocomplete="off">
                                	@csrf

                                    <div class="row">

                                    	<div class="col-xs-12 col-md-4">
                                    		<div class="form-group">
                                                <label for="tipo">Tipo</label>
                                                <input type="text" disabled class="form-control"  value="{{ Auth::user()->tipo }}" id="tipo">	
                                    		</div>
                                    	</div>

                                        <div class="col-xs-12 col-md-4">

                                            <div class="form-group">

                                                @if( isset( Auth::user()->cpf ) && !empty( Auth::user()->cpf ))
                                                <label>CPF (disabled)</label>
                                                <input type="text" class="form-control" 
                                                disabled placeholder="CPF" value="{{ Auth::user()->cpf }}">
                                                @else
                                                <label>CPF</label>
                                                <input type="text" class="form-control {{ $errors->has('cpf') ? ' is-invalid' : '' }}" placeholder="CPF" name="cpf" maxlength="14" required="required">

                                                @if ($errors->has('cpf'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('cpf') }}</strong>
                                                    </span>
                                                @endif

                                                @endif

                                            </div>

                                        </div>

                                         <div class="col-xs-12 col-md-4">

                                            <div class="form-group">

                                                <label>CRECI</label>
                                                <input type="text" class="form-control {{ $errors->has('creci') ? ' is-invalid' : '' }}" placeholder="CRECI" name="creci" maxlength="14" value="{{ Auth::user()->creci }}">

                                                @if ($errors->has('creci'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('creci') }}</strong>
                                                    </span>
                                                @endif


                                            </div>

                                        </div>                                       

                                    </div>

                                    <div class="row">
                                    	<div class="col-xs-12 col-md-12">
                                    		<div class="form-group">

                                    			@if(Auth::user()->tipo == 'corretor')
                                                
	                                                <label>Nome</label>
	                                                <input type="text" class="form-control {{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="Nome" value=" {{ Auth::user()->nome }}" name="nome">
	                                                @if ($errors->has('nome'))
	                                                    <span class="invalid-feedback" role="alert">
	                                                        <strong>{{ $errors->first('nome') }}</strong>
	                                                    </span>
	                                                @endif

                                    			@else

	                                                <label>Empresa</label>
	                                                <input type="text" class="form-control {{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="Nome" value=" {{ Auth::user()->nome }}" name="nome">

	                                                @if ($errors->has('nome'))
	                                                    <span class="invalid-feedback" role="alert">
	                                                        <strong>{{ $errors->first('nome') }}</strong>
	                                                    </span>
	                                                @endif


                                    			@endif

                                    		</div>
                                    	</div>
                                    </div>

                                    <div class="row">

                                        <div class="col-xs-12 col-md-6">

                                            <div class="form-group">

                                                <label>Telefone Fixo</label>

                                                <input type="text" class="form-control {{ $errors->has('phone_fixo') ? ' is-invalid' : '' }}" placeholder="Telefone Fixo" value="{{ Auth::user()->phone_fixo }}" id="phone_fixo" name="phone_fixo">

                                                @if ($errors->has('phone_fixo'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone_fixo') }}</strong>
                                                    </span>
                                                @endif


                                            </div>

                                        </div>

                                        <div class="col-xs-12 col-md-6">

                                            <div class="form-group">
                                                <label>Celular ou Whatsapp</label>

                                                <input type="text" class="form-control {{ $errors->has('celular') ? ' is-invalid' : '' }}" placeholder="Celular ou Whatsapp" value="{{ Auth::user()->celular }}" id="celular" name="celular" required="required">

                                                @if ($errors->has('celular'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('celular') }}</strong>
                                                    </span>
                                                @endif


                                            </div>

                                        </div>


                                    </div>

                                    <div class="row">

                                    	<div class=" col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" disabled class="form-control" placeholder="Email" value="{{ Auth::user()->email }}" name="email" id="email">
                                            </div>
                                        </div>
                                        <div class=" col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
                                                <label for="site">Site</label>
                                                <input type="text" class="form-control" placeholder="Site ou Blog" value="{{ Auth::user()->site }}" name="site" id="site">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class=" col-xs-12 col-md-12">
                                            <div class="form-group">
                                                <label>Sobre</label>
                                                <textarea rows="5" class="form-control char-count" id="sobre" placeholder="Uma breve descrição sobre você ou sua empresa | Máximo 100 caracteres" name="sobre" maxlength="100">{{ Auth::user()->sobre }}</textarea>
                                                <p class="text-muted"><small><span name="sobre">100</span></small> caracteres restantes</p>
                                            </div>
                                        </div>
                                    </div>

									<button type="submit" class="btn btn-info btn-fill pull-right">Atualizar Perfil</button>
                                    <div class="clearfix"></div>

                                </form>
                            </div>
                        </div>
                    </div> 

                    <div class="col-xs-12 col-md-4">
                    	<div class="card card-user">
                    		
                    		<div class="image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400"/>
                            </div>

                            <div class="content">

                                <div class="author">
                                	<form enctype="multipart/form-data" id="foto_perfil" method="post" action="{{ route('anunciante.profile.avatar') }}">
                                		@csrf
                                		<input type="file" name="foto" id="upload" />
                                	</form>

                                     <a href="javascript:void(0)"  id="upload_link">
                                    <img id="avatar" class="avatar border-gray" 
                                    src="{{ Auth::user()->logo == '' ? asset('users/img/faces/face-3.jpg') : asset( Auth::user()->logo ) }}" />
                                    </a>

                                      <h4 class="title">{{ Auth::user()->nome }} 
                                      	 <br />
                                         <small>{{ Auth::user()->celular == '' ? ' Coloque seu celular ou Whatsapp ' : formataPhone( Auth::user()->celular )  }}</small>
                                      </h4>
                                    
                                </div>
                                <i><p class="description text-center">  {{ Auth::user()->sobre == '' ? 'Fale algo sobre você...' :  Auth::user()->sobre }}                                	
                                </p></i>
                            </div>




                    	</div>
                    </div>


                </div>   

            </div>
        </div>


@endsection