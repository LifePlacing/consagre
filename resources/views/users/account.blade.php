@extends('users.layouts.default')

@section('content')

<div class="panel panel-default">

  <div class="panel-heading">
    <h3 class="panel-title">Minha Conta</h3>
  </div>

  <div class="panel-body">

  	<div class="col-sm-12 col-md-2">
  		<p>Foto do Perfil: </p>
		<div class="panel panel-default">
			<div class="image panel-body">
				<img src="{{ asset(Auth::user()->foto) }}" class="image-avatar border-gray">
			</div>
		</div> 
  	</div>

  	<div class="col-sm-12 col-md-10 ">

		<div class="col-sm-12 col-md-12">
	  		<p>Nome Completo: </p>
	  		<div class="panel panel-default">
	  			<div class="panel-body">
	  				
	  				{{ Auth::user()->sobrenome == '' ? Auth::user()->name : Auth::user()->name .' '. Auth::user()->sobrenome }} 
	  			</div>
	  		</div>
		</div>

  		<div class="col-sm-6 col-md-6">
	  		<p>Email:</p>
	  		<div class="panel panel-default">
	  			<div class="panel-body">	  				
	  				{{ Auth::user()->email }} 
	  			</div>
	  		</div>
  		</div>

  		<div class="col-sm-6 col-md-6">

  			<p>Telefone:</p>
	  		<div class="panel panel-default">
	  			<div class="panel-body">	  				
	  				{{ Auth::user()->phone == '' ? 'Precisa informar um telefone' : formataPhone(Auth::user()->phone) }} 
	  			</div>
	  		</div>

  		</div>  		

  		
  	</div>

  	<div class="col-sm-12 col-md-12 ">
  		  	<p>Sobre:</p>
	  		<div class="panel panel-default">
	  			<div class="panel-body">	  				
	  				<p>{{ Auth::user()->sobre == '' ? 'Neste espaço aconselhamos dar mais informações sobre você, para facilitar o contato com o cliente ou imobiliárias' : Auth::user()->sobre }} </p>
	  			</div>
	  		</div>  		
  	</div>

  	<a href="{{ route('perfil.show') }}" class="btn">Editar Informações</a>

  </div>
</div>
	

@endsection