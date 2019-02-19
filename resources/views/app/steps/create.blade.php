@extends('layouts/head')
@section('title')
    Anunciar
    @parent
@stop
<!-- Scripts Globais -->
@section('header_styles')
    <link rel="stylesheet" href="{{asset('css/form-elements.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css?version=1.0')}}"> 
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


    <form id="anuncie-imovel" name="anuncieimovel" action="/anunciar" role="form" method="POST" class="f1" autocomplete="off">

    	{{ csrf_field() }}

    <fieldset>
            <h4><i class="fa fa-suitcase"></i>
            Qual o proposito do seu anuncio:</h4>                      

            <div class="form-group xs-12">
                <div class="btn-group btn-group-toggle col-sm-12" data-toggle="buttons">

                    <label class="btn btn-primary active">
                        <input type="radio" name="meta" value="venda" id="venda" checked="checked" 
                         > Vender
                    </label>

                    <label class="btn btn-primary">
                        <input type="radio" name="meta" value="aluguel" id="alugar"> Alugar
                    </label>             

                </div>

            </div> 

            <div class="form-group xs-12" id="menu_temp">

                <div class="form-group col-sm-12" id="mod_temporada">

                    <div class="card">

                        <div class="card-body">
                            Este imóvel é para Temporada?
                              <div class="form-check">

                                <input type="checkbox" class="form-check-input" id="temporada" name="temporada">
                                <label class="form-check-label" for="temporada">Marque apenas se o imóvel for para temporadas e fins de semana.</label>

                              </div>                                             


                        </div>
                    </div>

                </div>
                
            </div> 

            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="f1-first-name">Nome</label>
                    <input type="text" name="name" placeholder="Seu Nome Completo" class="required form-control" id="name"
                    value="{{ Auth::user()->name }}">
                    <div class="erro-form erro-name"> Preecha Corretamente </div>
                </div>
            </div>   

            <div class="form-row">

                @if(isset(Auth::user()->cpf) && !empty(Auth::user()->cpf))

                <div class="form-group col-sm-6 ">
                    <input type="tel" name="cpf" class="cpf form-control col-sm-12" tipo_dado="cpf" maxlength="14" id="cpf" value="{{ Auth::user()->cpf }}" onblur="validarCPF(this)" readonly="readonly">
                    
                </div>

                @else

	            <div class="form-group col-sm-6 ">
	                <input type="tel" name="cpf" placeholder="Seu CPF" class="cpf form-control col-sm-12 required" tipo_dado="cpf" maxlength="14" id="cpf" value="{{ Auth::user()->cpf }}" onblur="validarCPF(this)" autocomplete="new-password">
	                <div class="erro-cpf erro-form"> CPF inválido </div>
	            </div>
                @endif

	            <div class="form-group col-sm-6 ">
	                <input type="tel" name="phone" placeholder="Seu Telefone" class="phone form-control col-sm-12 required" id="phone" value="{{ Auth::user()->phone }}" autocomplete="new-password">
	                <div class="erro-form erro-phone"> Digite um telefone válido </div>
	            </div>

            </div>                     

            <h4><i class="fa fa-home"></i>
            Que tipo de imóvel vai anunciar?</h4>

            <div class="form-row">

                <div class="form-group col-sm-6">

                    <select name="imovel_type_id" class="form-control required" id="imovel_type_id" data-content="Selecione o tipo de imovel" data-placement="bottom">
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

              <div class="form-group">
                    <h5>CEP</h5>

                      <div class="form-inline">

                        <input autocomplete="new-password" type="phone" name="cep" ref="cep" id="cep" 
                        class="form-control{{ $errors->has('cep') ? ' is-invalid' : '' }} col-sm-6 form-control-lg required"   maxlength="8" size="8" placeholder="00000-00" onblur="pesquisacep(this.value);" />
                        

                        <div class="col-sm-6">
                          <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" class="lembra-cep" target="_blank" >
                             <i class="fa fa-caret-right"></i>Não sei meu CEP
                            </a>
                        </div>

                      <div class="invalid-feedback">
                        <strong>* CEP não encontrado ou invalido </strong>
                      </div>

                      </div>
                      
                          <div class="form-group">
                              <input type="text" class="form-control required" name="localidade" id="city_imobi"  placeholder="Cidade" aria-describedby="city" readonly>
                          </div>

                          <div class="form-group">
                          <input type="text" class="form-control required" name="estado" id="estado"  aria-describedby="address" placeholder="Estado" readonly required="required">
                          </div> 

                          <div class="form-group">
                            <input type="text" name ="bairro" class="form-control required" id="bairro_imobi" placeholder="Bairro">
                          </div> 

                          <div class="form-group">
                            <label for="logradouro">Endereço</label>
                            <input type="text" name="logradouro" class="form-control required"
                            id="rua_imobi" placeholder="ex: Rua Dom Pedro" autocomplete="new-password">                   
                          </div>

                          <div class="form-row">
                            <div class="col-sm-6 mb-2">
                              <label for="unidade" class="">Número</label>
                              <input type="phone" name="unidade" class="form-control numero required form-control-lg" pattern="[0-9]+$" id="unidade" placeholder="Para melhor localização no mapa" autocomplete="off">
                              <div class="erro-form erro-number"></div>                  
                          </div>

                          <div class="col-sm-6 mb-2">
                            <label for="complemento">Complemento</label>
                            <input type="text" name="complemento" class="form-control" id="complemento" placeholder="ex: ap 40 bloco C">
                          </div>

                      </div>
              </div>

            </div>	

            <h4><i class="fa fa-clipboard"></i> 
            Informações importantes do Imóvel:</h4>

            <div class="form-row ">

                <div class="form-group col-sm-12 col-md-6">
                    <label for="quartos">Quartos</label>
                    <input type="number" name="quartos" placeholder="0" class="form-control numero required" id="quartos" min="0" max="20" value="{{ old('quartos') }}" pattern="[0-9]+$" >
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
                    <input type="number" name="area_total" placeholder="0" class="form-control numero" min="0" id="area_total" value="{{ old('area_total') }}">
                </div>


            </div> 

            <h4><i class="fa fa-dollar"></i>
                Quanto custa o seu Imóvel?
            </h4>

            <div id="meta_aluguel">
                <div class="form-row" id="meta_aluguel_venda">

                        <div class="form-group col-sm-4">
                            <label for="valor">
                                <div id="log">Valor de Venda :</div> 
                            </label>
                            <input type="text" id="valor" class="col-sm-12 required" value="{{ old('preco_venda') }}" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" name="preco_venda">
                        </div>

                        <div class="form-group col-sm-4" id="percetual">
                            <label for="percent">
                                <div>Comissão Base 6% para venda:</div> 
                            </label>
                            <input type="text" id="percent" readonly  class="col-sm-12 form-control" name="comissao">
                        </div>

                        <div class="form-group col-sm-4" id="preco_total">
                            <label for="preco">
                                <div id="log_2">Valor total de venda :</div> 
                            </label>
                            <input type="text" name="preco" id="preco" class="col-sm-12 form-control " value="{{ old('preco') }}" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" readonly>
                        </div>


                </div>

                <div class="form-row" id="meta_aluguel_temporada">

                        <div class="form-group col-sm-4">
                            <label for="valor">
                                <div id="log">Valor do Aluguel:</div> 
                            </label>
                            <input type="text" id="valor" class="col-sm-12 required" value="{{ old('preco_aluguel') }}" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" name="preco_aluguel">
                        </div>

                        <select name="periodo" class="form-control required" id="periodo_temporada" data-content="Selecione o pacote de temporada" data-placement="bottom">
                            <option value="Diária"> Diária </option>
                            <option value="Fim de Semana"> Fim de Semana </option>
                            <option value="Quinzena"> Quinzena </option>                                         
                            <option value="Mensal"> Mensal </option>                                         
                        </select>

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
<script src="{{asset('js/scripts.js?version=1.0')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 
<script type="text/javascript">
    $("#cpf").mask("999.999.999-99");
    $("#phone").mask("(00) 00000-0000");
    $('#preco').mask('#.##0,00', {reverse: true});
    $('#valor').mask('#.##0,00', {reverse: true, style: 'currency', currency: 'BRL'});
    $('#percent').mask('#.##0,00', {reverse: true});
    $('#iptu').mask('#.##0,00', {reverse: true});
    $('#condominio').mask('#.##0,00', {reverse: true});
</script> 
@stop