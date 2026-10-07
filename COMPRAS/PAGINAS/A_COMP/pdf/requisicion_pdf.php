<?php
date_default_timezone_set("Mexico/General");
session_start();
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario'])) {
	header('Location: ../../../index');
	exit();
}
include("../../../conexion/conexion.php");
$conexion = Conectarse();
require '../../../pdf/fpdf.php';

class PDF extends FPDF
{
	function Header()
	{
		$est = $_GET['est'];
		if ($est == "Cancelado") {
			$im = '../../../img/membrete_blanco_cancelado.jpg';
		} else {
			$im = '../../../img/membrete_blanco.jpg';
		}
		$this->Image($im, 0, 0, 215);
		$this->SetFont('Arial', 'B', 12);
		$this->Ln(20);
		$this->Cell(33);
		$this->Cell(130, 10, utf8_decode('AVISO DE COMPRA REQUISICIÓN GENERAL'), 0, 0, 'C');
		$this->Ln(11);
	}
}
header("Content-Type: text/html;charset=utf-8");
error_reporting(E_ALL ^ E_NOTICE);
mysql_query("SET NAMES 'utf8'");

$id = $_GET['folio'];
$query = "SELECT * FROM avisos_rg WHERE id='" . $id . "'";
$resultado = mysql_query($query, $conexion) or die("Error: " . mysql_error());

$pdf = new PDF('p', 'mm', 'Letter');
#Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetTopMargin(4);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln(-6);
$pdf->Cell(157);
$pdf->Cell(30, 6, 'FOLIO:', 'C', 0, 'L');
$pdf->Ln(10);
$pdf->Cell(17);
$pdf->SetFont('Arial', 'B', 9);
//DATOS
$pdf->Cell(160, 6, utf8_decode('DATOS'), 1, 1, 'C', 1);
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Empresa'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Fecha'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Fecha Recibido'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Folio Compras'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Folio Gerente'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Supervisor'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Correo'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Obra a Surtir'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Proveedor'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Cotización'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Monto Total con I.V.A.'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Observaciones'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Partida 1'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Partida 2'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Partida 3'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Partida 4'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Partida 5'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Partida 6'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Partida 7'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Partida 8'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Partida 9'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Cell(17);
$pdf->Cell(40, 6, utf8_decode('Partida 10'), 1, 0, 'L', 1);
$pdf->Cell(120, 6, '', 1, 1, 'C');
$pdf->Ln(10);
$pdf->Cell(17);
//FIRMAS
$pdf->Cell(53, 6, utf8_decode('Elaboró'), 1, 0, 'C', 1);
$pdf->Cell(53, 6, utf8_decode('Autorizó Compras'), 1, 0, 'C', 1);
$pdf->Cell(53, 6, utf8_decode('Autorizó Finanzas'), 1, 1, 'C', 1);
$pdf->Cell(17);
$pdf->Cell(53, 26, '', 1, 0, 'C');
$pdf->Cell(53, 26, '', 1, 0, 'C');
$pdf->Cell(53, 26, '', 1, 1, 'C');
$pdf->Ln(-2);
$pdf->Cell(17);

