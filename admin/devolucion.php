<?php
	require'../global/security.php';
	require'../class/almacen.php';
	require'../class/productos.php';

	//creación o instanciamiento de un objeto de la Clase Connection
	$objCon = new Connection();
	$con = $objCon->get_connected();

	$objAlm = new Almacen();
	$objProd = new Productos();
	$objAT = new AT();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="icon" href="../css/image/icon.png">
	<title>NC | GMant.</title>
	<!--/CSS/-->
	<link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/admin.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css"/>

	<!--/SCRIPT/-->
	<script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
	<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../jquery-uitablefilter-master/jquery.uitablefilter.js"></script>
	<script type="text/javascript" src="../js/permitir_caracter.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.tr.min.js"></script>
	<script src="../js/moment.min.js"></script>
	<script type="text/javascript" src="../js/devoluciones.js"></script>


	<style>
		form label{
			display: block;
			margin-left: 5px;
			margin-bottom: 0px;
			text-transform: uppercase;
			font-size: 12px;

		}
		.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9{
			padding-left: 0px;
		}
		.form-horizontal .form-group {
			margin-right: 0px;
		    margin-bottom: 5px;
		}
		.modal.modal-wide .modal-dialog {
		  width: 90%;
		}
		.modal-wide .modal-body {
		  overflow-y: auto;
		}
		.table-search tbody tr:hover {
		  background-color: #333;
		  color: #fff;
		}
		.btn-inverse{
			background: #333;
		    border-radius: 0;
		    color: #fff;
		    padding: 0px 5px;
		}
		.btn-inverse:hover, .btn-inverse:focus{
			color: #079b9d;
		}


	</style>
