@extends('layouts.head')

@section('content')

<div class="container grid-right" >

	<div class="wrapleft">

		<div class="imovel_top">
			<h2>{{$propriedade->titulo}}</h2>
			<p>{{$propriedade->logradouro}}
				<i class="fa fa-angle-double-right" ></i>
				 {{$propriedade->cidade->nome}}
				 <i class="fa fa-angle-double-right"></i>
				 {{$propriedade->estado}} 
			</p>
		</div>

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

				@for($i=0; $i < $propriedade->media->count(); $i++)
						<div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
							<img class="d-block w-100" src="{{asset($propriedade->media[$i]->source)}}" 
							alt="{{ $propriedade->media[$i]->source }}">
						</div>
				@endfor



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
		<p>{{ $propriedade->descricao }}</p>
		
	</div>	
			

		
	</div>

@endsection

@section('sidebar-right')

	<div class="sidebar-right">
		

		<div class="painel">			
			<div class="titulo">
				<p>{{$propriedade->meta}}</p>				
				<h2 class="preco">{{ formataMoney($propriedade->preco) }}</h2>
			</div>

			<ul>
				<li>
					<i class="fa fa-area-chart fa-2x"></i>
					<br>Área Total
					<p>{{$propriedade->area_total}} m<sup>2</sup></p>
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

			<div class="titulo">
				<p>Contate o anunciante!</p>

			</div>	
			<div class="inline">

				<div class="col-4">
					<div class="thumbnail">
						<img src="{{asset('images/profile.png')}}" class="rounded-circle">
					</div>
				</div>

				<div class="col-8">
					<div class="nome">{{ $usuario->name }}</div>			
					<div class="tel"> {{formataPhone($usuario->phone)}}</div>	
				</div>

			</div>
		
			<form id="contatar_anunciante">

				<div class="form-group">
					<label for="InputMensagem">Mensagem</label>
					<textarea id="InputMensagem" class="form-control" rows="3"> </textarea>
				</div>

				  <div class="form-group">
				    <label for="InputNome">Nome</label>
				    <input type="text" class="form-control" id="InputNome" aria-describedby="nome" placeholder="Nome">
				  </div> 

				  <div class="form-group">
				    <label for="InputEmail1">Email</label>
				    <input type="email" class="form-control" id="InputEmail1" placeholder="Email">
				  </div>   	

				  <div class="form-group">
				    <label for="InputPhone">DDD e Telefone</label>
				    <input type="tel" class="form-control" id="InputPhone" placeholder="Telefone para contato">
				  </div> 

				  <input type="submit" class="btn btn-danger" value="CONTATAR ANUNCIANTE">				  					

			</form>			

			
		</div>



	</div>

</div>
@endsection

@section('relacionados')
	@parent
	@include('app.inc.relacionados')
@endsection



