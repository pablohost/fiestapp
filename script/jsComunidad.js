$(function(){
	var cuenta=2;
	//Cargamos la seccion perfil
	cargarSeccion(0);
	//******************************************************
	//******************************************************
  	//******************************************************
  	//******************************************************
  	//PORTAL DE EVENTOS ORGANIZADOR
  	//******************************************************
  	//******************************************************
  	//******************************************************
  	//******************************************************
	$("#lkOrga1").click(function() {
		//seccion perfil de organizador
		cargarSeccion(0);
	});

	$("#lkOrga2").click(function() {
		//seccion eventos de organizador
		cargarSeccion(1);
		cuenta=2;
	});

	$("#lkOrga3").click(function() {
		//seccion locales de organizador
		cargarSeccion(2);
	});

	$("#lkOrga4").click(function() {
		//seccion promociones de organizador
		cargarSeccion(3);
	});
	//******************************************************
  	//******************************************************
  	//SECCION EVENTOS - PORTAL DE EVENTOS ORGANIZADOR
  	//******************************************************
  	//******************************************************
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
  	//Agregar otra foto al formulario
	$("#medio").on("click","#btnOtraFoto",function(e){
	    e.preventDefault();
	    let indiceFoto=0;
	    $("#fotosRecinto .custom-file").each(function(){
        	    indiceFoto=$(this).find("input").data("ind");
        	});
	    indiceFoto+=1;
	    if (indiceFoto>10) {
	    	$(this).addClass('disabled');
	    }else{
	    	$("#fotosRecinto").append('<div class="custom-file">'+
			    						'<input type="file" class="custom-file-input" id="flFotoRec'+indiceFoto+'" name="FotoRec'+indiceFoto+'" data-ind="'+indiceFoto+'">'+
		    							'<label class="custom-file-label fl'+cuenta+'" for="flFotoRec'+indiceFoto+'" data-browse="Elegir">Seleccionar Archivo</label><br><br>'+
									'</div>');
	    	cuenta+=1;
	    }
  	});
  	//boton cargar mis recintos
  	$("#medio").on("click","#btnMisRecintos",function(e){
	    e.preventDefault();
	    $("#listaRecintos").html("<div class='spinner-grow text-warning' role='status'><span class='sr-only'>Cargando...</span></div>");
	    let indicePerfil=$( "#idObjetivo" ).val();
		let nombrePerfil=$( "#noObjetivo" ).val();
		let tipoPerfil=$( "#tiObjetivo" ).val();
		console.log(indicePerfil);
		console.log(nombrePerfil);
		console.log(tipoPerfil);
		
	    $.post('script/listaRecintos.php',
		    {x: indicePerfil},
		    function(data, textStatus, xhr) {
		    //optional stuff to do after success 
		    console.log(data);
		    console.log(textStatus);
		    console.log(xhr);
		    $( "#listaRecintos" ).empty();
		    $( "#listaRecintos" ).html(data.msg);
		    limpioRecinto();
		});
  		
  	});
  	//combobox mis recintos
  	$("#medio").on("change","#cbxRecintos",function(e){
	    /* Act on the event */
      let indice = $('#cbxRecintos option:selected').val();
      //console.log(indice);
      if (indice==0) {
      	limpioRecinto();
      } else {
        $.ajax({
        type: "POST",
        url: 'script/consultaRecinto.php',
        data: {x: indice},
        success: function (data) {
          	$("#txtCapa").val(data.cap);
	      	$("#txtEsta").val(data.est);
	      	$("#txtNomLoc").val(data.nombre);
	      	$("#txtFonoLoc").val(data.fono);
	      	$("#txtCorLoc").val(data.correo);
	      	$("#txtWebLoc").val(data.web);
	      	$("#txtDescLoc").val(data.des.replace(new RegExp("<br>","g"), "\n"));
        },
        error: function () {
        }
      });
      }
  		
  	});

  	//revisa la estension de las fotos cargadas, una por una
  	$('#medio').on('change',"#flFotoEve", function() {

		//FOTO FLAYER
		console.log(this);
		console.log($('#flFotoEve'));
		comprobarArchivo(this,$('#flFotoEve'),$(".fl0"));
	});
	$('#medio').on('change',"#flFotoRec1", function() {

		//FOTO 1 RECINTO
		comprobarArchivo(this,$('#flFotoRec1'),$(".fl1"));
	});
	$('#medio').on('change',"#flFotoRec2", function() {

		//FOTO 2 RECINTO
		comprobarArchivo(this,$('#flFotoRec2'),$(".fl2"));
	});
	$('#medio').on('change',"#flFotoRec3", function() {

		//FOTO 3 RECINTO
		comprobarArchivo(this,$('#flFotoRec3'),$(".fl3"));
	});
	$('#medio').on('change',"#flFotoRec4", function() {

		//FOTO 4 RECINTO
		comprobarArchivo(this,$('#flFotoRec4'),$(".fl4"));
	});
	$('#medio').on('change',"#flFotoRec5", function() {

		//FOTO 5 RECINTO
		comprobarArchivo(this,$('#flFotoRec5'),$(".fl5"));
	});
	$('#medio').on('change',"#flFotoRec6", function() {

		//FOTO 6 RECINTO
		comprobarArchivo(this,$('#flFotoRec6'),$(".fl6"));
	});
	$('#medio').on('change',"#flFotoRec7", function() {

		//FOTO 7 RECINTO
		comprobarArchivo(this,$('#flFotoRec7'),$(".fl7"));
	});
	$('#medio').on('change',"#flFotoRec8", function() {

		//FOTO 8 RECINTO
		comprobarArchivo(this,$('#flFotoRec8'),$(".fl8"));
	});
	$('#medio').on('change',"#flFotoRec9", function() {

		//FOTO 9 RECINTO
		comprobarArchivo(this,$('#flFotoRec9'),$(".fl9"));
	});
	$('#medio').on('change',"#flFotoRec10", function() {

		//FOTO 10 RECINTO
		comprobarArchivo(this,$('#flFotoRec10'),$(".fl10"));
	});
  	//boton confirmar evento nuevo
	$("#medio").on("click","#btnConfirmaAgregaOrga",function(e){
	    e.preventDefault();
    	//mostramos al usuario animacion de carga
	    Swal.fire({
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          }
        }).then((result) => {
          
        });
        /*
        var serie=$('#creaEventoOrga-form').serialize();
        var formData = new FormData(document.getElementById("creaEventoOrga-form"));
        console.log(serie);
        console.log(formData);
        */
        //comprobamos todos los inputs
        let emailCheck = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        let textoCheck = /^[a-z\- A-Z]+$/;
        let numCheck = /^[0-9]+$/;

        //DATOS DEL EVENTO
         /* titulo evento */
        if ($("#txtTituloEve").val().length>0&&$("#txtTituloEve").val().length<90) {
           /* descripcion evento */
          if ($("#txtDescEve").val().length<1950) {
             /* foto o flyer del evento */
            if ($("#flFotoEve").val()!="") {
              //console.log($("#flFotoEve").val());
               /* categorias del evento */
              if ($("#sw1").prop("checked")==true||$("#sw2").prop("checked")==true||$("#sw3").prop("checked")==true||$("#sw4").prop("checked")==true||$("#sw5").prop("checked")==true||$("#sw6").prop("checked")==true) {
                 /* fecha de inicio */
                if ($('#dtInicio').val().length!=0) {
                   /* fecha de termino */
                  if ($('#dtFin').val().length!=0) {
                     /* enlace para comprar boletos */
                    if ($("#txtBoleEve").val().length<150) {
                      //DATOS DEL RECINTO
                       /* ubicacion del local */
                      if ($("#txtLon").val().length>0&&$("#txtLon").val().length<40&&$("#txtLat").val().length>0&&$("#txtLat").val().length<40) {
                         /* nombre del local */
                        if ($("#txtNomLoc").val().length>0&&$("#txtNomLoc").val().length<90) {
                           /* informacion del contacto */
                          if ($("#txtFonoLoc").val().length>1||$("#txtCorLoc").val().length>1||$("#txtWebLoc").val().length>1) {
                            /* descripcion recinto */
                            if ($("#txtDescLoc").val().length<1950) {
                              /* estacionamientos del recinto*/
                                if ($("#txtEsta").val().length>0) {
                                  if ($("#txtEsta").val()<99999&&numCheck.test($("#txtEsta").val())) {
                                    console.log("ingreso estacionamiento de recinto");
                                  }else{
                            		  /* error - estacionamientos */
	                                  Swal.fire({
	                                    title: 'Error en ESTACIONAMIENTOS',
	                                    html: '<p>Solo usar numeros, y con un maximo de 5 digitos</p>',
	                                    type: 'error',
	                                    confirmButtonText: 'OK',
	                                    onAfterClose: () => {
	                                      $("#txtEsta").focus();
	                                    }
	                                  });
	                                  return false;
                                  }
                                }
                            	/* capacidad del recinto*/
                                if ($("#txtCapa").val().length>0) {
                                  if ($("#txtCapa").val()<99999&&numCheck.test($("#txtCapa").val())) {
                                    console.log("ingreso capacidad de recinto");
                                  }else{
                                    /* error - capacidad recinto */
	                                Swal.fire({
	                                  title: 'Error en CAPACIDAD PERSONAS',
	                                  html: '<p>Solo usar numeros, y con un maximo de 5 digitos</p>',
	                                  type: 'error',
	                                  confirmButtonText: 'OK',
	                                  onAfterClose: () => {
	                                    $("#txtCapa").focus();
	                                  }
	                                });
                                    return false;
                                  }
                                }
                              	/* numero de telefono recinto*/
                                if ($("#txtFonoLoc").val().length>0) {
                                  if ($("#txtFonoLoc").val().length==8&&numCheck.test($("#txtFonoLoc").val())) {
                                    console.log("ingreso numero de telefono");
                                  }else{
                                    Swal.fire({
                                      title: 'Error en TELEFONO',
                                      html: '<p>El telefono solo deben ser numeros con un minimo de 8 numeros.</p><p style="color:red;">Se debe omitir el codigo de area.</p>',
                                      type: 'error',
                                      confirmButtonText: 'OK',
                                      onAfterClose: () => {
                                        $("#txtFonoLoc").focus();
                                      }
                                    });
                                    return false;
                                  }
                                }
                                /* correo electronico recinto */
                                if ($("#txtCorLoc").val().length>0&&$("#txtCorLoc").val().length<45) {
                                  if (emailCheck.test($("#txtCorLoc").val())) {
                                    console.log("ingreso correo electronico");
                                  }else{
                                    Swal.fire({
                                      title: 'Error en CORREO ELECTRONICO RECINTO',
                                      html: '<p>El correo electronico tiene un maximo de 45 caracteres.</p>',
                                      type: 'error',
                                      confirmButtonText: 'OK',
                                      onAfterClose: () => {
                                        $("#txtCorLoc").focus();
                                      }
                                    });
                                    return false;
                                  }
                                }
                                /* pagina web recinto */
                                if ($("#txtWebLoc").val().length>0) {
                                	if ($("#txtWebLoc").val().length<50) {
	                                  let fixLink=$("#txtWebLoc").val().substr(0, 4);
	                                  if (fixLink=="http") {
	                                  	console.log("ingreso pagina web ok");
	                                  }else{
	                                  	$("#txtWebLoc").val("https://"+$("#txtWebLoc").val());
	                                  }
	                                }else{
	                                  Swal.fire({
	                                    title: 'Error en PAGINA WEB',
	                                    html: '<p>La pagina web tiene una maximo de 50 caracteres.</p>',
	                                    type: 'error',
	                                    confirmButtonText: 'OK',
	                                    onAfterClose: () => {
	                                      $("#txtWebLoc").focus();
	                                    }
	                                  });
	                                  return false;
	                                }
                                }

                                /* en este punto todos los campos estan OK */
                                /* Validacion campo recaptcha */

                                let x=$('#creaEventoOrga-form').serialize();
                                console.log(x);
                                $.ajax({
                                  type: "POST",
                                  url: 'script/robot.php',
                                  data: x,
                                  dataType: "json",
                                  success: function (respuesta) {
                                    let z=respuesta;
                                    if (z.cod==0) {
                                      //console.log(z.msg);
                                      //****************************************
                                      //****En este punto todos los inputs fueron ingresados correctamente :) !
                                      //****************************************
                                      //no eres robot
                                      guardarEventoOrga();
                                      console.log("campos obligatorios OK");

                                    } else if(z.cod==1){
                                      //console.log(z.msg);
                                      //si eres robot
                                      Swal.fire({ title: z.msg, text: "No olvide completar el campo ReCaptcha", type: "info", confirmButtonText: "OK" });
                                      return false;
                                      
                                    }
                                      
                                  },
                                  error: function () {
                                    //ha habido un error desconocido
                                    Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
                                    return false;
                                  }
                                });
                            }else{
                              /* error - descripcion recinto */
                              Swal.fire({
                                title: 'Error en DESCRIPCION RECINTO',
                                html: '<p>La descripcion tiene un maximo de 2000 caracteres.</p>',
                                type: 'error',
                                confirmButtonText: 'OK',
                                onAfterClose: () => {
                                  $("#txtDescLoc").focus();
                                }
                              });

                            }
                          } else {
                            /* error - contacto recinto */
                            Swal.fire({
                              title: 'Error en CONTACTO DEL RECINTO',
                              html: '<p>Debe proporcionarnos almenos un metodo de contacto con el recinto.</p><p style="color:red;">Esto es OBLIGATORIO.</p>',
                              type: 'error',
                              confirmButtonText: 'OK',
                              onAfterClose: () => {
                                $("#txtFonoLoc").focus();
                              }
                            });
                          }
                        } else {
                          /* error - nombre recinto */
                          Swal.fire({
                            title: 'Error en NOMBRE DEL RECINTO',
                            html: '<p>El nombre del recinto tiene un maximo de 90 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                            type: 'error',
                            confirmButtonText: 'OK',
                            onAfterClose: () => {
                              $("#txtNomLoc").focus();
                            }
                          });
                        }
                      } else {
                        /* error - ubicacion recinto */
                        Swal.fire({
                          title: 'Error en UBICACION DEL RECINTO',
                          html: '<p>Debe indicar donde esta el recinto, por ahora solo se admiten coordenadas.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                          type: 'error',
                          confirmButtonText: 'OK',
                          onAfterClose: () => {
                            $("#txtLon").focus();
                          }
                        });
                      }
                    } else {
                      /* error - enlace boletos */
                      Swal.fire({
                        title: 'Error en ENLACE COMPRA DE BOLETOS',
                        html: '<p>El enlace tiene un maximo de 140 caracteres</p>',
                        type: 'error',
                        confirmButtonText: 'OK',
                        onAfterClose: () => {
                          $("#txtBoleEve").focus();
                        }
                      });
                    }
                  } else {
                    /* error - fecha termino evento */
                    Swal.fire({
                      title: 'Error en FECHA FINALIZACION DEL EVENTO',
                      html: '<p>Debe indicar que dia y hora termina su evento.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                      type: 'error',
                      confirmButtonText: 'OK',
                      onAfterClose: () => {
                        $("#dtFin").focus();
                      }
                    });
                  }
                } else {
                  /* error - fecha inicio evento */
                  Swal.fire({
                    title: 'Error en FECHA INICIO DEL EVENTO',
                    html: '<p>Debe indicar que dia y hora comienza su evento.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                    type: 'error',
                    confirmButtonText: 'OK',
                    onAfterClose: () => {
                      $("#dtInicio").focus();
                    }
                  });
                }
              } else {
                /* error - categoria evento */
                Swal.fire({
                  title: 'Error en CATEGORIAS DEL EVENTO',
                  html: '<p>Debe agregar al menos una categoria a su evento.</p><p style="color:red;">Esto es OBLIGATORIO.</p>',
                  type: 'error',
                  confirmButtonText: 'OK',
                  onAfterClose: () => {
                    $("#sw1").focus();
                  }
                });
              }
            } else {
              /* error - foto evento */
              Swal.fire({
                title: 'Error en FOTO EVENTO',
                html: '<p>Debe agregar una foto de referencia para su evento.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                type: 'error',
                confirmButtonText: 'OK',
                onAfterClose: () => {
                  $("#flFotoEve").focus();
                }
              });
            }
          } else {
            /* error - descripcion evento */
            Swal.fire({
              title: 'Error en DESCRIPCION EVENTO',
              html: '<p>La descripcion tiene un maximo de 2000 caracteres.</p>',
              type: 'error',
              confirmButtonText: 'OK',
              onAfterClose: () => {
                $("#txtDescEve").focus();
              }
            });
          }
        } else {
          /* error - titulo evento */
          Swal.fire({
            title: 'Error en TITULO EVENTO',
            html: '<p>El titulo tiene un maximo de 90 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
            type: 'error',
            confirmButtonText: 'OK',
            onAfterClose: () => {
              $("#txtTituloEve").focus();
            }
          });
        }
  	});
  	//boton volver atras eventos
	$("#medio").on("click","#btnAtrasEventos",function(e){
	    e.preventDefault();

	    $("#lkOrga2").click();
  	});
  	//boton eliminar evento - organizador
  	$("#medio").on("click","#btnBorraEventoOrga",function(e){
	    e.preventDefault();
	    let x=$(this).data("ind");

	    Swal.fire({
		  title: 'Estas seguro/a?',
		  html: "Estas a punto de <b>ELIMINAR</b> para siempre<hr>"+$(this).parentsUntil(".boxEve").find(".infoProd").html(),
		  type: 'error',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar!',
		  cancelButtonText: 'Volver Atras',
		}).then((result) => {
		  if (result.value) {
		      setTimeout(function(){ borraEvento(x); },2500)
		  	
		    Swal.fire({
		    	allowOutsideClick: false,
			  onBeforeOpen: () => {
			    Swal.showLoading()
			  },
			  onClose: () => {

			  }
			}).then((result) => {
			  
			})
		  }
		})
  	});
  	//boton editar evento - organizador
  	$("#medio").on("click","#btnEditaEventoOrga",function(e){
	    e.preventDefault();
	    let indice=$(this).data("ind");
	    let nombreEve=$(this).data("nom");
	    loading();
	    $.post('script/formEditaEvento.php',
		    function(data, textStatus, xhr) {
		    $( "#medio" ).empty();
	    	$( "#medio" ).html(data);
	    	$( "#lblNomRec" ).html(nombreEve);
	    	
	    	$.ajax({
		        type: "POST",
		        url: 'script/consultaEvento.php',
		        data: {x: indice},
		        success: function (data, textStatus, xhr) {
		        	console.log(data);
		    		console.log(textStatus);
		    		console.log(xhr);
		        	$("#txtIndEvento").val(data.indEvento);
		        	$("#txtTituloEve").val(data.tituloEvento);
		        	$("#txtDescEve").val(data.desEvento.replace(new RegExp("<br>","g"), "\n"));
		        	$("#dtInicio").val(data.fecIni);
		        	$("#cbxInicio").val(data.hrIni);
		        	$("#dtFin").val(data.fecFin);
		        	$("#cbxFin").val(data.hrFin);
		        	$("#txtBoleEve").val(data.boleto);
		        	$("#txtLon").val(data.lon);
		        	$("#txtLat").val(data.lat);
		          	$("#txtCapa").val(data.cap);
			      	$("#txtEsta").val(data.est);
			      	$("#txtNomLoc").val(data.nombreRecinto);
			      	$("#txtFonoLoc").val(data.fono);
			      	$("#txtCorLoc").val(data.correo);
			      	$("#txtWebLoc").val(data.web);
			      	$("#txtDescLoc").val(data.desRecinto.replace(new RegExp("<br>","g"), "\n"));
			      	$.each( data.cates, function( key, value ) {
					  if (value==1) {
					  	$("#sw1").prop("checked", true);
					  }else if (value==2) {
					  	$("#sw2").prop("checked", true);
					  }else if (value==3) {
					  	$("#sw3").prop("checked", true);
					  }else if (value==4) {
					  	$("#sw4").prop("checked", true);
					  }else if (value==5) {
					  	$("#sw5").prop("checked", true);
					  }else if (value==6) {
					  	$("#sw6").prop("checked", true);
					  }
					});
					$.post('script/listaRecintos.php',
					    {x: data.usu},
					    function(lista, textStatus, xhr) {
					    //optional stuff to do after success 
					    console.log(lista);
					    console.log(textStatus);
					    console.log(xhr);
					    $( "#listaRecintos" ).empty();
					    $( "#listaRecintos" ).html(lista.msg);
					    $("#cbxRecintos").val(data.indRecinto);
					});
		        },
		        error: function () {
		        }
			});
	  	});
	});
	//boton confirmar editar evento - organizador
	$("#medio").on("click","#btnConfirmaEditEve",function(e){
	    e.preventDefault();
    	//mostramos al usuario animacion de carga
	    Swal.fire({
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          }
        }).then((result) => {
          
        });
        //comprobamos todos los inputs
        let emailCheck = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        let textoCheck = /^[a-z\- A-Z]+$/;
        let numCheck = /^[0-9]+$/;

        //DATOS DEL EVENTO
         /* titulo evento */
        if ($("#txtTituloEve").val().length>0&&$("#txtTituloEve").val().length<90) {
	        /* descripcion evento */
	        if ($("#txtDescEve").val().length<1950) {
               /* categorias del evento */
              if ($("#sw1").prop("checked")==true||$("#sw2").prop("checked")==true||$("#sw3").prop("checked")==true||$("#sw4").prop("checked")==true||$("#sw5").prop("checked")==true||$("#sw6").prop("checked")==true) {
                 /* fecha de inicio */
                if ($('#dtInicio').val().length!=0) {
                   /* fecha de termino */
                  if ($('#dtFin').val().length!=0) {
                     /* enlace para comprar boletos */
                    if ($("#txtBoleEve").val().length<150) {
                      //DATOS DEL RECINTO
                       /* ubicacion del local */
                      if ($("#txtLon").val().length>0&&$("#txtLon").val().length<40&&$("#txtLat").val().length>0&&$("#txtLat").val().length<40) {
                         /* nombre del local */
                        if ($("#txtNomLoc").val().length>0&&$("#txtNomLoc").val().length<90) {
                           /* informacion del contacto */
                          if ($("#txtFonoLoc").val().length>1||$("#txtCorLoc").val().length>1||$("#txtWebLoc").val().length>1) {
                            /* descripcion recinto */
                            if ($("#txtDescLoc").val().length<1950) {
                            	/* estacionamientos del recinto*/
                                if ($("#txtEsta").val().length>0) {
                                  if ($("#txtEsta").val()<99999&&numCheck.test($("#txtEsta").val())) {
                                    console.log("ingreso estacionamiento de recinto");
                                  }else{
                            		  /* error - estacionamientos */
	                                  Swal.fire({
	                                    title: 'Error en ESTACIONAMIENTOS',
	                                    html: '<p>Solo usar numeros, y con un maximo de 5 digitos</p>',
	                                    type: 'error',
	                                    confirmButtonText: 'OK',
	                                    onAfterClose: () => {
	                                      $("#txtEsta").focus();
	                                    }
	                                  });
	                                  return false;
                                  }
                                }
                            	/* capacidad del recinto*/
                                if ($("#txtCapa").val().length>0) {
                                  if ($("#txtCapa").val()<99999&&numCheck.test($("#txtCapa").val())) {
                                    console.log("ingreso capacidad de recinto");
                                  }else{
                                    /* error - capacidad recinto */
	                                Swal.fire({
	                                  title: 'Error en CAPACIDAD PERSONAS',
	                                  html: '<p>Solo usar numeros, y con un maximo de 5 digitos</p>',
	                                  type: 'error',
	                                  confirmButtonText: 'OK',
	                                  onAfterClose: () => {
	                                    $("#txtCapa").focus();
	                                  }
	                                });
                                    return false;
                                  }
                                }
                              	/* numero de telefono recinto*/
                                if ($("#txtFonoLoc").val().length>0) {
                                  if ($("#txtFonoLoc").val().length==8&&numCheck.test($("#txtFonoLoc").val())) {
                                    console.log("ingreso numero de telefono");
                                  }else{
                                    Swal.fire({
                                      title: 'Error en TELEFONO',
                                      html: '<p>El telefono solo deben ser numeros con un minimo de 8 numeros.</p><p style="color:red;">Se debe omitir el codigo de area.</p>',
                                      type: 'error',
                                      confirmButtonText: 'OK',
                                      onAfterClose: () => {
                                        $("#txtFonoLoc").focus();
                                      }
                                    });
                                    return false;
                                  }
                                }
                                /* correo electronico recinto */
                                if ($("#txtCorLoc").val().length>0&&$("#txtCorLoc").val().length<45) {
                                  if (emailCheck.test($("#txtCorLoc").val())) {
                                    console.log("ingreso correo electronico");
                                  }else{
                                    Swal.fire({
                                      title: 'Error en CORREO ELECTRONICO RECINTO',
                                      html: '<p>El correo electronico tiene un maximo de 45 caracteres.</p>',
                                      type: 'error',
                                      confirmButtonText: 'OK',
                                      onAfterClose: () => {
                                        $("#txtCorLoc").focus();
                                      }
                                    });
                                    return false;
                                  }
                                }
                                /* pagina web recinto */
                                if ($("#txtWebLoc").val().length>0) {
                                	if ($("#txtWebLoc").val().length<50) {
	                                  let fixLink=$("#txtWebLoc").val().substr(0, 4);
	                                  if (fixLink=="http") {
	                                  	console.log("ingreso pagina web ok");
	                                  }else{
	                                  	$("#txtWebLoc").val("https://"+$("#txtWebLoc").val());
	                                  }
	                                }else{
	                                  Swal.fire({
	                                    title: 'Error en PAGINA WEB',
	                                    html: '<p>La pagina web tiene una maximo de 50 caracteres.</p>',
	                                    type: 'error',
	                                    confirmButtonText: 'OK',
	                                    onAfterClose: () => {
	                                      $("#txtWebLoc").focus();
	                                    }
	                                  });
	                                  return false;
	                                }
                                }

                                /* en este punto todos los campos estan OK */
                                /* Validacion campo recaptcha */

                                let x=$('#editaEventoOrga-form').serialize();
                                console.log(x);
                                  $.ajax({
	                                  type: "POST",
	                                  url: 'script/robot.php',
	                                  data: x,
	                                  dataType: "json",
	                                  success: function (respuesta) {
	                                    let z=respuesta;
	                                    if (z.cod==0) {
	                                      //console.log(z.msg);
	                                      //****************************************
	                                      //****En este punto todos los inputs fueron ingresados correctamente :) !
	                                      //****************************************
	                                      //no eres robot
	                                      editaEventoOrga();
	                                      console.log("campos obligatorios OK");

	                                    } else if(z.cod==1){
	                                      //console.log(z.msg);
	                                      //si eres robot
	                                      Swal.fire({ title: z.msg, text: "No olvide completar el campo ReCaptcha", type: "info", confirmButtonText: "OK" });
	                                      return false;
	                                      
	                                    }
                                      
                                  },
                                  error: function () {
                                    //ha habido un error desconocido
                                    Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
                                    return false;
                                  }
                                });
                            }else{
                              /* error - descripcion recinto */
                              Swal.fire({
                                title: 'Error en DESCRIPCION RECINTO',
                                html: '<p>La descripcion tiene un maximo de 2000 caracteres.</p>',
                                type: 'error',
                                confirmButtonText: 'OK',
                                onAfterClose: () => {
                                  $("#txtDescLoc").focus();
                                }
                              });

                            }
                          } else {
                            /* error - contacto recinto */
                            Swal.fire({
                              title: 'Error en CONTACTO DEL RECINTO',
                              html: '<p>Debe proporcionarnos almenos un metodo de contacto con el recinto.</p><p style="color:red;">Esto es OBLIGATORIO.</p>',
                              type: 'error',
                              confirmButtonText: 'OK',
                              onAfterClose: () => {
                                $("#txtFonoLoc").focus();
                              }
                            });
                          }
                        } else {
                          /* error - nombre recinto */
                          Swal.fire({
                            title: 'Error en NOMBRE DEL RECINTO',
                            html: '<p>El nombre del recinto tiene un maximo de 90 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                            type: 'error',
                            confirmButtonText: 'OK',
                            onAfterClose: () => {
                              $("#txtNomLoc").focus();
                            }
                          });
                        }
                      } else {
                        /* error - ubicacion recinto */
                        Swal.fire({
                          title: 'Error en UBICACION DEL RECINTO',
                          html: '<p>Debe indicar donde esta el recinto, por ahora solo se admiten coordenadas.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                          type: 'error',
                          confirmButtonText: 'OK',
                          onAfterClose: () => {
                            $("#txtLon").focus();
                          }
                        });
                      }
                    } else {
                      /* error - enlace boletos */
                      Swal.fire({
                        title: 'Error en ENLACE COMPRA DE BOLETOS',
                        html: '<p>El enlace tiene un maximo de 140 caracteres</p>',
                        type: 'error',
                        confirmButtonText: 'OK',
                        onAfterClose: () => {
                          $("#txtBoleEve").focus();
                        }
                      });
                    }
                  } else {
                    /* error - fecha termino evento */
                    Swal.fire({
                      title: 'Error en FECHA FINALIZACION DEL EVENTO',
                      html: '<p>Debe indicar que dia y hora termina su evento.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                      type: 'error',
                      confirmButtonText: 'OK',
                      onAfterClose: () => {
                        $("#dtFin").focus();
                      }
                    });
                  }
                } else {
                  /* error - fecha inicio evento */
                  Swal.fire({
                    title: 'Error en FECHA INICIO DEL EVENTO',
                    html: '<p>Debe indicar que dia y hora comienza su evento.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                    type: 'error',
                    confirmButtonText: 'OK',
                    onAfterClose: () => {
                      $("#dtInicio").focus();
                    }
                  });
                }
              } else {
                /* error - categoria evento */
                Swal.fire({
                  title: 'Error en CATEGORIAS DEL EVENTO',
                  html: '<p>Debe agregar al menos una categoria a su evento.</p><p style="color:red;">Esto es OBLIGATORIO.</p>',
                  type: 'error',
                  confirmButtonText: 'OK',
                  onAfterClose: () => {
                    $("#sw1").focus();
                  }
                });
              }
	        } else {
	            /* error - descripcion evento */
	            Swal.fire({
	              title: 'Error en DESCRIPCION EVENTO',
	              html: '<p>La descripcion tiene un maximo de 2000 caracteres.</p>',
	              type: 'error',
	              confirmButtonText: 'OK',
	              onAfterClose: () => {
	                $("#txtDescEve").focus();
	              }
	            });
	        }
        } else {
          /* error - titulo evento */
          Swal.fire({
            title: 'Error en TITULO EVENTO',
            html: '<p>El titulo tiene un maximo de 90 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
            type: 'error',
            confirmButtonText: 'OK',
            onAfterClose: () => {
              $("#txtTituloEve").focus();
            }
          });
        }
  	});
	//boton gestionar evento - organizador
  	$("#medio").on("click","#btnGestionEvento",function(e){
	    e.preventDefault();
	    let indiceEve=$(this).data("ind");
	    let nombreEve=$(this).data("nom");
	    loading();
	    $.post('script/revisaEvento.php',
		    {x: indiceEve},
		    function(mensaje, textStatus, xhr) {
		    //optional stuff to do after success 
		    console.log(mensaje);
		    console.log(textStatus);
		    console.log(xhr);
		    if (mensaje.cod==0) {
		    	Swal.fire({
	                title: "ERROR",
	                text: "NO SE ENCUENTRA EVENTO",
	                type: "error",
	                confirmButtonText: "OK",
	                onAfterClose: () => {
		              $("#lkOrga2").click();
		            }
	            });
		    }else if(mensaje.cod==1){
		    	$.post('script/formGestionEvento.php',
				    function(data, textStatus, xhr) {
				    $( "#medio" ).empty();
			    	$( "#medio" ).html(data);
			    	$( "#lblNomEve" ).html(nombreEve);
			    	if (mensaje.estadoEvento==0) {
			    		//aun no comienza el evento
			    		$( "#boxGestionEvento" ).empty();
			    		if (mensaje.dias==0) {
			    			$( "#boxGestionEvento" ).html('<h4>El evento esta por comenzar</h4>');
			    		}else{
			    			$( "#boxGestionEvento" ).html('<h4>Faltan '+mensaje.dias+' Dias para que comienze el evento</h4>');
			    		}
			    		
			    	}else if (mensaje.estadoEvento==1) {
			    		//el evento es ahora
			    		$("#lblUsoCap").html(mensaje.capUso);
			    		$("#lblMaxCap").html(mensaje.capMax);
			    		$("#lblUsoEst").html(mensaje.estUso);
			    		$("#lblMaxEst").html(mensaje.estMax);
			    		$("#txtIndEventoCap").val(indiceEve);
			    		$("#txtIndEventoEst").val(indiceEve);
			    	}else if (mensaje.estadoEvento==2) {
			    		//el evento finalizo
			    		$( "#boxGestionEvento" ).empty();
			    		$( "#boxGestionEvento" ).html('<h4>El evento ya finalizo</h4>');
			    	}
			  	});
		    }
		});
  	});
  	//controlamos los input numericos de la gestion de evento
  	$("#medio").on("change","#txtUsoCap",function(e){
	    /* Act on the event */
		let valTemp = $(this).val();
		let usoTemp=parseInt($("#medio").find("#lblUsoCap").html());
	    let maxTemp=parseInt($("#medio").find("#lblMaxCap").html());
		if (valTemp != NaN) {
			if (valTemp>maxTemp) {
				Swal.fire({
	                title: 'Error',
	                html: '<p>No puedes sumar mas asistentes que el maximo total</p>',
	                type: 'error',
	                confirmButtonText: 'OK',
	                onAfterClose: () => {
	                	$(this).val("0");
	                }
	            });
			}else{
				if (valTemp<0) {
					Swal.fire({
		                title: 'Error',
		                html: '<p>No puedes agregar o quitar menos de 0</p>',
		                type: 'error',
		                confirmButtonText: 'OK',
		                onAfterClose: () => {
		                	$(this).val("0");
		                }
		            });
				}
			}
		}else{
			$(this).val("0");
		}
  	});
  	$("#medio").on("change","#txtUsoEst",function(e){
	    /* Act on the event */
		let valTemp = $(this).val();
		let usoTemp=parseInt($("#medio").find("#lblUsoEst").html());
	    let maxTemp=parseInt($("#medio").find("#lblMaxEst").html());
		if (valTemp != NaN) {
			if (valTemp>maxTemp) {
				Swal.fire({
	                title: 'Error',
	                html: '<p>No puedes sumar mas asistentes que el maximo total</p>',
	                type: 'error',
	                confirmButtonText: 'OK',
	                onAfterClose: () => {
	                	$(this).val("0");
	                }
	            });
			}else{
				if (valTemp<0) {
					Swal.fire({
		                title: 'Error',
		                html: '<p>No puedes agregar o quitar menos de 0</p>',
		                type: 'error',
		                confirmButtonText: 'OK',
		                onAfterClose: () => {
		                	$(this).val("0");
		                }
		            });
				}
			}
		}else{
			$(this).val("0");
		}
  	});
  	//boton gestionar evento - SUMAR CAPACIDAD
  	$("#medio").on("click","#btnMasCap",function(e){
	    e.preventDefault();
	    let valTemp=parseInt($("#medio").find("#txtUsoCap").val());
	    let usoTemp=parseInt($("#medio").find("#lblUsoCap").html());
	    let maxTemp=parseInt($("#medio").find("#lblMaxCap").html());
	    if (valTemp>=maxTemp) {
	    	Swal.fire({
                title: 'Error',
                html: '<p>No puedes sumar mas asistentes que el maximo total</p>',
                type: 'error',
                confirmButtonText: 'OK',
                onAfterClose: () => {
                }
            });
	    }else{
	    	valTemp+=1;
	    	$("#medio").find("#txtUsoCap").val(valTemp);
	    }
  	});
  	//boton gestionar evento - RESTAR CAPACIDAD
  	$("#medio").on("click","#btnMenosCap",function(e){
	    e.preventDefault();
	    let valTemp=parseInt($("#medio").find("#txtUsoCap").val());
	    if (valTemp<=0) {
	    	Swal.fire({
                title: 'Error',
                html: '<p>No puedes agregar o quitar menos de 0</p>',
                type: 'error',
                confirmButtonText: 'OK',
                onAfterClose: () => {
                }
            });
	    }else{
	    	valTemp-=1;
	    	$("#medio").find("#txtUsoCap").val(valTemp);
	    }
  	});
  	//boton gestionar evento - SUMAR ESTACIONAMIENTO
  	$("#medio").on("click","#btnMasEst",function(e){
	    e.preventDefault();
	    let valTemp=parseInt($("#medio").find("#txtUsoEst").val());
	    let usoTemp=parseInt($("#medio").find("#lblUsoEst").html());
	    let maxTemp=parseInt($("#medio").find("#lblMaxEst").html());
	    let dif=maxTemp-usoTemp;
	    if (valTemp>=dif) {
	    	Swal.fire({
                title: 'Error',
                html: '<p>No puedes sumar mas asistentes que el maximo total</p>',
                type: 'error',
                confirmButtonText: 'OK',
                onAfterClose: () => {
                }
            });
	    }else{
	    	valTemp+=1;
	    	$("#medio").find("#txtUsoEst").val(valTemp);
	    }
  	});
  	//boton gestionar evento - RESTAR ESTACIONAMIENTO
  	$("#medio").on("click","#btnMenosEst",function(e){
	    e.preventDefault();
	    let valTemp=parseInt($("#medio").find("#txtUsoEst").val());
	    if (valTemp<=0) {
	    	Swal.fire({
                title: 'Error',
                html: '<p>No puedes agregar o quitar menos de 0</p>',
                type: 'error',
                confirmButtonText: 'OK',
                onAfterClose: () => {
                }
            });
	    }else{
	    	valTemp-=1;
	    	$("#medio").find("#txtUsoEst").val(valTemp);
	    }
  	});
  	//boton gestionar evento - AGREGAR ASISTENTES
  	$("#medio").on("click","#btnAgregaUsoCap",function(e){
	    e.preventDefault();
	    Swal.fire({
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          }
        }).then((result) => {
          
        });
	    let x=$('[name=formCapacidadEvento]').serialize();
	    console.log(x);
	    actualizaCap(x,0);
  	});
  	//boton gestionar evento - QUITAR ASISTENTES
  	$("#medio").on("click","#btnQuitaUsoCap",function(e){
	    e.preventDefault();
	    Swal.fire({
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          }
        }).then((result) => {
          
        });
	    let x=$('[name=formCapacidadEvento]').serialize();
	    console.log(x);
	    actualizaCap(x,1);
  	});
  	//boton gestionar evento - AGREGAR ESTACIONAMIENTOS
  	$("#medio").on("click","#btnAgregaUsoEst",function(e){
	    e.preventDefault();
	    Swal.fire({
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          }
        }).then((result) => {
          
        });
	    let x=$('[name=formEstacionamientoEvento]').serialize();
	    console.log(x);
	    actualizaEst(x,0);
  	});
  	//boton gestionar evento - QUITAR ESTACIONAMIENTOS
  	$("#medio").on("click","#btnQuitaUsoEst",function(e){
	    e.preventDefault();
	    Swal.fire({
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          }
        }).then((result) => {
          
        });
	    let x=$('[name=formEstacionamientoEvento]').serialize();
	    console.log(x);
	    actualizaEst(x,1);
  	});
  	//******************************************************
  	//******************************************************
  	//SECCION RECINTOS - PORTAL DE EVENTOS ORGANIZADOR
  	//******************************************************
  	//******************************************************

  	//boton eliminar recinto - organizador
  	$("#medio").on("click","#btnBorraRecintoOrga",function(e){
	    e.preventDefault();
	    let x=$(this).data("ind");

	    Swal.fire({
		  title: 'Estas seguro/a?',
		  html: "Estas a punto de <b>ELIMINAR</b> para siempre<hr>"+$(this).parentsUntil(".boxEve").find(".infoProd").html(),
		  type: 'error',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar!',
		  cancelButtonText: 'Volver Atras',
		}).then((result) => {
		  if (result.value) {
		      setTimeout(function(){ borraRecinto(x); },2500)
		  	
		    Swal.fire({
		    	allowOutsideClick: false,
			  onBeforeOpen: () => {
			    Swal.showLoading()
			  },
			  onClose: () => {

			  }
			}).then((result) => {
			  
			})
		  }
		})
  	});

  	//boton editar recinto - organizador
  	$("#medio").on("click","#btnEditaRecintoOrga",function(e){
	    e.preventDefault();
	    let indice=$(this).data("ind");
	    loading();
	    $.post('script/formEditaRecinto.php',
		    function(data, textStatus, xhr) {
		    $( "#medio" ).empty();
	    	$( "#medio" ).html(data);
	    	$.ajax({
		        type: "POST",
		        url: 'script/consultaRecinto.php',
		        data: {x: indice},
		        success: function (data) {
		        	$("#txtIndRecinto").val(data.ind);
		        	$("#txtLon").val(data.lon);
		        	$("#txtLat").val(data.lat);
		          	$("#txtCapa").val(data.cap);
			      	$("#txtEsta").val(data.est);
			      	$("#txtNomLoc").val(data.nombre);
			      	$("#txtFonoLoc").val(data.fono);
			      	$("#txtCorLoc").val(data.correo);
			      	$("#txtWebLoc").val(data.web);
			      	$("#txtDescLoc").val(data.des.replace(new RegExp("<br>","g"), "\n"));
		        },
		        error: function () {
		        }
			});
	  	});
	});

	//boton galeria recinto - organizador
  	$("#medio").on("click","#btnGaleRecintoOrga",function(e){
	    e.preventDefault();
	    let indice=$(this).data("ind");
	    let nombre=$(this).data("nom");
	    loading();
	    $.post('script/formGaleRecinto.php',
	    	{x: indice,z: nombre},
		    function(data, textStatus, xhr) {
	    	console.log(data);
		    console.log(textStatus);
		    console.log(xhr);
		    if (data.cod==0) {
		    	$( "#medio" ).empty();
	    		$( "#medio" ).html(data.msg);
		    	jQuery("#gallery").unitegallery({
					gallery_theme: "tiles",
					tiles_min_columns: 1,
					tiles_col_width: 350,
					tile_border_color:"#7a7a7a",
					tile_outline_color:"#8B8B8B",
					tile_enable_shadow:true,
					tile_shadow_color:"#8B8B8B",
					tile_overlay_opacity:0.3,
					tile_show_link_icon:true,
					tile_image_effect_type:"sepia",
					tile_image_effect_reverse:true,
					tile_enable_textpanel:true,
					lightbox_textpanel_title_color:"e5e5e5",
					tiles_space_between_cols:20	
				});
		    }else if (data.cod==1) {
		    	$( "#medio" ).empty();
	    		$( "#medio" ).html(data.msg);
		    }
	    	
	  	});
	});
  	
  	//boton borrar foto recinto - organizador
  	$("#medio").on("click",".ug-icon-link",function(e){
	    e.preventDefault();
	    
	    let x=$(this).attr('href');
	    Swal.fire({
		  title: 'Estas seguro/a?',
		  html: "Estas a punto de <b>ELIMINAR</b> para siempre esta foto",
		  type: 'error',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar!',
		  cancelButtonText: 'Volver Atras',
		}).then((result) => {
		  if (result.value) {
		      setTimeout(function(){ borraFotoRecinto(x); },2500)
		  	
		    Swal.fire({
		    	allowOutsideClick: false,
			  onBeforeOpen: () => {
			    Swal.showLoading()
			  },
			  onClose: () => {

			  }
			}).then((result) => {
			  
			})
		  }
		})
		
	});

  	//boton volver atras recintos
	$("#medio").on("click","#btnAtrasRecintos",function(e){
	    e.preventDefault();

	    $("#lkOrga3").click();
  	});
  	//boton confirmar evento editado
	$("#medio").on("click","#btnConfirmaRecintoOrga",function(e){
	    e.preventDefault();
    	//mostramos al usuario animacion de carga
	    Swal.fire({
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          }
        }).then((result) => {
          
        });
        /*
        var serie=$('#creaEventoOrga-form').serialize();
        var formData = new FormData(document.getElementById("creaEventoOrga-form"));
        console.log(serie);
        console.log(formData);
        */
        //comprobamos todos los inputs
        let emailCheck = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        let numCheck = /^[0-9]+$/;

        //DATOS DEL RECINTO
		/* ubicacion del local */
		if ($("#txtLon").val().length>0&&$("#txtLon").val().length<40&&$("#txtLat").val().length>0&&$("#txtLat").val().length<40) {
			 /* nombre del local */
			if ($("#txtNomLoc").val().length>0&&$("#txtNomLoc").val().length<90) {
			   /* informacion del contacto */
			  if ($("#txtFonoLoc").val().length>1||$("#txtCorLoc").val().length>1||$("#txtWebLoc").val().length>1) {
			    /* descripcion recinto */
			    if ($("#txtDescLoc").val().length<1950) {
			    	/* estacionamientos del recinto*/
                    if ($("#txtEsta").val().length>0) {
                      if ($("#txtEsta").val()<99999&&numCheck.test($("#txtEsta").val())) {
                        console.log("ingreso estacionamiento de recinto");
                      }else{
                		  /* error - estacionamientos */
                          Swal.fire({
                            title: 'Error en ESTACIONAMIENTOS',
                            html: '<p>Solo usar numeros, y con un maximo de 5 digitos</p>',
                            type: 'error',
                            confirmButtonText: 'OK',
                            onAfterClose: () => {
                              $("#txtEsta").focus();
                            }
                          });
                          return false;
                      }
                    }
                	/* capacidad del recinto*/
                    if ($("#txtCapa").val().length>0) {
                      if ($("#txtCapa").val()<99999&&numCheck.test($("#txtCapa").val())) {
                        console.log("ingreso capacidad de recinto");
                      }else{
                        /* error - capacidad recinto */
                        Swal.fire({
                          title: 'Error en CAPACIDAD PERSONAS',
                          html: '<p>Solo usar numeros, y con un maximo de 5 digitos</p>',
                          type: 'error',
                          confirmButtonText: 'OK',
                          onAfterClose: () => {
                            $("#txtCapa").focus();
                          }
                        });
                        return false;
                      }
                    }
                  	/* numero de telefono recinto*/
                    if ($("#txtFonoLoc").val().length>0) {
                      if ($("#txtFonoLoc").val().length==8&&numCheck.test($("#txtFonoLoc").val())) {
                        console.log("ingreso numero de telefono");
                      }else{
                        Swal.fire({
                          title: 'Error en TELEFONO',
                          html: '<p>El telefono solo deben ser numeros con un minimo de 8 numeros.</p><p style="color:red;">Se debe omitir el codigo de area.</p>',
                          type: 'error',
                          confirmButtonText: 'OK',
                          onAfterClose: () => {
                            $("#txtFonoLoc").focus();
                          }
                        });
                        return false;
                      }
                    }
                    /* correo electronico recinto */
                    if ($("#txtCorLoc").val().length>0&&$("#txtCorLoc").val().length<45) {
                      if (emailCheck.test($("#txtCorLoc").val())) {
                        console.log("ingreso correo electronico");
                      }else{
                        Swal.fire({
                          title: 'Error en CORREO ELECTRONICO RECINTO',
                          html: '<p>El correo electronico tiene un maximo de 45 caracteres.</p>',
                          type: 'error',
                          confirmButtonText: 'OK',
                          onAfterClose: () => {
                            $("#txtCorLoc").focus();
                          }
                        });
                        return false;
                      }
                    }
                    /* pagina web recinto */
                    if ($("#txtWebLoc").val().length>0) {
                    	if ($("#txtWebLoc").val().length<50) {
                          let fixLink=$("#txtWebLoc").val().substr(0, 4);
                          if (fixLink=="http") {
                          	console.log("ingreso pagina web ok");
                          }else{
                          	$("#txtWebLoc").val("https://"+$("#txtWebLoc").val());
                          }
                        }else{
                          Swal.fire({
                            title: 'Error en PAGINA WEB',
                            html: '<p>La pagina web tiene una maximo de 50 caracteres.</p>',
                            type: 'error',
                            confirmButtonText: 'OK',
                            onAfterClose: () => {
                              $("#txtWebLoc").focus();
                            }
                          });
                          return false;
                        }
                    }

                    /* en este punto todos los campos estan OK */
                    /* Validacion campo recaptcha */

                    let x=$('#editaRecintoOrga-form').serialize();
		            console.log(x);
		            $.ajax({
		              type: "POST",
		              url: 'script/robot.php',
		              data: x,
		              dataType: "json",
		              success: function (respuesta) {
		                let z=respuesta;
		                if (z.cod==0) {
		                  //console.log(z.msg);
		                  //****************************************
		                  //****En este punto todos los inputs fueron ingresados correctamente :) !
		                  //****************************************
		                  //no eres robot
		                  editarRecintoOrga();
		                  console.log("campos obligatorios OK");

		                } else if(z.cod==1){
		                  //console.log(z.msg);
		                  //si eres robot
		                  Swal.fire({ title: z.msg, text: "No olvide completar el campo ReCaptcha", type: "info", confirmButtonText: "OK" });
		                  return false;
		                  
		                }
		                  
		              },
		              error: function () {
		                //ha habido un error desconocido
		                Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
		                return false;
		              }
		            });
			    }else{
			      /* error - descripcion recinto */
			      Swal.fire({
			        title: 'Error en DESCRIPCION RECINTO',
			        html: '<p>La descripcion tiene un maximo de 2000 caracteres.</p>',
			        type: 'error',
			        confirmButtonText: 'OK',
			        onAfterClose: () => {
			          $("#txtDescLoc").focus();
			        }
			      });

			    }
			  } else {
			    /* error - contacto recinto */
			    Swal.fire({
			      title: 'Error en CONTACTO DEL RECINTO',
			      html: '<p>Debe proporcionarnos almenos un metodo de contacto con el recinto.</p><p style="color:red;">Esto es OBLIGATORIO.</p>',
			      type: 'error',
			      confirmButtonText: 'OK',
			      onAfterClose: () => {
			        $("#txtFonoLoc").focus();
			      }
			    });
			  }
			} else {
			  /* error - nombre recinto */
			  Swal.fire({
			    title: 'Error en NOMBRE DEL RECINTO',
			    html: '<p>El nombre del recinto tiene un maximo de 90 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
			    type: 'error',
			    confirmButtonText: 'OK',
			    onAfterClose: () => {
			      $("#txtNomLoc").focus();
			    }
			  });
			}
		} else {
			/* error - ubicacion recinto */
			Swal.fire({
			  title: 'Error en UBICACION DEL RECINTO',
			  html: '<p>Debe indicar donde esta el recinto, por ahora solo se admiten coordenadas.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
			  type: 'error',
			  confirmButtonText: 'OK',
			  onAfterClose: () => {
			    $("#txtLon").focus();
			  }
			});
		}
  	});

	//boton confirma carga de fotos
	$("#medio").on("click","#btnConfirmaGaleOrga",function(e){
	    e.preventDefault();

	    if (($("#flFotoRec1").val()==""||$("#flFotoRec1").val()==undefined)&&($("#flFotoRec2").val()==""||$("#flFotoRec2").val()==undefined)&&($("#flFotoRec3").val()==""||$("#flFotoRec3").val()==undefined)&&($("#flFotoRec4").val()==""||$("#flFotoRec4").val()==undefined)&&($("#flFotoRec5").val()==""||$("#flFotoRec5").val()==undefined)&&($("#flFotoRec6").val()==""||$("#flFotoRec6").val()==undefined)&&($("#flFotoRec7").val()==""||$("#flFotoRec7").val()==undefined)&&($("#flFotoRec8").val()==""||$("#flFotoRec8").val()==undefined)&&($("#flFotoRec9").val()==""||$("#flFotoRec9").val()==undefined)&&($("#flFotoRec10").val()==""||$("#flFotoRec10").val()==undefined)) {
	    	Swal.fire({
			  title: 'ERROR',
			  html: '<p>Debes subir almenos una fotografia nueva</p>',
			  type: 'error',
			  confirmButtonText: 'OK',
			  onAfterClose: () => {
			    $("#flFotoRec1").focus();
			  }
			});
	    }else{
	    	/* Validacion campo recaptcha */

            let x=$('#agregaFotoOrga-form').serialize();
            console.log(x);
            $.ajax({
              type: "POST",
              url: 'script/robot.php',
              data: x,
              dataType: "json",
              success: function (respuesta) {
                let z=respuesta;
                if (z.cod==0) {
                  //console.log(z.msg);
                  //****************************************
                  //****En este punto todos los inputs fueron ingresados correctamente :) !
                  //****************************************
                  //no eres robot
                  agregaFotoRecinto($("#txtIndRecinto").val());
                  console.log("campos obligatorios OK");

                } else if(z.cod==1){
                  //console.log(z.msg);
                  //si eres robot
                  Swal.fire({ title: z.msg, text: "No olvide completar el campo ReCaptcha", type: "info", confirmButtonText: "OK" });
                  return false;
                  
                }
                  
              },
              error: function () {
                //ha habido un error desconocido
                Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
                return false;
              }
            });
	    }
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
		loading();
		cargaRecintosOrga();
	}else if (opcion==3) {
		loading();
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
			$("#medio").find("#botoneraOrgaEve").empty();
			$("#medio").find("#botoneraEve").empty();
		}

		//cargamos eventos finalizados
		$( "#subMedioFin" ).html("<div class='spinner-grow text-warning' style='width: 12rem; height: 10rem;' role='status'><span class='sr-only'>Cargando...</span></div>");
		$.post('script/cargaEventosOrgaFin.php',
		    {x: indicePerfil,y: nombrePerfil,z: tipoPerfil},
		    function(data, textStatus, xhr) {
	    	console.log(data);
	    	console.log(textStatus);
	    	console.log(xhr);
		    /*optional stuff to do after success */
		    $( "#subMedioFin" ).empty();
		    $( "#subMedioFin" ).html(data.msg);
		    if (data.cod==2) {
				$("#medio").find("#botoneraEve").empty();
			}
		});

	});
}
function cargaRecintosOrga(){
	let indicePerfil=$( "#idObjetivo" ).val();
	let nombrePerfil=$( "#noObjetivo" ).val();
	let tipoPerfil=$( "#tiObjetivo" ).val();
	console.log(indicePerfil);
	console.log(nombrePerfil);
	console.log(tipoPerfil);
	$.post('script/cargaRecintosOrga.php',
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
			$("#medio").find("#botoneraRec").empty();
		}

	});
}
function hackScript(textoCrudo) {
	// body...
	let textoCocido = textoCrudo.replace(new RegExp("<script>","gi"), "hack");
	textoCocido = textoCocido.replace(new RegExp("</script>","gi"), "hack");
	return textoCocido;
}
function guardarEventoOrga() {
	// body...
	Swal.fire({
      title: 'Creando Evento...',
      text: $("#txtTituloEve").val(),
      type: "success",
      showConfirmButton: false,
      allowOutsideClick: false,
      allowEscapeKey: false,
      onBeforeOpen: () => {
        Swal.showLoading();
      }
    }).then((result) => {
      
    });

    //recuperamos todos los datos ingresados por el usuario

    let cates="";
    if ($("#sw1").prop( "checked" )) {
      cates+="1:";
    }
    if ($("#sw2").prop( "checked" )) {
      cates+="2:";
    }
    if ($("#sw3").prop( "checked" )) {
      cates+="3:";
    }
    if ($("#sw4").prop( "checked" )) {
      cates+="4:";
    }
    if ($("#sw5").prop( "checked" )) {
      cates+="5:";
    }
    if ($("#sw6").prop( "checked" )) {
      cates+="6:";
    }

    let desEve = $("#txtDescEve").val();
    let desEveBR = desEve.replace(new RegExp("\n","g"), "<br>");
    desEveBR = hackScript(desEveBR);
    let desLoc = $("#txtDescLoc").val();
    let desLocBR = desLoc.replace(new RegExp("\n","g"), "<br>");
    desLocBR = hackScript(desLocBR);
    //limpio todos los campos de texto de scripts maliciosos
    $("#txtTituloEve").val(hackScript($("#txtTituloEve").val()));
    $("#txtBoleEve").val(hackScript($("#txtBoleEve").val()));
    $("#txtNomLoc").val(hackScript($("#txtNomLoc").val()));
    $("#txtCorLoc").val(hackScript($("#txtCorLoc").val()));
    $("#txtWebLoc").val(hackScript($("#txtWebLoc").val()));
    //cambio comillas dobles por simples
    $("#txtTituloEve").val($("#txtTituloEve").val().replace(new RegExp("\"","gi"), "'"));
    $("#txtNomLoc").val($("#txtNomLoc").val().replace(new RegExp("\"","gi"), "'"));


    //let x=$('[name=formCreaEvento]').serialize()+cates;
    //console.log(x);

    var formData = new FormData(document.getElementById("creaEventoOrga-form"));
    formData.append('Categorias', cates);
    formData.append('descEventoBR', desEveBR);
    formData.append('descLocalBR', desLocBR);
    formData.append('indiceUsu', $("#idObjetivo").val());
    
    $.ajax({
      type: "POST",
      url: 'script/regEveOrga.php',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        console.log(respuesta);
        let z=respuesta;
        if (z.cod==0) {
          Swal.fire({
            title: respuesta.msg,
            html: '<p>Ahora nuestros administradores evaluaran si publicar tu evento</p>',
            type: 'success',
            confirmButtonText: 'OK',
            onAfterClose: () => {
              $("#lkOrga2").click();
            }
          });
        }else if(z.cod==1){
          Swal.fire({
            title: respuesta.msg,
            html: '<p>Intenta Otra Vez !</p>',
            type: 'info',
            confirmButtonText: 'OK',
            onAfterClose: () => {

            }
          });
        }else if(z.cod==2){
          Swal.fire({
            title: 'Error en Fecha y Hora del Evento',
            html: respuesta.msg,
            type: 'error',
            confirmButtonText: 'OK',
            onAfterClose: () => {
              $("#dtInicio").focus();
            }
          });
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr);
        console.log(ajaxOptions);
        console.log(thrownError);
        Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
      }
    });
}

