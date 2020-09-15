<?php 

class EventosUsuarios extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'Ev_Usu';
    }
    
    protected function fijarTabla()
    {
        return "eventos_usuarios";
    }
    
    protected function fijarId(){
        return "cod_evento_usuario";
    }
    
    protected function fijarAtributos()
    {
        return array(
            "cod_evento_usuario",
            "cod_usuario",
            "cod_evento",
            "borrado"
        );
    }

    protected function fijarDescripciones()
    {
        return array(
            "cod_evento_usuario" => "Código",
            "cod_usuario" => "Código de usuario",
            "cod_evento" => "Código de evento",
            "borrado" => "Borrado"
        );
    }

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_evento_usuario,cod_usuario,cod_evento",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_evento_usuario",
                "TIPO" => "ENTERO",
                "MIN"  =>0
            ),
            array(
                "ATRI" => "cod_usuario",
                "TIPO" => "ENTERO",
                "MIN"  =>0
            ),
            array(
                "ATRI" => "cod_evento",
                "TIPO" => "ENTERO",
                "MIN"  =>0
            ),
            array(
                "ATRI" => "cod_usuario",
                "TIPO" => "FUNCION",
                "FUNCION"=> "validaUsuarioEvento"
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
        $this->cod_evento_usuario=0;
        $this->cod_usuario=1;
        $this->cod_evento=1;
        $this->borrado=false;
    }
    
    protected function fijarSentenciaInsert()
    {
        $cod_usuario=CGeneral::addSlashes($this->cod_usuario);
        $cod_evento=CGeneral::addSlashes($this->cod_evento);
        $borrado=CGeneral::addSlashes($this->borrado);
        
        return "insert into eventos_usuarios (".
            " cod_usuario, cod_evento, borrado ".
            " ) values ( ".
            " '$cod_usuario', "." '$cod_evento', ".($borrado?"1":"0").
            "     )";
    }
    
    
    
    protected function fijarSentenciaUpdate()
    {
        $cod_usuario=CGeneral::addSlashes($this->cod_usuario);
        $cod_evento=CGeneral::addSlashes($this->cod_evento);
        $borrado=CGeneral::addSlashes($this->borrado);
        
        return "update eventos_usuarios set ".
            " cod_usuario='$cod_usuario', ".
            " cod_evento='$cod_evento', ".
            " borrado=".($borrado?"1":"0") .
            "     where cod_evento_usuario={$this->cod_evento_usuario}";
    }
    
    protected function validaUsuarioEvento()
    {
        $cod_usuario=CGeneral::addSlashes($this->cod_usuario);
        $cod_evento=CGeneral::addSlashes($this->cod_evento);
        
        $resultado = $this->buscarTodos(["where" => "cod_usuario = ".$cod_usuario." and cod_evento = ".$cod_evento. " and borrado=0"]);
        if($resultado){
            $this->setError("cod_usuario", "Usted ya se encuentra participando en este evento.");
            return;
        }
        
        $usuario = new Usuarios();

        $usuario = $usuario->buscarTodos(["where"=>"cod_usuario =".$cod_usuario]);
        
        
        $evento = new Eventos();
        
        $evento = $evento->buscarTodos(["where"=>"cod_evento =".$cod_evento]);
        
        
        $edad = funcionesGenerales::devuelveEdad($usuario[0]["fecha_nacimiento"]);
        
        if($edad<$evento[0]["edad_requerida"] || ($edad>$evento[0]["edad_maxima"] &&  $evento[0]["edad_maxima"]!= 0)){
            $this->setError("cod_usuario", "Lo sentimos, no cumples los requisitos de edad.");
            return; 
        }
        
        if($evento[0]["n_inscritos"]>=$evento[0]["aforo"]){
            $this->setError("cod_usuario", "Lo sentimos, el aforo esta al completo.");
            return;
        }
    }
    
}