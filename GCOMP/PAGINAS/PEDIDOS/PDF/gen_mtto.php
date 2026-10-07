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
			$this->Cell(130,10, utf8_decode('Solicitud de Mantenimiento'),0,0,'C');
			$this->Ln(15);
		}		
	}
	header("Content-Type: text/html;charset=utf-8");
	error_reporting(E_ALL ^ E_NOTICE);
	mysql_query("SET NAMES 'utf8'");

	$id=$_GET['id_mtto'];
	$query = "SELECT * FROM mantenimientos WHERE id_pedido='".$id."'";	
	$resultado=mysql_query($query,$conexion) or die("Error: ".mysql_error());

	$pdf = new PDF('p','mm','Letter');	
	#Establecemos los márgenes izquierda, arriba y derecha: 
	$pdf->SetTopMargin(10);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10);
	$pdf->Cell(60,6,'Fecha',0,0,'C',0);
	$pdf->Cell(55,6,'Folio de Solicitud GPC',0,0,'C',0);
	$pdf->Cell(60,6,'Folio de Solicitud de Gerencia Solicitante',0,1,'C',0);
    $pdf->Cell(10);
    $pdf->Cell(60,6,'',1,0,'C',0);
	$pdf->Cell(55,6,'',1,0,'C',0);
	$pdf->Cell(60,6,'',1,1,'C',0);
	$pdf->Ln(4);
	$pdf->Cell(10);
	$pdf->Cell(70,6,'Gerencia que Solicita',0,0,'C',0);
	$pdf->Cell(50,6,'Departamento que Solicita',0,0,'C',0);
	$pdf->Cell(55,6,'Solicitante',0,1,'C',0);
	$pdf->Cell(10);
    $pdf->Cell(70,6,'',1,0,'C',0);
	$pdf->Cell(50,6,'',1,0,'C',0);
	$pdf->Cell(55,6,'',1,1,'C',0);
	$pdf->Ln(4);
	$pdf->Cell(10);
	$pdf->Cell(175,6,utf8_decode('Lugar de Realización'),0,1,'L',0);
	$pdf->Cell(10);
    $pdf->Cell(175,6,'',1,1,'L',0);
	$pdf->Ln(4);
	$pdf->Cell(10);
	$pdf->Cell(175,6,utf8_decode('Descripción'),0,1,'L',0);
	$pdf->Cell(10);
    $pdf->Cell(175,18,'',1,1,'L',0);
	$pdf->Ln(4);
	$pdf->Cell(10);
	$pdf->Cell(175,6,utf8_decode('Notas'),0,1,'L',0);
	$pdf->Cell(10);
    $pdf->Cell(175,12,'',1,1,'L',0);
	$pdf->Ln(4);
	$pdf->Cell(10);
	$pdf->Cell(55,6,utf8_decode('¿Se cuenta con el material necesario?'),0,0,'L',0);
    $pdf->Cell(20,6,'',0,1,'L',0);
	$pdf->Ln(4);
	$pdf->Cell(10);
	$pdf->Cell(175,6,utf8_decode('Material Necesario'),0,1,'L',0);
	$pdf->Cell(10);
    $pdf->Cell(175,12,'',1,1,'L',0);
	$pdf->Ln(16);
	$pdf->Cell(10);
	//FOOTER
	$pdf->SetFont('Arial','B',8);
    $pdf->Cell(5);
	$pdf->Cell(50,6,utf8_decode('Emisor'),1,0,'C',1);
    $pdf->Cell(8);
	$pdf->Cell(50,6,utf8_decode('Receptor'),1,0,'C',1);
    $pdf->Cell(8);
    $pdf->Cell(50,6,utf8_decode('Firma de Recibido'),1,1,'C',1);
    $pdf->Cell(15);
	$pdf->Cell(50,18,utf8_decode(''),1,0,'C',0);
    $pdf->Cell(8);
	$pdf->Cell(50,18,utf8_decode(''),1,0,'C',0);
    $pdf->Cell(8);
    $pdf->Cell(50,18,utf8_decode(''),1,1,'C',0);
	$pdf->Ln(6);
	$pdf->Cell(15);
	$pdf->Cell(50,6,utf8_decode('Emisor'),1,0,'C',1);
    $pdf->Cell(8);
	$pdf->Cell(50,6,utf8_decode('Receptor'),1,0,'C',1);
    $pdf->Cell(8);
    $pdf->Cell(50,6,utf8_decode('Firma de Recibido'),1,1,'C',1);
    $pdf->Cell(15);
	$pdf->Cell(50,18,utf8_decode(''),1,0,'C',0);
    $pdf->Cell(8);
	$pdf->Cell(50,18,utf8_decode(''),1,0,'C',0);
    $pdf->Cell(8);
    $pdf->Cell(50,18,utf8_decode(''),1,1,'C',0);
	
	$pdf->SetFont('Arial','',8);
	if (!$resultado)
	{
		printf("Errormessage: %s\n", mysql_error($conexion));
	}
	else
	{
		while($row =mysql_fetch_array($resultado)) 
		{
			$pdf->SetY(45);
			$pdf->Cell(48);
			$pdf->SetFont('Arial','',8);
			$pdf->Ln(6);
            $pdf->Cell(10);
            $pdf->Cell(60,6,date('d-m-Y', strtotime($row['fecha'])),1,0,'C',0);
            $pdf->Cell(55,6,utf8_decode($row['folio_gpc']),1,0,'C',0);
			$pdf->Cell(60,6,utf8_decode($row['folio_ger']),1,1,'C',0);
			$pdf->Ln(10);
			$pdf->Cell(10);
			$pdf->Cell(70,6,utf8_decode($row['gerencia']),1,0,'C',0);
            $pdf->Cell(50,6,utf8_decode($row['departamento']),1,0,'C',0);
			$pdf->Cell(55,6,utf8_decode($row['solicitante']),1,1,'C',0);
			$pdf->Ln(10);
			$pdf->Cell(10);
			$pdf->Cell(175,6,utf8_decode($row['lugar']),1,1,'L',0);
			$pdf->Ln(10);
			$pdf->Cell(10);
			$pdf->Cell(175,18,utf8_decode($row['descripcion']),1,1,'L',0);
			$pdf->Ln(10);
			$pdf->Cell(10);
			$pdf->Cell(175,12,utf8_decode($row['notas']),1,1,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(65);
			$pdf->Cell(20,6,utf8_decode($row['material_necesario']),0,1,'L',0);
			$pdf->Ln(10);
			$pdf->Cell(10);
			$pdf->Cell(175,12,utf8_decode($row['material']),1,1,'L',0);
			
			$i=180;
			$pdf->SetY($i);
			$pdf->Ln(19);
			//FOOTER
			$pdf->Cell(15);
			$pdf->Cell(50,18,utf8_decode($row['departamento']),0,0,'C');
			$pdf->Cell(8);
            $pdf->Cell(50,18,utf8_decode('Supervisor de Mantenimiento'),0,0,'C',0);
            $pdf->Cell(8);
            $pdf->Cell(50,18,utf8_decode('Gerente de Proyectos de Construcción'),0,1,'C',0);
			$pdf->Ln(12);
			$pdf->Cell(15);
			$pdf->Cell(50,18,utf8_decode($row['departamento']),0,0,'C');
			$pdf->Cell(8);
            $pdf->Cell(50,18,utf8_decode('Supervisor de Mantenimiento'),0,0,'C',0);
            $pdf->Cell(8);
            $pdf->Cell(50,18,utf8_decode('Gerente de Proyectos de Construcción'),0,1,'C',0);
			$pdf->Ln(-16);
			$pdf->Cell(10);															
		}
	}
	$pdf->Output();
?>