function comprobarArchivo(elemento, archivo, texto) {
	// body...
	if (archivo.val()!="") {
	  if (elemento.files[0].type=="image/jpg"||elemento.files[0].type=="image/jpeg"||elemento.files[0].type=="image/png") {
	    texto.html("<span style='color:green;'>Archivo Cargado Correctamente <i class='fas fa-check'></i></span>");
	  } else {
	    texto.html("<span style='color:red;'>Solo se permiten imagenes en formato JPG, JPEG y PNG <i class='fas fa-times'></i></span>");
	    archivo.val("");
	  }
	  
	} else {
	  texto.html("Seleccionar Archivo");
	}
}
function limpioRecinto() {
	// body...
	$("#txtCapa").val("");
  	$("#txtEsta").val("");
  	$("#txtNomLoc").val("");
  	$("#txtFonoLoc").val("");
  	$("#txtCorLoc").val("");
  	$("#txtWebLoc").val("");
  	$("#txtDescLoc").val("");
}

function borraRecinto(indice){
	$.ajax({
	    type: "POST",
	    url: 'script/comprobarIdentidad.php',
	    data: {ind: indice,mod: 1},
	    success: function (data) {
	      	if (data.cod==0) {
	      		$.get( "script/borraRecinto.php?indice="+indice, function( respuesta ) {
				  if (respuesta.cod === 0) {
			            Swal.fire({
			                title: "Listo!",
			                text: respuesta.msg,
			                type: "success",
			                confirmButtonText: "Ok"
			            });
			            $("#lkOrga3").click();
			        } else {
			            Swal.fire({
			                title: "Error",
			                text: respuesta.msg,
			                type: "warning",
			                confirmButtonText: "Ok"
			            });
			        }
				}, "json");
	      	}else{
	      		Swal.fire({
	                title: data.msg,
	                text: "ERROR FATAL",
	                type: "error",
	                confirmButtonText: "OK",
	                onAfterClose: () => {
		              $("#lkOrga3").click();
		            }
	            });
	      	}
	    },
	    error: function () {
	    }
    });
}

