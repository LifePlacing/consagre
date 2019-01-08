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