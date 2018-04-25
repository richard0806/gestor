<?php
require'class/config.php';
require'class/dbactions.php';
require'class/Pmenu.php';
require'global/constants.php';

$objcon = new Connection();
$objcon->get_connected();

	$query = "UPDATE consulta SET StockMant = 18 WHERE IdProducto = '4997'";
		mysql_query($query);
		if(mysql_affected_rows() > 0){
			echo 'Registro  Actualizado';	
		}else{
			echo 'Error';
		}
