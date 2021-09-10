<?php 
require_once ("phpExcel/Classes/PHPExcel.php");

$objPHPExcel = new PHPExcel();

// Establecer propiedades

$objPHPExcel->getProperties()

->setCreator("Cattivo")

->setLastModifiedBy("Cattivo")

->setTitle("Documento Excel de Prueba")

->setSubject("Documento Excel de Prueba")

->setDescription("Demostracion sobre como crear archivos de Excel desde PHP.")

->setKeywords("Excel Office 2007 openxml php")

->setCategory("Pruebas de Excel");

// Agregar Informacion

$objPHPExcel->setActiveSheetIndex(0)

->mergeCells('A1:N1');
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1','REPORTE DE ASAMBLEAS CIUDADANAS DE INFORMACIÓN Y SELECCIÓN');


// Renombrar Hoja

$objPHPExcel->getActiveSheet()->setTitle('Tecnologia Simple');


// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.

$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

header('Content-Disposition: attachment;filename="pruebaReal.xlsx"');

header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

$objWriter->save('php://output');

exit;

?>

?>