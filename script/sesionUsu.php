<?php
//Iniciamos la sesión
session_start();

//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);

function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}

//Comprobamos si la sesión está iniciada
//Si existe una sesión correcta, mostramos la página para los usuarios
//Sino, mostramos la página de acceso y registro de usuarios
if(isset($_SESSION['usuario']) and $_SESSION['estado'] == 'Autenticado') {

	unset($_SESSION['usuario']);
	unset($_SESSION['estado']);
	unset($_SESSION['nombre']);
	unset($_SESSION['tipo']);
	
	die(json_encode(arreglo('Sesion Cerrada',0),JSON_UNESCAPED_UNICODE));
} else {
	die(json_encode(arreglo('No se pudo cerrar sesion',1),JSON_UNESCAPED_UNICODE));
};

?>