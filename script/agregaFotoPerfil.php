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
//Y definimos el máximo que se puede subir
//Por defecto el máximo es de 2 MB, pero se puede aumentar desde el .htaccess o en la directiva 'upload_max_filesize' en el php.ini



//$tamañoMaximoKB = "12288"; //Tamaño máximo expresado en KB
$tamañoMaximoBytes = 2097152; // -> 2097152 Bytes -> 2 MB --- 12582912 Bytes -> 12 MB

//revisamos si se subieron nuevas fotos al recinto
if ($_FILES['FotoPer1']['error'] === 0) {
	//se define la ruta de la foto
	$formatoFoto=explode("/",$_FILES['FotoPer1']['type']);
	$rutaPer1="galeriaComunidad/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
	$nombreArchivo = $_FILES['FotoPer1']['name'];
	$tamañoArchivo = $_FILES['FotoPer1']['size']; //Obtenemos el tamaño del archivo en Bytes
	//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
	if($tamañoArchivo > $tamañoMaximoBytes) {
		echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
		die();
	}
}
if (isset($_FILES['FotoPer2'])&&$_FILES['FotoPer2']['error'] === 0) {
	//se define la ruta de la foto
	$formatoFoto=explode("/",$_FILES['FotoPer2']['type']);
	$rutaPer2="galeriaComunidad/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
	$nombreArchivo = $_FILES['FotoPer2']['name'];
	$tamañoArchivo = $_FILES['FotoPer2']['size']; //Obtenemos el tamaño del archivo en Bytes
	//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
	if($tamañoArchivo > $tamañoMaximoBytes) {
		echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
		die();
	}
}
if (isset($_FILES['FotoPer3'])&&$_FILES['FotoPer3']['error'] === 0) {
	//se define la ruta de la foto
	$formatoFoto=explode("/",$_FILES['FotoPer3']['type']);
	$rutaPer3="galeriaComunidad/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
	$nombreArchivo = $_FILES['FotoPer3']['name'];
	$tamañoArchivo = $_FILES['FotoPer3']['size']; //Obtenemos el tamaño del archivo en Bytes
	//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
	if($tamañoArchivo > $tamañoMaximoBytes) {
		echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
		die();
	}
}
if (isset($_FILES['FotoPer4'])&&$_FILES['FotoPer4']['error'] === 0) {
	//se define la ruta de la foto
	$formatoFoto=explode("/",$_FILES['FotoPer4']['type']);
	$rutaPer4="galeriaComunidad/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
	$nombreArchivo = $_FILES['FotoPer4']['name'];
	$tamañoArchivo = $_FILES['FotoPer4']['size']; //Obtenemos el tamaño del archivo en Bytes
	//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
	if($tamañoArchivo > $tamañoMaximoBytes) {
		echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
		die();
	}
}
if (isset($_FILES['FotoPer5'])&&$_FILES['FotoPer5']['error'] === 0) {
	//se define la ruta de la foto
	$formatoFoto=explode("/",$_FILES['FotoPer5']['type']);
	$rutaPer5="galeriaComunidad/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
	$nombreArchivo = $_FILES['FotoPer5']['name'];
	$tamañoArchivo = $_FILES['FotoPer5']['size']; //Obtenemos el tamaño del archivo en Bytes
	//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
	if($tamañoArchivo > $tamañoMaximoBytes) {
		echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
		die();
	}
}
if (isset($_FILES['FotoPer6'])&&$_FILES['FotoPer6']['error'] === 0) {
	//se define la ruta de la foto
	$formatoFoto=explode("/",$_FILES['FotoPer6']['type']);
	$rutaPer6="galeriaComunidad/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
	$nombreArchivo = $_FILES['FotoPer6']['name'];
	$tamañoArchivo = $_FILES['FotoPer6']['size']; //Obtenemos el tamaño del archivo en Bytes
	//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
	if($tamañoArchivo > $tamañoMaximoBytes) {
		echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
		die();
	}
}
if (isset($_FILES['FotoPer7'])&&$_FILES['FotoPer7']['error'] === 0) {
	//se define la ruta de la foto
	$formatoFoto=explode("/",$_FILES['FotoPer7']['type']);
	$rutaPer7="galeriaComunidad/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
	$nombreArchivo = $_FILES['FotoPer7']['name'];
	$tamañoArchivo = $_FILES['FotoPer7']['size']; //Obtenemos el tamaño del archivo en Bytes
	//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
	if($tamañoArchivo > $tamañoMaximoBytes) {
		echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
		die();
	}
}
if (isset($_FILES['FotoPer8'])&&$_FILES['FotoPer8']['error'] === 0) {
	//se define la ruta de la foto
	$formatoFoto=explode("/",$_FILES['FotoPer8']['type']);
	$rutaPer8="galeriaComunidad/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
	$nombreArchivo = $_FILES['FotoPer8']['name'];
	$tamañoArchivo = $_FILES['FotoPer8']['size']; //Obtenemos el tamaño del archivo en Bytes
	//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
	if($tamañoArchivo > $tamañoMaximoBytes) {
		echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
		die();
	}
}
if (isset($_FILES['FotoPer9'])&&$_FILES['FotoPer9']['error'] === 0) {
	//se define la ruta de la foto
	$formatoFoto=explode("/",$_FILES['FotoPer9']['type']);
	$rutaPer9="galeriaComunidad/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
	$nombreArchivo = $_FILES['FotoPer9']['name'];
	$tamañoArchivo = $_FILES['FotoPer9']['size']; //Obtenemos el tamaño del archivo en Bytes
	//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
	if($tamañoArchivo > $tamañoMaximoBytes) {
		echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
		die();
	}
}
if (isset($_FILES['FotoPer10'])&&$_FILES['FotoPer10']['error'] === 0) {
	//se define la ruta de la foto
	$formatoFoto=explode("/",$_FILES['FotoPer10']['type']);
	$rutaPer10="galeriaComunidad/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
	$nombreArchivo = $_FILES['FotoPer10']['name'];
	$tamañoArchivo = $_FILES['FotoPer10']['size']; //Obtenemos el tamaño del archivo en Bytes
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

	//guardamos el indice del perfil logeado
	$indicePerfil=$_SESSION['objetivo'];
	//tabla Galeria del Recinto
	if (isset($rutaPer1)) {
		# code...
		$sql = 'INSERT INTO GaleriasUsu(indUsu,img) VALUES (:valUsu,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valUsu', $indicePerfil, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaPer1, PDO::PARAM_STR);

			$result->execute();
		move_uploaded_file($_FILES['FotoPer1']['tmp_name'], "../".$rutaPer1);
	}
	if (isset($rutaPer2)) {
		# code...
		$sql = 'INSERT INTO GaleriasUsu(indUsu,img) VALUES (:valUsu,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valUsu', $indicePerfil, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaPer2, PDO::PARAM_STR);

			$result->execute();
		move_uploaded_file($_FILES['FotoPer2']['tmp_name'], "../".$rutaPer2);
	}
	if (isset($rutaPer3)) {
		# code...
		$sql = 'INSERT INTO GaleriasUsu(indUsu,img) VALUES (:valUsu,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valUsu', $indicePerfil, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaPer3, PDO::PARAM_STR);

			$result->execute();
		move_uploaded_file($_FILES['FotoPer3']['tmp_name'], "../".$rutaPer3);
	}
	if (isset($rutaPer4)) {
		# code...
		$sql = 'INSERT INTO GaleriasUsu(indUsu,img) VALUES (:valUsu,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valUsu', $indicePerfil, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaPer4, PDO::PARAM_STR);

			$result->execute();
		move_uploaded_file($_FILES['FotoPer4']['tmp_name'], "../".$rutaPer4);
	}
	if (isset($rutaPer5)) {
		# code...
		$sql = 'INSERT INTO GaleriasUsu(indUsu,img) VALUES (:valUsu,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valUsu', $indicePerfil, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaPer5, PDO::PARAM_STR);

			$result->execute();
		move_uploaded_file($_FILES['FotoPer5']['tmp_name'], "../".$rutaPer5);
	}
	if (isset($rutaPer6)) {
		# code...
		$sql = 'INSERT INTO GaleriasUsu(indUsu,img) VALUES (:valUsu,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valUsu', $indicePerfil, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaPer6, PDO::PARAM_STR);

			$result->execute();
		move_uploaded_file($_FILES['FotoPer6']['tmp_name'], "../".$rutaPer6);
	}
	if (isset($rutaPer7)) {
		# code...
		$sql = 'INSERT INTO GaleriasUsu(indUsu,img) VALUES (:valUsu,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valUsu', $indicePerfil, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaPer7, PDO::PARAM_STR);

			$result->execute();
		move_uploaded_file($_FILES['FotoPer7']['tmp_name'], "../".$rutaPer7);
	}
	if (isset($rutaPer8)) {
		# code...
		$sql = 'INSERT INTO GaleriasUsu(indUsu,img) VALUES (:valUsu,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valUsu', $indicePerfil, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaPer8, PDO::PARAM_STR);

			$result->execute();
		move_uploaded_file($_FILES['FotoPer8']['tmp_name'], "../".$rutaPer8);
	}
	if (isset($rutaPer9)) {
		# code...
		$sql = 'INSERT INTO GaleriasUsu(indUsu,img) VALUES (:valUsu,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valUsu', $indicePerfil, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaPer9, PDO::PARAM_STR);

			$result->execute();
		move_uploaded_file($_FILES['FotoPer9']['tmp_name'], "../".$rutaPer9);
	}
	if (isset($rutaPer10)) {
		# code...
		$sql = 'INSERT INTO GaleriasUsu(indUsu,img) VALUES (:valUsu,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valUsu', $indicePerfil, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaPer10, PDO::PARAM_STR);
			$result->execute();
		move_uploaded_file($_FILES['FotoPer10']['tmp_name'], "../".$rutaPer10);
	}
	

	$conn->commit(); 

	//cargamos las nuevas fotos del recinto

	echo json_encode(arreglo('Listo',0), JSON_FORCE_OBJECT);
	die();

} catch (PDOException $e) { 
// si ocurre un error hacemos rollback para anular todos los insert 
$conn->rollback(); 
//echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
//die();
echo $e->getMessage();
}


?>