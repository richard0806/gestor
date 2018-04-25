<?php

require'../class/sessions.php';
$objses = new Sessions();
$objses->init();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
	header('Location: http://'.$_SERVER["SERVER_NAME"].':8080/almacen_siemens/index.php?error=2');
}

?>
<?php

require'../class/config.php';
require'../class/modules.php';
require'../class/dbactions.php';
require'../class/Pmenu.php';
require'../global/constants.php';

$objcon = new Connection();
$objcon->get_connected();

$query=mysql_query("SELECT * FROM users WHERE loginUsers = '".$user."'");
$resultado=mysql_fetch_array($query);
	$IdUser = $resultado['idUsers'];



?>
<!doctype html>
<html>	
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../cssalmacen/img/carrito.png">
    <meta name="description" content="Gestor de Mantenimiento Siemens MSD">
    <meta name="author" content="RMSoluciones">
    
		<title>Reportes-Almacen Siemens</title>
     <link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.1/dist/css/bootstrap.min.css">   
     
      <!-- Just for debugging purposes. Don't actually copy these 2 lines! <script src="../../assets/js/ie8-responsive-file-warning.js"></script>-->    
     <script src="../assets/js/ie-emulation-modes-warning.js"></script>
     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template ../cssalmacen/datatable/dataTables.bootstrap.css-->
     <link rel="stylesheet" type="text/css" href="../cssalmacen/carousel.css">
     <link rel="stylesheet" type="text/css" href="../cssalmacen/offcanvas.css">
     <link rel="stylesheet" type="text/css" href="../cssalmacen/justified-nav.css">
     <link rel="stylesheet" type="text/css" href="../../font-awesome-4.3.0/css/font-awesome.css">
     <link rel="stylesheet" type="text/css" href="../cssalmacen/daterangepicker.css">
     <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
     <link rel="stylesheet" type="text/css" href="../cssalmacen/Alert/sweetalert.css">
    <style>
		@import url(http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css);
		.fa-fw {width: 2em;}
		
		
