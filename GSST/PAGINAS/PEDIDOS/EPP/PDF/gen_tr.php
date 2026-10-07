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
	$sql1="SELECT * FROM epp_tr WHERE id='$id'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM epp_tr WHERE id='$id'";
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("tr.xlsx");
		while ($registro = mysql_fetch_object ($resultado)) {
			$objPHPExcel ->setActiveSheetIndex(0)
			->setCellValue('M1', $registro->folio)
			->setCellValue('M2', date("d/m/Y",strtotime($registro->fecha)))
            ->setCellValue('D4', $registro->empresa)
            ->setCellValue('K4', $registro->obra)
			->setCellValue('C6', $registro->cant_unid1)
			->setCellValue('C7', $registro->cant_unid2)
			->setCellValue('C8', $registro->cant_unid3)
			->setCellValue('C9', $registro->cant_unid4)
			->setCellValue('C10', $registro->cant_unid5)
            ->setCellValue('C11', $registro->cant_unid6)
            ->setCellValue('C12', $registro->cant_unid7)
			->setCellValue('C13', $registro->cant_unid8)
            ->setCellValue('C14', $registro->cant_unid9)
			->setCellValue('C15', $registro->cant_unid10)
			->setCellValue('C16', $registro->cant_unid11)
			->setCellValue('C17', $registro->cant_unid12)
            ->setCellValue('C18', $registro->cant_unid13)
			->setCellValue('C19', $registro->cant_unid14)
			->setCellValue('C20', $registro->cant_unid15)
			->setCellValue('C21', $registro->cant_unid16)
			->setCellValue('C22', $registro->cant_unid17)
			->setCellValue('C23', $registro->cant_unid18)
            ->setCellValue('C24', $registro->cant_unid19)
			->setCellValue('C25', $registro->cant_unid20)
			->setCellValue('D6', $registro->desc1)
			->setCellValue('D7', $registro->desc2)
			->setCellValue('D8', $registro->desc3)
			->setCellValue('D9', $registro->desc4)
			->setCellValue('D10', $registro->desc5)
            ->setCellValue('D11', $registro->desc6)
            ->setCellValue('D12', $registro->desc7)
			->setCellValue('D13', $registro->desc8)
            ->setCellValue('D14', $registro->desc9)
			->setCellValue('D15', $registro->desc10)
			->setCellValue('D16', $registro->desc11)
			->setCellValue('D17', $registro->desc12)
            ->setCellValue('D18', $registro->desc13)
			->setCellValue('D19', $registro->desc14)
			->setCellValue('D20', $registro->desc15)
			->setCellValue('D21', $registro->desc16)
			->setCellValue('D22', $registro->desc17)
			->setCellValue('D23', $registro->desc18)
            ->setCellValue('D24', $registro->desc19)
			->setCellValue('D25', $registro->desc20)
            ->setCellValue('I6', $registro->codigo1)
			->setCellValue('I7', $registro->codigo2)
			->setCellValue('I8', $registro->codigo3)
			->setCellValue('I9', $registro->codigo4)
			->setCellValue('I10', $registro->codigo5)
            ->setCellValue('I11', $registro->codigo6)
            ->setCellValue('I12', $registro->codigo7)
			->setCellValue('I13', $registro->codigo8)
            ->setCellValue('I14', $registro->codigo9)
			->setCellValue('I15', $registro->codigo10)
			->setCellValue('I16', $registro->codigo11)
			->setCellValue('I17', $registro->codigo12)
            ->setCellValue('I18', $registro->codigo13)
			->setCellValue('I19', $registro->codigo14)
			->setCellValue('I20', $registro->codigo15)
			->setCellValue('I21', $registro->codigo16)
			->setCellValue('I22', $registro->codigo17)
			->setCellValue('I23', $registro->codigo18)
            ->setCellValue('I24', $registro->codigo19)
			->setCellValue('I25', $registro->codigo20)
            ->setCellValue('J6', $registro->marca1)
			->setCellValue('J7', $registro->marca2)
			->setCellValue('J8', $registro->marca3)
			->setCellValue('J9', $registro->marca4)
			->setCellValue('J10', $registro->marca5)
            ->setCellValue('J11', $registro->marca6)
            ->setCellValue('J12', $registro->marca7)
			->setCellValue('J13', $registro->marca8)
            ->setCellValue('J14', $registro->marca9)
			->setCellValue('J15', $registro->marca10)
			->setCellValue('J16', $registro->marca11)
			->setCellValue('J17', $registro->marca12)
            ->setCellValue('J18', $registro->marca13)
			->setCellValue('J19', $registro->marca14)
			->setCellValue('J20', $registro->marca15)
			->setCellValue('J21', $registro->marca16)
			->setCellValue('J22', $registro->marca17)
			->setCellValue('J23', $registro->marca18)
            ->setCellValue('J24', $registro->marca19)
			->setCellValue('J25', $registro->marca20)
            ->setCellValue('K6', $registro->color1)
			->setCellValue('K7', $registro->color2)
			->setCellValue('K8', $registro->color3)
			->setCellValue('K9', $registro->color4)
			->setCellValue('K10', $registro->color5)
            ->setCellValue('K11', $registro->color6)
            ->setCellValue('K12', $registro->color7)
			->setCellValue('K13', $registro->color8)
            ->setCellValue('K14', $registro->color9)
			->setCellValue('K15', $registro->color10)
			->setCellValue('K16', $registro->color11)
			->setCellValue('K17', $registro->color12)
            ->setCellValue('K18', $registro->color13)
			->setCellValue('K19', $registro->color14)
			->setCellValue('K20', $registro->color15)
			->setCellValue('K21', $registro->color16)
			->setCellValue('K22', $registro->color17)
			->setCellValue('K23', $registro->color18)
            ->setCellValue('K24', $registro->color19)
			->setCellValue('K25', $registro->color20)
            ->setCellValue('L6', $registro->medidas1)
			->setCellValue('L7', $registro->medidas2)
			->setCellValue('L8', $registro->medidas3)
			->setCellValue('L9', $registro->medidas4)
			->setCellValue('L10', $registro->medidas5)
            ->setCellValue('L11', $registro->medidas6)
            ->setCellValue('L12', $registro->medidas7)
			->setCellValue('L13', $registro->medidas8)
            ->setCellValue('L14', $registro->medidas9)
			->setCellValue('L15', $registro->medidas10)
			->setCellValue('L16', $registro->medidas11)
			->setCellValue('L17', $registro->medidas12)
            ->setCellValue('L18', $registro->medidas13)
			->setCellValue('L19', $registro->medidas14)
			->setCellValue('L20', $registro->medidas15)
			->setCellValue('L21', $registro->medidas16)
			->setCellValue('L22', $registro->medidas17)
			->setCellValue('L23', $registro->medidas18)
            ->setCellValue('L24', $registro->medidas19)
			->setCellValue('L25', $registro->medidas20)
            ->setCellValue('M6', $registro->clase1)
			->setCellValue('M7', $registro->clase2)
			->setCellValue('M8', $registro->clase3)
			->setCellValue('M9', $registro->clase4)
			->setCellValue('M10', $registro->clase5)
            ->setCellValue('M11', $registro->clase6)
            ->setCellValue('M12', $registro->clase7)
			->setCellValue('M13', $registro->clase8)
            ->setCellValue('M14', $registro->clase9)
			->setCellValue('M15', $registro->clase10)
			->setCellValue('M16', $registro->clase11)
			->setCellValue('M17', $registro->clase12)
            ->setCellValue('M18', $registro->clase13)
			->setCellValue('M19', $registro->clase14)
			->setCellValue('M20', $registro->clase15)
			->setCellValue('M21', $registro->clase16)
			->setCellValue('M22', $registro->clase17)
			->setCellValue('M23', $registro->clase18)
            ->setCellValue('M24', $registro->clase19)
			->setCellValue('M25', $registro->clase20)
			->setCellValue('B27', $registro->observaciones_sup)
			->setCellValue('B29', $registro->observaciones_res)
			->setCellValue('B32', $registro->observaciones_almacen)
			->setCellValue('B35', $registro->observaciones_gerseg)
			->setCellValue('B38', $registro->observaciones_gerob);

			if($registro->obra == "Administrativo") {
				$isup ='firmas/ADM/ADM_SUP.jpg';
                $ires ='firmas/ADM/ADM_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/ADM/ADM_GEROB.jpg';
			}
            else if($registro->obra == "Concretos Cavi") {
				$isup ='firmas/CON/CON_SUP.jpg';
                $ires ='firmas/CON/CON_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/CON/CON_GEROB.jpg';
			}
            else if($registro->obra == "Proyectos de Construcción Concretos") {
				$isup ='firmas/PCC/PCC_SUP.jpg';
                $ires ='firmas/PCC/PCC_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/PCC/PCC_GEROB.jpg';
			}
            else if($registro->obra == "Sucursal MyT Control Vehicular") {
				$isup ='firmas/CVE/CVE_SUP.jpg';
                $ires ='firmas/CVE/CVE_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/CVE/CVE_GEROB.jpg';
			}
			else if($registro->obra == "Herradura") {
				$isup ='firmas/HER/HER_SUP.jpg';
                $ires ='firmas/HER/HER_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/HER/HER_GEROB.jpg';
			}
            else if($registro->obra == "Sucursal MyT Maquinaria Pesada") {
				$isup ='firmas/MPE/MPE_SUP.jpg';
                $ires ='firmas/MPE/MPE_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/MPE/MPE_GEROB.jpg';
			}
            else if($registro->obra == "Mantenimiento Multifuncional") {
				$isup ='firmas/MTO/MTO_SUP.jpg';
                $ires ='firmas/MTO/MTO_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/MTO/MTO_GEROB.jpg';
			}
            else if($registro->obra == "Sucursal MyT Administración") {
				$isup ='firmas/MYT/MYT_SUP.jpg';
                $ires ='firmas/MYT/MYT_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/MYT/MYT_GEROB.jpg';
			}
            else if($registro->obra == "Sucursal MyT Mecánicos Zona Foránea") {
				$isup ='firmas/MZF/MZF_SUP.jpg';
                $ires ='firmas/MZF/MZF_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/MZF/MZF_GEROB.jpg';
			}
			else if($registro->obra == "Proyecto San Julián") {
				$isup ='firmas/PSJ/PSJ_SUP.jpg';
                $ires ='firmas/PSJ/PSJ_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/PSJ/PSJ_GEROB.jpg';
			}
			else if($registro->obra == "Reclutamiento") {
				$isup ='firmas/REC/REC_SUP.jpg';
                $ires ='firmas/REC/REC_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/REC/REC_GEROB.jpg';
			}	
            else if($registro->obra == "Sabinas") {
                $isup ='firmas/SAB/SAB_SUP.jpg';
                $ires ='firmas/SAB/SAB_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/SAB/SAB_GEROB.jpg';
			}	
            else if($registro->obra == "Saucito") {
				$isup ='firmas/SAU/SAU_SUP.jpg';
                $ires ='firmas/SAU/SAU_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/SAU/SAU_GEROB.jpg';
			}
			else if($registro->obra == "Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos") {
				$isup ='firmas/SPP/SPP_SUP.jpg';
                $ires ='firmas/SPP/SPP_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/SPP/SPP_GEROB.jpg';
			}
            else if($registro->obra == "Sucursal MyT Transporte Especial") {
				$isup ='firmas/TES/TES_SUP.jpg';
                $ires ='firmas/TES/TES_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/TES/TES_GEROB.jpg';
			}
			else if($registro->obra == "Tocayos Agosto 2019") {
				$isup ='firmas/TOC/TOC_SUP.jpg';
                $ires ='firmas/TOC/TOC_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/TOC/TOC_GEROB.jpg';
			}	
            else if($registro->obra == "Juanicipio") {
                $isup ='firmas/JNC/JNC_SUP.jpg';
                $ires ='firmas/JNC/JNC_RES.jpg';
                $ialmacen ='firmas/ALM.jpg';
                $igerseg ='firmas/GERSEG.jpg';
                $igerob ='firmas/JNC/JNC_GEROB.jpg';
			}
				
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($isup);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('C41');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($ires);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('H41');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($ialmacen);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('L41');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($igerseg);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('C46');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($igerob);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('H46');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$nomfile="EPP Trimestral.xlsx";
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