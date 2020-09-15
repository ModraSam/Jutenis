<?php 

class TipoEventos extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'tipo_evento';
    }
    
    protected function fijarTabla()
    {
        return "tipo_eventos";
    }
    
    protected function fijarId(){
        return "cod_tipo_evento";
    }

    
    protected function fijarAtributos()
    {
        return array(
            "cod_tipo_evento",
            "nombre"
        );
    }
    

    protected function fijarDescripciones()
    {
        return array(
            "cod_tipo_evento"=>"Código",
            "nombre"=>"Tipo de evento"
        );
    }

    

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_tipo_evento",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_tipo_evento",
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
        $this->cod_tipo_evento=0;
        $this->nombre="";
        
    }
    
    protected function fijarSentenciaInsert()
    {
        $nombre=CGeneral::addSlashes($this->nombre);
        
        return "insert into tipo_eventos (".
            " nombre".
            " ) values ( ".
            " '$nombre'".
            "     )";
    }
    
    
    
    protected function fijarSentenciaUpdate()
    {
        $nombre=CGeneral::addSlashes($this->nombre);
        
        return "update tipo_eventos set ".
            " nombre='$nombre' ".
            "     where cod_tipo_evento={$this->cod_tipo_evento}";
    }
    
               

}