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
    <link rel='stylesheet' href='css/unite-gallery.css' type='text/css' />
    <link rel="stylesheet" href="css/lunar.css"> 
    
    
      <?php
        if (isset($_GET['nombre']) && isset($_GET['x'])) {
            # code...
          // conectar la base da datos 

          $config = parse_ini_file('script/config.ini');

          $host = 'localhost'; 
          $conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host,$config['username'], $config['password']); 
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // iniciar transacción 
          $conn->beginTransaction();

          try { 

            // BUSCAMOS EL RECINTO
            $sql = 'SELECT Locales.lon, Locales.lat, Locales.nombre, Locales.des, Locales.fono, Locales.correo, Locales.web, CapPersonas.max, CapPersonas.uso, Estacionamientos.max, Estacionamientos.uso
                      FROM Locales
                      INNER JOIN CapPersonas ON CapPersonas.ind = Locales.indCap
                      INNER JOIN Estacionamientos ON Estacionamientos.ind = Locales.indEst
                      WHERE Locales.ind = :valInd
                      AND Locales.estado = 0;';

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
                $longitud=$row[0];
                $latitud=$row[1];
                $nombreLocal=$row[2];
                $desLocal=$row[3];
                if ($row[4]=="") {
                  $fonoLocal=" - ";
                }else{
                  $fonoLocal="+569".$row[4];
                }
                if ($row[5]=="") {
                  $correoLocal=" - ";
                }else{
                  $correoLocal=$row[5];
                }
                if ($row[6]=="") {
                  $webLocal=" - ";
                }else{
                  $webLocal=$row[6];
                }
                $personasMax=$row[7];
                $personasUso=$row[8];
                $estacionamientosMax=$row[9];
                $estacionamientosUso=$row[10];
              }
      ?>
              <!--******************extra******************--> 
              <title><?= $nombreLocal ?> - Recintos FiestApp</title> 
              <meta name="description" content="Encuentra las mejores fiestas, tocatas, festivales, carretes y mas !"/>
              <link rel="icon" type="image/png" href="../img/favicon.ico">
          </head> 
          <body class="text-center cuerpoEvento" id="#arriba"> 
              <!--******************navegador******************-->
      <?php 

              require 'cabeza.php';

      ?>
               <!-- ******************cuerpo****************** -->
              <div class="container-fluid pt-5 paleEvento">
                <div class="row py-3 boxEvento">
                  <div class="col-12 col-xl-9">
                    <div class="container-fluid">
                      <div class="row justify-content-center">
                        <div class="col-12">
                          <h1><?= strtoupper($nombreLocal) ?></h1><hr>
                        </div>
                        <div class="col-6 col-md-3">
                          <p class="text-muted">
                            <i class="fas fa-phone-alt"></i> <?= $fonoLocal ?>
                          </p>
                        </div>
                        <div class="col-6 col-md-3">
                          <p class="text-muted">
                            <i class="fas fa-at"></i> <?= $correoLocal ?>
                          </p>
                        </div>
                        <div class="col-6 col-md-3">
                          <p class="text-muted">
                            <i class="fas fa-globe"></i><a href="<?= $webLocal ?>" target="_blank"> <?= str_replace("https://", "", $webLocal) ?></a>
                          </p>
                        </div>
                        <div class="col-6 col-md-3">
                          <p class="text-muted">
                            <i class="fas fa-map-marker-alt"></i> <?= $nombreLocal ?>
                          </p>
                        </div>
                        <div class="col-12 pb-2">
                          <h4><?= $desLocal ?></h4>
                          <hr>
                        </div>
                        <div class="col-12 pb-2 text-left">
                          <h2 class="pl-4">
                            <i class="fas fa-images"></i> Galeria
                          </h2>
                          <div class="container" id="galRecinto">
                            <div id="gallery" style="display:none;">
                            <?php
                            // BUSCAMOS EL RECINTO
                            $sql = 'SELECT GaleriasLoc.img
                                    FROM GaleriasLoc
                                    WHERE GaleriasLoc.indLocal=:valInd;';

                            $result = $conn->prepare($sql); 
                            $result->bindValue(':valInd', $_GET['x'], PDO::PARAM_INT); 
                            // Especificamos el fetch mode antes de llamar a fetch()
                            $result->setFetchMode(PDO::FETCH_BOTH);
                            // Ejecutamos
                            $result->execute();
                            //Comprobamos si encontro el evento activo
                            $filas=$result->rowCount();
                            if ($filas!=0) {
                              // Mostramos los resultados
                              ?>
                              
                              <?php
                              while ($row = $result->fetch()){
                                //guardamos todos los datos de la BD en variables
                                ?>
                                <img alt="Foto del Recinto" src="<?= $row[0]; ?>" data-image="<?= $row[0]; ?>" data-description="">
                                <?php
                              }
                              ?>
                              </div>
                              
                              <?php
                            }else{
                              ?>
                              </div>
                              <h3>No hay fotos de este recinto.</h3>
                              <?php
                            }
                            ?>

                          </div>
                          <hr>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-xl-3 py-3">
                    <div class="container-fluid">
                      <hr>
                      <div class="row">
                        <div class="col-12 col-sm-6 col-xl-12 py-2">
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
                        <div class="col-12 col-sm-6 col-xl-12 py-2">
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
                        </div>
                        <div class="col-12 py-2">
                          <hr>
      <?php
          if(isset($_SESSION['usuario']) and $_SESSION['estado'] == 'Autenticado') {
      ?>
                          <button type="button" class="btn btn-danger btn-block btn-lg" style="font-weight: bold;" target="_blank" id="btnDenunciaEvento" data-toggle="modal" data-target="#demoModal">
                              <i class="fas fa-exclamation-triangle"></i> DENUNCIAR RECINTO
                          </button>
                          <!-- PopUp Denunciar Evento -->
                          <div class="modal fade "   id="demoModal"  tabindex="-1" role="dialog" aria-labelledby="demoModal" aria-hidden="true" id="cierraPop">
                              <div class="modal-dialog   modal-dialog-centered  " role="document">
                                  <div class="modal-content">
                                      <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                      <div class="modal-body">
                                          <div class="popCata">
                                              <div class="px-sm-1 py-sm-5 overlay-light">
                                                  <div class="px-2 py-4">
                                                      <h1 class="pt-sm-3 text-center">DENUNCIAR RECINTO</h1>
                                                      <h5>Selecciona una categoria para que nuestros moderadores puedan evaluar la denuncia.</h5>
                                                      <hr>
                                                      <form name="formDenunciaEve">
                                                        <input name="indicePerfil" type="hidden" value="<?= $_SESSION['objetivo'] ?>">
                                                        <input name="indiceEvento" type="hidden" value="<?= $_GET['x'] ?>">
                                                        <div class="container">
                                                          <div class="row">
                                                            <div class="col-md-6">
                                                              <div class="custom-control custom-radio text-center pb-3 pl-0">
                                                                <input type="radio" class="custom-control-input" name="dn" id="dn1" value="1">
                                                                <label class="custom-control-label" for="dn1">SPAM</label>
                                                              </div>
                                                              <div class="custom-control custom-radio text-center pb-3 pl-0">
                                                                <input type="radio" class="custom-control-input" name="dn" id="dn2" value="2">
                                                                <label class="custom-control-label" for="dn2">ACOSO</label>
                                                              </div>
                                                              <div class="custom-control custom-radio text-center pb-3 pl-0">
                                                                <input type="radio" class="custom-control-input" name="dn" id="dn3" value="3">
                                                                <label class="custom-control-label" for="dn3">CONTENIDO SEXUAL</label>
                                                              </div>
                                                              <div class="custom-control custom-radio text-center pb-3 pl-0">
                                                                <input type="radio" class="custom-control-input" name="dn" id="dn4" value="4">
                                                                <label class="custom-control-label" for="dn4">ESTAFA</label>
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                              <div class="custom-control custom-radio text-center pb-3 pl-0">
                                                                <input type="radio" class="custom-control-input" name="dn" id="dn5" value="5">
                                                                <label class="custom-control-label" for="dn5">VIOLENCIA</label>
                                                              </div>
                                                              <div class="custom-control custom-radio text-center pb-3 pl-0">
                                                                <input type="radio" class="custom-control-input" name="dn" id="dn6" value="6">
                                                                <label class="custom-control-label" for="dn6">UBICACION FALSA</label>
                                                              </div>
                                                              <div class="custom-control custom-radio text-center pb-3 pl-0">
                                                                <input type="radio" class="custom-control-input" name="dn" id="dn7" value="7">
                                                                <label class="custom-control-label" for="dn7">EVENTO FALSO</label>
                                                              </div>
                                                              <div class="custom-control custom-radio text-center pb-3 pl-0">
                                                                <input type="radio" class="custom-control-input" name="dn" id="dn8" value="8">
                                                                <label class="custom-control-label" for="dn8">OTROS</label>
                                                              </div>
                                                            </div>
                                                            <div class="col-12">
                                                              <span class="titInput">Descripcion</span>
                                                                <textarea type="text" id="txtDescDen" rows="4" class="form-control" placeholder="Cuentanos mas sobre tu denuncia (OPCIONAL)" name="DescDen"></textarea>
                                                            </div>  
                                                          </div>
                                                        </div>
                                                        <hr>
                                                        <div class="g-recaptcha" data-sitekey="6LfMScQUAAAAANKeGizusHJd8EQJw5-IVm4-U9Q-" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                                                        <hr>
                                                        <button type="submit" class="btn btn-dark btn-block" data-dismiss="modal" aria-label="Close" id="btnConfirmarDenuncia" style="font-weight: bold;">
                                                          CONFIRMAR <i class="fas fa-check"></i>
                                                        </button>
                                                      </form>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
      <?php
          }else{
      ?>
                          <span class="d-block btnEveCute" tabindex="0" data-toggle="tooltip" title="Debes iniciar sesion">
                            <a href="#" role="button" class="btn btn-danger btn-block btn-lg disabled" style="font-weight: bold;" target="_blank" id="btnDenunciaEvento">
                                <i class="fas fa-exclamation-triangle"></i> DENUNCIAR RECINTO
                            </a>
                          </span>
      <?php
          }
      ?>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <br><br>
                </div>
      <?php

              
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
    <script src="https://unpkg.com/popper.js"></script>
    <!--script bootstrap / jquery--> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 

    <!--script propios--> 
    <script src="script/jsGlobal.js"></script>
    <script src="script/jsRecinto.js"></script>
 
    <!--script externos--> 
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
    <script src="script/lunar.js"></script>
    <script src="https://unpkg.com/tooltip.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type='text/javascript' src='script/unitegallery.min.js'></script>
    <script src='script/ug-theme-tiles.js' type='text/javascript'></script> 
    

</body> 
 
</html>