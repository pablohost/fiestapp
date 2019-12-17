<?php
session_start();
header('charset=utf-8');
//Variable vacía (para evitar los E_NOTICE)
setlocale(LC_TIME, 'es_CL.UTF-8');
if(isset($_POST["x"])&&isset($_POST["y"])&&isset($_POST["z"])){
	$mensaje="";

	// conectar la base da datos 

	$config = parse_ini_file('config.ini');

	$host = 'localhost'; 
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 

	// BUSCAMOS EL CORREO
	$sql = 'SELECT Usuarios.nombre,Usuarios.apelli,Usuarios.foto,Usuarios.indTip
		FROM Usuarios
        WHERE Usuarios.ind=:valInd';

	$result = $conn->prepare($sql);  
	$result->bindValue(':valInd', $_POST["x"], PDO::PARAM_INT);
	// Especificamos el fetch mode antes de llamar a fetch()
	$result->setFetchMode(PDO::FETCH_ASSOC);
	// Ejecutamos
	$result->execute();
	//Comprobamos si encontro el evento activo
    $filas=$result->rowCount();
    if ($filas!=0) {
    	// Mostramos los resultados
		while ($row = $result->fetch()){
			$nombreCompleto=$row['nombre'].' '.$row['apelli'];
			if ($_POST["y"]==$nombreCompleto&&$_POST["z"]==$row['indTip']) {
				# code...
				$mensaje .= '
					<div class="row pt-5">
						<div class="col-12">
							<div class="container">
								<div class="row">
									<div class="col-12 col-md-4">
										<img src="'.$row['foto'].'" style="max-width: 100%;max-height: 180px;border-radius: 200px;">
									</div>
									<div class="col-12 col-md-8">
										<h1 class="pt-5" id="nombrePerfil">'.$nombreCompleto.'</h1>
									</div>
								</div>
							</div>	
						</div>
					</div>';
			}else{
				echo '<div class="row">
				            <div class="col-12 pt-5">
				                <h1>PERFIL NO SE ENCUENTRA O NO EXISTE</h1>
				                <h2><a href="portal?perfil='.$_SESSION['nombre'].'&tipo='.$_SESSION['tipo'].'&ind='.$_SESSION['objetivo'],'">VOLVER</a></h2>
				            </div>
				        </div>';
			}
			
		}
		echo $mensaje;
    }else{
    	echo '<div class="row">
            <div class="col-12 pt-5">
                <h1>PERFIL NO SE ENCUENTRA O NO EXISTE</h1>
                <h2><a href="portal?perfil='.$_SESSION['nombre'].'&tipo='.$_SESSION['tipo'].'&ind='.$_SESSION['objetivo'],'">VOLVER</a></h2>
            </div>
        </div>';
    }
	
	} catch (PDOException $e) { 
	// si ocurre un error hacemos rollback para anular todos los insert 
	$conn->rollback(); 
	//echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
	//die();
	echo $e->getMessage();
	}
}else{
	echo '<div class="row">
            <div class="col-12 pt-5">
                <h1>PERFIL NO SE ENCUENTRA O NO EXISTE</h1>
                <h2><a href="portal?perfil='.$_SESSION['nombre'].'&tipo='.$_SESSION['tipo'].'&ind='.$_SESSION['objetivo'],'">VOLVER</a></h2>
            </div>
        </div>';
}



?>