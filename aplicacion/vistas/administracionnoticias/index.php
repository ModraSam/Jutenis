<?php 

echo CHTML::dibujaEtiqueta("h1", [],"Noticias").PHP_EOL;

echo CHTML::dibujaEtiqueta("fieldset",["class"=>"form-group"],
    CHTML::dibujaEtiqueta("legend",[],"Opciones de filtrado"),
    false);


echo CHTML::dibujaEtiqueta("div", ["class"=>"col-sm-6"],"",false).PHP_EOL;
echo CHTML::iniciarForm("","get",["id"=>"filtrado"]);

    echo CHTML::dibujaEtiqueta("div", ["class"=>"form-group row"],"",false).PHP_EOL;
    
        echo CHTML::campoLabel("Título", "titulo", ["class"=>"col-sm-2 col-form-label"]).PHP_EOL;
    
    echo CHTML::dibujaEtiqueta("div", ["class"=>"col-sm-10"],"",false).PHP_EOL;
    
    
        echo CHTML::campoText("titulo",$dat["titulo"],
            ["form"=>"filtrado", "class"=>"form-control", "placeholder"=>"título"]).PHP_EOL;
        
    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
    
    
    
    echo CHTML::dibujaEtiqueta("div", ["class"=>"form-group row"],"",false).PHP_EOL;
    
        echo CHTML::campoLabel("Borrado", "bor", ["class"=>"col-sm-2 col-form-label"]).PHP_EOL;
    
    echo CHTML::dibujaEtiqueta("div", ["class"=>"col-sm-10"],"",false).PHP_EOL;
    
    
        echo CHTML::campoListaDropDown("bor",$dat["bor"],
            ["S"=>"Borrado",
                "N"=>"Sin borrar"],
            ["linea"=>"Sin seleccionar", "form"=>"filtrado", "class"=>"form-control"]).PHP_EOL;
            
        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
        
        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
    

echo CHTML::finalizarForm();
            
            
            echo CHTML::campoBotonSubmit("Filtrar",["form"=>"filtrado","class"=>"btn btn-secondary"]);
            
            echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
            
            echo CHTML::dibujaEtiquetaCierre("fieldset");
            echo "<br><br>";

        
        echo CHTML::link(CHTML::imagen('/imagenes/24x24/nuevo.png').
            "Nuevo",["administracionnoticias","insertar"],["class"=>"btn btn-success"]).
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