.side-menu {
	position: relative;
	width: 100%;
	height: 100%;
	background-color: #f8f8f8;
	border-right: 1px solid #e7e7e7;
	
}
.side-menu .navbar {
	border: none;
}
.side-menu .navbar-header {
	width: 100%;
	border-bottom: 1px solid #e7e7e7;
}
.side-menu .navbar-nav .active a {
	background-color: transparent;
	margin-right: -1px;
	border-right: 5px solid #e7e7e7;
}
.side-menu .navbar-nav li {
	display: block;
	width: 100%;
	border-bottom: 1px solid #e7e7e7;
}
.side-menu .navbar-nav li a {
	padding: 15px;
}
.side-menu .navbar-nav li a .glyphicon {
	padding-right: 10px;
}
.side-menu #dropdown {
	border: 0;
	margin-bottom: 0;
	border-radius: 0;
	background-color: transparent;
	box-shadow: none;
}
.side-menu #dropdown .caret {
	float: right;
	margin: 9px 5px 0;
}
.side-menu #dropdown .indicator {
	float: right;
}
.side-menu #dropdown > a {
	border-bottom: 1px solid #e7e7e7;
}
.side-menu #dropdown .panel-body {
	padding: 0;
	background-color: #f3f3f3;
}
.side-menu #dropdown .panel-body .navbar-nav {
	width: 100%;
}
.side-menu #dropdown .panel-body .navbar-nav li {
	padding-left: 15px;
	border-bottom: 1px solid #e7e7e7;
}
.side-menu #dropdown .panel-body .navbar-nav li:last-child {
	border-bottom: none;
}
.side-menu #dropdown .panel-body .panel > a {
	margin-left: -20px;
	padding-left: 35px;
}
.side-menu #dropdown .panel-body .panel-body {
	margin-left: -15px;
}
.side-menu #dropdown .panel-body .panel-body li {
	padding-left: 30px;
}
.side-menu #dropdown .panel-body .panel-body li:last-child {
	border-bottom: 1px solid #e7e7e7;
}
.side-menu #search-trigger {
	background-color: #f3f3f3;
	border: 0;
	border-radius: 0;
	position: absolute;
	top: 0;
	right: 0;
	padding: 15px 18px;
}
.side-menu .brand-name-wrapper {
	min-height: 50px;
}
.side-menu .brand-name-wrapper .navbar-brand {
	display: block;
}
.side-menu #search {
	position: relative;
	z-index: 1000;
}
.side-menu #search .panel-body {
	padding: 0;
}
.side-menu #search .panel-body .navbar-form {
	padding: 0;
	padding-right: 50px;
	width: 100%;
	margin: 0;
	position: relative;
	border-top: 1px solid #e7e7e7;
}
.side-menu #search .panel-body .navbar-form .form-group {
	width: 100%;
	position: relative;
}
.side-menu #search .panel-body .navbar-form input {
	border: 0;
	border-radius: 0;
	box-shadow: none;
	width: 100%;
	height: 50px;
}
.side-menu #search .panel-body .navbar-form .btn {
	position: absolute;
	right: 0;
	top: 0;
	border: 0;
	border-radius: 0;
	background-color: #f3f3f3;
	padding: 15px 18px;
}
/* Main body section */
.side-body {
	margin-left: 310px;
}
/* small screen */
@media (max-width: 768px) {
	.side-menu {
		position: relative;
		width: 100%;
		height: 0;
		border-right: 0;
	}

	.side-menu .navbar {
		z-index: 999;
		position: relative;
		height: 0;
		min-height: 0;
		background-color:none !important;
		border-color: none !important;
	}
	.side-menu .brand-name-wrapper .navbar-brand {
		display: inline-block;
	}
	/* Slide in animation */
	@-moz-keyframes slidein {
		0% {
			left: -300px;
		}
		100% {
			left: 10px;
		}
	}
	@-webkit-keyframes slidein {
		0% {
			left: -300px;
		}
		100% {
			left: 10px;
		}
	}
	@keyframes slidein {
		0% {
			left: -300px;
		}
		100% {
			left: 10px;
		}
	}
	@-moz-keyframes slideout {
		0% {
			left: 0;
		}
		100% {
			left: -300px;
		}
	}
	@-webkit-keyframes slideout {
		0% {
			left: 0;
		}
		100% {
			left: -300px;
		}
	}
	@keyframes slideout {
		0% {
			left: 0;
		}
		100% {
			left: -300px;
		}
	}
	/* Slide side menu*/
	/* Add .absolute-wrapper.slide-in for scrollable menu -> see top comment */
	.side-menu-container > .navbar-nav.slide-in {
		-moz-animation: slidein 300ms forwards;
		-o-animation: slidein 300ms forwards;
		-webkit-animation: slidein 300ms forwards;
		animation: slidein 300ms forwards;
		-webkit-transform-style: preserve-3d;
		transform-style: preserve-3d;
	}
	.side-menu-container > .navbar-nav {
		/* Add position:absolute for scrollable menu -> see top comment */
		position: fixed;
		left: -300px;
		width: 300px;
		top: 43px;
		height: 100%;
		border-right: 1px solid #e7e7e7;
		background-color: #f8f8f8;
		overflow: auto;
		-moz-animation: slideout 300ms forwards;
		-o-animation: slideout 300ms forwards;
		-webkit-animation: slideout 300ms forwards;
		animation: slideout 300ms forwards;
		-webkit-transform-style: preserve-3d;
		transform-style: preserve-3d;
	}
	@-moz-keyframes bodyslidein {
		0% {
			left: 0;
		}
		100% {
			left: 300px;
		}
	}
	@-webkit-keyframes bodyslidein {
		0% {
			left: 0;
		}
		100% {
			left: 300px;
		}
	}
	@keyframes bodyslidein {
		0% {
			left: 0;
		}
		100% {
			left: 300px;
		}
	}
	@-moz-keyframes bodyslideout {
		0% {
			left: 300px;
		}
		100% {
			left: 0;
		}
	}
	@-webkit-keyframes bodyslideout {
		0% {
			left: 300px;
		}
		100% {
			left: 0;
		}
	}
	@keyframes bodyslideout {
		0% {
			left: 300px;
		}
		100% {
			left: 0;
		}
	}
	/* Slide side body*/
	.side-body {
		margin-left: 5px;
		margin-top: 70px;
		position: relative;
		-moz-animation: bodyslideout 300ms forwards;
		-o-animation: bodyslideout 300ms forwards;
		-webkit-animation: bodyslideout 300ms forwards;
		animation: bodyslideout 300ms forwards;
		-webkit-transform-style: preserve-3d;
		transform-style: preserve-3d;
	}
	.body-slide-in {
		-moz-animation: bodyslidein 300ms forwards;
		-o-animation: bodyslidein 300ms forwards;
		-webkit-animation: bodyslidein 300ms forwards;
		animation: bodyslidein 300ms forwards;
		-webkit-transform-style: preserve-3d;
		transform-style: preserve-3d;
	}
	/* Hamburger */
	.navbar-toggle-sidebar {
		border: 0;
		float: left;
		padding: 18px;
		margin: 0;
		border-radius: 0;
		background-color: #f3f3f3;
	}
	/* Search */
	#search .panel-body .navbar-form {
		border-bottom: 0;
	}
	#search .panel-body .navbar-form .form-group {
		margin: 0;
	}
	.side-menu .navbar-header {
		/* this is probably redundant */
		position: fixed;
		z-index: 3;
		background-color: #f8f8f8;
	}
	/* Dropdown tweek */
	#dropdown .panel-body .navbar-nav {
		margin: 0;
	}
}

	hr {
  height: 4px;
  margin-left: 15px;
  margin-bottom:-3px;
}
.hr-warning{
  background-image: -webkit-linear-gradient(left, rgba(210,105,30,.8), rgba(210,105,30,.6), rgba(0,0,0,0));
}
.hr-success{
  background-image: -webkit-linear-gradient(left, rgba(15,157,88,.8), rgba(15, 157, 88,.6), rgba(0,0,0,0));
}
.hr-primary{
  background-image: -webkit-linear-gradient(left, rgba(66,133,244,.8), rgba(66, 133, 244,.6), rgba(0,0,0,0));
}
.hr-danger{
  background-image: -webkit-linear-gradient(left, rgba(244,67,54,.8), rgba(244,67,54,.6), rgba(0,0,0,0));
}
	</style>
    <script>
	function generar_reporte_excel(){
		document.getElementById('frmExcel').submit();
	}
	
	function generar_reporte_pdf(){
		document.getElementById('frmPDF').submit();
	}
	</script> 
    </head>
		
		
	<body>
		<!--MENUES======-->
           <?php require'../global/menu.php';?>
        <!--FINAL DE LOS MENUES======-->
        
       <div class="container">
           <div class="jumbotron">
                <h1>Reportes de Almacén</h1>
                <p class="lead">Este módulo de <b>Reportes</b> esta encargado de todos los movimientos que suceden dentro del ámbite del almacén.</p>        
            </div><!--FINAL DEL JUMBOTRON-->
        <hr class="divider">
    <div class="row">
        <div class="col-md-3">
        	<!-- Menu -->
	<div class="side-menu">
		<nav class="navbar navbar-default" role="navigation">
			<!-- Main Menu -->
			<div class="side-menu-container">
				<ul class="nav navbar-nav admin-menu">
					<li class="active"><a href="#" data-target-id="home"><i class="fa fa-home fa-fw"></i>Home</a></li>
                    
                    <!-- Dropdown level Entradas -->
                    <li class="panel panel-default" id="dropdown">
						<a data-toggle="collapse" href="#dropdown-lvl0">
							<span class="fa fa-list-alt fa-fw"></span>Entradas<span class="caret"></span>
						</a>
						<!-- Dropdown level 1 -->
						<div id="dropdown-lvl0" class="panel-collapse collapse">
							<div class="panel-body">
								<ul class="nav navbar-nav">
									<li><a data-target-id="entrada"><i class="fa fa-calendar fa-fw"></i>Por Fechas</a></li>
									<li><a href="#"><i class="fa fa-book fa-fw"></i>Por OT</a></li>
									<li><a href="#">Por AT</a></li>
                                    <li><a href="#">Por Almacén</a></li>
								</ul>
							</div>
						</div>
					</li>
                    
                    <!-- Dropdown level salidas -->
                    
                    <li class="panel panel-default" id="dropdown">
						<a data-toggle="collapse" href="#dropdown-lvl1">
							<span class="fa fa-file-o fa-fw"></span>Salidas<span class="caret"></span>
						</a>
						<!-- Dropdown level 1 -->
						<div id="dropdown-lvl1" class="panel-collapse collapse">
							<div class="panel-body">
								<ul class="nav navbar-nav">
									<li><a data-target-id="salidas_xfechas"><i class="fa fa-calendar fa-fw"></i>Por fechas</a></li>
									<li><a data-target-id="salidas_xOT"><i class="fa fa-book fa-fw"></i>Por OT</a></li>
									<li><a href="#">Por AT</a></li>
                                    <li><a href="#">Por Almacén</a></li>
								</ul>
							</div>
						</div>
					</li>
                    
					<li><a data-target-id="charts"><i class="fa fa-bar-chart-o fa-fw"></i>Transferencias</a></li>
                    <li><a data-target-id="table"><i class="fa fa-table fa-fw"></i>Devoluciones</a></li>
                    <li><a data-target-id="forms"><i class="fa fa-tasks fa-fw"></i>Movimientos</a></li>
                    <li><a data-target-id="calender"><i class="fa fa-calendar fa-fw"></i>Prestamos</a></li>
                    <li><a data-target-id="library"><i class="fa fa-book fa-fw"></i>Inventario</a></li>
                    <li><a data-target-id="applications"><i class="fa fa-pencil fa-fw"></i>Applications</a></li>
                    <li><a data-target-id="settings"><i class="fa fa-cogs fa-fw"></i>Settings</a></li>

					<!-- Dropdown-->				

					<li><a href="#"><span class="glyphicon glyphicon-signal"></span> Link</a></li>

				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>
	</div><!-- /.Final col-md-3 -->
