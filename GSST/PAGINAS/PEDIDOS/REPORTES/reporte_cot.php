<?php
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
	{
		header('Location: ../../../index.php');
		exit();
	}

	include("../../../conexion/conexion.php"); 
  	$conexion=Conectarse();

	mysql_query("SET NAMES 'utf8'");
	$nombre=$_SESSION['nombre'];
	$sql1="SELECT * FROM cotizaciones WHERE solicitante='$nombre'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM cotizaciones WHERE solicitante LIKE '%$nombre%' ORDER BY folio_gerencia";
 	
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("reporte_cotizaciones.xlsx");
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
				->setCellValue('A'.$i, $registro->folio_gerencia)
				->setCellValue('B'.$i, $registro->folio_compras)
				->setCellValue('C'.$i, date("d-m-Y",strtotime($registro->fecha_solicitud)))
				->setCellValue('D'.$i, date("d-m-Y",strtotime($registro->fecha_requerido)))
				->setCellValue('E'.$i, date("d-m-Y",strtotime($registro->fecha_recibido)))
				->setCellValue('F'.$i, $registro->unid1)
				->setCellValue('G'.$i, $registro->desc1)
				->setCellValue('H'.$i, $registro->firma_rp1)
				->setCellValue('I'.$i, $registro->proyecto)
				->setCellValue('J'.$i, $registro->solicitante)
				->setCellValue('K'.$i, $registro->ubicacion_obra)
				->setCellValue('L'.$i, $registro->lugar_cotizacion)
				->setCellValue('M'.$i, $registro->tipo_cotizacion)
				->setCellValue('N'.$i, $registro->estado)
				->setCellValue('O'.$i, $registro->notas)

				->setCellValue('F'.$j, $registro->unid2)
				->setCellValue('G'.$j, $registro->desc2)
				->setCellValue('H'.$j, $registro->firma_rp2)

				->setCellValue('F'.$k, $registro->unid3)
				->setCellValue('G'.$k, $registro->desc3)
				->setCellValue('H'.$k, $registro->firma_rp3)

				->setCellValue('F'.$l, $registro->unid4)
				->setCellValue('G'.$l, $registro->desc4)
				->setCellValue('H'.$l, $registro->firma_rp4)

				->setCellValue('F'.$m, $registro->unid5)
				->setCellValue('G'.$m, $registro->desc5)
				->setCellValue('H'.$m, $registro->firma_rp5)

				->setCellValue('F'.$n, $registro->unid6)
				->setCellValue('G'.$n, $registro->desc6)
				->setCellValue('H'.$n, $registro->firma_rp6)

				->setCellValue('F'.$o, $registro->unid7)
				->setCellValue('G'.$o, $registro->desc7)
				->setCellValue('H'.$o, $registro->firma_rp7)

				->setCellValue('F'.$p, $registro->unid8)
				->setCellValue('G'.$p, $registro->desc8)
				->setCellValue('H'.$p, $registro->firma_rp8)

				->setCellValue('F'.$q, $registro->unid9)
				->setCellValue('G'.$q, $registro->desc9)
				->setCellValue('H'.$q, $registro->firma_rp9)

				->setCellValue('F'.$r, $registro->unid10)
				->setCellValue('G'.$r, $registro->desc10)
				->setCellValue('H'.$r, $registro->firma_rp10)

				->setCellValue('F'.$s, $registro->unid11)
				->setCellValue('G'.$s, $registro->desc11)
				->setCellValue('H'.$s, $registro->firma_rp11)

				->setCellValue('F'.$t, $registro->unid12)
				->setCellValue('G'.$t, $registro->desc12)
				->setCellValue('H'.$t, $registro->firma_rp12)

				->setCellValue('F'.$u, $registro->unid13)
				->setCellValue('G'.$u, $registro->desc13)
				->setCellValue('H'.$u, $registro->firma_rp13)

				->setCellValue('F'.$v, $registro->unid14)
				->setCellValue('G'.$v, $registro->desc14)
				->setCellValue('H'.$v, $registro->firma_rp14)

				->setCellValue('F'.$w, $registro->unid15)
				->setCellValue('G'.$w, $registro->desc15)
				->setCellValue('H'.$w, $registro->firma_rp15)

				->setCellValue('F'.$x, $registro->unid16)
				->setCellValue('G'.$x, $registro->desc16)
				->setCellValue('H'.$x, $registro->firma_rp16)

				->setCellValue('F'.$y, $registro->unid17)
				->setCellValue('G'.$y, $registro->desc17)
				->setCellValue('H'.$y, $registro->firma_rp17)

				->setCellValue('F'.$z, $registro->unid18)
				->setCellValue('G'.$z, $registro->desc18)
				->setCellValue('H'.$z, $registro->firma_rp18)

				->setCellValue('F'.$ii, $registro->unid19)
				->setCellValue('G'.$ii, $registro->desc19)
				->setCellValue('H'.$ii, $registro->firma_rp19)

				->setCellValue('F'.$jj, $registro->unid20)
				->setCellValue('G'.$jj, $registro->desc20)
				->setCellValue('H'.$jj, $registro->firma_rp20);
				
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
				
				$nombre= $registro->supervisor;
	}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$fecha01="Reporte Cotizaciones ".$nombre.".xlsx";
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
        		alert('Esta obra no tiene reporte');
        		javascript:history.back()
         	</script>";
	  }
?>