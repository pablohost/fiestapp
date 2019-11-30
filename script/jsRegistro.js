$(function(){
      /*Limpiar Casillas*/

      function limpio(){
        $("#txtNombre").val("");
        $("#txtApelli").val("");
        $("#txtCorreo").val("");
        $("#txtClave").val("");
        $("#txtClave2").val("");
        $("#txtEdad").val("");
        $("#txtFono").val("");
        $("input[name='Genero']").prop("checked", false);
        $("#rdbNR").prop("checked", true);
      }

      /*Habilito - Deshabilito*/

      function permiso(){
        if ($("#swFiltro").is(":checked")) {
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
        }else{
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
        }
      }

      /*Filtro mayor de edad*/ 

      permiso();

      $("#swFiltro").click(function(event) {
        /* Act on the event */
        permiso();
      });

      /*Comprobar casillas*/ 

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
              if ($("#txtClave").val().length>0&&$("#txtClave").val().length<30) {
                /* repite clave */
                if ($("#txtClave2").val().length>0&&$("#txtClave2").val().length<30) {
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
                    html: '<p>La clave tiene un maximo de 30 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
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
                  html: '<p>La clave tiene un maximo de 30 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
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

});
