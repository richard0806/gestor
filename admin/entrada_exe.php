<?php 

$respuesta="DONE";				
require'../class/config.php';

$objcon = new Connection();
$objcon->get_connected();
			
		//variable fecha de creacion
				date_default_timezone_set("America/Santo_Domingo");
				$date = date("Y-m-d H:i:s");	
				
				
				$sql = mysql_query("INSERT INTO cod_entrada (IdFactura,EntregaAlmacen,EntregaOpret, idUsers, DateEntrada,Observaciones) VALUES ('".$_POST['factura']."','".$_POST['entregaAlmacen']."','".$_POST['entregaOpret']."','".$_POST['username']."','".$date."','".$_POST['observaciones']."' )");		
				
				//('54432', '03/27/2015 1:47 PM', '03/27/2015 1:47 PM', '4', '03/27/2015 1:47 PM')

		
				//consulta para obtener el id general
				$consulta = mysql_query("SELECT * FROM cod_entrada WHERE IdFactura = '".$_POST['factura']."'");
				$row = mysql_fetch_array($consulta);
				$id = $row['idCodEntrada'];
								
				//insercion de datos detalle de salida
				$Insert = "INSERT INTO detalle_entrada 
				(idCodEntrada, IdFactura, ITem, Designacion, Referencia, IdProducto, Medida, Cantidad, Observaciones, Date) 
				VALUES ('".$id."', '".$_POST['factura']."', '".$_POST['Item']."','".$_POST['Descripcion']."', '".$_POST['Referencia']."', '".$_POST['Id']."', '".$_POST['medida']."', '".$_POST['cantidad']."', '".$_POST['comentario']."', '".$date."')";
				$Insert2 = mysql_query($Insert);
				//('7', '54432344534', '34', 'Abrazadera con gancho tubo 42', '8WL2148-5', '1224', 'Ud', '1', 'Prueba', '2015-03-27 00:00:00')

				$movimiento = "INSERT INTO movimientos VALUES 
					('', 'ENT', '".$_POST['factura']."', '".$_POST['Id']."', '".$_POST['Descripcion']."', '".$_POST['cantidad']."', '".$_POST['username']."','".$date."')";
					mysql_query($movimiento);

			if(mysql_affected_rows()>0){
				if($_POST['almacen']!= "" && !empty($_POST['almacen'])){					
					switch($_POST['almacen']){
						case '1':
						$query ="UPDATE consulta SET StockMant = ".$_POST['stock']." + ".$_POST['cantidad']." WHERE IdProducto ='".$_POST['Id']."' ";
						$introd = mysql_query($query);
						
						if(mysql_affected_rows()>0){
							$respuesta="DONE";
							$mensaje='Registros guardados correctamente.';					
						}
						else{
							$respuesta ="BAD";
							$mensaje='<strong>Error:</strong> No se ejecuto la introduccion de datos(1).';
						}
						break;
						case '4':
						$query = "UPDATE sobmant SET Cantidad = ".$_POST['stock']." + ".$_POST['cantidad']." WHERE IdProducto =".$_POST['Id'];
						$introd = mysql_query($query);
						if(mysql_affected_rows()>0){
							$respuesta="DONE";
							$mensaje='Registros guardados correctamente.';					
						}
						else{
							$respuesta ="BAD";
							$mensaje='<strong>Error:</strong> No se ejecuto la introduccion de datos(2).';
						}
						break;
					}//final de switch

					

					
				}
				else{
			
				$respuesta ="BAD";
				$mensaje='<strong>Error:</strong> No se ejecuto la introduccion de datos(4).</div>';
				}//final del if de validar que el campo almacen no este vacio
					
				
			}else{
			
				$respuesta ="BAD";
				$mensaje='<strong>Error:</strong> No se ejecuto la introduccion de datos(0).</div>';
			}//final del if(mysql_affected_rows()(1)
		
		
		
		
	$salidaJSON=array("respuesta" => $respuesta,"mensaje" => $mensaje);
	echo json_encode($salidaJSON);
?>