<?php

class Profiles{

	//atributos
	public $nameProf;
	public $objDb;
	public $result;

	public function __construct(){

		$this->objDb = new Database();

	}

	public function show_profiles($con){

		$query = "SELECT * FROM profiles";
		$this->result = $this->objDb->select($con, $query);
		return $this->result;

	}

	public function new_profile($con){

		date_default_timezone_set("America/Santo_Domingo");
		$date = date("Y") . "-" . date("m") . "-" . date("d");

		$query = "INSERT INTO profiles VALUES('', '".$_POST["code"]."', '".$_POST["name"]."',
			'".$_POST["desc"]."', '".$date."', '".$_POST["status"]."')";
		$this->objDb->insert($con,$query);

	}

	public function single_profile($con, $idProf){

		$query = "SELECT * FROM profiles WHERE idProfile = '".$idProf."' ";
		$this->result = $this->objDb->select($con,$query);
		return $this->result;

	}

	public function modify_profile($con){

		$query = "UPDATE profiles SET codeProfi = '".$_POST["code"]."', nameProfi = '".$_POST["name"]."',
			descProfi = '".$_POST["desc"]."', statusPro = '".$_POST["status"]."' WHERE idProfile = '".$_POST["idProf"]."' ";
		$this->objDb->update($con, $query);

	}

	public function delete_profile($con){

		$query = "DELETE FROM profiles WHERE idProfile = '".$_GET["idPerfil"]."' ";
		$this->objDb->delete($con, $query);

	}

	public function assign_module($con){

		$query = "DELETE FROM mod_profile WHERE idProfile = '".$_POST["idPerfil"]."' ";
		$this->objDb->delete($con, $query);
		$query = "SELECT * FROM modules";
		$this->result = $this->objDb->select($con, $query);
		while($row=$this->result->fetch_array(MYSQLI_ASSOC)){
			$name_module = str_replace(' ', '_', $row["nameModule"]);
			if(isset($_POST[$name_module])){
				$con->query("INSERT INTO mod_profile VALUES('', '".$row["idmodule"]."', '".$_POST["idPerfil"]."')");
			}
		}

	}

	public function look_assign($con,$idModule, $idProf){

		$query = "SELECT * FROM mod_profile WHERE idmodule = '".$idModule."' AND idProfile = '".$idProf."' ";
		$this->result = $this->objDb->select($con, $query);
		return $this->result;

	}

	public function user_pro($con,$pro){

		echo $pro; die();

		$query = "SELECT * FROM mod_profile, user_pro WHERE user_pro.idUsers = '".$_SESSION["iduser"]."'
			AND mod_profile.idProfile = user_pro.idProfile ";
		$this->result = $this->objDb->select($con,$query);
		return $this->result;

	}

}

?>