</head>
<body>
	<?php require'../global/menu.php' ?>
	<article class="container" style="padding-top:50px;" id="accordion">
				<h3>Formularios de Nota de Crédito</h3>
				<hr style="border-color: #333;width: 100%">
	    		<div class="pull-right" style="position: relative;top: -20px;">
	    			<a class="btn-inverse btn" role="button" data-toggle="collapse" data-parent="#accordion" href="#cForm" aria-expanded="true" aria-controls="cForm">
			          <i class="fa fa-angle-double-down fa-lg" aria-hidden="true"></i><br>
			        </a>
        		</div>

	    <section class="main col-sm-offset-1">
        		<div id="cForm" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
	    		<form action="" id="formOT" class="form-horizontal" autocomplete="off">

	    			<div class="form-group">
	    				<label for="txtalmacen">Almacén</label>
	    				<div class="col-sm-3">
	    					<select class="form-control input-sm" name="txtalmacen" id="txtalmacen">
								<option value="">**Seleccione**</option>
								<?php
									$numRows = 0;
									$listAlm = $objAlm->Show_alm($con);
									$numRows = $listAlm->num_rows;

									if($numRows > 0){
										while($rows = $listAlm->fetch_array(MYSQLI_ASSOC)){
											echo '<option value='.$rows["id"].'>'.$rows["name"].'</option>';
										}
									}
								?>
	    					</select>
	    				</div>
	    			</div>
	    			<div class="form-group validate">
	    				<label for="">ID</label>
	    				<div class="col-sm-2">
	    					<input type="text" class="form-control input-sm" name="txtid" id="txtid" required="" onkeypress="return permite(event, 'num')">
	    				</div>
	    				<div class="col-sm-4">
	    					<button class="btn btn-sm btn-primary cargar"><i class="fa fa-spinner" aria-hidden="true"></i> Cargar</button>
	    					<button type="button" class="btn btn-sm btn-default listar" data-toggle="modal" href="#listModal"><i class="fa fa-list" aria-hidden="true"></i> Listar</button>
	    				</div>
	    			</div>
	    			<div class="form-group">
	    				<label for="">Descripcion</label>
	    				<div class="col-sm-8">
	    					<input type="text" class="form-control input-sm" id="txtdescripcion" readonly="" style="color: blue; text-transform: uppercase;" >
	    				</div>
	    			</div>
	    			<div class="form-group">
	    				<div class="col-sm-3">
	    					<input type="text" class="form-control input-sm" id="txtreferencia" readonly="" style="color: blue">
	    				</div>
	    				<div class="col-sm-3">
	    					<input type="text" class="form-control input-sm" id="txtsap" readonly="" style="color: blue">
	    				</div>
	    			</div>
	    			<div class="form-group">
	    				<div class="col-sm-2">
	    					<input type="text" class="form-control input-sm" id="txtstock" readonly="" style="color: blue">
	    				</div>
	    				<div class="col-sm-1">
	    					<input type="text" class="form-control input-sm" id="txtmedida" readonly="" style="color: blue">
	    				</div><br><div class="col-sm-1"><label for="" style="margin-top: -15%;">Prestamo</label></div>
	    				<div class="material-switch col-sm-1">
                            <input id="txtprestamo" name="txtprestamo" type="checkbox"/>
                            <label for="txtprestamo" class="label-default"></label>
                        </div>


	    			</div>

	    			<div class="form-group">
	    				<label for="">Cant. Solicitada</label>
	    				<div class="col-sm-2">
	    					<input type="text" class="form-control input-sm" id="txtcant" style="color: blue; text-transform: uppercase;" onkeypress="return permite(event, 'num')">
	    				</div>
	    				<div class="col-sm-5" style="text-align: right;">
	    					<button type="button" class="btn btn-sm btn-primary btn-add"><i class="fa fa-plus" aria-hidden="true"></i> Agregar / F2</button>
	    					<button type="button" class="btn btn-sm btn-danger btn-reset"><i class="fa fa-trash" aria-hidden="true"></i> Cancelar</button>
	    				</div>
	    			</div>

	    		</form>
				</div>
	    </section>
	    <hr style="border-color:#333;">
	    <div class="pull-right" style="position: relative;top: -20px; display: inline-block;">
			<a role="button" class="btn btn-inverse" data-toggle="collapse" data-parent="#accordion" href="#Ctable" aria-expanded="true" aria-controls="cForm">
	          <i class="fa fa-angle-double-down fa-lg" aria-hidden="true"></i>
	        </a><span class="badge" id="badgecant"></span>
        </div>

        <div id="Ctable" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        	<form action="" class="form-horizontal main col-sm-offset-1" id="frmRef">
        		<div class="form-group">
        			<!--label for="">Tipo de Documento</label>
    				<div class="col-sm-2">
    					<select class="form-control input-sm" name="txtTipoSalida" id="txtTipoSalida">
    						<option value="1" selected="selected">Salida Oficial</option>
    						<option value="2">Salida Interna</option>
    					</select>
    				</div-->

	    			<label for="" style="margin-top: -16px;">AT</label>
	    			<div class="col-sm-2">
    					<select class="form-control input-sm" name="txtAt">
    						<option value="">**Seleccione**</option>
								<?php
									$numList = 0;
									$list = $objAT->listAt($con);
									$numList = $list->num_rows;

									if($numList > 0){
										while($row = $list->fetch_array(MYSQLI_ASSOC)){
											echo '<option value='.$row["id"].'>'.$row["name"].'</option>';
										}
									}
								?>
    					</select>
    				</div>
    				<label for="" style="margin-top: -16px;">OT No.</label>
    				<div class="col-sm-2" style="margin-left:15px;">
    					<div class="form-group multiple-form-group input-group">
                            <div class="input-group-btn input-group-select">
                                <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown">
                                <span class="concept">Gesman</span> <span class="caret"></span>
                                </button>
                                    <ul class="dropdown-menu" role="menu">
                                       	<li><a href="#Gesman">Gesman</a></li>
                                        <li><a href="#OT">OT</a></li>
                                        <li><a href="#SNO">SNO</a></li>
                                    </ul>
                                    <input type="hidden" class="input-group-select-val" name="type" value="Gesman" id="type">
                            </div>
                            <input type="text" name="Ot" class="form-control input-sm" required id="Ot" maxlength="6" onkeypress="return permite(event, 'num')">
                        </div>
    				</div>
					<label for="" style="margin-top: -16px;">Fecha</label>
    				<div class="col-sm-3">
	    				<div class="input-group txtDate" id="dp3" data-date="<?=date('Y-m-d')?>" data-date-format="yyyy-mm-dd">
					      <input name="txtDate" class="form-control input-sm" type="text" value="<?=date('Y-m-d')?>">
					      <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar" id="butt"></i></span>
					  	</div>
				  </div>
    			</div>
        	</form>
	    <div style="background: #333; text-align:right; font-size:12px; color:#fff;padding:5px;border-bottom: 1px solid rgb(72, 72, 72);">
	    	<strong>Cantidad:</strong>
	    	<span id="span_cantidad">0</span> Productos.
	    </div>
	    <table class="table table-striped table-condensed" id="tableDetalles">
			<thead style="background-color: #333;color: #079b9d;">
				<tr>
                 	<th hidden>Item</th>
                    <th>Designacion</th>
                    <th>Referencia</th>
                    <th>ID</th>
                    <th>Medida</th>
                    <th>Cantidad</th>
                    <th hidden>Almacen</th>
                    <th>Condición</th>
                    <th>Observaciones</th>
                    <th>Accion</th>
               	 </tr>
			</thead>
			<tbody id="cuerpodetalles"></tbody>
		</table>
		<hr style="border-color:#333;">
		<div style="text-align:right;">
	    	<button type="button" class="btn btn-sm btn-primary" id="submit">Procesar</button>
	    	<button type="reset" class="btn btn-sm btn-default">Cancelar</button>
	    </div>
		</div>
	</article>

	<!--/MODALS/-->
	<div id="listModal" class="modal modal-wide fade">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        <h4 class="modal-title">Productos</h4>
	        <div class="pull-right col-sm-3">
	        	<input type="search" class="form-control" id="input-search">
	        </div>

	      </div>
	      <div class="modal-body">
	        <table class="table table-striped table-search">
	        	<thead>
		        	<tr>
		        		<th width="8%">Items</th>
		        		<th width="8%">ID</th>
		        		<th width="80%">Descripción (ID OPRET)</th>
		        		<th width="20%">Referencia</th>
		        		<th width="20%">SAP</th>
		        	</tr>
	        	</thead>
	        	<tbody></tbody>
	        </table>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="nota-informativa"></div>
	<?php require'../global/load.php'; ?>
	<!--/END MODALS/-->
	<?php
		$con->close();
	?>
</body>
</html>
