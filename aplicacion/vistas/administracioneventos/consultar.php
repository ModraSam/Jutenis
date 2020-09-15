<?php 

echo CHTML::dibujaEtiqueta("div",["class"=>"container"]);

echo CHTML::dibujaEtiqueta("div",["class"=>"row"]);

echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-12"]);



echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

    echo CHTML::modeloLabel($evento, "titulo",[]);
    
    echo CHTML::modeloText($evento,"titulo",["class"=>"form-control", "readonly"=>"readonly"]).PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");


echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

    echo CHTML::modeloLabel($evento, "contenido",[]).
    CHTML::modeloTextArea($evento,"contenido",["class"=>"form-control", "rows"=>"4","readonly"=>"readonly"]).PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");



//poblacion y fecha
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group row"]);
    

    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($evento, "fecha",["col-sm-2 col-form-label"]);
        
        echo CHTML::modeloText($evento,"fecha",["class"=>"form-control", "readonly"=>"readonly"]).PHP_EOL;

    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($evento, "poblacion",["col-sm-2 col-form-label"]);
        
        echo CHTML::modeloText($evento,"poblacion",["class"=>"form-control", "readonly"=>"readonly"]).PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
echo CHTML::dibujaEtiquetaCierre("div");


//edades

echo CHTML::dibujaEtiqueta("div",["class"=>"form-group row"]);


    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);

        echo CHTML::modeloLabel($evento, "edad_requerida",["col-sm-2 col-form-label"]);
        
        echo CHTML::modeloText($evento,"edad_Requerida",["class"=>"form-control", "readonly"=>"readonly"]).PHP_EOL;

    echo CHTML::dibujaEtiquetaCierre("div");

    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($evento, "edad_maxima",["col-sm-2 col-form-label"]);
        
        echo CHTML::modeloText($evento,"edad_maxima",["class"=>"form-control", "readonly"=>"readonly"]).PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");



//tipo_evento

echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

        echo CHTML::modeloLabel($evento, "tipo_evento",[]);
        
        echo CHTML::modeloText($evento,"tipo_evento",["class"=>"form-control", "readonly"=>"readonly"]).PHP_EOL;
        
echo CHTML::dibujaEtiquetaCierre("div");


//aforo
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group row"]);


    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($evento, "aforo",["col-sm-2 col-form-label"]);
        
        echo CHTML::modeloText($evento,"aforo",["class"=>"form-control", "readonly"=>"readonly"]).PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($evento, "n_inscritos",["col-sm-2 col-form-label"]);
        
        echo CHTML::modeloText($evento,"n_inscritos",["class"=>"form-control", "readonly"=>"readonly"]).PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

    echo CHTML::modeloCheckBox($evento, "borrado", [
        "value"=>1,
        "uncheckValor"=>0,
        "etiqueta"=>"Borrado",
        "disabled"=>"",
        "class"=>"form-check-label"
    ]) .
    CHTML::modeloError($evento, "borrado") . PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::link("Editar", Sistema::app()->generaURL(array(
    "administracioneventos",
    "modificar"
), array(
    "id" => $evento->cod_evento
)), ["class"=>"btn btn-primary"]).PHP_EOL;


echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");