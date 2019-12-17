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

if(isset($_POST["dn"])&&isset($_POST["indicePerfil"])&&isset($_POST["indiceEvento"])) {

	//se revisa si existe descripcion de la denuncia
	$descripcion="";
	if (isset($_POST["DescDen"])) {
		# code...
		$descripcion=$_POST["DescDen"];
	}
	//**********COMPROBAR SI EL USUARIO YA DENUNCIO EL EVENTO
	// conectar la base da datos 

	$config = parse_ini_file('config.ini');

	$host = 'localhost'; 
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host,$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 

		// BUSCAMOS SI EL USUARIO YA DENUNCIO EL EVENTO
		$sql = 'SELECT Sinapsis.ind 
		FROM Sinapsis 
		WHERE Sinapsis.indUsu = :valUsu
		AND Sinapsis.indEve = :valEve
		AND Sinapsis.nivel = 3';

		$result = $conn->prepare($sql); 
		$result->bindValue(':valUsu', $_POST["indicePerfil"], PDO::PARAM_INT); 
		$result->bindValue(':valEve', $_POST["indiceEvento"], PDO::PARAM_INT); 
		// Especificamos el fetch mode antes de llamar a fetch()
		$result->setFetchMode(PDO::FETCH_ASSOC);
		// Ejecutamos
		$result->execute();
		//Comprobamos si encontro el registro
	    $filas=$result->rowCount();
	    if ($filas!=0) {
	    	# code...
	    	echo json_encode(arreglo('Ya denunciaste este evento',2), JSON_FORCE_OBJECT);
			die();
	    }

		// tabla Sinapsis
		$sql = 'INSERT INTO Sinapsis(indUsu,indEve,nivel) VALUES (:valUsu,:valEve,:valNiv);'; 
		$result = $conn->prepare($sql); 
		$result->bindValue(':valUsu', $_POST["indicePerfil"], PDO::PARAM_INT);
		$result->bindValue(':valEve', $_POST["indiceEvento"], PDO::PARAM_INT);
		$result->bindValue(':valNiv', 3, PDO::PARAM_INT);
		$result->execute(); 
		$lastIdSin = $conn->lastInsertId();

		// tabla Estacionamientos
		$sql = 'INSERT INTO Denuncias(indSin,indCat,des,estado) VALUES (:valSin,:valCat,:valDes,:valEst);'; 
		$result = $conn->prepare($sql); 
		$result->bindValue(':valSin', $lastIdSin, PDO::PARAM_INT);
		$result->bindValue(':valCat', $_POST["dn"], PDO::PARAM_INT);
		$result->bindValue(':valDes', $descripcion, PDO::PARAM_STR);
		$result->bindValue(':valEst', 0, PDO::PARAM_INT);
		$result->execute(); 

		$conn->commit(); 

		echo json_encode(arreglo('Evento Denunciado',0), JSON_FORCE_OBJECT);
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
