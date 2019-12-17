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

//creamos el select
$mensaje = '<select class="form-control" id="cbxRecintos" name="Recinto">
                <option value="0">Nuevo Recinto</option>';

// conectar la base da datos 

$config = parse_ini_file('config.ini');

$host = 'localhost'; 
$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// iniciar transacción 
$conn->beginTransaction();

try { 

    // BUSCAMOS SI EL USUARIO YA DENUNCIO EL EVENTO
    $sql = 'SELECT DISTINCT Locales.ind,Locales.nombre
            FROM Sinapsis
            INNER JOIN Eventos ON Eventos.ind = Sinapsis.indEve
            INNER JOIN Locales ON Locales.ind = Eventos.indLoc
            WHERE Locales.estado=0
            AND Sinapsis.indUsu=:valInd;';

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
            $mensaje .= '<option value="'.$row[0].'">'.$row[1].'</option>';
        }
    }else{
        $mensaje .= '</select>';
        echo json_encode(arreglo($mensaje,1), JSON_FORCE_OBJECT);
        die();
    }
    $conn->commit();
    $mensaje .= '</select>';
    echo json_encode(arreglo($mensaje,0), JSON_FORCE_OBJECT);
    die();
} catch (PDOException $e) { 
    // si ocurre un error hacemos rollback para anular todos los insert 
    $conn->rollback(); 
    //echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
    //die();
    echo $e->getMessage();
}
?>