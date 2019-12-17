<?php
header('Content-Type: application/json; charset=utf-8');
//cuenteo
function arreglo($ind,$lon,$lat,$nombre,$des,$fono,$correo,$web,$cap,$est){
    //cod  0=bueno & 1=malo
     return $datos= array(
        'ind' => $ind,
        'lon' => $lon,
        'lat' => $lat,
        'nombre' => $nombre,
        'des' => $des,
        'fono' => $fono,
        'correo' => $correo,
        'web' => $web,
        'cap' => $cap,
        'est' => $est
    );
}
// conectar la base da datos 

$config = parse_ini_file('config.ini');

$host = 'localhost'; 
$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// iniciar transacción 
$conn->beginTransaction();

try { 

    // BUSCAMOS SI EL USUARIO YA DENUNCIO EL EVENTO
    $sql = 'SELECT Locales.ind,Locales.lon,Locales.lat,Locales.nombre,Locales.des,Locales.fono,Locales.correo,Locales.web,CapPersonas.max,Estacionamientos.max
            FROM Locales
            INNER JOIN CapPersonas ON CapPersonas.ind = Locales.indCap
            INNER JOIN Estacionamientos ON Estacionamientos.ind = Locales.indEst
            WHERE Locales.estado=0
            AND Locales.ind=:valInd;';

    $result = $conn->prepare($sql); 
    $result->bindValue(':valInd', $_POST["x"], PDO::PARAM_INT); 
    // Especificamos el fetch mode antes de llamar a fetch()
    $result->setFetchMode(PDO::FETCH_BOTH);
    // Ejecutamos
    $result->execute();
    //Comprobamos si encontro el registro
    $filas=$result->rowCount();
    if ($filas!=0) {
        # code...
        while ($row = $result->fetch()){
            $conn->commit();
            echo json_encode(arreglo($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9]), JSON_FORCE_OBJECT);
            die();
        }
    }else{
        $conn->commit();
        echo json_encode(arreglo(0,"ERROR","ERROR","ERROR","ERROR","ERROR","ERROR",0,0), JSON_FORCE_OBJECT);
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