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

    <!--******************css externo****************** -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://rawgit.com/fitodac/line-awesome/master/dist/css/line-awesome.min.css" crossorigin="anonymous"> 
    <link href="https://fonts.googleapis.com/css?family=Exo+2:400,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/hover-min.css"> 
    
    <!--******************extra******************--> 
    <title>RECUPERAR CLAVE</title> 
    <meta name="description" content="Encuentra las mejores fiestas, tocatas, festivales, carretes y mas !"/>
    <link rel="icon" type="image/png" href="../img/favicon.ico">
</head> 
<body style="font-family: 'Exo 2', sans-serif;background-color: rgba(224, 221, 200,1);" class="text-center"> 
    <!--******************navegador******************-->
    <?php 

    require 'cabeza.php';

     ?>

     
    <!-- ******************cuerpo****************** -->

    <br><br>
    <form class="form-signin mt-5" method="POST" id="acceso" action="" accept-charset="utf-8" name="formRecu">
      <img class="mb-4 mt-5" src="../img/logo.png" alt="" height="125">
      <h1 class="h3 mb-3 font-weight-normal titLog">OLVIDE MI CLAVE</h1>
      <p class="mt-3">Ingresa el correo electronico con el que te registraste, te enviaremos un mail con los pasos a seguir</p>
      <hr>
      <label for="inputEmail" class="sr-only">Correo Electronico</label>
      <input name="mailAcceso" type="email" id="txtCorreo" class="form-control mb-2" placeholder="ejemplo@gmail.com" autocomplete="off" required autofocus>
      <p>
        <div class="g-recaptcha" data-sitekey="6LfMScQUAAAAANKeGizusHJd8EQJw5-IVm4-U9Q-"></div> 
      </p>
      <button class="btn btn-lg btn-dark btn-block" type="submit" id="btnRecu">Confirmar</button>
      <p class="mt-3">Recordaste tu clave ? <a href="http://www.fiestapp.tk/comunidad">INICIA SESION</a></p>
      <p class="mt-3 text-muted">&copy; www.fiestapp.cl</p>
      <p class="mt-3 text-muted">&copy; Inacap Puente Alto</p>
      <p class="mt-3 text-muted">&copy; 2019</p>
    </form>
    <br>
    <div class="container-fluid fondoBot4" style="padding: 0"> 
        
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