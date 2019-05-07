@extends('users.layouts.default')

@section('content')

<div class="content">

    <div class="container-fluid">

        <div class="row">

                <div class="card">

                	<div class="header">

                            <div class="row">
                            	<h4 class="title col-xs-12 col-sm-12">
                                    Lista de Imóveis Anunciados
                                </h4>
                            </div>
                            
                    </div>

                    <div class="content">

                    	<div class="row">

                    		<div class="col-xs-12 col-sm-12 col-md-12">
                    			@isset($imoveis)
                    				<table class="table">
                    					
                    					<th>Código</th>
                    					<th>Meta</th>
                    					<th>Titulo</th>
                    					<th>Preço</th>
                    					<th>Ações</th>


	                    				@foreach($imoveis as $destaque)
	                    				<tr>
	                    							
	                    					<td>{{ formatCodigo($destaque->codigo) }}</td>		
	                    					<td>{{ $destaque->meta }}</td>
	                    					<td>{{ $destaque->titulo }}</td>
	                    					<td>{{ formataMoney($destaque->preco_venda) }}</td>
	                    					<td>
	                    						<a href="{{route('index')}}/{{slugTitulo($destaque->titulo)}}/{{$destaque->id}}/{{$destaque->meta}}/{{ $destaque->cidade->slug }}">
	                    							<i class="fa fa-eye" aria-hidden="true"></i>
	                    						</a>

	                    						<i class="fa fa-pencil" aria-hidden="true"></i>

												<a href="#" onclick="event.preventDefault();
												document.getElementById('delete-form-{{$destaque->id}}').submit();">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</a>  

												<form id="delete-form-{{$destaque->id}}" action="{{ route('apagarImovel') }}" method="POST" style="display: none;">
												    @csrf
												    <input type="hidden" name="id" value="{{ $destaque->id }}">
												</form>
	                    						
	                    					</td>
	                    					
	                    				</tr>

	                    				@endforeach

                    				</table>
                    			@endif
                    		</div>

                    	</div>

                    </div>

                </div>
        </div>

    </div>
    
</div>      
@endsection