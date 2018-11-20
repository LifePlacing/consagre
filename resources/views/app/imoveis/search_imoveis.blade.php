@extends('layouts.head')

@section('breadcrumbs')
	@parent
	@include('app.inc.breadcrumbs')
@endsection



	@section('sidebar')

<div class="container-grid" >

		<div class="sidebar">

			<form method="post" action="{{route('buscaImoveis')}}">

				@csrf

				<div class="widget">

					<div class="text-center">
						<h1>Filtrar Sua Pesquisa</h1>
					</div>

					@if(isset($pesquisa))
						<input type="hidden" name="meta" value="{{ $pesquisa['meta'] }} ">
						<input type="hidden" name="cidade" value="{{ $pesquisa['cidade'] }}">
						<input type="hidden" name="imovel_type_id" value="{{ $pesquisa['imovel_type_id'] }}">
					@else
						<input type="hidden" name="meta" value="all">	
						<input type="hidden" name="cidade" value="all">	
						<input type="hidden" name="imovel_type_id" value="all">	
					@endif

					<hr>

					<div class="valores">
						<h2>Preço Minimo</h2>
						<h2>Preço Máximo</h2>						
					</div>

					<div class="form-inline">
					<input type="text" name="minpreco" placeholder="R$ 0.00 " class="form-control mb-2 mr-sm-2 preco"
					autocomplete="off">
					<input type="text" name="maxpreco" placeholder="+ de 50.000" class="form-control mb-2 mr-sm-2 preco " autocomplete="off">
					</div>

					<h2>Número de Quartos</h2>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="qOpt1" name="qOpt1">
						<label class="custom-control-label" for="qOpt1"> 1 </label>
					</div>
					<div class="custom-control custom-checkbox">	
						<input type="checkbox" class="custom-control-input" id="qOpt2" name="qOpt2">
						<label class="custom-control-label" for="qOpt2"> 2 </label>
					</div>
					<div class="custom-control custom-checkbox">	
						<input type="checkbox" class="custom-control-input" id="qOpt3" name="qOpt3">
						<label class="custom-control-label" for="qOpt3"> 3 </label>
					</div>
					<div class="custom-control custom-checkbox">	
						<input type="checkbox" class="custom-control-input" id="qOpt4" name="qOpt4">
						<label class="custom-control-label" for="qOpt4"> +4</label>
					</div>

					<div class="valores">
						<h2>Área Minima</h2>
						<h2>Área Máxima</h2>						
					</div>

					<div class="form-inline">
					<input type="text" name="" placeholder="Ex: 200m2" class="form-control mb-2 mr-sm-2 preco">
					<input type="text" name="" placeholder="ilimitado" class="form-control mb-2 mr-sm-2 preco ">
					</div>

					<h2>Número de Vagas na Garagem</h2>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="vOpt1" name="vOpt1">
						<label class="custom-control-label" for="vOpt1"> 1 </label>
					</div>
					<div class="custom-control custom-checkbox">	
						<input type="checkbox" class="custom-control-input" id="vOpt2" name="vOpt2">
						<label class="custom-control-label" for="vOpt2"> 2 </label>
					</div>
					<div class="custom-control custom-checkbox">	
						<input type="checkbox" class="custom-control-input" id="vOpt3" name="vOpt3">
						<label class="custom-control-label" for="vOpt3"> 3 </label>
					</div>
					<div class="custom-control custom-checkbox">	
						<input type="checkbox" class="custom-control-input" id="vOpt4" name="vOpt4">
						<label class="custom-control-label" for="vOpt4"> +4</label>
					</div>


					<hr>

					<div class="form-inline">
						<input type="submit" value="Filtrar Pesquisa" class="btn btn-danger btn-lg">
					</div>


				</div>
			</form>
			
		</div>

	@endsection

	@section('content')

	<div class="wrap">

		<div class="h2">
			<h2>Resultados para pesquisa:</h2><span></span>			
		</div>


		@if(isset($total_resultados) && !empty($total_resultados)) 
			@if($total_resultados > 0)
				<p class="text-center"> Total de resultados: {{ $total_resultados }} </p> 
			@endif 

		@elseif(empty($total_resultados))
			<p class="text-center">Não encontramos resultados</p>
		@endif


		@if($errors->any())
			<div class="alert alert-danger" role="alert">
				{{$errors->first()}}
			</div>
		@endif

		@if(isset($search) && count($search) > 0)

			@foreach ($search as $item)
	

			<div class="card-imovel" onclick="window.location='/{{ slugTitulo($item->titulo)}}/{{$item->id}}/{{$item->meta}}/{{$item->cidade->slug}}'">	
			    @foreach($item->media as $key => $medias)
			    	@if($key == 0)
			    	<img class="img-fluid img-dest" src="{{asset($medias->source)}}">
			    	@endif

			    @endforeach

				<div class="card-imovel-box">
					
					<div class="col-pesquisa">

						<div class="valor-preco">
							{{ formataMoney($item->preco) }}
						</div>


						<div class="titulo">
							<h5>{{$item->bairro}}</h5>
							<p>{{$item->logradouro}}
								<i class="fa fa-angle-double-right" ></i>
								 {{$item->cidade->nome}}
								 <i class="fa fa-angle-double-right"></i>
								 {{$item->estado}} 
							</p>
						</div>

					</div>

					<div class="corpo">

						<pre>{{ str_limit($item->descricao, $limit = 140, $end = '...') }}</pre>
						<small> 
							Atualizado em : {!! (date('d/m/Y',strtotime($item->updated_at))) !!}
						</small>

						<ul>
							<li><i class="fa fa-bed fa-lg" aria-hidden="true"></i><br>
								{{ $item->quartos }}@if($item->quartos > 1) quartos @else quarto @endif
								
							</li>
							<li><i class="fa fa-bath fa-lg" aria-hidden="true"></i><br>
								@if($item->suites != 0 && $item->suites === 1) {{ $item->suites }} suíte @else  {{ $item->suites }} suítes @endif
							</li>
							<li><i class="fa fa-car fa-lg" aria-hidden="true"></i><br>
								@if($item->garagem != 0 && $item->garagem === 1) {{ $item->garagem }} vaga @else  {{ $item->garagem }} vagas @endif
							</li>
							<li><i class="fa fa-area-chart fa-lg" aria-hidden="true"></i><br>
								{{ $item->area_total }} m<sup>2</sup>	
							</li>
						</ul>

					</div>

					<div class="card-bottom">
						<a href="#">Ver telefone</a>
						<button class="btn">MENSAGEM</button> 						
					</div>


				</div>
			    	
			</div>

			@endforeach

			{{ $search->appends($pesquisa)->links() }}			

		@endif

	</div>

</div>

	@endsection
