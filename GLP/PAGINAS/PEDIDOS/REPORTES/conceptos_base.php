<?php
	include("../../../conexion/conexion.php"); 
  	$conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");

 	$sql ="SELECT * FROM conceptos_gcp ORDER BY codigo";
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("conceptos.xlsx");
		$i=5;

	while ($registro = mysql_fetch_object ($resultado)) {
				$objPHPExcel ->setActiveSheetIndex(0)
			//INSERTAR REGISTROS EN PRIMER PEDIDO
				->setCellValue('A'.$i, $registro->codigo)
				->setCellValue('B'.$i, $registro->descripcion)
				->setCellValue('C'.$i, $registro->unidad);
				
				$i=$i+1;
				
				
	}			
	}
	
	header('Content-Type: application/vdn.ms-excel');
	$fecha01="Reporte Conceptos.xlsx";
	header('Content-Disposition: attachment;filename='.$fecha01.'');
	header('Cache-Control: max-age=0');
	$objPHPExcel->getActiveSheet() ->setTitle('Reporte');
	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
	ob_end_clean();
	$objWriter->save('php://output');
	exit;
	mysql_close();
?>