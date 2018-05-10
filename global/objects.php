<?php
include_once 'security.php';

include_once '../class/conex.php';
include_once '../class/dbactions.php';
include_once 'constants.php';
include_once '../class/Pmenu.php';

include_once '../class/almacen.php';
include_once '../class/bitacora.php';
include_once '../class/gallery.php';
include_once '../class/modules.php';
include_once '../class/productos.php';
include_once '../class/profiles.php';
include_once '../class/roles.php';
include_once '../class/search.php';
include_once '../class/sessions.php';
include_once '../class/users.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$con = $objCon->get_connected();
?>
