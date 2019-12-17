<?php
header('Content-Type: application/json; charset=utf-8');

function arreglo($msg,$cod){
    //cod  0=bueno & 1=malo
     return $datos= array(
        'msg' => $msg,
        'cod' => $cod
    );
}
$mensaje="";
// conectar la base da datos 

$config = parse_ini_file('config.ini');

$host = 'localhost'; 
$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// iniciar transacción 
$conn->beginTransaction();

try { 

    // BUSCAMOS EL RECINTO
    $sql = 'SELECT GaleriasLoc.img
            FROM GaleriasLoc
            WHERE GaleriasLoc.indLocal=:valInd;';

    $result = $conn->prepare($sql); 
    $result->bindValue(':valInd', $_POST['x'], PDO::PARAM_INT); 
    // Especificamos el fetch mode antes de llamar a fetch()
    $result->setFetchMode(PDO::FETCH_BOTH);
    // Ejecutamos
    $result->execute();
    //Comprobamos si encontro el evento activo
    $filas=$result->rowCount();
    if ($filas!=0) {
      // Mostramos los resultados
      while ($row = $result->fetch()){
        //guardamos todos los datos de la BD en variables
        $mensaje.="<img alt='Foto del Recinto' src='".$row[0]."' data-image='". $row[0] ."' data-description="">";
      }
      echo json_encode(arreglo($mensaje,0), JSON_FORCE_OBJECT);
      die();
    }else{
      $mensaje.="<h5>No hay fotos de este recinto.</h5>";
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
?>