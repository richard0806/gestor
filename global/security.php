<?php
	require'../class/sessions.php';
	$objses = new Sessions();
	$objses->init();

	$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

	if($user == ''){
		header('Location: http://'.$_SERVER["HTTP_HOST"].'/gestor/signin.php?error=2');
	}

	date_default_timezone_set("America/Santo_Domingo");
	$now = date("Y") . "-" . date("m") . "-" . date("d");
?>