function editarRecintoOrga() {
	// body...
	Swal.fire({
      title: 'Editando Recinto...',
      text: $("#txtNomLoc").val(),
      type: "success",
      showConfirmButton: false,
      allowOutsideClick: false,
      allowEscapeKey: false,
      onBeforeOpen: () => {
        Swal.showLoading();
      }
    }).then((result) => {
      
    });

    //recuperamos todos los datos ingresados por el usuario
    let desLoc = $("#txtDescLoc").val();
    let desLocBR = desLoc.replace(new RegExp("\n","g"), "<br>");
    desLocBR = hackScript(desLocBR);
    //limpio todos los campos de texto de scripts maliciosos
    $("#txtNomLoc").val(hackScript($("#txtNomLoc").val()));
    $("#txtCorLoc").val(hackScript($("#txtCorLoc").val()));
    $("#txtWebLoc").val(hackScript($("#txtWebLoc").val()));
    //cambio comillas dobles por simples
    $("#txtNomLoc").val($("#txtNomLoc").val().replace(new RegExp("\"","gi"), "'"));

    //creamos el formData con todos los datos necesarios para ser enviado
    var formData = new FormData(document.getElementById("editaRecintoOrga-form"));
    formData.append('descLocalBR', desLocBR);
    
    $.ajax({
      type: "POST",
      url: 'script/editRecOrga.php',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        console.log(respuesta);
        let z=respuesta;
        if (z.cod==0) {
          Swal.fire({
            title: respuesta.msg,
            html: '<p>Recuerda siempre utilizar datos reales</p>',
            type: 'success',
            confirmButtonText: 'OK',
            onAfterClose: () => {
              $("#lkOrga2").click();
            }
          });
        }else if(z.cod==1){
          Swal.fire({
            title: respuesta.msg,
            html: '<p>Intenta Otra Vez !</p>',
            type: 'info',
            confirmButtonText: 'OK',
            onAfterClose: () => {

            }
          });
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr);
        console.log(ajaxOptions);
        console.log(thrownError);
        Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
      }
    });
}

