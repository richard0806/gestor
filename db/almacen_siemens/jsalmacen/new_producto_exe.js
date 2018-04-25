// JavaScript Document

$(function(){
				$("#keyword").click(function() {  
					if($("#keyword").is(':checked')) { 
						$('#txtkeyword').prop( "disabled", false );
						$('#txtkeyword').focus();
					}else{ 
						$('#txtkeyword').prop( "disabled", true );
					} 
				});//FINAL CHECKBOX.
				
				
				$('#Almacen').change(function(){
					if($('#Almacen').val() == 1){
						$('#paquete').prop( "disabled", false );
						$("#paquete").attr("required", "true");	
					}else{
						$('#paquete').prop( "disabled", true );
					}
				});//FINAL CHANGE.
									
});//FINAL FUNCTION()



$(document).ready(function() { 
				$('#fn_generar').on('click', function () {
					var respuesta = "function";
					$.ajax({
						type:'POST',
						url:"ultimo_id_exe.php",
						data:'Op=' + respuesta,
						
						beforeSend: function(){
							//alert('Op=' + respuesta);
							$('#loader2').fadeIn("slow");
						},
						success: function(dat){
							$('#loader2').fadeOut("slow");
							$('#NewProducto #id_producto').val(dat);
						}
					})				
				});//final fn click
				
//ENVIO DE FORMULARIO PARA PROCESARLO	
				$("#NewProducto").submit(function(){ //en el evento submit del fomulario
					event.preventDefault();
					var formulario = $('#NewProducto').serialize();
						
						$.ajax({
							type:'POST',//TIPO DE PETICION PUEDE SER GET
							dataType:"json",
							url: $(this).attr('action'),						
            				data: formulario,
							
							beforeSend: function(){
								var Id = $('#NewProducto #id_producto').val();
								var stock = $('#NewProducto #cantidad').val();
								
								if(Id.length < 4){
									$('#NewProducto #id_producto').after( "<span class='c_error' id='c_error_name' style='color:red'>Ingrese el ID valido.</span>" );
									$('#NewProducto #id_producto').focus();
									return false;
								}else{
									$("#NewProducto .c_error").remove();//ocultamos el error de campo
									$('#load').fadeIn("slow"); //muestro el loader de ajax
								}
								              					
							},
				  			success: function(responsesave){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
								if(responsesave.respuesta=="SI"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
									$("#load").fadeOut("slow");
									alert(responsesave.mensaje);									
									limpiaForm("#NewProducto");
									$('#myModalNew').modal('hide');
									
								}else{
									$("#load").fadeOut("slow");
									alert(responsesave.mensaje);										 	
								}
								
								
							},
			   			});//fin ajax
				});//fin submit

});
			function limpiaForm(miForm) {
				// recorremos todos los campos que tiene el formulario
				$(':input', miForm).each(function() {
				var type = this.type;
				var tag = this.tagName.toLowerCase();
				//limpiamos los valores de los campos…
				if (type == 'text' || type == 'password' || tag == 'textarea')
				this.value = "";
				// excepto de los checkboxes y radios, le quitamos el checked
				// pero su valor no debe ser cambiado
				else if (type == 'checkbox' || type == 'radio')
				this.checked = false;
				// los selects le ponesmos el indice a -
				else if (tag == 'select')
				this.selectedIndex = 0;
				});
			}
       
		function validar(){
						
		};
				
