<?php
//Iniciamos la sesión
session_start();

if(isset($_SESSION['usuario']) and $_SESSION['estado'] == 'Autenticado') {
  if ($_SESSION['tipo']==1) {
    # code...
    header("LOCATION:http://www.fiestapp.tk/comunidad.php");
  } else if ($_SESSION['tipo']==2){
    # code...
    header("LOCATION:http://www.fiestapp.tk/portal.php");
  } else if ($_SESSION['tipo']==3){
    # code...
    header("LOCATION:http://www.fiestapp.tk/panel.php");
  }
  
}

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
    <title>INICIAR SESION</title> 
    <meta name="description" content="Encuentra las mejores fiestas, tocatas, festivales, carretes y mas !"/>
    <link rel="icon" type="image/png" href="../img/favicon.ico">
</head> 
<body style="font-family: 'Exo 2', sans-serif;background-color: rgba(210, 199, 214,1);" class="text-center" id="arriba"> 
    <!--******************navegador******************-->
    <?php 

    require 'cabeza.php';

     ?>

     
    <!-- ******************cuerpo****************** -->

    <br><br>
    <form class="form-signin mt-5" method="POST" id="acceso" action="" accept-charset="utf-8" name="formAcceso">
      <input id="tipoUsu" name="tipoAcceso" type="hidden" value="1">
      <img class="mb-4 mt-5" src="../img/logo.png" alt="" height="125">
      <h1 class="h3 mb-3 font-weight-normal titLog">INICIAR SESION</h1>
      <label for="txtCorreo" class="sr-only">Correo Electronico</label>
      <input name="mailAcceso" type="email" id="txtCorreo" class="form-control" placeholder="ejemplo@gmail.com" autocomplete="off" required autofocus>
      <label for="txtClave" class="sr-only">Contraseña</label>
      <input name="passAcceso" type="password" id="txtClave" class="form-control" placeholder="********" autocomplete="off" required>
      <p>
        <div class="g-recaptcha" data-sitekey="6LfMScQUAAAAANKeGizusHJd8EQJw5-IVm4-U9Q-"></div> 
      </p>
      <button class="btn btn-lg btn-dark btn-block" type="submit" id="btnLogin">CONFIRMAR</button>
      <p class="mt-3"> Olvidaste la contraseña?, <a href="http://www.fiestapp.tk/recuperar">CLICK AQUI</a></p>
      <hr>
      <p class="mt-3"> Aun no tienes una cuenta?, <a href="http://www.fiestapp.tk/registro">REGISTRARSE</a></p>
      <p class="mt-3 text-muted">&copy; www.fiestapp.cl</p>
      <p class="mt-3 text-muted">&copy; Inacap Puente Alto</p>
      <p class="mt-3 text-muted">&copy; 2019</p>
    </form>
    <br>
    <div class="container-fluid fondoBot2" style="padding: 0"> 
        
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
    <script src="script/jsLogin.js"></script>
 
    <!--script externos--> 
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
    <script src="https://unpkg.com/popper.js"></script>
    <script src="https://unpkg.com/tooltip.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body> 
 
</html>