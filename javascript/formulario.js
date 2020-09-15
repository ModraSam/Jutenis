$(function(){


  /*Compruebo que haya cookie para añadir el evento click (su función el eliminar del arbol DOM el elemento con el id alert).
  Si hay cookie no muestro el elemento desde el principio*/
  if(compruebaCookie()){
	  $( "#alert" ).css("display","none");
  }
  else{
	  $("#botonAceptar").click(function() {
		    if(compruebaCookie){
		      let fecha = new Date();

		      fecha.setTime(fecha.getTime()+24*60*60*1000);
		      document.cookie = `lenguaje = true ; expires=${fecha.toUTCString()}`;
		      console.log(`Cookie generada -> ${document.cookie} `);
		    }

		    $( "#alert" ).remove();
		  });
  }

});



function compruebaCookie() {
	if(!document.cookie){
	return false;
	}
	else{
	        let trozos = document.cookie.split(";");
	
	        for(let i=0; i < trozos.length; i++){
	            let c = trozos[i];
	
	            if(c.includes("lenguaje")) {
	                return true;
	            }
	        }
	}
}