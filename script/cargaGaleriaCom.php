<?php 
header('Content-Type: application/json; charset=utf-8');
session_start();
$mensaje='';

$mensaje.='
<div class="row pt-5">
	<div class="col-12">
		<h1 class="titComu">FOTOS</h1>
	</div>
	<div class="col-12" id="boxNuevaFoto">
		<div class="container text-left" style="border: 5px solid rgba(225, 173, 7, 1);padding: 1rem;background-color: rgba(255,255,255,.9);border-radius: 20px;">
			<form id="agregaFotoPer-form" action="" method="POST" name="formAgregaFotoPer">
			    <div class="row justify-content-center">
			    	<input id="txtIndPerfil" type="hidden" value="'.$_POST['x'].'" name="IndPerfil">
			        <!--FOTOS-->
			        <div class="col-12 boxDatosEve form-group pt-1">
			            <!--Galeria Recinto-->
			            <span class="titInput">AGREGAR NUEVAS FOTOS</span>
			            <div id="fotosPerfil">
			            	<div class="custom-file">
				              <input type="file" class="custom-file-input" id="flFotoPer1" name="FotoPer1" data-ind="1">
				              <label class="custom-file-label fl1" for="flFotoPer1" data-browse="Elegir">Seleccionar Archivo</label>
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
			            <button class="btn btn-warning btn-lg btn-block" id="btnConfirmaGalePer" type="button" style="font-weight: 700;"> 
			                CONFIRMAR <i class="fas fa-check"></i>
			            </button> 
			        </div>
			    </div>
			</form>
			<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		</div>
	</div>
	<div class="col-12 pb-2 text-left">
	<hr>';

function arreglo($msg,$cod){
    //cod  0=bueno & 1=malo
     return $datos= array(
        'msg' => $msg,
        'cod' => $cod
    );
}

// conectar la base da datos 

$config = parse_ini_file('config.ini');

$host = 'localhost'; 
$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$host.";charset=utf8",$config['username'], $config['password']); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// iniciar transacción 
$conn->beginTransaction();

try { 

	//comprobamos si es el dueño del perfil o un visitante
	$visita=true;
	if ($_POST["x"]==$_SESSION['objetivo']) {
		# code...
		$visita=false;
	}

    // BUSCAMOS EL RECINTO
    $sql = 'SELECT GaleriasUsu.img,GaleriasUsu.ind
            FROM GaleriasUsu
            WHERE GaleriasUsu.indUsu=:valInd;';

    $result = $conn->prepare($sql); 
    $result->bindValue(':valInd', $_POST['x'], PDO::PARAM_INT); 
    // Especificamos el fetch mode antes de llamar a fetch()
    $result->setFetchMode(PDO::FETCH_BOTH);
    // Ejecutamos
    $result->execute();
    //Comprobamos si encontro el evento activo
    $filas=$result->rowCount();
    if ($filas!=0) {
    	$mensaje.='
    	<div class="container" id="galRecinto">
			<div id="gallery" style="display:none;">';
		// Mostramos los resultados
		while ($row = $result->fetch()){
			//guardamos todos los datos de la BD en variables
			//perfil normal
			if ($visita) {
				$mensaje.="<img alt='Foto de ".$_POST['z']."' src='".$row[0]."' data-image='". $row[0] ."' data-description=''>";
			}else{
				//ESTAS CARGARNDO TU PROPIO PERFIL
				$mensaje.="
				<a href='".$row[1]."'>
					<img alt='Foto de ".$_POST['z']."' src='".$row[0]."' data-image='". $row[0] ."' data-description=''>
				</a>";
			}
		}

		$mensaje.='</div>
		        </div>
		      	<br>
		    </div>
		    <script type="text/javascript" src="script/unitegallery.min.js"></script>
			<script src="script/ug-theme-tiles.js" type="text/javascript"></script> 
		</div>';

		if ($visita) {
			# code...
			echo json_encode(arreglo($mensaje,2), JSON_FORCE_OBJECT);
			die();
		}else{
			echo json_encode(arreglo($mensaje,0), JSON_FORCE_OBJECT);
			die();
		}
    }else{
		$mensaje.="<h4 class='text-center'>No hay fotos.</h4>";
		$mensaje.='<br>
		    </div>
		</div>';
		if ($visita) {
			# code...
			echo json_encode(arreglo($mensaje,3), JSON_FORCE_OBJECT);
			die();
		}else{
			echo json_encode(arreglo($mensaje,4), JSON_FORCE_OBJECT);
			die();
		}
    }
    
} catch (PDOException $e) { 
    // si ocurre un error hacemos rollback para anular todos los insert 
    $conn->rollback(); 
    //echo json_encode(arreglo("Error Interno",1), JSON_FORCE_OBJECT);
    //die();
    echo $e->getMessage();
}

?>