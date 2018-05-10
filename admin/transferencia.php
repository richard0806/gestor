<?php

require'../global/objects.php';



?>
<!doctype html>
<html>
	<head>
		<?php include_once '../global/header.php' ?>

		<title>Transferencias-Almacen Siemens</title>
    <!-- Custom styles for this template -->
     <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/v4.0.0/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    </head>

<body>
		<!--MENUES======-->
           <?php require'../global/menu.php';?>
        <!--FINAL DE LOS MENUES======-->

       <div class="container"><br>
       <br>
       <br>
           <h3>Formularios de Transferencia</h3>
        <hr style="border-color: #333;width: 100%">

 			<div class="row">
                  <div class="col-xs-12">

                      	<h4 style="padding-left:100px;">Almacén</h4>
                          <form action="#" method="post" id="fromtransferencia" class="form-horizontal">
                          		<input type="text" name="username" class="hidden" value="<?=  $IdUser;?>" />

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
				<button type="button" class="btn btn-default" id="limpiar1"><img src="../css/img/delete.png" width="25"> Cancelar</button>
              	<button type="submit" id="enviar" class="btn btn-default"><img src="../css/img/check.png" width="25"> Procesar</button>
         <?php
              }else{?>
             <button type="button" class="btn btn-default disabled" onClick="return false" id="limpiar1"><img src="../css/img/delete.png" width="25"> Cancelar</button>
              <button type="submit" id="enviar" class="btn btn-default disabled" onClick="return false"><img src="../css/img/check.png" width="25"> Procesar</button>
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
    <script src="../global/load.js"></script>
    <script src="../jsalmacen/Transferencia.js"></script>
    <script src="../jsalmacen/new_transferencia.js"></script>
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
