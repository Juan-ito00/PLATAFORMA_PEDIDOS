<?php
date_default_timezone_set("Mexico/General");
setlocale(LC_ALL, ”es_ES”);
include("../../../conexion/conexion.php");
include("../../../../destinatarios.php");
include("../../../../config.php");
include("../../../../firmas.php");
$conexion = Conectarse();
mysql_query("SET NAMES 'utf8'");
mysql_query("SET lc_time_names = 'es_MX'");
$buscar = $_GET['id_pedido'];
$lugg = $_GET['lug'];
if (isset($autorizadores[$lugg])) {
	$firma = $autorizadores[$lugg]['nombre'];
	$firmap = $autorizadores[$lugg]['puesto'];
	$firmaAutorizacion = $autorizadores[$lugg]['firma'];
}
$sql1 = "SELECT * FROM pedidos_int WHERE id_pedido='$buscar'";
$res = mysql_query($sql1, $conexion);
if (mysql_num_rows($res) >= 1) {
	$sql = "SELECT * FROM pedidos_int WHERE id_pedido='$buscar'";
	$resultado = mysql_query($sql, $conexion) or die(mysql_error());
	$registros = mysql_num_rows($resultado);
	if ($registros > 0) {
		require_once '../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel = $objReader->load("formato_int.xlsx");
		$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
		$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
		$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
		$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
		$objPHPExcel->getActiveSheet()->getProtection()->setPassword('password');

		//formato para la fecha
		$dia = Date("d");
		$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$anio = Date("Y");
		$comp = $dia . " de " . $meses[date('n') - 1] . " de " . $anio;
		//ESCRIBIENDO EN EL ARCHIVO DE EXCEL

		while ($registro = mysql_fetch_object($resultado)) {

			// Obtener el tipo de servicio directamente de la BD
			$lugg = trim($registro->tipo_servicio);

			// Buscar el autorizador correspondiente
			if (isset($autorizadores[$lugg])) {

				$firma = $autorizadores[$lugg]['nombre'];
				$firmap = $autorizadores[$lugg]['puesto'];
				$rutaAutorizacion = $autorizadores[$lugg]['firma'];
			} else {

				$firma = '';
				$firmap = '';
				$rutaAutorizacion = '';
			}
			$objPHPExcel->setActiveSheetIndex(0)

				->setCellValue('G7', $registro->tipo_servicio)
				->setCellValue('L8', $registro->folio)
				->setCellValue('L9', $registro->folio_af)
				->setCellValue('B11', date("d-m-Y", strtotime($registro->fecha_solicitud)))
				->setCellValue('D11', $registro->proyecto)
				->setCellValue('H11', $registro->supervisor)
				->setCellValue('L11', $registro->ubicacion)
				->setCellValue('B15', $registro->servicio1)
				->setCellValue('K15', $registro->fecha_entrega1)
				->setCellValue('L15', $registro->fecha_devolucion1)
				->setCellValue('B20', $registro->notas_seguimiento)
				->setCellValue('B52', $registro->notas_seguimiento)
				->setCellValue('B28', $registro->supervisor)
				->setCellValue('B60', $registro->supervisor)
				->setCellValue('K28', $firma)
				->setCellValue('K29', $firmap)
				->setCellValue('K60', $firma)
				->setCellValue('K61', $firmap)
				//INSERTA REGISTROS EN COLUMNA UNIDAD
				->setCellValue('B16', $registro->servicio2)
				->setCellValue('B17', $registro->servicio3)
				//INSERTA REGISTROS EN COLUMNA DESCRIPCION
				->setCellValue('K16', $registro->fecha_entrega2)
				->setCellValue('K17', $registro->fecha_entrega3)
				//INSERTA REGISTROS EN COLUMNA USO
				->setCellValue('L16', $registro->fecha_devolucion2)
				->setCellValue('L17', $registro->fecha_devolucion3);

			$nombre = $registro->folio;

			$rutaGerente = "../../../../FIRMAS/MyT/MyT.png";

			echo '<pre>';

			echo "Supervisor original:\n";
			var_dump($registro->supervisor);

			$rutaSupervisor = obtenerFirma(
				$registro->supervisor,
				'MyT'
			);


			$rutaSupervisor = obtenerFirma(
				$registro->supervisor,
				'MyT'
			);



			if (file_exists($rutaSupervisor)) {
				$firmaSupervisor = new PHPExcel_Worksheet_Drawing();
				$firmaSupervisor->setName('Firma Supervisor');
				$firmaSupervisor->setDescription('Firma Supervisor');
				$firmaSupervisor->setPath($rutaSupervisor);
				$firmaSupervisor->setHeight(100);
				$firmaSupervisor->setCoordinates('D26');
				$firmaSupervisor->setOffSetY(5);
				$firmaSupervisor->setWorksheet($objPHPExcel->getActiveSheet());
			}

			if (file_exists($rutaGerente)) {
				$firmaGerente = new PHPExcel_Worksheet_Drawing();
				$firmaGerente->setName('Firma Gerente');
				$firmaGerente->setDescription('Firma Gerente');
				$firmaGerente->setPath($rutaGerente);
				$firmaGerente->setHeight(100);
				$firmaGerente->setCoordinates('G27');
				$firmaGerente->setOffSetX(100);

				$firmaGerente->setWorksheet($objPHPExcel->getActiveSheet());
			}

			if (file_exists($rutaAutorizacion)) {
				$firmaAutorizacion = new PHPExcel_Worksheet_Drawing();
				$firmaAutorizacion->setName('Firma Autorización');
				$firmaAutorizacion->setDescription('Firma Autorización');
				$firmaAutorizacion->setPath($rutaAutorizacion);
				$firmaAutorizacion->setHeight(100);
				$firmaAutorizacion->setCoordinates('K26');
				$firmaAutorizacion->setOffsetX(100);
				$firmaAutorizacion->setWorksheet($objPHPExcel->getActiveSheet());
			}
		}
	}
	$f = Date("Y-M-d-His");
	header('Content-Type: application/vdn.ms-excel');
	$fecha01 = "Pedido " . $nombre . ".xlsx";
	header('Content-Disposition: attachment;filename=' . $fecha01 . '');
	header('Cache-Control: max-age=0');
	$objPHPExcel->getActiveSheet()->setTitle('Reporte');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	ob_end_clean();
	$objWriter->save('php://output');
	exit;
	mysql_close();
} else {
	echo "<script type='text/javascript'>
        		alert('EL FOLIO NO SE ENCUENTRA EN EL SISTEMA');
        		javascript:history.back()
         	</script>";
}
