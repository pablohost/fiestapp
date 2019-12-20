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
$mensaje='
<div class="row pt-2" id="subMedio">
	<div class="col-12 text-center">
		<h2>Resultados</h2>
		<hr>
	</div>
	<div class="col-12 text-center pl-3">
		<form class="my-3 boxBuscar">
            <input class="form-control mr-2 13" type="search" placeholder="Búsqueda de personas" aria-label="Search" id="txtBuscarCom" style="display: unset; width: auto;">
            <a href="#" class="btn btn-outline-warning" role="button" aria-pressed="true" id="btnBuscarCom">
                <i class="fas fa-search fa-1x"></i>
            </a>
        </form>
        <hr>
	</div>';
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
	        WHERE CONCAT_WS(" ", Usuarios.nombre, Usuarios.apelli) REGEXP :valUsu
	        AND Usuarios.estado=0;';

	$result = $conn->prepare($sql);  
	$result->bindValue(':valUsu', $_POST["x"], PDO::PARAM_STR);
	// Especificamos el fetch mode antes de llamar a fetch()
	$result->setFetchMode(PDO::FETCH_BOTH);
	// Ejecutamos
	$result->execute();
	//Comprobamos si encontro el evento activo
    $filas=$result->rowCount();
    if ($filas!=0) {
    	//Definimos si es el dueño del perfil o un visitante

    	// Mostramos los resultados
    	$verificacion=false;
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
			<div class="col-12 col-md-6 col-lg-4 col-xl-3 boxEve">
				<form class="formPer hvr-grow" style="background-color: rgba(255,255,255,.5);">
					<input name="idPerfil" type="hidden" value="'.$indicePerfil.'">
					<a href="'.$portalComunidad.'?perfil='.$nombreCompleto.'&tipo='.$indiceTipo.'&ind='.$indicePerfil.'">
					<div class="boxFoto centro">
						<img src="'.$foto.'" class="fotoAmigo">
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
    			</div>
	    		<div class="row pt-5">
					<div class="col-12 pt-5">
		                <h1>NO SE ENCONTRARON RESULTADOS</h1>
		            </div>
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