<div class="search">

	<div class="busca-filtro">

		<form method="post" action="{{route('buscaImoveis')}}">

			@csrf

			<div class="form-inline">

				<div class="form-group col-sm-4 col-xs-12 col-md-12">
					<span>Do que você precisa?</span>

					<div class="btn-group btn-group-toggle col-sm-12" 
					data-toggle="buttons">
						  <label class="btn btn-primary active">
						    <input type="radio" name="meta" id="comprar" value="venda"autocomplete="on" required checked="checked"> Comprar
						  </label>
						  <label class="btn btn-primary">
						    <input type="radio" name="meta" value="aluguel" id="alugar" autocomplete="on"> Alugar
						  </label>
						  <label class="btn btn-primary">
						    <input type="radio" name="meta" id="destaques" autocomplete="on" value="all"> Destaques
						  </label>

					</div>
					
				</div>

				
					<div class="form-group col-sm-4">
						<span>Qual tipo?</span>

						<select class="dropdown-toggle custom-select col-sm-12" name="imovel_type_id">
						   	<optgroup label="Todos">
						  		<option selected value="all">Todas os Imóveis</option>
							</optgroup>
							<optgroup label="Tipos">
						  @if(isset($tipos))

							@foreach($tipos as $tipo => $id)
						  		<option value="{{ $id }}" class="option">{{ $tipo }}</option>
						  	@endforeach

						  @endif
						  	</optgroup>
						</select>
					</div>

				    <div class="form-group col-sm-4">
				    	<span>Onde?</span>
				    	<select class="dropdown-toggle custom-select col-sm-12" name="cidade">
				    		<option selected value="all">Qual cidade do Litoral Paulista?</option>				    		
				    	@if(isset($cidades))
				    		@foreach($cidades as $nome => $id)
				       			<option value="{{ $id }}" class="option">{{ $nome }}</option>
				       		@endforeach
				       	@endif
				       </select>
				    </div>	

				</div>
			    
			    <a data-toggle="collapse" href="#searchAdvanced" aria-expanded="false" aria-controls="searchAdvanced" class="button_avancado">
					Busca Avançada						
				</a>

					<div class="collapse" id="searchAdvanced">
						<search-avc></search-avc>
					</div>	

				<button type="submit" class="btn-buscar">BUSCAR</button>

				

		</form>
	</div>	

	</div>