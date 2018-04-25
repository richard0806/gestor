<?php
	require 'class/conex.php';
	require 'class/dbactions.php';
	require 'class/gallery.php';

	$objConex = new Connection();
	$con = $objConex->get_connected();

	$images = new Galleries();
	$resultados = '';

	$rows = $images->list_gallery($con, $_POST['id']);
	//$filas = $rows->fetch_array(MYSQLI_BOTH);
	$num = $rows->num_rows;
	//echo "Registros encontrados: ".$num.'\n ';
	$URL = 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].'/gestor/'; 
	if ($num > 0) {
		$resultados .= '<div class="w3-content" style="width:800px; max-height: 450px;">';
		while ( $filas = $rows->fetch_array(MYSQLI_ASSOC)) {			
			$resultados .= "<img class='mySlides' src='{$URL}css/foto_prod/{$filas["image"]}' style='width:100% ;display:block;'>";
		}
		$resultados .= '</div>
						<div class="w3-center">
						  <div class="w3-section">
						    <button class="w3-button w3-light-grey" onclick="plusDivs(-1)">❮ Prev</button>
						    <button class="w3-button w3-light-grey" onclick="plusDivs(1)">Next ❯</button>
						  </div>
						</div>';

	}else{
		$resultados .= "<h3 style='text-align: center; color: #fff; text-transform: uppercase;'>Este item no tiene fotos</h3>";
	}
	mysqli_close($con);

	echo $resultados;
?>