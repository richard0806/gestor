<?php
include_once '../global/security.php';
/*
  Generando excel desde mysql con PHP
    @Autor: Richard Valenzuela ~ RM soluciones WEB
 */
 /*

    OBTENEMOS EL PRIMER Y ULTIMO DIA DEL MES ANTERIOR
 */
 function _data_last_month_day() {
       $month = date('m')-1;
       $year = date('Y');
       $day = date("d", mktime(0,0,0, $month+1, 0, $year));

       return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
   };

   /** Actual month first day **/
   function _data_first_month_day() {
       $month = date('m')-1;
       $year = date('Y');
       return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
   }
   $last_month = date('m')-1;
   switch($last_month) {
    case "1":  $mes =  "Enero";       break;
    case "2":  $mes =  "Febrero";     break;
    case "3":  $mes =  "Marzo";       break;
    case "4":  $mes =  "Abril";       break;
    case "5":  $mes =  "Mayo";        break;
    case "6":  $mes =  "Junio";       break;
    case "7":  $mes =  "Julio";       break;
    case "8":  $mes =  "Agosto";      break;
    case "9":  $mes =  "Septiempre";  break;
    case "10": $mes =  "Octubre";    break;
    case "11": $mes =  "Noviembre";  break;
    case "12": $mes =  "Diciembre";  break;
    break;
   }

if (PHP_SAPI == 'cli')
  die('Este Scripts sólo se puede ejecutar desde un navegador Web');

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
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:H1');
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:H2');

    $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A1', 'Reporte de Consumos de '.$mes)
              ->setCellValue('A2', 'FECHA: '._data_first_month_day().' - '._data_last_month_day())
              ->setCellValue('A3', 'No.')
              ->setCellValue('B3', 'OT')
              ->setCellValue('C3', 'FECHA')
              ->setCellValue('D3', "UBICACIÓN")
              ->setCellValue('E3', "DESCRIPCION")
              ->setCellValue('F3', "REF.")
              ->setCellValue('G3', "MEDIDA")
              ->setCellValue('H3', "CANTIDAD.");

// Fuente de la primera fila en negrita
    $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

    $objPHPExcel->getActiveSheet()->getStyle('A1:H3')->applyFromArray($boldArray);

    //Ancho de las columnas
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(80);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);

/*Extraer datos de MYSQL*/
  require '../class/productos.php';

  $objcon = new Connection();
  $con = $objcon->get_connected();

  $objReport = new Report();
  $inicio = _data_first_month_day();
  $fin = _data_last_month_day();

  //echo $inicio.'<br>'.$fin;

  $listado = $objReport->consumos_mensual($con, $inicio, $fin);
  $cel=4;//Numero de fila donde empezara a crear  el reporte
  $items = 0;
  while($row=$listado->fetch_array(MYSQLI_ASSOC)){
      $items++;
      $a="A".$cel;
      $b="B".$cel;
      $c="C".$cel;
      $d="D".$cel;
      $e="E".$cel;
      $f="F".$cel;
      $g="G".$cel;
      $h="H".$cel;
      // Agregar datos (S.ot, SD.fecha, P.designacion, P.ref, P.medida, SD.cantidad)
      $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue($a, $items)
                            ->setCellValue($b, $row['ot'])
                            ->setCellValue($c, $row['fecha'])
                            ->setCellValue($d, '/')
                            ->setCellValue($e, $row['designacion'])
                            ->setCellValue($f, $row['ref'])
                            ->setCellValue($g, $row['medida'])
                            ->setCellValue($h, $row['cantidad']);

  $cel+=1;
  }
$namePC = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$nameRep = 'Reporte de Consumos de '.$mes;

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
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Consumos de '.$mes);


// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
$objPHPExcel->setActiveSheetIndex(0);

// Redirigir la salida al navegador web de un cliente ( Excel5 )
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte_Consumo_'.$mes.'.xls"');
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
