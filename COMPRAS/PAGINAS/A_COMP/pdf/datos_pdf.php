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
			$this->Cell(130,10, utf8_decode('DATOS DE PROVEEDOR'),0,0,'C');
			$this->Ln(15);
		}		
	}
	header("Content-Type: text/html;charset=utf-8");
	error_reporting(E_ALL ^ E_NOTICE);
	mysql_query("SET NAMES 'utf8'");
	$currY = date('y');
	$id=$_GET['folio']." ".$currY;
	$query = "SELECT * FROM datos_proveedores JOIN proveedores ON datos_proveedores.id_proveedor = proveedores.id WHERE datos_proveedores.folio='".$id."'";	
	$resultado=mysql_query($query,$conexion) or die("Error: ".mysql_error());

	$pdf = new PDF('p','mm','Letter');	
	#Establecemos los márgenes izquierda, arriba y derecha: 
	$pdf->SetTopMargin(10);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',9);
	$pdf->Ln(10);
	$pdf->Cell(157);
	$pdf->Cell(30,6,'FOLIO:','C',0,'L');
	$pdf->Ln(6);
	$pdf->Cell(17);
	$pdf->Cell(30,6,'OBSERVACIONES:','C',0,'L');
	$pdf->Ln(10);
	$pdf->Cell(17);
	$pdf->SetFont('Arial','B',9);
	//DATOS FISCALES
	$pdf->Cell(160,6,utf8_decode('DATOS FISCALES'),1,1,'C',1);
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Razón Social'),1,0,'L',1);
	$pdf->Cell(130,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('RFC'),1,0,'L',1);
	$pdf->Cell(130,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Dirección'),1,0,'L',1);
	$pdf->Cell(130,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('CURP'),1,0,'L',1);
	$pdf->Cell(130,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Teléfono'),1,0,'L',1);
	$pdf->Cell(130,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Correo Opinión'),1,0,'L',1);
	$pdf->Cell(130,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Agente de Ventas'),1,0,'L',1);
	$pdf->Cell(130,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Contacto'),1,0,'L',1);
	$pdf->Cell(130,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Área'),1,0,'L',1);
	$pdf->Cell(130,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Opinión ante SAT'),1,0,'L',1);
	$pdf->Cell(130,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Vigencia'),1,0,'L',1);
	$pdf->Cell(130,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Desc. bien/serv'),1,0,'L',1);
	$pdf->Cell(130,6,'',1,1,'C');
	$pdf->Ln(10);
	$pdf->Cell(17);
	//DATOS BANCARIOS
	$pdf->Cell(160,6,utf8_decode('DATOS BANCARIOS'),1,1,'C',1);
	$pdf->Cell(17);
	$pdf->Cell(40,6,utf8_decode('Nombre del Banco'),1,0,'L',1);
	$pdf->Cell(120,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(40,6,utf8_decode('Cuenta Bancaria'),1,0,'L',1);
	$pdf->Cell(120,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(40,6,utf8_decode('Clabe Interbancaria'),1,0,'L',1);
	$pdf->Cell(120,6,'',1,1,'C');
	$pdf->Ln(10);
	$pdf->Cell(17);
	//ACUERDOS
	$pdf->Cell(160,6,utf8_decode('ACUERDOS'),1,1,'C',1);
	$pdf->Cell(17);
	$pdf->Cell(40,6,utf8_decode('Pago'),1,0,'L',1);
	$pdf->Cell(120,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(40,6,utf8_decode('Tiempo de Entrega'),1,0,'L',1);
	$pdf->Cell(120,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->Cell(40,6,utf8_decode('Método de Entrega'),1,0,'L',1);
	$pdf->Cell(120,6,'',1,1,'C');
	$pdf->Ln(10);
	$pdf->Cell(17);
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
			$pdf->SetY(61);
			$pdf->Cell(47);
			$pdf->Cell(70,6,utf8_decode($row['observaciones']),0,1,'L');
			$i=77;
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
			$pdf->Cell(130,6,utf8_decode($row['agente_ventas']),0,1,'L');
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