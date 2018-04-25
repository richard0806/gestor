<?php
require'../class/config.php';

$objcon = new Connection();
$objcon->get_connected();

//$query=mysql_query("SELECT * FROM users WHERE loginUsers = '".$user."'");
//$resultado=mysql_fetch_array($query);
	//$IdUser = $resultado['idUsers'];

$salida='';
$fechaMin = $_POST['inicio'];
$fechaMax = $_POST['final'];
$rango ="SELECT * FROM detalle_salida WHERE Date >='".$fechaMin."' AND Date <='".$fechaMax." 24:00:00'";
	$consulta = mysql_query($rango)or die ("Fallo en la consulta");

	$count = mysql_num_rows($consulta);

	if($count > 0){
		$item = 0;
		while($row = mysql_fetch_array($consulta)){
			++$item	;
			echo'<tr>
						<td>'.$item.'</td>
						<td>'.$row['OtSalida'].'</td>
						<td>'.$row['Designacion'].'</td>
						<td>'.$row['Referencia'].'</td>
						<td>'.$row['IdProducto'].'</td>
						<td>'.$row['Medida'].'</td>
						<td>'.$row['Cantidad'].'</td>
						<td>'.$row['Date'].'</td>
						</tr>

			';
		}
	}else{
		echo'<tr><td colspan="8" class="alert alert-danger" style="text-align:center;">No Existen registros durante estas fechas.</td></tr>';
	}
?>
