<?php 
 	
echo CHTML::dibujaEtiqueta("div", ["class"=>"container text-center container-event mb-5"], "", false).PHP_EOL;





echo CHTML::dibujaEtiqueta("div", ["class"=>"body-event"], "", false).PHP_EOL;



    echo CHTML::dibujaEtiqueta("p", ["class"=>"text-left title-event mr-2"], "", false).PHP_EOL;


            echo $fila["titulo"] . " (".$fila["poblacion"].")".PHP_EOL;
        
        echo CHTML::dibujaEtiquetaCierre("p").PHP_EOL;
        
        echo CHTML::dibujaEtiqueta("div", ["class"=>" text-right mb-2 font-weight-bold"], $fila["tipo_evento"]).PHP_EOL;
        
        echo CHTML::dibujaEtiqueta("div", ["class"=>" text-left mr-4 ml-2"], "", false).PHP_EOL;

        echo $fila["contenido"]. "<br><p class='mt-3'>Edad requerida: ".$fila["edad_requerida"]." años".PHP_EOL;
        if ($fila["edad_maxima"]!="0") {
            echo "<br>Edad máxima: ".$fila["edad_maxima"]." años</p>".PHP_EOL;
        }


        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;

        

    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
     	
     	
    echo CHTML::dibujaEtiqueta("footer", ["class"=>"footer-event navbar row"], "", false).PHP_EOL;
    
    
    echo  CHTML::dibujaEtiqueta("p", ["class"=>"text-left col-6 col-md-6 order-1 order-md-1"], '<i class="fa fa-calendar mr-2" aria-hidden="true"></i> '.CGeneral::fechaMysqlANormal($fila["fecha"])).PHP_EOL;
    
    if(Sistema::app()->Acceso()->hayUsuario()){
        $resultado = $eventoUsuario->buscarTodos(["where" => "cod_usuario = ".$usuario." and cod_evento = ".$fila["cod_evento"]]);
        
        if($resultado && $resultado[0]["borrado"]==0){
            
            echo CHTML::link( "Dejar de participar",
                Sistema::app()->generaURL(array(
                    "inicial",
                    "mis_eventos"
                ), array(
                    "id" => $fila["cod_evento"],
                    "eve_usu" =>$resultado[0]["cod_evento_usuario"]
                )),
                ["class"=>"btn btn-danger btn-participate col-12 col-md-4 order-3 order-md-2 confirmacion-evento"]).PHP_EOL;
        }
        if($resultado && $resultado[0]["borrado"]==1){
            echo  CHTML::dibujaEtiqueta("button", ["class"=>"btn btn-secondary btn-participate col-12 col-md-4 order-3 order-md-2", "disabled"=>"disabled"], "Participar").PHP_EOL;
        }
        
        if(!$resultado){
            echo CHTML::link( "Participar",
                Sistema::app()->generaURL(array(
                    "inicial",
                    "mis_eventos"
                ), array(
                    "id" => $fila["cod_evento"]
                )),
                ["class"=>"btn btn-success btn-participate col-12 col-md-4 order-3 order-md-2"]).PHP_EOL;
        }
        
    }
    
    
    
    else{
        echo CHTML::link( "Participar",
            Sistema::app()->generaURL(array(
                "inicial",
                "mis_eventos"
            ), array(
                "id" => $fila["cod_evento"]
            )),
            ["class"=>"btn btn-success btn-participate col-12 col-md-4 order-3 order-md-2"]).PHP_EOL;
    }
    
    echo  CHTML::dibujaEtiqueta("p", ["class"=>"text-right col-6 col-md-2 order-2 order-md-3"], ($fila["n_inscritos"]."/".$fila["aforo"])).PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("footer").PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
 	
 	