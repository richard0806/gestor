// JavaScript Document

$(function(){
	//$(".c_error").remove();
	//comprobamos si se pulsa una tecla
        $("#cargar").click(function(){
                                    
              //obtenemos el texto introducido en el campo de búsqueda
              consulta = $("#id_producto").val();
			  almacen1 = $("#Almacen1 option:selected").val();
			  almacen2 = $("#Almacen2 option:selected").val();
			  $('#diverror3').hide("swing"); //muestro mediante div
			  $(".c_error").remove();//ocultamos el error de campo
			  $('#Descripcion').val('');
			  $('#Ref').val('');
			  $('#Stock1').val('');
			  $('#Stock2').val('');
			  $('#Medida').val('');
                                                                           
              //hace la búsqueda
                                                                                  
              $.ajax({
                    type: "POST",
                    url: "../admin/Consul_Transfer.php",
                    data: "id="+consulta + '&' +"Alm="+ almacen1 + '&' +"Alm2="+ almacen2,
                    dataType: "json",
					
                    beforeSend: function(){
													
						 if(almacen1 == 0){
							 $('#Almacen1').after( "<span class='c_error' id='c_error_name' style='color:red'>Seleccione una opcion.</span>" );
							 $('#enviar').prop( "disabled", true );
							 return false;
							 }else if(almacen2 == 0){
								 $('#Almacen2').after( "<span class='c_error' id='c_error_name' style='color:red'>Seleccione una opcion.</span>" );
							$('#enviar').prop( "disabled", true );
							 return false;
							}else if(almacen1 == almacen2){
								$('#enviar').prop( "disabled", true );
									swal({
									  title: "Error de Datos!",
									  text: "El Almacén de salida no puede ser igual a el Almacén de recepción de transferencia",
									  type: "error",   
									  timer: 1500,   
									  showConfirmButton: false 
									});	
									 $("#Almacen2 option[value=0]").attr("selected",true);
									return false;
							}else if (consulta.length == 0 ){
								$('#id_producto').after( "<span class='c_error' id='c_error_name' style='color:red'>Ingrese el ID.</span>" );
								$('#id_producto').focus();
								return false;
								
							} else{
                          //imagen de carga
                          		$(".c_error").remove();//ocultamos el error de campo
						  		waitingDialog.show();//$('#myModalEntrada').modal('show');//CERRAMOS EL FORM							  	
							  	//$('#diverror2').hide("swing");
								
							  //alert("id="+consulta + '&' +"Alm="+ almacen);							
							}
							
                    },
                    error: function(){
						$('#enviar').prop( "disabled", true );
						  waitingDialog.hide();//$('#myModalEntrada').modal('hide');//CERRAMOS EL FORM					  
						  swal({
							  title: "Lo sentimos!",
							  text: "No existen datos que concuerden con su búsqueda.!",
							  type: "warning",
							  timer: 1500,   
							  showConfirmButton: false
							});
						  $('#id_producto').val('');					  
						  $('#id_producto').focus();
                    },
                    success: function(data){ 
						  $('#Descripcion').val(data.descripcion);//llenamos los campos 
						  $('#Ref').val(data.Ref);//llenamos los campos
						  $('#Stock1').val(data.stock);//llenamos los campos
						  $('#Stock2').val(data.sobmant);//llenamos los campos
						  $('#SAP').val(data.sap);//llenamos los campos
						  $('#Medida').val(data.medida);//llenamos los campos
						  $('#enviar').prop( "disabled", false ); 
						  
                          waitingDialog.hide();//$('#myModalEntrada').modal('hide');//CERRAMOS EL FORM 
						  $('#cantidad').focus();
						  //alert(data.Alm +'<br>'+ data.paq);                                    
                    },
              });
		//$(location).attr('href', 'entrada.php?success=1');
    	
  	});
	
});
		function limpiarformulario(formulario){
			   /* Se encarga de leer todas las etiquetas input del formulario*/
			   $(formulario).find('input').each(function() {
				  switch(this.type) {
					 case 'password':
					 case 'text':
					 case 'hidden':
						  $(this).val('');
						  break;
					 case 'checkbox':
					 case 'radio':
						  this.checked = false;
				  }
			   });
			 
			   /* Se encarga de leer todas las etiquetas select del formulario */
			   $(formulario).find('select').each(function() {
				   $("#"+this.id + " option[value=0]").attr("selected",true);
			   });
			   /* Se encarga de leer todas las etiquetas textarea del formulario */
			   $(formulario).find('textarea').each(function(){
				  $(this).val('');
			   });
			   $('#enviar').prop( "disabled", true );
			}