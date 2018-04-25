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

$idPerfil = $_GET["idPerfil"];

//consultamos el listado de los usuarios!!
$objPer = new Profiles();
$objMod = new Modules();

$perfil = $objPer->single_profile($idPerfil);
$module = $objMod->show_modules();
//para buscar modulos asignados al perfil seleccionado!
$objassig = new Profiles();

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
        <title>Asignar Modulos al Perfil Seleccionado!!</title>
		
    <link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.1/dist/css/bootstrap.min.css">   
     
      <!-- Just for debugging purposes. Don't actually copy these 2 lines!--> 
     <script src="../assets/js/ie-emulation-modes-warning.js"></script>
     
    <!-- Custom styles for this template -->
     <link rel="stylesheet" type="text/css" href="../cssalmacen/carousel.css">
     <link rel="stylesheet" type="text/css" href="../cssalmacen/offcanvas.css">
     <link rel="stylesheet" type="text/css" href="../cssalmacen/Button radio and checkbox.css">
	 <link rel="stylesheet" type="text/css" href="../cssalmacen/Checkbox.css">
	 <style>
			#radioBtn .notActive{				
				color: #3276b1;
				background-color: #fff;
			}
			#radioBtn{
			margin-top:38%;
			}
			.table{
				width:50%;
				margin:auto;
			}
		</style>
    </head>
    
    <body>
   		<!--MENUES======-->
           <?php require'../global/menu.php';?>
        <!--FINAL DE LOS MENUES======-->    
        
        <div class="container">
        <form name="assigmod" action="assign_module_exe.php" method="post" class="form-horizontal">
        <table align="center" class="table table-condensed table-bordered table-hover table-responsive">
        	<tbody>
				<?php $num_rowsP = mysql_num_rows($perfil);
				$num_rowsM = mysql_num_rows($module);
                
                if($num_rowsP > 0){
                	if($row=mysql_fetch_array($perfil)){?>
						<tr><td colspan="2" style="text-align:center;"><h4><b>Asignación de Modulos al Perfil: </b><?php echo $row["nameProfi"];?></h4></td></tr>
					<?php
						if($num_rowsM > 0){
							$counter = 1 ;
							while($rowM=mysql_fetch_array($module)){
								$assign_mod = $objassig->look_assign($rowM["idmodule"], $idPerfil);
								$num_assign = mysql_num_rows($assign_mod);?>
								
                                <tr>
                                	<td><b><?php echo $rowM["nameModule"];?></b></td>
                                	<td><?php if($num_assign > 0){?>
										<div class="material-switch pull-right">
											<input id="checkbox <?php echo $counter; ?>" name="<?php echo $rowM["nameModule"];?>" type="checkbox" checked/>
											<label for="checkbox <?php echo $counter; ?>" class="label-default"></label>
										</div>
									<?php
									}else{?>
										<div class="material-switch pull-right">
											<input id="checkbox <?php echo $counter; ?>" name="<?php echo $rowM["nameModule"];?>" type="checkbox"/>
											<label for="checkbox <?php echo $counter; ?>" class="label-default"></label>
										</div>
                                    <?php }?>
									</td>
                                </tr>
							<?php
							$counter = $counter + 1 ;	
							}
							?><input type="hidden" name="idPerfil" value="<?php echo $idPerfil;?>" />
							<?php
							
						}
					
					
					}
                }
                
                ?>
                <tr>
					<td colspan="2" align="center">
						<a href="profile_list.php" class="btn btn-default">Cancelar</a>
                    <?php //Validar los permisos para la Creacion de Modulos.
                        if(in_array('22',$_SESSION['roles'])){
                        ?>
                        <input type="submit" name="send" id="send" value="Guardar" class="btn btn-success" />
                        <?php
                        }else{
                        ?>
                       <input type="submit" name="send" id="send" value="Guardar" class="btn btn-success disabled" onClick="return false" />
                        <?php
                        }
                        ?>
					</td>
				</tr>
            </tbody>
        
        </table>
        </form>
    </div><!--FINAL DEL CONTAINER--> 
	
	<!--PIE DE PAGINA
    ==========================================-->
     <?php require'../global/pie_pagina.php';?>
	<!--===============FINAL===================-->
       
    <!--cadena de comando para los script de la pagina principal-->
    <script src="../jsalmacen/jquery-2.1.3.min.js"></script>  
	<script src="../../bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>
	<script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="../jsalmacen/offcanvas.js"></script>
    
    </body>
</html>