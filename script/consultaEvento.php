<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
//cuenteo
function arreglo($indEvento,$fecIni,$fecFin,$hrIni,$hrFin,$tituloEvento,$desEvento,$boleto,$indRecinto,$lon,$lat,$nombreRecinto,$desRecinto,$fono,$correo,$web,$cap,$est,$cates,$usu){
    //cod  0=bueno & 1=malo
     return $datos= array(
        'indEvento' => $indEvento,
        'fecIni' => $fecIni,
        'fecFin' => $fecFin,
        'hrIni' => $hrIni,
        'hrFin' => $hrFin,
        'tituloEvento' => $tituloEvento,
        'desEvento' => $desEvento,
        'boleto' => $boleto,
        'indRecinto' => $indRecinto,
        'lon' => $lon,
        'lat' => $lat,
        'nombreRecinto' => $nombreRecinto,
        'desRecinto' => $desRecinto,
        'fono' => $fono,
        'correo' => $correo,
        'web' => $web,
        'cap' => $cap,
        'est' => $est,
        'cates' => $cates,
        'usu' => $usu
    );
};
// conectar la base da datos 

$config = parse_ini_file('config.ini');

$host = 'localhost'; 
$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// iniciar transacción 
$conn->beginTransaction();

try { 
    // BUSCAMOS CATEGORIAS DEL EVENTO
    $sql = 'SELECT Categorias.ind
            FROM Categorias
            INNER JOIN CategoriasEve ON CategoriasEve.indCat = Categorias.ind
            WHERE CategoriasEve.indEve=:valInd
            AND CategoriasEve.estado=0;';

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
        $temp=0;
        while ($row = $result->fetch()){
            $cates[$temp]= $row[0];
            $temp+=1;
        }
    }else{
        $conn->commit();
        //echo json_encode(arreglo(0,"","","ERROR","ERROR","ERROR",0,0,0,"ERROR","ERROR","ERROR","ERROR","ERROR",0,0), JSON_FORCE_OBJECT);
        die();
    }
    // BUSCAMOS DATOS DEL EVENTO Y RECINTO
    $sql = 'SELECT Eventos.ind,Eventos.fecIni,Eventos.fecFin,Eventos.titulo,Eventos.des,Eventos.boleto,Locales.ind,Locales.lon,Locales.lat,Locales.nombre,Locales.des,Locales.fono,Locales.correo,Locales.web,CapPersonas.max,Estacionamientos.max
            FROM Eventos
            INNER JOIN Locales ON Eventos.indLoc = Locales.ind
            INNER JOIN CapPersonas ON CapPersonas.ind = Locales.indCap
            INNER JOIN Estacionamientos ON Estacionamientos.ind = Locales.indEst
            WHERE Eventos.estado=0
            AND Eventos.ind=:valInd;';

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
            //Calculamos y formateamos la fecha del evento - un dia corresponde a 86400
            $fechaInicioNum = strtotime($row[1]);
            $fechaFinNum = strtotime($row[2]);
            $fechaIni=date("Y-m-d", $fechaInicioNum);
            $fechaFin=date("Y-m-d", $fechaFinNum);
            //formateamos los horarios del evento
            $hrIni=date("H:i",$fechaInicioNum);
            $hrFin=date("H:i",$fechaFinNum);

            echo json_encode(arreglo($row[0],$fechaIni,$fechaFin,$hrIni,$hrFin,$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$cates,$_SESSION['objetivo']), JSON_FORCE_OBJECT);
            die();
        }
    }else{
        $conn->commit();
        echo json_encode(arreglo(0,"","","00:00","00:00","ERROR","ERROR","ERROR",0,0,0,"ERROR","ERROR","ERROR","ERROR","ERROR",0,0,0,0), JSON_FORCE_OBJECT);
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