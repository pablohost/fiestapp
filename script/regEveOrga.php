<?php
header('Content-Type: application/json; charset=utf-8');

//cuenteo
function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}

if(isset($_POST["Categorias"]) && isset($_POST["Capacidad"]) && isset($_POST["Estacionamiento"]) && isset($_POST["TituloEve"]) && isset($_POST["DtIni"]) && isset($_POST["HrIni"]) && isset($_POST["DtFin"]) && isset($_POST["HrFin"]) && isset($_POST["Long"]) && isset($_POST["Lati"]) && isset($_POST["NomLoc"]) && isset($_POST["indiceUsu"])) {

	//Y definimos el máximo que se puede subir
	//$tamañoMaximoKB = "12288"; //Tamaño máximo expresado en KB
	$tamañoMaximoBytes = 2097152; // -> 2097152 Bytes -> 2 MB --- 12582912 Bytes -> 12 MB

	//se define la ruta de la foto $_FILES['FotoEve']['tmp_name']
	if ($_FILES['FotoEve']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoEve']['type']);
		$rutaFly="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoEve']['name'];
		$tamañoArchivo = $_FILES['FotoEve']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	//revisamos si se subieron nuevas fotos al recinto
	if ($_FILES['FotoRec1']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec1']['type']);
		$rutaRec1="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec1']['name'];
		$tamañoArchivo = $_FILES['FotoRec1']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec2'])&&$_FILES['FotoRec2']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec2']['type']);
		$rutaRec2="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec2']['name'];
		$tamañoArchivo = $_FILES['FotoRec2']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec3'])&&$_FILES['FotoRec3']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec3']['type']);
		$rutaRec3="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec3']['name'];
		$tamañoArchivo = $_FILES['FotoRec3']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec4'])&&$_FILES['FotoRec4']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec4']['type']);
		$rutaRec4="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec4']['name'];
		$tamañoArchivo = $_FILES['FotoRec4']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec5'])&&$_FILES['FotoRec5']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec5']['type']);
		$rutaRec5="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec5']['name'];
		$tamañoArchivo = $_FILES['FotoRec5']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec6'])&&$_FILES['FotoRec6']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec6']['type']);
		$rutaRec6="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec6']['name'];
		$tamañoArchivo = $_FILES['FotoRec6']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec7'])&&$_FILES['FotoRec7']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec7']['type']);
		$rutaRec7="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec7']['name'];
		$tamañoArchivo = $_FILES['FotoRec7']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec8'])&&$_FILES['FotoRec8']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec8']['type']);
		$rutaRec8="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec8']['name'];
		$tamañoArchivo = $_FILES['FotoRec8']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec9'])&&$_FILES['FotoRec9']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec9']['type']);
		$rutaRec9="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec9']['name'];
		$tamañoArchivo = $_FILES['FotoRec9']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	if (isset($_FILES['FotoRec10'])&&$_FILES['FotoRec10']['error'] === 0) {
		//se define la ruta de la foto
		$formatoFoto=explode("/",$_FILES['FotoRec10']['type']);
		$rutaRec10="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
		$nombreArchivo = $_FILES['FotoRec10']['name'];
		$tamañoArchivo = $_FILES['FotoRec10']['size']; //Obtenemos el tamaño del archivo en Bytes
		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo json_encode(arreglo('El archivo <b>'.$nombreArchivo.'</b> es demasiado grande. El tamaño maximo del archivo es de 2MB.',1), JSON_FORCE_OBJECT);
			die();
		}
	}
	//se identifica la via de contacto con el recinto
	$fonoLocal="";
	$correoLocal="";
	$webLocal="";
	if ($_POST["FonoLoc"]!="") {
		# code...
		$fonoLocal=$_POST["FonoLoc"];
	}else{
		$fonoLocal="";
	}
	if ($_POST["CorLoc"]!="") {
		# code...
		$correoLocal=$_POST["CorLoc"];
	}else{
		$correoLocal="";
	}
	if ($_POST["WebLoc"]!="") {
		# code...
		$webLocal=$_POST["WebLoc"];
	}else{
		$webLocal="";
	}
	//se identifica si existe enlace para los boletos
	$boletos="";
	if ($_POST["BoleEve"]!="") {
		# code...
		$boletos=$_POST["BoleEve"];
	}else{
		$boletos="";
	}
	//se identifica si se agrego descripcion al evento
	$descripcionEve="";
	if ($_POST["descEventoBR"]!="") {
		# code...
		$descripcionEve=$_POST["descEventoBR"];
	}else{
		$descripcionEve="";
	}
	//se identifica si se agrego descripcion al recinto
	$descripcionLoc="";
	if ($_POST["descLocalBR"]!="") {
		# code...
		$descripcionLoc=$_POST["descLocalBR"];
	}else{
		$descripcionLoc="";
	}
	//formateamos la fecha y hora del evento
	$fechaInicio="";
	$fechaInicio=strtotime($_POST["DtIni"]." ".$_POST["HrIni"]);
	

	$fechaFin="";
	$fechaFin=strtotime($_POST["DtFin"]." ".$_POST["HrFin"]);
	
	//comprobamos que se ingresan fechas validas
	$fechaNow = time()-10800;
	if ($fechaInicio<$fechaNow||$fechaFin<$fechaNow) {
		# code...
		echo json_encode(arreglo('La fecha y hora ingresada no puede ser anterior al dia de hoy.',2), JSON_FORCE_OBJECT);
		die();
	}
	if ($fechaInicio>$fechaFin) {
		# code...
		echo json_encode(arreglo('La fecha y hora de termino no puede ser anterior a la de inicio.',2), JSON_FORCE_OBJECT);
		die();
	}

	$fechaInicio=date("Y-m-d H:i:s", $fechaInicio);
	$fechaFin=date("Y-m-d H:i:s", $fechaFin);

	//se identifican las categorias del evento
	$cates = explode(":", $_POST["Categorias"]);

	//**********COMPROBAR QUE DIRECCION DE CORREO ELECTRONICO NO EXISTA EN UNA CUENTA ACTIVA
	// conectar la base da datos 

	$config = parse_ini_file('config.ini');

	$host = 'localhost'; 
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 

	//reviso si en un recinto nuevo o se actualiza uno antiguo
	$indiceLocal=0;
	$indiceCap=0;
	$indiceEst=0;
	if (isset($_POST["Recinto"])) {
		# code...
		$indiceLocal=$_POST["Recinto"];
	}else{
		$indiceLocal=0;
	}
	
	if ($indiceLocal==0) {
		//NUEVO RECINTO
		// tabla capPersonas
		$sql = 'INSERT INTO CapPersonas(max,uso) VALUES (:valMax,:valUso);'; 
		$result = $conn->prepare($sql); 
		$result->bindValue(':valMax', $_POST["Capacidad"], PDO::PARAM_INT);
		$result->bindValue(':valUso', 0, PDO::PARAM_INT);
		$result->execute(); 
		$lastIdPer = $conn->lastInsertId();

		// tabla Estacionamientos
		$sql = 'INSERT INTO Estacionamientos(max,uso) VALUES (:valMax,:valUso);'; 
		$result = $conn->prepare($sql); 
		$result->bindValue(':valMax', $_POST["Estacionamiento"], PDO::PARAM_INT);
		$result->bindValue(':valUso', 0, PDO::PARAM_INT);
		$result->execute(); 
		$lastIdEst = $conn->lastInsertId();

		// tabla Locales
		$sql = 'INSERT INTO Locales(indCap,indEst,lon,lat,nombre,des,fono,correo,web,estado) VALUES (:valCap,:valEst,:valLon,:valLat,:valNom,:valDes,:valFon,:valCor,:valWeb,:valEstado);'; 
		$result = $conn->prepare($sql); 
		$result->bindValue(':valCap', $lastIdPer, PDO::PARAM_INT);
		$result->bindValue(':valEst', $lastIdEst, PDO::PARAM_INT);
		$result->bindValue(':valLon', $_POST["Long"], PDO::PARAM_STR);
		$result->bindValue(':valLat', $_POST["Lati"], PDO::PARAM_STR);
		$result->bindValue(':valNom', $_POST["NomLoc"], PDO::PARAM_STR);
		$result->bindValue(':valDes', $descripcionLoc, PDO::PARAM_STR);
		$result->bindValue(':valFon', $fonoLocal, PDO::PARAM_STR);
		$result->bindValue(':valCor', $correoLocal, PDO::PARAM_STR);
		$result->bindValue(':valWeb', "https://".$webLocal, PDO::PARAM_STR);
		$result->bindValue(':valEstado', 0, PDO::PARAM_INT);
		$result->execute(); 
		$lastIdLoc = $conn->lastInsertId();
		$indiceLocal=$lastIdLoc;
	}else{
		//ACTUALIZAR RECINTO
		// buscamos el recinto para actualizarlo
		$sql = 'SELECT Locales.indCap, Locales.indEst 
				FROM Locales 
				WHERE Locales.ind = :valInd;'; 
		$result = $conn->prepare($sql); 
		$result->bindValue(':valInd', $_POST["Recinto"], PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute(); 
		// Mostramos los resultados
		while ($row = $result->fetch()){
			$indiceCap=$row["indCap"];
			$indiceEst=$row["indEst"];
		}
		// tabla capPersonas
		$sql = 'UPDATE CapPersonas SET CapPersonas.max=:valMax,CapPersonas.uso=0 WHERE CapPersonas.ind=:valInd;'; 
		$result = $conn->prepare($sql); 
		$result->bindValue(':valMax', $_POST["Capacidad"], PDO::PARAM_INT);
		$result->bindValue(':valInd', $indiceCap, PDO::PARAM_INT);
		$result->execute(); 

		// tabla Estacionamientos
		$sql = 'UPDATE Estacionamientos SET Estacionamientos.max=:valMax,Estacionamientos.uso=0 WHERE Estacionamientos.ind=:valInd;'; 
		$result = $conn->prepare($sql); 
		$result->bindValue(':valMax', $_POST["Estacionamiento"], PDO::PARAM_INT);
		$result->bindValue(':valInd', $indiceEst, PDO::PARAM_INT);
		$result->execute(); 
		// tabla Locales
		$sql = 'UPDATE Locales 
				SET Locales.lon=:valLon, Locales.lat=:valLat, Locales.nombre=:valNom, Locales.des=:valDes, Locales.fono=:valFon, Locales.correo=:valCor, Locales.web=:valWeb 
				WHERE Locales.ind=:valInd;'; 
		$result = $conn->prepare($sql); 
		$result->bindValue(':valLon', $_POST["Long"], PDO::PARAM_STR);
		$result->bindValue(':valLat', $_POST["Lati"], PDO::PARAM_STR);
		$result->bindValue(':valNom', $_POST["NomLoc"], PDO::PARAM_STR);
		$result->bindValue(':valDes', $descripcionLoc, PDO::PARAM_STR);
		$result->bindValue(':valFon', $fonoLocal, PDO::PARAM_STR);
		$result->bindValue(':valCor', $correoLocal, PDO::PARAM_STR);
		$result->bindValue(':valWeb', "https://".$webLocal, PDO::PARAM_STR);
		$result->bindValue(':valInd', $_POST["Recinto"], PDO::PARAM_INT);
		$result->execute(); 
		$indiceLocal=$_POST["Recinto"];
	}

	

	//tabla Galeria del Recinto
	if (isset($rutaRec1)) {
		# code...
		$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaRec1, PDO::PARAM_STR);
			$result->execute();
		move_uploaded_file($_FILES['FotoRec1']['tmp_name'], "../".$rutaRec1);
	}
	if (isset($rutaRec2)) {
		# code...
		$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaRec2, PDO::PARAM_STR);
			$result->execute();
		move_uploaded_file($_FILES['FotoRec2']['tmp_name'], "../".$rutaRec2);
	}
	if (isset($rutaRec3)) {
		# code...
		$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaRec3, PDO::PARAM_STR);
			$result->execute();
		move_uploaded_file($_FILES['FotoRec3']['tmp_name'], "../".$rutaRec3);
	}
	if (isset($rutaRec4)) {
		# code...
		$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaRec4, PDO::PARAM_STR);
			$result->execute();
		move_uploaded_file($_FILES['FotoRec4']['tmp_name'], "../".$rutaRec4);
	}
	if (isset($rutaRec5)) {
		# code...
		$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaRec5, PDO::PARAM_STR);
			$result->execute();
		move_uploaded_file($_FILES['FotoRec5']['tmp_name'], "../".$rutaRec5);
	}
	if (isset($rutaRec6)) {
		# code...
		$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaRec6, PDO::PARAM_STR);
			$result->execute();
		move_uploaded_file($_FILES['FotoRec6']['tmp_name'], "../".$rutaRec6);
	}
	if (isset($rutaRec7)) {
		# code...
		$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaRec7, PDO::PARAM_STR);
			$result->execute();
		move_uploaded_file($_FILES['FotoRec7']['tmp_name'], "../".$rutaRec7);
	}
	if (isset($rutaRec8)) {
		# code...
		$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaRec8, PDO::PARAM_STR);
			$result->execute();
		move_uploaded_file($_FILES['FotoRec8']['tmp_name'], "../".$rutaRec8);
	}
	if (isset($rutaRec9)) {
		# code...
		$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaRec9, PDO::PARAM_STR);
			$result->execute();
		move_uploaded_file($_FILES['FotoRec9']['tmp_name'], "../".$rutaRec9);
	}
	if (isset($rutaRec10)) {
		# code...
		$sql = 'INSERT INTO GaleriasLoc(indLocal,img) VALUES (:valLoc,:valImg);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
			$result->bindValue(':valImg', $rutaRec10, PDO::PARAM_STR);
			$result->execute();
		move_uploaded_file($_FILES['FotoRec10']['tmp_name'], "../".$rutaRec10);
	}
	if (isset($rutaFly)) {
		# code...
		$sql = 'UPDATE Eventos SET Eventos.fly=:valFly WHERE Eventos.ind=:valEve;'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valEve', $_POST["IndEvento"], PDO::PARAM_INT);
			$result->bindValue(':valFly', $rutaFly, PDO::PARAM_STR);
			$result->execute();
		//cargamos la foto del evento en una carpeta con su ruta
		move_uploaded_file($_FILES['FotoEve']['tmp_name'], "../".$rutaFly);
	}
	

	// tabla Eventos
	$sql = 'INSERT INTO Eventos(indLoc,fecIni,fecFin,titulo,des,fly,estado,boleto) VALUES (:valLoc,:valIni,:valFin,:valTit,:valDes,:valFly,:valEstado,:valBol);'; 
	$result = $conn->prepare($sql); 
	$result->bindValue(':valLoc', $indiceLocal, PDO::PARAM_INT);
	$result->bindValue(':valIni', $fechaInicio, PDO::PARAM_STR);
	$result->bindValue(':valFin', $fechaFin, PDO::PARAM_STR);
	$result->bindValue(':valTit', $_POST["TituloEve"], PDO::PARAM_STR);
	$result->bindValue(':valDes', $descripcionEve, PDO::PARAM_STR);
	$result->bindValue(':valFly', $rutaFinal, PDO::PARAM_STR);
	$result->bindValue(':valEstado', 0, PDO::PARAM_INT);
	$result->bindValue(':valBol', $boletos, PDO::PARAM_STR);
	$result->execute(); 
	$lastIdEve = $conn->lastInsertId();

	// tabla Categorias
	foreach ($cates as $valor) {
		if ($valor!="") {
			# code...
			$sql = 'INSERT INTO CategoriasEve(indEve,indCat) VALUES (:valEve,:valCat);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valEve', $lastIdEve, PDO::PARAM_INT);
			$result->bindValue(':valCat', $valor, PDO::PARAM_INT);
			$result->execute();
		}
	}

	//tabla Sinapsis
	$sql = 'INSERT INTO Sinapsis(indUsu,indEve,nivel) VALUES (:valUsu,:valEve,:valNiv);'; 
	$result = $conn->prepare($sql); 
	$result->bindValue(':valUsu', $_POST["indiceUsu"], PDO::PARAM_INT);
	$result->bindValue(':valEve', $lastIdEve, PDO::PARAM_INT);
	$result->bindValue(':valNiv', 0, PDO::PARAM_INT);
	$result->execute();
	

	$conn->commit(); 

	//cargamos la foto del evento en una carpeta con su ruta
	move_uploaded_file($_FILES['FotoEve']['tmp_name'], "../".$rutaFinal);

	//cargamos las nuevas fotos del recinto

	echo json_encode(arreglo('<p>Ahora nuestros administradores evaluaran si publicar tu evento</p>',0), JSON_FORCE_OBJECT);
	die();

	} catch (PDOException $e) { 
	// si ocurre un error hacemos rollback para anular todos los insert 
	$conn->rollback(); 
	//echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
	//die();
	echo $e->getMessage();
	}

}else{
	echo json_encode(arreglo('Error Inesperado',1), JSON_FORCE_OBJECT);
	die();
};//Fin condicional para saber si todos los campos necesarios están completos


?>