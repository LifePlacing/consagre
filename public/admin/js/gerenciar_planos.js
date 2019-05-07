
$(document).ready(function() {  

    $('.edit_plan').on('mousedown', function(){

      var assinaturas = $(this).data("assinaturas");

      sessionStorage.setItem('idPlano', $(this).data("id"));

      var id = sessionStorage.getItem('idPlano');

      var planoNome = $(this).data("planonome");
      
      $('.modal-span').text('Editar: ' + planoNome)
     


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

          })


          
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

                  if(data == 200){

                    var elemento = document.getElementById('load_message');
                    elemento.classList.add("d-none"); 

                    var msg = document.getElementById('msg');
                    msg.classList.remove('d-none');

                  }

                },
                

              });


          });

    }); 
});