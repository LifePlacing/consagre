function scroll_to_class(element_class, removed_height) {
    var scroll_to = $(element_class).offset().top - removed_height;
    if($(window).scrollTop() != scroll_to) {
        $('html, body').stop().animate({scrollTop: scroll_to}, 0);
    }
}


jQuery(document).ready(function(){

    
    $(".btn-plan input[name='plano']").on('click', function(){      
        

            if($("input:checked").val() == "plano_basico"){
                $('#plan_basico').css('box-shadow','0px 0px 5px rgb(255,90,0)'); 
                $('#plan_pro').css('box-shadow','0px 0px 2px rgba(0,0,0,0.3)');                        
                document.getElementById('plano_id').value=(this.value);              
                $('#plano_selecionado').html("Plano Básico");
                var valor_basico = document.getElementById('valor_basico').innerHTML; 
                var texto = document.getElementById('valor_do_plano');
                texto.innerHTML = valor_basico;

            }

            if($("input:checked").val() == "plano_pro"){
               $('#plan_basico').css('box-shadow','0px 0px 2px rgba(0,0,0,0.3)'); 
               $('#plan_pro').css('box-shadow','0px 0px 5px rgb(255,90,0)');
               document.getElementById('plano_id').value=(this.value); 
               $('#plano_selecionado').html("Plano Pro-100"); 

                var valor_pro = document.getElementById('valor_pro').innerHTML; 
                var texto = document.getElementById('valor_do_plano');
                texto.innerHTML = valor_pro;

            }

    });        
    

           if ($(".f1 .btn-primary input[name='meta']:checked").val() == "venda") {

                    $( "#percetual" ).show();
                    $("#preco").val("");

                    $('#log').html("Valor da " + $("input:checked").val() + ":"); 
                    $('#log_2').html("Valor total da " + $("input:checked").val() + " :"); 

                var precoAluguel = $("#valor");

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
            }



    $('.char-count').keyup(function() {
        var maxLength = parseInt($(this).attr('maxlength')); 
        var length = $(this).val().length;
        var newLength = maxLength-length;
        var name = $(this).attr('name');
        $('span[name="'+name+'"]').text(newLength);
    });    

    
    $('.f1 fieldset:first').fadeIn('slow');
    
    $('.f1 input[type="text"], .f1 select, .f1 input[type="tel"], .f1 input[type="number"]').on('focus', function() {
    	$(this).removeClass('input-error');        
    });
       
    $('.f1 input[type="tel"]').attr('autocomplete','off');

    /*Função para input number*/

    
    $(".f1 .btn-primary input[name='meta']").on('focus', function(){ 

           if ($("input:checked").val() == "aluguel") {

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

                    $( "#percetual" ).show();
                    $("#preco").val("");

                    $('#log').html("Valor da " + $("input:checked").val() + ":"); 
                    $('#log_2').html("Valor total da " + $("input:checked").val() + " :"); 

                var precoAluguel = $("#valor");

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
            }


        
    });


    $( 'input.numero' ).on( 'keydown', function(e) {
    var keyCode = e.keyCode || e.which,
      pattern = /\d/,
      // Permite somente Backspace, Delete e as setas direita e esquerda, números do teclado numérico - 96 a 105 - (além dos números)
      keys = [ 46, 8, 9, 37, 39, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105 ];
  
    if( ! pattern.test( String.fromCharCode( keyCode ) ) && $.inArray( keyCode, keys ) === -1 ) {
      return false;
    }
    });       



    $('.f1').keyup(function(){

       if($('.required').val() == ''){

            $('#next').attr('disabled', true);

       } else{
            $('#next').removeAttr('disabled');
       }

    });


    // submit
    $('.f1').on('submit', function(e) {


        if(document.anuncieimovel.imovel_type_id.selectedIndex==""){
            $("select#imovel_type_id").addClass('input-error');
            $('select#imovel_type_id').popover('show');
            $('#next').popover('show');

            $("select#imovel_type_id").on('focus', function(){
                $('#next').popover('hide');
            }); 

            e.preventDefault();
            return false;                    
        }

    	// fields validation
    	$('.f1').find('.required').each(function() {

    		
           if($("#phone").val()==''){
                    $("#phone").addClass('input-error');
                    $('.erro-phone').show();
                    $('#next').popover('show');
                    e.preventDefault();
                    
                    $("#phone").on('focus', function(){
                        $('.erro-phone').hide();
                        $('#next').popover('hide');
                    });     
                              
            } 

            if ($('#unidade').val() == '') {
                $("#unidade").addClass('input-error');
                $('.erro-number').show();
                $(".erro-number").html("<span>Informe um numero</span>");
                $('#next').popover('show');
                e.preventDefault();
                
                    $("#unidade").on('focus', function(){
                        $('.erro-number').hide();
                        $('#next').popover('hide');
                    });                    
            }  

            if ($('#cep').val() == "") {
                $("#cep").addClass('input-error');
                $("#logradouro").addClass('input-error');
                $("#bairro").addClass('input-error');
                $('#next').popover('show');

                e.preventDefault();
               
                    $("#cep").on('focus', function(){
                        $("#cep").removeClass('input-error');
                        $("#logradouro").removeClass('input-error');
                        $("#bairro").removeClass('input-error');
                        $('#next').popover('hide');
                    });

            }   

            if($("#cpf").val() =='' || $('.erro-cpf').is(':visible')){
                        $("#cpf").addClass('input-error');                
                        $('.erro-cpf').show(); 
                        $('#next').popover('show');
                        e.preventDefault();
                       

                        $("#cpf").on('focus', function(){
                            $('.erro-cpf').hide();
                            $('#next').popover('hide');
                        }); 
                        
            }

            if($(this).val()=='') {           
                $(this).addClass('input-error');
                $('#next').popover('show');
                e.preventDefault();  
                        $(this).on('focus', function(){
                            $('#next').popover('hide');
                        });                  
            }


  
    		else {
                $('#next').popover('hide');
                $('#next').popover('dispose');
                $(this).removeClass('input-error');
    		}
    	});


        

    });
    
    
});





// formulário cadastro imobiliarias e corretores



//Inicio do Buscador de CEP

    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua_imobi').value=("");
            document.getElementById('bairro_imobi').value=("");
            document.getElementById('city_imobi').value=("");           
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua_imobi').value=(conteudo.logradouro);
            document.getElementById('bairro_imobi').value=(conteudo.bairro);
            document.getElementById('city_imobi').value=(conteudo.localidade);            
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

function pesquisacep(valor) {

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





function maskIt(w,e,m,r,a){

// Cancela se o evento for Backspace
if (!e) var e = window.event
if (e.keyCode) code = e.keyCode;
else if (e.which) code = e.which;
// Variáveis da função
var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
var mask = (!r) ? m : m.reverse();
var pre  = (a ) ? a.pre : "";
var pos  = (a ) ? a.pos : "";
var ret  = "";
if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;
// Loop na máscara para aplicar os caracteres
for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
if(mask.charAt(x)!='#'){
ret += mask.charAt(x); x++; } 
else {
ret += txt.charAt(y); y++; x++; } }
// Retorno da função
ret = (!r) ? ret : ret.reverse() 

w.value = pre+ret+pos; 

}

// Novo método para o objeto 'String'
String.prototype.reverse = function(){
return this.split('').reverse().join(''); 
}
