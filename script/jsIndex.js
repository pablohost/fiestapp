$(function(){

	listLoading();
  	sendRequest_Cate(0);
  	$("#helpCate").html("Todos");
        
	//********animacion del header typed.js*********

	var options = {
		strings: ['LAS MEJORES FIESTAS', 'EL MEJOR CARRETE', 'SHOWS DE STAND UP COMEDY', 'FESTIVALES DE MUSICA', 'EVENTOS DENTRO DE SANTIAGO'],
		typeSpeed: 80,
		loop: true
	};

	var typed = new Typed('#headCute', options);

	ScrollReveal().reveal('.sr1', {
		reset: true,
		origin: 'bottom',
		distance: '50px'
	});
	ScrollReveal().reveal('.sr2', {
		reset: true,
		origin: 'bottom',
		delay: 300,
		distance: '50px'
	});
	ScrollReveal().reveal('.sr3', {
		reset: true,
		origin: 'bottom',
		delay: 600,
		distance: '50px'
	});
	ScrollReveal().reveal('.sr4', {
		reset: true,
		origin: 'bottom',
		delay: 900,
		distance: '50px'
	});
	ScrollReveal().reveal('.sr5', {
		reset: true,
		origin: 'bottom',
		distance: '50px'
	});
	ScrollReveal().reveal('.sr6', {
		reset: true,
		origin: 'left',
		distance: '50px'
	});
	ScrollReveal().reveal('.sr7', {
		reset: true,
		origin: 'left',
		distance: '50px'
	});
	ScrollReveal().reveal('.sr8', {
		reset: true,
		origin: 'left',
		distance: '50px',
		delay: 300
	});
	ScrollReveal().reveal('.sr9', {
		reset: true,
		origin: 'left',
		distance: '50px',
		delay: 300
	});
      
});

function chekea(){
  ScrollReveal().sync();
}

function listLoading() {
  $("#listaEventos").empty();
  $("#helpCate").empty();
  $("#listaEventos").html("<div class='spinner-grow text-warning' style='width: 12rem; height: 10rem;' role='status'><span class='sr-only'>Cargando...</span></div>");
}

function sendRequest_Cate(cate) {
  $.post('script/cargaEventos.php',
    {x: cate},
    function(data, textStatus, xhr) {
    /*optional stuff to do after success */
    $("#listaEventos").empty();
    $("#listaEventos").html(data);
    setTimeout("chekea()",2000)
  });
}