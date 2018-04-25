<?php error_reporting (0);?>
<?php
require'class/config.php';
require'class/dbactions.php';
require'class/Pmenu.php';
require'global/constants.php';

$objcon = new Connection();
$objcon->get_connected();

/*$query=mysql_query("SELECT * FROM users WHERE loginUsers = '".$user."'");
$resultado=mysql_fetch_array($query);
	$IdUser = $resultado['idUsers'];*/
	
$criterio = '';
?>
<!DOCTYPE html>

<html lang="es">

    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="RMSoluciones">
    <link rel="icon" href="cssalmacen/img/carrito.png">
            <title>Consultas Siemens Almacen</title>
     <link rel="stylesheet" type="text/css" href="../bootstrap-3.3.1/dist/css/bootstrap.min.css"> 
      <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
     <script src="assets/js/ie-emulation-modes-warning.js"></script>
     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
     <link rel="stylesheet" type="text/css" href="../kartik-v-bootstrap/css/fileinput.min.css">    
    <link rel="stylesheet" type="text/css" href="../font-awesome-4.3.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="cssalmacen/Alert/sweetalert.css">
	<link href="http://getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet">
    <style>
	/*hover del button*/
	.btn-hover {
		font-weight: normal;
		color: #333333;
		cursor: pointer;
		background-color: inherit;
		border-color: transparent;
	}
	/*Final del estilo hover btn */
	
	.modal-static { 
		position: fixed;
		top: 50% !important; 
		left: 50% !important; 
		margin-top: -100px;  
		margin-left: -100px; 
		overflow: visible !important;
	}
	.modal-static,
	.modal-static .modal-dialog,
	.modal-static .modal-content {
		width: 200px; 
		height: 100px;
		opacity:0.9;		
	}
	.modal-static .modal-dialog,
	.modal-static .modal-content {
		padding: 0 !important; 
		margin: 0 !important;
	}
	.result{
    margin-top:20px;
	}
	.logo-subtext {
		color: #31708F;
		font: 35px/35px roboto-regular, arial, sans-serif;
		left: 87px;
		position: relative;
		top: 177px;
		white-space: nowrap;
	}
	.custab{
    border: 1px solid #ccc;
    padding: 5px;
    *margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
	/*
	 *
	 *Estilo del input buscar.
	 *
	 */
	#custom-search-input {
        margin:0;
        padding: 0;
    }
 
    #custom-search-input .search-query {
        padding-right: 3px;
        padding-right: 4px \9;
        padding-left: 3px;
        padding-left: 4px \9;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
 
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
 
    #custom-search-input button {
        border: 0;
        background: none;
        /** belows styles are working good */
        padding: 2px 5px;
        margin-top: 2px;
        position: relative;
        left: -28px;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        color:#D9230F;
    }
 
    .search-query:focus + button {
        z-index: 3;   
    } 
	/*logo*/
	.logo{
		background: url(user/imagn/gestion-almacen-stocks-300x219.png);
		background-size: 300px 219px;
		background-repeat: no-repeat;
		height:219px;
		width:300px;
		margin: 0 auto;
	}
	.lga1{
		height:313px;
	}
	.lga2{
		padding-top:65px;		
	}
	.lga3{
		position: relative;
		width: 20%;
	}
	/*
	Style de script*/
	
	.imgscript {
		background: url(user/imagn/gestion-almacen-stocks-300x219.png);
		background-size: 104px 62px;
		background-repeat: no-repeat;
		height: 62px;
		width: 104px;
		margin-left: 40px;
		
	}
	.logo-subtext2 {
		color: #31708F;
		font: 15px/17px roboto-regular, arial, sans-serif;
		left: 60px;
		position: relative;
		top: 10px;
		white-space: nowrap;
	}
	.formulario{
		margin-top:-42px;
		margin-left":-69px;
	}	
	.c_error1{
		color: red;
		margin-left: 292px;
	}
	.c_error2{
		color: red;
		margin-left: 346px;
	}
	.well2 {
		min-height: 20px;
		padding: 5px;
		background-color: #f5f5f5;
		border: 1px solid #e3e3e3;
		/* border-radius: 4px; */
		-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
		box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
	}
		.ver:hover, .ver_disabled:hover {
			color: red;
		}
		.edit:hover, .edit_disabled:hover {
			color: purple;
		}

	@media screen and (max-width:900px){
		 #c_error_name {margin-left: 0px;}
		.lga2 {
    			padding-top: 0px;
		}
.formulario {
    margin-top: 6px;
}
	}
	@media screen and (max-width:800px){
		.logo{
			background-size: 239px 162px;
			height: 164px;
		}
		.logo-subtext{
			font: 24px/24px roboto-regular, arial, sans-serif;
			top: 136px;
		}
		
	}
	@media screen and (max-width:1900px){
		.footer{
			margin-top: 40%;
		}
	}
		
