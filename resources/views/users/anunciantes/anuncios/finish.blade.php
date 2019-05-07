@extends('users.layouts.reorder')

<!-- Inicio do conteudo-->
@section('content')


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(isset($imovel))

<div class="content">

    <div class="container-fluid">

        <div class="row">
        	
        	<div class="panel">

        		<div class="header">

        			<div class="row">
        				<h4 class="title col-xs-12 col-sm-10"> Quase lá!! Confira uma prévia do seu anúncio: </h4>
        			</div>
        			
        		</div>

        		<div class="panel-body">

        			<div class="row">
        				
        				 <div class="col-xs-12 col-sm-12 col-md-12">

        				 	<div class="card">

        				 		<div class="content" id="sortable"> 

        				 		<div class="row">

        				 			<div class="col-sm-8 col-md-4">
        				 				
        				 				<div class="card card-preview">

			        				 		@foreach($imovel->media as  $media)	
			        				 			
			        				 			@if( $media->position === 0)
												<img src="{{ asset($media->source) }}" id="{{$media->position}}" class="img-thumbnail">
												@endif

											@endforeach	

											<div class="header">			 				 
			 									{{ formataMoney($imovel->preco) }}
			 								</div>

											<div class="content">

												<h3>{{$imovel->cidade->nome}}</h3>

									 				<div class="row">

									 					<div class="col-sm-3">
									 						<i class="fa fa-bed" aria-hidden="true"></i> {{$imovel->quartos}} 
									 					</div>
									 					<span>|</span>
									 					<div class="col-sm-3">
									 						<i class="fa fa-bath" aria-hidden="true"></i>
															{{$imovel->banheiros}}
														</div>
														<span>|</span>
														<div class="col-sm-3">
															{{$imovel->area_util}}m&#178;
														</div>

									 				</div>

											</div>
        				 					
        				 				</div>

        				 			</div>

        				 			<div class="col-sm-4 col-md-8">
        				 				
        				 				
        				 					<h4> Modificar a imagem principal? </h4>        				 		

        				 					 <button type="button" data-toggle="modal" data-target="#bibimg" 
        				 					 class="btn_destaque_img" >
  												{{ __('Selecionar Imagem') }}
											</button>


											<div class="modal fade" id="bibimg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

											      <div class="modal-dialog" role="document">
											        <div class="modal-content">
											          <div class="modal-header">
											            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											                <span aria-hidden="true">&times;</span>
											            </button>
											            
											            <h4 class="modal-title" id="myModalLabel">Selecione a imagem principal do anuncio</h4>

											          </div>
											          <div class="modal-body">

			        				 					<ul class="list-img">

				        				 					@foreach($imovel->media as $media)

				        				 					<a href="#" class="{{ $media->position === 0 ? 'active' : '' }}" onclick="event.preventDefault();document.getElementById('img-form-{{ $media->id }}').submit();">

															  <li>											
																
															    <div>
																	<img src="{{ asset($media->source) }}" id="{{ $media->position }}" >									     
															    </div>									    
															   

															  </li>

															</a> 
																				

															<form id="img-form-{{$media->id}}" method="POST" style="display: none;" action="{{ route('update.medias') }}">
															    
															    @csrf
															    <input type="hidden" name="id" value="{{$media->id}}">

															</form>
															
															@endforeach 

														</ul> 										               

											          </div>

											        </div>
											      </div>
											    </div>

        				 				
        				 					
        				 					<h4>Sequencia de Imagens do slide: </h4>

        				 					<div class="gallery">

		 										<div class="loading" id="load_message">
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

	        				 					<ul class="reorder_ul reorder-photos-list " >

		        				 					@foreach($imovel->media->sortBy('position') as  $media)	
														
														@if( $media->position !== 0)

														<li class="ui-sortable-handle" id="image_li_{!!$media->id!!}">
															<img src="{{ asset($media->source) }}" >
															<span> {!! $media->position !!} </span>
														</li>    

													    @endif 												  

													@endforeach	

												</ul> 

											</div>	

    										<div id="reorderHelper" class="light_box" style="display:none;">
    											1. Arraste as fotos para reordenar conforme desejado.<br>
    											2. Clique em "Salvar Nova Posição" quando terminar.
    										</div>	

    										<a href="javascript:void(0);" class="reorder_link" id="saveReorder">Editar Sequencia de Fotos</a>			




        				 				
       				 				
        				 			</div>

        				 		</div>			       				 		
        				 		


        				 		
        				 		</div>

        				 	</div>


        				 </div>

        			</div>

        			<div class="row">

        				<a href="{{ route('forget.sessao.anuncio') }}" class="btn btn-lg col-md-8 col-md-offset-2" id="finalizar">Finalizar cadastro do Imóvel</a>
        			</div>
        			
        			
        		</div>
        	</div>

	        </div>
    </div>

</div>  
	
@endif

@stop

