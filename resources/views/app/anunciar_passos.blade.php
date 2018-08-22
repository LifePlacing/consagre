@extends('layouts/wizard')


@section('title')
    Anunciar
    @parent
@stop


@section('header_styles')
    <link rel="stylesheet" href="{{asset('css/form-elements.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">    
@stop

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
        <div class="top-content">
            <div class="container">
                <div class="col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-2 col-lg-12 col-lg-offset-2 formulario">

                <h3>Anunciar meu imóvel</h3>
                <p>Complete ou atualize seus dados</p> 
                                   
                    <form id="anuncie-imovel"  role="form" action="{{url('/anunciar')}}" method="POST" class="f1">
                       @csrf
                            <div class="f1-steps">
                                <div class="f1-progress">
                                    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                                </div>
                                <div class="f1-step active">
                                    <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                                    <p>Sobre seu Imóvel</p>
                                </div>
                                <div class="f1-step">
                                    <div class="f1-step-icon"><i class="fa fa-image"></i></div>
                                    <p>Fotos e Detalhes</p>
                                </div>
                                <div class="f1-step">
                                    <div class="f1-step-icon"><i class="fa fa-money"></i></div>
                                    <p>Planos</p>
                                </div>

                            </div>

                           
                            <fieldset>

                            <h4><i class="fa fa-suitcase"></i>
                            Qual o proposito do seu anuncio:</h4>                      

                                <div class="form-group">
                                    <div class="btn-group btn-group-toggle col-sm-12" data-toggle="buttons">

                                        <label class="btn btn-primary active">
                                            <input type="radio" name="imovel_prop" value="venda" 
                                            checked="checked"> Vender
                                        </label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="imovel_prop" value="aluguel"> Alugar
                                        </label>

                                    </div>
                                </div>                                  
                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label class="sr-only" for="f1-first-name">Nome</label>
                                        @auth
                                        <input type="text" name="name" placeholder="Seu Nome Completo" class="required form-control" id="name"
                                        value="{{ Auth::user()->name }}">
                                        @endauth 
                                        <div class="erro-form erro-name"> Preecha Corretamente</div>
                                    </div>
                                </div>


                                <div class="form-row">

                                <div class="form-group col-sm-6 ">
                                    <input type="text" name="cpf" placeholder="Seu CPF" class="cpf form-control col-sm-12 required" tipo_dado="cpf" maxlength="14" id="cpf" required="required">
                                    <div class="erro-cpf erro-form"> CPF inválido </div>
                                </div>

                                <div class="form-group col-sm-6 ">
                                    <input type="tel" name="phone" placeholder="Seu Telefone" class="phone form-control col-sm-12" id="phone">
                                    <div class="erro-form erro-phone"> Digite um telefone válido </div>
                                </div>

                                </div>

                                <h4><i class="fa fa-home"></i>
                                Que tipo de imóvel você quer anunciar?</h4>

                                <div class="form-row">

                                    <div class="form-group col-sm-6">

                                        <select name="imovel_type_id" class="form-control required" id="imovel_type_id" >
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

                                            <select name="categoria_id" class="form-control required" id="categoria_id"> 
                                             @if($categorias) 
                                                 <option>Selecione uma categoria</option>   
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

                                    <div class="form-group col-sm-6 ">
                                        <label for="quartos">Quartos</label>
                                        <input type="tel" name="quartos" placeholder="0" class="form-control numero required" id="quartos" >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="banheiros">Banheiros</label>
                                        <input type="tel" name="banheiros" placeholder="0" class="form-control numero required" id="banheiros">
                                    </div>


                                    <div class="form-group col-sm-6">
                                        <label for="garagem">Vagas de Garagem</label>
                                        <input type="tel" name="garagem" placeholder="0" class="form-control numero required" id="garagem" >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="suites">Suítes</label>
                                        <input type="tel" name="suites" placeholder="0" class="form-control numero" id="suites">
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
                                            <input type="text" name="preco" id="preco" onKeyUp="maskIt(this,event,'###.###.###.###,##',true)" dir="rtl" size="15"
                                            placeholder="0,00" class="col-sm-12 required">
                                        </div>

                                </div>                                                                 

                                <div class="f1-buttons">
                                    <button type="submit" class="btn-wizard btn-next">Continuar</button>
                                </div>

                            </fieldset>

<!-- ========================= SEGUNDA ABA DO CADASTRO DE IMOVEIS ====================== -->

                            <fieldset>

                                  <div class="form-group col-sm-12">
                                    <label>Titulo do anuncio</label>
                                    <input type="text" name="titulo" id="titulo" class="form-control required" value="{{ old('titulo') }}">
                                  </div>                              

                                <div class="form-group col-sm-12">
                                    <label for="descricao">Descrição</label>
                                    <textarea placeholder="Crie aqui seu texto falando sobre as principais caracteristicas do seu imóvel."
                                    id="descricao" name="descricao" rows="6" maxlength="800" class="col-sm-12 required" value="{{ old('descricao') }}">
                                    </textarea>
                                </div>
                                
                                <div class="form-group col-sm-12">

                                </div>

                                <div class="f1-buttons">
                                    <button type="button" class="btn-wizard btn-previous">Voltar</button>
                                    <button type="button" class="btn-wizard btn-next">Continuar</button>
                                </div>
                            </fieldset>

                            <fieldset>
                                <h4>:</h4>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-facebook">Facebook</label>
                                    <input type="text" name="f1-facebook" placeholder="Facebook..." class="f1-facebook form-control" id="f1-facebook">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-twitter">Twitter</label>
                                    <input type="text" name="f1-twitter" placeholder="Twitter..." class="f1-twitter form-control" id="f1-twitter">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-google-plus">Google plus</label>
                                    <input type="text" name="f1-google-plus" placeholder="Google plus..." class="f1-google-plus form-control required" id="f1-google-plus">
                                </div>

  
                                <div class="f1-buttons">
                                    <button type="button" class="btn-wizard btn-previous">Voltar</button>
                                    <button type="submit" class="btn-wizard btn-submit">Cadastrar</button>
                                </div>
                            </fieldset>
                        
                        </form>

                    </div>

            </div>
        </div>



@stop


@section('footer_scripts')

<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 
<script type="text/javascript">
    $("#cpf").mask("999.999.999-99");
    $("#phone").mask("(00) 00000-0000");
</script> 

@stop