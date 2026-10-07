<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
	{
		header('Location: ../../../../index');
		exit();
	}

	include("../../../../conexion/conexion.php"); 
	$conexion=Conectarse();
	require '../../../../pdf/fpdf.php';

	header("Content-Type: text/html;charset=utf-8");
	error_reporting(E_ALL ^ E_NOTICE);
	mysql_query("SET NAMES 'utf8'");

	$id_f=$_GET['id_f'];
	$query = "SELECT * FROM oficios_comisiones WHERE id='".$id_f."'";	
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
            $asunto = $row['asunto'];

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
						$im = '../../../../img/membrete_blanco_cancelado.jpg';
					}
					else {
						$im = '../../../../img/membrete_blanco.jpg';
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
					$this->Cell(184,10, utf8_decode('Asunto: '.$GLOBALS['asunto']),0,0,'R');
						
				}		
			}
			$pdf = new PDF('p','mm','Letter');
			$pdf->SetTopMargin(10);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFillColor(232,232,232);
			$pdf->Ln(10);

			$pdf->Cell(12);
			$pdf->Cell(30,7,utf8_decode($row['dirigido_a']),'0',1,'L');
            $pdf->Cell(12);
            $pdf->Cell(30,7,utf8_decode('P R E S E N T E'),'0',1,'L');
			$pdf->Ln(15);

            $splitTimeStamp2 = explode("-",$row['fecha_inicio']);
            $d2 = $splitTimeStamp2[2];
            $m2 = $splitTimeStamp2[1];
            $a2 = $splitTimeStamp2[0];

            switch ($m2)
            {
                case '01':
                $mesi = "Enero";
                    break;
                case '02':
                $mesi = "Febrero";
                    break;
                case '03':
                $mesi = "Marzo";
                    break;
                case '04':
                $mesi = "Abril";
                    break;
                case '05':
                $mesi = "Mayo";
                    break;
                case '06':
                $mesi = "Junio";
                    break;
                case '07':
                $mesi = "Julio";
                    break;
                case '08':
                $mesi = "Agosto";
                    break;
                case '09':
                $mesi = "Septiembre";
                    break;
                case '10':
                $mesi = "Octubre";
                    break;
                case '11':
                $mesi = "Noviembre";
                    break;
                case '12':
                $mesi = "Diciembre";
                    break;
            }

            $splitTimeStamp3 = explode("-",$row['fecha_termino']);
            $d3 = $splitTimeStamp3[2];
            $m3 = $splitTimeStamp3[1];
            $a3 = $splitTimeStamp3[0];

            switch ($m3)
            {
                case '01':
                $mest = "Enero";
                    break;
                case '02':
                $mest = "Febrero";
                    break;
                case '03':
                $mest = "Marzo";
                    break;
                case '04':
                $mest = "Abril";
                    break;
                case '05':
                $mest = "Mayo";
                    break;
                case '06':
                $mest = "Junio";
                    break;
                case '07':
                $mest = "Julio";
                    break;
                case '08':
                $mest = "Agosto";
                    break;
                case '09':
                $mest = "Septiembre";
                    break;
                case '10':
                $mest = "Octubre";
                    break;
                case '11':
                $mest = "Noviembre";
                    break;
                case '12':
                $mest = "Diciembre";
                    break;
            }
			//cuerpo
			$pdf->Cell(12);
			$pdf->MultiCell(170,7,utf8_decode('Solicitamos su apoyo para: '.$row['comision'].' a la ciudad de '.$row['ciudad_destino'].'.'),0);
            $pdf->Cell(12);
			$pdf->MultiCell(170,7,utf8_decode('En base al oficio '.$row['oficio_solicitante'].', emitido por '.$row['emite_oficio'].', que se adjunta a esta asignación con fecha '.date('d/m/Y', strtotime($row['fecha_oficio'])).'.'),0);
			$pdf->Ln(6);
			$pdf->Cell(12);
			$pdf->MultiCell(170,7,utf8_decode('El traslado será en el vehicúlo '.$row['vehiculo_comision'].'.'),0);
			$pdf->Ln(6);
			$pdf->Cell(12);
			$pdf->MultiCell(170,5,utf8_decode('Con inicio de comisión el '.$d2.' de '.$mesi.' del '.$a2.' a las '.$row['hora_inicio'].'.'),0);
            $pdf->Ln(6);
			$pdf->Cell(12);
			$pdf->MultiCell(170,5,utf8_decode('Término el '.$d3.' de '.$mest.' del '.$a3.' a las '.$row['hora_termino'].'.'),0);
            $pdf->Ln(6);
			$pdf->Cell(12);
			$pdf->MultiCell(170,5,utf8_decode('Con un total de '.$row['dias'].' día.'),0);
            $pdf->Ln(6);
			$pdf->Cell(12);
			$pdf->MultiCell(170,5,utf8_decode('Se entrega copia de este oficio a Capital Humano, para la justificación de falta de registro de entrada y salida en caso de que esta comisión implique no hacerlos durante su ejecución.'),0);
            $pdf->Cell(12);
			$pdf->MultiCell(170,5,utf8_decode('Sin otro particular me despido, agradeciendo de antemano su apoyo y la atención presentada al presente, quedando a su órdenes para cualquier duda o aclaración.'),0);
            $pdf->Ln(10);
            $pdf->Cell(12);
            $pdf->MultiCell(170,5,utf8_decode('Atentamente'),0,'C');
            $pdf->Ln(15);
			$pdf->Cell(32);
			$pdf->Cell(70,7,utf8_decode('Ing. Airam Alonso Ramírez Roldan'),0,0,'C');
            $pdf->Cell(70,7,utf8_decode($row['dirigido_a']),0,1,'C');
			$pdf->Cell(32);
			$pdf->Cell(70,7,utf8_decode('Jefe de Inventarios'),0,0,'C');
            $pdf->Cell(70,7,utf8_decode('Chofer'),0,1,'C');
            $pdf->Ln(5);
            $pdf->Cell(32);
			$pdf->Cell(70,7,utf8_decode('Elaboró'),0,0,'C');
            $pdf->Cell(70,7,utf8_decode('Comisionado'),0,1,'C');
            
			$pdf->Output();																
		}
	}
	$pdf->Output();
?>