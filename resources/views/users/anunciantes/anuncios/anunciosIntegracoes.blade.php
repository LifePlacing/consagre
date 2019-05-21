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

                                <a href="" onclick="event.preventDefault(); document.getElementById('ativar-todos').submit();" class="btn btn-primary btn-lg">Ativar Anúncios
                                
                                </a>

                                <form id="ativar-todos" action="{{ route('anunciosemmassa.corujas') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="url" value="{{$url}}">
                                </form>


		                      @foreach( $anun_integracoes['Listing'] as $key => $list )

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                          <div class="col-xs-12 col-md-3">
                                            <?php $url = preg_replace("/^http:/i", "https:", $list['Media']['Item'][0] )?>
                                            <a href="#" class="thumbnail">       
                                              <img src="{{ $url }}" alt="">
                                            </a>
                                          </div>
                                          <div class="col-xs-12 col-md-9">

                                                <div class="titulo-lista-imovels">
                                                    <h5>{{ $list['Title'] }}</h5>
                                                    
                                                    <span>
                                                        {{ __('imovels.'.$list['TransactionType']) }} 
                                                    </span>   
                                                </div>

                                              Código: <span>{{ $list['ListingID'] }}</span>

                                              <div class="icones-imovels">

                                                <div>
                                                    <i class="fa fa-bed fa-lg" aria-hidden="true"></i><br>
                                                    {{ $list['Details']['Bedrooms']}} quartos
                                                </div>
                                                <div>
                                                    <i class="fa fa-bath fa-lg" aria-hidden="true"></i><br>
                                                    {{ $list['Details']['Bathrooms']}}
                                                    banheiros
                                                </div>
                                                <div>
                                                    <i class="fa fa-area-chart fa-lg" aria-hidden="true"></i><br>
                                                    {{ $list['Details']['ConstructedArea'] }}m<sup>2</sup>
                                                </div>
                                                <div>
                                                    <i class="fa fa-car fa-lg" aria-hidden="true"></i><br>
                                                    {{ $list['Details']['Garage']}} garagem
                                                </div>
                                                    
                                                  
                                              </div>
                                          </div>
                                    </div>                                    
                                </div>

		                      @endforeach


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