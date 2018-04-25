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
    <meta name="author" content="RMSoluciones">
    <link rel="icon" href="../cssalmacen/img/carrito.png">
		<title>Averias-Almacen Siemens</title>
     <link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.1/dist/css/bootstrap.min.css">  
     
      <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <script src="../../assets/js/ie8-responsive-file-warning.js"></script>
     <script src="../assets/js/ie-emulation-modes-warning.js"></script>
     

    <!-- Custom styles for this template -->
     <link rel="stylesheet" type="text/css" href="../cssalmacen/carousel.css">
     <link rel="stylesheet" type="text/css" href="../cssalmacen/offcanvas.css">
     <link rel="stylesheet" type="text/css" href="../cssalmacen/justified-nav.css">
<link rel="stylesheet" type="text/css" href="../cssalmacen/Alert/sweetalert.css">
    </head>
		
		
	<body>
		<!--MENUES======-->
           <?php require'../global/menu.php';?>
        <!--FINAL DE LOS MENUES======-->
        
        
      <div class="container">
      	<div class="jumbotron">
            <h1>Modulo de Averias</h1>
            <p class="lead">Este módulo consiste en ver solicitudes creadas y crear nuevas luego de ejecutar una serie de procedimientos que llevan a la detención de estas fallas.</p>        
      	</div><!--FINAL DEL JUMBOTRON-->
		<hr>
		
        <div class="despacho">
         <h2><strong>Record de Averias</strong></h2>
          <?php 
              if(in_array('15',$_SESSION['roles'])){?>
               <a href="new_averias.php" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Crear Averias</a>
         <?php
              }else{?>
             <a href="new_averias.php" class="btn btn-success disabled" onClick="return false"><i class="glyphicon glyphicon-plus"></i> Crear Averias</a>
        <?php
              }
        ?> 
         
         <br><br>
		<span class="pull-right"><strong>Cantidad:</strong> <span id="span_cantidad"></span> averías.</span>
         <table class="table table-bordered table-hover table-condensed table-responsive" id="table1">
                    <thead>
                    <tr>
                      <th>AT</th>
                      <th>OT / Gesman</th>
                      <th>Estatus</th>
                      <th>Ubicacion</th>
                      <th>Fecha Informe</th>                   
                      <th>Fecha fin</th>
                      <th>Imputable</th>
                      <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody id="listaaverias">
                      <?php echo $contenido?>
                    </tbody>
                  </table>
         
        </div>
    </div><!--FINAL DEL CONTAINER-->
    
    
    <!--PIE DE PAGINA
    ==========================================-->
     <?php require'../global/pie_pagina.php';?>
	<!--===============FINAL===================-->
    
    <!--Pantallas Modales para mejor efecto visual a la pagina
    ===========================================================-->
   <div class="modal fade" id="myModalEntrada" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
    <script src="../jsalmacen/offcanvas.js"></script>
    <script src="../jsalmacen/Alert/sweetalert.min.js"></script>
	<script>

		$(document).ready(function()
			{
                		fn_dar_eliminar();
				fn_cantidad();
            		});

		function fn_cantidad()
			{
				cantidad = $("#table1 tbody").find("tr").length;
				$("#span_cantidad").html(cantidad);
			};

		function fn_dar_eliminar(){
                	$("a.elimina").on('click',function(){
                    	Item = $(this).parents("tr").find("td").eq(0).html();
				var parent = $(this).parents('tr').get(0);
				swal({   title: "Está seguro?",  
					 text: "Desea eliminar este Producto: " + Item,  
					 type: "warning",   
					 showCancelButton: true,   
					 confirmButtonColor: "#DD6B55",   
					 confirmButtonText: "Yes, Continuar!",   
					 cancelButtonText: "No, Cancelar!",   
					 closeOnConfirm: false,   
					 closeOnCancel: false 
				}, function(isConfirm){   
				 	if (isConfirm) {									
						$(parent).remove();
						fn_cantidad();
						swal("Listo!", "El registros No. "+ Item +" ha sido eliminado.", "success");     
						
					} else {     
						swal("Cancelado", "Proceso declinado perteneciente al ítems: " + Item, "error");  
					} 
				});                    
                	});			
	
		};
	</script>
   	</body>
</html>