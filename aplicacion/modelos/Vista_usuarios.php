<?php 

class Vista_usuarios extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'usuario';
    }
    
    protected function fijarTabla()
    {
        return "vista_usuarios";
    }
    
    protected function fijarId(){
        return "cod_usuario";
    }

    
    protected function fijarAtributos()
    {
        return array(
            "cod_usuario_usu",
            "nick",
            "correo",
            "nombre_usu",
            "apellidos",
            "dni",
            "fecha_nacimiento",
            "sexo",
            "telefono",
            "imagen",
            "activado",
            "nombre_role",
            "borrado"

        );
    }
    

    protected function fijarDescripciones()
    {
        return array(
            "cod_usuario_usu"=>"Código",
            "nick"=>"Nick",
            "nombre_usu"=>"Nombre",
            "correo"=>"Correo",
            "contrasena"=>"Contraseña",
            "apellidos"=>"Apellidos",
            "dni"=>"DNI",
            "fecha_nacimiento"=>"Fecha de nacimiento",
            "sexo"=>"Sexo",
            "telefono"=>"Teléfono",
            "imagen"=>"Imagen",
            "activado"=>"Activado",
            "nombre_role"=>"role",
            "borrado"=>"Borrado",
        );
    }

    

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_usuario_usu",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_usuario_usu",
                "TIPO" => "ENTERO",
                "MIN"  =>0
            ),
            array(
                "ATRI" => "nick",
                "TIPO" => "CADENA",
                "TAMANIO" => 30
            ),
            array(
                "ATRI" => "correo",
                "TIPO" => "CADENA",
                "TAMANIO" => 320
            ),
            array(
                "ATRI" => "nombre_usu",
                "TIPO" => "CADENA",
                "TAMANIO" => 20
            ),
            array(
                "ATRI" => "apellidos",
                "TIPO" => "CADENA",
                "TAMANIO" => 40
            ),
            array(
                "ATRI" => "DNI",
                "TIPO" => "CADENA",
                "TAMANIO"=> 9
            ),
            array(
                "ATRI" => "fecha_nacimiento",
                "TIPO" => "FECHA"
            ),
            array(
                "ATRI" => "sexo",
                "TIPO" => "ENTERO",
                "MIN" => 0,
                "MAX" => 1
            ),
            array(
                "ATRI" => "telefono",
                "TIPO" => "CADENA",
                "TAMANIO"=> 9
            ),
            array(
                "ATRI" => "imagen",
                "TIPO" => "CADENA",
                "TAMANIO" => 1000
            )
        );
    }

    protected function afterCreate()
    {
        $this->cod_usuario_usu=1;
        $this->nick="";
        $this->correo="";
        $this->nombre_usu="";
        $this->apellidos="";
        $this->dni="";
        $this->fecha_nacimento=(new DateTime())->format("d/m/Y");
        $this->sexo=false;
        $this->telefono="";
        $this->imagen="";
        $this->activado=false;
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

    
    protected function afterBuscar() {
        $fecha= $this->fecha_nacimiento;
        $fecha= CGeneral::fechaMysqlANormal($fecha);
        $this -> fecha = $fecha;
    }
    
    protected function fijarSentenciaInsert()
    {
        
        $titulo=CGeneral::addSlashes($this->titulo);
        $contenido=CGeneral::addSlashes($this->contenido);
        $fecha=CGeneral::fechaNormalAMysql($this->fecha);
        $cod_poblacion=$this->cod_poblacion;
        $edad_requerida=$this->edad_requerida;
        $edad_maxima=$this->edad_maxima;
        $cod_tipo_evento=$this->cod_tipo_evento;
        $aforo=$this->aforo;
        $borrado=$this->borrado;
        
        return "insert into eventos (".
            " titulo, contenido, fecha, cod_poblacion, edad_requerida, edad_maxima, cod_tipo_evento,".
            "aforo, borrado".
            " ) values ( ".
            " '$titulo','$contenido', '$fecha', $cod_poblacion, $edad_requerida, $edad_maxima, $cod_tipo_evento, ".
            "$aforo," .($borrado?"1":"0").
            "     )";
    }
    
    
    
    protected function fijarSentenciaUpdate()
    {
        $titulo=CGeneral::addSlashes($this->titulo);
        $contenido=CGeneral::addSlashes($this->contenido);
        $fecha=CGeneral::fechaNormalAMysql($this->fecha);
        $cod_poblacion=$this->cod_poblacion;
        $edad_requerida=$this->edad_requerida;
        $edad_maxima=$this->edad_maxima;
        $cod_tipo_evento=$this->cod_tipo_evento;
        $aforo=$this->aforo;
        $borrado=$this->borrado;
        
        return "update eventos set ".
            " titulo='$titulo', ".
            " contenido='$contenido', ".
            " fecha='$fecha', ".
            " cod_poblacion=$cod_poblacion, ".
            " edad_requerida=$edad_requerida, ".
            " edad_maxima=$edad_maxima, ".
            " cod_tipo_evento=$cod_tipo_evento, ".
            " aforo=$aforo, ".
            " borrado= ".($borrado?"1":"0").
            "     where cod_evento={$this->cod_evento}";
    }
    
    
    
    public static function getUsuario()
    {
        if (!$_SESSION["usuario"]["validado"])
        {
            return false;
        }
        
        $usuario = new Vista_usuarios();
        
        $nick =$_SESSION["usuario"]["nick"];
        
        return $usuario->buscarTodos(["where"=>"nick = '".$nick."'"]);
        
    }

}