<?php
require'../class/config.php';

$objcon = new Connection();
$objcon->get_connected();
?>
<?php 
	$token = $_GET['token'];
	$idusuario = $_GET['idUsers'];

	$sql = "SELECT * FROM tblreseteopass WHERE token = '".$token."'";
	$resultado = mysql_query($sql);
	
	if( mysql_num_rows($resultado) > 0 ){
		$usuario = mysql_fetch_assoc($resultado);

		if( sha1($usuario['idUsers']) == $idusuario ){
?>
<!DOCTYPE html>
<html lang="es">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../cssalmacen/img/carrito.png">
    <meta name="author" content="RMsoluciones">
    <title> Restablecer contraseña </title>
    <link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../cssalmacen/sticky-footer.css">
    
     <style>
   
	footer {
		padding-right: 15px;
		padding-left: 50px;
		margin-right: auto;
		margin-left: auto;
		
	}
    </style>
  </head>

  <body>
  	<div class="container">
        <div class="row">
                <div class="col-sm-12">
                        <div class="page-header">
                            <h2>Restaurar contraseña</h2>
                        </div>
                </div>
        </div>
        <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
        <p class="text-center">Utilice el formulario de abajo para cambiar tu contraseña. La contraseña no puede ser el mismo que su nombre de usuario.</p>
        <form action="cambiarpassword.php" method="post" id="passwordForm">
        <input type="password" class="input-lg form-control" name="password1" id="password1" placeholder="Nueva contraseña" required autocomplete="off">
        <div class="row">
        <div class="col-sm-6">
        <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 8 a 15 caracteres de longitud<br>
        <span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Una Letra Mayuscula
        </div>
        <div class="col-sm-6">
        <span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Una letra minúscula<br>
        <span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Un número
        </div>
        </div>
<input type="password" class="input-lg form-control" name="password2" id="password2" placeholder="Confirmar contraseña" autocomplete="off">
<div class="row">
<div class="col-sm-12">
<span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Las Contraseñas Coinciden
</div>
</div>
<input type="hidden" name="token" value="<?php echo $token ?>">
<input type="hidden" name="idusuario" value="<?php echo $idusuario ?>">
<br>
<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Aplicando Cambios..." value="Recuperar contraseña">
</form>
</div><!--/col-sm-6-->
</div><!--/row-->
</div>
    
    <!--PIE DE PAGINA
    ==========================================-->
     <?php require'../global/pie_pagina.php';?>
	<!--===============FINAL===================-->

    <script src="../jsalmacen/jquery-2.1.3.min.js"></script>
    <script src="../../bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>
   	<script src="js/validatecaracter.js"></script>
  </body>
</html>
<?php
		}
		else{
			header('Location:../index.php');
		}
	}
	else{
		header('Location:../index.php');
	}
?>