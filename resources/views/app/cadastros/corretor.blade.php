@extends('layouts.head')

@section('breadcrumbs')
	@parent
	@include('app.inc.breadcrumbs')
@endsection


@section('content')

<div class="container">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif



	<div class="d-inline-flex">
        

	<div class="col-md-8">


				<h2 class="laranja">Anúncios para Corretores na Consagre Imoveis</h2>
				<p class="text-muted">Preencha o formulário e conheca nossos serviços</p>


			<form method="POST" action="{{ route('anunciante.store', 'corretor') }}" id="anunciantes">
				
				@csrf

                <div class="form-group row">

                    <div class="col-md-8">

                    	 <label for="nome" class="col-form-label text-md-right">{{ __('Nome do Corretor') }}</label>

                        <input id="nome" type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ old('nome') }}" required>


                        @if ($errors->has('nome'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nome') }}</strong>
                            </span>
                        @endif
                    </div>                    

                    <div class="col-md-4">
                    	<label for="creci" class="col-form-label text-md-right">{{ __('CRECI') }}</label>
                        <input id="creci" type="text" class="form-control{{ $errors->has('creci') ? ' is-invalid' : '' }}" name="creci" value="{{ old('creci') }}">

                        @if ($errors->has('creci'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('creci') }}</strong>
                            </span>
                        @endif

                    </div>

                </div>


                <div class="form-group row">

                    <div class="col-md-8">

                    	 <label for="email" class="col-form-label text-md-right">{{ __('Email') }}</label>

                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>


                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>                    

                    <div class="col-md-4">
                    	<label for="telefone" class="col-form-label text-md-right">{{ __('DDD + Telefone') }}</label>
                        <input id="telefone" type="tel" class="form-control{{ $errors->has('phone_fixo') ? ' is-invalid' : '' }}" name="phone_fixo" value="{{ old('phone_fixo') }}" required>                        

                        @if ($errors->has('phone_fixo'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone_fixo') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-md-8">

                    	 <label for="site" class="col-form-label text-md-right">{{ __('Site') }}</label>

                        <input id="site" type="text" class="form-control{{ $errors->has('site') ? ' is-invalid' : '' }}" name="site" value="{{ old('site') }}">

                        @if ($errors->has('site'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('site') }}</strong>
                            </span>
                        @endif


                    </div>                    

                    <div class="col-md-4">
                    	<label for="celular" class="col-form-label text-md-right">{{ __('DDD + Celular') }}</label>
                        <input id="celular" type="tel" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celular" value="{{ old('celular') }}">
                        @if ($errors->has('celular'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('celular') }}</strong>
                            </span>
                        @endif


                    </div>

                </div>
				
				<div class="form-group row">
                	
                	<div class="col-md-3">
                    	<label for="cep_imobi" class="col-form-label text-md-right">{{ __('CEP') }}</label>
                        <input id="cep_imobi" type="text" class="form-control{{ $errors->has('cep') ? ' is-invalid' : '' }}" name="cep" value="{{ old('cep') }}" required 
                        size="8" maxlength="8"  onblur="pesquisacep(this.value);">


                        @if ($errors->has('cep'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('cep') }}</strong>
                            </span>
                        @endif
                    </div>

                	<div class="col-md-6">
                    	<label for="rua_imobi" class="col-form-label text-md-right">{{ __('Endereço') }}</label>
                        <input id="rua_imobi" type="text" class="form-control{{ $errors->has('logradouro') ? ' is-invalid' : '' }}" name="logradouro" value="{{ old('logradouro') }}" required>


                        @if ($errors->has('logradouro'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('logradouro') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-3">
                    	<label for="number_imobi" class="col-form-label text-md-right">{{ __('Numero') }}</label>
						<input id="number_imobi" type="text" class="form-control{{ $errors->has('unidade') ? ' is-invalid' : '' }}" name="unidade" value="{{ old('unidade') }}" required>                    	
                    </div>



            	</div>

                <div class="form-group row">

                    <div class="col-md-8">

                    	 <label for="city_imobi" class="col-form-label text-md-right">{{ __('Cidade') }}</label>

                        <input id="city_imobi" type="text" class="form-control{{ $errors->has('cidade') ? ' is-invalid' : '' }}" name="cidade" value="{{ old('cidade') }}" required>


                        @if ($errors->has('cidade'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('cidade') }}</strong>
                            </span>
                        @endif
                    </div>                    

                    <div class="col-md-4">
                    	<label for="bairro_imobi" class="col-form-label text-md-right">{{ __('Bairro') }}</label>
                        <input id="bairro_imobi" type="text" class="form-control{{ $errors->has('bairro') ? ' is-invalid' : '' }}" name="bairro" value="{{ old('bairro') }}" required>


                        @if ($errors->has('bairro'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('bairro') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>

                <div class="form-group row">

                	 <div class="col-md-12">
                	 	<label for="sobre" class="col-form-label text-md-right">{{ __('Sobre') }}</label>
                	 	<textarea rows="4" class="form-control{{ $errors->has('sobre') ? ' is-invalid' : '' }} char-count" name="sobre" id="sobre" maxlength="200">
                        {{ old('sobre') }}     
                        </textarea>
                        <p class="text-muted"><small><span name="sobre">200</span></small> caracteres restantes</p>

                        @if ($errors->has('sobre'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sobre') }}</strong>
                            </span>
                        @endif

                	 </div>

                </div>


                <div class="form-group row ">
                    <div class="col-md-6 ">
                        <button type="submit" class="btn btn-primary" style="background: rgb(0,122,165)!important;color: #fff!important; width: 80%!important; border: 1px solid rgb(0,122,165)!important;">
                            {{ __('Enviar') }}
                        </button>

                    </div>
                </div>


			</form>

</div>


@endsection

@section('sidebar-right')	

	<div class="col-md-4">

		<br>
		<span class="text-informativo">			
			<p class="text-muted">
			Se você ainda não é cliente, faça uma experiência por 30 dias gratuitos, sem compromisso.
			Preencha o formulário e conheça nossos serviços.
			Os dados de captação ainda estão sendo atualizados, mas você poderá anunciar seus imoveis totalmente 
			grátis.</p>
		</span>
		
		<hr>
		<h3 class="azul"> Duvidas? Entre em contato </h3>

		<ul class="list-group">

			<li class="list-group-item text-muted">

			<p>	<i class="fa fa-envelope"></i> <span>contato@consagreimoveis.com.br </span></p>
			<p>	<i class="fa fa-whatsapp"></i> <span>(13)99131-2716</span> | <i class="fa fa-phone"></i>
			<span>(13) 3353-8109 </span></p>

			<button class="btn btn-danger" style="width: 100%!important;">Entrar em Contato</button>

			</li>

		</ul>

		<br>

		<h3 class="azul"> Horário de Atendimento </h3>

		<p>De segunda a sexta-feira<br>das 09h às 18 horas. </p>

		<hr>




	</div>

	</div>

</div>

@endsection

@section('footer_scripts')

<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 
<script type="text/javascript">
    $("#InputPhone").mask("(00) 00000-0000");
    $("#telefone").mask("(00) 0000-0000");
    $("#celular").mask("(00) 00000-0000");
</script>

@endsection