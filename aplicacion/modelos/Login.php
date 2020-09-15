<?php 

class Login extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'log';
    }

    protected function fijarAtributos()
    {
        return array(
            "nick",
            "contrasenia",
            "nombre",
            "puedeAcceder",
            "puedeConfigurar",
            "otrosPermisos"
        );
    }

    protected function fijarDescripciones()
    {
        return array(
            "nick" => "Usuario: ",
            "contrasenia" => "Contraseña: "
        );
    }

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "nick,contrasenia",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "nick",
                "TIPO" => "CADENA",
                "TAMANIO" => 30,
                "MENSAJE" =>"El nombre de usuario debe tener menos de 30 caracteres"
            ),
            array(
                "ATRI" => "contrasenia",
                "TIPO" => "CADENA",
                "TAMANIO" => 20
            ),
            array(
                "ATRI" => "nick",
                "TIPO" => "FUNCION",
                "FUNCION" => "comprobar"
            )
        );
    }

    protected function afterCreate()
    {
        $this->nick = "";
        $this->contrasenia = "";
    }

    public function comprobar()
    {
        if (!Sistema::app()->ACL())
        {
            $this->setError("nick", "Error en la configuración");
            return;
        }
        
        if (!Sistema::app()->ACL()->esValido($this->nick,$this->contrasenia))
        {
            $this->setError("nick", "Usuario y/o contraseña incorrectos.");
            return;
        }
        
        if (!Sistema::app()->ACL()->esActivado($this->nick,$this->contrasenia))
        {
            $this->setError("nick", "Su cuenta no está activada, por favor, contacte con un administrador.");
            return;
        }
        
        $this->nombre=Sistema::app()->ACL()->getNombre($this->nick);
        $pa=false;
        $pc=false;
        Sistema::app()->ACL()->getPermisos($this->nick, 
                        $pa, 
                        $pc);
        $this->puedeAcceder=$pa;
        $this->puedeConfigurar=$pc;
        $this->otrosPermisos=Sistema::app()->ACL()->getPermisosOtros($this->nick);
        
    }

}