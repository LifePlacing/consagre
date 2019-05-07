@extends('admin/layouts/default')

    @section('title')
        Consagre Imoveis Admin
    @parent

    @section('header_styles')
    	<link href="{{ asset('admin/icon_fonts_assets/picons-thin/style.css') }}" rel="stylesheet">
      <link href="{{ asset('css/cube-btn.css') }}" rel="stylesheet">
      <meta name="csrf-token" content="{{ csrf_token() }}">

    @stop

@stop

@section('content')

<div class="element-wrapper">
	
	<h6 class="element-header">
		Gerenciar Planos de Anuncios
	</h6>
	<div class="element-box">


		<h5 class="form-header">
             Modifique os planos de acordo com seu gosto.
    </h5>

		<div class="form-desc">
			Muita atenção ao modificar estas opções, pois ao alterar os planos todos os usuários que estiverem vinculados a ele receberão também estas atualizações. Você também pode adicionar um novo plano e manter os usuários já cadastrados inalterados : <a href="" data-toggle="modal" data-target="#adicionar-planos">Cadastrar novo Plano</a>
		</div>

        <div class="table-responsive">

        @if(count($planos))

          @if(session('status') && session('status') === 200 )          
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
          @elseif(session('status') && session('status') === 500)
              <div class="alert alert-danger" role="alert">
                  {{ session('message') }}
              </div>
          @endif
          

          <table id="dataTable1" class="table table-striped table-lightfont" width="100%">
          		<thead>
          			<tr>
          				<th>Código</th><th>Plano</th><th>Anúncios Simples</th><th>Destaques</th><th>Super Destaques</th><th>Valor Mensal</th><th>Assinaturas</th><th>Ações</th>
          			</tr>
          		</thead>
          		<tbody>

          			@foreach($planos as $plano)
          			<tr>
          				<td>{{ $plano->codigo }}</td>
          				<td>{{ $plano->nome }}</td>
          				<td>{{ $plano->quant_anuncios == 0 ? 'Ilimitado' : $plano->quant_anuncios }}</td>
          				<td>{{ $plano->destaques == 0 ? 'Ilimitado' : $plano->destaques }}</td>
          				<td>{{ $plano->super_destaques == 0 ? 'Ilimitado' : $plano->super_destaques }}</td>
          				<td>{{ formataMoedaInteiro($plano->valor_mensal) }}</td>
          				<td>{{ count($plano->assinaturas) }}</td>
          				<td>
      							<a href="" alt="Editar" class="btn_icon edit_plan" data-assinaturas="{{ count($plano->assinaturas) }}" data-id="{{ $plano->id }}" 
                         >
      							&nbsp<i class="picons-thin-icon-thin-0002_write_pencil_new_edit"></i>&nbsp 
      							</a>
                    @if(!count($plano->assinaturas))
                      <a href="" alt="Remover" class="btn_icon btn-del" data-id="{{ $plano->id }}" data-planonome="{{ $plano->nome }}">
                        &nbsp<i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i>&nbsp 
                      </a>
                    @endif
          				</td>
          			</tr>
          			@endforeach

          		</tbody>
          </table>

         @else

         <h2>Sem planos cadastrados: <a href="" data-toggle="modal" data-target="#adicionar-planos"> Cadastrar Plano</a> </h2>

         @endif

      	</div>

        <!-- Modal para adicionar -->
        
        <div aria-hidden="true" aria-labelledby=" Adicionar Planos de Acesso" class="modal" role="dialog" tabindex="-1" id="adicionar-planos">

          <div class="modal-dialog modal-lg">

              <div class="loading d-none" id="load_message_add">
                <div class="sk-cube-grid" >
                    <div class="sk-cube sk-cube1"></div>
                    <div class="sk-cube sk-cube2"></div>
                    <div class="sk-cube sk-cube3"></div>
                    <div class="sk-cube sk-cube4"></div>
                    <div class="sk-cube sk-cube5"></div>
                    <div class="sk-cube sk-cube6"></div>
                    <div class="sk-cube sk-cube7"></div>
                    <div class="sk-cube sk-cube8"></div>
                    <div class="sk-cube sk-cube9"></div>
                </div>  
              </div>

            <div class="modal-content">

               <div class="modal-header">
                <h5 class="modal-title" id="modalAdicionarPlano">
                  Cadastrar novo Plano
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
              </div> 

              <form method="POST" id="formValidate" action="{{ route('create.plano') }}" autocomplete="on">
                
                @csrf
                

                <div class="modal-body"> 

                <div id="msg_add" class="alert alert-success d-none"></div> 

                  <div class="row">

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for=""> Nome do Plano</label>
                        <input class="form-control" name="nome" placeholder="Nome do Plano" type="text" 
                        id="nome" autocomplete="off" required="required">
                        
                          <div class="help-block form-text with-errors form-control-feedback" id="helpNome">
                          </div>
                        
                      </div> 
                    </div> 
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Intervalo (em meses)</label>
                        <select name="interval" class="form-control" required="required">
                          <option value="1">Mensal(todos os meses) </option>
                          <option value="3">A cada 3 Meses</option>
                          <option value="6">Semestral</option>
                          <option value="12">Anual</option>                         
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Quantas cobranças?</label>
                        <select name="repeats" class="form-control">
                          <option value="" selected="selected">Ilimitado</option>                          
                            @for($i=2; $i < 25; $i++)
                              <option value="$i">{{ $i }}</option>
                            @endfor  
                        </select>
                      </div>
                    </div>                    
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="valor_mensal">Valor</label>
                        <input type="phone" name="valor_mensal" id="valor" class="form-control" autocomplete="off" required="required">                        
                          <div class="help-block form-text with-errors form-control-feedback" id="helpvalor">
                          </div>                                            
                      </div>
                    </div>                  

                  </div>


                  <hr>
                  <div class="row"> 

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="">Anúncios Simples</label>
                        <input type="phone" name="quant_anuncios" id="simples" required="required">
                        <small id="smallsimples" class="form-text text-muted">
                          Digite 0 para "Ilimitados"
                        </small>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for=""> Anúncios Destaque</label>
                        <input type="phone" name="destaques" id="destaque" required="required">
                        <small  id="smalldestaque" class="form-text text-muted">
                          Digite 0 para "Ilimitados"
                        </small>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="">Anúncios Super Destaque</label>
                        <input type="phone" name="super_destaques" id="super" required="required">
                        <small  id="smallsuper" class="form-text text-muted">
                          Digite 0 para "Ilimitados"
                        </small>

                      </div>
                    </div> 
                 
                  </div>


                </div>  
                <div class="modal-footer">
                  <button class="btn btn-secondary btn-lg" data-dismiss="modal" type="button" id="cancelarPlano"> Cancelar</button>
                  <button class="btn btn-primary btn-lg" type="submit" id="addPlanSubmit">
                      Cadastrar Plano
                  </button>
                </div> 

             </form> 

            </div>
          </div>
          
        </div>          




        <!-- Modal para Editar-->
        <div aria-hidden="true" aria-labelledby="Planos de Acesso" class="modal fade" role="dialog" tabindex="-1" id="modal-planos">

          <div class="modal-dialog modal-lg">

            <div id="msg" class="alert alert-success d-none">
              Plano Atualizado com sucesso!
            </div>

              <div class="loading d-none" id="load_message">
                <div class="sk-cube-grid" >
                    <div class="sk-cube sk-cube1"></div>
                    <div class="sk-cube sk-cube2"></div>
                    <div class="sk-cube sk-cube3"></div>
                    <div class="sk-cube sk-cube4"></div>
                    <div class="sk-cube sk-cube5"></div>
                    <div class="sk-cube sk-cube6"></div>
                    <div class="sk-cube sk-cube7"></div>
                    <div class="sk-cube sk-cube8"></div>
                    <div class="sk-cube sk-cube9"></div>
                </div>  
              </div>

            <div class="modal-content">
               <div class="modal-header">
                <h5 class="modal-title" id="modalEditarPlano">
                  Editar Plano
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
              </div> 

              <form method="POST" id="editarPlanos" action="{{ route('gerenciar.planos') }}">
                
                @csrf

                <input type="hidden" name="id" id="idPlan">

                <div class="modal-body">   

                  <div class="row">

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for=""> Nome do Plano</label>
                        <input class="form-control" name="nome" placeholder="Nome do Plano" type="text" id="nomeDoPlano">
                        <div class="help-block form-text with-errors form-control-feedback" id="helpnomeDoPlano">
                          </div> 
                      </div> 
                    </div> 

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="valor_mensal">Valor Mensal</label>
                        <input type="phone" name="valor_mensal" id="valor_mensal" class="form-control">                       
                      </div>
                    </div>                  

                  </div>


                  <hr>
                  <div class="row"> 

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="">Anúncios Simples</label>
                        <input type="phone" name="quant_anuncios" id="anumSimples">
                        <small id="helpAnunSimple" class="form-text text-muted">
                          Digite 0 para "Ilimitados"
                        </small>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for=""> Anúncios Destaque</label>
                        <input type="phone" name="destaques" id="anumDestaque">
                        <small id="helpAnunDestaque" class="form-text text-muted">
                          Digite 0 para "Ilimitados"
                        </small>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="">Anúncios Super Destaque</label>
                        <input type="phone" name="super_destaques" id="anumSuper">
                        <small id="helpAnunSuper" class="form-text text-muted">
                          Digite 0 para "Ilimitados"
                        </small>

                      </div>
                    </div> 
                 
                  </div>


                </div>  
                <div class="modal-footer">
                  <button class="btn btn-secondary btn-lg" data-dismiss="modal" type="button"> Cancelar </button>
                  <button class="btn btn-primary btn-lg" type="submit" id="submitPlan">
                      Atualizar Dados
                  </button>
               </div> 

             </form> 

            </div>
          </div>
          
        </div>

      <!-- Alerta de deletar Planos -->


        <div aria-hidden="true" aria-labelledby="Atenção" class="modal" tabindex="-1" id="deletePlan" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="alert alert-warning fade show" role="alert" style="margin-bottom: 0rem"> 

                  <h6><strong>Atenção!!</strong>Você tem certeza que deseja remover este Plano? </h6>
                  <br>
                  <p id="plan_nome_remove" class="text-monospace font-weight-bold"></p>

                  <hr>

                  <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg">
                    CANCELAR
                  </button>

                  <a class="btn btn-danger btn-lg" href="" id="aceitar">Sim quero remover !</a>
                      
                  <form method="POST" action="{{ route('deletar.plano') }}" style="display: none;" id="del_plan_form">
                     @csrf
                      <input type="hidden" name="id" id="delPlanId">                    
                  </form>
              </div>

            </div>
          </div>          
        </div>

        <!-- Modal Aviso Assinaturas-->

        <div aria-hidden="true" aria-labelledby="Atenção" class="modal" role="dialog" tabindex="-2" id="bd-com-assinaturas">

          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                <h5 class="modal-title" id="atencao">
                  Atenção!!
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                </div> 

                <div class="modal-body">                  
                    <div class="alert alert-warning" role="alert">
                      Muita atenção ao modificar estas opções, pois ao alterar os planos todos os usuários que estiverem vinculados a ele receberão também estas atualizações.
                      <br>
                      <span class="modal-span"></span>
                    </div>
                </div>  

                <div class="modal-footer">
                  <button class="btn btn-secondary" data-dismiss="modal" type="button"> Cancelar</button>

                  <button class="btn btn-primary" type="button" id="btn_continuar"> Continuar </button>
               </div> 

            </div>
          </div>
          
        </div>


	</div>

