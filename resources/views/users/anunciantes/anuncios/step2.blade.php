@extends('users.layouts.default')


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

<div class="content" >

    <div class="container-fluid">

        <div class="row">

                <div class="card">

                    <div class="header">
                        <div class="row">
                            <h4 class="title col-sm-9">Completar Anúncio</h4>
                        </div>
                    </div> 

                    <div class="content">                    	

			            <h4>
			            	<i class="fa fa-image"></i> &nbsp;Selecione as melhores fotos para seu anuncio:
			            </h4>

			            <div class="row">
			            	<div class="col-sm-12">
						    	<fotos></fotos>	
							</div>
						</div>
						
						@isset($imovel->medias)

							<h4>
				            	Imagens já disponiveis :
				            	<p class="text-muted">Para substituir estas imagens, basta enviar novas imagens no formulário acima!</p>
	                            <div class="clearfix"></div>
				            </h4>

							<div class="row">

									    <div class="content all-icons">
									    	
	                                    @foreach($imovel->medias as $key => $media)
	                                    <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">                                    	
	                                    	<img class="img-amostra" src="{{asset($media)}}" >
	                                    	
	                                	</div>
	                                    @endforeach                                    

			                            </div>
							
							</div>

	                    @endif

				    <form role="form" method="POST" class="f1" >

				        <fieldset>

				        {{ csrf_field() }}
				           <div class="row">

				            <div class="form-group col-sm-12">
				                <label>Titulo do anuncio</label>
				                <input type="text" name="titulo" id="titulo" class="char-count form-control required" value="{{ old('titulo') }}" placeholder="Digite até 50 caracteres para seu titulo" maxlength="50" autocomplete="off" required>
				                <p class="text-muted"><small><span name="titulo">50</span></small> caracteres restantes</p>
				            </div> 

				            </div>
				            <div class="row"> 

				            <div class="form-group col-sm-12">
				                <label for="descricao">Descrição</label>
				                <textarea placeholder="Crie aqui seu texto falando sobre as principais caracteristicas do seu imóvel."
				                id="descricao" name="descricao" rows="6"  class="col-sm-12 required char-count" value="{{ old('descricao') }}" required>
				                </textarea>
				         </div>

				        	</div>

				            <div class="f1-buttons">    
				                <button type="button" onclick="javascript: history.go(-1)" 
				                class="btn-previous ">Voltar</button>
				                <button type="submit" class="btn-next btn btn-info btn-fill pull-right ">Continuar</button>
				                <div class="clearfix"></div> 
				            </div>


				        </fieldset>

				    </form>


                    </div>	

				</div>
		</div>

	</div>	

@else
	<div class="alert alert-danger">
		<p>Você não pode seguir sem antes cadastrar os dados do imóvel!</p>
		<a href="{{ route('adicionaImovelAnunciante') }}">Cadastrar Imóvel</a>
	</div>
	

@endif


@stop<!-- Fim do conteudo-->


@section('footer_scripts')
<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js/scripts.js?version=1.0')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 
<script type="text/javascript">
    $("#cpf").mask("999.999.999-99");
    $("#phone").mask("(00) 00000-0000");
    $('#preco').mask('#.##0,00', {reverse: true});
    $('#valor').mask('#.##0,00', {reverse: true, style: 'currency', currency: 'BRL'});
    $('#percent').mask('#.##0,00', {reverse: true});
    $('#iptu').mask('#.##0,00', {reverse: true});
    $('#condominio').mask('#.##0,00', {reverse: true});
</script> 
@stop
