<?php
date_default_timezone_set("Mexico/General");
include 'plantilla.php';
require '../conexion/conexion.php';
$names = $link->query("SET NAMES 'UTF8'");
$esp = $link->query("SET lc_time_names = 'es_MX'");
$query = "SELECT * FROM trabajadores ORDER BY id asc";
$resultado = mysqli_query($link,$query);

$pdf = new PDF('l','mm',array(210,300));
#Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetTopMargin(10);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,'',0,0,'C',0);
$pdf->Cell(68,6,'',0,0,'C',0);
$pdf->Cell(20,6,'',0,0,'C',0);
$pdf->Cell(10,6,'',0,0,'C',0);
$pdf->Cell(65,6,'',0,0,'C',0);
$pdf->Cell(20,6,'',0,0,'C',0);
$pdf->Cell(15,6,'',0,0,'C',0);
$pdf->Cell(10,6,'',0,0,'C',0);
$pdf->Cell(54,6,'EXAMENES MEDICOS',1,0,'C',1);
$pdf->Cell(18,6,'',0,1,'C',0);
$pdf->Cell(5,6,'#',1,0,'C',1);
$pdf->Cell(68,6,'NOMBRE',1,0,'C',1);
$pdf->Cell(20,6,'NSS',1,0,'C',1);
$pdf->Cell(10,6,'NT',1,0,'C',1);
$pdf->Cell(65,6,'OBRA',1,0,'C',1);
$pdf->Cell(20,6,'ENF',1,0,'C',1);
$pdf->Cell(15,6,'IMC',1,0,'C',1);
$pdf->Cell(10,6,'RH',1,0,'C',1);
$pdf->Cell(18,6,'LAB',1,0,'C',1);
$pdf->Cell(18,6,'HC',1,0,'C',1);
$pdf->Cell(18,6,'RX',1,0,'C',1);
$pdf->Cell(18,6,'LENTES',1,1,'C',1);
$pdf->SetFont('Arial','',8);
$i=1;
while($row = $resultado->fetch_assoc())
{
	$pdf->Cell(5,6,$i,1,0,'C',0);
	$pdf->Cell(68,6,utf8_decode($row['nombre']),1,0,'l');
	$pdf->Cell(20,6,$row['nss'],1,0,'C');
	$pdf->Cell(10,6,$row['nt'],1,0,'C');
	$pdf->Cell(65,6,utf8_decode($row['obra']),1,0,'l');
	$pdf->Cell(20,6,utf8_decode($row['enfermedad']),1,0,'l');
	$pdf->Cell(15,6,$row['imc'],1,0,'C');
	$pdf->Cell(10,6,utf8_decode($row['rh']),1,0,'C');
	$pdf->Cell(18,6,utf8_decode($row['laboratorio']),1,0,'C');
	$pdf->Cell(18,6,$row['hc'],1,0,'C');
	$pdf->Cell(18,6,utf8_decode($row['rx']),1,0,'C');
	$pdf->Cell(18,6,utf8_decode($row['lente']),1,1,'C');
	$i++;
}

$pdf->Output();
?>