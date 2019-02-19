@extends('layouts.auth')

@section('content')

<div class="container">

    <div class="col-md-6 col-xs-12 col-sm-10" style="margin: 0 auto;">

        <div id="auth">

            <a class="navbar-brand" href="{{ url('/') }}">            
                <img src="{{asset('imagens/logo-page-login.svg')}}">
            </a> 

            <div class="card">

             	<div class="card-body text-center">

               

                	 <h4 class="card-title ">Olá {{ $nome }} <br>Seja Bem Vindo! </h4>

                @if($pass == null || empty($pass))

                	 <p>Cadastre uma senha para acesso ao painel de anuncios</p>

                <div class="card-text" >
                    
                    <form method="POST" action="{{ route('anunciante.ativar.update') }}" 
                    aria-label="{{ __('Cadastrar Senha de Anunciante') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Seu E-Mail') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control"  value="{{ $email ?? old('email') }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                <span id="passwordHelpBlock" class="form-text text-muted" >        
        							
        						</span>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cadastrar Senha') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

                @else

    				<div class="alert alert-danger" role="alert">
    				  	Este link já expirou!!
    				</div>

                @endif

            </div>

        </div>


        </div>
    </div>
</div>
@endsection