function agregaFotoRecinto(indice) {
	// body...
	Swal.fire({
      title: 'Subiendo...',
      type: "success",
      showConfirmButton: false,
      allowOutsideClick: false,
      allowEscapeKey: false,
      onBeforeOpen: () => {
        Swal.showLoading();
      }
    }).then((result) => {
      
    });
    //filtro de seguridad
    $.ajax({
	    type: "POST",
	    url: 'script/comprobarIdentidad.php',
	    data: {ind: indice,mod: 1},
	    success: function (data) {
	      	if (data.cod==0) {
	      		//recuperamos todos los datos ingresados por el usuario
			    //creamos el formData con todos los datos necesarios para ser enviado
			    var formData = new FormData(document.getElementById("agregaFotoOrga-form"));
			    
			    $.ajax({
			      type: "POST",
			      url: 'script/agregaFotoRecinto.php',
			      data: formData,
			      cache: false,
			      contentType: false,
			      processData: false,
			      dataType: "json",
			      success: function (respuesta) {
			        console.log(respuesta);
			        let z=respuesta;
			        if (z.cod==0) {
			          Swal.fire({
			            title: respuesta.msg,
			            html: '<p>La galeria de tu recinto se actualizo!</p>',
			            type: 'success',
			            confirmButtonText: 'OK',
			            onAfterClose: () => {
			              $("#lkOrga3").click();
			            }
			          });
			        }else if(z.cod==1){
			          Swal.fire({
			            title: respuesta.msg,
			            html: '<p>Intenta Otra Vez !</p>',
			            type: 'info',
			            confirmButtonText: 'OK',
			            onAfterClose: () => {

			            }
			          });
			        }
			      },
			      error: function (xhr, ajaxOptions, thrownError) {
			        console.log(xhr);
			        console.log(ajaxOptions);
			        console.log(thrownError);
			        Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
			      }
			    });
	      	}else{
	      		Swal.fire({
	                title: data.msg,
	                text: "ERROR FATAL",
	                type: "error",
	                confirmButtonText: "OK",
	                onAfterClose: () => {
		              $("#lkOrga3").click();
		            }
	            });
	      	}
	    },
	    error: function () {
	    }
    });
}

