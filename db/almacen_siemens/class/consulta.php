<?php
class Consult{
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	public function Consul_item($id, $Alm){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM consulta WHERE IdProducto = '".$id."' AND Almacen = '".$Alm."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	

}
?>