<?php #error_reporting (0);?>
<?php
	$respuesta= "SI";

//declaracion de variables...
$AT = "";$Proc = "";$Designacion ="";$Ref = "";
$Alias = " ";$SAP = "";$id = "";$Medida = "";
$ubicacion = "";$cantidad = "";$users = "";$almacen = "";
$pertenece = "";$paquete = "";$comentario = "";

//conexion a la base de datos...
require'../class/config.php';

$objcon = new Connection();
$objcon->get_connected();

//Asignacion de valores a variables...
$AT = $_POST['AT'];$Proc = $_POST['Proc'];$Designacion = $_POST['Descripcion'];$Ref = $_POST['Ref'];
$Alias = $_POST['txtkeyword'] ;$SAP = $_POST['SAP'];$id = $_POST['id_producto'];$Medida = $_POST['UdMedida'];
$ubicacion = $_POST['ubicacion'];$cantidad = $_POST['cantidad'];$users = $_POST['username'];$almacen = $_POST['Almacen'];
$pertenece = $_POST['pertenece'];$paquete = $_POST['paquete'];$comentario = $_POST['comentario'];


//validacion de id no repetido...
$valide = mysql_query("SELECT * FROM consulta WHERE IdProducto = ".$id."");
		$exist = mysql_num_rows($valide);


		if($exist > 0){
			$respuesta = "NO";
			$mensaje = "Error, este ID existen en la BD.";
		}else{
				//variable fecha de creacion
				date_default_timezone_set("America/Santo_Domingo");
				$date = date("Y-m-d H:i:s");
			if($almacen == '1'){
$query =mysql_query("INSERT INTO crearproducto
	(AT,Procedencia,Designacion,Alias,Referencia,SAP,IdProducto,UnidadMedida,Ubicacion,Cantidad,idUsers, Almacen, Pertenece,Paquete,Fecha,Comentario)
	 VALUES
	('".$AT."','".$Proc."','".$Designacion."','".$Alias."','".$Ref."','".$SAP."','".$id."','".$Medida."','".$ubicacion."','".$cantidad."','".$users."','".$almacen."','".$pertenece."','".$paquete."','".$date."','".$comentario."')");

			if($query){
				switch($paquete){
					//1er Caso de verificacion
					case '1':
					$query2 = mysql_query("INSERT INTO consulta
		(AT,Procedencia,Designacion,Alias,Referencia,SAP,IdProducto,UnidadMedida,UbicacionPF,StockMant,idUsers,Pertenece,Paquete,Date,Comentario)
		 VALUES
		('".$AT."','".$Proc."','".$Designacion."','".$Alias."','".$Ref."','".$SAP."','".$id."','".$Medida."','".$ubicacion."','".$cantidad."','".$users."','".$pertenece."','".$paquete."','".$date."','".$comentario."')");
					if(mysql_affected_rows()>0){
						$respuesta = "SI";
						$mensaje='En buena hora, Registros creado satisfactoriamente.';
					}
					else{
						$respuesta = "NO";
						$mensaje='Error al insertar el Registro nuevo, revise los datos e intente nuevamente.';
					}
				break;
				//2do Caso de verificacion
				case '2':
				$query3 = mysql_query("INSERT INTO consulta
		(AT,Procedencia,Designacion,Alias,Referencia,SAP,IdProducto,UnidadMedida,UbicacionEPC,StockMant,idUsers,Pertenece,Paquete,Date,Comentario)
		 VALUES
		('".$AT."','".$Proc."','".$Designacion."','".$Alias."','".$Ref."','".$SAP."','".$id."','".$Medida."','".$ubicacion."','".$cantidad."','".$users."','".$pertenece."','".$paquete."','".$date."','".$comentario."')");
					if(mysql_affected_rows()>0){
						$respuesta = "SI";
						$mensaje='En buena hora, Registros creado satisfactoriamente.';
					}
					else{
						$respuesta = "NO";
						$mensaje='Error al insertar el Registro nuevo, revise los datos e intente nuevamente.';
					}
				break;

				}//final del switch
			}
			}//final del if

			else if($almacen == '4'){
				$query =mysql_query("INSERT INTO crearproducto
					(AT,Procedencia,Designacion,Alias,Referencia,SAP,IdProducto,UnidadMedida,Ubicacion,Cantidad,idUsers, Almacen, Pertenece,Paquete,Fecha,Comentario)
					 VALUES
					('".$AT."','".$Proc."','".$Designacion."','".$Alias."','".$Ref."','".$SAP."','".$id."','".$Medida."','".$ubicacion."','".$cantidad."','".$users."','".$almacen."','".$pertenece."','".$paquete."','".$date."','".$comentario."')");

				if($query){
				$query2 = mysql_query("INSERT INTO sobmant
					(AT,Procedencia,Designacion,Alias,Referencia,SAP,IdProducto,UnidadMedida,Ubicacion,Cantidad,idUsers,Pertenece,Paquete,Date,Comentario)
					 VALUES
					('".$AT."','".$Proc."','".$Designacion."','".$Alias."','".$Ref."','".$SAP."','".$id."','".$Medida."','".$ubicacion."','".$cantidad."','".$users."','".$pertenece."','".$paquete."','".$date."','".$comentario."')");
					if(mysql_affected_rows()>0){
						$respuesta = "SI";
						$mensaje='En buena hora, Registros creado satisfactoriamente.';
					}
					else{
						$respuesta = "NO";
						$mensaje='Error al insertar el Registro nuevo, revise los datos e intente nuevamente.';
					}
				}

			}//final del if


			else{
				$respuesta = "NO";
				$mensaje='Error, revise los datos.';
			}

		}//final primer else
$resultado = array("respuesta" => $respuesta , "mensaje" => $mensaje);

echo json_encode($resultado);
?>
