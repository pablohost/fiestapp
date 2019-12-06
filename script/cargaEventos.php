<?php
header('charset=utf-8');
//Variable vacía (para evitar los E_NOTICE)
setlocale(LC_TIME, 'es_CL.UTF-8');
if(isset($_POST["x"])){
	$categoria=$_POST["x"];
	consultaCategoria($categoria);
}else{
	consultaCategoria(0);
}



function consultaCategoria($x){
	$mensaje="";
	$fechaN = time()-10800;
	$fechaT = date("Y-m-d H:i:s",$fechaN);
	// conectar la base da datos 

	$config = parse_ini_file('config.ini');

	$host = 'localhost'; 
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 

	// BUSCAMOS EL CORREO
	$sql = 'SELECT Eventos.ind,Eventos.fecIni,Eventos.fecFin,Eventos.titulo,Eventos.fly,Eventos.estado,Locales.lon,Locales.lat,Locales.nombre
		FROM Eventos 
		INNER JOIN Locales ON Eventos.indLoc = Locales.ind
        WHERE Eventos.estado=0
        AND Eventos.fecFin>=:valFec
		ORDER BY RAND();';

	$result = $conn->prepare($sql);  
	$result->bindValue(':valFec', $fechaT, PDO::PARAM_STR);
	// Especificamos el fetch mode antes de llamar a fetch()
	$result->setFetchMode(PDO::FETCH_ASSOC);
	// Ejecutamos
	$result->execute();
	// Mostramos los resultados
	while ($row = $result->fetch()){
		$mensaje .= '
					<div class="col-12 col-md-6 col-xl-4 boxEve">
						<form class="formEve hvr-grow" style="background-image: url('.$row['fly'].');">
							<input name="idEvento" type="hidden" value="'.$row['ind'].'">
							<a href="evento?titulo='.$row['titulo'].'&x='.$row['ind'].'">
							<div class="boxFoto">
								
							</div>
							</a>
							<div class="container-fluid pt-2 boxDes">
								<div class="row">
									<div class="col-12 pt-1">
									<a href="evento?titulo='.$row['titulo'].'&x='.$row['ind'].'" style="color: black;">
										<p class="infoProd">'.strtoupper($row['titulo']).'</p>
									</a>
									</div>
									<div class="col-6">
										<p class="text-muted mb-1"><i class="fas fa-map-marker-alt"></i> '.$row['nombre'].'</p>
									</div>
									<div class="col-6">
										<p class="text-muted"><i class="fas fa-calendar-day"></i> '.ucfirst(strftime("%a, %d de %B", strtotime($row['fecIni']))).'</p>
									</div>
								</div>
							</div>
						</form>
					</div>';
	}
	echo $mensaje;
	} catch (PDOException $e) { 
	// si ocurre un error hacemos rollback para anular todos los insert 
	$conn->rollback(); 
	//echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
	//die();
	echo $e->getMessage();
	}
}

?>