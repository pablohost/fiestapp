<?php
header('Content-Type: application/json; charset=utf-8');
//cuenteo
function arreglo($capMax,$capUso,$estMax,$estUso,$dias,$estadoEvento,$cod){
    //cod  0=bueno & 1=malo
     return $datos= array(
        'capMax' => $capMax,
        'capUso' => $capUso,
        'estMax' => $estMax,
        'estUso' => $estUso,
        'dias' => $dias,
        'estadoEvento' => $estadoEvento,
        'cod' => $cod
    );
}

//variables
$mensaje = '';
$estadoEvento=0;
$dias=0;
// conectar la base da datos 

$config = parse_ini_file('config.ini');

$host = 'localhost'; 
$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// iniciar transacción 
$conn->beginTransaction();

try { 

    // BUSCAMOS SI EL USUARIO YA DENUNCIO EL EVENTO
    $sql = 'SELECT CapPersonas.max,CapPersonas.uso,Estacionamientos.max,Estacionamientos.uso,Eventos.fecIni,Eventos.fecFin
            FROM Eventos
            INNER JOIN Locales ON Locales.ind = Eventos.indLoc
            INNER JOIN CapPersonas ON CapPersonas.ind = Locales.indCap
            INNER JOIN Estacionamientos ON Estacionamientos.ind = Locales.indEst
            WHERE  Eventos.ind =:valInd;';

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
            $capMax=$row[0];
            $capUso=$row[1];
            $estMax=$row[2];
            $estUso=$row[3];
            $fechaInicio=$row[4];
            $fechaTermino=$row[5];
            //Calculamos y formateamos la fecha del evento - un dia corresponde a 86400
            setlocale(LC_TIME, 'es_CL.UTF-8');
            $fechaNow = time()-10800;
            $fechaInicioNum = strtotime($fechaInicio);
            $fechaFinNum = strtotime($fechaTermino);
            $difInicio = $fechaInicioNum - $fechaNow;
            //variable para saber estado del evento - 0 Aun no comienza, 1 El evento es ahora, 2 El evento finalizo
            if ($fechaInicioNum<$fechaNow&&$fechaFinNum>$fechaNow) {
                # code...
                //el evento es ahora
                $estadoEvento=1;
            }else if ($fechaInicioNum>$fechaNow) {
                # code...
                //el evento aun no comienza
                $estadoEvento=0;
                $dias = floor($difInicio/86400);
            }else if ($fechaFinNum<$fechaNow) {
                # code...
                //el evento finalizao
                $estadoEvento=2;
            }
        }
    }else{
        echo json_encode(arreglo(0,0,0,0,0,0,0), JSON_FORCE_OBJECT);
        die();
    }
    $conn->commit();
    echo json_encode(arreglo($capMax,$capUso,$estMax,$estUso,$dias,$estadoEvento,1), JSON_FORCE_OBJECT);
    die();
} catch (PDOException $e) { 
    // si ocurre un error hacemos rollback para anular todos los insert 
    $conn->rollback(); 
    //echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
    //die();
    echo $e->getMessage();
}
?>