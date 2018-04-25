<?php 
	class Productos{

		public function __construct()
		{
			$this->objDb = new Database();
		}

		public function list_prod($con,$idAlm){
			//CASE WHEN salario > 34685 THEN (salario * 0.15) WHEN salario > 52027.41 THEN (salario * 0.20)    WHEN salario >72260.25 THEN (salario * 0.25)    ELSE 0 END
			$query ="SELECT P.id_opret, P.id_prod, P.designacion, P.ref, P.SAP, S.cantidad FROM tbl_productos P JOIN tbl_stock S WHERE P.id_prod = S.id_prod AND S.id_alm = {$idAlm} ";
			$this->result = $this->objDb->select($con,$query);

			return $this->result;
		}
		public function crit_list_prod($con,$idAlm,$at){
			//CASE WHEN salario > 34685 THEN (salario * 0.15) WHEN salario > 52027.41 THEN (salario * 0.20)    WHEN salario >72260.25 THEN (salario * 0.25)    ELSE 0 END
			$query ="SELECT P.id_opret, P.id_prod, P.designacion, P.ref, P.SAP, P.medida, S.cantidad FROM tbl_productos P JOIN tbl_stock S WHERE P.id_prod = S.id_prod AND S.id_alm = {$idAlm} AND P.id_at = {$at}";
			$this->result = $this->objDb->select($con,$query);

			return $this->result;
		}
		public function single_prod($con, $id)
		{
			$query = "SELECT designacion, ref, SAP, medida, id_opret FROM tbl_productos WHERE id_prod = {$id} LIMIT 1";
			$this->result = $this->objDb->select($con, $query);

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
		public function move_prod($con, $id)
		{
			$query = "SELECT tipo, doc, cantidad, date_crea FROM tbl_movimientos WHERE id_prod = {$id} ORDER BY date_crea DESC";
			$this->result = $this->objDb->select($con, $query);

			return $this->result;
		}
		public function update_keyword($con, $id, $valor){
			$query = "UPDATE tbl_productos SET keyword = '{$valor}' WHERE id_prod = {$id} ";
			$this->objDb->update($con, $query);
		}
		public function update_alm($con,$id,$alm,$move,$cant){
			switch($move){
				case 'sal':
					$query = "UPDATE tbl_stock SET cantidad = cantidad - '{$cant}' WHERE id_prod = '{$id}' AND id_alm = '{$alm}' ";
					$this->objDb->update($con, $query);	
				break;
				case 'dev':
					$query = "UPDATE tbl_stock SET cantidad = cantidad + '{$cant}' WHERE id_prod = '{$id}' AND id_alm = '{$alm}' ";
					$this->objDb->update($con, $query);	
				break;
				case 'ent':
					$query = "UPDATE tbl_stock SET cantidad = cantidad + '{$cant}' WHERE id_prod = '{$id}' AND id_alm = '{$alm}' ";
					$this->objDb->update($con, $query);	
				break;
			}
		}
	}

	class AT{
		public function __construct()
		{
			$this->objDb = new Database();
		}
		public function listAt($con){
			$query = "SELECT * FROM tbl_at ORDER BY id ASC";
			$this->result = $this->objDb->select($con, $query);

			return $this->result;
		}
		public function singleAt($con, $id){
			$query = "SELECT name FROM tbl_at WHERE id = '{$id}' LIMIT 1";
			$this->result = $this->objDb->select($con, $query);

			return $this->result;
		}
	}

	class Ubicaciones{
		public function __construct()
		{
			$this->objDb = new Database();
		}
		public function single_ubic($con, $id){
			$query = "SELECT posicion FROM tbl_ubicaciones WHERE id ={$id}";
			$this->result = $this->objDb->select($con, $query);

			return $this->result;
		}
	}
?>