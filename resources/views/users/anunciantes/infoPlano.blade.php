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

                                <h4 class=" title col-sm-6 hidden-xs">Informações do Plano - ( <strong>{{ Auth::user()->plano->nome }} </strong>)</h4>

                                <div class="visible-xs">
                                    <h3 class=" title  text-center"> Informações do Plano <br> ( <strong>{{ Auth::user()->plano->nome }} </strong>)</h3>
                                    <br>
                                </div>    
   
                                <div class="col-sm-6 col-xs-12">

                                    <div class="card" >

                                        <div class="content">

                                            Anúncios Restantes:

                                            @if(isset($simples) && Auth::user()->plano->quant_anuncios > 0)

                                                @if($simples <= Auth::user()->plano->quant_anuncios )
                                                    <span class="badge">
                                                        {{ Auth::user()->plano->quant_anuncios - $simples }}
                                                    </span> 
                                                    <span class="text-success">simples</span>
                                                @else
                                                    <span class="text-danger">Você atingiu seu limite de anuncios</span>
                                                @endif
                                            
                                            @endif   
                                    
                                            @isset($destaque)

                                                @if($destaque <= Auth::user()->plano->destaques )
                                                     <span class="badge">{{ Auth::user()->plano->destaques - $destaque }}</span> <span class="text-success">destaques</span>
                                                @else
                                                    <span class="text-danger">Você atingiu seu limite de anuncios destaque</span>
                                                @endif 

                                            @endif

                                            @isset($super)

                                                @if($super <= Auth::user()->plano->super_destaques )
                                                    <span class="badge">{{ Auth::user()->plano->super_destaques - $super }}</span> <span class="text-success">super destaque</span>
                                                @else
                                                    <span class="text-danger">Você atingiu seu limite de anuncios super destaque</span>
                                                @endif 

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>   


                    <div class="content">

                        <div class="row">                           

                            <div class="col-xs-12 col-sm-12 col-md-12">
                        
                                <table class="table">

                                    <tr>                                       
                                        <th>Valor Mensal:</th>
                                        <th>Pagamento</th>
                                        <th>Status</th>
                                    </tr>
                                    <tr>                                        
                                        <td>{{ formataMoedaInteiro(Auth::user()->plano->valor_mensal) }}</td>

                                            <td>
                                                @if($pagamento->payment == "banking_billet")
                                                    Boleto Bancário 
                                                 @elseif( $pagamento->payment == "currency") 
                                                    Em Dinheiro
                                                 @else
                                                    Cartão de Crédito 
                                                 @endif
                                            </td>

                                            <td>
                                                
                                                @if(verificaStatus($pagamento->status) == 'Aguardando Pagamento' )
                                                    <span class="bg-warning text-danger">   {{ verificaStatus($pagamento->status) }}
                                                    </span> 
                                                @else
                                                    <span class="text-success">
                                                    {{ verificaStatus($pagamento->status) }}
                                                    </span>
                                                @endif
                                                
                                            </td>
                                        
                                    </tr>

                                  </table>  

                            </div> 
                        
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