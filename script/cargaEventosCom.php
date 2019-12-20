<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
setlocale(LC_TIME, 'es_CL.UTF-8');
//Variable vacía (para evitar los E_NOTICE)
//setlocale(LC_TIME, 'es_CL.UTF-8');
//cuenteo
function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}
if(isset($_POST["x"])&&isset($_POST["y"])&&isset($_POST["z"])){

	$mensaje='
	<div class="row pt-5" id="botoneraEventosCom">
		<div class="col-12 text-center pl-3">
			<h2 class="titComu">Invitaciones de Eventos</h2>
			<div class="container text-center">
				<div class="row" id="boxInvitaciones">
					<h5>No Hay</h5>
				</div>
			</div>
			<hr>
		</div>
	</div>
	<div class="row pt-2" id="subMedio">
		<div class="col-12 text-center pl-3">
			<h2 class="titComu">Eventos</h2>
		</div>';

	//Definimos si es el dueño del perfil o un visitante
	$visita=true;
	if ($_POST["x"]==$_SESSION['objetivo']) {
		# code...
		$visita=false;
	}

	// conectar la base da datos 

	$config = parse_ini_file('config.ini');

	$host = 'localhost'; 
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 

	// BUSCAMOS EL CORREO
	$sql = 'SELECT Usuarios.nombre,Usuarios.apelli,Usuarios.indTip,Eventos.ind,Eventos.fecIni,Eventos.fecFin,Eventos.titulo,Eventos.fly,Eventos.estado,Locales.lon,Locales.lat,Locales.nombre
			FROM Usuarios
	        INNER JOIN Sinapsis ON Sinapsis.indUsu = Usuarios.ind
	        INNER JOIN Eventos ON Eventos.ind = Sinapsis.indEve
	        INNER JOIN Locales ON Locales.ind = Eventos.indLoc
	        WHERE Sinapsis.indUsu=:valInd
	        AND Eventos.estado = 0
	        AND Sinapsis.nivel = 1;';

	$result = $conn->prepare($sql);  
	$result->bindValue(':valInd', $_POST["x"], PDO::PARAM_INT);
	// Especificamos el fetch mode antes de llamar a fetch()
	$result->setFetchMode(PDO::FETCH_BOTH);
	// Ejecutamos
	$result->execute();
	//Comprobamos si encontro el evento activo
    $filas=$result->rowCount();
    if ($filas!=0) {
    	
    	$fechaN = time()-10800;
    	// Mostramos los resultados
		while ($row = $result->fetch()){
			$nombreCompleto=$row[0].' '.$row[1];
			$tipoUsuario=$row[2];
			$indiceEvento=$row[3];
			$fechaInicio=$row[4];
			$fechaFin=$row[5];
			$tituloEvento=$row[6];
			$fotoEvento=$row[7];
			$estadoEvento=$row[8];
			$longitud=$row[9];
			$latitud=$row[10];
			$nombreLocal=$row[11];

			//calculamos si el evento finalizo
			$fechaFinNum = strtotime($fechaFin);

			if ($fechaN>$fechaFinNum) {
				# code...
				$mensaje .= '
					<div class="col-12 col-md-6 col-xl-4 boxEve">
						<form class="formEve hvr-grow" style="background-image: url('.$fotoEvento.');">
							<p class="eventoFina">
									
							</p>
							<input name="idEvento" type="hidden" value="'.$indiceEvento.'">
							<a href="evento?titulo='.$tituloEvento.'&x='.$indiceEvento.'">
							<div class="boxFoto">
								
							</div>
							</a>
							<div class="container-fluid pt-2 boxDes mt-2">
								<div class="row">
									<div class="col-12 pt-1">
									<a href="evento?titulo='.$tituloEvento.'&x='.$indiceEvento.'" style="color: black;">
										<p class="infoProd titEvento">'.strtoupper($tituloEvento).'</p>
									</a>
									</div>
									<div class="col-6">
										<p class="text-muted mb-1 titEvento"><i class="fas fa-map-marker-alt"></i> '.$nombreLocal.'</p>
									</div>
									<div class="col-6">
										<p class="text-muted titEvento"><i class="fas fa-calendar-day"></i> '.ucfirst(strftime("%a, %d de %B", strtotime($fechaInicio))).'</p>
									</div>
								</div>
							</div>
						</form>
					</div>';
			}else{
				$mensaje .= '
					<div class="col-12 col-md-6 col-xl-4 boxEve">
						<form class="formEve hvr-grow" style="background-image: url('.$fotoEvento.');">
							<p class="eventoApro">
									
							</p>
							<input name="idEvento" type="hidden" value="'.$indiceEvento.'">
							<a href="evento?titulo='.$tituloEvento.'&x='.$indiceEvento.'">
							<div class="boxFoto">
								
							</div>
							</a>
							<div class="container-fluid pt-2 boxDes mt-2">
								<div class="row">
									<div class="col-12 pt-1">
									<a href="evento?titulo='.$tituloEvento.'&x='.$indiceEvento.'" style="color: black;">
										<p class="infoProd titEvento">'.strtoupper($tituloEvento).'</p>
									</a>
									</div>
									<div class="col-6">
										<p class="text-muted mb-1 titEvento"><i class="fas fa-map-marker-alt"></i> '.$nombreLocal.'</p>
									</div>
									<div class="col-6">
										<p class="text-muted titEvento"><i class="fas fa-calendar-day"></i> '.ucfirst(strftime("%a, %d de %B", strtotime($fechaInicio))).'</p>
									</div>
								</div>
							</div>
						</form>
					</div>';
			}


			
		}
		$mensaje .= '</div>';
		if ($visita) {
			# code...
			echo json_encode(arreglo($mensaje,2), JSON_FORCE_OBJECT);
			die();
		}else{
			echo json_encode(arreglo($mensaje,0), JSON_FORCE_OBJECT);
			die();
		}
    	
    }else{
    	$mensaje.='
    			</div>
	    		<div class="row pt-5">
					<div class="col-12 pt-5">
		                <h1>NO HAY EVENTOS</h1>
		            </div>
		        </div>';
        if ($visita) {
			# code...
			echo json_encode(arreglo($mensaje,2), JSON_FORCE_OBJECT);
			die();
		}else{
			echo json_encode(arreglo($mensaje,0), JSON_FORCE_OBJECT);
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
	$mensaje.='
			<div class="row pt-5">
				<div class="col-12 pt-5">
	                <h1>PERFIL NO SE ENCUENTRA O NO EXISTE</h1>
	                <h2><a href="comunidad?perfil='.$_SESSION['nombre'].'&tipo='.$_SESSION['tipo'].'&ind='.$_SESSION['objetivo'].'">VOLVER</a></h2>
	            </div>
	        </div>';
	echo json_encode(arreglo($mensaje,1), JSON_FORCE_OBJECT);
	die();
}


?>