function borraFotoRecinto(indice) {
	// body...
	$.ajax({
	    type: "POST",
	    url: 'script/comprobarIdentidad.php',
	    data: {ind: indice,mod: 2},
	    success: function (data) {
	      	if (data.cod==0) {
	      		$.get( "script/borraFotoRecinto.php?indice="+indice, function( respuesta ) {
				  if (respuesta.cod === 0) {
			            Swal.fire({
			                title: "Listo!",
			                text: respuesta.msg,
			                type: "success",
			                confirmButtonText: "Ok"
			            });
			            $("#lkOrga3").click();
			        } else {
			            Swal.fire({
			                title: "Error",
			                text: respuesta.msg,
			                type: "warning",
			                confirmButtonText: "Ok"
			            });
			        }
				}, "json");
	      	}else{
	      		Swal.fire({
	                title: data.msg,
	                text: "ERROR FATAL",
	                type: "error",
	                confirmButtonText: "OK",
	                onAfterClose: () => {
		              $("#lkOrga3").click();
		            }
	            });
	      	}
	    },
	    error: function () {
	    }
    });
}

function borraEvento(indice) {
	// body...
	$.ajax({
	    type: "POST",
	    url: 'script/comprobarIdentidad.php',
	    data: {ind: indice,mod: 3},
	    success: function (data) {
	      	if (data.cod==0) {
	      		$.get( "script/borraEvento.php?indice="+indice, function( respuesta ) {
				  if (respuesta.cod === 0) {
			            Swal.fire({
			                title: "Listo!",
			                text: respuesta.msg,
			                type: "success",
			                confirmButtonText: "Ok"
			            });
			            $("#lkOrga2").click();
			        } else {
			            Swal.fire({
			                title: "Error",
			                text: respuesta.msg,
			                type: "warning",
			                confirmButtonText: "Ok"
			            });
			        }
				}, "json");
	      	}else{
	      		Swal.fire({
	                title: data.msg,
	                text: "ERROR FATAL",
	                type: "error",
	                confirmButtonText: "OK",
	                onAfterClose: () => {
		              $("#lkOrga2").click();
		            }
	            });
	      	}
	    },
	    error: function () {
	    }
    });
}

