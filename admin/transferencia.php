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
    
		<title>Transferencias-Almacen Siemens</title>
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
     <link rel="stylesheet" type="text/css" href="../cssalmacen/justified-nav.css">
     <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/v4.0.0/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="../../font-awesome-4.3.0/css/font-awesome.css">
     <link rel="stylesheet" type="text/css" href="../cssalmacen/Alert/sweetalert.css">
    </head>

<body>
		<!--MENUES======-->
           <?php require'../global/menu.php';?>
        <!--FINAL DE LOS MENUES======-->
        
       <div class="container">
           <div class="jumbotron">
                <h1>Transferencias de Almacén</h1>
                <p class="lead">Este módulo de <b>Transferencias</b> esta encargado de todos los movimientos que suceden entre los almacén.</p>        
            </div><!--FINAL DEL JUMBOTRON-->
        <hr class="divider">

 			<div class="row">
                  <div class="col-xs-12">
                      
                      	<h4 style="padding-left:100px;">Almacén</h4>
                          <form action="#" method="post" id="fromtransferencia" class="form-horizontal">
                          		<input type="text" name="username" class="hidden" value="<?php echo $IdUser;?>" />
        						
                                <div class="form-group">
                                    <label for="Almacen1" class="col-sm-2 control-label">Desde</label>
                                    <div class="col-sm-3">
                                        <select id="Almacen1" name="Almacen1" class="form-control" required>
                                            <option value="0" selected>Seleccionar...</option>
                                            <option value="1">Almacen Mantenimiento</option>
                                            <option value="2">Almacen Sobrante</option>
                                            <option value="3">Almacen Eurodom</option>
                                            <option value="4">Almacen Sobt. Mant</option>
                                            <option value="5">No Comforme</option>
                                        </select>
                                     </div>
                                     
                                      <label for="Almacen2" class="col-sm-2 control-label">Hasta</label>
                                    <div class="col-sm-3">
                                        <select id="Almacen2" name="Almacen2" class="form-control" required>
                                            <option value="0" selected>Seleccionar...</option>
                                            <option value="1">Almacen Mantenimiento</option>
                                            <option value="2">Almacen Sobrante</option>
                                            <option value="3">Almacen Eurodom</option>
                                            <option value="4">Almacen Sobt. Mant</option>
                                            <option value="5">No Comforme</option>
                                        </select>
                                     </div>
                               </div>
                               
                               <div class="form-group">
                                     <label for="id_producto" class="col-sm-2 control-label">ID Producto</label>
                                    <div class="col-sm-1">
                                      <input type="text" class="form-control required" id="id_producto" name="id_producto" placeholder="ID" maxlength="4" required onkeypress="return permite(event, 'num')"> 
                                    </div>
                                     
                                    <div class="col-sm-1">
                                    <button type="button" class="btn btn-link" id="cargar">Cargar datos</button>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <label for="cantidad" class="col-sm-2 control-label">Cantidad</label>
                                    <div class="col-sm-2">
                                      <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="###" maxlength="4" required onkeypress="return permite(event, 'num')">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="Descripcion" class="col-sm-2 control-label">Descripcion</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="Descripcion" name="Descripcion" placeholder="Designacion del Producto..." readonly>
                                    </div>            
                                </div>
                                
                                 <div class="form-group">
                                    <label for="Ref" class="col-sm-2 control-label">Referencia</label>
                                    <div class="col-sm-3">
                                      <input type="text" class="form-control" id="Ref" name="Ref" placeholder="8WL1234..." readonly>
                                    </div>
                                    <label for="SAP" class="col-sm-2 control-label">SAP</label>
                                    <div class="col-sm-3">
                                      <input type="text" class="form-control" name="SAP" id="SAP" size="4" placeholder="A2V0000000" required readonly>
                                    </div>                        
                                </div>
                                
                                <div class="form-group hidden">
                                 <label for="Stock1" class="col-sm-2 control-label">Stock1</label>
                                    <div class="col-sm-3">
                                      <input type="text" class="form-control" id="Stock1" name="Stock1" size="4" readonly required/>
                                    </div>
                                    <label for="Stock2" class="col-sm-2 control-label">Stock2</label>
                                    <div class="col-sm-3">
                                      <input type="text" class="form-control" name="Stock2" id="Stock2" size="4" required readonly/>
                                    </div>                        
                                </div>
                                                               
                                <div class="form-group">                                     
                                    <label for="Medida" class="col-sm-2 control-label">Medida</label>
                                	<div class="col-sm-2">
                                    	<input type="text" class="form-control" name="Medida" id="Medida" readonly placeholder="Medida"/>
                                    </div>                                   
                                    <label for="comentario" class="col-sm-3 control-label">Comentarios</label>
                                    <div class="col-sm-3">
                                        <textarea name="comentario" id="comentario" class="form-control" placeholder="Observaciones" ></textarea>
                                    </div>
                                </div>
                                
                                <hr class="divider">
         	 <div class="form-group">
            	<div class="col-sm-offset-2 col-sm-10" align="right">
                <?php 
              if(in_array('24',$_SESSION['roles'])){?>
				<button type="button" class="btn btn-default" id="limpiar1"><img src="../cssalmacen/img/delete.png" width="25"> Cancelar</button>
              	<button type="submit" id="enviar" class="btn btn-default"><img src="../cssalmacen/img/check.png" width="25"> Procesar</button>
         <?php
              }else{?>
             <button type="button" class="btn btn-default disabled" onClick="return false" id="limpiar1"><img src="../cssalmacen/img/delete.png" width="25"> Cancelar</button>
              <button type="submit" id="enviar" class="btn btn-default disabled" onClick="return false"><img src="../cssalmacen/img/check.png" width="25"> Procesar</button>
        <?php
              }
        ?>
                            
            	</div>
              </div>
						</form> 
                      <!--/</div>Final del well/-->
                  </div> <!--/Final del col-xs-12/-->                
              </div><!--/Final del row de los formularios /-->
              </div><!--/Final del container /-->

 	<!--PIE DE PAGINA
    ==========================================-->
     <?php require'../global/pie_pagina.php';?>
	<!--===============FINAL===================-->
    
     <!--cadena de comando para los script de la pagina principal-->
    <script src="../jsalmacen/jquery-2.1.3.min.js"></script>  
	<script src="../../bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>
	<script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="../jsalmacen/offcanvas.js"></script>
    <script src="../global/permitir_caracter.js"></script>
    <script src="../global/loader.js"></script>
    <script src="../jsalmacen/Transferencia.js"></script>
    <script src="../jsalmacen/new_transferencia.js"></script>
    <script src="../jsalmacen/Alert/sweetalert.min.js"></script>
    <script>
	$(document).ready(function(e) {
			$('#enviar').prop( "disabled", true ); 
			$('#limpiar1').click(function(){
				limpiarformulario('#fromtransferencia');
			});
	 });
	
	
	</script>

</body>
</html>