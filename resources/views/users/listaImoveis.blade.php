@extends('users.layouts.default')

@section('content')

        @if(Auth::user()->imovels->count())

			@foreach(Auth::user()->imovels as $key => $imovel)
	

			<div class="card-imovel" onclick="window.location='/{{ slugTitulo($imovel->titulo)}}/{{$imovel->id}}/{{$imovel->meta}}/{{$imovel->cidade->slug}}'">	
			    @foreach($imovel->media as $key => $medias)
			    	@if($key == 0)
			    	<img class="img-fluid img-dest" src="{{asset($medias->source)}}">
			    	@endif
			    @endforeach

			<div class="card-imovel-box">
				
				<div class="col-md-3">
					<div class="valor-preco">
						{{ formataMoney($imovel->preco) }}
					</div>

					<ul>
						<li><i class="fa fa-bed" aria-hidden="true"></i>
							{{ $imovel->quartos }}@if($imovel->quartos > 1) quartos @else quarto @endif
							
						</li>
						<li><i class="fa fa-bath" aria-hidden="true"></i>
							@if($imovel->suites != 0 && $imovel->suites === 1) {{ $imovel->suites }} suíte @else  {{ $imovel->suites }} suítes @endif
						</li>
						<li><i class="fa fa-car" aria-hidden="true"></i>
							@if($imovel->garagem != 0 && $imovel->garagem === 1) {{ $imovel->garagem }} vaga @else  {{ $imovel->garagem }} vagas @endif
						</li>
						<li><i class="fa fa-area-chart" aria-hidden="true"></i>
							{{ $imovel->area_total }} m<sup>2</sup>	
						</li>
					</ul>
				</div>
				<div class="col-md-9">					
					<div class="titulo">
						<h5>{{$imovel->bairro}}</h5>
						<p>{{$imovel->logradouro}}
							<i class="fa fa-angle-double-right" ></i>
							 {{$imovel->cidade->nome}}
							 <i class="fa fa-angle-double-right"></i>
							 {{$imovel->estado}} 
						</p>
					</div>
					<pre>{{ str_limit($imovel->descricao, $limit = 140, $end = '...') }}</pre>
					<small> 
						Atualizado em : {!! (date('d/m/Y',strtotime($imovel->updated_at))) !!}
					</small>

					<div class="card-bottom">
						<a href="#">Ver telefone</a>
						<button class="btn">MENSAGEM</button> 						
					</div>

				</div>


			</div>
			    	
			</div>

			@endforeach

   @endif  

@endsection