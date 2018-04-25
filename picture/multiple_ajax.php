<?php
require '../class/conex.php';
require '../class/dbactions.php';
require '../global/constants.php';
require '../class/Pmenu.php';

if (isset($_FILES["file"]))
{
   $reporte = null;
     for($x=0; $x<count($_FILES["file"]["name"]); $x++)
    {
    $file = $_FILES["file"];
    $nombre = $file["name"][$x];
    $tipo = $file["type"][$x];
    $ruta_provisional = $file["tmp_name"][$x];
    $size = $file["size"][$x];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "./../css/foto_prod/";
    
    if ($tipo != 'image/jpeg' && $tipo != 'image/jpg' && $tipo != 'image/png' && $tipo != 'image/gif')
    {
        $reporte .= "<p style='color: red'>Error $nombre, el archivo no es una imagen.</p>";
    }
    else if($size > 2048*2048)
    {
        $reporte .= "<p style='color: red'>Error $nombre, el tamaño máximo permitido es 2 Mb</p>";
    }
    else if($width > 800 || $height > 800)
    {
        $reporte .= "<p style='color: red'>Error $nombre, la anchura y la altura máxima permitida es de 500px</p>";
    }
    else if($width < 60 || $height < 60)
    {
        $reporte .= "<p style='color: red'>Error $nombre, la anchura y la altura mínima permitida es de 60px</p>";
    }
    else
    {
        $src = $carpeta.$nombre;
        move_uploaded_file($ruta_provisional,$src);
        //INSERT INTO `tbl_img_prod`(`id`, `id_prod`, `image`, `us_crea`, `date_crea`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
        $objCon = new Connection();
		$con = $objCon->get_connected();

        date_default_timezone_set("America/Santo_Domingo");
        $now = date("Y") . "-" . date("m") . "-" . date("d");
	//print_r($file);

        $query = "INSERT INTO tbl_img_prod VALUES ('', '{$_POST["id_prod"]}', '{$nombre}', '2', '{$now}')";
        $con->query($query);
        echo "<p style='color: blue'>La imagen $nombre ha sido subida con éxito</p>";
    }
    }
        echo $reporte;
}
