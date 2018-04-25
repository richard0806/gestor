<?php 
	
	/**
	* 
	*/
	class Almacen
	{
		
		public function __construct(){ 
			$this->objDb = new Database();
		}

		public function Show_alm($con){
			$query = "SELECT id, name FROM tbl_almacen ";
			$this->result = $this->objDb->select($con, $query);
			return $this->result;
		}
	}

?>