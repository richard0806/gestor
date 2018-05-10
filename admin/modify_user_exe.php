<?php
//Llamado de los archivos clase
require'../class/segurity.php';
require'../class/users.php';
require'../class/profiles.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$con = $objCon->get_connected();

$objUse = new Users();

$objUse->modify_user($con);

header('Location: user_list.php');

?>
