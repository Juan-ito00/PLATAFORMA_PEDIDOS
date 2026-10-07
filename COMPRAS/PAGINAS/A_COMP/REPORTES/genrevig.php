<?php
	include("../../../conexion/conexion.php");
   	$conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");

	$desde=$_GET['desde'];  
	$hasta=$_GET['hasta'];

 	$sql ="SELECT * FROM proveedores WHERE vigencia_sat BETWEEN '$desde' AND '$hasta' ORDER BY razon_social";
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("reporte_vig_prov_general.xlsx");
		$i=4;
	while ($registro = mysql_fetch_object ($resultado)) {

			$objPHPExcel ->getActiveSheet()->mergeCells('V'.($i).':V'.($i+1));
			$objPHPExcel ->setActiveSheetIndex(0)
			//INSERTAR REGISTROS EN PRIMER PEDIDO
			->setCellValue('A'.$i, $registro->razon_social)
			->setCellValue('B'.$i, date("d-m-Y",strtotime($registro->fecha_creacion)))
			->setCellValue('C'.$i, $registro->tipo_pago)
			->setCellValue('D'.$i, $registro->monto_credito)
			->setCellValue('E'.$i, $registro->tiempo_credito)
			->setCellValue('F'.$i, $registro->ps1.' '. $registro->ps2.' '.$registro->ps3)
			->setCellValue('G'.$i, date("d-m-Y",strtotime($registro->vigencia_sat)))
			->setCellValue('H'.$i, date("d-m-Y",strtotime($registro->vencimiento)))
			->setCellValue('I'.$i, $registro->tipo_contrato);
				
				$i=$i+1;
				
				
	}			
	}
	else{
		echo "<script type='text/javascript'>
        		alert('Sin reporte');
        		javascript:history.back()
         	</script>";
	  }
	
	header('Content-Type: application/vdn.ms-excel');
	$fecha01="Reporte Vigencia Proveedores General.xlsx";
	header('Content-Disposition: attachment;filename='.$fecha01.'');
	header('Cache-Control: max-age=0');
	$objPHPExcel->getActiveSheet() ->setTitle('Reporte');
	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
	ob_end_clean();
	$objWriter->save('php://output');
	exit;
	mysql_close();
?>