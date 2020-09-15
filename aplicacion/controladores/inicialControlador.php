<?php
	 
	class inicialControlador extends CControlador
	{
	    public function __construct()
	    {
	        if (Sistema::app()->Acceso()->puedeConfigurar() && Sistema::app()->Acceso()->hayUsuario()) {
	            $this->menu=[
	                ["texto"=>"Administracion",
	                    "enlace"=>["administracionnoticias","index"]
	                ],
	                ["texto"=>"Noticias",
	                    "enlace"=>["inicial","index"]
	                ],
	                ["texto"=>"Eventos",
	                    "enlace"=>["inicial","eventos"]
	                ],
	                ["texto"=>"Mis eventos",
	                    "enlace"=>["inicial", "mis_eventos"]
	                ],
	                ["texto"=>"Contacto",
	                    "enlace"=>["inicial","contacto"]
	                ]
	            ];
	        }
	        
	        if (Sistema::app()->Acceso()->hayUsuario() && !Sistema::app()->Acceso()->puedeConfigurar()) {
	            $this->menu=[
	                ["texto"=>"Noticias",
	                    "enlace"=>["inicial","index"]
	                ],
	                ["texto"=>"Eventos",
	                    "enlace"=>["inicial","eventos"]
	                ],
	                ["texto"=>"Mis eventos",
	                    "enlace"=>["inicial", "mis_eventos"]
	                ],
	                ["texto"=>"Contacto",
	                    "enlace"=>["inicial","contacto"]
	                ]
	            ];
	        }
	        
	        if(!Sistema::app()->Acceso()->hayUsuario()){
	            $this->menu=[
	                ["texto"=>"Noticias",
	                    "enlace"=>["inicial","index"]
	                ],
	                ["texto"=>"Eventos",
	                    "enlace"=>["inicial","eventos"]
	                ],
	                ["texto"=>"Contacto",
	                    "enlace"=>["inicial","contacto"]
	                ]
	            ];
	        }
        
	        

	    }
	    
	    public function accionIndex() {
	        
	        $this->plantilla="mainNoPortada";
	        
	        $this->titulo=[
	            "head"=>"Noticias",
	            "mensaje"=>"Noticias relevantes de Jutenis para tí."
	        ];
	        
	        $this->textoHead=CHTML::scriptFichero("/javascript/script.js");
	        
	        
	        $noticias = new Noticias();
	        
	        $sentOrder = "fecha desc";
	        
	        
	        // obtengo totales y opciones de filtrado
	        $filas = $noticias->buscarTodos([
	            "select" => "count(*) as n_filas",
	            "where" => "borrado = 0"
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
	        
	                            $filas = $noticias->buscarTodos([
	                                "order" => $sentOrder,
	                               "limit" => $sentLimit,
	                                "where" => "borrado=0"
	                            ]);
	                            
	                            
	                            
	                            
	                            $urlPaginador = Sistema::app()->generaURL([
	                                "inicial",
	                                "index"
	                            ]);
	                            
	                            $opcPaginador = array(
	                                "URL" => $urlPaginador,
	                                "TOTAL_REGISTROS" => $total,
	                                "PAGINA_ACTUAL" => $pagina,
	                                "REGISTROS_PAGINA" => $regPagina,
	                                "TAMANIOS_PAGINA" => array(
	                                    10 => "10",
	                                    20 => "20",
	                                    30 => "30",
	                                    40 => "40",
	                                    50 => "50"
	                                ),
	                                "MOSTRAR_TAMANIOS" => true,
	                                "PAGINAS_MOSTRADAS" => 10
	                            );
	       

	        
	        $this->dibujaVista("index", [
	            "filas" => $filas,
	            "opcPag" => $opcPaginador,
	        ], "Jutenis");
	    }
	    
	    public function accionNoticia() {
	        
	        $this->plantilla="mainNoPortada";
	        
	        if (isset($_REQUEST["noticia"]))
	        {
	            $noticia = new Noticias();
	            
	            $id=intval($_REQUEST["noticia"]);
	            if (!$noticia->buscarPorId($id))
	            {
	                Sistema::app()->paginaError(300,"La noticia no se he encontrado");
	                return;
	            }
	            
	            $this->dibujaVista("noticia", [
	                "noticia" => $noticia,
	            ], "$noticia->titulo");
	            
	            
	        }
	        
	        else{
	            Sistema::app()->paginaError(404,"Página no encontrada");
	            return;
	        }
	    }
	    
	    public function accionEventos()
	    {
	        $this->titulo=[
	            "head"=>"Eventos",
	            "mensaje"=>"Nuestro eventos deportivos por y para vosotros."
	        ];
	        
	        $this->textoHead=CHTML::scriptFichero("/javascript/script.js");
	        
	        $even = new Eventos();
	        // opciones de filtrado
	        $sentWhere = "fecha>subdate(current_date, 1) and borrado=0";
	        $sentOrder = "fecha asc";
	        
	        $datos = [
	            "tipo" => - 1,
	            "poblacion" => - 1
	        ];
	        
	        $fil = [];
	        
	        
	        $eventoUsuario =new EventosUsuarios();
	        
	        $id=-1;
	        if (isset($_REQUEST["eve_usu"]))
	        {
	            $id=intval($_REQUEST["eve_usu"]);
	            if (!$eventoUsuario->buscarPorId($id))
	            {
	                Sistema::app()->paginaError(300,"El evento del usuario no se ha encontrado");
	                return;
	            }
	            $usuario = new Usuarios();
	            
	            $id_usu=intval($eventoUsuario->cod_usuario);
	            
	            if (!$usuario->buscarPorId($id_usu)){
	                Sistema::app()->paginaError(300,"El usuario no se ha encontrado");
	                return;
	            }
	            
	            
	            
	            if ($usuario->nick==$_SESSION["usuario"]["nick"]) {
	                $sentencia="update eventos_usuarios set borrado=1 ".
	   	                "    where cod_evento_usuario=".$eventoUsuario->cod_evento_usuario;
	                $resultado=Sistema::app()->BD()->crearConsulta($sentencia);
	            }



	            
	        }
	        $participa=false;
	        if(isset($_REQUEST["id"])){
	            
	            $usuario = new Vista_usuarios();
	            
	            $usuario = $usuario::getUsuario();
	            
	            if($usuario){
	                
	                $eventoUsuario->setValores(["cod_usuario"=>$usuario[0]["cod_usuario_usu"],
	                    "cod_evento"=>$_REQUEST["id"]
	                ]);
	                
	                $eventoUsuario->cod_evento_usuario=1;
	                
	                if ($eventoUsuario->validar())
	                {
	                    $eventoUsuario->guardar();
	                    $participa=true;
	                }
	            }
	            else{
	                Sistema::app()->irAPagina(["login","login"]);
	                return;
	            }
	            
	        }
	        
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
	                                
	                                
	                                
	                                
	                                $urlPaginador = Sistema::app()->generaURL([
	                                    "inicial",
	                                    "eventos"
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
	                                
	                                $this->dibujaVista("eventos", [
	                                    "dat" => $datos,
	                                    "filas" => $filas,
	                                    "opcPag" => $opcPaginador,
	                                    "eventoUsuario"=>$eventoUsuario,
	                                    "participa"=>$participa
	                                ], "Jutenis");
	    }
	    
	    
	    
	    public function accionMis_eventos() {
	        
	        $this->titulo=[
	            "head"=>"Mis eventos",
	            "mensaje"=>"Tus eventos deportivos en los que participas."
	        ];
	        
	        if(!Sistema::app()->Acceso()->hayUsuario()){
	            Sistema::app()->irAPagina(["Login","login"]);
	            exit();
	        }
	        $this->textoHead=CHTML::scriptFichero("/javascript/script.js");
	        
	        
	        $usuario = new Vista_usuarios();
	        
	        $usuario = $usuario::getUsuario();
	        
	        $usuario = $usuario[0]["cod_usuario_usu"];
	        

	        
	        $eventoUsuario =new EventosUsuarios();

	        $id=-1;
	        if (isset($_REQUEST["eve_usu"]))
	        {
	            $id=intval($_REQUEST["eve_usu"]);
	            if (!$eventoUsuario->buscarPorId($id))
	            {
	                Sistema::app()->paginaError(300,"El evento del usuario no se ha encontrado");
	                return;
	            }
	            
	            $sentencia="update eventos_usuarios set borrado=1 ".
	   	            "    where cod_evento_usuario=".$eventoUsuario->cod_evento_usuario;
	            $resultado=Sistema::app()->BD()->crearConsulta($sentencia);
	            
	        }
	        
	        $sentencia = "select t.* ".
	        "from vista_eventos t JOIN eventos_usuarios eu ON t.cod_evento=eu.cod_evento where ".
	        "eu.borrado=0 and t.fecha>subdate(current_date, 1) and t.borrado=0 and eu.cod_usuario=".$usuario;
	            
	            $resultado = Sistema::app()->BD()->crearConsulta($sentencia);
	            if ($resultado->error()) {
	                Sistema::app()->paginaError(300, "Error en el acceso a datos");
	                exit();
	            }
	            
	            $filas = $resultado->filas();
 
                $this->dibujaVista("mis_eventos", [
                    "filas" => $filas,
                    "eventoUsuario"=>$eventoUsuario,
                    "usuario"=>$usuario
                ], "Jutenis");
	    }
	    
	    
	    public function accionContacto()
	    {
	        $this->plantilla="mainNoPortada";
	        
	        $this->textoHead=CHTML::scriptFichero("/javascript/script.js").CHTML::scriptFichero("/javascript/formulario.js");
	        
	        $enviado=false;
	        
	        $men =new Mensajes();
	        
	        $nombre=$men->getNombre();
	        if (isset($_POST[$nombre]))
	        {
	            
	            $men->setValores($_POST[$nombre]);
	            
	            
	            $men->cod_mensaje=1;
	            if ($men->validar())
	            {
	                if ($men->guardar())
	                {
	                    require 'PHPMailer/PHPMailerAutoload.php';
	                    $mail = new PHPMailer();
	                    
	                    try {
	                        
	                        $nombre=$men->nombre;
	                        $correo=$men->correo;
	                        $mensaje=$men->mensaje;
	                        

	                        $mail->setFrom('jutenissl@gmail.com', 'Jutenis');
	                        $mail->addAddress($correo,  $nombre);
	                        $mail->Subject = 'Contacto - Jutenis';
	                        $mail->Body = "Nombre: $nombre\nCorreo: $correo\nMensaje: $mensaje";
	                        

	                        $mail->isSMTP();
	                        $mail->Host = 'smtp.gmail.com';
	                        $mail->SMTPAuth = TRUE;
	                        $mail->SMTPSecure = 'tls';
	                        $mail->Username = 'jutenissl@gmail.com';
	                        $mail->Password = 'JuanTenis1?';
	                        $mail->Port = 587;
	                        
	                        $mail->addCC('jutenissl@gmail.com');
	                        

	                        $mail->SMTPOptions = array(
	                            'ssl' => array(
	                                'verify_peer' => false,
	                                'verify_peer_name' => false,
	                                'allow_self_signed' => true
	                            )
	                        );
	                        
	                        $mail->send();
	                        
	                        $enviado=true;

	                    }
	                    catch (Exception $e)
	                    {
	                        echo $e->errorMessage();
	                    }
	                    catch (\Exception $e)
	                    {
	                        echo $e->getMessage();
	                    }

	                    $men =new Mensajes();
	                    
	                    $this->dibujaVista("contactar",[
	                        "men"=>$men,
	                        "enviado"=>$enviado
	                    ],"Contacta con nosotros");
	                    exit();
	                }
	            }
	        }

	        $this->dibujaVista("contactar",[
	            "men"=>$men,
	            "enviado"=>$enviado
	        ],"Contacta con nosotros");
	    
	    
	   }
	   
	   
	   public function accionPerfil() {
	       
	       
	       $this->plantilla="mainNoPortada";
	       
	       if(!Sistema::app()->Acceso()->hayUsuario()){
	           Sistema::app()->irAPagina(["Login","login"]);
	           exit();
	       }

	       
	       $usuario = new Usuarios();
	       
	       $nick =$_SESSION["usuario"]["nick"];
	       
	       if (!$usuario->buscarPor(["where"=>"nick = '$nick'"]))
	       {
	           Sistema::app()->paginaError(300,"El usuario no se ha encontrado");
	           return;
	       }
	       
	       $nombre=$usuario->getNombre();
	       
	       if (isset($_POST[$nombre])) {
	           if ($_FILES["usuario"]["name"]["imagen"] && $_FILES["usuario"]["name"]["imagen"]!="") {
	               
	               
	               
	               //comprueba si anteriormente habia imagen
	               $imagen_antigua="";
	               if($usuario->imagen!=""){
	                   $imagen_antigua= "imagenes/sources/".$usuario->imagen;
	               }
	               
	               $imagePath = "imagenes/sources/";
	               
	               if(!file_exists($imagePath))
	                   mkdir($imagePath);
	                   
	                   $uniquesavename=time().uniqid(rand());
	                   $uniquesavename.=".".pathinfo($_FILES["usuario"]["name"]["imagen"], PATHINFO_EXTENSION);
	                   $destFile = $imagePath . $uniquesavename;
	                   $filename = $_FILES["usuario"]["tmp_name"]["imagen"];
	                   
	                   $usuario->imagen= $uniquesavename;
	                   
	                   
	                   
	                   
	                   
	                   if ($usuario->validar())
	                   {
	                       
	                       
	                       if($falloimg=!move_uploaded_file($filename,  $destFile)){
	                           $usuario->setError("imagen", "lo sentimos, pero no se puede añadir la imagen");
	                           
	                       }
	                       else if($imagen_antigua){
	                           unlink($imagen_antigua);
	                       }
	                       
	                       
	                       if (!$falloimg) {
	                           $usuario->guardar();
	                       }
	                       
	                   }
	           }
	       }
	       
	       
	       
	       $this->dibujaVista("perfil", [
	           "usuario"=>$usuario
	       ], $usuario->nick);
	   }
	
	}
