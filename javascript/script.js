$(function(){
	
  //espaciadoFooter();

  //footerInicial();

  $("div.fa-minus").click(mostarOcultar);

  //$( window ).resize(espaciadoFooter);

  $('.confirmacion-evento').click(function () {
	  return confirm("¿Seguro que quiere dejar de participar?\nSi lo hace, usted no podrá volver a participar en este evento.")
  	});
	 
  $(".alert").fadeOut(5000);
  
  $( window ).resize(function(){
		  if($("#divBtnFiltrado #btnFiltro").length==0)
		  $("#btnFiltro").css("top", (($(".navbar-custom").height()+60)+"px"))
  });
  
  //funcion que hace mostrar las opciones de filtrado y mueve el boton de sitio
  $("#btnFiltro").click(function(){
	 
	  $("#display-opcion-filtrado").toggle("linear");
	  
	  $("#display-opcion-filtrado").css({"top": (($(".navbar-custom").height()+20)+"px")});
	  
	  //comprueba que esté en el div de filtrado o no
	  if($("#divBtnFiltrado #btnFiltro").length){
		  $btnFil = $(this).detach();
		  $btnFil.html("Filtrar >>");
		  $btnFil.css({"position": "fixed",
			  			"top": (($(".navbar-custom").height()+60)+"px")});
		  $("body").append($btnFil);
	  }
	  else{
		  $btnFil = $(this).detach();
	  		$btnFil.html("Cerrar");
	  		$btnFil.css({"position": "relative",
	  					"top": "0px"});
		  $("#divBtnFiltrado").append($btnFil);
	  }
  });
  
  
 

/*function espaciadoFooter() {
  $footer = $("#footer");
  $paddingbot= $("#content-wrap");

  $altura = $footer.height();

  $paddingbot.css("padding-bottom", `${$altura*1.2}px`);

  console.log($altura);
  console.log($footer.css("margin-top"));
}

function footerInicial(){
  $footer = $("#footer");
  $pagecontainer= $("#page-container");

  $alturaFooter = $footer.height();
  $alturaPagC = $pagecontainer.height();

  $pagecontainer.css("min-height", `${$alturaPagC-$alturaFooter}px`);
  $footer.css("bottom", "0");

}*/

function mostarOcultar(){

    let $caja=$(this).parent().parent().children("div.body-event");
    let $footer=$(this).parent().parent().children("footer");

    if($caja.is( ":hidden" ) ) {
      $(this).toggleClass("fa-minus");
      $(this).toggleClass("fa-plus");

      $caja.slideDown(250);
      
        $(this).parent().css("border-bottom", "");
    } else {
      $(this).toggleClass("fa-minus");
      $(this).toggleClass("fa-plus");

      $caja.slideUp(250);

      setTimeout(() =>{
      $(this).parent().css("border-bottom", "1px solid #686868")}, 250);
    }

    

    /*if ( $caja.css("display") == null || $caja.css("display") == "block"){
      $caja.css("display", "none");
      $(this).toggleClass("fa-minus");
      $(this).toggleClass("fa-plus");
    }
     else{
      $caja.css("display", "block");
      $(this).toggleClass("fa-minus");
      $(this).toggleClass("fa-plus");
     }*/

}

});


