<?php 
class Busqueda
{
	
	public function __construct()
	{
		$this->objDb = new Database();
	}
	public function search_by_arg($con, $arg, $at)
	{
		if($at != 'all'){		
			$query = "SELECT id,designacion, keyword, ref, SAP, id_prod, id_opret, medida FROM tbl_productos WHERE id_at ='{$at}' AND (designacion LIKE '%{$arg}%' OR id_prod LIKE '%{$arg}%' OR ref LIKE '%{$arg}%' OR SAP LIKE '%{$arg}%' OR keyword LIKE '%{$arg}%') ";
			$this->result = $this->objDb->select($con,$query);

			if(mysqli_connect_errno()){
				die("Hubo un problema de consulta" .mysqli_connect_error());
			}
		}else{
			$query = "SELECT id,designacion, keyword, ref, SAP, id_prod, id_opret, medida FROM tbl_productos WHERE designacion LIKE '%{$arg}%' OR id_prod LIKE '%{$arg}%' OR ref LIKE '%{$arg}%' OR SAP LIKE '%{$arg}%' OR keyword LIKE '%{$arg}%'  ";
			$this->result = $this->objDb->select($con,$query);

			if(mysqli_connect_errno()){
				die("Hubo un problema de consulta" .mysqli_connect_error());
			}
		}
		return $this->result;
	}
	public function stock_actual($con, $id, $alm){
		$query = "SELECT cantidad FROM tbl_stock where id_prod = {$id} AND id_alm = {$alm}";
		$this->result = $this->objDb->select($con,$query);

		if(mysqli_connect_errno()){
			die("Hubo un problema de consulta" .mysqli_connect_error());
		}
		return $this->result;
	}
	public function ubic_single_prod($con, $id){
		$query = "SELECT id_ubic1, id_ubic2, id_ubic3, id_ubic4 FROM tbl_prod_ubic where id_prod = {$id}";
		$this->result = $this->objDb->select($con,$query);

		return $this->result;
	}
}
?>