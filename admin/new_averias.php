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
require'../class/modules.php';
require'../class/dbactions.php';
require'../class/Pmenu.php';
require'../global/constants.php';

$objcon = new Connection();
$objcon->get_connected();

$fila2 = "";

$query=mysql_query("SELECT * FROM users WHERE loginUsers = '".$user."'");
$resultado=mysql_fetch_array($query);
	$IdUser = $resultado['idUsers'];
					
					$query2 = mysql_query("SELECT * FROM consulta");
						while($rows = mysql_fetch_array($query2)){
							$fila2.= '
								<tr>
									<td><input type="checkbox" name="Idselect" value="'.$rows["IdConsulta"].'"/></td>
									<td>'.$rows["IdProducto"].'</td>									
									<td>'.$rows["Designacion"].'</td>
									<td>'.$rows["Alias"].'</td>
									<td>'.$rows["Referencia"].'</td>
									<td>'.$rows["SAP"].'</td>
									<td>'.$rows["StockMant"].'</td>
									
							';
							} 
					

?>

<!doctype html>
<html>	
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="RMSoluciones">
    <link rel="icon" href="../cssalmacen/img/carrito.png">
<title>Nueva Averia-Almacen Siemens</title>
<link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.1/dist/css/bootstrap.css">
    
      <!-- Just for debugging purposes. Don't actually copy these 2 lines! 
	<script src="../../assets/js/ie8-responsive-file-warning.js"></script>-->    
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
     <link rel="stylesheet" type="text/css" href="../cssalmacen/datepicker/datepicker3.css">
     <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">
     <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/1.0.3/css/dataTables.responsive.css">
     <link rel="stylesheet" type="text/css" href="../cssalmacen/Alert/sweetalert.css">
<style>
     #formaverias
	 {
		 margin:auto;
	 }
	 /*
	  *
	  *Estilos para los formulario dependientes de 
	  *el modulo de creacion de averias!
	  */

	
	.stepwizard-step p {
		margin-top: 10px;
	}
	
	.stepwizard-row {
		display: table-row;
	}
	
	.stepwizard {
		display: table;
		width: 100%;
		position: relative;
	}
	
	.stepwizard-step button[disabled] {
		opacity: 1 !important;
		filter: alpha(opacity=100) !important;
	}
	
	.stepwizard-row:before {
		top: 14px;
		bottom: 0;
		position: absolute;
		content: " ";
		width: 100%;
		height: 1px;
		background-color: #ccc;
		z-order: 0;
	
	}
	
	.stepwizard-step {
		display: table-cell;
		text-align: center;
		position: relative;
	}
	
	.btn-circle {
	  width: 30px;
	  height: 30px;
	  text-align: center;
	  padding: 6px 0;
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	}
     </style>
    <script src="../jsalmacen/jquery-2.1.3.min.js"></script>  
    <script src="../../bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>  
    </head>
		
		
	<body>
		<!--MENUES======-->
           <?php require'../global/menu.php';?>
        <!--FINAL DE LOS MENUES======-->
        
        <div class="container">
        <div class="jumbotron">
            <h1>Crear Nueva Averias</h1>
            <p  class="lead">Módulo para la creación de averías nuevas asignadas a cada Jefe de Área Técnica.</p>        
      	</div><!--FINAL DEL JUMBOTRON-->
		<hr>
        </div>
        
      <div class="container">
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-circle btn-default btn-primary">1</a>
            <p>Módulo 1</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
            <p>Módulo 2</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Módulo 3</p>
        </div>
    </div>
