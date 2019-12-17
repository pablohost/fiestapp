<?php 
$mensaje='';

$mensaje.='
<div class="row pt-2">
	<div class="col-12">
		<h1 style="color:rgba(225, 173, 7, 1);text-shadow: 2px 2px 10px #000;">EDITAR RECINTO</h1>
	</div>
	<div class="container text-left" style="border: 5px solid rgba(225, 173, 7, 1);padding: 1rem;background-color: rgba(255,255,255,.9);border-radius: 20px;">
		<form id="editaRecintoOrga-form" action="" method="POST" name="formEditaRecintoOrga">
		    <div class="row justify-content-center">
		        <!--INFORMACION REQUERIDA SOBRE EL RECINTO-->
		        <div class="col-12 boxDatosEve form-group pt-1">
		            <h4 class="titBoxEve text-center"><i class="fas fa-warehouse"></i> Informacion del Recinto </h4>
		            <hr style="border: 2px solid rgba(225, 173, 7, 1);">
		            <p class="text-muted">Donde se realizara el evento</p>
		            <!--Ubicacion-->
		            <input id="txtIndRecinto" type="hidden" value="" name="IndRecinto">
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
		        </div>
		        <div class="col-12 text-center" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;">
		            <div class="g-recaptcha" data-sitekey="6LfMScQUAAAAANKeGizusHJd8EQJw5-IVm4-U9Q-"></div> 
		        </div>
		        <div class="col-12">
		        <hr style="border: 2px solid rgba(225, 173, 7, 1);">
		        </div>
		        <div class="col-12 col-md-6 text-center">
		            <button class="btn btn-danger btn-lg btn-block" id="btnAtrasRecintos" type="button" style="font-weight: 700;"> 
		                VOLVER ATRAS
		            </button> 
		        </div>
		        <div class="col-12 col-md-6 text-center">
		            <button class="btn btn-warning btn-lg btn-block" id="btnConfirmaRecintoOrga" type="button" style="font-weight: 700;"> 
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