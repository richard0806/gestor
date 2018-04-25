<?php
require'../class/sessions.php';
$objses = new Sessions();
$objses->init();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
	header('Location: http://'.$_SERVER["SERVER_NAME"].':8080/almacen_siemens/index.php?error=2');
}

?>
<?php

require'../class/config.php';

$objcon = new Connection();
$objcon->get_connected();

$respuesta = 'NO';

date_default_timezone_set("America/Santo_Domingo");
	$date = date("Y") . "-" . date("m") . "-" . date("d");

	$sql = mysql_query("INSERT INTO transferencia VALUES ('','".$_POST['username']."','".$_POST['Almacen1']."', '".$_POST['Almacen2']."','".$_POST['id_producto']."','".$_POST['cantidad']."','".$_POST['Medida']."','".$date."')");


	if($_POST['Almacen1'] != "" && !empty($_POST['Almacen1'])){
		switch($_POST['Almacen1']){
			case '1':
				$almacen1 = 'consulta';
				$stock1 = 'StockMant';
				$query = mysql_query("UPDATE $almacen1 SET $stock1 = '".$_POST['Stock1']."' - '".$_POST['cantidad']."'  WHERE IdProducto = '".$_POST['id_producto']."' ");

			if(mysql_affected_rows()>0){
				switch($_POST['Almacen2']){
					case '4':
					$modify = mysql_query("UPDATE sobmant SET Cantidad ='".$_POST['Stock2']."' + '".$_POST['cantidad']."'  WHERE IdProducto = '".$_POST['id_producto']."' ");
					break;
				}
				$respuesta = 'YES';//echo 'YES';
			}else{
				$respuesta = 'NO';
			}//final del affected.

			break;

			case '4':
				$almacen1 = 'sobmant';
				$stock1 = 'Cantidad';
				$query = mysql_query("UPDATE $almacen1 SET $stock1 = '".$_POST['Stock1']."' - '".$_POST['cantidad']."'  WHERE IdProducto = '".$_POST['id_producto']."' ");
				if(mysql_affected_rows()>0){
					switch($_POST['Almacen2']){
					case '1':
						$modify = mysql_query("UPDATE consulta SET StockMant ='".$_POST['Stock2']."' + '".$_POST['cantidad']."'  WHERE IdProducto = '".$_POST['id_producto']."' ");
						break;
					}
					$respuesta = 'YES';
				}else{
					$respuesta = 'NO';
				}//final del affected.

		}//final primer switch
	}else{
		$respuesta = 'NO';
	}


$datos=array("respuesta" => $respuesta);
echo json_encode($datos);




?>
