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

//Llamado de los archivos clase
require'../class/config.php';
require'../class/consulta.php';
require'../class/dbactions.php';
require'../global/constants.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

$objConsul = new Consult();

$id = $_POST['id'];
$Alm = $_POST['Alm'];

		if($_POST['Alm']!= "" && !empty($_POST['Alm'])){
			switch($_POST['Alm']){
				case '1':
					//realizamos la busqueda del usuario a modificar
					$query = mysql_query("SELECT * FROM consulta WHERE IdProducto = '".$id."' ");
					$num_rows = mysql_num_rows($query);
						if($num_rows > 0){
							if($row=mysql_fetch_array($query)){
								$item = $row['IdConsulta'];
								$descripcion = $row['Designacion'];
								$medida = $row['UnidadMedida'];
								$AT = $row['AT'];
								$SAP = $row['SAP'];
								$Ref = $row['Referencia'];
								$stock = $row['StockMant'];
								$ubicacion = $row['UbicacionPF'];
								$pertence = $row['Pertenece'];
								$paq = $row['Paquete'];
								$comm = $row['Comentario'];
								}
						}
				break;

				case '4':
					//realizamos la busqueda del usuario a modificar
					$query = mysql_query("SELECT * FROM sobmant WHERE IdProducto = '".$id."' ");
					$num_rows = mysql_num_rows($query);

					if($num_rows > 0){
						if($row=mysql_fetch_array($query)){
							$item = $row['IdSobMant'];
							$descripcion = $row['Designacion'];
							$medida = $row['UnidadMedida'];
							$AT = $row['AT'];
							$SAP = $row['SAP'];
							$Ref = $row['Referencia'];
							$stock = $row['Cantidad'];
							$ubicacion = $row['Ubicacion'];;
							$pertence = $row['Pertenece'];
							$paq = $row['Paquete'];
							$comm = $row['Comentario'];
							}
					}
				break;
			}
		}


$datos=array("Item"=> $item, "descripcion" => $descripcion ,"ubicacion" => $ubicacion, "undMedida" => $medida, "At" => $AT, "sap" => $SAP,"pertenece" => $pertence, "Ref" => $Ref, "stock" => $stock, "paq" => $paq, "comm" => $comm);
echo json_encode($datos);
?>
