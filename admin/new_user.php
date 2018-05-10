<?php

include_once '../global/objects.php';

$objUse = new Users();
$objPro = new Profiles();

//Obtenemos los perfiles existentes
$profiles = $objPro->show_profiles($con);

?>
<!doctype html>
<html>
	<head>
			<?php include_once '../global/header.php' ?>
      <title>Nuevo Usuario</title>
    	<style>
			#radioBtn .notActive{
				color: #3276b1;
				background-color: #fff;
			}
			#radioBtn{
			margin-top:38%;
			}
		</style>
    </head>


  <body>
        <?php include_once '../global/menu.php';?>
        <div class="container"><br><br><br>
					<fieldset class="fieldset">
						<legend>Nuevos Usuarios </legend>
						<?php echo "4bab7392019b5ed7ca7d79145a236600<br/>".md5('123456'); ?>
					<form name="newUser" action="new_user_exe.php" method="post" class="form-horizontal">
						<div class="form-group">
		                    <label for="NameUsers" class="col-sm-2 control-label">Nombre/s</label>
		                    <div class="col-sm-3">
		                      <input type="text" name="NameUsers" id="NameUsers" class="form-control" maxlength="20" required autofocus />
		                    </div>
		                    <label for="LastnameUsers" class="col-sm-2 control-label">Apellido/s</label>
		                    <div class="col-sm-3">
		                 	 <input type="text" name="LastnameUsers" id="LastnameUsers" class="form-control" required />
		                  	</div>
		                </div>
		                 <div class="form-group">
		                    <label for="login" class="col-sm-2 control-label">Nombre de Usuario</label>
		                    <div class="col-sm-3">
		                      <input type="text" name="login" id="login" class="form-control" maxlength="15" required />
		                    </div>
		                    <label for="email" class="col-sm-2 control-label">Direcci&oacuten de Correo</label>
		                    <div class="col-sm-3">
		                 	 <input type="email" name="email" id="email" class="form-control" required />
		                  	</div>
		                </div>

		                <div class="form-group">
		                    <label for="password" class="col-sm-2 control-label">Contraseña</label>
		                    <div class="col-sm-3">
		                      <input type="password" name="pass" id="password" class="form-control"   maxlength="10" required/>
		                    </div>
		                    <label for="status" class="col-sm-2 control-label">Estatus</label>
		                    <div class="col-sm-3">
		                     <select name="status" id="status" class="form-control" required>
		                          <option value=""></option>
		                          <option value="Enabled" class="text-uppercase">ACTIVADO</option>
		                          <option value="Disabled" class="text-uppercase">DESACTIVADO</option>
		                     </select>
		                    </div>
		                </div>

		                <div class="form-group">
		                    <label for="Posicion" class="col-sm-2 control-label">Posición</label>
		                    <div class="col-sm-3">
		                      <input type="text" name="posc" id="posicion" class="form-control" required/>
		                    </div>
							<label for="profile" class="col-sm-2 control-label">Perfiles</label>
		                    <div class="col-sm-3">
		                     <select name="profile" id="profile" class="form-control" required>
		                          <option value=""></option>
								  <?php
									while($rowpr=$profiles->fetch_array(MYSQLI_BOTH)){ ?>
		                          <option value="<?=$rowpr['idProfile'];?>" ><?=$rowpr["nameProfi"];?></option>
								  <?php
									}
								  ?>
		                     </select>
		                    </div>
		                </div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Activar Permisos</label>
							<div class="col-sm-1">
								<div class="material-switch" style="margin-top:80% !important;">
		                            <input id="SwitchProfile" type="checkbox"/>
		                            <label for="SwitchProfile" class="label-success"></label>
		                        </div><input type="text" hidden id="statusCheck" name="statusCheck">
							</div>
						</div>
						<br>
							<div class='well'>
								<span>Mensajes</span>
								<ul>
									<li> Los nombres de usuario podrían contener solo dígitos, letras mayúsculas, minúsculas y guiones bajos.</li>
									<li> Los correos electrónicos deberán tener un formato válido. </li>
									<li> Las contraseñas deberán tener al menos 6 caracteres.</li>
									<li>Las contraseñas deberán estar compuestas por:
										<ul>
											<li> Por lo menos una letra mayúscula (A-Z)</li>
											<li> Por lo menos una letra minúscula (a-z)</li>
											<li> Por lo menos un número (0-9)</li>
										</ul>
									</li>
									<li> La contraseña y la confirmación deberán coincidir exactamente.</li>
								</ul>
							</div>

		                    <hr class="divider">
		                    <div class="col-xs-3 pull-right">
		                    <a href="../user/" class="btn btn-default btn-sm">Cancelar</a>
		                    <?php //Validar los permisos para la Creacion de Modulos.
		                        if(in_array('1',$_SESSION['roles'])){
		                        ?>
		                        <input type="button" name="send" id="send" value="Guardar" class="btn btn-success btn-sm" />
		                        <?php
		                        }else{
		                        ?>
		                       <input type="button" name="send" id="send" value="Guardar" class="btn btn-success disabled btn-sm" onClick="return false" />
		                        <?php
		                        }
		                        ?>

		                    </div>

		        </form>
				</fieldset>
    </div><!--FINAL DEL CONTAINER-->
    <script>
		$('#radioBtn a').on('click', function(){
			var sel = $(this).data('title');
			var tog = $(this).data('toggle');
			if (sel == 1){
			$('#'+tog).prop( "checked", true );
			}else{
				$('#'+tog).prop( "checked", false );
			}

			$('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
			$('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
		});
		console.log(md5('123456'));

		$('#statusCheck').val('0');

		$("#SwitchProfile").on( 'change', function() {
			if( $(this).is(':checked') ) {
				// Hacer algo si el checkbox ha sido seleccionado
				$('#statusCheck').val('1');
			} else {
				// Hacer algo si el checkbox ha sido deseleccionado
				$('#statusCheck').val('0');
			}
		});

		$('input').addClass('input-sm');
		$('select').addClass('input-sm');

		$('#send').click(function(){
			var form = $('form[name=newUser]');
			var username = $('#login');
			var email = $('#email');
			var password = $('#password');
			var Name = $('#NameUsers');
			var Lastname = $('#LastnameUsers');
			var posc = $('posicion');
			var status = $('#status');
			var profile = $('profile');

			// Verifica que cada campo tenga un valor
			if ( Name.val() == '' || Lastname.val() == '' || username.val() == '' || email.val() == '' || password.val() == '' ||  posc.val() == '' ||
				status.val() == '' || profile.val() == '') {
				alert('Deberá brindar toda la información solicitada. Por favor, intente de nuevo');
				$(this).focus();
				return false;
			}
			// Verifica el nombre de usuario
			re = /^\w+$/;
			if(!re.test( username.val() )) {
				alert("El nombre de usuario deberá contener solo letras, números y guiones bajos. Por favor, inténtelo de nuevo");
				username.focus();
				return false;
			}
			// Verifica que la contraseña tenga la extensión correcta (mín. 6 caracteres)
			// La verificación se duplica a continuación, pero se incluye para que el
			// usuario tenga una guía más específica.
			if (password.val().length < 6) {
				alert('La contraseña deberá tener al menos 6 caracteres. Por favor, inténtelo de nuevo');
				password.focus();
				return false;
			}
			// Crea una entrada de elemento nuevo, esta será nuestro campo de contraseña con hash.
			var p = document.createElement("input");

			// Agrega el elemento nuevo a nuestro formulario.
			form.append(p);
			p.name = "p";
			p.type = "hidden";
			p.value = md5(password.val());

			// Asegúrate de que la contraseña en texto simple no se envíe.
			password.val('');

			//Finalmente enviamos el formulario.
			form.submit();
		});
	</script>
    </body>
</html>
