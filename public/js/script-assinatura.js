$(document).ready(function () {

    $('#btn_emitir_assinatura').click(function (event) {
        
        if ($('#form-info')[0].checkValidity()) {
            var form_cartao_validation = ($('#form-cartao')[0].checkValidity() && $('#cartao')[0].classList.contains('active')) ? true : false;
            var form_boleto_validation = ($('#form-boleto')[0].checkValidity() && $('#boleto')[0].classList.contains('active')) ? true : false;

            if ((form_cartao_validation || form_boleto_validation)) {

                var plano = {};
                plano.descricao = document.getElementById('assinatura-descricao').value;
                plano.interval = document.getElementById('assinatura-interval').value;

                var item = {};
                item.name = document.getElementById('item-name').value;
                item.value = document.getElementById('item-value').value;
                item.amount = document.getElementById('item-amount').value;

                if (form_cartao_validation) {
                    $("#myModal").modal('show');
                    gerarToken(function () {
                        var customer = {};
                        customer.name = document.getElementById('customer-name').value;
                        customer.cpf = document.getElementById('customer-cpf').value;
                        customer.email = document.getElementById('customer-email').value;
                        customer.phone_number = document.getElementById('customer-phone_number').value;
                        customer.birth = document.getElementById('customer-birth').value;

                        var billing_address = {};
                        billing_address.street = document.getElementById('street').value;
                        billing_address.number = document.getElementById('number').value;
                        billing_address.neighborhood = document.getElementById('neighborhood').value;
                        billing_address.zipcode = document.getElementById('zipcode').value;
                        billing_address.city = document.getElementById('city').value;
                        billing_address.state = document.getElementById('state').value;

                        var payment_token = document.getElementById('token').value;

                        $.ajax({
                            url: 'emitir_assinatura.php',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                plano: plano,
                                item: item,
                                customer: customer,
                                payment_token: payment_token,
                                billing_address: billing_address
                            },
                            success: function (success) {
                                $("#myModal").modal('hide');
                                $('#myModalResultCard').modal('show');
                                var result = success.data;
                                var $htmlGeral = "<td>" + result.subscription_id + "</td><td>" + result.status + "</td>";
                                var $htmlInfo = "<td>" + result.plan.id + "</td><td>" + result.plan.interval + "</td><td>" + result.total + "</td>";

                                document.getElementById('table-geral-card').innerHTML = $htmlGeral;
                                document.getElementById('table-info-card').innerHTML = $htmlInfo;
                            },
                            error: function (error) {
                                $("#myModal").modal('hide');
                                var msg = JSON.stringify(error);
                                alert("Ocorreu um erro - Mensagem: \n" + msg);
                            }
                        });
                    });


                } else {
                    $("#myModal").modal('show');
                    var customer = {};
                    customer.name = document.getElementById('customer-name-b').value;
                    customer.cpf = document.getElementById('customer-cpf-b').value;
                    customer.phone_number = document.getElementById('customer-phoneNumber-b').value;


                    var expire_at = document.getElementById('expire_at').value;

                    $.ajax({
                        url: 'emitir_assinatura.php',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            plano: plano,
                            item: item,
                            customer: customer,
                            expire_at: expire_at
                        },
                        success: function (success) {
                            $("#myModal").modal('hide');
                            $('#myModalResult').modal('show');
                            var result = success.data;
                            var $htmlGeral = "<td>" + result.subscription_id + "</td><td>" + result.status + "</td><td>" + result.barcode + "</td><td><a href='" + result.link + "' target='_blank'>Click aqui</a></td>";
                            var $htmlInfo = "<td>" + result.plan.id + "</td><td>" + result.plan.interval + "</td><td>" + result.expire_at + "</td><td>" + result.total + "</td>";

                            document.getElementById('table-geral').innerHTML = $htmlGeral;
                            document.getElementById('table-info').innerHTML = $htmlInfo;
                        },
                        error: function (error) {
                            $("#myModal").modal('hide');
                            var msg = JSON.stringify(error);
                            alert("Ocorreu um erro - Mensagem: \n" + msg);
                        }
                    });
                }
            } else {
                alert('Você deverá preencher todos dados do formulário.');
            }
        } else {
            alert('Você deverá preencher todos dados do formulário.');
        }

    });

    //eventos para forma de pagemento
    $('#boleto').click(function (event) {
        $('#cartao').removeClass('active');
        $(this).addClass('active');
        $('#form-cartao').addClass('hide');
        $('#form-boleto').removeClass('hide');
    });

    $('#cartao').click(function (event) {
        $('#boleto').removeClass('active');
        $(this).addClass('active');
        $('#form-boleto').addClass('hide');
        $('#form-cartao').removeClass('hide');
    });

    //end para os eventos da forma de pagamento

    /**Inicio do script para gerar o payment_token do cartão de crédito */
    var s = document.createElement('script');
    s.type = 'text/javascript';

    var v = parseInt(Math.random() * 1000000);

    s.src = 'https://sandbox.gerencianet.com.br/v1/cdn/aaaaaaaaaaa1a3c11ff3732c68586a3a7/' + v; // substitua o 51e0446eba8f908aac124c7b2225a1b1 pelo identificador de sua conta Gerencianet, e na URL, deixe "sandbox" se estiver em desenvolvimento e "api" se estiver em produção

    s.async = false;
    s.id = 'aaaaaaaaaaa1a3c11ff3732c68586a3a7'; // substitua o 51e0446eba8f908aac124c7b2225a1b1 pelo identificador de sua conta Gerencianet

    if (!document.getElementById('aaaaaaaaaaa1a3c11ff3732c68586a3a7')) { // substitua o 51e0446eba8f908aac124c7b2225a1b1 pelo identificador de sua conta Gerencianet
        document.getElementsByTagName('head')[0].appendChild(s);
    }

    $gn = {
        validForm: true,
        processed: false,
        done: {},
        ready: function (fn) {
            $gn.done = fn;
        }
    };

    var consulta;

    $gn.ready(function (checkout) {
        consulta = checkout;
    });
    
    /**Fim do script */
    

    // função para gerar o token da transação
    function gerarToken(callbackSubmit) {
        // função de callback
        var callback = function (error, response) {
            if (error) {
                console.log(error);
            } else {
                console.log(response);
                document.getElementById('token').value = response.data.payment_token;
                callbackSubmit();
            }

        };
        //função para gerar o payment_token
        consulta.getPaymentToken({
            brand: document.getElementById('brand').value, // bandeira do cartão
            number: document.getElementById('numero').value, // número do cartão
            cvv: document.getElementById('cvv').value, // código de segurança
            expiration_month: document.getElementById('expiration_month').value, // mês de vencimento
            expiration_year: document.getElementById('expiration_year').value // ano de vencimento
        }, callback); // função de callback

    }


});