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

	header("Content-Type: text/html;charset=utf-8");
	error_reporting(E_ALL ^ E_NOTICE);
	mysql_query("SET NAMES 'utf8'");

	$id_f=$_GET['id_f'];
	$query = "SELECT * FROM oficios_scvac WHERE id='".$id_f."'";	
	$resultado=mysql_query($query,$conexion) or die("Error: ".mysql_error());

	if (!$resultado)
	{
		printf("Errormessage: %s\n", mysql_error($conexion));
	}
	else
	{
		while($row =mysql_fetch_array($resultado)) 
		{
			$folio1 = $row['folio'];
			$date_f = $row['fecha'];

			class PDF extends FPDF
			{
				function Header()
				{
					$splitTimeStamp = explode("-",$GLOBALS['date_f']);
					$d = $splitTimeStamp[2];
					$m = $splitTimeStamp[1];
					$a = $splitTimeStamp[0];

					switch ($m)
					{
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

					$est=$_GET['est'];
					if($est == 'Cancelado') {
						$im = '../../../img/membrete_blanco_cancelado.jpg';
					}
					else {
						$im = '../../../img/membrete_blanco.jpg';
					}
					$this->Image($im, 0, 0, 215 );
					$this->SetFont('Arial','',11);
					$this->Ln(30);
					$this->Ln(-10);
					$this->Cell(40);
					$this->Cell(144,10, utf8_decode(''.$GLOBALS['folio1']),0,0,'R');
                    $this->Ln(8);
					$this->Cell(184,10,utf8_decode('Sombrerete, Zac., a '.$d.' de '.$mes.' de '.$a.''),0,0,'R');
                    $this->Ln(8);
					$this->Cell(184,10, utf8_decode('Solicitud de Permiso a Cuenta de Vacaciones'),0,0,'R');
						
				}		
			}
			$pdf = new PDF('p','mm','Letter');
			$pdf->SetTopMargin(10);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFillColor(232,232,232);
			$pdf->Ln(10);

			$pdf->Cell(12);
			$pdf->Cell(30,7,utf8_decode('Atención:'),'0',1,'L');
            $pdf->Cell(12);
            $pdf->Cell(30,7,utf8_decode($row['jefe_inmediato']),'0',1,'L');
            $pdf->Cell(12);
            $pdf->Cell(30,7,utf8_decode('Cc. Gerencia de Capital Humano'),'0','0','L');
            $pdf->Ln(12);
			$pdf->Cell(12);
			$pdf->MultiCell(170,7,utf8_decode('Sírvase el presente documento para solicitar días a cuenta de vacaciones, correspondiente a los '.$row['dias_reserva'].' días que se tienen como reserva, a fin de disponer de ellos, cualquier día del año que los requiera para cubrir actividades personales. Siendo este mi '.$row['dia'].' día a disponer a cuenta de vacaciones.'),0,'J');
			$pdf->Ln(6);
			$pdf->Cell(12);
			$pdf->MultiCell(170,7,utf8_decode('Días a tomar: '.$row['dias_tomar']),0);
            $pdf->Cell(12);
            $pdf->MultiCell(170,7,utf8_decode('Fecha para disponer: '.$row['fecha_disponer']),0);
            $pdf->Ln(6);
            $pdf->Cell(12);
			$pdf->MultiCell(170,5,utf8_decode('Restándome así '.$row['dias_restantes'].' días, para disponer de ellos en futuras fechas en caso de requerirse.'),0);
			$pdf->Ln(6);
            $pdf->Cell(12);
			$pdf->MultiCell(170,5,utf8_decode('Sin más por el momento y en espera de poder contar con su apoyo, ¡Saludos!'),0);
            $pdf->Ln(10);
            $pdf->Cell(12);
            $pdf->MultiCell(170,5,utf8_decode('Atentamente:'),0);
            $pdf->Ln(16);
            $pdf->Cell(12);
			$pdf->Cell(30,7,utf8_decode($row['cargo']),'0',1,'L');
			//firmas
            $solicitante = $row['solicitante'];
            $query_c = "SELECT * FROM destinatarios WHERE nombre LIKE '%$solicitante%'";	
            $resultado_c=mysql_query($query_c,$conexion) or die("Error: ".mysql_error());

            if (!$resultado_c)
            {
                printf("Errormessage: %s\n", mysql_error($conexion));
            }
            else
            {
                while($row2 =mysql_fetch_array($resultado_c)) 
                {
                    $pdf->Cell(12);
                    $pdf->Cell(70,7,utf8_decode($row2['cargo']),'0',1,'L');
                    $pdf->Cell(12);
                    $pdf->Cell(70,7,utf8_decode('Solicita'),'0',1,'L');
                    $pdf->Ln(15);
                }
            }
            $pdf->Ln(8);
            $pdf->Cell(12);
			$pdf->Cell(30,7,utf8_decode($row['jefe_inmediato']),'0',1,'L');
			//firmas
            $query_j = "SELECT * FROM destinatarios WHERE nombre = '".$row['jefe_inmediato']."'";	
            $resultado_j=mysql_query($query_j,$conexion) or die("Error: ".mysql_error());

            if (!$resultado_j)
            {
                printf("Errormessage: %s\n", mysql_error($conexion));
            }
            else
            {
                while($rowj =mysql_fetch_array($resultado_j)) 
                {
                    $pdf->Cell(12);
                    $pdf->Cell(70,7,utf8_decode($rowj['cargo']),'0',1,'L');
                    $pdf->Cell(12);
                    $pdf->Cell(70,7,utf8_decode('Autoriza'),'0',1,'L');
                    $pdf->Ln(10);
                }
            }
			$pdf->Output();																
		}
	}
	$pdf->Output();
?>