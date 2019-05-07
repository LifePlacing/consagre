$(document).ready(function(){
    $('#load_message').hide();     
});

$( document ).ajaxStart(function() {
  $('#load_message').show();
});


$('.reorder_link').on('click',function(){

        $("ul.reorder-photos-list").sortable({ tolerance: "pointer" });        
        $('.reorder_link').html('Salvar Nova Posição');
        $('.reorder_link').attr("id","saveReorder");
        $('#reorderHelper').slideDown('slow');
        $('.image_link').attr("href","javascript:void(0);");
        $('.image_link').css("cursor","move");



        
        $("#saveReorder").click(function( e ){

            if( !$("#saveReorder i").length ){
                //$(this).html('').prepend('<img src="{!! asset('/images/loader.gif') !!} "/>');
                $("ul.reorder-photos-list").sortable('destroy');
                $("#reorderHelper").html("Reordenando Fotos - Isso pode demorar um pouco. Por favor, não saia desta página").removeClass('light_box').addClass('notice notice_error');
                
                var h = [];
                $("ul.reorder-photos-list li").each(function() {
                    h.push($(this).attr('id').substr(9));                    
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                    type: "POST",
                    url: "/anunciante/novoanuncio/finish/reorder",
                    data: {ids: " " + h + ""},                               
                    
                   success: function(){  

                        window.location.reload();
                   }, 
                   error: function(){
                        alert('Ocorreu um erro inesperado!');
                   }
                });	
                

                return false;
            }	

            e.preventDefault();
        });


    });

$('#finalizar').on('click', function(){
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
                
    $.ajax({
        type: "GET",
        url: "anunciante/novoanuncio/finish/forget/session",
        data: '',
    });



});