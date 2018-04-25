<?php
$respuesta = $_POST['Op'];
if($respuesta == 'function'){
require'../class/config.php';

$objcon = new Connection();
$objcon->get_connected();


$consulta = mysql_query("SELECT * FROM crearproducto ORDER BY Id DESC");

	$rs = mysql_fetch_array($consulta);
		++$rs[7];
		 $datos = $rs[7];
		 echo $datos;
}

?>
