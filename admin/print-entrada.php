<!doctype html>
<html>	
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gestor de Mantenimiento Siemens MSD">
    <meta name="author" content="RMSoluciones">
    <link rel="icon" href="cssalmacen/img/carrito.png">
		<title>Comprobante de Entrada-Almacen Siemens </title>
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
        <p style="font-size:14px;">Recepción de repuestos, materiales, herramientas y/o equipos</p>
    </div>
    <div>
    <?php
      $conex = mysql_connect('localhost', 'root', 'Asercomp01*');
      $db = mysql_select_db('siemens_sql',$conex)or die ("Error, No se realizo la Conexion a la Base de Datos");
      
      $query2 = mysql_query('SELECT * FROM cod_entrada WHERE IdFactura = "'.$_GET['fac'].'" LIMIT 1', $conex);
      		$noentrada = '';
        while($row = mysql_fetch_array($query2)){
			$noentrada = $row['idCodEntrada'];
    ?>
        
    <table class="table table-hover table-responsive table-bordered" style="margin:auto;" id="tabla-cabecera">
      <tr>
        <td>
        <div class="form-group text-center" style="margin-bottom:0px;">
            <label class="col-xm-5 control-label">Fecha Entrega:</label>
            <span><?php echo $row['EntregaAlmacen'];?></span><br>
            <label class="col-xm-5 control-label" style="font-size:10px; color:#333; border-top:1px solid; padding-right:10px;padding-left:10px; margin-left:20%;">(MM/DD/YYYY H:m) </label> 
        </div>
        </td> 
        <td>
        <div class="form-group text-center" style="margin-bottom:0px;">
            <label class="col-xm-4 control-label">Factura No.: </label>
            <span><?php echo $row['IdFactura'];?></span>
        </div>
        </td> 
        <td>
        <div class="form-group text-center" style="margin-bottom:0px;">
            <label for="" class="col-xm-4 control-label">Entrega OPRET: </label>
            <span><?php echo $row['EntregaOpret'];?></span><br/>
            <label class="col-xm-5 control-label" style="font-size:10px; color:#333; border-top:1px solid; padding-right:10px;padding-left:10px; margin-left:20%;">(MM/DD/YYYY H:m) </label> 
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
        <table class="table table-bordered table-condensed table-hover table-responsive" style="margin-bottom: 0;">
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
		 	$consulta0 = 'SELECT * FROM detalle_entrada WHERE IdFactura = "'.$_GET['fac'].'"';
			 $consulta = mysql_query($consulta0, $conex);
			 $contador = mysql_num_rows($consulta);	
			  if($contador == 0){
			  echo'<tr>
				<td colspan="8" class="alert alert-danger"><img src="../cssalmacen/img/icon-imag/alerta.png" width="15"> No existen registros en la Tabla.</td>
			  ';
			  }else {
			 $item = 0;
			while($rows = mysql_fetch_array($consulta)){
				++$item	;	
		?> 
          <tr>
            <th scope="row"><div align="right"><?php echo $item; ?></div></th>
            <td><?php echo utf8_encode($rows['Designacion']); ?></td>
            <td><?php echo $rows['Referencia']; ?></td>
            <td>&nbsp;</td><!--/Campo SAP/crear bd-->
            <td><?php echo $rows['Medida']; ?></td>
            <td><?php echo $rows['Cantidad']; ?></td>
            <td><?php echo $rows['Observaciones']; ?></td><!--/Campo Comentario crear bd/-->
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
            <td colspan="2"><b>Observaciones</b>
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
         Formulario de Recepción en Almacén<p>No. Entrada : <?php echo $noentrada; ?></p>
        </div>
        <div id="oficial" style="float:right; font-size:9px; padding-right:18%;">
        Código del Documento:  ED.LOG.GLO.nor.002<p>Revisión A De Fecha 10 Julio 2014</p>
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