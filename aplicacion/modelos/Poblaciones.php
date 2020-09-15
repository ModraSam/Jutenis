<?php 

class Poblaciones extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'poblacion';
    }
    
    protected function fijarTabla()
    {
        return "poblaciones";
    }
    
    protected function fijarId(){
        return "cod_poblacion";
    }

    
    protected function fijarAtributos()
    {
        return array(
            "cod_poblacion",
            "nombre"
        );
    }
    

    protected function fijarDescripciones()
    {
        return array(
            "cod_poblacion"=>"Código",
            "nombre"=>"Provincia"
        );
    }

    

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_poblacion",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_poblacion",
                "TIPO" => "ENTERO",
                "MIN"  =>0
            ),
            array(
                "ATRI" => "nombre",
                "TIPO" => "CADENA",
                "TAMANIO" => 20
            )
        );
    }

    protected function afterCreate()
    {
        $this->cod_poblacion=0;
        $this->nombre="";
        
    }
               

}