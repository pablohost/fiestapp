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

//Obtenemos los datos del formulario de acceso
$userPOST = $_POST["mailAcceso"]; 

//Filtro anti-XSS
//$userPOST = htmlspecialchars(mysqli_real_escape_string($connection, $userPOST));
//$passPOST = htmlspecialchars(mysqli_real_escape_string($connection, $passPOST));

//Definimos la cantidad máxima de caracteres
//Esta comprobación se tiene en cuenta por si se llegase a modificar el "maxlength" del formulario
//Los valores deben coincidir con el tamaño máximo de la fila de la base de datos
$maxCaracteresUsername = "120";

//Si los input son de mayor tamaño, se "muere" el resto del código y muestra la respuesta correspondiente
if(strlen($userPOST) > $maxCaracteresUsername) {
	echo json_encode(arreglo('El correo electronico no puede superar los '.$maxCaracteresUsername.' caracteres',1), JSON_FORCE_OBJECT);
	die();
};

//Pasamos el input del usuario a minúsculas para compararlo después con
//el campo "usernamelowercase" de la base de datos
$userPOSTMinusculas = strtolower($userPOST);


//Escribimos la consulta necesaria
$consulta = "SELECT Usuarios.seg,Usuarios.ind FROM Usuarios WHERE Usuarios.correo='".$userPOSTMinusculas."' AND Usuarios.estado=0";

//Obtenemos los resultados
$resultado = mysqli_query($connection, $consulta);

$filas = mysqli_num_rows($resultado);


//Si no existe ninguna fila, entonces mostramos el siguiente mensaje
if ($filas === 0) {

	echo json_encode(arreglo('No existen cuentas activas con el correo electronico indicado',1), JSON_FORCE_OBJECT);
	die();

} else {

	//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
	while($datos = mysqli_fetch_array($resultado)) {
		//Guardamos los resultados del codigo de seguridad en una url
		$codSeg = $datos[0];
		$codInd = $datos[1];

	};//Fin while $datos

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
	    $mail->addAddress($_POST["mailAcceso"]);     // Add a recipient

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'RECUPERAR CLAVE';
	    $mail->Body    = '
	    <html>
	    <head></head>
	    <body>
	    <h1>Solicitud de recuperacion de clave</h1>
	    <hr>
	    <h3>Haz click en el siguiente link, si no puedes, copialo y pegalo en tu navegador, entonces podras ingresar una nueva clave para tu cuenta</h3>
	    <a href="http://www.fiestapp.tk/nuevaClave.php?x='.$codSeg.'&z='.$codInd.'">http://www.fiestapp.tk/nuevaClave.php?x='.$codSeg.'&z='.$codInd.'</a>
	    <hr>
	    </body>
	    </html>';

	    $mail->AltBody    = 'Solicitud de recuperacion de clave \n Haz click en el siguiente link, si no puedes, copialo y pegalo en tu navegador, entonces podras ingresar una nueva clave para tu cuenta \n http://www.fiestapp.tk/nuevaClave.php?x='.$codSeg.'&z='.$codInd;
	    

	    $mail->send();
	    echo json_encode(arreglo('Listo',0), JSON_FORCE_OBJECT);
		die();

	} catch (Exception $e) {

	    //header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	    //echo json_encode(arreglo('Perfil Creado',0), JSON_FORCE_OBJECT);
		//die();
		echo $e->getMessage();

	}


}; //Fin else $filas


?>