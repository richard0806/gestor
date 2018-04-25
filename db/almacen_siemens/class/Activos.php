<?php
$conex=mysql_connect('localhost','root', 'Asercomp01*')or die("Error de Conexion");
mysql_select_db("almacen_siemens");

$valor=$_GET['valor'];
if($valor!=""){
$re=mysql_query("SELECT * FROM activos_l1 WHERE Linea='$valor' ");
 echo '<select id="ubicacion" name="ubicacion">';
 echo '<option value="">Seleccionar...</option>';
 while($f=mysql_fetch_array($re)){
 	echo '<option value="'.$f['Ubicacion'].'">'.$f['Ubicacion'].'</option>';
 }
 echo '</select>';
}
else
{
	echo '<select id="ubicacion" name="ubicacion">';
	echo'<option value="">Seleccionar...</option>';
	echo '</select>';
};
?>