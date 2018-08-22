@extends('layouts.head')

@section('content')

<div class="container" id="conteudo">

	<section id="lancamentos">

	<h2>Lançamentos</h2>

	<ul id="tabLanc" class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<a id="venda-tab" href="#avenda" class="nav-link active" data-toggle="tab" role="tab" aria-controls="avenda" aria-selected="true"> Venda</a>
		</li>
		<li class="nav-item">
			<a id="aluguel-tab" href="#aluguel" class="nav-link" data-toggle="tab" role="tab" aria-controls="aluguel" aria-selected="false"> Aluguel</a>
		</li>

	</ul>

	<div class="tab-content" id="ContentLanc">

	  	<div class="tab-pane fade show active" id="avenda" role="tabpanel" aria-labelledby="avenda-tab">
	  			@foreach($imoveislist as $i => $imovel)
	  					 @if($imovel->meta == 'venda')

	  					 	{{$imovel->id}}

	  					 	<!--@foreach($imovel->media as $medias)
                                    <img class="img-fluid img-thumbnail" src="{{asset('/imagens/imoveis/'.$medias->source)}}">
                             @endforeach-->
	  					 @endif 
	  			@endforeach	
		</div>
	  <div class="tab-pane fade" id="aluguel" role="tabpanel" aria-labelledby="aluguel-tab">

	  			@foreach($imoveislist as $i => $imovel)
	  					
	  					 @if($imovel->meta == 'aluguel' and $imovel->status == 0)

	  					 	{{$imovel->id}}

							 <!-- 					 	
	  					 	@foreach($imovel->media as $medias)
                                    <img class="img-fluid img-thumbnail" src="{{asset('/imagens/imoveis/'.$medias->source)}}">
                             @endforeach	 
                         	--> 					 	

	  					 @endif	
	  			@endforeach	  

	  </div>	  

	</div>	

	</section>

	<section id="cidades">

	<h2>Buscar por Cidade</h2>

	<ul class="nav nav-tabs" id="myTab" role="tablist">
	  <li class="nav-item">
	    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Litoral Sul</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Região de Santos</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Outras Cidades</a>
	  </li>
	</ul>
	<div class="tab-content" id="myTabContent">
	  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
	  	
	  	Cananeia, Iguape, Ilha Comprida, Itanhaém, Mongaguá, Pedro de Toledo, Peruíbe

	  </div>
	  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	  	@foreach($regSantos as $g => $guaru)
	  				{{$guaru->titulo}}
	  				{{ $guaru->cep}}
	  	@endforeach
	  	Bertioga, Cubatão, Guarujá, Praia Grande, Santos, São Vicente

	  </div>
	  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
	  	
	  	7Barras, Cajati, Eldorado, Itariri, Jacupiranga, Juquiá, Miracatú, Pariquera Açu, Registro

	  </div>
	</div>
	</section>
</div>
@endsection