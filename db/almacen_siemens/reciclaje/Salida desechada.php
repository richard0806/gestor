<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<div class="jumbotron">
            <h1>Salida de Productos</h1>
            <p class="lead">Este módulo de <b>Salidas</b> tiene como objetivo principal la organización y control explícito de los productos existentes en cada uno de sus almacenes (si cuenta con ellos) dando responsabilidad de manejar dichos objetivos a los usuarios con acceso al mismo.</p>        
      	</div><!--FINAL DEL JUMBOTRON-->
		<hr>
		
        <div class="despacho">
        <h2><u>Nueva Salida</u></h2>        
        <br><br>
        <!--CONTENEDOR DE LOS MENSAJES DE ERROR Y EXITO-->
                <div id="diverror2" class="alert alert-danger alert-dismissible fade in" style="display:none;" role="alert"><i class="glyphicon glyphicon-exclamation-sign"></i> No se han encontrado registros</div>
                         
                <div id="mensaje"></div>       
      		<!--FINAL CONTENEDOR DE LOS MENSAJES DE ERROR Y EXITO-->
        <form method="post" action="new_salida_exe.php" id="formsalida" class="form-horizontal">
        <input type="hidden" name="username" value="<?php echo $IdUser;?>" />
                         
          <!--div class="form-group">            
                <label for="id_producto" class="col-sm-2 control-label">ID Producto</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="id_producto" name="id_producto" placeholder="Codigo" maxlength="4" required autofocus> 
                </div>
                 
            	<div class="col-sm-1">
                <button type="button" class="btn btn-link" id="cargar">Cargar datos</button>
                </div>
        </div-->
            
         <div class="form-group">  
                <!--label for="cantidad" class="col-sm-2 control-label">Cantidad</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="###" maxlength="4" required>
                </div-->
                <label for="OT" class="col-sm-2 control-label">OT Referencia</label>
                <div class="col-sm-2">
                	 <input type="text" class="form-control" name="OT" id="OT" placeholder="#####/Gesman#" maxlength="10" required>
                </div>
 		 </div>
          <!--div class="form-group">
                <label for="Descripcion" class="col-sm-2 control-label">Descripcion</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="Descripcion" name="Descripcion" placeholder="Nombre del Producto..." readonly>
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
  	  		</div-->
         	<div class="form-group">
                <!--label for="UdMedida" class="col-sm-2 control-label">Ud. Medida</label>
                <div class="col-sm-3">
                  <input class="form-control" id="UdMedida" name="UdMedida" readonly placeholder="Medida">
                </div-->               
                <label for="At" class="col-sm-2 control-label">Area Téc.</label>
                <div class="col-sm-3">
                  <input class="form-control" id="At" name="At" required readonly placeholder="Area tecnica">
                </div>           
         	</div>
           
           
            <div class="form-group">
             <label for="SAP" class="col-sm-2 control-label">SAP</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="SAP" name="SAP" placeholder="A2V00000000..." maxlength="14" readonly>
                </div>
                <label for="Ubicacion" class="col-sm-2 control-label">Ubicacion</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="Ubicacion" id="Ubicacion" size="10" placeholder="T54-I-B3" required readonly>
                </div>                        
  	  		</div>
            
            <!--div class="form-group">
            	<label for="Almacen32" class="col-sm-2 control-label">Almacen</label>
                <div class="col-sm-3">
                	<select name="Almacen32" id="Almacen32" required class="form-control" onchange="if(this.value==1) {document.getElementById('tipopaquete').disabled = false} else {document.getElementById('tipopaquete').disabled = true} ">
                    	<option value="" selected>Seleccionar...</option>
                        <option value="1">Almacen Mantenimiento</option>
										<option value="2">Almacen Sobrante</option>
										<option value="3">Almacen Eurodom</option>
										<option value="4">Almacen Sobt. Mant</option>
										<option value="5">No Comforme</option>
                    </select>
                </div-->
                <label for="tipopaquete" class="col-sm-2 control-label">Tipo Paquete</label>
                <div class="col-sm-3">
                	<select name="tipopaquete" id="tipopaquete" class="form-control" required="required" disabled="false">
						<option value="" selected>Seleccionar</option>
						<option value="1">EPC L1</option>
						<option value="2">EPC L2</option>
						<option value="3">Paquete L1 + L2</option>
					</select>
                	
                </div>                
            </div>
           
            
            <div class="form-group">
            	<label for="comentario" class="col-sm-2 control-label">Comentarios</label>
                <div class="col-sm-8">
                	<textarea name="comentario" placeholder="Comentario..." id="comentario" class="form-control" rows="3" cols="30"></textarea>
                </div>
            </div>
            
          <hr class="divider">
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10" align="right">
              <button type="reset" class="btn btn-default"><i class="glyphicon glyphicon-floppy-remove"></i> Cancelar</button>
              <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-saved"></i> Save Changer</button>
              
            </div>
  </div>
         
        </form>
        </div>
</body>
</html>