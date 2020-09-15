<?php 

class Acl_roles extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'acl_role';
    }
    
    protected function fijarTabla()
    {
        return "acl_roles";
    }
    
    protected function fijarId(){
        return "cod_role";
    }

    
    protected function fijarAtributos()
    {
        return array(
            "cod_role",
            "nombre"
        );
    }
    

    protected function fijarDescripciones()
    {
        return array(
            "cod_role"=>"Código",
            "nombre"=>"Nombre"
        );
    }

    

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_role",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_role",
                "TIPO" => "ENTERO",
                "MIN"  =>0
            ),
            array(
                "ATRI" => "nombre",
                "TIPO" => "CADENA",
                "TAMANIO" => 30
            )
        );
    }

    protected function afterCreate()
    {
        $this->cod_role=0;
        $this->nombre="";
        
    }
               

}