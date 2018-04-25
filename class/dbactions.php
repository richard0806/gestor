<?php

class Database{
	
	public $result;
	
	public function __construct(){ }
	
	public function insert($con,$query){
		mysqli_query($con, $query);
	}
	
	public function select($con,$query){
		return $this->result = mysqli_query($con, $query);
	}
	
	public function update($con,$query){
		mysqli_query($con, $query);
	}
	
	public function delete($con,$query){
		mysqli_query($con, $query);
	}
	
}

?>