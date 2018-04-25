// Jquery Document

$(function(){
	$('#fromtransferencia').submit(function(event){
		event.preventDefault();
		var stock = $('#Stock1').val();
		var cantidad = $('#cantidad').val();
		var datos = $('#fromtransferencia').serialize();
		
		$.ajax({
				type: "POST",
                url: "../admin/new_transferencia_exe.php",
                data: datos,
                dataType: "json",
				
				beforeSend: function(){		
					if(stock < cantidad){
						swal({
								title: "Error de Datos!",
								text: "La cantidad seleccionada supero el Stock actual.",
								type: "error",   
								timer: 1500,   
								showConfirmButton: false 
							});
						$('#cantidad').val('');	
						$('#cantidad').focus();		
						return false;
								
					}else{
						waitingDialog.show();
					}
					
				},//final del beforeSend
				   error: function(){
						  waitingDialog.hide();//$('#myModalEntrada').modal('hide');//CERRAMOS EL FORM					  
						  swal({
							  title: "Error!",
							  text: "Lo sentimos, registro no procesado.",
							  type: "error",
							  timer: 1500,   
							  showConfirmButton: false
							});
                    },
					success: function(data){
						if(data.respuesta =='NO'){
							waitingDialog.hide();//$('#myModalEntrada').modal('hide');//CERRAMOS EL FORM
							swal({  title: "Error!",   
									text: '<strong>Problemas</strong> al actualizar los registros.',
									html: true,
									type: "error",   
									timer: 1500,   
									showConfirmButton: false 
								});							
						}else{
							waitingDialog.hide();//$('#myModalEntrada').modal('hide');//CERRAMOS EL FORM
							limpiarformulario('#fromtransferencia');
							swal({	title:"Buen trabajo!", 
									text:"Registros actualizados satisfactoriamente!", 
									type:"success",
									showCancelButton: false,   
									confirmButtonColor: '#5cb85c',    
									confirmButtonText: "Yes, Continuar!",
								})
						}
					}
		});//final del ajax submit.
					
	});//final del submit event.
	
});//final del function().