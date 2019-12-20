<?php
header('Content-Type: application/json; charset=utf-8');
//Iniciamos la sesión
session_start();
//cuenteo
function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}

if(isset($_POST["IndRecinto"])) {

	//Y definimos el máximo que se puede subir
	//Por defecto el máximo es de 2 MB, pero se puede aumentar desde el .htaccess o en la directiva 'upload_max_filesize' en el php.ini



	//$tamañoMaximoKB = "12288"; //Tamaño máximo expresado en KB
	$tamañoMaximoBytes = 2097152; // -> 2097152 Bytes -> 2 MB --- 12582912 Bytes -> 12 MB

	//revisamos si se subieron nuevas fotos al recinto
	if ($_FILES['FotoRec1']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec1']['type']);
		$rutaRec1="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec1']['name'];
		$tamañoArchivo = $_FILES['FotoRec1']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec2'])&&$_FILES['FotoRec2']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec2']['type']);
		$rutaRec2="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec2']['name'];
		$tamañoArchivo = $_FILES['FotoRec2']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec3'])&&$_FILES['FotoRec3']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec3']['type']);
		$rutaRec3="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec3']['name'];
		$tamañoArchivo = $_FILES['FotoRec3']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec4'])&&$_FILES['FotoRec4']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec4']['type']);
		$rutaRec4="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec4']['name'];
		$tamañoArchivo = $_FILES['FotoRec4']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec5'])&&$_FILES['FotoRec5']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec5']['type']);
		$rutaRec5="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec5']['name'];
		$tamañoArchivo = $_FILES['FotoRec5']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec6'])&&$_FILES['FotoRec6']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec6']['type']);
		$rutaRec6="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec6']['name'];
		$tamañoArchivo = $_FILES['FotoRec6']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec7'])&&$_FILES['FotoRec7']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec7']['type']);
		$rutaRec7="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec7']['name'];
		$tamañoArchivo = $_FILES['FotoRec7']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec8'])&&$_FILES['FotoRec8']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec8']['type']);
		$rutaRec8="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec8']['name'];
		$tamañoArchivo = $_FILES['FotoRec8']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec9'])&&$_FILES['FotoRec9']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec9']['type']);
		$rutaRec9="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec9']['name'];
		$tamañoArchivo = $_FILES['FotoRec9']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec10'])&&$_FILES['FotoRec10']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec10']['type']);
		$rutaRec10="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec10']['name'];
		$tamañoArchivo = $_FILES['FotoRec10']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	
	// conectar la base da datos 

	$config = parse_ini_file('config.ini');

	$host = 'localhost'; 
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 

	//reviso si en un recinto nuevo o se actualiza uno antiguo
	$indiceLocal=$_POST["IndRecinto"];
	//tabla Galeria del Recinto
		if (isset($rutaRec1)) {
			# code...
			$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
				$result = $conn->prepare($sql); 
				$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
				$result->bindValue(':valImg', $rutaRec1, PDO::PARAM_STR);
				$result->execute();
			move_uploaded_file($_FILES['FotoRec1']['tmp_name'], "../".$rutaRec1);
		}
		if (isset($rutaRec2)) {
			# code...
			$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
				$result = $conn->prepare($sql); 
				$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
				$result->bindValue(':valImg', $rutaRec2, PDO::PARAM_STR);
				$result->execute();
			move_uploaded_file($_FILES['FotoRec2']['tmp_name'], "../".$rutaRec2);
		}
		if (isset($rutaRec3)) {
			# code...
			$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
				$result = $conn->prepare($sql); 
				$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
				$result->bindValue(':valImg', $rutaRec3, PDO::PARAM_STR);
				$result->execute();
			move_uploaded_file($_FILES['FotoRec3']['tmp_name'], "../".$rutaRec3);
		}
		if (isset($rutaRec4)) {
			# code...
			$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
				$result = $conn->prepare($sql); 
				$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
				$result->bindValue(':valImg', $rutaRec4, PDO::PARAM_STR);
				$result->execute();
			move_uploaded_file($_FILES['FotoRec4']['tmp_name'], "../".$rutaRec4);
		}
		if (isset($rutaRec5)) {
			# code...
			$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
				$result = $conn->prepare($sql); 
				$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
				$result->bindValue(':valImg', $rutaRec5, PDO::PARAM_STR);
				$result->execute();
			move_uploaded_file($_FILES['FotoRec5']['tmp_name'], "../".$rutaRec5);
		}
		if (isset($rutaRec6)) {
			# code...
			$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
				$result = $conn->prepare($sql); 
				$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
				$result->bindValue(':valImg', $rutaRec6, PDO::PARAM_STR);
				$result->execute();
			move_uploaded_file($_FILES['FotoRec6']['tmp_name'], "../".$rutaRec6);
		}
		if (isset($rutaRec7)) {
			# code...
			$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
				$result = $conn->prepare($sql); 
				$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
				$result->bindValue(':valImg', $rutaRec7, PDO::PARAM_STR);
				$result->execute();
			move_uploaded_file($_FILES['FotoRec7']['tmp_name'], "../".$rutaRec7);
		}
		if (isset($rutaRec8)) {
			# code...
			$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
				$result = $conn->prepare($sql); 
				$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
				$result->bindValue(':valImg', $rutaRec8, PDO::PARAM_STR);
				$result->execute();
			move_uploaded_file($_FILES['FotoRec8']['tmp_name'], "../".$rutaRec8);
		}
		if (isset($rutaRec9)) {
			# code...
			$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
				$result = $conn->prepare($sql); 
				$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
				$result->bindValue(':valImg', $rutaRec9, PDO::PARAM_STR);
				$result->execute();
			move_uploaded_file($_FILES['FotoRec9']['tmp_name'], "../".$rutaRec9);
		}
		if (isset($rutaRec10)) {
			# code...
			$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
				$result = $conn->prepare($sql); 
				$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
				$result->bindValue(':valImg', $rutaRec10, PDO::PARAM_STR);
				$result->execute();
			move_uploaded_file($_FILES['FotoRec10']['tmp_name'], "../".$rutaRec10);
		}
		

		$conn->commit(); 

		//cargamos las nuevas fotos del recinto

		echo json_encode(arreglo('La galeria se actualizo',0), JSON_FORCE_OBJECT);
		die();

	} catch (PDOException $e) { 
	// si ocurre un error hacemos rollback para anular todos los insert 
	$conn->rollback(); 
	//echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
	//die();
	echo $e->getMessage();
	}

}else{
	echo json_encode(arreglo('Error Inesperado',1), JSON_FORCE_OBJECT);
	die();
};//Fin condicional para saber si todos los campos necesarios están completos


?>