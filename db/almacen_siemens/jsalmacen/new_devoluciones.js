// JavaScript Document
//Script para guardar datos de la tabla detalle-devolucion en BD mysql
$(function(){ 
			function fn_cantidad(){
				cantidad = $("#detalle-salida tbody").find("tr").length;
				$("#span_cantidad").html(cantidad);
			};
			
			 $("#prestamo").click(function() {  
				if($("#prestamo").is(':checked')) { 
					$('#txtprestamo').val('Prestamo');
				}else{ 
					$('#txtprestamo').val('Consumo');
				} 
			});
		
			$('#tb_salida').submit(function( event ) {
			event.preventDefault();
			var datos = $('#tb_salida').serialize();
			if ($('#detalle-devolucion-cuerpo >tr').length == 0){
					swal({  title: "Error!",   
							text: "<strong>No existe</strong> ningun Item en la tabla.",
							html: true,
							type: "error",   
							timer: 1500,   
							showConfirmButton: false 
						});
					//$('#mensaje1').html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><img src="../cssalmacen/img/Error.png" width="25" /> <strong>No existe</strong> ningun Item en la tabla.</div>');
					//fn_ocultar();
					return false;
					
				}else{
					$("#detalle-devolucion-cuerpo tr").each(function (index) {
						var campo1, campo2, campo3, campo4, campo5, campo6, campo7, campo8;
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
								case 9:
									  campo10 = $(this).text();
									break;
							}
						
						 });//final each para index2										 					 		  
						 var variables = '&Item='+campo1+'&Descripcion='+campo2+'&Referencia='+campo3+'&Id='+campo4+'&medida='+campo5+'&cantidad='+campo6 +'&condicion='+campo7+'&comentario='+campo8+'&almacen='+campo9+'&stock='+campo10;
						 //alert(datos +'-'+ variables);
						 $.ajax({
							type:'POST',//TIPO DE PETICION PUEDE SER GET
							dataType:"json",//EL TIPO DE DATO QUE DEVUELVE PUEDE SER JSON/TEXT/HTML/XML
							url:"devoluciones_exe.php",//DIRECCION DONDE SE ENCUENTRA LA OPERACION A REALIZAR  
							data: datos + variables,
							  
							  beforeSend: function(){								  
								  //alert('Espere un momento, estamos preparando los datos' +''+ datos + variables);
								  $('#myModalSalida').modal('show');//CERRAMOS EL FORM 
								},
								
							  success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
									if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
									$('#myModalSalida').modal('hide');//CERRAMOS EL FORM
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
													window.open ('print-devolucion.php?ot=' + $('#Ot').val(),"Ventana_Devoluciones","width=1000,height=450,top=100,left=200,toolbar=no,location=no,status=no,menubar=no");
													window.location = 'devolucion.php';     
												} else {     
													//$('#tb_salida input[type="text"]').val('');
								  					//$('#ATselect').find('option:first').attr('selected', 'selected').parent('select');
								  					//$("#detalle-devolucion-cuerpo").empty();	
								  					//fn_cantidad(); 
													location.reload();
													//window.setTimeout('location.reload()',0); //reloads after 0 seconds 
												}						
										});
								  }
								  else{
									$('#myModalSalida').modal('hide');//CERRAMOS EL FORM
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