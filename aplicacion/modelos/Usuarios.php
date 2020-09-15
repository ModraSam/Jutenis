<?php 

class Usuarios extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'usuario';
    }
    
    protected function fijarTabla()
    {
        return "usuarios";
    }
    
    protected function fijarId(){
        return "cod_usuario";
    }

    
    protected function fijarAtributos()
    {
        return array(
            "cod_usuario",
            "nick",
            "correo",
            "nombre",
            "apellidos",
            "dni",
            "fecha_nacimiento",
            "sexo",
            "telefono",
            "imagen",
            "activado"
        );
    }
    

    protected function fijarDescripciones()
    {
        return array(
            "cod_usuario"=>"Código",
            "nick"=>"Apodo",
            "correo"=>"Correo",
            "nombre"=>"Nombre",
            "apellidos"=>"Apellidos",
            "dni"=>"DNI",
            "fecha_nacimiento"=>"Fecha de nacimiento",
            "sexo"=>"Sexo",
            "telefono"=>"Teléfono",
            "imagen"=>"Imagen",
            "activado"=>"Activado"
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
                "ATRI" => "correo",
                "TIPO" => "email",
                "TAMANIO" => 320
            ),
            array(
                "ATRI" => "correo",
                "TIPO" => "FUNCION",
                "FUNCION"=> "validaCorreo"
            ),
            array(
                "ATRI" => "nombre",
                "TIPO" => "CADENA",
                "TAMANIO" => 30
            ),
            array(
                "ATRI" => "apellidos",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "apellidos",
                "TIPO" => "CADENA",
                "TAMANIO" => 40
            ),
            array(
                "ATRI" => "dni",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "dni",
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
                "ATRI" => "telefono",
                "TIPO" => "FUNCION",
                "FUNCION"=> "validaTelefono"
            ),
            array(
                "ATRI" => "imagen",
                "TIPO" => "CADENA",
                "TAMANIO" => 1000
            ),
            array(
                "ATRI" => "imagen",
                "TIPO" => "FUNCION",
                "FUNCION"=> "validaImagen"
            ),
            array(
                "ATRI" => "activado",
                "TIPO" => "ENTERO",
                "MIN" => 0,
                "MAX" => 1
            )
        );
    }

    protected function afterCreate()
    {
        $this->cod_usuario=1;
        $this->nick="";
        $this->correo="";
        $this->nombre="";
        $this->apellidos="";
        $this->dni="";
        $this->fecha_nacimento=(new DateTime())->format("d/m/Y");
        $this->sexo=false;
        $this->telefono="";
        $this->imagen="";
        $this->activado=false;
        
    }
    
    protected function validaNick()
    {
        $usuarios=new Usuarios();
        
        if ($usuarios->buscarTodos(["where"=> "nick='$this->nick'"]))
        {
            if($this->_esNuevo){
                $this->setError("nick", "Lo sentimos, ese nick ya está en uso.");
                return;
            }
            else{
                $usuarios->buscarPorId($this->cod_usuario);
                if ( $this->nick != $usuarios->nick) {
                    $this->setError("nick", "Lo sentimos, ese nick ya está en uso.");
                    return;
                }
            }
        }
    }
    
    protected function validaCorreo()
    {
        
        $usuarios=new Usuarios();
        
        if ($usuarios->buscarTodos(["where"=> "correo='$this->correo'"]))
        {
            
            if($this->_esNuevo){
                $this->setError("correo", "Lo sentimos, ese correo ya está en uso.");
                return;
            }
            else{
                $usuarios->buscarPorId($this->cod_usuario);
                if ( $this->correo != $usuarios->correo) {
                    $this->setError("correo", "Lo sentimos, ese correo ya está en uso.");
                    return;
                }
            }
  
        }
        
    }
    protected function validaTelefono()
    {

        if (!ctype_digit($this->telefono))
        {
            $this->setError("telefono", "Por favor, Introduzca un teléfono válido.");
            return;
        }
        
    }
    
    protected function validaImagen()
    {
        
        if ($this->imagen!="")
        {
            $extension=explode('.', $this->imagen);
            
            if(end($extension)!="png" && end($extension)!="jpg" && end($extension)!="jpeg" && end($extension)!="gif"){
            
            $this->setError("imagen", "Seleccione una imagen válida(png, jpg, jpeg, gif).");
            return;
            }
        }
        
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
    
    protected function afterBuscar() {
        $fecha= $this->fecha_nacimiento;
        $fecha= CGeneral::fechaMysqlANormal($fecha);
        $this->fecha_nacimiento = $fecha;
    }
    
    protected function fijarSentenciaInsert()
    {
       
        $nick=CGeneral::addSlashes($this->nick);
        $correo=CGeneral::addSlashes($this->correo);
        $nombre=CGeneral::addSlashes($this->nombre);
        $apellidos=CGeneral::addSlashes($this->apellidos);
        $dni=CGeneral::addSlashes($this->dni);
        $fecha_nacimiento=CGeneral::fechaNormalAMysql($this->fecha_nacimiento);
        $sexo=$this->sexo;
        $telefono=CGeneral::addSlashes($this->telefono);
        $imagen=CGeneral::addSlashes($this->imagen);
        $activado=$this->activado;
        
        return "insert into usuarios (".
            " nick, correo, nombre, apellidos, dni, fecha_nacimiento, sexo,".
            "telefono, imagen, activado".
            " ) values ( ".
            " '$nick','$correo', '$nombre', '$apellidos', '$dni', '$fecha_nacimiento', ". ($sexo?"1":"0").
            ", '$telefono', '$imagen', " .($activado?"1":"0").
            "     )";
    }
    
    
    
    protected function fijarSentenciaUpdate()
    {
        $correo=CGeneral::addSlashes($this->correo);
        $nombre=CGeneral::addSlashes($this->nombre);
        $apellidos=CGeneral::addSlashes($this->apellidos);
        $dni=CGeneral::addSlashes($this->dni);
        $fecha_nacimiento=CGeneral::fechaNormalAMysql($this->fecha_nacimiento);
        $sexo=$this->sexo;
        $telefono=CGeneral::addSlashes($this->telefono);
        $imagen=CGeneral::addSlashes($this->imagen);
        $activado=$this->activado;
        
        return "update usuarios set ".
            " correo='$correo', ".
            " nombre='$nombre', ".
            " apellidos='$apellidos', ".
            " dni='$dni', ".
            " fecha_nacimiento='$fecha_nacimiento', ".
            " sexo=".($sexo?"1":"0").
            ", telefono='$telefono', ".
            " imagen='$imagen', ".
            " activado= ".($activado?"1":"0").
            "     where cod_usuario={$this->cod_usuario}";
    }
    
    /*public function buscarPorNick($valor,$opciones=array())
    {
        if (!isset($opciones["where"]))
            $opciones["where"]="";
            $opciones["order"]="";
            $opciones["limit"]="1";
            
            if ($opciones["where"]!="")
                $opciones["where"].=" and ";
                
                $opciones["where"].=" t.{$this->nick}=$valor";
                
                $filas=$this->ejecutarConsultaSelect($opciones);
                
                if (is_array($filas) && count($filas)!=0)
                {
                    $this->_esNuevo=false;
                    $this->setValores($filas[0]);
                    $this->afterBuscar();
                    return true;
                }
                
                return false;
                
    }*/


}