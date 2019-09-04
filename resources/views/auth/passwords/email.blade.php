@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="col-md-10 col-sm-12 col-xs-12" id="auth">

            <a class="navbar-brand" href="{{ url('/') }}">           
                <img src="{{asset('imagens/logo-page-login.svg')}}">         </a>

            <h4>{{ __('Recuperar Senha') }}</h4>


            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" 
            aria-label="{{ __('Reset Password') }}">
                @csrf

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

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-login">
                            {{ __('Redefinir Senha') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
