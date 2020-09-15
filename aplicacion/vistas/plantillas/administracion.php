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
	
	<script src="https://cdn.tiny.cloud/1/kinp4v229hqiv114zgo493ymke6dgcghmc99h97es3iq3gia/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	
	 <script>
      tinymce.init({
        selector: '.editor'
      });
    </script>

<link rel="stylesheet" type="text/css" href="/estilos/administracion.css" />

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
		<a href="/index.php"><img id="logo" src="/imagenes/logo_blanquito.svg" alt="logo"></a>
        <?php
        
        //barra de navegacion
        if (isset($this->menu)) {
            foreach ($this->menu as $opcion) {
                if (isset($opcion["enlace"])) {
                    echo CHTML::link($opcion["texto"], $opcion["enlace"], [
                        "class" => "nav-link nav-large"
                    ]);
                }
                //si hay subenlaces se mostrará un desplegable
                else if(isset($opcion["subenlace"])) {
                    
                        
                    echo funcionesGenerales::montaDesplegable($opcion["texto"],$opcion["subenlace"]);
                    
                    
                   
                }
                
                
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


				<article class="table-responsive">
	        		<?php echo $contenido;?>
	 			</article>
				<!-- #content -->



</body>
</html>
