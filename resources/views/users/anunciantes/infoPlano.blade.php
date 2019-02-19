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

                                        @foreach( Auth::user()->assinaturas as $assinatura )
                                            
                                            @if($assinatura->name == Auth::user()->plano->nome)
                                                                                   
                                                @foreach($assinatura->payments as $payment)

                                                    @if($assinatura->last_charge == $payment->charge_id )

                                                    <td> {{ $payment->payment == "banking_billet" ? 'Boleto Bancário' : 'Cartão de Crédito' }} </td>

                                                    <td>{{ verificaStatus($payment->status) }}</td>

                                                    @endif

                                                @endforeach


                                            @endif

                                        @endforeach
                                    </tr>

                                  </table>  

                            </div> 
                        
                        </div>                   

                        
                    <div class="row">
                        
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Total de Anuncios</h4>                                
                            </div>
                            <div class="content">

                                <div class="row">
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        
                                        <div class="card">

                                            <div class="content">

                                                <div id="chartSimples" class="ct-chart"></div>
 
                                                
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        
                                        <div class="card">

                                            <div class="content">

                                                <div id="chartDestaque" class="ct-chart"></div>
 
                                                
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        
                                        <div class="card">

                                            <div class="content">

                                                <div id="superDest" class="ct-chart"></div>
 
                                                
                                            </div>

                                        </div>

                                    </div>




                                </div>

                           <div class="footer">
                                <div class="legend">
                                    <i class="fa fa-circle text-info"></i> Total
                                    <i class="fa fa-circle text-danger"></i>Disponiveis
                                    <i class="fa fa-circle text-warning"></i>Ativos
                                </div>                                    
                            </div>

                            </div>

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

<script type="text/javascript">

 $(document).ready(function(){

    var si = {!! Auth::user()->plano->quant_anuncios !!};
    var dest =  {!! Auth::user()->plano->destaques !!};
    var su = {!! Auth::user()->plano->super_destaques !!} ;

    var si_a = {!! Auth::user()->plano->quant_anuncios - $simples !!};
    var dest_a = {!! Auth::user()->plano->destaques - $destaque !!};
    var su_a = {!! Auth::user()->plano->super_destaques - $super !!};


    new Chartist.Bar('#chartSimples', {
      labels: ['Anuncios Simples'],
      series: [
        [si],
        [si_a],
        [{!! $simples !!}]
        
      ]
    }, 
    {
      seriesBarDistance: 15,
      axisX: {
        offset: 50
      },
      axisY: {
        onlyInteger: true,
        offset: 50,
        labelInterpolationFnc: function(value) {
          return value
        },
        scaleMinSpace: 20
      }
    }); 


//Destaques

    new Chartist.Bar('#chartDestaque', {
      labels: ['Anuncios Destaques'],
      series: [
        [dest],
        [dest_a],
        [{!! $destaque !!}]
        
      ]
    },
    {
      seriesBarDistance: 15,
      axisX: {
        offset: 50
      },
      axisY: {
        onlyInteger: true,
        offset: 50,
        labelInterpolationFnc: function(value) {
          return value 
        },
        scaleMinSpace: 5
      }
    });

//Super Destaques

    new Chartist.Bar('#superDest', {
      labels: ['Super Destaques'],
      series: [
        [su],
        [su_a],
        [{!! $super !!}]
        
      ]
    },
    {
      seriesBarDistance: 15,
      axisX: {
        offset: 50
      },
      axisY: {
        onlyInteger: true,
        offset: 50,
        labelInterpolationFnc: function(value) {
          return value 
        },
        scaleMinSpace: 5
      }
    });

});

</script>


@stop