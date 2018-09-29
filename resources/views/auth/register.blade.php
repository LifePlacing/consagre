@extends('layouts.auth')

@section('content')
<div class="container">

    <div class="justify-content-center">

        <div class="col-md-12 col-sm-12 col-xs-12" id="auth">

            <a class="navbar-brand" href="{{ url('/') }}">            
                <img src="{{asset('imagens/logo-page-login.svg')}}">
            </a>   
                    
            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>


                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                
                <div class="form-group col-md-7 offset-md-3">                 
                    <legend>Sexo</legend>  

                <div class="radio col-md-10 offset-md-2">                 
                               
                        <div class="col-md-6">
                        <input type="radio" name="sexo" value="masculino" checked="checked" id="male" 
                        class="form-control ">
                        <label for="male" class="col-form-label" >Masculino</label>
                        </div>

                        <div class="col-md-6">
                        <input type="radio" name="sexo" value="feminino" id="female" class="form-control col-md-4">
                        <label for="female" class="col-form-label" >Feminino</label>
                        </div>
                </div>
                </div> 


                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-login">
                            {{ __('Cadastrar') }}
                        </button>

                    </div>
                </div>
            </form>
        <hr>
            <div class="form-group row novo">

               <h5>  Já tem cadastro no site ? </h5>

                <a href="{{ route('login') }}" class="btn btn-danger">
                    {{ __('Acesse sua Conta') }}
                </a>

            </div>   


        </div>
    </div>
</div>
@endsection
