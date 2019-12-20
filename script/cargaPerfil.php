<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
//cuenteo
function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}
//Variable vacía (para evitar los E_NOTICE)
setlocale(LC_TIME, 'es_CL.UTF-8');
if(isset($_POST["x"])&&isset($_POST["y"])&&isset($_POST["z"])){

	$mensaje="";
	//comprobamos si es el dueño del perfil o un visitante
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

	// BUSCAMOS EL USUARIO
	$sql = 'SELECT Usuarios.nombre,Usuarios.apelli,Usuarios.foto,Usuarios.indTip,Usuarios.edad,Usuarios.fono,Generos.des
			FROM Usuarios
	        INNER JOIN Generos ON Generos.ind = Usuarios.indGen
	        WHERE Usuarios.ind=:valInd
	        AND Usuarios.estado=0';

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
		while ($row = $result->fetch()){

			$nombreCompleto=$row[0].' '.$row[1];
			$foto=$row[2];
			$tipoUsu=$row[3];
			$edadUsu=$row[4];
			$fonoUsu=$row[5];
			$geneUsu=$row[6];

			//arreglamos la variable edad
			if ($edadUsu==0) {
				# code...
				$edadUsu="Desconocido";
			}else{
				$edadUsu=$edadUsu." Años";
			}
			//arreglamos la variable fono
			if ($fonoUsu==0) {
				# code...
				$fonoUsu="Desconocido";
			}else{
				$fonoUsu="+569".$fonoUsu;
			}

			if ($_POST["y"]==$nombreCompleto&&$_POST["z"]==$row['indTip']) {
				//revisamos el tipo de perfil a cargar
				if ($tipoUsu==1) {
					//perfil normal
					if ($visita) {
						//revisamos el tipo de perfil de quien esta logeado
						if ($_SESSION['tipo']==1) {
							//revisamos si es que son amigos
							$sql = 'SELECT Amigos.estado
									FROM Amigos
									WHERE Amigos.indUsu=:valUsu
									AND Amigos.indAmi=:valAmi';

							$result = $conn->prepare($sql);  
							$result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT);
							$result->bindValue(':valAmi', $_POST["x"], PDO::PARAM_INT);
							// Especificamos el fetch mode antes de llamar a fetch()
							$result->setFetchMode(PDO::FETCH_BOTH);
							// Ejecutamos
							$result->execute();
							//Comprobamos si encontro amistad
						    $filas=$result->rowCount();
						    if ($filas!=0) {
						    	while ($_row = $result->fetch()){
						    		$estadoAmistad=$_row[0];
						    	}
						    	if ($estadoAmistad==0) {
						    		//SON AMIGOS
						    		$mensaje .= '
									<div class="row pt-5">
										<div class="col-12">
											<div class="container">
												<div class="row justify-content-center mb-3">
													<div class="col-12 col-md-6">
														<a href="#" role="button" class="btn btn-danger btn-block btn-lg" style="font-weight: bold;" id="btnEliminaAmigo" data-ind="'.$_POST["x"].'" data-nom="'.$_POST["y"].'">
									                        <i class="fas fa-user-times"></i> ELIMINAR
									                    </a>
													</div>
												</div>
												<div class="row">
													<div class="col-12 mt-3"><hr></div>
													<div class="col-12 col-md-4">
														<img src="'.$foto.'" class="fotoPerfil">
													</div>
													<div class="col-12 col-md-8">
														<h1 class="pt-5" id="nombrePerfil">'.$nombreCompleto.'</h1>
													</div>
													<div class="col-12 mt-3"><hr></div>
												</div>
												<div class="row mt-3 boxDetalleUsu py-3">
													<div class="col-12 text-center py-1">
														<h2>Genero</h2>
														<h4>'.$geneUsu.'</h4>
														<hr>
													</div>
													<div class="col-12 text-center py-1">
														<h2>Edad</h2>
														<h4>'.$edadUsu.'</h4>
														<hr>
													</div>
													<div class="col-12 text-center py-1">
														<h2>Telefono</h2>
														<h4>'.$fonoUsu.'</h4>
													</div>
												</div>
												<div class="row justify-content-center mb-3">
													<div class="col-12 mt-3"><hr></div>
													<div class="col-12 text-center">
														<h2 class="titComu">Mensajes</h2>
													</div>
													<div class="col-12 text-center">
														<div class="container-fluid">
															<div class="row" id="listaMensajes">
															</div>
														</div>
													</div>
												</div>
											</div>	
										</div>
									</div>';
						    	}else{
						    		//perfil normal - no son amigos
						    		$mensaje .= '
									<div class="row pt-5">
										<div class="col-12">
											<div class="container">
												<div class="row justify-content-center mb-3">
													<div class="col-12 col-md-6">
														<a href="#" role="button" class="btn btn-success btn-block btn-lg" style="font-weight: bold;" id="btnAgregaAmigo" data-ind="'.$_POST["x"].'">
									                        <i class="fas fa-user-plus"></i> AGREGAR
									                    </a>
													</div>
												</div>
												<div class="row">
													<div class="col-12 mt-3"><hr></div>
													<div class="col-12 col-md-4">
														<img src="'.$foto.'" class="fotoPerfil">
													</div>
													<div class="col-12 col-md-8">
														<h1 class="pt-5" id="nombrePerfil">'.$nombreCompleto.'</h1>
													</div>
													<div class="col-12 mt-3"><hr></div>
												</div>
												<div class="row mt-3 boxDetalleUsu py-3">
													<div class="col-12 text-center py-1">
														<h2>Genero</h2>
														<h4>'.$geneUsu.'</h4>
														<hr>
													</div>
													<div class="col-12 text-center py-1">
														<h2>Edad</h2>
														<h4>'.$edadUsu.'</h4>
														<hr>
													</div>
													<div class="col-12 text-center py-1">
														<h2>Telefono</h2>
														<h4>'.$fonoUsu.'</h4>
													</div>
												</div>
												<div class="row justify-content-center mb-3">
													<div class="col-12 mt-3"><hr></div>
													<div class="col-12 text-center">
														<h2 class="titComu">Mensajes</h2>
													</div>
													<div class="col-12 text-center">
														<div class="container-fluid">
															<div class="row" id="listaMensajes">
															</div>
														</div>
													</div>
												</div>
											</div>	
										</div>
									</div>';
						    	}
						    }else{
						    	//perfil normal - no son amigos
						    	$mensaje .= '
								<div class="row pt-5">
									<div class="col-12">
										<div class="container">
											<div class="row justify-content-center mb-3">
												<div class="col-12 col-md-6">
													<a href="#" role="button" class="btn btn-success btn-block btn-lg" style="font-weight: bold;" id="btnAgregaAmigo" data-ind="'.$_POST["x"].'">
								                        <i class="fas fa-user-plus"></i> AGREGAR
								                    </a>
												</div>
											</div>
											<div class="row">
												<div class="col-12 mt-3"><hr></div>
												<div class="col-12 col-md-4">
													<img src="'.$foto.'" class="fotoPerfil">
												</div>
												<div class="col-12 col-md-8">
													<h1 class="pt-5" id="nombrePerfil">'.$nombreCompleto.'</h1>
												</div>
												<div class="col-12 mt-3"><hr></div>
											</div>
											<div class="row mt-3 boxDetalleUsu py-3">
												<div class="col-12 text-center py-1">
													<h2>Genero</h2>
													<h4>'.$geneUsu.'</h4>
													<hr>
												</div>
												<div class="col-12 text-center py-1">
													<h2>Edad</h2>
													<h4>'.$edadUsu.'</h4>
													<hr>
												</div>
												<div class="col-12 text-center py-1">
													<h2>Telefono</h2>
													<h4>'.$fonoUsu.'</h4>
												</div>
											</div>
											<div class="row justify-content-center mb-3">
												<div class="col-12 mt-3"><hr></div>
												<div class="col-12 text-center">
													<h2 class="titComu">Mensajes</h2>
												</div>
												<div class="col-12 text-center">
													<div class="container-fluid">
														<div class="row" id="listaMensajes">
														</div>
													</div>
												</div>
											</div>
										</div>	
									</div>
								</div>';
						    }
						}elseif ($_SESSION['tipo']==2) {
							//perfil organizador
							$mensaje .= '
							<div class="row pt-5">
								<div class="col-12">
									<div class="container">
										<div class="row">
											<div class="col-12 col-md-4">
												<img src="'.$foto.'" class="fotoPerfil">
											</div>
											<div class="col-12 col-md-8">
												<h1 class="pt-5" id="nombrePerfil">'.$nombreCompleto.'</h1>
											</div>
											<div class="col-12 mt-3"><hr></div>
										</div>
										<div class="row mt-3 boxDetalleUsu py-3">
											<div class="col-12 text-center py-1">
												<h2>Genero</h2>
												<h4>'.$geneUsu.'</h4>
												<hr>
											</div>
											<div class="col-12 text-center py-1">
												<h2>Edad</h2>
												<h4>'.$edadUsu.'</h4>
												<hr>
											</div>
											<div class="col-12 text-center py-1">
												<h2>Telefono</h2>
												<h4>'.$fonoUsu.'</h4>
											</div>
										</div>
										<div class="row justify-content-center mb-3">
											<div class="col-12 mt-3"><hr></div>
											<div class="col-12 text-center">
												<h2 class="titComu">Mensajes</h2>
											</div>
											<div class="col-12 text-center">
												<div class="container-fluid">
													<div class="row" id="listaMensajes">
													</div>
												</div>
											</div>
										</div>
									</div>	
								</div>
							</div>';
						}elseif ($_SESSION['tipo']==3) {
							$mensaje .= '
							<div class="row pt-5">
								<div class="col-12">
									<div class="container">
										<div class="row">
											<div class="col-12 col-md-4">
												<img src="'.$foto.'" class="fotoPerfil">
											</div>
											<div class="col-12 col-md-8">
												<h1 class="pt-5" id="nombrePerfil">'.$nombreCompleto.'</h1>
											</div>
											<div class="col-12 mt-3"><hr></div>
										</div>
										<div class="row mt-3 boxDetalleUsu py-3">
											<div class="col-12 text-center py-1">
												<h2>Genero</h2>
												<h4>'.$geneUsu.'</h4>
												<hr>
											</div>
											<div class="col-12 text-center py-1">
												<h2>Edad</h2>
												<h4>'.$edadUsu.'</h4>
												<hr>
											</div>
											<div class="col-12 text-center py-1">
												<h2>Telefono</h2>
												<h4>'.$fonoUsu.'</h4>
											</div>
										</div>
									</div>	
								</div>
							</div>';
						}
					}else{
						//ESTAS CARGARNDO TU PROPIO PERFIL
						$mensaje .= '
						<div class="row pt-5">
							<div class="col-12">
								<div class="container">
									<div class="row">
										<div class="col-12 col-md-4">
											<img src="'.$foto.'" class="fotoPerfil">
										</div>
										<div class="col-12 col-md-8">
											<h1 class="pt-5" id="nombrePerfil">'.$nombreCompleto.'</h1>
										</div>
										<div class="col-12 mt-3"><hr></div>
									</div>
									<div class="row mt-3 boxDetalleUsu py-3">
										<div class="col-12 text-center py-1">
											<h2>Genero</h2>
											<h4>'.$geneUsu.'</h4>
											<hr>
										</div>
										<div class="col-12 text-center py-1">
											<h2>Edad</h2>
											<h4>'.$edadUsu.'</h4>
											<hr>
										</div>
										<div class="col-12 text-center py-1">
											<h2>Telefono</h2>
											<h4>'.$fonoUsu.'</h4>
										</div>
									</div>
									<div class="row justify-content-center mb-3">
										<div class="col-12 mt-3"><hr></div>
										<div class="col-12 col-md-6">
											<a href="#" role="button" class="btn btn-warning btn-block btn-lg" style="font-weight: bold;" id="btnEditaPerfil" data-ind="'.$_POST["x"].'">
						                        <i class="fas fa-user-edit"></i> EDITAR
						                    </a>
										</div>
									</div>
									<div class="row justify-content-center mb-3">
										<div class="col-12 mt-3"><hr></div>
										<div class="col-12 text-center">
											<h2 class="titComu">Mensajes</h2>
										</div>
										<div class="col-12 text-center">
											<div class="container-fluid">
												<div class="row" id="listaMensajes">
												</div>
											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>';
					}
				}elseif ($tipoUsu==2) {
					//perfil organizador
					$mensaje .= '
					<div class="row pt-5">
						<div class="col-12">
							<div class="container">
								<div class="row">
									<div class="col-12 col-md-4">
										<img src="'.$foto.'" class="fotoPerfil">
									</div>
									<div class="col-12 col-md-8">
										<h1 class="pt-5" id="nombrePerfil">'.$nombreCompleto.'</h1>
									</div>
									<div class="col-12 mt-3"><hr></div>
								</div>
								<div class="row mt-3 boxDetalleUsu py-3">
									<div class="col-12 text-center py-1">
										<h2>Genero</h2>
										<h4>'.$geneUsu.'</h4>
										<hr>
									</div>
									<div class="col-12 text-center py-1">
										<h2>Edad</h2>
										<h4>'.$edadUsu.'</h4>
										<hr>
									</div>
									<div class="col-12 text-center py-1">
										<h2>Telefono</h2>
										<h4>'.$fonoUsu.'</h4>
									</div>
								</div>
							</div>	
						</div>
					</div>';
				}
			}else{
				$mensaje .= '
			        <div class="row">
			            <div class="col-12 pt-5">
			                <h1>PERFIL NO SE ENCUENTRA O NO EXISTE</h1>
			                <h2><a href="portal?perfil='.$_SESSION['nombre'].'&tipo='.$_SESSION['tipo'].'&ind='.$_SESSION['objetivo'].'">VOLVER</a></h2>
			            </div>
			        </div>';
				echo json_encode(arreglo($mensaje,1), JSON_FORCE_OBJECT);
				die();
			}
			
		}
		if ($visita) {
			# code...
			echo json_encode(arreglo($mensaje,2), JSON_FORCE_OBJECT);
			die();
		}else{
			echo json_encode(arreglo($mensaje,0), JSON_FORCE_OBJECT);
			die();
		}
    }else{
        $mensaje .= '
        <div class="row">
            <div class="col-12 pt-5">
                <h1>PERFIL NO SE ENCUENTRA O NO EXISTE</h1>
                <h2><a href="portal?perfil='.$_SESSION['nombre'].'&tipo='.$_SESSION['tipo'].'&ind='.$_SESSION['objetivo'].'">VOLVER</a></h2>
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
	$mensaje .= '
        <div class="row">
            <div class="col-12 pt-5">
                <h1>PERFIL NO SE ENCUENTRA O NO EXISTE</h1>
                <h2><a href="portal?perfil='.$_SESSION['nombre'].'&tipo='.$_SESSION['tipo'].'&ind='.$_SESSION['objetivo'].'">VOLVER</a></h2>
            </div>
        </div>';
	echo json_encode(arreglo($mensaje,1), JSON_FORCE_OBJECT);
	die();
}



?>