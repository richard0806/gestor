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
//Llamado de los archivos clase
require'../class/config.php';
require'../class/profiles.php';
require'../class/modules.php';
require'../class/dbactions.php';
require'../class/Pmenu.php';
require'../global/constants.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objMod = new Modules();
$list_modules = $objMod->show_modules();

?>
<!doctype html>
<html lang="es">	
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../cssalmacen/img/carrito.png">
    <meta name="description" content="Gestor de Mantenimiento Siemens MSD">
    <meta name="author" content="RMSoluciones">
        <title>Administrar Modulos!!</title>
     <link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.1/dist/css/bootstrap.min.css">   
     
      <!-- Just for debugging purposes. Don't actually copy these 2 lines! <script src="../../assets/js/ie8-responsive-file-warning.js"></script>-->    
     <script src="../assets/js/ie-emulation-modes-warning.js"></script>
     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
     <link rel="stylesheet" type="text/css" href="../cssalmacen/carousel.css">
     <link rel="stylesheet" type="text/css" href="../cssalmacen/offcanvas.css">
	<link rel="stylesheet" type="text/css" href="../cssalmacen/Alert/sweetalert.css">

     <style>
	 .btn.dropdown-toggle ~ .dropdown-menu, 
	ul.nav li.dropdown ul.dropdown-menu {
		background-color: rgb(244, 244, 244);
		background-color: rgb(255, 255, 255);
		border: 0 solid rgb(66, 133, 244);
		box-shadow: 0px 0px 3px rgba(25, 25, 25, 0.3);
		top: 0px;
		margin: 0px;
		padding: 0px;
	}
	ul.nav li.dropdown ul.dropdown-menu {
		position: absolute;
		width: 100%;
	}
	.dropdown-menu .dropdown-plus-title {
		width: 100%;
		color: rgb(51, 51, 51);
		padding: 6px 12px;
		font-weight: 800;
		border: 0 solid rgb(173, 173, 173);
		border-bottom-width: 2px;
		cursor: pointer;
	}
	
	ul.nav li.dropdown ul.dropdown-menu .dropdown-plus-title {
		padding-top: 10px;
		padding-bottom: 10px;
		line-height: 20px;
	}
	
	.btn.dropdown-toggle.btn-primary ~ .dropdown-menu .dropdown-plus-title {
		border-color: rgb(53, 126, 189);
	}
	.btn.dropdown-toggle.btn-success ~ .dropdown-menu .dropdown-plus-title {
		border-color: rgb(76, 174, 76);
	}
	.btn.dropdown-toggle.btn-info ~ .dropdown-menu .dropdown-plus-title {
		border-color: rgb(70, 184, 218);
	}
	.btn.dropdown-toggle.btn-warning ~ .dropdown-menu .dropdown-plus-title {
		border-color: rgb(238, 162, 54);
	}
	.btn.dropdown-toggle.btn-danger ~ .dropdown-menu .dropdown-plus-title {
		border-color: rgb(212, 63, 58);
	}
	
	@media (min-width: 768px) {
		ul.nav li.dropdown ul.dropdown-menu .dropdown-plus-title {
			padding-top: 15px;
			padding-bottom: 15px;
		}
	}
	@media (min-width: 768px) {
		ul.nav li.dropdown ul.dropdown-menu {
			width: auto;
		}
	}
	
	</style>
    </head>
    
    <body>
    	<!--MENUES======-->
           <?php require'../global/menu.php';?>
        <!--FINAL DE LOS MENUES======-->
        
        <div class="container">
        <h2 align="center">Listado de Módulos!!!</h2>        
        			<div align="center">
        				<?php //Validar los permisos para la Creacion de Modulos.
                        if(in_array('8',$_SESSION['roles'])){
                        ?>
                        <a href="new_module.php" class="btn btn-primary btn-sm"><img src="../cssalmacen/img/icon-imag/Add.png" width="20"> Nuevo Módulo</a>
                        <?php
                        }else{
                        ?>
                        <a href="new_module.php" onClick="return false" class="btn btn-primary btn-sm disabled"><img src="../cssalmacen/img/icon-imag/Add.png" width="20"> Nuevo Módulo</a>
                        <?php
                        }
                        ?>
                        <ul class="nav navbar-nav pull-left">
                             <li class="dropdown open">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                     <li class="dropdown-plus-title">
                                        Link
                                        <b class="pull-right glyphicon glyphicon-chevron-up"></b>
                                    </li>
                                    <li><a href="role_list.php">Roles</a></li>
                                    <li><a href="profile_list.php">Perfiles</a></li>                                
                                </ul>
                            </li>
                        </ul>
             
                    
                        <br><br>
        			</div><!--FINAL DEL DIV ALIGN CENTER-->        
        
        <table align="center" class="table table-bordered table-condensed table-hover table-responsive">        	
            <thead>
                <tr>
                	<strong><td><div align="center">Código</div></td>
                    <td><div align="center">Nombre del Módulo</div></td>
                    <td><div align="center">Descripción</div></td>
                    <td><div align="center">Creado el</div></td>
                    <td><div align="center">Estado</div></td>
                    <td colspan="2" align="center"><div align="center">Acciones</div></td></strong>
                </tr>
                
            </thead>
            <tbody>
            
            	<?php
        	
				$numrows = mysql_num_rows($list_modules);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($list_modules)){?>
                    
                    	<tr>
                        	<td><?php echo $row["codeModule"];?></td>
                            <td><?php echo $row["nameModule"]; ?></td>
                            <td><?php echo $row["descModule"]; ?></td>
                            <td><?php echo $row["dateModule"]; ?></td>
                            <td><?php echo $row["statusModu"]; ?></td>
                            <td><div class="ui-group-buttons">
                            <?php 
							//Validacion de permisos para Modificar Modulos creados
                        if(in_array('9',$_SESSION['roles'])){
                        ?>
                        <a href="modify_module.php?idmodule=<?php echo $row["idmodule"];?>" class="btn btn-default btn-sm"><img src="../cssalmacen/img/icon-imag/icon-edit.png" width="22"></a>
                        <?php
                        }else{
                        ?>
                        <a href="modify_module.php?idmodule=<?php echo $row["idmodule"];?>" class="btn btn-default btn-sm" onClick="return false"><img src="../cssalmacen/img/icon-imag/icon-edit.png" width="22"></a>
                        <?php
                        }
                        ?>
                        <div class="or"></div>
                        
                           <?php
						   //Validacion de permisos para borrar modulos creados 
                        if(in_array('10',$_SESSION['roles'])){
                        ?>
							<a href="delete_module.php?idmodule=<?php echo $row["idmodule"];?>" class="btn btn-danger btn-sm"><img src="../cssalmacen/img/icon-imag/aviso_borrar.png" width="20"></a>
                        <?php
                        }else{
                        ?>
                        <a href="delete_module.php?idmodule=<?php echo $row["idmodule"];?>" class="btn btn-danger btn-sm" onClick="return false"><img src="../cssalmacen/img/icon-imag/aviso_borrar.png" width="20"></a>
                        <?php
                        }
                        ?>
                        </div></td>    
                        </tr>
                        
						<?php
					}
					
				}
			
				?>
            
            </tbody>
        
        </table>
        </div><!--/Final del div container/-->
        
        <!--PIE DE PAGINA
    ==========================================-->
     <?php require'../global/pie_pagina.php';?>
	<!--===============FINAL===================-->
    
    
            <!--cadena de comando para los script de la pagina principal-->
    	<script src="../jsalmacen/jquery-2.1.3.min.js"></script>  
	<script src="../../bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>
	<script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
    	<script src="../jsalmacen/offcanvas.js"></script>
	<script src="../jsalmacen/Alert/sweetalert.min.js"></script>

    </body>
</html>