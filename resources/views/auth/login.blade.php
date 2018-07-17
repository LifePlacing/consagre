@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="justify-content-center ">
        <div class="col-md-12 col-sm-12 col-xs-12" id="auth">               

            <a class="navbar-brand" href="{{ url('/') }}">            
                <img src="{{asset('imagens/logo-page-login.svg')}}">
            </a>

            <form method="POST" action="{{ route('login') }}" 
                aria-label="{{ __('Login') }}">
                    
                    @csrf

                <div class="form-group row">

                    <label for="email" class="col-sm-4 col-form-label text-md-right">
                    {{ __('E-mail') }}
                    </label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

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
                    <div class="col-md-6 offset-md-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Mantenha-me conectado') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-login">
                            {{ __('Login') }}
                        </button>

                        <a class="btn-link" href="{{ route('password.request') }}">
                            {{ __('Esqueceu sua senha?') }}
                        </a>
                    </div>
                </div>
            </form>

        <hr>
            <div class="form-group row novo">

               <h5>  Ainda não tem uma Conta ? </h5>

                <a href="{{ route('register') }}" class="btn btn-danger">
                    {{ __('Cadastre-se aqui') }}
                </a>

            </div>            

        </div>
    </div>
</div>
@endsection
