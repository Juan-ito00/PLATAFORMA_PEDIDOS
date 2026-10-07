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
			$objPHPExcel = $objReader->load("formato.xlsx");
			
			//formato para la fecha
			$dia = Date("d");
			$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			$anio = Date("Y");
			$comp = $dia." de ".$meses[date('n')-1]." de ".$anio;
			//ESCRIBIENDO EN EL ARCHIVO DE EXCEL
			
			while ($registro = mysql_fetch_object ($resultado)) 
			{
				$objPHPExcel ->setActiveSheetIndex(0)
				
				->setCellValue('L7', $registro->folio_af)
				->setCellValue('L10', $registro->estado)
				->setCellValue('B10', date("d-m-Y",strtotime($registro->fecha)))
				->setCellValue('D10', $registro->proyecto)
				->setCellValue('H10', $registro->supervisor)
				->setCellValue('C14', $registro->cant1)
				->setCellValue('D14', $registro->unid1)
				->setCellValue('E14', $registro->desc1)
				->setCellValue('K14', $registro->credito1)
				->setCellValue('L14', $registro->surtido1)
				//INSERTA REGISTROS EN COLUMNA CANTIDAD
				->setCellValue('C15', $registro->cant2)
				->setCellValue('C16', $registro->cant3)
				->setCellValue('C17', $registro->cant4)
				->setCellValue('C18', $registro->cant5)
				->setCellValue('C19', $registro->cant6)
				->setCellValue('C20', $registro->cant7)
				->setCellValue('C21', $registro->cant8)
				->setCellValue('C22', $registro->cant9)
				->setCellValue('C23', $registro->cant10)
				->setCellValue('C24', $registro->cant11)
				->setCellValue('C25', $registro->cant12)
				->setCellValue('C26', $registro->cant13)
				->setCellValue('C27', $registro->cant14)
				->setCellValue('C28', $registro->cant15)
				->setCellValue('C29', $registro->cant16)
				->setCellValue('C30', $registro->cant17)
				->setCellValue('C31', $registro->cant18)
				->setCellValue('C32', $registro->cant19)
				->setCellValue('C33', $registro->cant20)
				->setCellValue('C34', $registro->cant21)
				->setCellValue('C35', $registro->cant22)
				->setCellValue('C36', $registro->cant23)
				->setCellValue('C37', $registro->cant24)
				->setCellValue('C38', $registro->cant25)
				->setCellValue('C39', $registro->cant26)
				->setCellValue('C40', $registro->cant27)
				->setCellValue('C41', $registro->cant28)
				->setCellValue('C42', $registro->cant29)
				->setCellValue('C43', $registro->cant30)
				//INSERTA REGISTROS EN COLUMNA UNIDAD
				->setCellValue('D15', $registro->unid2)
				->setCellValue('D16', $registro->unid3)
				->setCellValue('D17', $registro->unid4)
				->setCellValue('D18', $registro->unid5)
				->setCellValue('D19', $registro->unid6)
				->setCellValue('D20', $registro->unid7)
				->setCellValue('D21', $registro->unid8)
				->setCellValue('D22', $registro->unid9)
				->setCellValue('D23', $registro->unid10)
				->setCellValue('D24', $registro->unid11)
				->setCellValue('D25', $registro->unid12)
				->setCellValue('D26', $registro->unid13)
				->setCellValue('D27', $registro->unid14)
				->setCellValue('D28', $registro->unid15)
				->setCellValue('D29', $registro->unid16)
				->setCellValue('D30', $registro->unid17)
				->setCellValue('D31', $registro->unid18)
				->setCellValue('D32', $registro->unid19)
				->setCellValue('D33', $registro->unid20)
				->setCellValue('D34', $registro->unid21)
				->setCellValue('D35', $registro->unid22)
				->setCellValue('D36', $registro->unid23)
				->setCellValue('D37', $registro->unid24)
				->setCellValue('D38', $registro->unid25)
				->setCellValue('D39', $registro->unid26)
				->setCellValue('D40', $registro->unid27)
				->setCellValue('D41', $registro->unid28)
				->setCellValue('D42', $registro->unid29)
				->setCellValue('D43', $registro->unid30)
				//INSERTA REGISTROS EN COLUMNA DESCRIPCION
				->setCellValue('E15', $registro->desc2)
				->setCellValue('E16', $registro->desc3)
				->setCellValue('E17', $registro->desc4)
				->setCellValue('E18', $registro->desc5)
				->setCellValue('E19', $registro->desc6)
				->setCellValue('E20', $registro->desc7)
				->setCellValue('E21', $registro->desc8)
				->setCellValue('E22', $registro->desc9)
				->setCellValue('E23', $registro->desc10)
				->setCellValue('E24', $registro->desc11)
				->setCellValue('E25', $registro->desc12)
				->setCellValue('E26', $registro->desc13)
				->setCellValue('E27', $registro->desc14)
				->setCellValue('E28', $registro->desc15)
				->setCellValue('E29', $registro->desc16)
				->setCellValue('E30', $registro->desc17)
				->setCellValue('E31', $registro->desc18)
				->setCellValue('E32', $registro->desc19)
				->setCellValue('E33', $registro->desc20)
				->setCellValue('E34', $registro->desc21)
				->setCellValue('E35', $registro->desc22)
				->setCellValue('E36', $registro->desc23)
				->setCellValue('E37', $registro->desc24)
				->setCellValue('E38', $registro->desc25)
				->setCellValue('E39', $registro->desc26)
				->setCellValue('E40', $registro->desc27)
				->setCellValue('E41', $registro->desc28)
				->setCellValue('E42', $registro->desc29)
				->setCellValue('E43', $registro->desc30)
				//INSERTA REGISTROS EN COLUMNA CREDITO
				->setCellValue('K15', $registro->credito2)
				->setCellValue('K16', $registro->credito3)
				->setCellValue('K17', $registro->credito4)
				->setCellValue('K18', $registro->credito5)
				->setCellValue('K19', $registro->credito6)
				->setCellValue('K20', $registro->credito7)
				->setCellValue('K21', $registro->credito8)
				->setCellValue('K22', $registro->credito9)
				->setCellValue('K23', $registro->credito10)
				->setCellValue('K24', $registro->credito11)
				->setCellValue('K25', $registro->credito12)
				->setCellValue('K26', $registro->credito13)
				->setCellValue('K27', $registro->credito14)
				->setCellValue('K28', $registro->credito15)
				->setCellValue('K29', $registro->credito16)
				->setCellValue('K30', $registro->credito17)
				->setCellValue('K31', $registro->credito18)
				->setCellValue('K32', $registro->credito19)
				->setCellValue('K33', $registro->credito20)
				->setCellValue('K34', $registro->credito21)
				->setCellValue('K35', $registro->credito22)
				->setCellValue('K36', $registro->credito23)
				->setCellValue('K37', $registro->credito24)
				->setCellValue('K38', $registro->credito25)
				->setCellValue('K39', $registro->credito26)
				->setCellValue('K40', $registro->credito27)
				->setCellValue('K41', $registro->credito28)
				->setCellValue('K42', $registro->credito29)
				->setCellValue('K43', $registro->credito30)
				//INSERTA REGISTROS EN COLUMNA ESTADO
				->setCellValue('L15', $registro->surtido2)
				->setCellValue('L16', $registro->surtido3)
				->setCellValue('L17', $registro->surtido4)
				->setCellValue('L18', $registro->surtido5)
				->setCellValue('L19', $registro->surtido6)
				->setCellValue('L20', $registro->surtido7)
				->setCellValue('L21', $registro->surtido8)
				->setCellValue('L22', $registro->surtido9)
				->setCellValue('L23', $registro->surtido10)
				->setCellValue('L24', $registro->surtido11)
				->setCellValue('L25', $registro->surtido12)
				->setCellValue('L26', $registro->surtido13)
				->setCellValue('L27', $registro->surtido14)
				->setCellValue('L28', $registro->surtido15)
				->setCellValue('L29', $registro->surtido16)
				->setCellValue('L30', $registro->surtido17)
				->setCellValue('L31', $registro->surtido18)
				->setCellValue('L32', $registro->surtido19)
				->setCellValue('L33', $registro->surtido20)
				->setCellValue('L34', $registro->surtido21)
				->setCellValue('L35', $registro->surtido22)
				->setCellValue('L36', $registro->surtido23)
				->setCellValue('L37', $registro->surtido24)
				->setCellValue('L38', $registro->surtido25)
				->setCellValue('L39', $registro->surtido26)
				->setCellValue('L40', $registro->surtido27)
				->setCellValue('L41', $registro->surtido28)
				->setCellValue('L42', $registro->surtido29)
				->setCellValue('L43', $registro->surtido30);
			
				$nombre=$registro->folio;		
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