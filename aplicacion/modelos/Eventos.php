<?php 

class Eventos extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'evento';
    }
    
    protected function fijarTabla()
    {
        return "vista_eventos";
    }
    
    protected function fijarId(){
        return "cod_evento";
    }

    
    protected function fijarAtributos()
    {
        return array(
            "cod_evento",
            "titulo",
            "contenido",
            "fecha",
            "cod_poblacion",
            "poblacion",
            "edad_requerida",
            "edad_maxima",
            "cod_tipo_evento",
            "tipo_evento",
            "aforo",
            "n_inscritos",
            "borrado"
        );
    }
    

    protected function fijarDescripciones()
    {
        return array(
            "cod_evento"=>"Código",
            "titulo"=>"Título",
            "contenido"=>"Contenido",
            "fecha"=>"Fecha",
            "cod_poblacion"=>"Código población",
            "poblacion"=>"Población",
            "edad_requerida"=>"Edad mínima",
            "edad_maxima"=>"Edad máxima",
            "cod_tipo_evento"=>"Código tipo de evento",
            "tipo_evento"=>"Tipo de evento",
            "aforo"=>"Aforo",
            "n_inscritos"=>"Número de inscritos",
            "borrado"=>"Borrado"
        );
    }

    

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_evento",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_evento",
                "TIPO" => "ENTERO",
                "MIN"  =>0
            ),
            array(
                "ATRI" => "titulo",
                "TIPO" => "CADENA",
                "TAMANIO" => 50
            ),
            array(
                "ATRI" => "titulo",
                "TIPO" => "FUNCION",
                "FUNCION" => "validaTitulo" 
            ),
            array(
                "ATRI" => "contenido",
                "TIPO" => "CADENA",
                "TAMANIO" => 3000
            ),
            array(
                "ATRI" => "fecha",
                "TIPO" => "FECHA"
            ),
            array(
                "ATRI" => "fecha",
                "TIPO" => "FUNCION",
                "FUNCION"=> "validaFecha"
            ),
            array(
                "ATRI" => "cod_poblacion",
                "TIPO" => "ENTERO",
                "MIN"  =>0
            ),
            array(
                "ATRI" => "cod_poblacion",
                "TIPO" => "FUNCION",
                "FUNCION"=> "validaPoblacion"
            ),
            array(
                "ATRI" => "poblacion",
                "TIPO" => "CADENA",
                "TAMANIO" => 20
            ),
            array(
                "ATRI" => "edad_requerida",
                "TIPO" => "ENTERO",
                "MIN"  =>3,
                "MAX" =>70
            ),
            array(
                "ATRI" => "edad_maxima",
                "TIPO" => "ENTERO",
                "MIN"  =>3,
                "MAX" =>70
            ),
            array(
                "ATRI" => "edad_maxima",
                "TIPO" => "FUNCION",
                "FUNCION"=> "validaEdades"
            ),
            array(
                "ATRI" => "cod_tipo_evento",
                "TIPO" => "ENTERO",
                "MIN"  =>0
            ),
            array(
                "ATRI" => "cod_tipo_evento",
                "TIPO" => "FUNCION",
                "FUNCION"=> "validaTipoEvento"
            ),
            array(
                "ATRI" => "tipo_evento",
                "TIPO" => "CADENA",
                "TAMANIO" => 20
            ),
            array(
                "ATRI" => "aforo",
                "TIPO" => "ENTERO",
                "MIN"  =>1
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
        $this->cod_evento=1;
        $this->titulo="";
        $this->contenido="";
        $this->fecha=(new DateTime())->format("d/m/Y");
        $this->cod_poblacion=0;
        $this->poblacion="Sin indicar";
        $this->edad_requerida=3;
        $this->edad_maxima=3;
        $this->cod_tipo_evento=0;
        $this->tipo_evento="Sin indicar";
        $this->aforo=10;
        $this->borrado=false;
        
    }
    
    protected function validaPoblacion()
    {
        $poblacion=new Poblaciones();
        
        if (!$poblacion->buscarPorId($this->cod_poblacion))
        {
            $this->setError("cod_poblacion", "No se encuentra la provincia indicada");
            return;
        }
        
        $this->poblacion=$poblacion->nombre;
    }
    
    protected function validaTipoEvento()
    {
        $tipoEv=new TipoEventos();
        
        if (!$tipoEv->buscarPorId($this->cod_tipo_evento))
        {
            $this->setError("cod_tipo_evento", "No se encuentra el tipo de evento indicado");
            return;
        }
        
        $this->tipo_evento=$tipoEv->nombre;
    }
   
    
    public function validaFecha(){
        $fecha1=DateTime::createFromFormat('d/m/Y',$this->fecha);
        $fecha2=DateTime::createFromFormat('d/m/Y',date("d/m/Y"));
        
        if ($fecha1<$fecha2)
        {
            $this->setError("fecha","La fecha debe ser posterior o igual a hoy");
        }
    }
    
    public function validaEdades(){
        
        if ($this->edad_maxima<$this->edad_requerida)
        {
            $this->setError("edad_maxima","La edad máxima no puede menor que la edad requerida");
            $this->setError("edad_requerida","La edad requerida no puede mayor que la edad máxima");
        }
    }
    
    public function validaTitulo(){
        
        if (strlen($this->titulo)<10)
        {
            $this->setError("Titulo","El titulo es demasiado corto, debe tener al menos 10 carácteres");
        }
    }
    
    
    public static function listaTiposEventos($tipoEv=null)
    {
        $objtipoEv=new TipoEventos();
        
        $aux=$objtipoEv->buscarTodos(["order"=>"nombre"]);
        $tiposEv=[];
        
        foreach($aux as $t)
        {
            $tiposEv[$t["cod_tipo_evento"]]=$t["nombre"];
        }
        if ($tipoEv==null)
            return $tiposEv;
            
            if (isset($tiposEv[$tipoEv]))
                return $tiposEv[$tipoEv];
                else
                    return false;
    }
    
    public static function listaPoblaciones($poblacion=null)
    {
        $objPoblacion=new Poblaciones();
        
        $aux=$objPoblacion->buscarTodos(["order"=>"nombre"]);
        $poblaciones=[];
        
        foreach($aux as $p)
        {
            $poblaciones[$p["cod_poblacion"]]=$p["nombre"];
        }
        if ($poblacion==null)
            return $poblaciones;
            
            if (isset($poblaciones[$poblacion]))
                return $poblaciones[$poblacion];
                else
                    return false;
    }
    
    public static function listaUsuariosEvento($cod_evento, $usuEv=null)
    {
        
        $usu = new Usuarios();
        
        $aux = $usu->buscarTodos([
            "select"=>"t.*",
            "where"=>"t.cod_usuario not in(
                                    select eu.cod_usuario
                                    from vista_eventos ve
                                    JOIN eventos_usuarios eu ON ve.cod_evento=eu.cod_evento
                                    where eu.borrado=0 and eu.cod_evento=$cod_evento)"
        ]);
        $ususEv=[];
        
        foreach($aux as $t)
        {
            $ususEv[$t["cod_usuario"]]=$t["nick"]. " - ". "Edad:".funcionesGenerales::devuelveEdad($t["fecha_nacimiento"])." - ".$t["nombre"]." ".$t["apellidos"]." - ".$t["dni"];
        }
        if ($usuEv==null)
            return $ususEv;
            
            if (isset($ususEv[$usuEv]))
                return $ususEv[$usuEv];
                else
                    return false;
    }
    
    
    protected function afterBuscar() {
        $fecha= $this->fecha;
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
               

}