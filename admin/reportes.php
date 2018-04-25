<?php 
  
  require'../global/security.php';

  //creación o instanciamiento de un objeto de la Clase Connection
  $objCon = new Connection();
  $con = $objCon->get_connected();

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../css/image/icon.png">
  <title>Reportes | GMant.</title>
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
  <script type="text/javascript" src="../js/report.js"></script>
  
</head>
<body> 
  <?php require'../global/menu.php' ?>
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link active" href="#">Active</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled" href="#">Disabled</a>
    </li>
  </ul>
</body>
</html>