function editaEventoOrga() {
	// body...
	Swal.fire({
      title: 'Editando Evento...',
      text: $("#txtTituloEve").val(),
      type: "success",
      showConfirmButton: false,
      allowOutsideClick: false,
      allowEscapeKey: false,
      onBeforeOpen: () => {
        Swal.showLoading();
      }
    }).then((result) => {
      
    });
    //comprobamos que el usuario que esta editando es el dueño del evento
    let indice=$("#txtIndEvento").val();
    $.ajax({
	    type: "POST",
	    url: 'script/comprobarIdentidad.php',
	    data: {ind: indice,mod: 3},
	    success: function (data) {
	      	if (data.cod==0) {
	      		//recuperamos todos los datos ingresados por el usuario

			    let cates="";
			    if ($("#sw1").prop( "checked" )) {
			      cates+="1:";
			    }
			    if ($("#sw2").prop( "checked" )) {
			      cates+="2:";
			    }
			    if ($("#sw3").prop( "checked" )) {
			      cates+="3:";
			    }
			    if ($("#sw4").prop( "checked" )) {
			      cates+="4:";
			    }
			    if ($("#sw5").prop( "checked" )) {
			      cates+="5:";
			    }
			    if ($("#sw6").prop( "checked" )) {
			      cates+="6:";
			    }

			    let desEve = $("#txtDescEve").val();
			    let desEveBR = desEve.replace(new RegExp("\n","g"), "<br>");
			    desEveBR = hackScript(desEveBR);
			    let desLoc = $("#txtDescLoc").val();
			    let desLocBR = desLoc.replace(new RegExp("\n","g"), "<br>");
			    desLocBR = hackScript(desLocBR);
			    //limpio todos los campos de texto de scripts maliciosos
			    $("#txtTituloEve").val(hackScript($("#txtTituloEve").val()));
			    $("#txtBoleEve").val(hackScript($("#txtBoleEve").val()));
			    $("#txtNomLoc").val(hackScript($("#txtNomLoc").val()));
			    $("#txtCorLoc").val(hackScript($("#txtCorLoc").val()));
			    $("#txtWebLoc").val(hackScript($("#txtWebLoc").val()));
			    //cambio comillas dobles por simples
			    $("#txtTituloEve").val($("#txtTituloEve").val().replace(new RegExp("\"","gi"), "'"));
			    $("#txtNomLoc").val($("#txtNomLoc").val().replace(new RegExp("\"","gi"), "'"));


			    //let x=$('[name=formCreaEvento]').serialize()+cates;
			    //console.log(x);

			    var formData = new FormData(document.getElementById("editaEventoOrga-form"));
			    formData.append('Categorias', cates);
			    formData.append('descEventoBR', desEveBR);
			    formData.append('descLocalBR', desLocBR);
			    formData.append('indiceUsu', $("#idObjetivo").val());
			    
			    $.ajax({
			      type: "POST",
			      url: 'script/editEveOrga.php',
			      data: formData,
			      cache: false,
			      contentType: false,
			      processData: false,
			      dataType: "json",
			      success: function (respuesta) {
			        console.log(respuesta);
			        let z=respuesta;
			        if (z.cod==0) {
			          Swal.fire({
			            title: respuesta.msg,
			            html: '<p>Ahora nuestros administradores evaluaran si publicar tu evento</p>',
			            type: 'success',
			            confirmButtonText: 'OK',
			            onAfterClose: () => {
			              $("#lkOrga2").click();
			            }
			          });
			        }else if(z.cod==1){
			          Swal.fire({
			            title: respuesta.msg,
			            html: '<p>Intenta Otra Vez !</p>',
			            type: 'info',
			            confirmButtonText: 'OK',
			            onAfterClose: () => {

			            }
			          });
			        }else if(z.cod==2){
			          Swal.fire({
			            title: 'Error en Fecha y Hora del Evento',
			            html: respuesta.msg,
			            type: 'error',
			            confirmButtonText: 'OK',
			            onAfterClose: () => {
			              $("#dtInicio").focus();
			            }
			          });
			        }
			      },
			      error: function (xhr, ajaxOptions, thrownError) {
			        console.log(xhr);
			        console.log(ajaxOptions);
			        console.log(thrownError);
			        Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
			      }
			    });
	      	}else{
	      		Swal.fire({
	                title: data.msg,
	                text: "ERROR FATAL",
	                type: "error",
	                confirmButtonText: "OK",
	                onAfterClose: () => {
		              $("#lkOrga2").click();
		            }
	            });
	      	}
	    },
	    error: function () {
	    }
    });
}

