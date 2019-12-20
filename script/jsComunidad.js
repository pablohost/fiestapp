$(function(){
	var cuenta=2;
	//Cargamos la seccion perfil
	cargarSeccion(0);
	//******************************************************
	//******************************************************
  	//******************************************************
  	//******************************************************
  	//COMUNIDAD FIESTAPP
  	//******************************************************
  	//******************************************************
  	//******************************************************
  	//******************************************************
	$("#lkCom1").click(function() {
		//seccion perfil de organizador
		cargarSeccion(0);
	});

	$("#lkCom2").click(function() {
		//seccion eventos de organizador
		cargarSeccion(1);
		cuenta=2;
		let indice=$( "#idObjetivo" ).val();
		let nombre=$( "#noObjetivo" ).val();
		console.log(indice);
		console.log(nombre);
	    $.post('script/cargaGaleriaCom.php',
	    	{x: indice,z: nombre},
		    function(data, textStatus, xhr) {
	    	console.log(data);
		    console.log(textStatus);
		    console.log(xhr);
		    
		    if (data.cod==0) {
		    	//perfil propio con foto
		    	$( "#medio" ).empty();
				$( "#medio" ).html(data.msg);
		    	jQuery( "#medio" ).find("#gallery").unitegallery({
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
		    }else if (data.cod==2) {
		    	//perfil visita con foto
		    	$( "#medio" ).empty();
				$( "#medio" ).html(data.msg);
				jQuery("#gallery").unitegallery({
					gallery_theme: "tiles"
				});
				$( "#medio" ).find("#boxNuevaFoto").empty();
		    }else if (data.cod==4) {
		    	//perfil propio sin foto
		    	$( "#medio" ).empty();
				$( "#medio" ).html(data.msg);
		    }else if (data.cod==3) {
		    	//perfil visita sin foto
		    	$( "#medio" ).empty();
				$( "#medio" ).html(data.msg);
				$( "#medio" ).find("#boxNuevaFoto").empty();
		    }
	    	
	  	});
	});

	$("#lkCom3").click(function() {
		//seccion locales de organizador
		cargarSeccion(2);
	});

	$("#lkCom4").click(function() {
		//seccion promociones de organizador
		cargarSeccion(3);
	});
	//******************************************************
  	//******************************************************
  	//SECCION PERFIL - COMUNIDAD
  	//******************************************************
  	//******************************************************
  	//boton agregar amigo 
	$("#medio").on("click","#btnAgregaAmigo",function(e){
	    e.preventDefault();

	    let x=$(this).data("ind");

	    agregaAmigo(x);

	    Swal.fire({
	    	allowOutsideClick: false,
		  onBeforeOpen: () => {
		    Swal.showLoading()
		  },
		  onClose: () => {

		  }
		}).then((result) => {
		  
		})
  	});
  	//boton eliminar amigo 
	$("#medio").on("click","#btnEliminaAmigo",function(e){
	    e.preventDefault();

	    let x=$(this).data("ind");
	    let z=$(this).data("nom");

	    Swal.fire({
		  title: 'Estas seguro/a?',
		  html: "Estas a punto de <b>ELIMINAR</b> de tu lista de amigos<hr>"+z,
		  type: 'error',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar!',
		  cancelButtonText: 'Volver Atras',
		}).then((result) => {
		  if (result.value) {
		      setTimeout(function(){ borraAmigo(x); },2500)
		  	
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
  	//boton envia mensaje 
	$("#medio").on("click","#btnEnviaMensaje",function(e){
	    e.preventDefault();

	    let indice=$(this).data("ind");

	    Swal.fire({
	    	allowOutsideClick: false,
		  onBeforeOpen: () => {
		    Swal.showLoading()
		  },
		  onClose: () => {

		  }
		}).then((result) => {
		  
		})

	    /*
        var serie=$('#creaEventoOrga-form').serialize();
        var formData = new FormData(document.getElementById("creaEventoOrga-form"));
        console.log(serie);
        console.log(formData);
        */
        //comprobamos todos los inputs
		if ($("#txtNuevoMen").val().length>0&&$("#txtNuevoMen").val().length<680) {

	        /* en este punto todos los campos estan OK */
	        /* Validacion campo recaptcha */

	        let x=$('#enviaMensajeForm').serialize();
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
	              enviaMensaje(indice);
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
	        title: 'Error en MENSAJE',
	        html: '<p>El mensaje tiene un maximo de 700 caracteres.</p>',
	        type: 'error',
	        confirmButtonText: 'OK',
	        onAfterClose: () => {
	          $("#txtNuevoMen").focus();
	        }
	      });
	    }
  	});
  	//boton eliminar mensaje 
	$("#medio").on("click","#btnBorraMensaje",function(e){
	    e.preventDefault();

	    let x=$(this).data("ind");

	    Swal.fire({
		  title: 'Estas seguro/a?',
		  html: "Estas a punto de <b>ELIMINAR</b> para siempre este mensaje",
		  type: 'error',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar!',
		  cancelButtonText: 'Volver Atras',
		}).then((result) => {
		  if (result.value) {
		      setTimeout(function(){ borraMensaje(x); },2500)
		  	
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
  	//******************************************************
  	//******************************************************
  	//SECCION FOTOS - COMUNIDAD
  	//******************************************************
  	//******************************************************
  	$('#medio').on('change',"#flFotoPer1", function() {

		//FOTO 1 RECINTO
		comprobarArchivo(this,$('#flFotoPer1'),$(".fl1"));
	});
	$('#medio').on('change',"#flFotoPer2", function() {

		//FOTO 2 RECINTO
		comprobarArchivo(this,$('#flFotoPer2'),$(".fl2"));
	});
	$('#medio').on('change',"#flFotoPer3", function() {

		//FOTO 3 RECINTO
		comprobarArchivo(this,$('#flFotoPer3'),$(".fl3"));
	});
	$('#medio').on('change',"#flFotoPer4", function() {

		//FOTO 4 RECINTO
		comprobarArchivo(this,$('#flFotoPer4'),$(".fl4"));
	});
	$('#medio').on('change',"#flFotoPer5", function() {

		//FOTO 5 RECINTO
		comprobarArchivo(this,$('#flFotoPer5'),$(".fl5"));
	});
	$('#medio').on('change',"#flFotoPer6", function() {

		//FOTO 6 RECINTO
		comprobarArchivo(this,$('#flFotoPer6'),$(".fl6"));
	});
	$('#medio').on('change',"#flFotoPer7", function() {

		//FOTO 7 RECINTO
		comprobarArchivo(this,$('#flFotoPer7'),$(".fl7"));
	});
	$('#medio').on('change',"#flFotoPer8", function() {

		//FOTO 8 RECINTO
		comprobarArchivo(this,$('#flFotoPer8'),$(".fl8"));
	});
	$('#medio').on('change',"#flFotoPer9", function() {

		//FOTO 9 RECINTO
		comprobarArchivo(this,$('#flFotoPer9'),$(".fl9"));
	});
	$('#medio').on('change',"#flFotoPer10", function() {

		//FOTO 10 RECINTO
		comprobarArchivo(this,$('#flFotoPer10'),$(".fl10"));
	});
  	//Agregar otra foto al formulario
	$("#medio").on("click","#btnOtraFoto",function(e){
	    e.preventDefault();
	    let indiceFoto=0;
	    $("#fotosPerfil .custom-file").each(function(){
        	    indiceFoto=$(this).find("input").data("ind");
        	});
	    indiceFoto+=1;
	    if (indiceFoto>10) {
	    	$(this).addClass('disabled');
	    }else{
	    	$("#fotosPerfil").append('<div class="custom-file">'+
			    						'<input type="file" class="custom-file-input" id="flFotoPer'+indiceFoto+'" name="FotoPer'+indiceFoto+'" data-ind="'+indiceFoto+'">'+
		    							'<label class="custom-file-label fl'+cuenta+'" for="flFotoPer'+indiceFoto+'" data-browse="Elegir">Seleccionar Archivo</label><br><br>'+
									'</div>');
	    	cuenta+=1;
	    }
  	});
  	//boton confirma carga de fotos
	$("#medio").on("click","#btnConfirmaGalePer",function(e){
	    e.preventDefault();
	    Swal.fire({
	    	allowOutsideClick: false,
		  onBeforeOpen: () => {
		    Swal.showLoading()
		  },
		  onClose: () => {

		  }
		}).then((result) => {
		  
		})
	    if (($("#flFotoPer1").val()==""||$("#flFotoPer1").val()==undefined)&&($("#flFotoPer2").val()==""||$("#flFotoPer2").val()==undefined)&&($("#flFotoPer3").val()==""||$("#flFotoPer3").val()==undefined)&&($("#flFotoPer4").val()==""||$("#flFotoPer4").val()==undefined)&&($("#flFotoPer5").val()==""||$("#flFotoPer5").val()==undefined)&&($("#flFotoPer6").val()==""||$("#flFotoPer6").val()==undefined)&&($("#flFotoPer7").val()==""||$("#flFotoPer7").val()==undefined)&&($("#flFotoPer8").val()==""||$("#flFotoPer8").val()==undefined)&&($("#flFotoPer9").val()==""||$("#flFotoPer9").val()==undefined)&&($("#flFotoPer10").val()==""||$("#flFotoPer10").val()==undefined)) {
	    	Swal.fire({
			  title: 'ERROR',
			  html: '<p>Debes subir almenos una fotografia nueva</p>',
			  type: 'error',
			  confirmButtonText: 'OK',
			  onAfterClose: () => {
			    $("#flFotoPer1").focus();
			  }
			});
	    }else{
	    	/* Validacion campo recaptcha */

            let x=$('#agregaFotoPer-form').serialize();
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
                  agregaFotoPerfil();
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

  	//boton borrar foto recinto - organizador
  	$("#medio").on("click",".ug-icon-link",function(e){
	    e.preventDefault();
	    
	    let x=$(this).attr('href');
	    let z=$(this).prevAll("img").attr("src");
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
		      setTimeout(function(){ borraFotoPerfil(x,z); },2500)
		  	
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
	//******************************************************
  	//******************************************************
  	//SECCION AMIGOS - COMUNIDAD
  	//******************************************************
  	//******************************************************
  	//boton aceptar amigo
  	$("#medio").on("click","#btnAceptaAmigo",function(e){
	    e.preventDefault();
	    let indice=$(this).data("ind");
	    Swal.fire({
	    	allowOutsideClick: false,
		  onBeforeOpen: () => {
		    Swal.showLoading()
		  },
		  onClose: () => {

		  }
		}).then((result) => {
		  
		})
	    $.ajax({
		    type: "POST",
		    url: 'script/comprobarIdentidad.php',
		    data: {ind: indice,mod: 5},
		    success: function (data) {
		      	if (data.cod==0) {
		      		$.post('script/solicitudAmistad.php',
					    {modo: 1,ind: indice},
					    function(mensaje, textStatus, xhr) {
				    	console.log(mensaje);
				    	console.log(textStatus);
				    	console.log(xhr);
					    /*optional stuff to do after success */
					    if (mensaje.cod==0) {
			      			Swal.fire({
				                title: "Listo !",
				                text: mensaje.msg,
				                type: "success",
				                confirmButtonText: "OK",
				                onAfterClose: () => {
					              $("#lkCom3").click();
					            }
				            });
				      	}else{
				      		Swal.fire({
				                title: mensaje.msg,
				                text: "ERROR FATAL",
				                type: "error",
				                confirmButtonText: "OK",
				                onAfterClose: () => {
					              $("#lkCom3").click();
					            }
				            });
		      			}
					});
		      	}else{
		      		Swal.fire({
		                title: data.msg,
		                text: "ERROR FATAL",
		                type: "error",
		                confirmButtonText: "OK",
		                onAfterClose: () => {
			              $("#lkCom3").click();
			            }
		            });
		      	}
		    },
		    error: function (respuesta, textStatus, xhr) {
		    	console.log(respuesta);
				console.log(textStatus);
				console.log(xhr);
		    }
	    });
	});
	//boton rechaza amigo
  	$("#medio").on("click","#btnRechazaAmigo",function(e){
	    e.preventDefault();
	    let indice=$(this).data("ind");
	    Swal.fire({
		  title: 'Estas seguro/a?',
		  html: "Estas a punto de <b>ELIMINAR</b> esta solicitud de amistad",
		  type: 'error',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar!',
		  cancelButtonText: 'Volver Atras',
		}).then((result) => {
		  if (result.value) {
		  	Swal.fire({
		    	allowOutsideClick: false,
			  onBeforeOpen: () => {
			    Swal.showLoading()
			  },
			  onClose: () => {

			  }
			}).then((result) => {
			  
			})
			$.post('script/solicitudAmistad.php',
				{modo: 2,ind: indice},
				function(mensaje, textStatus, xhr) {
				console.log(mensaje);
				console.log(textStatus);
				console.log(xhr);
				/*optional stuff to do after success */
				if (mensaje.cod==0) {
					Swal.fire({
				        title: "Listo !",
				        text: mensaje.msg,
				        type: "success",
				        confirmButtonText: "OK",
				        onAfterClose: () => {
				          $("#lkCom3").click();
				        }
				    });
				}else{
					Swal.fire({
				        title: mensaje.msg,
				        text: "ERROR FATAL",
				        type: "error",
				        confirmButtonText: "OK",
				        onAfterClose: () => {
				          $("#lkCom3").click();
				        }
				    });
				}
			});
		  }
		})
	});
  	//***************boton BUSQUEDA******************
  	$("#medio").on("submit",".boxBuscar",function(e){
	    e.preventDefault();

	    let x=$('#txtBuscarCom').val();
		if (x.length!=0) {
		  $('#btnBuscarCom').click();
		} else {
		  Swal.fire({ title: "Error!", text: "Indicanos qué buscas", type: "error", confirmButtonText: "OK" });
		}
  	});
  	$("#medio").on("click","#btnBuscarCom",function(e){
	    e.preventDefault();

	    let x=$('#txtBuscarCom').val();
		if (x.length!=0) {
		  loading();
		  buscarPersonas(x);
		} else {
		  Swal.fire({ title: "Error!", text: "Indicanos qué buscas", type: "error", confirmButtonText: "OK" });
		}
  	});

  	//revisa la estension de las fotos cargadas, una por una
  	$('#medio').on('change',"#flFotoEve", function() {

		//FOTO FLAYER
		console.log(this);
		console.log($('#flFotoEve'));
		comprobarArchivo(this,$('#flFotoEve'),$(".fl0"));
	});

  	//******************************************************
  	//******************************************************
  	//SECCION EVENTOS - COMUNIDAD
  	//******************************************************
  	//******************************************************
  	//boton aceptar invitacion
  	$("#medio").on("click","#btnAceptaInvi",function(e){
	    e.preventDefault();
	    let indice=$(this).data("ind");
	    let evento=$(this).data("eve");
	    Swal.fire({
	    	allowOutsideClick: false,
		  onBeforeOpen: () => {
		    Swal.showLoading()
		  },
		  onClose: () => {

		  }
		}).then((result) => {
		  
		})
	    $.ajax({
		    type: "POST",
		    url: 'script/comprobarIdentidad.php',
		    data: {ind: indice,mod: 8,eve: evento},
		    success: function (data) {
		      	if (data.cod==0) {
		      		$.post('script/invitacionEvento.php',
					    {modo: 1,ind: indice,eve: evento},
					    function(mensaje, textStatus, xhr) {
				    	console.log(mensaje);
				    	console.log(textStatus);
				    	console.log(xhr);
					    /*optional stuff to do after success */
					    if (mensaje.cod==0) {
			      			Swal.fire({
				                title: "Listo !",
				                text: mensaje.msg,
				                type: "success",
				                confirmButtonText: "OK",
				                onAfterClose: () => {
					              $("#lkCom4").click();
					            }
				            });
				      	}else{
				      		Swal.fire({
				                title: mensaje.msg,
				                text: "ERROR FATAL",
				                type: "error",
				                confirmButtonText: "OK",
				                onAfterClose: () => {
					              $("#lkCom4").click();
					            }
				            });
		      			}
					});
		      	}else{
		      		Swal.fire({
		                title: data.msg,
		                text: "ERROR FATAL",
		                type: "error",
		                confirmButtonText: "OK",
		                onAfterClose: () => {
			              $("#lkCom4").click();
			            }
		            });
		      	}
		    },
		    error: function (respuesta, textStatus, xhr) {
		    	console.log(respuesta);
				console.log(textStatus);
				console.log(xhr);
		    }
	    });
	});
	//boton rechaza invitacion
  	$("#medio").on("click","#btnRechazaInvi",function(e){
	    e.preventDefault();
	    let indice=$(this).data("ind");
	    Swal.fire({
		  title: 'Estas seguro/a?',
		  html: "Estas a punto de <b>ELIMINAR</b> esta invitacion para siempre",
		  type: 'error',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar!',
		  cancelButtonText: 'Volver Atras',
		}).then((result) => {
		  if (result.value) {
		  	Swal.fire({
		    	allowOutsideClick: false,
			  onBeforeOpen: () => {
			    Swal.showLoading()
			  },
			  onClose: () => {

			  }
			}).then((result) => {
			  
			})
			$.post('script/invitacionEvento.php',
				{modo: 2,ind: indice},
				function(mensaje, textStatus, xhr) {
				console.log(mensaje);
				console.log(textStatus);
				console.log(xhr);
				/*optional stuff to do after success */
				if (mensaje.cod==0) {
					Swal.fire({
				        title: "Listo !",
				        text: mensaje.msg,
				        type: "success",
				        confirmButtonText: "OK",
				        onAfterClose: () => {
				          $("#lkCom4").click();
				        }
				    });
				}else{
					Swal.fire({
				        title: mensaje.msg,
				        text: "ERROR FATAL",
				        type: "error",
				        confirmButtonText: "OK",
				        onAfterClose: () => {
				          $("#lkCom4").click();
				        }
				    });
				}
			});
		  }
		})
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
	}else if (opcion==2) {
		loading();
		cargaAmigosCom();
	}else if (opcion==3) {
		loading();
		cargaEventosCom();
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
	    console.log(data);
    	console.log(textStatus);
    	console.log(xhr);
	    $( "#medio" ).empty();
	    $( "#medio" ).html(data.msg);
	    //colocamos de titulo el nombre del perfil que se esta viosualizando
		document.title = $("#medio").find("#nombrePerfil").html()+" - FIESTAPP";
		listaMensajes(indicePerfil);
	});
}

function cargaAmigosCom(){
	let indicePerfil=$( "#idObjetivo" ).val();
	let nombrePerfil=$( "#noObjetivo" ).val();
	let tipoPerfil=$( "#tiObjetivo" ).val();
	console.log(indicePerfil);
	console.log(nombrePerfil);
	console.log(tipoPerfil);
	$.post('script/cargaAmigosCom.php',
	    {x: indicePerfil,y: nombrePerfil,z: tipoPerfil},
	    function(data, textStatus, xhr) {
    	console.log(data);
    	console.log(textStatus);
    	console.log(xhr);
	    /*optional stuff to do after success */
	    $( "#medio" ).empty();
	    $( "#medio" ).html(data.msg);
	    //colocamos de titulo el nombre del perfil que se esta viosualizando
		document.title = nombrePerfil+" - FIESTAPP";
		//bloqueamos funciones a visitantes
		if (data.cod==2) {
			$("#medio").find("#botoneraAmigosCom").empty();
		}

		//cargamos solicitudes de amistad
		$( "#boxSolicitudes" ).html("<div class='spinner-grow text-warning' style='width: 12rem; height: 10rem;' role='status'><span class='sr-only'>Cargando...</span></div>");
		$.post('script/solicitudAmistad.php',
		    {modo: 0},
		    function(data, textStatus, xhr) {
	    	console.log(data);
	    	console.log(textStatus);
	    	console.log(xhr);
		    /*optional stuff to do after success */
		    $( "#boxSolicitudes" ).empty();
		    $( "#boxSolicitudes" ).html(data.msg);
		});

	});
}

function cargaEventosCom(){
	let indicePerfil=$( "#idObjetivo" ).val();
	let nombrePerfil=$( "#noObjetivo" ).val();
	let tipoPerfil=$( "#tiObjetivo" ).val();
	console.log(indicePerfil);
	console.log(nombrePerfil);
	console.log(tipoPerfil);
	$.post('script/cargaEventosCom.php',
	    {x: indicePerfil,y: nombrePerfil,z: tipoPerfil},
	    function(data, textStatus, xhr) {
    	console.log(data);
    	console.log(textStatus);
    	console.log(xhr);
	    /*optional stuff to do after success */
	    $( "#medio" ).empty();
	    $( "#medio" ).html(data.msg);
	    //colocamos de titulo el nombre del perfil que se esta viosualizando
		document.title = nombrePerfil+" - FIESTAPP";
		//bloqueamos funciones a visitantes
		if (data.cod==2) {
			$("#medio").find("#botoneraEventosCom").empty();
		}

		//cargamos invitaciones a evento
		
		$( "#boxInvitaciones" ).html("<div class='spinner-grow text-warning' style='width: 12rem; height: 10rem;' role='status'><span class='sr-only'>Cargando...</span></div>");
		$.post('script/invitacionEvento.php',
		    {modo: 0},
		    function(data, textStatus, xhr) {
	    	console.log(data);
	    	console.log(textStatus);
	    	console.log(xhr);
		    $( "#boxInvitaciones" ).empty();
		    $( "#boxInvitaciones" ).html(data.msg);
		});
		

	});
}

function hackScript(textoCrudo) {
	// body...
	let textoCocido = textoCrudo.replace(new RegExp("<script>","gi"), "hack");
	textoCocido = textoCocido.replace(new RegExp("</script>","gi"), "hack");
	return textoCocido;
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

function buscarPersonas(palabra) {
	console.log(palabra);
  //console.log(palabra);
  $.post('script/consultaPersonas.php',
    {x: palabra},
    function(data, textStatus, xhr) {
    /*optional stuff to do after success */
    console.log(data);
	console.log(textStatus);
	console.log(xhr);
    $( "#medio" ).empty();
    $( "#medio" ).html(data.msg);
  });
}

function borraAmigo(indice) {
	// body...
	$.ajax({
	    type: "POST",
	    url: 'script/comprobarIdentidad.php',
	    data: {ind: indice,mod: 4},
	    success: function (data) {
	      	if (data.cod==0) {
	      		$.get( "script/borraAmigo.php?indice="+indice, function( respuesta, textStatus, xhr ) {
	      			console.log(respuesta);
					console.log(textStatus);
					console.log(xhr);
				  if (respuesta.cod === 0) {
			            Swal.fire({
			                title: "Listo!",
			                text: respuesta.msg,
			                type: "success",
			                confirmButtonText: "Ok"
			            });
			            $("#lkCom1").click();
			        } else {
			            Swal.fire({
			                title: "Error",
			                text: respuesta.msg,
			                type: "warning",
			                confirmButtonText: "Ok"
			            });
			        }
				}, "json");
	      	}else if (data.cod==1){
	      		Swal.fire({
	                title: data.msg,
	                text: "ERROR FATAL",
	                type: "error",
	                confirmButtonText: "OK",
	                onAfterClose: () => {
		              $("#lkCom1").click();
		            }
	            });
	      	}else if (data.cod==2){
	      		Swal.fire({
	                title: "ERROR",
	                text: "ERROR DE SEGURIDAD",
	                type: "error",
	                confirmButtonText: "OK",
	                onAfterClose: () => {
		              $("#lkCom1").click();
		            }
	            });
	      	}
	    },
	    error: function (respuesta, textStatus, xhr) {
	    	console.log(respuesta);
			console.log(textStatus);
			console.log(xhr);
	    }
    });
}

function agregaAmigo(indice) {
	// body...
	$.ajax({
	    type: "POST",
	    url: 'script/comprobarIdentidad.php',
	    data: {ind: indice,mod: 5},
	    success: function (data) {
	      	if (data.cod==0) {
	      		$.get( "script/agregaAmigo.php?indice="+indice, function( respuesta, textStatus, xhr ) {
	      			console.log(respuesta);
					console.log(textStatus);
					console.log(xhr);
				  	if (respuesta.cod === 0) {
			            Swal.fire({
			                title: "Listo!",
			                text: respuesta.msg,
			                type: "success",
			                confirmButtonText: "Ok"
			            });
			            $("#lkCom1").click();
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
	                title: "ERROR",
	                text: "ERROR FATAL",
	                type: "error",
	                confirmButtonText: "OK",
	                onAfterClose: () => {
		              $("#lkCom1").click();
		            }
	            });
	      	}
	    },
	    error: function (respuesta, textStatus, xhr) {
	    	console.log(respuesta);
			console.log(textStatus);
			console.log(xhr);
	    }
    });
}

function agregaFotoPerfil() {
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
    //recuperamos todos los datos ingresados por el usuario
    //creamos el formData con todos los datos necesarios para ser enviado
    var formData = new FormData(document.getElementById("agregaFotoPer-form"));
    
    $.ajax({
      type: "POST",
      url: 'script/agregaFotoPerfil.php',
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
            html: '<p>La galeria de tu perfil se actualizo!</p>',
            type: 'success',
            confirmButtonText: 'OK',
            onAfterClose: () => {
              $("#lkCom2").click();
            }
          });
        }else if(z.cod==1){
          Swal.fire({
            title: 'Error',
            html: respuesta.msg,
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

function borraFotoPerfil(indice, ruta) {
	// body...
	$.ajax({
	    type: "POST",
	    url: 'script/comprobarIdentidad.php',
	    data: {ind: indice,mod: 6},
	    success: function (data) {
	      	if (data.cod==0) {
	      		$.get( "script/borraFotoPerfil.php?indice="+indice+"&ruta="+ruta, function( respuesta ) {
				  if (respuesta.cod === 0) {
			            Swal.fire({
			                title: "Listo!",
			                html: respuesta.msg,
			                type: "success",
			                confirmButtonText: "Ok"
			            });
			            $("#lkCom2").click();
			        } else {
			            Swal.fire({
			                title: "Error",
			                html: respuesta.msg,
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
		              $("#lkCom2").click();
		            }
	            });
	      	}
	    },
	    error: function () {
	    }
    });
}
function listaMensajes(indice) {
	// body...
	$.ajax({
	    type: "POST",
	    url: 'script/comprobarIdentidad.php',
	    data: {ind: indice,mod: 4},
	    success: function (data) {
	    	console.log(data);
	      	if (data.cod==0) {
	      		$( "#listaMensajes" ).html("<div class='spinner-grow text-warning' style='width: 12rem; height: 10rem;' role='status'><span class='sr-only'>Cargando...</span></div>");
				$.post('script/listaMensajes.php',
				    {x: indice},
				    function(data, textStatus, xhr) {
			    	console.log(data);
			    	console.log(textStatus);
			    	console.log(xhr);
				    /*optional stuff to do after success */
				    $( "#listaMensajes" ).empty();
				    $( "#listaMensajes" ).html(data.msg);
				    $("#listaMensajes .boxMensaje").each(function(){
		              	$(this).find(".botonMensaje").empty();
		          	});
				});
	      	}else if (data.cod==2){
	      		$( "#listaMensajes" ).html("<div class='spinner-grow text-warning' style='width: 12rem; height: 10rem;' role='status'><span class='sr-only'>Cargando...</span></div>");
				$.post('script/listaMensajes.php',
				    {x: indice},
				    function(data, textStatus, xhr) {
			    	console.log(data);
			    	console.log(textStatus);
			    	console.log(xhr);
				    /*optional stuff to do after success */
				    $( "#listaMensajes" ).empty();
				    $( "#listaMensajes" ).html(data.msg);
				    $( "#boxEnviarMensaje" ).empty();
				});
	      	}else if (data.cod==1){
	      		$( "#listaMensajes" ).html("<div class='col-12 text-center'>No son amigos</div>");
	      	}
	    },
	    error: function () {
	    }
    });
}

function enviaMensaje(indice) {
	// body...
	//recuperamos todos los datos ingresados por el usuario
    let desMen = $("#txtNuevoMen").val();
    let desMenBR = desMen.replace(new RegExp("\n","g"), "<br>");
    desMenBR = hackScript(desMenBR);

    let formMensaje=$('#enviaMensajeForm').serialize()+"&desMenBR="+desMenBR+"&indice="+indice;
    console.log(formMensaje);

    $.ajax({
      type: "POST",
      url: 'script/enviaMensaje.php',
      data: formMensaje,
      success: function (data, textStatus, xhr) {
      	console.log(data);
		console.log(textStatus);
		console.log(xhr);
        if (data.cod==0) {
	        Swal.fire({
	            title: "Listo!",
	            html: data.msg,
	            type: "success",
	            confirmButtonText: "Ok"
	        });
	        $("#lkCom1").click();

        } else {
          	Swal.fire({
                title: "Error",
                html: data.msg,
                type: "warning",
                confirmButtonText: "Ok"
            });
        }
      },
      error: function () {
        //ha habido un error desconocido
        Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
        return false;
      }
    });
}

function borraMensaje(indice) {
	// body...
	$.ajax({
	    type: "POST",
	    url: 'script/comprobarIdentidad.php',
	    data: {ind: indice,mod: 7},
	    success: function (data) {
	      	if (data.cod==0) {
	      		$.get( "script/borraMensaje.php?indice="+indice, function( respuesta ) {
				  if (respuesta.cod === 0) {
			            Swal.fire({
			                title: "Listo!",
			                html: respuesta.msg,
			                type: "success",
			                confirmButtonText: "Ok"
			            });
			            $("#lkCom1").click();
			        } else {
			            Swal.fire({
			                title: "Error",
			                html: respuesta.msg,
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
		              $("#lkCom1").click();
		            }
	            });
	      	}
	    },
	    error: function () {
	    }
    });
}