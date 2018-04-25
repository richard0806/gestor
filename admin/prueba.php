<?php
//Llamado de los archivos clase
require'../class/sessions.php';
require'../class/config.php';
require'../class/consulta.php';
require'../class/dbactions.php';
require'../class/profiles.php';
require'../class/Pmenu.php';
require'../global/constants.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

$objConsul = new Consult();
$objPro = new Profiles();

$id = $_GET['id'];

//Obtenemos el usuario a modificar
$single_user = $objConsul->Consul_item($id);

//Obtenemos los perfiles existentes
$profiles = $objPro->show_profiles();

//buscar perfiles asignados
$objDb = new Database();

?>

<?php
                
				$num_rows = mysql_num_rows($single_user);
				
				if($num_rows > 0){
					
					if($row=mysql_fetch_array($single_user)){ ?>
					<input type="text" name="Descripcion" value="<?php echo $row["Descripcion"];?>" /><br>
                    <input type="text" name="Ubicacion" value="<?php echo $row["Ubicacion"];?>" /><br>
                   <input type="text" name="Cantidad" value="<?php echo $row["cantidad"];?>" />
                  
                    
                    <?php
					}else{?>
                    <p>favor de especificar el id a buscar</p>
					<?php }
				}?>