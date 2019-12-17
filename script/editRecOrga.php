<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
//cuenteo
function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}

if(isset($_POST["Capacidad"]) && isset($_POST["Estacionamiento"]) && isset($_POST["Long"]) && isset($_POST["Lati"]) && isset($_POST["NomLoc"]) && isset($_POST["IndRecinto"])) {

	//se identifica la via de contacto con el recinto
	$fonoLocal="";
	$correoLocal="";
	$webLocal="";
	if ($_POST["FonoLoc"]!="") {
		# code...
		$fonoLocal=$_POST["FonoLoc"];
	}else{
		$fonoLocal="";
	}
	if ($_POST["CorLoc"]!="") {
		# code...
		$correoLocal=$_POST["CorLoc"];
	}else{
		$correoLocal="";
	}
	if ($_POST["WebLoc"]!="") {
		# code...
		$webLocal=$_POST["WebLoc"];
		$webLocal=str_replace("https://", "", $webLocal);
	}else{
		$webLocal="";
	}
	//se identifica si se agrego descripcion al recinto
	$descripcionLoc="";
	if ($_POST["descLocalBR"]!="") {
		# code...
		$descripcionLoc=$_POST["descLocalBR"];
	}else{
		$descripcionLoc="";
	}

	// conectar la base da datos $_SESSION['objetivo']

	$config = parse_ini_file('config.ini');

	$host = 'localhost'; 
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 
		//EDITA RECINTO
		// tabla capPersonas
		$sql = 'UPDATE CapPersonas 
				INNER JOIN Locales ON Locales.indCap = CapPersonas.ind
				INNER JOIN Eventos ON Eventos.indLoc = Locales.ind
				INNER JOIN Sinapsis ON Sinapsis.indEve = Eventos.ind
				INNER JOIN Usuarios ON Usuarios.ind = Sinapsis.indUsu
				SET CapPersonas.max=:valMax
				WHERE Locales.ind = :valLoc
				AND Usuarios.ind = :valUsu;'; 
		$result = $conn->prepare($sql); 
		$result->bindValue(':valMax', $_POST["Capacidad"], PDO::PARAM_INT);
		$result->bindValue(':valLoc', $_POST["IndRecinto"], PDO::PARAM_INT);
		$result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT);
		$result->execute(); 

		// tabla Estacionamientos
		$sql = 'UPDATE Estacionamientos 
				INNER JOIN Locales ON Locales.indCap = Estacionamientos.ind
				INNER JOIN Eventos ON Eventos.indLoc = Locales.ind
				INNER JOIN Sinapsis ON Sinapsis.indEve = Eventos.ind
				INNER JOIN Usuarios ON Usuarios.ind = Sinapsis.indUsu
				SET Estacionamientos.max=:valMax
				WHERE Locales.ind = :valLoc
				AND Usuarios.ind = :valUsu;'; 
		$result = $conn->prepare($sql); 
		$result->bindValue(':valMax', $_POST["Estacionamiento"], PDO::PARAM_INT);
		$result->bindValue(':valLoc', $_POST["IndRecinto"], PDO::PARAM_INT);
		$result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT);
		$result->execute(); 

		// tabla Locales
		$sql = 'UPDATE Locales 
				INNER JOIN Eventos ON Eventos.indLoc = Locales.ind
				INNER JOIN Sinapsis ON Sinapsis.indEve = Eventos.ind
				INNER JOIN Usuarios ON Usuarios.ind = Sinapsis.indUsu
				SET Locales.lon=:valLon, Locales.lat=:valLat, Locales.nombre=:valNom, Locales.des=:valDes, Locales.fono=:valFon, Locales.correo=:valCor, Locales.web=:valWeb 
				WHERE Locales.ind = :valLoc
				AND Usuarios.ind = :valUsu;'; 
		$result = $conn->prepare($sql); 
		$result->bindValue(':valLoc', $_POST["IndRecinto"], PDO::PARAM_INT);
		$result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT);
		$result->bindValue(':valLon', $_POST["Long"], PDO::PARAM_STR);
		$result->bindValue(':valLat', $_POST["Lati"], PDO::PARAM_STR);
		$result->bindValue(':valNom', $_POST["NomLoc"], PDO::PARAM_STR);
		$result->bindValue(':valDes', $descripcionLoc, PDO::PARAM_STR);
		$result->bindValue(':valFon', $fonoLocal, PDO::PARAM_STR);
		$result->bindValue(':valCor', $correoLocal, PDO::PARAM_STR);
		$result->bindValue(':valWeb', "https://".$webLocal, PDO::PARAM_STR);
		$result->execute(); 
		$lastIdLoc = $conn->lastInsertId();
		$indiceLocal=$lastIdLoc;
		

		$conn->commit(); 

		echo json_encode(arreglo('Recinto Editado',0), JSON_FORCE_OBJECT);
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