@if(isset($super) && !empty($super))

	@foreach ($super as $item)

		<div class="card-imovel" onclick="window.location='/{{ slugTitulo($item->titulo)}}/{{$item->id}}/{{$item->meta}}/{{$item->cidade->slug}}'">

			<div id="superDestaquesSlide" class="carousel slide" data-ride="carousel">
				  
				  <div class="slide-dest carousel-inner">

					@foreach($item->media as $key => $medias)	

						@if($key == 0)
						    <div class="carousel-item active">				        
						        <img class="img-dest" src="{{ asset($medias->source) }}">
						    </div>
						@else
						    <div class="carousel-item">
						      <img class="img-dest" src="{{ asset($medias->source) }}">
						    </div>
						@endif
					
					@endforeach

				</div>

			</div>		    			    	


			<div class="card-imovel-box">

				<div class="col-pesquisa">

					<div class="valor-preco">
						{{ formataMoney($item->preco) }}
					</div>
					
					@if($item->tipo_de_anuncio == 'destaque' || $item->tipo_de_anuncio == 'super')
							<div class="etiqueta">{{ $item->tipo_de_anuncio == 'super' ? 'Super Destaque' :  $item->tipo_de_anuncio}}</div>
					@endif
					

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

	<hr>	

@endif