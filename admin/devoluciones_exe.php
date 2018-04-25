<?php
require'../global/security.php';

require'../class/productos.php';
require'../class/bitacora.php';

$respuesta="DONE";
//creación o instanciamiento de un objeto de la Clase Connection
	$objCon = new Connection();
	$con = $objCon->get_connected();

	$objProd = new Productos();
	$objBit = new Bitacora();

	$cadena = $_POST['fila'];

	if($cadena > 0 ){
		$contador = 0;
		/*
			INSERT INTO `tbl_salida`(`id`, `tsalida`, `id_at`, `ot`, `fecha`, us_crea, date_crea, us_modif, date_modif)...
		*/
		$queryExistS = "SELECT id FROM tbl_salida WHERE ot = '{$_POST['OT']}' LIMIT 1";
		$resultExistS =$con->query($queryExistS);
		$existS = $resultExistS->num_rows;

		if( $existS > 0){

			$queryExist = "SELECT id FROM tbl_devoluciones WHERE ot = '%{$_POST['OT']}%' LIMIT 1";
			$resultExist = mysqli_query($con,$queryExist);
			$exist = $resultExist->num_rows;

			if($exist > 0){
				$fetch_array = $resultExist->fetch_array(MYSQLI_NUM);
				$id = $fetch_array[0];
				//Recibimos el Array y lo decodificamos desde json, para poder utilizarlo como objeto
				$DATA 	= json_decode($_POST['data']);
				//print_r($DATA); die();
				//por cada uno de estos arrays vamos a crear una query para poder hacer un insert en la base de datos. y para eso necesitamos recorrer el array por cada uno de sus posiciones
				for ($i=0; $i < count($DATA); $i++) {

					// INSERT INTO `tbl_sdetalles`(`id`, `id_salida`, `id_prod`, `cantidad`, `id_alm`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5]);

					$q[$i] = "INSERT INTO tbl_ndetalles VALUES ('', '{$id}', '".$DATA[$i]->id."','".$DATA[$i]->cantidad."', '".$DATA[$i]->almacen."', '{$now}')";
					$insert = mysqli_query($con,$q[$i]);
					$objBit->movimientos($con, 'DEV', $_POST['OT'], $DATA[$i]->id, $DATA[$i]->cantidad, $_SESSION['iduser'], $now);
					$objProd->update_alm($con,$DATA[$i]->id,$DATA[$i]->almacen,'dev',$DATA[$i]->cantidad);
					$contador++;
				}
				if($cadena = $contador){
					$respuesta = 'DONE';
					$mensaje = $contador.' Registro/s guardado/s correctamente.';
				}else{
					$respuesta = 'BAD';
					$mensaje = 'ERROR, Procesando la solicitud';
				}
			}else{

				$query = "INSERT INTO tbl_devoluciones VALUES ('','{$_POST['AT']}','{$_POST['OT']}','{$_POST['fecha']}','{$_SESSION['iduser']}','{$now}','','')";
				$result = $con->query($query);
				$count = $con->affected_rows;
				$id = $con->insert_id;

				if($count > 0){
					//Recibimos el Array y lo decodificamos desde json, para poder utilizarlo como objeto
					$DATA 	= json_decode($_POST['data']);
					//print_r($DATA); die();
					//por cada uno de estos arrays vamos a crear una query para poder hacer un insert en la base de datos. y para eso necesitamos recorrer el array por cada uno de sus posiciones
					for ($i=0; $i < count($DATA); $i++) {

						// INSERT INTO `tbl_sdetalles`(`id`, `id_salida`, `id_prod`, `cantidad`, `id_alm`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5]);

						$q[$i] = "INSERT INTO tbl_ndetalles VALUES ('', '{$id}', '".$DATA[$i]->id."','".$DATA[$i]->cantidad."', '".$DATA[$i]->almacen."', '{$now}')";
						$insert = mysqli_query($con,$q[$i]);
						$objBit->movimientos($con, 'DEV', $_POST['OT'], $DATA[$i]->id, $DATA[$i]->cantidad, $_SESSION['iduser'], $now);
						$objProd->update_alm($con,$DATA[$i]->id,$DATA[$i]->almacen,'dev',$DATA[$i]->cantidad);
						$contador++;
					}
					if($cadena = $contador){
						$respuesta = 'DONE';
						$mensaje = $contador.' Registro/s guardado/s correctamente.';
					}else{
						$respuesta = 'BAD';
						$mensaje = 'ERROR, Procesando la solicitud';
					}

				}else{
					$respuesta = 'BAD';
					$mensaje = 'Lo sentimos, tuvimos un error al salvar '.$count.' registro/s.'.mysqli_error($con);
				}
			}
		}else{
			$respuesta = 'BAD';
			$mensaje = 'Lo sentimos, No existe una salida con esta Orden de Trabajo (OT). '.$existS;
		}
	}else{
		$respuesta = 'BAD';
		$mensaje = 'Lo sentimos, la cadena de datos esta vacia.';
	}

	$salidaJSON=array("respuesta" => $respuesta,"mensaje" => $mensaje, 'contador' =>$contador, 'fila'=>$cadena);
	echo json_encode($salidaJSON);
?>
