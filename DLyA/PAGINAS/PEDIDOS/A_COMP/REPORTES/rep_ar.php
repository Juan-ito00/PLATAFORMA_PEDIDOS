<?php
	include("../../../../conexion/conexion.php"); 
  	$conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");

	$desde=$_GET['desde'];  
	$hasta=$_GET['hasta'];

 	$sql ="SELECT * FROM oficios_rutas WHERE fecha_creacion BETWEEN '$desde' AND '$hasta' ORDER BY folio";
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);

 	if($registros > 0) {
		require_once '../../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("reporte_rutas.xlsx");
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

	while ($registro = mysql_fetch_array ($resultado))
    $rows[] = $registro;
    foreach($rows as $registro) { 
        $avc1 = $registro['folio_ac1'];
        if($avc1 != NULL){
            $sqlA ="SELECT * FROM avisos_ordinarios WHERE folio='".$avc1."'";
            $resultadoA = mysql_query($sqlA,$conexion) or die (mysql_error ());

            while ($registroA = mysql_fetch_array ($resultadoA)) {
                $Aprov1 = $registroA['proveedor'];
                $Aproy1 = $registroA['proyecto'];
                $Afoliocom1 = $registroA['folio_compras'];
                $Afolioger1 = $registroA['folio_gerencia'];
            }
        }
        else {
            $Aprov1 = " ";
            $Aproy1 = " ";
            $Afoliocom1 = " ";
            $Afolioger1 = " ";
        }
        //2
        $avc2 = $registro['folio_ac2'];
        if($avc2 != NULL){
            $sqlA2 ="SELECT * FROM avisos_ordinarios WHERE folio='".$avc2."'";
            $resultadoA2 = mysql_query($sqlA2,$conexion) or die (mysql_error ());

            while ($registroA2 = mysql_fetch_array ($resultadoA2)) {
                $Aprov2 = $registroA2['proveedor'];
                $Aproy2 = $registroA2['proyecto'];
                $Afoliocom2 = $registroA2['folio_compras'];
                $Afolioger2 = $registroA2['folio_gerencia'];
            }
        }
        else {
            $Aprov2 = " ";
            $Aproy2 = " ";
            $Afoliocom2 = " ";
            $Afolioger2 = " ";
        }
        //3
        $avc3 = $registro['folio_ac3'];
        if($avc3 != NULL){
            $sqlA3 ="SELECT * FROM avisos_ordinarios WHERE folio='".$avc3."'";
            $resultadoA3 = mysql_query($sqlA3,$conexion) or die (mysql_error ());

            while ($registroA3 = mysql_fetch_array ($resultadoA3)) {
                $Aprov3 = $registroA3['proveedor'];
                $Aproy3 = $registroA3['proyecto'];
                $Afoliocom3 = $registroA3['folio_compras'];
                $Afolioger3 = $registroA3['folio_gerencia'];
            }
        }
        else {
            $Aprov3 = " ";
            $Aproy3 = " ";
            $Afoliocom3 = " ";
            $Afolioger3 = " ";
        }
        //4
        $avc4 = $registro['folio_ac4'];
        if($avc4 != NULL){
            $sqlA4 ="SELECT * FROM avisos_ordinarios WHERE folio='".$avc4."'";
            $resultadoA4 = mysql_query($sqlA4,$conexion) or die (mysql_error ());

            while ($registroA4 = mysql_fetch_array ($resultadoA4)) {
                $Aprov4 = $registroA4['proveedor'];
                $Aproy4 = $registroA4['proyecto'];
                $Afoliocom4 = $registroA4['folio_compras'];
                $Afolioger4 = $registroA4['folio_gerencia'];
            }
        }
        else {
            $Aprov4 = " ";
            $Aproy4 = " ";
            $Afoliocom4 = " ";
            $Afolioger4 = " ";
        }
        //5
        $avc5 = $registro['folio_ac5'];
        if($avc5 != NULL){
            $sqlA5 ="SELECT * FROM avisos_ordinarios WHERE folio='".$avc5."'";
            $resultadoA5 = mysql_query($sqlA5,$conexion) or die (mysql_error ());

            while ($registroA5 = mysql_fetch_array ($resultadoA5)) {
                $Aprov5 = $registroA5['proveedor'];
                $Aproy5 = $registroA5['proyecto'];
                $Afoliocom5 = $registroA5['folio_compras'];
                $Afolioger5 = $registroA5['folio_gerencia'];
            }
        }
        else {
            $Aprov5 = " ";
            $Aproy5 = " ";
            $Afoliocom5 = " ";
            $Afolioger5 = " ";
        }
        //6
        $avc6 = $registro['folio_ac6'];
        if($avc6 != NULL){
            $sqlA6 ="SELECT * FROM avisos_ordinarios WHERE folio='".$avc6."'";
            $resultadoA6 = mysql_query($sqlA6,$conexion) or die (mysql_error ());

            while ($registroA6 = mysql_fetch_array ($resultadoA6)) {
                $Aprov6 = $registroA6['proveedor'];
                $Aproy6 = $registroA6['proyecto'];
                $Afoliocom6 = $registroA6['folio_compras'];
                $Afolioger6 = $registroA6['folio_gerencia'];
            }
        }
        else {
            $Aprov6 = " ";
            $Aproy6 = " ";
            $Afoliocom6 = " ";
            $Afolioger6 = " ";
        }
        //7
        $avc7 = $registro['folio_ac7'];
        if($avc7 != NULL){
            $sqlA7 ="SELECT * FROM avisos_ordinarios WHERE folio='".$avc7."'";
            $resultadoA7 = mysql_query($sqlA7,$conexion) or die (mysql_error ());

            while ($registroA7 = mysql_fetch_array ($resultadoA7)) {
                $Aprov7 = $registroA7['proveedor'];
                $Aproy7 = $registroA7['proyecto'];
                $Afoliocom7 = $registroA7['folio_compras'];
                $Afolioger7 = $registroA7['folio_gerencia'];
            }
        }
        else {
            $Aprov7 = " ";
            $Aproy7 = " ";
            $Afoliocom7 = " ";
            $Afolioger7 = " ";
        }
        //8
        $avc8 = $registro['folio_ac8'];
        if($avc8 != NULL){
            $sqlA8 ="SELECT * FROM avisos_ordinarios WHERE folio='".$avc8."'";
            $resultadoA8 = mysql_query($sqlA8,$conexion) or die (mysql_error ());

            while ($registroA8 = mysql_fetch_array ($resultadoA8)) {
                $Aprov8 = $registroA8['proveedor'];
                $Aproy8 = $registroA8['proyecto'];
                $Afoliocom8 = $registroA8['folio_compras'];
                $Afolioger8 = $registroA8['folio_gerencia'];
            }
        }
        else {
            $Aprov8 = " ";
            $Aproy8 = " ";
            $Afoliocom8 = " ";
            $Afolioger8 = " ";
        }
        //9
        $avc9 = $registro['folio_ac9'];
        if($avc9 != NULL){
            $sqlA9 ="SELECT * FROM avisos_ordinarios WHERE folio='".$avc9."'";
            $resultadoA9 = mysql_query($sqlA9,$conexion) or die (mysql_error ());

            while ($registroA9 = mysql_fetch_array ($resultadoA9)) {
                $Aprov9 = $registroA9['proveedor'];
                $Aproy9 = $registroA9['proyecto'];
                $Afoliocom9 = $registroA9['folio_compras'];
                $Afolioger9 = $registroA9['folio_gerencia'];
            }
        }
        else {
            $Aprov9 = " ";
            $Aproy9 = " ";
            $Afoliocom9 = " ";
            $Afolioger9 = " ";
        }
        //10
        $avc10 = $registro['folio_ac10'];
        if($avc10 != NULL){
            $sqlA10 ="SELECT * FROM avisos_ordinarios WHERE folio='".$avc10."'";
            $resultadoA10 = mysql_query($sqlA10,$conexion) or die (mysql_error ());

            while ($registroA10 = mysql_fetch_array ($resultadoA10)) {
                $Aprov10 = $registroA10['proveedor'];
                $Aproy10 = $registroA10['proyecto'];
                $Afoliocom10 = $registroA10['folio_compras'];
                $Afolioger10 = $registroA10['folio_gerencia'];
            }
        }
        else {
            $Aprov10 = " ";
            $Aproy10 = " ";
            $Afoliocom10 = " ";
            $Afolioger10 = " ";
        }
				$objPHPExcel ->setActiveSheetIndex(0)
			    //INSERTAR REGISTROS EN PRIMER PEDIDO
				->setCellValue('A'.$i, $registro['folio'])
				->setCellValue('B'.$i, $registro['ruta'])
				->setCellValue('C'.$i, $registro['chofer'])
				->setCellValue('D'.$i, date("d-m-Y",strtotime($registro['fecha_creacion'])))

				->setCellValue('E'.$i, $Aprov1)
				->setCellValue('F'.$i, $Aproy1)
				->setCellValue('G'.$i, $Afoliocom1)
				->setCellValue('H'.$i, $Afolioger1)
				->setCellValue('I'.$i, $registro['carta_porte1'])
				->setCellValue('J'.$i, $registro['factura1'])
                ->setCellValue('K'.$i, $registro['no_recoleccion1'])
                ->setCellValue('L'.$i, $registro['observaciones1'])
                
                ->setCellValue('E'.$j, $Aprov2)
				->setCellValue('F'.$j, $Aproy2)
				->setCellValue('G'.$j, $Afoliocom2)
				->setCellValue('H'.$j, $Afolioger2)
				->setCellValue('I'.$j, $registro['carta_porte2'])
				->setCellValue('J'.$j, $registro['factura2'])
                ->setCellValue('K'.$j, $registro['no_recoleccion2'])
                ->setCellValue('L'.$j, $registro['observaciones2'])
                
                ->setCellValue('E'.$k, $Aprov3)
				->setCellValue('F'.$k, $Aproy3)
				->setCellValue('G'.$k, $Afoliocom3)
				->setCellValue('H'.$k, $Afolioger3)
				->setCellValue('I'.$k, $registro['carta_porte3'])
				->setCellValue('J'.$k, $registro['factura3'])
                ->setCellValue('K'.$k, $registro['no_recoleccion3'])
                ->setCellValue('L'.$k, $registro['observaciones3'])
                
                ->setCellValue('E'.$l, $Aprov4)
				->setCellValue('F'.$l, $Aproy4)
				->setCellValue('G'.$l, $Afoliocom4)
				->setCellValue('H'.$l, $Afolioger4)
				->setCellValue('I'.$l, $registro['carta_porte4'])
				->setCellValue('J'.$l, $registro['factura4'])
                ->setCellValue('K'.$l, $registro['no_recoleccion4'])
                ->setCellValue('L'.$l, $registro['observaciones4'])
                
                ->setCellValue('E'.$m, $Aprov5)
				->setCellValue('F'.$m, $Aproy5)
				->setCellValue('G'.$m, $Afoliocom5)
				->setCellValue('H'.$m, $Afolioger5)
				->setCellValue('I'.$m, $registro['carta_porte5'])
				->setCellValue('J'.$m, $registro['factura5'])
                ->setCellValue('K'.$m, $registro['no_recoleccion5'])
                ->setCellValue('L'.$m, $registro['observaciones5'])
                
                ->setCellValue('E'.$n, $Aprov6)
				->setCellValue('F'.$n, $Aproy6)
				->setCellValue('G'.$n, $Afoliocom6)
				->setCellValue('H'.$n, $Afolioger6)
				->setCellValue('I'.$n, $registro['carta_porte6'])
				->setCellValue('J'.$n, $registro['factura6'])
                ->setCellValue('K'.$n, $registro['no_recoleccion6'])
                ->setCellValue('L'.$n, $registro['observaciones6'])
                
                ->setCellValue('E'.$o, $Aprov7)
				->setCellValue('F'.$o, $Aproy7)
				->setCellValue('G'.$o, $Afoliocom7)
				->setCellValue('H'.$o, $Afolioger7)
				->setCellValue('I'.$o, $registro['carta_porte7'])
				->setCellValue('J'.$o, $registro['factura7'])
                ->setCellValue('K'.$o, $registro['no_recoleccion7'])
                ->setCellValue('L'.$o, $registro['observaciones7'])
                
                ->setCellValue('E'.$p, $Aprov8)
				->setCellValue('F'.$p, $Aproy8)
				->setCellValue('G'.$p, $Afoliocom8)
				->setCellValue('H'.$p, $Afolioger8)
				->setCellValue('I'.$p, $registro['carta_porte8'])
				->setCellValue('J'.$p, $registro['factura8'])
                ->setCellValue('K'.$p, $registro['no_recoleccion8'])
                ->setCellValue('L'.$p, $registro['observaciones8'])
                
                ->setCellValue('E'.$q, $Aprov9)
				->setCellValue('F'.$q, $Aproy9)
				->setCellValue('G'.$q, $Afoliocom9)
				->setCellValue('H'.$q, $Afolioger9)
				->setCellValue('I'.$q, $registro['carta_porte9'])
				->setCellValue('J'.$q, $registro['factura9'])
                ->setCellValue('K'.$q, $registro['no_recoleccion9'])
                ->setCellValue('L'.$q, $registro['observaciones9'])
                
                ->setCellValue('E'.$r, $Aprov10)
				->setCellValue('F'.$r, $Aproy10)
				->setCellValue('G'.$r, $Afoliocom10)
				->setCellValue('H'.$r, $Afolioger10)
				->setCellValue('I'.$r, $registro['carta_porte10'])
				->setCellValue('J'.$r, $registro['factura10'])
                ->setCellValue('K'.$r, $registro['no_recoleccion10'])
                ->setCellValue('L'.$r, $registro['observaciones10']);
				
				$i=$i+11;
				$j=$j+11;
				$k=$k+11;
				$l=$l+11;
				$m=$m+11;
				$n=$n+11;
				$o=$o+11;
				$p=$p+11;
				$q=$q+11;
				$r=$r+11;				
	}			
	}
	
	header('Content-Type: application/vdn.ms-excel');
	$fecha01="Reporte_Rutas.xlsx";
	header('Content-Disposition: attachment;filename='.$fecha01.'');
	header('Cache-Control: max-age=0');
	$objPHPExcel->getActiveSheet() ->setTitle('Reporte');
	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
	ob_end_clean();
	$objWriter->save('php://output');
	exit;
	mysql_close();
?>