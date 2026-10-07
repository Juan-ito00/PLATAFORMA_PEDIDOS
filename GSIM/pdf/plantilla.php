<?php
date_default_timezone_set("Mexico/General");
require '../conexion/conexion.php';
$names = $link->query("SET NAMES 'UTF8'");
$esp = $link->query("SET lc_time_names = 'es_MX'");
require 'fpdf.php';
class PDF extends FPDF
{
function Header()
{
$this->Image('../assets/img/logo.png', 10, 10, 50 );
$this->SetFont('Arial','B',15);
$this->Cell(20);
$this->Cell(220,10, 'MODULO MEDICO',0,0,'C');
// Salto de línea
$this->Ln();
	$this->Cell(30);
$this->Cell(220,10, 'Reporte General de Expedientes',0,0,'C');
$this->Ln(10);
}
function Footer()
{
	
$fecha= date ("m F Y, g:i a");

$this->SetY(-15);
$this->SetFont('Helvetica','', 8);
$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
$this->SetY(-15);
$this->SetX(-35);
$this->SetFont('Arial','I', 7);
$this->Cell(0,10, utf8_decode('©Sistemas GRUPO CAVI'),0,0,'r');
$this->SetY(-15);$this->SetFont('Arial','I', 7);
$this->Cell(0,10, $fecha,0,0,'r');
}		
}
?>