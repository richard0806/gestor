<?php

require'../class/sessions.php';
$objses = new Sessions();
$objses->init();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){ // comprobamos que la sesión esté iniciada
	 header('Location: http://'.$_SERVER["HTTP_HOST"].'/almacen_siemens/?error=2');
}

?>
<?php
require'../class/config.php';

$objcon = new Connection();
$con = $objcon->get_connected();

$query=$con->query("SELECT * FROM users WHERE loginUsers = '".$user."'");
	$resultado=$query->fetch_array(MYSQLI_ASSOC);
	$IdUser = $resultado['idUsers'];
?>
<!DOCTYPE html>
<html lang="es">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../css/img/carrito.png">
    <meta name="author" content="RMsoluciones">
    <title> Rectificar Contraseña </title>
    <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" type="text/css" href="../css/sticky-footer.css">
    <link rel="stylesheet" type="text/css" href="../css/Alert/sweet-alert.css">
    
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
                            <h2>Cambio de contraseña</h2>
                        </div>
                </div>
        </div>
        <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
        <p class="text-center">Utilice el formulario de abajo para cambiar tu contraseña. La contraseña no puede ser el mismo que su nombre de usuario.</p>
    <form  method="post" id="passwordForm">
        <input type="password" class="input-sm form-control" name="passwordAnt" id="passwordAnt" placeholder="Contraseña Anterior" required autocomplete="off">
        <p align="center">Asegurese de que la nueva contraseña sea más segura que la anterior.</p>
        <input type="password" class="input-sm form-control" name="password1" id="password1" placeholder="Nueva contraseña" required autocomplete="off">
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
<input type="password" class="input-sm form-control" name="password2" id="password2" placeholder="Confirmar contraseña" autocomplete="off">
<div class="row">
<div class="col-sm-12">
<span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Las Contraseñas Coinciden
</div>
</div>
<input type="hidden" name="idusuario" id="idUser" value="<?php echo $IdUser ?>">
<br>
<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-sm" data-loading-text="Aplicando Cambios..." value="Aplicar Cambios">
</form>
</div><!--/col-sm-6-->
</div><!--/row-->
</div>
    
    <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script> 
    <script type="text/javascript" src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="../js/newpass.js"></script>
    <script src="../js/Alert/sweet-alert.js"></script>
  </body>
</html>
