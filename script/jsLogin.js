$(function(){

      /*Limpiar Casillas*/

      function limpio(){
        $("#txtCorreo").val("");
        $("#txtClave").val("");
      }

      /*Comprobar casillas*/ 

      $("#btnLogin").click(function(event) {
        /* Act on the event */
        event.preventDefault();

        let emailCheck = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

        /* correo electronico */
        if ($("#txtCorreo").val().length>0&&$("#txtCorreo").val().length<120&&emailCheck.test($("#txtCorreo").val())) {
          /* clave */
          if ($("#txtClave").val().length>5&&$("#txtClave").val().length<30) {

            /* en este punto se ingresaron los campos correctamente */

            /* Validacion campo recaptcha */
            let x=$('[name=formAcceso]').serialize();
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
                  
                }
                  
              },
              error: function () {
                //ha habido un error desconocido
                Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
              }
            });
            
          }else{
            /* error - clave */
            Swal.fire({
              title: 'Error en CLAVE',
              html: '<p>La clave tiene un maximo de 30 caracteres y un minimo de 6.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
              type: 'error',
              confirmButtonText: 'OK'
            });
          }
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

      /* validacion de campos superada */

      function todoOK(){
        Swal.fire({
          title: '',
          text: 'Cargando Perfil...',
          type: "success",
          showConfirmButton: false,
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          }
        }).then((result) => {
          
        });

        let x=$('[name=formAcceso]').serialize();
        console.log(x);
        
        $.ajax({
          type: "POST",
          url: 'script/acceso.php',
          data: x,
          success: function (respuesta) {
            console.log(respuesta);
            if (respuesta.cod==0) {

              //console.log(respuesta.msg);
              window.location.href='../comunidad';
              
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

      }

});