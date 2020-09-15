<?php

class administracionnoticiasControlador extends CControlador
{

    public function __construct()
    {
        
        $this->plantilla="administracion";
        
        //organizadores
        if (Sistema::app()->Acceso()->puedeConfigurar() && !Sistema::app()->Acceso()->puedePermisoOtros(1) ) {
            $this->menu=[
                ["texto"=>"noticias",
                    "subenlace"=>[ //subenlace de noticias
                        
                        ["texto"=>"consultar",
                            "enlace"=>["administracionnoticias","index"]
                        ],
                        ["texto"=>"Insertar",
                            "enlace"=>["administracionnoticias","insertar"]
                        ]
                    ]
                ],
                ["texto"=>"eventos",
                    "subenlace"=>[ //subenlace de noticias
                        
                        ["texto"=>"consultar",
                            "enlace"=>["administracioneventos","index"]
                        ],
                        ["texto"=>"Insertar",
                            "enlace"=>["administracioneventos","insertar"]
                        ]
                    ]
                ],
                ["texto"=>"Mensajes",
                    "enlace"=>["administracionmensajes","index"]
                ]
                
            ];
            
        }
        //administradores
        else if(Sistema::app()->Acceso()->puedeConfigurar() && Sistema::app()->Acceso()->puedePermisoOtros(1)){
            $this->menu=[
                ["texto"=>"noticias",
                    "subenlace"=>[ //subenlace de noticias
                        
                        ["texto"=>"consultar",
                            "enlace"=>["administracionnoticias","index"]
                        ],
                        ["texto"=>"Insertar",
                            "enlace"=>["administracionnoticias","insertar"]
                        ]
                    ]
                ],
                ["texto"=>"eventos",
                    "subenlace"=>[ //subenlace de noticias
                        
                        ["texto"=>"consultar",
                            "enlace"=>["administracioneventos","index"]
                        ],
                        ["texto"=>"Insertar",
                            "enlace"=>["administracioneventos","insertar"]
                        ]
                    ]
                ],
                ["texto"=>"usuarios",
                    "subenlace"=>[ //subenlace de noticias
                        
                        ["texto"=>"consultar",
                            "enlace"=>["administracionusuarios","index"]
                        ],
                        ["texto"=>"Insertar",
                            "enlace"=>["administracionusuarios","insertar"]
                        ]
                    ]
                ],
                ["texto"=>"Mensajes",
                    "enlace"=>["administracionmensajes","index"]
                ]
                
            ];
            
        }
        else {
            Sistema::app()->paginaError(300, "No tienes permiso a esta página");
            exit();
        }
            
        
    } 
    
