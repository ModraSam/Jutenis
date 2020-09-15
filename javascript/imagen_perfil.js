$(document).ready(function() {

	    $("#upload_link").on('click', function(e){
	        e.preventDefault();
	        $("#usuario_imagen:hidden").trigger('click');
	    });
	    
	    $("#usuario_imagen").on('change', function() {
	        $("#form").submit();
	    });

});