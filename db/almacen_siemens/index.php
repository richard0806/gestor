<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="RMSoluciones">
		<link rel="icon" href="cssalmacen/img/carrito.png">
		<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../font-awesome-4.3.0/css/font-awesome.min.css">
	<script type="text/javascript" src="jsalmacen/ie-emulation-modes-warning.js"></script>
		<style>		
			#features {
				margin-top:20px;
			}
			.feature, .feature i, .feature h3, .feature .title_border {
				-webkit-transition: all 1s ease-in-out;
				-moz-transition: all 1s ease-in-out;
				-o-transition: all 1s ease-in-out;
				transition: all 1s ease-in-out;    
			}
			.feature {
				background:#FFFFFF;
				text-align:center;
				padding:20px;
				border: solid 1px #cccccc;
			}
			.feature p {
				margin-top:20px;   
				margin-bottom:30px;   
			}
			.feature i{
				font-size:80px;
				color:#FFFFFF;
				background:#1E825F;
				padding:30px;
				border-radius:50%;
				border: solid 3px #1E825F;
			}
			.feature h3 {
				color:#1E825F;  
			}
			.feature:hover {
				background:#F5F5F5;
				-webkit-transform: translate(0,1em);
				-moz-transform: translate(0,1em);
				-o-transform: translate(0,1em);
				-ms-transform: translate(0,1em);
				transform: translate(0,1em);    
			}
			.feature:hover i{
				color:#1E825F;
				border-color:#1E825F;
				background:#FFFFFF;
			}
			.feature:hover .title_border {
				background-color:#1E825F;
				width:50%;
			}
			.feature .title_border {
				width: 0%;
				height: 3px;
				background:#1E825F;
				margin: 0 auto;
				margin-top: 12px;
				margin-bottom: 8px;
			}		
		</style>
	</head>
	<body>
		<div class="container">
			<div class="page-header">
			  <h1>Bienvenidos/as! <small>Seleccione una opcion para accesar al Gestor</small></h1>
			</div>
		</div>
		<div class="container" id="features">
			<div class="row">
				<a href="principal.php" style="color:#333">
				<div class="col-md-4 feature">
					<i class="glyphicon glyphicon-tasks"></i>
					<h3>Login del Gestor</h3>
					<div class="title_border"></div>
					<p>Inicie sesión para obtener más opciones del sistema (Entradas, Salidas, Averias y Reportes).</p>
				</div>
				</a>
				<a href="busqueda.php" style="color:#333">
				<div class="col-md-4 feature">
					<i class="glyphicon glyphicon-search"></i>
					<h3>Consulta de repuestos</h3>
					<div class="title_border"></div>
					<p>Consultas de repuestos (Imagenes, Cantidades, Stock actual y más) todo esto sin iniciar sesión.</p>
				</div>
				</a>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="jsalmacen/jquery-2.1.3.min.js"></script>
    <script src="../bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>
	</body>
</html>