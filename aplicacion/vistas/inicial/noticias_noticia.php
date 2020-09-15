<?php 
 	
    if($cont>2){

        echo CHTML::dibujaEtiqueta("div", ["class"=>"col-12 col-sm-6 mt-2 noti"], "", false).PHP_EOL;
        
            echo CHTML::dibujaEtiqueta("a", ["href"=>Sistema::app()->generaURL(array(
                "inicial",
                "noticia"
            ), array(
                "noticia" => $fila['cod_noticia']
            )), "class"=>"link-noticia"], "", false);
        
        
            echo CHTML::dibujaEtiqueta("div", ["class"=>"row"], "", false).PHP_EOL;
            
                echo CHTML::dibujaEtiqueta("div", ["class"=>"col-4 mr-2"], "", false).PHP_EOL;
                
                    if($fila["imagen"] !="")
                        echo CHTML::imagen("/imagenes/img_noticias/".$fila["imagen"],"img noticia", ["class"=>"imagen-noticia mb-3"]).PHP_EOL;
                        else
                            echo CHTML::imagen("/imagenes/background/tenis.jpg","img noticia", ["class"=>"imagen-noticia mb-3"]).PHP_EOL;
                
                echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                
                echo CHTML::dibujaEtiqueta("div", ["class"=>"col-7 mr-2"], "", false).PHP_EOL;
                
                    echo CHTML::dibujaEtiqueta("p", ["class"=>"fecha-noticias"],
                        '<i class="fa fa-clock-o mr-1" aria-hidden="true"></i>'.funcionesGenerales::transforma_fecha($fila["fecha"])).PHP_EOL;
                    
                    echo CHTML::dibujaEtiqueta("p", ["class"=>"titulo-noticias-peque" ], $fila["titulo"],true).PHP_EOL;
                
                echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
            
            echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
            
            echo CHTML::dibujaEtiquetaCierre("a").PHP_EOL;
        
        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
       
                                    
}
else{


    echo CHTML::dibujaEtiqueta("div", ["class"=>"col-12 col-sm-6 mt-2 mb-4 noti"], "", false).PHP_EOL;
    
        echo CHTML::dibujaEtiqueta("a", ["href"=>Sistema::app()->generaURL(array(
            "inicial",
            "noticia"
        ), array(
            "noticia" => $fila['cod_noticia']
        )), "class"=>"link-noticia"], "", false);
    
    
        echo CHTML::dibujaEtiqueta("div", [], "", false).PHP_EOL;
        
        if($fila["imagen"] !="")
            echo CHTML::imagen("/imagenes/img_noticias/".$fila["imagen"],"img noticia", ["class"=>"imagen-noticia mb-3"]).PHP_EOL;
            else
                echo CHTML::imagen("/imagenes/background/tenis.jpg","img noticia", ["class"=>"imagen-noticia mb-3"]).PHP_EOL;
            
            
            echo CHTML::dibujaEtiqueta("div", ["class"=>"ml-2"], "", false).PHP_EOL;
            
            
                echo CHTML::dibujaEtiqueta("p", ["class"=>"fecha-noticias"],
                    '<i class="fa fa-clock-o mr-2" aria-hidden="true"></i>'.funcionesGenerales::transforma_fecha($fila["fecha"])).PHP_EOL;
                
                echo CHTML::dibujaEtiqueta("p", ["class"=>"titulo-noticias" ], $fila["titulo"],true).PHP_EOL;
               
                
                echo CHTML::dibujaEtiqueta("div", ["class"=>" pos-noticia"], "Escrito por ".$fila["autor"],true).PHP_EOL;
                
                
            echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
            
        
        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
        
        echo CHTML::dibujaEtiquetaCierre("a").PHP_EOL;

    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;

}



 	
 	