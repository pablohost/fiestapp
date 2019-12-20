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
$mensaje='';
if(isset($_POST["x"])){
	
	// conectar la base da datos 

	$config = parse_ini_file('config.ini');

	$host = 'localhost'; 
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 

	// BUSCAMOS EL CORREO
	$sql = 'SELECT Usuarios.foto,Usuarios.nombre,Usuarios.apelli,Usuarios.ind,Usuarios.indTip
			FROM Usuarios
			INNER JOIN Sinapsis ON Sinapsis.indUsu = Usuarios.ind
			INNER JOIN Eventos ON Eventos.ind = Sinapsis.indEve
	        WHERE Eventos.ind=:valEve
	        AND Sinapsis.nivel=1
	        AND Usuarios.estado=0;';

	$result = $conn->prepare($sql);  
	$result->bindValue(':valEve', $_POST["x"], PDO::PARAM_INT);
	// Especificamos el fetch mode antes de llamar a fetch()
	$result->setFetchMode(PDO::FETCH_BOTH);
	// Ejecutamos
	$result->execute();
	//Comprobamos si encontro el evento activo
    $filas=$result->rowCount();
    if ($filas!=0) {
    	//Definimos si es el dueño del perfil o un visitante

    	// Mostramos los resultados
    	$visita=true;
		while ($row = $result->fetch()){
			$foto=$row[0];
			$nombreCompleto=$row[1].' '.$row[2];
			$indicePerfil=$row[3];
			$indiceTipo=$row[4];
			$portalComunidad="";
			if ($indiceTipo==1) {
				# code...
				$portalComunidad="comunidad";
			}else if ($indiceTipo==2) {
				# code...
				$portalComunidad="portal";
			}

			$mensaje .= '
			<div class="col-6 col-sm-4 col-md-3 boxEve">
				<form class="formPer hvr-grow" style="background-color: rgba(255,255,255,.5);">
					<input name="idPerfil" type="hidden" value="'.$indicePerfil.'">
					<a href="'.$portalComunidad.'?perfil='.$nombreCompleto.'&tipo='.$indiceTipo.'&ind='.$indicePerfil.'">
					<div class="centro boxFotoOrga">
						<img src="'.$foto.'" class="fotoAsisOrga">
					</div>
					</a>
					<div class="container-fluid pt-2 boxDes mt-2">
						<div class="row">
							<div class="col-12 pt-1">
								<a href="'.$portalComunidad.'?perfil='.$nombreCompleto.'&tipo='.$indiceTipo.'&ind='.$indicePerfil.'" style="color: black;">
									<p class="infoProd titEvento">'.strtoupper($nombreCompleto).'</p>
								</a>
							</div>
						</div>
					</div>
				</form>
			</div>';
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
		<div class="col-12 pt-5 text-center">
            <h5>NO HAY ASISTENTES AUN</h5>
        </div>';
    	echo json_encode(arreglo($mensaje,1), JSON_FORCE_OBJECT);
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