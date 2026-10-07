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
			$this->Ln(15);
			$this->Cell(33);
			$this->Cell(130,10, utf8_decode('Evaluación de Proveedores'),0,0,'C');
			$this->Ln(6);
		}		
	}
	header("Content-Type: text/html;charset=utf-8");
	error_reporting(E_ALL ^ E_NOTICE);
	mysql_query("SET NAMES 'utf8'");
	$id=$_GET['id_ev'];
	$query = "SELECT * FROM evaluaciones WHERE id='".$id."'";	
	$resultado=mysql_query($query,$conexion) or die("Error: ".mysql_error());

	$pdf = new PDF('p','mm','Letter');	
	#Establecemos los márgenes izquierda, arriba y derecha: 
	$pdf->SetTopMargin(10);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',8);
	$pdf->Ln(10);
	$pdf->Cell(157);
	$pdf->Cell(30,6,'Folio:','C',0,'L');
	$pdf->Ln(4);
	$pdf->Cell(157);
	$pdf->Cell(30,6,'Fecha:','C',0,'L');
	$pdf->Ln(4);
	$pdf->Cell(17);
	$pdf->Cell(30,6,'Contacto:','C',0,'L');
	$pdf->Ln(4);
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Razón Social:'),'C',0,'L');
	$pdf->Ln(4);
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('RFC:'),'C',0,'L');
	$pdf->Ln(4);
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Dirección:'),'C',0,'L');
	$pdf->Ln(4);
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('En el producto o servicio:'),'C',0,'L');
	$pdf->Ln(4);
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Momento de calificar:'),'C',0,'L');
	$pdf->Ln(4);
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Meses que evaluar:'),'C',0,'L');
	$pdf->Ln(4);
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('En la Sucursal:'),'C',0,'L');
	$pdf->Ln(4);
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Compras realizadas en el trimestre:'),'C',0,'L');
	$pdf->Ln(4);
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Persona que califica:'),'C',0,'L');
	$pdf->SetFont('Arial','B',7);
	$pdf->Ln(10);
	$pdf->Cell(17);
	//DATOS FISCALES
	$pdf->Cell(160,6,utf8_decode('Detalles de Calificación por Atributo'),1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(20,6,utf8_decode('Atributo'),1,0,'C');
	$pdf->Cell(80,6,utf8_decode('Descripción'),1,0,'C');
	$pdf->Cell(30,6,utf8_decode('Calificación'),1,0,'C');
	$pdf->Cell(30,6,utf8_decode('Observaciones'),1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(20,6,utf8_decode('Calidad'),1,0,'C');
	$pdf->Cell(80,6,utf8_decode('Existe un sistema establecido por el proveedor que verifique la gestión de la calidad'),1,0,'C');
	$pdf->Cell(30,6,utf8_decode(''),1,0,'C');
	$pdf->Cell(30,6,utf8_decode(''),1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(20,6,utf8_decode('Capacidad de respuesta'),1,0,'C');
	$pdf->Cell(80,6,utf8_decode(''),1,0,'C');
	$pdf->Cell(30,6,utf8_decode(''),1,0,'C');
	$pdf->Cell(30,6,utf8_decode(''),1,1,'C');
	//EMPRESA Y FIRMAS
	$pdf->Cell(100,6,utf8_decode('Empresa que Solicita'),1,0,'C',1);
	$pdf->Cell(60,6,utf8_decode('Nombre y Firma del Solicitante'),1,1,'C',1);
	$pdf->Cell(17);
	$pdf->Cell(100,10,'',1,0,'C');
	$pdf->Cell(60,10,'',1,1,'C');
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
			$descp = $row['razon_social'];
			$queryp = "SELECT * FROM proveedores WHERE razon_social='".$descp."'";	
			$resultadop=mysql_query($queryp,$conexion) or die("Error: ".mysql_error());
			while($row2 =mysql_fetch_array($resultadop)) 
			{
				$desc_bs = $row2['desc_bs'];
			}

			$pdf->SetY(55.2);
			$pdf->Cell(168.5);
			$pdf->Cell(70,6,utf8_decode($row['folio']),0,1,'L');
			$pdf->Cell(168.5);
			$pdf->Cell(70,6,date('d-m-Y', strtotime(utf8_decode($row['fecha']))),0,1,'L');
			$pdf->SetY(61);
			$pdf->Cell(47);
			$pdf->Cell(70,6,utf8_decode($row['observaciones']),0,1,'L');
			$i=83;
			$pdf->SetY($i);
			//DATOS FISCALES
			$pdf->Cell(47);
			$pdf->Cell(130,6,utf8_decode($row['razon_social']),0,1,'L');
			$pdf->Cell(47);
			$pdf->Cell(130,6,utf8_decode($row['rfc']),0,1,'L');
			$pdf->Cell(47);
			$pdf->Cell(130,6,utf8_decode(ucwords(strtolower($row['direccion']))),0,1,'L');
			$pdf->Cell(47);
			$pdf->Cell(130,6,utf8_decode($row['curp']),0,1,'L');
			$pdf->Cell(47);
			$pdf->Cell(130,6,utf8_decode($row['telefono']),0,1,'L');
			$pdf->Cell(47);
			$pdf->Cell(130,6,utf8_decode($row['correo']),0,1,'L');
			$pdf->Cell(47);
			$pdf->Cell(130,6,utf8_decode($row['contacto']),0,1,'L');
			$pdf->Cell(47);
			$pdf->Cell(130,6,utf8_decode($row['area']),0,1,'L');
			$pdf->Cell(47);
			$pdf->Cell(130,6,utf8_decode($row['opinion_sat']),0,1,'L');
			$pdf->Cell(47);
			if ($row['opinion_sat'] == 'N/A')
			{
				$pdf->Cell(130,6,'',0,1,'L');
			}
			else
			{
				$pdf->Cell(130,6,date('d-m-Y', strtotime($row['vencimiento'])),0,1,'L');
			}
			$pdf->Cell(47);
			$pdf->Cell(130,6,utf8_decode($desc_bs),0,1,'L');
			$pdf->Ln(16);
			//DATOS	BANCARIOS
			$pdf->Cell(57);
			$pdf->Cell(120,6,utf8_decode($row['nombre_banco']),0,1,'L');
			$pdf->Cell(57);
			$pdf->Cell(120,6,utf8_decode($row['cuenta']),0,1,'L');
			$pdf->Cell(57);
			$pdf->Cell(120,6,utf8_decode($row['clabe']),0,1,'L');
			$pdf->Ln(16);
			//ACUERDOS
			$pdf->Cell(57);
			$pdf->Cell(120,6,utf8_decode($row['pago']),0,1,'L');
			$pdf->Cell(57);
			$pdf->Cell(120,6,utf8_decode($row['tiempo_entrega']),0,1,'L');
			$pdf->Cell(57);
			$pdf->Cell(120,6,utf8_decode($row['metodo_entrega']),0,1,'L');
			$pdf->Ln(18);
			//EMPRESA Y FIRMAS
			$pdf->Cell(17);
			$pdf->Cell(100,6,utf8_decode($row['empresa']),0,0,'C');
			if ($_SESSION['usuario'] == 'MAYRA') {
				$SN = ' ';
			}
			else {
				$SN = $_SESSION['nombre'];
			}
			$pdf->Cell(60,6,utf8_decode($SN),0,0,'C');
			$pdf->Ln(16);																
		}
	}
	$pdf->Output();
?>