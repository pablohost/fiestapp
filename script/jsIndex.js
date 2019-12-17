$(function(){

	listLoading();
  	sendRequest_Cate($("#getCategoria").val());
  	$("#helpCate").html(nombreCate($("#getCategoria").val()));
        
    $("#btnCategoriaEvento").click(function(event) {
    	/* Act on the event */
    	listLoading();
  		sendRequest_Cate($("#cbxCategoria").val());
  		$("#helpCate").html(nombreCate($("#cbxCategoria").val()));
    });
    //link de categorias del navegador
	  $("#slinkCategoria0").click(function(event) {
	      /* Act on the event */
	      listLoading();
	      sendRequest_Cate(0);
	      $("#helpCate").html(nombreCate(0));
	  });
	  $("#slinkCategoria1").click(function(event) {
	      /* Act on the event */
	      listLoading();
	      sendRequest_Cate(1);
	      $("#helpCate").html(nombreCate(1));
	  });
	  $("#slinkCategoria2").click(function(event) {
	      /* Act on the event */
	      listLoading();
	      sendRequest_Cate(2);
	      $("#helpCate").html(nombreCate(2));
	  });
	  $("#slinkCategoria3").click(function(event) {
	      /* Act on the event */
	      listLoading();
	      sendRequest_Cate(3);
	      $("#helpCate").html(nombreCate(3));
	  });
	  $("#slinkCategoria4").click(function(event) {
	      /* Act on the event */
	      listLoading();
	      sendRequest_Cate(4);
	      $("#helpCate").html(nombreCate(4));
	  });
	  $("#slinkCategoria5").click(function(event) {
	      /* Act on the event */
	      listLoading();
	      sendRequest_Cate(5);
	      $("#helpCate").html(nombreCate(5));
	  });
	  $("#slinkCategoria6").click(function(event) {
	      /* Act on the event */
	      listLoading();
	      sendRequest_Cate(6);
	      $("#helpCate").html(nombreCate(6));
	  });
  	//nombre de la categoria
  	function nombreCate(cateNum) {
  		// body...
  		if (cateNum==0) {
  			return "TODOS";
  		} else if (cateNum==1) {
  			return "FIESTA";
  		} else if (cateNum==2) {
  			return "MUSICA EN VIVO";
  		} else if (cateNum==3) {
  			return "FESTIVAL";
  		} else if (cateNum==4) {
  			return "STAND UP COMEDY";
  		} else if (cateNum==5) {
  			return "CONFERENCIAS";
  		} else if (cateNum==6) {
  			return "OTROS";
  		}
  	}
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
    console.log(data);
    console.log(textStatus);
    console.log(xhr);
    $("#listaEventos").empty();
    $("#listaEventos").html(data);
    setTimeout("chekea()",2000)
  });
}