@extends('layouts/head')
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


   

    <div class="linha">

        <div class="h2">
            <h2>Confira os Dados do Anúncio</h2>
            <span></span>
        </div>

        <div class="modelo">            

                <div class="row">

                     @if(isset($imovel)) 

                        <div class="col">

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>                                        
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

                                <table class="table table-borderless">
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

                                <table class="table table-borderless">
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

        <div class="valores">

                <form action="/anunciar/finish" method="post">
                    {{ csrf_field() }}
                   
                        <button class="btn btn-plano" type="submit">
                           Anunciar Grátis
                        </button>                 

                </form>
                
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