function actualizaCap(formulario, modo) {
	// body...
	if (modo==0) {
		//modo agregar asistentes
		formulario=formulario+"&Modo=0";
		$.ajax({
			type: "POST",
			url: 'script/actualizaCapacidad.php',
			data: formulario,
			success: function (respuesta) {
				console.log(respuesta);
				if (respuesta.cod==0) {
			    	Swal.fire({
		                title: "OK",
		                text: respuesta.msg,
		                type: "success",
		                confirmButtonText: "OK",
		                onAfterClose: () => {
			              $("#medio").find("#lblUsoCap").html(respuesta.cap);
			              $("#medio").find("#txtUsoCap").val("0");
			            }
		            });
			    }else if(respuesta.cod==1){
			    	Swal.fire({
		                title: "ERROR",
		                text: respuesta.msg,
		                type: "error",
		                confirmButtonText: "OK",
		                onAfterClose: () => {
			            }
		            });
		            $("#medio").find("#txtUsoCap").val("0");
			    }
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr);
				console.log(ajaxOptions);
				console.log(thrownError);
				Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
			}
		});
	}else if (modo==1) {
		//modo quitar asistentes
		formulario=formulario+"&Modo=1";
		$.ajax({
			type: "POST",
			url: 'script/actualizaCapacidad.php',
			data: formulario,
			success: function (respuesta) {
				console.log(respuesta);
				if (respuesta.cod==0) {
			    	Swal.fire({
		                title: "OK",
		                text: respuesta.msg,
		                type: "success",
		                confirmButtonText: "OK",
		                onAfterClose: () => {
			              $("#medio").find("#lblUsoCap").html(respuesta.cap);
			              $("#medio").find("#txtUsoCap").val("0");
			            }
		            });
			    }else if(respuesta.cod==1){
			    	Swal.fire({
		                title: "ERROR",
		                text: respuesta.msg,
		                type: "error",
		                confirmButtonText: "OK",
		                onAfterClose: () => {
			            }
		            });
		            $("#medio").find("#txtUsoCap").val("0");
			    }
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr);
				console.log(ajaxOptions);
				console.log(thrownError);
				Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
			}
		});
	}
}

