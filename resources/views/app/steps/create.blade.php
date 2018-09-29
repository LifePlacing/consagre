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


<div class="container">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form id="anuncie-imovel" name="anuncieimovel" action="/anunciar" role="form" method="POST" class="f1">

    	{{ csrf_field() }}

    <fieldset>
            <h4><i class="fa fa-suitcase"></i>
            Qual o proposito do seu anuncio:</h4>                      

            <div class="form-group xs-12">
                <div class="btn-group btn-group-toggle col-sm-12" data-toggle="buttons">

                    <label class="btn btn-primary active">
                        <input type="radio" name="meta" value="venda" 
                        checked="checked"> Vender
                    </label>

                    <label class="btn btn-primary">
                        <input type="radio" name="meta" value="aluguel"> Alugar
                    </label>

                </div>
            </div>  

            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="f1-first-name">Nome</label>
                    <input type="text" name="name" placeholder="Seu Nome Completo" class="required form-control" id="name"
                    value="{{ Auth::user()->name }}">
                    <div class="erro-form erro-name"> Preecha Corretamente</div>
                </div>
            </div>   

            <div class="form-row">

	            <div class="form-group col-sm-6 ">
	                <input type="tel" name="cpf" placeholder="Seu CPF" class="cpf form-control col-sm-12 required" tipo_dado="cpf" maxlength="14" id="cpf" value="{{ Auth::user()->cpf }}" onblur="validarCPF(this)">
	                <div class="erro-cpf erro-form"> CPF inválido </div>
	            </div>

	            <div class="form-group col-sm-6 ">
	                <input type="tel" name="phone" placeholder="Seu Telefone" class="phone form-control col-sm-12 required" id="phone" value="{{ Auth::user()->phone }}">
	                <div class="erro-form erro-phone"> Digite um telefone válido </div>
	            </div>

            </div>                     

            <h4><i class="fa fa-home"></i>
            Que tipo de imóvel vai anunciar?</h4>

            <div class="form-row">

                <div class="form-group col-sm-6">

                    <select name="imovel_type_id" class="form-control required" id="imovel_type_id" data-content="Selecione o tipo de imovel" data-placement="top">
                        @if($tipos)
                        <option>Selecione o tipo de imóvel</option>
                        @foreach($tipos as $tipo => $id)
                        <option value="{{ $id }}"> 
                            {{ $tipo }}
                        </option>
                        @endforeach
                        @else
                            <option>Sem Categorias Cadastradas</option>
                        @endif                                           
                        
                    </select>
                </div>

                <div class="form-group col-sm-6 ">

                        <select name="categoria_id" class="form-control required" id="categoria_id" required="required" > 
                            @if($categorias)                                
                                @foreach($categorias as $cat => $id)          
                                    <option value="{{$id}}"> 
                                        {{$cat}}
                                    </option>
                                @endforeach
                            @else
                                <option>Sem Categorias Cadastradas</option>
                            @endif         
                        </select>
                </div>

            </div>  

	        <h4><i class="fa fa-map-marker"></i>
	        Onde fica o seu imóvel?</h4>   

            <div class="form-row">                                     
                <busca-cep></busca-cep>
            </div>	

            <h4><i class="fa fa-clipboard"></i> 
            Informações importantes do Imóvel:</h4>

            <div class="form-row ">

                <div class="form-group col-sm-12 col-md-6">
                    <label for="quartos">Quartos</label>
                    <input type="number" name="quartos" placeholder="0" class="form-control numero required" id="quartos" min="0" value="{{ old('quartos') }}" pattern="[0-9]+$" >
                </div>

                <div class="form-group col-sm-12 col-md-6">
                    <label for="garagem">Vagas de Garagem</label>
                    <input type="number" name="garagem" placeholder="0" class="form-control numero" id="garagem" min="0" value="{{ old('garagem') }}" pattern="[0-9]+$">
                </div>

                <div class="form-group col-sm-12 col-md-6">
                    <label for="banheiros">Banheiros</label>
                    <input type="number" name="banheiros" placeholder="0" class="form-control numero required" id="banheiros" value="{{ old('banheiros') }}" pattern="[0-9]+$" min="0">
                </div>

                <div class="form-group col-sm-12 col-md-6">
                    <label for="suites">Suítes</label>
                    <input type="number" name="suites" placeholder="0" class="form-control numero" id="suites" value="{{ old('suites') }}"
                    pattern="[0-9]+$" min="0">
                </div>

                <div class="form-group col-sm-12 col-md-6">
                    <label for="area_util">Área útil</label>
                    <input type="number" name="area_util" placeholder="0" class="form-control numero required" min="0" id="area_util" value="{{ old('area_util') }}" >
                </div>
                
                <div class="form-group col-sm-12 col-md-6">
                    <label for="area_total">Área Total</label>
                    <input type="number" name="area_total" placeholder="0" class="form-control numero required" min="0" id="area_total" value="{{ old('area_total') }}">
                </div>


            </div> 

            <h4><i class="fa fa-dollar"></i>
                Quanto custa o seu Imóvel?
            </h4>

            <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="preco">
                            <div id="log">Valor total de venda :</div> 
                        </label>
                        <input type="text" name="preco" id="preco" class="col-sm-12 required" value="{{ old('preco') }}" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$">
                    </div>
            </div>

            <h4><i class="fa fa-dollar"></i>
                Taxas ou Impostos :
            </h4>

            <div class="form-row">

                    <div class="form-group col-sm-4">
                        <label for="iptu">
                            <div id="log">Valor do IPTU :</div> 
                        </label>
                        <input type="text" name="iptu" id="iptu" class="col-sm-12" value="{{ old('iptu') }}" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" placeholder="* Campo Opcional">
                    </div>
                    
                    <div class="form-group col-sm-4">
                        <label for="iptu">
                            <div id="log">Valor do CONDOMINIO :</div> 
                        </label>
                        <input type="text" name="condominio" id="condominio" class="col-sm-12" value="{{ old('condominio') }}" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" placeholder="*Campo Opcional">
                    </div>                

            </div> 


            <div class="f1-buttons">
                <button type="submit" id="next" class="btn-wizard btn-next"  data-toggle="toggle" title="Ops!!" data-content="Preencha os campos corretamente"
                >Continuar</button>
            </div>

        </fieldset>

    </form> 

</div>    	

@stop<!-- Fim do conteudo-->


@section('footer_scripts')
<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 
<script type="text/javascript">
    $("#cpf").mask("999.999.999-99");
    $("#phone").mask("(00) 00000-0000");
    $('#preco').mask('#.##0,00', {reverse: true});
    $('#iptu').mask('#.##0,00', {reverse: true});
    $('#condominio').mask('#.##0,00', {reverse: true});
</script> 
@stop