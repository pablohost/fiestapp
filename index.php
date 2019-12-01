
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
    <link href="https://fonts.googleapis.com/css?family=Exo+2:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/hover-min.css"> 
    
    <!--******************extra******************--> 
    <title>FIESTAPP</title> 
    <meta name="description" content="Encuentra las mejores fiestas, tocatas, festivales, carretes y mas !"/>
    <link rel="icon" type="image/png" href="img/favicon.ico">
</head> 
<body style="font-family: 'Exo 2', sans-serif;"> 
    <!--******************navegador******************-->
    <?php 

    require 'cabeza.php';

     ?>

     
    <!-- ******************video de fondo****************** --> 
     
    <header class="container-fluid imgFondo d-flex" id="arriba"> 
        <div class="row">
            <div class="col-12 px-0">
                <video src="vid/vid2.mp4" class="video inicio1 d-none d-lg-block" poster="" autoplay="" muted="" loop id="videobanner"></video>
            </div>
            <div class="col-12 celuCute">
                <!-- ******************subtitulo****************** --> 
                <div class="text-center container-fluid my-auto"> 
                    <div class="row justify-content-center">
                        <div class="d-none d-sm-block col-sm-12">
                            <p class="titCute">ENCUENTRA <span id="headCute"></span></p>
                        </div>
                        <div class="my-2 col-2 col-sm-2 col-lg-1 iCute centro">
                            <i class="fas fa-glass-cheers fa-2x faCute"></i>
                        </div>
                        <div class="my-2 col-10 col-sm-4 col-lg-3 iCute centro">
                            <select class="custom-select selCute">
                                <option value="0" selected="true">
                                    TODOS
                                </option>
                                <option value="1">
                                    FIESTA
                                </option>
                                <option value="2">
                                    MUSICA EN VIVO
                                </option>
                                <option value="3">
                                    FESTIVAL
                                </option>
                                <option value="4">
                                    STAND UP COMEDY
                                </option>
                                <option value="5">
                                    CONFERENCIAS
                                </option>
                                <option value="6">
                                    OTROS
                                </option>
                            </select>
                        </div>
                        <div class="my-2 col-2 col-sm-2 col-lg-1 centro">
                            <i class="fas fa-globe-americas fa-2x faCute"></i>
                        </div>
                        <div class="my-2 col-10 col-sm-4 col-lg-3 centro">
                            <select class="custom-select selCute">
                                <option value="0" selected="true">
                                    SANTIAGO
                                </option>
                            </select>
                        </div>
                        <div class="my-2 col-12 col-lg-2 centro">
                            <a href="#evento" role="button" class="btn btn-warning btn-cta js-scroll-trigger" style="font-weight: bold; vertical-align: -webkit-baseline-middle;">
                                <i class="fas fa-search-location"></i> ENCONTRAR
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ***********************categorias*********************** --> 
            <div class="container-fluid text-center cateCute" id="Categoria">
                <div class="row justify-content-center inicioCat1">
                    <div class="col-12 col-lg-4 frameCategoria"> 
                        <a href="http://www.fiestapp.tk/registro.php" class="hvr-buzz js-scroll-trigger" id="linkCategoria1"> 
                            <img src="img/cat1.jpg" class="imgCate"><span class="titCate"> UNETE A LA COMUNIDAD </span> 
                        </a> 
                    </div> 
                    <div class="col-12 col-lg-4 frameCategoria"> 
                        <a href="#evento" class="hvr-buzz js-scroll-trigger" id="linkCategoria2"> 
                            <img src="img/cat2.jpg" class="imgCate"><span class="titCate"> BUSCA EVENTOS EN EL MAPA </span> 
                        </a> 
                    </div> 
                    <div class="col-12 col-lg-4 frameCategoria"> 
                        <a href="#evento" class="hvr-buzz js-scroll-trigger" id="linkCategoria3"> 
                            <img src="img/cat3.jpg" class="imgCate"><span class="titCate"> CREA TU PROPIO EVENTO </span> 
                        </a> 
                    </div>
                </div> 
            </div> 
        </div>
    </header> 
    
    
    <!-- ***********************banner de publicidad dentro de la pagina*********************** --> 
    <div class="container-fluid text-center"> 
        <div class="row h-100" style="background-color:rgba(0, 0, 0, 0.6); min-height: 240px;box-shadow: 0 0 8px 4px white inset; "> 
            <div class="col-12 pt-5">
                <br><br><br><br>
                <span class="text-white">ESPACIO PARA PUBLICIDAD DE GOOGLE</span>
            </div>
        </div> 
    </div> 
    <br>
    <!-- ***********************Lista de Eventos*********************** -->
    <div class="container text-center" style="" id="evento">
        <span class="headCate">EVENTOS</span>
        <p style="font-size: 1.8rem;color: rgba(18, 0, 94, 0.60);">Categoria: <span id="helpCate"></span></p>
        <div class="row" style="margin: 0px; min-height: 400px;" id="listaEventos">
            <!-- 1 -->
        </div>
    </div>
    <hr>
    <!-- ***********************seccion - red social*********************** --> 
    <div class="container-fluid text-center inicioNos redCute py-3" id="red"> 
        <section class="row centro"> 
            <div class="col-12"> 
                <h2 class="nosTit"> UTILIZA FIESTAPP COMO RED SOCIAL </h2>
            </div> 
            <div class="col-12 col-md-6 text-left"> 
                <section class="boxCute"> 
                    <h5 style="font-style: oblique;" class="nosSub"> 
                        ¿Aun no tienes una cuenta?
                    </h5> 
                    <p class="nosPar text-center"> 
                        <a href="http://www.fiestapp.tk/registro" role="button" class="btn btn-warning btn-cta" style="font-weight: bold;">
                            <i class="fas fa-user-plus"></i>
                            UNIRTE
                        </a>
                    </p>
                    <p class="nosPar sr1"> 
                        <i class="fas fa-users fa-2x"></i>
                        Haz amigos con tus mismos gustos
                    </p> 
                    <p class="nosPar sr2"> 
                        <i class="fas fa-icons fa-2x"></i>
                        Invita a tus amigos a tus eventos favoritos
                    </p>
                    <p class="nosPar sr3">
                        <i class="fas fa-camera fa-2x"></i> 
                        Guarda tus fotos privadas, o compartelas con tus amigos
                    </p>
                    <p class="nosPar sr4">
                        <i class="fas fa-star-half-alt fa-2x"></i> 
                        Califica eventos o locales a los que haz asistido
                    </p>
                </section> 
            </div> 
            <div class="col-12 col-md-6"> 
                <section> 
                    <h5 style="font-style: oblique;" class="nosSub"> 
                        ¿Ya eres parte de la comunidad?
                    </h5> 
                    <p class="nosPar text-center"> 
                        <a href="http://www.fiestapp.tk/comunidad" role="button" class="btn btn-warning btn-cta" style="font-weight: bold;">
                            <i class="fas fa-sign-in-alt"></i>
                            ACCEDER
                        </a>
                    </p>
                    <br>
                    <p class="nosPar sr5"> 
                        <i class="fas fa-share-alt fa-2x"></i>
                        Invita a tus amigos a ser parte de esta gran comunidad
                    </p>
                </section> 
            </div> 
        </section>
    </div>
    <div class="container-fluid fondoBot" style="padding: 0"> 
        
    </div>
 
    <!-- ******************seccion organizadores****************** --> 
    <section id="organizadores" style="background-color: rgba(210, 199, 214,1);"> 
      <div class="container-fluid"> 
        <div class="row"> 
            <div class="col-lg-12 text-center"> 
                <h2 class="orgTit my-4">CREA TUS PROPIOS EVENTOS, FACIL Y RAPIDO</h2> 
            </div> 
          <div class="col-md-6 text-left inicioMay4"> 
            <div class="mt-2 my-5"> 
              <h5 class="orgSub my-4 sr1"> 
                <i class="fas fa-bullhorn fa-2x"></i>
                Tus eventos seran publicados automaticamente
              </h5> 
              <h5 class="orgSub my-4 sr2"> 
                <i class="fas fa-car-side fa-2x"></i>
                Control en tiempo real para la capacidad de estacionamientos o personas
              </h5> 
              <h5 class="orgSub my-4 sr3"> 
                <i class="fas fa-mouse-pointer fa-2x"></i>
                Las personas podran ver informacion de tu evento y de tu local, con un solo click
              </h5>
              <h5 class="orgSub my-4 sr4"> 
                <i class="far fa-check-square fa-2x"></i>
                Al crear tu evento debes cumplir con todas las normativas, de lo contrario no sera publicado
              </h5>
            </div> 
          </div> 
          <div class="col-md-6 text-center inicioMay3 imgOrga centro">
            <div>
                <p class="orgCute">
                    ¿Aun no tienes una cuenta de organizador?
                </p>
                <p>
                    <a href="http://www.fiestapp.tk/registro" role="button" class="btn btn-warning btn-cta" style="font-weight: bold;">
                        <i class="fas fa-user-plus"></i>
                        UNIRTE
                    </a>
                </p>
                <hr style="border-top: 1px solid rgba(255,255,255,1);">
                <br>
                <p class="orgCute">
                    Accede a tu cuenta
                </p>
                <p>
                    <a href="http://www.fiestapp.tk/portal" role="button" class="btn btn-warning btn-cta" style="font-weight: bold;">
                        <i class="fas fa-sign-in-alt"></i>
                        ACCEDER
                    </a>
                </p>
            </div>
          </div>
        </div> 
      </div>
    </section> 
    
    <!-- ******************seccion publicidad****************** --> 
    <section id="publicidad" style="background-image: url(img/f10.jpg); background-size: cover;" class="py-4 pb-5"> 
      <div class="container-fluid"> 
        <div class="row"> 
            <hr>
            <div class="col-lg-12 text-center"> 
                <h2 class="orgTit my-4">DESTACA TU EVENTO ENTRE LOS DEMAS</h2> 
            </div>  
        </div> 
      </div> 
      <div class="container-fluid"> 
        <div class="row"> 
          <div class="col-md-6 text-center inicioMay1"> 
            <div class="service-box mt-2 mx-auto sr6"> 
              <i class="far fa-grin-stars fa-7x text-primary mb-3 mayResp"></i> 
              <h3 class="mb-3 orgCute" style="color: rgb(255, 193, 7);">GANA VISIBILIDAD</h3> 
              <p class="text-white mb-0 maySub">Seras destacado en el mapa con un simbolo especial, asi mas personas podran conocer tu evento.</p> 
            </div> 
          </div> 
          <div class="col-md-6 text-center inicioMay2"> 
            <div class="service-box mt-2 mx-auto sr7"> 
              <i class="fas fa-sort-numeric-up fa-7x text-primary mb-3 mayResp"></i> 
              <h3 class="mb-3 orgCute" style="color: rgb(255, 193, 7);">SIEMPRE ARRIBA</h3> 
              <p class="text-white mb-0 maySub">Tendras la preferencia de los primeros lugares, en todas las busquedas relacionadas con tu evento.</p> 
            </div> 
          </div> 
          <div class="col-md-6 text-center inicioMay3"> 
            <div class="service-box mt-2 mx-auto sr8"> 
              <i class="far fa-heart fa-7x text-primary mb-3 mayResp"></i> 
              <h3 class="mb-3 orgCute" style="color: rgb(255, 193, 7);">COSTOS REDUCIDOS</h3> 
              <p class="text-white mb-0 maySub">Se cobraran solo $2.000 CLP diarios, puedes elegir la cantidad de dias que necesites para tu evento.</p> 
            </div> 
          </div> 
          <div class="col-md-6 text-center inicioMay4"> 
            <div class="service-box mt-2 mx-auto sr9"> 
              <i class="far fa-credit-card fa-7x text-primary mb-3 mayResp"></i> 
              <h3 class="mb-3 orgCute" style="color: rgb(255, 193, 7);">FACILIDAD DE PAGO</h3> 
              <p class="text-white mb-0 maySub">Gracias a la plataforma FLOW, podras pagar en cualquier momento y lugar, mediante Webpay, Onepay o Servipag.</p> 
            </div> 
          </div> 
        </div> 
      </div>
    </section>
    <!-- ******************pie de pagina****************** --> 
    <?php 

    require 'pie.php';

     ?>
    
    <!--script bootstrap / jquery--> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 

    <!--script propios--> 
    <script src="script/jsIndex.js"></script> 
    <script src="script/jsGlobal.js"></script>
 
    <!--script externos--> 
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
    <script src="https://unpkg.com/popper.js"></script>
    <script src="https://unpkg.com/tooltip.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>

</body> 
 
</html>