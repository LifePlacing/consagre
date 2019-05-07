jQuery(document).ready(function(){

	  $("#SliderRelacionados").on("slid.bs.carousel", function(e) {
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 3;
	    var totalItems = $("#SliderRelacionados .carousel-item").length;	   

	    if (idx >= totalItems - (itemsPerSlide - 1)) {
	      var it = itemsPerSlide - (totalItems - idx);
	      for (var i = 0; i < it; i++) {
	        // append slides to end
	        if (e.direction == "left") {
	          $("#SliderRelacionados .carousel-item")
	            .eq(i)
	            .appendTo("#SliderRelacionados .carousel-inner");
	        } else {
	          $("#SliderRelacionados .carousel-item")
	            .eq(0)
	            .appendTo($(this).find("#SliderRelacionados .carousel-inner"));
	        }
	      }
	    }
	  });
 	


	$("#contatar_anunciante").submit(function(e){


		e.preventDefault();

		var id = document.getElementById('imv_id').value;
		var msg = document.getElementById('InputMensagem').value;
		var user = document.getElementById('InputNome').value;
		var mail = document.getElementById('InputEmail1').value;
		var fone = document.getElementById('InputPhone').value;

		var url = "/mensagem";

		$.ajaxSetup({
		   headers: {
		      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		   }
		});


		$.ajax({
	      type: "POST",
	      url: url,
	      data: { imv_id: id , mensagem: msg, nome: user, email: mail, telefone: fone},
	      dataType: 'JSON',

	      beforeSend : function(){
	      		var elemento = document.getElementById('load_message');
				elemento.classList.remove("d-none");          
		  },

	      success: function (data) {

	      	var resposta = '';

	      	 if(data == 200){

	      	 	$("#contatar_btn").prop('disabled', true); 

	      	 	$('#response').hide();
	  	 	    
		        var elemento = document.getElementById('load_message');
		        elemento.classList.add("d-none");

		        var sucesso = document.getElementById('success_message');
		        	sucesso.classList.remove("d-none");
		        
		        $("#success_message").fadeOut(3000, 'swing', function(){
			        	setTimeout(function() {
	       					sucesso.classList.add("d-none");
	   					}, 4000);
		        });
   				

	      	 }else{

	      	 	var elemento = document.getElementById('load_message');
	        	elemento.classList.add("d-none");       	

	      	 }


	      },
	      error: function(data){

	      		var elemento = document.getElementById('load_message');
	        	elemento.classList.add("d-none");

			    var errors = data.responseJSON;

			    var errorsHtml = '';

			    $.each(errors.errors, function( key, value ) {
			      errorsHtml += '<p class="text-danger">' + value[0] + '</p>';
			    });

			    
			    $('#response').show().html(errorsHtml);

	        	
	      }

	    })



	});

});