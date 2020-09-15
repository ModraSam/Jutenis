<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $titulo;?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width; initial-scale=1.0">

<!-- Bootstrap -->
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	crossorigin="anonymous">

<!-- Custom font-->
<link
	href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
	rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="/estilos/style.css" />

<link rel="icon" type="image/png" href="/imagenes/favicon-32x32.png" />

<script src="https://kit.fontawesome.com/a14f36d112.js"
	crossorigin="anonymous"></script>
	
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
    
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
		<?php
if (isset($this->textoHead))
    echo $this->textoHead;

    echo CMenu::requisitos();
?>
	</head>
<body>

	<!-- Nav -->
	<nav class="navbar navbar-custom position-sticky">
		<a href="/index.php"><img id="logo" src="/imagenes/logo.svg" alt="logo"></a>
        <?php
        
        //barra de navegacion
        if (isset($this->menu)) {
            foreach ($this->menu as $opcion) {
                echo CHTML::link($opcion["texto"], $opcion["enlace"], [
                    "class" => "nav-link nav-large"
                ]);
            }
            
        }

        if (Sistema::app()->Acceso() &&
            Sistema::app()->Acceso()->hayUsuario()){
                echo "<div class='dropdown'>";
                echo CHTML::link( Sistema::app()->Acceso()->getNombre(),"#", ["class" => "dropdown-toggle nav-link nav-large",  "data-toggle" =>"dropdown"]);
                echo '<div class="dropdown-menu animate slideIn">';
                    echo  CHTML::link("Perfil",["inicial","perfil"], ["class" => "dropdown-item nav-link nav-large"]);
	               echo  CHTML::link("Salir",["login","logout"], ["class" => "dropdown-item nav-link nav-large"]);
                echo "</div>";
                echo"</div>";
        }
        else{
            echo "<div>";
                echo CHTML::link("Conectar",["login","login"], ["class" => "nav-link nav-large"]);
            echo"</div>";
        }
        
        //barra de android
        if (isset($this->menu)) {
            
            $menu=new CMenu($this->menu);
            echo $menu->dibujate();
        }

        ?> 
		
		
    </nav>
    
	<div id="mostrador">
	
		<div id="title-container" >
		
		<?php
		if (isset($this->titulo)) {
            
		    if(isset($this->titulo["head"]))
		        echo "<h1>".strtoupper($this->titulo["head"])."</h1>";
		    
		     else 
		           echo "<h1>Titulo de ejemplo</h1>";
		            
		           if(isset($this->titulo["mensaje"]))
		        
		        echo "<p>{$this->titulo["mensaje"]}</p>";
		        
		        else
		            echo "<p>Texto de ejemplo</p>";
        }
        else {
                    echo "<h1>Titulo de ejemplo</h1>";
                    echo "<p>Texto de ejemplo</p>";
        }
            ?>
			
			
			<a href="#page-container" class="btn" id="btn-mostrar-mas">Mostrar más</a>
		</div>
	</div>

	<div id="page-container">

		<div class="text-center" id="container-notice">
		<div class="row">
			<?php echo $contenido;?>
		</div>
			
		
		</div>
			
			
	        		


				<!-- #content -->




			<!-- Footer -->
			<footer id="footer"
				class="page-footer font-small text-secondary footer">

				<!-- Copyright -->
				<div class="footer-copyright text-center py-3">
					© 2020 Copyright: <a class="text-secondary"
						target="_blank" href="https://github.com/ModraSam"> <?php echo Sistema::app()->autor?></a>
					Todos los derechos reservados.
				</div>
				<!-- Copyright -->

				<div class="text-center">
					<div>
						Siguenos en: <a target="_blank" href="https://www.facebook.com/jutenissl"
							class="text-secondary"><i class="fab fa-facebook-f"></i></a> <a
							target="_blank" href="https://twitter.com/jutenis" class="text-secondary"><i
							class="fab fa-twitter"></i></a> <a
							target="_blank" href="https://www.youtube.com/user/jutenis/videos"
							class="text-secondary"><i class="fab fa-youtube"></i></a> <a
							target="_blank" href="https://www.instagram.com/jutenis/" class="text-secondary"><i
							class="fab fa-instagram"></i></a>
					</div>
				</div>


			</footer>
			<!-- Footer -->

		</div>

</body>
</html>
