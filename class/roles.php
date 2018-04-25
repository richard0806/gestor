<?php

class Roles{
	
	public $nameRol;
	public $objDb;
	public $result;
	
	public function __construct(){ 
	
		$this->objDb = new Database();
	
	}
	
	public function show_roles($con){
		
		$query = "SELECT * FROM roles, modules WHERE roles.idmodule = modules.idmodule ORDER BY idRole ASC";
		$this->result = $this->objDb->select($con, $query);
		return $this->result;
		
	}
	
	public function new_role($con){
		
		date_default_timezone_set("America/Santo_Domingo");
		$date = date("Y") . "-" . date("m") . "-" . date("d");
		
		$query = "INSERT INTO roles VALUES('', '".$_POST["code"]."', '".$_POST["name"]."', 
			'".$_POST["desc"]."', '".$date."', '".$_POST["status"]."', '".$_POST["module"]."')";
		$this->objDb->insert($con,$query);
		
	}
	
	public function single_role($con,$idrole){
		
		$query = "SELECT * FROM roles, modules WHERE roles.idRole = '".$idrole."' 
			AND roles.idmodule = modules.idmodule";
		$this->result = $this->objDb->select($con,$query);
		return $this->result;
		
	}
	
	public function modify_role($con){
		
		$query = "UPDATE roles SET codeRole = '".$_POST["code"]."', nameRole = '".$_POST["name"]."', 
			descRole = '".$_POST["desc"]."', statRole = '".$_POST["status"]."', idmodule = '".$_POST["modules"]."' 
			WHERE idRole = '".$_POST["idrole"]."' ";
		$this->objDb->update($con,$query);
		
	}
	
	public function module_role($con,$idmodule){
		
		$query = "SELECT * FROM roles WHERE idmodule = '".$idmodule."' ";
		$this->result = $this->objDb->select($con, $query);
		return $this->result;
		
	}
	
	public function delete_role($con){
		
		$query = "DELETE FROM roles WHERE idRole = '".$_GET["idrole"]."' ";
		$this->objDb->delete($con,$query);
		
	}
	
	public function assign_roles($con){
		
		$query = "DELETE FROM role_user WHERE idUsers = '".$_POST["idUser"]."' ";
		$this->objDb->delete($con,$query);
		
		$counter = 1;
		
		$result = $this->show_roles($con);
		
		//print_r($_POST);
		
		

		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			
			$namerole = 'role' . $counter;
			if(isset($_POST[$namerole])){
				/*echo "<br>";
				echo $namerole . "--";
				echo $_POST[$namerole]. "<BR>";*/
				$query = "INSERT INTO role_user VALUES('','".$_POST["idUser"]."','".$_POST[$namerole]."')";
				$this->objDb->insert($con,$query);
			}
			
			$counter = $counter + 1;
			
		}

	}
	
}

?>