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

$objcon = new Connection();
$objcon->get_connected();

$fechaMin = $_GET["inicio"];
$fechaMax = $_GET["final"];

 $sql = "SELECT * FROM detalle_salida WHERE Date >='".$fechaMin." 00:00:00' AND Date <='".$fechaMax." 24:00:00' ORDER BY Date ASC";
 $resultado = mysql_query ($sql) or die (mysql_error ());
 $registros = mysql_num_rows ($resultado);
 
if ($registros > 0) {
	 date_default_timezone_set("America/Santo_Domingo");
   require_once '../class/Exportar/Excel/Classes/PHPExcel.php';
  
  //Variables de PHP
   $objPHPExcel = new PHPExcel();
    
   //Informacion del excel
   $objPHPExcel->
    getProperties()
		->setCreator("Gestor de Mantenimiento Siemens")
        ->setLastModifiedBy("Gestor de Mantenimiento Siemens")
        ->setTitle("Reporte de Productos por fecha ".$fechaMin." <-> ".$fechaMax."")		
        ->setSubject("Reporte_Salidas_por_fecha")
        ->setDescription("Documento generado con PHPExcel")
        ->setKeywords("Gestor de Mantenimiento Siemens con PHPExcel")
        ->setCategory("Reportes");	   
 
   $i = 2; 
   $y = 0;
   $objPHPExcel->setActiveSheetIndex(0)
  			->setCellValue('A'.$i, "Fecha: ".$fechaMin." <-> ".$fechaMax."");
		$i++;
	$objPHPExcel->setActiveSheetIndex(0)	
  			->setCellValue('A'.$i, "Item")
	  		->setCellValue('B'.$i, "OT")
	  		->setCellValue('C'.$i, "Designacion")
			->setCellValue('D'.$i, "Referencia")
			->setCellValue('E'.$i, "ID Almacen")
            ->setCellValue('F'.$i, "Medida")
			->setCellValue('G'.$i, "Cantidad")
			->setCellValue('H'.$i, "Fecha")
			->setCellValue('I'.$i, "Comentarios");
			
   while ($registro = mysql_fetch_object ($resultado)) {
       $i++; 
	   $y++; 
      $objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$i, $y)
	  		->setCellValue('B'.$i, $registro->OtSalida)
	  		->setCellValue('C'.$i, $registro->Designacion)
			->setCellValue('D'.$i, $registro->Referencia)
			->setCellValue('E'.$i, $registro->IdProducto)
            ->setCellValue('F'.$i, $registro->Medida)
			->setCellValue('G'.$i, $registro->Cantidad)
			->setCellValue('H'.$i, $registro->Date)
			->setCellValue('I'.$i, $registro->Observaciones);
  
      
       
   }
}
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte de Productos por fecha.xlsx"');
header('Cache-Control: max-age=0');
 
$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('php://output');
exit;
mysql_close ();
?>
