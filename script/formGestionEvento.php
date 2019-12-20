<?php 
$mensaje='';
$mensaje.='
<div class="row pt-2">
	<div class="col-12">
		<h1 style="color:rgba(225, 173, 7, 1);text-shadow: 2px 2px 10px #000;font-weight: 600;">GESTIONAR EVENTO</h1>
		<h3 style="color:rgba(225, 173, 7, 1);text-shadow: 2px 2px 10px #000;" id="lblNomEve"></h3>
	</div>
	<div class="col-12">
		<div class="container text-center mt-4" style="border: 5px solid rgba(225, 173, 7, 1);padding: 1rem;background-color: rgba(255,255,255,.9);border-radius: 20px;" id="boxGestionEvento">
			<div class="row justify-content-center">
		        <div class="col-12 col-md-6 boxDatosEve form-group pt-1">
		        	<form id="capacidadEvento-form" action="" method="POST" name="formCapacidadEvento">
			            <h4 class="titBoxEve text-center"><i class="fas fa-users"></i> Capacidad del Evento</h4>
			            <input id="txtIndEventoCap" type="hidden" value="" name="IndEvento">
			            <hr style="border: 2px solid rgba(225, 173, 7, 1);">
			            <div class="container-fluid text-center py-2">
			            	<div class="row justify-content-center py-2">
			            		<div class="col-12 centro">
			            			<p class="text-muted"><span id="lblUsoCap">0</span> / <span id="lblMaxCap">0</span></p>
			            		</div>
			            	</div>
			            	<div class="row justify-content-center">
			            		<div class="col-4 centro">
			            			<span class=""><a href="#" role="button" class="btn btn-danger btn-sm" id="btnMenosCap"><i class="fas fa-minus"></i></a></span>
			            		</div>
			            		<div class="col-4 centro">
			            			<input type="number" id="txtUsoCap" class="form-control " min="0" max="99999" value="0" name="CapacidadUso">
			            		</div>
			            		<div class="col-4 centro">
			            			<span class=""><a href="#" role="button" class="btn btn-success btn-sm" id="btnMasCap"><i class="fas fa-plus"></i></a></span>
			            		</div>
			            	</div>
			            	<div class="row justify-content-center pt-4">
			            		<div class="col-6 centro">
			            			<button class="btn btn-warning btn-sm btn-block" id="btnAgregaUsoCap" type="button" style="font-weight: 700;"> 
						            	AGREGAR
						            </button> 
			            		</div>
			            		<div class="col-6 centro">
			            			<button class="btn btn-dark btn-sm btn-block" id="btnQuitaUsoCap" type="button" style="font-weight: 700;"> 
						            	QUITAR
						            </button>
			            		</div>
			            	</div>
			            </div>
		            </form>
		        </div>
		        <div class="col-12 col-md-6 boxDatosEve form-group pt-1">
		        	<form id="estacionamientoEvento-form" action="" method="POST" name="formEstacionamientoEvento">
			            <h4 class="titBoxEve text-center"><i class="fas fa-car"></i> Estacionamientos del Evento</h4>
			            <input id="txtIndEventoEst" type="hidden" value="" name="IndEvento">
			            <hr style="border: 2px solid rgba(225, 173, 7, 1);">
			            <div class="container-fluid text-center py-2">
			            	<div class="row justify-content-center py-2">
			            		<div class="col-12 centro">
			            			<p class="text-muted"><span id="lblUsoEst">0</span> / <span id="lblMaxEst">0</span></p>
			            		</div>
			            	</div>
			            	<div class="row justify-content-center">
			            		<div class="col-4 centro">
			            			<span class=""><a href="#" role="button" class="btn btn-danger btn-sm" id="btnMenosEst"><i class="fas fa-minus"></i></a></span>
			            		</div>
			            		<div class="col-4 centro">
			            			<input type="number" id="txtUsoEst" class="form-control " min="0" max="99999" value="0" name="EstacionamientoUso">
			            		</div>
			            		<div class="col-4 centro">
			            			<span class=""><a href="#" role="button" class="btn btn-success btn-sm" id="btnMasEst"><i class="fas fa-plus"></i></a></span>
			            		</div>
			            	</div>
			            	<div class="row justify-content-center pt-4">
			            		<div class="col-6 centro">
			            			<button class="btn btn-warning btn-sm btn-block" id="btnAgregaUsoEst" type="button" style="font-weight: 700;"> 
						            	AGREGAR
						            </button> 
			            		</div>
			            		<div class="col-6 centro">
			            			<button class="btn btn-dark btn-sm btn-block" id="btnQuitaUsoEst" type="button" style="font-weight: 700;"> 
						            	QUITAR
						            </button>
			            		</div>
			            	</div>
			            </div>
		            </form>
		        </div>
		    </div>
		</div>
	</div>
	<div class="col-12">
		<div class="container text-center mt-4" style="border: 5px solid rgba(225, 173, 7, 1);padding: 1rem;background-color: rgba(255,255,255,.9);border-radius: 20px;">
			<div class="row justify-content-center">
		        <div class="col-12 boxDatosEve form-group pt-1">
		            <h4 class="titBoxEve text-center"><i class="fas fa-users"></i> Asistentes al Evento</h4>
		            <hr style="border: 2px solid rgba(225, 173, 7, 1);">
		            <div class="container-fluid">
		            	<div class="row" id="listaAsistentes">
		            		<div class="spinner-grow text-warning" style="width: 12rem; height: 10rem;" role="status"><span class="sr-only">Cargando...</span></div>
		            	</div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>';
echo $mensaje;

?>