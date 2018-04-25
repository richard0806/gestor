<?php 
	$mensaje = ''; 

	$err = isset($_GET['error']) ? $_GET['error'] : null ;
	if(isset($_GET['error']) ){
		$mensaje = 'Error, Intentaste acceder sin iniciar session.';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="icon" href="css/image/icon.png">
	<title>Sign in | Gestor Mant.</title>
	<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/signin.css">
</head>
<body>	
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="col-sm-6">
					<div class="col-md-12">
						<h2>WELCOME <br>GESTOR MANTENIMIENTO</h2>
						<h5>Sistema de Gestion de Almacen Siemens - OPRET</h5>
						<!--br>
						<h5 class="new-account">NEW HERE?</h5>
						<a href="sign_up.php" class="btn btn-default btn-signup">SIGN UP USERS</a>
						<a href="admin/sign_up.php" class="btn btn-default btn-signup">SIGN UP ADMIN</a-->

						<?php
               				if($mensaje != ''){?>
               				<br><br>
               				<p class="text-center" style="color: #000; text-shadow: 0 0 4px #c70000; font-weight: 800;font-size: 20px;"><?= $mensaje ?></p>
               			<?php } ?>
					</div>

				</div>
				<div class="home1">
					<a href="index.php"><i class="fa fa-home fa-2x" aria-hidden="true"></i></a>
				</div>
				<div class="col-sm-5" style="padding:30px;">							
					<div class="col-md-10 form-login">						
						<h2>Sign in</h2>

						<div id="loader" style="display: none; text-align: center;height: 150px;">
				    		<div class="dot"></div>
							<div class="dot"></div>
							<div class="dot"></div>
							<div class="dot"></div>
							<div class="dot"></div>
							<div class="dot"></div>
							<div class="dot"></div>
							<div class="dot"></div>
							<div class="lading"></div>
						</div>
						<form action="session_init.php" class="form-horizontal tab-pane active" method="post" id="form-signin">
							<div class="form-group">
								<i class="fa fa-user fa-2x" aria-hidden="true"></i>
               					<input type="text" class="form-control" id="txtUsuario" name="txtUsuario" placeholder="Usuario" autofocus>
               				</div>
               				<div class="form-group">
               					<i class="fa fa-unlock-alt fa-2x" aria-hidden="true"></i>
               					<input type="password" class="form-control" id="txtClave" name="txtClave" placeholder="Contraseña" autofocus>
               					
               				</div>

               				<p class="text-right" style="padding-right: 10px;"><a href="#" class="linked">Olvidaste tu contraseña?</a></p><br>
               				<button type="submit" class="btn btn-lg btn-sm btn-default btn-block">Sign In</button>
               				<p class="text-error text-center" ></p>
						</form>
						
					</div>					
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#form-signin').submit(function(event) {
				$(this).hide('slow');
				$('#loader').show('slow');
			});
		});
	</script>
</body>
</html>