<?php 

class Noticias extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'noticia';
    }
    
    protected function fijarTabla()
    {
        return "noticias";
    }
    
    protected function fijarId(){
        return "cod_noticia";
    }

    
    protected function fijarAtributos()
    {
        return array(
            "cod_noticia",
            "titulo",
            "mensaje",
            "fecha",
            "imagen",
            "autor",
            "borrado"
        );
    }
    

    protected function fijarDescripciones()
    {
        return array(
            "cod_noticia"=>"Código",
            "titulo"=>"Título",
            "mensaje"=>"Mensaje",
            "fecha"=>"Fecha",
            "imagen"=>"Imagen",
            "autor"=>"Autor",
            "borrado"=>"Borrado"
        );
    }

    

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_noticia",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_noticia",
                "TIPO" => "ENTERO",
                "MIN"  =>0
            ),
            array(
                "ATRI" => "titulo",
                "TIPO" => "CADENA",
                "TAMANIO" => 200
            ),
            array(
                "ATRI" => "titulo",
                "TIPO" => "FUNCION",
                "FUNCION" => "validaTitulo" 
            ),
            array(
                "ATRI" => "mensaje",
                "TIPO" => "CADENA",
                "TAMANIO" => 10000
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
                "ATRI" => "autor",
                "TIPO" => "CADENA",
                "TAMANIO" => 200
            ),
            array(
                "ATRI" => "autor",
                "TIPO" => "FUNCION",
                "FUNCION" => "validaAutor"
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
        $this->cod_noticia=1;
        $this->titulo="";
        $this->mensaje="";
        $this->fecha=(new DateTime())->format("d/m/Y");
        $this->imagen="";
        $this->autor="";
        $this->borrado=false;
        
    }
    
    public function validaTitulo(){
        
        if (strlen($this->titulo)<10)
        {
            $this->setError("Titulo","El titulo es demasiado corto, debe tener al menos 10 carácteres");
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
    
    
    public function validaAutor(){
        
        if (strlen($this->autor)<3)
        {
            $this->setError("autor","El autor es demasiado corto, debe tener al menos 3 carácteres");
        }
    }
    
    
    protected function afterBuscar() {
        $fecha= $this->fecha;
        $fecha= CGeneral::fechaTimeMysqlANormal($fecha);
        $this -> fecha = $fecha;
    }
    
    protected function fijarSentenciaInsert()
    {
        
        $titulo=CGeneral::addSlashes($this->titulo);
        $mensaje=CGeneral::addSlashes($this->mensaje);
        $fecha=CGeneral::fechaNormalAMysql($this->fecha);
        $imagen=CGeneral::addSlashes($this->imagen);
        $autor=CGeneral::addSlashes($this->autor);
        $borrado=$this->borrado;
        
        return "insert into noticias (".
            " titulo, mensaje, imagen, autor, borrado".
            " ) values ( ".
            " '$titulo','$mensaje','$imagen','$autor',".($borrado?"1":"0").
            "     )";
    }
            
            
            
    protected function fijarSentenciaUpdate()
    {
        $titulo=CGeneral::addSlashes($this->titulo);
        $mensaje=CGeneral::addSlashes($this->mensaje);
        $fecha=CGeneral::fechaNormalAMysql($this->fecha);
        $imagen=CGeneral::addSlashes($this->imagen);
        $autor=CGeneral::addSlashes($this->autor);
        $borrado=$this->borrado;
        
        return "update noticias set ".
               " titulo='$titulo', ".
               " mensaje='$mensaje', ".
               " imagen='$imagen', ".
               " autor='$autor', ".
               " borrado= ".($borrado?"1":"0").
               "     where cod_noticia={$this->cod_noticia}";
    }
               

}