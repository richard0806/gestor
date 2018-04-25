<?php
$at = $_POST["At"];
$desc = $_POST["Descripcion"];
$ref = $_POST["Ref"];
$sap = $_POST["SAP"];
$id = $_POST["id_producto"];
$exit = $_POST['Stock'] + $_POST["cantidad"];
$udM = $_POST["UdMedida"];
$cantidad = $_POST["cantidad"];
$ubi = $_POST["Ubicacion"];
$user = $_POST["username"];
$alm = $_POST["Almacen32"];
$pert = $_POST["check_list"];
$paq = $_POST["tipopaquete"];
$comm = $_POST["comentario"];
date_default_timezone_set("America/Santo_Domingo");
$date = date("Y-m-d h:i:s");

$respuesta = new stdClass();

$conexion = new mysqli('localhost', 'root', 'Asercomp01*', 'siemens_sql');

		//En esta seccion insertamos la entrada de producto existente!!!
		$sql = "INSERT INTO entrada VALUES('', '$at', '$desc','$ref', '$sap','$id','$udM',$cantidad,'$ubi', $user, '$alm', '$pert', '$paq', '$comm', '$date')";
			$resultado = $conexion->query($sql);

			if($resultado){
				$respuesta->answer = 'SI';
				$respuesta->mensaje = '<div class="alert alert-info"> El producto ha sido <b>Modificado</b> correctamente </div>';

      		}
			else{
				$respuesta->answer = 'NO';
				$respuesta->mensaje = '<div class="alert alert-warning"> Error al <b>Modificar</b> el Registro. <b>Revise</b> los datos e intente nuevamente. </div>';

			}
	echo json_encode( $respuesta );
?>
