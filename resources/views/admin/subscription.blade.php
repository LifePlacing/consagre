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

		<h6 class="element-header">
			Assinaturas
		</h6>
		<div class="element-box">
			
			<h5 class="form-header">
             	Assinaturas Cadastradas
    		</h5>

			<div class="form-desc">
				Por questão de segurança as assinaturas criadas pelos anunciantes não podem ser removidas, afim de manter o bom funcionamento do sistema.
			</div>

			@isset($assinaturas)
			 <div class="table-responsive">
			 	 <table id="dataTable1" class="table table-striped table-lightfont" width="100%">
			 	 	
			 	 	<thead>
	          			<tr>
	          				<th>Código</th><th>Nome</th><th>Anunciante</th><th>Plano</th><th>Pagamento</th><th>Status</th>
	          			</tr>
          			</thead>
          			<tbody>
          				@foreach($assinaturas as $assinatura)
          				<tr>
          					<td>{{ $assinatura->custom_id}}</td>
          					<td>{{ $assinatura->name}}</td>
          					<td>{{ $assinatura->anunciante->nome }}</td>
          					<td>{{ $assinatura->plano->nome }}</td>
          					<td>{{ $assinatura->last_charge }}</td>
          					<td>{{ $assinatura->status }}</td>
          				</tr>
          				@endforeach
          			</tbody>

			 	 </table>
			 </div>
			 @endif


		</div>

	</div>

@stop

@section('footer_scripts')

 <script type="text/javascript" src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}" ></script>

 @stop