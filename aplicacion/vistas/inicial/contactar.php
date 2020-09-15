<?php

if($enviado){
    echo CHTML::dibujaEtiqueta("div", ["class"=>"alert alert-success text-left", "role"=>"alert",
        "style"=>"position: fixed; top: 60px; left: 60px; z-index:2;"], "", false).PHP_EOL;
    
    echo CHTML::dibujaEtiqueta("h4", ["class"=>"alert-heading"], "Enviado correctamente", true);
    
    echo CHTML::dibujaEtiqueta("p", [], "Muchas gracias por su comentario, le enviaremos una respuesto lo más rápido posible.", true);
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
}


echo CHTML::dibujaEtiqueta("div",["class"=>"row"]);


echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-12 col-lg-6 mb-5 contacto"]);

echo CHTML::dibujaEtiqueta("div",["class"=>"mt-5"]);

    echo CHTML::dibujaEtiqueta("h2",[],"CONTACTO",true);
    
    echo CHTML::dibujaEtiqueta("div",["class"=>"container mt-5"]);
    
    echo CHTML::dibujaEtiqueta("h4",[],"JUTENIS SE ENCUENTRA EN:",true);
    
     echo CHTML::dibujaEtiqueta("p",["class"=>"mt-2 ml-2"], CHTML::dibujaEtiqueta("i",["class"=>"fa fa-map-o"],"",true)." C/ de Gladys Harbors , 2<br>".
         "Centro de Tecnificación de Tenis<br>".
         "29532-Málaga",true);

     echo CHTML::dibujaEtiqueta("p",[]," Si quieres ponerte en contacto puedes hacerlo por teléfono: 999 999 999, nuestro email jutenissl@gmail.com, escribiéndonos a través nuestro formulario:",true);
     
    
     
        echo CHTML::dibujaEtiquetaCierre("div");
        
    
    echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiqueta("div",["class"=>"container mt-5"]);

echo CHTML::dibujaEtiqueta("div",["class"=>"row"]);

echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-12"]);


echo CHTML::iniciarForm();
echo CHTML::modeloHidden($men, "cod_mensaje");

//nombre correo
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group row"]);


    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-5"]);

        echo CHTML::modeloLabel($men, "nombre",[]);
        
        echo CHTML::modeloText($men,"nombre",["class"=>"form-control","maxlength"=>50, "required"=>"required"]).
        CHTML::modeloError($men, "nombre", ["class"=>"alert alert-danger"]). PHP_EOL;

    echo CHTML::dibujaEtiquetaCierre("div");

    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-7"]);

        echo CHTML::modeloLabel($men, "correo",[]);
        
        echo CHTML::modeloText($men,"correo",["class"=>"form-control","maxlength"=>320]).
        CHTML::modeloError($men, "correo", ["class"=>"alert alert-danger", "required"=>"required"]). PHP_EOL;
    
     echo CHTML::dibujaEtiquetaCierre("div");
    
echo CHTML::dibujaEtiquetaCierre("div");


//mensaje
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

        echo CHTML::modeloLabel($men, "mensaje",[]);
        
        
        echo CHTML::modeloTextArea($men,"mensaje",["class"=>"form-control", "rows"=>"9"]).
        CHTML::modeloError($men, "mensaje", ["class"=>"alert alert-danger"]). PHP_EOL;

        
echo CHTML::dibujaEtiquetaCierre("div");


echo CHTML::dibujaEtiqueta("div",["id"=>"botonera", "class"=>"form-group d-flex justify-content-end"]);

    echo CHTML::campoBotonSubmit("Enviar",["class"=>"btn btn-success"]).PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::finalizarForm();




echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiqueta("div",["class"=>"col-0 col-lg-5 mt-5 mb-5", "id"=>"img-contacto"]);

echo CHTML::dibujaEtiquetaCierre("div");


echo CHTML::dibujaEtiquetaCierre("div");


echo CHTML::dibujaEtiqueta("div",["class"=>"bottomLenguaje navbar-fixed-bottom", "id"=>"alert"], 'Le rogamos el uso lenguaje apropiado
                                                                                                    <button id="botonAceptar" class="btn btn-success">
                                                                                                    ¡Entendido!
                                                                                                    </button>'
    ,true);

