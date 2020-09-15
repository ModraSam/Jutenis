<?php
	header("HTTP/1.1 $numError $mensaje");
	header("Status: $numError $mensaje");
	
	?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<link rel="icon" type="image/png" href="/imagenes/favicon-32x32.png" />
	

	<title>Error <?php echo $numError?></title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="/estilos/error.css" />

</head>

<body>

	<div id="error">
		<div class="error">
			<div class="errores"></div>
			<h1><?php echo $numError?></h1>
			<h2><?php echo $mensaje;?></h2>
			<p>Sentimos el error ocasionado. Por favor, vuelva a la página principal para continuar. </p>
			<?php echo CHTML::link("Volver a la página principal",["inicial",""]);?>
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