    public function accionIndex()
    {

        
        $noti = new Noticias();
        // opciones de filtrado
        $sentWhere = "";
        $sentOrder = "fecha desc";
        
        $datos = [
            "titulo" => "",
            "bor" => - 1
        ];
        
        $fil = [];
        
        if (isset($_REQUEST["titulo"])) {
            
            $titulo = $_REQUEST["titulo"];
            
            $datos["titulo"] = $titulo;
            $fil["titulo"] = $titulo;
            
            if ($sentWhere != "")
                $sentWhere .= " and ";
                $sentWhere .= "titulo LIKE '%$titulo%'";
                
        }
        
        
        if (isset($_REQUEST["bor"])) {
            $bor = trim($_REQUEST["bor"]);
            
            if ($bor == 'S' || $bor == 'N') {
                $datos["bor"] = $bor;
                $fil["bor"] = $bor;
                
                if ($sentWhere != "")
                    $sentWhere .= " and ";
                    if ($bor == 'S')
                        $sentWhere .= "borrado=1";
                        else
                            $sentWhere .= "borrado=0";
            }
        }

        // obtengo totales y opciones de filtrado
        $filas = $noti->buscarTodos([
            "select" => "count(*) as n_filas",
            "where" => $sentWhere
        ]);

        $sentencia = "select count(*) as n_filas" . " from noticias";
        if ($sentWhere != "")
            $sentencia .= "    where $sentWhere";

        $resultado = Sistema::app()->BD()->crearConsulta($sentencia);
        if ($resultado->error()) {
            Sistema::app()->paginaError(300, "Error en el acceso a datos");
            exit();
        }

        $filas = $resultado->filas();

        $total = $filas[0]["n_filas"];
        $pagina = 1;
        if (isset($_REQUEST["pag"]))
            $pagina = intval($_REQUEST["pag"]);

        $regPagina = 10;
        if (isset($_REQUEST["reg_pag"]))
            $regPagina = intval($_REQUEST["reg_pag"]);
        if ($regPagina <= 0)
            $regPagina = 10;

        $paginas = ceil($total * 1.0 / $regPagina);

        if ($pagina < 1)
            $pagina = 1;

        if ($pagina > $paginas)
            $pagina = 1;

        $sentLimit = "" . (($pagina - 1) * $regPagina) . ",$regPagina";

        $filas = $noti->buscarTodos([
            "where" => $sentWhere,
            "order" => $sentOrder,
            "limit" => $sentLimit
        ]);

        foreach ($filas as $clave => $valor) {
            $filas[$clave]["fecha"] = CGeneral::fechaTimeMysqlANormal($filas[$clave]["fecha"]);

            $filas[$clave]["borrado_texto"] = ($filas[$clave]["borrado"] == '1' ? 'Si' : 'No');
            
            
            $filas[$clave]["imagen"] = ($filas[$clave]["imagen"] != '' ?
                '<img class="avatar" src="/imagenes/img_noticias/'.$filas[$clave]["imagen"].'" alt="noticia">'
                : '');
            
            // botones
            $cadena = CHTML::link(CHTML::imagen("/imagenes/24x24/ver.png"), Sistema::app()->generaURL(array(
                "administracionnoticias",
                "consultar"
            ), array(
                "id" => $filas[$clave]["cod_noticia"]
            )));
            $cadena .= CHTML::link(CHTML::imagen('/imagenes/24x24/modificar.png'), Sistema::app()->generaURL(array(
                "administracionnoticias",
                "modificar"
            ), array(
                "id" => $filas[$clave]["cod_noticia"]
            )));
            $cadena .= CHTML::link(CHTML::imagen('/imagenes/24x24/borrar.png'), Sistema::app()->generaURL(array(
                "administracionnoticias",
                "borrar"
            ), array(
                "id" => $filas[$clave]["cod_noticia"]
            )), array(
                "onclick" => "return confirm('&iquest;Esta seguro de borrar el noticia?');"
            ));
            $filas[$clave]["opciones"] = $cadena;
        }
        // definiciones de las cabeceras de las
        // columnas para el CGrid
        $cabecera = array(
            array(
                "ETIQUETA" => "TITULO",
                "CAMPO" => "titulo"
            ),
            array(
                "ETIQUETA" => "MENSAJE",
                "CAMPO" => "mensaje",
                "ANCHO" => "500px",
                "TEXTO_MAX" => 55
            ),
            array(
                "ETIQUETA" => "FECHA",
                "CAMPO" => "fecha"
            ),
            array(
                "ETIQUETA" => "IMAGEN",
                "CAMPO" => "imagen"
            ),
            array(
                "ETIQUETA" => "AUTOR",
                "CAMPO" => "autor"
            ),
            array(
                "ETIQUETA" => "BORRADO",
                "CAMPO" => "borrado_texto"
            ),
            array("ETIQUETA"=>"ACCIONES",
                "CAMPO"=>"opciones"
                )
        );

        $urlPaginador = Sistema::app()->generaURL([
            "administracionnoticias",
            "index"
        ], $fil);

        $opcPaginador = array(
            "URL" => $urlPaginador,
            "TOTAL_REGISTROS" => $total,
            "PAGINA_ACTUAL" => $pagina,
            "REGISTROS_PAGINA" => $regPagina,
            "TAMANIOS_PAGINA" => array(
                5 => "5",
                10 => "10",
                20 => "20",
                30 => "30",
                40 => "40",
                50 => "50"
            ),
            "MOSTRAR_TAMANIOS" => true,
            "PAGINAS_MOSTRADAS" => 5
        );
        $this->dibujaVista("index", [
            "dat" => $datos,
            "filas" => $filas,
            "cabe" => $cabecera,
            "opcPag" => $opcPaginador
        ], "Lista de noticias");
    }
    
    public function accionConsultar()
    {
        $noti =new Noticias();
        
        $id=-1;
        if (isset($_REQUEST["id"]))
        {
            $id=intval($_REQUEST["id"]);
        }
        
        if (!$noti->buscarPorId($id))
        {
            Sistema::app()->paginaError(300,"La noticia no se ha encontrado");
            return;
        }
        
        $this->dibujaVista("consultar", [
            "noticia" => $noti
        ], "Consultar noticia");
    }
    
