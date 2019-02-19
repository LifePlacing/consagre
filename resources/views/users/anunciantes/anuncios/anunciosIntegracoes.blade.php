@extends('users.layouts.default')

@section('content')
	
	@if(session('anun_integracoes'))

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class=" col-xs-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">{{ session('header') ? $header['Provider'] : 'Anuncios Enviados Recentemente' }}</h4>
                                <p>Anuncios enviados em: {{ date_br($header['PublishDate']) }}.</p>                                
                            </div>
                            <div class="content">

                            	<div class="table-responsive">

                            		<table class="table">

		                    			<tr>
		                        			<th>Código</th>
		                        			<th>Titulo</th>
		                        			<th>Descrição</th>
		                        			<th>Ações</th>
		                        		</tr>

		                            	@foreach( $anun_integracoes['Listing'] as $key => $list )


		                            		<tr>
		                            			<td>{{ $list['ListingID'] }}</td>
		                            			<td> {{ $list['Title'] }}</td>

		                            			<td> {!! $list['Details']['Description'] !!}

		                            			</td>
		                            			<td> 
		                            				<a href="#" onclick="event.preventDefault();      document.getElementById('ativar-form-{{$key}}').submit();"> Ativar</a> 

		                            				<a href="#" onclick="event.preventDefault();
                                                document.getElementById('detalhes-form-{{$key}}').submit();" title="Detalhes do anúncio"> Detalhes</a> 



                                                        <form id="detalhes-form-{{$key}}" action="{{ route('single.xml.detalhes') }}" method="POST" style="display: none;">
                                                            @csrf
                                                            <input type="hidden" name="ListingID" value="{{ $list['ListingID'] }}">
                                                            <input type="hidden" name="url" value="{{$url}}">
                                                        </form>

                                                        <form id="ativar-form-{{$key}}" action="{{ route('ativarAnuncioXml') }}" method="POST" style="display: none;">
                                                            @csrf
                                                            <input type="hidden" name="ListingID" value="{{ $list['ListingID'] }}">
                                                            <input type="hidden" name="url" value="{{$url}}">
                                                        </form>
		                            			</td>
		                            		</tr>

		                            	@endforeach

	                            	</table>

                            	</div>

                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>	
    
    @elseif(session('anun_integracoes_ingaia'))

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class=" col-xs-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sistema inGaia</h4>                                      
                            </div>
                            <div class="content">

                                <div class="table-responsive">

                                    <table class="table">

                                        <tr>
                                            <th>Código</th>
                                            <th>Titulo</th>
                                            <th>Url</th>
                                            <th>Ações</th>
                                        </tr>

                                        @foreach( $anun_integracoes_ingaia['Imovel'] as $key => $list )


                                            <tr>
                                                <td>{{ $list['CodigoImovel'] }}</td>
                                                <td> {{ $list['TituloImovel'] }}</td>

                                                <td> 
                                                    
                                                </td>
                                                <td> 
                                                    <a href="#" onclick="event.preventDefault();      document.getElementById('ativar-form-{{$key}}').submit();"> Ativar</a> 

                                                    <a href="#" onclick="event.preventDefault();
                                                document.getElementById('detalhes-form-{{$key}}').submit();" title="Detalhes do anúncio"> Detalhes</a> 



                                                        <form id="detalhes-form-{{$key}}" action="{{ route('single.xml.detalhes') }}" method="POST" style="display: none;">
                                                            @csrf
                                                            <input type="hidden" name="ListingID" value="{{ $list['CodigoImovel'] }}">
                                                            <input type="hidden" name="url" value="{{$url}}">
                                                        </form>

                                                        <form id="ativar-form-{{$key}}" action="{{ route('ativarAnuncioIngaia') }}" method="POST" style="display: none;">
                                                            @csrf
                                                            <input type="hidden" name="ListingID" value="{{ $list['CodigoImovel'] }}">
                                                            <input type="hidden" name="url" value="{{$url}}">
                                                        </form>
                                                </td>
                                            </tr>

                                        @endforeach

                                    </table>

                                </div>

                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>


	@else
		<h2>Não Existe anuncios para este sistema</h2>
	@endif

@endsection