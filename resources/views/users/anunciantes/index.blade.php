@extends('users.layouts.default')

@section('content')


<div class="content">

    <div class="container-fluid">

        <div class="row">

        	<div class="card">

        		<div class="header">
        			
        			<div class="row">
        				<h4 class="title col-xs-12 col-sm-6"> Olá ! {{ Auth::user()->nome }} </h4>
        				
	       			</div>
        		
        		</div>

        		<div class="content">

        			<div class="row">                           

                            <div class="col-xs-12 col-sm-6 col-md-6">

                            		<div class="card">
                            			<div class="header">
                            				<div class="row">
                            					<h4 class="title col-xs-10 col-sm-10"> Assinatura</h4>
                            					@isset($assinatura)

	                            					@if($assinatura->status == 'active')				
	                            						<i class="bg-success col-xs-2 col-sm-2">
	                            							on
	                            						</i>
	                            					@else
	                            						<i class="bg-danger col-xs-2 col-sm-2">
	                            							off
	                            						</i>
	                            					@endif

                            					@endif
                            				</div>
                            			</div>

                            			<div class="content">

                            				<table class="table">
                            					<tr>
	                            					<th>Código:</th>
	                            					<th>Pagamentos</th>
	                            					<th>Status do Pagamento:</th>
                            					</tr>
                            					<tr>
                            						<td>{{ $assinatura->custom_id }}</td>                            						
                            						
                        							@if($assinatura->last_charge == $pagamento->charge_id )

                        							<td> {{ $pagamento->payment == "banking_billet" ? 'Boleto Bancário' : 'Cartão de Crédito' }} </td>
                            							
                        							<td>
                            							@if(verificaStatus($pagamento->status) == 'Aguardando Pagamento' )
                            								<span class="bg-warning text-danger">	{{ verificaStatus($pagamento->status) }}
                            								</span>	
                            							@else

                            								{{ verificaStatus($pagamento->status) }}

                            							@endif
                            						</td>			

                        							@endif
                            						
                            					</tr>
                            				</table>

                            				<hr>

                            				@if($pagamento->payment == 'banking_billet')

                            					<small class="text-warning"> Obs: Pagamento via Boleto Bancário pode demorar até 48h para creditar.</small>

                            				@endif
                            					
                            			</div>

                            		</div>

                            </div>


                            <div class="col-xs-12 col-sm-6 col-md-6">
                            		<div class="card">
                            			<div class="header">
                            				<div class="row">
                            					<h4 class="title col-xs-12 col-sm-12"> Anúncios Disponíveis</h4>
                            				</div>
                            			</div>
                            			<div class="content">

                            				<table class="table" >
                            					
                            					<tr align="center">
                            						<th>Simples</th>
                            						<th>Destaques</th>
                            						<th>Super Destaques</th>
                            					</tr>

                            					<tr align="center">
                            						<td>{{ Auth::user()->plano->quant_anuncios == 0 ? " Ilimitado " : Auth::user()->plano->quant_anuncios  - $simples }}</td>
                            						<td>{{ Auth::user()->plano->destaques - $destaque }}</td>
                            						<td>{{ Auth::user()->plano->super_destaques - $super }}</td>
                            					</tr>

                            				</table>                            				

                            				
                            			
											<a class="btn btn-info btn-fill col-xs-12 col-sm-12" href="{{ route('adicionaImovelAnunciante') }}"> Novo Anúncio </a>	

											<div class="clearfix"></div>							
                                    	
										</div>

                            		</div>                            	
                            </div>
                    </div>

        		</div>

        	</div>

        </div>
        
    </div>
    
</div>        	

@endsection
