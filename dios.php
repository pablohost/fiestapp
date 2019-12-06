<?php

//Iniciamos la sesión
session_start();

//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);

//Comprobamos si la sesión está iniciada
//Si existe una sesión correcta, mostramos la página para los usuarios
//Sino, mostramos la página de acceso y registro de usuarios
if(isset($_SESSION['usuario']) and $_SESSION['estado'] == 'Autenticado' and $_SESSION['tipo'] == 3) {
    
	?>
        
    <!DOCTYPE html>  
    <html> 
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--******************css******************--> 
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" /> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> 
        <link rel="stylesheet" type="text/css" href="https://rawgit.com/fitodac/line-awesome/master/dist/css/line-awesome.min.css" crossorigin="anonymous"> 
        <link rel="stylesheet" href="/css/hover-min.css"> 
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@8.12.1/dist/sweetalert2.min.css">
        <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">

        <link rel="stylesheet" href="/css/estilo.css">
        <link rel="stylesheet" href="/css/estiloPerfil.css">
        <link rel="icon" type="image/png" href="../img/favicon.ico">
         
        <!--******************extra******************--> 
        <title><?= $_SESSION['nombre'] ?> - FIESTAPP</title>
    </head> 
    <body id="arriba"> 

        <!--******************navegador******************--> 
        <nav class="navbar navbar-light fixed-top navbar-expand-lg" style="background-color:rgba(255, 255, 255, 0.8);" > 
            <div class="container-fluid text-white"> 
                <!-- ******************logo****************** --> 
                <a class="navbar-brand js-scroll-trigger" href="#arriba"><img src="img/logo.png" class="logo1 hvr-float-shadow"></a> 
                <!-- ******************boton responsive****************** --> 
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> 
                    <span class="navbar-toggler-icon"></span> 
                </button> 
                <!-- ******************menu****************** --> 
                <div class="collapse navbar-collapse text-right menuSes" id="navbarResponsive"> 
                    <ul class="navbar-nav ml-auto"> 
     
                        <li class="nav-item navSpace">
                            <a class="nav-link js-scroll-trigger hvr-underline-from-center efectoNAV" href="#arriba" id="">
                                <i class="far fa-user fa-1x"></i>&nbsp;<span id="sesUsu"><?= $_SESSION['nombre'] ?></span>
                            </a>
                        </li>
                        
                        <li class="nav-item navSpace">
                            <a class="nav-link js-scroll-trigger hvr-underline-from-center efectoNAV" href="#" id="cerrarSes">
                                <i class="fas fa-power-off fa-1x"></i>&nbsp;Cerrar Sesion
                            </a>
                        </li>
     
                    </ul> 
                </div> 
            </div> 
        </nav> 
        <br><br><br>
        <!-- ***********************Navegador segundario*********************** -->
        <div class="container-fluid text-center boxNav pt-5">
            <div class="row">
                <div class="col-6 col-md-3 navPortal">
                    <a href="#" class="hvr-icon-fade linkPortal js-scroll-trigger" id="lkProd">
                        <i class="fas fa-cogs fa-3x hvr-icon"></i>
                        <p class="xlinkPortal">GESTION</p>
                    </a>
                </div>
                <div class="col-6 col-md-3 navPortal">
                    <a href="#" class="hvr-icon-fade linkPortal js-scroll-trigger" id="lkProm">
                        <i class="fas fa-calendar-alt fa-3x hvr-icon"></i>
                        <p class="xlinkPortal">EVENTOS</p>
                    </a>
                </div>
                <div class="col-6 col-md-3 navPortal">
                    <a href="#" class="hvr-icon-fade linkPortal js-scroll-trigger" id="lkEsta">
                        <i class="fas fa-users fa-3x hvr-icon"></i>
                        <p class="xlinkPortal">USUARIOS</p>
                    </a>
                </div>
                <div class="col-6 col-md-3 navPortal">
                    <a href="#" class="hvr-icon-fade linkPortal js-scroll-trigger" id="lkCuen">
                        <i class="fas fa-users-cog fa-3x hvr-icon"></i>
                        <p class="xlinkPortal">CUENTAS</p>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- ***********************/Zona de despliege del > Navegador segundario/*********************** -->
        <div class="container text-center boxNav2" id="medio">
            
        </div>

        <br> 
        <br>
        <!-- ******************pie de pagina****************** -->
        <footer class="text-white respPie" style="background-color: rgba(0, 0, 0, 0.8);"> 
            <div class="container text-center"> 
                <div class="row"> 
                    <div class="col-md-6">
	                    <p class="cueCredi"> 
	                        <span class="48">Inacap Puente Alto - Ing. Informatica</span>
	                    </p>
	                </div> 
	                <br> 
	                <div class="col-md-6">
	                    <p class="cueCredi">
	                        <a href="#" class="linkPIE" id="">www.fiestapp.cl <i class="far fa-copyright fa-1x"></i></a>
	                    </p>
	                </div>
                </div> 
            </div> 
        </footer>
     
     
        <!--script bootstrap / jquery--> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.js"></script> 
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script> 
     
        <!-- SCROOLL REVEAL JS LIBRARY CDN --> 
        <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script> 
     
        <!--script-->
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="/script/ns.hover.js"></script>
        
        <script src="script/jsComunidad.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.12.1/dist/sweetalert2.min.js"></script>
     
    </body> 
     
    </html>



    <?php 

} else {
    include('panel.php');
    die();
};

?>