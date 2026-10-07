<?php
	date_default_timezone_set("Mexico/General");
	setlocale(LC_ALL,”es_ES”);
	include("../../../conexion/conexion.php"); 
  $conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET lc_time_names = 'es_MX'");
	$buscar=$_GET['id_pedido'];  
	$sql1="SELECT * FROM pedidos WHERE id_pedido='$buscar'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
		$sql ="SELECT * FROM pedidos WHERE id_pedido='$buscar'" ;
		$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 		$registros = mysql_num_rows ($resultado);
 		if($registros > 0) 
 		{
			require_once '../../../Classes/PHPExcel.php';
			$objPHPExcel = new PHPExcel();
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			if ($resultado['cant13'] != ' ') 
			{
				$objPHPExcel = $objReader->load("formato.xlsx");
        	$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
			$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
			$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
			$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
			$objPHPExcel->getActiveSheet()->getProtection()->setPassword('password');
			
			//formato para la fecha
			$dia = Date("d");
			$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			$anio = Date("Y");
			$comp = $dia." de ".$meses[date('n')-1]." de ".$anio;
			//ESCRIBIENDO EN EL ARCHIVO DE EXCEL
			
			while ($registro = mysql_fetch_object ($resultado)) {
				$objPHPExcel ->setActiveSheetIndex(0)
				
				->setCellValue('G4', $registro->empresa)
				->setCellValue('L8', $registro->folio)
				->setCellValue('L9', $registro->folio_af)
				->setCellValue('B11', date("d-m-Y",strtotime($registro->fecha)))
				->setCellValue('D11', $registro->proyecto)
				->setCellValue('H11', $registro->supervisor)
				->setCellValue('L11', $registro->ubicacion)
				->setCellValue('C15', $registro->cant1)
				->setCellValue('D15', $registro->unid1)
				->setCellValue('E15', $registro->desc1)
				->setCellValue('K15', $registro->uso1)
				->setCellValue('B47', $registro->notas_seguimiento)
				->setCellValue('B106', $registro->notas_seguimiento)
				->setCellValue('B55', $registro->supervisor)
				->setCellValue('B114', $registro->supervisor)
                ->setCellValue('K56', $registro->lugar)
                ->setCellValue('K115', $registro->lugar)
				//INSERTA REGISTROS EN COLUMNA CANTIDAD
				->setCellValue('C16', $registro->cant2)
				->setCellValue('C17', $registro->cant3)
				->setCellValue('C18', $registro->cant4)
				->setCellValue('C19', $registro->cant5)
				->setCellValue('C20', $registro->cant6)
				->setCellValue('C21', $registro->cant7)
				->setCellValue('C22', $registro->cant8)
				->setCellValue('C23', $registro->cant9)
				->setCellValue('C24', $registro->cant10)
				->setCellValue('C25', $registro->cant11)
				->setCellValue('C26', $registro->cant12)
				->setCellValue('C27', $registro->cant13)
				->setCellValue('C28', $registro->cant14)
				->setCellValue('C29', $registro->cant15)
				->setCellValue('C30', $registro->cant16)
				->setCellValue('C31', $registro->cant17)
				->setCellValue('C32', $registro->cant18)
				->setCellValue('C33', $registro->cant19)
				->setCellValue('C34', $registro->cant20)
				->setCellValue('C35', $registro->cant21)
				->setCellValue('C36', $registro->cant22)
				->setCellValue('C37', $registro->cant23)
				->setCellValue('C38', $registro->cant24)
				->setCellValue('C39', $registro->cant25)
				->setCellValue('C40', $registro->cant26)
				->setCellValue('C41', $registro->cant27)
				->setCellValue('C42', $registro->cant28)
				->setCellValue('C43', $registro->cant29)
				->setCellValue('C44', $registro->cant30)
				//INSERTA REGISTROS EN COLUMNA UNIDAD
				->setCellValue('D16', $registro->unid2)
				->setCellValue('D17', $registro->unid3)
				->setCellValue('D18', $registro->unid4)
				->setCellValue('D19', $registro->unid5)
				->setCellValue('D20', $registro->unid6)
				->setCellValue('D21', $registro->unid7)
				->setCellValue('D22', $registro->unid8)
				->setCellValue('D23', $registro->unid9)
				->setCellValue('D24', $registro->unid10)
				->setCellValue('D25', $registro->unid11)
				->setCellValue('D26', $registro->unid12)
				->setCellValue('D27', $registro->unid13)
				->setCellValue('D28', $registro->unid14)
				->setCellValue('D29', $registro->unid15)
				->setCellValue('D30', $registro->unid16)
				->setCellValue('D31', $registro->unid17)
				->setCellValue('D32', $registro->unid18)
				->setCellValue('D33', $registro->unid19)
				->setCellValue('D34', $registro->unid20)
				->setCellValue('D35', $registro->unid21)
				->setCellValue('D36', $registro->unid22)
				->setCellValue('D37', $registro->unid23)
				->setCellValue('D38', $registro->unid24)
				->setCellValue('D39', $registro->unid25)
				->setCellValue('D40', $registro->unid26)
				->setCellValue('D41', $registro->unid27)
				->setCellValue('D42', $registro->unid28)
				->setCellValue('D43', $registro->unid29)
				->setCellValue('D44', $registro->unid30)
				//INSERTA REGISTROS EN COLUMNA DESCRIPCION
				->setCellValue('E16', $registro->desc2)
				->setCellValue('E17', $registro->desc3)
				->setCellValue('E18', $registro->desc4)
				->setCellValue('E19', $registro->desc5)
				->setCellValue('E20', $registro->desc6)
				->setCellValue('E21', $registro->desc7)
				->setCellValue('E22', $registro->desc8)
				->setCellValue('E23', $registro->desc9)
				->setCellValue('E24', $registro->desc10)
				->setCellValue('E25', $registro->desc11)
				->setCellValue('E26', $registro->desc12)
				->setCellValue('E27', $registro->desc13)
				->setCellValue('E28', $registro->desc14)
				->setCellValue('E29', $registro->desc15)
				->setCellValue('E30', $registro->desc16)
				->setCellValue('E31', $registro->desc17)
				->setCellValue('E32', $registro->desc18)
				->setCellValue('E33', $registro->desc19)
				->setCellValue('E34', $registro->desc20)
				->setCellValue('E35', $registro->desc21)
				->setCellValue('E36', $registro->desc22)
				->setCellValue('E37', $registro->desc23)
				->setCellValue('E38', $registro->desc24)
				->setCellValue('E39', $registro->desc25)
				->setCellValue('E40', $registro->desc26)
				->setCellValue('E41', $registro->desc27)
				->setCellValue('E42', $registro->desc28)
				->setCellValue('E43', $registro->desc29)
				->setCellValue('E44', $registro->desc30)
				//INSERTA REGISTROS EN COLUMNA USO
				->setCellValue('K16', $registro->uso2)
				->setCellValue('K17', $registro->uso3)
				->setCellValue('K18', $registro->uso4)
				->setCellValue('K19', $registro->uso5)
				->setCellValue('K20', $registro->uso6)
				->setCellValue('K21', $registro->uso7)
				->setCellValue('K22', $registro->uso8)
				->setCellValue('K23', $registro->uso9)
				->setCellValue('K24', $registro->uso10)
				->setCellValue('K25', $registro->uso11)
				->setCellValue('K26', $registro->uso12)
				->setCellValue('K27', $registro->uso13)
				->setCellValue('K28', $registro->uso14)
				->setCellValue('K29', $registro->uso15)
				->setCellValue('K30', $registro->uso16)
				->setCellValue('K31', $registro->uso17)
				->setCellValue('K32', $registro->uso18)
				->setCellValue('K33', $registro->uso19)
				->setCellValue('K34', $registro->uso20)
				->setCellValue('K35', $registro->uso21)
				->setCellValue('K36', $registro->uso22)
				->setCellValue('K37', $registro->uso23)
				->setCellValue('K38', $registro->uso24)
				->setCellValue('K39', $registro->uso25)
				->setCellValue('K40', $registro->uso26)
				->setCellValue('K41', $registro->uso27)
				->setCellValue('K42', $registro->uso28)
				->setCellValue('K43', $registro->uso29)
				->setCellValue('K44', $registro->uso30);
			
				$nombre=$registro->folio;		
			}
			}//TERMINA IF PARA PLANTILLA GRANDE
			else
			{
        	$objPHPExcel = $objReader->load("formato12.xlsx");
        	$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
			$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
			$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
			$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
			$objPHPExcel->getActiveSheet()->getProtection()->setPassword('password');
			
			//formato para la fecha
			$dia = Date("d");
			$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			$anio = Date("Y");
			$comp = $dia." de ".$meses[date('n')-1]." de ".$anio;
			//ESCRIBIENDO EN EL ARCHIVO DE EXCEL
			
			while ($registro = mysql_fetch_object ($resultado)) {
				$objPHPExcel ->setActiveSheetIndex(0)
				
				->setCellValue('G4', $registro->empresa)
				->setCellValue('L8', $registro->folio)
				->setCellValue('L9', $registro->folio_af)
				->setCellValue('B11', date("d-m-Y",strtotime($registro->fecha)))
				->setCellValue('D11', $registro->proyecto)
				->setCellValue('H11', $registro->supervisor)
				->setCellValue('L11', $registro->ubicacion)
				->setCellValue('C15', $registro->cant1)
				->setCellValue('D15', $registro->unid1)
				->setCellValue('E15', $registro->desc1)
				->setCellValue('K15', $registro->uso1)
				->setCellValue('B28', $registro->notas_seguimiento)
				->setCellValue('B69', $registro->notas_seguimiento)
				->setCellValue('B37', $registro->supervisor)
				->setCellValue('B78', $registro->supervisor)
                ->setCellValue('K38', $registro->lugar)
                ->setCellValue('K79', $registro->lugar)
				//INSERTA REGISTROS EN COLUMNA CANTIDAD
				->setCellValue('C16', $registro->cant2)
				->setCellValue('C17', $registro->cant3)
				->setCellValue('C18', $registro->cant4)
				->setCellValue('C19', $registro->cant5)
				->setCellValue('C20', $registro->cant6)
				->setCellValue('C21', $registro->cant7)
				->setCellValue('C22', $registro->cant8)
				->setCellValue('C23', $registro->cant9)
				->setCellValue('C24', $registro->cant10)
				->setCellValue('C25', $registro->cant11)
				->setCellValue('C26', $registro->cant12)
				
				//INSERTA REGISTROS EN COLUMNA UNIDAD
				->setCellValue('D16', $registro->unid2)
				->setCellValue('D17', $registro->unid3)
				->setCellValue('D18', $registro->unid4)
				->setCellValue('D19', $registro->unid5)
				->setCellValue('D20', $registro->unid6)
				->setCellValue('D21', $registro->unid7)
				->setCellValue('D22', $registro->unid8)
				->setCellValue('D23', $registro->unid9)
				->setCellValue('D24', $registro->unid10)
				->setCellValue('D25', $registro->unid11)
				->setCellValue('D26', $registro->unid12)
				
				//INSERTA REGISTROS EN COLUMNA DESCRIPCION
				->setCellValue('E16', $registro->desc2)
				->setCellValue('E17', $registro->desc3)
				->setCellValue('E18', $registro->desc4)
				->setCellValue('E19', $registro->desc5)
				->setCellValue('E20', $registro->desc6)
				->setCellValue('E21', $registro->desc7)
				->setCellValue('E22', $registro->desc8)
				->setCellValue('E23', $registro->desc9)
				->setCellValue('E24', $registro->desc10)
				->setCellValue('E25', $registro->desc11)
				->setCellValue('E26', $registro->desc12)
				
				//INSERTA REGISTROS EN COLUMNA USO
				->setCellValue('K16', $registro->uso2)
				->setCellValue('K17', $registro->uso3)
				->setCellValue('K18', $registro->uso4)
				->setCellValue('K19', $registro->uso5)
				->setCellValue('K20', $registro->uso6)
				->setCellValue('K21', $registro->uso7)
				->setCellValue('K22', $registro->uso8)
				->setCellValue('K23', $registro->uso9)
				->setCellValue('K24', $registro->uso10)
				->setCellValue('K25', $registro->uso11)
				->setCellValue('K26', $registro->uso12);
			
				$nombre=$registro->folio;		
			}
		}
		}
		$f = Date("Y-M-d-His");
		header('Content-Type: application/vdn.ms-excel');
		$fecha01="Pedido ".$nombre.".xlsx";
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
        		alert('EL FOLIO NO SE ENCUENTRA EN EL SISTEMA');
        		javascript:history.back()
         	</script>";
	  }
?>