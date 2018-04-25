<?php
$archivo = $_FILES['image']['name'];
if($archivo != ""){
$target_path = "./uploads/";
//$target_path = dirname(__FILE__)."/";

$target_path = $target_path . basename( $_FILES['image']['name']); 
if($error_up = move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) { 
$var = "El archivo ". basename( $_FILES['image']['name']). " ha sido subido";
} 
else{
$var = "Ha ocurrido un error, trate de nuevo!";
}
}
/*

include "class.upload.php";

$image = new Upload($_FILES["image"]);
if($image->uploaded){
	$image->Process("uploads/");
	if($image->processed){
		echo "Upload Success";
	}else{
		echo "Error: ".$image->error;
	}
}*/

?>
