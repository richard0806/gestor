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


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

$id = $_POST['id'];
//$Alm = $_POST['Alm'];
//$Alm2 = $_POST['Alm2'];

if($_POST != "" && !empty($_POST )){
	switch($_POST['Alm']){
		case '1':
			$query = mysql_query("SELECT * FROM consulta WHERE IdProducto = '".$id."' ");
			switch($_POST['Alm2']){
				case '4':
					$num_rows = mysql_num_rows($query);
					if($num_rows > 0){
						if($row=mysql_fetch_array($query)){
							$descripcion = $row['Designacion'];
							$SAP = $row['SAP'];
							$Ref = $row['Referencia'];
							$stock = $row['StockMant'];
							$medida= $row['UnidadMedida'];
								$sql = mysql_query("SELECT * FROM sobmant WHERE IdProducto = '".$id."' ");
								$num_row = mysql_num_rows($sql);
								if($num_row > 0){
									if($rows=mysql_fetch_array($sql)){
										$stock1 = $rows['Cantidad'];
									}//final de fetch array
								}//final de $num_row.
								else{
										$stock1 = 0;
									}
							}//final de fetch array
					}//final del $num_rows.
					break;
			}//final del segundo switch
			break;

			case '4':
			$query = mysql_query("SELECT * FROM sobmant WHERE IdProducto = '".$id."' ");
			switch($_POST['Alm2']){
				case '1':
					$num_rows = mysql_num_rows($query);
					if($num_rows > 0){
						if($row=mysql_fetch_array($query)){
							$descripcion = $row['Designacion'];
							$SAP = $row['SAP'];
							$Ref = $row['Referencia'];
							$stock = $row['Cantidad'];
							$medida= $row['UnidadMedida'];
								$sql = mysql_query("SELECT * FROM consulta WHERE IdProducto = '".$id."' ");
								$num_row = mysql_num_rows($sql);
								if($num_row > 0){
									if($rows=mysql_fetch_array($sql)){
										$stock1 = $rows['StockMant'];
									}//final de fetch array
								}//final de $num_row.
								else{
										$stock1 = 0;
									}
							}//final de fetch array
					}//final del $num_rows.
					break;
			}//final del segundo switch
			break;
	}//final del primer switch
}//final del if validate.




$datos=array("descripcion" => $descripcion , "sap" => $SAP,  "Ref" => $Ref, "stock" => $stock,  "sobmant" => $stock1, 'medida' => $medida);
echo json_encode($datos);
?>
