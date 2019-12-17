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
        if ($("#txtTituloEve").val().length>0&&$("#txtTituloEve").val().length<150) {
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
                        if ($("#txtNomLoc").val().length>0&&$("#txtNomLoc").val().length<120) {
                           /* informacion del contacto */
                          if ($("#txtFonoLoc").val().length>1||$("#txtCorLoc").val().length>1||$("#txtWebLoc").val().length>1) {
                            /* descripcion recinto */
                            if ($("#txtDescLoc").val().length<1950) {
                              /* capacidad del recinto */
                              if ($("#txtCapa").val()>-1&&$("#txtCapa").val()<99999&&numCheck.test($("#txtCapa").val())) {
                                /* estacionamientos del recinto */
                                if ($("#txtEsta").val()>-1&&$("#txtEsta").val()<99999&&numCheck.test($("#txtEsta").val())) {
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
	                                if ($("#txtCorLoc").val().length>0&&$("#txtCorLoc").val().length<90) {
	                                  if (emailCheck.test($("#txtCorLoc").val())) {
	                                    console.log("ingreso numero de telefono");
	                                  }else{
	                                    Swal.fire({
	                                      title: 'Error en TELEFONO',
	                                      html: '<p>El telefono solo deben ser numeros con un minimo de 8 numeros.</p><p style="color:red;">Se debe omitir el codigo de area.</p>',
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
	                                if ($("#txtWebLoc").val().length>0&&$("#txtWebLoc").val().length<60) {
	                                  let fixLink=$("#txtWebLoc").val().substr(0, 4);
	                                  if (fixLink=="http") {
	                                  	console.log("ingreso pagina web ok");
	                                  }else{
	                                  	$("#txtWebLoc").val("https://"+$("#txtWebLoc").val());
	                                  }
	                                }else{
	                                  Swal.fire({
	                                    title: 'Error en PAGINA WEB',
	                                    html: '<p>La pagina web tiene una maximo de 60 caracteres.</p>',
	                                    type: 'error',
	                                    confirmButtonText: 'OK',
	                                    onAfterClose: () => {
	                                      $("#txtWebLoc").focus();
	                                    }
	                                  });
	                                  return false;
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
                                }
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
                              }
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
                            html: '<p>El nombre del recinto tiene un maximo de 120 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
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
                        html: '<p>El enlace tiene un maximo de 650 caracteres</p>',
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
            html: '<p>El titulo tiene un maximo de 150 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
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
			if ($("#txtNomLoc").val().length>0&&$("#txtNomLoc").val().length<120) {
			   /* informacion del contacto */
			  if ($("#txtFonoLoc").val().length>1||$("#txtCorLoc").val().length>1||$("#txtWebLoc").val().length>1) {
			    /* descripcion recinto */
			    if ($("#txtDescLoc").val().length<1950) {
			      /* capacidad del recinto */
			      if ($("#txtCapa").val()>-1&&$("#txtCapa").val()<99999&&numCheck.test($("#txtCapa").val())) {
			        /* estacionamientos del recinto */
			        if ($("#txtEsta").val()>-1&&$("#txtEsta").val()<99999&&numCheck.test($("#txtEsta").val())) {
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
			            if ($("#txtCorLoc").val().length>0&&$("#txtCorLoc").val().length<90) {
			              if (emailCheck.test($("#txtCorLoc").val())) {
			                console.log("ingreso numero de telefono");
			              }else{
			                Swal.fire({
			                  title: 'Error en TELEFONO',
			                  html: '<p>El telefono solo deben ser numeros con un minimo de 8 numeros.</p><p style="color:red;">Se debe omitir el codigo de area.</p>',
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
			            if ($("#txtWebLoc").val().length>0&&$("#txtWebLoc").val().length<60) {
			              let fixLink=$("#txtWebLoc").val().substr(0, 4);
			              if (fixLink=="http") {
			              	console.log("ingreso pagina web ok");
			              }else{
			              	$("#txtWebLoc").val("https://"+$("#txtWebLoc").val());
			              }
			            }else{
			              Swal.fire({
			                title: 'Error en PAGINA WEB',
			                html: '<p>La pagina web tiene una maximo de 60 caracteres.</p>',
			                type: 'error',
			                confirmButtonText: 'OK',
			                onAfterClose: () => {
			                  $("#txtWebLoc").focus();
			                }
			              });
			              return false;
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
			        }
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
			      }
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
			    html: '<p>El nombre del recinto tiene un maximo de 120 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
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
			$("#medio").find("#botoneraOrgaEve").addClass('d-none');
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
			$("#medio").find("#btnAgregaRecintoOrga").addClass('d-none');
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