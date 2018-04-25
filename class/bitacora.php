 <?php 
	class Bitacora{

		public function __construct()
		{
			$this->objDb = new Database();
		}

		public function movimientos($con,$tipo,$doc,$id, $cant,$user,$now){
			$query = "INSERT INTO tbl_movimientos VALUES ('','{$tipo}','{$doc}','{$id}','{$cant}','{$user}','{$now}')";
			$this->result = $this->objDb->insert($con,$query);
		}
	}

?>