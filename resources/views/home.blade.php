@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('warning') }}
                        </div>
                    @endif
                    Você está Logado! Esta página ainda está em contrução 
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    @can('isProprietario')
                    <div class="proprietario">
                        Eu Sou {{ Auth::user()->user_type }} .
                    </div>
                    @endcan


                    @if(Auth::user()->imovels)

                        <p>Imoveis deste usuario: 

                            @foreach(Auth::user()->imovels as $key => $imovel)

                                {{$imovel->titulo}} <br>
                                {{$imovel->descricao}} <br>

                                @foreach($imovel->media as $medias)

                                    <img class="img-fluid img-thumbnail" src="{{asset('/imagens/imoveis/'.$medias->source)}}">

                                @endforeach

                            @endforeach

                         </p>

                    @endif    

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
