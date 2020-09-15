<?php 

echo CHTML::dibujaEtiqueta("h1", [],"Eventos").PHP_EOL;

echo CHTML::dibujaEtiqueta("fieldset",["class"=>"form-group"],
    CHTML::dibujaEtiqueta("legend",[],"Opciones de filtrado"),
    false);
echo CHTML::iniciarForm("","get",["id"=>"filtrado"]);

echo CHTML::finalizarForm();

echo CHTML::dibujaEtiqueta("table", ["class"=>"tablaFiltrado"]);

    echo CHTML::dibujaEtiqueta("tr");

        echo CHTML::dibujaEtiqueta("td");
            echo CHTML::campoLabel("Población:", "poblacion").
            CHTML::campoListaDropDown("poblacion",$dat["poblacion"],
                Eventos::listaPoblaciones(),
                ["linea"=>"Sin seleccionar", "form"=>"filtrado", "class"=>"form-control"]).PHP_EOL;
        echo CHTML::dibujaEtiquetaCierre("td");
        
        echo CHTML::dibujaEtiqueta("td");
            echo CHTML::campoLabel("Tipo:", "tipo").
            CHTML::campoListaDropDown("tipo",$dat["tipo"],
                Eventos::listaTiposEventos(),
                ["linea"=>"Sin seleccionar", "form"=>"filtrado", "class"=>"form-control"]).PHP_EOL;
        echo CHTML::dibujaEtiquetaCierre("td");
            
        echo CHTML::dibujaEtiqueta("td");
            echo CHTML::campoLabel("Borrado:", "bor").
            CHTML::campoListaDropDown("bor",$dat["bor"],
                ["S"=>"Borrado",
                    "N"=>"Sin borrar"],
                ["linea"=>"Sin seleccionar", "form"=>"filtrado", "class"=>"form-control"]).PHP_EOL;
        echo CHTML::dibujaEtiquetaCierre("td");

    echo CHTML::dibujaEtiquetaCierre("tr");

echo CHTML::dibujaEtiquetaCierre("table");

    
echo CHTML::campoBotonSubmit("Filtrar",["form"=>"filtrado","class"=>"btn btn-secondary"]);
        
echo CHTML::dibujaEtiquetaCierre("fieldset");
        echo "<br><br>";
        
        echo CHTML::link(CHTML::imagen('/imagenes/24x24/nuevo.png').
            "Nuevo",["administracioneventos","insertar"],["class"=>"btn btn-success"]).
            "<br><br>".PHP_EOL;
        
        

$this->textoHead=CPager::requisitos().CGrid::requisitos();//CHTML::scriptFichero("/javascript/table.js");

$tabla=new CGrid($cabe,$filas,
    ["id"=>"table", "class"=>"table table-striped"]);

$pagi=new CPager($opcPag,array());


//dibujo el paginador
echo CHTML::dibujaEtiqueta("div",["class"=>"grid"]);
echo $pagi->dibujate();

//se dibuja la tabla
echo $tabla->dibujate();

//dibujo el paginador
echo $pagi->dibujate();

echo CHTML::dibujaEtiquetaCierre("div");

?>