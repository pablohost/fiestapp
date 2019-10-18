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
          if ($("#txtClave").val().length>0&&$("#txtClave").val().length<30) {

            /* en este punto se ingresaron los campos correctamente */

            todoOK();
            
          }else{
            /* error - clave */
            Swal.fire({
              title: 'Error en CLAVE',
              html: '<p>La clave tiene un maximo de 30 caracteres.</p><p style="color:red;">Este campo es OBLIGATORIO.</p>',
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
          title: ':)',
          html: '<p>Datos ingresados correctamente</p>',
          type: 'success',
          confirmButtonText: 'OK'
        });

        limpio();

      }

});