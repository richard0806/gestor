<?php

require'../class/sessions.php';

require'../global/security.php';
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

//Obtenemos los perfiles existentes
$profiles = $objPro->show_profiles();

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
            <title>Modulo de Usuarios!!</title>
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
        <form name="newUser" action="new_user_exe.php" method="post" class="form-horizontal">
        		<h2 align="center">Crear nuevos Usuarios!!!</h2>  
                <br><br>                
                 <div class="form-group">			
                    <label for="login" class="col-sm-2 control-label">Nombre de Usuario</label>
                    <div class="col-sm-3">
                      <input type="text" name="login" id="login" class="form-control" maxlength="15" required autofocus />
                    </div>
                    <label for="email" class="col-sm-2 control-label">Direccion de Correo</label>
                    <div class="col-sm-3">
                 	 <input type="text" name="email" id="email" class="form-control" required />
                  	</div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Contraseña</label>
                    <div class="col-sm-3">
                      <input type="password" name="pass" id="password" class="form-control"   maxlength="10" required/>
                    </div>
                    <label for="status" class="col-sm-2 control-label">Estatus</label>
                    <div class="col-sm-3">
                     <select name="status" id="status" class="form-control" required>
                          <option value=""></option>
                          <option value="Enabled">Enabled</option>
                          <option value="Disabled">Disabled</option>
                     </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="Posicion" class="col-sm-2 control-label">Posición</label>
                    <div class="col-sm-3">
                      <input type="text" name="posc" id="posicion" class="form-control" required/>
                    </div>
                </div>
                
                <div class="form-group">        
                   		<h4 align="center"> <u>Perfiles</u> </h4>		 
                     	<?php 
							$item = 0;
							while($rowpr=mysql_fetch_array($profiles)){ ++$item;?>
                            <div class="col-sm-2"></div> 
                       	 <div class="col-sm-5">
                             <div class="funkyradio">	
                                <div class="funkyradio-danger col-sm-5">
                                    <input type="checkbox" name="pro<?php echo $rowpr["idProfile"];?>" id="checkbox<?php echo $item;?>"/>
                                    <label for="checkbox<?php echo $item;?>"><?php echo $rowpr["nameProfi"];?></label>                 
                                </div>
                            </div>
                        	<div class="input-group">
                                <div id="radioBtn" class="btn-group">
                                <a class="btn btn-success btn-sm notActive" name="cheked" data-toggle="profile<?php echo $item;?>" data-title="1">YES</a>
                                <a class="btn btn-default btn-sm active" name="cheked" data-toggle="profile<?php echo $item;?>" data-title="0">NO</a>
                            </div>
                            <input type="radio" name="profile" id="profile<?php echo $item;?>" value="<?php echo $rowpr["idProfile"];?>" class="hidden">
    					</div>
                   		</div>
						<?php
                         }
						?>
                        
                      
                    
                  </div>
                  
                    <hr class="divider">
                    <p align="center">
                    <a href="user_list.php" class="btn btn-default">Cancelar</a>
                    <?php //Validar los permisos para la Creacion de Modulos.
                        if(in_array('1',$_SESSION['roles'])){
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