<?php

require'../global/objects.php';

$objrol = new Roles();

$result = $objrol->assign_roles($con);

header('Location: user_list.php');


?>
