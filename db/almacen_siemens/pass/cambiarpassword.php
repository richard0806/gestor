<?php
require'../class/config.php';

$objcon = new Connection();
$objcon->get_connected();
?>
<?php 

$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$idusuario = $_POST['idusuario'];
$token = $_POST['token'];

if( $password1 != "" && $password2 != "" && $idusuario != "" && $token != "" ){
?>
<!DOCTYPE html>
<html lang="esp">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Restablecer contraseña </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../cssalmacen/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="../cssalmacen/Alert/sweet-alert.css">
     <style>
    .container1
	{
		margin:auto;
		width:100%;
		max-width:900px;
		box-sizing:border-box;
		padding:5px;
		top:500px;
		bottom:500px;
	}
	
	.alert{
    width: 300px;
    top: -75px;
    left: 0;
    color: #fff;
	text-shadow:none;
		width: 100%;
	}
	.alert-danger{
		background: rgb(228, 105, 105);
	}
	.alert-warning{
		background: #FFD900;
	}
	.alert-success{
		background: rgb(25, 204, 25);
	}
	.animated {
	  -webkit-animation-duration: 1s;
	  animation-duration: 1s;
	  -webkit-animation-fill-mode: both;
	  animation-fill-mode: both;
	}
	
	@-webkit-keyframes fadeInUp {
	  0% {
		opacity: 0;
		-webkit-transform: translateY(20px);
		transform: translateY(20px);
	  }
	
	  100% {
		opacity: 1;
		-webkit-transform: translateY(0);
		transform: translateY(0);
	  }
	}
	
	@keyframes fadeInUp {
	  0% {
		opacity: 0;
		-webkit-transform: translateY(20px);
		-ms-transform: translateY(20px);
		transform: translateY(20px);
	  }
	
	  100% {
		opacity: 1;
		-webkit-transform: translateY(0);
		-ms-transform: translateY(0);
		transform: translateY(0);
	  }
	}
	
	.fadeInUp {
	  -webkit-animation-name: fadeInUp;
	  animation-name: fadeInUp;
	}
    </style>
  </head>
  
  <body>
    <div class="container1">
    
<?php

	$sql = " SELECT * FROM tblreseteopass WHERE token = '".$token."' ";
		date_default_timezone_set("America/Santo_Domingo");
		$date = date("Y-m-d H:i:s");

	$resultado = mysql_query($sql);
	$count = mysql_num_rows($resultado);
	if($count > 0 ){
		$usuario = mysql_fetch_assoc($resultado);
		if( sha1( $usuario['idUsers'] === $idusuario ) ){
			if( $password1 === $password2 ){
				$sql = "UPDATE users SET passUsers = '".$password1."',  Date = '".$date."' WHERE idUsers = ".$usuario['idUsers'];
				$resultado = mysql_query($sql);
				if($resultado){
					$sql = "DELETE FROM tblreseteopass WHERE token = '".$token."'";
					$resultado = mysql_query( $sql );
				?>
                    <p class="alert alert-success animated fadeInUp"><img src="../cssalmacen/img/check.png" width="50"> La contraseña se actualizó con exito. Gracias por ser parte de nuestra familia, Siemens RD <a href="../index.php" class="pull-right">Iniciar Session</a> </p>
				<?php
				}
				else{
				?>
					<p class="alert alert-danger animated fadeInUp"> Ocurrió un error al actualizar la contraseña, intentalo más tarde </p>
				<?php
				}
			}
			else{
			?>
			<p class="alert alert-danger animated fadeInUp"> Las contraseñas no coinciden. Vuelva a intentarlo desde el link enviado a su <strong>correo</strong> </p>
			<?php
			}

		}
		else{
?>

<p class="alert alert-danger"> El token no es válido. <a href="../index.php">Reintentar Nuevamente</a> </p>
<?php
		}	
	}
	else{
		
?>

<p class="alert alert-danger"> El token no es válido. <a href="../index.php">Reintentar Nuevamente</a> </p>
<?php
	}
	?>
	</div> <!-- /container -->
	<script src="../jsalmacen/jquery-2.1.3.min.js"></script>
    <script src="../../bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>
    <script src="../jsalmacen/Alert/sweet-alert.js"></script>
   
  </body>
</html>
<?php
}
else{
	header('Location:../index.php');
}
?>