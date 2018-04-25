<?php

require'../class/sessions.php';
$objses = new Sessions();
$objses->init();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
	header('Location: http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].'/almacen_siemens/index.php?error=2');
}

?>
<?php
//Llamado de los archivos clase
require'../class/config.php';
require'../global/constants.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();


?>
<!doctype html>
<html>	
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gestor de Mantenimiento Siemens MSD">
    <meta name="author" content="RMSoluciones">
    <link rel="icon" href="cssalmacen/img/carrito.png">
		<title>Comprobante de Salida-Almacen Siemens </title>
    <!--/CSS Style/-->
     <link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.1/dist/css/bootstrap.min.css">
     <style>
	 body{font-size:11px; margin:auto; font-family:Arial, Helvetica, sans-serif;} 
	 
     .imagen{position:absolute; float:left; margin-left:30px; margin-top:15px; }
	 
	 #firmas{margin-bottom: 0;	 }
	 
	 #tabla-detalle table{ text-align:center; }
	 footer {
		width: 100%;
		max-width:1140px;
		height: auto;
		bottom: 0;
		box-sizing:border-box;
	}
	 
     </style>
</head>

<body>
<div class="container">
	<div class="imagen"><img src="../cssalmacen/img/logoeurodom.jpg" width="102" alt="logo"></div>
    <div class="container text-center">
        <h5><b>Metro de Santo Domingo</b></h5>
        <h5><b>Mantenimiento</b></h5>
        <p style="font-size:14px;">Solicitud de repuestos, materiales, herramientas y/o equipos</p>
    </div>
    <div>
    <?php
      $salida = '';
            
      $query2 = mysql_query('SELECT * FROM cod_salida WHERE OtSalida = "'.$_GET['ot'].'"');
      		$nosalida = '';
		$observaciones = '';
        while($row = mysql_fetch_array($query2)){
			$nosalida = $row['idCodSalida'];
        ?>
        
    <table class="table table-responsive table-bordered" style="margin:auto; border: 1px solid #5C5050;" id="tabla-cabecera" >
      <tr>
        <td width="28%">
        <div class="form-group">
            <label for="" class="col-xm-3 control-label">AT que Solicita:</label>
            <span><?php echo $row['AT'];?></span>
        </div>
        </td> 
        <td width="28%">
        <div class="form-group">
            <label for="" class="col-xm-3 control-label">(N/A) No.: </label>
            <span><?php echo $row['OtSalida'];?></span>
        </div>
        </td> 
        <td width="30%">
        <div class="form-group" style="margin-bottom:5px;;">
            <label class="col-xm-3 control-label"> ED.LOG.GLO.nor.001.: </label> 
            <span ><?php echo $row['DateSalida'];?></span><br/>
            <label class="col-xm-2 control-label">(MM/DD/YYYY H:m) </label>
            
        </div>
        </td>   
      </tr>  
    </table>
	<?php
		$observaciones = $row['Observaciones'];
		};		
  	?>
    </div>

    <div id="tabla-detalle" style="margin-top:5px">
        <table class="table table-bordered table-condensed table-responsive" style="margin-bottom: 0;">
          <tr>
            <th scope="col" width="30"><div align="center">#</div></th>
            <th scope="col"><div align="center">Designacion</div></th>
            <th scope="col"><div align="center">Referencia</div></th>
            <th scope="col"><div align="center">Código SAP</div></th>
            <th scope="col"><div align="center">Medida</div></th>
            <th scope="col"><div align="center">Cantidad</div></th>
            <th scope="col"><div align="center">Observacion</div></th>
          </tr>
         <?php
		 	$consulta0 = 'SELECT * FROM detalle_salida WHERE OtSalida = "'.$_GET['ot'].'"';
			 $consulta = mysql_query($consulta0);
			 $contador = mysql_num_rows($consulta);	
			  if($contador == 0){
			  echo'<tr>
				<td colspan="9" class="alert alert-danger"><img src="../cssalmacen/img/icon-imag/alerta.png" width="15"> No existen registros en la Tabla.</td>
			  ';
			  }else {
			 $item = 0;
			while($rows = mysql_fetch_array($consulta)){
				++$item	;	
		?> 
          <tr>
            <th scope="row"><div align="right"><?php echo $item; ?></div></th>
            <td><?php echo $rows['Designacion']; ?></td>
            <td><?php echo $rows['Referencia']; ?></td>
            <td><?php echo $rows['SAP']; ?></td><!--/Campo SAP/crear bd-->
            <td><?php echo $rows['Medida']; ?></td>
            <td><?php echo $rows['Cantidad']; ?></td>
            <td>(<?php echo $rows['Condicion']; ?>) <?php echo utf8_encode($rows['Observaciones']); ?></td><!--/Campo Comentario crear bd/-->
          </tr>
          <?php
			  
			}
			if($contador > 0){
				  while($item < 8){
						++$item;	
						echo'<tr>
							<th scope="row"><div align="right">'.$item.'</div></th>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							</tr> 
							'; 
					}
			  }
		}
	?> 
	
        </table>
    </div>
    
    <footer style="margin-top:5px;">
        <table class="table table-bordered table-condensed table-responsive" id="firmas">
          <tr>
            <td>
            <b>Responsable Área Técnica Siemens</b>
            <br><br>
            <p>Nombre:</p>
            <br>
            <p>Firma:</p>
            </td>
            <td>
            <b>Responsable de Almacén Siemens</b>
            <br><br>
            <p>Nombre:</p>
            <br>
            <p>Firma:</p>
            </td>
            <td>
            <b>Responsable de Almacén OPRET</b>
            <br><br>
            <p>Nombre:</p>
            <br>
            <p>Firma:</p>
            </td>
          </tr>
          <tr>
             <td colspan="2" width="65%"><b>Observaciones</b>
			<br>
			<p><?php echo $observaciones;?></p>
			</td>
            
            <td>
            <b>Responsable de Área Técnica OPRET</b>
            <br><br>
            <p>Nombre:</p>
            <br>
            <p>Firma:</p>
            </td>
            
          </tr>
          
        </table>
    
       <div id="oficial" style="float:left; font-size:9px;">
        Formulario de Salida de Almacén<p>No. Salida : <?php echo $nosalida; ?></p>
        </div>
        <div id="oficial" style="float:right; font-size:9px; padding-right:18%;">
        Código del Documento: ED.LOG.GLO.nor.001.<p>
        Revisión A De Fecha 10 Julio 2014</p>
        </div>
	</footer>

</div>
<!--/Script/-->
<script src="../jsalmacen/jquery-2.1.3.min.js"></script>
<script src="../../bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    window.print();
});
</script>
</body>
</html>