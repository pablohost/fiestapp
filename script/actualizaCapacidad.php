<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
//cuenteo
function arreglo($msg,$cod,$cap){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod,
		'cap' => $cap
	);
}
if (isset($_POST['IndEvento'])&&isset($_POST['CapacidadUso'])&&isset($_POST['Modo'])) {
	# code...
	// conectar la base da datos 

	$config = parse_ini_file('config.ini');

	$host = 'localhost'; 
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 
		$fechaNow = time()-10800;
		$fechaNow = date("Y-m-d H:i:s", $fechaNow);
	    // BUSCAMOS LA CAPACIDAD DEL EVENTO
	    $sql = 'SELECT CapPersonas.max,CapPersonas.uso
	            FROM Eventos
	            INNER JOIN Locales ON Locales.ind = Eventos.indLoc
	            INNER JOIN CapPersonas ON CapPersonas.ind = Locales.indCap
	            WHERE  Eventos.ind =:valInd
	            AND Eventos.fecIni < :valNow
            	AND Eventos.fecFin > :valNow;';

        $result = $conn->prepare($sql); 
	    $result->bindValue(':valInd', $_POST["IndEvento"], PDO::PARAM_INT); 
	    $result->bindValue(':valNow', $fechaNow, PDO::PARAM_STR);
	    // Especificamos el fetch mode antes de llamar a fetch()
	    $result->setFetchMode(PDO::FETCH_BOTH);
	    // Ejecutamos
	    $result->execute();
	    //Comprobamos si encontro el registro
	    $filas=$result->rowCount();
	    if ($filas!=0) {
	        # code...
	        while ($row = $result->fetch()){
	            $max=$row[0];
	        	$uso=$row[1];
	        }
	        if ($_POST['Modo']==0) {
	        	# code...
	        	$nuevoUso=$uso+$_POST['CapacidadUso'];
		        if ($nuevoUso>$max) {
		        	# code...
		        	echo json_encode(arreglo("Se agregaron mas asistentes que el maximo establecido",1,0), JSON_FORCE_OBJECT);
		        	die();
		        }else{
		        	$sql = 'UPDATE Eventos
					INNER JOIN Locales ON Locales.ind = Eventos.indLoc
					INNER JOIN CapPersonas ON CapPersonas.ind = Locales.indCap
					SET CapPersonas.uso=:valUso
					WHERE  Eventos.ind =:valInd;';

				    $result = $conn->prepare($sql); 
				    $result->bindValue(':valInd', $_POST["IndEvento"], PDO::PARAM_INT);
				    $result->bindValue(':valUso', $nuevoUso, PDO::PARAM_INT); 
				    // Ejecutamos
				    $result->execute();
				    $conn->commit();
				    echo json_encode(arreglo("Capacidad Actualizada",0,$nuevoUso), JSON_FORCE_OBJECT);
			        die();
		        }
	        }else if ($_POST['Modo']==1) {
	        	# code...
	        	$nuevoUso=$uso-$_POST['CapacidadUso'];
		        if ($nuevoUso<0) {
		        	# code...
		        	echo json_encode(arreglo("Se quitaron mas asistentes de los que estan",1,0), JSON_FORCE_OBJECT);
		        	die();
		        }else{
		        	$sql = 'UPDATE Eventos
					INNER JOIN Locales ON Locales.ind = Eventos.indLoc
					INNER JOIN CapPersonas ON CapPersonas.ind = Locales.indCap
					SET CapPersonas.uso=:valUso
					WHERE  Eventos.ind =:valInd;';

				    $result = $conn->prepare($sql); 
				    $result->bindValue(':valInd', $_POST["IndEvento"], PDO::PARAM_INT);
				    $result->bindValue(':valUso', $nuevoUso, PDO::PARAM_INT); 
				    // Ejecutamos
				    $result->execute();
				    $conn->commit();
				    echo json_encode(arreglo("Capacidad Actualizada",0,$nuevoUso), JSON_FORCE_OBJECT);
			        die();
		        }
	        }
	        
	    }else{
	        echo json_encode(arreglo("ERROR",1,0), JSON_FORCE_OBJECT);
	        die();
	    }
	} catch (PDOException $e) { 
	    // si ocurre un error hacemos rollback para anular todos los insert 
	    $conn->rollback(); 
	    //echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
	    //die();
	    echo $e->getMessage();
	}
}

?>