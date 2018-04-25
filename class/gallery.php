<?php 
class Galleries{

	public function __construct(){		
		$this->objDb = new Database();
		/*$this->objSe = new Sessions();*/
	}

	public function list_gallery($con, $id){
		$query = "SELECT image FROM tbl_img_prod WHERE id_prod = '{$id}' ";
		$this->result = $this->objDb->select($con, $query);
		return $this->result;
	}
}

?>