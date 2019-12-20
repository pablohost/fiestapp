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

if(isset($_POST["x"])) {

	//**********
	// conectar la base da datos 

	$config = parse_ini_file('config.ini');

	$host = 'localhost'; 
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host,$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 

		// COMPROBAR SI EL USUARIO YA PUSO ASISTIR EN EL EVENTO
		$sql = 'SELECT Sinapsis.ind 
		FROM Sinapsis 
		WHERE Sinapsis.indUsu = :valUsu
		AND Sinapsis.indEve = :valEve
		AND Sinapsis.nivel = 1';

		$result = $conn->prepare($sql); 
		$result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT); 
		$result->bindValue(':valEve', $_POST["x"], PDO::PARAM_INT); 
		// Especificamos el fetch mode antes de llamar a fetch()
		$result->setFetchMode(PDO::FETCH_BOTH);
		// Ejecutamos
		$result->execute();
		//Comprobamos si encontro el registro
	    $filas=$result->rowCount();
	    if ($filas!=0) {
	    	# code...
	    	while ($row = $result->fetch()){
	    		$indiceSinapsis=$row[0];
	    	}
	    	if (isset($_POST["z"])) {
	    		# code...
	    		// tabla Sinapsis
				$sql = 'DELETE FROM Sinapsis WHERE Sinapsis.ind=:valSin;'; 
				$result = $conn->prepare($sql); 
				$result->bindValue(':valSin', $indiceSinapsis, PDO::PARAM_INT);
				$result->execute(); 

				$conn->commit(); 

				echo json_encode(arreglo('Encuentra mas eventos en fiestapp !',0), JSON_FORCE_OBJECT);
				die();
	    	}else{
	    		echo json_encode(arreglo('Tranquilo, Ya sabemos que asistiras a este evento ;)',2), JSON_FORCE_OBJECT);
				die();
			}
	    }else{
	    	if (isset($_POST["z"])) {
	    		# code...
	    		echo json_encode(arreglo('Ya no asistes a este evento o no se encuentra el evento',2), JSON_FORCE_OBJECT);
				die();
	    	}else{
	    		// tabla Sinapsis
				$sql = 'INSERT INTO Sinapsis(indUsu,indEve,nivel) VALUES (:valUsu,:valEve,:valNiv);'; 
				$result = $conn->prepare($sql); 
				$result->bindValue(':valEve', $_POST["x"], PDO::PARAM_INT);
				$result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT);
				$result->bindValue(':valNiv', 1, PDO::PARAM_INT);
				$result->execute(); 

				$conn->commit(); 

				echo json_encode(arreglo('Que lo pases bien !',0), JSON_FORCE_OBJECT);
				die();
			}
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