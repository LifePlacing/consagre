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
                            <div class="row">
                                <h4 class="title col-sm-9">Novo Anúncio</h4>
                            </div>
                        </div>   


                    <div class="content">

                        <form id="anuncie-imovel" name="anuncieimovel" role="form" method="POST" class="f1" autocomplete="off" action="{{ route('postImovelAdd') }}">

                        	{{ csrf_field() }}

                            <fieldset>
                            
                            <div class="row">

                                <div class="form-group col-sm-6">

                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                        <label class="btn btn-primary btn-fill active">
                                            <input type="radio" name="meta" value="venda" id="venda" checked="checked" 
                                             > Vender
                                        </label>

                                        <label class="btn btn-primary btn-fill">
                                            <input type="radio" name="meta" value="aluguel" id="alugar"> Alugar
                                        </label>

                                    </div>

                                </div> 

                                <div class="form-group col-sm-6">       

                                <span class="label label-info">
                                    Tipo de anúncio:
                                </span>

                                <select name="tipo_de_anuncio" class="form-control required" id="tipo_de_anuncio"  data-placement="bottom">
                                   
                                   @if($quant < $plano->quant_anuncios )
                                    <option value="simples">
                                                Simples 
                                    </option>
                                    @endif
                                    @if($dest < $plano->destaques)
                                    <option value="destaque">             
                                            Destaque 
                                    </option>
                                    @endif

                                    @if($super < $plano->super_destaques)
                                    <option value="super">
                                        Super Destaque 
                                    </option>
                                    @endif
                                </select>
                                          
    
                                

                                </div>


                            </div>
                  

                                <h4><i class="fa fa-home"></i>
                                Que tipo de imóvel vai anunciar?</h4>

                                <div class="row">

                                    <div class="form-group col-sm-6">

                                        <select name="imovel_type_id" class="form-control required" id="imovel_type_id" data-content="Selecione o tipo de imovel" data-placement="bottom">                
                                            @isset($tipos)
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

                                <div class="row"> 

                                        <div class="form-group col-sm-4 has-success">

                                            <label for="cep">CEP</label>

                                            <input autocomplete="new-password" type="phone" name="cep" ref="cep" id="cep" class="form-control{{ $errors->has('cep') ? 'is-invalid' : '' }} form-control-lg "   maxlength="8" size="8" placeholder="00000-00" onblur="pesquisacep(this.value);" required data-match="#cep" data-match-error="*CEP não encontrado ou invalido" /> 
                                                          
                                            
                                        </div>

                                        <div class="form-group col-sm-8">
                                          <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" class="lembra-cep" target="_blank" >
                                             <i class="fa fa-caret-right"></i>Não sei meu CEP
                                            </a>
                                        </div>

                                 </div> 

                                 <div class="row">  
                                          
                                      <div class="form-group col-sm-4">

                                          <input type="text" class="form-control required" name="localidade" id="city_imobi"  placeholder="Cidade" aria-describedby="city" readonly value="{{ old('localidade')}}">

                                      </div>

                                      <div class="form-group col-sm-2">

                                        <input type="text" class="form-control required" name="estado" id="estado"  aria-describedby="address" placeholder="Estado" readonly required="required">

                                      </div> 

                                      <div class="form-group col-sm-6">
       
                                        <input type="text" name ="bairro" class="form-control required" id="bairro_imobi" placeholder="Bairro" value="{{ old('bairro') }}">
                                       
                                      </div>
                                </div>               

                                <div class="row">

                                      <div class="form-group col-sm-6">
                                        <label for="logradouro">Endereço</label>
                                        <input type="text" name="logradouro" class="form-control required"
                                        id="rua_imobi" placeholder="ex: Rua Dom Pedro" autocomplete="new-password">                 
                                      </div>


                                        <div class="col-sm-2 mb-2">
                                          <label for="unidade" class="">Número</label>
                                          <input type="phone" name="unidade" class="form-control numero required form-control-lg" pattern="[0-9]+$" id="unidade" placeholder="Para melhor localização no mapa" autocomplete="off">
                                          <div class="erro-form erro-number"></div>                  
                                        </div>

                                      <div class="col-sm-4 mb-2">
                                        <label for="complemento">Complemento</label>
                                        <input type="text" name="complemento" class="form-control" id="complemento" placeholder="ex: ap 40 bloco C">
                                      </div>

                                </div>


                                <h4><i class="fa fa-clipboard"></i> 
                                Informações importantes do Imóvel:</h4>

                                <div class="row ">

                                    <div class="form-group col-sm-6 col-md-4">
                                        <label for="quartos">Quartos</label>
                                        <input type="number" name="quartos" placeholder="0" class="form-control numero required" id="quartos" min="0" max="20" value="{{ old('quartos') }}" pattern="[0-9]+$" >
                                    </div>

                                    <div class="form-group col-sm-6 col-md-4">
                                        <label for="garagem">Vagas de Garagem</label>
                                        <input type="number" name="garagem" placeholder="0" class="form-control numero" id="garagem" min="0" value="{{ old('garagem') }}" pattern="[0-9]+$">
                                    </div>

                                    <div class="form-group col-sm-6 col-md-4">
                                        <label for="banheiros">Banheiros</label>
                                        <input type="number" name="banheiros" placeholder="0" class="form-control numero required" id="banheiros" value="{{ old('banheiros') }}" pattern="[0-9]+$" min="0">
                                    </div>

                                 </div>
                                 <div class="row">   

                                    <div class="form-group col-sm-6 col-md-4">
                                        <label for="suites">Suítes</label>
                                        <input type="number" name="suites" placeholder="0" class="form-control numero" id="suites" value="{{ old('suites') }}"
                                        pattern="[0-9]+$" min="0">
                                    </div>

                                    <div class="form-group col-sm-6 col-md-4">
                                        <label for="area_util">Área útil</label>
                                        <input type="number" name="area_util" placeholder="0" class="form-control numero required" min="0" id="area_util" value="{{ old('area_util') }}" >
                                    </div>
                                    
                                    <div class="form-group col-sm-6 col-md-4">
                                        <label for="area_total">Área Total</label>
                                        <input type="number" name="area_total" placeholder="0" class="form-control numero" min="0" id="area_total" value="{{ old('area_total') }}">
                                    </div>


                                </div> 

                                <h4><i class="fa fa-dollar"></i>
                                    Quanto custa o seu Imóvel?
                                </h4>

                                <div class="row">

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

                                <h4><i class="fa fa-dollar"></i>
                                    Taxas ou Impostos :
                                </h4>

                                <div class="row">

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

                                    @isset($quant)
                                        @if($quant <= $plano->quant_anuncios )
                                            <button type="submit" id="next" class="btn btn-info btn-fill pull-right "  data-toggle="popover" title="Ops!!" data-content="Preencha os campos corretamente"
                                            data-placement="top" >Continuar</button>  
                                            <div class="clearfix"></div> 
                                            
                                        @else
                                            <p class="text-danger">Faça um upgrade do seu Plano!</p>
                                        @endif
                                    @endif


                             </fieldset>                                

                        </form> 

                    </div>    

                </div>

        </div>

    </div>

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