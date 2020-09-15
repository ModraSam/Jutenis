<?php

class administracionusuariosControlador extends CControlador
{

    public function __construct()
    {
        
        $this->plantilla="administracion";
        
        //administradores
        if(Sistema::app()->Acceso()->puedeConfigurar() && Sistema::app()->Acceso()->puedePermisoOtros(1)){
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
        $usu = new Vista_usuarios();
        // opciones de filtrado
        $sentWhere = "";
        $sentOrder = "";

        $datos = [
            "correo" => "",
            "role"=> -1,
            "activ" => - 1,
            "bor" => - 1
        ];

        $fil = [];

        if (isset($_REQUEST["correo"])) {
            
             $correo = $_REQUEST["correo"];
            
                $datos["correo"] = $correo;
                $fil["correo"] = $correo;

                if ($sentWhere != "")
                    $sentWhere .= " and ";
                $sentWhere .= "correo LIKE '%$correo%'";
            
        }
        
        if (isset($_REQUEST["role"])) {
            $role = intval($_REQUEST["role"]);
            if ($role > 0 && Vista_usuarios::listaRoles($role)) {
                $datos["role"] = $role;
                $fil["role"] = $role;
                
                if ($sentWhere != "")
                    $sentWhere .= " and ";
                    $sentWhere .= "cod_role=$role";
            }
        }
        
        if (isset($_REQUEST["activ"])) {
            $activ = trim($_REQUEST["activ"]);
            
            if ($activ == 'S' || $activ == 'N') {
                $datos["activ"] = $activ;
                $fil["activ"] = $activ;
                
                if ($sentWhere != "")
                    $sentWhere .= " and ";
                    if ($activ == 'S')
                        $sentWhere .= "activado=1";
                        else
                            $sentWhere .= "activado=0";
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

        $sentencia = "select count(*) as n_filas" . " from vista_usuarios";
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

        $filas = $usu->buscarTodos([
            "where" => $sentWhere,
            "order" => $sentOrder,
            "limit" => $sentLimit
        ]);

        foreach ($filas as $clave => $valor) {
            $filas[$clave]["fecha_nacimiento"] = CGeneral::fechaMysqlANormal($filas[$clave]["fecha_nacimiento"]);

            $filas[$clave]["sexo_texto"] = ($filas[$clave]["sexo"] == '1' ? 'Hombre' : 'Mujer');
            
            $filas[$clave]["imagen"] = ($filas[$clave]["imagen"] != '' ? 
                                    '<img class="avatar" src="/imagenes/sources/'.$filas[$clave]["imagen"].'" alt="imagen de usuario">'
                                    : '<img class="avatar" src="/imagenes/default/usuario.webp" alt="imagen de usuario">');
            
            $filas[$clave]["activado_texto"] = ($filas[$clave]["activado"] == '1' ? 'Si' : 'No');
            
            $filas[$clave]["borrado_texto"] = ($filas[$clave]["borrado"] == '1' ? 'Si' : 'No');
            // botones
            $cadena = CHTML::link(CHTML::imagen("/imagenes/24x24/ver.png"), Sistema::app()->generaURL(array(
                "administracionusuarios",
                "consultar"
            ), array(
                "nick" => $filas[$clave]["nick"]
            )));
            $cadena .= CHTML::link(CHTML::imagen('/imagenes/24x24/modificar.png'), Sistema::app()->generaURL(array(
                "administracionusuarios",
                "modificar"
            ), array(
                "nick" => $filas[$clave]["nick"]
            )));
            $cadena .= CHTML::link(CHTML::imagen('/imagenes/24x24/borrar.png'), Sistema::app()->generaURL(array(
                "administracionusuarios",
                "borrar"
            ), array(
                "nick" => $filas[$clave]["nick"]
            )), array(
                "onclick" => "return confirm('&iquest;Esta seguro de borrar el evento?');"
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
                "ETIQUETA" => "CORREO",
                "CAMPO" => "correo",
                "TEXTO_MAX" => 55
            ),
            array(
                "ETIQUETA" => "NOMBRE",
                "CAMPO" => "nombre_usu"
            ),
            array(
                "ETIQUETA" => "APELLIDOS",
                "CAMPO" => "apellidos"
            ),
            array(
                "ETIQUETA" => "DNI",
                "CAMPO" => "dni"
            ),
            array(
                "ETIQUETA" => "FECHA_NAC",
                "CAMPO" => "fecha_nacimiento"
            ),
            array(
                "ETIQUETA" => "SEXO",
                "CAMPO" => "sexo_texto"
            ),
            array(
                "ETIQUETA" => "TELÉFONO",
                "CAMPO" => "telefono"
            ),
            array(
                "ETIQUETA" => "IMAGEN",
                "CAMPO" => "imagen"
            ),
            array(
                "ETIQUETA" => "ROLE",
                "CAMPO" => "nombre_role"
            ),
            array(
                "ETIQUETA" => "ACTIVADO",
                "CAMPO" => "activado_texto"
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
            "administracionusuarios",
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
        ], "Lista de usuarios");
    }
    
    public function accionConsultar()
    {
        $usu =new Usuarios();
        $acl =new Acl_usuarios();
        
        $nick=-1;
        if (isset($_REQUEST["nick"]))
        {
            $nick=$_REQUEST["nick"];
        }
        
        if (!$usu->buscarPor(["where"=>"nick = '$nick'"]) & !$acl->buscarPor(["where"=>"nick = '$nick'"]))
        {
            Sistema::app()->paginaError(300,"El usuario no se ha encontrado");
            return;
        }
        
        $this->dibujaVista("consultar", [
            "usu" => $usu,
            "acl"=> $acl
        ], "Consultar usuario");
    }
    
    public function accionModificar()
    {
        $usu =new Usuarios();
        $acl =new Acl_usuarios();
        
        $nick=-1;
        if (isset($_REQUEST["nick"]))
        {
            $nick=$_REQUEST["nick"];
        }
        
        if (!$usu->buscarPor(["where"=>"nick = '$nick'"]) & !$acl->buscarPor(["where"=>"nick = '$nick'"]))
        {
            Sistema::app()->paginaError(300,"El usuario no se ha encontrado");
            return;
        }
        
        $nombre_usu=$usu->getNombre();
        $nombre_acl=$acl->getNombre();
        if (isset($_POST[$nombre_usu]) && isset($_POST[$nombre_acl]))
        {
            
            if ($_POST[$nombre_usu]["fecha_nacimiento"]) {
                $fecha = date("d/m/Y",strtotime($_POST[$nombre_usu]["fecha_nacimiento"]));
                $_POST[$nombre_usu]["fecha_nacimiento"]= $fecha;
            }
            
            if ($_POST[$nombre_acl]["nombre"]) {
                $_POST[$nombre_usu]["nombre"]= $_POST[$nombre_acl]["nombre"];
            }
            
            if ($_POST[$nombre_acl]["nick"]) {
                $_POST[$nombre_usu]["nick"]= $_POST[$nombre_acl]["nick"];
            }
            /*if ($_POST[$nombre_acl]["contrasena"]) {
                $_POST[$nombre_acl]["contrasena"]= "TT".$_POST[$nombre_acl]["contrasena"];
            }*/
            

            
            $hayimagen=false;
            
            if ($_FILES["usuario"]["name"]["imagen"] && $_FILES["usuario"]["name"]["imagen"]!="") {
                
                $hayimagen=true;
                
                
                //comprueba si anteriormente habia imagen
                $imagen_antigua="";
                if($usu->imagen!=""){
                    $imagen_antigua= "imagenes/sources/".$usu->imagen;
                }
                
                $imagePath = "imagenes/sources/";
                
                if(!file_exists($imagePath))
                    mkdir($imagePath);
                    
                    $uniquesavename=time().uniqid(rand());
                    $uniquesavename.=".".pathinfo($_FILES["usuario"]["name"]["imagen"], PATHINFO_EXTENSION);
                    $destFile = $imagePath . $uniquesavename;
                    $filename = $_FILES["usuario"]["tmp_name"]["imagen"];
                    
                    $usu->imagen= $uniquesavename;
                    
                    
            }
            
            $usu->setValores($_POST[$nombre_usu]);
            $acl->setValores($_POST[$nombre_acl]);
            $acl->contrasena="123456";
            
            if ($usu->validar() & $acl->validar())
            {
                
                if ($falloimg=$hayimagen) {
                    
                    if($falloimg=!move_uploaded_file($filename,  $destFile)){
                        $usu->setError("imagen", "lo sentimos, pero no se puede añadir la imagen");
                        
                    }
                    else if($imagen_antigua){
                        unlink($imagen_antigua);
                    }
                }
                
                if (!$falloimg) {
                    if ($acl->guardar() && $usu->guardar())
                    {
                        Sistema::app()->irAPagina(["administracionusuarios","consultar"],
                            ["nick"=>$usu->nick]);
                        return;
                    }
                }
                
            }
            $acl->contrasena="";
        }
        
        $this->dibujaVista("modificar", [
            "usu" => $usu,
            "acl" => $acl
        ], "Modificar Usuario");
    }
    
    public function accionInsertar()
    {
        $usu =new Usuarios();
        $acl =new Acl_usuarios();
        
        
        
        
            
            
        
        $nombre_usu=$usu->getNombre();
        $nombre_acl=$acl->getNombre();
        if (isset($_POST[$nombre_usu]) && isset($_POST[$nombre_acl]))
        {
            
            if ($_POST[$nombre_usu]["fecha_nacimiento"]) {
                $fecha = date("d/m/Y",strtotime($_POST[$nombre_usu]["fecha_nacimiento"]));
                $_POST[$nombre_usu]["fecha_nacimiento"]= $fecha;
            }
            
            if ($_POST[$nombre_acl]["nombre"]) {
                $_POST[$nombre_usu]["nombre"]= $_POST[$nombre_acl]["nombre"];
            }
            
            if ($_POST[$nombre_acl]["nick"]) {
                $_POST[$nombre_usu]["nick"]= $_POST[$nombre_acl]["nick"];
            }
            
            if ($_POST[$nombre_acl]["contrasena"]) {
                $_POST[$nombre_acl]["contrasena"]= "TT".$_POST[$nombre_acl]["contrasena"];
            }
            
            $hayimagen=false;
            
            if ($_FILES["usuario"]["name"]["imagen"] && $_FILES["usuario"]["name"]["imagen"]!="") {
                
                $hayimagen=true;
                
                   
                    $imagePath = "imagenes/sources/";
                    
                    if(!file_exists($imagePath))
                        mkdir($imagePath);
                    
                    $uniquesavename=time().uniqid(rand());
                    $uniquesavename.=".".pathinfo($_FILES["usuario"]["name"]["imagen"], PATHINFO_EXTENSION);
                    $destFile = $imagePath . $uniquesavename;
                    $filename = $_FILES["usuario"]["tmp_name"]["imagen"];
                    
                   $usu->imagen= $uniquesavename;
                    
                
            }
            
            $usu->setValores($_POST[$nombre_usu]);
            $acl->setValores($_POST[$nombre_acl]);

            
            
            $usu->cod_usuario=1;
            $acl->cod_usuario=1;
            if ($usu->validar() & $acl->validar())
            {
                
                if ($falloimg=$hayimagen) {
                    
                    if($falloimg=!move_uploaded_file($filename,  $destFile)){
                        $usu->setError("imagen", "lo sentimos, pero no se puede añadir la imagen");
                        
                    }
                }
                
                if (!$falloimg) {
                    if ($acl->guardar() && $usu->guardar())
                    {
                        Sistema::app()->irAPagina(["administracionusuarios","consultar"],
                            ["nick"=>$usu->nick]);
                        return;
                    }
                }
                        
                    
            }
        }
        
        $acl->contrasena="";
        
        $this->dibujaVista("insertar", [
            "usu" => $usu,
            "acl" => $acl
        ], "Nuevo usuario");
    }
    
    public function accionBorrar()
    {
        $acl =new Acl_usuarios();
        
        $nick=-1;
        if (isset($_REQUEST["nick"]))
        {
            $nick=$_REQUEST["nick"];
        }
        
        if (!$acl->buscarPor(["where"=>"nick = '$nick'"]))
        {
            Sistema::app()->paginaError(300,"El usuario no se ha encontrado");
            return;
        }
        
        
        {
            $sentencia="update acl_usuarios set borrado=1 ".
                "    where nick=".$acl->nick;
            $resultado=Sistema::app()->BD()->crearConsulta($sentencia);
            if ($resultado)
            {
                Sistema::app()->irAPagina(["administracionusuarios","consultar"],
                    ["nick"=>$acl->nick]);
                return;
            }
        }
        
        Sistema::app()->irAPagina(["administracionusuarios","index"],
            []);
    }
    
}

	
	