function actualizaEst(formulario, modo) {
	// body...
	if (modo==0) {
		//modo agregar asistentes
		formulario=formulario+"&Modo=0";
		$.ajax({
			type: "POST",
			url: 'script/actualizaEstacionamiento.php',
			data: formulario,
			success: function (respuesta) {
				console.log(respuesta);
				if (respuesta.cod==0) {
			    	Swal.fire({
		                title: "OK",
		                text: respuesta.msg,
		                type: "success",
		                confirmButtonText: "OK",
		                onAfterClose: () => {
			              $("#medio").find("#lblUsoEst").html(respuesta.cap);
			              $("#medio").find("#txtUsoEst").val("0");
			            }
		            });
			    }else if(respuesta.cod==1){
			    	Swal.fire({
		                title: "ERROR",
		                text: respuesta.msg,
		                type: "error",
		                confirmButtonText: "OK",
		                onAfterClose: () => {
			            }
		            });
		            $("#medio").find("#txtUsoEst").val("0");
			    }
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr);
				console.log(ajaxOptions);
				console.log(thrownError);
				Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
			}
		});
	}else if (modo==1) {
		//modo quitar asistentes
		formulario=formulario+"&Modo=1";
		$.ajax({
			type: "POST",
			url: 'script/actualizaEstacionamiento.php',
			data: formulario,
			success: function (respuesta) {
				console.log(respuesta);
				if (respuesta.cod==0) {
			    	Swal.fire({
		                title: "OK",
		                text: respuesta.msg,
		                type: "success",
		                confirmButtonText: "OK",
		                onAfterClose: () => {
			              $("#medio").find("#lblUsoEst").html(respuesta.cap);
			              $("#medio").find("#txtUsoEst").val("0");
			            }
		            });
			    }else if(respuesta.cod==1){
			    	Swal.fire({
		                title: "ERROR",
		                text: respuesta.msg,
		                type: "error",
		                confirmButtonText: "OK",
		                onAfterClose: () => {
			            }
		            });
		            $("#medio").find("#txtUsoEst").val("0");
			    }
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr);
				console.log(ajaxOptions);
				console.log(thrownError);
				Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
			}
		});
	}
}