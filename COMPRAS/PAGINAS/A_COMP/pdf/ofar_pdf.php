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
	$query = "SELECT * FROM oficios_rutas WHERE id='".$id_f."'";	
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
			$date_f = $row['fecha_creacion'];

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
						$im = '../../../img/membrete_blanco_horizontal_cancelado.jpg';
					}
					else {
						$im = '../../../img/membrete_blanco_horizontal.jpg';
					}
					$this->Image($im, 0, 0, 300 );
					$this->SetFont('Arial','',11);
					$this->Ln(30);
					$this->Ln(-10);
					$this->Cell(80);
					$this->Cell(184,10, utf8_decode(''.$GLOBALS['folio1']),0,0,'R');
					$this->Ln(8);
                    $this->Cell(80);
					$this->Cell(184,10,utf8_decode('Sombrerete, Zac., a '.$d.' de '.$mes.' de '.$a.''),0,0,'R');	
				}		
			}
			$pdf = new PDF('l','mm','A4');
			$pdf->SetTopMargin(10);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFillColor(232,232,232);
			$pdf->Ln(15);

			$pdf->Cell(10);
			$pdf->Cell(80,7,utf8_decode('Ruta: '.$row['ruta']),'0','0','L');
            $pdf->Cell(80,7,utf8_decode('Chofer designado: '.$row['chofer']),'0','0','L');
			$pdf->Ln(15);

			$pdf->Cell(10);
            $pdf->SetFont('Arial','B',8);
			$pdf->Cell(6,14,utf8_decode('No.'),'1','0','C');
            $pdf->Cell(60,14,utf8_decode('Proveedor'),'1','0','C');
            $pdf->Cell(30,14,utf8_decode('Proyecto'),'1','0','C');
            $pdf->Cell(22,14,utf8_decode('Folio Compras'),'1','0','C');
            $pdf->Cell(22,14,utf8_decode('Folio Gerencia'),'1','0','C');
            $pdf->Cell(17,14,utf8_decode('Carta Porte'),'1','0','C');
            $pdf->Cell(12,14,utf8_decode('Factura'),'1','0','C');
            $pdf->Cell(27,14,utf8_decode('No. de Recolección'),'1','0','C');
            $pdf->Cell(30,14,utf8_decode('Observaciones'),'1','0','C');
            $pdf->Cell(32,7,utf8_decode('Recolección Completa'),'1','2','C');
            $pdf->Cell(16,7,utf8_decode('Sí'),'1','0','C');
            $pdf->Cell(16,7,utf8_decode('No'),'1','1','C');
            if($row['tipo1'] == 'avisos_ordinarios' || $row['tipo1'] == 'avisos_rg' || $row['tipo1'] == 'solicitudes_anticipo'){
                $tabla = $row['tipo1'];
                $qa1 = "SELECT * FROM $tabla WHERE folio='".$row['folio_ac1']."'";	
                $ra1=mysql_query($qa1,$conexion) or die("Error: ".mysql_error());

                if (!$ra1)
                {
                    printf("Errormessage: %s\n", mysql_error($conexion));
                }
                else
                {
                    while($rowa1 =mysql_fetch_array($ra1)) 
                    {
                        $proveedor1 = $rowa1['proveedor'];
                        $proyecto1 = $rowa1['proyecto'];
                        $folio_compras1 = $rowa1['folio_compras'];
                        $folio_gerencia1 = $rowa1['folio_gerencia'];
                    }
                }
            }

            $pdf->Cell(10);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(6,7,utf8_decode('1'),'1','0','C');
            $pdf->Cell(60,7,utf8_decode(''.$proveedor1),'1','0','C');
            $pdf->Cell(30,7,utf8_decode(''.$proyecto1),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_compras1),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_gerencia1),'1','0','C');
            $pdf->Cell(17,7,utf8_decode($row['carta_porte1']),'1','0','C');
            $pdf->Cell(12,7,utf8_decode($row['factura1']),'1','0','C');
            $pdf->Cell(27,7,utf8_decode($row['no_recoleccion1']),'1','0','C');
            $pdf->Cell(30,7,utf8_decode($row['observaciones1']),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
			$pdf->Ln(7);
            if($row['tipo2'] == 'avisos_ordinarios' || $row['tipo2'] == 'avisos_rg' || $row['tipo2'] == 'solicitudes_anticipo'){
                $tabla = $row['tipo2'];
                $qa2 = "SELECT * FROM $tabla WHERE folio='".$row['folio_ac2']."'";	
                $ra2=mysql_query($qa2,$conexion) or die("Error: ".mysql_error());

                if (!$ra2)
                {
                    printf("Errormessage: %s\n", mysql_error($conexion));
                }
                else
                {
                    while($rowa2 =mysql_fetch_array($ra2)) 
                    {
                        $proveedor2 = $rowa2['proveedor'];
                        $proyecto2 = $rowa2['proyecto'];
                        $folio_compras2 = $rowa2['folio_compras'];
                        $folio_gerencia2 = $rowa2['folio_gerencia'];
                    }
                }
            }

            $pdf->Cell(10);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(6,7,utf8_decode('2'),'1','0','C');
            $pdf->Cell(60,7,utf8_decode(''.$proveedor2),'1','0','C');
            $pdf->Cell(30,7,utf8_decode(''.$proyecto2),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_compras2),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_gerencia2),'1','0','C');
            $pdf->Cell(17,7,utf8_decode($row['carta_porte2']),'1','0','C');
            $pdf->Cell(12,7,utf8_decode($row['factura2']),'1','0','C');
            $pdf->Cell(27,7,utf8_decode($row['no_recoleccion2']),'1','0','C');
            $pdf->Cell(30,7,utf8_decode($row['observaciones2']),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
			$pdf->Ln(7);

            if($row['tipo3'] == 'avisos_ordinarios' || $row['tipo3'] == 'avisos_rg' || $row['tipo3'] == 'solicitudes_anticipo'){
                $tabla = $row['tipo3'];
                $qa3 = "SELECT * FROM $tabla WHERE folio='".$row['folio_ac3']."'";	
                $ra3=mysql_query($qa3,$conexion) or die("Error: ".mysql_error());

                if (!$ra3)
                {
                    printf("Errormessage: %s\n", mysql_error($conexion));
                }
                else
                {
                    while($rowa3 =mysql_fetch_array($ra3)) 
                    {
                        $proveedor3 = $rowa3['proveedor'];
                        $proyecto3 = $rowa3['proyecto'];
                        $folio_compras3 = $rowa3['folio_compras'];
                        $folio_gerencia3 = $rowa3['folio_gerencia'];
                    }
                }
            }

            $pdf->Cell(10);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(6,7,utf8_decode('3'),'1','0','C');
            $pdf->Cell(60,7,utf8_decode(''.$proveedor3),'1','0','C');
            $pdf->Cell(30,7,utf8_decode(''.$proyecto3),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_compras3),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_gerencia3),'1','0','C');
            $pdf->Cell(17,7,utf8_decode($row['carta_porte3']),'1','0','C');
            $pdf->Cell(12,7,utf8_decode($row['factura3']),'1','0','C');
            $pdf->Cell(27,7,utf8_decode($row['no_recoleccion3']),'1','0','C');
            $pdf->Cell(30,7,utf8_decode($row['observaciones3']),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
			$pdf->Ln(7);
            if($row['tipo4'] == 'avisos_ordinarios' || $row['tipo4'] == 'avisos_rg' || $row['tipo4'] == 'solicitudes_anticipo'){
                $tabla = $row['tipo4'];
                $qa4 = "SELECT * FROM $tabla WHERE folio='".$row['folio_ac4']."'";	
                $ra4=mysql_query($qa4,$conexion) or die("Error: ".mysql_error());
    
                if (!$ra4)
                {
                    printf("Errormessage: %s\n", mysql_error($conexion));
                }
                else
                {
                    while($rowa4 =mysql_fetch_array($ra4)) 
                    {
                        $proveedor4 = $rowa4['proveedor'];
                        $proyecto4 = $rowa4['proyecto'];
                        $folio_compras4 = $rowa4['folio_compras'];
                        $folio_gerencia4 = $rowa4['folio_gerencia'];
                    }
                }

            }

            $pdf->Cell(10);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(6,7,utf8_decode('4'),'1','0','C');
            $pdf->Cell(60,7,utf8_decode(''.$proveedor4),'1','0','C');
            $pdf->Cell(30,7,utf8_decode(''.$proyecto4),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_compras4),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_gerencia4),'1','0','C');
            $pdf->Cell(17,7,utf8_decode($row['carta_porte4']),'1','0','C');
            $pdf->Cell(12,7,utf8_decode($row['factura4']),'1','0','C');
            $pdf->Cell(27,7,utf8_decode($row['no_recoleccion4']),'1','0','C');
            $pdf->Cell(30,7,utf8_decode($row['observaciones4']),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
			$pdf->Ln(7);

            if($row['tipo5'] == 'avisos_ordinarios' || $row['tipo5'] == 'avisos_rg' || $row['tipo5'] == 'solicitudes_anticipo'){
                $tabla = $row['tipo5'];
                $qa5 = "SELECT * FROM $tabla WHERE folio='".$row['folio_ac5']."'";	
                $ra5=mysql_query($qa5,$conexion) or die("Error: ".mysql_error());

                if (!$ra5)
                {
                    printf("Errormessage: %s\n", mysql_error($conexion));
                }
                else
                {
                    while($rowa5 =mysql_fetch_array($ra5)) 
                    {
                        $proveedor5 = $rowa5['proveedor'];
                        $proyecto5 = $rowa5['proyecto'];
                        $folio_compras5 = $rowa5['folio_compras'];
                        $folio_gerencia5 = $rowa5['folio_gerencia'];
                    }
                }
            }

            $pdf->Cell(10);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(6,7,utf8_decode('5'),'1','0','C');
            $pdf->Cell(60,7,utf8_decode(''.$proveedor5),'1','0','C');
            $pdf->Cell(30,7,utf8_decode(''.$proyecto5),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_compras5),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_gerencia5),'1','0','C');
            $pdf->Cell(17,7,utf8_decode($row['carta_porte5']),'1','0','C');
            $pdf->Cell(12,7,utf8_decode($row['factura5']),'1','0','C');
            $pdf->Cell(27,7,utf8_decode($row['no_recoleccion5']),'1','0','C');
            $pdf->Cell(30,7,utf8_decode($row['observaciones5']),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
			$pdf->Ln(7);

            if($row['tipo6'] == 'avisos_ordinarios' || $row['tipo6'] == 'avisos_rg' || $row['tipo6'] == 'solicitudes_anticipo'){
                $tabla = $row['tipo6'];
                $qa6 = "SELECT * FROM $tabla WHERE folio='".$row['folio_ac6']."'";	
                $ra6=mysql_query($qa6,$conexion) or die("Error: ".mysql_error());

                if (!$ra6)
                {
                    printf("Errormessage: %s\n", mysql_error($conexion));
                }
                else
                {
                    while($rowa6 =mysql_fetch_array($ra6)) 
                    {
                        $proveedor6 = $rowa6['proveedor'];
                        $proyecto6 = $rowa6['proyecto'];
                        $folio_compras6 = $rowa6['folio_compras'];
                        $folio_gerencia6 = $rowa6['folio_gerencia'];
                    }
                }
            }

            $pdf->Cell(10);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(6,7,utf8_decode('6'),'1','0','C');
            $pdf->Cell(60,7,utf8_decode(''.$proveedor6),'1','0','C');
            $pdf->Cell(30,7,utf8_decode(''.$proyecto6),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_compras6),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_gerencia6),'1','0','C');
            $pdf->Cell(17,7,utf8_decode($row['carta_porte6']),'1','0','C');
            $pdf->Cell(12,7,utf8_decode($row['factura6']),'1','0','C');
            $pdf->Cell(27,7,utf8_decode($row['no_recoleccion6']),'1','0','C');
            $pdf->Cell(30,7,utf8_decode($row['observaciones6']),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
			$pdf->Ln(7);

            if($row['tipo7'] == 'avisos_ordinarios' || $row['tipo7'] == 'avisos_rg' || $row['tipo7'] == 'solicitudes_anticipo'){
                $tabla = $row['tipo7'];
                $qa7 = "SELECT * FROM $tabla WHERE folio='".$row['folio_ac7']."'";	
                $ra7=mysql_query($qa7,$conexion) or die("Error: ".mysql_error());

                if (!$ra7)
                {
                    printf("Errormessage: %s\n", mysql_error($conexion));
                }
                else
                {
                    while($rowa7 =mysql_fetch_array($ra7)) 
                    {
                        $proveedor7 = $rowa7['proveedor'];
                        $proyecto7 = $rowa7['proyecto'];
                        $folio_compras7 = $rowa7['folio_compras'];
                        $folio_gerencia7 = $rowa7['folio_gerencia'];
                    }
                }
            }

            $pdf->Cell(10);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(6,7,utf8_decode('7'),'1','0','C');
            $pdf->Cell(60,7,utf8_decode(''.$proveedor7),'1','0','C');
            $pdf->Cell(30,7,utf8_decode(''.$proyecto7),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_compras7),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_gerencia7),'1','0','C');
            $pdf->Cell(17,7,utf8_decode($row['carta_porte7']),'1','0','C');
            $pdf->Cell(12,7,utf8_decode($row['factura7']),'1','0','C');
            $pdf->Cell(27,7,utf8_decode($row['no_recoleccion7']),'1','0','C');
            $pdf->Cell(30,7,utf8_decode($row['observaciones7']),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
			$pdf->Ln(7);

            if($row['tipo8'] == 'avisos_ordinarios' || $row['tipo8'] == 'avisos_rg' || $row['tipo8'] == 'solicitudes_anticipo'){
                $tabla = $row['tipo8'];
                $qa8 = "SELECT * FROM $tabla WHERE folio='".$row['folio_ac8']."'";	
                $ra8=mysql_query($qa8,$conexion) or die("Error: ".mysql_error());

                if (!$ra8)
                {
                    printf("Errormessage: %s\n", mysql_error($conexion));
                }
                else
                {
                    while($rowa8 =mysql_fetch_array($ra8)) 
                    {
                        $proveedor8 = $rowa8['proveedor'];
                        $proyecto8 = $rowa8['proyecto'];
                        $folio_compras8 = $rowa8['folio_compras'];
                        $folio_gerencia8 = $rowa8['folio_gerencia'];
                    }
                }
            }

            $pdf->Cell(10);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(6,7,utf8_decode('8'),'1','0','C');
            $pdf->Cell(60,7,utf8_decode(''.$proveedor8),'1','0','C');
            $pdf->Cell(30,7,utf8_decode(''.$proyecto8),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_compras8),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_gerencia8),'1','0','C');
            $pdf->Cell(17,7,utf8_decode($row['carta_porte8']),'1','0','C');
            $pdf->Cell(12,7,utf8_decode($row['factura8']),'1','0','C');
            $pdf->Cell(27,7,utf8_decode($row['no_recoleccion8']),'1','0','C');
            $pdf->Cell(30,7,utf8_decode($row['observaciones8']),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
			$pdf->Ln(7);

            if($row['tipo9'] == 'avisos_ordinarios' || $row['tipo9'] == 'avisos_rg' || $row['tipo9'] == 'solicitudes_anticipo'){
                $tabla = $row['tipo9'];
                $qa9 = "SELECT * FROM $tabla WHERE folio='".$row['folio_ac9']."'";	
                $ra9=mysql_query($qa9,$conexion) or die("Error: ".mysql_error());

                if (!$ra9)
                {
                    printf("Errormessage: %s\n", mysql_error($conexion));
                }
                else
                {
                    while($rowa9 =mysql_fetch_array($ra9)) 
                    {
                        $proveedor9 = $rowa9['proveedor'];
                        $proyecto9 = $rowa9['proyecto'];
                        $folio_compras9 = $rowa9['folio_compras'];
                        $folio_gerencia9 = $rowa9['folio_gerencia'];
                    }
                }
            }

            $pdf->Cell(10);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(6,7,utf8_decode('9'),'1','0','C');
            $pdf->Cell(60,7,utf8_decode(''.$proveedor9),'1','0','C');
            $pdf->Cell(30,7,utf8_decode(''.$proyecto9),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_compras9),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_gerencia9),'1','0','C');
            $pdf->Cell(17,7,utf8_decode($row['carta_porte9']),'1','0','C');
            $pdf->Cell(12,7,utf8_decode($row['factura9']),'1','0','C');
            $pdf->Cell(27,7,utf8_decode($row['no_recoleccion9']),'1','0','C');
            $pdf->Cell(30,7,utf8_decode($row['observaciones9']),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
			$pdf->Ln(7);

            if($row['tipo10'] == 'avisos_ordinarios' || $row['tipo10'] == 'avisos_rg' || $row['tipo10'] == 'solicitudes_anticipo'){
                $tabla = $row['tipo10'];
                $qa10 = "SELECT * FROM $tabla WHERE folio='".$row['folio_ac10']."'";	
                $ra10=mysql_query($qa10,$conexion) or die("Error: ".mysql_error());

                if (!$ra10)
                {
                    printf("Errormessage: %s\n", mysql_error($conexion));
                }
                else
                {
                    while($rowa10 =mysql_fetch_array($ra10)) 
                    {
                        $proveedor10 = $rowa10['proveedor'];
                        $proyecto10 = $rowa10['proyecto'];
                        $folio_compras10 = $rowa10['folio_compras'];
                        $folio_gerencia10 = $rowa10['folio_gerencia'];
                    }
                }
            }

            $pdf->Cell(10);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(6,7,utf8_decode('10'),'1','0','C');
            $pdf->Cell(60,7,utf8_decode(''.$proveedor10),'1','0','C');
            $pdf->Cell(30,7,utf8_decode(''.$proyecto10),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_compras10),'1','0','C');
            $pdf->Cell(22,7,utf8_decode(''.$folio_gerencia10),'1','0','C');
            $pdf->Cell(17,7,utf8_decode($row['carta_porte10']),'1','0','C');
            $pdf->Cell(12,7,utf8_decode($row['factura10']),'1','0','C');
            $pdf->Cell(27,7,utf8_decode($row['no_recoleccion10']),'1','0','C');
            $pdf->Cell(30,7,utf8_decode($row['observaciones10']),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
            $pdf->Cell(16,7,utf8_decode(''),'1','0','C');
			$pdf->Ln(10);
			

			//firma
			$pdf->Ln(15);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(75);
			$pdf->Cell(70,7,utf8_decode('Autorizó'),'0','0','C');
            $pdf->Cell(70,7,utf8_decode('Enterado'),'0','0','C');
            $pdf->Ln(5);
			$pdf->Cell(75);
			$pdf->Cell(70,7,utf8_decode('Ing. Airam Alonso Ramírez Roldan'),'0','0','C');
            $pdf->Cell(70,7,utf8_decode($row['chofer']),'0','0','C');
			$pdf->Ln(5);
			$pdf->Cell(75);
			$pdf->Cell(70,7,utf8_decode('Jefe de Inventarios'),'0','0','C');
            $pdf->Cell(70,7,utf8_decode('Chofer'),'0','0','C');
			$pdf->Output();																
		}
	}
	$pdf->Output();
?>