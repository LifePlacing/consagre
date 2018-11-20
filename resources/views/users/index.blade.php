@extends('users.layouts.default')

@section('content')
	
	<div class="row">
	<div class="col-md-4 animated bounceInLeft delay-2s">
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

	<div class="col-md-4 animated bounceIn delay-4s">
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

	<div class="col-md-4 animated bounceInRight delay-4s">
		<div class="panel-info panel">
			<div class="panel-heading"> <p><i class="pe-7s-cash"></i>Plano Contratado</p></div>
			<div class="panel-body bg-info">				
				
				<p> Máximo Anuncios: 10 anuncios simples.</p>					
					
			
			</div>
		</div>
	</div>	

	</div>

	<div class="row">
		<div class="col-md-6">			
			<div class="card ">
                <div class="header">
                    <h4 class="title"><p> Agendamentos | Visitas</h4>
                    <p class="category">Eventos agendados para seu imóvel</p>
                </div>
				
				<div class="content">
					<div id="calendar"></div>

				</div>

			</div>
		</div>	
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Imobiliarias | Corretores</h4>
                                <p class="category">Parceiros</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                    	<th>Anuncio</th>
                                    	<th>Informações de Contato </th>
                                    	<th class="td-actions text-center">Ação</th>
                                        <tbody>                                        	
                                            <tr>                                            	
                                                <td>
                                                	<picture class="td-picture">												
						  							  	<img src="{{ asset('users/img/full-screen-image-3.jpg') }}" class="img-fluid td-picture">	
					  						  		</picture>
                                                </td>
                                                <td>
                                                Nome: Imobiliaria Parceira <br>
                                                Telefone: (13) 99999-9999 <br>
                                                <br>
                                                <span><i class="fa fa-comments-o"></i> <a href="#">Enviar Mensagem</a></span>
                                            	</td>

                                                <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" title="Visualizar Parceiro" class="btn btn-info btn-simple btn-xs">
                                                       <i class="fa fa-search"></i>
                                                    </button>

                                                    <button type="button" rel="tooltip" title="Aprovar Anuncio" class="btn btn-success btn-simple btn-xs">
                                                        <i class="fa fa-check"></i>
                                                    </button>

                                                    <button type="button" rel="tooltip" title="Reprovar" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>

                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


	</div>	


@endsection