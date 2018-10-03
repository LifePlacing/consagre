@extends('layouts/head')
@section('title')
    Anunciar
    @parent
@stop
<!-- Scripts Globais -->
@section('header_styles')
    <link rel="stylesheet" href="{{asset('css/form-elements.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}"> 
@stop
<!-- Scripts Globais -->

@section('wizard')
	@include('app.steps.master')
@endsection

<!-- Inicio do conteudo-->
@section('content')


<div class="container">

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

    <div class="form-group text-justify">

            <h5><i class="fa fa-image"></i>
                Selecione as melhores fotos para seu anuncio:
            </h5>

    </div>  
    
    <fotos></fotos>
    <br>
    
    <p class="info"> 
        <span>*</span>Não esqueça de enviar suas fotos antes de prosseguir com o cadastro
    </p>

    <form  action="/anunciar/anunciar-step2" role="form" method="POST" class="f1" >

        <fieldset>
        {{ csrf_field() }}
           
            <div class="form-group col-sm-12">
                <label>Titulo do anuncio</label>
                <input type="text" name="titulo" id="titulo" class="char-count form-control required" value="{{ old('titulo') }}" placeholder="Digite até 50 caracteres para seu titulo" maxlength="50" autocomplete="off">
                <p class="text-muted"><small><span name="titulo">50</span></small> caracteres restantes</p>
            </div>  

            <div class="form-group col-sm-12">
                <label for="descricao">Descrição</label>
                <textarea placeholder="Crie aqui seu texto falando sobre as principais caracteristicas do seu imóvel."
                id="descricao" name="descricao" rows="6" maxlength="400" class="col-sm-12 required char-count" value="{{ old('descricao') }}">
                </textarea>
                <p class="text-muted"><small><span name="descricao">400</span></small> caracteres restantes</p>
            </div>


            <div class="f1-buttons">    
                <button type="button" onclick="javascript: history.go(-1)" 
                class="btn-wizard btn-previous">Voltar</button>
                <button type="submit" class="btn-wizard btn-next">Continuar</button>
            </div>


        </fieldset>
    </form>
@else
    <center><i class="fa fa-warning fa-5x"></i></center>
    <h2>Você precisa cadastrar um imóvel válido !</h2>
    <a class="button btn-danger" href="{{url('/anunciar')}}">Cadastrar um Imóvel</a>

@endif

</div>
@stop<!-- Fim do conteudo-->


@section('footer_scripts')
<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js">    
</script> 
<script type="text/javascript">
    $("#cpf").mask("999.999.999-99");
    $("#phone").mask("(00) 00000-0000");
</script> 
@stop