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

	$sql1="SELECT * FROM epp_ex WHERE obra='$obra'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM epp_ex WHERE obra LIKE '%$obra%' AND datef BETWEEN '$desde' AND '$hasta' ORDER BY folio";
 	
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("rep_ex.xlsx");
		$i=6;
		$j=7;
		$k=8;
		$l=9;
		$m=10;
	while ($registro = mysql_fetch_object ($resultado)) {
				$objPHPExcel ->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $registro->year)
				->setCellValue('B'.$i, date("d-m-Y",strtotime($registro->datef)))
				->setCellValue('C'.$i, $registro->folio)
				->setCellValue('D'.$i, date("d-m-Y",strtotime($registro->fecha)))
				->setCellValue('E'.$i, $registro->obra)
				->setCellValue('F'.$i, $registro->supervisor_sol)
				->setCellValue('G'.$i, $registro->motivo)
				->setCellValue('H'.$i, $registro->justificacion)
				->setCellValue('I'.$i, $registro->cant1)
				->setCellValue('J'.$i, $registro->equipo1)
				->setCellValue('K'.$i, $registro->codigo1)
				->setCellValue('L'.$i, $registro->marca1)
				->setCellValue('M'.$i, $registro->nombre1)
				->setCellValue('N'.$i, $registro->contrato1)
				->setCellValue('O'.$i, $registro->observaciones1)
				->setCellValue('P'.$i, $registro->precio1)
				->setCellValue('Q'.$i, $registro->estatus_entrega1.' '.date("d-m-Y",strtotime($registro->fecha_entrega1)))
				->setCellValue('R'.$i, $registro->autorizado_residente.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_residente)))
				->setCellValue('S'.$i, $registro->autorizado_sasst.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_sasst)))
				->setCellValue('T'.$i, $registro->autorizado_gcp.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_gcp)))
				->setCellValue('U'.$i, $registro->autorizado_gerseg.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_gerseg)))
				->setCellValue('V'.$i, $registro->autorizado_gerob.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_gerob)))
				->setCellValue('W'.$i, $registro->autorizado_dir.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_dir)))
				->setCellValue('X'.$i, $registro->observaciones_sup)
				->setCellValue('Y'.$i, $registro->observaciones_res)
				->setCellValue('Z'.$i, $registro->observaciones_sasst)
				->setCellValue('AA'.$i, $registro->observaciones_gerseg)
				->setCellValue('AB'.$i, $registro->observaciones_gerob)
				->setCellValue('AC'.$i, $registro->observaciones_dir)
				

				->setCellValue('I'.$j, $registro->cant2)
				->setCellValue('J'.$j, $registro->equipo2)
				->setCellValue('K'.$j, $registro->codigo2)
				->setCellValue('L'.$j, $registro->marca2)
				->setCellValue('M'.$j, $registro->nombre2)
				->setCellValue('N'.$j, $registro->contrato2)
				->setCellValue('O'.$j, $registro->observaciones2)
				->setCellValue('P'.$j, $registro->precio2)
				->setCellValue('Q'.$j, $registro->estatus_entrega2.' '.date("d-m-Y",strtotime($registro->fecha_entrega2)))

				->setCellValue('I'.$k, $registro->cant3)
				->setCellValue('J'.$k, $registro->equipo3)
				->setCellValue('K'.$k, $registro->codigo3)
				->setCellValue('L'.$k, $registro->marca3)
				->setCellValue('M'.$k, $registro->nombre3)
				->setCellValue('N'.$k, $registro->contrato3)
				->setCellValue('O'.$k, $registro->observaciones3)
				->setCellValue('P'.$k, $registro->precio3)
				->setCellValue('Q'.$k, $registro->estatus_entrega3.' '.date("d-m-Y",strtotime($registro->fecha_entrega3)))

				->setCellValue('I'.$l, $registro->cant4)
				->setCellValue('J'.$l, $registro->equipo4)
				->setCellValue('K'.$l, $registro->codigo4)
				->setCellValue('L'.$l, $registro->marca4)
				->setCellValue('M'.$l, $registro->nombre4)
				->setCellValue('N'.$l, $registro->contrato4)
				->setCellValue('O'.$l, $registro->observaciones4)
				->setCellValue('P'.$l, $registro->precio4)
				->setCellValue('Q'.$l, $registro->estatus_entrega4.' '.date("d-m-Y",strtotime($registro->fecha_entrega4)))

				->setCellValue('I'.$m, $registro->cant5)
				->setCellValue('J'.$m, $registro->equipo5)
				->setCellValue('K'.$m, $registro->codigo5)
				->setCellValue('L'.$m, $registro->marca5)
				->setCellValue('M'.$m, $registro->nombre5)
				->setCellValue('N'.$m, $registro->contrato5)
				->setCellValue('O'.$m, $registro->observaciones5)
				->setCellValue('P'.$m, $registro->precio5)
				->setCellValue('Q'.$m, $registro->estatus_entrega5.' '.date("d-m-Y",strtotime($registro->fecha_entrega5)));
				
				$i=$i+6;
				$j=$j+6;
				$k=$k+6;
				$l=$l+6;
				$m=$m+6;
	}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$nomfile="Reporte EPP Extraordinario.xlsx";
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