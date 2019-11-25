<?php
header('Content-Type: application/json; charset=utf-8');
//cuenteo
function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}

if(isset($_POST["Nombre"]) && isset($_POST["Apelli"]) && isset($_POST["Correo"]) && isset($_POST["Clave1"]) && isset($_POST["Clave2"]) && isset($_POST["Genero"]) && isset($_POST["Edad"]) && isset($_POST["Fono"]) && isset($_POST["TipoU"])) {
	// se encripta la clave
	$Clave=password_hash($_POST["Clave1"], PASSWORD_DEFAULT);

	// conectar la base da datos 

	$config = parse_ini_file('config.ini');

	$host = 'localhost'; 
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host,$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 
	// tabla 1 
	$sql = 'INSERT INTO Usuarios(indTip,indGen,priv,correo,clave,nombre,apelli,fono,edad,estado) VALUES (:valTipo,:valGen,:valPriv,:valCor,:valCla,:valNom,:valApe,:valFono,:valEdad,:valEst);'; 
	$result = $conn->prepare($sql); 
	$result->bindValue(':valTipo', $_POST["TipoU"], PDO::PARAM_INT);
	$result->bindValue(':valGen', $_POST["Genero"], PDO::PARAM_INT);
	$result->bindValue(':valPriv', 0, PDO::PARAM_INT);
	$result->bindValue(':valCor', $_POST["Correo"], PDO::PARAM_STR);
	$result->bindValue(':valCla', $Clave, PDO::PARAM_STR);
	$result->bindValue(':valNom', $_POST["Nombre"], PDO::PARAM_STR);
	$result->bindValue(':valApe', $_POST["Apelli"], PDO::PARAM_STR);
	$result->bindValue(':valFono', $_POST["Fono"], PDO::PARAM_STR);
	$result->bindValue(':valEdad', $_POST["Edad"], PDO::PARAM_INT);
	$result->bindValue(':valEst', 0, PDO::PARAM_INT);
	$result->execute(); 
	$conn->commit(); 

	echo json_encode(arreglo('Perfil Creado',0), JSON_FORCE_OBJECT);
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