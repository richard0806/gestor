<?php

class Connection{
	//variables para los datos de la base de datos
	protected $server;
	protected $userdb;
	protected $passdb;
	protected $dbname;

	public function __construct(){

		//Iniciar las variables con los datos de la base de datos
		$this->server = 'localhost';
		$this->userdb = 'sec_user_gestor';
		$this->passdb = 'sSG0eo8283a~3';
		$this->dbname = 'db_gestor';
	}

	public function get_connected(){
		//Para conectarnos a MySQL
		$con = mysqli_connect($this->server, $this->userdb, $this->passdb,$this->dbname);
		if(mysqli_connect_errno()){
			die("Hubo un problema de conexion" .mysqli_connect_error());
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/gestor/signin.php');
		}
		mysqli_query ($con,"SET NAMES 'utf8'");
		return $con;
	}
}

?>
