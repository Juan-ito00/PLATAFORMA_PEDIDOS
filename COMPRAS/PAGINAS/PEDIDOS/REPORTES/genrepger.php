<?php
	include("../../../conexion/conexion.php");
   	$conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");

	$desde=$_GET['desde'];  
	$hasta=$_GET['hasta'];
	$buscar=$_GET['gerencia'];

	$sql1="SELECT * FROM pedidos WHERE gerencia='$buscar'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM pedidos WHERE gerencia LIKE '%$buscar%' AND lugar='Compras' AND fecha BETWEEN '$desde' AND '$hasta' ORDER BY folio";
 	
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("reporte_gerencia.xlsx");
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
			$objPHPExcel ->getActiveSheet()->mergeCells('V'.($i).':V'.($i+50));
				$objPHPExcel ->setActiveSheetIndex(0)
			//INSERTAR REGISTROS EN PRIMER PEDIDO
				->setCellValue('A'.$i, $registro->folio)
				->setCellValue('B'.$i, $registro->folio_af)
				->setCellValue('C'.$i, $registro->estado)
				->setCellValue('D'.$i, date("d-m-Y",strtotime($registro->fecha_recibido)))
				->setCellValue('E'.$i, $registro->cant1)
				->setCellValue('F'.$i, $registro->unid1)
				->setCellValue('G'.$i, $registro->desc1)
				->setCellValue('H'.$i, $registro->uso1)
				->setCellValue('I'.$i, $registro->surtido1)
				->setCellValue('J'.$i, $registro->tiempo_espera1)
				->setCellValue('K'.$i, $registro->entrega_1)
				->setCellValue('L'.$i, $registro->recibe_1)
				->setCellValue('M'.$i, $registro->firmado_1)
				->setCellValue('N'.$i, $registro->no_firmado1)
				->setCellValue('O'.$i, $registro->monto_mxn)
				->setCellValue('P'.$i, $registro->monto_credito)
				->setCellValue('R'.$i, $registro->proyecto)
				->setCellValue('S'.$i, $registro->gerencia)
				->setCellValue('T'.$i, $registro->fecha_surtido)

				->setCellValue('B'.$j, $registro->folio_af)
				->setCellValue('E'.$j, $registro->cant2)
				->setCellValue('F'.$j, $registro->unid2)
				->setCellValue('G'.$j, $registro->desc2)
				->setCellValue('H'.$j, $registro->uso2)
				->setCellValue('I'.$j, $registro->surtido2)
				->setCellValue('J'.$j, $registro->tiempo_espera2)
				->setCellValue('K'.$j, $registro->entrega_2)
				->setCellValue('L'.$j, $registro->recibe_2)
				->setCellValue('M'.$j, $registro->firmado_2)
				->setCellValue('N'.$j, $registro->no_firmado2)

				->setCellValue('B'.$k, $registro->folio_af)
				->setCellValue('E'.$k, $registro->cant3)
				->setCellValue('F'.$k, $registro->unid3)
				->setCellValue('G'.$k, $registro->desc3)
				->setCellValue('H'.$k, $registro->uso3)
				->setCellValue('I'.$k, $registro->surtido3)
				->setCellValue('J'.$k, $registro->tiempo_espera3)
				->setCellValue('K'.$k, $registro->entrega_3)
				->setCellValue('L'.$k, $registro->recibe_3)
				->setCellValue('M'.$k, $registro->firmado_3)
				->setCellValue('N'.$k, $registro->no_firmado3)

				->setCellValue('B'.$l, $registro->folio_af)
				->setCellValue('E'.$l, $registro->cant4)
				->setCellValue('F'.$l, $registro->unid4)
				->setCellValue('G'.$l, $registro->desc4)
				->setCellValue('H'.$l, $registro->uso4)
				->setCellValue('I'.$l, $registro->surtido4)
				->setCellValue('J'.$l, $registro->tiempo_espera4)
				->setCellValue('K'.$l, $registro->entrega_4)
				->setCellValue('L'.$l, $registro->recibe_4)
				->setCellValue('M'.$l, $registro->firmado_4)
				->setCellValue('N'.$l, $registro->no_firmado4)

				->setCellValue('B'.$m, $registro->folio_af)
				->setCellValue('E'.$m, $registro->cant5)
				->setCellValue('F'.$m, $registro->unid5)
				->setCellValue('G'.$m, $registro->desc5)
				->setCellValue('H'.$m, $registro->uso5)
				->setCellValue('I'.$m, $registro->surtido5)
				->setCellValue('J'.$m, $registro->tiempo_espera5)
				->setCellValue('K'.$m, $registro->entrega_5)
				->setCellValue('L'.$m, $registro->recibe_5)
				->setCellValue('M'.$m, $registro->firmado_5)
				->setCellValue('N'.$m, $registro->no_firmado5)

				->setCellValue('B'.$n, $registro->folio_af)
				->setCellValue('E'.$n, $registro->cant6)
				->setCellValue('F'.$n, $registro->unid6)
				->setCellValue('G'.$n, $registro->desc6)
				->setCellValue('H'.$n, $registro->uso6)
				->setCellValue('I'.$n, $registro->surtido6)
				->setCellValue('J'.$n, $registro->tiempo_espera6)
				->setCellValue('K'.$n, $registro->entrega_6)
				->setCellValue('L'.$n, $registro->recibe_6)
				->setCellValue('M'.$n, $registro->firmado_6)
				->setCellValue('N'.$n, $registro->no_firmado6)

				->setCellValue('B'.$o, $registro->folio_af)
				->setCellValue('E'.$o, $registro->cant7)
				->setCellValue('F'.$o, $registro->unid7)
				->setCellValue('G'.$o, $registro->desc7)
				->setCellValue('H'.$o, $registro->uso7)
				->setCellValue('I'.$o, $registro->surtido7)
				->setCellValue('J'.$o, $registro->tiempo_espera7)
				->setCellValue('K'.$o, $registro->entrega_7)
				->setCellValue('L'.$o, $registro->recibe_7)
				->setCellValue('M'.$o, $registro->firmado_7)
				->setCellValue('N'.$o, $registro->no_firmado7)

				->setCellValue('B'.$p, $registro->folio_af)
				->setCellValue('E'.$p, $registro->cant8)
				->setCellValue('F'.$p, $registro->unid8)
				->setCellValue('G'.$p, $registro->desc8)
				->setCellValue('H'.$p, $registro->uso8)
				->setCellValue('I'.$p, $registro->surtido8)
				->setCellValue('J'.$p, $registro->tiempo_espera8)
				->setCellValue('K'.$p, $registro->entrega_8)
				->setCellValue('L'.$p, $registro->recibe_8)
				->setCellValue('M'.$p, $registro->firmado_8)
				->setCellValue('N'.$p, $registro->no_firmado8)

				->setCellValue('B'.$q, $registro->folio_af)
				->setCellValue('E'.$q, $registro->cant9)
				->setCellValue('F'.$q, $registro->unid9)
				->setCellValue('G'.$q, $registro->desc9)
				->setCellValue('H'.$q, $registro->uso9)
				->setCellValue('I'.$q, $registro->surtido9)
				->setCellValue('J'.$q, $registro->tiempo_espera9)
				->setCellValue('K'.$q, $registro->entrega_9)
				->setCellValue('L'.$q, $registro->recibe_9)
				->setCellValue('M'.$q, $registro->firmado_9)
				->setCellValue('N'.$q, $registro->no_firmado9)

				->setCellValue('B'.$r, $registro->folio_af)
				->setCellValue('E'.$r, $registro->cant10)
				->setCellValue('F'.$r, $registro->unid10)
				->setCellValue('G'.$r, $registro->desc10)
				->setCellValue('H'.$r, $registro->uso10)
				->setCellValue('I'.$r, $registro->surtido10)
				->setCellValue('J'.$r, $registro->tiempo_espera10)
				->setCellValue('K'.$r, $registro->entrega_10)
				->setCellValue('L'.$r, $registro->recibe_10)
				->setCellValue('M'.$r, $registro->firmado_10)
				->setCellValue('N'.$r, $registro->no_firmado10)

				->setCellValue('B'.$s, $registro->folio_af)
				->setCellValue('E'.$s, $registro->cant11)
				->setCellValue('F'.$s, $registro->unid11)
				->setCellValue('G'.$s, $registro->desc11)
				->setCellValue('H'.$s, $registro->uso11)
				->setCellValue('I'.$s, $registro->surtido11)
				->setCellValue('J'.$s, $registro->tiempo_espera11)
				->setCellValue('K'.$s, $registro->entrega_11)
				->setCellValue('L'.$s, $registro->recibe_11)
				->setCellValue('M'.$s, $registro->firmado_11)
				->setCellValue('N'.$s, $registro->no_firmado11)

				->setCellValue('B'.$t, $registro->folio_af)
				->setCellValue('E'.$t, $registro->cant12)
				->setCellValue('F'.$t, $registro->unid12)
				->setCellValue('G'.$t, $registro->desc12)
				->setCellValue('H'.$t, $registro->uso12)
				->setCellValue('I'.$t, $registro->surtido12)
				->setCellValue('J'.$t, $registro->tiempo_espera12)
				->setCellValue('K'.$t, $registro->entrega_12)
				->setCellValue('L'.$t, $registro->recibe_12)
				->setCellValue('M'.$t, $registro->firmado_12)
				->setCellValue('N'.$t, $registro->no_firmado12)

				->setCellValue('B'.$u, $registro->folio_af)
				->setCellValue('E'.$u, $registro->cant13)
				->setCellValue('F'.$u, $registro->unid13)
				->setCellValue('G'.$u, $registro->desc13)
				->setCellValue('H'.$u, $registro->uso13)
				->setCellValue('I'.$u, $registro->surtido13)
				->setCellValue('J'.$u, $registro->tiempo_espera13)
				->setCellValue('K'.$u, $registro->entrega_13)
				->setCellValue('L'.$u, $registro->recibe_13)
				->setCellValue('M'.$u, $registro->firmado_13)
				->setCellValue('N'.$u, $registro->no_firmado13)

				->setCellValue('B'.$v, $registro->folio_af)
				->setCellValue('E'.$v, $registro->cant14)
				->setCellValue('F'.$v, $registro->unid14)
				->setCellValue('G'.$v, $registro->desc14)
				->setCellValue('H'.$v, $registro->uso14)
				->setCellValue('I'.$v, $registro->surtido14)
				->setCellValue('J'.$v, $registro->tiempo_espera14)
				->setCellValue('K'.$v, $registro->entrega_14)
				->setCellValue('L'.$v, $registro->recibe_14)
				->setCellValue('M'.$v, $registro->firmado_14)
				->setCellValue('N'.$v, $registro->no_firmado14)

				->setCellValue('B'.$w, $registro->folio_af)
				->setCellValue('E'.$w, $registro->cant15)
				->setCellValue('F'.$w, $registro->unid15)
				->setCellValue('G'.$w, $registro->desc15)
				->setCellValue('H'.$w, $registro->uso15)
				->setCellValue('I'.$w, $registro->surtido15)
				->setCellValue('J'.$w, $registro->tiempo_espera15)
				->setCellValue('K'.$w, $registro->entrega_15)
				->setCellValue('L'.$w, $registro->recibe_15)
				->setCellValue('M'.$w, $registro->firmado_15)
				->setCellValue('N'.$w, $registro->no_firmado15)

				->setCellValue('B'.$x, $registro->folio_af)
				->setCellValue('E'.$x, $registro->cant16)
				->setCellValue('F'.$x, $registro->unid16)
				->setCellValue('G'.$x, $registro->desc16)
				->setCellValue('H'.$x, $registro->uso16)
				->setCellValue('I'.$x, $registro->surtido16)
				->setCellValue('J'.$x, $registro->tiempo_espera16)
				->setCellValue('K'.$x, $registro->entrega_16)
				->setCellValue('L'.$x, $registro->recibe_16)
				->setCellValue('M'.$x, $registro->firmado_16)
				->setCellValue('N'.$x, $registro->no_firmado16)

				->setCellValue('B'.$y, $registro->folio_af)
				->setCellValue('E'.$y, $registro->cant17)
				->setCellValue('F'.$y, $registro->unid17)
				->setCellValue('G'.$y, $registro->desc17)
				->setCellValue('H'.$y, $registro->uso17)
				->setCellValue('I'.$y, $registro->surtido17)
				->setCellValue('J'.$y, $registro->tiempo_espera17)
				->setCellValue('K'.$y, $registro->entrega_17)
				->setCellValue('L'.$y, $registro->recibe_17)
				->setCellValue('M'.$y, $registro->firmado_17)
				->setCellValue('N'.$y, $registro->no_firmado17)

				->setCellValue('B'.$z, $registro->folio_af)
				->setCellValue('E'.$z, $registro->cant18)
				->setCellValue('F'.$z, $registro->unid18)
				->setCellValue('G'.$z, $registro->desc18)
				->setCellValue('H'.$z, $registro->uso18)
				->setCellValue('I'.$z, $registro->surtido18)
				->setCellValue('J'.$z, $registro->tiempo_espera18)
				->setCellValue('K'.$z, $registro->entrega_18)
				->setCellValue('L'.$z, $registro->recibe_18)
				->setCellValue('M'.$z, $registro->firmado_18)
				->setCellValue('N'.$z, $registro->no_firmado18)

				->setCellValue('B'.$ii, $registro->folio_af)
				->setCellValue('E'.$ii, $registro->cant19)
				->setCellValue('F'.$ii, $registro->unid19)
				->setCellValue('G'.$ii, $registro->desc19)
				->setCellValue('H'.$ii, $registro->uso19)
				->setCellValue('I'.$ii, $registro->surtido19)
				->setCellValue('J'.$ii, $registro->tiempo_espera19)
				->setCellValue('K'.$ii, $registro->entrega_19)
				->setCellValue('L'.$ii, $registro->recibe_19)
				->setCellValue('M'.$ii, $registro->firmado_19)
				->setCellValue('N'.$ii, $registro->no_firmado19)

				->setCellValue('B'.$jj, $registro->folio_af)
				->setCellValue('E'.$jj, $registro->cant20)
				->setCellValue('F'.$jj, $registro->unid20)
				->setCellValue('G'.$jj, $registro->desc20)
				->setCellValue('H'.$jj, $registro->uso20)
				->setCellValue('I'.$jj, $registro->surtido20)
				->setCellValue('J'.$jj, $registro->tiempo_espera20)
				->setCellValue('K'.$jj, $registro->entrega_20)
				->setCellValue('L'.$jj, $registro->recibe_20)
				->setCellValue('M'.$jj, $registro->firmado_20)
				->setCellValue('N'.$jj, $registro->no_firmado20)

				->setCellValue('B'.$kk, $registro->folio_af)
				->setCellValue('E'.$kk, $registro->cant21)
				->setCellValue('F'.$kk, $registro->unid21)
				->setCellValue('G'.$kk, $registro->desc21)
				->setCellValue('H'.$kk, $registro->uso21)
				->setCellValue('I'.$kk, $registro->surtido21)
				->setCellValue('J'.$kk, $registro->tiempo_espera21)
				->setCellValue('K'.$kk, $registro->entrega_21)
				->setCellValue('L'.$kk, $registro->recibe_21)
				->setCellValue('M'.$kk, $registro->firmado_21)
				->setCellValue('N'.$kk, $registro->no_firmado21)

				->setCellValue('B'.$ll, $registro->folio_af)
				->setCellValue('E'.$ll, $registro->cant22)
				->setCellValue('F'.$ll, $registro->unid22)
				->setCellValue('G'.$ll, $registro->desc22)
				->setCellValue('H'.$ll, $registro->uso22)
				->setCellValue('I'.$ll, $registro->surtido22)
				->setCellValue('J'.$ll, $registro->tiempo_espera22)
				->setCellValue('K'.$ll, $registro->entrega_22)
				->setCellValue('L'.$ll, $registro->recibe_22)
				->setCellValue('M'.$ll, $registro->firmado_22)
				->setCellValue('N'.$ll, $registro->no_firmado22)

				->setCellValue('B'.$mm, $registro->folio_af)
				->setCellValue('E'.$mm, $registro->cant23)
				->setCellValue('F'.$mm, $registro->unid23)
				->setCellValue('G'.$mm, $registro->desc23)
				->setCellValue('H'.$mm, $registro->uso23)
				->setCellValue('I'.$mm, $registro->surtido23)
				->setCellValue('J'.$mm, $registro->tiempo_espera23)
				->setCellValue('K'.$mm, $registro->entrega_23)
				->setCellValue('L'.$mm, $registro->recibe_23)
				->setCellValue('M'.$mm, $registro->firmado_23)
				->setCellValue('N'.$mm, $registro->no_firmado23)

				->setCellValue('B'.$nn, $registro->folio_af)
				->setCellValue('E'.$nn, $registro->cant24)
				->setCellValue('F'.$nn, $registro->unid24)
				->setCellValue('G'.$nn, $registro->desc24)
				->setCellValue('H'.$nn, $registro->uso24)
				->setCellValue('I'.$nn, $registro->surtido24)
				->setCellValue('J'.$nn, $registro->tiempo_espera24)
				->setCellValue('K'.$nn, $registro->entrega_24)
				->setCellValue('L'.$nn, $registro->recibe_24)
				->setCellValue('M'.$nn, $registro->firmado_24)
				->setCellValue('N'.$nn, $registro->no_firmado24)

				->setCellValue('B'.$oo, $registro->folio_af)
				->setCellValue('E'.$oo, $registro->cant25)
				->setCellValue('F'.$oo, $registro->unid25)
				->setCellValue('G'.$oo, $registro->desc25)
				->setCellValue('H'.$oo, $registro->uso25)
				->setCellValue('I'.$oo, $registro->surtido25)
				->setCellValue('J'.$oo, $registro->tiempo_espera25)
				->setCellValue('K'.$oo, $registro->entrega_25)
				->setCellValue('L'.$oo, $registro->recibe_25)
				->setCellValue('M'.$oo, $registro->firmado_25)
				->setCellValue('N'.$oo, $registro->no_firmado25)

				->setCellValue('B'.$pp, $registro->folio_af)
				->setCellValue('E'.$pp, $registro->cant26)
				->setCellValue('F'.$pp, $registro->unid26)
				->setCellValue('G'.$pp, $registro->desc26)
				->setCellValue('H'.$pp, $registro->uso26)
				->setCellValue('I'.$pp, $registro->surtido26)
				->setCellValue('J'.$pp, $registro->tiempo_espera26)
				->setCellValue('K'.$pp, $registro->entrega_26)
				->setCellValue('L'.$pp, $registro->recibe_26)
				->setCellValue('M'.$pp, $registro->firmado_26)
				->setCellValue('N'.$pp, $registro->no_firmado26)

				->setCellValue('B'.$qq, $registro->folio_af)
				->setCellValue('E'.$qq, $registro->cant27)
				->setCellValue('F'.$qq, $registro->unid27)
				->setCellValue('G'.$qq, $registro->desc27)
				->setCellValue('H'.$qq, $registro->uso27)
				->setCellValue('I'.$qq, $registro->surtido27)
				->setCellValue('J'.$qq, $registro->tiempo_espera27)
				->setCellValue('K'.$qq, $registro->entrega_27)
				->setCellValue('L'.$qq, $registro->recibe_27)
				->setCellValue('M'.$qq, $registro->firmado_27)
				->setCellValue('N'.$qq, $registro->no_firmado27)

				->setCellValue('B'.$rr, $registro->folio_af)
				->setCellValue('E'.$rr, $registro->cant28)
				->setCellValue('F'.$rr, $registro->unid28)
				->setCellValue('G'.$rr, $registro->desc28)
				->setCellValue('H'.$rr, $registro->uso28)
				->setCellValue('I'.$rr, $registro->surtido28)
				->setCellValue('J'.$rr, $registro->tiempo_espera28)
				->setCellValue('K'.$rr, $registro->entrega_28)
				->setCellValue('L'.$rr, $registro->recibe_28)
				->setCellValue('M'.$rr, $registro->firmado_28)
				->setCellValue('N'.$rr, $registro->no_firmado28)

				->setCellValue('B'.$ss, $registro->folio_af)
				->setCellValue('E'.$ss, $registro->cant29)
				->setCellValue('F'.$ss, $registro->unid29)
				->setCellValue('G'.$ss, $registro->desc29)
				->setCellValue('H'.$ss, $registro->uso29)
				->setCellValue('I'.$ss, $registro->surtido29)
				->setCellValue('J'.$ss, $registro->tiempo_espera29)
				->setCellValue('K'.$ss, $registro->entrega_29)
				->setCellValue('L'.$ss, $registro->recibe_29)
				->setCellValue('M'.$ss, $registro->firmado_29)
				->setCellValue('N'.$ss, $registro->no_firmado29)

				->setCellValue('B'.$tt, $registro->folio_af)
				->setCellValue('E'.$tt, $registro->cant30)
				->setCellValue('F'.$tt, $registro->unid30)
				->setCellValue('G'.$tt, $registro->desc30)
				->setCellValue('H'.$tt, $registro->uso30)
				->setCellValue('I'.$tt, $registro->surtido30)
				->setCellValue('J'.$tt, $registro->tiempo_espera30)
				->setCellValue('K'.$tt, $registro->entrega_30)
				->setCellValue('L'.$tt, $registro->recibe_30)
				->setCellValue('M'.$tt, $registro->firmado_30)
				->setCellValue('N'.$tt, $registro->no_firmado30)

				->setCellValue('B'.$uu, $registro->folio_af)
				->setCellValue('E'.$uu, $registro->cant31)
				->setCellValue('F'.$uu, $registro->unid31)
				->setCellValue('G'.$uu, $registro->desc31)
				->setCellValue('H'.$uu, $registro->uso31)
				->setCellValue('I'.$uu, $registro->surtido31)
				->setCellValue('J'.$uu, $registro->tiempo_espera31)
				->setCellValue('K'.$uu, $registro->entrega_31)
				->setCellValue('L'.$uu, $registro->recibe_31)
				->setCellValue('M'.$uu, $registro->firmado_31)
				->setCellValue('N'.$uu, $registro->no_firmado31)

				->setCellValue('B'.$vv, $registro->folio_af)
				->setCellValue('E'.$vv, $registro->cant32)
				->setCellValue('F'.$vv, $registro->unid32)
				->setCellValue('G'.$vv, $registro->desc32)
				->setCellValue('H'.$vv, $registro->uso32)
				->setCellValue('I'.$vv, $registro->surtido32)
				->setCellValue('J'.$vv, $registro->tiempo_espera32)
				->setCellValue('K'.$vv, $registro->entrega_32)
				->setCellValue('L'.$vv, $registro->recibe_32)
				->setCellValue('M'.$vv, $registro->firmado_32)
				->setCellValue('N'.$vv, $registro->no_firmado32)

				->setCellValue('B'.$ww, $registro->folio_af)
				->setCellValue('E'.$ww, $registro->cant33)
				->setCellValue('F'.$ww, $registro->unid33)
				->setCellValue('G'.$ww, $registro->desc33)
				->setCellValue('H'.$ww, $registro->uso33)
				->setCellValue('I'.$ww, $registro->surtido33)
				->setCellValue('J'.$ww, $registro->tiempo_espera33)
				->setCellValue('K'.$ww, $registro->entrega_33)
				->setCellValue('L'.$ww, $registro->recibe_33)
				->setCellValue('M'.$ww, $registro->firmado_33)
				->setCellValue('N'.$ww, $registro->no_firmado33)

				->setCellValue('B'.$xx, $registro->folio_af)
				->setCellValue('E'.$xx, $registro->cant34)
				->setCellValue('F'.$xx, $registro->unid34)
				->setCellValue('G'.$xx, $registro->desc34)
				->setCellValue('H'.$xx, $registro->uso34)
				->setCellValue('I'.$xx, $registro->surtido34)
				->setCellValue('J'.$xx, $registro->tiempo_espera34)
				->setCellValue('K'.$xx, $registro->entrega_34)
				->setCellValue('L'.$xx, $registro->recibe_34)
				->setCellValue('M'.$xx, $registro->firmado_34)
				->setCellValue('N'.$xx, $registro->no_firmado34)

				->setCellValue('B'.$yy, $registro->folio_af)
				->setCellValue('E'.$yy, $registro->cant35)
				->setCellValue('F'.$yy, $registro->unid35)
				->setCellValue('G'.$yy, $registro->desc35)
				->setCellValue('H'.$yy, $registro->uso35)
				->setCellValue('I'.$yy, $registro->surtido35)
				->setCellValue('J'.$yy, $registro->tiempo_espera35)
				->setCellValue('K'.$yy, $registro->entrega_35)
				->setCellValue('L'.$yy, $registro->recibe_35)
				->setCellValue('M'.$yy, $registro->firmado_35)
				->setCellValue('N'.$yy, $registro->no_firmado35)

				->setCellValue('B'.$zz, $registro->folio_af)
				->setCellValue('E'.$zz, $registro->cant36)
				->setCellValue('F'.$zz, $registro->unid36)
				->setCellValue('G'.$zz, $registro->desc36)
				->setCellValue('H'.$zz, $registro->uso36)
				->setCellValue('I'.$zz, $registro->surtido36)
				->setCellValue('J'.$zz, $registro->tiempo_espera36)
				->setCellValue('K'.$zz, $registro->entrega_36)
				->setCellValue('L'.$zz, $registro->recibe_36)
				->setCellValue('M'.$zz, $registro->firmado_36)
				->setCellValue('N'.$zz, $registro->no_firmado36)

				->setCellValue('B'.$iii, $registro->folio_af)
				->setCellValue('E'.$iii, $registro->cant37)
				->setCellValue('F'.$iii, $registro->unid37)
				->setCellValue('G'.$iii, $registro->desc37)
				->setCellValue('H'.$iii, $registro->uso37)
				->setCellValue('I'.$iii, $registro->surtido37)
				->setCellValue('J'.$iii, $registro->tiempo_espera37)
				->setCellValue('K'.$iii, $registro->entrega_37)
				->setCellValue('L'.$iii, $registro->recibe_37)
				->setCellValue('M'.$iii, $registro->firmado_37)
				->setCellValue('N'.$iii, $registro->no_firmado37)

				->setCellValue('B'.$jjj, $registro->folio_af)
				->setCellValue('E'.$jjj, $registro->cant38)
				->setCellValue('F'.$jjj, $registro->unid38)
				->setCellValue('G'.$jjj, $registro->desc38)
				->setCellValue('H'.$jjj, $registro->uso38)
				->setCellValue('I'.$jjj, $registro->surtido38)
				->setCellValue('J'.$jjj, $registro->tiempo_espera38)
				->setCellValue('K'.$jjj, $registro->entrega_38)
				->setCellValue('L'.$jjj, $registro->recibe_38)
				->setCellValue('M'.$jjj, $registro->firmado_38)
				->setCellValue('N'.$jjj, $registro->no_firmado38)

				->setCellValue('B'.$kkk, $registro->folio_af)
				->setCellValue('E'.$kkk, $registro->cant39)
				->setCellValue('F'.$kkk, $registro->unid39)
				->setCellValue('G'.$kkk, $registro->desc39)
				->setCellValue('H'.$kkk, $registro->uso39)
				->setCellValue('I'.$kkk, $registro->surtido39)
				->setCellValue('J'.$kkk, $registro->tiempo_espera39)
				->setCellValue('K'.$kkk, $registro->entrega_39)
				->setCellValue('L'.$kkk, $registro->recibe_39)
				->setCellValue('M'.$kkk, $registro->firmado_39)
				->setCellValue('N'.$kkk, $registro->no_firmado39)

				->setCellValue('B'.$lll, $registro->folio_af)
				->setCellValue('E'.$lll, $registro->cant40)
				->setCellValue('F'.$lll, $registro->unid40)
				->setCellValue('G'.$lll, $registro->desc40)
				->setCellValue('H'.$lll, $registro->uso40)
				->setCellValue('I'.$lll, $registro->surtido40)
				->setCellValue('J'.$lll, $registro->tiempo_espera40)
				->setCellValue('K'.$lll, $registro->entrega_40)
				->setCellValue('L'.$lll, $registro->recibe_40)
				->setCellValue('M'.$lll, $registro->firmado_40)
				->setCellValue('N'.$lll, $registro->no_firmado40)

				->setCellValue('B'.$mmm, $registro->folio_af)
				->setCellValue('E'.$mmm, $registro->cant41)
				->setCellValue('F'.$mmm, $registro->unid41)
				->setCellValue('G'.$mmm, $registro->desc41)
				->setCellValue('H'.$mmm, $registro->uso41)
				->setCellValue('I'.$mmm, $registro->surtido41)
				->setCellValue('J'.$mmm, $registro->tiempo_espera41)
				->setCellValue('K'.$mmm, $registro->entrega_41)
				->setCellValue('L'.$mmm, $registro->recibe_41)
				->setCellValue('M'.$mmm, $registro->firmado_41)
				->setCellValue('N'.$mmm, $registro->no_firmado41)

				->setCellValue('B'.$nnn, $registro->folio_af)
				->setCellValue('E'.$nnn, $registro->cant42)
				->setCellValue('F'.$nnn, $registro->unid42)
				->setCellValue('G'.$nnn, $registro->desc42)
				->setCellValue('H'.$nnn, $registro->uso42)
				->setCellValue('I'.$nnn, $registro->surtido42)
				->setCellValue('J'.$nnn, $registro->tiempo_espera42)
				->setCellValue('K'.$nnn, $registro->entrega_42)
				->setCellValue('L'.$nnn, $registro->recibe_42)
				->setCellValue('M'.$nnn, $registro->firmado_42)
				->setCellValue('N'.$nnn, $registro->no_firmado42)

				->setCellValue('B'.$ooo, $registro->folio_af)
				->setCellValue('E'.$ooo, $registro->cant43)
				->setCellValue('F'.$ooo, $registro->unid43)
				->setCellValue('G'.$ooo, $registro->desc43)
				->setCellValue('H'.$ooo, $registro->uso43)
				->setCellValue('I'.$ooo, $registro->surtido43)
				->setCellValue('J'.$ooo, $registro->tiempo_espera43)
				->setCellValue('K'.$ooo, $registro->entrega_43)
				->setCellValue('L'.$ooo, $registro->recibe_43)
				->setCellValue('M'.$ooo, $registro->firmado_43)
				->setCellValue('N'.$ooo, $registro->no_firmado43)

				->setCellValue('B'.$ppp, $registro->folio_af)
				->setCellValue('E'.$ppp, $registro->cant44)
				->setCellValue('F'.$ppp, $registro->unid44)
				->setCellValue('G'.$ppp, $registro->desc44)
				->setCellValue('H'.$ppp, $registro->uso44)
				->setCellValue('I'.$ppp, $registro->surtido44)
				->setCellValue('J'.$ppp, $registro->tiempo_espera44)
				->setCellValue('K'.$ppp, $registro->entrega_44)
				->setCellValue('L'.$ppp, $registro->recibe_44)
				->setCellValue('M'.$ppp, $registro->firmado_44)
				->setCellValue('N'.$ppp, $registro->no_firmado44)

				->setCellValue('B'.$qqq, $registro->folio_af)
				->setCellValue('E'.$qqq, $registro->cant45)
				->setCellValue('F'.$qqq, $registro->unid45)
				->setCellValue('G'.$qqq, $registro->desc45)
				->setCellValue('H'.$qqq, $registro->uso45)
				->setCellValue('I'.$qqq, $registro->surtido45)
				->setCellValue('J'.$qqq, $registro->tiempo_espera45)
				->setCellValue('K'.$qqq, $registro->entrega_45)
				->setCellValue('L'.$qqq, $registro->recibe_45)
				->setCellValue('M'.$qqq, $registro->firmado_45)
				->setCellValue('N'.$qqq, $registro->no_firmado45)

				->setCellValue('B'.$rrr, $registro->folio_af)
				->setCellValue('E'.$rrr, $registro->cant46)
				->setCellValue('F'.$rrr, $registro->unid46)
				->setCellValue('G'.$rrr, $registro->desc46)
				->setCellValue('H'.$rrr, $registro->uso46)
				->setCellValue('I'.$rrr, $registro->surtido46)
				->setCellValue('J'.$rrr, $registro->tiempo_espera46)
				->setCellValue('K'.$rrr, $registro->entrega_46)
				->setCellValue('L'.$rrr, $registro->recibe_46)
				->setCellValue('M'.$rrr, $registro->firmado_46)
				->setCellValue('N'.$rrr, $registro->no_firmado46)

				->setCellValue('B'.$sss, $registro->folio_af)
				->setCellValue('E'.$sss, $registro->cant47)
				->setCellValue('F'.$sss, $registro->unid47)
				->setCellValue('G'.$sss, $registro->desc47)
				->setCellValue('H'.$sss, $registro->uso47)
				->setCellValue('I'.$sss, $registro->surtido47)
				->setCellValue('J'.$sss, $registro->tiempo_espera47)
				->setCellValue('K'.$sss, $registro->entrega_47)
				->setCellValue('L'.$sss, $registro->recibe_47)
				->setCellValue('M'.$sss, $registro->firmado_47)
				->setCellValue('N'.$sss, $registro->no_firmado47)

				->setCellValue('B'.$ttt, $registro->folio_af)
				->setCellValue('E'.$ttt, $registro->cant48)
				->setCellValue('F'.$ttt, $registro->unid48)
				->setCellValue('G'.$ttt, $registro->desc48)
				->setCellValue('H'.$ttt, $registro->uso48)
				->setCellValue('I'.$ttt, $registro->surtido48)
				->setCellValue('J'.$ttt, $registro->tiempo_espera48)
				->setCellValue('K'.$ttt, $registro->entrega_48)
				->setCellValue('L'.$ttt, $registro->recibe_48)
				->setCellValue('M'.$ttt, $registro->firmado_48)
				->setCellValue('N'.$ttt, $registro->no_firmado48)

				->setCellValue('B'.$uuu, $registro->folio_af)
				->setCellValue('E'.$uuu, $registro->cant49)
				->setCellValue('F'.$uuu, $registro->unid49)
				->setCellValue('G'.$uuu, $registro->desc49)
				->setCellValue('H'.$uuu, $registro->uso49)
				->setCellValue('I'.$uuu, $registro->surtido49)
				->setCellValue('J'.$uuu, $registro->tiempo_espera49)
				->setCellValue('K'.$uuu, $registro->entrega_49)
				->setCellValue('L'.$uuu, $registro->recibe_49)
				->setCellValue('M'.$uuu, $registro->firmado_49)
				->setCellValue('N'.$uuu, $registro->no_firmado49)

				->setCellValue('B'.$vvv, $registro->folio_af)
				->setCellValue('E'.$vvv, $registro->cant50)
				->setCellValue('F'.$vvv, $registro->unid50)
				->setCellValue('G'.$vvv, $registro->desc50)
				->setCellValue('H'.$vvv, $registro->uso50)
				->setCellValue('I'.$vvv, $registro->surtido50)
				->setCellValue('J'.$vvv, $registro->tiempo_espera50)
				->setCellValue('K'.$vvv, $registro->entrega_50)
				->setCellValue('L'.$vvv, $registro->recibe_50)
				->setCellValue('M'.$vvv, $registro->firmado_50)
				->setCellValue('N'.$vvv, $registro->no_firmado50);
				
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
				
				$nombre= $registro->area_pagina;
	}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$fecha01="Reporte por Gerencia  ".$nombre.".xlsx";
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
        		alert('Esta gerencia no tiene reporte');
        		javascript:history.back()
         	</script>";
	  }
?>