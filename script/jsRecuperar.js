$(function(){

      /*Limpiar Casillas*/

      function limpio(){
        $("#txtCorreo").val("");
      }

      /*Comprobar casillas*/ 

      $("#btnRecu").click(function(event) {
        /* Act on the event */
        event.preventDefault();

        let emailCheck = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

        /* correo electronico */
        if ($("#txtCorreo").val().length>0&&$("#txtCorreo").val().length<120&&emailCheck.test($("#txtCorreo").val())) {
          
          /* en este punto se ingresaron los campos correctamente */

          /* Validacion campo recaptcha */
          let x=$('[name=formRecu]').serialize();
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
                todoOK(1);

              } else if(z.cod==1){
                //console.log(z.msg);
                //si eres robot
                Swal.fire({ title: z.msg, text: "No olvide completar el campo ReCaptcha", type: "info", confirmButtonText: "OK" });
                
              }
                
            },
            error: function () {
              //ha habido un error desconocido
              Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
            }
          });

        }else{
          /* error - correo electronico */
          Swal.fire({
            title: 'Error en CORREO ELECTRONICO',
            html: '<p>Ingresa un correo electronico valido.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
            type: 'error',
            confirmButtonText: 'OK'
          });

        }

      });

      /*Comprobar casillas*/ 

      $("#btnNeoClave").click(function(event) {
        /* Act on the event */
        event.preventDefault();

        if ($("#txtClave1").val().length>5&&$("#txtClave1").val().length<30&&$("#txtClave2").val().length>5&&$("#txtClave2").val().length<30) {
          if ($("#txtClave1").val()===$("#txtClave2").val()) {
            /* en este punto se ingresaron los campos correctamente */

            /* Validacion campo recaptcha */
            let x=$('[name=formNeoClave]').serialize();
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
                  todoOK(2);

                } else if(z.cod==1){
                  //console.log(z.msg);
                  //si eres robot
                  Swal.fire({ title: z.msg, text: "No olvide completar el campo ReCaptcha", type: "info", confirmButtonText: "OK" });
                  
                }
                  
              },
              error: function () {
                //ha habido un error desconocido
                Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
              }
            });

          }else{
            /* error - clave no coincide */
            Swal.fire({
              title: 'Error en CLAVE',
              html: '<p>Las claves introducidas no coinciden.</p><p style="color:red;">deben ser IDENTICAS.</p>',
              type: 'error',
              confirmButtonText: 'OK'
            });
          }
        }else{
          /* error - clave */
          Swal.fire({
            title: 'Error en CLAVE',
            html: '<p>La clave tiene un maximo de 30 caracteres y un minimo de 6.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
            type: 'error',
            confirmButtonText: 'OK'
          });
        }
      });

      /* validacion de campos superada */

      function todoOK(opcion){
        Swal.fire({
          title: '',
          text: 'Cargando...',
          type: "success",
          showConfirmButton: false,
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          }
        }).then((result) => {
          
        });

        if (opcion==1) {
          let x=$('[name=formRecu]').serialize();
          //console.log(x);
          
          $.ajax({
            type: "POST",
            url: 'script/recuperaClave.php',
            data: x,
            success: function (respuesta) {
              console.log(respuesta);
              if (respuesta.cod==0) {

                //console.log(respuesta.msg);
                Swal.fire({
                  title: respuesta.msg,
                  html: '<p>Te enviamos un correo con los pasos a seguir para recuperar tu cuenta</p>',
                  type: 'success',
                  confirmButtonText: 'OK',
                  onAfterClose: () => {

                  }
                });
                
              }else if(respuesta.cod==1){
                Swal.fire({
                  title: respuesta.msg,
                  html: '<p>Intenta Otra Vez !</p>',
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
              Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
            }
          });
        }else if (opcion==2) {
          let x=$('[name=formNeoClave]').serialize();
          console.log(x);
          
          $.ajax({
            type: "POST",
            url: 'script/modificaClave.php',
            data: x,
            success: function (respuesta) {
              console.log(respuesta);
              console.log(respuesta.cod);
              console.log(respuesta['cod']);
              if (respuesta.cod==0) {
                console.log(respuesta.msg);
                Swal.fire({
                  title: respuesta.msg,
                  html: '<p>Inicia sesion con tu nueva clave !</p>',
                  type: 'success',
                  confirmButtonText: 'OK',
                  onAfterClose: () => {
                    window.location.href='../comunidad';
                  }
                });
                
              }else if(respuesta.cod==1){
                Swal.fire({
                  title: respuesta.msg,
                  html: '<p>Intenta Otra Vez !</p>',
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
              Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
            }
          });
        }else{

        }

        

      }

});