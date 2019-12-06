$(function(){

	//Cargamos la seccion perfil
	cargarSeccion(0);

	$("#lkOrga1").click(function() {
		//seccion perfil de organizador
		cargarSeccion(0);
	});

	$("#lkOrga2").click(function() {
		//seccion eventos de organizador
		cargarSeccion(1);
	});

	$("#lkOrga3").click(function() {
		//seccion locales de organizador
		cargarSeccion(2);
	});

	$("#lkOrga4").click(function() {
		//seccion promociones de organizador
		cargarSeccion(3);
	});
	//boton agregar evento organizador
	$("#medio").on("click","#btnAgregaEventoOrga",function(e){
	    e.preventDefault();

	    loading();
	    $.post('script/formCreaEvento.php',
		    function(data, textStatus, xhr) {
		    /*optional stuff to do after success */
		    $( "#medio" ).empty();
	    	$( "#medio" ).html(data);
		});
  	});
	//boton cerrar sesion
	$("#cerrarSes").click(function(e) {
		e.preventDefault();

		$.post('script/sesionUsu.php',
		    function(data, textStatus, xhr) {
		    /*optional stuff to do after success */
		    let z=JSON.parse( data );
		    if (z.cod==0) {
				Swal.fire({
				  title: 'Listo !',
				  text: z.msg,
				  timer: 1500,
				  type: "success",
				  showConfirmButton: false,
				  allowOutsideClick: false
				}).then((result) => {
				  if (
				    // Read more about handling dismissals
				    result.dismiss === Swal.DismissReason.timer
				  ) {
				    window.location.href='http://www.fiestapp.tk/comunidad';
				  }
				});
		    } else {
		    	Swal.fire({ title: "Error", text: z.msg, type: "error", confirmButtonText: "OK" });
		    }
		    //$( "#medio" ).find( "#lista" ).empty();
		    //$( "#medio" ).find( "#lista" ).html(data.msg);
		});

	});
});
//funcion que carga las seccion del navegador
function cargarSeccion(opcion){
	let seccion="";
	if (opcion==0) {
		loading();
		cargaPerfil();
	}else if (opcion==1) {
		loading();
		cargaEventosOrga();
	}else if (opcion==2) {
		
	}else if (opcion==3) {
		
	}
}

function loading() {
	$( "#medio" ).empty();
    $( "#medio" ).html("<div class='spinner-grow text-warning' style='width: 12rem; height: 10rem;' role='status'><span class='sr-only'>Cargando...</span></div>");
}

function cargaPerfil(){
	let indicePerfil=$( "#idObjetivo" ).val();
	let nombrePerfil=$( "#noObjetivo" ).val();
	let tipoPerfil=$( "#tiObjetivo" ).val();
	$.post('script/cargaPerfil.php',
	    {x: indicePerfil,y: nombrePerfil,z: tipoPerfil},
	    function(data, textStatus, xhr) {
	    /*optional stuff to do after success */
	    $( "#medio" ).empty();
	    $( "#medio" ).html(data);
	    //colocamos de titulo el nombre del perfil que se esta viosualizando
		document.title = $("#medio").find("#nombrePerfil").html()+" - FIESTAPP";

	});
}

function cargaEventosOrga(){
	let indicePerfil=$( "#idObjetivo" ).val();
	let nombrePerfil=$( "#noObjetivo" ).val();
	let tipoPerfil=$( "#tiObjetivo" ).val();
	console.log(indicePerfil);
	console.log(nombrePerfil);
	console.log(tipoPerfil);
	$.post('script/cargaEventosOrga.php',
	    {x: indicePerfil,y: nombrePerfil,z: tipoPerfil},
	    function(data, textStatus, xhr) {
    	console.log(data);
    	console.log(textStatus);
    	console.log(xhr);
	    /*optional stuff to do after success */
	    $( "#medio" ).empty();
	    $( "#medio" ).html(data.msg);
	    //colocamos de titulo el nombre del perfil que se esta viosualizando
		document.title = $("#medio").find("#nombrePerfil").val()+" - FIESTAPP";
		//bloqueamos funciones a visitantes
		if (data.cod==2) {
			$("#medio").find("#btnAgregaEventoOrga").addClass('disabled');
		}

	});
}