</div>

@stop

@section('footer_scripts')

 <script type="text/javascript" src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}" ></script>
 <script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}" >  </script>

 <script type="text/javascript" id="codigoJs">

   $('#valor').mask('#.##0,00', {reverse: true});

   /*função modal delete*/
   $('.btn-del').on('mousedown', function(){

        $('#deletePlan').modal('toggle');
        var nomePlano = $(this).data('planonome');
        var id = $(this).data('id');

        $('#plan_nome_remove').text('Plano: ' + nomePlano);

        $('#delPlanId').val(id);

        $('#aceitar').on('click', function(event){
          
          event.preventDefault();

          $('#del_plan_form').submit(); 

        });

    });

   /* Função Modal Editar */
   $('.edit_plan').on('mousedown', function(){

      var assinaturas = $(this).data("assinaturas");

      sessionStorage.setItem('idPlano', $(this).data("id"));

      var id = sessionStorage.getItem('idPlano');

      var planoNome = $(this).data("planonome");
      
      $('.modal-span').text('Editar: ' + planoNome);
     


        $('#modal-planos').on('show.bs.modal', function(event){
         
          var planos = {!! $planos !!}

          $('#valor_mensal').mask('#.##0,00', {reverse: true});
          
          $.each(planos, function(){
              
              if(id == this.id){
                $('#idPlan').val(this.id);
                $('#nomeDoPlano').val(this.nome) ;
                $('#anumSimples').val(this.quant_anuncios); 
                $('#anumSuper').val(this.super_destaques); 
                $('#anumDestaque').val(this.destaques); 
                $('#valor_mensal').val(this.valor_mensal); 

              }          

          });


          
        });

        $('#modal-planos').on('hidden.bs.modal', function(event){
            setTimeout(function () {
                location.reload()
            }, 100);
        });


        if( assinaturas > 0){

          $('#bd-com-assinaturas').modal('toggle');           
          

           $('#btn_continuar').on('click', function(id){

                $('#bd-com-assinaturas').modal('hide');

                $('#modal-planos').modal('toggle');

           });

        }else{
          $('#modal-planos').modal('toggle');    
        }


          $('#editarPlanos').submit(function(e){

            e.preventDefault();

                var identifica = $('#idPlan').val();
                var nome = $('#nomeDoPlano').val() ;
                var quant_anuncios = $('#anumSimples').val(); 
                var super_destaques = $('#anumSuper').val(); 
                var destaques =  $('#anumDestaque').val(); 
                var valor_mensal =  $('#valor_mensal').val(); 

                var url = "{!! route('gerenciar.planos') !!}";
               
                $.ajaxSetup({
                   headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
                });

               $.ajax({
                  type: "POST",
                  url: url,
                  data: { id:identifica, nome:nome, quant_anuncios:quant_anuncios, super_destaques:super_destaques, destaques:destaques, valor_mensal:valor_mensal},
                  dataType: "json",

                  beforeSend : function(){
                    var elemento = document.getElementById('load_message');
                    elemento.classList.remove("d-none");                 
                  },

                  success: function(data){

                    if(data.status === 200){

                      var elemento = document.getElementById('load_message');
                      elemento.classList.add("d-none"); 

                      var msg = document.getElementById('msg');
                      msg.classList.remove('d-none');
                      $('#editarPlanos').find('.is-invalid').removeClass('is-invalid').addClass('is-valid');
                      $('#editarPlanos').find('.help-block').addClass('d-none');

                    }

                  },
                  error: function(data)
                  {
                      if(data.status === 422) {
                          var elemento = document.getElementById('load_message');              
                          var errors = data.responseJSON;
                          elemento.classList.add("d-none");

                          $.each(errors, function(key, value){
                              if(value.nome){                          
                                $('#helpnomeDoPlano').html(value.nome[0]); 
                                $( '#nomeDoPlano' ).addClass('is-invalid');                             
                              }                       
                          });

                      }else{
                         
                      }
                  }                  

                });

            });

  }); 


  /* Função Modal Adicionar Plano */

   var form = $('#formValidate') ;
   form.submit(function(e){
      e.preventDefault();

      $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            beforeSend : function(){
              var elemento = document.getElementById('load_message_add');
              elemento.classList.remove("d-none"); 
              
            },
            success : function(json)
            {
             
               if(json.status === 200){
                  var msg = json.message;                 
                  var elemento = document.getElementById('load_message_add');
                  elemento.classList.add("d-none");
                  form.find('.is-invalid').removeClass('is-invalid').addClass('is-valid');  
                  $('#msg_add').html(msg);
                  $('#msg_add').removeClass('d-none');
                  $('button#cancelarPlano').removeClass('btn-secondary').addClass('btn-primary');
                  $('button#cancelarPlano').text('Finalizar');
                  $('button#addPlanSubmit').addClass('d-none');
                  
                }

            },
            error: function(json)
            {
                if(json.status === 422) {
                    var elemento = document.getElementById('load_message_add');              
                    var errors = json.responseJSON;
                    elemento.classList.add("d-none");

                    $.each(errors, function(key, value){
                        if(value.nome){                          
                          $('#helpNome').html(value.nome[0]); 
                          $( '#nome' ).addClass('is-invalid');                             
                        }
                        if(value.valor_mensal){
                          $('#helpvalor').html(value.valor_mensal[0]);
                          $( '#valor' ).addClass('is-invalid');
                        }                         
                    });

                }
            }
      });

   });

  $('#adicionar-planos').on('hidden.bs.modal', function(event){
      setTimeout(function () {
          location.reload()
      }, 100);

  });

   document.getElementById('codigoJs').innerHTML = "";

 </script>
@stop