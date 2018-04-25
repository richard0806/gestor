$('form1').on('submit',function(){
		//AQUI USAMOS LA PETICION AJAX
		var datos=$('#busca').val();
		
		$.ajax({
			type:'POST',//TIPO DE PETICION PUEDE SER GET
			dataType:"json",//EL TIPO DE DATO QUE DEVUELVE PUEDE SER JSON/TEXT/HTML/XML
			url:"../ajax2.php",//DIRECCION DONDE SE ENCUENTRA LA OPERACION A REALIZAR
			data:datos,//DATOS ENVIADOS PUEDE SER TEXT A TRAVEZ DE LA URL O PUEDE SER UN OBJETO
			
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#solicitudaveria").html(response.resultado);//cargo los registros que devuelve ajax										
				}
				else{
					alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");						
				}
		});
		return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA
});