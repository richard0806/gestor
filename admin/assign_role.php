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
require'../class/roles.php';
require'../class/users.php';
require'../class/Pmenu.php';
require'../global/constants.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

$objUser = new Users();

//obtenemos los perfiles del usuario seleccionado
$user = $objUser->single_user($_GET["idUser"]);
$profiles = $objUser->look_modules();

if($rowU=mysql_fetch_array($user)){
	$username = $rowU["loginUsers"];
}

$objrol = new Roles();
$objdat = new Database();

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
        <title>Asignar Roles al Usuario Seleccionado!!</title>
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
        <form name="assigmod" action="assign_role_exe.php" method="post" class="form-horizontal">
        <input type="hidden" name="idUser" value="<?php echo $_GET["idUser"];?>" />
        <table align="center" class="table table-condensed table-bordered table-hover table-responsive">
        	<tbody>
            	<tr><td colspan="3" style="text-align:center;"><h4><b>Asignación de Roles a: </b><?php echo $username;?></h4></td></tr>
				<?php $numrows = mysql_num_rows($profiles);
				if($numrows > 0){
					$counter = 1;
					while($row=mysql_fetch_array($profiles)){
						$query = "SELECT * FROM roles, modules WHERE roles.idmodule = '".$row["idmodule"]."' 
							AND roles.idmodule = modules.idmodule ";
						$get_roles = $objdat->select($query);
						while($rowRo=mysql_fetch_array($get_roles)){
							$query1 = "SELECT * FROM role_user WHERE idRole = '".$rowRo["idRole"]."' 
								AND idUsers = '".$_GET["idUser"]."' ";
							$get_info = $objdat->select($query1);
							if($rowR=mysql_fetch_array($get_info)){
								$assig = $rowR["idRole"];
							}else{
								$assig = 'false';
							}
							?>
							<tr>
								<td><b><?php echo $rowRo["nameRole"]; ?></b></td>
								<td><?php echo $rowRo["nameModule"];?></td>
								<td><?php
								if($assig==$rowRo["idRole"]){?>
									<div class="material-switch pull-right">
										<input id="role<?php echo $counter;?>" name="role<?php echo $counter;?>" type="checkbox" value="<?php echo $rowRo["idRole"];?>" checked/>
										<label for="role<?php echo $counter;?>" class="label-default"></label>
									</div>
								<?php
								}else{?>
									<div class="material-switch pull-right">
										<input id="role<?php echo $counter;?>" name="role<?php echo $counter;?>" type="checkbox" value="<?php echo $rowRo["idRole"];?>"/>
										<label for="role<?php echo $counter;?>" class="label-default"></label>
									</div>
								<?php
								}
								?>
								</td>
							</tr>
						<?php
							$counter = $counter + 1;
						}
					}
				}
                ?>
                <tr>
					<td colspan="3" align="center">
					<a href="user_list.php" class="btn btn-default">Cancelar</a>
                    <?php //Validar los permisos para la Creacion de Modulos.
                        if(in_array('18',$_SESSION['roles'])){
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