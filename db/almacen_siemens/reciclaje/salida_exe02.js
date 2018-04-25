// JavaScript Document
$(document).ready(function() {
	$('#enviar').on('click', function(){
		if ($('#detalle-salida >tbody >tr').length == 0){
			$('#mensaje1').html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><img src="../cssalmacen/img/Error.png" width="25" /> <strong>No existe</strong> ningun Item en la tabla.</div>').show("swing");
			return false;					
		}else{
		$('#tb_salida').submit(function(event){
			event.preventDefault();	
			var datos = $('#tb_salida').serialize();	
			var ruta = '../admin/Temp_salida_exe.php';
			var url1 = "new_salida2.php";
			$("#detalle-salida tbody tr").each(function (index) {
				  var campo1, campo2, campo3, campo4, campo5, campo6;
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
					  }
				 });	 
			});//final del each	
		});	//final del submit 
		}	
	});
	
	
			 $.ajax({
				url: ruta,
				type: 'post',
				data: 'Item='+campo1 + ' & ' + 'Descripcion='+ campo2 + ' & ' + 'Referencia='+ campo3 + ' & ' + 'Id='+ campo4 + ' & ' + 'medida='+ campo5 + ' & ' + 'cantidad='+ campo6,
				beforeSend: function(){
					alert(datos);
				},
				success: function(data){
					if(data){
					$(location).attr('href',url1); 
					}else{
						$('#mensaje1').html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><img src="../cssalmacen/img/Error.png" width="25" /> <strong>Error,</strong> al guardar datos en BD-01253.</div>');	
					}
				}		  
         });//final del ajax jquery
	
});	//final del document.ready	