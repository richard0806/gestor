$(function() {
	var form = $('#form-signin');


	$(form).submit( function(event){
		event.preventDefault();

		var user = $('#txtUsuario').val();
		var pass = $('#txtClave').val();

		if(user == '' || pass == ''){
			$('#txtUsuario').focus();
			$('.text-error').removeClass('hidden');
			$('.text-error').text('Existen Campos vacios');
			return false;
		}
		formu = $(form).serialize();
		$.ajax({
			url: 'session_init.php',
			type: 'POST',
			data: formu,
			statusCode: {
			    404: function() {
			      window.location = 'global/404error.php';
			    }
			  },

			beforeSend: function(){
				//alert(formu);
				$('#form-signin').toggle('500');
				$('.loader').toggle('500');
			},

			success: function(resp){
				resp = JSON.parse(resp);
				if (resp.respuesta === 'DONE') {
					window.location = resp.ruta;					
				}
				else{
					$('.loader').toggle('500');
					$('#form-signin').toggle('500');
					$('#txtUsuario').focus();
					$('.text-error').removeClass('hidden');
					$('.text-error').text(resp.mensaje);
				}
			}
		});
	});
});