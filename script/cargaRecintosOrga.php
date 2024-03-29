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
$mensaje="";
if(isset($_POST["x"])&&isset($_POST["y"])&&isset($_POST["z"])){
	

	// conectar la base da datos 

	$config = parse_ini_file('config.ini');

	$host = 'localhost'; 
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 

	// BUSCAMOS EL CORREO
	$sql = 'SELECT DISTINCT Usuarios.nombre,Usuarios.apelli,Usuarios.indTip,Locales.ind,Locales.nombre,Locales.lon,Locales.lat
            FROM Sinapsis
            INNER JOIN Eventos ON Eventos.ind = Sinapsis.indEve
            INNER JOIN Locales ON Locales.ind = Eventos.indLoc
            INNER JOIN Usuarios ON Usuarios.ind = Sinapsis.indUsu
            WHERE Locales.estado=0
            AND Sinapsis.indUsu=:valInd;';

	$result = $conn->prepare($sql);  
	$result->bindValue(':valInd', $_POST["x"], PDO::PARAM_INT);
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
			$nombreCompleto=$row[0].' '.$row[1];
			$tipoUsuario=$row[2];
			$indiceLocal=$row[3];
			$nombreLocal=$row[4];
			$longitud=$row[5];
			$latitud=$row[6];

			if (!$verificacion) {
				# code...
				if ($_POST["y"]==$nombreCompleto&&$_POST["z"]==$tipoUsuario) {
					# code...
					if ($_POST["x"]==$_SESSION['objetivo']) {
						# code...
						$visita=false;
					}
					$verificacion=true;
					$mensaje .= '
						<div class="row">
							<input id="nombrePerfil" type="hidden" value="'.$nombreCompleto.'">
							<input id="indicePerfil" type="hidden" value="'.$_POST["x"].'">
							<input id="tipoPerfil" type="hidden" value="'.$tipoUsuario.'">
						</div>
						<div class="row pt-5">
							<div class="col-12 text-left pl-3">
								<h2>Mis Recintos.</h2>
							</div>
						</div>
				    	<div class="row pt-2" id="subMedio">
							<div class="col-12 col-md-6 col-xl-4 boxEve">
								<form class="formEve hvr-grow" style="background-color: rgba(255,255,255,.5);">
									<p class="cuteFA">
										<i class="fas fa-warehouse"></i>
									</p>
									<div class="container-fluid" style="position: absolute;" id="botoneraRec">
										<div class="row">
											<div class="col-12 py-1">
												<a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;opacity: .9;box-shadow: 2px 2px 10px #000;" id="btnGaleRecintoOrga" data-ind="'.$indiceLocal.'" data-nom="'.$nombreLocal.'">
							                        <i class="fas fa-images"></i>
							                        GALERIA
							                    </a>
											</div>
											<div class="col-12 py-1">
												<a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;opacity: .9;box-shadow: 2px 2px 10px #000;" id="btnEditaRecintoOrga" data-ind="'.$indiceLocal.'">
							                        <i class="fas fa-edit"></i>
							                        EDITAR
							                    </a>
											</div>
											<div class="col-12 py-1">
												<a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;opacity: .9;box-shadow: 2px 2px 10px #000;" id="btnBorraRecintoOrga" data-ind="'.$indiceLocal.'">
							                        <i class="fas fa-trash-alt"></i>
							                        ELIMINAR
							                    </a>
											</div>
										</div>
									</div>
									<input name="idEvento" type="hidden" value="'.$indiceLocal.'">
									<a href="recinto?nombre='.$nombreLocal.'&x='.$indiceLocal.'">
									<div class="boxFoto">
										
									</div>
									</a>
									<div class="container-fluid pt-2 boxDes mt-2">
										<div class="row">
											<div class="col-12 pt-1">
											<a href="recinto?nombre='.$nombreLocal.'&x='.$indiceLocal.'" style="color: black;">
												<p class="infoProd titEvento">'.strtoupper($nombreLocal).'</p>
											</a>
											</div>
											<div class="col-12">
												<p class="text-muted mb-1 titEvento"><i class="fas fa-map-marker-alt"></i> '.$longitud.', '.$latitud.'</p>
											</div>
										</div>
									</div>
								</form>
							</div>';
				}else{
					$mensaje.='
						<div class="row pt-5">
							<div class="col-12 pt-5">
				                <h1>PERFIL NO SE ENCUENTRA O NO EXISTE</h1>
				                <h2><a href="portal?perfil='.$_SESSION['nombre'].'&tipo='.$_SESSION['tipo'].'&ind='.$_SESSION['objetivo'].'">VOLVER</a></h2>
				            </div>
				        </div>';
		        	echo json_encode(arreglo($mensaje,1), JSON_FORCE_OBJECT);
					die();
				}
			}else{
				$mensaje .= '
						<div class="col-12 col-md-6 col-xl-4 boxEve">
							<form class="formEve hvr-grow" style="background-color: rgba(255,255,255,.5);">
								<p class="cuteFA">
									<i class="fas fa-warehouse"></i>
								</p>
								<div class="container-fluid" style="position: absolute;" id="botoneraRec">
									<div class="row">
										<div class="col-12 py-1">
											<a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;opacity: .9;box-shadow: 2px 2px 10px #000;" id="btnGaleRecintoOrga" data-ind="'.$indiceLocal.'" data-nom="'.$nombreLocal.'">
						                        <i class="fas fa-images"></i>
						                        GALERIA
						                    </a>
										</div>
										<div class="col-12 py-1">
											<a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;opacity: .9;box-shadow: 2px 2px 10px #000;" id="btnEditaRecintoOrga" data-ind="'.$indiceLocal.'">
						                        <i class="fas fa-edit"></i>
						                        EDITAR
						                    </a>
										</div>
										<div class="col-12 py-1">
											<a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;opacity: .9;box-shadow: 2px 2px 10px #000;" id="btnBorraRecintoOrga" data-ind="'.$indiceLocal.'">
						                        <i class="fas fa-trash-alt"></i>
						                        ELIMINAR
						                    </a>
										</div>
									</div>
								</div>
								<input name="idEvento" type="hidden" value="'.$indiceLocal.'">
								<a href="recinto?nombre='.$nombreLocal.'&x='.$indiceLocal.'">
								<div class="boxFoto">
									
								</div>
								</a>
								<div class="container-fluid pt-2 boxDes mt-2">
									<div class="row">
										<div class="col-12 pt-1">
										<a href="recinto?nombre='.$nombreLocal.'&x='.$indiceLocal.'" style="color: black;">
											<p class="infoProd titEvento">'.strtoupper($nombreLocal).'</p>
										</a>
										</div>
										<div class="col-12">
											<p class="text-muted mb-1 titEvento"><i class="fas fa-map-marker-alt"></i> '.$longitud.', '.$latitud.'</p>
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
	    		<div class="row pt-5">
					<div class="col-12 pt-5">
		                <h1>NO HAY RECINTOS REGISTRADOS</h1>
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
	                <h2><a href="portal?perfil='.$_SESSION['nombre'].'&tipo='.$_SESSION['tipo'].'&ind='.$_SESSION['objetivo'].'">VOLVER</a></h2>
	            </div>
	        </div>';
	echo json_encode(arreglo($mensaje,1), JSON_FORCE_OBJECT);
	die();
}


?>