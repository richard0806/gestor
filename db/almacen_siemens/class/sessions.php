<?php

class Sessions{
	
	public function __construct(){ }
	
	public function init(){
		//session_name("loginUsuario");
		@session_start();
	}
	
	public function set($varname, $value){
		
		$_SESSION[$varname] = $value;
		
	}
	
	public function destroy(){
		
		session_unset();
		session_destroy();
		header('Location: http://'.$_SERVER["SERVER_NAME"].':8080/almacen_siemens/');
	}
	
}

?>