<?php

include_once '../global/objects.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$con = $objCon->get_connected();

$objUser = new Users();

//obtenemos los perfiles del usuario seleccionado
$user = $objUser->single_user($con, $_GET["idUser"]);
$profiles = $objUser->look_modules($con);

if($rowU=$user->fetch_array(MYSQLI_ASSOC)){
	$username = $rowU["loginUsers"];
}

$objrol = new Roles();
$objdat = new Database();

?>
<!doctype html>
<html>
	<head>
			<?php include_once '../global/header.php' ?>
        <title>Asignar Roles al Usuario Seleccionado!!</title>

    <!-- Custom styles for this template -->
     <!-- <link rel="stylesheet" type="text/css" href="../cssalmacen/carousel.css">
     <link rel="stylesheet" type="text/css" href="../cssalmacen/offcanvas.css">
     <link rel="stylesheet" type="text/css" href="../cssalmacen/Button radio and checkbox.css">
     	 <link rel="stylesheet" type="text/css" href="../cssalmacen/Checkbox.css"> -->
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
           <?php include_once '../global/menu.php';?>
        <!--FINAL DE LOS MENUES======-->


        <div class="container"><br><br><br>
        <form name="assigmod" action="assign_role_exe.php" method="post" class="form-horizontal">
        <input type="hidden" name="idUser" value="<?= $_GET["idUser"];?>" />
        <table align="center" class="table table-condensed table-bordered table-hover table-responsive">
        	<tbody>
            	<tr><td colspan="3" style="text-align:center;"><h4><b>Asignación de Roles a: </b><?= $username;?></h4></td></tr>
				<?php $numrows = $profiles->num_rows;
				if($numrows > 0){
					$counter = 1;
					while($row=$profiles->fetch_array(MYSQLI_ASSOC)){
						$query = "SELECT * FROM roles, modules WHERE roles.idmodule = '".$row["idmodule"]."'
							AND roles.idmodule = modules.idmodule ";
						$get_roles = $objdat->select($con, $query);
						while($rowRo=$get_roles->fetch_array(MYSQLI_ASSOC)){
							$query1 = "SELECT * FROM role_user WHERE idRole = '".$rowRo["idRole"]."'
								AND idUsers = '".$_GET["idUser"]."' ";
							$get_info = $objdat->select($con, $query1);
							if($rowR=$get_info->fetch_array(MYSQLI_ASSOC)){
								$assig = $rowR["idRole"];
							}else{
								$assig = 'false';
							}
							?>
							<tr>
								<td><b><?= $rowRo["nameRole"]; ?></b></td>
								<td><?= $rowRo["nameModule"];?></td>
								<td><?php
								if($assig==$rowRo["idRole"]){?>
									<div class="material-switch pull-right">
										<input id="role<?= $counter;?>" name="role<?= $counter;?>" type="checkbox" value="<?= $rowRo["idRole"];?>" checked/>
										<label for="role<?= $counter;?>" class="label-default"></label>
									</div>
								<?php
								}else{?>
									<div class="material-switch pull-right">
										<input id="role<?= $counter;?>" name="role<?= $counter;?>" type="checkbox" value="<?= $rowRo["idRole"];?>"/>
										<label for="role<?= $counter;?>" class="label-default"></label>
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

    </body>
</html>
