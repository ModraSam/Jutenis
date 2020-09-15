<?php

$this->textoHead = CHTML::scriptFichero("/javascript/prev_img.js");

echo CHTML::iniciarForm("","post",["enctype"=>"multipart/form-data"]);
echo CHTML::modeloHidden($noticia, "cod_noticia");

echo CHTML::dibujaEtiqueta("div",["class"=>"container"]);

echo CHTML::dibujaEtiqueta("div",["class"=>"row"]);

echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-12"]);



echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

echo CHTML::modeloLabel($noticia, "titulo",[]);

echo CHTML::modeloText($noticia,"titulo",["class"=>"form-control","maxlength"=>50]).
CHTML::modeloError($noticia, "titulo", ["class"=>"alert alert-danger"]). PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");


echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

echo CHTML::modeloLabel($noticia, "mensaje",[]).
CHTML::modeloTextArea($noticia,"mensaje",["class"=>"form-control editor", "maxlength"=>3000, "rows"=>"20"]).
CHTML::modeloError($noticia, "mensaje", ["class"=>"alert alert-danger"]).PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");


echo CHTML::dibujaEtiqueta("div",["class"=>"form-group row"]);

    
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($noticia, "autor",[]);
        
        echo CHTML::modeloText($noticia,"autor",["class"=>"form-control","maxlength"=>30]).
        CHTML::modeloError($noticia, "autor", ["class"=>"alert alert-danger"]). PHP_EOL;
        
        echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
    echo CHTML::modeloLabel($noticia, "imagen")."<br>".PHP_EOL;
    
        echo CHTML::modeloFile($noticia,"imagen", ["class"=>"impImg"]).
        CHTML::modeloError($noticia, "imagen", ["class"=>"alert alert-danger"]). PHP_EOL;
        
        echo CHTML::imagen("","",["id"=>"imgPreview", "class"=>"avatar", "style"=>"display: none;"]);
    
    echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");



//borrado

echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

echo CHTML::modeloLabel($noticia, "borrado") ;


echo CHTML::modeloListaDropDown($noticia, "borrado",
    [0=>"No borrado",1=>"Borrado"],
    [
        "linea"=>false,
        "class"=>"form-control"
    ]).CHTML::modeloError($noticia, "borrado", ["class"=>"alert alert-danger"]). PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");


    echo CHTML::campoBotonSubmit("Modificar",["class"=>"btn btn-primary"]).PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
    
    
    echo CHTML::finalizarForm();