<?php 
	require '../global/security.php';
	require '../class/productos.php';

	//creación o instanciamiento de un objeto de la Clase Connection
	$objCon = new Connection();
	$con = $objCon->get_connected();

	$objProd = new Productos();
	$idAlm = $_POST['almacen'];
	$respuesta = '';
	$mensaje='';
	$descripcion = '';
	$ref = '';
	$sap = '';
	$medida='';
	$cantidad = '';
	$idOpret = '';

	if(!isset($_POST['func'])){		

		
		$salida = '';
		$items = 1;

		$listProd = $objProd->list_prod($con,$idAlm);

		if($listProd->num_rows > 0){
			while($rows = $listProd->fetch_array(MYSQLI_BOTH)){
				if($rows['id_opret'] == null || $rows['id_opret'] == ''){
					$IdOp = '';
				}else{
					$IdOp = '('.$rows["id_opret"].')';
				}
				$salida .="	<tr>
								<td>{$items}</td>
								<td>{$rows['id_prod']}</td>
								<td>{$rows['designacion']} $IdOp</td>
								<td>{$rows['ref']}</td>
								<td>{$rows['SAP']}</td>
							</tr>"; 
							$items++;
			}
		}
		else
		{
			$salida .= '<tr class="danger text-center"><td colspan="5" style="color:red"><i class="fa fa-ban" aria-hidden="true"></i> No Existen registros en este almacén</td></tr>';
		}
		echo $salida;
		$con->close();
	}else{

		$id = $_POST['id'];

		$single = $objProd->single_prod($con, $id);
			$numSingle = $single->num_rows;
			if($numSingle > 0){
				$cant = $objProd->stock_actual($con, $id, $idAlm);
				$numCant = $cant->num_rows;
				if($numCant > 0){
					while($rows = $cant->fetch_array(MYSQLI_ASSOC)){
						$cantidad = $rows['cantidad'];
					}
				}else{
					$cantidad = 0;
				}
				while($row = $single->fetch_array(MYSQLI_ASSOC)){
					$descripcion = $row['designacion'];
					$idOpret = $row['id_opret'];
					$ref = $row['ref'];
					$sap = $row['SAP'];
					$medida = $row['medida'];					
				}
				$respuesta = 'DONE';
				$mensaje='';			
			}else{
				$respuesta = 'BAD';
				$mensaje = "<p>Este producto con el ID: {$id} no existe</p>";	
			}
		
		$con->close();
		$salida = array('respuesta'=>$respuesta, 'mensaje'=>$mensaje, 'descripcion'=>$descripcion, 'ref'=>$ref, 'sap'=>$sap, 'stock'=>$cantidad, 'medida'=>$medida, 'idOpret'=> $idOpret);
		echo json_encode($salida);
	}	
	
?>