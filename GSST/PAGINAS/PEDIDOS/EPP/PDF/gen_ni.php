<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
	{
		header('Location: ../../../../index');
		exit();
	}
	include("../../../../conexion/conexion.php"); 
	$conexion=Conectarse();
	require '../../../../pdf/fpdf.php';

	$id=$_GET['id_pedido'];
	$sql1="SELECT * FROM epp_ni WHERE id='$id'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM epp_ni WHERE id='$id'";
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("ni.xlsx");
		while ($registro = mysql_fetch_object ($resultado)) {
			$objPHPExcel ->setActiveSheetIndex(0)
			->setCellValue('P1', $registro->folio)
			->setCellValue('P2', date("d/m/Y",strtotime($registro->fecha)))
			->setCellValue('E5', $registro->obra)
			->setCellValue('E6', $registro->puesto)
			->setCellValue('E7', $registro->motivo)
			->setCellValue('E8', $registro->supervisor_sol)
			->setCellValue('B10', $registro->nombre)
            ->setCellValue('F10', $registro->talla_calzado)
            ->setCellValue('H10', $registro->talla_camisa)
            ->setCellValue('J10', $registro->talla_pantalon)
            ->setCellValue('M10', $registro->estatura)
            ->setCellValue('O10', $registro->peso)
            ->setCellValue('P10', $registro->sup_int)
			->setCellValue('B12', $registro->observaciones_sup)
			->setCellValue('B15', $registro->observaciones_almacen);

            $isup ='firmas/REC/REC_SUP.jpg';
            $ialmacen ='firmas/ALM.jpg';
				
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($isup);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('C18');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($ialmacen);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('O18');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$nomfile="EPP Nuevo Ingreso.xlsx";
	header('Content-Disposition: attachment;filename='.$nomfile.'');
	header('Cache-Control: max-age=0');
	$objPHPExcel->getActiveSheet() ->setTitle('Reporte');
	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
	ob_end_clean();
	$objWriter->save('php://output');
	exit;
	mysql_close();
	
	}
	else{
		echo "<script type='text/javascript'>
        		alert('Error, no hay información.');
        		javascript:history.back()
         	</script>";
	  }
?>