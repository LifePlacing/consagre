@extends('layouts/wizard')
@section('title')
    Anunciar
    @parent
@stop
<!-- Scripts Globais -->
@section('header_styles')
    <link rel="stylesheet" href="{{asset('css/form-elements.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}"> 
@stop
<!-- Scripts Globais -->

@section('wizard')
	@include('app.steps.master')
@endsection

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

<div class="container">
           <h2>Escolha um Plano</h2>

<div class="linha">
    <div class="valores">
            <form action="/anunciar/finish" method="post">
                {{ csrf_field() }}

                <div class="item">
                        <div class="card">
                        <div class="card-header">
                            Corretor de Imóveis
                        </div>
                        <div class="card-body">
                        <h5 class="card-title">Plano VIP</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Quant. de Anuncios</th>
                                                <td>Até 10 anuncios</td>
                                                <td><i class="fa fa-check"></i></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Fotos</th>
                                                <td>Até 10 fotos por anuncio</td>
                                                <td><i class="fa fa-check"></i></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Destaques</th>
                                                <td>2 Anuncios destaque</td>
                                                <td><i class="fa fa-check"></i></td>
                                        </tr> 
                                        <tr>                                          
                                        <th scope="row">Captação</th>
                                            <td>não incluso</td>
                                            <td><i class="fa fa-times"></i></td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Multiusuarios</th>
                                            <td>não incluso</td>
                                            <td><i class="fa fa-times"></i></td>
                                        </tr>                                            
                                    </tbody>
                                </table>
                            </div>                        
                              <a href="#" class="btn btn-plano">Assinar</a>
                        </div>
                        </div>
                </div>
                <div class="item">
                        <div class="card">
                        <div class="card-header">
                            Imobiliárias
                        </div>
                        <div class="card-body">
                        <h5 class="card-title">Plano PREMIUM</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Quant. de Anuncios</th>
                                                <td>Anuncios Ilimitados</td>
                                                <td><i class="fa fa-check"></i></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Fotos</th>
                                                <td>Até 10 fotos por anuncio</td>
                                                <td><i class="fa fa-check"></i></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Destaques</th>
                                                <td>Destaques Premium</td>
                                                <td><i class="fa fa-check"></i></td>
                                        </tr> 
                                        <tr>                                          
                                        <th scope="row">Captação</th>
                                            <td>Captação para Revenda</td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Multiusuarios</th>
                                            <td>Até 3 usuarios</td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>                                            
                                    </tbody>
                                </table>
                            </div> 
                                               
                            <a href="#" class="btn btn-plano">Assinar</a>
                        </div>
                        </div> 
                 </div> 
                 
                    <button class="btn btn-plano" type="submit">
                        Continuar sem destaque
                    </button>                 

            </form>
            
    </div>


    <div class="modelo">

        <h2>Dados do Anuncio</h2>

            <div class="row">

                 @if(isset($imovel)) 

                    <div class="col">

                        <div class="table-responsive">
                            <table class="table table-borderless ">
                                <tbody>
                                    <tr>
                                        <th><h5>Imagens do Anuncio</h5></th>
                                    </tr>
                                    <tr>
                                        <td>

                                        @foreach($imovel->medias as $key => $media)
                                        <img class="img-thumbnail img-fluid mx-auto d-flex flex-row img-amostra" src="{{asset($media)}}" >
                                        @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="col-md-6 col-sm-12">   

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                       <th colspan="4"> <h5>Dados do Imovél</h5> </th>
                                    </tr>
                                </thead>
                                
                                    <tr>
                                        <th>Meta:</th>         
                                        <td colspan="3">{{$imovel->meta}}</td>
                                    </tr>
                                    <tr>
                                        <th>Titulo:</th>
                                        <td colspan="3">{{$imovel->titulo}}</td>
                                    </tr>
                                    <tr>
                                        <th>Descrição:</th>
                                        <td colspan="3">{{$imovel->descricao}}</td>
                                    </tr>

                                        <tr>
                                            <tr>
                                                <th scope="row">Quartos</th>
                                                <th scope="row">Garagem</th>
                                                <th scope="row">Banheiros</th>
                                                <th scope="row">Suites</th>
                                            </tr>
                                            <tr>
                                                <td>{{$imovel->quartos}}</td> 
                                                <td>{{$imovel->garagem}}</td>
                                                <td>{{$imovel->banheiros}}</td>
                                                <td>{{$imovel->suites}}</td>
                                            </tr>                                        
                                        </tr>

                                        <tr>
                                            <th>Area Util:</th>
                                            <td>{{$imovel->area_util}} m2</td>
                                            <th>Area Total:</th>
                                            <td>{{$imovel->area_total}} m2</td>                                        
                                        </tr>    




                            </table> 
                        </div>


                            <div class="table-responsive">

                            <table class="table table-bordered ">
                                <thead class="thead-light">
                                    <tr>
                                       <th colspan="4"> 
                                            <h5>Endereço do Imóvel</h5> 
                                        </th>
                                    </tr>
                                </thead>  

                                <tr>                                   
                                    <th>CEP: </th>
                                    <td colspan="3">{{$imovel->cep}}</td>          
                                </tr> 

                                <tr>
                                    <th>Cidade: </th>
                                    <td>{{$imovel->localidade}}</td>
                                    <th>Estado: </th>
                                    <td>{{$imovel->estado}}</td>
                                </tr>  
                                <tr>
                                    <th>Rua / Avenida: </th>
                                    <td colspan="3">{{$imovel->logradouro}}</td>
                                </tr>  
                                <tr>
                                    <th>Bairro: </th>
                                    <td colspan="3">{{$imovel->bairro}}</td>
                                </tr>                         
                                
                            </table>
                            </div>
                        
                    </div>

                @endif
            </div>

    </div>

</div>
</div>
@stop<!-- Fim do conteudo-->


@section('footer_scripts')
<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 
<script type="text/javascript">
    $("#cpf").mask("999.999.999-99");
    $("#phone").mask("(00) 00000-0000");
</script> 
@stop