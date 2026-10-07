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
	mysql_query("SET NAMES 'utf8'");

	$desde=$_POST['desde'];  
	$hasta=$_POST['hasta'];
	$obra=$_POST['obra'];

	$sql1="SELECT * FROM epp_rc WHERE obra='$obra'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM epp_rc WHERE obra LIKE '%$obra%' AND datef BETWEEN '$desde' AND '$hasta' ORDER BY folio";
 	
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("rep_rc.xlsx");
		$i=6;
		$j=7;
		$k=8;
		$l=9;
		$m=10;
		$n=11;
		$o=12;
		$p=13;
		$q=14;
		$r=15;
		$s=16;
		$t=17;
		$u=18;
		$v=19;
		$w=20;
		$x=21;
		$y=22;
		$z=23;
		$aa=24;
		$ab=25;
	while ($registro = mysql_fetch_object ($resultado)) {
				$objPHPExcel ->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $registro->year)
				->setCellValue('B'.$i, date("d-m-Y",strtotime($registro->datef)))
				->setCellValue('C'.$i, $registro->folio)
				->setCellValue('D'.$i, date("d-m-Y",strtotime($registro->fecha)))
				->setCellValue('E'.$i, $registro->empresa)
				->setCellValue('F'.$i, $registro->obra)
				->setCellValue('G'.$i, $registro->supervisor_sol)
				->setCellValue('H'.$i, $registro->nombre1)
				->setCellValue('I'.$i, $registro->talla_bota1)
				->setCellValue('J'.$i, $registro->talla_overol1)
				->setCellValue('K'.$i, $registro->talla_zapato1)
				->setCellValue('L'.$i, $registro->talla_camisa1)
				->setCellValue('M'.$i, $registro->talla_pantalon1)
				->setCellValue('N'.$i, $registro->talla_chaleco1)
				->setCellValue('O'.$i, $registro->talla_bata1)
				->setCellValue('P'.$i, $registro->estatus_entrega1.' '.date("d-m-Y",strtotime($registro->fecha_entrega1)))
				->setCellValue('Q'.$i, $registro->autorizado_residente.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_residente)))
				->setCellValue('R'.$i, $registro->autorizado_almacen.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_almacen)))
				->setCellValue('S'.$i, $registro->autorizado_gerseg.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_gerseg)))
				->setCellValue('T'.$i, $registro->autorizado_gerob.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_gerob)))
				->setCellValue('U'.$i, $registro->observaciones_sup)
				->setCellValue('V'.$i, $registro->observaciones_res)
				->setCellValue('W'.$i, $registro->observaciones_almacen)
				->setCellValue('X'.$i, $registro->observaciones_gerseg)
				->setCellValue('Y'.$i, $registro->observaciones_gerob)
				
				->setCellValue('H'.$j, $registro->nombre2)
				->setCellValue('I'.$j, $registro->talla_bota2)
				->setCellValue('J'.$j, $registro->talla_overol2)
				->setCellValue('K'.$j, $registro->talla_zapato2)
				->setCellValue('L'.$j, $registro->talla_camisa2)
				->setCellValue('M'.$j, $registro->talla_pantalon2)
				->setCellValue('N'.$j, $registro->talla_chaleco2)
				->setCellValue('O'.$j, $registro->talla_bata2)
				->setCellValue('P'.$j, $registro->estatus_entrega2.' '.date("d-m-Y",strtotime($registro->fecha_entrega2)))
				
				->setCellValue('H'.$k, $registro->nombre3)
				->setCellValue('I'.$k, $registro->talla_bota3)
				->setCellValue('J'.$k, $registro->talla_overol3)
				->setCellValue('K'.$k, $registro->talla_zapato3)
				->setCellValue('L'.$k, $registro->talla_camisa3)
				->setCellValue('M'.$k, $registro->talla_pantalon3)
				->setCellValue('N'.$k, $registro->talla_chaleco3)
				->setCellValue('O'.$k, $registro->talla_bata3)
				->setCellValue('P'.$k, $registro->estatus_entrega3.' '.date("d-m-Y",strtotime($registro->fecha_entrega3)))
				
				->setCellValue('H'.$l, $registro->nombre4)
				->setCellValue('I'.$l, $registro->talla_bota4)
				->setCellValue('J'.$l, $registro->talla_overol4)
				->setCellValue('K'.$l, $registro->talla_zapato4)
				->setCellValue('L'.$l, $registro->talla_camisa4)
				->setCellValue('M'.$l, $registro->talla_pantalon4)
				->setCellValue('N'.$l, $registro->talla_chaleco4)
				->setCellValue('O'.$l, $registro->talla_bata4)
				->setCellValue('P'.$l, $registro->estatus_entrega4.' '.date("d-m-Y",strtotime($registro->fecha_entrega4)))
				
				->setCellValue('H'.$m, $registro->nombre5)
				->setCellValue('I'.$m, $registro->talla_bota5)
				->setCellValue('J'.$m, $registro->talla_overol5)
				->setCellValue('K'.$m, $registro->talla_zapato5)
				->setCellValue('L'.$m, $registro->talla_camisa5)
				->setCellValue('M'.$m, $registro->talla_pantalon5)
				->setCellValue('N'.$m, $registro->talla_chaleco5)
				->setCellValue('O'.$m, $registro->talla_bata5)
				->setCellValue('P'.$m, $registro->estatus_entrega5.' '.date("d-m-Y",strtotime($registro->fecha_entrega5)))
				
				->setCellValue('H'.$n, $registro->nombre6)
				->setCellValue('I'.$n, $registro->talla_bota6)
				->setCellValue('J'.$n, $registro->talla_overol6)
				->setCellValue('K'.$n, $registro->talla_zapato6)
				->setCellValue('L'.$n, $registro->talla_camisa6)
				->setCellValue('M'.$n, $registro->talla_pantalon6)
				->setCellValue('N'.$n, $registro->talla_chaleco6)
				->setCellValue('O'.$i, $registro->talla_bata6)
				->setCellValue('P'.$i, $registro->estatus_entrega6.' '.date("d-m-Y",strtotime($registro->fecha_entrega6)))
				
				->setCellValue('H'.$o, $registro->nombre7)
				->setCellValue('I'.$o, $registro->talla_bota7)
				->setCellValue('J'.$o, $registro->talla_overol7)
				->setCellValue('K'.$o, $registro->talla_zapato7)
				->setCellValue('L'.$o, $registro->talla_camisa7)
				->setCellValue('M'.$o, $registro->talla_pantalon7)
				->setCellValue('N'.$o, $registro->talla_chaleco7)
				->setCellValue('O'.$o, $registro->talla_bata7)
				->setCellValue('P'.$o, $registro->estatus_entrega7.' '.date("d-m-Y",strtotime($registro->fecha_entrega7)))
				
				->setCellValue('H'.$p, $registro->nombre8)
				->setCellValue('I'.$p, $registro->talla_bota8)
				->setCellValue('J'.$p, $registro->talla_overol8)
				->setCellValue('K'.$p, $registro->talla_zapato8)
				->setCellValue('L'.$p, $registro->talla_camisa8)
				->setCellValue('M'.$p, $registro->talla_pantalon8)
				->setCellValue('N'.$p, $registro->talla_chaleco8)
				->setCellValue('O'.$p, $registro->talla_bata8)
				->setCellValue('P'.$p, $registro->estatus_entrega8.' '.date("d-m-Y",strtotime($registro->fecha_entrega8)))
				
				->setCellValue('H'.$q, $registro->nombre9)
				->setCellValue('I'.$q, $registro->talla_bota9)
				->setCellValue('J'.$q, $registro->talla_overol9)
				->setCellValue('K'.$q, $registro->talla_zapato9)
				->setCellValue('L'.$q, $registro->talla_camisa9)
				->setCellValue('M'.$q, $registro->talla_pantalon9)
				->setCellValue('N'.$q, $registro->talla_chaleco9)
				->setCellValue('O'.$q, $registro->talla_bata9)
				->setCellValue('P'.$q, $registro->estatus_entrega9.' '.date("d-m-Y",strtotime($registro->fecha_entrega9)))
				
				->setCellValue('H'.$r, $registro->nombre10)
				->setCellValue('I'.$r, $registro->talla_bota10)
				->setCellValue('J'.$r, $registro->talla_overol10)
				->setCellValue('K'.$r, $registro->talla_zapato10)
				->setCellValue('L'.$r, $registro->talla_camisa10)
				->setCellValue('M'.$r, $registro->talla_pantalon10)
				->setCellValue('N'.$r, $registro->talla_chaleco10)
				->setCellValue('O'.$r, $registro->talla_bata10)
				->setCellValue('P'.$r, $registro->estatus_entrega10.' '.date("d-m-Y",strtotime($registro->fecha_entrega10)))
				
				->setCellValue('H'.$s, $registro->nombre11)
				->setCellValue('I'.$s, $registro->talla_bota11)
				->setCellValue('J'.$s, $registro->talla_overol11)
				->setCellValue('K'.$s, $registro->talla_zapato11)
				->setCellValue('L'.$s, $registro->talla_camisa11)
				->setCellValue('M'.$s, $registro->talla_pantalon11)
				->setCellValue('N'.$s, $registro->talla_chaleco11)
				->setCellValue('O'.$s, $registro->talla_bata11)
				->setCellValue('P'.$s, $registro->estatus_entrega11.' '.date("d-m-Y",strtotime($registro->fecha_entrega11)))
				
				->setCellValue('H'.$t, $registro->nombre12)
				->setCellValue('I'.$t, $registro->talla_bota12)
				->setCellValue('J'.$t, $registro->talla_overol12)
				->setCellValue('K'.$t, $registro->talla_zapato12)
				->setCellValue('L'.$t, $registro->talla_camisa12)
				->setCellValue('M'.$t, $registro->talla_pantalon12)
				->setCellValue('N'.$t, $registro->talla_chaleco12)
				->setCellValue('O'.$t, $registro->talla_bata12)
				->setCellValue('P'.$t, $registro->estatus_entrega12.' '.date("d-m-Y",strtotime($registro->fecha_entrega12)))
				
				->setCellValue('H'.$u, $registro->nombre13)
				->setCellValue('I'.$u, $registro->talla_bota13)
				->setCellValue('J'.$u, $registro->talla_overol13)
				->setCellValue('K'.$u, $registro->talla_zapato13)
				->setCellValue('L'.$u, $registro->talla_camisa13)
				->setCellValue('M'.$u, $registro->talla_pantalon13)
				->setCellValue('N'.$u, $registro->talla_chaleco13)
				->setCellValue('O'.$u, $registro->talla_bata13)
				->setCellValue('P'.$u, $registro->estatus_entrega13.' '.date("d-m-Y",strtotime($registro->fecha_entrega13)))
				
				->setCellValue('H'.$v, $registro->nombre14)
				->setCellValue('I'.$v, $registro->talla_bota14)
				->setCellValue('J'.$v, $registro->talla_overol14)
				->setCellValue('K'.$v, $registro->talla_zapato14)
				->setCellValue('L'.$v, $registro->talla_camisa14)
				->setCellValue('M'.$v, $registro->talla_pantalon14)
				->setCellValue('N'.$v, $registro->talla_chaleco14)
				->setCellValue('O'.$v, $registro->talla_bata14)
				->setCellValue('P'.$v, $registro->estatus_entrega14.' '.date("d-m-Y",strtotime($registro->fecha_entrega14)))
				
				->setCellValue('H'.$w, $registro->nombre15)
				->setCellValue('I'.$w, $registro->talla_bota15)
				->setCellValue('J'.$w, $registro->talla_overol15)
				->setCellValue('K'.$w, $registro->talla_zapato15)
				->setCellValue('L'.$w, $registro->talla_camisa15)
				->setCellValue('M'.$w, $registro->talla_pantalon15)
				->setCellValue('N'.$w, $registro->talla_chaleco15)
				->setCellValue('O'.$w, $registro->talla_bata15)
				->setCellValue('P'.$w, $registro->estatus_entrega15.' '.date("d-m-Y",strtotime($registro->fecha_entrega15)))
				
				->setCellValue('H'.$x, $registro->nombre16)
				->setCellValue('I'.$x, $registro->talla_bota16)
				->setCellValue('J'.$x, $registro->talla_overol16)
				->setCellValue('K'.$x, $registro->talla_zapato16)
				->setCellValue('L'.$x, $registro->talla_camisa16)
				->setCellValue('M'.$x, $registro->talla_pantalon16)
				->setCellValue('N'.$x, $registro->talla_chaleco16)
				->setCellValue('O'.$x, $registro->talla_bata16)
				->setCellValue('P'.$x, $registro->estatus_entrega16.' '.date("d-m-Y",strtotime($registro->fecha_entrega16)))
				
				->setCellValue('H'.$y, $registro->nombre17)
				->setCellValue('I'.$y, $registro->talla_bota17)
				->setCellValue('J'.$y, $registro->talla_overol17)
				->setCellValue('K'.$y, $registro->talla_zapato17)
				->setCellValue('L'.$y, $registro->talla_camisa17)
				->setCellValue('M'.$y, $registro->talla_pantalon17)
				->setCellValue('N'.$y, $registro->talla_chaleco17)
				->setCellValue('O'.$y, $registro->talla_bata17)
				->setCellValue('P'.$y, $registro->estatus_entrega17.' '.date("d-m-Y",strtotime($registro->fecha_entrega17)))
				
				->setCellValue('H'.$z, $registro->nombre18)
				->setCellValue('I'.$z, $registro->talla_bota18)
				->setCellValue('J'.$z, $registro->talla_overol18)
				->setCellValue('K'.$z, $registro->talla_zapato18)
				->setCellValue('L'.$z, $registro->talla_camisa18)
				->setCellValue('M'.$z, $registro->talla_pantalon18)
				->setCellValue('N'.$z, $registro->talla_chaleco18)
				->setCellValue('O'.$z, $registro->talla_bata18)
				->setCellValue('P'.$z, $registro->estatus_entrega18.' '.date("d-m-Y",strtotime($registro->fecha_entrega18)))
				
				->setCellValue('H'.$aa, $registro->nombre19)
				->setCellValue('I'.$aa, $registro->talla_bota19)
				->setCellValue('J'.$aa, $registro->talla_overol19)
				->setCellValue('K'.$aa, $registro->talla_zapato19)
				->setCellValue('L'.$aa, $registro->talla_camisa19)
				->setCellValue('M'.$aa, $registro->talla_pantalon19)
				->setCellValue('N'.$aa, $registro->talla_chaleco19)
				->setCellValue('O'.$aa, $registro->talla_bata19)
				->setCellValue('P'.$aa, $registro->estatus_entrega19.' '.date("d-m-Y",strtotime($registro->fecha_entrega19)))
				
				->setCellValue('H'.$ab, $registro->nombre20)
				->setCellValue('I'.$ab, $registro->talla_bota20)
				->setCellValue('J'.$ab, $registro->talla_overol20)
				->setCellValue('K'.$ab, $registro->talla_zapato20)
				->setCellValue('L'.$ab, $registro->talla_camisa20)
				->setCellValue('M'.$ab, $registro->talla_pantalon20)
				->setCellValue('N'.$ab, $registro->talla_chaleco20)
				->setCellValue('O'.$ab, $registro->talla_bata20)
				->setCellValue('P'.$ab, $registro->estatus_entrega20.' '.date("d-m-Y",strtotime($registro->fecha_entrega20)));

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
				$ab=$ab+21;
	}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$nomfile="Reporte EPP Ropa y Calzado.xlsx";
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
        		alert('Esta obra no tiene reporte');
        		javascript:history.back()
         	</script>";
	  }
?>