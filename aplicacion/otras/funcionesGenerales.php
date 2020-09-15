<?php 

class funcionesGenerales{
    
    public static function addFicheroImagen($fichero,$tipo,&$nombre)
    {
        funcionesGenerales::devolverNombrealeatorio($nombre);
        
        $direccion="/imagenenes/".$tipo."/".$nombre;
        
        if(!file_exists("/imagenenes/".$tipo))
            mkdir("/imagenenes/".$tipo);
            
                
            if(move_uploaded_file($fichero, $carpeta))
                return $carpeta."/".$fichero;
            else 
                return "";
        
        
        
    }
    
    public static function devolverNombrealeatorio(&$nombre)
    {
        $cadAl = ""; 
        
        for ($i = 1; $i <= 10; $i++) {
            $cadAl .= "".rand(0, 9);
        }
        $cadAl.=$nombre;
        
        
                        
    }
    
    public static function devuelveEdad($fecha) {
        $aux = new DateTime($fecha);
        $hoy = new DateTime();
        $edad = $hoy->diff($aux);
        return $edad->y;
    }
    
    public static function transforma_fecha($fecha) {
        $fecha = explode(" ",$fecha); 
        $fecha1 = explode("-",$fecha[0]);
        
        return $fecha1[2]."/".$fecha1[1]."/".$fecha1[0]." ".$fecha[1];
    }
    
    
    //funcion que monta desplegable de la barra de menú
    public static function montaDesplegable($texto, $enlace) {
        
        
        ob_start();
        
        echo "<div class='dropdown'>";
        
        echo CHTML::link( $texto,"#", ["class" => "dropdown-toggle nav-link nav-large ",  "data-toggle" =>"dropdown"]);
        
        echo '<div class="dropdown-menu dropdown-menu-right animate slideIn">';
        foreach ($enlace as $opcion) {
            echo CHTML::link($opcion["texto"], $opcion["enlace"],  ["class" => "dropdown-item nav-link nav-large"]);
            
        }
        echo "</div>";
        echo"</div>";
        
        $escrito=ob_get_contents();
        ob_end_clean();
        
        return $escrito;
    }
    
    //funcion que monta desplegable de la barra de menú
    public static function montaDesplegableAndroid($texto, $enlace) {
        
        
        ob_start();
        
        echo "<div class='dropdown'>";
        
        echo CHTML::link( $texto,"#", ["class" => "dropdown-toggle nav-link",  "data-toggle" =>"dropdown"]);
        
        echo '<div class="dropdown-menu dropdown-menu-right animate slideIn">';
        foreach ($enlace as $opcion) {
            echo CHTML::link($opcion["texto"], $opcion["enlace"],  ["class" => "dropdown-item nav-link"]);
            
        }
        echo "</div>";
        echo"</div>";
        
        $escrito=ob_get_contents();
        ob_end_clean();
        
        return $escrito;
    }
    
    
    function sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject, $template){
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->isSMTP();                            // Establecer el correo electrónico para utilizar SMTP
        $mail->Host = 'smtp.gmail.com';             // Especificar el servidor de correo a utilizar
        $mail->SMTPAuth = true;                     // Habilitar la autenticacion con SMTP
        $mail->Username = $mail_username;          // Correo electronico saliente ejemplo: tucorreo@gmail.com
        $mail->Password = $mail_userpassword; 		// Tu contraseña de gmail
        $mail->SMTPSecure = 'tls';                  // Habilitar encriptacion, `ssl` es aceptada
        $mail->Port = 587;                          // Puerto TCP  para conectarse
        $mail->setFrom($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe aparecer el correo electrónico. Puede utilizar cualquier dirección que el servidor SMTP acepte como válida. El segundo parámetro opcional para esta función es el nombre que se mostrará como el remitente en lugar de la dirección de correo electrónico en sí.
        $mail->addReplyTo($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe responder. El segundo parámetro opcional para esta función es el nombre que se mostrará para responder
        $mail->addAddress($mail_addAddress);   // Agregar quien recibe el e-mail enviado
        $message = "hola";
        $message = str_replace('{{first_name}}', $mail_setFromName, $message);
        $message = str_replace('{{message}}', $txt_message, $message);
        $message = str_replace('{{customer_email}}', $mail_setFromEmail, $message);
        $mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
        
        $mail->Subject = $mail_subject;
        $mail->msgHTML($message);
        if(!$mail->send()) {
            echo '<p style="color:red">No se pudo enviar el mensaje..';
            echo 'Error de correo: ' . $mail->ErrorInfo."</p>";
        } else {
            echo '<p style="color:green">Tu mensaje ha sido enviado!</p>';
        }
    }
}