<?php

        if (!empty($error_msg)) {
            echo $error_msg;
        }

//Llamado de los archivos clase
require '../global/objects.php';

$objUse = new Users();

if (isset($_POST["NameUsers"], $_POST["LastnameUsers"], $_POST["login"], $_POST["posc"], $_POST["email"], $_POST['p'], $_POST["status"], $_POST["profile"])) {
	$username = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // No es un correo electrónico válido.
        echo '<script> alert("La dirección de correo electrónico que ha introducido no es válido.");
					history.back();</script>';
    }
	$password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 32) {
        // La contraseña con hash deberá ser de 32 caracteres.
        // De lo contrario, algo muy raro habrá sucedido.
        echo '<script> alert("Configuración de contraseña no válida.");
					history.back();</script>';
    }

    // La validez del nombre de usuario y de la contraseña ha sido verificada en el cliente.
    // Esto será suficiente, ya que nadie se beneficiará de
    // violar estas reglas.
    //
	$prep_stmt = "SELECT * FROM users WHERE emailUser = '".$email."' LIMIT 1";
    $stmt = $con->query($prep_stmt);

   // Verifica el correo electrónico existente.
        if ( $stmt->num_rows == 1) {
            // Ya existe otro usuario con este correo electrónico.
            echo '<script> alert("Un usuario con esta dirección de correo electrónico ya existe.");
					history.back();</script>';
            return false;
        }
	$prep_stmt = "SELECT * FROM users WHERE loginUsers = '".$username."' LIMIT 1";
    $stmt = $con->query($prep_stmt);

   // Verifica el correo electrónico existente.
        if ( $stmt->num_rows == 1 ) {
            // Ya existe otro usuario con este correo electrónico.
            echo '<script> alert("Un usuario con este nombre de usuario ya existe.");
					history.back();</script>';
            return false;
        }

        // Crea una contraseña.
        $password = $_POST['p'];//hash('sha512', $password . $random_salt);

		//Capturamos la fecha actual del registro.
		date_default_timezone_set("America/Santo_Domingo");
		$date = date("Y") . "-" . date("m") . "-" . date("d").' '.date("H").':'.date("s").':'.date("i");

        // Inserta el nuevo usuario a la base de datos.
		$query = "INSERT INTO users VALUES('NULL', '".$_POST["NameUsers"]."', '".$_POST["LastnameUsers"]."', '".$username."', '".$_POST["posc"]."', '".$password."',
			'".$email."', '1', 'images', '".$_POST["status"]."', '1', '".$date."')";
			$insert_stmt = $con->query($query);
		if ($insert_stmt) {
			//Obtenemos el ID del Ultimo usuario ingresado a la tabla users!!
			$queryid = "SELECT * FROM users ORDER BY idUsers DESC Limit 1";
			$resultid = $con->query($queryid);
			if($proid=$resultid->fetch_array(MYSQLI_BOTH)){
				$idUser = $proid["idUsers"];
			}

			$queryPro = "SELECT * FROM profiles";
			$resultPro = $con->query($queryPro);
			while($rowPro= $resultPro->fetch_array(MYSQLI_BOTH)){
				if($rowPro["idProfile"] == $_POST["profile"]){
					$con->query("INSERT INTO user_pro VALUES('NULL', '".$_POST["profile"]."', '".$idUser."', '".$_POST["statusCheck"]."')");
				}
			}
            //header('Location:../user/');
            header('Location: user_list.php');
		}
}

?>
