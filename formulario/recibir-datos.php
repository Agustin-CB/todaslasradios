<?php

    require_once 'vendor/autoload.php';
    require_once 'correo.php';
    require_once 'vendor/autoload.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $texto = $_POST['texto'];

    $respuesta = [];
    $bandera = true;

    if($nombre == ''){
        $respuesta += ['nombre' => 'Ingrese un nombre'];
        $bandera = false;
    }

    if($email == ''){
        $respuesta += ['email' => 'Ingrese un email'];
        $bandera = false;
    }

    if($telephone == ''){
        $respuesta += ['telephone' => 'Ingrese un numero de telefono valido'];
        $bandera = false;
    }

    if($texto == ''){
        $respuesta += ['texto' => 'Ingrese un Mensaje'];
        $bandera = false;
    }

    if($bandera){
         
        $mail = new PHPMailer(true);
		try {
			//Server settings 
		    // $mail->SMTPDebug = 2;                                       // Enable verbose debug output || para revisar que error nos da
			$mail->isSMTP();                                            // Set mailer to use SMTP
			$mail->Host       = 'mail.todaslasradios.com.ar';  // smtp.gmail.com || si es hotmail buscarlo como smtp hotmail || smtp.live.com etc (atenti con eso)
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication || NO TOCAR
			$mail->Username   = 'consultas@todaslasradios.com.ar';                     // SMTP username || Mail en donde se enviaran los mensajes de los clientes 
			$mail->Password   = 'O-UDO(tdJoe1';                               // SMTP Contraseña que generas desde "seguridad" de GMAIL
			$mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted 
			$mail->Port       = 465;                                    // TCP port to connect to || Puerto donde tenes que revisar en el CPANEL
			//Recipients
			$mail->setFrom('consultas@todaslasradios.com.ar', 'Buenas tardes - Todaslasradios.com.ar'); // tenes que poner tu usuario "nombre de papa" || MAIL EN DONDE SE VA A ENVIAR EL MSJ
			$mail->addAddress('contacto@todaslasradios.com.ar', 'Buenas Estimado'); // a quien se le va a enviar el correo || MAIL A DONDE QUERES QUE LLEGUE EL MSJ!
			// Content
			$mail->Subject = 'Mensaje de un Usuario'; 
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Body    = correo($nombre,$email,$telephone,$texto);
			$mail->CharSet = 'UTF-8';
			$mail->send();
			$respuesta = ['respuesta' => true];
		} catch (Exception $e) {
			$respuesta = ['respuesta' => false];
		}


    }


    echo json_encode($respuesta);

    
   