</div><!-- /.Div row final -->
        <div class="col-md-9  admin-content" id="home">
            <p>
                Hello! This is a forked snippet.<br>
                It is for users, which use one-page layouts.
            </p>
            <p>
                Here's the original one from BhaumikPatel: <a href="http://bootsnipp.com/snippets/featured/vertical-admin-menu" target="_BLANK">Vertical Admin Menu</a>
                <br><br>
                <strong>Thank you Bhaumik!</strong>
            </p>
        </div>
        
        <div class="col-md-9 admin-content" id="entrada">
            Entradas
        </div>
        <!--====================/Cuerpo de reportes de salida(detallado por modalidad)/=====================================-->
        <div class="col-md-9 admin-content" id="salidas_xfechas">
            <form method="post" action="Report-Salida-Mes-exe.php" id="reporteXmes" class="form-horizontal">
        	<div class="form-group">
            	<h4></h4>
            	<label class="col-sm-2 control-label">Fecha</label>
                <div class="col-sm-3">
                <input type="text" class="from_date form-control" placeholder="Seleccione fecha de inicio" contenteditable="false" name="inicio" required>
                </div>
                <div class="col-sm-3">
                    <input type="text" class="to_date form-control" placeholder="Seleccione fecha final" contenteditable="false" name="final" required>  
                </div>
                <div class="col-sm-1">
                <button type="submit" class="btn btn-primary btn-sm">Generar reporte</button>
                </div>
            </div>
            <hr class="divider">
        </form>
        
        <div id="carga" style="display:none">
        	<p align="center">    		
      		<img src="../cssalmacen/img/loading2.gif"><br><span>Espere un Momento</span>
            </p>
        </div>
        <div id="TDSRF" style="display:none;">
        <!--/Tabla detalles/-->
        <a id="ExportToExcel" class="pull-right"><img src="../cssalmacen/img/icon-imag/pdf.png" alt="Exportar a Excel" width="30"></a> 
         <a id="" class="pull-right"><img src="../cssalmacen/img/icon-imag/excel-icon.png" alt="Exportar a PDF" width="30"></a>      
        <table class="table table-bordered table-condensed table-hover table-responsive" id="reporteSalidaRangoFecha" style="text-align:center;">
        	<thead>
            	<tr>
                	<th><div align="center">Item</div></th>
                    <th><div align="center">OT-Salida</div></th>
                    <th><div align="center">Designación</div></th>
                    <th><div align="center">Referencia</div></th>
                    <th><div align="center">ID</div></th>
                    <th><div align="center">Medida</div></th>
                    <th><div align="center">Cantidad</div></th>
                    <th><div align="center">Fecha</div></th>
                </tr>
            </thead>
        	<tbody id='reportesalida'>
            </tbody>
        </table>
        <!--/Final Tabla detalles/-->
        </div>
      </div>
        
        <div class="col-md-9 admin-content" id="salidas_xOT">
            <form method="post" action="Report-Salida-OT-exe.php" id="reporteXot" class="form-horizontal">
        	<div class="form-group">
            	<h4></h4>
                <label class="col-sm-2 control-label">Área Técnica</label>
                <div class="col-sm-3">
                    <select name="At" class="form-control" id="ATselect" required>
                        <option value="" selected>Seleccionar...</option>
                        <option value="CAT">CAT</option>
                        <option value="SEN">SEN</option>
                        <option value="ELE">ELE</option>
                        <option value="Opret">OPRET</option>
                     </select>
                 </div>
                <div class="col-sm-1">
                <button type="submit" class="btn btn-primary btn-sm">Generar reporte</button>
                </div>
            </div>
            <hr class="hr-primary" />
        </form>
        
        <div id="carga" style="display:none">
        	<p align="center">    		
      		<img src="../cssalmacen/img/loading2.gif"><br><span>Espere un Momento</span>
            </p>
        </div>
        <div id="TDSRO" style="display:none;">
        <!--/Tabla detalles/-->
        <a id="ExportToExcel" class="pull-right"><img src="../cssalmacen/img/icon-imag/pdf.png" alt="Exportar a Excel" width="30"></a> 
         <a id="" class="pull-right"><img src="../cssalmacen/img/icon-imag/excel-icon.png" alt="Exportar a PDF" width="30"></a>      
        <table class="table table-bordered table-condensed table-hover table-responsive" id="reporteSalidaXOt" style="text-align:center;">
        	<thead>
            	<tr>
                	<th><div align="center">Item</div></th>
                    <th><div align="center">OT-Salida</div></th>
                    <th><div align="center">Designación</div></th>
                    <th><div align="center">Referencia</div></th>
                    <th><div align="center">ID</div></th>
                    <th><div align="center">Medida</div></th>
                    <th><div align="center">Cantidad</div></th>
                    <th><div align="center">Fecha</div></th>
                </tr>
            </thead>
        	<tbody id='reportesalidaXot'>
            </tbody>
        </table>
        <!--/Final Tabla detalles/-->
        </div>
      </div>
        <!--====================/Final Cuerpo de salida(detallado por modalidad)/=====================================-->
        
        <div class="col-md-9 well admin-content" id="charts">
            Transferencias
        </div>
        <div class="col-md-9 well admin-content" id="table">
            Devoluciones
        </div>
        <div class="col-md-9 well admin-content" id="forms">
            Movimientos
        </div>
        <div class="col-md-9 well admin-content" id="calender">
            Prestamos
        </div>
        <div class="col-md-9 well admin-content" id="library">
            Inventario
        </div>
        <div class="col-md-9 well admin-content" id="applications">
            Applications
        </div>
        <div class="col-md-9 well admin-content" id="settings">
            Settings
        </div>
    </div>
