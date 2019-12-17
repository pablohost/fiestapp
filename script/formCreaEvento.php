<?php 
$mensaje='';
$mensaje.='
<div class="row pt-2">
	<div class="col-12">
		<h1 style="color:rgba(225, 173, 7, 1);text-shadow: 2px 2px 10px #000;">CREAR NUEVO EVENTO</h1>
	</div>
	<div class="col-12">
	<div class="container text-left" style="border: 5px solid rgba(225, 173, 7, 1);padding: 1rem;background-color: rgba(255,255,255,.9);border-radius: 20px;">
		<form id="creaEventoOrga-form" action="" method="POST" name="formCreaEventoOrga">
		    <div class="row justify-content-center">
		        <div class="col-12 boxDatosEve form-group pt-1">
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
		              <label class="custom-file-label fl0" for="flFotoEve" data-browse="Elegir">Seleccionar Archivo</label>
		            </div><br><br>
		            <!--Categorias Evento-->
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
		        <div class="col-12 boxDatosEve form-group pt-1">
		            <h4 class="titBoxEve text-center"><i class="fas fa-warehouse"></i> Informacion del Recinto </h4>
		            <hr style="border: 2px solid rgba(225, 173, 7, 1);">
		            <p class="text-muted">Donde se realizara el evento</p>
		            <p class=""><a href="#" role="button" class="btn btn-warning btn-sm" id="btnMisRecintos"><i class="fas fa-warehouse"></i> MIS RECINTOS</a></p>
		            <div class="" id="listaRecintos">
		            </div>
		            <!--Ubicacion-->
		            <span class="titInput">Ubicacion</span><br>
		            <span class="text-muted">Longitud</span><br>
		            <input type="text" id="txtLon" class="form-control" placeholder="" name="Long" value="-33.462683"><br>
		            <span class="text-muted">Latitud</span><br>
		            <input type="text" id="txtLat" class="form-control" placeholder="" name="Lati" value="-70.661773"><br>
		            <!--Nombre del recinto-->
		            <span class="titInput">Nombre del Recinto</span>
		            <input type="text" id="txtNomLoc" class="form-control" placeholder="Ej: Estadio Nacional" name="NomLoc"><br>
		            <!--Descripcion Recinto-->
		            <span class="titInput">Descripcion</span>
		            <textarea type="text" id="txtDescLoc" rows="7" class="form-control" placeholder="Aqui puedes detallar mas info. acerca del recinto" name="DescLoc"></textarea><br>
		            <hr>
		            <p class="text-muted">Medios de contacto con el recinto</p>
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
		            <input type="text" id="txtWebLoc" class="form-control" placeholder="Ej: www.fiestapp.cl" name="WebLoc"><hr>
		            <p class="text-muted">Mas info. del recinto</p>
		            <div class="container-fluid">
		                <div class="row">
		                    <div class="col-12 col-md-6">
		                        <!--Capacidad total de aforo-->
		                        <span class="titInput">Capacidad de Personas</span>
		                        <input type="number" id="txtCapa" class="form-control" min="0" max="99999" placeholder="Ej: 220" name="Capacidad">
		                    </div>
		                    <div class="col-12 col-md-6">
		                        <!--Capacidad total de estacionamientos-->
		                        <span class="titInput">Estacionamientos</span>
		                        <input type="number" id="txtEsta" class="form-control" min="0" max="9999" placeholder="Ej: 25" name="Estacionamiento">
		                    </div>
		                </div>
		            </div><br>
		            <!--Galeria Recinto-->
		            <span class="titInput">Galeria del Recinto</span>
		            <div id="fotosRecinto">
		            	<div class="custom-file">
			              <input type="file" class="custom-file-input" id="flFotoRec1" name="FotoRec1" data-ind="1">
			              <label class="custom-file-label fl1" for="flFotoRec1" data-browse="Elegir">Seleccionar Archivo</label>
			              <br><br>
			            </div>
		            </div>
		            <p class="pt-2"><a href="#" role="button" class="btn btn-success btn-sm" id="btnOtraFoto"><i class="fas fa-plus-square"></i> OTRA FOTO</a></p>
		        </div>
		        <div class="col-12 text-center" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;">
		            <div class="g-recaptcha" data-sitekey="6LfMScQUAAAAANKeGizusHJd8EQJw5-IVm4-U9Q-"></div> 
		        </div>
		        <div class="col-12">
		        <hr style="border: 2px solid rgba(225, 173, 7, 1);">
		        </div>
		        <div class="col-12 col-md-6 text-center">
		            <button class="btn btn-danger btn-lg btn-block" id="btnAtrasEventos" type="button" style="font-weight: 700;"> 
		                VOLVER ATRAS
		            </button> 
		        </div>
		        <div class="col-12 col-md-6 text-center">
		            <button class="btn btn-warning btn-lg btn-block" id="btnConfirmaAgregaOrga" type="button" style="font-weight: 700;"> 
		                CONFIRMAR <i class="fas fa-check"></i>
		            </button> 
		        </div>
		    </div>
		</form>
		</div>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</div>
</div>';
echo $mensaje;

?>