notifica = {
	
		showNotification: function(from, align, msn, icone, tipo){
        	$.notify({
        	icon: icone,
        	message: msg

        },{
            type: tipo,
            timer: 2000,
            placement: {
                from: from,
                align: align
            }
        });
	}

} 

function ConfirmDialog(message, id){
    $('<div></div>').appendTo('body')
                    .html('<div><h6>'+message+'</h6></div>')
                    .dialog({
                        modal: true, autoOpen: true, 
                        width: 400, resizable: false, height:'auto',
                        buttons: {
                            "Remover": function () {

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                
                                $.ajax({
                                    method: "POST",                                    
                                    data: { id:id },
                                    success: function (data) {                    
                                         
                                            setTimeout(function() {
                                                location.reload();
                                            }, 2500);

                                            $.notify({
                                                icon: 'fa fa-check',
                                                message: data

                                            },{
                                                type: 'success',                                                
                                                timer: 3000,                                                
                                            });


                                        
                                    },
                                    error: function (data){

                                        $.notify({
                                                message: 'Ocorreu um erro!'

                                            },{
                                                type: 'danger',                                                
                                                timer: 3000,                                                
                                            });  

                                    }
                                });   

                                $(this).dialog("close");
                            },
                            "Cancelar": function(){
                                $(this).dialog("close");
                            }

                        },
                        close: function (event, ui) {
                            $(this).remove();
                        },
                        beforeClose: function(event, ui){
                            $(this).remove();
                        }
                    });
    };
