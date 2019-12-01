<?php 
header('Content-Type: application/json; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Conectamos a la base de datos
require('conexion.php');
mysqli_set_charset($connection,"utf8");

//cuenteo
function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}

//Obtenemos los datos del formulario de nueva clave
$clave = $_POST["passAcceso1"]; 
$seg = $_POST["codSeg"];
$ind = $_POST["codInd"];
$correo = $_POST["correo"];

// se encripta la clave
$claveEnc=password_hash($clave, PASSWORD_DEFAULT);
//se crea nuevo codigo de seguridad para recuperar clave
$neoSeg="fiestapp".rand(100000, 999999);

$consulta = "UPDATE Usuarios SET Usuarios.clave='".$claveEnc."', Usuarios.seg='".$neoSeg."' WHERE Usuarios.ind=".$ind;

if ($connection->query($consulta) === TRUE) {
    $mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
	    $mail->isSMTP();                                            // Set mailer to use SMTP
	    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'acab.contacto@gmail.com';                     // SMTP username
	    $mail->Password   = '123acab456';                               // SMTP password
	    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
	    $mail->Port       = 465;                                    // TCP port to connect to
	    $mail->CharSet = 'UTF-8';

	    //Recipients
	    $mail->setFrom('acab.contacto@gmail.com', 'FIESTAPP - NO RESPONDER');
	    $mail->addAddress($correo);     // Add a recipient

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'SE MODIFICO SU CLAVE';
	    $mail->Body    = '
	    <html>
	    <head></head>
	    <body>
	    <h1>Se modifico su clave satifactoriamente</h1>
	    <hr>
	    Fiestapp - Inacap Puente Alto.
	    <hr>
	    </body>
	    </html>';

	    $mail->AltBody    = 'SE MODIFICO SU CLAVE \n Se modifico su clave satifactoriamente \n Fiestapp - Inacap Puente Alto.';
	    

	    $mail->send();
	    echo json_encode(arreglo('Listo',0), JSON_FORCE_OBJECT);
	  	die();

	} catch (Exception $e) {

    	//header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		echo $e->getMessage();

	}
} else {
    echo json_encode(arreglo('Error Inesperado',1), JSON_FORCE_OBJECT);
  	die();
}


?>