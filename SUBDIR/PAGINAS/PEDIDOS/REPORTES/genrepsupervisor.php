<?php
	include("../../../conexion/conexion.php");
   	$conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");

	$desde=$_GET['desde'];  
	$hasta=$_GET['hasta'];
	$buscar=$_GET['supervisor'];

	$sql1="SELECT * FROM pedidos WHERE supervisor='$buscar'";
    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
	$sql ="SELECT * FROM pedidos WHERE supervisor LIKE '%$buscar%' AND lugar='Compras' AND fecha BETWEEN '$desde' AND '$hasta' ORDER BY folio";
 	
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("reporte_supervisor_su.xlsx");
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
				->setCellValue('B'.$i, $registro->folio_af)
				->setCellValue('C'.$i, $registro->estado)
				->setCellValue('D'.$i, date("d-m-Y",strtotime($registro->fecha_recibido)))
				->setCellValue('E'.$i, $registro->cant1)
				->setCellValue('F'.$i, $registro->unid1)
				->setCellValue('G'.$i, $registro->desc1)
				->setCellValue('H'.$i, $registro->uso1)
				->setCellValue('I'.$i, $registro->surtido1)
				->setCellValue('J'.$i, $registro->numero_requisicion1)
				->setCellValue('K'.$i, $registro->tiempo_espera1)
				->setCellValue('L'.$i, $registro->entrega_1)
				->setCellValue('M'.$i, $registro->recibe_1)
				->setCellValue('N'.$i, $registro->firmado_1)
				->setCellValue('O'.$i, $registro->monto_mxn)
				->setCellValue('P'.$i, $registro->monto_credito)
				->setCellValue('R'.$i, $registro->proyecto)
				->setCellValue('S'.$i, $registro->gerencia)
				->setCellValue('T'.$i, $registro->fecha_surtido)

				->setCellValue('E'.$j, $registro->cant2)
				->setCellValue('F'.$j, $registro->unid2)
				->setCellValue('G'.$j, $registro->desc2)
				->setCellValue('H'.$j, $registro->uso2)
				->setCellValue('I'.$j, $registro->surtido2)
				->setCellValue('J'.$j, $registro->numero_requisicion2)
				->setCellValue('K'.$j, $registro->tiempo_espera2)
				->setCellValue('L'.$j, $registro->entrega_2)
				->setCellValue('M'.$j, $registro->recibe_2)
				->setCellValue('N'.$j, $registro->firmado_2)

				->setCellValue('E'.$k, $registro->cant3)
				->setCellValue('F'.$k, $registro->unid3)
				->setCellValue('G'.$k, $registro->desc3)
				->setCellValue('H'.$k, $registro->uso3)
				->setCellValue('I'.$k, $registro->surtido3)
				->setCellValue('J'.$k, $registro->numero_requisicion3)
				->setCellValue('K'.$k, $registro->tiempo_espera3)
				->setCellValue('L'.$k, $registro->entrega_3)
				->setCellValue('M'.$k, $registro->recibe_3)
				->setCellValue('N'.$k, $registro->firmado_3)

				->setCellValue('E'.$l, $registro->cant4)
				->setCellValue('F'.$l, $registro->unid4)
				->setCellValue('G'.$l, $registro->desc4)
				->setCellValue('H'.$l, $registro->uso4)
				->setCellValue('I'.$l, $registro->surtido4)
				->setCellValue('J'.$l, $registro->numero_requisicion4)
				->setCellValue('K'.$l, $registro->tiempo_espera4)
				->setCellValue('L'.$l, $registro->entrega_4)
				->setCellValue('M'.$l, $registro->recibe_4)
				->setCellValue('N'.$l, $registro->firmado_4)

				->setCellValue('E'.$m, $registro->cant5)
				->setCellValue('F'.$m, $registro->unid5)
				->setCellValue('G'.$m, $registro->desc5)
				->setCellValue('H'.$m, $registro->uso5)
				->setCellValue('I'.$m, $registro->surtido5)
				->setCellValue('J'.$m, $registro->numero_requisicion5)
				->setCellValue('K'.$m, $registro->tiempo_espera5)
				->setCellValue('L'.$m, $registro->entrega_5)
				->setCellValue('M'.$m, $registro->recibe_5)
				->setCellValue('N'.$m, $registro->firmado_5)

				->setCellValue('E'.$n, $registro->cant6)
				->setCellValue('F'.$n, $registro->unid6)
				->setCellValue('G'.$n, $registro->desc6)
				->setCellValue('H'.$n, $registro->uso6)
				->setCellValue('I'.$n, $registro->surtido6)
				->setCellValue('J'.$n, $registro->numero_requisicion6)
				->setCellValue('K'.$n, $registro->tiempo_espera6)
				->setCellValue('L'.$n, $registro->entrega_6)
				->setCellValue('M'.$n, $registro->recibe_6)
				->setCellValue('N'.$n, $registro->firmado_6)

				->setCellValue('E'.$o, $registro->cant7)
				->setCellValue('F'.$o, $registro->unid7)
				->setCellValue('G'.$o, $registro->desc7)
				->setCellValue('H'.$o, $registro->uso7)
				->setCellValue('I'.$o, $registro->surtido7)
				->setCellValue('J'.$o, $registro->numero_requisicion7)
				->setCellValue('K'.$o, $registro->tiempo_espera7)
				->setCellValue('L'.$o, $registro->entrega_7)
				->setCellValue('M'.$o, $registro->recibe_7)
				->setCellValue('N'.$o, $registro->firmado_7)

				->setCellValue('E'.$p, $registro->cant8)
				->setCellValue('F'.$p, $registro->unid8)
				->setCellValue('G'.$p, $registro->desc8)
				->setCellValue('H'.$p, $registro->uso8)
				->setCellValue('I'.$p, $registro->surtido8)
				->setCellValue('J'.$p, $registro->numero_requisicion8)
				->setCellValue('K'.$p, $registro->tiempo_espera8)
				->setCellValue('L'.$p, $registro->entrega_8)
				->setCellValue('M'.$p, $registro->recibe_8)
				->setCellValue('N'.$p, $registro->firmado_8)

				->setCellValue('E'.$q, $registro->cant9)
				->setCellValue('F'.$q, $registro->unid9)
				->setCellValue('G'.$q, $registro->desc9)
				->setCellValue('H'.$q, $registro->uso9)
				->setCellValue('I'.$q, $registro->surtido9)
				->setCellValue('J'.$q, $registro->numero_requisicion9)
				->setCellValue('K'.$q, $registro->tiempo_espera9)
				->setCellValue('L'.$q, $registro->entrega_9)
				->setCellValue('M'.$q, $registro->recibe_9)
				->setCellValue('N'.$q, $registro->firmado_9)

				->setCellValue('E'.$r, $registro->cant10)
				->setCellValue('F'.$r, $registro->unid10)
				->setCellValue('G'.$r, $registro->desc10)
				->setCellValue('H'.$r, $registro->uso10)
				->setCellValue('I'.$r, $registro->surtido10)
				->setCellValue('J'.$r, $registro->numero_requisicion10)
				->setCellValue('K'.$r, $registro->tiempo_espera10)
				->setCellValue('L'.$r, $registro->entrega_10)
				->setCellValue('M'.$r, $registro->recibe_10)
				->setCellValue('N'.$r, $registro->firmado_10)

				->setCellValue('E'.$s, $registro->cant11)
				->setCellValue('F'.$s, $registro->unid11)
				->setCellValue('G'.$s, $registro->desc11)
				->setCellValue('H'.$s, $registro->uso11)
				->setCellValue('I'.$s, $registro->surtido11)
				->setCellValue('J'.$s, $registro->numero_requisicion11)
				->setCellValue('K'.$s, $registro->tiempo_espera11)
				->setCellValue('L'.$s, $registro->entrega_11)
				->setCellValue('M'.$s, $registro->recibe_11)
				->setCellValue('N'.$s, $registro->firmado_11)

				->setCellValue('E'.$t, $registro->cant12)
				->setCellValue('F'.$t, $registro->unid12)
				->setCellValue('G'.$t, $registro->desc12)
				->setCellValue('H'.$t, $registro->uso12)
				->setCellValue('I'.$t, $registro->surtido12)
				->setCellValue('J'.$t, $registro->numero_requisicion12)
				->setCellValue('K'.$t, $registro->tiempo_espera12)
				->setCellValue('L'.$t, $registro->entrega_12)
				->setCellValue('M'.$t, $registro->recibe_12)
				->setCellValue('N'.$t, $registro->firmado_12)

				->setCellValue('E'.$u, $registro->cant13)
				->setCellValue('F'.$u, $registro->unid13)
				->setCellValue('G'.$u, $registro->desc13)
				->setCellValue('H'.$u, $registro->uso13)
				->setCellValue('I'.$u, $registro->surtido13)
				->setCellValue('J'.$u, $registro->numero_requisicion13)
				->setCellValue('K'.$u, $registro->tiempo_espera13)
				->setCellValue('L'.$u, $registro->entrega_13)
				->setCellValue('M'.$u, $registro->recibe_13)
				->setCellValue('N'.$u, $registro->firmado_13)

				->setCellValue('E'.$v, $registro->cant14)
				->setCellValue('F'.$v, $registro->unid14)
				->setCellValue('G'.$v, $registro->desc14)
				->setCellValue('H'.$v, $registro->uso14)
				->setCellValue('I'.$v, $registro->surtido14)
				->setCellValue('J'.$v, $registro->numero_requisicion14)
				->setCellValue('K'.$v, $registro->tiempo_espera14)
				->setCellValue('L'.$v, $registro->entrega_14)
				->setCellValue('M'.$v, $registro->recibe_14)
				->setCellValue('N'.$v, $registro->firmado_14)

				->setCellValue('E'.$w, $registro->cant15)
				->setCellValue('F'.$w, $registro->unid15)
				->setCellValue('G'.$w, $registro->desc15)
				->setCellValue('H'.$w, $registro->uso15)
				->setCellValue('I'.$w, $registro->surtido15)
				->setCellValue('J'.$w, $registro->numero_requisicion15)
				->setCellValue('K'.$w, $registro->tiempo_espera15)
				->setCellValue('L'.$w, $registro->entrega_15)
				->setCellValue('M'.$w, $registro->recibe_15)
				->setCellValue('N'.$w, $registro->firmado_15)

				->setCellValue('E'.$x, $registro->cant16)
				->setCellValue('F'.$x, $registro->unid16)
				->setCellValue('G'.$x, $registro->desc16)
				->setCellValue('H'.$x, $registro->uso16)
				->setCellValue('I'.$x, $registro->surtido16)
				->setCellValue('J'.$x, $registro->numero_requisicion16)
				->setCellValue('K'.$x, $registro->tiempo_espera16)
				->setCellValue('L'.$x, $registro->entrega_16)
				->setCellValue('M'.$x, $registro->recibe_16)
				->setCellValue('N'.$x, $registro->firmado_16)

				->setCellValue('E'.$y, $registro->cant17)
				->setCellValue('F'.$y, $registro->unid17)
				->setCellValue('G'.$y, $registro->desc17)
				->setCellValue('H'.$y, $registro->uso17)
				->setCellValue('I'.$y, $registro->surtido17)
				->setCellValue('J'.$y, $registro->numero_requisicion17)
				->setCellValue('K'.$y, $registro->tiempo_espera17)
				->setCellValue('L'.$y, $registro->entrega_17)
				->setCellValue('M'.$y, $registro->recibe_17)
				->setCellValue('N'.$y, $registro->firmado_17)

				->setCellValue('E'.$z, $registro->cant18)
				->setCellValue('F'.$z, $registro->unid18)
				->setCellValue('G'.$z, $registro->desc18)
				->setCellValue('H'.$z, $registro->uso18)
				->setCellValue('I'.$z, $registro->surtido18)
				->setCellValue('J'.$z, $registro->numero_requisicion18)
				->setCellValue('K'.$z, $registro->tiempo_espera18)
				->setCellValue('L'.$z, $registro->entrega_18)
				->setCellValue('M'.$z, $registro->recibe_18)
				->setCellValue('N'.$z, $registro->firmado_18)

				->setCellValue('E'.$ii, $registro->cant19)
				->setCellValue('F'.$ii, $registro->unid19)
				->setCellValue('G'.$ii, $registro->desc19)
				->setCellValue('H'.$ii, $registro->uso19)
				->setCellValue('I'.$ii, $registro->surtido19)
				->setCellValue('J'.$ii, $registro->numero_requisicion19)
				->setCellValue('K'.$ii, $registro->tiempo_espera19)
				->setCellValue('L'.$ii, $registro->entrega_19)
				->setCellValue('M'.$ii, $registro->recibe_19)
				->setCellValue('N'.$ii, $registro->firmado_19)

				->setCellValue('E'.$jj, $registro->cant20)
				->setCellValue('F'.$jj, $registro->unid20)
				->setCellValue('G'.$jj, $registro->desc20)
				->setCellValue('H'.$jj, $registro->uso20)
				->setCellValue('I'.$jj, $registro->surtido20)
				->setCellValue('J'.$jj, $registro->numero_requisicion20)
				->setCellValue('K'.$jj, $registro->tiempo_espera20)
				->setCellValue('L'.$jj, $registro->entrega_20)
				->setCellValue('M'.$jj, $registro->recibe_20)
				->setCellValue('N'.$jj, $registro->firmado_20)

				->setCellValue('E'.$kk, $registro->cant21)
				->setCellValue('F'.$kk, $registro->unid21)
				->setCellValue('G'.$kk, $registro->desc21)
				->setCellValue('H'.$kk, $registro->uso21)
				->setCellValue('I'.$kk, $registro->surtido21)
				->setCellValue('J'.$kk, $registro->numero_requisicion21)
				->setCellValue('K'.$kk, $registro->tiempo_espera21)
				->setCellValue('L'.$kk, $registro->entrega_21)
				->setCellValue('M'.$kk, $registro->recibe_21)
				->setCellValue('N'.$kk, $registro->firmado_21)

				->setCellValue('E'.$ll, $registro->cant22)
				->setCellValue('F'.$ll, $registro->unid22)
				->setCellValue('G'.$ll, $registro->desc22)
				->setCellValue('H'.$ll, $registro->uso22)
				->setCellValue('I'.$ll, $registro->surtido22)
				->setCellValue('J'.$ll, $registro->numero_requisicion22)
				->setCellValue('K'.$ll, $registro->tiempo_espera22)
				->setCellValue('L'.$ll, $registro->entrega_22)
				->setCellValue('M'.$ll, $registro->recibe_22)
				->setCellValue('N'.$ll, $registro->firmado_22)

				->setCellValue('E'.$mm, $registro->cant23)
				->setCellValue('F'.$mm, $registro->unid23)
				->setCellValue('G'.$mm, $registro->desc23)
				->setCellValue('H'.$mm, $registro->uso23)
				->setCellValue('I'.$mm, $registro->surtido23)
				->setCellValue('J'.$mm, $registro->numero_requisicion23)
				->setCellValue('K'.$mm, $registro->tiempo_espera23)
				->setCellValue('L'.$mm, $registro->entrega_23)
				->setCellValue('M'.$mm, $registro->recibe_23)
				->setCellValue('N'.$mm, $registro->firmado_23)

				->setCellValue('E'.$nn, $registro->cant24)
				->setCellValue('F'.$nn, $registro->unid24)
				->setCellValue('G'.$nn, $registro->desc24)
				->setCellValue('H'.$nn, $registro->uso24)
				->setCellValue('I'.$nn, $registro->surtido24)
				->setCellValue('J'.$nn, $registro->numero_requisicion24)
				->setCellValue('K'.$nn, $registro->tiempo_espera24)
				->setCellValue('L'.$nn, $registro->entrega_24)
				->setCellValue('M'.$nn, $registro->recibe_24)
				->setCellValue('N'.$nn, $registro->firmado_24)

				->setCellValue('E'.$oo, $registro->cant25)
				->setCellValue('F'.$oo, $registro->unid25)
				->setCellValue('G'.$oo, $registro->desc25)
				->setCellValue('H'.$oo, $registro->uso25)
				->setCellValue('I'.$oo, $registro->surtido25)
				->setCellValue('J'.$oo, $registro->numero_requisicion25)
				->setCellValue('K'.$oo, $registro->tiempo_espera25)
				->setCellValue('L'.$oo, $registro->entrega_25)
				->setCellValue('M'.$oo, $registro->recibe_25)
				->setCellValue('N'.$oo, $registro->firmado_25)

				->setCellValue('E'.$pp, $registro->cant26)
				->setCellValue('F'.$pp, $registro->unid26)
				->setCellValue('G'.$pp, $registro->desc26)
				->setCellValue('H'.$pp, $registro->uso26)
				->setCellValue('I'.$pp, $registro->surtido26)
				->setCellValue('J'.$pp, $registro->numero_requisicion26)
				->setCellValue('K'.$pp, $registro->tiempo_espera26)
				->setCellValue('L'.$pp, $registro->entrega_26)
				->setCellValue('M'.$pp, $registro->recibe_26)
				->setCellValue('N'.$pp, $registro->firmado_26)

				->setCellValue('E'.$qq, $registro->cant27)
				->setCellValue('F'.$qq, $registro->unid27)
				->setCellValue('G'.$qq, $registro->desc27)
				->setCellValue('H'.$qq, $registro->uso27)
				->setCellValue('I'.$qq, $registro->surtido27)
				->setCellValue('J'.$qq, $registro->numero_requisicion27)
				->setCellValue('K'.$qq, $registro->tiempo_espera27)
				->setCellValue('L'.$qq, $registro->entrega_27)
				->setCellValue('M'.$qq, $registro->recibe_27)
				->setCellValue('N'.$qq, $registro->firmado_27)

				->setCellValue('E'.$rr, $registro->cant28)
				->setCellValue('F'.$rr, $registro->unid28)
				->setCellValue('G'.$rr, $registro->desc28)
				->setCellValue('H'.$rr, $registro->uso28)
				->setCellValue('I'.$rr, $registro->surtido28)
				->setCellValue('J'.$rr, $registro->numero_requisicion28)
				->setCellValue('K'.$rr, $registro->tiempo_espera28)
				->setCellValue('L'.$rr, $registro->entrega_28)
				->setCellValue('M'.$rr, $registro->recibe_28)
				->setCellValue('N'.$rr, $registro->firmado_28)

				->setCellValue('E'.$ss, $registro->cant29)
				->setCellValue('F'.$ss, $registro->unid29)
				->setCellValue('G'.$ss, $registro->desc29)
				->setCellValue('H'.$ss, $registro->uso29)
				->setCellValue('I'.$ss, $registro->surtido29)
				->setCellValue('J'.$ss, $registro->numero_requisicion29)
				->setCellValue('K'.$ss, $registro->tiempo_espera29)
				->setCellValue('L'.$ss, $registro->entrega_29)
				->setCellValue('M'.$ss, $registro->recibe_29)
				->setCellValue('N'.$ss, $registro->firmado_29)

				->setCellValue('E'.$tt, $registro->cant30)
				->setCellValue('F'.$tt, $registro->unid30)
				->setCellValue('G'.$tt, $registro->desc30)
				->setCellValue('H'.$tt, $registro->uso30)
				->setCellValue('I'.$tt, $registro->surtido30)
				->setCellValue('J'.$tt, $registro->numero_requisicion30)
				->setCellValue('K'.$tt, $registro->tiempo_espera30)
				->setCellValue('L'.$tt, $registro->entrega_30)
				->setCellValue('M'.$tt, $registro->recibe_30)
				->setCellValue('N'.$tt, $registro->firmado_30)

				->setCellValue('E'.$uu, $registro->cant31)
				->setCellValue('F'.$uu, $registro->unid31)
				->setCellValue('G'.$uu, $registro->desc31)
				->setCellValue('H'.$uu, $registro->uso31)
				->setCellValue('I'.$uu, $registro->surtido31)
				->setCellValue('J'.$uu, $registro->numero_requisicion31)
				->setCellValue('K'.$uu, $registro->tiempo_espera31)
				->setCellValue('L'.$uu, $registro->entrega_31)
				->setCellValue('M'.$uu, $registro->recibe_31)
				->setCellValue('N'.$uu, $registro->firmado_31)

				->setCellValue('E'.$vv, $registro->cant32)
				->setCellValue('F'.$vv, $registro->unid32)
				->setCellValue('G'.$vv, $registro->desc32)
				->setCellValue('H'.$vv, $registro->uso32)
				->setCellValue('I'.$vv, $registro->surtido32)
				->setCellValue('J'.$vv, $registro->numero_requisicion32)
				->setCellValue('K'.$vv, $registro->tiempo_espera32)
				->setCellValue('L'.$vv, $registro->entrega_32)
				->setCellValue('M'.$vv, $registro->recibe_32)
				->setCellValue('N'.$vv, $registro->firmado_32)

				->setCellValue('E'.$ww, $registro->cant33)
				->setCellValue('F'.$ww, $registro->unid33)
				->setCellValue('G'.$ww, $registro->desc33)
				->setCellValue('H'.$ww, $registro->uso33)
				->setCellValue('I'.$ww, $registro->surtido33)
				->setCellValue('J'.$ww, $registro->numero_requisicion33)
				->setCellValue('K'.$ww, $registro->tiempo_espera33)
				->setCellValue('L'.$ww, $registro->entrega_33)
				->setCellValue('M'.$ww, $registro->recibe_33)
				->setCellValue('N'.$ww, $registro->firmado_33)

				->setCellValue('E'.$xx, $registro->cant34)
				->setCellValue('F'.$xx, $registro->unid34)
				->setCellValue('G'.$xx, $registro->desc34)
				->setCellValue('H'.$xx, $registro->uso34)
				->setCellValue('I'.$xx, $registro->surtido34)
				->setCellValue('J'.$xx, $registro->numero_requisicion34)
				->setCellValue('K'.$xx, $registro->tiempo_espera34)
				->setCellValue('L'.$xx, $registro->entrega_34)
				->setCellValue('M'.$xx, $registro->recibe_34)
				->setCellValue('N'.$xx, $registro->firmado_34)

				->setCellValue('E'.$yy, $registro->cant35)
				->setCellValue('F'.$yy, $registro->unid35)
				->setCellValue('G'.$yy, $registro->desc35)
				->setCellValue('H'.$yy, $registro->uso35)
				->setCellValue('I'.$yy, $registro->surtido35)
				->setCellValue('J'.$yy, $registro->numero_requisicion35)
				->setCellValue('K'.$yy, $registro->tiempo_espera35)
				->setCellValue('L'.$yy, $registro->entrega_35)
				->setCellValue('M'.$yy, $registro->recibe_35)
				->setCellValue('N'.$yy, $registro->firmado_35)

				->setCellValue('E'.$zz, $registro->cant36)
				->setCellValue('F'.$zz, $registro->unid36)
				->setCellValue('G'.$zz, $registro->desc36)
				->setCellValue('H'.$zz, $registro->uso36)
				->setCellValue('I'.$zz, $registro->surtido36)
				->setCellValue('J'.$zz, $registro->numero_requisicion36)
				->setCellValue('K'.$zz, $registro->tiempo_espera36)
				->setCellValue('L'.$zz, $registro->entrega_36)
				->setCellValue('M'.$zz, $registro->recibe_36)
				->setCellValue('N'.$zz, $registro->firmado_36)

				->setCellValue('E'.$iii, $registro->cant37)
				->setCellValue('F'.$iii, $registro->unid37)
				->setCellValue('G'.$iii, $registro->desc37)
				->setCellValue('H'.$iii, $registro->uso37)
				->setCellValue('I'.$iii, $registro->surtido37)
				->setCellValue('J'.$iii, $registro->numero_requisicion37)
				->setCellValue('K'.$iii, $registro->tiempo_espera37)
				->setCellValue('L'.$iii, $registro->entrega_37)
				->setCellValue('M'.$iii, $registro->recibe_37)
				->setCellValue('N'.$iii, $registro->firmado_37)

				->setCellValue('E'.$jjj, $registro->cant38)
				->setCellValue('F'.$jjj, $registro->unid38)
				->setCellValue('G'.$jjj, $registro->desc38)
				->setCellValue('H'.$jjj, $registro->uso38)
				->setCellValue('I'.$jjj, $registro->surtido38)
				->setCellValue('J'.$jjj, $registro->numero_requisicion38)
				->setCellValue('K'.$jjj, $registro->tiempo_espera38)
				->setCellValue('L'.$jjj, $registro->entrega_38)
				->setCellValue('M'.$jjj, $registro->recibe_38)
				->setCellValue('N'.$jjj, $registro->firmado_38)

				->setCellValue('E'.$kkk, $registro->cant39)
				->setCellValue('F'.$kkk, $registro->unid39)
				->setCellValue('G'.$kkk, $registro->desc39)
				->setCellValue('H'.$kkk, $registro->uso39)
				->setCellValue('I'.$kkk, $registro->surtido39)
				->setCellValue('J'.$kkk, $registro->numero_requisicion39)
				->setCellValue('K'.$kkk, $registro->tiempo_espera39)
				->setCellValue('L'.$kkk, $registro->entrega_39)
				->setCellValue('M'.$kkk, $registro->recibe_39)
				->setCellValue('N'.$kkk, $registro->firmado_39)

				->setCellValue('E'.$lll, $registro->cant40)
				->setCellValue('F'.$lll, $registro->unid40)
				->setCellValue('G'.$lll, $registro->desc40)
				->setCellValue('H'.$lll, $registro->uso40)
				->setCellValue('I'.$lll, $registro->surtido40)
				->setCellValue('J'.$lll, $registro->numero_requisicion40)
				->setCellValue('K'.$lll, $registro->tiempo_espera40)
				->setCellValue('L'.$lll, $registro->entrega_40)
				->setCellValue('M'.$lll, $registro->recibe_40)
				->setCellValue('N'.$lll, $registro->firmado_40)

				->setCellValue('E'.$mmm, $registro->cant41)
				->setCellValue('F'.$mmm, $registro->unid41)
				->setCellValue('G'.$mmm, $registro->desc41)
				->setCellValue('H'.$mmm, $registro->uso41)
				->setCellValue('I'.$mmm, $registro->surtido41)
				->setCellValue('J'.$mmm, $registro->numero_requisicion41)
				->setCellValue('K'.$mmm, $registro->tiempo_espera41)
				->setCellValue('L'.$mmm, $registro->entrega_41)
				->setCellValue('M'.$mmm, $registro->recibe_41)
				->setCellValue('N'.$mmm, $registro->firmado_41)

				->setCellValue('E'.$nnn, $registro->cant42)
				->setCellValue('F'.$nnn, $registro->unid42)
				->setCellValue('G'.$nnn, $registro->desc42)
				->setCellValue('H'.$nnn, $registro->uso42)
				->setCellValue('I'.$nnn, $registro->surtido42)
				->setCellValue('J'.$nnn, $registro->numero_requisicion42)
				->setCellValue('K'.$nnn, $registro->tiempo_espera42)
				->setCellValue('L'.$nnn, $registro->entrega_42)
				->setCellValue('M'.$nnn, $registro->recibe_42)
				->setCellValue('N'.$nnn, $registro->firmado_42)

				->setCellValue('E'.$ooo, $registro->cant43)
				->setCellValue('F'.$ooo, $registro->unid43)
				->setCellValue('G'.$ooo, $registro->desc43)
				->setCellValue('H'.$ooo, $registro->uso43)
				->setCellValue('I'.$ooo, $registro->surtido43)
				->setCellValue('J'.$ooo, $registro->numero_requisicion43)
				->setCellValue('K'.$ooo, $registro->tiempo_espera43)
				->setCellValue('L'.$ooo, $registro->entrega_43)
				->setCellValue('M'.$ooo, $registro->recibe_43)
				->setCellValue('N'.$ooo, $registro->firmado_43)

				->setCellValue('E'.$ppp, $registro->cant44)
				->setCellValue('F'.$ppp, $registro->unid44)
				->setCellValue('G'.$ppp, $registro->desc44)
				->setCellValue('H'.$ppp, $registro->uso44)
				->setCellValue('I'.$ppp, $registro->surtido44)
				->setCellValue('J'.$ppp, $registro->numero_requisicion44)
				->setCellValue('K'.$ppp, $registro->tiempo_espera44)
				->setCellValue('L'.$ppp, $registro->entrega_44)
				->setCellValue('M'.$ppp, $registro->recibe_44)
				->setCellValue('N'.$ppp, $registro->firmado_44)

				->setCellValue('E'.$qqq, $registro->cant45)
				->setCellValue('F'.$qqq, $registro->unid45)
				->setCellValue('G'.$qqq, $registro->desc45)
				->setCellValue('H'.$qqq, $registro->uso45)
				->setCellValue('I'.$qqq, $registro->surtido45)
				->setCellValue('J'.$qqq, $registro->numero_requisicion45)
				->setCellValue('K'.$qqq, $registro->tiempo_espera45)
				->setCellValue('L'.$qqq, $registro->entrega_45)
				->setCellValue('M'.$qqq, $registro->recibe_45)
				->setCellValue('N'.$qqq, $registro->firmado_45)

				->setCellValue('E'.$rrr, $registro->cant46)
				->setCellValue('F'.$rrr, $registro->unid46)
				->setCellValue('G'.$rrr, $registro->desc46)
				->setCellValue('H'.$rrr, $registro->uso46)
				->setCellValue('I'.$rrr, $registro->surtido46)
				->setCellValue('J'.$rrr, $registro->numero_requisicion46)
				->setCellValue('K'.$rrr, $registro->tiempo_espera46)
				->setCellValue('L'.$rrr, $registro->entrega_46)
				->setCellValue('M'.$rrr, $registro->recibe_46)
				->setCellValue('N'.$rrr, $registro->firmado_46)

				->setCellValue('E'.$sss, $registro->cant47)
				->setCellValue('F'.$sss, $registro->unid47)
				->setCellValue('G'.$sss, $registro->desc47)
				->setCellValue('H'.$sss, $registro->uso47)
				->setCellValue('I'.$sss, $registro->surtido47)
				->setCellValue('J'.$sss, $registro->numero_requisicion47)
				->setCellValue('K'.$sss, $registro->tiempo_espera47)
				->setCellValue('L'.$sss, $registro->entrega_47)
				->setCellValue('M'.$sss, $registro->recibe_47)
				->setCellValue('N'.$sss, $registro->firmado_47)

				->setCellValue('E'.$ttt, $registro->cant48)
				->setCellValue('F'.$ttt, $registro->unid48)
				->setCellValue('G'.$ttt, $registro->desc48)
				->setCellValue('H'.$ttt, $registro->uso48)
				->setCellValue('I'.$ttt, $registro->surtido48)
				->setCellValue('J'.$ttt, $registro->numero_requisicion48)
				->setCellValue('K'.$ttt, $registro->tiempo_espera48)
				->setCellValue('L'.$ttt, $registro->entrega_48)
				->setCellValue('M'.$ttt, $registro->recibe_48)
				->setCellValue('N'.$ttt, $registro->firmado_48)

				->setCellValue('E'.$uuu, $registro->cant49)
				->setCellValue('F'.$uuu, $registro->unid49)
				->setCellValue('G'.$uuu, $registro->desc49)
				->setCellValue('H'.$uuu, $registro->uso49)
				->setCellValue('I'.$uuu, $registro->surtido49)
				->setCellValue('J'.$uuu, $registro->numero_requisicion49)
				->setCellValue('K'.$uuu, $registro->tiempo_espera49)
				->setCellValue('L'.$uuu, $registro->entrega_49)
				->setCellValue('M'.$uuu, $registro->recibe_49)
				->setCellValue('N'.$uuu, $registro->firmado_49)

				->setCellValue('E'.$vvv, $registro->cant50)
				->setCellValue('F'.$vvv, $registro->unid50)
				->setCellValue('G'.$vvv, $registro->desc50)
				->setCellValue('H'.$vvv, $registro->uso50)
				->setCellValue('I'.$vvv, $registro->surtido50)
				->setCellValue('J'.$vvv, $registro->numero_requisicion50)
				->setCellValue('K'.$vvv, $registro->tiempo_espera50)
				->setCellValue('L'.$vvv, $registro->entrega_50)
				->setCellValue('M'.$vvv, $registro->recibe_50)
				->setCellValue('N'.$vvv, $registro->firmado_50);
				
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
				
				$nombre= $registro->proyecto;
	}		
	}
	header('Content-Type: application/vdn.ms-excel');
	$fecha01="Reporte Supervisor ".$nombre.".xlsx";
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
        		alert('Este supervisor no tiene reporte');
        		javascript:history.back()
         	</script>";
	  }
?>