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

	$sql1="SELECT * FROM epp_re WHERE obra='$obra'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM epp_re WHERE obra LIKE '%$obra%' AND datef BETWEEN '$desde' AND '$hasta' ORDER BY folio";
 	
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("rep_re.xlsx");
		$i=6;
		$j=7;
		$k=8;
		$l=9;
		$m=10;
		$n=11;
	while ($registro = mysql_fetch_object ($resultado)) {
				$objPHPExcel ->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $registro->year)
				->setCellValue('B'.$i, date("d-m-Y",strtotime($registro->datef)))
				->setCellValue('C'.$i, $registro->folio)
				->setCellValue('D'.$i, date("d-m-Y",strtotime($registro->fecha)))
				->setCellValue('E'.$i, $registro->obra)
				->setCellValue('F'.$i, $registro->supervisor_sol)
				->setCellValue('G'.$i, $registro->trabajador)
				->setCellValue('H'.$i, date("d-m-Y",strtotime($registro->fecha_ingreso)))
				->setCellValue('I'.$i, $registro->categoria)
				->setCellValue('J'.$i, $registro->motivo)
				->setCellValue('K'.$i, $registro->epp1)
				->setCellValue('L'.$i, date("d-m-Y",strtotime($registro->fut_epp1)))
				->setCellValue('M'.$i, $registro->talla_epp1)
				->setCellValue('N'.$i, $registro->estatus_entrega1.' '.date("d-m-Y",strtotime($registro->fecha_entrega1)))
				->setCellValue('O'.$i, $registro->autorizado_residente.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_residente)))
				->setCellValue('P'.$i, $registro->autorizado_sasst.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_sasst)))
				->setCellValue('Q'.$i, $registro->autorizado_myt.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_myt)))
				->setCellValue('R'.$i, $registro->autorizado_gerseg.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_gerseg)))
				->setCellValue('S'.$i, $registro->autorizado_gerob.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_gerob)))
				->setCellValue('T'.$i, $registro->observaciones_sup)
				->setCellValue('U'.$i, $registro->observaciones_res)
				->setCellValue('V'.$i, $registro->observaciones_sasst)
				->setCellValue('W'.$i, $registro->observaciones_gerseg)
				->setCellValue('X'.$i, $registro->observaciones_gerob)
				
				->setCellValue('K'.$j, $registro->epp2)
				->setCellValue('L'.$j, date("d-m-Y",strtotime($registro->fut_epp2)))
				->setCellValue('M'.$j, $registro->talla_epp2)
				->setCellValue('N'.$j, $registro->estatus_entrega2.' '.date("d-m-Y",strtotime($registro->fecha_entrega2)))

				->setCellValue('K'.$k, $registro->epp3)
				->setCellValue('L'.$k, date("d-m-Y",strtotime($registro->fut_epp3)))
				->setCellValue('M'.$k, $registro->talla_epp3)
				->setCellValue('N'.$k, $registro->estatus_entrega3.' '.date("d-m-Y",strtotime($registro->fecha_entrega3)))

				->setCellValue('K'.$l, $registro->epp4)
				->setCellValue('L'.$l, date("d-m-Y",strtotime($registro->fut_epp4)))
				->setCellValue('M'.$l, $registro->talla_epp4)
				->setCellValue('N'.$l, $registro->estatus_entrega4.' '.date("d-m-Y",strtotime($registro->fecha_entrega4)))

				->setCellValue('K'.$m, $registro->epp5)
				->setCellValue('L'.$m, date("d-m-Y",strtotime($registro->fut_epp5)))
				->setCellValue('M'.$m, $registro->talla_epp5)
				->setCellValue('N'.$m, $registro->estatus_entrega5.' '.date("d-m-Y",strtotime($registro->fecha_entrega5)))

				->setCellValue('K'.$n, $registro->epp6)
				->setCellValue('L'.$n, date("d-m-Y",strtotime($registro->fut_epp6)))
				->setCellValue('M'.$n, $registro->talla_epp6)
				->setCellValue('N'.$n, $registro->estatus_entrega6.' '.date("d-m-Y",strtotime($registro->fecha_entrega6)));
				
				$i=$i+7;
				$j=$j+7;
				$k=$k+7;
				$l=$l+7;
				$m=$m+7;
				$n=$n+7;
	}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$nomfile="Reporte EPP Reemplazo.xlsx";
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