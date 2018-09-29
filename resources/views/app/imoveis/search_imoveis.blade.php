@extends('layouts.head')

@section('breadcrumbs')
	@parent
	@include('app.inc.breadcrumbs')
@endsection



	@section('sidebar')

<div class="container container-grid" >

		<div class="sidebar">

			<form>
				<div class="widget">
					<h2>Localização do Imóvel</h2>
					<div class="form-group">
						<input type="text" name="" class="form-control" placeholder="Qual Cidade da Baixada Santista?">
					</div>

					<h2>Tipo de Imóvel</h2>
					<div class="form-group">
						<input type="text" name="" class="form-control">
					</div>

					<div class="valores">
						<h2>Preço Minimo</h2>
						<h2>Preço Máximo</h2>						
					</div>

					<div class="form-inline">
					<input type="text" name="" placeholder=" R$ 0.00 " class="form-control mb-2 mr-sm-2 preco">
					<input type="text" name="" placeholder=" R$ ilimitado" class="form-control mb-2 mr-sm-2 preco ">
					</div>

					<h2>Número de Quartos</h2>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="customCheck1">
						<label class="custom-control-label" for="customCheck1"> 1 </label>
					</div>
					<div class="custom-control custom-checkbox">	
						<input type="checkbox" class="custom-control-input" id="customCheck2">
						<label class="custom-control-label" for="customCheck2"> 2 </label>
					</div>
					<div class="custom-control custom-checkbox">	
						<input type="checkbox" class="custom-control-input" id="customCheck3">
						<label class="custom-control-label" for="customCheck3"> 3 </label>
					</div>
					<div class="custom-control custom-checkbox">	
						<input type="checkbox" class="custom-control-input" id="customCheck4">
						<label class="custom-control-label" for="customCheck4"> +4</label>
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
						<input type="checkbox" class="custom-control-input" id="v1">
						<label class="custom-control-label" for="v1"> 1 </label>
					</div>
					<div class="custom-control custom-checkbox">	
						<input type="checkbox" class="custom-control-input" id="v2">
						<label class="custom-control-label" for="v2"> 2 </label>
					</div>
					<div class="custom-control custom-checkbox">	
						<input type="checkbox" class="custom-control-input" id="v3">
						<label class="custom-control-label" for="v3"> 3 </label>
					</div>
					<div class="custom-control custom-checkbox">	
						<input type="checkbox" class="custom-control-input" id="v4">
						<label class="custom-control-label" for="v4"> +4</label>
					</div>

				</div>
			</form>
			
		</div>

	@endsection

	@section('content')

	<div class="wrap">

		<h2>Resultados para pesquisa:
			@if(isset($search)) 
				@if(count($search) > 0)
					<small> {{ count($search)}} </small> 
				@endif 

			@elseif(isset($lista) || count($search) === 0)
				<small>Não encontramos resultados</small>
			@endif
		</h2>

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
				
				<div class="col-md-3">
					<div class="valor-preco">
						{{ formataMoney($item->preco) }}
					</div>

					<ul>
						<li><i class="fa fa-bed" aria-hidden="true"></i>
							{{ $item->quartos }}@if($item->quartos > 1) quartos @else quarto @endif
							
						</li>
						<li><i class="fa fa-bath" aria-hidden="true"></i>
							@if($item->suites != 0 && $item->suites === 1) {{ $item->suites }} suíte @else  {{ $item->suites }} suítes @endif
						</li>
						<li><i class="fa fa-car" aria-hidden="true"></i>
							@if($item->garagem != 0 && $item->garagem === 1) {{ $item->garagem }} vaga @else  {{ $item->garagem }} vagas @endif
						</li>
						<li><i class="fa fa-area-chart" aria-hidden="true"></i>
							{{ $item->area_total }} m<sup>2</sup>	
						</li>
					</ul>




				</div>
				<div class="col-md-9">					
					<div class="titulo">
						<h5>{{$item->bairro}}</h5>
						<p>{{$item->logradouro}}
							<i class="fa fa-angle-double-right" ></i>
							 {{$item->cidade->nome}}
							 <i class="fa fa-angle-double-right"></i>
							 {{$item->estado}} 
						</p>
					</div>
					<pre>{{ str_limit($item->descricao, $limit = 140, $end = '...') }}</pre>
					<small> 
						Atualizado em : {!! (date('d/m/Y',strtotime($item->updated_at))) !!}
					</small>

					<div class="card-bottom">
						<a href="#">Ver telefone</a>
						<button class="btn">MENSAGEM</button> 						
					</div>

				</div>


			</div>
			    	
			</div>

			@endforeach


		@elseif(isset($lista) && count($lista) > 0)	

			@foreach ($lista as $item)			

			<div class="card-imovel" onclick="window.location='/{{ slugTitulo($item->titulo)}}/{{$item->id}}/{{$item->meta}}/{{$item->cidade->slug}}'" >	
			    @foreach($item->media as $key => $medias)
			    	@if($key == 0)
			    	<img class="img-fluid img-dest" src="{{asset($medias->source)}}">
			    	@endif

			    @endforeach

			<div class="card-imovel-box">
				
				<div class="col-md-3">
					<div class="valor-preco">
						{{ formataMoney($item->preco) }}
					</div>

					<ul>
						<li><i class="fa fa-bed" aria-hidden="true"></i>
							{{ $item->quartos }}@if($item->quartos > 1) quartos @else quarto @endif
							
						</li>
						<li><i class="fa fa-bath" aria-hidden="true"></i>
							@if($item->suites != 0 && $item->suites === 1) {{ $item->suites }} suíte @else  {{ $item->suites }} suítes @endif
						</li>
						<li><i class="fa fa-car" aria-hidden="true"></i>
							@if($item->garagem != 0 && $item->garagem === 1) {{ $item->garagem }} vaga @else  {{ $item->garagem }} vagas @endif
						</li>
						<li><i class="fa fa-area-chart" aria-hidden="true"></i>
							{{ $item->area_total }} m<sup>2</sup>	
						</li>
					</ul>

				</div>
				<div class="col-md-9">					
					<div class="titulo">
						<h5>{{$item->bairro}}</h5>
						<p>{{$item->logradouro}}
							<i class="fa fa-angle-double-right" ></i>
							 {{$item->cidade->nome}}
							 <i class="fa fa-angle-double-right"></i>
							 {{$item->estado}} 
						</p>
					</div>
					<pre>{{ str_limit($item->descricao, $limit = 140, $end = '...') }}</pre>
					<small> 
						Atualizado em : {!! (date('d/m/Y',strtotime($item->updated_at))) !!}
					</small>

					<div class="card-bottom">
						<a href="#">Ver telefone</a>
						<button class="btn">MENSAGEM</button> 						
					</div>

				</div>


			</div>
			    	
			</div>

			@endforeach

			{{ $lista->links() }}

		@endif

	</div>

</div>

	@endsection
