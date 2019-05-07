@extends('users.layouts.default')

<!-- Inicio do conteudo-->
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="content">

        <div class="container-fluid">

            <div class="row">

            	<div class="card">

            		 <div class="header">
                        
                        

                     </div>

                     <div class="content">
            		 	
            		 	<div class="row">

                            
                            <h4 class=" title col-sm-12 hidden-xs"> 
                                Assunto: <strong> {{ $mensagem->imovel->titulo }} </strong> 
                            </h4>

                            <div class="col-sm-12">

                                <small>
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                    <strong>{{ $mensagem->nome_remetente }}</strong> (
                                        {{ $mensagem->email_remetente }} )
                                </small>

                            </div>
                            
                            
                                
                            <div class="col-sm-8 col-sm-offset-2 corpo-msg">
                            
                                <div class="panel panel-default">

                                    <div class="panel-body">

                                    <p class="lead"> {{ $mensagem->nome_remetente }} - ( {{ $mensagem->email_remetente }} ) </p>   

                                    @if(isset($mensagem->telefone) && !empty($mensagem->telefone))
                                        <p>Olá meu telefone é: {{ $mensagem->telefone }}</p>
                                    @endif 
                                       
                                    <p>
                                        Interesse: 
                                        <a href="{{route('index')}}/{{slugTitulo($mensagem->imovel->titulo)}}/{{$mensagem->imovel_id}}/{{$mensagem->imovel->meta}}/{{ $mensagem->imovel->cidade->slug }}">
                                                {{ $mensagem->imovel->titulo }}
                                        </a>

                                    </p>

                                    <hr>

                                    <p> {{ $mensagem->msg }} </p>                                

                                    </div>  

                                    <div class="panel-footer">
                                        <small>
                                            Esta mensagem foi enviado a você para informar que o sr(a) {{ $mensagem->nome_remetente }}, entrou no seu anúncio e tem dúvidas ou precisa que entre em contato.
                                        </small>
                                    </div>                          
                                
                                </div>  

                            </div>                        

            		 	</div>
            		 
            		</div>

                </div>
                
            </div>
        </div>
    </div>

@stop