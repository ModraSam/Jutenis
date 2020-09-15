<?php
class CAcceso {
    private $_sesion;
    private $_validado;
    private $_nick;
    private $_nombre;
    private $_puedeAcceder;
    private $_puedeConfigurar;
    private $_otrosPermisos=[];
    
    
    public function __construct($sesion){
        $this->_sesion=$sesion;
        $this->_validado = false;
        
        
        if (!$this->_sesion->haySesion())
            $this->_sesion->crearSesion();
        
         
        if($this->_sesion->existe("usuario"))
         {  
            $datos=$this->_sesion->get("usuario");
            if (isset($datos["validado"]))
            {
                $this->_validado=$datos["validado"];
                if ($this->_validado)
                {
                    $this->_nick           =$datos["nick"];
                    $this->_nombre         =$datos["nombre"];
                    $this->_puedeAcceder   =$datos["puedeAcceder"];
                    $this->_puedeConfigurar=$datos["puedeConfigurar"];
                    $this->_otrosPermisos  =$datos["permisos"];
                }
            }
         }
    }
    
    
    public function registrarUsuario( $nick, $nombre, $puedeAcceder, $puedeConfigurar,$otrosPermisos)
    {
         

        $this->_validado       = true;
        $this->_nick           = $nick;
        $this->_nombre         = $nombre;
        $this->_puedeAcceder   = $puedeAcceder;
        $this->_puedeConfigurar= $puedeConfigurar;
        $this->_otrosPermisos  = $otrosPermisos;
       
      if ($this->_sesion->haySesion())
      {   
        $datos=[];
        $datos["validado"]       = true;
        $datos["nick"]           = $this->_nick;
        $datos["nombre"]         = $this->_nombre;
        $datos["puedeAcceder"]   = $this->_puedeAcceder;
        $datos["puedeConfigurar"]= $this->_puedeConfigurar;
        $datos["permisos"]       = $this->_otrosPermisos;
        $this->_sesion->set("usuario",$datos);
        return true;
      }
      return false;
    }
    
    
    public function quitarRegistroUsuario()
    {
        
        
        $this->_validado = false;
        if ($this->_sesion->haySesion()) 
        {
           
            $datos=[];
            $datos["validado"]=false;
            $this->_sesion->set("usuario",$datos);
            
        }
            
    }
    
    
    public function hayUsuario()
    {
        return ($this->_validado);
    }//hayUsuario()
    

    public function puedeAcceder()
    {
      if ($this->hayUsuario())
      {
         return $this->_puedeAcceder;
      }  
      return false;    
    }
    
    
    public function puedeConfigurar()
    {
      
     if ($this->hayUsuario())
       return $this->_puedeConfigurar;
     return false;
    }
    

    public function puedePermisoOtros($numero)
    {
        if ($this->hayUsuario())
            return (isset($this->_otrosPermisos[$numero]) &&
                        $this->_otrosPermisos[$numero]); 
        return false;
    }
    

    public function getNick()
    {
       if($this->hayUsuario())
       {
           return $this->_nick;
       }
       return false;
    }
    

    public function getNombre()
    {
       if($this->hayUsuario())
       {
         return $this->_nombre;    
       }
      return false; 
    }
    
}