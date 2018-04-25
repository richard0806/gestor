<?php

class Users{
	
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	public function login_in($con,$user, $pass){
		// para el inicio de sesion de los usuarios!!
		$query = "SELECT * FROM users, profiles, user_pro WHERE (users.loginUsers = '".$user."' OR users.emailUser = '".$user."') AND users.passUsers = '".$pass."' AND user_pro.idUsers = users.idUsers 
			AND user_pro.idProfile = profiles.idProfile AND user_pro.default = 1 AND users.statusUsers = 'Enabled'";
		$result = $this->objDb->select($con,$query);
		$rows = mysqli_num_rows($result);
		if($rows > 0){
			
			if($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
				//session_name("loginUsuario");
				 
				$this->objSe->init();
				$this->objSe->set('user', $row["loginUsers"]);
				$this->objSe->set('iduser', $row["idUsers"]);
				$this->objSe->set('idprofile', $row["idProfile"]);
				//$_SESSION['idUsers'] = $row["idUsers"];
								
				//$_SESSION["autentificado"]= "SI";
				 //defino la sesión que demuestra que el usuario está autorizado
				//$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
				//defino la fecha y hora de inicio de sesión en formato aaaa-mm-dd hh:mm:ss 
				/* 
				
				En Medio de los comentarios solo para probar
				
				*/
				
				$query2 = "SELECT * FROM mod_profile, user_pro WHERE user_pro.idUsers = '".$row["idUsers"]."' 
					AND mod_profile.idProfile =  user_pro.idProfile ";
				$resultmod = $this->objDb->select($con, $query2);
				$rows = $resultmod->num_rows;
				
				if($rows > 0){
					$counter = 0;
					$_SESSION['modules'][] = array();
					$_SESSION['profiles'][] = array();
					$_SESSION['roles'][] = array();
					//Obtenemos los Modulos que el usuario tiene asignados!!
					while($rowMod=mysqli_fetch_array($resultmod,MYSQLI_ASSOC)){
						
						if(in_array($rowMod["idmodule"],$_SESSION['modules'])){
							//echo "<br />" . $rowPro["idmodule"] . "Ya esta en el array." . "<br />";
						}else{
							$_SESSION['modules'][$counter] = $rowMod["idmodule"];
						}
						
						$counter = $counter + 1;
						
					}
					//Obtenemos los roles asignados al usuario!!!
					$query3 = "SELECT * FROM role_user WHERE idUsers = '".$row["idUsers"]."' ";
					$resultrol = $this->objDb->select($con, $query3);
					$counter = 0;
					while($rowRol=mysqli_fetch_array($resultrol, MYSQLI_ASSOC)){
						
						if(in_array($rowRol["idRolUs"],$_SESSION['roles'])){
							//echo "<br />" . $rowRol["idRolUs"] . "Ya esta en el array." . "<br />";
						}else{
							$_SESSION['roles'][$counter] = $rowRol["idRole"];
						}
						
						$counter = $counter + 1;
						
					}
					//Obtenemos los perfiles asignados al usuario!!!
					$query4 = "SELECT * FROM user_pro WHERE idUsers = '".$row["idUsers"]."' ";
					$resultpro = $this->objDb->select($con, $query4);
					$counter = 0;
					while($rowpro=mysqli_fetch_array($resultpro,MYSQLI_ASSOC)){
						
						if(in_array($rowpro["idProfile"],$_SESSION['profiles'])){
							//echo "<br />" . $rowRol["idRolUs"] . "Ya esta en el array." . "<br />";
						}else{
							$_SESSION['profiles'][$counter] = $rowpro["idProfile"];
						}
						
						$counter = $counter + 1;
						
					}
					
				}
				
				/*
				
				fin de la prueba
				$this->useropc = $row["nameProfi"];				
						switch($this->useropc){
							
							case 'Standard':
								header('Location: reciclaje/restar_fechas.php');
								break;
								
							case 'Admin':
								header('Location: reciclaje/restar_fechas.php');
								break;
								
							case 'Jefe AT':
								header('Location: reciclaje/restar_fechas.php');
								break;
								
							case 'Invitados':
								header('Location: reciclaje/restar_fechas.php');
								break;
							
						}
				*/
				
				$query32=mysqli_query($con, "SELECT * FROM users WHERE loginUsers = '".$_SESSION['user']."' OR emailUser = '".$_SESSION['user']."'");
				$resultado=mysqli_fetch_array($query32, MYSQLI_ASSOC);
					$IdUser = $resultado['idUsers'];
					$Date = $resultado ['Date'];
					
					header('Content-Type: text/html; charset=UTF-8'); 
					$fecha1 = new DateTime($Date);
					$fecha2 = new DateTime(date("Y-m-d H:i:s"));
					$fecha = $fecha1->diff($fecha2);
					$operacion = $fecha->y * 12;
					$resultado_resta = $fecha->m + $operacion ;
					if($resultado_resta != 0){
						if($resultado_resta >= 4){
							echo "<script>
								
							var respuesta = confirm ('La contraseña a expirado. Cambie la contraseña ahora o de lo contrario la cuenta séra desactivada.');
							if (respuesta == true)
							{
								window.location.href = 'admin/Password.php';
							}else{
								window.location.href = 'global/ExpPass.php?idUsers=".$IdUser."';
							}
							</script>
							";
							
						}
						else if($resultado_resta >= 3 && $resultado_resta < 4 ){
							echo "<script>		
							var respuesta = confirm ('Por cuestiones de seguridad debe cambiar la contraseña. Para cambiar pulse ACEPTAR de lo contrario pulse CANCELAR.');
							if (respuesta == true)
							{
								window.location.href = 'admin/Password.php';
							}else{
								if($IdUser == 2 || $IdUser == 1){						
								window.location.href = 'admin/index.php';			
								}else{
								window.location.href = 'user/index.php';
								}		
							}
							</script>
							";
							
							//header('Location: http://webalmacensiemens.servehttp.com/almacen_siemens'); 
						}
						else if($resultado_resta < 3){
							echo"<script>
							if($IdUser == 2 || $IdUser == 1){
								window.location.href = 'admin/index.php';
							}else{
								window.location.href = 'user/index.php';
							}
							</script>";	
												
						}
				}else{
					echo"<script>
						if($IdUser == 2 || $IdUser == 1){
							window.location.href = 'http://".$_SERVER['HTTP_HOST']."/gestor/admin/';
						}else{
							window.location.href = 'user/index.php';
						}
						</script>";		
				}							
			}			
		}else{			
			header('Location: signin.php?error=1');			
		}
		
	}
	
