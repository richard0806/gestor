<?php

require'../class/sessions.php';
$objses = new Sessions();
$objses->init();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){ // comprobamos que la sesión esté iniciada
	 header('Location: http://'.$_SERVER["SERVER_NAME"].':8080/almacen_siemens/index.php?error=2');
}

?>
<?php
require'../class/config.php';

$objcon = new Connection();
$con = $objcon->get_connected();

$respuesta = '';
$mensaje = '';
$exist = '';
				
			$query = mysqli_query($con,"SELECT passUsers FROM users WHERE idUsers = '{$_POST["idusuario"]}' LIMIT 1");
			$count = $query->num_rows;
			if($count > 0){
				//print_r($query);
				$clave = md5($_POST['password2']);
				$exist = $query->fetch_array(MYSQLI_NUM);
				//print_r($exist);
				//echo($clave);
				if($exist[0] == md5($_POST['passwordAnt'])){
					$sql = $con->query("UPDATE users SET passUsers ='".$clave."', Date = '".date("Y-m-d H:i:s")."' WHERE idUsers ='".$_POST['idusuario']."'");
					if($con->affected_rows > 0) {
					$respuesta = "listo";
					$mensaje = 'Registro actualizado satisfactoriamente. Gracias!';
					}else {
						$respuesta = "error3";
						$mensaje = 'La actualizacion de la contraseña no fue exitosa, intentelo mas tarde.';
						//No se pudo cambiar la contraseña. <a href='javascript:history.back();'>Reintentar</a>";
					}
				}else{
					$respuesta = 'error2';
					$mensaje = 'La contraseña anterior no coincide con la obtenida de la Base de Datos.';
				}				
			}else{
				$respuesta = 'error1';
				$mensaje = 'No existe ningun registro con este Id de Usuario.';
			}
			
$salidaJSON=array("respuesta" => $respuesta,"mensaje" => $mensaje);
echo json_encode($salidaJSON);

             
?>