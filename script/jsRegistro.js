$(function(){

      /*Limpiar Casillas*/

      function limpio(){
        //formulario registro usuarios
        $("#txtNombre").val("");
        $("#txtApelli").val("");
        $("#txtCorreo").val("");
        $("#txtClave").val("");
        $("#txtClave2").val("");
        $("#txtEdad").val("");
        $("#txtFono").val("");
        $("input[name='Genero']").prop("checked", false);
        $("#rdbNR").prop("checked", true);
        //formulario registro eventos
        $("#txtTituloEve").val("");
        $("#txtDescEve").val("");
        $("#flFotoEve").val("");
        $("#sw1").prop("checked", false);
        $("#sw2").prop("checked", false);
        $("#sw3").prop("checked", false);
        $("#sw4").prop("checked", false);
        $("#sw5").prop("checked", false);
        $("#sw6").prop("checked", false);
        $("#dtInicio").val("");
        $("#cbxInicio").val("00:00");
        $("#dtFin").val("");
        $("#cbxFin").val("00:00");
        $("#txtBoleEve").val("");
        //$("#txtLon").prop("disabled", false);
        //$("#txtLat").prop("disabled", false);
        $("#txtNomLoc").val("");
        $("#txtFonoLoc").val("");
        $("#txtCorLoc").val("");
        $("#txtWebLoc").val("");
      }

      /*Habilito - Deshabilito*/

      function permiso(){
        if ($("#swFiltro").is(":checked")) {
          //formulario registro usuarios
          $("#txtNombre").prop("disabled", false);
          $("#txtApelli").prop("disabled", false);
          $("#txtCorreo").prop("disabled", false);
          $("#txtClave").prop("disabled", false);
          $("#txtClave2").prop("disabled", false);
          $("#txtEdad").prop("disabled", false);
          $("#txtFono").prop("disabled", false);
          $("input[name='Genero']").prop("disabled", false);
          $("#swTipoU").prop("disabled", false);
          $("#btnRegistro").prop("disabled", false);
          //formulario registro eventos
          $("#txtTituloEve").prop("disabled", false);
          $("#txtDescEve").prop("disabled", false);
          $("#flFotoEve").prop("disabled", false);
          $("#sw1").prop("disabled", false);
          $("#sw2").prop("disabled", false);
          $("#sw3").prop("disabled", false);
          $("#sw4").prop("disabled", false);
          $("#sw5").prop("disabled", false);
          $("#sw6").prop("disabled", false);
          $("#dtInicio").prop("disabled", false);
          $("#cbxInicio").prop("disabled", false);
          $("#dtFin").prop("disabled", false);
          $("#cbxFin").prop("disabled", false);
          $("#txtBoleEve").prop("disabled", false);
          $("#txtLon").prop("disabled", false);
          $("#txtLat").prop("disabled", false);
          $("#txtNomLoc").prop("disabled", false);
          $("#txtFonoLoc").prop("disabled", false);
          $("#txtCorLoc").prop("disabled", false);
          $("#txtWebLoc").prop("disabled", false);
          $("#btnRegistroEve").prop("disabled", false);
        }else{
          //formulario registro usuarios
          $("#txtNombre").prop("disabled", true);
          $("#txtApelli").prop("disabled", true);
          $("#txtCorreo").prop("disabled", true);
          $("#txtClave").prop("disabled", true);
          $("#txtClave2").prop("disabled", true);
          $("#txtEdad").prop("disabled", true);
          $("#txtFono").prop("disabled", true);
          $("input[name='Genero']").prop("disabled", true);
          $("#swTipoU").prop("disabled", true);
          $("#btnRegistro").prop("disabled", true);
          //formulario registro eventos
          $("#txtTituloEve").prop("disabled", true);
          $("#txtDescEve").prop("disabled", true);
          $("#flFotoEve").prop("disabled", true);
          $("#sw1").prop("disabled", true);
          $("#sw2").prop("disabled", true);
          $("#sw3").prop("disabled", true);
          $("#sw4").prop("disabled", true);
          $("#sw5").prop("disabled", true);
          $("#sw6").prop("disabled", true);
          $("#dtInicio").prop("disabled", true);
          $("#cbxInicio").prop("disabled", true);
          $("#dtFin").prop("disabled", true);
          $("#cbxFin").prop("disabled", true);
          $("#txtBoleEve").prop("disabled", true);
          $("#txtLon").prop("disabled", true);
          $("#txtLat").prop("disabled", true);
          $("#txtNomLoc").prop("disabled", true);
          $("#txtFonoLoc").prop("disabled", true);
          $("#txtCorLoc").prop("disabled", true);
          $("#txtWebLoc").prop("disabled", true);
          $("#btnRegistroEve").prop("disabled", true);
        }
      }

      //binds to onchange event of your input field
      $('#flFotoEve').bind('change', function() {

        //this.files[0].size gets the size of your file.
        console.log(this);
        console.log(this.files[0]);
        console.log(this.files[0].size);
        if ($('#flFotoEve').val()!="") {
          if (this.files[0].type=="image/jpg"||this.files[0].type=="image/jpeg"||this.files[0].type=="image/png") {
            $(".custom-file-label").html("<span style='color:green;'>Archivo Cargado Correctamente <i class='fas fa-check'></i></span>");
          } else {
            $(".custom-file-label").html("<span style='color:red;'>Solo se permiten imagenes en formato JPG, JPEG y PNG <i class='fas fa-times'></i></span>");
            $('#flFotoEve').val("");
          }
          
        } else {
          $(".custom-file-label").html("Seleccionar Archivo");
        }
        

      });

      /*Filtro mayor de edad*/ 

      permiso();

      $("#swFiltro").click(function(event) {
        /* Act on the event */
        permiso();
      });

      /*Comprobar casillas FORMULARIO REGISTRO DE USUARIOS*/ 

      $("#btnRegistro").click(function(event) {
        /* Act on the event */
        event.preventDefault();

        Swal.fire({
          title: '',
          text: '',
          type: "success",
          showConfirmButton: false,
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          }
        }).then((result) => {
          
        });

        let emailCheck = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        let textoCheck = /^[a-z A-Z]+$/;
        let numCheck = /^[0-9]+$/;

        /* nombre */
        if ($("#txtNombre").val().length>0&&$("#txtNombre").val().length<120&&textoCheck.test($("#txtNombre").val())) {
          /* apellido */
          if ($("#txtApelli").val().length>0&&$("#txtApelli").val().length<120&&textoCheck.test($("#txtApelli").val())) {
            /* correo electronico */
            if ($("#txtCorreo").val().length>0&&$("#txtCorreo").val().length<120&&emailCheck.test($("#txtCorreo").val())) {
              /* clave */
              if ($("#txtClave").val().length>5&&$("#txtClave").val().length<30) {
                /* repite clave */
                if ($("#txtClave2").val().length>5&&$("#txtClave2").val().length<30) {
                  /* compara las claves*/
                  if ($("#txtClave").val()===$("#txtClave2").val()) {
                    console.log("campos obligatorios OK");

                    /* genero */
                    /*
                    if ($("#rdbNR").prop("checked")||$("#rdbNB").prop("checked")||$("#rdbFE").prop("checked")||$("#rdbMA").prop("checked")) {
                      console.log("ingreso genero");
                    }
                    */
                    /* edad */
                    if ($("#txtEdad").val().length>0) {
                      if ($("#txtEdad").val()>=18&&$("#txtEdad").val()<=99&&numCheck.test($("#txtEdad").val())) {
                        console.log("ingreso edad");
                      }else{
                        Swal.fire({
                          title: 'Error en EDAD',
                          html: '<p>La edad solo puede ser numerica.</p><p style="color:red;">Solo se admiten edades entre 18 y 99 años.</p>',
                          type: 'error',
                          confirmButtonText: 'OK',
                          onAfterClose: () => {
                            $("#txtEdad").focus();
                          }
                        });
                        return false;
                      }
                    }
                    /* numero de telefono */
                    if ($("#txtFono").val().length>0) {
                      if ($("#txtFono").val().length==8&&numCheck.test($("#txtFono").val())) {
                        console.log("ingreso numero de telefono");
                      }else{
                        Swal.fire({
                          title: 'Error en TELEFONO',
                          html: '<p>El telefono solo deben ser numeros con un minimo de 8 numeros.</p><p style="color:red;">Se debe omitir el codigo de area.</p>',
                          type: 'error',
                          confirmButtonText: 'OK',
                          onAfterClose: () => {
                            $("#txtFono").focus();
                          }
                        });
                        return false;
                      }
                    }

                    /* en este punto todos los campos estan OK */
                    /* Validacion campo recaptcha */
                    let x=$('[name=formRegistro]').serialize();
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
                          todoOK();

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
                    /* las claves son distintas */
                    Swal.fire({
                      title: 'Error en CLAVE',
                      html: '<p>Las claves <span style="color:red;">NO</span> coinciden</p>',
                      type: 'error',
                      confirmButtonText: 'OK',
                      onAfterClose: () => {
                        $("#txtClave").focus();
                      }
                    });
                  }
                }else{
                  /* error - clave 2 */
                  Swal.fire({
                    title: 'Error en REPETIR CLAVE',
                    html: '<p>La clave tiene un maximo de 30 caracteres y un minimo de 6.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                    type: 'error',
                    confirmButtonText: 'OK',
                    onAfterClose: () => {
                      $("#txtClave2").focus();
                    }
                  });
                }
              }else{
                /* error - clave */
                Swal.fire({
                  title: 'Error en CLAVE',
                  html: '<p>La clave tiene un maximo de 30 caracteres y un minimo de 6.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                  type: 'error',
                  confirmButtonText: 'OK',
                  onAfterClose: () => {
                    $("#txtClave").focus();
                  }
                });
              }
            }else{
              /* error - correo electronico */
              Swal.fire({
                title: 'Error en CORREO ELECTRONICO',
                html: '<p>Ingresa un correo electronico valido.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                type: 'error',
                confirmButtonText: 'OK',
                onAfterClose: () => {
                  $("#txtCorreo").focus();
                }
              });
            }
          }else{
            /* error - apellido */
            Swal.fire({
              title: 'Error en APELLIDO',
              html: '<p>Solo debes usar letras y con un maximo de 120 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
              type: 'error',
              confirmButtonText: 'OK',
              onAfterClose: () => {
                $("#txtApelli").focus();
              }
            });
          }
        }else{
          /* error - nombre */
          Swal.fire({
            title: 'Error en NOMBRE',
            html: '<p>Solo debes usar letras y con un maximo de 120 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
            type: 'error',
            confirmButtonText: 'OK',
            onAfterClose: () => {
              $("#txtNombre").focus();
            }
          });

        }

      });
      
      //comprobar casillas FORMULARIO REGISTRO DE EVENTOS
      $("#btnRegistroEve").click(function(event) {
        /* Act on the event */
        event.preventDefault();

        Swal.fire({
          title: '',
          text: '',
          type: "success",
          showConfirmButton: false,
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          }
        }).then((result) => {
          
        });

        let emailCheck = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        let textoCheck = /^[a-z A-Z]+$/;
        let numCheck = /^[0-9]+$/;

        //DATOS DEL EVENTO
         /* titulo evento */
        if ($("#txtTituloEve").val().length>0&&$("#txtTituloEve").val().length<150) {
           /* descripcion evento */
          if ($("#txtDescEve").val().length<1950) {
             /* foto o flyer del evento */
            if ($("#flFotoEve").val()!="") {
              console.log($("#flFotoEve").val());
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
                            //DATOS PARA LA CUENTA
                            /* nombre */
                            if ($("#txtNombre").val().length>0&&$("#txtNombre").val().length<120&&textoCheck.test($("#txtNombre").val())) {
                              /* apellido */
                              if ($("#txtApelli").val().length>0&&$("#txtApelli").val().length<120&&textoCheck.test($("#txtApelli").val())) {
                                /* correo electronico */
                                if ($("#txtCorreo").val().length>0&&$("#txtCorreo").val().length<120&&emailCheck.test($("#txtCorreo").val())) {
                                  /* clave */
                                  if ($("#txtClave").val().length>5&&$("#txtClave").val().length<30) {
                                    /* repite clave */
                                    if ($("#txtClave2").val().length>5&&$("#txtClave2").val().length<30) {
                                      /* compara las claves*/
                                      if ($("#txtClave").val()===$("#txtClave2").val()) {
                                        

                                        
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
                                        if ($("#txtCorLoc").val().length>0) {
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

                                        $("#txtDescEve").val().replace(new RegExp("\n","g"), "<br>");

                                        /* en este punto todos los campos estan OK */
                                        /* Validacion campo recaptcha */

                                        let x=$('[name=formCreaEvento]').serialize();
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
                                              eventoOK();
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
                                        /* las claves son distintas */
                                        Swal.fire({
                                          title: 'Error en CLAVE',
                                          html: '<p>Las claves <span style="color:red;">NO</span> coinciden</p>',
                                          type: 'error',
                                          confirmButtonText: 'OK',
                                          onAfterClose: () => {
                                            $("#txtClave").focus();
                                          }
                                        });
                                      }
                                    }else{
                                      /* error - clave 2 */
                                      Swal.fire({
                                        title: 'Error en REPETIR CLAVE',
                                        html: '<p>La clave tiene un maximo de 30 caracteres y un minimo de 6.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                                        type: 'error',
                                        confirmButtonText: 'OK',
                                        onAfterClose: () => {
                                          $("#txtClave2").focus();
                                        }
                                      });
                                    }
                                  }else{
                                    /* error - clave */
                                    Swal.fire({
                                      title: 'Error en CLAVE',
                                      html: '<p>La clave tiene un maximo de 30 caracteres y un minimo de 6.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                                      type: 'error',
                                      confirmButtonText: 'OK',
                                      onAfterClose: () => {
                                        $("#txtClave").focus();
                                      }
                                    });
                                  }
                                }else{
                                  /* error - correo electronico */
                                  Swal.fire({
                                    title: 'Error en CORREO ELECTRONICO',
                                    html: '<p>Ingresa un correo electronico valido.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                                    type: 'error',
                                    confirmButtonText: 'OK',
                                    onAfterClose: () => {
                                      $("#txtCorreo").focus();
                                    }
                                  });
                                }
                              }else{
                                /* error - apellido */
                                Swal.fire({
                                  title: 'Error en APELLIDO',
                                  html: '<p>Solo debes usar letras y con un maximo de 120 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                                  type: 'error',
                                  confirmButtonText: 'OK',
                                  onAfterClose: () => {
                                    $("#txtApelli").focus();
                                  }
                                });
                              }
                            }else{
                              /* error - nombre */
                              Swal.fire({
                                title: 'Error en NOMBRE',
                                html: '<p>Solo debes usar letras y con un maximo de 120 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
                                type: 'error',
                                confirmButtonText: 'OK',
                                onAfterClose: () => {
                                  $("#txtNombre").focus();
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

      

      /* validacion de campos superada */

      function todoOK(){
        Swal.fire({
          title: 'Creando Perfil...',
          text: 'Bienvenide '+$("#txtNombre").val()+' '+$("#txtApelli").val(),
          type: "success",
          showConfirmButton: false,
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          }
        }).then((result) => {
          
        });

        //recuperamos todos los datos ingresados por el usuario

        if($("#txtEdad").val().length==0) {
          $("#txtEdad").val('0');
        }

        if($("#txtFono").val().length==0) {
          $("#txtFono").val('0');
        }

        let zzz="&TipoU=";
        if($("#swTipoU").is(":checked")) {
          zzz+="2";
        }else{
          zzz+="1";
        }

        let x=$('[name=formRegistro]').serialize()+zzz;
        console.log(x);
        
        $.ajax({
          type: "POST",
          url: 'script/regSocial.php',
          data: x,
          success: function (respuesta) {
            console.log(respuesta);
            let z=respuesta;
            if (z.cod==0) {
              Swal.fire({
                title: respuesta.msg,
                html: '<p>Te enviamos un correo de bienvenida, disfruta de FIESTAPP !</p>',
                type: 'success',
                confirmButtonText: 'OK',
                onAfterClose: () => {
                  window.location.href="comunidad.php";
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
                title: respuesta.msg,
                html: '<p>Este correo electronico ya posee una cuenta activa en nuestra comunidad, prueba con otro!</p>',
                type: 'error',
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
            limpio();
            Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
          }
        });
      }

      function eventoOK(){
        Swal.fire({
          title: 'Creando Evento...',
          text: 'Bienvenide '+$("#txtNombre").val()+' '+$("#txtApelli").val(),
          type: "success",
          showConfirmButton: false,
          allowOutsideClick: false,
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
        console.log(desEveBR);


        //let x=$('[name=formCreaEvento]').serialize()+cates;
        //console.log(x);

        var formData = new FormData(document.getElementById("creaEvento-form"));
        formData.append('Categorias', cates);
        formData.append('descEventoBR', desEveBR)
        console.log(formData);
        
        $.ajax({
          type: "POST",
          url: 'script/regEveUsu.php',
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
                html: '<p>Te enviamos un correo de bienvenida, disfruta de FIESTAPP !</p>',
                type: 'success',
                confirmButtonText: 'OK',
                onAfterClose: () => {
                  window.location.href="comunidad.php";
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
                title: respuesta.msg,
                html: '<p>Este correo electronico ya posee una cuenta activa en nuestra comunidad, prueba con otro!</p>',
                type: 'error',
                confirmButtonText: 'OK',
                onAfterClose: () => {
                  $("#txtCorreo").focus();
                }
              });
            }else if(z.cod==3){
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
            limpio();
            Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
          }
        });
      }

});