$pdf->SetFont('Arial', '', 8);
if (!$resultado) {
	printf("Errormessage: %s\n", mysql_error($conexion));
} else {
	while ($row = mysql_fetch_array($resultado)) {
		$flc = $row['folio_gerencia'];
		$queryf = "SELECT * FROM pedidos WHERE folio='" . $flc . "'";
		$resultadof = mysql_query($queryf, $conexion) or die("Error: " . mysql_error());
		while ($rowf = mysql_fetch_array($resultadof)) {
			$fecha_p = $rowf['fecha'];
		}
		$pdf->SetY(29.2);
		$pdf->Cell(168.5);
		$pdf->Cell(70, 6, utf8_decode($row['folio']), 0, 1, 'L');
		$i = 46;
		$pdf->SetY($i);
		//DATOS
		$pdf->Cell(57);
		$pdf->Cell(120, 6, utf8_decode($row['empresa']), 0, 1, 'L');
		$pdf->Cell(57);
		$pdf->Cell(120, 6, date('d-m-Y', strtotime($row['fecha'])), 0, 1, 'L');
		$pdf->Cell(57);
		$pdf->Cell(120, 6, date('d-m-Y', strtotime($fecha_p)), 0, 1, 'L');
		$pdf->Cell(57);
		$pdf->Cell(120, 6, utf8_decode($row['folio_compras']), 0, 1, 'L');
		$pdf->Cell(57);
		$pdf->Cell(120, 6, utf8_decode($row['folio_gerencia']), 0, 1, 'L');
		$pdf->Cell(57);
		$pdf->Cell(120, 6, utf8_decode($row['supervisor']), 0, 1, 'L');
		$pdf->Cell(57);
		$pdf->Cell(120, 6, utf8_decode($row['correo']), 0, 1, 'L');
		$pdf->Cell(57);
		$pdf->Cell(120, 6, utf8_decode($row['proyecto']), 0, 1, 'L');
		$pdf->Cell(57);
		$pdf->Cell(120, 6, utf8_decode($row['proveedor']), 0, 1, 'L');
		$pdf->Cell(57);
		$pdf->Cell(120, 6, utf8_decode($row['cotizacion']), 0, 1, 'L');
		$pdf->Cell(57);
		$pdf->Cell(120, 6, utf8_decode('$' . $row['monto_total'] . ' ' . $row['moneda']), 0, 1, 'L');
		$pdf->Cell(57);
		$pdf->Cell(120, 6, utf8_decode($row['observaciones']), 0, 1, 'L');
		$pdf->Cell(57);
		if ($row['partida1'] == '0.00') {
			$pdf->Cell(120, 6, utf8_decode('$'), 0, 1, 'L');
		} else {
			$pdf->Cell(120, 6, utf8_decode('$' . $row['partida1']), 0, 1, 'L');
		}
		$pdf->Cell(57);
		if ($row['partida2'] == '0.00') {
			$pdf->Cell(120, 6, utf8_decode('$'), 0, 1, 'L');
		} else {
			$pdf->Cell(120, 6, utf8_decode('$' . $row['partida2']), 0, 1, 'L');
		}
		$pdf->Cell(57);
		if ($row['partida3'] == '0.00') {
			$pdf->Cell(120, 6, utf8_decode('$'), 0, 1, 'L');
		} else {
			$pdf->Cell(120, 6, utf8_decode('$' . $row['partida3']), 0, 1, 'L');
		}
		$pdf->Cell(57);
		if ($row['partida4'] == '0.00') {
			$pdf->Cell(120, 6, utf8_decode('$'), 0, 1, 'L');
		} else {
			$pdf->Cell(120, 6, utf8_decode('$' . $row['partida4']), 0, 1, 'L');
		}
		$pdf->Cell(57);
		if ($row['partida5'] == '0.00') {
			$pdf->Cell(120, 6, utf8_decode('$'), 0, 1, 'L');
		} else {
			$pdf->Cell(120, 6, utf8_decode('$' . $row['partida5']), 0, 1, 'L');
		}
		$pdf->Cell(57);
		if ($row['partida6'] == '0.00') {
			$pdf->Cell(120, 6, utf8_decode('$'), 0, 1, 'L');
		} else {
			$pdf->Cell(120, 6, utf8_decode('$' . $row['partida6']), 0, 1, 'L');
		}
		$pdf->Cell(57);
		if ($row['partida7'] == '0.00') {
			$pdf->Cell(120, 6, utf8_decode('$'), 0, 1, 'L');
		} else {
			$pdf->Cell(120, 6, utf8_decode('$' . $row['partida7']), 0, 1, 'L');
		}
		$pdf->Cell(57);
		if ($row['partida8'] == '0.00') {
			$pdf->Cell(120, 6, utf8_decode('$'), 0, 1, 'L');
		} else {
			$pdf->Cell(120, 6, utf8_decode('$' . $row['partida8']), 0, 1, 'L');
		}
		$pdf->Cell(57);
		if ($row['partida9'] == '0.00') {
			$pdf->Cell(120, 6, utf8_decode('$'), 0, 1, 'L');
		} else {
			$pdf->Cell(120, 6, utf8_decode('$' . $row['partida9']), 0, 1, 'L');
		}
		$pdf->Cell(57);
		if ($row['partida10'] == '0.00') {
			$pdf->Cell(120, 6, utf8_decode('$'), 0, 1, 'L');
		} else {
			$pdf->Cell(120, 6, utf8_decode('$' . $row['partida10']), 0, 1, 'L');
		}
		$pdf->Ln(28);
		//FIRMAS
		$pdf->Cell(17);
		if ($_SESSION['usuario'] == 'MAYRA') {
			$SN = ' ';
		} else {
			$SN = $_SESSION['nombre'];
		}
		$pdf->Cell(53, 6, utf8_decode($SN), 0, 0, 'C');
		$pdf->Cell(53, 6, utf8_decode('Raquel Grijalva Álvarez'), 0, 0, 'C');
		$pdf->Cell(53, 6, utf8_decode('María del Rocío Martínez Andrade'), 0, 1, 'C');
		$pdf->Cell(17);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(53, 6, utf8_decode('Coordinador de Compras'), 0, 0, 'C');
		$pdf->Cell(53, 6, utf8_decode('Gerente de Compras'), 0, 0, 'C');
		$pdf->Cell(53, 6, utf8_decode('Gerente de Finazas'), 0, 1, 'C');
		$pdf->Ln(16);
	}
}
$pdf->Output();
