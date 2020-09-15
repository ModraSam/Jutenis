<?php 

$this->textoHead=CHTML::scriptFichero("/javascript/participantes.js").CGrid::requisitos();

echo CHTML::modeloError($eventoUsuario, "cod_usuario", ["class"=>"alert alert-danger", "role"=>"alert",
    "style"=>"color: #721c24; position: fixed; top: 60px; left: 60px; z-index:2;"], true).PHP_EOL;

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


if($evento->aforo>count($filas)){
    
    echo CHTML::botonHtml("Añadir participante", ["id"=>"anadir", "class"=>"btn btn-primary"]);
    
    echo CHTML::dibujaEtiqueta("div",["id"=>"anadir-container"]);
    
    
    
    
    echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);
    
    echo CHTML::iniciarForm();
    
    echo CHTML::dibujaEtiqueta("div",["class"=>"row"]);
    
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
    echo CHTML::campoLabel("Lista de usuarios", "a_usu", ["class"=>"h4"]) .
    CHTML::campoListaDropDown("a_usu", "",
        Eventos::listaUsuariosEvento($evento->cod_evento),
        [
            "class"=>"form-control"
        ]);
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6 d-flex align-items-end"]);
    
    echo CHTML::campoBotonSubmit("Añadir",["class"=>"btn btn-success"]).PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::finalizarForm();
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
}



echo CHTML::dibujaEtiqueta("h3",["class"=>"mt-4 mb-3"],"Participantes");


$tabla=new CGrid($cabe,$filas,
    ["id"=>"table", "class"=>"table table-striped"]);


echo CHTML::dibujaEtiqueta("div",["class"=>"grid"]);


//se dibuja la tabla
echo $tabla->dibujate();


echo CHTML::dibujaEtiquetaCierre("div");





echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");



