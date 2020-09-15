<?php 

echo CHTML::iniciarForm();

    echo CHTML::dibujaEtiqueta("div", ["class"=>"text-center mb-5 h1"], "Iniciar sesión", true);
    
    echo CHTML::modeloError($log, "nick", ["class"=>"alert alert-danger"]).
        CHTML::modeloText($log, "nick",["placeholder"=>"Usuario","size"=>10, "class"=>"form-control mb-4" ]).PHP_EOL;
    
        echo CHTML::modeloPassword($log, "contrasenia",["placeholder"=>"Contraseña","size"=>10, "class"=>"form-control mb-3"]).PHP_EOL;
    
   echo CHTML::dibujaEtiqueta("div", ["class"=>"container"]);
   
        echo CHTML::dibujaEtiqueta("div", ["class"=>"row"]);
        
        echo CHTML::campoBotonSubmit("Iniciar sesión", ["class"=>"btn btn-primary col-12"]).PHP_EOL;
        
        echo CHTML::dibujaEtiquetaCierre("div");
        
        echo "<hr>";
        
        echo CHTML::dibujaEtiqueta("div", ["class"=>"row"]);
        
        echo CHTML::link("Registrase", Sistema::app()->generaURL(array(
            "login",
            "registro"
        )), ["class"=>"btn btn-success col-12"]).PHP_EOL;
        
        echo CHTML::dibujaEtiquetaCierre("div");
   
   echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::finalizarForm();
