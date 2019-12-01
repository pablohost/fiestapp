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

if(isset($_POST["Nombre"]) && isset($_POST["Apelli"]) && isset($_POST["Correo"]) && isset($_POST["Clave1"]) && isset($_POST["Clave2"]) && isset($_POST["Genero"]) && isset($_POST["Edad"]) && isset($_POST["Fono"]) && isset($_POST["TipoU"])) {
	// se encripta la clave
	$Clave=password_hash($_POST["Clave1"], PASSWORD_DEFAULT);
	//se crea codigo de seguridad para recuperar clave
	$Seg="fiestapp".rand(100000, 999999);

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
	

	// tabla 1 
	$sql = 'INSERT INTO Usuarios(indTip,indGen,priv,correo,clave,nombre,apelli,fono,edad,estado,foto,seg) VALUES (:valTipo,:valGen,:valPriv,:valCor,:valCla,:valNom,:valApe,:valFono,:valEdad,:valEst,:valFoto,:valSeg);'; 
	$result = $conn->prepare($sql); 
	$result->bindValue(':valTipo', $_POST["TipoU"], PDO::PARAM_INT);
	$result->bindValue(':valGen', $_POST["Genero"], PDO::PARAM_INT);
	$result->bindValue(':valPriv', 0, PDO::PARAM_INT);
	$result->bindValue(':valCor', strtolower($_POST["Correo"]), PDO::PARAM_STR);
	$result->bindValue(':valCla', $Clave, PDO::PARAM_STR);
	$result->bindValue(':valNom', $_POST["Nombre"], PDO::PARAM_STR);
	$result->bindValue(':valApe', $_POST["Apelli"], PDO::PARAM_STR);
	$result->bindValue(':valFono', $_POST["Fono"], PDO::PARAM_STR);
	$result->bindValue(':valEdad', $_POST["Edad"], PDO::PARAM_INT);
	$result->bindValue(':valEst', 0, PDO::PARAM_INT);
	$result->bindValue(':valFoto', "galeriaComunidad/fiestero.jpg", PDO::PARAM_STR);
	$result->bindValue(':valSeg', $Seg, PDO::PARAM_STR);
	$result->execute(); 
	$conn->commit(); 

	// Enviamos correo de bienvenida
	$tipoUsuario="";
	if ($_POST["TipoU"]==2) {
		# code...
		$tipoUsuario="Si";
	} else {
		# code...
		$tipoUsuario="No";
	}

	$genero="";
	if ($_POST["Genero"]==1) {
		# code...
		$genero="No Responde";
	} else if ($_POST["Genero"]==2){
		# code...
		$genero="No Binario";
	} else if ($_POST["Genero"]==3){
		# code...
		$genero="Mujer";
	} else if ($_POST["Genero"]==4){
		# code...
		$genero="Hombre";
	}

	$edad="";
	if ($_POST["Edad"]==0) {
		# code...
		$edad="No Responde";
	} else {
		# code...
		$edad=$_POST["Edad"]." Años";
	}

	$fono="";
	if ($_POST["Fono"]==0) {
		# code...
		$fono="No Responde";
	} else {
		# code...
		$fono="+569 ".$_POST["Fono"];
	}
	

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