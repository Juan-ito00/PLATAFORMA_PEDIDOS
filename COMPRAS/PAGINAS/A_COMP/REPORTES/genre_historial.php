<?php
	include("../../../conexion/conexion.php");
   	$conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");

	$tipo=$_GET['tipo'];
	$folio_aviso=$_GET['folio_aviso'];

	if ($tipo == 'Ord') 
	{
		$sql1="SELECT * FROM avisos_ordinarios WHERE folio LIKE '%$folio_aviso%'";
		$tipo_aviso = "Aviso de Compra Ordinario";
	}
	else if ($tipo == 'Ant') 
	{
		$sql1="SELECT * FROM avisos_ra WHERE folio LIKE '%$folio_aviso%'";
		$tipo_aviso = "Aviso de Compra Requiere Anticipo";
	}
	else if ($tipo == 'Req') 
	{
		$sql1="SELECT * FROM avisos_rg WHERE folio LIKE '%$folio_aviso%'";
		$tipo_aviso = "Aviso de Compra Requisición General";
	}

    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
    	if ($tipo == 'Ord') 
		{
			$sql="SELECT * FROM avisos_ordinarios WHERE folio LIKE '%$folio_aviso%'";
			$tipo_aviso = "Aviso de Compra Ordinario";
		}
		else if ($tipo == 'Ant') 
		{
			$sql="SELECT * FROM avisos_ra WHERE folio LIKE '%$folio_aviso%'";
			$tipo_aviso = "Aviso de Compra Requiere Anticipo";
		}
		else if ($tipo == 'Req') 
		{
			$sql="SELECT * FROM avisos_rg WHERE folio LIKE '%$folio_aviso%'";
			$tipo_aviso = "Aviso de Compra Requisición General";
		}
 	
	 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
	 	$registros = mysql_num_rows ($resultado);
	 	if($registros > 0) {
			require_once '../../../Classes/PHPExcel.php';
			$objPHPExcel = new PHPExcel();
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	        $objPHPExcel = $objReader->load("reporte_historial.xlsx");

			while ($registro = mysql_fetch_object ($resultado)) {
				if ($registro->fecha_autorizacion == NULL || $registro->fecha_autorizacion == '0000-00-00') {
					$fr = ' ';
				}
				else {	
					$fr = date("d-m-Y",strtotime($registro->fecha_autorizacion));
				}
				if ($registro->fecha_orden == NULL || $registro->fecha_orden == '0000-00-00') {
					$fo = ' ';
				}
				else {	
					$fo = date("d-m-Y",strtotime($registro->fecha_orden));
				}
				$objPHPExcel ->setActiveSheetIndex(0)
				->setCellValue('B2', $registro->folio)
				->setCellValue('B4', $tipo_aviso)
				->setCellValue('B6', date("d-m-Y",strtotime($registro->fecha)))
				->setCellValue('B8', $fr)
				->setCellValue('B10', $fo)
				->setCellValue('C6', $registro->coordinador)
				->setCellValue('C8', 'Guadalupe Castañeda Barrientos')
				->setCellValue('C10', 'Guadalupe Castañeda Barrientos');
			}		
		}

		$sql2="SELECT * FROM oficios_intcac WHERE folio_aviso LIKE '%$folio_aviso%'";
		$resultado2 = mysql_query($sql2,$conexion) or die (mysql_error ());
	 	$registros2 = mysql_num_rows ($resultado2);
	 	if($registros2 > 0) {
			while ($registro2 = mysql_fetch_object ($resultado2)) {
				$objPHPExcel ->setActiveSheetIndex(0)
				->setCellValue('B12', date("d-m-Y",strtotime($registro2->fecha)))
				->setCellValue('C12', $registro2->coordinador);
			}		
		}

		$sql3="SELECT * FROM oficios_intcmd WHERE folio_aviso LIKE '%$folio_aviso%'";
		$resultado3 = mysql_query($sql3,$conexion) or die (mysql_error ());
	 	$registros3 = mysql_num_rows ($resultado3);
	 	if($registros3 > 0) {
			while ($registro3 = mysql_fetch_object ($resultado3)) {
				$objPHPExcel ->setActiveSheetIndex(0)
				->setCellValue('B14', date("d-m-Y",strtotime($registro3->fecha)))
				->setCellValue('C14', $registro3->coordinador);
			}		
		}
		header('Content-Type: application/vdn.ms-excel');
		$fecha01="Reporte Historial.xlsx";
		header('Content-Disposition: attachment;filename='.$fecha01.'');
		header('Cache-Control: max-age=0');
		$objPHPExcel->getActiveSheet() ->setTitle('Reporte');
		$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
		ob_end_clean();
		$objWriter->save('php://output');
		exit;
		mysql_close();
	}
	else
	{
		echo "<script type='text/javascript'>
    		alert('Sin reporte');
    		javascript:history.back()
     	</script>";
  	}
?>