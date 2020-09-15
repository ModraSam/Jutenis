<?php

class administracionmensajesControlador extends CControlador
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
     
        
        
        $men = new Mensajes();
        // opciones de filtrado
        $sentWhere = "";
        $sentOrder = "fecha desc";
        
        $datos = [
            "bor" => - 1
        ];
        
        $fil = [];
        
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
        $filas = $men->buscarTodos([
            "select" => "count(*) as n_filas",
            "where" => $sentWhere,
            "order" => $sentOrder
        ]);

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

        $filas = $men->buscarTodos([
            "where" => $sentWhere,
            "order" => $sentOrder,
            "limit" => $sentLimit
        ]);

        foreach ($filas as $clave => $valor) {
            $filas[$clave]["fecha"] = CGeneral::fechaTimeMysqlANormal($filas[$clave]["fecha"]);

            $filas[$clave]["borrado_texto"] = ($filas[$clave]["borrado"] == '1' ? 'Si' : 'No');
            // botones
           
            $cadena = CHTML::link(CHTML::imagen('/imagenes/24x24/borrar.png'), Sistema::app()->generaURL(array(
                "administracionmensajes",
                "borrar"
            ), array(
                "id" => $filas[$clave]["cod_mensaje"]
            )), array(
                "onclick" => "return confirm('&iquest;Esta seguro de borrar el mensaje?');"
            ));
            $filas[$clave]["opciones"] = $cadena;
        }
        // definiciones de las cabeceras de las
        // columnas para el CGrid
        $cabecera = array(
            array(
                "ETIQUETA" => "NOMBRE",
                "CAMPO" => "nombre"
            ),
            array(
                "ETIQUETA" => "CORREO",
                "CAMPO" => "correo"
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
                "ETIQUETA" => "BORRADO",
                "CAMPO" => "borrado_texto"
            ),
            array("ETIQUETA"=>"ACCIONES",
                "CAMPO"=>"opciones"
                )
        );

        $urlPaginador = Sistema::app()->generaURL([
            "administracionmensajes",
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
        ], "Lista de mensajes");
    }
    
    public function accionBorrar()
    {
        $men =new Mensajes();
        
        $id=-1;
        if (isset($_REQUEST["id"]))
        {
            $id=intval($_REQUEST["id"]);
        }
        
        if (!$men->buscarPorId($id))
        {
            Sistema::app()->paginaError(300,"El mensjae no se ha encontrado");
            return;
        }
        
        
        {
            $sentencia="update mensajes set borrado=1 ".
                "    where cod_mensaje=".$men->cod_mensaje;
            Sistema::app()->BD()->crearConsulta($sentencia);
            
        }
        
        Sistema::app()->irAPagina(["administracionmensajes","index"],
            []);
    }
    
}

	
	