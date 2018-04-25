	<?php
require'../class/config.php';

$objcon = new Connection();
$objcon->get_connected();
	

?>
<?php
header('Content-Type: text/html; charset=UTF-8'); 
	function generarLinkTemporal($idusuario, $username){

		$cadena = $idusuario.$username.rand(1,9999999).date('Y-m-d');
		$token = sha1($cadena);	
		
		$sql = "INSERT INTO tblreseteopass (idUsers, loginUsers, token, creado) VALUES($idusuario,'$username','$token',NOW());";
			

		$resultado = mysql_query($sql);
		if($resultado){
			$enlace = 'http://'.$_SERVER["SERVER_NAME"].':8080/almacen_siemens/pass/restablecer.php?idUsers='.sha1($idusuario).'&token='.$token;
			return $enlace;
		}
		else{
			return FALSE;
		}
			
	}

	function enviarEmail($user, $email, $link ){
		
		$asunto  = html_entity_decode("Cómo restablecer la contraseña del Gestor Siemens RD.‏");
		$mensaje = '<html>
		<head>
			<title>Restablece tu contraseña</title>
			<style>
			body{
				 font: 300 14px/18px "Lucida Grande", Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif;
				  color: #333;
			}
			
			footer{
				font: 11px/15px Geneva, Verdana, Arial, Helvetica, sans-serif;
  				color: #888;
			}
			</style>
		</head>
		<body>
			
			<p>Estimado/a '.$user.':</p>
			<br>
			
 			<p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.
 			Para completar el proceso, haz clic en este enlace:</p>
			
			<br>			
 			<p><a href='.$link.' class="">Recuperar Contraseña</a></p>
			<br>
			
			<p>Este enlace expirará 1 hora después de que se haya enviado este correo.</p>
			
 			<p>Si no realizaste esta solicitud, es probable que otro usuario haya ingresado tu dirección de correo electrónico por error y tu cuenta siga protegida. Si crees que una persona no autorizada accedió a tu cuenta, debes restablecer tu contraseña en <a href="http://webalmacensiemens.servehttp.com/almacen_siemens">Gestor Siemens RD</a></p>
			<p>Atentamente,</p>
			<br>
			<p>Soporte Gestor Siemens RD</p>
			<br>
			
     		<img id="ecxfooter-gradient" src="https://statici.icloud.com/emailimages/v4/common/footer_gradient_web.png" style="display:block;width:100%;" height="16">
			 <footer>
				<p>Copyright &copy;  2014 Siemens RD. Todos los Derechos Reservados - Diseños y Más.
					  <a href="../../RMsoluciones.php">RM Soluciones</a></p>
			  </footer>
			
			</body>
		</html>';

		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$cabeceras .= 'From: Gestor de Mantenimiento Siemens RD<siemensalmacen@gmail.com>' . "\r\n";
		$cabeceras .= 'X-Mailer: PHP/' . phpversion();
		
		mail($email, '=?UTF-8?B?'.base64_encode($asunto).'?=', $mensaje, $cabeceras);
	}
	
	$email = $_POST['email'];
	$respuesta = new stdClass();

	if( $email != "" ){
   		$sql = " SELECT * FROM users WHERE emailUser = '$email' AND statusUsers = 'Enabled' ";
   		$resultado = mysql_query($sql);
				
   		if(mysql_num_rows($resultado) > 0){
      		$usuario = mysql_fetch_assoc($resultado);
				
				$sql1 = "SELECT * FROM tblreseteopass WHERE idUsers = ".$usuario['idUsers']." ";
				$consulta = mysql_query($sql1);				
				$count = mysql_num_rows($consulta);				
				if($count == 0){
					$linkTemporal = generarLinkTemporal( $usuario['idUsers'], $usuario['loginUsers'] );
					if($linkTemporal){
						enviarEmail($usuario['loginUsers'],$email, $linkTemporal );
						$respuesta->mensaje = '<div class="notice notice-success animated fadeInUp">
						<strong>Notice:</strong> Te enviamos un correo electrónico con las instrucciones para escoger una nueva contraseña.</div>';
					}
				}else{
					
					$respuesta->mensaje= '<div class="notice notice-danger animated fadeInUp">
					<strong>Notice:</strong> Este usuario ya está registrado. </div>';	
				}
   		}
   		else
   			$respuesta->mensaje = '<div class="notice notice-warning animated fadeInUp"> 
		 <strong>Notice:</strong> No existe una cuenta asociada a ese correo <b>'.$email.'</b> o la cuenta se encuentra desactivada, favor de ponerse en contacto con el administrador del sistema.</div>';
	}
	else
   		$respuesta->mensaje= '<div class="notice notice-danger animated fadeInUp">
		<strong>Notice:</strong> Debes introducir el email de la cuenta</div>';
		
 	echo json_encode( $respuesta );
?>