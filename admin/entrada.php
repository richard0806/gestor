<?php require '../global/objects.php';?>

<!DOCTYPE html>
<html>
	<head>
		<?php include_once '../global/header.php' ?>
		<title>Entradas-Almacen Siemens</title>
		<style>
			.container h3{
				display: inline;
			}
		</style>

    </head>


	<body>
		<?php require '../global/menu.php' ?>
		<article class="container" style="padding-top:50px;" id="accordion">
			<h3>Formularios de Entrada</h3>
			<?php
			 if(in_array('20',$_SESSION['roles'])){?>
				<button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModalNew"><i class="fa fa-plus"></i>
Crear Nuevo Producto</button>
	<?php
			 }else{?>
			<button type="button" class="btn btn-primary btn-sm disabled pull-right" onClick="return false" data-toggle="modal" data-target="#myModalNew"><img src="../cssalmacen/img/icon-imag/Add.png" width="20">
Crear Nuevo Producto</button>
 <?php
			 }
 ?>
			<hr style="border-color: #333;width: 100%">

		</div>

        <div class="despacho">
            <br>
        <!--CONTENEDOR DE LOS MENSAJES DE ERROR Y EXITO-->

                <div id="mensaje"></div>
      		<!--FINAL CONTENEDOR DE LOS MENSAJES DE ERROR Y EXITO-->
        <form method="post" action="javascript: fn_agregar();" id="formentrada" class="form-horizontal">
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
                <div class="col-sm-8"></div>
                <div class="col-sm-3">
                 <?php
              if(in_array('21',$_SESSION['roles'])){?>
               <input type="reset" name="limpiar" class="btn btn-primary btn-sm" id="limpiar" value="Limpiar" />
               <input name="agregar" type="submit" id="agregar" value="Agregar" class="btn btn-primary btn-sm" />
         <?php
              }else{?>
             <input type="reset" name="limpiar" class="btn btn-primary btn-sm disabled" onClick="return false" id="limpiar" value="Limpiar" />
             <input name="agregar" type="submit" id="agregar" value="Agregar" class="btn btn-primary btn-sm disabled" onClick="return false" />
        <?php
              }
        ?>

                </div>
             </div>

             </form>
             <br>
             <div id="mensaje1"></div>


             <hr class="divider">
             <br>
        <form method="post" action="" class="form-horizontal" id="tb_entrada">
				<input type="text" name="username" class="hidden" value="<?php echo $IdUser;?>" />
            <div class="form-group">
                <label class="col-sm-1" style="text-align:right;">Entrega Álmacen: </label>
                <div class="col-sm-3">
                 	<div class='input-group date' id='datetimepicker2'>
                 	<input type="text" name="entregaAlmacen" class="form-control" required/>
                    <span class="input-group-addon"><img src="../cssalmacen/img/icon-imag/fa-calendar.png" width="18" height="18" alt="Date"></span>
                    </div>
                </div>
					<label for="factura" class="col-xs-1 control-label">Factura: </label>
					<div class="col-sm-2">
						<input type="text" name="factura" class="form-control" maxlength="11" size="11" required id='factura'/>
					</div>
					<label class="col-sm-1" style="text-align:right;">Entrega a OPRET: </label>
					<div class="col-sm-3">
						<div class='input-group date' id='datetimepicker1'>
							<input type="text" name="entregaOpret" class="form-control" required/>
							<span class="input-group-addon"><img src="../cssalmacen/img/icon-imag/fa-calendar.png" width="18" height="18" alt="Date"></span>
						</div>
					</div>
			</div><!--/final del form-group/-->

            </div><!--/final del despacho/-->


             <div class="pull-left" style="font-size:18px; margin-left:20px;">Detalles de Entradas</div>
             <br>
            <div class="col-lg-12">
				<table class="table table-bordered table-condensed table-hover table-responsive" id="detalle-entrada">
					<thead>
						<tr>
							<th>Item</th>
							<th>Designacion</th>
							<th>Referencia</th>
							<th>ID</th>
							<th>Medida</th>
							<th>Cantidad</th>
							<th>Observaciones</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody id="detalle-entrada-cuerpo">
					</tbody>
					<tfoot>
						<tr>
							<td colspan="8" style="text-align:right; font-size:12px; color: red;"><strong>Cantidad:</strong> <span id="span_cantidad"></span> Productos.</td>
						</tr>
					</tfoot>
				</table>
            </div>
