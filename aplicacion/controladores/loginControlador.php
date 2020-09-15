<?php
	 
	class loginControlador extends CControlador
	{
	    public function __construct()
	    {
	        $this->accionDefecto="login";
	        
	        $this->plantilla="login";
	    }
		public function accionLogin()
		{
		    $log=new Login();
		    
		    $nombre=$log->getNombre();
		    if (isset($_POST[$nombre]))
		    {
		        $log->setValores($_POST[$nombre]); 
		        
		        if ($log->validar())
		        {
		            Sistema::app()->Acceso()->registrarUsuario(
		                          $log->nick, 
		                          $log->nombre, 
		                          $log->puedeAcceder, 
		                          $log->puedeConfigurar, 
		                          $log->otrosPermisos);
		            
		            Sistema::app()->irAPagina([],[]);
		            return;
		        }
		        else {
		            $log->contrasenia="";
		        }
		    }
		    
		    $this->dibujaVista("login",["log"=>$log],"Pagina de login");
			
		}
		
		public function accionLogout()
		{
		    if (Sistema::app()->Acceso())
		        Sistema::app()->Acceso()->quitarRegistroUsuario();
		    
		    Sistema::app()->irAPagina([],[]);
		}
		
		public function accionRegistro()
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
		        
		        $usu->setValores($_POST[$nombre_usu]);
		        $acl->setValores($_POST[$nombre_acl]);
		        
		        
		        $usu->cod_usuario=1;
		        $acl->cod_usuario=1;
		        $acl->cod_role=2;
		        
		        
		        if ($usu->validar() & $acl->validar())
		        {
		            if ($acl->guardar() && $usu->guardar())
		            {
		                Sistema::app()->irAPagina(["login","login"]);
		                return;
		            }
		        }
		    }
		    
		    $acl->contrasena="";
		    
		    $this->dibujaVista("registro", [
		        "usu" => $usu,
		        "acl" => $acl
		    ], "Nuevo Usuario");
		}
		    
	}
