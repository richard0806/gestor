<?php

$conexion = mysql_connect('localhost','root','Asercomp01*');
$bd = mysql_select_db('siemens_sql',$conexion)or die ("Error, no se pudó conectar a la base de datos");

$consulta = mysql_query("SELECT * FROM crearproducto ORDER BY Id DESC");
	
	$rs = mysql_fetch_array($consulta);
	++$rs[7];
	echo $rs[7];
?>
