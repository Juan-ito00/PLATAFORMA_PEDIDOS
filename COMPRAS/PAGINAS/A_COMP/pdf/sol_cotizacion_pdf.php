<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']) && !isset($_SESSION['telefono']))
	{
		header('Location: ../../../index');
		exit();
	}
	include("../../../conexion/conexion.php"); 
	$conexion=Conectarse();
	require '../../../pdf/fpdf.php';

	class PDF extends FPDF
	{
		function Header()
		{	
			$this->Image('../../../img/membrete_blanco.jpg', 0, 0, 215 );
			$this->SetFont('Arial','B',12);
			$this->Ln(20);
			$this->Cell(33);
			$this->Cell(130,10, utf8_decode('SOLICITUD DE COTIZACIÓN'),0,0,'C');
			$this->Ln(15);
		}		
	}
	header("Content-Type: text/html;charset=utf-8");
	error_reporting(E_ALL ^ E_NOTICE);
	mysql_query("SET NAMES 'utf8'");

	$id=$_GET['folio'];
	$query = "SELECT * FROM sol_cotizaciones WHERE id='".$id."'";	
	$resultado=mysql_query($query,$conexion) or die("Error: ".mysql_error());

	$pdf = new PDF('p','mm','Letter');	
	#Establecemos los márgenes izquierda, arriba y derecha: 
	$pdf->SetTopMargin(10);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','',8);
	$pdf->Ln(10);
	$pdf->Cell(10);
	$pdf->Cell(50,28,'',1,0,'C',0);
	$pdf->Cell(5);
	$pdf->Cell(85,12,utf8_decode('Cítese estos datos en toda correspondencia.'),1,0,'C',0);
	$pdf->Cell(5);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(30,6,'Solicitud No.',1,1,'C',0);
	$pdf->Ln(10);
	$pdf->Cell(65);
	$pdf->Cell(40,6,utf8_decode('Fecha de Emisión'),1,0,'C',0);
	$pdf->Cell(5);
	$pdf->Cell(40,6,utf8_decode('Fecha límite de Cotización'),1,0,'C',0);
	$pdf->Cell(5);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(30,6,'Folio Pedido',1,1,'C',0);
	$pdf->Ln(10);
	$pdf->Cell(10);
	$pdf->SetFont('Arial','B',9);
	//ARTICULOS
	$pdf->Cell(12,4,utf8_decode('Partida'),1,0,'C',0);
	$pdf->Cell(12,4,utf8_decode('Cant.'),1,0,'C',0);
	$pdf->Cell(12,4,utf8_decode('Unidad'),1,0,'C',0);
	$pdf->Cell(80,4,utf8_decode('Descripción y Características'),1,0,'C',0);
	$pdf->Cell(59,4,utf8_decode('Uso'),1,1,'C',0);
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(12,4,'',1,0,'C');
	$pdf->Cell(80,4,'',1,0,'C');
	$pdf->Cell(59,4,'',1,1,'C');
	$pdf->Ln(4);
	$pdf->Cell(10);
	$pdf->Cell(175,6,utf8_decode('Documentación requerida para seguimiento de compra'),1,1,'C');
	$pdf->Cell(10);
	$pdf->Cell(175,24,'',1,1,'C');
	$pdf->Ln(4);
	$pdf->Cell(10);
	//FOOTER
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(87.5,6,utf8_decode('Favor de considerar y plasmar en su cotización'),1,0,'C',1);
	$pdf->Cell(87.5,6,utf8_decode('Para aclaraciones comunicarse con'),1,1,'C',1);
	$pdf->Cell(10);
	$pdf->Cell(87.5,20,'',1,0,'C');
	$pdf->Cell(87.5,20,'',1,1,'C');
	$pdf->Ln(-2);
	$pdf->Cell(10);
	
	$pdf->SetFont('Arial','',8);
	if (!$resultado)
	{
		printf("Errormessage: %s\n", mysql_error($conexion));
	}
	else
	{
		while($row =mysql_fetch_array($resultado)) 
		{
			$proveedor = $row['proveedor'];
			$queryf = "SELECT * FROM proveedores WHERE razon_social='".$proveedor."'";	
			$resultadof=mysql_query($queryf,$conexion) or die("Error: ".mysql_error());
			while($rowf =mysql_fetch_array($resultadof)) 
			{
				$rfc = $rowf['rfc'];
				$direccion = $rowf['direccion'];
				$telefono = $rowf['telefono'];
			}
			$pdf->SetY(38);
			$pdf->Cell(48);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(100,6,utf8_decode($row['empresa']),0,1,'C');
			$pdf->SetFont('Arial','',7);
			$pdf->Ln(-2);
			$pdf->Cell(48);
			$pdf->Cell(100,6,utf8_decode('Calle Benemérito de las Américas No. 137'),0,1,'C');
			$pdf->Ln(-2.5);
			$pdf->Cell(48);
			$pdf->Cell(100,6,utf8_decode('Col. López Mateos, Sombrerete, Zacatecas'),0,1,'C');
			$pdf->Ln(-2.5);
			$pdf->Cell(48);
			$pdf->Cell(100,6,utf8_decode('CP.99102 Tel. 433 935 2833 y 433 935 2232'),0,1,'C');
			$pdf->Cell(168.5);
			$pdf->SetFont('Arial','',8);
			$pdf->Ln(6);
			$pdf->Cell(155);
			$pdf->Cell(30,6,utf8_decode($row['folio']),1,1,'C');
			$pdf->Ln(10);
			$pdf->Cell(65);
			$pdf->Cell(40,6,date('d-m-Y', strtotime($row['fecha'])),1,0,'C',0);
			$pdf->Cell(5);
			$pdf->Cell(40,6,date('d-m-Y', strtotime($row['fecha_limite'])),1,0,'C',0);
			$pdf->Cell(5);
			$pdf->Cell(30,6,utf8_decode($row['folio_compras']),1,1,'C');
			
			$pdf->Ln(-26.5);
			$pdf->Cell(10);
			$pdf->Multicell(50,3,utf8_decode($proveedor."\n\n".$rfc."\n\n".$direccion."\n\n".$telefono),0,'L',0);
			$i=63;
			$pdf->SetY($i);
			//ARTICULOS
			$pdf->Ln(28);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida1']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad1']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad1']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc1']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso1']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida2']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad2']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad2']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc2']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso2']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida3']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad3']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad3']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc3']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso3']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida4']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad4']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad4']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc4']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso4']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida5']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad5']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad5']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc5']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso5']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida6']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad6']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad6']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc6']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso6']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida7']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad7']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad7']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc7']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso7']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida8']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad8']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad8']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc8']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso8']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida9']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad9']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad9']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc9']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso9']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida10']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad10']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad10']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc10']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso10']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida11']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad11']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad11']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc11']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso11']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida12']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad12']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad12']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc12']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso12']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida13']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad13']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad13']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc13']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso13']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida14']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad14']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad14']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc14']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso14']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida15']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad15']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad15']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc15']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso15']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida16']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad16']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad16']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc16']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso16']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida17']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad17']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad17']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc17']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso17']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida18']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad18']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad18']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc18']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso18']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida19']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad19']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad19']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc19']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso19']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Cell(12,4,utf8_decode($row['partida20']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['cantidad20']),0,0,'C',0);
			$pdf->Cell(12,4,utf8_decode($row['unidad20']),0,0,'C',0);
			$pdf->Cell(80,4,utf8_decode($row['desc20']),0,0,'C',0);
			$pdf->Cell(59,4,utf8_decode($row['uso20']),0,1,'C',0);
			$pdf->Cell(10);
			$pdf->Ln(12);
			if($row['tipo_proveedor'] == "Proveedor Nuevo") {
				$pdf->Cell(10);
				$pdf->Multicell(175,2,utf8_decode("1. Constancia de situación fiscal\n\n2. Opinión de cumplimiento con fecha no mayor a 30 días\n\n3. Carátula de datos bancarios\n\n4. Documento de autenticidad de datos en hoja membretada del proveedor y firmado por el representante o propietario\n\n5. Fotografía de establecimiento actualizada"),0,'L',0);
				$pdf->Ln(16);
			}
			else if($row['tipo_proveedor'] == "Proveedor en Sistema") {
				$pdf->Cell(10);
				$pdf->Multicell(175,20,utf8_decode("1. Opinión de cumplimiento con fecha no mayor a 30 días."),0,'L',0);
				$pdf->Ln(15);
			}
			//FOOTER
			if ($_SESSION['usuario'] == 'MAYRA') {
				$SN = ' ';
			}
			else {
				$SN = $_SESSION['nombre'];
			}
			$pdf->Cell(97);
			$pdf->Cell(87.5,8,utf8_decode('Ing.'.' '.$SN),0,1,'C');
			$pdf->Cell(97);
			$pdf->Cell(87.5,8,utf8_decode($_SESSION['telefono']),0,1,'C');
			$pdf->Ln(-16);
			$pdf->Cell(10);
			$pdf->Multicell(87.5,2,utf8_decode("Mejores Precios\n\nCondiciones de Pago\n\nTiempo de Entrega\n\nMétodo de Entrega"),0,'C',0);
			$pdf->Ln(16);																
		}
	}
	$file="cotizaciones/cotizacion".$id.".pdf";
    $pdf->Output($file, 'F');
	$pdf->Output();
?>