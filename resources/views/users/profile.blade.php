@extends('users.layouts.default')


@section('content')

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}                  
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar Perfil</h4>
                            </div>
                            <div class="content">
                                <form>
                                	@csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                @if(isset(Auth::user()->cpf) && !empty(Auth::user()->cpf))
                                                <label>CPF (disabled)</label>
                                                <input type="text" class="form-control" 
                                                disabled placeholder="CPF" value="{{ Auth::user()->cpf }}">
                                                @else
                                                <label>CPF</label>
                                                <input type="text" class="form-control" placeholder="CPF" name="cpf">
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Telefone</label>
                                                <input type="text" class="form-control" placeholder="Telefone" value="{{ Auth::user()->phone }}" id="phone">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="email" class="form-control" placeholder="Email"
                                                	value=" {{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nome</label>
                                                <input type="text" class="form-control" placeholder="Nome" value=" {{ Auth::user()->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sobrenome</label>
                                                <input type="text" class="form-control" placeholder="Sobrenome" value="{{ Auth::user()->sobrenome}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Sobre</label>
                                                <textarea rows="5" class="form-control char-count" id="sobre" placeholder="Uma breve descrição sobre você ou sua empresa | Máximo 100 caracteres" name="sobre" maxlength="100"></textarea>
                                                <p class="text-muted"><small><span name="sobre">100</span></small> caracteres restantes</p>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Atualizar Perfil</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400"/>
                            </div>
                            <div class="content">
                                <div class="author">
                                	<form enctype="multipart/form-data" id="foto_perfil" method="post" action="{{ url('/usuario/profile/show') }}">
                                		@csrf
                                		<input type="file" name="foto" id="upload" /> 
                                		<input type="hidden" name="user" value="{{ Auth::user()->id }}">
                                	</form>

                                     <a href="javascript:void(0)"  id="upload_link">
                                    <img id="avatar" class="avatar border-gray" 
                                    src="{{ Auth::user()->foto == '' ? asset('users/img/faces/face-3.jpg') : asset( Auth::user()->foto ) }}" />
                                    </a>

                                      <h4 class="title">{{ Auth::user()->name }} 
                                      	 <br />
                                         <small>{{ Auth::user()->phone == '' ? ' Coloque seu contato ' : formataPhone( Auth::user()->phone )  }}</small>
                                      </h4>
                                    
                                </div>
                                <i><p class="description text-center">  {{ Auth::user()->sobre == '' ? 'Fale algo sobre você...' :  Auth::user()->sobre }}                                	
                                </p></i>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

@endsection