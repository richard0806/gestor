

$('#formconsulta').submit(function(event){
		event.preventDefault();
		valor();
	});


function valor(){

		//obtenemos el texto introducido en el campo de búsqueda
              consulta = $("#busqueda").val();
			  $(".c_error1").remove();//ocultamos el error de campo
			  $('.respuesta').empty();//vaciamos la tabla 
			  
			  //hace la búsqueda
                                                                                  
              $.ajax({
                    type: "POST",
                    url: "../user/js/consulta.php",
                    data: "b="+consulta,
                    dataType: "html",
					
                    beforeSend: function(){
						//alert("b="+consulta);
						 if (consulta.length == 0 ){
								$('#busqueda').after( "<span class='c_error1' id='c_error_name' style='color:red'>Ingrese el Datos de Busqueda.</span>" );
								$('#busqueda').focus();
								return false;
								
							} else{
                          //imagen de carga
                          		$(".c_error1").remove();//ocultamos el error de campo
								$('.respuesta').empty();//vaciamos la tabla 
						  		$('#myModalloader').modal('show');//CERRAMOS EL FORM								  							
							}
                    },
                    error: function(){
                          $('#busqueda').val('');//limpiamos los campos text
						  $('#myModalloader').modal('hide');//CERRAMOS EL FORM						  
						  swal({
							  title: "Lo sentimos!",
							  text: "No existen datos que concuerden con su búsqueda.!",
							  type: "error",
							  timer: 2500,
							  showConfirmButton: false
							});
						  $('#busqueda').focus();
                    },
                    success: function(data){
						if(data == "DONE"){
							$('#busqueda').val('');//limpiamos los campos text
							$('.respuesta').empty();//vaciamos la tabla 
						  	$('#myModalloader').modal('hide');//CERRAMOS EL FORM
							swal({
							  title: "Lo sentimos!",
							  text: "No existen datos que concuerden con su búsqueda.!",
							  type: "error",
							  timer: 2500,
							  showConfirmButton: false
							});
							$('#busqueda').focus();
							}else{ 
						$('.respuesta').empty();						
						$('.respuesta').append(data);//LLENAMOS LA TABLA CON LOS DATOS
						$('#myModalloader').modal('hide');//CERRAMOS EL FORM 
							}
                    }
				});//FINAL DEL AJAX
}//FINAL DE LA FUNCION