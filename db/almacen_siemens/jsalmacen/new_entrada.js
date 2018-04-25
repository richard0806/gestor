// JavaScript Document
//Script para guardar datos de la tabla detalle-salida en BD mysql
$(function(){ 
			function fn_cantidad(){
				cantidad = $("#detalle-entrada tbody").find("tr").length;
				$("#span_cantidad").html(cantidad);
			};
			
		
			$('#tb_entrada').submit(function( event ) {
			event.preventDefault();
			var datos = $('#tb_entrada').serialize();
			if ($('#detalle-entrada-cuerpo >tr').length == 0){
					swal({  title: "Error!",   
							text: "<strong>No existe</strong> ningun Item en la tabla.",
							html: true,
							type: "error",   
							timer: 1000,   
							showConfirmButton: false 
						});
					//fn_ocultar();
					return false;
					
				}else{
					$("#detalle-entrada-cuerpo tr").each(function (index) {
						var campo1, campo2, campo3, campo4, campo5, campo6, campo7;
						 $(this).children("td").each(function (index2) {
							  switch (index2) {
								case 0:
									 campo1 = $(this).text();
									  break;
								case 1:
									 campo2 = $(this).text();
									  break;
								case 2:
									  campo3 = $(this).text();
									 break;
								case 3:
									  campo4 = $(this).text();
									 break;
								case 4:
									  campo5 = $(this).text();
									 break;
								case 5:
									  campo6 = $(this).text();
									break;
								case 6:
									  campo7 = $(this).text();
									break;
								case 7:
									  campo8 = $(this).text();
									break;
								case 8:
									  campo9 = $(this).text();
									break;
								
							}
						
						 });//final each para index2										 					 		  
						 var variables = '&Item='+campo1+'&Descripcion='+campo2+'&Referencia='+campo3+'&Id='+campo4+'&medida='+campo5+'&cantidad='+campo6 +'&comentario='+campo7 +'&almacen='+campo8+'&stock='+campo9;
						 //alert(datos +'-'+ variables);
						 $.ajax({
							type:'POST',//TIPO DE PETICION PUEDE SER GET
							dataType:"json",//EL TIPO DE DATO QUE DEVUELVE PUEDE SER JSON/TEXT/HTML/XML
							url:"entrada_exe.php",//DIRECCION DONDE SE ENCUENTRA LA OPERACION A REALIZAR  
							data: datos + variables,
							  
							  beforeSend: function(){								  
								  //alert('Espere un momento, estamos preparando los datos' +'&'+ datos + variables);
								  waitingDialog.show();//CERRAMOS EL FORM 
								},
								
							  success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
								if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
									waitingDialog.hide();//CERRAMOS EL FORM
									swal({  title: "Está seguro?",   
											text: response.mensaje + ", desea imprimir este comprobante?",   
											type: "success",   
											showCancelButton: true,   
											confirmButtonColor: '#5cb85c',    
											confirmButtonText: "Yes, Continuar!",   
											cancelButtonText: "No, Cancelar!",   
											closeOnConfirm: false 
										}, function(isConfirm){   
												if (isConfirm) {     
													window.location = 'print-entrada.php?fac=' + $('#factura').val();    
												} else {     
													$('#tb_entrada input[type="text"]').val('');
													$('#ATselect').find('option:first').attr('selected', 'selected').parent('select');
													$("#detalle-entrada-cuerpo").empty();	
													fn_cantidad();   
												}						
										});
								  }
								  else{
									waitingDialog.hide();//CERRAMOS EL FORM
									//alert(response.mensaje);
									swal({  title: "Error!",   
											text: response.mensaje,
											html: true,
											type: "error",   
											timer: 2000,   
											showConfirmButton: false 
										});
								 	//fn_ocultar();
								  }
							  }
						});//final ajax
						
					});//final del each index
					
			}//final del else		
				
				
		});
});