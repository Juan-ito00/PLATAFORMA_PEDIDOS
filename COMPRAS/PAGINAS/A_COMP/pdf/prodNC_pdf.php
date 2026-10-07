<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
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
			$this->Cell(130,10, utf8_decode('PRODUCTO NO CONFORME'),0,0,'C');
			$this->Ln(15);
		}		
	}
	header("Content-Type: text/html;charset=utf-8");
	error_reporting(E_ALL ^ E_NOTICE);
	mysql_query("SET NAMES 'utf8'");

	$id=$_GET['id'];
	$query = "SELECT * FROM avisos_pnc WHERE id='".$id."'";	
	$resultado=mysql_query($query,$conexion) or die("Error: ".mysql_error());

	$pdf = new PDF('p','mm','Letter');	
	#Establecemos los márgenes izquierda, arriba y derecha: 
	$pdf->SetTopMargin(10);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',9);
	$pdf->Ln(10);
	$pdf->Cell(127);
	$pdf->Cell(50,6,'FOLIO:','B',0,'L');
	$pdf->Ln(6);
    $pdf->Cell(127);
	$pdf->Cell(50,6,'FECHA:','B',1,'L');
    $pdf->Ln(15);
	$pdf->Cell(17);
	$pdf->SetFont('Arial','B',9);
	//DATOS
	$pdf->Cell(30,6,utf8_decode('Aviso de Compra'),'B,R',0,'L');
	$pdf->Cell(80,6,'','B',1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Pedido'),'B,R',0,'L');
	$pdf->Cell(80,6,'','B',1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Proveedor'),'B,R',0,'L');
	$pdf->Cell(80,6,'','B',1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Folio Factura'),'B,R',0,'L');
	$pdf->Cell(80,6,'','B',1,'C');
    $pdf->Ln(10);
	$pdf->Cell(17);
	$pdf->Cell(120,6,utf8_decode('Descripción de la no conformidad:'),0,1,'L');
	$pdf->Cell(17);
    $pdf->Cell(160,24,'',1,1,'C');
    $pdf->Ln(10);
    $pdf->Cell(17);
	$pdf->Cell(32,6,utf8_decode('Fecha Compromiso'),'B,R',0,'L');
	$pdf->Cell(78,6,'','B',1,'C');
	$pdf->Ln(20);
	$pdf->Cell(17);
	//FIRMAS
	$pdf->Cell(80,6,utf8_decode('Elaboró'),1,0,'C');
	$pdf->Cell(80,6,utf8_decode('Recibió'),1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(80,25,'',1,0,'C');
	$pdf->Cell(80,25,'',1,1,'C');
    $pdf->Ln(5);
    $pdf->Cell(57);
    $pdf->Cell(80,25,'',1,1,'C');
    $pdf->Cell(57);
    $pdf->Cell(80,6,utf8_decode('Proveedor'),1,0,'C');
	$pdf->Ln(10);
	$pdf->Cell(17);
	
	$pdf->SetFont('Arial','',8);
	if (!$resultado)
	{
		printf("Errormessage: %s\n", mysql_error($conexion));
	}
	else
	{
		while($row =mysql_fetch_array($resultado)) 
		{
			$pdf->SetY(55.2);
			$pdf->Cell(140);
			$pdf->Cell(40,6,utf8_decode($row['folio']),0,1,'L');
            $pdf->Cell(140);
            $pdf->Cell(40,6,utf8_decode($row['fecha']),0,1,'L');
			$pdf->SetY(82);
			//DATOS
			$pdf->Cell(47);
			$pdf->Cell(80,6,utf8_decode($row['aviso_compra']),0,1,'L');
			$pdf->Cell(47);
			$pdf->Cell(80,6,utf8_decode($row['folio_compras']),0,1,'L');
			$pdf->Cell(47);
			$pdf->Cell(80,6,utf8_decode($row['proveedor']),0,1,'L');
			$pdf->Cell(47);
			$pdf->Cell(80,6,utf8_decode($row['folio_factura']),0,1,'L');
            $pdf->Ln(15);
			$pdf->Cell(17);
			$pdf->MultiCell(160,5.5,utf8_decode($row['descripcion']),0);
			$pdf->Ln(55);
			//FIRMAS
			if ($_SESSION['usuario'] == 'MAYRA') {
				$SN = ' ';
			}
			else {
				$SN = $row['coordinador_aviso'];
			}
			$pdf->SetY(202);
			$pdf->Cell(17);
			$pdf->Cell(80,6,utf8_decode('Ing. Airam Alonso Ramírez Roldan'),0,0,'C');
			$pdf->Cell(80,6,utf8_decode($SN),0,0,'C');
			$pdf->Ln(4);
			$pdf->Cell(17);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(80,6,utf8_decode('Jefe de Inventarios'),0,0,'C');
			$pdf->Cell(80,6,utf8_decode('Coordinador de Compras'),0,0,'C');				
		}
	}
	$pdf->Output();
?>