</div>
<form action="validaraverias.php" method="post" name="formaverias" id="formaverias" class="form-horizontal" role="form">
    <div class="row setup-content" id="step-1" style="display: block;">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Crear Averia</h3>
                <br><br>
                 <div class="form-group"> 
                     <label for="estatus" class="col-sm-2 control-label">Estatus</label>
                     <div class="col-sm-2">
                      <select required="required" name="estatus" id="estatus" class="form-control">
                         <option value="" selected>Seleccionar...</option>
                         <option value="Abierto">Abierto</option>
                         <option value="Cerrado">Cerrado</option>
                      </select>
                     </div>
                     <div class="col-sm-3"></div>
                      <div class="checkbox col-sm-3">
                          <label>
                            <input name="checkbox[]" type="checkbox" id="checkbox" value="Es imputable" /> Es Imputable
                          </label>
                      </div>
                      <div class="checkbox col-sm-2">
                      	<label>
                        	<input name="checkbox[]" type="checkbox" id="checkbox" value="Es critico" /> Es Critica
                        </label>
                      </div>
                 </div><!--/FINAL DEL FORM GROUP-->
                 
                 
                 <div class="form-group">
                 	<label for="fechainforme" class="col-sm-2 control-label">Informe</label>
                    <div class="col-sm-3">
                    	<input type="text" name="fechainforme" id="fechainforme" placeholder="dd/mm/yyyy" required class="form-control dp">
                    </div>
                    <div class="col-sm-2"></div>
                    <div class="checkbox col-sm-3">                    
                    	<label>
                        	<input name="checkbox[]" type="checkbox" id="checkbox" value="En garantia" />En Garantia
                        </label>
                    </div>
                    <div class="checkbox col-sm-2">
                        <label>
                        	<input name="checkbox[]" type="checkbox" id="checkbox" value="Material pendiente" />Material Pendiente
                        </label>
                    </div>
                 </div><!--/FINAL DEL FORM GROUP-->
                 
                 <div class="form-group">
                 	<label for="fechapresencia" class="col-sm-2 control-label">Presencia</label>
                 	<div class="col-sm-3">
                    	<input type="text" name="fechapresencia" id="fechapresencia" placeholder="dd/mm/yyyy" required class="form-control dp">
                    </div>
                    <label class="col-sm-2 control-label" for="linea">Linea</label>
                    <div class="col-sm-3">
                          <select id="linea" name="linea" required="" onchange="llamarAjaxGETpro()" class="form-control">         
                            <option value="" selected>Seleccionar...</option>
                            <?php
                                $consult=mysql_query("SELECT * FROM ubicacion_activos");
                              while($fil=mysql_fetch_assoc($consult))
                              {
                              echo "<option value=".$fil['linea'].">".$fil['descripcion']."</option>";
                              }
                            ?>
                          </select>                    	
                    </div>
                 </div><!--/FINAL DEL FORM GROUP-->
                 
                 <div class="form-group">
                 	<label for="fechasituacion" class="col-sm-2 control-label">En Situ</label>
                 	<div class="col-sm-3">
                    	<input type="text" name="fechasituacion" id="fechasituacion" placeholder="dd/mm/yyyy" required class="form-control dp">
                    </div>
                    <label for="ubicacion" class="col-sm-2 control-label">Ubicacion: </label>
                    <div class="col-sm-3">
                    	<select id="ubicacion" name="ubicacion" required class="form-control">
                         	<option value="" selected>Seleccionar...</option> 
                            <!--esto lo llena el jquery automatico-->
                      	</select>
                    </div>
                 </div><!--/FINAL DEL FORM GROUP-->
                 
                 <div class="form-group">
                 	<label for="fechainicio" class="col-sm-2 control-label">Inicio</label>
                 	<div class="col-sm-3">
                    	<input type="text" name="fechainicio" id="fechainicio" placeholder="dd/mm/yyyy" required class="form-control dp">
                    </div>
                    <label for="At" class="col-sm-2 control-label">Aréa Tec.: </label>
                    <div class="col-sm-3">
                    	<select name="At" id="At" required="required" class="form-control">
                          	<option value="" selected>Seleccionar...</option>
                            <option value="CATRIG">CAT-RIG</option>
                            <option value="OCL">OCL</option>
                            <option value="SET">SET</option>
                            <option value="CT">CT</option>
                            <option value="SEN">SEN</option>
                       </select>
                    </div>
                 </div><!--/FINAL DEL FORM GROUP--> 
                 
                 <div class="form-group">
                 	<label for="fechafin" class="col-sm-2 control-label">Fin</label>
                 	<div class="col-sm-3">
                    	<input type="text" name="fechafin" id="fechafin" placeholder="dd/mm/yyyy" required class="form-control dp">
                    </div>
                    <label for="" class="col-sm-2 control-label">Sintomas</label>
                    <div class="col-sm-3">
                    	<select name="Ssintomas" id="Ssintomas" class="form-control">
                           <option value="" selected>Seleccionar...</option>
                           <option value="prueba">Prueba</option>
                            <!--select llenado con json de jquery-->
                            <?php echo $sintomas; ?>  
                         </select>
                    </div>
                    <div class="col-sm-1">
                    	<input type="button" value="Agregar" id="bsintomas" class=" btn btn-link" data-toggle="modal" data-target=".bs-example-modal-sm1"/>
                    </div>
                 </div><!--/FINAL DEL FORM GROUP--> 
                 
                 <div class="form-group">
                 	<label for="ot" class="col-sm-2 control-label">OT Referencia</label>
                 	<div class="col-sm-3">
                    	<input type="text" name="ot" id="ot" required placeholder="Ej:OT-1234"class="form-control" maxlength="12">
                    </div>
                    <label for="Scausas" class="col-sm-2 control-label">Causas</label>
                    <div class="col-sm-3">
                    	<select name="Scausas" id="Scausas" class="form-control">
                           <option value="" selected>Seleccionar...</option>
                           <option value="prueba">Prueba</option>
                           <!--select llenado con json de jquery-->
                           <?php echo $causas; ?>
                        </select>
                    </div>
                    <div class="col-sm-1">
                    <input type="button" value="Agregar" id="bcausas" class="btn btn-link" data-toggle="modal" data-target=".bs-example-modal-sm2" />
                    </div>
                 </div><!--/FINAL DEL FORM GROUP--> 
                 
                 <div class="form-group">
                 	<label for="equipo" class="col-sm-2 control-label">Equipo: </label>
                 	<div class="col-sm-3">
                    	<select name="equipo" id="equipo" required="required" class="form-control">
                          <option value="" selected >Seleccionar...</option>
                          <option value="prueba">Conjunto anclaje fuerte 2 tirantes - 8m</option>
                        </select>
                    </div>
                    <label for="Ssolucion" class="col-sm-2 control-label">Solucion</label>
                    <div class="col-sm-3">
                    	<select name="Ssolucion" id="Ssolucion" class="form-control">
                           <option value="" selected>Seleccionar...</option>
                           <option value="prueba">Prueba</option>
                           <!--select llenado con json de jquery-->
                           <?php echo $solucion; ?>
                        </select>
                    </div>
                    <div class="col-sm-1">
                    	<input type="button" value="Agregar" id="bsolucion" class="btn btn-link" data-toggle="modal" data-target=".bs-example-modal-sm3"/>
                    </div>
                 </div><!--/FINAL DEL FORM GROUP-->
                 
                 <div class="form-group">
                    <label for="tiemporeparacion" class="col-sm-2">Tiempo de Reparacion</label>
                    <div class="col-sm-3">
                    	<input data-format="hh:mm:ss" type="text" class="form-control" name="tiemporeparacion" id="tiemporeparacion" readonly/>
                     </div>
                      <label for="tiemporespuesta" class="col-sm-2 control-label">Tiempo de Respuesta</label>
                    <div class="col-sm-3">
                    	<input data-format="hh:mm:ss" type="text" class="form-control" name="tiemporespuesta" id="tiemporespuesta" readonly>
                    </div>
                 </div><!--/FINAL DEL FORM GROUP--> 
                 
                 <div class="form-group">
                 	<label for="observacion" class="col-sm-2 control-label">Observacion</label>
                 	<div class="col-sm-3">
                    	<textarea name="observacion" cols="20" rows="5" placeholder="Observaciones de algo en particular" class="form-control"></textarea>
                    </div>
                 </div><!--/FINAL DEL FORM GROUP--> 
                 
                 
                 <div class="form-group hidden">
                 <label>Creado por: </label> <input type="text" name="username" class="form-control" disabled="" value='<?php echo $_SESSION['user']."-".date ("Y-n-j H:i:s")?>'>
                       
                        <label>Modificador:</label><input type="text" name="username" size="30" disabled="" value='<?php echo $_SESSION['user']."-".date ("Y-n-j H:i:s")?>' class="form-control">
                      
                    <input style="visibility:hidden" type="text" name="username1" value="<?php echo $IdUser;?>"/>
                 	
                 </div><!--/FINAL DEL FORM GROUP-->
                
                <!--/FINAL DEL MODULO DE CREACION DE NUEVAS AVERIAS
                =========================================================================-->
                <hr class="divider">
                <nav>
                  <ul class="pager">
                    <li class="next"><a class="nextBtn">Siguiente <span aria-hidden="true">&rarr;</span></a></li>
                  </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-2" style="display: none;">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Solicitudes</h3>
               <p align="center"><button  id="nsolucion" class="btn btn-link" data-toggle="modal" data-target=".bs-example-modal-sm4"/><i class="glyphicon glyphicon-plus"></i> Nueva Solicitud</button></p>
                  <table width="100%" border="1"class="table table-bordered table-condensed table-hover" id="table2">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Código</th>
                          <th>Repuesto</th>
                          <th>Stock</th>
                          <th>Devueltos</th>
                          <th>Consumos</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!--/esta table se va a llenar con un JQUERY-->
                      </tbody>
                    </table>
                    <hr class="divider">
                <nav>
                  <ul class="pager">
                    <li class="previous"><a href="#" class="prevBtn"><span aria-hidden="true">&larr;</span> Anterior</a></li>
                    <li class="next"><a class="nextBtn">Siguiente <span aria-hidden="true">&rarr;</span></a></li>
                  </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3" style="display: none;">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Labores</h3>
                <br><br>
                <p>Esta seccion es para Labores.</p>
                <hr class="divider">
                <ul class="pager">
                    <li class="previous"><a href="#" class="prevBtn"><span aria-hidden="true">&larr;</span> Anterior</a></li>
                    <li class="next"><a><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</a></li>
                    <li class="next"><a><i class="glyphicon glyphicon-remove-sign"></i> Cancelar</a></li>
                  </ul>
                </nav>
                <button class="btn btn-success btn-lg pull-right" type="submit">Finish!</button>
            </div>
        </div>
    </div>
