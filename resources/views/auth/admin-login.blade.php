@extends('layouts.auth')

@section('content')

<div class="container">

    <div class="justify-content-center form-adm ">

        <div class="col-md-12 col-sm-12 col-xs-12" id="auth">               

            <a class="navbar-brand" href="{{ url('/') }}" style="width: 100%; height: 150px;">            
                <img src="{{asset('imagens/logo-page-login.svg')}}" style="min-height: 130px;">
            </a>

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

            <form method="POST" action="{{ route('submit.login.admin') }}" >
                    
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

                        <a class="btn-link" href="{{ route('password.request') }}" style="color: #fff">
                            {{ __('Esqueceu sua senha?') }}
                        </a>
                    </div>
                </div>

            </form>         

        </div>

    </div>

</div>
@endsection