	public function list_users($con){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM users ORDER BY idUsers ASC";
		$this->result = $this->objDb->select($con,$query);
		return $this->result;
		
	}
	
	public function single_user($con,$idUser){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM users WHERE idUsers = '".$idUser."' ";
		$this->result = $this->objDb->select($con,$query);
		return $this->result;
		
	}
	
	public function new_user($con){
		date_default_timezone_set("America/Santo_Domingo");
		$date = date("Y") . "-" . date("m") . "-" . date("d");
		
		//En esta seccion insertamos el usuario en la tabla users!!!
		$query = "INSERT INTO users VALUES('', '".$_POST["login"]."', '".$_POST["posc"]."', '".$_POST["pass"]."', 
			'".$_POST["email"]."', '1', 'images', '".$_POST["status"]."', '1', '".$date."')";
		$this->objDb->insert($con,$query);
		
		//Obtenemos el ID del Ultimo usuario ingresado a la tabla users!!
		$query = "SELECT * FROM users ORDER BY idUsers DESC Limit 1";
		$result = $this->objDb->select($con,$query);
		if($pro=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$idUser = $pro["idUsers"];
		}
		
		$query = "SELECT * FROM profiles";
		$this->result = $this->objDb->select($con,$query);
		while($row=mysqli_fetch_array($this->result,MYSQLI_ASSOC)){
			//estoy armando el nombre de la variable POST
			$namePro = "pro" . $row["idProfile"];
			
			if(isset($_POST[$namePro])){
				mysqli_query($con,"INSERT INTO user_pro VALUES('', '".$row["idProfile"]."', '".$idUser."', '".$_POST["profile"]."')");
			}
		}
		
	}
	
	public function modify_user($con){
		
		
		//Modificamos los datos de la tabla users!!!
		$query = "UPDATE users SET loginUsers = '".$_POST["login"]."',PoscUsers = '".$_POST["posc"]."', emailUser = '".$_POST["email"]."', statusUsers = '".$_POST["status"]."'
			WHERE idUsers = '".$_POST["idUsers"]."' ";
		$this->objDb->update($con,$query);
		
		$query = "DELETE FROM user_pro WHERE idUsers = '".$_POST["idUsers"]."' ";
		$this->objDb->delete($con,$query);
		
		$query = "SELECT * FROM profiles";
		$this->result = $this->objDb->select($con,$query);
		while($row=mysqli_fetch_array($this->result,MYSQLI_ASSOC)){
			$namePro = "pro" . $row["idProfile"];
			if(isset($_POST[$namePro])){
				if($row["idProfile"] == $_POST["profile"]){
					mysqli_query($con,"INSERT INTO user_pro VALUES('', '".$row["idProfile"]."', '".$_POST["idUsers"]."', '1')");
				}else{
					mysqli_query($con,"INSERT INTO user_pro VALUES('', '".$row["idProfile"]."', '".$_POST["idUsers"]."', '0')");
				}
				
			}
		}
		
		
	}
	
	public function delete_user(){
		
		$query = "DELETE FROM users WHERE idUsers = '".$_GET["idUser"]."' ";
		$this->objDb->delete($query);
		$query = "DELETE FROM user_pro WHERE idUsers = '".$_GET["idUser"]."' ";
		$this->objDb->delete($query);
		
	}
	
	public function look_modules(){
		
		/*echo "<pre>";
		print_r($_SESSION['profiles']);
		print_r($_SESSION['modules']);
		print_r($_SESSION['roles']);
		echo "</pre>";*/
		
		$query = "SELECT DISTINCT idmodule FROM user_pro, mod_profile WHERE user_pro.idUsers = '".$_GET["idUser"]."' 
			AND mod_profile.idProfile = user_pro.idProfile ";
		
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
}

?>