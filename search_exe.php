<?php
	require 'class/conex.php';
	require 'class/dbactions.php';
	require 'class/search.php';
	require 'class/productos.php';

	$objConex = new Connection();
	$con = $objConex->get_connected();

	$search = new Busqueda();
	$Ubicaciones = new Ubicaciones();
	$resultados = '';
	$num = '';

	if(!isset($_POST['id']) || $_POST['id'] == ''){
		$resultados .= "<tr><td colspan='10' class='danger text-center' style='width: 1150px'><b>ERROR!</b> Consulta invalida, campo vacio</td></tr>";
	}else{
	$rows = $search->search_by_arg($con, $_POST['id'], $_POST['AT']);
	//$filas = $rows->fetch_array(MYSQLI_BOTH);
	$num = $rows->num_rows;
	//echo "Registros encontrados: ".$num.'\n '.$filas['Designacion'];
	if ($num > 0) {
		$item = 0;	
		while ( $filas = $rows->fetch_array(MYSQLI_BOTH)) {
			$item++;	$i = 0;		$y=0;

			$stockMant = $search->stock_actual($con, $filas['id_prod'], '1');
			$stockSobMant = $search->stock_actual($con, $filas['id_prod'], '2');
			$ProdUbic = $search->ubic_single_prod($con, $filas['id']);

				$Ubic = $ProdUbic->fetch_array(MYSQLI_NUM);			
				//print_r($Ubic);
				//echo '<br>'.count($Ubic);			
				for($i = 0; $i < count($Ubic); $i++){
					$ubica = $Ubicaciones->single_ubic($con,$Ubic[$i]);
					$Ubc[$i] = $ubica->fetch_array(MYSQLI_NUM);
				}
				
				$ubica1 = ($Ubc[0][0] == null)? '' : $Ubc[0][0];
				$ubica2 = ($Ubc[1][0] == null)? '' : ' | '.$Ubc[1][0];
				$ubica3 = ($Ubc[2][0] == null)? '' : ' | '.$Ubc[2][0];
				$ubica4 = ($Ubc[3][0] == null)? '' : ' | '.$Ubc[3][0];	

			$cant01 = $stockMant->fetch_array(MYSQLI_NUM);
			$cant02 = $stockSobMant->fetch_array(MYSQLI_NUM);

				$cant1 = ($cant01[0] == null)? '0.00' : $cant01[0];
				$cant2 = ($cant02[0] == null)? '0.00' : $cant02[0];
			
			$resultados .= "<tr>
							<td style='width: 37px;'>{$item}</td>
							<td style='width: 361px;'>{$filas['designacion']}</td>
							<td style='width: 100px;'>{$filas['keyword']}</td>
							<td style='width: 122px;'>{$filas['ref']}</td>
							<td style='width: 129px;'>{$filas['SAP']}</td>
							<td style='width: 65px;'>{$filas['id_prod']}</td>
							<td style='width: 119px;'>{$ubica1}{$ubica2}{$ubica3}{$ubica4}</td>
							<td style='width: 95px;'>{$cant1}</td>
							<td style='width: 111px;'>{$cant2}</td>
							<td style='width: 109px;'>
								<a href='#' id='gallery'><i class='fa fa-picture-o'></i></a>
								<a href='move.php?id={$filas['id_prod']}' target='_blank' id='move'><i class='fa fa-arrows-alt' aria-hidden='true'></i></a>
								<a id='modKey'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
								<a href='#' id='trash' class='hidden'><i class='fa fa-trash-o'></i></a>
							</td>		
							</tr>";
			
		}
	}else{
		$resultados .= "<tr><td colspan='10' class='danger text-center' style='width: 1150px'>No existen registros con referencia: <b>{$_POST['id']}</b> </td></tr>";
	}
	mysqli_close($con);


	}

	echo $resultados;
?>