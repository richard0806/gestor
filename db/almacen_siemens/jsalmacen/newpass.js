//JQUERY CODE
$(function(){	
			
	var a = 'no'; var s = 'no'; var d = 'no'; var f = 'no';
	$("input[type=password]").keyup(function(){
    var ucase = new RegExp("[A-Z]+");
	var lcase = new RegExp("[a-z]+");
	var num = new RegExp("[0-9]+");
	
	
	if($("#password1").val().length >= 8 && $("#password1").val().length <= 15){
		$("#8char").removeClass("glyphicon-remove");
		$("#8char").addClass("glyphicon-ok");
		$("#8char").css("color","#00A41E");
		a = 'si';
	}else{
		$("#8char").removeClass("glyphicon-ok");
		$("#8char").addClass("glyphicon-remove");
		$("#8char").css("color","#FF0004");
		a = 'no';
	}
	
	if(ucase.test($("#password1").val())){
		$("#ucase").removeClass("glyphicon-remove");
		$("#ucase").addClass("glyphicon-ok");
		$("#ucase").css("color","#00A41E");
		s = 'si';
	}else{
		$("#ucase").removeClass("glyphicon-ok");
		$("#ucase").addClass("glyphicon-remove");
		$("#ucase").css("color","#FF0004");
		s = 'no';
	}
	
	if(lcase.test($("#password1").val())){
		$("#lcase").removeClass("glyphicon-remove");
		$("#lcase").addClass("glyphicon-ok");
		$("#lcase").css("color","#00A41E");
		d = 'si';
	}else{
		$("#lcase").removeClass("glyphicon-ok");
		$("#lcase").addClass("glyphicon-remove");
		$("#lcase").css("color","#FF0004");
		d = 'no';
	}
	
	if(num.test($("#password1").val())){
		$("#num").removeClass("glyphicon-remove");
		$("#num").addClass("glyphicon-ok");
		$("#num").css("color","#00A41E");
		f = 'si';
	}else{
		$("#num").removeClass("glyphicon-ok");
		$("#num").addClass("glyphicon-remove");
		$("#num").css("color","#FF0004");
		f = 'no';
		
	}
	
	if($('#password1').val() != ""){
		if($("#password1").val() == $("#password2").val()){
			$("#pwmatch").removeClass("glyphicon-remove");
			$("#pwmatch").addClass("glyphicon-ok");
			$("#pwmatch").css("color","#00A41E");
			g = 'si';
			
		}else{
			$("#pwmatch").removeClass("glyphicon-ok");
			$("#pwmatch").addClass("glyphicon-remove");
			$("#pwmatch").css("color","#FF0004");
			$("input[type=submit]").prop('disabled', true);
			g = 'no';
			
		}
	}else{
		//$("input[type=submit]").prop('disabled', true);	
		$("#pwmatch").removeClass("glyphicon-ok");
		$("#pwmatch").addClass("glyphicon-remove");
		$("#pwmatch").css("color","#FF0004");
		$("input[type=submit]").prop('disabled', true);
	}
	
	if($("#passwordAnt").val().length > 3 && $("#passwordAnt").val().length <= 15){
		h = 'si';
	}else{
		h = 'no';
		$("input[type=submit]").prop('disabled', true);
	}
	
	
	if((a == 'si') && (s == 'si') && (d == 'si') && (f == 'si') && (g == 'si') && (h == 'si')){
		$("input[type=submit]").prop( "disabled", false );
		//alert(a+'-'+s+'-'+d+'-'+f+'-'+g);
	}
});

$("input[type=submit]").prop('disabled', true);
		
			 
		
});
		
	$(function(){	
			$('#passwordForm').submit(function(event){
				event.preventDefault();		
			$.ajax({
                    type: 'POST',//TIPO DE PETICION PUEDE SER GET
		    		dataType:"json",//EL TIPO DE DATO QUE DEVUELVE PUEDE SER JSON/TEXT/HTML/XML,
                    url: "../admin/modify_pass_exe.php",
                    data: $('#passwordForm').serialize(),
					
                    success: function(data){
						if(data.respuesta == "error1"){
							swal({
							  title: "Error!",
							  text: data.mensaje,
							  type: "error",
							  showCancelButton: true,
							  confirmButtonClass: 'btn-danger',
							  confirmButtonText: 'Volver!'
							}, 
							  function(isConfirm){   
							  	if (isConfirm) {     
									var x = location.hostname;
									$(location).attr('href',"http://"+ x +":8080/almacen_siemens/admin/log_out.php");  
								} else {     
									history.back(); 
								} 
							});	
						}
						if(data.respuesta == "error2"){
							swal({
							  title: "Esta seguro?",
							  text: data.mensaje,
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: 'btn-warning',
							  confirmButtonText: 'Volver!'
							 }, 
							  function(isConfirm){   
							  	if (isConfirm) {     
									$('#passwordAnt').val('');
									$('#passwordAnt').focus(); 
								} else {     
									history.back();  
								} 
							});	
						}
						
						if(data.respuesta == "error3"){
							swal({
							  title: "Error!",
							  text: data.mensaje,
							  type: "error",
							  showCancelButton: false,
							  confirmButtonClass: 'btn-danger',
							  confirmButtonText: 'Volver!'
							 }, 
							  function(isConfirm){   
							  	if (isConfirm) {     
									history.back(); 
								} else {     
									history.back(); 
								} 
							});							
						}
						
						if(data.respuesta == "listo"){
							swal({
							  title: "Listo!",
							  text: data.mensaje,
							  type: "success",
							  showCancelButton: true,
							  confirmButtonClass: 'btn-success',
							  confirmButtonText: 'Continuar!',
							  }, 
							  function(isConfirm){   
							  	if (isConfirm) {     
									history.back(); 
								} else {     
									$('input[type="password"]').val('');
									$('#passwordAnt').focus();   
								} 
							});
							
						}
						
						//$(location).attr('href',"http://localhost:8080/almacen_siemens/admin/log_out.php");
						
                    }
				});//FINAL DEL AJAX
			});
		});