<br>
			<hr class="divider">

			<div class="form-group">

					<label for="observaciones" class="col-sm-2 control-label" style="text-align:right;">Observaciones: </label>
					<div class="col-sm-6">
						<textarea id="observaciones" name="observaciones" class="form-control" placeholder="Escriba el comentario aquí"></textarea>
					</div>

            	<div class="col-sm-4 text-center">

                <?php
					if(in_array('21',$_SESSION['roles'])){
				?>
					<button type="reset" class="btn btn-default" id="limpiar1"><img src="../cssalmacen/img/delete.png" width="25"> Cancelar</button>
					<button type="submit" id="enviar" class="btn btn-default"><img src="../cssalmacen/img/check.png" width="25"> Guardar e Imprimir</button>
				<?php
					}else{
				?>
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



    <!-- Modal Crear Producto
    ====================================================================================================-->
<div class="modal fade" id="myModalNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear Nuevo Producto</h4>
      </div>
      <form method="post" action="new_producto_exe.php" id="NewProducto" class="form-horizontal">
      <div class="modal-body">
        	<input type="text" name="username" class="hidden" value="<?php echo $IdUser;?>" required />
            <div class="form-group">
            	<label for="AT" class="col-sm-2 control-label">AT</label>
                <div class="col-sm-3">
                 <select name="AT" class="form-control" id="AT" required>
                    <option value="" selected>Seleccionar...</option>
                    <option value="CAT">CAT</option>
                    <option value="SEN">SEN</option>
                    <option value="ELE">ELE</option>
                 </select>
                 </div>
                 <label for="" class="col-sm-2 control-label">Procedencia</label>
                 <div class="col-sm-3">
                 <select name="Proc" class="form-control" id="Proc" >
                    <option value="" selected>Seleccionar...</option>
                    <option value="España">España</option>
                    <option value="Alemania">Alemania</option>
                 </select>
                 </div>
            </div>

            <div class="form-group">
                <label for="Descripcion" class="col-sm-2 control-label">Descripcion</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="Descripcion" name="Descripcion" placeholder="Designacion del Producto..." required>
                </div>
         	</div>

            <div class="form-group">
            <label for="Ref" class="col-sm-2 control-label">Referencia</label>
                <div class="col-sm-3">
                  <input type="text" name="Ref" id="Ref" class="form-control"  placeholder="8WL1234...">
                </div>
                <div class="col-sm-2">
                    <div class="checkbox" align="right">
                   		<label><input type="checkbox" id="keyword" name="keyword" value=""><b>Keyword</b></label>
                	</div>
                </div>

                <div class="col-sm-3">
                <input type="text" name="txtkeyword" id="txtkeyword" class="form-control" placeholder="Keyword" disabled/>
                </div>
            </div>



            <div class="form-group">
             <label for="SAP" class="col-sm-2 control-label">SAP</label>
                <div class="col-sm-3">
                  <input class="form-control" id="SAP" name="SAP" placeholder="A2V00000">
                </div>
                <label for="id_producto" class="col-sm-2 control-label">ID Producto</label>
                <div class="col-sm-2">
                	<div class="input-group">
                 		<input type="text" class="form-control required" id="id_producto" name="id_producto" placeholder="ID" maxlength="4" required onkeypress="return permite(event, "num")" readonly>
                        <div class="input-group-addon"><a id="fn_generar" style="cursor:pointer;"><img src="../cssalmacen/img/icon-imag/actualizar.png" width="20"></a></div>

                     </div>

                 </div>
                 <img id="loader2" src="../cssalmacen/img/loader (2).gif" width="32" height="32" style="display:none;">

            </div>
            <div class="form-group">
            	<label for="UdMedida" class="col-sm-2 control-label">Ud. Medida</label>
                <div class="col-sm-3">
                  <select name="UdMedida" class="form-control" id="UdMedida" required>
                    <option value="" selected>Seleccionar...</option>
                    <option value="Ud">Unidad</option>
                    <option value="Lb">Libra</option>
                    <option value="Mtr">Metros</option>
                    <option value="Pie">Pie</option>
                    <option value="Kit">Kit</option>
                    <option value="Par">Par</option>
                    <option value="Kg">Kg</option>
                 </select>
                </div>
                <label for="ubicacion" class="col-sm-2 control-label">Ubicacion</label>
                <div class="col-sm-3">
                	<input type="text" name="ubicacion" id="ubicacion" class="form-control" required placeholder="T00-I-D0"/>
                </div>
            </div>

            <div class="form-group">
            	<label for="Cantidad" class="col-sm-2 control-label">Cantidad</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="####" maxlength="4" onkeypress="return permite(event, 'num')" readonly value="0">
                </div>
                <div class="col-sm-1"></div>
                <label for="Almacen" class="col-sm-2 control-label">Almacen</label>
                <div class="col-sm-3">
                	<select id="Almacen" name="Almacen" class="form-control" required >
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
            	<label for="pertenece" class="col-sm-2 control-label">Pertence a</label>
                <div class="col-sm-3">
                <select name="pertenece" id="pertenece" class="form-control">
                	<option value="" selected>Seleccionar...</option>
                    <option value="1">Repuestos del Cliente</option>
                    <option value="2">Consumible</option>
                </select>
                </div>
                <label for="paquete" class="col-sm-2 control-label">Paquete</label>
                <div class="col-sm-3">
                	<select name="paquete" id="paquete" class="form-control" disabled>
                    	<option value="" selected>Seleccionar...</option>
                        <option value="1">EPC L1</option>
                        <option value="2">EPC L2</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
            <label for="comentario" class="col-sm-2 control-label">Comentarios</label>
                <div class="col-sm-8">
                	<textarea name="comentario" id="comentario" class="form-control" placeholder="Observaciones" ></textarea>
                </div>
            </div>
            <div id="ajax_loader"></div>
            <div id="load" style="display:none;">
            	<p align="center" >
      				<img src="../cssalmacen/img/loader (2).gif"><br><span>Espere un Momento</span>
           		</p>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="guardarmodal">Guardar Cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>

    <!--=====================FINAL DE LA PROGRAM. MODAL==================-->

    <!--cadena de comando para los script de la pagina principal-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/v4.0.0/src/js/bootstrap-datetimepicker.js"></script>
    <script src="../js/entrada.js"></script>
    <script src="../js/new_entrada.js"></script>
    <script src="../js/new_producto_exe.js"></script>
    <script src="../global/loader.js"></script>
<script src="../js/Alert/sweetalert.min.js"></script>
    <script type="text/javascript">
      $(function () {
        $('#datetimepicker1').datetimepicker();
				$('#datetimepicker2').datetimepicker();

				$('#guardarmodal').click(function(){
					$("#NewProducto .c_error").remove();//ocultamos el error de campo
				});
			});//FINAL FUNCTION().



        </script>
</body>
</html>
