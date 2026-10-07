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
	$sql1="SELECT * FROM epp_ex WHERE id='$id'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM epp_ex WHERE id='$id'";
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("ex.xlsx");
		while ($registro = mysql_fetch_object ($resultado)) {
			$objPHPExcel ->setActiveSheetIndex(0)
			->setCellValue('P1', $registro->folio)
			->setCellValue('P2', date("d/m/Y",strtotime($registro->fecha)))
			->setCellValue('E5', $registro->obra)
			->setCellValue('E6', $registro->supervisor_sol)
			->setCellValue('E7', $registro->motivo)
			->setCellValue('E8', $registro->justificacion)
			->setCellValue('B11', $registro->cant1)
			->setCellValue('B12', $registro->cant2)
			->setCellValue('B13', $registro->cant3)
			->setCellValue('B14', $registro->cant4)
			->setCellValue('B15', $registro->cant5)
			->setCellValue('C11', $registro->equipo1)
			->setCellValue('C12', $registro->equipo2)
			->setCellValue('C13', $registro->equipo3)
			->setCellValue('C14', $registro->equipo4)
			->setCellValue('C15', $registro->equipo5)
			->setCellValue('F11', $registro->codigo1)
			->setCellValue('F12', $registro->codigo2)
			->setCellValue('F13', $registro->codigo3)
			->setCellValue('F14', $registro->codigo4)
			->setCellValue('F15', $registro->codigo5)
			->setCellValue('H11', $registro->marca1)
			->setCellValue('H12', $registro->marca2)
			->setCellValue('H13', $registro->marca3)
			->setCellValue('H14', $registro->marca4)
			->setCellValue('H15', $registro->marca5)
			->setCellValue('J11', $registro->nombre1)
			->setCellValue('J12', $registro->nombre2)
			->setCellValue('J13', $registro->nombre3)
			->setCellValue('J14', $registro->nombre4)
			->setCellValue('J15', $registro->nombre5)
			->setCellValue('M11', $registro->contrato1)
			->setCellValue('M12', $registro->contrato2)
			->setCellValue('M13', $registro->contrato3)
			->setCellValue('M14', $registro->contrato4)
			->setCellValue('M15', $registro->contrato5)
			->setCellValue('O11', $registro->precio1)
			->setCellValue('O12', $registro->precio2)
			->setCellValue('O13', $registro->precio3)
			->setCellValue('O14', $registro->precio4)
			->setCellValue('O15', $registro->precio5)
			->setCellValue('P11', $registro->observaciones1)
			->setCellValue('P12', $registro->observaciones2)
			->setCellValue('P13', $registro->observaciones3)
			->setCellValue('P14', $registro->observaciones4)
			->setCellValue('P15', $registro->observaciones5)
			->setCellValue('B17', $registro->observaciones_sup)
			->setCellValue('B20', $registro->observaciones_res)
			->setCellValue('B23', $registro->observaciones_sasst)
			->setCellValue('B26', $registro->observaciones_gerseg)
			->setCellValue('B29', $registro->observaciones_gerob);

			if($registro->obra == "Administrativo") {
				$isup ='firmas/ADM/ADM_SUP.jpg';
                $ires ='firmas/ADM/ADM_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/ADM/ADM_GEROB.jpg';
			}
            else if($registro->obra == "Concretos Cavi") {
				$isup ='firmas/CON/CON_SUP.jpg';
                $ires ='firmas/CON/CON_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/CON/CON_GEROB.jpg';
			}
            else if($registro->obra == "Proyectos de Construcción Concretos") {
				$isup ='firmas/PCC/PCC_SUP.jpg';
                $ires ='firmas/PCC/PCC_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/PCC/PCC_GEROB.jpg';
			}
            else if($registro->obra == "Sucursal MyT Control Vehicular") {
				$isup ='firmas/CVE/CVE_SUP.jpg';
                $ires ='firmas/CVE/CVE_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/CVE/CVE_GEROB.jpg';
			}
			else if($registro->obra == "Herradura") {
				$isup ='firmas/HER/HER_SUP.jpg';
                $ires ='firmas/HER/HER_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/HER/HER_GEROB.jpg';
			}
            else if($registro->obra == "Sucursal MyT Maquinaria Pesada") {
				$isup ='firmas/MPE/MPE_SUP.jpg';
                $ires ='firmas/MPE/MPE_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/MPE/MPE_GEROB.jpg';
			}
            else if($registro->obra == "Mantenimiento Multifuncional") {
				$isup ='firmas/MTO/MTO_SUP.jpg';
                $ires ='firmas/MTO/MTO_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/MTO/MTO_GEROB.jpg';
			}
            else if($registro->obra == "Sucursal MyT Administración") {
				$isup ='firmas/MYT/MYT_SUP.jpg';
                $ires ='firmas/MYT/MYT_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/MYT/MYT_GEROB.jpg';
			}
            else if($registro->obra == "Sucursal MyT Mecánicos Zona Foránea") {
				$isup ='firmas/MZF/MZF_SUP.jpg';
                $ires ='firmas/MZF/MZF_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/MZF/MZF_GEROB.jpg';
			}
			else if($registro->obra == "Proyecto San Julián") {
				$isup ='firmas/PSJ/PSJ_SUP.jpg';
                $ires ='firmas/PSJ/PSJ_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/PSJ/PSJ_GEROB.jpg';
			}
			else if($registro->obra == "Reclutamiento") {
				$isup ='firmas/REC/REC_SUP.jpg';
                $ires ='firmas/REC/REC_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/REC/REC_GEROB.jpg';
			}	
            else if($registro->obra == "Sabinas") {
                $isup ='firmas/SAB/SAB_SUP.jpg';
                $ires ='firmas/SAB/SAB_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/SAB/SAB_GEROB.jpg';
			}	
            else if($registro->obra == "Saucito") {
				$isup ='firmas/SAU/SAU_SUP.jpg';
                $ires ='firmas/SAU/SAU_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/SAU/SAU_GEROB.jpg';
			}
			else if($registro->obra == "Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos") {
				$isup ='firmas/SPP/SPP_SUP.jpg';
                $ires ='firmas/SPP/SPP_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/SPP/SPP_GEROB.jpg';
			}
            else if($registro->obra == "Sucursal MyT Transporte Especial") {
				$isup ='firmas/TES/TES_SUP.jpg';
                $ires ='firmas/TES/TES_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/TES/TES_GEROB.jpg';
			}
			else if($registro->obra == "Tocayos Agosto 2019") {
				$isup ='firmas/TOC/TOC_SUP.jpg';
                $ires ='firmas/TOC/TOC_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/TOC/TOC_GEROB.jpg';
			}	
            else if($registro->obra == "Juanicipio") {
				$isup ='firmas/JNC/JNC_SUP.jpg';
                $ires ='firmas/JNC/JNC_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/JNC/JNC_GEROB.jpg';
			}
				
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($isup);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('C32');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($ires);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('J32');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($isasst);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('O32');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($igerseg);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('C37');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($igerob);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('J37');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$nomfile="EPP Extraordinario.xlsx";
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