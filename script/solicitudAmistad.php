<?php
header('Content-Type: application/json; charset=utf-8');
session_start();

function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}
$mensaje="";
// conectar la base da datos 

$config = parse_ini_file('config.ini');

$host = 'localhost'; 
$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// iniciar transacción 
$conn->beginTransaction();

try {
	if ($_POST["modo"]==0) {
		# code...
		// MOSTRAMOS TODAS LAS SOLICITUDES
		$sql = 'SELECT Usuarios.ind,Usuarios.nombre,Usuarios.apelli
	            FROM Amigos
                INNER JOIN Usuarios ON Usuarios.ind = Amigos.indUsu
	            WHERE Amigos.indAmi=:valUsu
	            AND Amigos.estado=1;';

		$result = $conn->prepare($sql); 
	    $result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT); 
		// Especificamos el fetch mode antes de llamar a fetch()FETCH_BOTH
		$result->setFetchMode(PDO::FETCH_BOTH);
		// Ejecutamos
		$result->execute();
		$filas=$result->rowCount();
	    if ($filas!=0) {
	    	while ($row = $result->fetch()){
                $indiceAmi=$row[0];
                $nombreAmi=$row[1].' '.$row[2];
                $mensaje .= '
				<div class="col-12 my-2 py-2" style="background-color: rgba(255,255,255,.8);border-radius: 10px;">
					<div class="container-fluid text-center">
						<div class="row">
							<div class="col-6 col-sm-8 col-md-10 text-left">
								<a href="comunidad?perfil='.$nombreAmi.'&tipo=1&ind='.$indiceAmi.'" style="color: black;">
									<h4 class="mb-0" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">'.$nombreAmi.'</h4>
								</a>
							</div>
							<div class="col-3 col-sm-2 col-md-1 centro">
								<a href="#" role="button" class="btn btn-success btn-sm" style="font-weight: bold;" id="btnAceptaAmigo" data-ind="'.$indiceAmi.'">
			                        <i class="fas fa-check"></i>
			                    </a>
							</div>
							<div class="col-3 col-sm-2 col-md-1 centro">
								<a href="#" role="button" class="btn btn-danger btn-sm" style="font-weight: bold;" id="btnRechazaAmigo" data-ind="'.$indiceAmi.'">
			                        <i class="fas fa-times"></i>
			                    </a>
							</div>
						</div>
					</div>
				</div>';
            }
	        $conn->commit();
	        echo json_encode(arreglo($mensaje,0), JSON_FORCE_OBJECT);
	        die();
	    }else{
	    	$mensaje .= '<div class="col-12"><h5>No hay</h5></div>';
			$conn->commit();
	        echo json_encode(arreglo($mensaje,1), JSON_FORCE_OBJECT);
	        die();
	    }
	}elseif ($_POST["modo"]==1) {
		# code...
		// ACEPTAMOS LA SOLICITUD
		$sql = 'UPDATE Amigos
	            SET Amigos.estado=0
	            WHERE Amigos.indUsu=:valUsu 
	            OR Amigos.indUsu=:valAmi;';

		$result = $conn->prepare($sql); 
	    $result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT); 
	    $result->bindValue(':valAmi', $_POST['ind'], PDO::PARAM_INT); 
		// Especificamos el fetch mode antes de llamar a fetch()FETCH_BOTH
		$result->setFetchMode(PDO::FETCH_BOTH);
		// Ejecutamos
		$result->execute();
		$conn->commit();
        echo json_encode(arreglo('Amigo Agregado',0), JSON_FORCE_OBJECT);
        die();
	}elseif ($_POST["modo"]==2) {
		# code...
		// BORRAMOS LA SOLICITUD
		$sql = 'DELETE FROM Amigos
	            WHERE Amigos.indUsu=:valUsu 
	            OR Amigos.indUsu=:valAmi;';

		$result = $conn->prepare($sql); 
	    $result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT); 
	    $result->bindValue(':valAmi', $_POST['ind'], PDO::PARAM_INT); 
		// Especificamos el fetch mode antes de llamar a fetch()FETCH_BOTH
		$result->setFetchMode(PDO::FETCH_BOTH);
		// Ejecutamos
		$result->execute();
		$conn->commit();
        echo json_encode(arreglo('Solicitud Eliminada',0), JSON_FORCE_OBJECT);
        die();
	}

} catch (PDOException $e) { 
	// si ocurre un error hacemos rollback para anular todos los insert 
	$conn->rollback(); 
	//echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
	//die();
	echo $e->getMessage();
}

?>