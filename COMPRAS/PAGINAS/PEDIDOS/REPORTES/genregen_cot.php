<?php
	include("../../../conexion/conexion.php");
   	$conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");

	$desde=$_GET['desde'];  
	$hasta=$_GET['hasta'];

 	$sql ="SELECT * FROM cotizaciones WHERE fecha_recibido BETWEEN '$desde' AND '$hasta' ORDER BY folio_compras";
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("reporte_general_cot.xlsx");
		$i=4;
		$j=5;
		$k=6;
		$l=7;
		$m=8;
		$n=9;
		$o=10;
		$p=11;
		$q=12;
		$r=13;
		$s=14;
		$t=15;
		$u=16;
		$v=17;
		$w=18;
		$x=19;
		$y=20;
		$z=21;
		$aa=22;
		$bb=23;
	while ($registro = mysql_fetch_object ($resultado)) {

			$objPHPExcel ->getActiveSheet()->mergeCells('V'.($i).':V'.($i+50));
			$objPHPExcel ->setActiveSheetIndex(0)
			//INSERTAR REGISTROS EN PRIMER PEDIDO
				->setCellValue('A'.$i, $registro->folio_gerencia)
				->setCellValue('B'.$i, $registro->folio_compras)
				->setCellValue('C'.$i, date("d-m-Y",strtotime($registro->fecha_solicitud)))
				->setCellValue('D'.$i, date("d-m-Y",strtotime($registro->fecha_recibido)))
				->setCellValue('E'.$i, date("d-m-Y",strtotime($registro->fecha_requerido)))
				->setCellValue('F'.$i, $registro->proyecto)
				->setCellValue('G'.$i, $registro->desc1)
				->setCellValue('H'.$i, $registro->unid1)
				->setCellValue('I'.$i, $registro->estado)

				->setCellValue('G'.$j, $registro->desc2)
				->setCellValue('H'.$j, $registro->unid2)
				->setCellValue('G'.$k, $registro->desc3)
				->setCellValue('H'.$k, $registro->unid3)
				->setCellValue('G'.$l, $registro->desc4)
				->setCellValue('H'.$l, $registro->unid4)
				->setCellValue('G'.$m, $registro->desc5)
				->setCellValue('H'.$m, $registro->unid5)
				->setCellValue('G'.$n, $registro->desc6)
				->setCellValue('H'.$n, $registro->unid6)
				->setCellValue('G'.$o, $registro->desc7)
				->setCellValue('H'.$o, $registro->unid7)
				->setCellValue('G'.$p, $registro->desc8)
				->setCellValue('H'.$p, $registro->unid8)
				->setCellValue('G'.$q, $registro->desc9)
				->setCellValue('H'.$q, $registro->unid9)
				->setCellValue('G'.$r, $registro->desc10)
				->setCellValue('H'.$r, $registro->unid10)
				->setCellValue('G'.$s, $registro->desc11)
				->setCellValue('H'.$s, $registro->unid11)
				->setCellValue('G'.$t, $registro->desc12)
				->setCellValue('H'.$t, $registro->unid12)
				->setCellValue('G'.$u, $registro->desc13)
				->setCellValue('H'.$u, $registro->unid13)
				->setCellValue('G'.$v, $registro->desc14)
				->setCellValue('H'.$v, $registro->unid14)
				->setCellValue('G'.$w, $registro->desc15)
				->setCellValue('H'.$w, $registro->unid15)
				->setCellValue('G'.$x, $registro->desc16)
				->setCellValue('H'.$x, $registro->unid16)
				->setCellValue('G'.$y, $registro->desc17)
				->setCellValue('H'.$y, $registro->unid17)
				->setCellValue('G'.$z, $registro->desc18)
				->setCellValue('H'.$z, $registro->unid18)
				->setCellValue('G'.$aa, $registro->desc19)
				->setCellValue('H'.$aa, $registro->unid19)
				->setCellValue('G'.$bb, $registro->desc20)
				->setCellValue('H'.$bb, $registro->unid20);
				
				$i=$i+21;
				$j=$j+21;
				$k=$k+21;
				$l=$l+21;
				$m=$m+21;
				$n=$n+21;
				$o=$o+21;
				$p=$p+21;
				$q=$q+21;
				$r=$r+21;
				$s=$s+21;
				$t=$t+21;
				$u=$u+21;
				$v=$v+21;
				$w=$w+21;
				$x=$x+21;
				$y=$y+21;
				$z=$z+21;
				$aa=$aa+21;
				$bb=$bb+21;	
	}			
	}
	
	header('Content-Type: application/vdn.ms-excel');
	$fecha01="Reporte Gral Cot$Mes.xlsx";
	header('Content-Disposition: attachment;filename='.$fecha01.'');
	header('Cache-Control: max-age=0');
	$objPHPExcel->getActiveSheet() ->setTitle('Reporte');
	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
	ob_end_clean();
	$objWriter->save('php://output');
	exit;
	mysql_close();
?>