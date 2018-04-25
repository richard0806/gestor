<?php
/*
 Ejemplo 1 generando excel desde mysql con PHP
    @Autor: Richard Valenzuela ~ RM soluciones WEB
 */

$at = $_POST['reportAt'];

switch ($at) {
    case 1:
      $nameAt = 'CAT';
      break;
       case 2:
      $nameAt = 'SEN';
      break;
       case 3:
      $nameAt = 'ELE';
      break;
 }


if (PHP_SAPI == 'cli')
  die('Este ejemplo sólo se puede ejecutar desde un navegador Web');

/** Incluye PHPExcel */
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
// Crear nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Propiedades del documento
$objPHPExcel->getProperties()->setCreator("RM Soluciones Web")
               ->setLastModifiedBy("RM Soluciones Web")
               ->setTitle("Reporte de Stock Actual")
               ->setSubject("Reporte de Stock Actual")
               ->setDescription("Reporte de Stock Actual, Gestor de Mant.")
               ->setKeywords("office 2010 openxml php")
               ->setCategory("Archivo de Reporte de Stocks");

   // Combino las celdas desde A1 hasta E1
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');  
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');   

    $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A1', 'REPORTE DE STOCK ACTUAL '.$nameAt)
              ->setCellValue('A2', 'FECHA: '.date('Y-m-d'))
              ->setCellValue('A3', '#')
              ->setCellValue('B3', 'AT')
              ->setCellValue('C3', 'DESCRIPCION')
              ->setCellValue('D3', "REF.")
              ->setCellValue('E3', "SAP")
              ->setCellValue('F3', "ID")
              ->setCellValue('G3', "MEDIDA")
              ->setCellValue('H3', "STOCK.");
      
// Fuente de la primera fila en negrita
    $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

    $objPHPExcel->getActiveSheet()->getStyle('A1:H3')->applyFromArray($boldArray);

    //Ancho de las columnas
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);  
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(80);  
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);  
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8);

/*Extraer datos de MYSQL*/
  require '../class/config.php';
  require '../class/dbactions.php';
  require'../global/constants.php';
  require '../class/productos.php';

  $objcon = new Connection();
  $con = $objcon->get_connected();

  $objProd = new Productos();

  
  $listado = $objProd->crit_list_prod($con,1,$at);
  $cel=4;//Numero de fila donde empezara a crear  el reporte
  $items = 0;
  while($row=mysqli_fetch_array($listado)){
      $items++;
      $a="A".$cel;
      $b="B".$cel;
      $c="C".$cel;
      $d="D".$cel;
      $e="E".$cel;
      $f="F".$cel;
      $g="G".$cel;
      $h="H".$cel;
      // Agregar datos
      $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue($a, $items)
                            ->setCellValue($b, $nameAt)
                            ->setCellValue($c, $row['designacion'])
                            ->setCellValue($d, $row['ref'])
                            ->setCellValue($e, $row['SAP'])
                            ->setCellValue($f, $row['id_prod'].'  ('.$row['id_opret'].')')
                            ->setCellValue($g, $row['medida'])
                            ->setCellValue($h, $row['cantidad']);
      
  $cel+=1;
  }
date_default_timezone_set("America/Santo_Domingo");
$now = date("Y") . "-" . date("m") . "-" . date("d");
$namePC = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$nameRep = 'Reporte de Stock '.$nameAt;

$ireport = "INSERT INTO tbl_sreport VALUES ('', '{$nameRep}', '{$namePC}', '{$now}')";
$ins = $con->query($ireport);
$res = ($con->affected_rows > 0)? 'YES' : 'NOT'; 

//$ins->close();
$con->close();
/*Fin extracion de datos MYSQL*/

$rango="A3:$h";
$styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF')))
);
$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);

// Cambiar el nombre de hoja de cálculo
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Stock '.$nameAt);


// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
$objPHPExcel->setActiveSheetIndex(0);

// Redirigir la salida al navegador web de un cliente ( Excel5 )
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte_Stock_'.$nameAt.'.xls"');
header('Cache-Control: max-age=0');
// Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
header('Cache-Control: max-age=1');

// Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
if($res == 'YES'){
  $objWriter->save('php://output');
}else{
  echo '<script language="javascript">alert("Error, al descargar el archivo.");</script>'; 
}
exit;
?>