</style>
    </head>
        
 <body>
        
    <div class="container">
	<div id="lga" class="lga1">
<a href="index.php" class="pull-right hidden" id="volver"><i class="glyphicon glyphicon-home"></i> Volver a Inicio</a>
		<div class="lga2">	
			<div class="logo" title="Gestor" align="left" id="hplogo">
				<div class="logo-subtext" id="textlogo">Gestor de Almacén</div>
			</div>
		</div>
	
     <form method="get" id="formconsulta" class="form-horizontal" action="busqueda.php">
			<div id="custom-search-input" >
                <div class="input-group col-md-6" style="margin:0 auto;">
                    <input type="text" name="criterio" id="busqueda" class="search-query form-control" placeholder="Search" autofocus autocomplete="off" />
		<input class="hidden" value="<?php echo $_GET['criterio']; ?>"  id="valoroculto">                  
<span class="input-group-btn" style="z-index: 100;">
                        <button class="btn btn-danger" type="submit" id="btnbuscar">
						<span class="glyphicon glyphicon-search"></span>
						</button>
					</span>					
                </div>

            </div>
			<p class="hidden">Keypresses: <span class="keypresscount">0</span></p>
	</form>
			
	</div>
		<div style="width: 95%;margin: auto;" id="Tdetalle">
		<?php
        //inicializo el criterio y recibo cualquier cadena que se desee buscar
        $criterio = "";
		$txt_criterio="";
		$pagina='';
		$inicio='';
		$final= '';
		$tamPag= '';
		$numPags = '';
        if ($_GET['criterio']!=""){
	$txt_criterio = $_GET['criterio'];
	$criterio = " where IdProducto like '%" . $txt_criterio . "%' or Designacion like '%" . $txt_criterio . "%' or Referencia like '%" . $txt_criterio . "%' or Alias like '%" . $txt_criterio . "%' or SAP like '%" . $txt_criterio . "%'";
}

	if($txt_criterio != ''){
	$sql="SELECT * FROM siemens_sql.consulta ".$criterio;
	$res=mysql_query($sql);
	$numeroRegistros=mysql_num_rows($res);
	if($numeroRegistros<=0){		
		if($txt_criterio != ''){
			$sql="SELECT * FROM siemens_sql.sobmant ".$criterio;
			$res=mysql_query($sql);
			$numeroRegistros=mysql_num_rows($res);
			if($numeroRegistros<=0){		
				echo "<div align='center'>
						<h3><font face='verdana' size='3' class='label label-danger'>No se encontraron resultados</font></h3>
						</div>";
			}else{
				//////////elementos para el orden
				if(!isset($orden))
				{
					$orden="IdProducto";
				}
				//////////fin elementos de orden

				//////////calculo de elementos necesarios para paginacion
				//tamaño de la pagina
				$tamPag=10;

				//pagina actual si no esta definida y limites
				if(!isset($_GET["pagina"]))
					{
					$pagina=1;
					$inicio=1;
					$final=$tamPag;
					}
					else
					{
					$pagina = $_GET["pagina"];
					}
				//calculo del limite inferior
				$limitInf=($pagina-1)*$tamPag;

				//calculo del numero de paginas
				$numPags=ceil($numeroRegistros/$tamPag);
				if(!isset($pagina))
				{
					   $pagina=1;
					   $inicio=1;
					   $final=$tamPag;
				}else{
					$seccionActual=intval(($pagina-1)/$tamPag);
					$inicio=($seccionActual*$tamPag)+1;

					if($pagina<$numPags)
					{
					   $final=$inicio+$tamPag-1;
					}else{
						$final=$numPags;
					}
						
						if ($final>$numPags){
							 $final=$numPags;
					}
				}

				//////////fin de dicho calculo

				//////////creacion de la consulta con limites
				$next = mysql_query("SELECT * FROM siemens_sql.sobmant ".$criterio." ORDER BY IdSobMant ASC LIMIT ".$limitInf.",".$tamPag);
						$count = mysql_num_rows($next);

				/*/////////fin consulta con limites
				echo "<hr/><div align='center'>
						<font face='verdana' size='-2'>encontrados ".$numeroRegistros." resultados<br>
						ordenados por <b>".$orden."</b>";
						if(isset($txt_criterio)){
				echo "<br>Valor filtro: <b>".$txt_criterio."</b>";
						}
				echo "</font></div><hr/>";*/
				echo '<span class="alert-info" align="center"><h3>Informacion de consulta</h3></span>';
				echo '<table class="table table-bordered table-condensed table-hover table-responsive" id="myTablequery" style="margin-bottom: 0px;">';
				echo "<thead bgcolor='#CCCCCC' style='font-size:12;font-family:Arial, Helvetica, sans-serif'><tr style='font-size:12px;'>
					<th>Item</th>
					<th>Designacion</th>
					<th>Palabra Clave</th>
					<th>Referencia</th>
					<th>SAP</th>
					<th>Id Producto</th>
					<th>Ubicación</th>
					<th>Stock Mant.</th>
					<th>Stock Sob.-Mant.</th>
					<th>Herramientas</th>
				</tr></thead>";
						
							 
							while($rows=mysql_fetch_array($next)){
								echo '<tbody style="font-size:12px;"><trstyle="font-family:Verdana, Arial, Helvetica, sans-serif"><tr>';
								echo '<td>'.$rows["IdSobMant"].'</td>';
								echo '<td>'.$rows["Designacion"].'</td>';
								echo '<td>'.$rows["Alias"].'</td>';
								echo '<td>'.$rows["Referencia"].'</td>';
								echo '<td>'.$rows["SAP"].'</td>';
								echo '<td id="td" class="td1">'.$rows["IdProducto"].'</td>';
								echo '<td>'.$rows["Ubicacion"].'</td>';						
								$sql1 = mysql_query("SELECT * FROM siemens_sql.consulta WHERE IdProducto = '".$rows['IdProducto']."' ");
								$cor = mysql_num_rows($sql1);
								if($cor > 0){
								$fila1 = mysql_fetch_array($sql1);
									$resul1 = $fila1["StockMant"];
								}else{
									$resul1 = 0 ;
								}						
								echo '<td>'.$resul1.'</td>';
								echo '<td>'.$rows["Cantidad"].'</td>';
								echo '<td class="hidden">SobMant</td>';
								echo '<td class="hidden">'.$rows["Ubicacion"].'</td>';
								echo '<td class="hidden"></td>';
								echo '<td>
									 <a id="show-picture" class="ver"><i class="fa fa-eye"></i></a>
									  <a  data-toggle="modal" data-target=".myModalkeyword" id="insert-keyword" class="edit"><i class="fa fa-pencil-square-o"></i></a>
									</td>';
								echo '</tr></tbody>';
								
							}
				echo "<tfooter><tr><td colspan='10'><font color='#c7254e' face='verdana' size='-2'>Repuestos encontrados: <b>".$numeroRegistros." resultados</b> ~ Valor filtro: <b>".$txt_criterio."</b></font></td></tr></tfooter>";
				echo "</table>";
				
			
			//////////a partir de aqui viene la paginacion
			echo '<div align="center">
			<nav style="margin: 0 auto;">
			  <ul class="pagination">';
			  
			if($pagina>1)
			{
				echo "<li><a aria-label='Previous' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina-1)."&orden=".$orden."&criterio=".$txt_criterio."'>";
				echo "<span aria-hidden='true'>&laquo;</span></a></li>";
			}

			for($i=$inicio;$i<=$final;$i++)
			{
				if($i==$pagina)
				{
					echo "<li class='active'><a href='#'>".$i."</a></li>";
				}else{
					echo "<li><a href='".$_SERVER["PHP_SELF"]."?pagina=".$i."&orden=".$orden."&criterio=".$txt_criterio."'>".$i."</a></li>";
				}
			}
			if($pagina<$numPags)
			{
				echo "<li><a aria-label='Next' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina+1)."&orden=".$orden."&criterio=".$txt_criterio."'>";
				echo "<span aria-hidden='true'>&raquo;</span></a></li>";
			}
			//////////fin de la paginacion
			echo '	</ul>
			</nav>
			</div>';
			}//fin if
			}
	}else{
		//////////elementos para el orden
		if(!isset($orden))
		{
			$orden="IdProducto";
		}
		//////////fin elementos de orden

		//////////calculo de elementos necesarios para paginacion
		//tamaño de la pagina
		$tamPag=10;

		//pagina actual si no esta definida y limites
		if(!isset($_GET["pagina"]))
			{
			$pagina=1;
			$inicio=1;
			$final=$tamPag;
			}
			else
			{
			$pagina = $_GET["pagina"];
			}
		//calculo del limite inferior
		$limitInf=($pagina-1)*$tamPag;

		//calculo del numero de paginas
		$numPags=ceil($numeroRegistros/$tamPag);
		if(!isset($pagina))
		{
			   $pagina=1;
			   $inicio=1;
			   $final=$tamPag;
		}else{
			$seccionActual=intval(($pagina-1)/$tamPag);
			$inicio=($seccionActual*$tamPag)+1;

			if($pagina<$numPags)
			{
			   $final=$inicio+$tamPag-1;
			}else{
				$final=$numPags;
			}
                
                if ($final>$numPags){
                     $final=$numPags;
		    }
		}

		//////////fin de dicho calculo

		//////////creacion de la consulta con limites
		$sql="SELECT * FROM siemens_sql.consulta ".$criterio." ORDER BY IdConsulta ASC LIMIT ".$limitInf.",".$tamPag;
		$res=mysql_query($sql);
				
		if(mysql_num_rows($res) != 0){

		/*/////////fin consulta con limites
		echo "<hr/><div align='center'>
				<font face='verdana' size='-2'>encontrados ".$numeroRegistros." resultados<br>
				ordenados por <b>".$orden."</b>";
                if(isset($txt_criterio)){
		echo "<br>Valor filtro: <b>".$txt_criterio."</b>";
                }
		echo "</font></div><hr/>";*/
		echo '<span class="alert-info" align="center"><h3>Informacion de consulta</h3></span>';
		echo '<table class="table table-bordered table-condensed table-hover table-responsive" id="myTablequery" style="margin-bottom: 0px;">';
		echo "<thead bgcolor='#CCCCCC' style='font-size:12;font-family:Arial, Helvetica, sans-serif'><tr style='font-size:12px;'>
        	<th>Item</th>
            <th>Designacion</th>
            <th>Palabra Clave</th>
            <th>Referencia</th>
            <th>SAP</th>
            <th>Id Producto</th>
            <th>Ubicación</th>
            <th>Stock Mant.</th>
            <th>Stock Sob.-Mant.</th>
            <th>Herramientas</th>
        </tr></thead>";
		
		while($rows=mysql_fetch_array($res))
		{
			echo '<tbody style="font-size:12px;"><trstyle="font-family:Verdana, Arial, Helvetica, sans-serif">';
						echo '<td>'.$rows["IdConsulta"].'</td>';
						echo '<td>'.$rows["Designacion"].'</td>';
						echo '<td>'.$rows["Alias"].'</td>';
						echo '<td>'.$rows["Referencia"].'</td>';
						echo '<td>'.$rows["SAP"].'</td>';
						echo '<td id="td" class="td1">'.$rows["IdProducto"].'</td>';
						echo '<td>'.$rows["UbicacionPF"].'/'.$rows["UbicacionEPC"].'</td>';
						echo '<td>'.$rows["StockMant"].'</td>';
					$sql1 = mysql_query("SELECT * FROM siemens_sql.sobmant WHERE IdProducto = '".$rows['IdProducto']."' ");
						$count = mysql_num_rows($sql1);
						if($count > 0){
						$fila = mysql_fetch_array($sql1);
							$resul = $fila["Cantidad"];
						}else{
							$resul = 0 ;
						}
						echo '<td>'.$resul.'</td>';
						echo '<td class="hidden">Mant</td>';
						echo '<td class="hidden">'.$rows["UbicacionPF"].'</td>';
						echo '<td class="hidden">'.$rows["UbicacionEPC"].'</td>';
						echo '<td>
							 <a id="show-picture" class="ver"><i class="fa fa-eye"></i></a>
							  <a  data-toggle="modal" data-target=".myModalkeyword" id="insert-keyword" class="edit"><i class="fa fa-pencil-square-o"></i></a>
						  	</td>';
						echo '</tr></tbody>';
		}//fin while
		}else{
				$next = mysql_query("SELECT * FROM siemens_sql.sobmant".$criterio." ORDER BY IdSobMant ASC LIMIT ".$limitInf.",".$tamPag);
				$count = mysql_num_rows($next);
				
				if($count>0){
					 
					while($rows=mysql_fetch_array($next)){
						echo '<tbody style="font-size:12px;"><trstyle="font-family:Verdana, Arial, Helvetica, sans-serif"><tr>';
						echo '<td>'.$rows["IdSobMant"].'</td>';
						echo '<td>'.$rows["Designacion"].'</td>';
						echo '<td>'.$rows["Alias"].'</td>';
						echo '<td>'.$rows["Referencia"].'</td>';
						echo '<td>'.$rows["SAP"].'</td>';
						echo '<td id="td" class="td1">'.$rows["IdProducto"].'</td>';
						echo '<td>'.$rows["Ubicacion"].'</td>';						
						$sql1 = mysql_query("SELECT * FROM siemens_sql.consulta WHERE IdProducto = '".$rows['IdProducto']."' ");
						$cor = mysql_num_rows($sql1);
						if($cor > 0){
						$fila1 = mysql_fetch_array($sql1);
							$resul1 = $fila1["StockMant"];
						}else{
							$resul1 = 0 ;
						}						
						echo '<td>'.$resul1.'</td>';
						echo '<td>'.$rows["Cantidad"].'</td>';
						echo '<td class="hidden">SobMant</td>';
						echo '<td class="hidden">'.$rows["Ubicacion"].'</td>';
						echo '<td class="hidden"></td>';
						echo '<td>
							 <a id="show-picture" class="ver"><i class="fa fa-eye"></i></a>
							  <a  data-toggle="modal" data-target=".myModalkeyword" id="insert-keyword" class="edit"><i class="fa fa-pencil-square-o"></i></a>
						  	</td>';
						echo '</tr></tbody>';
						
					}
				}
		}
		echo "<tfooter><tr><td colspan='10'><font color='#c7254e' face='verdana' size='-2'>Repuestos encontrados: <b>".$numeroRegistros." resultados</b> ~ Valor filtro: <b>".$txt_criterio."</b></font></td></tr></tfooter>";
		echo "</table>";
		
	
	//////////a partir de aqui viene la paginacion
	echo '<div align="center">
	<nav style="margin: 0 auto;">
	  <ul class="pagination">';
	  
	if($pagina>1)
	{
		echo "<li><a aria-label='Previous' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina-1)."&orden=".$orden."&criterio=".$txt_criterio."'>";
		echo "<span aria-hidden='true'>&laquo;</span></a></li>";
	}

	for($i=$inicio;$i<=$final;$i++)
	{
		if($i==$pagina)
		{
			echo "<li class='active'><a href='#'>".$i."</a></li>";
		}else{
			echo "<li><a href='".$_SERVER["PHP_SELF"]."?pagina=".$i."&orden=".$orden."&criterio=".$txt_criterio."'>".$i."</a></li>";
		}
	}
	if($pagina<$numPags)
	{
		echo "<li><a aria-label='Next' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina+1)."&orden=".$orden."&criterio=".$txt_criterio."'>";
		echo "<span aria-hidden='true'>&raquo;</span></a></li>";
	}
	//////////fin de la paginacion
	echo '	</ul>
	</nav>
	</div>';
	}//fin if
	}
	
	?>
	 </div>
     </form> 
     </div><!--FINAL DEL CONTAINER DE CONSULTA-->
     
    <footer class="footer" style="background-color: transparent;">
      <div class="container">
	  <p class="text-muted">Copyright © 2014-2016 Siemens RD. Todos los Derechos Reservados. Design Web ~ 
              <a href="../../RMsoluciones.php">RM Soluciones</a></p>
      </div>
    </footer>
    <!--/Modal de loader/-->
        <!-- Static Modal -->
    <div class="modal modal-static fade" id="myModalloader" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <img src="cssalmacen/img/loader (2).gif" width="32" height="32">
                        <h4>Cargando Datos... <button type="button" class="close" style="float: none;" data-dismiss="modal" aria-hidden="true">×</button></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <!--/Final de Modal loader/-->
    
