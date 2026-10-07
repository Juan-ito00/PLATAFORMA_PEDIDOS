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
			$this->Cell(17);
			$this->Cell(160,25, utf8_decode('EVALUACIÓN POR LAS OPERACIONES DE COMPRAS'),1,0,'C');
			$this->Ln(15);
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
	$pdf->SetFont('Arial','B',9);
	$pdf->Ln(3);
	$pdf->Cell(130);
	$pdf->Cell(30,6,'FOLIO:','C',0,'L');
	$pdf->Ln(8);
	$pdf->Cell(17);
	$pdf->Cell(160,6,'NOMBRE DEL PROVEEDOR A EVALUAR','C',0,'C');
	$pdf->Ln(12);
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Fecha de la Evaluación:'),'C',0,'L');
	$pdf->Ln(6);
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Descripción de su Pedido:'),'C',0,'L');
	$pdf->Ln(6);
	$pdf->Cell(17);
	$pdf->Cell(30,6,utf8_decode('Nombre del Residente o Supervisor:'),'C',0,'L');
	$pdf->Ln(10);
	$pdf->Cell(17);
	$pdf->SetFont('Arial','B',7.5);
	$pdf->MultiCell(160,5, utf8_decode('CON EL PROPÓSITO DE EVALUAR EL DESEMPEÑO, CALIDAD Y CUMPLIMIENTO DEL PROVEEDOR DEL BIEN O SERVICIO, SE SOLICITA CONTESTAR EL CUESTIONARIO CON BASE EN LOS SIGUIENTES CRITERIOS DE PUNTUACIÓN:'),1,1,'');
	$pdf->Ln(2);
	$pdf->Cell(17);
	$pdf->Cell(40,6,utf8_decode('1 DEFICIENTE'),'C',0,'C');
	$pdf->Cell(40,6,utf8_decode('2 REGULAR'),'C',0,'C');
	$pdf->Cell(40,6,utf8_decode('3 BUENO'),'C',0,'C');
	$pdf->Cell(40,6,utf8_decode('4 EXCELENTE'),'C',1,'C');
	$pdf->Ln(-2);
	$pdf->Cell(17);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(40,6,utf8_decode('MENOS DE 80%'),'C',0,'C');
	$pdf->Cell(40,6,utf8_decode('DEL 81% AL 85%'),'C',0,'C');
	$pdf->Cell(40,6,utf8_decode('DEL 86% AL 90%'),'C',0,'C');
	$pdf->Cell(40,6,utf8_decode('DEL 90% AL 100%'),'C',1,'C');
	$pdf->Ln(2);
	$pdf->Cell(17);
	$pdf->SetFont('Arial','B',9);
	//DATOS FISCALES
	$pdf->Cell(10,6,'',1,0,'L');
	$pdf->Cell(100,6,utf8_decode('EVALUACIÓN'),1,0,'C');
	$pdf->Cell(50,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(10,6,'I',1,0,'C');
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(100,6,'CALIDAD DEL MATERIAL ACORDE A LO SOLICITADO',1,0,'L');
	$pdf->Cell(50,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(10,6,'II',1,0,'C');
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(100,6,'ENTREGA OPORTUNA A LA FECHA COMPROMISO PARA SU SURTIDO',1,0,'L');
	$pdf->Cell(50,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(10,6,'III',1,0,'C');
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(100,6,'SURTIDO COMPLETO ACORDE A LO SOLICITADO MEDIANTE SU PEDIDO',1,0,'L');
	$pdf->Cell(50,6,'',1,1,'C');
	$pdf->Cell(17);
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(10,6,'IV',1,0,'C');
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(100,6,'CONDICIONES DEL MATERIAL AL MOMENTO DE SU ENTREGA',1,0,'L');
	$pdf->Cell(50,6,'',1,1,'C');
	$pdf->Ln(4);
	$pdf->Cell(17);
	$pdf->SetFont('Arial','B',7.5);
	$pdf->Cell(160,6,'RESIDENTE O SUPERVISOR A CARGO DE OBRA, ESPECIFIQUE:','C',0,'L');
	$pdf->SetFont('Arial','',7);
	$pdf->Ln(4);
	$pdf->Cell(17);
	$pdf->Cell(160,6,utf8_decode('Usted cumplió en solicitar su pedido en los plazos establecidos por el departamento de compras:'),'C',0,'L');
	$pdf->Ln(6);
	$pdf->Cell(17);
	$pdf->Cell(10,8,'SI',1,0,'C');
	$pdf->Cell(10,8,'NO',1,0,'C');
	$pdf->MultiCell(140,4,utf8_decode('Al marcar NO, ¿con cuántos días de margen realizó su pedido? (no considerar como días completos los pedidos solicitados después de las 5 de la tarde, así como tampoco sábados y domingos ni días festivos)'),1,1,'');
	$pdf->Cell(107);
	$pdf->Cell(70,6,'',1,0,'L');
	$pdf->Ln(6);
	$pdf->Cell(17);
	$pdf->Cell(160,6,utf8_decode('Usted cumplió en llenar de forma correcta y completa en todas sus especificaciones su pedido:'),'C',0,'L');
	$pdf->Ln(6);
	$pdf->Cell(17);
	$pdf->Cell(10,8,'SI',1,0,'C');
	$pdf->Cell(10,8,'NO',1,0,'C');
	$pdf->MultiCell(140,4,utf8_decode('Al marcar NO, indique si las especificaciones las consideró dejarlas a opción del departamento de compras o por olvido de su parte.'),1,1,'');
	$pdf->Cell(107);
	$pdf->Cell(70,6,'',1,0,'L');
	$pdf->Ln(6);
	$pdf->Cell(17);
	$pdf->Cell(160,6,utf8_decode('Durante la compra existió la necesidad de aclarar especificaciones o tiempos entre el departamento de compras y usted:'),'C',0,'L');
	$pdf->Ln(6);
	$pdf->Cell(17);
	$pdf->Cell(10,8,'SI',1,0,'C');
	$pdf->Cell(10,8,'NO',1,0,'C');
	$pdf->MultiCell(140,8,utf8_decode('Al marcar SI, indique la razón por la que se requirió comunicación extra a las especificaciones del pedido.'),1,1,'');
	$pdf->Cell(107);
	$pdf->Cell(70,6,'',1,0,'L');
	//FIRMAS
	$pdf->SetFont('Arial','',9);
	$pdf->Ln(30);
	$pdf->Cell(17);
	$pdf->Cell(80,6,utf8_decode('Nombre y Firma'),'C',0,'C');
	$pdf->Cell(80,6,utf8_decode('Nombre y Firma'),'C',0,'C');
	$pdf->Ln(-2);
	$pdf->Cell(17);
	$pdf->Cell(80,20,'Residente y/o Supervisor','C',0,'C');
	$pdf->Cell(80,20,'Depto. Operaciones de Compras','C',0,'C');
	$pdf->Cell(17);
	$pdf->Ln(10);
	$pdf->Cell(17);
	if (!$resultado)
	{
		printf("Errormessage: %s\n", mysql_error($conexion));
	}
	else
	{
		while($row =mysql_fetch_array($resultado)) 
		{
			$pdf->SetY(48);
			$pdf->Cell(142);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(70,6,utf8_decode($row['folio']),0,1,'L');
			$pdf->SetY(61);
			$pdf->Cell(81);
			$pdf->Cell(70,6,utf8_decode($row['proveedor']),0,1,'L');
			$pdf->Ln(1);
			$pdf->Cell(54);
			$pdf->Cell(70,6,date('d-m-Y'),0,1,'L');
			$pdf->Ln(0);
			$pdf->Cell(58);
			$pdf->Cell(70,6,utf8_decode($row['descripcion']),0,1,'L');
			$pdf->Ln(0);
			$pdf->Cell(73);
			$pdf->Cell(70,6,utf8_decode($row['res_sup']),0,1,'L');
			$pdf->Ln(28);
			$pdf->Cell(128);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(70,6,utf8_decode($row['res_sup']),0,1,'L');
			$pdf->Ln(0);
			$pdf->Cell(150);
			$pdf->Cell(70,6,utf8_decode($row['ev1']),0,1,'L');
			$pdf->Ln(0);
			$pdf->Cell(150);
			$pdf->Cell(70,6,utf8_decode($row['ev2']),0,1,'L');
			$pdf->Ln(0);
			$pdf->Cell(150);
			$pdf->Cell(70,6,utf8_decode($row['ev3']),0,1,'L');
			$pdf->Ln(0);
			$pdf->Cell(150);
			$pdf->Cell(70,6,utf8_decode($row['ev4']),0,1,'L');
			if ($row['plazos'] == 'Sí') {
				$pdf->Ln(18);
				$pdf->Cell(17);
				$pdf->Cell(10,6,utf8_decode('X'),0,1,'C');
			}
			else if ($row['plazos'] == 'No') {
				$pdf->Ln(18);
				$pdf->Cell(27);
				$pdf->Cell(10,6,utf8_decode('X'),0,1,'C');
			}
			$pdf->Ln(-2);
			$pdf->Cell(108);
			$pdf->Cell(70,6,utf8_decode('Días de margen: '.$row['dias_margen']),0,1,'L');
			if ($row['especificaciones'] == 'Sí') {
				$pdf->Ln(10);
				$pdf->Cell(17);
				$pdf->Cell(10,6,utf8_decode('X'),0,1,'C');
			}
			else if ($row['especificaciones'] == 'No') {
				$pdf->Ln(10);
				$pdf->Cell(27);
				$pdf->Cell(10,6,utf8_decode('X'),0,1,'C');
			}
			$pdf->Ln(-2);
			$pdf->Cell(108);
			$pdf->Cell(70,6,utf8_decode($row['esp_op']),0,1,'L');
			if ($row['aclaraciones'] == 'Sí') {
				$pdf->Ln(10);
				$pdf->Cell(17);
				$pdf->Cell(10,6,utf8_decode('X'),0,1,'C');
			}
			else if ($row['aclaraciones'] == 'No') {
				$pdf->Ln(10);
				$pdf->Cell(27);
				$pdf->Cell(10,6,utf8_decode('X'),0,1,'C');
			}
			$pdf->Ln(-2);
			$pdf->Cell(108);
			$pdf->Cell(70,6,utf8_decode($row['razon']),0,1,'L');
			$i=114;
			$pdf->SetY($i);																	
		}
	}
	$pdf->Output();
?>