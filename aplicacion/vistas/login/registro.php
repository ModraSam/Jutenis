<?php

echo CHTML::iniciarForm();
echo CHTML::modeloHidden($usu, "cod_usuario");
echo CHTML::modeloHidden($acl, "cod_usuario");

echo CHTML::dibujaEtiqueta("div", ["class"=>"text-center mb-5 h1"], "Regristro", true);

echo CHTML::dibujaEtiqueta("div",["class"=>"container"]);

echo CHTML::dibujaEtiqueta("div",["class"=>"row"]);

echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-12"]);


//nombre apellidos

echo CHTML::dibujaEtiqueta("div",["class"=>"form-group row"]);


    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-5"]);

        echo CHTML::modeloLabel($acl, "nombre",[]);
        
        echo CHTML::modeloText($acl,"nombre",["class"=>"form-control","maxlength"=>30]).
        CHTML::modeloError($acl, "nombre", ["class"=>"alert alert-danger"]). PHP_EOL;

    echo CHTML::dibujaEtiquetaCierre("div");

    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-7"]);

        echo CHTML::modeloLabel($usu, "apellidos",[]);
        
        echo CHTML::modeloText($usu,"apellidos",["class"=>"form-control","maxlength"=>40]).
        CHTML::modeloError($usu, "apellidos", ["class"=>"alert alert-danger"]). PHP_EOL;
    
     echo CHTML::dibujaEtiquetaCierre("div");
    
echo CHTML::dibujaEtiquetaCierre("div");


//correo
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

    echo CHTML::modeloLabel($usu, "correo",[]);
    
    echo CHTML::modeloText($usu,"correo",["class"=>"form-control","maxlength"=>320]).
    CHTML::modeloError($usu, "correo", ["class"=>"alert alert-danger"]). PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");


//nick
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

    echo CHTML::modeloLabel($acl, "nick",[]);
    
    echo CHTML::modeloText($acl,"nick",["class"=>"form-control","maxlength"=>30]).
    CHTML::modeloError($acl, "nick", ["class"=>"alert alert-danger"]). PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");

//sexo y fecha
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group row"]);


    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);

        echo CHTML::modeloLabel($usu, "sexo") ;
        
        echo CHTML::modeloListaDropDown($usu, "sexo",
            [0=>"Femenino",1=>"Masculino"],
            [
                "linea"=>false,
                "class"=>"form-control"
            ]).CHTML::modeloError($usu, "sexo", ["class"=>"alert alert-danger"]). PHP_EOL;

    echo CHTML::dibujaEtiquetaCierre("div");

    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($usu, "fecha_nacimiento",["col-sm-2 col-form-label"]);
        
        echo CHTML::modeloDate($usu,"fecha_nacimiento",["class"=>"form-control", "value"=>date("Y-m-d", strtotime(str_replace('/', '-', $usu->fecha_nacimiento)))]).
        CHTML::modeloError($usu, "fecha_nacimiento", ["class"=>"alert alert-danger"]).PHP_EOL;
        
    echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");


//contraseña
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

    echo CHTML::modeloLabel($acl, "contrasena",[]);
    
    echo CHTML::modeloPassword($acl,"contrasena",["class"=>"form-control","maxlength"=>30]).
    CHTML::modeloError($acl, "contrasena", ["class"=>"alert alert-danger"]). PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");

//dni telefono
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group row"]);


    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($usu, "dni",[]);
        
        echo CHTML::modeloText($usu,"dni",["class"=>"form-control","maxlength"=>9]).
        CHTML::modeloError($usu, "dni", ["class"=>"alert alert-danger"]). PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div");

    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($usu, "telefono",[]);
        
        echo CHTML::modeloText($usu,"telefono",["class"=>"form-control","maxlength"=>9]).
        CHTML::modeloError($usu, "telefono", ["class"=>"alert alert-danger"]). PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");


//dni telefono
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group row"]);

    
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        
        
    echo CHTML::dibujaEtiquetaCierre("div");
    

echo CHTML::dibujaEtiquetaCierre("div");


//sumbit
echo CHTML::dibujaEtiqueta("div", ["class"=>"row"]);

    echo CHTML::campoBotonSubmit("Registrarse",["class"=>"btn btn-success col-12 mt-3"]).PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");



echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");




echo CHTML::finalizarForm();