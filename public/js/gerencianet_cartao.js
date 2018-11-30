    /* Máscaras do CARTÃO DE CREDITO  */

    function execmascara(){
        v_obj.value=v_fun(v_obj.value);
    }
    

    function mascara(o,f){
        v_obj=o
        v_fun=f
        setTimeout("execmascara()",1)
    }

    function mcc(v){
        v=v.replace(/\D/g,"");
        v=v.replace(/^(\d{4})(\d)/g,"$1 $2");
        v=v.replace(/^(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3");
        v=v.replace(/^(\d{4})\s(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3 $4");
        return v;
    }
   
    function id(el){
        return document.getElementById(el);
    }


    function formataDinheiro(n){
        return "R$ " + (n / 100).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
    }

jQuery(document).ready(function(){


    id('cc-number').onkeypress = function(){
            mascara( this, mcc );
    }

    $("#copiar").click(function(){

        var nome = $("#anunciante-nome").val();

        $("#nome_cliente").val(nome);  

    });

    /*Desabilitando o campo de parcelas*/
    $("#div_installments").removeClass("alert alert-success");
    /*Fim desabilitando campo de parcelas*/

    /*FIM DA MASCARA DO CARTÃO*/

    $gn.ready(function(checkout){

         $("#ver_parcelas").click(function () {

            if ($('#form')[0].checkValidity()){

                $("#myModal").modal('show');


                checkout.getInstallments( parseInt($("#valor").val()), $("#bandeira").val(), function(error, response) {


                    if(error){                         
                         $("#myModal").modal('hide');

                        var html="";
                        var html="Ocorreu um erro - Mensagem: " + error;

                        $('#erros').modal('show');
                        $('#msg_error').removeClass('d-none');
                        $('#msg_error').html(html);


                    }else{

                        if (response.code == 200) {

                            var options = '';

                            for (i = 0; i < response.data.installments.length; i++) {
                                options += '<option value="' + response.data.installments[i].installment + '">' + response.data.installments[i].installment + 'x de R$' + response.data.installments[i].currency + '</option>';


                            }
                            $('#installments').html(options);                            
                            $('#btn_pg_cartao').removeClass('d-none');
                            $('#ver_parcelas').addClass('d-none');
                            $('#div_installments').addClass('alert alert-success');
                            $("#div_installments").removeClass("d-none")
                            $("#myModal").modal('hide');
                        }



                    }

                });

            }else {
                var html="";
                var html="Você deverá preencher todos dados do formulário.";

                $('#erros').modal('show');
                $('#msg_error').removeClass('d-none');
                $('#msg_error').html(html);

            }


         });

         $("#btn_pg_cartao").click(function (){


            $("#myModal").modal('show');

            var plan_id = $("#plan_id").val();
            var anunciante_id = $("#cod_anunciante").val();
            var descricao = $("#descricao").val();
            var valor = $("#valor").val();
            var quantidade = $("#quantidade").val();
            var nome_cliente = $("#nome_cliente").val();
            var cpf = $("#cpf").val();
            var telefone = $("#telefone").val();
            var email = $("#email").val();
            var nascimento = $("#nascimento").val();

            var rua = $("#rua_imobi").val();            
            var bairro = $("#bairro_imobi").val();
            var cep = $("#cep_imobi").val();
            var cidade = $("#city_imobi").val();
            var estado = $("#estado").val();
            var numero = $("#numero").val();

            var numero_cartao = $("#cc-number").val();
            var codigo_seguranca = $("#codigo_seguranca").val();
            var bandeira = $("#bandeira").val();
            var ano_vencimento = $("#ano_vencimento").val();
            var mes_vencimento = $("#mes_vencimento").val();
            var installments = $("#installments").val();
            
            var callback = function (error, response) {

                if(error){                    
                     $("#myModal").modal('hide');
                      
                    var html="";
                    var html="Ocorreu um erro - Mensagem: " + error;

                    $('#erros').modal('show');
                    $('#msg_error').removeClass('d-none');
                    $('#msg_error').html(html);


                }else{

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({

                        url: "/planos/contratar/payment/cartao/",
                        data: {
                            descricao: descricao, valor: valor, quantidade: quantidade, nome_cliente: nome_cliente, cpf: cpf, telefone: telefone,
                            rua: rua, numero: numero, estado: estado, bairro: bairro, cep: cep, cidade: cidade, payament_token: response.data.payment_token, installments: installments, email: email, nascimento: nascimento, anunciante_id:anunciante_id, plan_id:plan_id
                        },
                        type: 'post',
                        dataType: 'json',
                        success: function (resposta){
                            $("#myModal").modal('hide');
                            if (resposta.code == 200) {

                                $("#btn_pg_cartao").addClass('d-none');
                                $("#retorno").modal('show');

                                var trans = resposta.data.charge_id ;
                                var status = "Status:"+resposta.data.status;
                                var prod = "<h3>Produto: "+descricao+"</h3>";
                                html = "";
                                var html = "<th>" + resposta.data.installments + "</th>"
                                html += "<th>" + formataDinheiro(resposta.data.installment_value) + "</th>"
                                html += "<th>" + formataDinheiro(resposta.data.total) + "</th>";

                                $('#transacao').html(trans);
                                $('#produto').html(prod);
                                $('#status').html(status);
                                $('#installments_value').html(html);

                            }else {
                                $("#myModal").modal('hide');                                
                                var html="";
                                var html="Ocorreu um erro - Mensagem: " + resposta.code;

                                $('#erros').modal('show');
                                $('#msg_error').removeClass('d-none');
                                $('#msg_error').html(html);

                            }
                        },                        
                        error: function (resposta){
                            $("#myModal").modal('hide');                           
                            var html="";
                            var html="Ocorreu um erro - Mensagem: " + resposta.responseText;

                            $('#erros').modal('show');
                            $('#msg_error').removeClass('d-none');
                            $('#msg_error').html(html);
                        }

                    });

                }

            }
            checkout.getPaymentToken({
                brand: bandeira,
                number: numero_cartao,
                cvv: codigo_seguranca,
                expiration_month: mes_vencimento,
                expiration_year: ano_vencimento
            }, callback);

            
         });


    });



    $("#cc-number").keyup(function(){

        var card = $("#cc-number").val(); 

        var number = +card.replace( /\s/g, '' );
        
        var visa = /^4[0-9]{12}(?:[0-9]{3})/;
        var mastercard = /^5[1-5][0-9]{14}/;
        var hipercard = /^(606282\d{10}(\d{3})?)|(3841\d{15})/;
        var amex = /^3[47][0-9]{13}/;
        var diners = /^3(?:0[0-5]|[68][0-9])[0-9]{11}/;
        var elo = /^((((636368)|(438935)|(504175)|(451416)|(636297))\d{0,10})|((5067)|(4576)|(4011))\d{0,12})/;
        var invalidos = /^[0126789]|^5[06-9]{1}|^3[1235689]/;

        if(number == '' || number == null || invalidos.test(number)){
            $("#mastercard").addClass('d-none');
            $("#visa").addClass('d-none');
            $("#hipercard").addClass('d-none');
            $("#amex").addClass('d-none');
            $("#diners").addClass('d-none');
            $("#elo").addClass('d-none');
            $("#brand").value=null;
            $("#cc-number").removeClass('is-valid is-invalid');
        }

        if(mastercard.test(number)){           
            $("#bandeira").val('mastercard');
            $("#mastercard").removeClass('d-none');
            $("#cc-number").removeClass('is-invalid');
            $("#cc-number").addClass('is-valid');
            return false;
        }

        if (visa.test(number)) {
            $("#bandeira").val('visa');
            $("#visa").removeClass('d-none');
            $("#cc-number").removeClass('is-invalid');
            $("#cc-number").addClass('is-valid');
            return false;
        }

        if(hipercard.test(number)){
            $("#bandeira").val('hipercard');
            $("#hipercard").removeClass('d-none');
            $("#cc-number").removeClass('is-invalid');
            $("#cc-number").addClass('is-valid');
            return false;
        }

        if (amex.test(number)){
            $("#bandeira").val('amex');
            $("#amex").removeClass('d-none');
            $("#cc-number").removeClass('is-invalid');
            $("#cc-number").addClass('is-valid');
            return false;
        }

        if (diners.test(number)){
            $("#bandeira").val('diners');
            $("#diners").removeClass('d-none');
            $("#cc-number").removeClass('is-invalid');
            $("#cc-number").addClass('is-valid');
            return false;
        }

        if (elo.test(number)) {
            $("#bandeira").val('elo');
            $("#elo").removeClass('d-none');
            $("#cc-number").removeClass('is-invalid');
            $("#cc-number").addClass('is-valid');
            return false;
        }

        if (invalidos.test(number)){
            $("#cc-number").addClass('is-invalid');
            return false;
        }

        
    });

});    