<?php
$x=0;
$x=isset($_GET['indice']) ? $_GET['indice'] : 0;
if ($x===0) {
	# code...
	echo json_encode(arreglo('no mandaa',0), JSON_FORCE_OBJECT);
	die();
}

function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}

//Archivo de conexión a la base de datos
require('conexion.php');
mysqli_set_charset($connection,"utf8");

$consulta = mysqli_query($connection, 
	"UPDATE Eventos SET Eventos.estado=1 WHERE Eventos.ind=".$x.";");

if ($consulta) {
	# code...
	echo json_encode(arreglo('Eliminado correctamente',0), JSON_FORCE_OBJECT);
	die();
	
} else {
	# code...
	echo json_encode(arreglo('No se pudo eliminar o ya no existe',1), JSON_FORCE_OBJECT);
	die();
}

?>