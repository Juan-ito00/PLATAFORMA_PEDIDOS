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
	mysql_query("SET NAMES 'utf8'");

	$desde=$_POST['desde'];  
	$hasta=$_POST['hasta'];
	$obra=$_POST['obra'];

	$sql1="SELECT * FROM epp_ni WHERE obra='$obra'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM epp_ni WHERE obra LIKE '%$obra%' AND datef BETWEEN '$desde' AND '$hasta' ORDER BY folio";
 	
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("rep_ni.xlsx");
		$i=6;
	while ($registro = mysql_fetch_object ($resultado)) {
				$objPHPExcel ->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $registro->year)
				->setCellValue('B'.$i, date("d-m-Y",strtotime($registro->datef)))
				->setCellValue('C'.$i, $registro->folio)
				->setCellValue('D'.$i, date("d-m-Y",strtotime($registro->fecha)))
				->setCellValue('E'.$i, $registro->obra)
				->setCellValue('F'.$i, $registro->puesto)
				->setCellValue('G'.$i, $registro->supervisor_sol)
				->setCellValue('H'.$i, $registro->motivo)
				->setCellValue('I'.$i, $registro->nombre)
				->setCellValue('J'.$i, $registro->talla_calzado)
				->setCellValue('K'.$i, $registro->talla_camisa)
				->setCellValue('L'.$i, $registro->talla_pantalon)
				->setCellValue('M'.$i, $registro->peso)
				->setCellValue('N'.$i, $registro->estatura)
				->setCellValue('O'.$i, $registro->sup_int)
				->setCellValue('P'.$i, $registro->autorizado_almacen.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_almacen)))
				->setCellValue('Q'.$i, $registro->observaciones_sup)
				->setCellValue('R'.$i, $registro->observaciones_almacen);
				
				$i=$i+1;
	}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$nomfile="Reporte EPP Nuevo Ingreso.xlsx";
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
        		alert('Esta obra no tiene reporte');
        		javascript:history.back()
         	</script>";
	  }
?>