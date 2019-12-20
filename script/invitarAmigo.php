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

if(isset($_POST["x"])&&isset($_POST["z"])) {

	//**********
	// conectar la base da datos 

	$config = parse_ini_file('config.ini');

	$host = 'localhost'; 
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host,$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 

		// COMPROBAR SI EL USUARIO YA FUE INVITADO
		$sql = 'SELECT Invitaciones.ind 
		FROM Invitaciones 
		WHERE Invitaciones.indAnf = :valUsu
		AND Invitaciones.indInv = :valInv
		AND Invitaciones.indEve = :valEve';

		$result = $conn->prepare($sql); 
		$result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT); 
		$result->bindValue(':valInv', $_POST["x"], PDO::PARAM_INT); 
		$result->bindValue(':valEve', $_POST["z"], PDO::PARAM_INT); 
		// Especificamos el fetch mode antes de llamar a fetch()
		$result->setFetchMode(PDO::FETCH_BOTH);
		// Ejecutamos
		$result->execute();
		//Comprobamos si encontro el registro
	    $filas=$result->rowCount();
	    if ($filas!=0) {
	    	# code...
	    	echo json_encode(arreglo('Ya haz invitado a este amigo',1), JSON_FORCE_OBJECT);
			die();
	    }else{
	    	// tabla Sinapsis
			$sql = 'INSERT INTO Invitaciones(indAnf,indInv,indEve) VALUES (:valUsu,:valInv,:valEve);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT); 
			$result->bindValue(':valInv', $_POST["x"], PDO::PARAM_INT); 
			$result->bindValue(':valEve', $_POST["z"], PDO::PARAM_INT); 
			$result->execute(); 

			$conn->commit(); 

			echo json_encode(arreglo('Amigo Invitado',0), JSON_FORCE_OBJECT);
			die();
	    }
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