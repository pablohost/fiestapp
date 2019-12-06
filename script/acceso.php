<?php
header('Content-Type: application/json; charset=utf-8');
//Conectamos a la base de datos
require('conexion.php');
mysqli_set_charset($connection,"utf8");

//cuenteo
function arreglo($msg,$cod,$nom,$tip,$ind){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod,
		'nom' => $nom,
		'tip' => $tip,
		'ind' => $ind
	);
}

//Obtenemos los datos del formulario de acceso
$userPOST = $_POST["mailAcceso"]; 
$passPOST = $_POST["passAcceso"];

//Filtro anti-XSS
//$userPOST = htmlspecialchars(mysqli_real_escape_string($connection, $userPOST));
//$passPOST = htmlspecialchars(mysqli_real_escape_string($connection, $passPOST));

//Definimos la cantidad máxima de caracteres
//Esta comprobación se tiene en cuenta por si se llegase a modificar el "maxlength" del formulario
//Los valores deben coincidir con el tamaño máximo de la fila de la base de datos
$maxCaracteresUsername = "120";
$maxCaracteresPassword = "30";

//Si los input son de mayor tamaño, se "muere" el resto del código y muestra la respuesta correspondiente
if(strlen($userPOST) > $maxCaracteresUsername) {
	echo json_encode(arreglo('El correo electronico no puede superar los '.$maxCaracteresUsername.' caracteres',1,"Error","Error","Error"), JSON_FORCE_OBJECT);
	die();
};

if(strlen($passPOST) > $maxCaracteresPassword) {
	echo json_encode(arreglo('La contraseña no puede superar los '.$maxCaracteresPassword.' caracteres',1,"Error","Error","Error"), JSON_FORCE_OBJECT);
	die();
};

//Pasamos el input del usuario a minúsculas para compararlo después con
//el campo "usernamelowercase" de la base de datos
$userPOSTMinusculas = strtolower($userPOST);


//Escribimos la consulta necesaria
$consulta = "SELECT Usuarios.correo,Usuarios.clave,Usuarios.nombre,Usuarios.apelli,Usuarios.indTip,Usuarios.ind FROM Usuarios WHERE Usuarios.correo='".$userPOSTMinusculas."'";

//Obtenemos los resultados
$resultado = mysqli_query($connection, $consulta);
$datos = mysqli_fetch_array($resultado);

//Guardamos los resultados del nombre de usuario en minúsculas
//y de la contraseña de la base de datos
$userBD = $datos['correo'];
$passwordBD = $datos['clave'];

//Comprobamos si los datos son correctos
if($userBD == $userPOSTMinusculas and password_verify($passPOST, $passwordBD)){

	session_start();
	$_SESSION['usuario'] = $datos['correo'];
	$_SESSION['estado'] = 'Autenticado';
	$_SESSION['nombre'] = $datos['nombre'].' '.$datos['apelli'];
	$_SESSION['tipo'] = $datos['indTip'];
	$_SESSION['objetivo'] = $datos['ind'];

	echo json_encode(arreglo('Datos Correctos',0,$_SESSION['nombre'],$datos['indTip'],$datos['ind']), JSON_FORCE_OBJECT);
	die();

	/* Sesión iniciada, si se desea, se puede redireccionar desde el servidor */

//Si los datos no son correctos, o están vacíos, muestra un error
//Además, hay un script que vacía los campos con la clase "acceso" (formulario)
} else if ( $userBD != $userPOSTMinusculas || $userPOST == "" || $passPOST == "" || !password_verify($passPOST, $passwordBD) ) {
	echo json_encode(arreglo('Los datos de acceso son incorrectos',1,"Error","Error","Error"), JSON_FORCE_OBJECT);
	die();
} else {
	echo json_encode(arreglo('Error Fatal',1,"Error","Error","Error"), JSON_FORCE_OBJECT);
	die();
};
?>