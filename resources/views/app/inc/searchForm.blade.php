			<form method="post" action="{{ route('buscaImoveis') }}">

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
					autocomplete="off" >
					<input type="text" name="maxpreco" placeholder="+ de 50.000" class="form-control mb-2 mr-sm-2 preco " autocomplete="off" >
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