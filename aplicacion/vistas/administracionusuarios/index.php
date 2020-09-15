<?php 


echo CHTML::dibujaEtiqueta("h1", [],"Usuarios").PHP_EOL;


echo CHTML::dibujaEtiqueta("fieldset",["class"=>"form-group"],
    CHTML::dibujaEtiqueta("legend",[],"Opciones de filtrado"),
    false);

echo CHTML::dibujaEtiqueta("div", ["class"=>"col-sm-6"],"",false).PHP_EOL;

    echo CHTML::iniciarForm("","get",["id"=>"filtrado"]).PHP_EOL;
        
    
        echo CHTML::dibujaEtiqueta("div", ["class"=>"form-group row"],"",false).PHP_EOL;

            echo CHTML::campoLabel("Correo", "correo", ["class"=>"col-sm-2 col-form-label"]).PHP_EOL;
        
        echo CHTML::dibujaEtiqueta("div", ["class"=>"col-sm-10"],"",false).PHP_EOL;
          
        
        echo CHTML::campoText("correo",$dat["correo"],
            ["form"=>"filtrado", "class"=>"form-control", "placeholder"=>"Correo"]).PHP_EOL;
            
        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
        
        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
        
        
        
        echo CHTML::dibujaEtiqueta("div", ["class"=>"form-group row"],"",false).PHP_EOL;
        
        echo CHTML::campoLabel("Role", "role", ["class"=>"col-sm-2 col-form-label"]);
        
        echo CHTML::dibujaEtiqueta("div", ["class"=>"col-sm-10"],"",false).PHP_EOL;
        
            echo CHTML::campoListaDropDown("role",$dat["role"],
                Vista_usuarios::listaRoles(),
                ["linea"=>"Sin seleccionar", "form"=>"filtrado", "class"=>"form-control"]).PHP_EOL;
                
        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
        
        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
        

    echo CHTML::finalizarForm().PHP_EOL;
    
    echo CHTML::dibujaEtiqueta("table", ["class"=>"tablaFiltrado"]);
    
    echo CHTML::dibujaEtiqueta("tr");
  
    echo CHTML::dibujaEtiqueta("td");
    echo CHTML::campoLabel("Activado:", "activ").
    CHTML::campoListaDropDown("activ",$dat["activ"],
        ["S"=>"Activado",
            "N"=>"Sin activar"],
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

echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::campoBotonSubmit("Filtrar",["form"=>"filtrado","class"=>"btn btn-secondary"]).PHP_EOL;
        
echo CHTML::dibujaEtiquetaCierre("fieldset");
        echo "<br><br>";
        
        echo CHTML::link(CHTML::imagen('/imagenes/24x24/nuevo.png').
            "Nuevo",["administracionusuarios","insertar"],["class"=>"btn btn-success"]).
            "<br><br>".PHP_EOL;
        
        
        /*$acl = new Acl_usuarios();

        $acl->cod_usuario=1;
        $acl->setValores(["nombre"=>"prueba", "nick"=>"prueba", "contrasena"=>"prueba", "cod_role"=> 2, "borrado"=>0]);
        
        if ($acl->validar()){
            if ($acl->guardar()){
                echo $acl->cod_usuario;
            }
        }*/
            
       /* $acl = new Usuarios();

        $acl->setValores(["nick"=>"prueba", "correo"=>"prueba@aaa.es", "nombre"=>"prueba",
            "apellidos"=>"prueba prueba", "dni"=> "25620888W", "fecha_nacimiento"=>"20/05/2004",
            "sexo"=>0, "telefono"=>"999122122", "imagen"=>"","activado"=>0]);
        
        if ($acl->validar()){
        if ($acl->guardar()){
        echo $acl->cod_usuario;
        }
            
        }*/
            
        

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