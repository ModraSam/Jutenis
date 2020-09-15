$(function(){
  
	$(".alert").fadeOut(3000);
	
  if ( $("#anadir").length > 0 ) {
    
    $("#anadir-container").hide();

    $("#anadir").click(function(){
      $("#anadir-container").slideDown();
      $("#anadir").slideUp();
    })

  }
  
  });