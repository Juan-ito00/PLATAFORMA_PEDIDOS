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
	$sql1="SELECT * FROM epp_rc WHERE id='$id'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM epp_rc WHERE id='$id'";
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("rc.xlsx");
		while ($registro = mysql_fetch_object ($resultado)) {
			$objPHPExcel ->setActiveSheetIndex(0)
			->setCellValue('P1', $registro->folio)
			->setCellValue('P2', date("d/m/Y",strtotime($registro->fecha)))
            ->setCellValue('C4', $registro->empresa)
            ->setCellValue('M4', $registro->obra)
			->setCellValue('C6', $registro->nombre1)
			->setCellValue('C7', $registro->nombre2)
			->setCellValue('C8', $registro->nombre3)
			->setCellValue('C9', $registro->nombre4)
			->setCellValue('C10', $registro->nombre5)
            ->setCellValue('C11', $registro->nombre6)
            ->setCellValue('C12', $registro->nombre7)
			->setCellValue('C13', $registro->nombre8)
            ->setCellValue('C14', $registro->nombre9)
			->setCellValue('C15', $registro->nombre10)
			->setCellValue('C16', $registro->nombre11)
			->setCellValue('C17', $registro->nombre12)
            ->setCellValue('C18', $registro->nombre13)
			->setCellValue('C19', $registro->nombre14)
			->setCellValue('C20', $registro->nombre15)
			->setCellValue('C21', $registro->nombre16)
			->setCellValue('C22', $registro->nombre17)
			->setCellValue('C23', $registro->nombre18)
            ->setCellValue('C24', $registro->nombre19)
			->setCellValue('C25', $registro->nombre20)
			->setCellValue('D6', $registro->talla_overol1)
			->setCellValue('D7', $registro->talla_overol2)
			->setCellValue('D8', $registro->talla_overol3)
			->setCellValue('D9', $registro->talla_overol4)
			->setCellValue('D10', $registro->talla_overol5)
            ->setCellValue('D11', $registro->talla_overol6)
            ->setCellValue('D12', $registro->talla_overol7)
			->setCellValue('D13', $registro->talla_overol8)
            ->setCellValue('D14', $registro->talla_overol9)
			->setCellValue('D15', $registro->talla_overol10)
			->setCellValue('D16', $registro->talla_overol11)
			->setCellValue('D17', $registro->talla_overol12)
            ->setCellValue('D18', $registro->talla_overol13)
			->setCellValue('D19', $registro->talla_overol14)
			->setCellValue('D20', $registro->talla_overol15)
			->setCellValue('D21', $registro->talla_overol16)
			->setCellValue('D22', $registro->talla_overol17)
			->setCellValue('D23', $registro->talla_overol18)
            ->setCellValue('D24', $registro->talla_overol19)
			->setCellValue('D25', $registro->talla_overol20)
            ->setCellValue('L6', $registro->talla_zapato1)
			->setCellValue('L7', $registro->talla_zapato2)
			->setCellValue('L8', $registro->talla_zapato3)
			->setCellValue('L9', $registro->talla_zapato4)
			->setCellValue('L10', $registro->talla_zapato5)
            ->setCellValue('L11', $registro->talla_zapato6)
            ->setCellValue('L12', $registro->talla_zapato7)
			->setCellValue('L13', $registro->talla_zapato8)
            ->setCellValue('L14', $registro->talla_zapato9)
			->setCellValue('L15', $registro->talla_zapato10)
			->setCellValue('L16', $registro->talla_zapato11)
			->setCellValue('L17', $registro->talla_zapato12)
            ->setCellValue('L18', $registro->talla_zapato13)
			->setCellValue('L19', $registro->talla_zapato14)
			->setCellValue('L20', $registro->talla_zapato15)
			->setCellValue('L21', $registro->talla_zapato16)
			->setCellValue('L22', $registro->talla_zapato17)
			->setCellValue('L23', $registro->talla_zapato18)
            ->setCellValue('L24', $registro->talla_zapato19)
			->setCellValue('L25', $registro->talla_zapato20)
            ->setCellValue('M6', $registro->talla_bota1)
			->setCellValue('M7', $registro->talla_bota2)
			->setCellValue('M8', $registro->talla_bota3)
			->setCellValue('M9', $registro->talla_bota4)
			->setCellValue('M10', $registro->talla_bota5)
            ->setCellValue('M11', $registro->talla_bota6)
            ->setCellValue('M12', $registro->talla_bota7)
			->setCellValue('M13', $registro->talla_bota8)
            ->setCellValue('M14', $registro->talla_bota9)
			->setCellValue('M15', $registro->talla_bota10)
			->setCellValue('M16', $registro->talla_bota11)
			->setCellValue('M17', $registro->talla_bota12)
            ->setCellValue('M18', $registro->talla_bota13)
			->setCellValue('M19', $registro->talla_bota14)
			->setCellValue('M20', $registro->talla_bota15)
			->setCellValue('M21', $registro->talla_bota16)
			->setCellValue('M22', $registro->talla_bota17)
			->setCellValue('M23', $registro->talla_bota18)
            ->setCellValue('M24', $registro->talla_bota19)
			->setCellValue('M25', $registro->talla_bota20)
            ->setCellValue('N6', $registro->talla_camisa1)
			->setCellValue('N7', $registro->talla_camisa2)
			->setCellValue('N8', $registro->talla_camisa3)
			->setCellValue('N9', $registro->talla_camisa4)
			->setCellValue('N10', $registro->talla_camisa5)
            ->setCellValue('N11', $registro->talla_camisa6)
            ->setCellValue('N12', $registro->talla_camisa7)
			->setCellValue('N13', $registro->talla_camisa8)
            ->setCellValue('N14', $registro->talla_camisa9)
			->setCellValue('N15', $registro->talla_camisa10)
			->setCellValue('N16', $registro->talla_camisa11)
			->setCellValue('N17', $registro->talla_camisa12)
            ->setCellValue('N18', $registro->talla_camisa13)
			->setCellValue('N19', $registro->talla_camisa14)
			->setCellValue('N20', $registro->talla_camisa15)
			->setCellValue('N21', $registro->talla_camisa16)
			->setCellValue('N22', $registro->talla_camisa17)
			->setCellValue('N23', $registro->talla_camisa18)
            ->setCellValue('N24', $registro->talla_camisa19)
			->setCellValue('N25', $registro->talla_camisa20)
            ->setCellValue('O6', $registro->talla_pantalon1)
			->setCellValue('O7', $registro->talla_pantalon2)
			->setCellValue('O8', $registro->talla_pantalon3)
			->setCellValue('O9', $registro->talla_pantalon4)
			->setCellValue('O10', $registro->talla_pantalon5)
            ->setCellValue('O11', $registro->talla_pantalon6)
            ->setCellValue('O12', $registro->talla_pantalon7)
			->setCellValue('O13', $registro->talla_pantalon8)
            ->setCellValue('O14', $registro->talla_pantalon9)
			->setCellValue('O15', $registro->talla_pantalon10)
			->setCellValue('O16', $registro->talla_pantalon11)
			->setCellValue('O17', $registro->talla_pantalon12)
            ->setCellValue('O18', $registro->talla_pantalon13)
			->setCellValue('O19', $registro->talla_pantalon14)
			->setCellValue('O20', $registro->talla_pantalon15)
			->setCellValue('O21', $registro->talla_pantalon16)
			->setCellValue('O22', $registro->talla_pantalon17)
			->setCellValue('O23', $registro->talla_pantalon18)
            ->setCellValue('O24', $registro->talla_pantalon19)
			->setCellValue('O25', $registro->talla_pantalon20)
            ->setCellValue('P6', $registro->talla_chaleco1)
			->setCellValue('P7', $registro->talla_chaleco2)
			->setCellValue('P8', $registro->talla_chaleco3)
			->setCellValue('P9', $registro->talla_chaleco4)
			->setCellValue('P10', $registro->talla_chaleco5)
            ->setCellValue('P11', $registro->talla_chaleco6)
            ->setCellValue('P12', $registro->talla_chaleco7)
			->setCellValue('P13', $registro->talla_chaleco8)
            ->setCellValue('P14', $registro->talla_chaleco9)
			->setCellValue('P15', $registro->talla_chaleco10)
			->setCellValue('P16', $registro->talla_chaleco11)
			->setCellValue('P17', $registro->talla_chaleco12)
            ->setCellValue('P18', $registro->talla_chaleco13)
			->setCellValue('P19', $registro->talla_chaleco14)
			->setCellValue('P20', $registro->talla_chaleco15)
			->setCellValue('P21', $registro->talla_chaleco16)
			->setCellValue('P22', $registro->talla_chaleco17)
			->setCellValue('P23', $registro->talla_chaleco18)
            ->setCellValue('P24', $registro->talla_chaleco19)
			->setCellValue('P25', $registro->talla_chaleco20)
            ->setCellValue('Q6', $registro->talla_bata1)
			->setCellValue('Q7', $registro->talla_bata2)
			->setCellValue('Q8', $registro->talla_bata3)
			->setCellValue('Q9', $registro->talla_bata4)
			->setCellValue('Q10', $registro->talla_bata5)
            ->setCellValue('Q11', $registro->talla_bata6)
            ->setCellValue('Q12', $registro->talla_bata7)
			->setCellValue('Q13', $registro->talla_bata8)
            ->setCellValue('Q14', $registro->talla_bata9)
			->setCellValue('Q15', $registro->talla_bata10)
			->setCellValue('Q16', $registro->talla_bata11)
			->setCellValue('Q17', $registro->talla_bata12)
            ->setCellValue('Q18', $registro->talla_bata13)
			->setCellValue('Q19', $registro->talla_bata14)
			->setCellValue('Q20', $registro->talla_bata15)
			->setCellValue('Q21', $registro->talla_bata16)
			->setCellValue('Q22', $registro->talla_bata17)
			->setCellValue('Q23', $registro->talla_bata18)
            ->setCellValue('Q24', $registro->talla_bata19)
			->setCellValue('Q25', $registro->talla_bata20);

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
                $isasst ='firmas/ALM.jpg';
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
			$objDrawing->setCoordinates('E41');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($ialmacen);
			$objDrawing->setResizeProportional(true);
			$objDrawing->setWidth(148);
			$objDrawing->setCoordinates('O41');
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
			$objDrawing->setCoordinates('O46');
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$nomfile="EPP Ropa y Calzado.xlsx";
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