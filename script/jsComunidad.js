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
		//agrego el navegador de la seccion
		/*
		seccion+="<div class='row justify-content-center'>";
		seccion+="<div class='col-12 col-sm-4'>";
		seccion+="<img class='fotoPerfil' src=''>";
		seccion+="</div>";
		seccion+="<div class='col-12 col-sm-8 navPortal' id='boxAP'>";
		seccion+="<a href='#mainProd' class='btn btn-success btnAgregaP' role='button'><i class='far fa-plus-square fa-1x'></i><span> AGREGAR</span></a>";
		seccion+="</div>";
		seccion+="<div class='col-12 navPortal' id='boxSP'>";
		seccion+="<form class='my-2' id='boxBuscarP'>";
		seccion+="<input class='form-control mr-2' type='search' placeholder='BUSCAR PRODUCTO' aria-label='Search' id='txtBuscarP'>";
		seccion+="<a href='#lista' class='btn btn-outline-danger js-scroll-trigger' role='button' aria-pressed='true' id='btnBuscarP'><i class='fas fa-search fa-1x'></i></a>";
		seccion+="</form>";
		seccion+="</div>";
		seccion+="<div class='container mainProd' style='border: 2px solid rgba(86, 0, 39,1);'>";
		seccion+="<div class='row' id='lista'>";
		seccion+="</div>";
		seccion+="</div>";
		seccion+="</div>";
		$("#medio").html(seccion);
		*/
		loading();
		cargaPerfil();
	}else if (opcion==1) {
		seccion+="<div class='row justify-content-center'><div class='col-12'><h1 class='mt-3 titPortal'>Promociones</h1><hr></div><div class='col-12 navPortalX' id='boxCbx'></div><div class='col-12 navPortalX text-muted'>NUEVO PRECIO PROMOCION(sin puntos)</div><div class='col-12 navPortalX'><input class='form-control mr-2' type='number' placeholder='0' id='txtValPro'></div><div class='col-12 navPortalX'><a href='#mainProd' class='btn btn-success btnAgregaO' role='button' id='btnAddSale'><i class='fas fa-tag fa-1x'></i><span> AGREGAR OFERTA</span></a></div><div class='container' style='border: 2px solid green;'><div class='row justify-content-center' id='lista'></div></div></div>";
		$("#medio").html(seccion);
		listaProd();
		prodLoading();
		cargaPromo();
	}else if (opcion==2) {
		seccion+="<div class='row justify-content-center'><div class='col-12'><h1 class='mt-3 titPortal'>Estadisticas</h1><hr></div><div class='col-12'><p class='my-2 text-left h4'>HISTORICO(desde la creacion de la tienda hasta la fecha)</p><p class='my-2 text-left'>Cantidad total de ventas realizadas : <b>0</b></p><p class='my-2 text-left'>Cantidad total de producto vendidos : <b>0</b></p><p class='my-2 text-left'>Total ingresos bruto : <b>0</b></p><p class='my-2 text-left'>Total pagado a Flow : <b>0</b></p><p class='my-2 text-left'>Total ingresos neto : <b>0</b></p><hr></div></div>";
		$("#medio").html(seccion);
		listaProd();
		prodLoading();
		cargaPromo();
	}else if (opcion==3) {
		let currentUsu=$("#navbarResponsive").find("#sesUsu").html();
		seccion+="<div class='row justify-content-center'><div class='col-12'><h1 class='mt-3 titPortal'>Cuentas</h1><hr></div><div class='col-12 navPortalX'><p class='my-2 text-left h3'>Cambiar Contraseña</p><form enctype='multipart/form-data' id='formCuenta' accept-charset='utf-8' method='POST'><p class='text-muted formCute my-2'>Contraseña Actual</p><input class='form-control' type='password' placeholder='Contraseña Actual' id='txtPasOld' name='pasOld'><p class='text-muted formCute my-2'>Contraseña Nueva(Minimo 6 caracteres.)</p><input class='form-control' type='password' placeholder='Contraseña Nueva' id='txtPasNew' name='pasNew'><p class='text-muted formCute my-2'>Vuelve a escribir la contraseña nueva</p><input class='form-control' type='password' placeholder='Repetir Contraseña Nueva' id='txtPasNew2' name='pasNew2'><input name='usu' type='hidden' value='"+currentUsu+"'><p class='my-2'><a href='' class='btn btn-success btnEditP' role='button' id='btnEdtPass'><span>CONFIRMAR</span></a></p></form></div></div>";
		$("#medio").html(seccion);
		listaProd();
		prodLoading();
		cargaPromo();
	}
}

function loading() {
	$( "#medio" ).empty();
    $( "#medio" ).html("<div class='spinner-grow text-warning' style='width: 12rem; height: 10rem;' role='status'><span class='sr-only'>Cargando...</span></div>");
}

function cargaPerfil(){
	let indicePerfil=$( "#idObjetivo" ).val();
	console.log(indicePerfil);
	$.post('script/cargaPerfil.php',
	    {x: indicePerfil},
	    function(data, textStatus, xhr) {
	    /*optional stuff to do after success */
	    console.log(data);
	    console.log(textStatus);
	    console.log(xhr);
	    $( "#medio" ).empty();
	    $( "#medio" ).html(data);
	});
}