<!--/Modal para Agregar editar datos-->
<div class="modal fade myModalkeyword" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y:visible">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Datos</h4>
      </div>
      <form method="post" action="#" id="formKeyword" class="form-horizontal">
      <div class="modal-body">
       
          <div class="form-group">
          	<input type="hidden" name="idUsers" id="idUsers" class="form-control" value="Invitado" required readonly>          	
            <input type="text" name="OpAlm" id="OpAlm" class="form-control hidden" required readonly>
            <label for="Descripcion" class="col-sm-2 control-label">Designacion</label>
            <div class="col-sm-8">
            	<input type="text" id="Descripcion" name="Descripcion" required class="form-control">
            </div>
          </div>
          
          <div class="form-group">
            <label for="keyword" class="col-sm-2 control-label">Palabra Clave</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" name="keyword" id="keyword" autofocus>
              </div>
              <label for="Ref" class="col-sm-2 control-label">Referencia</label>
              <div class="col-sm-3">
              	<input type="text" class="form-control" name="Ref" id="Ref">
              </div>
          </div>
          <div class="form-group">
            <label for="SAP" class="col-sm-2 control-label">SAP</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" name="SAP" id="SAP">
              </div>
              <label for="idPro" class="col-sm-2 control-label">ID Almacén</label>
              <div class="col-sm-3">
              <input type="text" name="idPro" id="idPro" class="form-control" required readonly>
              </div>
          </div>
          
          <div class="form-group">
              <label for="ubicacion" class="col-sm-2 control-label">Ubicacion</label>
              <div class="col-sm-3">
              	<input type="text" class="form-control" name="ubicacion" id="ubicacion">
              </div>
              <label for="ubicacionL2" class="col-sm-2 control-label">Ubicacion L2</label>
              <div class="col-sm-3">
              	<input type="text" class="form-control" name="ubicacionL2" id="ubicacionL2">
              </div>
          </div>
          
          <div id="mensaje">
          </div> 
              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!--/Ver Fotos-->
