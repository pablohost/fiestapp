<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
//Variable vacía (para evitar los E_NOTICE)
//setlocale(LC_TIME, 'es_CL.UTF-8');
//cuenteo
function arreglo($msg,$cod){
	//cod  0=encontro mensajes y es su perfil & 1=encontro mensajes y es otro perfil & 2=no encontro mensajes y es tu perfil & 3=no encontro mensajes y es otro perfil
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}
$mensaje='
	<div class="col-12 text-center" id="boxEnviarMensaje" style="background-color: rgba(255,255,255,.8);border-radius: 10px;">
		<form class="formEnviaMensaje" id="enviaMensajeForm">
			<div class="container-fluid text-center">
				<div class="row my-2">
					<div class="col-12 centro my-1">
						<textarea type="text" id="txtNuevoMen" rows="4" class="form-control my-2" placeholder="Escribe aqui..." name="NuevoMen"></textarea>
					</div>
					<div class="col-12 col-md-6 my-1">
						<div class="g-recaptcha" data-sitekey="6LfMScQUAAAAANKeGizusHJd8EQJw5-IVm4-U9Q-" style="transform:scale(0.7);-webkit-transform:scale(0.7);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
					</div>
					<div class="col-12 col-md-6 my-1 centro">
						<a href="#" role="button" class="btn btn-success btn-sm" id="btnEnviaMensaje" data-ind="'.$_POST["x"].'">
							<i class="fas fa-paper-plane"></i> ENVIAR
						</a>
					</div>
					<script src="https://www.google.com/recaptcha/api.js" async defer></script>
				</div>
			</div>
		</form>
	</div>
	<div class="container-fluid mt-4" style="overflow-y: scroll;max-height: 500px;"><div class="row">';

//comprobamos si es el dueño del perfil o un visitante
$visita=true;
if ($_POST["x"]==$_SESSION['objetivo']) {
	# code...
	$visita=false;
}

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
	$sql = 'SELECT Mensajes.des,Mensajes.fechaHora,Mensajes.indEmi,Usuarios.nombre,Usuarios.apelli,Usuarios.indTip,Mensajes.ind
			FROM Mensajes
			INNER JOIN Usuarios ON Usuarios.ind = Mensajes.indEmi
			WHERE Mensajes.indRec=:valUsu
			AND Usuarios.estado=0
			ORDER BY Mensajes.fechaHora DESC;';

	$result = $conn->prepare($sql);  
	$result->bindValue(':valUsu', $_POST["x"], PDO::PARAM_STR);
	// Especificamos el fetch mode antes de llamar a fetch()
	$result->setFetchMode(PDO::FETCH_BOTH);
	// Ejecutamos
	$result->execute();
	//Comprobamos si encontro el evento activo
    $filas=$result->rowCount();
    if ($filas!=0) {
    	

    	// Mostramos los resultados
		while ($row = $result->fetch()){
			$mensajeEnviado=$row[0];
			$mensajeFecha=$row[1];
			$indEmisor=$row[2];
			$nomEmisor=$row[3].' '.$row[4];
			$tipEmisor=$row[5];
			$indMensaje=$row[6];
			$portalComunidad="";

			if ($tipEmisor==1) {
				# code...
				$portalComunidad="comunidad";
			}else if ($tipEmisor==2) {
				# code...
				$portalComunidad="portal";
			}

			//Calculamos y formateamos la fecha 
            setlocale(LC_TIME, 'es_CL.UTF-8');
            $fechaNumMen = strtotime($mensajeFecha);
            $mensajeFecha=ucfirst(strftime("%d de %B del %Y a las %H:%M", $fechaNumMen));

			$mensaje .= '
			<div class="col-12 my-2 py-2" style="background-color: rgba(255,255,255,.8);border-radius: 10px;">
				<div class="container-fluid text-center boxMensaje">
					<div class="row">
						<div class="col-12 col-md-6 centro my-1">
							<a href="'.$portalComunidad.'?perfil='.$nomEmisor.'&tipo='.$tipEmisor.'&ind='.$indEmisor.'" style="color: black;">
								<h4 class="mb-0" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">'.$nomEmisor.'</h4>
							</a>
						</div>
						<div class="col-12 col-md-6 text-muted centro my-1">
							<h5 class="mb-0" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">'.$mensajeFecha.'</h5>
						</div>
						<div class="col-12 text-left">
							<hr>
							<h5 style="background-color: rgba(255,255,255,.6);border-radius: 10px;padding: .5rem;">'.$mensajeEnviado.'</h5>
						</div>
						<div class="col-12 text-left">
							<hr>
							<p class="botonMensaje">
								<a href="#" role="button" class="btn btn-danger btn-sm" id="btnBorraMensaje" data-ind="'.$indMensaje.'">
									<i class="fas fa-comment-slash"></i> ELIMINAR MENSAJE
								</a>
							</p>
						</div>
					</div>
				</div>
			</div>';
		}
		$mensaje.="</div></div>";
		if ($visita) {
			# code...
			echo json_encode(arreglo($mensaje,1), JSON_FORCE_OBJECT);
			die();
		}else{
			echo json_encode(arreglo($mensaje,0), JSON_FORCE_OBJECT);
			die();
		}
    	
    }else{
    	$mensaje.='
			<div class="col-12 pt-5 text-center">
                <p>No hay mensajes</p>
            </div>';
        if ($visita) {
			# code...
			echo json_encode(arreglo($mensaje,2), JSON_FORCE_OBJECT);
			die();
		}else{
			echo json_encode(arreglo($mensaje,3), JSON_FORCE_OBJECT);
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
			<div class="col-12 pt-5">
                <h1>PERFIL NO SE ENCUENTRA O NO EXISTE</h1>
            </div>';
	echo json_encode(arreglo($mensaje,4), JSON_FORCE_OBJECT);
	die();
}


?>