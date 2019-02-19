jQuery(document).ready(function(){

        $('#password').on('keyup change', function(){

            var valor = $(this).val();

            var d = document.getElementById('passwordHelpBlock');
            
            ERaz = /[a-z]/;
            ERAZ = /[A-Z]/;
            ER09 = /[0-9]/;
            ERxx = /[@!#$%&*+=?|-]/;

            if(valor.length == ''){
                d.innerHTML = 'Senha inválida !';
                
            }else{

                if(valor.length < 5){
                    d.innerHTML = 'Seguranca da senha: <font color=\'red\'> BAIXA</font>';
                    return false;
                } else {
                    if(valor.length > 7 && valor.search(ERaz) != -1 && valor.search(ERAZ) != -1 && valor.search(ER09) != -1 && valor.search(ERxx) != -1 ){
                        d.innerHTML = 'Seguranca da senha: <font color=\'green\'> ALTA (Recomendada) </font>';
                    } else {
                        if(valor.search(ERaz) != -1 && valor.search(ERAZ) != -1 || valor.search(ERaz) != -1 && valor.search(ER09) != -1 || valor.search(ERaz) != -1 && valor.search(ERxx) != -1 ||valor.search(ERAZ) != -1 && valor.search(ER09) != -1 ||valor.search(ERAZ) != -1 && valor.search(ERxx) != -1 ||valor.search(ER09) != -1 && valor.search(ERxx) != -1){
                            d.innerHTML = 'Seguranca da senha: <font color=\'orange\'> MEDIA</font>';
                        } else {
                            d.innerHTML = 'Seguranca da senha: <font color=\'red\'> BAIXA</font>';
                        }
                    }
                }
            }


        });



});