<?php
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
	{
		header('Location: ../../../index.php');
		exit();
	}

	include("../../../conexion/conexion.php"); 
  	$conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");
	$desde=$_GET['desde'];  
	$hasta=$_GET['hasta'];
	$nombre=$_SESSION['nombre'];
	$sql1="SELECT * FROM pedidos_int WHERE supervisor='$nombre'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM pedidos_int WHERE supervisor LIKE '%$nombre%' AND gerencia='GCSO1' AND fecha_solicitud BETWEEN '$desde' AND '$hasta' ORDER BY folio";
 	
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("reporte_supervisor_int.xlsx");
		$i=4;
		$j=5;
		$k=6;

		while ($registro = mysql_fetch_object ($resultado)) 
		{
					$objPHPExcel ->setActiveSheetIndex(0)
				//INSERTAR REGISTROS EN PRIMER PEDIDO
					->setCellValue('A'.$i, $registro->folio)
					->setCellValue('B'.$i, $registro->tipo_servicio)
					->setCellValue('C'.$i, $registro->estado)
					->setCellValue('D'.$i, date("d-m-Y",strtotime($registro->fecha_recibido)))
					->setCellValue('E'.$i, $registro->servicio1)
					->setCellValue('H'.$i, date("d-m-Y",strtotime($registro->fecha_entrega1)))
					->setCellValue('I'.$i, date("d-m-Y",strtotime($registro->fecha_devolución1)))
					->setCellValue('J'.$i, $registro->proyecto)
					->setCellValue('K'.$i, $registro->gerencia)

					->setCellValue('E'.$j, $registro->servicio2)
					->setCellValue('F'.$j, date("d-m-Y",strtotime($registro->fecha_entrega2)))
					->setCellValue('G'.$j, date("d-m-Y",strtotime($registro->fecha_devolucion2)))

					->setCellValue('E'.$k, $registro->servicio3)
					->setCellValue('F'.$k, date("d-m-Y",strtotime($registro->fecha_entrega3)))
					->setCellValue('G'.$k, date("d-m-Y",strtotime($registro->fecha_devolucion3)));
					
					$i=$i+4;
					$j=$j+4;
					$k=$k+4;
				
				$nombre= $registro->supervisor;
	}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$fecha01="Reporte Supervisor ".$nombre.".xlsx";
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
        		alert('Esta obra no tiene reporte');
        		javascript:history.back()
         	</script>";
	  }
?>