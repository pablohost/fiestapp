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

if (isset($_SESSION['objetivo'])&&isset($_POST["ind"])&&isset($_POST["mod"])) {
    # code...
    // conectar la base da datos 

    $config = parse_ini_file('config.ini');

    $host = 'localhost'; 
    $conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // iniciar transacción 
    $conn->beginTransaction();

    try { 
        
        if ($_POST["mod"]==1) {
            //MODO 1 - USUARIO/RECINTO
            $sql = 'SELECT Usuarios.ind,Locales.ind 
                    FROM Locales 
                    INNER JOIN Eventos ON Eventos.indLoc = Locales.ind
                    INNER JOIN Sinapsis ON Sinapsis.indEve = Eventos.ind
                    INNER JOIN Usuarios ON Usuarios.ind = Sinapsis.indUsu
                    WHERE Locales.ind = :valLoc
                    AND Usuarios.ind = :valUsu;';

            $result = $conn->prepare($sql); 
            $result->bindValue(':valLoc', $_POST["ind"], PDO::PARAM_INT);
            $result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT); 
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
                    echo json_encode(arreglo("OK",0), JSON_FORCE_OBJECT);
                    die();
                }
            }else{
                $conn->commit();
                echo json_encode(arreglo("ERROR",1), JSON_FORCE_OBJECT);
                die();
            }
        }elseif ($_POST["mod"]==2) {
            //MODO 2 - USUARIO/FOTO-RECINTO
            $sql = 'SELECT Usuarios.ind,Locales.ind,GaleriasLoc.ind 
                    FROM GaleriasLoc 
                    INNER JOIN Locales ON Locales.ind = GaleriasLoc.indLocal
                    INNER JOIN Eventos ON Eventos.indLoc = Locales.ind
                    INNER JOIN Sinapsis ON Sinapsis.indEve = Eventos.ind
                    INNER JOIN Usuarios ON Usuarios.ind = Sinapsis.indUsu
                    WHERE GaleriasLoc.ind = :valFot
                    AND Usuarios.ind = :valUsu;';

            $result = $conn->prepare($sql); 
            $result->bindValue(':valFot', $_POST["ind"], PDO::PARAM_INT);
            $result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT); 
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
                    echo json_encode(arreglo("OK",0), JSON_FORCE_OBJECT);
                    die();
                }
            }else{
                $conn->commit();
                echo json_encode(arreglo("ERROR",1), JSON_FORCE_OBJECT);
                die();
            }
        }elseif ($_POST["mod"]==3) {
            //MODO 3 - USUARIO/EVENTO
            $sql = 'SELECT Usuarios.ind,Eventos.ind 
                    FROM Eventos 
                    INNER JOIN Sinapsis ON Sinapsis.indEve = Eventos.ind
                    INNER JOIN Usuarios ON Usuarios.ind = Sinapsis.indUsu
                    WHERE Eventos.ind = :valEve
                    AND Usuarios.ind = :valUsu;';

            $result = $conn->prepare($sql); 
            $result->bindValue(':valEve', $_POST["ind"], PDO::PARAM_INT);
            $result->bindValue(':valUsu', $_SESSION['objetivo'], PDO::PARAM_INT); 
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
                    echo json_encode(arreglo("OK",0), JSON_FORCE_OBJECT);
                    die();
                }
            }else{
                $conn->commit();
                echo json_encode(arreglo("ERROR",1), JSON_FORCE_OBJECT);
                die();
            }
        }
        
    } catch (PDOException $e) { 
        // si ocurre un error hacemos rollback para anular todos los insert 
        $conn->rollback(); 
        //echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
        //die();
        echo $e->getMessage();
    }
}else{
    echo json_encode(arreglo("ERROR CRITICO",1), JSON_FORCE_OBJECT);
    die();
}
?>