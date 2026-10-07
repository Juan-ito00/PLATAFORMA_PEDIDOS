<?php
	include("../../../conexion/conexion.php");
   	$conexion=Conectarse();
	mysql_query("SET NAMES 'utf8'");

	$desde=$_GET['desde'];  
	$hasta=$_GET['hasta'];
	
	$sql1="SELECT * FROM oficios_asignacion WHERE fecha BETWEEN '$desde' AND '$hasta'";

    $res=mysql_query($sql1,$conexion);
    if(mysql_num_rows($res)>=1)
    {
    	$sql="SELECT * FROM oficios_asignacion WHERE fecha BETWEEN '$desde' AND '$hasta'";
 	
 	$resultado = mysql_query($sql,$conexion) or die (mysql_error ());
 	$registros = mysql_num_rows ($resultado);
 	if($registros > 0) {
		require_once '../../../Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("reporte_ofac.xlsx");
		$i=4;
        while ($registro = mysql_fetch_object ($resultado)) {
            $objPHPExcel ->getActiveSheet()->mergeCells('V'.($i).':V'.($i+1));
            $objPHPExcel ->setActiveSheetIndex(0)
            //INSERTAR REGISTROS EN PRIMER PEDIDO
                ->setCellValue('A'.$i, $registro->folio)
                ->setCellValue('B'.$i, $registro->folio_compras)
                ->setCellValue('C'.$i, $registro->proveedor)
                ->setCellValue('D'.$i, $registro->precio)
                ->setCellValue('E'.$i, $registro->calidad)
                ->setCellValue('F'.$i, $registro->tiempo_entrega)
                ->setCellValue('G'.$i, $registro->disponibilidad)
                ->setCellValue('H'.$i, $registro->cot_adquiridas);
                
                $i=$i+1;
        }		
	}
	header('Content-Type: application/vdn.ms-excel');
	$fecha01="Reporte OFAC.xlsx";
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