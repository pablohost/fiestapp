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
    <title>REGISTRO DE EVENTOS</title> 
    <meta name="description" content="Encuentra las mejores fiestas, tocatas, festivales, carretes y mas !"/>
    <link rel="icon" type="image/png" href="../img/favicon.ico">
</head> 
<body style="font-family: 'Exo 2', sans-serif;background-image: url(img/f11.jpg);" id="arriba"> 
    <!--******************navegador******************-->
    <?php 

    require 'cabeza.php';

     ?>

     
    <!-- ******************cuerpo****************** -->
    <div class="container pt-5 mt-5 text-center">
      <h1 class="titRegistro">REGISTRO DE EVENTOS</h1>
      <hr class="hrCute">
    </div>
    
    <div class="container boxRegistro">
        <form id="creaEvento-form" action="" method="POST" name="formCreaEvento">
            <div class="row justify-content-center">
                <div class="col-12 boxDatosEve form-group pt-1">
                    <!--Filtro de Menores de Edad-->
                    <h4 class="titBoxEve text-center"><i class="fas fa-user-tie"></i> Eres mayor de edad? </h4>
                    <hr style="border: 2px solid rgba(225, 173, 7, 1);">
                    
                    <div class="custom-control custom-switch text-center pb-2" style="padding-left: 0rem!important">
                      <span style="margin-right: 2.4rem;">NO</span>
                      <input type="checkbox" class="custom-control-input" id="swFiltro">
                      <label class="custom-control-label" for="swFiltro">SI</label>
                    </div>
                </div>
                <div class="col-12 boxDatosEve form-group pt-1">
                    <!--Filtro de Menores de Edad-->
                    <h4 class="titBoxEve text-center"><i class="fas fa-calendar-day"></i> Informacion del Evento </h4>
                    <hr style="border: 2px solid rgba(225, 173, 7, 1);">
                    <p class="text-muted">Usaremos esta info para publicar tu evento</p>
                    <!--Titulo Evento-->
                    <span class="titInput">Titulo</span>
                    <input type="text" id="txtTituloEve" class="form-control" placeholder="Agrega un titulo a tu evento" name="TituloEve"><br>
                    <!--Descripcion Evento-->
                    <span class="titInput">Descripcion</span>
                    <textarea type="text" id="txtDescEve" rows="7" class="form-control" placeholder="Aqui puedes detallar mas info. acerca de tu evento" name="DescEve"></textarea><br>
                    <!--Flyer Evento-->
                    <span class="titInput">Foto o Flyer del Evento</span>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="flFotoEve" name="FotoEve">
                      <label class="custom-file-label" for="flFotoEve" data-browse="Elegir">Seleccionar Archivo</label>
                    </div><br><br>
                    <!--Region-->
                    <span class="titInput">Categorias</span>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="custom-control custom-switch text-center pb-3 pl-0">
                                  <input type="checkbox" class="custom-control-input" id="sw1">
                                  <label class="custom-control-label" for="sw1">FIESTA</label>
                                </div>
                                <div class="custom-control custom-switch text-center pb-3 pl-0">
                                  <input type="checkbox" class="custom-control-input" id="sw2">
                                  <label class="custom-control-label" for="sw2">MUSICA EN VIVO</label>
                                </div>
                                <div class="custom-control custom-switch text-center pb-3 pl-0">
                                  <input type="checkbox" class="custom-control-input" id="sw3">
                                  <label class="custom-control-label" for="sw3">FESTIVAL</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="custom-control custom-switch text-center pb-3 pl-0">
                                  <input type="checkbox" class="custom-control-input" id="sw4">
                                  <label class="custom-control-label" for="sw4">STAND UP COMEDY</label>
                                </div>
                                <div class="custom-control custom-switch text-center pb-3 pl-0">
                                  <input type="checkbox" class="custom-control-input" id="sw5">
                                  <label class="custom-control-label" for="sw5">CONFERENCIAS</label>
                                </div>
                                <div class="custom-control custom-switch text-center pb-3 pl-0">
                                  <input type="checkbox" class="custom-control-input" id="sw6">
                                  <label class="custom-control-label" for="sw6">OTROS</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--Fechas Evento-->
                    <span class="titInput">Fecha y Hora</span><br>
                    <span class="text-muted">Inicio</span>
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <!--Fecha Inicio-->
                                <input type="date" id="dtInicio" class="form-control" name="DtIni">
                            </div>
                            <div class="col-6">
                                <!--Hora Inicio-->
                                <select class="custom-select" id="cbxInicio" name="HrIni">
                                    <option value="00:00" selected="">00:00</option>
                                    <option value="00:30">00:30</option>
                                    <option value="01:00">01:00</option>
                                    <option value="01:30">01:30</option>
                                    <option value="02:00">02:00</option>
                                    <option value="02:30">02:30</option>
                                    <option value="03:00">03:00</option>
                                    <option value="03:30">03:30</option>
                                    <option value="04:00">04:00</option>
                                    <option value="04:30">04:30</option>
                                    <option value="05:00">05:00</option>
                                    <option value="05:30">05:30</option>
                                    <option value="06:00">06:00</option>
                                    <option value="06:30">06:30</option>
                                    <option value="07:00">07:00</option>
                                    <option value="07:30">07:30</option>
                                    <option value="08:00">08:00</option>
                                    <option value="08:30">08:30</option>
                                    <option value="09:00">09:00</option>
                                    <option value="09:30">09:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:30">21:30</option>
                                    <option value="22:00">22:00</option>
                                    <option value="22:30">22:30</option>
                                    <option value="23:00">23:00</option>
                                    <option value="23:30">23:30</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <span class="text-muted">Finalizacion</span>
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <!--Fecha Fin-->
                                <input type="date" id="dtFin" class="form-control" name="DtFin">
                            </div>
                            <div class="col-6">
                                <!--Hora Fin-->
                                <select class="custom-select" id="cbxFin" name="HrFin">
                                    <option value="00:00" selected="">00:00</option>
                                    <option value="00:30">00:30</option>
                                    <option value="01:00">01:00</option>
                                    <option value="01:30">01:30</option>
                                    <option value="02:00">02:00</option>
                                    <option value="02:30">02:30</option>
                                    <option value="03:00">03:00</option>
                                    <option value="03:30">03:30</option>
                                    <option value="04:00">04:00</option>
                                    <option value="04:30">04:30</option>
                                    <option value="05:00">05:00</option>
                                    <option value="05:30">05:30</option>
                                    <option value="06:00">06:00</option>
                                    <option value="06:30">06:30</option>
                                    <option value="07:00">07:00</option>
                                    <option value="07:30">07:30</option>
                                    <option value="08:00">08:00</option>
                                    <option value="08:30">08:30</option>
                                    <option value="09:00">09:00</option>
                                    <option value="09:30">09:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:30">21:30</option>
                                    <option value="22:00">22:00</option>
                                    <option value="22:30">22:30</option>
                                    <option value="23:00">23:00</option>
                                    <option value="23:30">23:30</option>
                                </select>
                            </div>
                        </div>
                    </div><br>
                    <!--Enlace Boletos-->
                    <span class="titInput">Enlace de compra de boletos</span>
                    <input type="text" id="txtBoleEve" class="form-control" placeholder="Ej: www.vendoticket.cl/tu-evento" name="BoleEve"><br>
                </div>

                <!--INFORMACION REQUERIDA SOBRE EL RECINTO-->
                <div class="col-12 col-md-6 boxDatosEve form-group pt-1">
                    <h4 class="titBoxEve text-center"><i class="fas fa-warehouse"></i> Informacion del Recinto </h4>
                    <hr style="border: 2px solid rgba(225, 173, 7, 1);">
                    <p class="text-muted">Donde se realizara el evento</p>
                    <!--Ubicacion-->
                    <span class="titInput">Ubicacion</span><br>
                    <span class="text-muted">Longitud</span><br>
                    <input type="text" id="txtLon" class="form-control" placeholder="" name="Long" value="-33.462683"><br>
                    <span class="text-muted">Latitud</span><br>
                    <input type="text" id="txtLat" class="form-control" placeholder="" name="Lati" value="-70.661773"><br>
                    <!--Nombre del recinto-->
                    <span class="titInput">Nombre del Recinto</span>
                    <input type="text" id="txtNomLoc" class="form-control" placeholder="Ej: Estadio Nacional" name="NomLoc"><br>
                    <hr>
                    <p class="text-muted">Indicanos al menos un medio de contacto con el recinto</p>
                    <!--Telefono del recinto-->
                    <span class="titInput">Telefono de Contacto</span>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">+569</span>
                      </div>
                      <input type="tel" id="txtFonoLoc" class="form-control" placeholder="Ej: 4321 1234" name="FonoLoc">
                    </div><br>
                    <!--Correo del Recinto-->
                    <span class="titInput">Correo  de Contacto</span>
                    <input type="email" id="txtCorLoc" class="form-control" placeholder="ejemplo@gmail.com" name="CorLoc"><br>
                    <!--Pagina Web-->
                    <span class="titInput">Pagina Web</span>
                    <input type="text" id="txtWebLoc" class="form-control" placeholder="Ej: www.fiestapp.cl" name="WebLoc"><br>
                </div>
                <!--INFORMACION REQUERIDA DE LA CUENTA-->
                <div class="col-12 col-md-6 boxDatosEve form-group pt-1">
                    <h4 class="titBoxEve text-center"><i class="fas fa-address-card"></i> Informacion Requerida </h4>
                    <hr style="border: 2px solid rgba(225, 173, 7, 1);">
                    <p class="text-muted">Se te creara una cuenta de Organizador de Eventos, si ya tienes una debes iniciar sesion y crear el evento desde el <a href="http://www.fiestapp.tk/portal">portal de eventos</a></p>
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
                <div class="col-12 text-center" >
                    <div class="g-recaptcha" data-sitekey="6LfMScQUAAAAANKeGizusHJd8EQJw5-IVm4-U9Q-"></div> 
                </div>
                <div class="col-12 text-center">
                    <hr class="hrCute">
                    <button class="btn btn-warning btn-lg btn-block" id="btnRegistroEve" type="button" style="font-weight: 700;"> 
                        CONFIRMAR <i class="fas fa-check"></i>
                    </button> 
                </div>
            </div>
            
            
        </form>
    </div>
    <br><br>
<button class="btn btn-warning btn-lg btn-block" id="btnXD" type="button" style="font-weight: 700;"> 
                        XDXD <i class="fas fa-check"></i>
                    </button> 

    
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