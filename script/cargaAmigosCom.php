<?php
header('Content-Type: application/json; charset=utf-8');
session_start();

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
	<div class="row pt-5" id="botoneraAmigosCom">
		<div class="col-12 text-center pl-3">
			<h2 class="titComu">Solicitudes de amistad</h2>
			<div class="container text-center">
				<div class="row" id="boxSolicitudes">
					<h5>No Hay</h5>
				</div>
			</div>
			<hr>
		</div>
		<div class="col-12 text-center pl-3">
			<h2 class="titComu">Buscar Personas</h2>
		</div>
		<div class="col-12 text-center pl-3">
			<form class="my-3 boxBuscar">
	            <input class="form-control mr-2 13" type="search" placeholder="Búsqueda de personas" aria-label="Search" id="txtBuscarCom" style="display: unset; width: auto;">
	            <a href="#" class="btn btn-outline-warning" role="button" aria-pressed="true" id="btnBuscarCom">
	                <i class="fas fa-search fa-1x"></i>
	            </a>
	        </form>
	        <hr>
		</div>
	</div>
	<div class="row pt-2" id="subMedio">
		<div class="col-12 text-center pl-3">
			<h2 class="titComu">Amigos</h2>
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
	$sql = 'SELECT Usuarios.foto,Usuarios.nombre,Usuarios.apelli,Usuarios.ind
			FROM Amigos
			INNER JOIN Usuarios ON Usuarios.ind = Amigos.indAmi
			WHERE Amigos.indUsu=:valInd
			AND Amigos.estado=0
			AND Usuarios.estado=0;';

	$result = $conn->prepare($sql);  
	$result->bindValue(':valInd', $_POST["x"], PDO::PARAM_INT);
	// Especificamos el fetch mode antes de llamar a fetch()
	$result->setFetchMode(PDO::FETCH_BOTH);
	// Ejecutamos
	$result->execute();
	//Comprobamos si encontro el evento activo
    $filas=$result->rowCount();
    if ($filas!=0) {
    	

    	// Mostramos los resultados
    	$verificacion=false;
		while ($row = $result->fetch()){
			$foto=$row[0];
			$nombreCompleto=$row[1].' '.$row[2];
			$indicePerfil=$row[3];


			if (!$verificacion) {
				# code...
				
				$verificacion=true;
				$mensaje .= '
						<input id="nombrePerfil" type="hidden" value="'.$_POST["y"].'">
						<input id="indicePerfil" type="hidden" value="'.$_POST["x"].'">
						<div class="col-12 col-md-6 col-lg-4 col-xl-3 boxEve">
							<form class="formAmi hvr-grow" style="background-color: rgba(255,255,255,.5);">
								<input name="idPerfil" type="hidden" value="'.$indicePerfil.'">
								<a href="comunidad?perfil='.$nombreCompleto.'&tipo=1&ind='.$indicePerfil.'">
								<div class="boxFoto centro">
									<img src="'.$foto.'" class="fotoAmigo">
								</div>
								</a>
								<div class="container-fluid pt-2 boxDes">
									<div class="row">
										<div class="col-12 pt-1">
											<a href="comunidad?perfil='.$nombreCompleto.'&tipo=1&ind='.$indicePerfil.'" style="color: black;">
												<p class="infoProd titEvento">'.strtoupper($nombreCompleto).'</p>
											</a>
										</div>
									</div>
								</div>
							</form>
						</div>';
			}else{
				$mensaje .= '
						<div class="col-12 col-md-6 col-lg-4 col-xl-3 boxEve">
							<form class="formAmi hvr-grow" style="background-color: rgba(255,255,255,.5);">
								<input name="idPerfil" type="hidden" value="'.$indicePerfil.'">
								<a href="comunidad?perfil='.$nombreCompleto.'&tipo=1&ind='.$indicePerfil.'">
								<div class="boxFoto centro">
									<img src="'.$foto.'" class="fotoAmigo">
								</div>
								</a>
								<div class="container-fluid pt-2 boxDes">
									<div class="row">
										<div class="col-12 pt-1">
											<a href="comunidad?perfil='.$nombreCompleto.'&tipo=1&ind='.$indicePerfil.'" style="color: black;">
												<p class="infoProd titEvento">'.strtoupper($nombreCompleto).'</p>
											</a>
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
		                <h1>NO HAY AMIGOS</h1>
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