function scroll_to_class(element_class, removed_height) {
    var scroll_to = $(element_class).offset().top - removed_height;
    if($(window).scrollTop() != scroll_to) {
        $('html, body').stop().animate({scrollTop: scroll_to}, 0);
    }
}


jQuery(document).ready(function(){
	
    $('.f1 fieldset:first').fadeIn('slow');
    
    $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea, .f1 select, .f1 input[type="tel"], .f1 input[type="number"]').on('focus', function() {
    	$(this).removeClass('input-error');        
    });
       
    $('.f1 input[type="tel"]').attr('autocomplete','off');

    /*Função para input number*/
    
    $(".f1 .btn-primary input[name='imovel_prop']").on('focus', function(){ 
       
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


    // next step

    $('.f1 .btn-next').on('click', function() {

    	var parent_fieldset = $(this).parents('fieldset');
    	var next_step = true;

    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    	var progress_line = $(this).parents('.f1').find('.f1-progress-line');
    	

    	// fields validation
    	parent_fieldset.find('.required').each(function() {


        if ($(this).val() == "") {
                $(this).addClass('input-error');
                next_step = false;

        }else {                
    			$(this).removeClass('input-error');
    	}




        });



    	// fields validation
    	
    	/*if(next_step) {
    		parent_fieldset.fadeOut(400, function() {
    			// change icons
    			//current_active_step.removeClass('active').addClass('activated').next().addClass('active');
    			// progress bar
    			bar_progress(progress_line, 'right');
    			// show next step
	    		$(this).next().fadeIn();
	    		// scroll window to beginning of the form
    			scroll_to_class( $('.f1'), 20 );
	    	});
    	}*/
    	
    });
    
    // previous step
    $('.f1 .btn-previous').on('click', function() {
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    	var progress_line = $(this).parents('.f1').find('.f1-progress-line');
    	
    	$(this).parents('fieldset').fadeOut(400, function() {
    		// change icons
    		current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
    		// progress bar
    		bar_progress(progress_line, 'left');
    		// show previous step
    		$(this).prev().fadeIn();
    		// scroll window to beginning of the form
			scroll_to_class( $('.f1'), 20 );
    	});
    });
    



    // submit
    $('.f1').on('submit', function(e) {
    	
    	// fields validation
    	$(this).find('.required').each(function() {
    		
            if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}



            if( !validarCPF($("#cpf").val())){
                        $("#cpf").addClass('input-error');                
                        $('.erro-cpf').show(); 
                        e.preventDefault(); 
                        $("#cpf").on('focus', function(){
                            $('.erro-cpf').hide();
                        });                              
            } 

                 

    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	// fields validation

        //current_active_step.removeClass('active').addClass('activated').next().addClass('active');
    	//bar_progress(progress_line, 'left');
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