<div class="modal fade" id="myModalimg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">            
                <div class="modal-body"> 
                              
                </div>
                <div class="modal-footer">
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
            	</div>
            </div>
        </div>
    </div>
    
    <!--=====================FINAL DE LA PROGRAM. MODAL==========-->    
   
        
    <!--cadena de comando para los script de la pagina principal--<script src="../pass/js/jquery-1.11.1.min.js"></script-->
    <script src="jsalmacen/jquery-2.1.3.min.js"></script>
   <script src="../bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>   
	<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="../kartik-v-bootstrap/js/fileinput.min.js"></script>
	<script src="jsalmacen/Alert/sweetalert.min.js"></script>
   <script>
    i = 0;
var vsl = $('#valoroculto').val();
   			function fn_ocultar(){
				 setTimeout(function() {
					 	$('.myModalkeyword input[type="text"]').val('');
						$('.myModalkeyword #mensaje').empty();
					},3000);	
			};
   		
		
		/*Script para la ventana de KeyWord*/
		$('#myTablequery').on('click','#insert-keyword',function(){
			var idusers = $('.myModalkeyword #idUsers').val(); 
			if(idusers == 2 || idusers == 1 || idusers == 4){
				$('.myModalkeyword #Descripcion').prop( "readonly", false );
				$('.myModalkeyword #Ref').prop( "readonly", false );
				$('.myModalkeyword #SAP').prop( "readonly", false );
				$('.myModalkeyword #ubicacion').prop( "readonly", false );
				$('.myModalkeyword #ubicacionL2').prop( "readonly", false );
			}
			else{
				$('.myModalkeyword #Descripcion').prop( "readonly", true );
				$('.myModalkeyword #Ref').prop( "readonly", true );
				$('.myModalkeyword #SAP').prop( "readonly", true );
				$('.myModalkeyword #ubicacion').prop( "readonly", true);
				$('.myModalkeyword #ubicacionL2').prop( "readonly", true );	
			}
			$('.myModalkeyword #OpAlm').val($(this).parent().parent().children('td:eq(9)').text());;
			$('.myModalkeyword #idPro').val($(this).parent().parent().children('td:eq(5)').text());;
			$('.myModalkeyword #Descripcion').val($(this).parent().parent().children('td:eq(1)').text());;
			$('.myModalkeyword #Ref').val($(this).parent().parent().children('td:eq(3)').text());;
			$('.myModalkeyword #SAP').val($(this).parent().parent().children('td:eq(4)').text());;
			$('.myModalkeyword #ubicacion').val($(this).parent().parent().children('td:eq(10)').text());;
			$('.myModalkeyword #ubicacionL2').val($(this).parent().parent().children('td:eq(11)').text());;
			$(".myModalkeyword #keyword").val($(this).parent().parent().children('td:eq(2)').text());;
			$(".myModalkeyword #keyword").focus();			
			});
		$('#formKeyword').submit(function(event){
			event.preventDefault();
			var keyword = $('#formKeyword').serialize();
			$.ajax({
				url:'user/Extra/keyword_exe2.php',
				type:'post',
				data:keyword,
				beforeSend: function(){
					//alert(keyword);
					//$('.myModalkeyword #mensaje').hide();
					}
				}).done(function(respuesta){
					$('.myModalkeyword #mensaje').html(respuesta);
					fn_ocultar();
				});
			});
			
			/*Script para visualizar las imagenes*/
			$('#myTablequery tbody').on('click','#show-picture', function(){
				var imag = $(this).parent().parent().children('td:eq(5)').text();
				//alert (imag);
				var ruta = 'user/Extra/ver2.php';
				$.ajax({
					url:ruta,
					type:'post',
					data:'imagen='+ imag
				}).done(function(datos){
					 $('#myModalimg').modal();
					  $('#myModalimg').on('shown.bs.modal', function(){
						  $('#myModalimg .modal-body').html(datos);
					  });
					  $('#myModalimg').on('hidden.bs.modal', function(){
						  $('#myModalimg .modal-body').html('');
					  });
				});
			});
			
			//script para modal detalles generales
			$(function () {
$('#busqueda').val(vsl);
				$('#myTablequery').on('click','#detallegeneral',function(){
					$('#mpdg').modal('show');
				})
				
				$('.btn-mais-info').on('click', function(event) {
					$( '.open_info' ).toggleClass( "hide" );
				})
				if ($('#busqueda').val().length == 0 ){
					$('#custom-search-input').after( "<span class='c_error1' id='c_error_name'>Ingrese el Datos de Busqueda.</span>" );
					$('#busqueda').focus();
					return false;
						
				} else{
                    //imagen de carga
                	$(".c_error1").remove();//ocultamos el error de campo
					$('.respuesta').empty();//vaciamos la tabla 
					//$('#myModalloader').modal('show');//CERRAMOS EL FORM								  							
				}
				 
			
				if($('#busqueda').val().length > 0){
					//$('#lga').addClass('hidden');
					$("#lga").removeClass("lga1");
					$("#lga").addClass("well2");
					$("#lga>div").removeClass("lga2");
					$("#lga>div").addClass("lga3");
					$("body>div").removeClass("container");
					$('#hplogo').removeClass("logo");
					$("#hplogo").addClass("imgscript");
					$("#textlogo").removeClass("logo-subtext");
					$("#textlogo").addClass("logo-subtext2");
					$("#formconsulta").addClass("formulario");
					$('#c_error_name').removeClass("c_error1");
					$(".c_error1").remove();//ocultamos el error de campo
					$("#c_error_name").addClass("c_error2");
					$('#volver').removeClass('hidden');
				}
			});
			$("#busqueda").keyup(function(){
					if($('#busqueda').val().length < 1){
						$("#Tdetalle").addClass('hidden');
						//alert('hola gente');
					}
				if($('#busqueda').val().length > 0){
					//$('#lga').addClass('hidden');
					$("#lga").removeClass("lga1");
					$("#lga").addClass("well2");
					$("#lga>div").removeClass("lga2");
					$("#lga>div").addClass("lga3");
					$("body>div").removeClass("container");
					$('#hplogo').removeClass("logo");
					$("#hplogo").addClass("imgscript");
					$("#textlogo").removeClass("logo-subtext");
					$("#textlogo").addClass("logo-subtext2");
					$("#formconsulta").addClass("formulario");
					$('#c_error_name').removeClass("c_error1");
					$(".c_error1").remove();//ocultamos el error de campo
					$("#c_error_name").addClass("c_error2");
					$('#volver').removeClass('hidden');
				}
				
			});
			$("#busqueda").keypress(function(){
				$(".keypresscount").text(i += 1);				
			});
	</script>

    </body>
    
</html>