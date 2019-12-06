<?php

//Iniciamos la sesión
session_start();

//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);

//Comprobamos si la sesión está iniciada
//Si existe una sesión correcta, mostramos la página para los usuarios
//Sino, mostramos la página de acceso y registro de usuarios
if(isset($_SESSION['usuario']) and $_SESSION['estado'] == 'Autenticado') {
	
	if (isset($_GET['perfil'])&&isset($_GET['tipo'])&&isset($_GET['ind'])) {
		# code...
		if ($_SESSION['tipo']==1) {
			# code...
			header("Location: comunidad?perfil=".$_SESSION['nombre']."&tipo=".$_SESSION['tipo']."&ind=".$_SESSION['objetivo']);
	    	die();
		} else if ($_SESSION['tipo']==2){
			# code...
			header("Location: portal?perfil=".$_SESSION['nombre']."&tipo=".$_SESSION['tipo']."&ind=".$_SESSION['objetivo']);
	    	die();
		} else if ($_SESSION['tipo']==3){
			# code...
			include('dios.php');
	    	die();
		}
	}else{
		header("Location: panel?perfil=".$_SESSION['nombre']."&tipo=".$_SESSION['tipo']."&ind=".$_SESSION['objetivo']);
    	die();
	}
    
} else {
    include('login.php');
    die();
};

?>