<?php 

class Mensajes extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'mensaje';
    }
    
    protected function fijarTabla()
    {
        return "mensajes";
    }
    
    protected function fijarId(){
        return "cod_mensaje";
    }

    
    protected function fijarAtributos()
    {
        return array(
            "cod_mensaje",
            "nombre",
            "correo",
            "mensaje",
            "fecha",
            "borrado"
        );
    }
    

    protected function fijarDescripciones()
    {
        return array(
            "cod_mensaje"=>"Código",
            "nombre"=>"Nombre",
            "correo"=>"Correo",
            "mensaje"=>"Mensaje",
            "fecha"=>"Fecha",
            "borrado"=>"Borrado"
        );
    }

    

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_mensaje",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_mensaje",
                "TIPO" => "ENTERO",
                "MIN"  =>0
            ),
            array(
                "ATRI" => "nombre",
                "TIPO" => "CADENA",
                "TAMANIO" => 50
            ),
            array(
                "ATRI" => "correo",
                "TIPO" => "email",
                "TAMANIO" => 320
            ),
            array(
                "ATRI" => "mensaje",
                "TIPO" => "CADENA",
                "TAMANIO" => 3000
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
        $this->cod_mensaje=1;
        $this->nombre="";
        $this->correo="";
        $this->mensaje="";
        $this->fecha=(new DateTime())->format("d/m/Y");
        $this->borrado=false;
        
    }
    
    public function validaCadena(){
        
        if (strlen($this->nombre)<3)
        {
            $this->setError("nombre","El nombre es demasiado corto.");
        }
        
        if (strlen($this->mensaje)<30)
        {
            $this->setError("mensaje","El mensaje es demasiado corto, debe tener al menos 30 carácteres");
        }
    }
    
    
    protected function afterBuscar() {
        $fecha= $this->fecha;
        $fecha= CGeneral::fechaTimeMysqlANormal($fecha);
        $this -> fecha = $fecha;
    }
    
    protected function fijarSentenciaInsert()
    {
        
        $nombre=CGeneral::addSlashes($this->nombre);
        $correo=CGeneral::addSlashes($this->correo);
        $mensaje=CGeneral::addSlashes($this->mensaje);
        
        return "insert into mensajes (".
            " nombre, correo, mensaje".
            " ) values ( ".
            " '$nombre','$correo','$mensaje'".
            "     )";
    }

               

}