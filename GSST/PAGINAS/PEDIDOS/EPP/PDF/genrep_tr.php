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

	$sql1="SELECT * FROM epp_tr WHERE obra='$obra'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM epp_tr WHERE obra LIKE '%$obra%' AND datef BETWEEN '$desde' AND '$hasta' ORDER BY folio";
 	
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("rep_tr.xlsx");
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
				->setCellValue('H'.$i, $registro->cant_unid1)
				->setCellValue('I'.$i, $registro->desc1)
				->setCellValue('J'.$i, $registro->codigo1)
				->setCellValue('K'.$i, $registro->marca1)
				->setCellValue('L'.$i, $registro->color1)
				->setCellValue('M'.$i, $registro->medidas1)
				->setCellValue('N'.$i, $registro->clase1)
				->setCellValue('O'.$i, $registro->estatus_entrega1.' '.date("d-m-Y",strtotime($registro->fecha_entrega1)))
				->setCellValue('P'.$i, $registro->autorizado_residente.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_residente)))
				->setCellValue('Q'.$i, $registro->autorizado_almacen.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_almacen)))
				->setCellValue('R'.$i, $registro->autorizado_gerseg.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_gerseg)))
				->setCellValue('S'.$i, $registro->autorizado_gerob.' '.date("d-m-Y",strtotime($registro->fecha_autorizado_gerob)))
				->setCellValue('T'.$i, $registro->observaciones_sup)
				->setCellValue('U'.$i, $registro->observaciones_res)
				->setCellValue('V'.$i, $registro->observaciones_almacen)
				->setCellValue('W'.$i, $registro->observaciones_gerseg)
				->setCellValue('X'.$i, $registro->observaciones_gerob)
				
				->setCellValue('H'.$j, $registro->cant_unid2)
				->setCellValue('I'.$j, $registro->desc2)
				->setCellValue('J'.$j, $registro->codigo2)
				->setCellValue('K'.$j, $registro->marca2)
				->setCellValue('L'.$j, $registro->color2)
				->setCellValue('M'.$j, $registro->medidas2)
				->setCellValue('N'.$j, $registro->clase2)
				->setCellValue('O'.$j, $registro->estatus_entrega2.' '.date("d-m-Y",strtotime($registro->fecha_entrega2)))
				
				->setCellValue('H'.$k, $registro->cant_unid3)
				->setCellValue('I'.$k, $registro->desc3)
				->setCellValue('J'.$k, $registro->codigo3)
				->setCellValue('K'.$k, $registro->marca3)
				->setCellValue('L'.$k, $registro->color3)
				->setCellValue('M'.$k, $registro->medidas3)
				->setCellValue('N'.$k, $registro->clase3)
				->setCellValue('O'.$k, $registro->estatus_entrega3.' '.date("d-m-Y",strtotime($registro->fecha_entrega3)))
				
				->setCellValue('H'.$l, $registro->cant_unid4)
				->setCellValue('I'.$l, $registro->desc4)
				->setCellValue('J'.$l, $registro->codigo4)
				->setCellValue('K'.$l, $registro->marca4)
				->setCellValue('L'.$l, $registro->color4)
				->setCellValue('M'.$l, $registro->medidas4)
				->setCellValue('N'.$l, $registro->clase4)
				->setCellValue('O'.$l, $registro->estatus_entrega4.' '.date("d-m-Y",strtotime($registro->fecha_entrega4)))
				
				->setCellValue('H'.$m, $registro->cant_unid5)
				->setCellValue('I'.$m, $registro->desc5)
				->setCellValue('J'.$m, $registro->codigo5)
				->setCellValue('K'.$m, $registro->marca5)
				->setCellValue('L'.$m, $registro->color5)
				->setCellValue('M'.$m, $registro->medidas5)
				->setCellValue('N'.$m, $registro->clase5)
				->setCellValue('O'.$m, $registro->estatus_entrega5.' '.date("d-m-Y",strtotime($registro->fecha_entrega5)))
				
				->setCellValue('H'.$n, $registro->cant_unid6)
				->setCellValue('I'.$n, $registro->desc6)
				->setCellValue('J'.$n, $registro->codigo6)
				->setCellValue('K'.$n, $registro->marca6)
				->setCellValue('L'.$n, $registro->color6)
				->setCellValue('M'.$n, $registro->medidas6)
				->setCellValue('N'.$n, $registro->clase6)
				->setCellValue('O'.$n, $registro->estatus_entrega6.' '.date("d-m-Y",strtotime($registro->fecha_entrega6)))
				
				->setCellValue('H'.$o, $registro->cant_unid7)
				->setCellValue('I'.$o, $registro->desc7)
				->setCellValue('J'.$o, $registro->codigo7)
				->setCellValue('K'.$o, $registro->marca7)
				->setCellValue('L'.$o, $registro->color7)
				->setCellValue('M'.$o, $registro->medidas7)
				->setCellValue('N'.$o, $registro->clase7)
				->setCellValue('O'.$o, $registro->estatus_entrega7.' '.date("d-m-Y",strtotime($registro->fecha_entrega7)))
				
				->setCellValue('H'.$p, $registro->cant_unid8)
				->setCellValue('I'.$p, $registro->desc8)
				->setCellValue('J'.$p, $registro->codigo8)
				->setCellValue('K'.$p, $registro->marca8)
				->setCellValue('L'.$p, $registro->color8)
				->setCellValue('M'.$p, $registro->medidas8)
				->setCellValue('N'.$p, $registro->clase8)
				->setCellValue('O'.$p, $registro->estatus_entrega8.' '.date("d-m-Y",strtotime($registro->fecha_entrega8)))
				
				->setCellValue('H'.$q, $registro->cant_unid9)
				->setCellValue('I'.$q, $registro->desc9)
				->setCellValue('J'.$q, $registro->codigo9)
				->setCellValue('K'.$q, $registro->marca9)
				->setCellValue('L'.$q, $registro->color9)
				->setCellValue('M'.$q, $registro->medidas9)
				->setCellValue('N'.$q, $registro->clase9)
				->setCellValue('O'.$q, $registro->estatus_entrega9.' '.date("d-m-Y",strtotime($registro->fecha_entrega9)))
				
				->setCellValue('H'.$r, $registro->cant_unid10)
				->setCellValue('I'.$r, $registro->desc10)
				->setCellValue('J'.$r, $registro->codigo10)
				->setCellValue('K'.$r, $registro->marca10)
				->setCellValue('L'.$r, $registro->color10)
				->setCellValue('M'.$r, $registro->medidas10)
				->setCellValue('N'.$r, $registro->clase10)
				->setCellValue('O'.$r, $registro->estatus_entrega10.' '.date("d-m-Y",strtotime($registro->fecha_entrega10)))
				
				->setCellValue('H'.$s, $registro->cant_unid11)
				->setCellValue('I'.$s, $registro->desc11)
				->setCellValue('J'.$s, $registro->codigo11)
				->setCellValue('K'.$s, $registro->marca11)
				->setCellValue('L'.$s, $registro->color11)
				->setCellValue('M'.$s, $registro->medidas11)
				->setCellValue('N'.$s, $registro->clase11)
				->setCellValue('O'.$s, $registro->estatus_entrega11.' '.date("d-m-Y",strtotime($registro->fecha_entrega11)))
				
				->setCellValue('H'.$t, $registro->cant_unid12)
				->setCellValue('I'.$t, $registro->desc12)
				->setCellValue('J'.$t, $registro->codigo12)
				->setCellValue('K'.$t, $registro->marca12)
				->setCellValue('L'.$t, $registro->color12)
				->setCellValue('M'.$t, $registro->medidas12)
				->setCellValue('N'.$t, $registro->clase12)
				->setCellValue('O'.$t, $registro->estatus_entrega12.' '.date("d-m-Y",strtotime($registro->fecha_entrega12)))
				
				->setCellValue('H'.$u, $registro->cant_unid13)
				->setCellValue('I'.$u, $registro->desc13)
				->setCellValue('J'.$u, $registro->codigo13)
				->setCellValue('K'.$u, $registro->marca13)
				->setCellValue('L'.$u, $registro->color13)
				->setCellValue('M'.$u, $registro->medidas13)
				->setCellValue('N'.$u, $registro->clase13)
				->setCellValue('O'.$u, $registro->estatus_entrega13.' '.date("d-m-Y",strtotime($registro->fecha_entrega13)))
				
				->setCellValue('H'.$v, $registro->cant_unid14)
				->setCellValue('I'.$v, $registro->desc14)
				->setCellValue('J'.$v, $registro->codigo14)
				->setCellValue('K'.$v, $registro->marca14)
				->setCellValue('L'.$v, $registro->color14)
				->setCellValue('M'.$v, $registro->medidas14)
				->setCellValue('N'.$v, $registro->clase14)
				->setCellValue('O'.$v, $registro->estatus_entrega14.' '.date("d-m-Y",strtotime($registro->fecha_entrega14)))
				
				->setCellValue('H'.$w, $registro->cant_unid15)
				->setCellValue('I'.$w, $registro->desc15)
				->setCellValue('J'.$w, $registro->codigo15)
				->setCellValue('K'.$w, $registro->marca15)
				->setCellValue('L'.$w, $registro->color15)
				->setCellValue('M'.$w, $registro->medidas15)
				->setCellValue('N'.$w, $registro->clase15)
				->setCellValue('O'.$w, $registro->estatus_entrega15.' '.date("d-m-Y",strtotime($registro->fecha_entrega15)))
				
				->setCellValue('H'.$x, $registro->cant_unid16)
				->setCellValue('I'.$x, $registro->desc16)
				->setCellValue('J'.$x, $registro->codigo16)
				->setCellValue('K'.$x, $registro->marca16)
				->setCellValue('L'.$x, $registro->color16)
				->setCellValue('M'.$x, $registro->medidas16)
				->setCellValue('N'.$x, $registro->clase16)
				->setCellValue('O'.$x, $registro->estatus_entrega16.' '.date("d-m-Y",strtotime($registro->fecha_entrega16)))
				
				->setCellValue('H'.$y, $registro->cant_unid17)
				->setCellValue('I'.$y, $registro->desc17)
				->setCellValue('J'.$y, $registro->codigo17)
				->setCellValue('K'.$y, $registro->marca17)
				->setCellValue('L'.$y, $registro->color17)
				->setCellValue('M'.$y, $registro->medidas17)
				->setCellValue('N'.$y, $registro->clase17)
				->setCellValue('O'.$y, $registro->estatus_entrega17.' '.date("d-m-Y",strtotime($registro->fecha_entrega17)))
				
				->setCellValue('H'.$z, $registro->cant_unid18)
				->setCellValue('I'.$z, $registro->desc18)
				->setCellValue('J'.$z, $registro->codigo18)
				->setCellValue('K'.$z, $registro->marca18)
				->setCellValue('L'.$z, $registro->color18)
				->setCellValue('M'.$z, $registro->medidas18)
				->setCellValue('N'.$z, $registro->clase18)
				->setCellValue('O'.$z, $registro->estatus_entrega18.' '.date("d-m-Y",strtotime($registro->fecha_entrega18)))
				
				->setCellValue('H'.$aa, $registro->cant_unid19)
				->setCellValue('I'.$aa, $registro->desc19)
				->setCellValue('J'.$aa, $registro->codigo19)
				->setCellValue('K'.$aa, $registro->marca19)
				->setCellValue('L'.$aa, $registro->color19)
				->setCellValue('M'.$aa, $registro->medidas19)
				->setCellValue('N'.$aa, $registro->clase19)
				->setCellValue('O'.$aa, $registro->estatus_entrega19.' '.date("d-m-Y",strtotime($registro->fecha_entrega19)))
				
				->setCellValue('H'.$ab, $registro->cant_unid20)
				->setCellValue('I'.$ab, $registro->desc20)
				->setCellValue('J'.$ab, $registro->codigo20)
				->setCellValue('K'.$ab, $registro->marca20)
				->setCellValue('L'.$ab, $registro->color20)
				->setCellValue('M'.$ab, $registro->medidas20)
				->setCellValue('N'.$ab, $registro->clase20)
				->setCellValue('O'.$ab, $registro->estatus_entrega20.' '.date("d-m-Y",strtotime($registro->fecha_entrega20)));

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
	$nomfile="Reporte EPP Trimestral.xlsx";
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