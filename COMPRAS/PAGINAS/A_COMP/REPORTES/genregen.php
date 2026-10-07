<?php
	include("../../../conexion/conexion.php"); 
  	$conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");
	$desde=$_GET['desde'];  
	$hasta=$_GET['hasta'];
 	$sql ="SELECT * FROM sol_cotizaciones WHERE fecha BETWEEN '$desde' AND '$hasta' ORDER BY fecha";
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("reporte_sol_cot.xlsx");
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
		$ii=22;
		$jj=23;

	while ($registro = mysql_fetch_object ($resultado)) {
				$objPHPExcel ->setActiveSheetIndex(0)
			//INSERTAR REGISTROS EN PRIMER PEDIDO
				->setCellValue('A'.$i, $registro->folio)
				->setCellValue('B'.$i, $registro->proveedor)
				->setCellValue('C'.$i, date("d-m-Y",strtotime($registro->fecha)))
				->setCellValue('D'.$i, date("d-m-Y",strtotime($registro->fecha_limite)))
				->setCellValue('E'.$i, $registro->cantidad1)
				->setCellValue('F'.$i, $registro->unidad1)
				->setCellValue('G'.$i, $registro->desc1)
				->setCellValue('H'.$i, $registro->uso1)
				->setCellValue('I'.$i, $registro->folio_compras)
				->setCellValue('J'.$i, $registro->empresa)

				->setCellValue('E'.$j, $registro->cantidad2)
				->setCellValue('F'.$j, $registro->unidad2)
				->setCellValue('G'.$j, $registro->desc2)
				->setCellValue('H'.$j, $registro->uso2)

				->setCellValue('E'.$k, $registro->cantidad3)
				->setCellValue('F'.$k, $registro->unidad3)
				->setCellValue('G'.$k, $registro->desc3)
				->setCellValue('H'.$k, $registro->uso3)

				->setCellValue('E'.$l, $registro->cantidad4)
				->setCellValue('F'.$l, $registro->unidad4)
				->setCellValue('G'.$l, $registro->desc4)
				->setCellValue('H'.$l, $registro->uso4)

				->setCellValue('E'.$m, $registro->cantidad5)
				->setCellValue('F'.$m, $registro->unidad5)
				->setCellValue('G'.$m, $registro->desc5)
				->setCellValue('H'.$m, $registro->uso5)

				->setCellValue('E'.$n, $registro->cantidad6)
				->setCellValue('F'.$n, $registro->unidad6)
				->setCellValue('G'.$n, $registro->desc6)
				->setCellValue('H'.$n, $registro->uso6)

				->setCellValue('E'.$o, $registro->cantidad7)
				->setCellValue('F'.$o, $registro->unidad7)
				->setCellValue('G'.$o, $registro->desc7)
				->setCellValue('H'.$o, $registro->uso7)

				->setCellValue('E'.$p, $registro->cantidad8)
				->setCellValue('F'.$p, $registro->unidad8)
				->setCellValue('G'.$p, $registro->desc8)
				->setCellValue('H'.$p, $registro->uso8)

				->setCellValue('E'.$q, $registro->cantidad9)
				->setCellValue('F'.$q, $registro->unidad9)
				->setCellValue('G'.$q, $registro->desc9)
				->setCellValue('H'.$q, $registro->uso9)

				->setCellValue('E'.$r, $registro->cantidad10)
				->setCellValue('F'.$r, $registro->unidad10)
				->setCellValue('G'.$r, $registro->desc10)
				->setCellValue('H'.$r, $registro->uso10)

				->setCellValue('E'.$s, $registro->cantidad11)
				->setCellValue('F'.$s, $registro->unidad11)
				->setCellValue('G'.$s, $registro->desc11)
				->setCellValue('H'.$s, $registro->uso11)

				->setCellValue('E'.$t, $registro->cantidad12)
				->setCellValue('F'.$t, $registro->unidad12)
				->setCellValue('G'.$t, $registro->desc12)
				->setCellValue('H'.$t, $registro->uso12)

				->setCellValue('E'.$u, $registro->cantidad13)
				->setCellValue('F'.$u, $registro->unidad13)
				->setCellValue('G'.$u, $registro->desc13)
				->setCellValue('H'.$u, $registro->uso13)

				->setCellValue('E'.$v, $registro->cantidad14)
				->setCellValue('F'.$v, $registro->unidad14)
				->setCellValue('G'.$v, $registro->desc14)
				->setCellValue('H'.$v, $registro->uso14)

				->setCellValue('E'.$w, $registro->cantidad15)
				->setCellValue('F'.$w, $registro->unidad15)
				->setCellValue('G'.$w, $registro->desc15)
				->setCellValue('H'.$w, $registro->uso15)

				->setCellValue('E'.$x, $registro->cantidad16)
				->setCellValue('F'.$x, $registro->unidad16)
				->setCellValue('G'.$x, $registro->desc16)
				->setCellValue('H'.$x, $registro->uso16)

				->setCellValue('E'.$y, $registro->cantidad17)
				->setCellValue('F'.$y, $registro->unidad17)
				->setCellValue('G'.$y, $registro->desc17)
				->setCellValue('H'.$y, $registro->uso17)

				->setCellValue('E'.$z, $registro->cantidad18)
				->setCellValue('F'.$z, $registro->unidad18)
				->setCellValue('G'.$z, $registro->desc18)
				->setCellValue('H'.$z, $registro->uso18)

				->setCellValue('E'.$ii, $registro->cantidad19)
				->setCellValue('F'.$ii, $registro->unidad19)
				->setCellValue('G'.$ii, $registro->desc19)
				->setCellValue('H'.$ii, $registro->uso19)

				->setCellValue('E'.$jj, $registro->cantidad20)
				->setCellValue('F'.$jj, $registro->unidad20)
				->setCellValue('G'.$jj, $registro->desc20)
				->setCellValue('H'.$jj, $registro->uso20);
				
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

				$ii=$ii+21;
				$jj=$jj+21;
				
				
	}			
	}
	
	header('Content-Type: application/vdn.ms-excel');
	$fecha01="Reporte Solicitud Cot.xlsx";
	header('Content-Disposition: attachment;filename='.$fecha01.'');
	header('Cache-Control: max-age=0');
	$objPHPExcel->getActiveSheet() ->setTitle('Reporte');
	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
	ob_end_clean();
	$objWriter->save('php://output');
	exit;
	mysql_close();
?>