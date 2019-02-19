@extends('users.layouts.default')

@section('content')
	
	<div class="row">

	<div class="col-md-6 animated bounceInLeft delay-2s">
		<div class="panel-primary panel">
			<div class="panel-heading "> <p> <i class="pe-7s-note2"></i> Anuncios</p></div>

			<div class="panel-body bg-primary">					

					<div class="col ">
						<i class="pe-7s-check"></i>
						<span>Ativos: </span>
						
						<div class="count">
							@if(isset($ativos))
								{{ $ativos->count() }}
							@endif
						</div>

					</div>
					<div class="col ">						
							<i class="pe-7s-attention"> </i>
							<span>Pendentes: </span>
							
							<div class="count">
								@if(isset($pendentes))
									{{ $pendentes->count() }}
								@endif
							</div>
						
					</div>
							
			</div>			
		</div>
	</div>

	<div class="col-md-6 animated bounceIn delay-4s">
		<div class="panel-success panel">
			<div class="panel-heading"> <p><i class="pe-7s-chat"></i>Mensagens</p></div>
			<div class="panel-body bg-success">
				
					<div class="col ">
						<i class="pe-7s-mail-open"></i>
						<span>Recebidas: </span>
						
						<div class="count">
							@if(isset($ativos))
								{{ $ativos->count() }}
							@endif
						</div>

					</div>
					<div class="col ">						
							<i class="pe-7s-mail"> </i>
							<span>Novas : </span>
							
							<div class="count">
								@if(isset($pendentes))
									{{ $pendentes->count() }}
								@endif
							</div>
						
					</div>

			</div>
		</div>
	</div>


	</div>

	<div class="row">
		<div class="col-md-12">			
			<div class="card ">
                <div class="header">
                    <h4 class="title"><p> Imóveis Anunciados</h4>
                    <p class="category"></p>
                </div>
				
				<div class="content">
					<div id="calendar">
						@if( isset($imoveis_user) )

						<table class="table">

							<tr>
								<th>Código do Imóvel</th>
								<th>Titulo</th>								
								<th>Valor</th>
								<th>Status</th>
								<th>Ações</th>
							</tr>
							@foreach( $imoveis_user as $imovel)
							<tr>
								<td>{{ formatCodigo($imovel->codigo)  }}</td>
								<td>{{ $imovel->titulo  }}</td>
								<td>{{ formataMoney($imovel->preco_venda)   }}</td>
								<td>{{ $imovel->status == 0 ? "Pendente / Em Analise" : "Ativo" }}</td>
								<td>

									<a 
									href="/preview/imovel_codigo/{{$imovel->id}}" 
									onclick="window.location='/preview/imovel_codigo/{{$imovel->id}}'" > 
									<i class="pe-7s-look e63e"> </i>Visualizar </a>
								</td>
							</tr>
								 
							@endforeach
							
						</table>


						@endif
					</div>

				</div>

			</div>
		</div>	

	</div>	


@endsection