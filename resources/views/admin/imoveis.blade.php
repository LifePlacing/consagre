@extends('admin/layouts/default')

    @section('title')
        Consagre Imoveis Admin
    @parent

    @section('header_styles')
    	<link href="{{ asset('admin/icon_fonts_assets/picons-thin/style.css') }}" rel="stylesheet">
    @stop

@stop

@section('content')

<div class="element-wrapper">

	@isset($action)

		@switch($action)

			@case('super_destaques')

				<h6 class="element-header">Lista de Super Destaques</h6>
				<div class="element-box">

					@if($super->count() > 0)

					<div class="table-responsive">					
						
						<table id="dataTable1" width="100%" class="table table-striped table-lightfont">
							
							<thead>
	                        	<tr>
	                        		<th>Código</th> <th>Meta </th> <th> Titulo </th> <th> Anunciante</th><th>Tipo de Anúncio</th> <th>Ações</th> 
	                        	</tr>
			                </thead>

			                <tfoot>
			                	<tr>
	                        		<th>Código</th> <th>Meta </th> <th> Titulo </th> <th> Anunciante</th><th>Tipo de Anúncio</th> <th>Ações</th> 
	                        	</tr>
			                </tfoot>

			                <tbody>

			                	@foreach($super as $ativo)
			                	<tr>
									<td>{{ formatCodigo($ativo->codigo) }}</td> 
									<td>{{ $ativo->meta }}</td>			                		
									<td>{{ $ativo->titulo }}</td>			                		
									<td>{{ $ativo->anunciante->nome }}</td>			                		
									<td>{{ $ativo->tipo_de_anuncio }}</td>			                		
									<td>
								
										<a href="" alt="Detalhes" class="btn_icon btn-lg" data-toggle="tooltip" data-placement="top" title="Visualizar">
										&nbsp<i class="picons-thin-icon-thin-0043_eye_visibility_show_visible"></i>&nbsp
										</a>
														
									</td>			                		
			                	</tr>
			                	@endforeach

			                </tbody>

						</table>

						@else
							<h2>Sem resultados no momento!</h2>
						@endif

					</div>						
					
				</div>

			@break


			@case('destaques')

				<h6 class="element-header">Lista de Destaques</h6>
				<div class="element-box">

					@if($destaques->count() > 0)
					<div class="table-responsive">					
						
						<table id="dataTable1" width="100%" class="table table-striped table-lightfont">
							
							<thead>
	                        	<tr>
	                        		<th>Código</th> <th>Meta </th> <th> Titulo </th> <th> Anunciante</th><th>Tipo de Anúncio</th> <th>Ações</th> 
	                        	</tr>
			                </thead>

			                <tfoot>
			                	<tr>
	                        		<th>Código</th> <th>Meta </th> <th> Titulo </th> <th> Anunciante</th><th>Tipo de Anúncio</th> <th>Ações</th> 
	                        	</tr>
			                </tfoot>

			                <tbody>

			                	@foreach($destaques as $ativo)
			                	<tr>
									<td>{{ formatCodigo($ativo->codigo) }}</td> 
									<td>{{ $ativo->meta }}</td>			                		
									<td>{{ $ativo->titulo }}</td>			                		
									<td>{{ $ativo->anunciante->nome }}</td>			                		
									<td>{{ $ativo->tipo_de_anuncio }}</td>			                		
									<td>								
										<a href="" alt="Detalhes" class="btn_icon btn-lg" data-toggle="tooltip" data-placement="top" title="Visualizar">
										&nbsp<i class="picons-thin-icon-thin-0043_eye_visibility_show_visible"></i>&nbsp
										</a>
														
									</td>			                		
			                	</tr>
			                	@endforeach

			                </tbody>

						</table>

						@else
							<h2>Sem resultados no momento!</h2>
						@endif

					</div>	

				
				</div>


			@break

			@case('simples')

				<h6 class="element-header">Anúncios Simples</h6>
				<div class="element-box">

					<div class="table-responsive">					
						
						<table id="dataTable1" width="100%" class="table table-striped table-lightfont">
							
							<thead>
	                        	<tr>
	                        		<th>Código</th> <th>Meta </th> <th> Titulo </th> <th> Anunciante</th><th>Tipo de Anúncio</th> <th>Ações</th> 
	                        	</tr>
			                </thead>

			                <tfoot>
			                	<tr>
	                        		<th>Código</th> <th>Meta </th> <th> Titulo </th> <th> Anunciante</th><th>Tipo de Anúncio</th> <th>Ações</th> 
	                        	</tr>
			                </tfoot>

			                <tbody>

			                	@foreach($simples as $ativo)
			                	<tr>
									<td>{{ formatCodigo($ativo->codigo) }}</td> 
									<td>{{ $ativo->meta }}</td>			                		
									<td>{{ $ativo->titulo }}</td>			                		
									<td>{{ $ativo->anunciante->nome }}</td>			                		
									<td>{{ $ativo->tipo_de_anuncio }}</td>			                		
									<td>
										<a href="" alt="Detalhes" class="btn_icon btn-lg" data-toggle="tooltip" data-placement="top" title="Visualizar">
										&nbsp<i class="picons-thin-icon-thin-0043_eye_visibility_show_visible"></i>&nbsp
										</a>
														
									</td>			                		
			                	</tr>
			                	@endforeach

			                </tbody>

						</table>

					</div>	
				</div>


			@break

			@case('captacao')

				<h6 class="element-header">Captação de Anúncios</h6>
				<div class="element-box">
					
					@if(count($captacao))
					<div class="table-responsive">					
						
						<table id="dataTable1" width="100%" class="table table-striped table-lightfont">
							
							<thead>
	                        	<tr>
	                        		<th>Código</th> <th>Meta </th> <th> Titulo </th> <th> Usuário</th><th>Telefone</th> <th>Ações</th> 
	                        	</tr>
			                </thead>

			                <tfoot>
			                	<tr>
	                        		<th>Código</th> <th>Meta </th> <th> Titulo </th> <th> Usuário</th><th>Telefone</th> <th>Ações</th> 
	                        	</tr>
			                </tfoot>

			                <tbody>

			                	@foreach($captacao as $ativo)
			                	<tr>
									<td>{{ formatCodigo($ativo->codigo) }}</td> 
									<td>{{ $ativo->meta }}</td>			                		
									<td>{{ $ativo->titulo }}</td>			                		
									<td>{{ $ativo->user->name }}</td>			                		
									<td>{{ $ativo->user->phone }}</td>			                		
									<td>
									
										<a href="" alt="Detalhes" class="btn_icon btn-lg" data-toggle="tooltip" data-placement="top" title="Visualizar">
										&nbsp<i class="picons-thin-icon-thin-0043_eye_visibility_show_visible"></i>&nbsp
										</a>
														
									</td>			                		
			                	</tr>
			                	@endforeach

			                </tbody>

						</table>

					</div>

					@else

						<h2> Sem Registro no momento! </h2>

					@endif

				
				</div>

			@break

		@endswitch

	@endif

</div>

@stop

@section('footer_scripts')
 <script type="text/javascript" src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}" >  </script>
 <script type="text/javascript" src="{{ asset('admin/js/busca_cep.js') }}" >  </script>

@stop