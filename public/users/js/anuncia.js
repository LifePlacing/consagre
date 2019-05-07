jQuery(document).ready(function(){

	$('#inputPercentual').hide();

	/* Função definida para ler no carregamento da página */

       if ($(".f1 .btn-primary input[name='meta']:checked").val() == "venda") {

        	$('#inputPercentual').show();

            $( "#percetual" ).hide();           
            

            $("#preco").val("");

            $('#log').html("Valor da " + $("input:checked").val() + ":"); 
            $('#log_2').html("Valor total da " + $("input:checked").val() + " :"); 

        	var precoAluguel = $("#valor");


            $('#checkComissao').on('click change', function(){     			

     			if($("#checkComissao:checked").val() == 'on'){
     				
     				$("#percetual").show();
			            			                
	                var valor = precoAluguel.val().replace(/\./, "" );

	                var split = valor.split(',')[0];
	                var formatado = parseFloat(split.replace(".","")).toFixed(2); 

	                var valorPorcentagem = formatado * (6 / 100);
	                
	                var formato = { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' };

	                $("#percent").val(valorPorcentagem.toLocaleString('pt-BR', formato) );

	                var total = parseFloat(formatado) + parseFloat(valorPorcentagem);

	               $("#preco").val(total.toLocaleString('pt-BR', formato) );

	               
	               precoAluguel.focusout( function(){

		                var valor = precoAluguel.val().replace(/\./, "" );

		                var split = valor.split(',')[0];
		                var formatado = parseFloat(split.replace(".","")).toFixed(2); 

		                var valorPorcentagem = formatado * (6 / 100);
		                
		                var formato = { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' };

		                $("#percent").val(valorPorcentagem.toLocaleString('pt-BR', formato) );

		                var total = parseFloat(formatado) + parseFloat(valorPorcentagem);

		               $("#preco").val(total.toLocaleString('pt-BR', formato) );



	               });

			                
			               				

     			}else{

     					$("#percetual").hide();
			            
			                
		                var valor = precoAluguel.val().replace(/\./, "" );

		                var split = valor.split(',')[0];

		                var formatado = parseFloat(split.replace(".","")).toFixed(2); 
		                
		                
		                var formato = { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' };

		                
		                var total = parseFloat(formatado) ;

		               $("#preco").val(total.toLocaleString('pt-BR', formato) );

		               precoAluguel.focusout( function(){

		               		var valor = precoAluguel.val().replace(/\./, "" );

			                var split = valor.split(',')[0];

			                var formatado = parseFloat(split.replace(".","")).toFixed(2); 			                
			                
			                var formato = { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' };

			                

			                var total = parseFloat(formatado) ;

			               $("#preco").val(total.toLocaleString('pt-BR', formato) );


		               });
			                
			          

     			}

     		}); 

            precoAluguel.focusout( function(){
                
                var valor = precoAluguel.val().replace(/\./, "" );

                var split = valor.split(',')[0];

                var formatado = parseFloat(split.replace(".","")).toFixed(2);                 
                
                var formato = { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' };
                

                var total = parseFloat(formatado) ;

               $("#preco").val(total.toLocaleString('pt-BR', formato) );

                
            }); 
			


    }


	/* Mudança dos campos de valores para venda e aluguel */

    $(".f1 .btn-primary input[name='meta']").on('change focus', function(){ 

           if($("input:checked").val() == "aluguel"){

           		$('#inputPercentual').hide();
                $( "#percetual" ).hide(); 
                $("#preco").val("");

                $('#log').html("Valor Mensal do " + $("input:checked").val() + ":"); 
                $('#log_2').html("Valor Anual do " + $("input:checked").val() + " :"); 

                var precoAluguel = $("#valor");

                precoAluguel.focusout( function(){

                    //var valor = parseInt(precoAluguel.val().replace(/[^\d]+/g, ""));
                    var valor = precoAluguel.val().replace(/\./, "" );

                    var split = valor.split(',')[0];
                    var formatado = parseFloat(split.replace(".","")).toFixed(2); 

                    var total = formatado * 12;

                    var formato = { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' }

                    $("#preco").val(total.toLocaleString('pt-BR', formato) );

                    
                });


               
           }else{

           		$( "#percetual" ).hide();
           		$('#inputPercentual').show();
                
                $("#preco").val("");

                $('#log').html("Valor da " + $("input:checked").val() + ":"); 
                $('#log_2').html("Valor total da " + $("input:checked").val() + " :"); 

                var precoAluguel = $("#valor");

            $('#checkComissao').on('click change', function(){     			

     			if($("#checkComissao:checked").val() == 'on'){
     				
     				$("#percetual").show();
			            			                
	                var valor = precoAluguel.val().replace(/\./, "" );

	                var split = valor.split(',')[0];
	                var formatado = parseFloat(split.replace(".","")).toFixed(2); 

	                var valorPorcentagem = formatado * (6 / 100);
	                
	                var formato = { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' };

	                $("#percent").val(valorPorcentagem.toLocaleString('pt-BR', formato) );

	                var total = parseFloat(formatado) + parseFloat(valorPorcentagem);

	               $("#preco").val(total.toLocaleString('pt-BR', formato) );

	               
	               precoAluguel.focusout( function(){

		                var valor = precoAluguel.val().replace(/\./, "" );

		                var split = valor.split(',')[0];
		                var formatado = parseFloat(split.replace(".","")).toFixed(2); 

		                var valorPorcentagem = formatado * (6 / 100);
		                
		                var formato = { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' };

		                $("#percent").val(valorPorcentagem.toLocaleString('pt-BR', formato) );

		                var total = parseFloat(formatado) + parseFloat(valorPorcentagem);

		               $("#preco").val(total.toLocaleString('pt-BR', formato) );



	               });

			                
			               				

     			}else{

     					$("#percetual").hide();
			            
			                
		                var valor = precoAluguel.val().replace(/\./, "" );

		                var split = valor.split(',')[0];

		                var formatado = parseFloat(split.replace(".","")).toFixed(2); 
		                
		                
		                var formato = { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' };

		                
		                var total = parseFloat(formatado) ;

		               $("#preco").val(total.toLocaleString('pt-BR', formato) );

		               precoAluguel.focusout( function(){

		               		var valor = precoAluguel.val().replace(/\./, "" );

			                var split = valor.split(',')[0];

			                var formatado = parseFloat(split.replace(".","")).toFixed(2); 			                
			                
			                var formato = { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' };

			                

			                var total = parseFloat(formatado) ;

			               $("#preco").val(total.toLocaleString('pt-BR', formato) );


		               });
			                
			          

     			}

     		});








                    
            }


        
    });

});


/*========== FUNÇÃO DE BUSCA DO CEP ===========*/

//Inicio do Buscador de CEP

    function limpa_formulário_cep() {

         if (document.getElementById('cep') != null){
            $("#cep").removeClass('is-invalid');       
            $("#cep").removeClass('is-valid');
        }

            //Limpa valores do formulário de cep.
            document.getElementById('rua_imobi').value=("");
            document.getElementById('bairro_imobi').value=("");
            document.getElementById('city_imobi').value=(""); 

            if (document.getElementById('estado') != null){
                document.getElementById('estado').value=("");
            } 

                       
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {

            //Atualiza os campos com os valores.
            document.getElementById('rua_imobi').value=(conteudo.logradouro);
            document.getElementById('bairro_imobi').value=(conteudo.bairro);
            document.getElementById('city_imobi').value=(conteudo.localidade); 
            if (document.getElementById('estado') != null){
                document.getElementById('estado').value=(conteudo.uf);
            } 
            if (document.getElementById('complemento') != null){
                document.getElementById('complemento').value=(conteudo.complemento);
            }           


        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            $("#cep").addClass('is-invalid');
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor){

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua_imobi').value="carregando...";
                document.getElementById('bairro_imobi').value="carregando...";
                document.getElementById('city_imobi').value="carregando...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                $("#cep").removeClass('is-invalid');
                $("#cep").addClass('is-valid');


                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

//FIM do Buscador de CEP  