    public function accionModificar()
    {
        $noti =new Noticias();
        
        $id=-1;
        if (isset($_REQUEST["id"]))
        {
            $id=intval($_REQUEST["id"]);
        }
        
        if (!$noti->buscarPorId($id))
        {
            Sistema::app()->paginaError(300,"La noticia no se ha encontrado");
            return;
        }
        
        $nombre=$noti->getNombre();
        if (isset($_POST[$nombre]))
        {

            $hayimagen=false;
            
            if ($_FILES[$nombre]["name"]["imagen"] && $_FILES[$nombre]["name"]["imagen"]!="") {
                
                $hayimagen=true;
                
                //comprueba si anteriormente habia imagen
                $imagen_antigua="";
                if($noti->imagen!=""){
                    $imagen_antigua= "imagenes/img_noticias/".$noti->imagen;
                }
                
                $imagePath = "imagenes/img_noticias/";
                
                if(!file_exists($imagePath))
                    mkdir($imagePath);
                    
                    $uniquesavename=time().uniqid(rand());
                    $uniquesavename.=".".pathinfo($_FILES["$nombre"]["name"]["imagen"], PATHINFO_EXTENSION);
                    $destFile = $imagePath . $uniquesavename;
                    $filename = $_FILES["$nombre"]["tmp_name"]["imagen"];
                    
                    $noti->imagen= $uniquesavename;
                    
                    
            }
            
            $noti->setValores($_POST[$nombre]);
            
            if ($noti->validar())
            {
                if ($falloimg=$hayimagen) {
                    
                    if($falloimg=!move_uploaded_file($filename,  $destFile)){
                        $noti->setError("imagen", "lo sentimos, pero no se puede añadir la imagen");
                        
                    }
                    else if($imagen_antigua){
                        unlink($imagen_antigua);
                    }
                }
                
                if (!$falloimg) {
                    if ($noti->guardar())
                    {
                        Sistema::app()->irAPagina(["administracionnoticias","consultar"],
                            ["id"=>$noti->cod_noticia]);
                        return;
                    }
                }
            }
        }
        
        $this->dibujaVista("modificar", [
            "noticia" => $noti
        ], "Modificar noticia");
    }
    
    public function accionInsertar()
    {
        $noti =new Noticias();
        
        $nombre=$noti->getNombre();
        if (isset($_POST[$nombre]))
        {
            
            

            
            $hayimagen=false;
            
            if ($_FILES[$nombre]["name"]["imagen"] && $_FILES[$nombre]["name"]["imagen"]!="") {
                
                $hayimagen=true;
                
                
                $imagePath = "imagenes/img_noticias/";
                
                if(!file_exists($imagePath))
                    mkdir($imagePath);
                    
                    $uniquesavename=time().uniqid(rand());
                    $uniquesavename.=".".pathinfo($_FILES["$nombre"]["name"]["imagen"], PATHINFO_EXTENSION);
                    $destFile = $imagePath . $uniquesavename;
                    $filename = $_FILES["$nombre"]["tmp_name"]["imagen"];
                    
                    $noti->imagen= $uniquesavename;
                    
                    
            }
            
            $noti->setValores($_POST[$nombre]);
            
            
            $noti->cod_noticia=1;

            
            if ($noti->validar())
            {
                if ($falloimg=$hayimagen) {
                    
                    if($falloimg=!move_uploaded_file($filename,  $destFile)){
                        $noti->setError("imagen", "lo sentimos, pero no se puede añadir la imagen");
                        
                    }
                }
                
                if (!$falloimg) {
                if ($noti->guardar())
                {
                    Sistema::app()->irAPagina(["administracionnoticias","consultar"],
                        ["id"=>$noti->cod_noticia]);
                    return;
                }
                }
            }
        }
        
        $this->dibujaVista("insertar", [
            "noticia" => $noti
        ], "Nuevo noticia");
    }
    
    public function accionBorrar()
    {
        $noti =new Noticias();
        
        $id=-1;
        if (isset($_REQUEST["id"]))
        {
            $id=intval($_REQUEST["id"]);
        }
        
        if (!$noti->buscarPorId($id))
        {
            Sistema::app()->paginaError(300,"La noticia no se ha encontrado");
            return;
        }
        
        
        {
            $sentencia="update noticias set borrado=1 ".
                "    where cod_noticia=".$noti->cod_noticia;
            $resultado=Sistema::app()->BD()->crearConsulta($sentencia);
            if ($resultado)
            {
                Sistema::app()->irAPagina(["administracionnoticias","consultar"],
                    ["id"=>$noti->cod_noticia]);
                return;
            }
        }
        
        Sistema::app()->irAPagina(["administracionnoticias","index"],
            []);
    }
    
}

	
	