<?php

  require '../global/objects.php';

 ?>
<!DOCTYPE html>
<html>
<head>
  <?php include_once '../global/header.php' ?>
  <title>Reportes | GMant.</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css"/>

  <!--/SCRIPT/-->
  <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
  <script type="text/javascript" src="../js/report.js"></script>

</head>
<body>
  <?php require '../global/menu.php' ?>
  <br>
  <br>
  <br>
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link active" href="../report/consumos_mes.php">Consumos del Mes Pasado</a>
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
