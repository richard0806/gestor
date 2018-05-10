<?php
//Llamado de los archivos clase
include_once '../global/objects.php';

$objUse = new Users();
$objPro = new Profiles();

$idUser = $_GET['idUser'];

//Obtenemos el usuario a modificar
$single_user = $objUse->single_user($con,$idUser);

//Obtenemos los perfiles existentes
$profiles = $objPro->show_profiles($con);

//buscar perfiles asignados
$objDb = new Database();

?>

<!DOCTYPE html>
<html>
	<head>
	<?php include_once '../global/header.php' ?>
            <title>Modificar Usuarios!!</title>
      <style>
			#radioBtn .notActive{
				color: #3276b1;
				background-color: #fff;
			}
			#radioBtn{
			margin-top:38%;
			}
		</style>
    </head>

 <body>
		<!--MENUES======-->
           <?php require '../global/menu.php';?>
        <!--FINAL DE LOS MENUES======-->

     <div class="container"><br><br><br>
     <h2 align="center">Modificando Usuario</h2>
                <br><br>
        <form name="modUser" action="modify_user_exe.php" method="post" class="form-horizontal">
        <input type="hidden" name="idUsers" value="<?= $idUser;?>" />

                <?php

				$num_rows = $single_user->num_rows;

				if($num_rows > 0){

					if($row=$single_user->fetch_array(MYSQLI_ASSOC)){
				//Codigo para ocultar contraseña por completo...
				$espacio =$row["passUsers"];
				$pass0 = preg_replace('/([a-zA-Z0-9&\/\\#,+()$~%._":*¿?<>{}ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç\s])/', '*', $espacio)


		?>

                 <div class="form-group">
                    <label for="login" class="col-sm-2 control-label">Nombre de Usuario</label>
                    <div class="col-sm-3">
                      <input type="text" name="login" id="login" class="form-control" value="<?= $row["loginUsers"];?>" maxlength="15" />
                    </div>
                    <label for="email" class="col-sm-2 control-label">Direccion de Correo</label>
                    <div class="col-sm-3">
                  <input type="text" name="email" id="email" class="form-control"  value="<?= $row["emailUser"];?>" />
                  </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Contraseña</label>
                    <div class="col-sm-3">
                      <input type="password" name="pass" id="password" class="form-control"  value="<?= $pass0; ?>" maxlength="10"/>
                    </div>

                    <label for="status" class="col-sm-2 control-label">Estatus</label>
                    <div class="col-sm-3">
                    	 <select name="status" id="status" class="form-control">
                          <option value="<?= $row["statusUsers"];?>"><?= $row["statusUsers"];?></option>
                          <option value=""></option>
                          <option value="Enabled">Enabled</option>
                          <option value="Disabled">Disabled</option>
                     </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Posicion" class="col-sm-2 control-label">Posición</label>
                    <div class="col-sm-3">
                      <input type="text" name="posc" id="posicion" class="form-control" required  value="<?= $row["PoscUsers"];?>"/>
                    </div>
                </div>

                 <div class="form-group">
                         <h4 align="center"> <u>Perfiles</u> </h4>


				  <?php
				  			$item = 0;
							while($rowpr=$profiles->fetch_array(MYSQLI_ASSOC)){ ++$item;?>
                    	<div class="col-sm-2"></div>
                     		<div class="col-sm-5">
						<?php
							$query = "SELECT * FROM user_pro WHERE idUsers = '".$idUser."'
								AND idProfile = '".$rowpr["idProfile"]."' ";
							$result = $objDb->select($con,$query);

							if($rowpr1=$result->fetch_array(MYSQLI_ASSOC)){?>
                             <div class="funkyradio">
                                <div class="funkyradio-danger col-sm-5">
                                 <input type="checkbox" name="pro<?= $rowpr["idProfile"];?>" id="checkbox<?= $item;?>" checked/>
                                 <label for="checkbox<?= $item;?>"><?= $rowpr["nameProfi"];?></label>
                                </div>
                            </div>
							<?php
							}else{?>
                            <div class="funkyradio">
                                <div class="funkyradio-danger col-sm-5">
								<input type="checkbox" name="pro<?= $rowpr["idProfile"];?>" id="checkbox<?= $item;?>"/>
                                <label for="checkbox<?= $item;?>"><?= $rowpr["nameProfi"];?></label>
                                </div>
                            </div>
							<?php
							}
						?>


						<?php
                        	if($rowpr1["default"] == '1'){?>
								<div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                <a class="btn btn-success btn-sm active" name="cheked" data-toggle="profile<?= $item;?>" data-title="1">YES</a>
                                <a class="btn btn-default btn-sm notActive" name="cheked" data-toggle="profile<?= $item;?>" data-title="0">NO</a>
                            </div>
                            <input type="radio" name="profile" id="profile<?= $item;?>" value="<?= $rowpr["idProfile"];?>" checked class="hidden">
    					</div>
							<?php
							}else{?>
                            <div class="input-group">
                            <div id="radioBtn" class="btn-group">
								<a class="btn btn-success btn-sm notActive" name="cheked"data-toggle="profile<?= $item;?>" data-title="1">YES</a>
                                <a class="btn btn-default btn-sm active" name="cheked" data-toggle="profile<?= $item;?>" data-title="0">NO</a>
                       		</div>
                            <input type="radio" name="profile" id="profile<?= $item;?>" value="<?= $rowpr["idProfile"];?>" class="hidden">
    					</div>
							<?php
							}
							?>
                          </div>
                        <?php
						}
						?>

                  </div>

                    <hr class="divider">
                    <p align="center">
                   <a href="user_list.php" class="btn btn-default">Cancelar</a>
                    <?php //Validar los permisos para Modificar de Usuarios.
                        if(in_array('3',$_SESSION['roles'])){
                        ?>
                        <input type="submit" name="send" id="send" value="Save Changes" class="btn btn-primary" />
                        <?php
                        }else{
                        ?>
                       <input type="submit" name="send" id="send" value="Save Changes" class="btn btn-primary disabled" onClick="return false" />
                        <?php
                        }
                        ?>
                    </p>


						<?php
					}

				}

				?>
        </form>
    </div><!--FINAL DEL CONTAINER-->

    <!--cadena de comando para los script de la pagina principal-->
    <script>
		$('#radioBtn a').on('click', function(){
			var sel = $(this).data('title');
			var tog = $(this).data('toggle');
			if (sel == 1){
			$('#'+tog).prop( "checked", true );
			}else{
				$('#'+tog).prop( "checked", false );
			}

			$('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
			$('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
		})
	</script>

    </body>
</html>
