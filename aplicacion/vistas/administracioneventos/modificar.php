<?php 
//uso de sesion
if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 1;
} else {
    $_SESSION['contador']++;
}

echo CHTML::iniciarForm();
echo CHTML::modeloHidden($evento, "cod_evento");

echo CHTML::dibujaEtiqueta("div",["class"=>"container"]);

echo CHTML::dibujaEtiqueta("div",["class"=>"row"]);

echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-12"]);



echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

    echo CHTML::modeloLabel($evento, "titulo",[]);
    
    echo CHTML::modeloText($evento,"titulo",["class"=>"form-control","maxlength"=>50]).
    CHTML::modeloError($evento, "titulo", ["class"=>"alert alert-danger"]). PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");


echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

    echo CHTML::modeloLabel($evento, "contenido",[]).
    CHTML::modeloTextArea($evento,"contenido",["class"=>"editor form-control", "maxlength"=>3000, "rows"=>"4"]).
    CHTML::modeloError($evento, "contenido", ["class"=>"alert alert-danger"]).PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");



//poblacion y fecha
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group row"]);
    

    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($evento, "fecha",["col-sm-2 col-form-label"]);
        
        echo CHTML::modeloDate($evento,"fecha",["class"=>"form-control", "value"=>date("Y-m-d", strtotime(str_replace('/', '-', $evento->fecha)))]).
        CHTML::modeloError($evento, "fecha", ["class"=>"alert alert-danger"]).PHP_EOL;

    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($evento, "poblacion",["col-sm-2 col-form-label"]);
        
        echo CHTML::modeloListaDropDown($evento, "cod_poblacion",
            Eventos::listaPoblaciones(),
            [
                "class"=>"form-control"
            ]) .
            CHTML::modeloError($evento, "cod_poblacion", ["class"=>"alert alert-danger"]).PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
echo CHTML::dibujaEtiquetaCierre("div");


//edades

echo CHTML::dibujaEtiqueta("div",["class"=>"form-group row"]);


    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);

        echo CHTML::modeloLabel($evento, "edad_requerida",["col-sm-2 col-form-label"]);
        
        echo CHTML::modeloNumber($evento,"edad_Requerida",["class"=>"form-control"]).
        CHTML::modeloError($evento, "edad_requerida", ["class"=>"alert alert-danger"]).PHP_EOL;

    echo CHTML::dibujaEtiquetaCierre("div");

    echo CHTML::dibujaEtiqueta("div",["class"=>"col-sm-6"]);
    
        echo CHTML::modeloLabel($evento, "edad_maxima",["col-sm-2 col-form-label"]);
        
        echo CHTML::modeloNumber($evento,"edad_maxima",["class"=>"form-control"]).
        CHTML::modeloError($evento, "edad_maxima", ["class"=>"alert alert-danger"]).PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");



//tipo_eventos
    
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

    echo CHTML::modeloLabel($evento, "tipo_evento") .
        CHTML::modeloListaDropDown($evento, "cod_tipo_evento",
            Eventos::listaTiposEventos(),
            [
                "class"=>"form-control"
            ]).CHTML::modeloError($evento, "tipo_evento", ["class"=>"alert alert-danger"]).PHP_EOL;
            
echo CHTML::dibujaEtiquetaCierre("div");



//aforo
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);
    
        echo CHTML::modeloLabel($evento, "aforo",[""]);
        
        echo CHTML::modeloNumber($evento,"aforo",["class"=>"form-control"]).
        CHTML::modeloError($evento, "aforo", ["class"=>"alert alert-danger"]).PHP_EOL;
    
echo CHTML::dibujaEtiquetaCierre("div");


//borrado
echo CHTML::dibujaEtiqueta("div",["class"=>"form-group"]);

    echo CHTML::modeloLabel($evento, "borrado") ;
    
    echo CHTML::modeloListaDropDown($evento, "borrado",
        [0=>"No borrado",1=>"Borrado"],
        [
            "linea"=>false,
            "class"=>"form-control"
        ]).CHTML::modeloError($evento, "borrado", ["class"=>"alert alert-danger"]). PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");


echo CHTML::campoBotonSubmit("Modificar",["class"=>"btn btn-primary"]).PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");



echo CHTML::finalizarForm();