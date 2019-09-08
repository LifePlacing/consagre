@extends('users.layouts.default')

@section('content')
	
	@if(session('anun_integracoes'))

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class=" col-xs-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">{{ session('header') || isset($header) ? $header->Provider : 'Anuncios Enviados Recentemente' }}</h4>
                                <p>Anuncios enviados em: {{ date_br($header->PublishDate) }}.</p>                                
                            </div>
                            <div class="content">

                                <a href="" onclick="event.preventDefault(); document.getElementById('ativar-todos').submit();" class="btn btn-primary btn-lg">Ativar Anúncios
                                
                                </a>

                                <form id="ativar-todos" action="{{ route('anunciosemmassa.corujas') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="url" value="{{$url}}">
                                </form>


		                      @foreach( $anun_integracoes->Listing as $key => $list )

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                          <div class="col-xs-12 col-md-3">
                                            <?php $url = preg_replace("/^http:/i", "https:", $list->Media->Item[0] )?>
                                            <a href="#" class="thumbnail">       
                                              <img src="{{ $url }}" alt="">
                                            </a>
                                          </div>
                                          <div class="col-xs-12 col-md-9">

                                                <div class="titulo-lista-imovels">
                                                    <h5>{{ $list->Title }}</h5>
                                                    
                                                    <span>
                                                        {{ __('imovels.'.$list->TransactionType) }} 
                                                    </span>   
                                                </div>

                                              Código: <span>{{ $list->ListingID }}</span>

                                              <div class="icones-imovels">

                                                <div>
                                                    <i class="fa fa-bed fa-lg" aria-hidden="true"></i><br>
                                                    {{ $list->Details->Bedrooms}} quartos
                                                </div>
                                                <div>
                                                    <i class="fa fa-bath fa-lg" aria-hidden="true"></i><br>
                                                    {{ $list->Details->Bathrooms}}
                                                    banheiros
                                                </div>
                                                <div>
                                                    <i class="fa fa-area-chart fa-lg" aria-hidden="true"></i><br>
                                                    {{ $list->Details->ConstructedArea }}m<sup>2</sup>
                                                </div>
                                                <div>
                                                    <i class="fa fa-car fa-lg" aria-hidden="true"></i><br>
                                                    {{ $list->Details->Garage}} garagem
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

                                <a href="" onclick="event.preventDefault(); document.getElementById('ativar-todos').submit();" class="btn btn-primary btn-lg">Ativar Anúncios
                                
                                </a>

                                <form id="ativar-todos" action="{{ route('ativarAnuncioIngaia.all') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="url" value="{{$url}}">
                                </form>                                                                      
                            </div>

                            <div class="content">
                                                             
                              @foreach($anun_integracoes_ingaia->Imovel as $key => $list )

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                          <div class="col-xs-12 col-md-3">
                                          
                                        @if(isset($list->Fotos->Foto)) 
                                            @foreach($list->Fotos->Foto as $key => $foto)

                                                @if($foto->Principal == 1)
                                                    <a href="#" class="thumbnail">      
                                                        <img src="{{ replacehttps($foto->URLArquivo) }}" alt="">
                                                    </a>
                                                    @break
                                                @endif
                                            @endforeach
                                        @else
                                           <a href="#" class="thumbnail">      
                                                <img src="{{ url('imagens/consagre-imoveis-sem-imagem.png') }}" alt="">
                                            </a>
                                        @endif

                                                
                                          </div>
                                          <div class="col-xs-12 col-md-9">

                                                <div class="titulo-lista-imovels">
                                                    <h5>{!! $list->TituloImovel !!}</h5>
                                                    
                                                    <span>
                                                        @if( isset($list->PrecoVenda) )             
                                                         {{ __('imovels.For Sale') }}
                                                        @else
                                                        {{ __('imovels.For Rent') }}                   
                                                        @endif
                                                    </span>   
                                                </div>

                                              Código: <span>{!! $list->CodigoImovel !!}</span>

                                              <div class="icones-imovels">

                                                <div>
                                                    <i class="fa fa-bed fa-lg" aria-hidden="true"></i><br>
                                                    @isset($list->QtdDormitorios)
                                                        {!! $list->QtdDormitorios !!} quartos
                                                    @endif

                                                </div>
                                                <div>
                                                    <i class="fa fa-bath fa-lg" aria-hidden="true"></i><br>
                                                    @isset($list->QtdBanheiros)
                                                    {!! $list->QtdBanheiros !!}         banheiros
                                                    @endif

                                                </div>
                                                <div>
                                                    <i class="fa fa-area-chart fa-lg" aria-hidden="true"></i><br>
                                                    @isset($list->AreaUtil)
                                                    {{ $list->AreaUtil }} m<sup>2</sup>
                                                    @endif
                                                </div>
                                                <div>
                                                    <i class="fa fa-car fa-lg" aria-hidden="true"></i><br>
                                                    @isset($list->QtdVagas)   {!! $list->QtdVagas !!} garagem
                                                    @endif
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
         

	@else
		<h2>Não Existe anuncios para este sistema</h2>
	@endif





@endsection