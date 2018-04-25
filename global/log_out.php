<?php
	require 'constanst.php'; 
	session_start();
	session_unset();
	session_destroy();

	header("Location: ".URL."index.php");

?>