</form>
</div>


<!--PIE DE PAGINA
    ==========================================-->
     <?php require'../global/pie_pagina.php';?>
<!--===============FINAL===================-->

<!--MODAL DE LOS BOTONES DE SINTOMAS,SOLUCION,CAUSAS
        ===========================================================================================================-->
        <div class="modal fade bs-example-modal-sm1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title">AGREGAR SINTOMAS</h5>
              </div>
              <input type="hidden" name="opcion1" id="opcion1" class="center" readonly>
              <form method="post" action="" id="formsintomas" name="formsintomas">
                <div class="modal-body">
                  <fielset>                  
                    <label for="newsintomas">Sintoma: </label>
                    <input type="text" name="newsintomas" id="newsintomas" maxlength="17" class="form-control" required>
                    <label for="comentario">Comentarios: </label>
                    <textarea name="comentario" id="newcomentario" cols="10" rows="5" class="form-control"></textarea>   
                  </fielset>
                  <fieldset class="loader">                        
                    <img src="../cssalmacen/img/loader (2).gif"><br><span>Espere un Momento</span>
                  </fieldset> 
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Save changes">
                </div>
              </form> 
            </div>
          </div>
        </div>
      <!--===================================================FINAL============================================================-->
      <div class="modal fade bs-example-modal-sm2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h5 class="modal-title">AGREGAR CAUSAS</h5>
            </div>
            <input type="hidden" name="opcion1" id="opcion1" class="center" readonly>
            <form method="post" action="" name="formcausas" id="formcausas">
            <div class="modal-body">
              <fielset>
                <label for="newcausas">Causas: </label>
                <input type="text" class="form-control" required maxlength="17" name="newcausas" id="newcausas" />
                <label for="comentario">Comentarios: </label>
                <textarea name="comentario" id="newcomentario" cols="10" rows="5" class="form-control"></textarea>
              </fielset>              
                <fieldset class="loader">                        
                  <img src="../cssalmacen/img/loader (2).gif"><br><span>Espere un Momento</span>
                </fieldset>
            
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Save changes">
              </div>
            </form>          
          </div>
        </div>
      </div>
      <!--===============================================FINAL=================================================================-->
      <div class="modal fade bs-example-modal-sm3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h5 class="modal-title">AGREGAR SOLUCION</h5>
            </div>
            <input type="hidden" name="opcion1" id="opcion1" class="center" readonly>
            <form method="post" action="" name="formsolucion" id="formsolucion" >
              <div class="modal-body">
                <fielset>
                  <label for="newsolucion">Solucion: </label>
                  <input type="text" class="form-control" name="newsolucion" id="newsolucion" required maxlength="17"/>
                  <label for="comentario">Comentario: </label>
                  <textarea name="comentario" id="newcomentario" cols="10" rows="5" class="form-control"></textarea>
                </fielset>
                <fieldset class="loader">                        
                  <img src="../cssalmacen/img/loader (2).gif"><br><span>Espere un Momento</span>
                </fieldset> 
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-primary" value="Save changes">
                </div>
            </form>
          </div>
        </div>
      </div>
      <!--=============================================FINAL==================================================================-->
       <div class="modal fade bs-example-modal-sm4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Nueva Solicitud</h4>
            </div>
            <form method="post" action="" name="form" id="form" class="form-horizontal" >
              <div class="modal-body">              
          <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <div class="row">
          	<div class="col-sm-12">
            	<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                	<thead>
                    	<tr>
                        	<th>Marcar</th>
                        	<th>ID</th>
                            <th>Código</th>
                            <th>Designacion</th>
                            <th>Palabra Clave</th>
                            <th>Referencia</th>
                            <th>Sap</th>
                            <th>Existencia</th>
                        </tr>
                    </thead>
                    <tbody style="text-align:center;">
                    <?php echo $fila2; ?>
                    </tbody>
                </table>
            </div><!-- /Final del col-sm-12/ -->
          </div><!--/final del div row-->
       	 </div><!--/final de el div datatable completo-->
              <hr class="divider">
              <div class="form-group">
                    <label for="tipo" class="col-sm-2 control-label">Tipo de Averia</label>
                    <div class="col-sm-3">
                      <select class="form-control" required id="tipo">
                      	<option value="" selected>Seleccionar...</option>
                        <option value="Correctivo">Correctivo</option>
                        <option value="Preventivo">Preventivo</option>
                      </select>
                     </div>
                     <label for="fecha" class="col-sm-2 control-label">Fecha</label>
                  <div class="col-sm-3">
                  <input type="text" name="fecha" id="fecha" class="form-control dp" placeholder="dd/mm/yyyy" required><!--/este input tiene que ser datetime-->
                  </div>
              </div>
              
              <div class="form-group">
                  <label for="equipo" class="col-sm-2 control-label">Equipo</label>
                  <div class="col-sm-3">
                     <select name="equipo" id="equipo" class="form-control" required>
                        <option value="" selected>Seleccionar</option>
                        <?php
                          $raveria = mysql_query("SELECT * FROM averias WHERE Estatus='Abierto' ORDER BY id_averias desc");
                            while ($rave=mysql_fetch_array($raveria)) {
                              echo '<option value='.$rave["id_averias"].'>'.$rave["Equipo_averiado"].'</option>';
                            }
                          ?>
                      </select> 
                   </div>
                    <label for="entrega" class="col-sm-2 control-label">Entrega</label>
                  <div class="col-sm-3">
                    <select name="entrega" id="entrega" class="form-control" required> 
                            <option value="">Seleccionar</option>                       
                              <?php
                              $entrega = mysql_query("SELECT * FROM users");
                                while ($por=mysql_fetch_array($entrega)) {
                                  echo '<option value='.$por["idUsers"].'>'.$por["loginUsers"].'</option>';
                                }
                              ?>
                     </select>
                  </div>
              </div><!--/FINAL DEL FROM-GROUP-->
              
              <div class="form-group">
              	<label for="recibe" class="col-sm-2 control-label">Recibe</label>
              	<div class="col-sm-3">
                <input type="text" name="recibe" id="recibe" required placeholder="Recibido por" class="form-control">
                </div>
                <label for="observaciones" class="col-sm-2 control-label">Observaciones</label>
                <div class="col-sm-3">
                	<textarea name="observaciones" id="observaciones" placeholder="Comment..." class="form-control"></textarea>
                </div>
              </div><!--/FINAL DEL FROM-GROUP-->
             
             <div class="form-group"> 
               		<div class="col-sm-12"> 
                    <fieldset class="loader text-center">                        
                      <img src="../cssalmacen/img/loader (2).gif"><br><span>Espere un Momento</span>
                    </fieldset>
                    </div> 
                </div>
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-primary" value="Save changes">
                </div>
            </form>
          </div>
        </div>
      </div>
      <!--=============================================FINAL==================================================================-->
   
   
        
    <!--cadena de comando para los script de la pagina principal-->
    <script src="../jsalmacen/jquery-2.1.3.min.js"></script> 
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="../jsalmacen/offcanvas.js"></script>
    <script src="../jsalmacen/activos.js"></script>
    <script src="../jsalmacen/datepickers/datepicker.js"></script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="../jsalmacen/Alert/sweetalert.min.js"></script>

<!--/Script para el modulo de crear averias/-->
<script language="javascript">
$(document).ready(function(){
	$(".loader").hide();
    	$( ".dp" ).datepicker({
        //changeMonth: true,
        //changeYear: true
        });
     $('#example').DataTable();
	

});
    </script>
	<script type="text/javascript">
	$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'], select, textarea, input[type='checkbox']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});
	</script>
</body>
</html>