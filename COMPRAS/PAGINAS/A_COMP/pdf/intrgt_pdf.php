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

header("Content-Type: text/html;charset=utf-8");
error_reporting(E_ALL ^ E_NOTICE);
mysql_query("SET NAMES 'utf8'");
$id = $_GET['folio'];
$query = "SELECT * FROM oficios_intrgt WHERE id='" . $id . "'";
$resultado = mysql_query($query, $conexion) or die("Error: " . mysql_error());

class PDF extends FPDF
{
	function Header()
	{
		$currentdate = date('Y/m/d');
		$splitTimeStamp = explode("/", $currentdate);
		$d = $splitTimeStamp[2];
		$m = $splitTimeStamp[1];
		$a = $splitTimeStamp[0];
		switch ($m) {
			case '01':
				$mes = "Enero";
				break;
			case '02':
				$mes = "Febrero";
				break;
			case '03':
				$mes = "Marzo";
				break;
			case '04':
				$mes = "Abril";
				break;
			case '05':
				$mes = "Mayo";
				break;
			case '06':
				$mes = "Junio";
				break;
			case '07':
				$mes = "Julio";
				break;
			case '08':
				$mes = "Agosto";
				break;
			case '09':
				$mes = "Septiembre";
				break;
			case '10':
				$mes = "Octubre";
				break;
			case '11':
				$mes = "Noviembre";
				break;
			case '12':
				$mes = "Diciembre";
				break;
		}
		$this->Image('../../../img/membrete_blanco.jpg', 0, 0, 215);
		$this->SetFont('Arial', '', 11);
		$this->Ln(30);
		$this->Cell(40);
		$this->Ln(5);
		$this->Cell(184, 10, utf8_decode('Sombrerete, Zac., a ' . $d . ' de ' . $mes . ' de ' . $a . ''), 0, 0, 'R');
		$this->Ln(10);
		$this->Cell(184, 10, utf8_decode('ASUNTO: Requisición General Terminada'), 0, 0, 'R');
		$this->Ln(25);
		$this->Cell(17);
		$this->Cell(100, 10, utf8_decode('María del Rocío Martínez Andrade'), 0, 0, 'L');
		$this->Ln(5);
		$this->Cell(17);
		$this->Cell(100, 10, utf8_decode('Gerente de Finanzas'), 0, 0, 'L');
		$this->Ln(5);
		$this->Cell(17);
		$this->Cell(100, 10, utf8_decode('P R E S E N T E'), 0, 0, 'L');
		$this->Ln(8);
	}
}

$pdf = new PDF('p', 'mm', 'Letter');
#Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetTopMargin(10);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232, 232, 232);
$pdf->Ln(10);
$pdf->Cell(17);
if (!$resultado) {
	printf("Errormessage: %s\n", mysql_error($conexion));
} else {
	while ($row = mysql_fetch_array($resultado)) {
		$pdf->Ln(-68);
		$pdf->Cell(40);
		$pdf->Cell(144, 10, utf8_decode('Oficio ' . $row['folio'] . ' INT-RGT'), 0, 0, 'R');
		$pdf->Ln(68);
		$pdf->Cell(17);
		$pdf->MultiCell(170, 5, utf8_decode('Por medio del presente me dirijo a usted para saludarle y de la manera más atenta informo que la requisición general con folio ' . $row['folio_aviso'] . ' ha sido terminada.'), 0);
		$pdf->Ln(5);
		$pdf->Cell(17);
		$pdf->MultiCell(170, 5, utf8_decode('Justificación: '), 0);
		$pdf->Cell(17);
		$pdf->SetFont('Arial', 'B', 11);
		$pdf->MultiCell(170, 5, utf8_decode($row['justificacion'] . '.'), 0);
		$pdf->Ln(20);

		$pdf->Cell(60);
		$pdf->SetFont('Arial', '', 11);
		$pdf->Cell(70, 7, utf8_decode('Atentamente'), '0', '0', 'C');
		$pdf->Ln(25);
		$pdf->Cell(60);
		$pdf->Cell(70, 7, utf8_decode('Ing. Raquel Grijalva Álvarez'), '0', '0', 'C');
		$pdf->Ln(5);
		$pdf->Cell(60);
		$pdf->Cell(70, 7, utf8_decode('Gerente de Compras'), '0', '0', 'C');
		$pdf->Ln(25);
		$pdf->Cell(60);
		$pdf->Cell(70, 7, utf8_decode('Cecilia Castrejón Valdez'), '0', '0', 'C');
		$pdf->Ln(5);
		$pdf->Cell(60);
		$pdf->Cell(70, 7, utf8_decode('Gerente de Finanzas'), '0', '0', 'C');
		$pdf->Ln(5);
		$pdf->Cell(60);
		$pdf->Cell(70, 7, utf8_decode('Enterada'), '0', '0', 'C');
		$pdf->Output();
	}
}
$pdf->Output();
