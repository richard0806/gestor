// JavaScript Document
//Utilizado tanto en Salida como en Devoluciones por contener los mismos campos... 

$(function(){

	//$(".c_error").remove();

	//comprobamos si se pulsa una tecla
        $("#cargar").click(function(){
                                    
              //obtenemos el texto introducido en el campo de búsqueda
              consulta = $("#id_producto").val();
			  almacen = $("#Almacen32 option:selected").val();
			  $('#diverror3').hide("swing"); //muestro mediante div
			  $(".c_error").remove();//ocultamos el error de campo
			  
                                                                           
              //hace la búsqueda
                                                                                  
              $.ajax({
                    type: "POST",
                    url: "../admin/consulta.php",
                    data: "id="+consulta + '&' +"Alm="+ almacen,
                    dataType: "json",
					
                    beforeSend: function(){						
						 if(almacen == 0){
							 $('#Almacen32').after( "<span class='c_error' id='c_error_name' style='color:red'>Seleccione una opcion.</span>" );
							 return false;
							 }else if (consulta.length == 0 ){
								$('#id_producto').after( "<span class='c_error' id='c_error_name' style='color:red'>Ingrese el ID.</span>" );
								$('#id_producto').focus();
								return false;
								
							} else{
                          //imagen de carga
                          		$(".c_error").remove();//ocultamos el error de campo
						  		waitingDialog.show();//$('#myModalEntrada').modal('show');//CERRAMOS EL FORM							
							  //alert("id="+consulta + '&' +"Alm="+ almacen);							
							}
                    },
                    error: function(){
						//limpiamos todos los campos del formulario
                       		limpiarformulario("#formentrada");
					   
						  waitingDialog.hide();//$('#myModalEntrada').modal('hide');//CERRAMOS EL FORM						  
						  			swal({  title: "Error!",   
											text: 'No se han encontrado registros',
											html: true,
											type: "error",   
											timer: 1500,   
											showConfirmButton: false 
										});
						  //$('#diverror2').show("swing"); //muestro mediante div
						  $('#id_producto').focus();
                    },
                    success: function(data){ 
						  $('#Descripcion').val(data.descripcion);//llenamos los campos 
						  $('#Ref').val(data.Ref);//llenamos los campos
						  $('#Stock').val(data.stock);//llenamos los campos
						  $('#UdMedida').val(data.undMedida);//llenamos los campos select
						  $('#At').val(data.At);//llenamos los campos select
						  $('#Item').val(data.Item);//llenamos los campos							  
						  //$('#Ubicacion').val(data.ubicacion);//llenamos los campos
						  //$('#check_list[value='+ data.pertenece+']').attr("checked","checked");
						  //$("#Almacen32 option[value="+ data.warehouse +"]").attr("selected",true);
						  //$('#tipopaquete option[value='+ data.paq+']').attr('selected',true);//llenamos los campos 						 select
						   
						  
                          waitingDialog.hide();//$('#myModalEntrada').modal('hide');//CERRAMOS EL FORM 
						  $('#cantidad').focus();
						  //alert(data.Alm +'<br>'+ data.paq);                                    
                    },
              });
		//$(location).attr('href', 'entrada.php?success=1');
    	
  	});
	
});
// JavaScript Document agregar a la tablas
//los productos para despues procesar la salida.

            $(document).ready(function(){
                fn_dar_eliminar();
				fn_cantidad();
            });
			function fn_ocultar(){
				 setTimeout(function() {
						$('#mensaje1').empty();
					},3000);	
			};
			
			function fn_cantidad(){
				cantidad = $("#detalle-entrada tbody").find("tr").length;
				$("#span_cantidad").html(cantidad);
			};
					
            function fn_agregar(){				
				var solicitar =  ($('#cantidad').val()!='')?parseInt($("#cantidad").val()):0;//validar que solo acepte datos numericos.
				var Actual = ($('#Stock').val()!='')?parseInt($("#Stock").val()):0;//validar que solo acepte datos numericos.
				if(solicitar == 0 || solicitar == ""){
					$('#cantidad').after( "<span class='c_error' id='c_error_name' style='color:red'>La cantidad debe ser mayor de 0.</span>" );
					$('#cantidad').focus();//Ponemos el focus en el campo Cantidad
						
				}else{
                cadena = "<tr>";
                cadena = cadena + "<td>" + $("#Item").val() + "</td>";
                cadena = cadena + "<td>" + $("#Descripcion").val() + "</td>";
                cadena = cadena + "<td>" + $("#Ref").val() + "</td>";
                cadena = cadena + "<td>" + $("#id_producto").val() + "</td>";
				cadena = cadena + "<td>" + $("#UdMedida").val() + "</td>";
				cadena = cadena + "<td>" + $("#cantidad").val() + "</td>";
				cadena = cadena + "<td>" + $("#comentario").val() + "</td>";
				cadena = cadena + "<td class='hidden'>" + $("#Almacen32").val() + "</td>";
				cadena = cadena + "<td class='hidden'>" + $("#Stock").val() + "</td>";
                cadena = cadena + "<td><a class='elimina'><img src='../cssalmacen/img/delete.png'  style='cursor:pointer;' width='20' /></a></td></tr>";
                $("#detalle-entrada tbody").append(cadena);
                /*
                    aqui puedes enviar un conunto de tados ajax para agregar al usuairo
                    $.post("agregar.php", {ide_usu: $("#valor_ide").val(), nom_usu: $("#valor_uno").val()});
                */
                fn_dar_eliminar();
				fn_cantidad();
				swal({	title: "Listo!", 
						text: "Producto <strong> agregado</strong> Correctamente.",
						html: true,
						type: "success",
						timer: 1000,   
						showConfirmButton: false
				});
                // $('#mensaje1').html('<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><img src="../cssalmacen/img/icon-imag/insert.png"  width="25"/> Producto <strong> agregado</strong> Correctamente.</div>');
				limpiarformulario("#formentrada");
            	}
			}
            
            function fn_dar_eliminar(){
                $("a.elimina").on('click',function(){
                    Item = $(this).parents("tr").find("td").eq(0).html();
					var parent = $(this).parents('tr').get(0);
					swal({   title: "Está seguro?",  
							 text: "Desea eliminar este Producto: " + Item,  
							 type: "warning",   
							 showCancelButton: true,   
							 confirmButtonColor: "#DD6B55",   
							 confirmButtonText: "Yes, Continuar!",   
							 cancelButtonText: "No, Cancelar!",   
							 closeOnConfirm: false,   
							 closeOnCancel: false 
						}, function(isConfirm){   
							 	if (isConfirm) {									
									$(parent).remove();
									fn_cantidad();
									swal("Listo!", "El registros No. "+ Item +" ha sido eliminado.", "success");     
									
								} else {     
									swal("Cancelado", "Proceso declinado perteneciente al ítems: " + Item, "error");  
								} 
						});                    
                });			
	
			};
 
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
			}	
			$('#limpiar1').click(function(){
				$("#detalle-entrada tbody").empty();
				fn_cantidad();
			});					
	