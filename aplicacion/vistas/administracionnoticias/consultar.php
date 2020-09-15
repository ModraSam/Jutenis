<?php 

echo CHTML::dibujaEtiqueta("div",["class"=>"container"]);

echo CHTML::dibujaEtiqueta("div",["class"=>"row"]);

echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-12"]);



echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

    echo CHTML::modeloLabel($noticia, "titulo",[]);
    
    echo CHTML::modeloText($noticia,"titulo",["class"=>"form-control", "readonly"=>"readonly"]).PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");


echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

    echo CHTML::modeloLabel($noticia, "mensaje",[]).PHP_EOL;
    
    echo $noticia->mensaje.PHP_EOL;
    
    //CHTML::modeloTextArea($noticia,"mensaje",["class"=>"form-control", "rows"=>"20","readonly"=>"readonly"]).PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");


//imagen
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group row"]);

    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($noticia, "imagen",[])."<br>".PHP_EOL;
        
        if($noticia->imagen!="")
            echo CHTML::imagen("/imagenes/img_noticias/".$noticia->imagen,"imagen", ["class"=>"imagen-noticia"]);
    
    echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");


//autor
    echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);
    
        echo CHTML::modeloLabel($noticia, "autor",[]).PHP_EOL;
    
        echo CHTML::modeloText($noticia,"autor",["class"=>"form-control", "readonly"=>"readonly"]).PHP_EOL;

    
    echo CHTML::dibujaEtiquetaCierre("div");


//fecha borrado
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group row"]);
    

    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($noticia, "fecha",["col-sm-2 col-form-label"]);
        
        echo CHTML::modeloText($noticia,"fecha",["class"=>"form-control", "readonly"=>"readonly"]).PHP_EOL;

    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
    echo CHTML::modeloLabel($noticia, "borrado") ;
    
    echo CHTML::modeloListaDropDown($noticia, "borrado",
        [0=>"No borrado",1=>"Borrado"],
        [
            "linea"=>false,
            "class"=>"form-control",
            "readonly"=>"readonly"
        ]).CHTML::modeloError($noticia, "borrado", ["class"=>"alert alert-danger"]). PHP_EOL;
        
        echo CHTML::dibujaEtiquetaCierre("div");
        
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
echo CHTML::dibujaEtiquetaCierre("div");


echo CHTML::link("Editar", Sistema::app()->generaURL(array(
    "administracionnoticias",
    "modificar"
), array(
    "id" => $noticia->cod_noticia
)), ["class"=>"btn btn-primary"]).PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");