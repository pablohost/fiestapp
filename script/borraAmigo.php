<?php
header('Content-Type: application/json; charset=utf-8');
session_start();

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

// conectar la base da datos 

$config = parse_ini_file('config.ini');

$host = 'localhost'; 
$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// iniciar transacción 
$conn->beginTransaction();

try {
	$sql = 'DELETE FROM Amigos 
			WHERE Amigos.indUsu=:valUsu
            AND Amigos.indAmi=:valAmi
            AND Amigos.estado=0;'; 
	$result = $conn->prepare($sql); 
	$result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT);
	$result->bindValue(':valAmi', $x, PDO::PARAM_INT);
	$result->execute();

	$sql = 'DELETE FROM Amigos 
			WHERE Amigos.indUsu=:valAmi
            AND Amigos.indAmi=:valUsu
            AND Amigos.estado=0;'; 
	$result = $conn->prepare($sql); 
	$result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT);
	$result->bindValue(':valAmi', $x, PDO::PARAM_INT);
	$result->execute();

	$conn->commit(); 

	echo json_encode(arreglo('Eliminado correctamente',0), JSON_FORCE_OBJECT);
	die();

} catch (PDOException $e) { 
	// si ocurre un error hacemos rollback para anular todos los insert 
	$conn->rollback(); 
	//echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
	//die();
	echo $e->getMessage();
}

?>