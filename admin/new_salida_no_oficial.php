﻿<?php

require'../class/sessions.php';
$objses = new Sessions();
$objses->init();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
	header('Location: http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].'/almacen_siemens/index.php?error=2');
}

?>
<?php

require'../class/config.php';
require'../class/modules.php';
require'../class/dbactions.php';
require'../class/Pmenu.php';
require'../global/constants.php';

$objcon = new Connection();
$objcon->get_connected();

$query=mysql_query("SELECT * FROM users WHERE loginUsers = '".$user."'");
$resultado=mysql_fetch_array($query);
	$IdUser = $resultado['idUsers'];


//alimentamos el generador de aleatorios
mt_srand (time());
//generamos un número aleatorio
$numero_aleatorio = mt_rand(100,9999);
$aleatorio = $numero_aleatorio;

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
    
		<title>Crear Salida-Almacen Siemens</title>
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
	<style>
	 /* Hiding the checkbox, but allowing it to be focused */
		.badgebox
		{
			opacity: 0;
		}

		.badgebox + .badge
		{
			/* Move the check mark away when unchecked */
			text-indent: -999999px;
			/* Makes the badge's width stay the same checked and unchecked */
			width: 27px;
		}

		.badgebox:focus + .badge
		{
			/* Set something to make the badge looks focused */
			/* This really depends on the application, in my case it was: */
			
			/* Adding a light border */
			box-shadow: inset 0px 0px 5px;
			/* Taking the difference out of the padding */
		}

		.badgebox:checked + .badge
		{
			/* Move the check mark back when checked */
			text-indent: 0;
		}
	</style>
    </head>
		
		
	<body>
		<!--MENUES======-->
           <?php require'../global/menu.php';?>
        <!--FINAL DE LOS MENUES======-->
        
        
      <div class="container">
      	<div class="jumbotron">
            <h1>Salida no Oficial de Productos</h1>
            <p class="lead">Este módulo de <b>Salidas</b> tiene como objetivo principal la organización y control explícito de los productos existentes en cada uno de sus almacenes (si cuenta con ellos) dando responsabilidad de manejar dichos objetivos a los usuarios con acceso al mismo.</p>        
      	</div><!--FINAL DEL JUMBOTRON-->
		<hr>
		
        <div class="despacho">
        	<h2><u>Nueva Salida</u></h2>        
        	<br><br>
        <!--CONTENEDOR DE LOS MENSAJES DE ERROR Y EXITO-->
                         
                <div id="mensaje"></div>       
      		<!--FINAL CONTENEDOR DE LOS MENSAJES DE ERROR Y EXITO-->
        <form method="post" action="javascript: fn_agregar();" id="formsalida" class="form-horizontal">
        <input type="text" name="username" class="hidden" value="<?php echo $IdUser;?>" />
        
        	<div class="form-group">
            	<label for="Almacen32" class="col-sm-2 control-label">Almacen</label>
                <div class="col-sm-3">
                	<select id="Almacen32" name="Almacen32" class="form-control" required >
                    	<option value="0" selected>Seleccionar...</option>
                        <option value="1">Almacen Mantenimiento</option>
						<option value="2">Almacen Sobrante</option>
						<option value="3">Almacen Eurodom</option>
						<option value="4">Almacen Sobt. Mant</option>
						<option value="5">No Comforme</option>
                    </select>
               	 </div>
                 <label for="id_producto" class="col-sm-2 control-label">ID Producto</label>
                <div class="col-sm-1">
                  <input type="text" class="form-control required" id="id_producto" name="id_producto" placeholder="ID" maxlength="4" required onkeypress="return permite(event, 'num')"> 
                </div>
                 
            	<div class="col-sm-1">
                <button type="button" class="btn btn-link" id="cargar">Cargar datos</button>
                </div>
            </div>
            
            <div class="form-group"> 
            	<label class="col-sm-2 control-label">Item</label>           
                <div class="col-sm-3">
                	<input type="text" class="form-control" id="Item" name="Item" placeholder="Item" required disabled> 
                </div>
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
                <label for="Stock" class="col-sm-2 control-label">Stock Actual</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="Stock" id="Stock" size="4" placeholder="Stock" required readonly>
                </div> 
                <input type="text" class="form-control hidden" id="SAP" name="SAP" placeholder="A2V0000..." readonly>                       
  	  		</div>
            
            <div class="form-group">
                <label for="UdMedida" class="col-sm-2 control-label">Ud. Medida</label>
                <div class="col-sm-3">
                  <input class="form-control" id="UdMedida" name="UdMedida" readonly placeholder="Medida">
                </div>
                <label for="comentario" class="col-sm-2 control-label">Comentarios</label>
                <div class="col-sm-4">
                	<textarea name="comentario" id="comentario" class="form-control" placeholder="Observaciones" ></textarea>
                </div>
            </div>
            
           <div class="form-group"> 
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                    <div class="checkbox" align="left">
			<label for="prestamo" class="btn btn-default">Prestamo <input type="checkbox" id="prestamo" name="prestamo" class="badgebox"><span class="badge">&check;</span></label>
                	</div>
                </div>
                <div class="col-sm-2"><input type="text" name="prestamo" id="txtprestamo" class="hidden" required/></div>
                <div class="col-sm-3">
                	<input type="reset" name="limpiar" class="btn btn-primary btn-sm" id="limpiar" value="Limpiar" />
                	<input name="agregar" type="submit" id="agregar" value="Agregar" class="btn btn-primary btn-sm" />
                </div>                
             </div>
             
             </form>
             <br>
             <div id="mensaje1"></div>
             
             
             <hr class="divider"> 
             <br>                    
             <form method="post" action="" class="form-horizontal" id="tb_salida">
             <input type="text" name="username" class="hidden" value="<?php echo $IdUser;?>" />
             <div class="form-group">
                 <label class="col-sm-2 control-label">AT que solicita: </label>
                 <div class="col-sm-2">
                 <select name="At" class="form-control" id="ATselect" required>
                    <option value="" selected>Seleccionar...</option>
                    <option value="CAT">CAT</option>
                    <option value="SEN">SEN</option>
                    <option value="ELE">ELE</option>
		    <option value="Opret">Opret</option>
                 </select>
                 </div>
                 

		<label for="Ot" class="col-sm-1 control-label">OT No.: </label>
                    <div class="col-sm-2">
                        <div class="form-group multiple-form-group input-group">
                            <div class="input-group-btn input-group-select">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="concept">SNO</span> <span class="caret"></span>
                                </button>
                                    <ul class="dropdown-menu" role="menu">
                                       <li><a href="#SNO">SNO</a></li>
                                    </ul>
                                    <input type="hidden" class="input-group-select-val" required name="type" value="SNO" id="type">
                            </div>
                            <input type="text" name="Ot" class="form-control" required readonly id="Ot" maxlength="5" value="<?php echo $aleatorio; ?>">
                        </div>
                    </div>

                 <label class="col-sm-1 control-label">Fecha: </label>
                 <div class="col-sm-3">
                 	<div class='input-group date' id='datetimepicker1'>
                 	<input type="text" name="fecha" class="form-control" required/>
                    <span class="input-group-addon"><img src="../cssalmacen/img/icon-imag/fa-calendar.png" width="18" height="18" alt="Date"></span>
                    </div>
                 </div><!--/final del form-group/-->
             </div><!--/final del despacho/-->
                          
             <br><br>
             
             <div class="pull-left" style="font-size:18px; margin-left:20px;">Detalles de Salida</div>
             <div class="col-lg-12">
             <table class="table table-bordered table-condensed table-hover table-responsive" id="detalle-salida">
                <thead bgcolor="#cccccc"> <tr>
                 	<th>Item</th>
                    <th>Designacion</th>
                    <th>Referencia</th>
                    <th>ID</th>
                    <th>Medida</th>
                    <th>Cantidad</th>
                    <th>Condición</th>
                    <th>Observaciones</th>
                    <th>Accion</th>
               	 </tr>	</thead>
                 <tbody id="detalle-salida-cuerpo">
                 </tbody>
                  <tfoot>
                	<tr>
                    	<td colspan="9" style="text-align:right; font-size:12px; background-color: #666; color:#FFF;"><strong>Cantidad:</strong> <span id="span_cantidad"></span> Productos.</td>
                    </tr>
                </tfoot>
             </table>
            </div>             
           <hr class="divider">
         	 <div class="form-group">
			<label for="observaciones" class="col-sm-2 control-label" style="text-align:right;">Observaciones: </label>
			<div class="col-sm-6">
				<textarea id="observaciones" name="observaciones" class="form-control" placeholder="Escriba el comentario aquí"></textarea>
			</div>

            	<div class="col-sm-4 text-center">

                         <?php 
              if(in_array('11',$_SESSION['roles'])){?>
               <button type="reset" class="btn btn-default" id="limpiar1"><img src="../cssalmacen/img/delete.png" width="25"> Cancelar</button>
              <button type="submit" id="enviar" class="btn btn-default"><img src="../cssalmacen/img/check.png" width="25"> Guardar e Imprimir</button>
         <?php
              }else{?>
             <button type="reset" class="btn btn-default disabled" onClick="return false" id="limpiar1"><img src="../cssalmacen/img/delete.png" width="25"> Cancelar</button>
              <button type="submit" id="enviar" class="btn btn-default disabled" onClick="return false"><img src="../cssalmacen/img/check.png" width="25"> Guardar e Imprimir</button>
        <?php
              }
        ?> 
                            
            	</div>
              </div>
              </form>
              </div>
        </div>
    </div><!--FINAL DEL CONTAINER-->
    
    
    <!--PIE DE PAGINA
    ==========================================-->
     <?php require'../global/pie_pagina.php';?>
	<!--===============FINAL===================-->
    
    <!--Pantallas Modales para mejor efecto visual a la pagina
    ===========================================================-->
   <div class="modal fade" id="myModalSalida" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
      <fieldset id="loader">
    		<p align="center" style="color:#fff;">    		
      		<img src="../cssalmacen/img/loader.gif"><br><span>Espere un Momento</span>
            </p>
      </fieldset>
   </div>
</div>
    
    <!--=====================FINAL DE LA PROGRAM. MODAL==========-->
        
    <!--cadena de comando para los script de la pagina principal-->
    <script src="../jsalmacen/jquery-2.1.3.min.js"></script>  
	<script src="../../bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>
	<script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
     <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/v4.0.0/src/js/bootstrap-datetimepicker.js"></script>
    <script src="../jsalmacen/offcanvas.js"></script>    
    <script src="../jsalmacen/salida.js"></script>
    <script src="../jsalmacen/new_salida.js"></script>
    <script src="../global/permitir_caracter.js"></script>
    <script src="../jsalmacen/Alert/sweetalert.min.js"></script>
    <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });

	   (function ($) {
                $(function () {

                    var selectFormGroup = function (event) {
                        event.preventDefault();

                        var $selectGroup = $(this).closest('.input-group-select');
                        var param = $(this).attr("href").replace("#","");
                        var concept = $(this).text();

                        $selectGroup.find('.concept').text(concept);
                        $selectGroup.find('.input-group-select-val').val(param);

                    }

                    $(document).on('click', '.dropdown-menu a', selectFormGroup);

                });
            })(jQuery);
        </script>
</body>
</html>