</div>
</div> 
      
        <!--PIE DE PAGINA
    ==========================================-->
     <?php require'../global/pie_pagina.php';?>
	<!--===============FINAL===================-->
      </div><!--/final de container/-->
      
      
        <!--cadena de comando para los script de la pagina principal-->
    <script src="../jsalmacen/jquery-2.1.3.min.js"></script>  
	<script src="../../bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>
	<script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="../jsalmacen/offcanvas.js"></script>
    <script src="../jsalmacen/datarangepicker.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script src="../jsalmacen/Alert/sweetalert.min.js"></script>
    <script>
	
	$( function(){
		
		var startDate = new Date('2012/01/01');
		var FromEndDate = new Date();
		var ToEndDate = new Date();
		
		ToEndDate.setDate(ToEndDate.getDate()+365);
		$('.from_date').datepicker({
			weekStart: 1,
			startDate: '2012/01/01',
			endDate: FromEndDate, 
			autoclose: true,
		})
			.on('changeDate', function(selected){
				startDate = new Date(selected.date.valueOf());
				startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
				$('.to_date').datepicker('setStartDate', startDate);
			}); 
		$('.to_date').datepicker({			
				weekStart: 1,
				startDate: startDate,
				endDate: ToEndDate,
				autoclose: true
			})
			.on('changeDate', function(selected){
				FromEndDate = new Date(selected.date.valueOf());
				FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
				$('.from_date').datepicker('setEndDate', FromEndDate);
			});
		
		  
		  
		  
		  
		});
		$(function(){
			$('#reporteXmes').submit(function(){
				event.preventDefault();
				var datos = $('#reporteXmes').serialize();
					
					$.ajax({
						type:'POST',
						url: $(this).attr('action'),						
            			data: datos,
						
						beforeSend: function(){
							//alert(datos);
							$('#reportesalida').empty();
							$('#carga').fadeIn(1500);
						},
						success: function(repons){
							$('#carga').fadeOut();
							$('#TDSRF').fadeIn(1500);
							$('#reportesalida').html(repons);
						}
					});
			})	
			$('#ExportToExcel').on('click', function(){
				var datos = $('#reporteXmes').serialize();
				$.ajax({
						type:'POST',
						url: '../Exportar_prueba_exe.php',						
            			data: datos
					});
			});
		});
		
		$(document).ready(function()
		{
			var navItems = $('.admin-menu li > a');
			var navListItems = $('.admin-menu li');
			var allWells = $('.admin-content');
			var allWellsExceptFirst = $('.admin-content:not(:first)');
			
			allWellsExceptFirst.hide();
			navItems.click(function(e)
			{
				e.preventDefault();
				navListItems.removeClass('active');
				$(this).closest('li').addClass('active');
				
				allWells.hide();
				var target = $(this).attr('data-target-id');
				$('#' + target).show();
			});
				$('.navbar-toggle-sidebar').click(function () {
				$('.navbar-nav').toggleClass('slide-in');
				$('.side-body').toggleClass('body-slide-in');
				$('#search').removeClass('in').addClass('collapse').slideUp(200);
			});
		
			$('#search-trigger').click(function () {
				$('.navbar-nav').removeClass('slide-in');
				$('.side-body').removeClass('body-slide-in');
				$('.search-input').focus();
			});
		});
		</script> 
</body>
</html>