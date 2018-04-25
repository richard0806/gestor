<?php
	require 'class/conex.php';
	require 'class/dbactions.php';
	require 'class/productos.php';

	$objConex = new Connection();
	$con = $objConex->get_connected();

	$objProd = new Productos();

	$respuesta = '';
	$mensaje = '';
	$id = $_POST['txtID'];
	$valor = $_POST['txtkeyword'];
	if($id == ''){
		$respuesta = "BAD";
		$mensaje = 'Error, el campo ID no puede estar vacio.';
	}else if($valor == ''){
		$respuesta = "BAD";
		$mensaje = '<p>Error, el campo KeyWord no puede estar vacio.</p>';
	}else{
		$objProd->update_keyword($con, $id, $valor);

		if($con->affected_rows > 0){
			$respuesta = 'DONE';
			$mensaje = '<p>Registro actualizado correctamente</p>';
		}else{
			$respuesta = "BAD";
			$mensaje = '<p>Error en el proceso: '+ mysqli_error() +'</p>';
		}
	}


	mysqli_close($con);

	$salida = array('respuesta'=>$respuesta, 'mensaje'=>$mensaje);
	echo json_encode($salida);

	?>
