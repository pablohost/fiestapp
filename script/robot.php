<?php
header('Content-Type: application/json; charset=utf-8');
$recaptcha = $_POST["g-recaptcha-response"];

//cuenteo
function arreglo($msg,$cod){
	//cod  0=bueno & 1=malo
	 return $datos= array(
		'msg' => $msg,
		'cod' => $cod
	);
}

 
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
	'secret' => '6LfMScQUAAAAAEPfzia4fI4UZnPZ9yr3NZSwmXu6',
	'response' => $recaptcha
);
$options = array(
	'http' => array (
		'method' => 'POST',
		'header' => "Content-Type: application/x-www-form-urlencoded",
		'content' => http_build_query($data)
	)
);
$context  = stream_context_create($options);
$verify = file_get_contents($url, false, $context);
$captcha_success = json_decode($verify);
if ($captcha_success->success) {
	// No eres un robot, continuamos 

	echo json_encode(arreglo('No eres un robot',0), JSON_FORCE_OBJECT);
	die();
	// ...
} else {
	// Eres un robot!
	echo json_encode(arreglo('Eres un robot?',1), JSON_FORCE_OBJECT);
	die();
}

?>