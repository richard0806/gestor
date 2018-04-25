<?php
	require 'class/conex.php';
	require 'class/dbactions.php';
	require 'class/productos.php';
	require 'class/search.php';

	$objConex = new Connection();
	$con = $objConex->get_connected();

	$objProd = new Productos();
	$single = $objProd->single_prod($con, $_GET['id']);

	$move = $objProd->move_prod($con, $_GET['id']);

	$search = new Busqueda();
	$stockMant = $search->stock_actual($con, $_GET['id'], '1');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Movimientos | Gestor Mant.</title>
	<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">
</head>
<body>
	<div class="container">
		<?php
			$list = $single->fetch_array(MYSQLI_BOTH);
			$name = $list[0];
			$ref = $list[1];
			$Stock1 = $stockMant->fetch_array(MYSQLI_BOTH);
			$cant = $Stock1[0];
		?>
		<h3 style="margin-bottom: 0px;">Name: <?=$name ?></h3>
		<h4 style="margin-top: 0px;">Ref.: <?= $ref ?><br/>ID: <?= $_GET['id']?> <br/> stock: <?= $cant?></h4>
		<table class="table table-hover table-striped">
			<thead style="background: #1a4a72; color: #fff;">
				<th>Item</th>
				<th>Tipo</th>
				<th>Orden de Trab.</th>
				<th>Fecha</th>
				<th>Cantidad</th>
				<th></th>
			</thead>
			<tbody>
				<?php
					$num = $move->num_rows;
					if ($num > 0) {
						$item = 0;
						while ($row = $move->fetch_array(MYSQLI_NUM)) {
							$item++;

							echo"
								<tr>
								<td>{$item}</td>
								<td>{$row[0]}</td>
								<td><a href='#' class='popups'>{$row[1]}</a></td>
								<td>{$row[3]}</td>
								<td>{$row[2]}</td>
								<td></td>
								</tr>
							";
						}
					}else{
						echo'<tr><td colspan="5" class="danger text-center">No existen movimientos para este producto.</td></tr>';
					}
				?>
			</tbody>
		</table>
	</div>
<!--SCRIPT-->
<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
<script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/search.js"></script>
<script>
$(document).ready(function(){


  function Reprint(doc,tipo){
		caracteristicas = "width=1000,height=450,top=100,left=200,scrollTo,resizable=1,scrollbars=1,location=0";
    switch (tipo) {
      case "SAL":
          link = 'admin/print-salida.php?ot='+doc;
					popUp = window.open (link,"Ventana_Salida",caracteristicas);
        break;
        case "DEV":
            link = 'admin/print-devolucion.php?ot='+doc;
						popUp = window.open (link,"Ventana_Devolucion",caracteristicas);
          break;
					case "ENT":
	            link = 'admin/print-entrada.php?ot='+doc;
							popUp = window.open (link,"Ventana_Entradas",caracteristicas);

	          break;
    }
  }


		$('a.popups').on('click',function(e){
	      e.preventDefault();
	          tipoPrint = $(this).parents("tr").find("td").eq(1).text(); //$(this).find('td').eq(1).text();
	          docPrint = $(this).parents("tr").find("td").eq(2).text(); //$(this).find('td').eq(2).text();
						Reprint(docPrint,tipoPrint);
						if (popUp == null || typeof(popUp)=='undefined') {
						    alert('Por favor deshabilita el bloqueador de ventanas emergentes y vuelve a hacer clic para ver el Archivo.');
								return false;
						}else{
								popUp;
						}
		})
})

</script>
</body>
</html>
