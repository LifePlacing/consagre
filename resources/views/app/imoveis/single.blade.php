@extends('layouts.head')

@section('title', $propriedade->titulo )


@section('content')

	<div class="h2">
		<h2> {{$propriedade->titulo}} </h2> <span></span>
	</div>

<div class="grid-right">

	<div class="wrapleft">

		<div class="meta">
			{{ formataMoney($propriedade->preco) }}
		</div>

		<div class="slider">

			<div id="SliderImoveis" class="carousel slide carousel-fade" data-ride="carousel">

				  <ol class="carousel-indicators">
				    @for($i=0; $i < $propriedade->media->count(); $i++)
				    	<li data-target="#SliderImoveis" data-slide-to="{{$i}}" class="{{ $i == 0 ? 'active' : '' }}"></li>
				    @endfor			    
				  </ol>


				<div class="carousel-inner">

					
					@foreach($propriedade->media->sortBy('position') as $media )

						@if($media->position !== null)
							<div class="carousel-item {{ $media->position == 0 ? 'active' : '' }}">
								<img class="d-block w-100" src="{{asset($media->source)}}" 
								alt="{{ $media->source }}">
							</div>
						@endif

					@endforeach

				</div>

				  <a class="carousel-control-prev" href="#SliderImoveis" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Anterior</span>
				  </a>
				  <a class="carousel-control-next" href="#SliderImoveis" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Próximo</span>
				  </a>


			</div>
			
		</div>
		

		<div class="descricao">
			<h2>Descrição</h2>

			<div class="imovel_top">
				<p class="text-white">{{$propriedade->logradouro}}
					<i class="fa fa-angle-double-right" ></i>
					 {{ $propriedade->cidade->nome }}
					 <i class="fa fa-angle-double-right"></i>
					 {{ $propriedade->estado }} 
				</p>
			</div>

			<p>{{ $propriedade->descricao }}</p>
			
		</div>	


			

		
	</div>

@endsection

@section('sidebar-right')

	<div class="sidebar-right">
		

		<div class="painel">			
			<div class="titulo">
				<p>{{$propriedade->meta}}</p>				
				<h2 class="preco">{{  $propriedade->meta == 'aluguel' ? formataMoney($propriedade->preco_venda) : formataMoney($propriedade->preco) }}</h2>
			</div>

			<ul>
				<li>
					<i class="fa fa-area-chart fa-2x"></i>
					<br>Área Total
					<p>{{$propriedade->area_util}} m<sup>2</sup></p>
				</li>
				<li>
					<i class="fa fa-bed fa-2x"></i>
					<br>Quartos
					<p>{{$propriedade->quartos}}</p>
				</li>
				<li>
					@if($propriedade->suites == 0)
					<i class="fa fa-bath fa-2x"></i>
					<br>Banheiro
					<p>{{$propriedade->banheiros}}</p>
					@else
					<i class="fa fa-bath fa-2x"></i>
					<br>Suites
					<p>{{$propriedade->suites}}</p>
					@endif
				</li>
				<li>
					<i class="fa fa-car fa-2x"></i>
					<br>Vagas
					<p>{{$propriedade->garagem}}</p>
				</li>
			</ul>

		</div>

		<div class="painel">

				<div class="loading d-none" id="load_message">
					<div class="sk-cube-grid" >
						  <div class="sk-cube sk-cube1"></div>
						  <div class="sk-cube sk-cube2"></div>
						  <div class="sk-cube sk-cube3"></div>
						  <div class="sk-cube sk-cube4"></div>
						  <div class="sk-cube sk-cube5"></div>
						  <div class="sk-cube sk-cube6"></div>
						  <div class="sk-cube sk-cube7"></div>
						  <div class="sk-cube sk-cube8"></div>
						  <div class="sk-cube sk-cube9"></div>
					</div>	
				</div>

				<div class="green d-none" id="success_message">

					<i class="fa fa-check fa-5x" aria-hidden="true"></i>
					<h2>Mensagem Enviada com Sucesso!</h2>

				</div>

			<div class="titulo">
				<p>Contate o anunciante!</p>
			</div>

			<div class="inline">

				<div class="col-4">
					
					<div class="thumbnail img-profile">

						@if( isset($usuario->foto))
							<img src="{{asset($usuario->foto)}}" class="rounded-circle" >
						@elseif(isset($propriedade->anunciante->logo))
							<img src="{{asset($propriedade->anunciante->logo)}}" class="rounded-circle" >
						@else
							<img src="{{asset('images/profile.png')}}" class="rounded-circle">
						@endif

					</div>

				</div>

				<div class="col-8">
					<div class="nome">{{ !isset($usuario->name) ? $propriedade->anunciante->nome : $usuario->name }}</div>			
					<div class="tel"> {{ empty($usuario) ? formataPhone($propriedade->anunciante->celular) : formataPhone($usuario->phone)}}</div>	
				</div>

			</div>
		
			<form id="contatar_anunciante" method="POST">

				@csrf

				<div id="response"></div>

				<input type="hidden" id="imv_id" name="imv_id" value="{{ isset($propriedade) ? $propriedade->id : 'null' }}">
				<div class="form-group">
					<label for="InputMensagem">Mensagem</label>
					<textarea id="InputMensagem" class="form-control {{ $errors->has('mensagem') ? 'is-invalid' : ''}}" rows="3" name="mensagem" required> 
					{{ old('mensagem') }}</textarea>
				</div>

				
    				<div class="invalid-feedback"> 
    					{{ $errors->first('mensagem') }} 
    				</div>
				

				  <div class="form-group">
				    <label for="InputNome">Nome</label>
				    <input type="text" class="form-control  {{ $errors->has('nome') ? 'is-invalid' : ''}}" id="InputNome" aria-describedby="nome" placeholder="Nome" name="nome" value="{{ old('nome') }}" required >
				  </div>

				@if($errors->has('nome'))
    				<div class="invalid-feedback" style="display: inline;"> 
    					{{ $errors->first('nome') }} 
    				</div>
				@endif


				  <div class="form-group">
				    <label for="InputEmail1">Email</label>
				    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" id="InputEmail1" placeholder="Email" name="email" value="{{ old('email') }}" required>
				  </div>  

				@if($errors->has('email'))
    				<div class="invalid-feedback" style="display: inline;"> 
    					{{ $errors->first('email') }} 
    				</div>
				@endif


				  <div class="form-group">
				    <label for="InputPhone">DDD e Telefone</label>
				    <input type="tel" class="form-control {{ $errors->has('telefone') ? 'is-invalid' : ''}}" id="InputPhone" placeholder="Telefone para contato" name="telefone" value="{{ old('telefone') }}" required>
				  </div> 

				@if($errors->has('telefone'))
    				<div class="invalid-feedback" style="display: inline;"> 
    					{{ $errors->first('telefone') }} 
    				</div>
				@endif

				<input id="contatar_btn" class="btn btn-danger" value="CONTATAR ANUNCIANTE" type="submit">	

		  					

			</form>			

			
		</div>



	</div>

</div>
@endsection

@section('relacionados')
	@parent
	@include('app.inc.relacionados')
@endsection


@section('footer_scripts')   

<!--<script type="text/javascript" src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>-->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script src="{{ asset('js/jquery.mask.min.js') }} "></script>

<script src="{{ asset('js/load-btn.js') }}"></script>

<script type="text/javascript">
    $("#InputPhone").mask("(00) 00000-0000");    
</script>

@endsection


