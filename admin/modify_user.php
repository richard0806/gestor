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
require'../class/users.php';
require'../class/dbactions.php';
require'../class/profiles.php';
require'../class/Pmenu.php';
require'../global/constants.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

$objUse = new Users();
$objPro = new Profiles();

$idUser = $_GET['idUser'];

//Obtenemos el usuario a modificar
$single_user = $objUse->single_user($idUser);

//Obtenemos los perfiles existentes
$profiles = $objPro->show_profiles();

//buscar perfiles asignados
$objDb = new Database();

?>

<!DOCTYPE html>
<html>	
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../cssalmacen/img/carrito.png">
    <meta name="description" content="Gestor de Mantenimiento Siemens MSD">
    <meta name="author" content="RMSoluciones">
            <title>Modificar Usuarios!!</title>
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
     <link rel="stylesheet" type="text/css" href="../cssalmacen/Button radio and checkbox.css">
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
           <?php require'../global/menu.php';?>
        <!--FINAL DE LOS MENUES======-->    
    
     <div class="container"> 
     <h2 align="center">Modificar Usuarios Creados!!!</h2>  
                <br><br>  
        <form name="modUser" action="modify_user_exe.php" method="post" class="form-horizontal">
        <input type="hidden" name="idUsers" value="<?php echo $idUser;?>" />
                  	
                <?php
                
				$num_rows = mysql_num_rows($single_user);
				
				if($num_rows > 0){
					
					if($row=mysql_fetch_array($single_user)){ 
				//Codigo para ocultar contraseña por completo... 
				$espacio =$row["passUsers"];
				$pass0 = preg_replace('/([a-zA-Z0-9&\/\\#,+()$~%._":*¿?<>{}ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç\s])/', '*', $espacio)
				
		
		?>				

                 <div class="form-group">			
                    <label for="login" class="col-sm-2 control-label">Nombre de Usuario</label>
                    <div class="col-sm-3">
                      <input type="text" name="login" id="login" class="form-control" value="<?php echo $row["loginUsers"];?>" maxlength="15" />
                    </div>
                    <label for="email" class="col-sm-2 control-label">Direccion de Correo</label>
                    <div class="col-sm-3">
                  <input type="text" name="email" id="email" class="form-control"  value="<?php echo $row["emailUser"];?>" />
                  </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Contraseña</label>
                    <div class="col-sm-3">
                      <input type="password" name="pass" id="password" class="form-control"  value="<?php echo $pass0; ?>" maxlength="10"/>
                    </div>
                    
                    <label for="status" class="col-sm-2 control-label">Estatus</label>
                    <div class="col-sm-3">
                    	 <select name="status" id="status" class="form-control">
                          <option value="<?php echo $row["statusUsers"];?>"><?php echo $row["statusUsers"];?></option>
                          <option value=""></option>
                          <option value="Enabled">Enabled</option>
                          <option value="Disabled">Disabled</option>
                     </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="Posicion" class="col-sm-2 control-label">Posición</label>
                    <div class="col-sm-3">
                      <input type="text" name="posc" id="posicion" class="form-control" required  value="<?php echo $row["PoscUsers"];?>"/>
                    </div>
                </div>
                
                 <div class="form-group">
                         <h4 align="center"> <u>Perfiles</u> </h4>
                         
                     
				  <?php 
				  			$item = 0;
							while($rowpr=mysql_fetch_array($profiles)){ ++$item;?>
                    	<div class="col-sm-2"></div> 
                     		<div class="col-sm-5">
						<?php 							
							$query = "SELECT * FROM user_pro WHERE idUsers = '".$idUser."' 
								AND idProfile = '".$rowpr["idProfile"]."' ";
							$result = $objDb->select($query);
							
							if($rowpr1=mysql_fetch_array($result)){?>                            
                             <div class="funkyradio">	
                                <div class="funkyradio-danger col-sm-5">
                                 <input type="checkbox" name="pro<?php echo $rowpr["idProfile"];?>" id="checkbox<?php echo $item;?>" checked/>
                                 <label for="checkbox<?php echo $item;?>"><?php echo $rowpr["nameProfi"];?></label>
                                </div>
                            </div>
							<?php	
							}else{?>
                            <div class="funkyradio">	
                                <div class="funkyradio-danger col-sm-5">
								<input type="checkbox" name="pro<?php echo $rowpr["idProfile"];?>" id="checkbox<?php echo $item;?>"/>
                                <label for="checkbox<?php echo $item;?>"><?php echo $rowpr["nameProfi"];?></label>
                                </div>
                            </div>
							<?php
							}						
						?>
                        
                        
						<?php
                        	if($rowpr1["default"] == '1'){?>
								<div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                <a class="btn btn-success btn-sm active" name="cheked" data-toggle="profile<?php echo $item;?>" data-title="1">YES</a>
                                <a class="btn btn-default btn-sm notActive" name="cheked" data-toggle="profile<?php echo $item;?>" data-title="0">NO</a>
                            </div>
                            <input type="radio" name="profile" id="profile<?php echo $item;?>" value="<?php echo $rowpr["idProfile"];?>" checked class="hidden">
    					</div>    
							<?php
							}else{?>
                            <div class="input-group">
                            <div id="radioBtn" class="btn-group">
								<a class="btn btn-success btn-sm notActive" name="cheked"data-toggle="profile<?php echo $item;?>" data-title="1">YES</a>
                                <a class="btn btn-default btn-sm active" name="cheked" data-toggle="profile<?php echo $item;?>" data-title="0">NO</a>
                       		</div>
                            <input type="radio" name="profile" id="profile<?php echo $item;?>" value="<?php echo $rowpr["idProfile"];?>" class="hidden">
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
    <!--PIE DE PAGINA
    ==========================================-->
     <?php require'../global/pie_pagina.php';?>
	<!--===============FINAL===================-->
       
    <!--cadena de comando para los script de la pagina principal-->
    <script src="../jsalmacen/jquery-2.1.3.min.js"></script>  
	<script src="../../bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>
	<script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="../jsalmacen/offcanvas.js"></script>
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