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
                    
                    @isset($imoveis)

                        @foreach($imoveis as $imovel)
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-xs-12 col-md-3">  
                                        <a href="#" class="thumbnail"> 
                                            @foreach($imovel->media as $media)
                                                @if($media->position == 0)
                                                <img src="{{ url_imovel($media->source) }}" alt="">
                                                @endif
                                            @endforeach
                                        </a>
                                    </div>
                                    <div class="col-xs-12 col-md-9">


                                        <div class="switch__container">
                                          <input onchange="Valid_id({!! $imovel->id !!})" id="switch-shadow-{{$imovel->id}}" class="switch switch--shadow" type="checkbox" {{ $imovel->status == 1 ? 'checked' : '' }} >
                                          <label for="switch-shadow-{{$imovel->id}}"></label>
                                        </div>                                 
                                        <div class="titulo-lista-imovels">
                                            <h5>{{ $imovel->titulo }}</h5>
                                            
                                            <span class="txt-meta">
                                                {{ $imovel->meta }}  

                                            </span> 
                                        </div>                                                    

                                      Código: <span>{{ $imovel->codigo }}</span>
                                      <div class="icones-imovels">
                                        <div>
                                            <i class="fa fa-bed fa-lg" aria-hidden="true"></i><br>
                                            {{ $imovel->quartos }} <small>quartos</small>
                                        </div>
                                        <div>
                                            <i class="fa fa-bath fa-lg" aria-hidden="true"></i><br>
                                            {{ $imovel->banheiros }}
                                            <small>banheiros</small>
                                        </div>
                                        <div>
                                            <i class="fa fa-area-chart fa-lg" aria-hidden="true"></i><br>
                                            {{ $imovel->area_total }}m<sup>2</sup>
                                        </div>
                                        <div>
                                            <i class="fa fa-car fa-lg" aria-hidden="true"></i><br>
                                            {{ $imovel->garagem }}<small> garagem</small>
                                        </div>
                                      </div>

                                      <div class="group-button">
                                          <a href="{{route('index')}}/{{slugTitulo($imovel->titulo)}}/{{$imovel->id}}/{{$imovel->meta}}/{{ $imovel->cidade->slug }}" class="btn btn-primary ">Visualizar</a>
                                          
                                          <a href="" class="btn btn-danger delete-imv" data-id="{{$imovel->id}}">Deletar</a>                                           
                                        
                                      </div>
                                        
                                        <form id="delete-form-{{$imovel->id}}" action="{{ route('apagarImovel') }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $imovel->id }}">
                                        </form>


                                    </div>                                    
                                </div>
                            </div>    
                        @endforeach


                        {{ $imoveis->links() }}

                    @endif

                    </div>

                </div>
        </div>

    </div>
    
</div>   

<div class="modal" tabindex="-1" role="dialog" id="modalDelete">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Atenção!!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Você deseja realmente apagar este anúncio? </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="continuar">Continuar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" id="modal-success">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    </button>
    </div>   
    <div class="alert" role="alert" id="msg">   
    </div>
   
  </div>
</div>


@endsection
