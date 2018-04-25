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
require'../class/dbactions.php';
require'../class/Pmenu.php';
require'../global/constants.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los perfiles!!
$objPro = new Profiles();
$list_profiles = $objPro->show_profiles();

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
        <title>Modulo de Perfiles!!</title>
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

    </head>
    
    <body>
    	<!--MENUES======-->
           <?php require'../global/menu.php';?>
        <!--FINAL DE LOS MENUES======-->
        
        <div class="container">
        <h2 align="center">Listado de Perfiles!!!</h2>
        		<div align="center">
                		<?php 
                        if(in_array('5',$_SESSION['roles'])){
                        ?>
                        <a href="new_profile.php" class="btn btn-primary btn-sm"><img src="../cssalmacen/img/icon-imag/Add.png" width="20"> Nuevo Perfil</a>
                        <?php
                        }else{
                        ?>
                        <a href="new_profile.php" class="btn btn-primary btn-sm" onClick="return false"><img src="../cssalmacen/img/icon-imag/Add.png" width="20"> Nuevo Perfil</a>
                        <?php
                        }
                        ?>
                	
                <br><br>
        		</div><!--FINAL DEL DIV ALIGN CENTER-->
        <table align="center" class="table table-bordered table-responsive table-hover table-condensed">        	
          <thead>                
                <tr>
                	<td><div align="center"><strong>Código</strong></div></td>
                    <td><div align="center"><strong>Nombre del Perfil</strong></div></td>
                    <td><div align="center"><strong>Descripción</strong></div></td>
                    <td><div align="center"><strong>Creado el</strong></div></td>
                    <td><div align="center"><strong>Estado</strong></div></td>
                    <td colspan="4"><div align="center"><strong>Acciones</strong></div></td>
               </tr>
                
            </thead>
            <tbody>
            
            	<?php
        	
				$numrows = mysql_num_rows($list_profiles);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($list_profiles)){?>
                    
                    	<tr>
                        	<td><?php echo $row["codeProfi"];?></td>
                            <td><?php echo $row["nameProfi"]; ?></td>
                            <td><?php echo $row["descProfi"]; ?></td>
                            <td><?php echo $row["dateProfi"]; ?></td>
                            <td><?php echo $row["statusPro"]; ?></td>
                            
                            <?php //validacion de permisos para asignar modulos.
                        if(in_array('22',$_SESSION['roles'])){
                        ?>
                        <td><a href="assign_profile.php?idPerfil=<?php echo $row["idProfile"];?>">Asignar Modulos</a></td>
                        <?php
                        }else{
                        ?>
                        <td><a href="assign_profile.php?idPerfil=<?php echo $row["idProfile"];?>" onClick="return false">Asignar Modulos</a></td>
                        <?php
                        }
                        ?>                            
                            <td><a href="show_modules.php?idPerfil=<?php echo $row["idProfile"];?>">Ver Modulos Asignados</a></td>
                            <td><div class="ui-group-buttons">
                             <?php //validacion de permisos para modificar Perfiles creados.
                        if(in_array('6',$_SESSION['roles'])){
                        ?>
                        <a href="modify_profile.php?idPerfil=<?php echo $row["idProfile"];?>" class="btn btn-default btn-sm"><img src="../cssalmacen/img/icon-imag/icon-edit.png" width="22"></a>
                        <?php
                        }else{
                        ?>
                        <a href="modify_profile.php?idPerfil=<?php echo $row["idProfile"];?>" class="btn btn-default btn-sm" onClick="return false"><img src="../cssalmacen/img/icon-imag/icon-edit.png" width="22"></a>
                        <?php
                        }
                        ?> 
                        <div class="or"></div>    
                            <?php //validacion de permisos para eliminar Perfiles creados.
                        if(in_array('7',$_SESSION['roles'])){
                        ?>
                        <a href="delete_profile.php?idPerfil=<?php echo $row["idProfile"];?>"class="btn btn-danger btn-sm"><img src="../cssalmacen/img/icon-imag/aviso_borrar.png" width="20"></a>
                        <?php
                        }else{
                        ?>
                        <a href="delete_profile.php?idPerfil=<?php echo $row["idProfile"];?>"class="btn btn-danger btn-sm" onClick="return false"><img src="../cssalmacen/img/icon-imag/aviso_borrar.png" width="20"></a>
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