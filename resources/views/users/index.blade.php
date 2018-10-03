@extends('users.layouts.default')

@section('content')

	<div class="col-md-4">
		<div class="panel-primary panel">
			<div class="panel-heading ">Anuncios Pendentes</div>
			<div class="panel-body bg-primary">		

				@if(isset($pendentes))

					{{ $pendentes->count() }}

				@endif
				
			</div>			
		</div>
	</div>

	<div class="col-md-4 ">
		<div class="panel-success panel">
			<div class="panel-heading">Visitas</div>
			<div class="panel-body bg-success">
				Visitas Hoje
			</div>
		</div>
	</div>

	<div class="col-md-4 ">
		<div class="panel-warning panel">
			<div class="panel-heading">Visitas</div>
			<div class="panel-body bg-warning">
				anuncios pendentes
			</div>
		</div>
	</div>


@endsection