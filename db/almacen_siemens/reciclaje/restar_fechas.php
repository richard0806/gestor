<?php
require'../class/sessions.php';
$objses = new Sessions();
$objses->init();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
	header('Location: http://'.$_SERVER["SERVER_NAME"].':8080/almacen_siemens/index.php?error=2');
}

?>
<?php
require'../class/config.php';
require'../class/dbactions.php';
require'../class/Pmenu.php';
require'../global/constants.php';

$objcon = new Connection();
$objcon->get_connected();


$query=mysql_query("SELECT * FROM users WHERE loginUsers = '".$_SESSION['user']."' OR emailUser = '".$_SESSION['user']."'");
$resultado=mysql_fetch_array($query);
	$IdUser = $resultado['idUsers'];
	$Date = $resultado ['Date'];
	

?>

<?php
header('Content-Type: text/html; charset=UTF-8'); 
$fecha1 = new DateTime($Date);
$fecha2 = new DateTime(date("Y-m-d H:i:s"));
$fecha = $fecha1->diff($fecha2);
$operacion = $fecha->y * 12;
$resultado_resta = $fecha->m + $operacion ;
//printf('%d años, %d meses, %d días, %d horas, %d minutos',  );
// imprime: 2 años, 4 meses, 2 días, 1 horas, 17 minutos $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i
if($resultado_resta != 0){
				if($resultado_resta >= 4){
					echo "<script>
						
					var respuesta = confirm ('La contraseña a expirado. Cambie la contraseña ahora o de lo contrario la cuenta séra desactivada.');
					if (respuesta == true)
					{
						window.location.href = 'http://".$_SERVER['SERVER_NAME'].":8080/almacen_siemens/admin/Password.php';
					}else{
						window.location.href = 'http://".$_SERVER['SERVER_NAME'].":8080/almacen_siemens/global/ExpPass.php?idUsers=".$IdUser."';
					}
					</script>
					";
					
				}
				else if($resultado_resta >= 3 && $resultado_resta < 4 ){
					echo "<script>		
					var respuesta = confirm ('Por cuestiones de seguridad debe cambiar la contraseña. Para cambiar pulse ACEPTAR de lo contrario pulse CANCELAR.');
					if (respuesta == true)
					{
						window.location.href = 'http://".$_SERVER['SERVER_NAME'].":8080/almacen_siemens/admin/Password.php';
					}else{
						if($IdUser == 2){						
						window.location.href = 'http://".$_SERVER['SERVER_NAME'].":8080/almacen_siemens/admin/index.php';			
						}else{
						window.location.href = 'http://".$_SERVER['SERVER_NAME'].":8080/almacen_siemens/user/index.php';
						}		
					}
					</script>
					";
					
					//header('Location: http://webalmacensiemens.servehttp.com/almacen_siemens'); 
				}
				else if($resultado_resta < 3){
					echo"<script>
					if($IdUser == 2){
						window.location.href = 'http://".$_SERVER['SERVER_NAME'].":8080/almacen_siemens/admin/index.php';
					}else{
						window.location.href = 'http://".$_SERVER['SERVER_NAME'].":8080/almacen_siemens/user/index.php';
					}
					</script>";	
					//echo "".$resultado_resta ." Meses.";
					//echo '<br/>';
					//echo $_SESSION['user'];
					//echo '<br/>';
					//echo 'Tienes aproximadamente:'.$resultado_resta.' Meses.';
					//echo $IdUser;
					
				}
		}else{
				echo"<script>
					if($IdUser == 2){
						window.location.href = 'http://".$_SERVER['SERVER_NAME'].":8080/almacen_siemens/admin/index.php';
					}else{
						window.location.href = 'http://".$_SERVER['SERVER_NAME'].":8080/almacen_siemens/user/index.php';
					}
					</script>";		
		}
		


// Podemos reemplazar la fecha inicial fija, por las que tengamos en el registro del Artículo de la base de datos
// Ej.: $resultado_resta = restaFechas( $fecha_articulo , date('d-m-Y') );

?>