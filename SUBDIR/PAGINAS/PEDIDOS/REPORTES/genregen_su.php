<?php
	include("../../../conexion/conexion.php"); 
  	$conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");
	$desde=$_GET['desde'];  
	$hasta=$_GET['hasta'];
 	$sql ="SELECT * FROM pedidos WHERE  fecha BETWEEN '$desde' AND '$hasta' ORDER BY fecha";
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("reporte_general.xlsx");
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
		$kk=24;
		$ll=25;
		$mm=26;
		$nn=27;
		$oo=28;
		$pp=29;
		$qq=30;
		$rr=31;
		$ss=32;
		$tt=33;
		$uu=34;
		$vv=35;
		$ww=36;
		$xx=37;
		$yy=38;
		$zz=39;
		$iii=40;
		$jjj=41;
		$kkk=42;
		$lll=43;
		$mmm=44;
		$nnn=45;
		$ooo=46;
		$ppp=47;
		$qqq=48;
		$rrr=49;
		$sss=50;
		$ttt=50;
		$uuu=50;
		$vvv=50;

	while ($registro = mysql_fetch_object ($resultado)) {
				$objPHPExcel ->setActiveSheetIndex(0)
			//INSERTAR REGISTROS EN PRIMER PEDIDO
				->setCellValue('A'.$i, $registro->folio)
				->setCellValue('B'.$i, $registro->lugar)
				->setCellValue('C'.$i, $registro->estado)
				->setCellValue('D'.$i, date("d-m-Y",strtotime($registro->fecha_recibido)))
				->setCellValue('E'.$i, $registro->cant1)
				->setCellValue('F'.$i, $registro->unid1)
				->setCellValue('G'.$i, $registro->desc1)
				->setCellValue('H'.$i, $registro->uso1)
				->setCellValue('I'.$i, $registro->numero_requisicion1)
				->setCellValue('J'.$i, $registro->tiempo_espera1)
				->setCellValue('K'.$i, $registro->surtido1)
				->setCellValue('L'.$i, $registro->proyecto)
				->setCellValue('M'.$i, $registro->gerencia)
				->setCellValue('N'.$i, date("d-m-Y",strtotime($registro->fecha_surtido_parcial)))
				->setCellValue('O'.$i, date("d-m-Y",strtotime($registro->fecha_surtido)))
				->setCellValue('P'.$i, $registro->observaciones)

				->setCellValue('E'.$j, $registro->cant2)
				->setCellValue('F'.$j, $registro->unid2)
				->setCellValue('G'.$j, $registro->desc2)
				->setCellValue('H'.$j, $registro->uso2)
				->setCellValue('I'.$j, $registro->numero_requisicion2)
				->setCellValue('J'.$j, $registro->tiempo_espera2)
				->setCellValue('K'.$j, $registro->surtido2)

				->setCellValue('E'.$k, $registro->cant3)
				->setCellValue('F'.$k, $registro->unid3)
				->setCellValue('G'.$k, $registro->desc3)
				->setCellValue('H'.$k, $registro->uso3)
				->setCellValue('I'.$k, $registro->numero_requisicion3)
				->setCellValue('J'.$k, $registro->tiempo_espera3)
				->setCellValue('K'.$k, $registro->surtido3)

				->setCellValue('E'.$l, $registro->cant4)
				->setCellValue('F'.$l, $registro->unid4)
				->setCellValue('G'.$l, $registro->desc4)
				->setCellValue('H'.$l, $registro->uso4)
				->setCellValue('I'.$l, $registro->numero_requisicion4)
				->setCellValue('J'.$l, $registro->tiempo_espera4)
				->setCellValue('K'.$l, $registro->surtido4)

				->setCellValue('E'.$m, $registro->cant5)
				->setCellValue('F'.$m, $registro->unid5)
				->setCellValue('G'.$m, $registro->desc5)
				->setCellValue('H'.$m, $registro->uso5)
				->setCellValue('I'.$m, $registro->numero_requisicion5)
				->setCellValue('J'.$m, $registro->tiempo_espera5)
				->setCellValue('K'.$m, $registro->surtido5)

				->setCellValue('E'.$n, $registro->cant6)
				->setCellValue('F'.$n, $registro->unid6)
				->setCellValue('G'.$n, $registro->desc6)
				->setCellValue('H'.$n, $registro->uso6)
				->setCellValue('I'.$n, $registro->numero_requisicion6)
				->setCellValue('J'.$n, $registro->tiempo_espera6)
				->setCellValue('K'.$n, $registro->surtido6)

				->setCellValue('E'.$o, $registro->cant7)
				->setCellValue('F'.$o, $registro->unid7)
				->setCellValue('G'.$o, $registro->desc7)
				->setCellValue('H'.$o, $registro->uso7)
				->setCellValue('I'.$o, $registro->numero_requisicion7)
				->setCellValue('J'.$o, $registro->tiempo_espera7)
				->setCellValue('K'.$o, $registro->surtido7)

				->setCellValue('E'.$p, $registro->cant8)
				->setCellValue('F'.$p, $registro->unid8)
				->setCellValue('G'.$p, $registro->desc8)
				->setCellValue('H'.$p, $registro->uso8)
				->setCellValue('I'.$p, $registro->numero_requisicion8)
				->setCellValue('J'.$p, $registro->tiempo_espera8)
				->setCellValue('K'.$p, $registro->surtido8)

				->setCellValue('E'.$q, $registro->cant9)
				->setCellValue('F'.$q, $registro->unid9)
				->setCellValue('G'.$q, $registro->desc9)
				->setCellValue('H'.$q, $registro->uso9)
				->setCellValue('I'.$q, $registro->numero_requisicion9)
				->setCellValue('J'.$q, $registro->tiempo_espera9)
				->setCellValue('K'.$q, $registro->surtido9)

				->setCellValue('E'.$r, $registro->cant10)
				->setCellValue('F'.$r, $registro->unid10)
				->setCellValue('G'.$r, $registro->desc10)
				->setCellValue('H'.$r, $registro->uso10)
				->setCellValue('I'.$r, $registro->numero_requisicion10)
				->setCellValue('J'.$r, $registro->tiempo_espera10)
				->setCellValue('K'.$r, $registro->surtido10)

				->setCellValue('E'.$s, $registro->cant11)
				->setCellValue('F'.$s, $registro->unid11)
				->setCellValue('G'.$s, $registro->desc11)
				->setCellValue('H'.$s, $registro->uso11)
				->setCellValue('I'.$s, $registro->numero_requisicion11)
				->setCellValue('J'.$s, $registro->tiempo_espera11)
				->setCellValue('K'.$s, $registro->surtido11)

				->setCellValue('E'.$t, $registro->cant12)
				->setCellValue('F'.$t, $registro->unid12)
				->setCellValue('G'.$t, $registro->desc12)
				->setCellValue('H'.$t, $registro->uso12)
				->setCellValue('I'.$t, $registro->numero_requisicion12)
				->setCellValue('J'.$t, $registro->tiempo_espera12)
				->setCellValue('K'.$t, $registro->surtido12)

				->setCellValue('E'.$u, $registro->cant13)
				->setCellValue('F'.$u, $registro->unid13)
				->setCellValue('G'.$u, $registro->desc13)
				->setCellValue('H'.$u, $registro->uso13)
				->setCellValue('I'.$u, $registro->numero_requisicion13)
				->setCellValue('J'.$u, $registro->tiempo_espera13)
				->setCellValue('K'.$u, $registro->surtido13)

				->setCellValue('E'.$v, $registro->cant14)
				->setCellValue('F'.$v, $registro->unid14)
				->setCellValue('G'.$v, $registro->desc14)
				->setCellValue('H'.$v, $registro->uso14)
				->setCellValue('I'.$v, $registro->numero_requisicion14)
				->setCellValue('J'.$v, $registro->tiempo_espera14)
				->setCellValue('K'.$v, $registro->surtido14)

				->setCellValue('E'.$w, $registro->cant15)
				->setCellValue('F'.$w, $registro->unid15)
				->setCellValue('G'.$w, $registro->desc15)
				->setCellValue('H'.$w, $registro->uso15)
				->setCellValue('I'.$w, $registro->numero_requisicion15)
				->setCellValue('J'.$w, $registro->tiempo_espera15)
				->setCellValue('K'.$w, $registro->surtido15)

				->setCellValue('E'.$x, $registro->cant16)
				->setCellValue('F'.$x, $registro->unid16)
				->setCellValue('G'.$x, $registro->desc16)
				->setCellValue('H'.$x, $registro->uso16)
				->setCellValue('I'.$x, $registro->numero_requisicion16)
				->setCellValue('J'.$x, $registro->tiempo_espera16)
				->setCellValue('K'.$x, $registro->surtido16)

				->setCellValue('E'.$y, $registro->cant17)
				->setCellValue('F'.$y, $registro->unid17)
				->setCellValue('G'.$y, $registro->desc17)
				->setCellValue('H'.$y, $registro->uso17)
				->setCellValue('I'.$y, $registro->numero_requisicion17)
				->setCellValue('J'.$y, $registro->tiempo_espera17)
				->setCellValue('K'.$y, $registro->surtido17)

				->setCellValue('E'.$z, $registro->cant18)
				->setCellValue('F'.$z, $registro->unid18)
				->setCellValue('G'.$z, $registro->desc18)
				->setCellValue('H'.$z, $registro->uso18)
				->setCellValue('I'.$z, $registro->numero_requisicion18)
				->setCellValue('J'.$z, $registro->tiempo_espera18)
				->setCellValue('K'.$z, $registro->surtido18)

				->setCellValue('E'.$ii, $registro->cant19)
				->setCellValue('F'.$ii, $registro->unid19)
				->setCellValue('G'.$ii, $registro->desc19)
				->setCellValue('H'.$ii, $registro->uso19)
				->setCellValue('I'.$ii, $registro->numero_requisicion19)
				->setCellValue('J'.$ii, $registro->tiempo_espera19)
				->setCellValue('K'.$ii, $registro->surtido19)

				->setCellValue('E'.$jj, $registro->cant20)
				->setCellValue('F'.$jj, $registro->unid20)
				->setCellValue('G'.$jj, $registro->desc20)
				->setCellValue('H'.$jj, $registro->uso20)
				->setCellValue('I'.$jj, $registro->numero_requisicion20)
				->setCellValue('J'.$jj, $registro->tiempo_espera20)
				->setCellValue('K'.$jj, $registro->surtido20)

				->setCellValue('E'.$kk, $registro->cant21)
				->setCellValue('F'.$kk, $registro->unid21)
				->setCellValue('G'.$kk, $registro->desc21)
				->setCellValue('H'.$kk, $registro->uso21)
				->setCellValue('I'.$kk, $registro->numero_requisicion21)
				->setCellValue('J'.$kk, $registro->tiempo_espera21)
				->setCellValue('K'.$kk, $registro->surtido21)

				->setCellValue('E'.$ll, $registro->cant22)
				->setCellValue('F'.$ll, $registro->unid22)
				->setCellValue('G'.$ll, $registro->desc22)
				->setCellValue('H'.$ll, $registro->uso22)
				->setCellValue('I'.$ll, $registro->numero_requisicion22)
				->setCellValue('J'.$ll, $registro->tiempo_espera22)
				->setCellValue('K'.$ll, $registro->surtido22)

				->setCellValue('E'.$mm, $registro->cant23)
				->setCellValue('F'.$mm, $registro->unid23)
				->setCellValue('G'.$mm, $registro->desc23)
				->setCellValue('H'.$mm, $registro->uso23)
				->setCellValue('I'.$mm, $registro->numero_requisicion23)
				->setCellValue('J'.$mm, $registro->tiempo_espera23)
				->setCellValue('K'.$mm, $registro->surtido23)

				->setCellValue('E'.$nn, $registro->cant24)
				->setCellValue('F'.$nn, $registro->unid24)
				->setCellValue('G'.$nn, $registro->desc24)
				->setCellValue('H'.$nn, $registro->uso24)
				->setCellValue('I'.$nn, $registro->numero_requisicion24)
				->setCellValue('J'.$nn, $registro->tiempo_espera24)
				->setCellValue('K'.$nn, $registro->surtido24)

				->setCellValue('E'.$oo, $registro->cant25)
				->setCellValue('F'.$oo, $registro->unid25)
				->setCellValue('G'.$oo, $registro->desc25)
				->setCellValue('H'.$oo, $registro->uso25)
				->setCellValue('I'.$oo, $registro->numero_requisicion25)
				->setCellValue('J'.$oo, $registro->tiempo_espera25)
				->setCellValue('K'.$oo, $registro->surtido25)

				->setCellValue('E'.$pp, $registro->cant26)
				->setCellValue('F'.$pp, $registro->unid26)
				->setCellValue('G'.$pp, $registro->desc26)
				->setCellValue('H'.$pp, $registro->uso26)
				->setCellValue('I'.$pp, $registro->numero_requisicion26)
				->setCellValue('J'.$pp, $registro->tiempo_espera26)
				->setCellValue('K'.$pp, $registro->surtido26)

				->setCellValue('E'.$qq, $registro->cant27)
				->setCellValue('F'.$qq, $registro->unid27)
				->setCellValue('G'.$qq, $registro->desc27)
				->setCellValue('H'.$qq, $registro->uso27)
				->setCellValue('I'.$qq, $registro->numero_requisicion27)
				->setCellValue('J'.$qq, $registro->tiempo_espera27)
				->setCellValue('K'.$qq, $registro->surtido27)

				->setCellValue('E'.$rr, $registro->cant28)
				->setCellValue('F'.$rr, $registro->unid28)
				->setCellValue('G'.$rr, $registro->desc28)
				->setCellValue('H'.$rr, $registro->uso28)
				->setCellValue('I'.$rr, $registro->numero_requisicion28)
				->setCellValue('J'.$rr, $registro->tiempo_espera28)
				->setCellValue('K'.$rr, $registro->surtido28)

				->setCellValue('E'.$ss, $registro->cant29)
				->setCellValue('F'.$ss, $registro->unid29)
				->setCellValue('G'.$ss, $registro->desc29)
				->setCellValue('H'.$ss, $registro->uso29)
				->setCellValue('I'.$ss, $registro->numero_requisicion29)
				->setCellValue('J'.$ss, $registro->tiempo_espera29)
				->setCellValue('K'.$ss, $registro->surtido29)

				->setCellValue('E'.$tt, $registro->cant30)
				->setCellValue('F'.$tt, $registro->unid30)
				->setCellValue('G'.$tt, $registro->desc30)
				->setCellValue('H'.$tt, $registro->uso30)
				->setCellValue('I'.$tt, $registro->numero_requisicion30)
				->setCellValue('J'.$tt, $registro->tiempo_espera30)
				->setCellValue('K'.$tt, $registro->surtido30)

				->setCellValue('E'.$uu, $registro->cant31)
				->setCellValue('F'.$uu, $registro->unid31)
				->setCellValue('G'.$uu, $registro->desc31)
				->setCellValue('H'.$uu, $registro->uso31)
				->setCellValue('I'.$uu, $registro->numero_requisicion31)
				->setCellValue('J'.$uu, $registro->tiempo_espera31)
				->setCellValue('K'.$uu, $registro->surtido31)

				->setCellValue('E'.$vv, $registro->cant32)
				->setCellValue('F'.$vv, $registro->unid32)
				->setCellValue('G'.$vv, $registro->desc32)
				->setCellValue('H'.$vv, $registro->uso32)
				->setCellValue('I'.$vv, $registro->numero_requisicion32)
				->setCellValue('J'.$vv, $registro->tiempo_espera32)
				->setCellValue('K'.$vv, $registro->surtido32)

				->setCellValue('E'.$ww, $registro->cant33)
				->setCellValue('F'.$ww, $registro->unid33)
				->setCellValue('G'.$ww, $registro->desc33)
				->setCellValue('H'.$ww, $registro->uso33)
				->setCellValue('I'.$ww, $registro->numero_requisicion33)
				->setCellValue('J'.$ww, $registro->tiempo_espera33)
				->setCellValue('K'.$ww, $registro->surtido33)

				->setCellValue('E'.$xx, $registro->cant34)
				->setCellValue('F'.$xx, $registro->unid34)
				->setCellValue('G'.$xx, $registro->desc34)
				->setCellValue('H'.$xx, $registro->uso34)
				->setCellValue('I'.$xx, $registro->numero_requisicion34)
				->setCellValue('J'.$xx, $registro->tiempo_espera34)
				->setCellValue('K'.$xx, $registro->surtido34)

				->setCellValue('E'.$yy, $registro->cant35)
				->setCellValue('F'.$yy, $registro->unid35)
				->setCellValue('G'.$yy, $registro->desc35)
				->setCellValue('H'.$yy, $registro->uso35)
				->setCellValue('I'.$yy, $registro->numero_requisicion35)
				->setCellValue('J'.$yy, $registro->tiempo_espera35)
				->setCellValue('K'.$yy, $registro->surtido35)

				->setCellValue('E'.$zz, $registro->cant36)
				->setCellValue('F'.$zz, $registro->unid36)
				->setCellValue('G'.$zz, $registro->desc36)
				->setCellValue('H'.$zz, $registro->uso36)
				->setCellValue('I'.$zz, $registro->numero_requisicion36)
				->setCellValue('J'.$zz, $registro->tiempo_espera36)
				->setCellValue('K'.$zz, $registro->surtido36)

				->setCellValue('E'.$iii, $registro->cant37)
				->setCellValue('F'.$iii, $registro->unid37)
				->setCellValue('G'.$iii, $registro->desc37)
				->setCellValue('H'.$iii, $registro->uso37)
				->setCellValue('I'.$iii, $registro->numero_requisicion37)
				->setCellValue('J'.$iii, $registro->tiempo_espera37)
				->setCellValue('K'.$iii, $registro->surtido37)

				->setCellValue('E'.$jjj, $registro->cant38)
				->setCellValue('F'.$jjj, $registro->unid38)
				->setCellValue('G'.$jjj, $registro->desc38)
				->setCellValue('H'.$jjj, $registro->uso38)
				->setCellValue('I'.$jjj, $registro->numero_requisicion38)
				->setCellValue('J'.$jjj, $registro->tiempo_espera38)
				->setCellValue('K'.$jjj, $registro->surtido38)

				->setCellValue('E'.$kkk, $registro->cant39)
				->setCellValue('F'.$kkk, $registro->unid39)
				->setCellValue('G'.$kkk, $registro->desc39)
				->setCellValue('H'.$kkk, $registro->uso39)
				->setCellValue('I'.$kkk, $registro->numero_requisicion39)
				->setCellValue('J'.$kkk, $registro->tiempo_espera39)
				->setCellValue('K'.$kkk, $registro->surtido39)

				->setCellValue('E'.$lll, $registro->cant40)
				->setCellValue('F'.$lll, $registro->unid40)
				->setCellValue('G'.$lll, $registro->desc40)
				->setCellValue('H'.$lll, $registro->uso40)
				->setCellValue('I'.$lll, $registro->numero_requisicion40)
				->setCellValue('J'.$lll, $registro->tiempo_espera40)
				->setCellValue('K'.$lll, $registro->surtido40)

				->setCellValue('E'.$mmm, $registro->cant41)
				->setCellValue('F'.$mmm, $registro->unid41)
				->setCellValue('G'.$mmm, $registro->desc41)
				->setCellValue('H'.$mmm, $registro->uso41)
				->setCellValue('I'.$mmm, $registro->numero_requisicion41)
				->setCellValue('J'.$mmm, $registro->tiempo_espera41)
				->setCellValue('K'.$mmm, $registro->surtido41)

				->setCellValue('E'.$nnn, $registro->cant42)
				->setCellValue('F'.$nnn, $registro->unid42)
				->setCellValue('G'.$nnn, $registro->desc42)
				->setCellValue('H'.$nnn, $registro->uso42)
				->setCellValue('I'.$nnn, $registro->numero_requisicion42)
				->setCellValue('J'.$nnn, $registro->tiempo_espera42)
				->setCellValue('K'.$nnn, $registro->surtido42)

				->setCellValue('E'.$ooo, $registro->cant43)
				->setCellValue('F'.$ooo, $registro->unid43)
				->setCellValue('G'.$ooo, $registro->desc43)
				->setCellValue('H'.$ooo, $registro->uso43)
				->setCellValue('I'.$ooo, $registro->numero_requisicion43)
				->setCellValue('J'.$ooo, $registro->tiempo_espera43)
				->setCellValue('K'.$ooo, $registro->surtido43)

				->setCellValue('E'.$ppp, $registro->cant44)
				->setCellValue('F'.$ppp, $registro->unid44)
				->setCellValue('G'.$ppp, $registro->desc44)
				->setCellValue('H'.$ppp, $registro->uso44)
				->setCellValue('I'.$ppp, $registro->numero_requisicion44)
				->setCellValue('J'.$ppp, $registro->tiempo_espera44)
				->setCellValue('K'.$ppp, $registro->surtido44)

				->setCellValue('E'.$qqq, $registro->cant45)
				->setCellValue('F'.$qqq, $registro->unid45)
				->setCellValue('G'.$qqq, $registro->desc45)
				->setCellValue('H'.$qqq, $registro->uso45)
				->setCellValue('I'.$qqq, $registro->numero_requisicion45)
				->setCellValue('J'.$qqq, $registro->tiempo_espera45)
				->setCellValue('K'.$qqq, $registro->surtido45)

				->setCellValue('E'.$rrr, $registro->cant46)
				->setCellValue('F'.$rrr, $registro->unid46)
				->setCellValue('G'.$rrr, $registro->desc46)
				->setCellValue('H'.$rrr, $registro->uso46)
				->setCellValue('I'.$rrr, $registro->numero_requisicion46)
				->setCellValue('J'.$rrr, $registro->tiempo_espera46)
				->setCellValue('K'.$rrr, $registro->surtido46)

				->setCellValue('E'.$sss, $registro->cant47)
				->setCellValue('F'.$sss, $registro->unid47)
				->setCellValue('G'.$sss, $registro->desc47)
				->setCellValue('H'.$sss, $registro->uso47)
				->setCellValue('I'.$sss, $registro->numero_requisicion47)
				->setCellValue('J'.$sss, $registro->tiempo_espera47)
				->setCellValue('K'.$sss, $registro->surtido47)

				->setCellValue('E'.$ttt, $registro->cant48)
				->setCellValue('F'.$ttt, $registro->unid48)
				->setCellValue('G'.$ttt, $registro->desc48)
				->setCellValue('H'.$ttt, $registro->uso48)
				->setCellValue('I'.$ttt, $registro->numero_requisicion48)
				->setCellValue('J'.$ttt, $registro->tiempo_espera48)
				->setCellValue('K'.$ttt, $registro->surtido48)

				->setCellValue('E'.$uuu, $registro->cant49)
				->setCellValue('F'.$uuu, $registro->unid49)
				->setCellValue('G'.$uuu, $registro->desc49)
				->setCellValue('H'.$uuu, $registro->uso49)
				->setCellValue('I'.$uuu, $registro->numero_requisicion49)
				->setCellValue('J'.$uuu, $registro->tiempo_espera49)
				->setCellValue('K'.$uuu, $registro->surtido49)

				->setCellValue('E'.$vvv, $registro->cant50)
				->setCellValue('F'.$vvv, $registro->unid50)
				->setCellValue('G'.$vvv, $registro->desc50)
				->setCellValue('H'.$vvv, $registro->uso50)
				->setCellValue('I'.$vvv, $registro->numero_requisicion50)
				->setCellValue('J'.$vvv, $registro->tiempo_espera50)
				->setCellValue('K'.$vvv, $registro->surtido50);
				
				$i=$i+51;
				$j=$j+51;
				$k=$k+51;
				$l=$l+51;
				$m=$m+51;
				$n=$n+51;
				$o=$o+51;
				$p=$p+51;
				$q=$q+51;
				$r=$r+51;
				$s=$s+51;
				$t=$t+51;
				$u=$u+51;
				$v=$v+51;
				$w=$w+51;
				$x=$x+51;
				$y=$y+51;
				$z=$z+51;

				$ii=$ii+51;
				$jj=$jj+51;
				$kk=$kk+51;
				$ll=$ll+51;
				$mm=$mm+51;
				$nn=$nn+51;
				$oo=$oo+51;
				$pp=$pp+51;
				$qq=$qq+51;
				$rr=$rr+51;
				$ss=$ss+51;
				$tt=$tt+51;
				$uu=$uu+51;
				$vv=$vv+51;
				$ww=$ww+51;
				$xx=$xx+51;
				$yy=$yy+51;
				$zz=$zz+51;

				$iii=$iii+51;
				$jjj=$jjj+51;
				$kkk=$kkk+51;
				$lll=$lll+51;
				$mmm=$mmm+51;
				$nnn=$nnn+51;
				$ooo=$ooo+51;
				$ppp=$ppp+51;
				$qqq=$qqq+51;
				$rrr=$rrr+51;
				$sss=$sss+51;
				$ttt=$ttt+51;
				$uuu=$uuu+51;
				$vvv=$vvv+51;
				
				
	}			
	}
	
	header('Content-Type: application/vdn.ms-excel');
	$fecha01="Reporte General $Mes.xlsx";
	header('Content-Disposition: attachment;filename='.$fecha01.'');
	header('Cache-Control: max-age=0');
	$objPHPExcel->getActiveSheet() ->setTitle('Reporte');
	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
	ob_end_clean();
	$objWriter->save('php://output');
	exit;
	mysql_close();
?>