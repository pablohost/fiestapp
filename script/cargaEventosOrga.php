<?php
header('Content-Type: application/json; charset=utf-8');
session_start();

//Variable vacía (para evitar los E_NOTICE)
setlocale(LC_TIME, 'es_CL.UTF-8');
//cuenteo
function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}
$mensaje='
<div class="row pt-5" id="botoneraOrgaEve">
	<div class="col-12">
		<div class="container text-center">
			<a href="#" role="button" class="btn btn-warning btn-block btn-lg" style="font-weight: bold;" id="btnAgregaEventoOrga">
          		<i class="fas fa-calendar-plus"></i> CREAR EVENTO
      		</a>
  		</div>
	</div>
</div>
<div class="row pt-5">
	<div class="col-12 text-left pl-3">
		<hr>
		<h2>Mis Eventos Publicados.</h2>
	</div>
</div>
<div class="row pt-2" id="subMedio">';
$fechaN = time()-10800;
$fechaT = date("Y-m-d H:i:s",$fechaN);
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
	$sql = 'SELECT Usuarios.nombre,Usuarios.apelli,Usuarios.indTip,Eventos.ind,Eventos.fecIni,Eventos.fecFin,Eventos.titulo,Eventos.fly,Eventos.estado,Locales.lon,Locales.lat,Locales.nombre
		FROM Usuarios
        INNER JOIN Sinapsis ON Sinapsis.indUsu = Usuarios.ind
        INNER JOIN Eventos ON Eventos.ind = Sinapsis.indEve
        INNER JOIN Locales ON Locales.ind = Eventos.indLoc
        WHERE Usuarios.ind=:valInd
        AND Eventos.estado = 0
        AND Eventos.fecFin>=:valFec
        AND Sinapsis.nivel = 0;';

	$result = $conn->prepare($sql);  
	$result->bindValue(':valInd', $_POST["x"], PDO::PARAM_INT);
	$result->bindValue(':valFec', $fechaT, PDO::PARAM_STR);
	// Especificamos el fetch mode antes de llamar a fetch()
	$result->setFetchMode(PDO::FETCH_BOTH);
	// Ejecutamos
	$result->execute();
	//Comprobamos si encontro el evento activo
    $filas=$result->rowCount();
    if ($filas!=0) {
    	//Definimos si es el dueño del perfil o un visitante

    	// Mostramos los resultados
    	$mensaje .= '
		';
    	$verificacion=false;
    	$visita=true;
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
							<input id="nombrePerfil" type="hidden" value="'.$nombreCompleto.'">
							<input id="indicePerfil" type="hidden" value="'.$_POST["x"].'">
							<input id="tipoPerfil" type="hidden" value="'.$tipoUsuario.'">
							<div class="col-12 col-md-6 col-xl-4 boxEve">
								<form class="formEve hvr-grow" style="background-image: url('.$fotoEvento.');">
									<p class="eventoApro">
										
									</p>
									<div class="container-fluid" style="position: absolute;" id="botoneraEve">
										<div class="row">
											<div class="col-12 py-1">
												<a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;opacity: .9;box-shadow: 2px 2px 10px #000;" id="btnGestionEvento" data-ind="'.$indiceEvento.'" data-nom="'.$tituloEvento.'">
							                        <i class="fas fa-cogs"></i>
							                        GESTIONAR
							                    </a>
											</div>
											<div class="col-12 py-1">
												<a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;opacity: .9;box-shadow: 2px 2px 10px #000;" id="btnEditaEventoOrga" data-ind="'.$indiceEvento.'" data-nom="'.$tituloEvento.'">
							                        <i class="fas fa-edit"></i>
							                        EDITAR
							                    </a>
											</div>
											<div class="col-12 py-1">
												<a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;opacity: .9;box-shadow: 2px 2px 10px #000;" id="btnBorraEventoOrga" data-ind="'.$indiceEvento.'">
							                        <i class="fas fa-trash-alt"></i>
							                        ELIMINAR
							                    </a>
											</div>
										</div>
									</div>
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
							<form class="formEve hvr-grow" style="background-image: url('.$fotoEvento.');">
								<p class="eventoApro">
										
								</p>
								<div class="container-fluid" style="position: absolute;" id="botoneraEve">
									<div class="row">
										<div class="col-12 py-1">
											<a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;opacity: .9;box-shadow: 2px 2px 10px #000;" id="btnGestionEvento" data-ind="'.$indiceEvento.'" data-nom="'.$tituloEvento.'">
						                        <i class="fas fa-cogs"></i>
						                        GESTIONAR
						                    </a>
										</div>
										<div class="col-12 py-1">
											<a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;opacity: .9;box-shadow: 2px 2px 10px #000;" id="btnEditaEventoOrga" data-ind="'.$indiceEvento.'" data-nom="'.$tituloEvento.'">
						                        <i class="fas fa-edit"></i>
						                        EDITAR
						                    </a>
										</div>
										<div class="col-12 py-1">
											<a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;opacity: .9;box-shadow: 2px 2px 10px #000;" id="btnBorraEventoOrga" data-ind="'.$indiceEvento.'">
						                        <i class="fas fa-trash-alt"></i>
						                        ELIMINAR
						                    </a>
										</div>
									</div>
								</div>
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
		$mensaje .= '
		</div>
		<div class="row pt-5">
			<div class="col-12 text-left pl-3">
				<hr>
				<h2>Mis Eventos En Espera.</h2>
			</div>
		</div>
		<div class="row pt-2" id="subMedioEspera">
			
		</div>
		<div class="row pt-5">
			<div class="col-12 text-left pl-3">
				<hr>
				<h2>Mis Eventos Finalizados.</h2>
			</div>
		</div>
		<div class="row pt-2" id="subMedioFin">

		</div>';
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
    				<div class="col-12 pt-5">
		                <h1>NO HAY EVENTOS REGISTRADOS</h1>
		            </div>
    			</div>
				<div class="row pt-5">
					<div class="col-12 text-left pl-3">
						<hr>
						<h2>Mis Eventos En Espera.</h2>
					</div>
				</div>
				<div class="row pt-2" id="subMedioEspera">
					
				</div>
				<div class="row pt-5">
					<div class="col-12 text-left pl-3">
						<hr>
						<h2>Mis Eventos Finalizados.</h2>
					</div>
				</div>
				<div class="row pt-2" id="subMedioFin">

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