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

	<div class="content">

	    <div class="container-fluid">

	        <div class="row">

	        	<div class="card">

	        		 <div class="header">
	        		 	
	        		 	<div class="row">
	        		 	 	<h4 class=" title col-sm-6 hidden-xs"> Mensagens <strong> Inbox </strong></h4>
	        		 	</div>
	        		 
	        		 </div>

					<div class="content">

						<div class="row">
						
							<div class="col-xs-12 col-sm-12 col-md-12">

								<div class="panel panel-default">

								@if( isset($mensagens) && !empty($mensagens))

									<div class="panel-body">

									<table class="table table-hover" width="100%">

								
									@foreach($mensagens as $msg)
											
										

										<tr>
											<td width="2%">
												<input type="checkbox" name="select">
											</td>

											<td width="96%" >

												<a href="{{ route('mensagem.inbox', [Auth::user()->id, $msg->id ]) }}" style="color: #222;">

												<table width="100%"  >

													<tr style=" {{ $msg->read_at == '' ? '': 'color:#7B7C7F; '}}">
														<td width="30%" >

														@if($msg->read_at == '')	
															<strong>
																{{ $msg->nome_remetente }} - <span class="label label-danger">new</span> 
															</strong>
														@else
															{{ $msg->nome_remetente }}
														@endif

														</td>

														<td width="60%" style=" {{ $msg->read_at == '' ? '': 'font-style: oblique; '}}">
															{{ abrevia($msg->msg) }}
														</td>

														<td width="10%" >	
														
															@if($msg->read_at == '')

															{{  $msg->created_at->format('d/m/Y') == $today->format('d/m/Y') ?  $msg->created_at->format('h:i:s') : $msg->created_at->format('d/m/Y') }}

															@else
																<span class="label label-success">
																	{{ $msg->read_at->format('d/m/Y') }}
																</span> 
															@endif
														</td>

													</tr>

												</table>

												</a>

											</td>

											<td width="2%">										
												<a href="#" onclick="ConfirmDialog('Deseja excluir esta mensagem?', {{$msg->id}} );" >
													<i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
												</a>
											</td>



											
										</tr>


									@endforeach

									</table>

									</div>
										
					
								</div>

								{{ $mensagens->links() }}

								@else

									<h2>Sem mensagens no momento.</h2>						

								
								@endif

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

@stop<!-- Fim do conteudo-->
