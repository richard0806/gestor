
$(function(){ 
//CUANDO PRESIONAMOS EL BOTON AGREGAR MOSTRAMOS EL FORMULARIO
	$('#crear').on('click',function(){	
		$('#Caveria input[type=text]').val('');//BORRAMOS TODOS LOS CAMPOS TIPO TEXT EN EL FORM		
		$('#estatus option[selected]').removeAttr('selected');//REMOVEMOS EL ATTRIBUTO SELECTED DEL SELECT
		$("#opcion").val("NUEVO");
		
	});
	$('#loader').hide();//OCULTAMOS EL LOADER
	//validamos la accion a tomar cuando demos submit en el formulario frm_user
	$('#enviar').on('click',function(){
		//AQUI USAMOS LA PETICION AJAX
		var datos=$(this).serialize();
		
		$.ajax({
			type:'POST',//TIPO DE PETICION PUEDE SER GET
			dataType:"json",//EL TIPO DE DATO QUE DEVUELVE PUEDE SER JSON/TEXT/HTML/XML
			url:"ajax.php",//DIRECCION DONDE SE ENCUENTRA LA OPERACION A REALIZAR
			data:'Op='+ $("#opcion").val() +'&'+datos,//DATOS ENVIADOS PUEDE SER TEXT A TRAVEZ DE LA URL O PUEDE SER UN OBJETO
			
			beforeSend: function(){//ACCION QUE SUCEDE ANTES DE HACER EL SUBMIT			
				//$('#loader').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA
				alert(datos);
				},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#listaaverias").html(response.contenido);//cargo los registros que devuelve ajax
					$('#myModal1').modal('hide');//CERRAMOS EL FORM
					$('#loader').hide();//OCULTAMOS EL LOADER
				}

				else{
						alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");
						$('#loader').hide();	
					}
				
				
			},
			error: function(){//SI OCURRE UN ERROR 
				alert('El servicio no esta disponible intentelo mas tarde');//MENSAJE EN CASO DE ERROR
				$('#loader').hide();//OCULTAMOS EL DIV LOADER
			}
		});
		return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA
	});
	
	//capturamos los eventos click que se den en la seccion tbody de la tabla en cualquier a
	$("#listaaverias").on("click","a",function(){
		
		
			// Llenar el formulario con los datos del registro seleccionado
				$('#ID').val($(this).parent().parent().children('td:eq(0)').text());
				$('#username').val($(this).parent().parent().children('td:eq(1)').text());
				
			// Seleccionar status
				$('#AT option[value='+ $(this).parent().parent().children('td:eq(2)').text() +']').attr('selected',true);

				$('#Ubicacion').val($(this).parent().parent().children('td:eq(3)').text());
				$('#ot').val($(this).parent().parent().children('td:eq(4)').text());
				$('#Equipo').val($(this).parent().parent().children('td:eq(5)').text());
				
			// Seleccionar status
			$('#estatus option[value='+ $(this).parent().parent().children('td:eq(6)').text() +']').attr('selected',true);
      
		//abrimos el formulario como tipo dialog
		$("#opcion").val("EDITAR");
		$("#myModal1").modal('show');		
	});
});