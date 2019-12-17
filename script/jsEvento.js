$(function() {
	//boton confirmar la denuncia del evento
	$("#btnConfirmarDenuncia").click(function(event) {
    	/* Act on the event */
    	//demostramos al usuario que se esta procesando su solicitud
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

        let x=$('[name=formDenunciaEve]').serialize();
        console.log(x);
    	
    	//comprobamos q este almenos una categoria seleccionada
    	if ($("#dn1").prop( "checked" )||$("#dn2").prop( "checked" )||$("#dn3").prop( "checked" )||$("#dn4").prop( "checked" )||$("#dn5").prop( "checked" )||$("#dn6").prop( "checked" )||$("#dn7").prop( "checked" )||$("#dn8").prop( "checked" )) {
    		//confirmamos el recaptcha
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
	              $.ajax({
			          type: "POST",
			          url: 'script/denunciarEvento.php',
			          data: x,
			          success: function (respuesta) {
			            console.log(respuesta);
			            let z=respuesta;
			            if (z.cod==0) {
			              Swal.fire({
			                title: respuesta.msg,
			                html: '<p>Nuestros administradores estan tomando cartas en el asunto.</p>',
			                type: 'success',
			                confirmButtonText: 'OK',
			                onAfterClose: () => {
			                  window.location.href="../";
			                }
			              });
			            }else if(z.cod==1){
			              Swal.fire({
			                title: respuesta.msg,
			                html: '<p>Error Inesperado</p>',
			                type: 'error',
			                confirmButtonText: 'OK',
			                onAfterClose: () => {

			                }
			              });
			            }else if(z.cod==2){
			              Swal.fire({
			                title: respuesta.msg,
			                html: '<p>Nuestros administradores estan tomando cartas en el asunto.</p>',
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
			            limpio();
			            Swal.fire({ title: "Error Fatal!", text: "Intenta nuevamente", type: "error", confirmButtonText: "OK" });
			          }
			        });

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
    		Swal.fire({ title: "Error", text: "Indica almenos una categoria para denunciar", type: "error", confirmButtonText: "OK" });
    	}
    });
});

$('.btnEveCute').tooltip({ 
	boundary: 'window'
});