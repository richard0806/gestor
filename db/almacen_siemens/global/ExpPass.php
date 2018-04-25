<?php

require'../class/sessions.php';
$objses = new Sessions();
			
require'../class/config.php';
$objcon = new Connection();
$objcon->get_connected();

//Modificamos los datos de la tabla users!!!
		$query = "UPDATE users SET statusUsers = 'Disabled'	WHERE idUsers = '".$_GET["idUsers"]."' ";
		$update = mysql_query($query);
		
		if(mysql_affected_rows() > 0){			
			$objses->init();
			
			$objses->destroy();
			
			header('Location: http://'.$_SERVER["SERVER_NAME"].':8080/almacen_siemens');
		}
?>