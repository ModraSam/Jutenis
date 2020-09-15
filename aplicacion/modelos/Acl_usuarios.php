<?php 

class Acl_usuarios extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'acl_usuario';
    }
    
    protected function fijarTabla()
    {
        return "acl_usuarios";
    }
    
    protected function fijarId(){
        return "cod_usuario";
    }

    
    protected function fijarAtributos()
    {
        return array(
            "cod_usuario",
            "nombre",
            "nick",
            "contrasena",
            "cod_role",
            "borrado"
        );
    }
    

    protected function fijarDescripciones()
    {
        return array(
            "cod_usuario"=>"Código",
            "nombre"=>"Nombre",
            "nick"=>"Nick",
            "contrasena"=>"Contraseña",
            "cod_role"=>"Role",
            "borrado"=>"Borrado"
        );
    }

    

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_usuario",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_usuario",
                "TIPO" => "ENTERO",
                "MIN"  =>0
            ),
            array(
                "ATRI" => "nombre",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "nombre",
                "TIPO" => "CADENA",
                "TAMANIO" => 30
            ),
            array(
                "ATRI" => "nick",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "nick",
                "TIPO" => "CADENA",
                "TAMANIO" => 30
            ),
            array(
                "ATRI" => "nick",
                "TIPO" => "FUNCION",
                "FUNCION"=> "validaNick"
            ),
            array(
                "ATRI" => "contrasena",
                "TIPO" => "CADENA",
                "TAMANIO" => 32
            ),
            array(
                "ATRI" => "contrasena",
                "TIPO" => "FUNCION",
                "FUNCION"=> "validaContrasena"
            ),
            array(
                "ATRI" => "cod_role",
                "TIPO" => "ENTERO",
                "MIN"  =>0
            ),
            array(
                "ATRI" => "cod_role",
                "TIPO" => "FUNCION",
                "FUNCION"=> "validaRole"
            ),
            array(
                "ATRI" => "borrado",
                "TIPO" => "ENTERO",
                "MIN" => 0,
                "MAX" => 1
            )
        );
    }
    
    protected function afterCreate()
    {
        $this->cod_usuario=0;
        $this->nombre="";
        $this->nick="";
        $this->contrasena="";
        $this->cod_role=0;
        $this->borrado=false;
        
    }
    
    public static function listaRoles($rol=null)
    {
        $roles=new Acl_roles();
        
        $aux=$roles->buscarTodos(["order"=>"nombre"]);
        $roles=[];
        
        foreach($aux as $t)
        {
            $roles[$t["cod_role"]]=$t["nombre"];
        }
        if ($rol==null)
            return $roles;
            
            if (isset($roles[$rol]))
                return $roles[$rol];
                else
                    return false;
    }
    
    protected function validaNick()
    {
        $acl_usuarios=new Acl_usuarios();
        
        if ($acl_usuarios->buscarTodos(["where"=> "nick='$this->nick'"]))
        {
            if($this->_esNuevo){
                $this->setError("nick", "Lo sentimos, ese nick ya está en uso.");
                return;
            }
            else{
                $acl_usuarios->buscarPorId($this->cod_usuario);
                if ( $this->nick != $acl_usuarios->nick) {
                    $this->setError("nick", "Lo sentimos, ese nick ya está en uso.");
                    return;
                }
            }
        }
        
    }
    
    protected function validaContrasena()
    {
        if(strlen($this->contrasena)<6)
        {
            $this->setError("contrasena", "La contraseña es muy corta.");
            return;
        }
        
    }
    
    protected function validaRole()
    {
        $role=new Acl_roles();
        
        if (!$role->buscarPorId($this->cod_role))
        {
            $this->setError("cod_role", "No se encuentra el role indicado");
            return;
        }
    
    }

    protected function fijarSentenciaInsert()
    {
        
        $nombre=CGeneral::addSlashes($this->nombre);
        $nick=CGeneral::addSlashes($this->nick);
        $contrasena=CGeneral::addSlashes($this->contrasena);
        $cod_role=$this->cod_role;
        $borrado=$this->borrado;
        
        return "insert into acl_usuarios (".
            " nombre, nick, contrasena, cod_role, borrado ) values ( ".
            " '$nombre','$nick', MD5('$contrasena'), $cod_role, " .($borrado?"1":"0").
            "     )";
    }
    
    
    
    protected function fijarSentenciaUpdate()
    {
        $nombre=CGeneral::addSlashes($this->nombre);
        $nick=CGeneral::addSlashes($this->nick);
        $contrasena=CGeneral::addSlashes($this->contrasena);
        $cod_role=$this->cod_role;
        $borrado=$this->borrado;
        
        return "update acl_usuarios set ".
            " nombre='$nombre', ".
            " nick='$nick', ".
            /*" contrasena=MD5('$contrasena'), ".*/
            " cod_role='$cod_role', ".
            " borrado= ".($borrado?"1":"0").
            "     where cod_usuario={$this->cod_usuario}";
    }
    
               

}