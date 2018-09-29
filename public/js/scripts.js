function scroll_to_class(element_class, removed_height) {
    var scroll_to = $(element_class).offset().top - removed_height;
    if($(window).scrollTop() != scroll_to) {
        $('html, body').stop().animate({scrollTop: scroll_to}, 0);
    }
}


jQuery(document).ready(function(){


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
       
       $('#log').html("Valor total de " + $("input:checked").val() + " :");       
        
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
w.value = pre+ret+pos; }

// Novo método para o objeto 'String'
String.prototype.reverse = function(){
return this.split('').reverse().join(''); 
}
