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
	$sql1="SELECT * FROM epp_re WHERE id='$id'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM epp_re WHERE id='$id'";
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("re.xlsx");
		while ($registro = mysql_fetch_object ($resultado)) {
			if($registro->fut_epp1 == '0000-00-00'){$fut1='';} else{$fut1=date("d/m/Y",strtotime($registro->fut_epp1));}
			if($registro->fut_epp2 == '0000-00-00'){$fut2='';} else{$fut2=date("d/m/Y",strtotime($registro->fut_epp2));}
			if($registro->fut_epp3 == '0000-00-00'){$fut3='';} else{$fut3=date("d/m/Y",strtotime($registro->fut_epp3));}
			if($registro->fut_epp4 == '0000-00-00'){$fut4='';} else{$fut4=date("d/m/Y",strtotime($registro->fut_epp4));}
			if($registro->fut_epp5 == '0000-00-00'){$fut5='';} else{$fut5=date("d/m/Y",strtotime($registro->fut_epp5));}
			if($registro->fut_epp6 == '0000-00-00'){$fut6='';} else{$fut6=date("d/m/Y",strtotime($registro->fut_epp6));}
			$objPHPExcel ->setActiveSheetIndex(0)
			->setCellValue('P1', $registro->folio)
			->setCellValue('P2', date("d/m/Y",strtotime($registro->fecha)))
			->setCellValue('E5', $registro->trabajador)
			->setCellValue('E6', $registro->obra)
			->setCellValue('E7', $registro->supervisor_sol)
			->setCellValue('O5', date("d/m/Y",strtotime($registro->fecha_ingreso)))
			->setCellValue('O6', $registro->categoria)
			->setCellValue('O7', $registro->motivo)
			->setCellValue('B10', $registro->epp1)
			->setCellValue('B11', $registro->epp2)
			->setCellValue('B12', $registro->epp3)
			->setCellValue('B13', $registro->epp4)
			->setCellValue('B14', $registro->epp5)
			->setCellValue('B15', $registro->epp6)
			->setCellValue('F10', $fut1)
			->setCellValue('F11', $fut2)
			->setCellValue('F12', $fut3)
			->setCellValue('F13', $fut4)
			->setCellValue('F14', $fut5)
			->setCellValue('F15', $fut6)
			->setCellValue('J10', $registro->talla_epp1)
			->setCellValue('K11', $registro->talla_epp2)
			->setCellValue('J12', $registro->talla_epp3)
			->setCellValue('J13', $registro->talla_epp4)
			->setCellValue('J14', $registro->talla_epp5)
			->setCellValue('J15', $registro->talla_epp6)
			->setCellValue('B19', $registro->observaciones_sup)
			->setCellValue('B22', $registro->observaciones_res)
			->setCellValue('B25', $registro->observaciones_sasst)
			->setCellValue('B28', $registro->observaciones_gerseg)
			->setCellValue('B31', $registro->observaciones_gerob);
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath('../../../../../GSST/PAGINAS/PEDIDOS/EPP/evidencia/'.utf8_decode($registro->foto_ev1));
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('B17');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath('../../../../../GSST/PAGINAS/PEDIDOS/EPP/evidencia/'.utf8_decode($registro->foto_ev2));
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('F17');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath('../../../../../GSST/PAGINAS/PEDIDOS/EPP/evidencia/'.utf8_decode($registro->foto_ev3));
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('L17');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			if($registro->obra == "Administrativo") {
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/ADM/ADM_SUP.jpg';
				}
                $ires ='firmas/ADM/ADM_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/ADM/ADM_GEROB.jpg';
			}
            else if($registro->obra == "Concretos Cavi") {
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/CON/CON_SUP.jpg';
				}
                $ires ='firmas/CON/CON_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/CON/CON_GEROB.jpg';
			}
            else if($registro->obra == "Proyectos de Construcción Concretos") {
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/PCC/PCC_SUP.jpg';
				}
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
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/HER/HER_SUP.jpg';
				}
                $ires ='firmas/HER/HER_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/HER/HER_GEROB.jpg';
			}
            else if($registro->obra == "Sucursal MyT Maquinaria Pesada") {
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/MPE/MPE_SUP.jpg';
				}
                $ires ='firmas/MPE/MPE_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/MPE/MPE_GEROB.jpg';
			}
            else if($registro->obra == "Mantenimiento Multifuncional") {
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/MTO/MTO_SUP.jpg';
				}
                $ires ='firmas/MTO/MTO_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/MTO/MTO_GEROB.jpg';
			}
            else if($registro->obra == "Sucursal MyT Administración") {
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/MYT/MYT_SUP.jpg';
				}
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
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/PSJ/PSJ_SUP.jpg';
				}
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
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/SAB/SAB_SUP.jpg';
				}
                $ires ='firmas/SAB/SAB_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/SAB/SAB_GEROB.jpg';
			}	
            else if($registro->obra == "Saucito") {
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/SAU/SAU_SUP.jpg';
				}
                $ires ='firmas/SAU/SAU_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/SAU/SAU_GEROB.jpg';
			}
			else if($registro->obra == "Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos") {
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/SPP/SPP_SUP.jpg';
				}
                $ires ='firmas/SPP/SPP_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/SPP/SPP_GEROB.jpg';
			}
            else if($registro->obra == "Sucursal MyT Transporte Especial") {
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/TES/TES_SUP.jpg';
				}
                $ires ='firmas/TES/TES_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/TES/TES_GEROB.jpg';
			}
			else if($registro->obra == "Tocayos Agosto 2019") {
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/TOC/TOC_SUP.jpg';
				}
                $ires ='firmas/TOC/TOC_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/TOC/TOC_GEROB.jpg';
			}	
            else if($registro->obra == "Juanicipio") {
				if($registro->supervisor_sol == "Jesús Valdez Esparza"){
					$isup ='firmas/MZF/MZF_RES.jpg';
				}
				else {
					$isup ='firmas/JNC/JNC_SUP.jpg';
				}
                $ires ='firmas/JNC/JNC_RES.jpg';
                $isasst ='firmas/SASST.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/JNC/JNC_GEROB.jpg';
			}
				
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($isup);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('C34');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($ires);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('H34');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($isasst);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('O34');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($igerseg);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('C39');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($igerob);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('H39');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$nomfile="EPP Reemplazo.xlsx";
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