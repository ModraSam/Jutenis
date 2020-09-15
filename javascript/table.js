$(document).ready(function() {
  $("a.mostrar").click(function() {

    $elemento = $(this).siblings('span.ocultar');

      if ($elemento.is(":visible")) {
           $elemento.hide();
           $(this).text("Mostrar más.");
      }
      else {
          $elemento.show();
          $(this).text("Mostrar menos.");
      }

  });

});