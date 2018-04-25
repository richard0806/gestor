 <?php
require 'class/conex.php';
require 'class/dbactions.php';
require 'global/constants.php';
require 'class/Pmenu.php';

$objCon = new Connection();
$con = $objCon->get_connected();

$hoy = date("Y-m-d");

$consulta_visita_real = "SELECT * FROM visitas WHERE fecha='$hoy'"; /*AND ip='".$_SERVER['REMOTE_ADDR']."'";*/
$rs_visita_real = $con->query($consulta_visita_real);

if ($rs_visita_real->num_rows == 0) {   
   $insert_real = "INSERT INTO visitas (ip, fecha, num) VALUES ('".$_SERVER['REMOTE_ADDR']."', '$hoy', 1)";
   $con->query($insert_real);
}else{
    $update_real = "UPDATE visitas SET num = (num+1) WHERE fecha = '{$hoy}'";
    $con->query($update_real);
}
?>