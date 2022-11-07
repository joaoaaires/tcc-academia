jQuery.fn.makeTextRed = function(){
    return this.each(function(){
		if($(this).children('#status').text() == 'Pago') {
        	$(this).addClass('success');
		} else {
			$(this).addClass('error');		
		}
    });
};