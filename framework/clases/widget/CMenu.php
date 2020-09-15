<?php


	class CMenu extends CWidget
	{
		private $_elementos=array();
		private $_atributosHTML=array();
		
		public function __construct($elementos, $atributosHTML=array())
		{
			
			$this->_elementos=$elementos;
			$this->_atributosHTML=$atributosHTML;
			
			
			if (!isset($this->_atributosHTML["class"]))
			    $this->_atributosHTML["class"]="navbar-collapse";
			
			    if (!isset($this->_atributosHTML["id"]))
			        $this->_atributosHTML["id"]="content-android";
			
		}
		    
		
		public static function requisitos()
		{
		    $codigo=<<<EOF

            $(function(){


            $("#nav-android").click(androidMenu);

			function androidMenu() {
                  var x = $("#content-android");
            
                  if(x.is( ":hidden" )){
                    x.slideDown(250);
                  }
                  else
                  x.slideUp(250);
            }

        $( window ).resize(navbar);
        
        function navbar(){
          if( $( window ).width()>=600){
              $("#content-android").css("display","none");
          }
        }

        });
EOF;  

		    return CHTML::script($codigo);
		}
		
		
		public function dibujate()
		{
			return $this->dibujaApertura().$this->dibujaFin();
		}
		
		public function dibujaApertura()
		{
			ob_start();

			echo CHTML::link("<i class='fas fa-bars'></i>", "javascript:void(0);", ["id"=>"nav-android", "class" => "nav-link"]);
			
			echo CHTML::dibujaEtiqueta("div",$this->_atributosHTML,"",false);
			
			
			if (isset($this->_elementos)) {
			    foreach ($this->_elementos as $opcion) {
			        if (isset($opcion["enlace"])) {
			            echo CHTML::link($opcion["texto"], $opcion["enlace"], [
			                "class" => "nav-link"
			            ]);
			        }
			        //si hay subenlaces se mostrará un desplegable
			        else if(isset($opcion["subenlace"])) {
			            
			            
			            echo funcionesGenerales::montaDesplegableAndroid($opcion["texto"],$opcion["subenlace"]);
			            
			            
			            
			        }
			        
			        
			    }
			    
			
			
			
		}
		if (Sistema::app()->Acceso() &&
		    Sistema::app()->Acceso()->hayUsuario()){
		        echo "<div class='dropdown'>";
		        echo CHTML::link( Sistema::app()->Acceso()->getNombre(),"#", ["class" => "dropdown-toggle nav-link",  "data-toggle" =>"dropdown"]);
		        echo '<div class="dropdown-menu animate slideIn">';
		        echo  CHTML::link("Perfil",["inicial","perfil"], ["class" => "dropdown-item nav-link"]);
		        echo  CHTML::link("Salir",["login","logout"], ["class" => "dropdown-item nav-link"]);
		        echo "</div>";
		        echo"</div>";
		}
		else{
		    echo "<div>";
		    echo CHTML::link("Conectar",["login","login"], ["class" => "nav-link nav-large"]);
		    echo"</div>";
		}
			
			
			echo CHTML::dibujaEtiquetaCierre("div");
			$escrito=ob_get_contents();
			ob_end_clean();
			
			return $escrito;	
							
		}
				
		public function dibujaFin()
		{
			return "";
		}
		

		
		
	}
