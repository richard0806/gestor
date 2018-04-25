<?php

class move{
	
	public $objDb;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	public function new_entrada(){
		date_default_timezone_set("America/Santo_Domingo");
		$date = date("Y") . "-" . date("m") . "-" . date("d");
		
		//En esta seccion insertamos el usuario en la tabla users!!!
		$query = "INSERT INTO Entrada VALUES('', '".$_POST["At"]."', '".$_POST["Descripcion"]."', 
			'".$_POST["Ref"]."', '".$_POST["SAP"]."','".$_POST["id_producto"]."','".$_POST["UdMedidad"]."','".$_POST["cantidad"]."','".$_POST["Ubicacion"]."', '".$_POST["username"]."', '".$_POST["Almacen32"]."', '".$_POST["check_list"]."', '".$_POST["tipopaquete"]."', '".$_POST["comentario"]."', '".$date."')";
		$this->objDb->insert($query);
		}
}
?>