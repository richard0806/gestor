<?php
//Llamado de los archivos clase
require'../global/security.php';
require'../class/users.php';
require'../class/roles.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$con = $objCon->get_connected();

//consultamos el listado de los usuarios!!
$objUse = new Users();
$list_users = $objUse->list_users($con);

//busca los roles de éste modulo

$objrol = new Roles();
$roles = $objrol->module_role($con,'11');


?>
<!doctype html>
<html>	
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../css/image/icon.png">
    <meta name="description" content="Gestor de Mantenimiento Siemens MSD">
    <meta name="author" content="RMSoluciones">
            <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/admin.css">
     <style>
    .ui-group-buttons{
        display: -webkit-box;
    }
    .ui-group-buttons a{
        margin-left:10px;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 8px;
        line-height: 0.8;
        vertical-align: top;
        border-top: none;
    }
    .table-fixed thead {
          width: 97%;
        }
        .table-fixed tbody {
          height: 230px;
          overflow-y: auto;
          width: 100%;
        }
        .table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
          display: block;
        }
        .table-fixed tbody td, .table-fixed thead > tr> th {
          float: left;
          border-bottom-width: 0;
        }

	</style>    
    </head>
        
 <body style="padding-top: 50px;">       
        <?php require'../global/menu.php'; ?>
       
       
     <div class="container"><!--container body central-->
        <h3 style="display: inline;">Lista de Usuarios</h3>
        <div class="pull-right" style="width: 300px;">
            <?php 
            if(in_array('1',$_SESSION['roles'])){
            ?>
            <a href="new_user.php" class="btn btn-default btn-sm btn-block"><i class="glyphicon glyphicon-user"></i>
             Nuevo Usuario</a>
            <?php
            }else{
            ?>
            <a href="new_user.php" onClick="return false" class="btn btn-default btn-sm btn-block">
            <i class="glyphicon glyphicon-user"></i> Nuevo Usuario</a>
            <?php
            }
            ?>
        </div><!--FINAL DEL DIV ALIGN CENTER-->
        
        <div class="row"><hr style="margin-top:25px;">
        <div class="span5">
            <table class="table table-striped table-condensed">
                  <thead>
                  <tr>
                      <th>Usuario</th>
                      <th>Correo</th>
                      <th>Role</th>
                      <th>Fecha registro</th>                      
                      <th>Status</th>
                      <th>Actions</th>                                          
                  </tr>
              </thead>   
              <tbody>
                 <?php
                    
                        $numrows = mysqli_num_rows($list_users);
                        
                        if($numrows > 0){
                            
                            while($row=mysqli_fetch_array($list_users,MYSQLI_ASSOC)){?>
                <tr>
                    <td><?= $row["loginUsers"];?></td>
                    <td><?= $row["emailUser"];?></td>
                    <td>2012/05/06</td>
                    <td><?= $row["PoscUsers"];?></td>
                    <td><span class="label label-success">Active</span></td> 
                    <td>
                        <div class="ui-group-buttons">
                        <?php
                        if(in_array('18',$_SESSION['roles'])){?>
                        <a href="assign_role.php?idUser=<?= $row["idUsers"];?>"><em class="fa fa-sliders" aria-hidden="true"></em></a>
                        <?php
                        }else{?>
                            <a href="assign_role.php?idUser=<?= $row["idUsers"];?>" onClick="return false"><i class="fa fa-sliders" aria-hidden="true"></i></a>
                        <?php
                        }
                        ?>
                        <div class="or"></div>
                        <?php 
                        if(in_array('3',$_SESSION['roles'])){?>
                            <a href="modify_user.php?idUser=<?= $row["idUsers"];?>"><em class="glyphicon glyphicon-pencil"></em></a>
                        <?php
                        }else{?>
                            <a href="modify_user.php?idUser=<?= $row["idUsers"];?>" onClick="return false"><em class="glyphicon glyphicon-pencil"></em></a>
                        <?php
                        }
                        ?>
                        <div class="or"></div>
                        <?php 
                        if(in_array('4',$_SESSION['roles'])){?>
                            <a href="delete_user.php?idUser=<?= $row["idUsers"];?>"><em class="glyphicon glyphicon-remove"></em></a>
                        <?php
                        }else{?>
                            <a href="delete_user.php?idUser=<?= $row["idUsers"];?>" onClick="return false"><em class="glyphicon glyphicon-remove"></em></a>
                        <?php
                        }
                        ?>
                    </div>
                    </td>                                      
                </tr> 
                 <?php
                            }
                            
                        }
                    
                        ?>                                  
              </tbody>
            </table>
            </div>
        </div>       
     </div><!--final del container body central--> 
       
    <!--cadena de comando para los script de la pagina principal-->
     <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    
    <script>
    $(function() {    
        $('#input-search').on('keyup', function() {
          var rex = new RegExp($(this).val(), 'i');
            $('.searchable-container .items').hide();
            $('.searchable-container .items').filter(function() {
                return rex.test($(this).text());
            }).show();
        });
        $('.sidebar-nav li').removeClass('active');
        $(".sidebar-nav li:eq(8)").addClass('active');
        $(".sidebar-nav li:eq(8) a").click(function(event){
            event.preventDefault();
        });
    });
        $(document).ready(function(){
            $(document).on("click",".sidebar-toggle",function(event){
                event.preventDefault();
                $(".wrapper").toggleClass("toggled");
            });
        });     
    </script>
        
    </body>

</html>