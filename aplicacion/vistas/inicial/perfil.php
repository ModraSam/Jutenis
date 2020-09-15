<?php


$this->textoHead = CHTML::scriptFichero("/javascript/imagen_perfil.js");

echo CHTML::dibujaEtiqueta("div",["class"=>"container"]).PHP_EOL;

    echo CHTML::dibujaEtiqueta("div",["class"=>"perfil"]).PHP_EOL;
        
        echo CHTML::dibujaEtiqueta("div",["class"=>"row"]).PHP_EOL;
        
        
        
            echo CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-lg-3"]).PHP_EOL;
            
            
            echo CHTML::dibujaEtiqueta("div",["class"=>"row"]).PHP_EOL;
            
                echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                    //imagen
                if($usuario->imagen !="")
                    echo CHTML::imagen("/imagenes/sources/".$usuario->imagen,"imagen de usuario", ["class"=>"avatar centrar"]).PHP_EOL;
                else 
                    echo CHTML::imagen("/imagenes/default/usuario.webp","imagen de usuario", ["class"=>"avatar centrar"]).PHP_EOL;

                echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
             
             echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
             
             
             echo CHTML::dibujaEtiqueta("div",["class"=>"row"]).PHP_EOL;
            
                echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
             
                echo CHTML::iniciarForm("","post",["enctype"=>"multipart/form-data", "id"=>"form"]);
                
                echo CHTML::modeloHidden($usuario, "cod_usuario");
                
                echo CHTML::modeloFile($usuario,"imagen").PHP_EOL;
                
                echo CHTML::finalizarForm().PHP_EOL;
                
                    echo CHTML::dibujaEtiqueta("p", ["class"=>"text-center"], CHTML::link(CHTML::dibujaEtiqueta("i",["class"=>"fa fa-pencil-square-o mb-3"],"")." Editar imagen", "#", ["id"=>"upload_link"])).PHP_EOL;
                
                echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                    
            echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
            
            
            echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
            
            
            echo CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-lg-7"]).PHP_EOL;
            
            
                echo CHTML::dibujaEtiqueta("div",["class"=>"row"]).PHP_EOL;
    
                    echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                    
                        echo CHTML::dibujaEtiqueta("p",["class"=>"definicion"],"APODO").PHP_EOL;
                    
                    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                
                    echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                    
                        echo CHTML::dibujaEtiqueta("p",["class"=>"mb-4"],$usuario->nick).PHP_EOL;
                    
                    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                
                echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
            
            
            
                echo CHTML::dibujaEtiqueta("div",["class"=>"row"]).PHP_EOL;
                
                    echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                    
                        echo CHTML::dibujaEtiqueta("p",["class"=>"definicion"],"NOMBRE").PHP_EOL;
                    
                    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                    
                    echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                    
                        echo CHTML::dibujaEtiqueta("p",["class"=>"mb-4"],$usuario->nombre_usu." ".$usuario->apellidos).PHP_EOL;
                    
                    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                    
                    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                    
                    
                    echo CHTML::dibujaEtiqueta("div",["class"=>"row"]).PHP_EOL;
                    
                        echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                        
                            echo CHTML::dibujaEtiqueta("p",["class"=>"definicion"],"FECHA DE NACIMIENTO").PHP_EOL;
                        
                        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                        
                        echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                        
                            echo CHTML::dibujaEtiqueta("p",["class"=>"mb-4"],CGeneral::fechaMysqlANormal($usuario->fecha_nacimiento)).PHP_EOL;
                        
                        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                    
                    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                    
                    
                    echo CHTML::dibujaEtiqueta("div",["class"=>"row"]).PHP_EOL;
                    
                        echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                        
                            echo CHTML::dibujaEtiqueta("p",["class"=>"definicion"],"CORREO").PHP_EOL;
                        
                        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                        
                        echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                        
                            echo CHTML::dibujaEtiqueta("p",["class"=>"mb-4"], $usuario->correo ).PHP_EOL;
                        
                        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                    
                    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                    
                    
                    echo CHTML::dibujaEtiqueta("div",["class"=>"row"]).PHP_EOL;
                    
                        echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                        
                            echo CHTML::dibujaEtiqueta("p",["class"=>"definicion"],"TELEFONO").PHP_EOL;
                        
                        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                        
                        echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                        
                            echo CHTML::dibujaEtiqueta("p",["class"=>"mb-4"], $usuario->telefono ).PHP_EOL;
                        
                        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                    
                    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                    
                    
                    echo CHTML::dibujaEtiqueta("div",["class"=>"row"]).PHP_EOL;
                    
                        echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                        
                            echo CHTML::dibujaEtiqueta("p",["class"=>"definicion"],"DNI").PHP_EOL;
                        
                        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                        
                        echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                        
                            echo CHTML::dibujaEtiqueta("p",["class"=>"mb-4"], $usuario->dni ).PHP_EOL;
                        
                        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                    
                    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                
                
                    echo CHTML::dibujaEtiqueta("div",["class"=>"row"]).PHP_EOL;
                        
                        echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                        
                            echo CHTML::dibujaEtiqueta("p",["class"=>"definicion"],"SEXO").PHP_EOL;
                        
                        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                        
                        echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]).PHP_EOL;
                        
                            echo CHTML::dibujaEtiqueta("p",["class"=>"mb-4"], $usuario->sexo==1 ? "Masculino" : "Femenino"  ).PHP_EOL;
                        
                        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                    
                    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
                    
                    
                echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
            
            
        
        echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;



