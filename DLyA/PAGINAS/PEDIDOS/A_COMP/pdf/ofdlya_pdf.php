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

	$query = "SELECT * FROM oficios_dlya WHERE id='".$id_f."'";	

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

			$asunto1 = $row['asunto'];
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
						$im = '../../../../img/membrete_blanco_cancelado.jpg';
					}
					else {
						$im = '../../../../img/membrete_blanco.jpg';
					}
					$this->Image($im, 0, 0, 215 );

					$this->SetFont('Arial','',11);

					$this->Ln(30);



					$this->Ln(-15);

					$this->Cell(40);

					$this->Cell(144,10, utf8_decode('OFICIO DLyA '.$GLOBALS['folio1']),0,0,'R');

					$this->Ln(5);

					$this->Cell(184,10,utf8_decode('Sombrerete, Zac., a '.$d.' de '.$mes.' de '.$a.''),0,0,'R');

					$this->Ln(10);

					$this->Cell(184,10, utf8_decode('ASUNTO: '.$GLOBALS['asunto1']),0,0,'R');		

				}		

			}

			$pdf = new PDF('p','mm','Letter');

			$pdf->SetTopMargin(10);

			$pdf->AliasNbPages();

			$pdf->AddPage();

			$pdf->SetFillColor(232,232,232);

			$pdf->Ln(10);

			//encabezado

			/*$pdf->Ln(-25);

			$pdf->Cell(40);

			$pdf->Cell(144,10, utf8_decode('OFICIO '.$row['folio']),0,0,'R');

			$pdf->Ln(5);

			$pdf->Cell(184,10,utf8_decode('Sombrerete, Zac., a '.$d.' de '.$mes.' de '.$a.''),0,0,'R');

			$pdf->Ln(10);

			//asunto

			$pdf->Cell(184,10, utf8_decode('ASUNTO: '.$row['asunto']),0,0,'R');*/

			$pdf->Ln(20);

			//destinatarios

			if ($row['cargos_grales'] == NULL || $row['cargos_grales'] == ' ') {

				if ($row['dirigido1'] != NULL && $row['dirigido1'] != ' ') {

					$pdf->Cell(12);

					$pdf->Cell(70,7,utf8_decode($row['dirigido1']),'0','0','L');

					$pdf->Ln(5);

					$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido1']."'";	

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

							$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','L');

							$pdf->Ln(10);

						}

					}



					if ($row['dirigido2'] != NULL && $row['dirigido2'] != ' ') {

						$pdf->Cell(12);

						$pdf->Cell(70,7,utf8_decode($row['dirigido2']),'0','0','L');

						$pdf->Ln(5);

						$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido2']."'";	

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

								$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','L');

								$pdf->Ln(10);

							}

						}



						if ($row['dirigido3'] != NULL && $row['dirigido3'] != ' ') {

							$pdf->Cell(12);

							$pdf->Cell(70,7,utf8_decode($row['dirigido3']),'0','0','L');

							$pdf->Ln(5);

							$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido3']."'";	

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

									$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','L');

									$pdf->Ln(10);

								}

							}



							if ($row['dirigido4'] != NULL && $row['dirigido4'] != ' ') {

								$pdf->Cell(12);

								$pdf->Cell(70,7,utf8_decode($row['dirigido4']),'0','0','L');

								$pdf->Ln(5);

								$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido4']."'";	

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

										$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','L');

										$pdf->Ln(10);

									}

								}



								if ($row['dirigido5'] != NULL && $row['dirigido5'] != ' ') {

									$pdf->Cell(12);

									$pdf->Cell(70,7,utf8_decode($row['dirigido5']),'0','0','L');

									$pdf->Ln(5);

									$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido5']."'";	

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

											$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','L');

											$pdf->Ln(10);

										}

									}



									if ($row['dirigido6'] != NULL && $row['dirigido6'] != ' ') {

										$pdf->Cell(12);

										$pdf->Cell(70,7,utf8_decode($row['dirigido6']),'0','0','L');

										$pdf->Ln(5);

										$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido6']."'";	

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

												$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','L');

												$pdf->Ln(10);

											}

										}



										if ($row['dirigido7'] != NULL && $row['dirigido7'] != ' ') {

											$pdf->Cell(12);

											$pdf->Cell(70,7,utf8_decode($row['dirigido7']),'0','0','L');

											$pdf->Ln(5);

											$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido7']."'";	

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

													$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','L');

													$pdf->Ln(10);

												}

											}



											if ($row['dirigido8'] != NULL && $row['dirigido8'] != ' ') {

												$pdf->Cell(12);

												$pdf->Cell(70,7,utf8_decode($row['dirigido8']),'0','0','L');

												$pdf->Ln(5);

												$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido8']."'";	

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

														$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','L');

														$pdf->Ln(10);

													}

												}

											}

										}

									}

								}

							}

						}

					}

				}

			}

			else {

				$pdf->Cell(12);

				$pdf->Cell(70,7,utf8_decode($row['cargos_grales']),'0','0','L');

				$pdf->Ln(10);

			}

			$query_e = "SELECT * FROM elaboro_oficio WHERE nombre='".$row['elaboro']."'";	

			$resultado_e=mysql_query($query_e,$conexion) or die("Error: ".mysql_error());



			if (!$resultado_e)

			{

				printf("Errormessage: %s\n", mysql_error($conexion));

			}

			else

			{

				while($rowe =mysql_fetch_array($resultado_e)) 

				{

					$cargo_elaboro = $rowe['cargo'];

				}

			}

			$pdf->Cell(12);

			$pdf->Cell(30,7,utf8_decode('P R E S E N T E'),'0','0','L');

			$pdf->Ln(15);

			//saludo

			$pdf->Cell(12);

			$pdf->Cell(170,7,utf8_decode('Por medio del presente envío un caluroso saludo y aprovecho para exponerle lo siguiente:'),'0','0','L');

			$pdf->Ln(10);

			//cuerpo

			$pdf->Cell(12);

			$pdf->MultiCell(170, 5, utf8_decode($row['cuerpo']), 0);

			$pdf->Ln(5);

			//saludo

			$pdf->Cell(12);

			$pdf->MultiCell(170,5,utf8_decode('Sin otro particular me despido, agradeciendo de antemano su apoyo y la atención presentada al presente, quedando a sus órdenes para cualquier duda o comentario.'),0);

			//firmas

			$pdf->Ln(10);

			$pdf->Cell(60);

			$pdf->SetFont('Arial','',11);

			$pdf->Cell(70,7,utf8_decode('Atentamente'),'0','0','C');

			$pdf->SetFont('Arial','',9);

			$pdf->Ln(15);

			$pdf->Cell(17);

			$pdf->Cell(70,7,utf8_decode($row['elaboro']),'0','0','C');

			$pdf->Cell(20);

			$pdf->Cell(70,7,utf8_decode('Ing. Airam Alonso Ramírez Roldan'),'0','0','C');

			$pdf->Ln(5);

			$pdf->Cell(17);

			$pdf->Cell(70,7,utf8_decode($cargo_elaboro),'0','0','C');

			$pdf->Cell(20);

			$pdf->Cell(70,7,utf8_decode('Jefe de Depto. Logística y Abastecimiento'),'0','0','C');

			$pdf->Ln(5);

			$pdf->Cell(17);

			$pdf->Cell(70,7,utf8_decode('Elaboró'),'0','0','C');

			$pdf->Cell(20);

			$pdf->Cell(70,7,utf8_decode($row['firma_gercomp']),'0','0','C');

			$pdf->Ln(15);

			$pdf->Cell(17);

			if ($row['cargos_grales'] == NULL || $row['cargos_grales'] == ' ') {

				if ($row['dirigido1'] != NULL && $row['dirigido1'] != ' ') {

					$pdf->Cell(70,7,utf8_decode($row['dirigido1']),'0','0','C');

					$pdf->Ln(5);

					$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido1']."'";	

					$resultado_c=mysql_query($query_c,$conexion) or die("Error: ".mysql_error());



					if (!$resultado_c)

					{

						printf("Errormessage: %s\n", mysql_error($conexion));

					}

					else

					{

						while($row2 =mysql_fetch_array($resultado_c)) 

						{

							

							$pdf->Cell(17);

							$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','C');

							$pdf->Ln(5);

							$pdf->Cell(17);

							$pdf->Cell(70,7,utf8_decode($row['firma1']),'0','0','C');

							$pdf->Ln(-10);

							$pdf->Cell(108);

						}

					}



					if ($row['dirigido2'] != NULL && $row['dirigido2'] != ' ') {

						$pdf->Cell(70,7,utf8_decode($row['dirigido2']),'0','0','C');

						$pdf->Ln(5);

						$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido2']."'";	

						$resultado_c=mysql_query($query_c,$conexion) or die("Error: ".mysql_error());



						if (!$resultado_c)

						{

							printf("Errormessage: %s\n", mysql_error($conexion));

						}

						else

						{

							while($row2 =mysql_fetch_array($resultado_c)) 

							{

								

								$pdf->Cell(108);

								$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','C');

								$pdf->Ln(5);

								$pdf->Cell(108);

								$pdf->Cell(70,7,utf8_decode($row['firma2']),'0','0','C');

								$pdf->Ln(15);

								$pdf->Cell(17);

							}

						}



						if ($row['dirigido3'] != NULL && $row['dirigido3'] != ' ') {

							$pdf->Cell(70,7,utf8_decode($row['dirigido3']),'0','0','C');

							$pdf->Ln(5);

							$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido3']."'";	

							$resultado_c=mysql_query($query_c,$conexion) or die("Error: ".mysql_error());



							if (!$resultado_c)

							{

								printf("Errormessage: %s\n", mysql_error($conexion));

							}

							else

							{

								while($row2 =mysql_fetch_array($resultado_c)) 

								{

									

									$pdf->Cell(17);

									$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','C');

									$pdf->Ln(5);

									$pdf->Cell(17);

									$pdf->Cell(70,7,utf8_decode($row['firma3']),'0','0','C');

									$pdf->Ln(-10);

									$pdf->Cell(108);

								}

							}



							if ($row['dirigido4'] != NULL && $row['dirigido4'] != ' ') {

								$pdf->Cell(70,7,utf8_decode($row['dirigido4']),'0','0','C');

								$pdf->Ln(5);

								$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido4']."'";	

								$resultado_c=mysql_query($query_c,$conexion) or die("Error: ".mysql_error());



								if (!$resultado_c)

								{

									printf("Errormessage: %s\n", mysql_error($conexion));

								}

								else

								{

									while($row2 =mysql_fetch_array($resultado_c)) 

									{

										

										$pdf->Cell(108);

										$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','C');

										$pdf->Ln(5);

										$pdf->Cell(108);

										$pdf->Cell(70,7,utf8_decode($row['firma4']),'0','0','C');

										$pdf->Ln(15);

										$pdf->Cell(17);

									}

								}



								if ($row['dirigido5'] != NULL && $row['dirigido5'] != ' ') {

									$pdf->Cell(70,7,utf8_decode($row['dirigido5']),'0','0','C');

									$pdf->Ln(5);

									$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido5']."'";	

									$resultado_c=mysql_query($query_c,$conexion) or die("Error: ".mysql_error());



									if (!$resultado_c)

									{

										printf("Errormessage: %s\n", mysql_error($conexion));

									}

									else

									{

										while($row2 =mysql_fetch_array($resultado_c)) 

										{

											

											$pdf->Cell(17);

											$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','C');

											$pdf->Ln(5);

											$pdf->Cell(17);

											$pdf->Cell(70,7,utf8_decode($row['firma5']),'0','0','C');

											$pdf->Ln(-10);

											$pdf->Cell(108);

										}

									}



									if ($row['dirigido6'] != NULL && $row['dirigido6'] != ' ') {

										$pdf->Cell(70,7,utf8_decode($row['dirigido6']),'0','0','C');

										$pdf->Ln(5);

										$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido6']."'";	

										$resultado_c=mysql_query($query_c,$conexion) or die("Error: ".mysql_error());



										if (!$resultado_c)

										{

											printf("Errormessage: %s\n", mysql_error($conexion));

										}

										else

										{

											while($row2 =mysql_fetch_array($resultado_c)) 

											{

												

												$pdf->Cell(108);

												$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','C');

												$pdf->Ln(5);

												$pdf->Cell(108);

												$pdf->Cell(70,7,utf8_decode($row['firma6']),'0','0','C');

												$pdf->Ln(15);

												$pdf->Cell(17);

											}

										}



										if ($row['dirigido7'] != NULL && $row['dirigido7'] != ' ') {

											$pdf->Cell(70,7,utf8_decode($row['dirigido7']),'0','0','C');

											$pdf->Ln(5);

											$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido7']."'";	

											$resultado_c=mysql_query($query_c,$conexion) or die("Error: ".mysql_error());



											if (!$resultado_c)

											{

												printf("Errormessage: %s\n", mysql_error($conexion));

											}

											else

											{

												while($row2 =mysql_fetch_array($resultado_c)) 

												{

													

													$pdf->Cell(17);

													$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','C');

													$pdf->Ln(5);

													$pdf->Cell(17);

													$pdf->Cell(70,7,utf8_decode($row['firma7']),'0','0','C');

													$pdf->Ln(-10);

													$pdf->Cell(108);

												}

											}



											if ($row['dirigido8'] != NULL && $row['dirigido8'] != ' ') {

												$pdf->Cell(70,7,utf8_decode($row['dirigido8']),'0','0','C');

												$pdf->Ln(5);

												$query_c = "SELECT * FROM destinatarios WHERE nombre='".$row['dirigido8']."'";	

												$resultado_c=mysql_query($query_c,$conexion) or die("Error: ".mysql_error());



												if (!$resultado_c)

												{

													printf("Errormessage: %s\n", mysql_error($conexion));

												}

												else

												{

													while($row2 =mysql_fetch_array($resultado_c)) 

													{

														

														$pdf->Cell(108);

														$pdf->Cell(70,7,utf8_decode($row2['cargo']),'0','0','C');

														$pdf->Ln(5);

														$pdf->Cell(108);

														$pdf->Cell(70,7,utf8_decode($row['firma8']),'0','0','C');

														$pdf->Ln(15);

														$pdf->Cell(17);

													}

												}

											}

										}

									}

								}

							}

						}

					}

				}

			}

			$pdf->Output();																

		}

	}

	$pdf->Output();

?>