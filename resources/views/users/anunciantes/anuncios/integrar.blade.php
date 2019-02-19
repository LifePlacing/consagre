@extends('users.layouts.default')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class=" col-xs-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Integre seus sistemas ao nosso portal</h4>
                                <p>A integração de sistemas permite automatizar a publicação dos seus anúncios.</p>                                
                            </div>
                            <div class="content">
                            	<form method="post" action="{{ route('anunciante.parse.xml') }}" autocomplete="off">
                                	@csrf

                                	<div class="row">
                                		
                                		<div class="col-xs-12 col-md-4">
                                    		<div class="form-group">
                                                <label for="sistema">Sistema</label>
                                                <select name="sistema" class="form-control" data-placement="bottom" required="required" id="sistema">
                                                	<option> Selecione o Sistema para integração </option>
                                                	<option value="inGaia">inGaia</option>
                                                	<option value="Code49">Code49</option>
                                                	<option value="Coruja Sistemas">Coruja Sistemas</option>
                                                </select>	
                                    		</div>
                                    	</div>

                                		<div class="col-xs-12 col-md-6">
                                			<div class="form-group">
                                				<label for="url">XML de Integração</label>
                                				<input type="text" name="url" required="required" placeholder="URL para integração do sistema" class="form-control" id="url">
                                				<span id="helpBlock" class="help-block">Esta informação você pode solicitar ao suporte do seu sistema.</span>
                                			</div>
                                		</div>
                                	</div>

                                	<hr>

                                	<button type="submit" class="btn btn-info btn-fill pull-right">Cadastrar Sistema</button>

                                    <div class="clearfix"></div>

                                </form>	

                                @if(!empty($xml) && $xml->count() > 0)

	                                <div class="row">
	                                	
	                                	<div class="col-xs-12 col-md-12">
	                                		
	                                		<h4 class="title"> Sistemas Ativos </h4>

	                                	</div>

	                                	<div class="col-xs-12 col-md-12">
	                                		
	                                		<table class="table">
	                                			
	                                			<tr>
	                                				<th>Sistema</th>
	                                				<th>URL</th>
	                                				<th>Ações</th>
	                                			</tr>
	                                			
                                				@foreach($xml as $item)
                                					<tr>
                                						<td>{{ $item->sistema }}</td>
                                						<td>{{ $item->url }}</td>
                                						<td>
                                						<a href="#" onclick="event.preventDefault();
                                                document.getElementById('ler-form-{{$item->id}}').submit();" title="visualizar anuncios enviados">
                                                        <i class="fa fa-eye fa-lg" aria-hidden="true"></i>&nbsp;
                                                        </a>
                                							
                                						<a href="#" onclick="event.preventDefault();
												document.getElementById('delete-form-{{$item->id}}').submit();" title="deletar">
                                							<i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>&nbsp;
                                						</a>


                                                        <a href="#" onclick="event.preventDefault();
                                                document.getElementById('atualiza-form-{{$item->id}}').submit();" title="Atualizar lista de anúncios">
                                                        <i class="fa fa-refresh fa-lg" aria-hidden="true"></i>&nbsp;

                                                        </a>

                                                        <form id="ler-form-{{$item->id}}" action="{{ route('anunciante.xml.leitura') }}" method="POST" style="display: none;">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                                        </form>
                                						
														<form id="delete-form-{{$item->id}}" action="{{ route('anunciante.parseXml.delete') }}" method="POST" style="display: none;">
														    @csrf
														    <input type="hidden" name="id" value="{{ $item->id }}">
														</form>


                                                        <form id="atualiza-form-{{$item->id}}" action="{{ route('anunciante.parseXml.update') }}" method="POST" style="display: none;">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                                        </form>
                                						</td>
                                					</tr>
                                				@endforeach


	                                		</table>

	                                	</div>

                                        <div class="clearfix"></div>

	                                </div>

                                @endif

                            </div>




                        </div>
                    </div>
                </div>


            </div>
        </div>

@endsection