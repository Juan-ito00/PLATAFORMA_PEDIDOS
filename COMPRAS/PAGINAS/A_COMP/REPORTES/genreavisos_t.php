<?php
	include("../../../conexion/conexion.php");
   	$conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");

	$desde=$_GET['desde'];  
	$hasta=$_GET['hasta'];
	$buscar=$_GET['tipo'];
	if ($buscar == 'Ord') 
	{
		$sql1="SELECT * FROM avisos_ordinarios WHERE fecha BETWEEN '$desde' AND '$hasta'";
		$n = "notas";
	}
	else if ($buscar == 'Ant') 
	{
		$sql1="SELECT * FROM avisos_ra WHERE fecha BETWEEN '$desde' AND '$hasta'";
		$n = "notas2";
	}
	else if ($buscar == 'Req') 
	{
		$sql1="SELECT * FROM avisos_rg WHERE fecha BETWEEN '$desde' AND '$hasta'";
		$n = "notas";
	}

    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
    	if ($buscar == 'Ord') 
		{
			$sql="SELECT * FROM avisos_ordinarios WHERE fecha BETWEEN '$desde' AND '$hasta'";
			$n = "notas";
		}
		else if ($buscar == 'Ant') 
		{
			$sql="SELECT * FROM avisos_ra WHERE fecha BETWEEN '$desde' AND '$hasta'";
			$n = "notas2";
		}
		else if ($buscar == 'Req') 
		{
			$sql="SELECT * FROM avisos_rg WHERE fecha BETWEEN '$desde' AND '$hasta'";
			$n = "notas";
		}
	//$sql ="SELECT * FROM proveedores WHERE razon_social LIKE '%$buscar%'";
 	
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($buscar == 'Req'){ //para reporte de requisiciones generales
 		if($registros > 0) {
			require_once '../../../Classes/PHPExcel.php';
			$objPHPExcel = new PHPExcel();
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			$objPHPExcel = $objReader->load("reporte_avisos_rg.xlsx");
			$i=4;
			while ($registro = mysql_fetch_object ($resultado)) {
				//manejo de fechas vacías y 1969-12-31 para excel
				switch ($registro->fecha_autorizacion) {
					case NULL:
						$fr = ' ';
						break;

					case '0000-00-00':
						$fr = date("d-m-Y",strtotime($registro->fecha_autorizacion));
						break;
				}
				switch ($registro->fecha_autorizacion2) {
					case NULL:
						$fr2 = ' ';
						break;

					case '0000-00-00':
						$fr2 = date("d-m-Y",strtotime($registro->fecha_autorizacion2));
						break;
				}
				switch ($registro->fecha_autorizacion3) {
					case NULL:
						$fr3 = ' ';
						break;

					case '0000-00-00':
						$fr3 = date("d-m-Y",strtotime($registro->fecha_autorizacion3));
						break;
				}
				switch ($registro->fecha_autorizacion4) {
					case NULL:
						$fr4 = ' ';
						break;

					case '0000-00-00':
						$fr4 = date("d-m-Y",strtotime($registro->fecha_autorizacion4));
						break;
				}
				switch ($registro->fecha_autorizacion5) {
					case NULL:
						$fr5 = ' ';
						break;

					case '0000-00-00':
						$fr5 = date("d-m-Y",strtotime($registro->fecha_autorizacion5));
						break;
				}
				switch ($registro->fecha_autorizacion6) {
					case NULL:
						$fr6 = ' ';
						break;

					case '0000-00-00':
						$fr6 = date("d-m-Y",strtotime($registro->fecha_autorizacion6));
						break;
				}
				switch ($registro->fecha_autorizacion7) {
					case NULL:
						$fr7 = ' ';
						break;

					case '0000-00-00':
						$fr7 = date("d-m-Y",strtotime($registro->fecha_autorizacion7));
						break;
				}
				switch ($registro->fecha_autorizacion8) {
					case NULL:
						$fr8 = ' ';
						break;

					case '0000-00-00':
						$fr8 = date("d-m-Y",strtotime($registro->fecha_autorizacion8));
						break;
				}
				switch ($registro->fecha_autorizacion9) {
					case NULL:
						$fr9 = ' ';
						break;

					case '0000-00-00':
						$fr9 = date("d-m-Y",strtotime($registro->fecha_autorizacion9));
						break;
				}
				switch ($registro->fecha_autorizacion10) {
					case NULL:
						$fr10 = ' ';
						break;

					case '0000-00-00':
						$fr10 = date("d-m-Y",strtotime($registro->fecha_autorizacion10));
						break;
				}
				/*-------*/
				switch ($registro->fecha_orden) {
					case NULL:
						$fo = ' ';
						break;

					case '0000-00-00':
						$fo = date("d-m-Y",strtotime($registro->fecha_orden));
						break;
				}
				switch ($registro->fecha_orden2) {
					case NULL:
						$fo2 = ' ';
						break;

					case '0000-00-00':
						$fo2 = date("d-m-Y",strtotime($registro->fecha_orden2));
						break;
				}
				switch ($registro->fecha_orden3) {
					case NULL:
						$fo3 = ' ';
						break;

					case '0000-00-00':
						$fo3 = date("d-m-Y",strtotime($registro->fecha_orden3));
						break;
				}
				switch ($registro->fecha_orden4) {
					case NULL:
						$fo4 = ' ';
						break;

					case '0000-00-00':
						$fo4 = date("d-m-Y",strtotime($registro->fecha_orden4));
						break;
				}
				switch ($registro->fecha_orden5) {
					case NULL:
						$fo5 = ' ';
						break;

					case '0000-00-00':
						$fo5 = date("d-m-Y",strtotime($registro->fecha_orden5));
						break;
				}
				switch ($registro->fecha_orden6) {
					case NULL:
						$fo6 = ' ';
						break;

					case '0000-00-00':
						$fo6 = date("d-m-Y",strtotime($registro->fecha_orden6));
						break;
				}
				switch ($registro->fecha_orden7) {
					case NULL:
						$fo7 = ' ';
						break;

					case '0000-00-00':
						$fo7 = date("d-m-Y",strtotime($registro->fecha_orden7));
						break;
				}
				switch ($registro->fecha_orden8) {
					case NULL:
						$fo8 = ' ';
						break;

					case '0000-00-00':
						$fo8 = date("d-m-Y",strtotime($registro->fecha_orden8));
						break;
				}
				switch ($registro->fecha_orden9) {
					case NULL:
						$fo9 = ' ';
						break;

					case '0000-00-00':
						$fo9 = date("d-m-Y",strtotime($registro->fecha_orden9));
						break;
				}
				switch ($registro->fecha_orden10) {
					case NULL:
						$fo10 = ' ';
						break;

					case '0000-00-00':
						$fo10 = date("d-m-Y",strtotime($registro->fecha_orden10));
						break;
				}
				/*-------*/
				switch ($registro->fecha_pago) {
					case NULL:
						$fp = ' ';
						break;

					case '0000-00-00':
						$fp = date("d-m-Y",strtotime($registro->fecha_pago));
						break;
				}
				switch ($registro->fecha_pago2) {
					case NULL:
						$fp2 = ' ';
						break;

					case '0000-00-00':
						$fp2 = date("d-m-Y",strtotime($registro->fecha_pago2));
						break;
				}
				switch ($registro->fecha_pago3) {
					case NULL:
						$fp3 = ' ';
						break;

					case '0000-00-00':
						$fp3 = date("d-m-Y",strtotime($registro->fecha_pago3));
						break;
				}
				switch ($registro->fecha_pago4) {
					case NULL:
						$fp4 = ' ';
						break;

					case '0000-00-00':
						$fp4 = date("d-m-Y",strtotime($registro->fecha_pago4));
						break;
				}
				switch ($registro->fecha_pago5) {
					case NULL:
						$fp5 = ' ';
						break;

					case '0000-00-00':
						$fp5 = date("d-m-Y",strtotime($registro->fecha_pago5));
						break;
				}
				switch ($registro->fecha_pago6) {
					case NULL:
						$fp6 = ' ';
						break;

					case '0000-00-00':
						$fp6 = date("d-m-Y",strtotime($registro->fecha_pago6));
						break;
				}
				switch ($registro->fecha_pago7) {
					case NULL:
						$fp7 = ' ';
						break;

					case '0000-00-00':
						$fp7 = date("d-m-Y",strtotime($registro->fecha_pago7));
						break;
				}
				switch ($registro->fecha_pago8) {
					case NULL:
						$fp8 = ' ';
						break;

					case '0000-00-00':
						$fp8 = date("d-m-Y",strtotime($registro->fecha_pago8));
						break;
				}
				switch ($registro->fecha_pago9) {
					case NULL:
						$fp9 = ' ';
						break;

					case '0000-00-00':
						$fp9 = date("d-m-Y",strtotime($registro->fecha_pago9));
						break;
				}
				switch ($registro->fecha_pago10) {
					case NULL:
						$fp10 = ' ';
						break;

					case '0000-00-00':
						$fp10 = date("d-m-Y",strtotime($registro->fecha_pago10));
						break;
				}
				//tiempo de entrega de proveedor
				$prov = $registro->proveedor;
				$sqlp="SELECT * FROM datos_proveedores JOIN proveedores ON datos_proveedores.id_proveedor=proveedores.id WHERE proveedores.razon_social LIKE '$prov'";
				$resultadop = mysql_query($sqlp,$conexion) or die (mysql_error ());
				while ($registrop = mysql_fetch_object ($resultadop)) {
					$tiempo_entrega = $registrop->tiempo_entrega;
				}
	
			$objPHPExcel ->getActiveSheet()->mergeCells('V'.($i).':V'.($i+1));
				$objPHPExcel ->setActiveSheetIndex(0)
			//INSERTAR REGISTROS EN PRIMER PEDIDO
				->setCellValue('A'.$i, $registro->folio)
				->setCellValue('B'.$i, date("d-m-Y",strtotime($registro->fecha)))
				->setCellValue('C'.$i, $registro->folio_compras)
				->setCellValue('D'.$i, $registro->folio_gerencia)
				->setCellValue('E'.$i, $registro->proveedor)
				->setCellValue('F'.$i, $tiempo_entrega)
				->setCellValue('G'.$i, $registro->monto_total)
				->setCellValue('H'.$i, $registro->partida1)
				->setCellValue('H'.($i+1), $registro->partida2)
				->setCellValue('H'.($i+2), $registro->partida3)
				->setCellValue('H'.($i+3), $registro->partida4)
				->setCellValue('H'.($i+4), $registro->partida5)
				->setCellValue('H'.($i+5), $registro->partida6)
				->setCellValue('H'.($i+6), $registro->partida7)
				->setCellValue('H'.($i+7), $registro->partida8)
				->setCellValue('H'.($i+8), $registro->partida9)
				->setCellValue('H'.($i+9), $registro->partida10)
				->setCellValue('I'.$i, $registro->autorizado_fin)
				->setCellValue('I'.($i+1), $registro->autorizado_fin2)
				->setCellValue('I'.($i+2), $registro->autorizado_fin3)
				->setCellValue('I'.($i+3), $registro->autorizado_fin4)
				->setCellValue('I'.($i+4), $registro->autorizado_fin5)
				->setCellValue('I'.($i+5), $registro->autorizado_fin6)
				->setCellValue('I'.($i+6), $registro->autorizado_fin7)
				->setCellValue('I'.($i+7), $registro->autorizado_fin8)
				->setCellValue('I'.($i+8), $registro->autorizado_fin9)
				->setCellValue('I'.($i+9), $registro->autorizado_fin10)
				->setCellValue('J'.$i, $fr)
				->setCellValue('J'.($i+1), $fr2)
				->setCellValue('J'.($i+2), $fr3)
				->setCellValue('J'.($i+3), $fr4)
				->setCellValue('J'.($i+4), $fr5)
				->setCellValue('J'.($i+5), $fr6)
				->setCellValue('J'.($i+6), $fr7)
				->setCellValue('J'.($i+7), $fr8)
				->setCellValue('J'.($i+8), $fr9)
				->setCellValue('J'.($i+9), $fr10)
				->setCellValue('K'.$i, $fo)
				->setCellValue('K'.($i+1), $fo2)
				->setCellValue('K'.($i+2), $fo3)
				->setCellValue('K'.($i+3), $fo4)
				->setCellValue('K'.($i+4), $fo5)
				->setCellValue('K'.($i+5), $fo6)
				->setCellValue('K'.($i+6), $fo7)
				->setCellValue('K'.($i+7), $fo8)
				->setCellValue('K'.($i+8), $fo9)
				->setCellValue('K'.($i+9), $fo10)
				->setCellValue('L'.$i, $fp)
				->setCellValue('L'.($i+1), $fp2)
				->setCellValue('L'.($i+2), $fp3)
				->setCellValue('L'.($i+3), $fp4)
				->setCellValue('L'.($i+4), $fp5)
				->setCellValue('L'.($i+5), $fp6)
				->setCellValue('L'.($i+6), $fp7)
				->setCellValue('L'.($i+7), $fp8)
				->setCellValue('L'.($i+8), $fp9)
				->setCellValue('L'.($i+9), $fp10)
				->setCellValue('M'.$i, $registro->$n);
				
				$i=$i+11;
				
				$nombre= $registro->$buscar;
			}		
		}
 	}
 	else {
	 	if($registros > 0) { //para reportes de los demás avisos
			require_once '../../../Classes/PHPExcel.php';
			$objPHPExcel = new PHPExcel();
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			$objPHPExcel = $objReader->load("reporte_avisos.xlsx");
			$i=4;
			while ($registro = mysql_fetch_object ($resultado)) {

			if ($registro->fecha_autorizacion == NULL || $registro->fecha_autorizacion == '0000-00-00') {
				$fr = ' ';
			}
			else {	
				$fr = date("d-m-Y",strtotime($registro->fecha_autorizacion));
			}
			if ($registro->fecha_orden == NULL || $registro->fecha_orden == '0000-00-00') {
				$fo = ' ';
			}
			else {	
				$fo = date("d-m-Y",strtotime($registro->fecha_orden));
			}
			if ($registro->fecha_pago == NULL || $registro->fecha_pago == '0000-00-00') {
				$fp = ' ';
			}
			else {	
				$fp = date("d-m-Y",strtotime($registro->fecha_pago));
			}

			//tiempo de entrega de proveedor
			$prov = $registro->proveedor;
			$sqlp="SELECT * FROM datos_proveedores JOIN proveedores ON datos_proveedores.id_proveedor=proveedores.id WHERE proveedores.razon_social LIKE '$prov'";
			$resultadop = mysql_query($sqlp,$conexion) or die (mysql_error ());
			while ($registrop = mysql_fetch_object ($resultadop)) {
				$tiempo_entrega = $registrop->tiempo_entrega;
			}

			$objPHPExcel ->getActiveSheet()->mergeCells('V'.($i).':V'.($i+1));
				$objPHPExcel ->setActiveSheetIndex(0)
			//INSERTAR REGISTROS EN PRIMER PEDIDO
				->setCellValue('A'.$i, $registro->folio)
				->setCellValue('B'.$i, date("d-m-Y",strtotime($registro->fecha)))
				->setCellValue('C'.$i, $registro->folio_compras)
				->setCellValue('D'.$i, $registro->folio_gerencia)
				->setCellValue('E'.$i, $registro->empresa)
				->setCellValue('F'.$i, $registro->proveedor)
				->setCellValue('G'.$i, $tiempo_entrega)
				->setCellValue('H'.$i, $registro->monto_total)
				->setCellValue('I'.$i, $registro->autorizado_fin)
				->setCellValue('J'.$i, $fr)
				->setCellValue('K'.$i, $fo)
				->setCellValue('L'.$i, $fp)
				->setCellValue('M'.$i, $registro->$n);
				
				$i=$i+1;
				
				$nombre= $registro->$buscar;
			}		
		}
 	}
header('Content-Type: application/vdn.ms-excel');
$fecha01="Reporte Avisos ".$nombre.".xlsx";
header('Content-Disposition: attachment;filename='.$fecha01.'');
header('Cache-Control: max-age=0');
$objPHPExcel->getActiveSheet() ->setTitle('Reporte');
$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;
mysql_close();

}else{
	echo "<script type='text/javascript'>
    		alert('Sin reporte');
    		javascript:history.back()
     	</script>";
  }
?>