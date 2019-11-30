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
    <link rel="stylesheet" href="css/estiloRegistro.css">

    <!--******************css externo****************** -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://rawgit.com/fitodac/line-awesome/master/dist/css/line-awesome.min.css" crossorigin="anonymous"> 
    <link href="https://fonts.googleapis.com/css?family=Exo+2:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/hover-min.css"> 
    
    <!--******************extra******************--> 
    <title>REGISTRO USUARIOS</title> 
    <meta name="description" content="Encuentra las mejores fiestas, tocatas, festivales, carretes y mas !"/>
    <link rel="icon" type="image/png" href="../img/favicon.ico">
</head> 
<body style="font-family: 'Exo 2', sans-serif;background-color: rgba(74, 20, 140,1);" id="arriba"> 
    <!--******************navegador******************-->
    <?php 

    require 'cabeza.php';

     ?>

     
    <!-- ******************cuerpo****************** -->
    <div class="container pt-5 mt-5 text-center">
      <h1 class="titRegistro">REGISTRO DE USUARIOS</h1>
      <p class="mt-3 mb-0 text-white helpCute"> Ya tienes una cuenta?, <a style="color: #ffc107!important;" href="http://www.fiestapp.tk/loginC.php">CLICK AQUI</a></p>
      <hr class="hrCute">
    </div>
    
    <div class="container boxRegistro">
        <form id="venta-form" action="" method="POST" name="formRegistro">
            <div class="row justify-content-center">
                <div class="col-12 boxDatos form-group">
                    <!--Filtro de Menores de Edad-->
                    <h4 class="titBox text-center"><i class="fas fa-user-tie"></i> Eres mayor de edad? </h4>
                    <hr>
                    
                    <div class="custom-control custom-switch text-center pb-2" style="padding-left: 0rem!important">
                      <span style="margin-right: 2.4rem;">NO</span>
                      <input type="checkbox" class="custom-control-input" id="swFiltro">
                      <label class="custom-control-label" for="swFiltro">SI</label>
                    </div>
                </div>
                <div class="col-12 boxDatos form-group">
                    <!--Tipo de Usuario-->
                    <h4 class="titBox text-center"><i class="fas fa-people-carry"></i> Eres organizador de eventos? </h4>
                    <hr>
                    <div class="custom-control custom-switch text-center pb-2" style="padding-left: 0rem!important">
                      <span style="margin-right: 2.4rem;">NO</span>
                      <input type="checkbox" class="custom-control-input" id="swTipoU">
                      <label class="custom-control-label" for="swTipoU">SI</label>
                    </div>
                </div>

                <!--REQUERIDA-->
                <div class="col-12 col-md-5 boxDatos form-group">
                    <h4 class="titBox text-center"><i class="fas fa-address-card"></i> Informacion Requerida </h4>
                    <hr>
                    <p class="text-muted">Este nombre sera mostrado en tu perfil publico</p>
                    <!--Nombre-->
                    <span class="titInput">Nombre</span>
                    <input type="text" id="txtNombre" class="form-control" placeholder="Ej: Jose (Obligatorio)" name="Nombre"><br>
                    <!--Apellido-->
                    <span class="titInput">Apellido</span>
                    <input type="text" id="txtApelli" class="form-control" placeholder="Ej: Quezada (Obligatorio)" name="Apelli"><br>
                    <hr>
                    <p class="text-muted">Con estos datos vas a iniciar sesion</p>
                    <!--Correo Electronico-->
                    <span class="titInput">Correo Electronico</span>
                    <input type="email" id="txtCorreo" class="form-control" placeholder="ejemplo@gmail.com (Obligatorio)" name="Correo"><br>
                    <!--Clave-->
                    <span class="titInput">Clave</span>
                    <input type="password" id="txtClave" class="form-control" placeholder="************* (Obligatorio)" name="Clave1"><br>
                    <!--Repite Clave-->
                    <span class="titInput">Repetir Clave</span>
                    <input type="password" id="txtClave2" class="form-control" placeholder="Repetir Clave (Obligatorio)" name="Clave2"><br>
                </div>
                <div class="col-md-2">
                  
                </div>
                <!--OPCIONAL-->
                <div class="col-12 col-md-5 boxDatos form-group">
                    <h4 class="titBox text-center"><i class="fas fa-heart"></i> Informacion Opcional </h4>
                    <hr>
                    <p class="text-muted">Cuentanos un poco mas de ti.</p>
                    <!--Genero-->
                    <span class="titInput">Genero</span>
                    <div class="form-check text-left" >
                      <input class="form-check-input" type="radio" name="Genero" id="rdbNR" value="1" checked="true">
                      <label class="form-check-label" for="rdbNR">
                        Prefiero no responder
                      </label>
                    </div>
                    <div class="form-check text-left">
                      <input class="form-check-input" type="radio" name="Genero" id="rdbNB" value="2">
                      <label class="form-check-label" for="rdbNB">
                        No Binario
                      </label>
                    </div>
                    <div class="form-check text-left">
                      <input class="form-check-input" type="radio" name="Genero" id="rdbFE" value="3">
                      <label class="form-check-label" for="rdbFE">
                        Mujer
                      </label>
                    </div>
                    <div class="form-check text-left">
                      <input class="form-check-input" type="radio" name="Genero" id="rdbMA" value="4">
                      <label class="form-check-label" for="rdbMA">
                        Hombre
                      </label>
                    </div>
                    <br>
                    <!--Edad-->
                    <span class="titInput">Edad</span>
                    <input type="number" id="txtEdad" class="form-control" min="18" max="99" placeholder="Ej: 18" name="Edad"><br>
                    <!--Telefono-->
                    <span class="titInput">Telefono</span>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">+569</span>
                      </div>
                      <input type="tel" id="txtFono" class="form-control" placeholder="Ej: 4321 1234" name="Fono">
                    </div>
                    <br>
                </div>
                <div class="col-12 text-center" >
                    <div class="g-recaptcha" data-sitekey="6LfMScQUAAAAANKeGizusHJd8EQJw5-IVm4-U9Q-"></div> 
                </div>
                <div class="col-12 text-center">
                    <hr class="hrCute">
                    <button class="btn btn-warning btn-lg btn-block" id="btnRegistro" type="button" style="font-weight: 700;"> 
                        CONFIRMAR <i class="fas fa-check"></i>
                    </button> 
                </div>
            </div>
            
            
        </form>
    </div>
    <br>
    <div class="container-fluid fondoRegistro" style="padding: 0"> 
        
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
    <script src="script/jsRegistro.js"></script>
 
    <!--script externos--> 
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
    <script src="https://unpkg.com/popper.js"></script>
    <script src="https://unpkg.com/tooltip.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


</body> 
 
</html>