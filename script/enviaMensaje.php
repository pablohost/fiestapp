<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
$x=0;
$x=isset($_POST['indice']) ? $_POST['indice'] : 0;
if ($x===0) {
	# code...
	echo json_encode(arreglo('Error Fatal',1), JSON_FORCE_OBJECT);
	die();
}

function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}

$fechaNow = time()-10800;
$fechaMensaje=date("Y-m-d H:i:s", $fechaNow);

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
	$sql = 'INSERT INTO Mensajes(indEmi,indRec,des,fechaHora) VALUES (:valEmi,:valRec,:valDes,:valFec);'; 
	$result = $conn->prepare($sql); 
	$result->bindValue(':valEmi', intval($indicePerfil), PDO::PARAM_INT);
	$result->bindValue(':valRec', intval($x), PDO::PARAM_INT);
	$result->bindValue(':valDes', $_POST['desMenBR'], PDO::PARAM_STR);
	$result->bindValue(':valFec', $fechaMensaje, PDO::PARAM_STR);

	$result->execute();
	$conn->commit(); 

	echo json_encode(arreglo('Mensaje Enviado',0), JSON_FORCE_OBJECT);
	die();

} catch (PDOException $e) { 
	// si ocurre un error hacemos rollback para anular todos los insert 
	$conn->rollback(); 
	//echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
	//die();
	echo $e->getMessage();
}

?>