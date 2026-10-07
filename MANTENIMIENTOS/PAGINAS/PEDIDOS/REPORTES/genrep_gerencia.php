<?php
	include("../../../conexion/conexion.php"); 
  $conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");
	$buscar=$_GET['gerencia'];
	$desde=$_GET['desde'];  
	$hasta=$_GET['hasta'];
	$sql1="SELECT * FROM pedidos WHERE proyecto='$buscar'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM mantenimientos WHERE gerencia LIKE '%$buscar%' AND fecha BETWEEN '$desde' AND '$hasta' ORDER BY folio_gpc";
 	
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("reporte_mtto.xlsx");
		$i=4;

	while ($registro = mysql_fetch_object ($resultado)) {
				$objPHPExcel ->setActiveSheetIndex(0)
			//INSERTAR REGISTROS EN PRIMER PEDIDO
				->setCellValue('A'.$i, date("d-m-Y",strtotime($registro->fecha)))
				->setCellValue('B'.$i, $registro->folio_gpc)
				->setCellValue('C'.$i, $registro->folio_ger)
				->setCellValue('D'.$i, $registro->gerencia)
				->setCellValue('E'.$i, $registro->departamento)
				->setCellValue('F'.$i, $registro->solicitante)
				->setCellValue('G'.$i, $registro->lugar)
				->setCellValue('H'.$i, $registro->descripcion)
				->setCellValue('I'.$i, $registro->notas)
				->setCellValue('J'.$i, $registro->material_necesario)
				->setCellValue('K'.$i, $registro->material)
				->setCellValue('L'.$i, $registro->autorizado)
				->setCellValue('M'.$i, $registro->autorizado_sup)
				->setCellValue('N'.$i, $registro->autorizado_gpc)
				->setCellValue('O'.$i, $registro->surtido);
				
				$i=$i+1;
				
				$nombre= $registro->gerencia;
	}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$fecha01="Reporte de Gerencia ".$nombre.".xlsx";
	header('Content-Disposition: attachment;filename='.$fecha01.'');
	header('Cache-Control: max-age=0');
	$objPHPExcel->getActiveSheet() ->setTitle('Reporte');
	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
	ob_end_clean();
	$objWriter->save('php://output');
	exit;
	mysql_close();
	
	}else{
		echo "<script type='text/javascript'>
        		alert('Esta gerencia no tiene reporte');
        		javascript:history.back()
         	</script>";
	  }
?>