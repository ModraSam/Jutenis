<?php

class administracioneventosControlador extends CControlador
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
     
        
        
        $even = new Eventos();
        // opciones de filtrado
        $sentWhere = "";
        $sentOrder = "fecha desc";

        $datos = [
            "tipo" => - 1,
            "poblacion" => - 1,
            "bor" => - 1
        ];

        $fil = [];

        if (isset($_REQUEST["tipo"])) {
            $tipo = intval($_REQUEST["tipo"]);
            if ($tipo > 0 && Eventos::listaTiposEventos($tipo)) {
                $datos["tipo"] = $tipo;
                $fil["tipo"] = $tipo;

                if ($sentWhere != "")
                    $sentWhere .= " and ";
                $sentWhere .= "cod_tipo_evento=$tipo";
            }
        }
        
        if (isset($_REQUEST["poblacion"])) {
            $poblacion = intval($_REQUEST["poblacion"]);
            if ($poblacion > 0 && Eventos::listaPoblaciones($poblacion)) {
                $datos["poblacion"] = $poblacion;
                $fil["poblacion"] = $poblacion;
                
                if ($sentWhere != "")
                    $sentWhere .= " and ";
                    $sentWhere .= "cod_poblacion=$poblacion";
            }
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
        $filas = $even->buscarTodos([
            "select" => "count(*) as n_filas",
            "where" => $sentWhere
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

        $filas = $even->buscarTodos([
            "where" => $sentWhere,
            "order" => $sentOrder,
            "limit" => $sentLimit
        ]);

        foreach ($filas as $clave => $valor) {
            $filas[$clave]["fecha"] = CGeneral::fechaMysqlANormal($filas[$clave]["fecha"]);

            $filas[$clave]["borrado_texto"] = ($filas[$clave]["borrado"] == '1' ? 'Si' : 'No');
            // botones
            
            $cadena = CHTML::link(CHTML::imagen("/imagenes/24x24/ver.png"), Sistema::app()->generaURL(array(
                "administracioneventos",
                "consultar"
            ), array(
                "id" => $filas[$clave]["cod_evento"]
            )));
            
            $cadena .= CHTML::link(CHTML::imagen("/imagenes/24x24/participantes.png"), Sistema::app()->generaURL(array(
                "administracioneventos",
                "participantes"
            ), array(
                "id" => $filas[$clave]["cod_evento"]
            )));
            
            $cadena .= CHTML::link(CHTML::imagen('/imagenes/24x24/modificar.png'), Sistema::app()->generaURL(array(
                "administracioneventos",
                "modificar"
            ), array(
                "id" => $filas[$clave]["cod_evento"]
            )));
            $cadena .= CHTML::link(CHTML::imagen('/imagenes/24x24/borrar.png'), Sistema::app()->generaURL(array(
                "administracioneventos",
                "borrar"
            ), array(
                "id" => $filas[$clave]["cod_evento"]
            )), array(
                "onclick" => "return confirm('&iquest;Esta seguro de borrar el evento?');"
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
                "ETIQUETA" => "CONTENIDO",
                "CAMPO" => "contenido",
                "ANCHO" => "500px",
                "TEXTO_MAX" => 55
            ),
            array(
                "ETIQUETA" => "FECHA",
                "CAMPO" => "fecha"
            ),
            array(
                "ETIQUETA" => "POBLACION",
                "CAMPO" => "poblacion"
            ),
            array(
                "ETIQUETA" => "EDAD_REQ",
                "CAMPO" => "edad_requerida"
            ),
            array(
                "ETIQUETA" => "EDAD_MAX",
                "CAMPO" => "edad_maxima"
            ),
            array(
                "ETIQUETA" => "TIPO_EVENTO",
                "CAMPO" => "tipo_evento"
            ),
            array(
                "ETIQUETA" => "AFORO",
                "CAMPO" => "aforo"
            ),
            array(
                "ETIQUETA" => "N_INSCRITOS",
                "CAMPO" => "n_inscritos"
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
            "administracioneventos",
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
        ], "Lista de eventos");
    }
    
    public function accionConsultar()
    {
        $eve =new Eventos();
        
        $id=-1;
        if (isset($_REQUEST["id"]))
        {
            $id=intval($_REQUEST["id"]);
        }
        
        if (!$eve->buscarPorId($id))
        {
            Sistema::app()->paginaError(300,"El evento no se ha encontrado");
            return;
        }
        
        $this->dibujaVista("consultar", [
            "evento" => $eve
        ], "Consultar evento");
    }
    
    public function accionModificar()
    {
        $eve =new Eventos();
        
        $id=-1;
        if (isset($_REQUEST["id"]))
        {
            $id=intval($_REQUEST["id"]);
        }
        
        if (!$eve->buscarPorId($id))
        {
            Sistema::app()->paginaError(300,"El evento no se ha encontrado");
            return;
        }
        
        $nombre=$eve->getNombre();
        if (isset($_POST[$nombre]))
        {
            if ($_POST[$nombre]["fecha"]) {
                $fecha = date("d/m/Y",strtotime($_POST[$nombre]["fecha"]));
                $_POST[$nombre]["fecha"]= $fecha;
            }
            
            $eve->setValores($_POST[$nombre]);
            
            if ($eve->validar())
            {
                if ($eve->guardar())
                {
                    Sistema::app()->irAPagina(["administracioneventos","consultar"],
                        ["id"=>$eve->cod_evento]);
                    return;
                }
            }
        }
        
        $this->dibujaVista("modificar", [
            "evento" => $eve
        ], "Modificar evento");
    }
    
    public function accionInsertar()
    {
        $eve =new Eventos();
        
        /*$alteraciones = $_POST[$nombre];
        
        if ($_POST[$nombre]["fecha"]) {
        $fecha = date("d/m/Y",strtotime($_POST[$nombre]["fecha"]));
        $alteraciones["fecha"]= $fecha;
        }
        
        if ($_POST[$nombre]["imagen"] && $_POST[$nombre]["imagen"]!="") {
        
        $alteraciones["imagen"]=funcionesGenerales::devolverNombreAddFichero(
        $_POST[$nombre]["imagen"], $nombre, $_POST[$nombre]["titulo"], $_POST[$nombre][""]);
        }
        
        $eve->setValores($_POST[$nombre]);
        if (isset($_FILES['imagen'])) {
        
        }*/
        
        $nombre=$eve->getNombre();
        if (isset($_POST[$nombre]))
        {
            
            if ($_POST[$nombre]["fecha"]) {
                $fecha = date("d/m/Y",strtotime($_POST[$nombre]["fecha"]));
                $_POST[$nombre]["fecha"]= $fecha;
            }
            
            $eve->setValores($_POST[$nombre]);

            
            $eve->cod_evento=1;
            if ($eve->validar())
            {
                if ($eve->guardar())
                {
                    Sistema::app()->irAPagina(["administracioneventos","consultar"],
                        ["id"=>$eve->cod_evento]);
                    return;
                }
            }
        }
        
        $this->dibujaVista("insertar", [
            "evento" => $eve
        ], "Nuevo Evento");
    }
    
    public function accionBorrar()
    {
        $eve =new Eventos();
        
        $id=-1;
        if (isset($_REQUEST["id"]))
        {
            $id=intval($_REQUEST["id"]);
        }
        
        if (!$eve->buscarPorId($id))
        {
            Sistema::app()->paginaError(300,"El evento no se ha encontrado");
            return;
        }
        
        
        
            $sentencia="update eventos set borrado=1 ".
                "    where cod_evento=".$eve->cod_evento;
            $resultado=Sistema::app()->BD()->crearConsulta($sentencia);
            if ($resultado)
            {
                Sistema::app()->irAPagina(["administracioneventos","consultar"],
                    ["id"=>$eve->cod_evento]);
                return;
            }
        
        
        Sistema::app()->irAPagina(["administracionEventos","index"],
            []);
    }
    
    public function accionParticipantes()
    {
        $eve =new Eventos();
        
        $id=-1;
        if (isset($_REQUEST["id"]))
        {
            $id=intval($_REQUEST["id"]);
        }
        
        if (!$eve->buscarPorId($id))
        {
            Sistema::app()->paginaError(300,"El evento no se ha encontrado");
            return;
        }
        
        $eventoUsuario = new EventosUsuarios();
        
        if (isset($_POST["a_usu"])){
            
            
            if ($eventoUsuario->buscarPor(["where"=> "cod_usuario=".$_POST['a_usu']." and cod_evento=$eve->cod_evento"]))
            {
                $eventoUsuario->borrado=0;
                
                if ($eventoUsuario->validar())
                    
                    $eventoUsuario->guardar();

            
            }
            else{
                $eventoUsuario->setValores(["cod_usuario"=>$_POST["a_usu"],
                "cod_evento"=>$eve->cod_evento
                ]);
                
                $eventoUsuario->cod_evento_usuario=1;
                
                if ($eventoUsuario->validar())
                {
                $eventoUsuario->guardar();
                
                }
            }
            
            
        }
        
        
        
                            $usu = new Usuarios();
                            
                            $filas = $usu->buscarTodos([
                                "select"=>"t.*",
                                "where"=>"t.cod_usuario in(
                                    select eu.cod_usuario
                                    from vista_eventos ve
                                    JOIN eventos_usuarios eu ON ve.cod_evento=eu.cod_evento
                                    where eu.borrado=0 and eu.cod_evento=$eve->cod_evento)"
                            ]);
                            
                            foreach ($filas as $clave => $valor) {
                                $cadena = CHTML::link(CHTML::imagen('/imagenes/24x24/borrar.png'), Sistema::app()->generaURL(array(
                                    "administracioneventos",
                                    "borrarusuarioevento"
                                ), array(
                                    "id_usu" => $filas[$clave]["cod_usuario"],
                                    "id_evento" => $id
                                )), array(
                                    "onclick" => "return confirm('&iquest;Esta seguro de borrar el usuario del evento?');"
                                ));
                                $filas[$clave]["opciones"] = $cadena;
                            }
                            // definiciones de las cabeceras de las
                            // columnas para el CGrid
                            $cabecera = array(
                                array(
                                    "ETIQUETA" => "NICK",
                                    "CAMPO" => "nick"
                                ),
                                array(
                                    "ETIQUETA" => "NOMBRE",
                                    "CAMPO" => "nombre"
                                ),
                                array(
                                    "ETIQUETA" => "APELLIDOS",
                                    "CAMPO" => "apellidos"
                                ),
                                array(
                                    "ETIQUETA" => "DNI",
                                    "CAMPO" => "dni"
                                ),
                                array("ETIQUETA"=>"ACCIONES",
                                    "CAMPO"=>"opciones"
                                )
                            );

                            $this->dibujaVista("participantes", [
                                "filas" => $filas,
                                "cabe" => $cabecera,
                                "evento" => $eve,
                                "eventoUsuario"=>$eventoUsuario
                            ], "Lista de participantes");

    
    }
    
    public function accionBorrarusuarioevento()
    {
    
        $eve =new Eventos();
        
        $usu =new Usuarios();
        
        if (isset($_REQUEST["id_evento"]))
        {
            $id_eve=intval($_REQUEST["id_evento"]);
        }
        
        if (isset($_REQUEST["id_usu"]))
        {
            $id_usu=intval($_REQUEST["id_usu"]);
        }
        
        if (!$eve->buscarPorId($id_eve))
        {
            Sistema::app()->paginaError(300,"El evento no se ha encontrado");
            return;
        }
        
        if (!$usu->buscarPorId($id_usu))
        {
            Sistema::app()->paginaError(300,"El usuario no se ha encontrado");
            return;
        }
        
        $sentencia="update eventos_usuarios set borrado=1 ".
            "    where cod_evento=$eve->cod_evento and cod_usuario=$usu->cod_usuario";
        
        $resultado=Sistema::app()->BD()->crearConsulta($sentencia);
        
        if ($resultado)
        {
            Sistema::app()->irAPagina(["administracioneventos","participantes"],
                ["id"=>$eve->cod_evento]);
            return;
        }
        Sistema::app()->irAPagina(["administracioneventos","participantes"],
            ["id"=>$eve->cod_evento]);
        return;
        
        
    }
    
}

	
	