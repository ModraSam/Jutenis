<?php

	class CGrid extends CWidget
	{
		private $_columnas=array();
		private $_filas=array();
		private $_atributosHTML=array();
	
		public function __construct($cabecera,$filas,$atributosHTML=array())
		{
			foreach($cabecera as $cabe)
			{
				$fila=array("CAMPO"=>"jjjjjj",
							"ETIQUETA"=>"",
							"ANCHO"=>"",
							"VISIBLE"=>true,
							"ALINEA"=>"izq",
				            "TEXTO_MAX"=>0
				);
							
				if (isset($cabe["CAMPO"]))
						$fila["CAMPO"]=$cabe["CAMPO"];
				
				if (isset($cabe["ETIQUETA"]))
						$fila["ETIQUETA"]=$cabe["ETIQUETA"];
					else
						$fila["ETIQUETA"]=$fila["CAMPO"];
				
				if (isset($cabe["ANCHO"]))
						$fila["ANCHO"]=$cabe["ANCHO"];
				
				if (isset($cabe["VISIBLE"]) && is_bool($cabe["VISIBLE"]))
						$fila["VISIBLE"]=$cabe["VISIBLE"];
				
				if (isset($cabe["ALINEA"]) && 
						in_array($cabe["ALINEA"],array("izq","der","cen")))
						$fila["ALINEA"]=$cabe["ALINEA"];
						
				if(isset($cabe["TEXTO_MAX"]) && is_int($cabe["TEXTO_MAX"]))
					 $fila["TEXTO_MAX"]=$cabe["TEXTO_MAX"];
				
				$this->_columnas[]=$fila;
				
			}
			
			$this->_filas=$filas;
			$this->_atributosHTML=$atributosHTML;
			
			if (!isset($this->_atributosHTML["class"]))
				$this->_atributosHTML["class"]="tabla";
			if (!isset($this->_atributosHTML["cellpadding"]))
				$this->_atributosHTML["cellpadding"]="0";
			if (!isset($this->_atributosHTML["cellspacing"]))
				$this->_atributosHTML["cellspacing"]="0";
			if (!isset($this->_atributosHTML["border"]))
				$this->_atributosHTML["border"]="0";
							
			
		}
		
		public static function requisitos()
		{
		    $codigo=<<<EOF
			$(document).ready(function() {
  $("a.mostrar").click(function(event) {

    event.preventDefault();

    elemento = $(this).siblings('span.ocultar');

      if (elemento.is(":visible")) {
           elemento.hide();
            $(this).siblings(".pSuspensivos").show();
           $(this).text("Mostrar más.");
      }
      else {
          elemento.show();
                $(this).siblings(".pSuspensivos").hide();
          $(this).text("Mostrar menos.");
      }

  });

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
			
			echo CHTML::dibujaEtiqueta("div",$this->_atributosHTML,
										"",false);
			echo CHTML::dibujaEtiqueta("table",$this->_atributosHTML,
										"",false);
			?>
			<thead class="thead-dark">							
			<tr>
			
				<?php
				foreach ($this->_columnas as $columna) 
				{
				  $eti=$etiqueta="th";
				  if ($columna["ANCHO"]!="")
				  		$etiqueta.=" width='".$columna["ANCHO"]."'";		
					
				  if ($columna["VISIBLE"])	
				   		echo "<$etiqueta>".$columna["ETIQUETA"]."</$eti>";	

				}
				
				?>
			</tr>
			</thead>	
			<?php
			$par=false;
				
			foreach ($this->_filas as $fila) 
			{
				if ($par)
						echo "<tr class='par'>\n";
				     else
					 	echo "<tr class='impar'>\n";
				$par=!$par;
				   
				foreach ($this->_columnas as $columna) 
				{
					$campo="";
					if (isset($fila[$columna["CAMPO"]]))
						$campo=$fila[$columna["CAMPO"]];
					$eti=$etiqueta="td";
					
					switch ($columna["ALINEA"]) {
						case 'izq': ;
							break;
						
						case 'der': $etiqueta.=" align='right'";
							break;
						
						case 'cen': $etiqueta.=" align='center'";
							break;
						
					}
					if ($columna["VISIBLE"]){
				  		echo "\t<$etiqueta>";
				  		if($columna["TEXTO_MAX"]>0 && $columna["TEXTO_MAX"]<strlen($campo)){
				  		    $campo= str_replace("<","&lt;",$campo);
				  		    $campo= str_replace(">","&gt;",$campo);
				  		   $inicio = substr($campo, 0, $columna["TEXTO_MAX"]); 
				  		   $final = substr($campo, $columna["TEXTO_MAX"]);
				  		   
				  		   echo"<span>".$inicio."</span>".
				  		   "<span class='pSuspensivos'>...</span>";
				  		echo "<span class='ocultar'>".$final."</span>";
				  		echo "<br><a href='#' class='mostrar'>Mostrar más.</a>";
				  		}
				    else
				        echo $campo;
				    
				    echo "</$eti>\n";	
					}
					
				  	
				}		
				echo "</tr>\n";
			}
										
		    echo CHTML::dibujaEtiquetaCierre("table");								
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
