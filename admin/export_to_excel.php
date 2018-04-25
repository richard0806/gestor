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
 /* Ejemplo 1 generando excel desde mysql con PHP
    @Autor: Richard Valenzuela ~ RM soluciones WEB
 */
require'../class/config.php';

$objcon = new Connection();
$objcon->get_connected();

function exportoexcel(){
   
 $sql = "SELECT * FROM consulta";
 $resultado = mysql_query ($sql) or die (mysql_error ());
 $registros = mysql_num_rows ($resultado);
  
 if ($registros > 0) {
	 date_default_timezone_set('America/Santo_Domingo');
   require_once '../class/Exportar/Excel/Classes/PHPExcel.php';
  
  //Variables de PHP
   $objPHPExcel = new PHPExcel();
    
   //Informacion del excel
   $objPHPExcel->
    getProperties()
        ->setCreator("Gestor de Mantenimiento Siemens")
        ->setLastModifiedBy("Gestor de Mantenimiento Siemens")
        ->setTitle("Stock Actual de Inventario")
        ->setSubject("Stock actual de Mantenimiento")
        ->setDescription("Documento generado con PHPExcel")
        ->setKeywords("Gestor de Mantenimiento Siemens  con  phpexcel")
        ->setCategory("Inventario actualizado");    
 
   $i = 3; 
	$objPHPExcel->setActiveSheetIndex(0)
  			->setCellValue('A'.$i, "Item")
	  		->setCellValue('B'.$i, "AT")
	  		->setCellValue('C'.$i, "Designacion")
			->setCellValue('D'.$i, "Referencia")
			->setCellValue('E'.$i, "SAP")
            ->setCellValue('F'.$i, "ID Producto")
			->setCellValue('G'.$i, "Medida")
			->setCellValue('H'.$i, "Ubicación L1")
			->setCellValue('I'.$i, "Ubicación L2")
			->setCellValue('J'.$i, "Stock Actual");
			
   while ($registro = mysql_fetch_object ($resultado)) {
       $i++; 
      $objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$i, $registro->IdConsulta)
            ->setCellValue('B'.$i, $registro->AT)
			->setCellValue('C'.$i, $registro->Designacion)
			->setCellValue('D'.$i, $registro->Referencia)
			->setCellValue('E'.$i, $registro->SAP)
			->setCellValue('F'.$i, $registro->IdProducto)
			->setCellValue('G'.$i, $registro->UnidadMedida)
			->setCellValue('H'.$i, $registro->UbicacionPF)
			->setCellValue('I'.$i, $registro->UbicacionEPC)
			->setCellValue('J'.$i, $registro->StockMant);
  
      
       
   }
}
$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Stock_Actual_Mantenimiento.xls"');
header('Cache-Control: max-age=0');
 
ob_end_clean();
$objWriter->save('php://output');

exit;
mysql_close ();
}

function exportoexcel4(){
   
 $sql = "SELECT * FROM sobmant";
 $resultado = mysql_query ($sql) or die (mysql_error ());
 $registros = mysql_num_rows ($resultado);
  
 if ($registros > 0) {
	 date_default_timezone_set('America/Santo_Domingo');
   require_once '../class/Exportar/Excel/Classes/PHPExcel.php';
  
  //Variables de PHP
   $objPHPExcel = new PHPExcel();
    
   //Informacion del excel
   $objPHPExcel->
    getProperties()
        ->setCreator("Gestor de Mantenimiento Siemens")
        ->setLastModifiedBy("Gestor de Mantenimiento Siemens")
        ->setTitle("Stock Actual de Inventario")
        ->setSubject("Stock actual de Sob-Mantenimiento")
        ->setDescription("Documento generado con PHPExcel")
        ->setKeywords("Gestor de Mantenimiento Siemens  con  phpexcel")
        ->setCategory("Inventario actualizado");    
 
   $i = 3; 
	$objPHPExcel->setActiveSheetIndex(0)
  			->setCellValue('A'.$i, "Item")
	  		->setCellValue('B'.$i, "AT")
	  		->setCellValue('C'.$i, "Designacion")
			->setCellValue('D'.$i, "Referencia")
			->setCellValue('E'.$i, "SAP")
            ->setCellValue('F'.$i, "ID Producto")
			->setCellValue('G'.$i, "Medida")
			->setCellValue('H'.$i, "Ubicación")
			->setCellValue('I'.$i, "Stock Actual");
			
   while ($registro = mysql_fetch_object ($resultado)) {
       $i++; 
      $objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$i, $registro->IdSobMant)
            ->setCellValue('B'.$i, $registro->AT)
			->setCellValue('C'.$i, $registro->Designacion)
			->setCellValue('D'.$i, $registro->Referencia)
			->setCellValue('E'.$i, $registro->SAP)
			->setCellValue('F'.$i, $registro->IdProducto)
			->setCellValue('G'.$i, $registro->UnidadMedida)
			->setCellValue('H'.$i, $registro->Ubicacion)
			->setCellValue('I'.$i, $registro->Cantidad);
  
      
       
   }
}
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Stock_Actual_Sob-Mantenimiento.xls"');
header('Cache-Control: max-age=0');
 
$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
ob_end_clean();
$objWriter->save('php://output');
exit;
mysql_close ();
}

$Almacen = $_POST['Almacen32'];
if($Almacen == 1){
	echo exportoexcel();
}
if($Almacen == 4){
	echo exportoexcel4();
}

?>