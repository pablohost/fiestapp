<?php
header('Content-Type: application/json; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//cuenteo
function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}

if(isset($_POST["Nombre"]) && isset($_POST["Apelli"]) && isset($_POST["Correo"]) && isset($_POST["Clave1"]) && isset($_POST["Clave2"]) && isset($_POST["TituloEve"]) && isset($_POST["DtIni"]) && isset($_POST["HrIni"]) && isset($_POST["DtFin"]) && isset($_POST["HrFin"]) && isset($_POST["Long"]) && isset($_POST["Lati"]) && isset($_POST["NomLoc"])) {

	// se encripta la clave
	$Clave=password_hash($_POST["Clave1"], PASSWORD_DEFAULT);
	//se crea codigo de seguridad para recuperar clave
	$Seg="fiestapp".rand(100000, 999999);
	//se define la ruta de la foto $_FILES['FotoEve']['tmp_name']
	$formatoFoto=explode("/",$_FILES['FotoEve']['type']);
	$rutaFinal="galeriaEventos/fiestapp".rand(10000000, 99999999).".".$formatoFoto[1];
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
	//se identifica si se agrego descripcion
	$descripcion="";
	if ($_POST["descEventoBR"]!="") {
		# code...
		$descripcion=$_POST["descEventoBR"];
	}else{
		$descripcion="";
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
		echo json_encode(arreglo('La fecha y hora ingresada no puede ser anterior al dia de hoy.',3), JSON_FORCE_OBJECT);
		die();
	}
	if ($fechaInicio>$fechaFin) {
		# code...
		echo json_encode(arreglo('La fecha y hora de termino no puede ser anterior a la de inicio.',3), JSON_FORCE_OBJECT);
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
	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host,$config['username'], $config['password']); 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// iniciar transacción 
	$conn->beginTransaction();

	try { 

	// BUSCAMOS EL CORREO
	$sql = 'SELECT Usuarios.correo, Usuarios.estado 
	FROM Usuarios 
	WHERE Usuarios.correo = :valCorreo;';

	$result = $conn->prepare($sql); 
	$result->bindValue(':valCorreo', strtolower($_POST["Correo"]), PDO::PARAM_STR); 
	// Especificamos el fetch mode antes de llamar a fetch()
	$result->setFetchMode(PDO::FETCH_ASSOC);
	// Ejecutamos
	$result->execute();
	// Mostramos los resultados
	while ($row = $result->fetch()){
		if ($row["correo"]==strtolower($_POST["Correo"])&& $row["estado"]==0) {
			# code...
			echo json_encode(arreglo('Correo Electronico Invalido',2), JSON_FORCE_OBJECT);
			die();
		}
	}
	

	// tabla capPersonas
	$sql = 'INSERT INTO CapPersonas(max,uso) VALUES (:valMax,:valUso);'; 
	$result = $conn->prepare($sql); 
	$result->bindValue(':valMax', 0, PDO::PARAM_INT);
	$result->bindValue(':valUso', 0, PDO::PARAM_INT);
	$result->execute(); 
	$lastIdPer = $conn->lastInsertId();

	// tabla Estacionamientos
	$sql = 'INSERT INTO Estacionamientos(max,uso) VALUES (:valMax,:valUso);'; 
	$result = $conn->prepare($sql); 
	$result->bindValue(':valMax', 0, PDO::PARAM_INT);
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
	$result->bindValue(':valDes', "", PDO::PARAM_STR);
	$result->bindValue(':valFon', $fonoLocal, PDO::PARAM_STR);
	$result->bindValue(':valCor', $correoLocal, PDO::PARAM_STR);
	$result->bindValue(':valWeb', "https://".$webLocal, PDO::PARAM_STR);
	$result->bindValue(':valEstado', 0, PDO::PARAM_INT);
	$result->execute(); 
	$lastIdLoc = $conn->lastInsertId();

	// tabla Eventos
	$sql = 'INSERT INTO Eventos(indLoc,fecIni,fecFin,titulo,des,fly,estado,boleto) VALUES (:valLoc,:valIni,:valFin,:valTit,:valDes,:valFly,:valEstado,:valBol);'; 
	$result = $conn->prepare($sql); 
	$result->bindValue(':valLoc', $lastIdLoc, PDO::PARAM_INT);
	$result->bindValue(':valIni', $fechaInicio, PDO::PARAM_STR);
	$result->bindValue(':valFin', $fechaFin, PDO::PARAM_STR);
	$result->bindValue(':valTit', $_POST["TituloEve"], PDO::PARAM_STR);
	$result->bindValue(':valDes', $descripcion, PDO::PARAM_STR);
	$result->bindValue(':valFly', $rutaFinal, PDO::PARAM_STR);
	$result->bindValue(':valEstado', 0, PDO::PARAM_INT);
	$result->bindValue(':valBol', $boletos, PDO::PARAM_STR);
	$result->execute(); 
	$lastIdEve = $conn->lastInsertId();

	// tabla Categorias
	foreach ($cates as $valor) {
		if ($valor!="") {
			# code...
			$sql = 'INSERT INTO CategoriasEve(indEve,indCat,estado) VALUES (:valEve,:valCat,:valEst);'; 
			$result = $conn->prepare($sql); 
			$result->bindValue(':valEve', $lastIdEve, PDO::PARAM_INT);
			$result->bindValue(':valCat', $valor, PDO::PARAM_INT);
			$result->bindValue(':valEst', 0, PDO::PARAM_INT);
			$result->execute();
		}
	}

	//tabla Usuarios
	$sql = 'INSERT INTO Usuarios(indTip,indGen,priv,correo,clave,nombre,apelli,fono,edad,estado,foto,seg) VALUES (:valTipo,:valGen,:valPriv,:valCor,:valCla,:valNom,:valApe,:valFono,:valEdad,:valEst,:valFoto,:valSeg);'; 
	$result = $conn->prepare($sql); 
	$result->bindValue(':valTipo', 2, PDO::PARAM_INT);
	$result->bindValue(':valGen', 1, PDO::PARAM_INT);
	$result->bindValue(':valPriv', 0, PDO::PARAM_INT);
	$result->bindValue(':valCor', strtolower($_POST["Correo"]), PDO::PARAM_STR);
	$result->bindValue(':valCla', $Clave, PDO::PARAM_STR);
	$result->bindValue(':valNom', $_POST["Nombre"], PDO::PARAM_STR);
	$result->bindValue(':valApe', $_POST["Apelli"], PDO::PARAM_STR);
	$result->bindValue(':valFono', "0", PDO::PARAM_STR);
	$result->bindValue(':valEdad', "0", PDO::PARAM_INT);
	$result->bindValue(':valEst', 0, PDO::PARAM_INT);
	$result->bindValue(':valFoto', "galeriaComunidad/fiestero.jpg", PDO::PARAM_STR);
	$result->bindValue(':valSeg', $Seg, PDO::PARAM_STR);
	$result->execute();
	$lastIdUsu = $conn->lastInsertId();

	//tabla Sinapsis
	$sql = 'INSERT INTO Sinapsis(indUsu,indEve,nivel) VALUES (:valUsu,:valEve,:valNiv);'; 
	$result = $conn->prepare($sql); 
	$result->bindValue(':valUsu', $lastIdUsu, PDO::PARAM_INT);
	$result->bindValue(':valEve', $lastIdEve, PDO::PARAM_INT);
	$result->bindValue(':valNiv', 0, PDO::PARAM_INT);
	$result->execute();
	

	$conn->commit(); 

	//cargamos la foto del evento en una carpeta con su ruta
	move_uploaded_file($_FILES['FotoEve']['tmp_name'], "../".$rutaFinal);

	// Enviamos correo de bienvenida
	$tipoUsuario="Si";

	$genero="Desconocido";

	$edad="No Responde";

	$fono="No Responde";

	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
	    $mail->isSMTP();                                            // Set mailer to use SMTP
	    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'acab.contacto@gmail.com';                     // SMTP username
	    $mail->Password   = '123acab456';                               // SMTP password
	    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
	    $mail->Port       = 465;                                    // TCP port to connect to
	    $mail->CharSet = 'UTF-8';

	    //Recipients
	    $mail->setFrom('acab.contacto@gmail.com', 'FIESTAPP - NO RESPONDER');
	    $mail->addAddress($_POST["Correo"]);     // Add a recipient

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Bienvenide '.$_POST["Nombre"];
	    $mail->Body    = '<html><head></head><body><h1>Bienvenide a FiestApp '.$_POST["Nombre"].' '.$_POST["Apelli"].'</h1><hr>
	    <h2>Estos son los datos de tu cuenta, disfruta de la comunidad!</h2>
	    <p><h3>- Nombre -</h3>'. $_POST["Nombre"] .'</p>
	    <p><h3>- Apellido -</h3>'. $_POST["Apelli"] .'</p>
	    <p><h3>- Correo Electronico -</h3>'. $_POST["Correo"] .'</p>
	    <p><h3>- Organizador de Eventos -</h3>'. $tipoUsuario .'</p><hr>
	    <p><h3>- Genero -</h3>'. $genero .'</p>
	    <p><h3>- Edad -</h3>'. $edad .'</p>
	    <p><h3>- Telefono -</h3>'. $fono .'</p><hr></body></html>';

	    $mail->AltBody    = 'Bienvenide a FiestApp\n No respondas este correo \n Estos son los datos de tu cuenta, disfruta de la comunidad!\n- Nombre - \n'. $_POST["Nombre"] .'\n- Apellido -\n'. $_POST["Apelli"] .'\n- Correo Electronico -\n'. $_POST["Correo"] .'\n- Organizador de Eventos -\n'. $tipoUsuario .'\n- Genero -'. $genero .'\n- Edad -'. $edad .'\n- Telefono -'. $fono;
	    

	    $mail->send();
	    echo json_encode(arreglo('Perfil Creado',0), JSON_FORCE_OBJECT);
		die();

	} catch (Exception $e) {

	    //header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	    //echo json_encode(arreglo('Perfil Creado',0), JSON_FORCE_OBJECT);
		//die();
		echo $e->getMessage();

	}

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