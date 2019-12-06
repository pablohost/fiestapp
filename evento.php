<?php
//Iniciamos la sesión
session_start();


?>
<!DOCTYPE html> 
<!-- 
****************** 
INACAP PUENTE ALTO
PROYECTO DE TITULO - FIESTAPP
INGENIERIA EN INFORMATICA

PABLO G. HENRIQUEZ
DAEG ORELLANA
YERKO ZABALETA
****************** 
--> 
<html> 
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <!--******************css bootstrap / jquery******************--> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"> 

    <!--******************css propio******************--> 
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/estiloEvento.css">

    <!--******************css externo****************** -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://rawgit.com/fitodac/line-awesome/master/dist/css/line-awesome.min.css" crossorigin="anonymous"> 
    <link href="https://fonts.googleapis.com/css?family=Exo+2:400,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/hover-min.css"> 
    
    
      <?php
        if (isset($_GET['titulo']) && isset($_GET['x'])) {
            # code...
          // conectar la base da datos 

          $config = parse_ini_file('script/config.ini');

          $host = 'localhost'; 
          $conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host,$config['username'], $config['password']); 
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // iniciar transacción 
          $conn->beginTransaction();

          try { 

            // BUSCAMOS EL CORREO
            $sql = 'SELECT Eventos.ind,Eventos.fecIni,Eventos.fecFin,Eventos.titulo,Eventos.des,Eventos.fly,Eventos.estado,Eventos.boleto,Locales.lon,Locales.lat,Locales.nombre,Locales.ind,CapPersonas.max,CapPersonas.uso,Estacionamientos.max,Estacionamientos.uso,Usuarios.nombre,Usuarios.apelli,Usuarios.ind
                    FROM Eventos 
                    INNER JOIN Locales ON Eventos.indLoc = Locales.ind
                    INNER JOIN CapPersonas ON Locales.indCap = CapPersonas.ind
                    INNER JOIN Estacionamientos ON Locales.indEst = Estacionamientos.ind
                    INNER JOIN Sinapsis ON Eventos.ind = Sinapsis.indEve
                    INNER JOIN Usuarios ON Sinapsis.indUsu = Usuarios.ind
                    WHERE Eventos.ind=:valInd
                    AND Eventos.estado=0
                    AND Sinapsis.nivel=0;';

            $result = $conn->prepare($sql); 
            $result->bindValue(':valInd', $_GET['x'], PDO::PARAM_INT); 
            // Especificamos el fetch mode antes de llamar a fetch()
            $result->setFetchMode(PDO::FETCH_BOTH);
            // Ejecutamos
            $result->execute();
            //Comprobamos si encontro el evento activo
            $filas=$result->rowCount();
            if ($filas!=0) {
              # code...
              // Mostramos los resultados
              while ($row = $result->fetch()){
                //guardamos todos los datos de la BD en variables
                $indiceEvento=$row[0];
                $fechaInicio=$row[1];
                $fechaTermino=$row[2];
                $tituloEvento=$row[3];
                $descEvento=$row[4];
                $fotoEvento=$row[5];
                $estadoEvento=$row[6];
                $boletoEvento=$row[7];
                $longitud=$row[8];
                $latitud=$row[9];
                $nombreLocal=$row[10];
                $indiceLocal=$row[11];
                $personasMax=$row[12];
                $personasUso=$row[13];
                $estacionamientosMax=$row[14];
                $estacionamientosUso=$row[15];
                $nombreOrganizador=$row[16]." ".$row[17];
                $indiceOrganizador=$row[18];

                //Calculamos y formateamos la fecha del evento - un dia corresponde a 86400
                setlocale(LC_TIME, 'es_CL.UTF-8');
                $fechaNow = time()-10800;
                $fechaInicioNum = strtotime($fechaInicio);
                $fechaFinNum = strtotime($fechaTermino);
                $difInicio = $fechaInicioNum - $fechaNow;
                $dias = round($difInicio/86400, 0, PHP_ROUND_HALF_DOWN);
                $fechaInicioCute=ucfirst(strftime("%A, %d de %B del %Y", $fechaInicioNum));
                //formateamos los horarios del evento
                $hrInicio=date("H:i",$fechaInicioNum);
                $hrFin=date("H:i",$fechaFinNum);

                


      ?>
              <!--******************extra******************--> 
              <title>Eventos FiestApp - <?= $tituloEvento ?></title> 
              <meta name="description" content="Encuentra las mejores fiestas, tocatas, festivales, carretes y mas !"/>
              <link rel="icon" type="image/png" href="../img/favicon.ico">
          </head> 
          <body style="font-family: 'Exo 2', sans-serif;background-color: rgba(86, 0, 39, .5);word-wrap: break-word;" class="text-center"> 
              <!--******************navegador******************-->
      <?php 

              require 'cabeza.php';

      ?>
               <!-- ******************cuerpo****************** -->
              <div class="container-fluid pt-5 paleEvento">
                <div class="row">
                  <div class="col-12" style="padding: 0">
                    <img src="<?= $fotoEvento ?>" class="fotoEvento">
                  </div>
                </div>
                <div class="row py-3 boxEvento">
                  <div class="col-12 col-lg-9">
                    <div class="container-fluid">
                      <div class="row justify-content-center">
                        <div class="col-12">
                          <h1><?= strtoupper($tituloEvento) ?></h1><hr>
                        </div>
                        <div class="col-6 col-md-3">
                          <p class="text-muted">
      <?php
          if ($dias>0) {
            # code...
      ?>
                            <i class="fas fa-hourglass-half"></i> Faltan <?= $dias ?> Dias.
      <?php
          }else if ($dias==0) {
            # code...
      ?>
                            <i class="fas fa-hourglass-half"></i> El evento esta por comenzar.
      <?php
            
          }else if ($dias<0) {
            # code...
            //calculo si es hoy o mañana el evento
            if ($fechaFinNum>$fechaNow) {
              # code...
      ?>
                            <i class="fas fa-fire"></i> El evento es ahora !.
      <?php
            }else{
      ?>
                            <i class="fas fa-calendar-times"></i> Este evento ya finalizo.
      <?php
            }
          }
      ?>
                          </p>
                        </div>
                        <div class="col-6 col-md-3">
                          <p class="text-muted">
                            <i class="fas fa-calendar-day"></i> <?= $fechaInicioCute ?>
                          </p>
                        </div>
                        <div class="col-6 col-md-3">
                          <p class="text-muted">
                            <i class="far fa-clock"></i> <?= $hrInicio ?> a <?= $hrFin ?>
                          </p>
                        </div>
                        <div class="col-6 col-md-3">
                          <p class="text-muted">
                            <i class="fas fa-map-marker-alt"></i> <?= $nombreLocal ?>
                          </p>
                        </div>
                        <div class="col-12 pb-2">
                          <h4><?= $descEvento ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-3 py-3">
                    <div class="container-fluid">
                      <hr>
                      <div class="row">
                        <div class="col-12 py-2">
                          <h4><i class="fas fa-user-tie"></i> Organizador</h4>
                          <p>
                            <a href="portal?perfil=<?= $nombreOrganizador ?>&tipo=2&ind=<?= $indiceOrganizador ?>"><?= $nombreOrganizador ?></a>
                          </p>
                          <hr>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12 py-2">
                          <h4><i class="fas fa-users"></i> Capacidad</h4>
      <?php
          if ($personasMax==0) {
            # code...
      ?>
                          <p class="text-muted"> No Especifica</p>
      <?php
          }else{
      ?>
                          <p class="text-muted"> <?= $personasUso ?> / <?= $personasMax ?></p>
      <?php

          }
      ?>
                          <hr>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12 py-2">
                          <h4><i class="fas fa-car"></i> Estacionamientos</h4>
      <?php
          if ($estacionamientosMax==0) {
            # code...
      ?>
                          <p class="text-muted"> No Especifica</p>
      <?php
          }else{
      ?>
                          <p class="text-muted"> <?= $estacionamientosUso ?> / <?= $estacionamientosMax ?></p>
      <?php

          }
      ?>
                          <hr>
                        </div>
                        <div class="col-12 py-2">
                          <a href="#" role="button" class="btn btn-warning btn-block btn-lg" style="font-weight: bold;" target="_blank">
                              <i class="fas fa-warehouse"></i> VER RECINTO
                          </a>
                        </div>
                        <div class="col-12 py-2">
      <?php
          if ($boletoEvento=="") {
            # code...
      ?>
                          <a href="#" role="button" class="btn btn-warning btn-block btn-lg disabled" style="font-weight: bold;" target="_blank">
                              <i class="fas fa-ticket-alt"></i> ENTRADAS
                          </a>
      <?php
          }else{
      ?>
                          <a href="<?= $boletoEvento ?>" role="button" class="btn btn-warning btn-block btn-lg" style="font-weight: bold;" target="_blank">
                              <i class="fas fa-ticket-alt"></i> ENTRADAS
                          </a>
      <?php
          }
      ?>
                          <hr>
                        </div>
                        
      <?php
          if(isset($_SESSION['usuario']) and $_SESSION['estado'] == 'Autenticado') {
            
            if ($_SESSION['tipo']==1) {
              # code...
      ?>
                        <div class="col-12 py-2">
                          <a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;" target="_blank" id="btnAsisteEvento">
                              <i class="fas fa-calendar-check"></i> ASISTIR
                          </a>
                        </div>
                        <div class="col-12 py-2">
                          <a href="#" role="button" class="btn btn-dark btn-block btn-lg" style="font-weight: bold;" target="_blank" id="btnInvitaAmigo">
                              <i class="fas fa-user-friends"></i> INVITAR AMIGO
                          </a>
                        </div>
      <?php
            } else if ($_SESSION['tipo']==2||$_SESSION['tipo']==3){
              # code...
      ?>
                        <div class="col-12 py-2">
                          <a href="#" role="button" class="btn btn-dark btn-block btn-lg disabled" style="font-weight: bold;" target="_blank" id="btnAsisteEvento">
                              <i class="fas fa-calendar-check"></i> ASISTIR
                          </a>
                        </div>
                        <div class="col-12 py-2">
                          <a href="#" role="button" class="btn btn-dark btn-block btn-lg disabled" style="font-weight: bold;" target="_blank" id="btnInvitaAmigo">
                              <i class="fas fa-user-friends"></i> INVITAR AMIGO
                          </a>
                        </div>
      <?php
            }
              
          } else {
      ?>
                        <div class="col-12 py-2">
                          <a href="#" role="button" class="btn btn-dark btn-block btn-lg disabled" style="font-weight: bold;" target="_blank" id="btnAsisteEvento">
                              <i class="fas fa-calendar-check"></i> ASISTIR
                          </a>
                        </div>
                        <div class="col-12 py-2">
                          <a href="#" role="button" class="btn btn-dark btn-block btn-lg disabled" style="font-weight: bold;" target="_blank" id="btnInvitaAmigo">
                              <i class="fas fa-user-friends"></i> INVITAR AMIGO
                          </a>
                        </div>
      <?php
          };
      ?>
                        <div class="col-12 py-2">
                          <hr>
                          <p>mapa</p>
                          <p>mapa</p>
                          <p>mapa</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <hr>
                    <h2 class="text-left pl-3"><i class="far fa-star"></i> Reseñas</h2>
                  </div>
                  <br><br>
                </div>
      <?php

              }
            }else{
      ?>
            <!--******************extra******************--> 
            <title>Eventos FiestApp - Evento Desconocido</title> 
            <meta name="description" content="Encuentra las mejores fiestas, tocatas, festivales, carretes y mas !"/>
            <link rel="icon" type="image/png" href="../img/favicon.ico">
        </head> 
        <body style="font-family: 'Exo 2', sans-serif;background-color: rgba(86, 0, 39, .5);" class="text-center"> 
            <!--******************navegador******************-->
      <?php 

            require 'cabeza.php';

      ?>
             <!-- ******************cuerpo****************** -->
            <div class="container-fluid pt-5 paleEvento">
              <div class="row">
                <div class="col-12">
                  <h1>EVENTO NO ENCONTRADO !</h1>
                </div>
              </div>
      <?php
            }
            
          } catch (PDOException $e) { 
          // si ocurre un error hacemos rollback para anular todos los insert 
          $conn->rollback(); 
          //echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
          //die();
          echo $e->getMessage();
          }
        }else{
      ?>
    <!--******************extra******************--> 
    <title>Eventos FiestApp - Evento Desconocido</title> 
    <meta name="description" content="Encuentra las mejores fiestas, tocatas, festivales, carretes y mas !"/>
    <link rel="icon" type="image/png" href="../img/favicon.ico">
</head> 
<body style="font-family: 'Exo 2', sans-serif;background-color: rgba(86, 0, 39, .5);" class="text-center"> 
    <!--******************navegador******************-->
<?php 

    require 'cabeza.php';

?>
     <!-- ******************cuerpo****************** -->
    <div class="container-fluid pt-5 paleEvento">
      <div class="row">
        <div class="col-12">
          <h1>EVENTO NO ENCONTRADO !</h1>
        </div>
      </div>
      <?php
        }
      ?>
    </div>

    <!-- ******************pie de pagina****************** --> 
    <?php 

    require 'pie.php';

    ?>
    
    <!--script bootstrap / jquery--> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 

    <!--script propios--> 
    <script src="script/jsGlobal.js"></script>
    <script src="script/jsRecuperar.js"></script>
 
    <!--script externos--> 
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
    <script src="https://unpkg.com/popper.js"></script>
    <script src="https://unpkg.com/tooltip.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body> 
 
</html>