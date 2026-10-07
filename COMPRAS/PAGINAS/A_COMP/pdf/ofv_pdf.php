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

$id_f = $_GET['id_f'];
$query = "SELECT * FROM oficios_vacaciones WHERE id='" . $id_f . "'";
$resultado = mysql_query($query, $conexion) or die("Error: " . mysql_error());

if (!$resultado) {
    printf("Errormessage: %s\n", mysql_error($conexion));
} else {
    while ($row = mysql_fetch_array($resultado)) {
        $folio1 = $row['folio'];
        $date_f = $row['fecha'];

        class PDF extends FPDF
        {
            function Header()
            {
                $splitTimeStamp = explode("-", $GLOBALS['date_f']);
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

                $est = $_GET['est'];
                if ($est == 'Cancelado') {
                    $im = '../../../img/membrete_blanco_cancelado.jpg';
                } else {
                    $im = '../../../img/membrete_blanco.jpg';
                }
                $this->Image($im, 0, 0, 215);
                $this->SetFont('Arial', '', 11);
                $this->Ln(30);
                $this->Ln(-10);
                $this->Cell(40);
                $this->Cell(144, 10, utf8_decode('' . $GLOBALS['folio1']), 0, 0, 'R');
                $this->Ln(8);
                $this->Cell(184, 10, utf8_decode('Sombrerete, Zac., a ' . $d . ' de ' . $mes . ' de ' . $a . ''), 0, 0, 'R');
                $this->Ln(8);
                $this->Cell(184, 10, utf8_decode('Asunto: SOLICITUD DE VACACIONES'), 0, 0, 'R');
            }
        }
        $pdf = new PDF('p', 'mm', 'Letter');
        $pdf->SetTopMargin(10);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFillColor(232, 232, 232);
        $pdf->Ln(10);

        $pdf->Cell(12);
        $pdf->Cell(30, 7, utf8_decode('Atención:'), '0', 1, 'L');
        $pdf->Cell(12);
        $pdf->Cell(30, 7, utf8_decode($row['jefe_inmediato']), '0', 1, 'L');
        if ($row['jefe_inmediato'] != 'Ing. Raquel Grijalva Álvarez') {
            $pdf->Cell(12);
            $pdf->Cell(30, 7, utf8_decode('Ing. Raquel Grijalva Álvarez'), '0', 1, 'L');
        }
        $pdf->Cell(12);
        $pdf->Cell(30, 7, utf8_decode('Cc. Gerencia de Capital Humano'), '0', '0', 'L');
        $pdf->Ln(15);

        $splitTimeStamp2 = explode("-", $row['fecha_inicio']);
        $d2 = $splitTimeStamp2[2];
        $m2 = $splitTimeStamp2[1];
        $a2 = $splitTimeStamp2[0];

        switch ($m2) {
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

        $splitTimeStamp3 = explode("-", $row['fecha_termino']);
        $d3 = $splitTimeStamp3[2];
        $m3 = $splitTimeStamp3[1];
        $a3 = $splitTimeStamp3[0];

        switch ($m3) {
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

        $splitTimeStamp4 = explode("-", $row['fecha_regreso']);
        $d4 = $splitTimeStamp4[2];
        $m4 = $splitTimeStamp4[1];
        $a4 = $splitTimeStamp4[0];

        switch ($m4) {
            case '01':
                $mesr = "Enero";
                break;
            case '02':
                $mesr = "Febrero";
                break;
            case '03':
                $mesr = "Marzo";
                break;
            case '04':
                $mesr = "Abril";
                break;
            case '05':
                $mesr = "Mayo";
                break;
            case '06':
                $mesr = "Junio";
                break;
            case '07':
                $mesr = "Julio";
                break;
            case '08':
                $mesr = "Agosto";
                break;
            case '09':
                $mesr = "Septiembre";
                break;
            case '10':
                $mesr = "Octubre";
                break;
            case '11':
                $mesr = "Noviembre";
                break;
            case '12':
                $mesr = "Diciembre";
                break;
        }
        //cuerpo
        $pdf->Cell(12);
        $pdf->MultiCell(170, 7, utf8_decode('Por medio de la presente y con el debido respeto, me permito solicitarle mi ' . $row['periodo'] . ' período vacacional correspondiente a ' . $row['dias'] . ' DÍAS abarcando del ' . $d2 . ' de ' . $mesi . ' del ' . $a2 . ' al ' . $d3 . ' de ' . $mest . ' del ' . $a3 . '. Incorporándome a mis actividades el ' . $d4 . ' de ' . $mesr . ' del ' . $a4 . '.'), 0);
        $pdf->Ln(6);
        $pdf->Cell(12);
        $pdf->MultiCell(170, 7, utf8_decode('Informo con antelación, con base a la programación asignada en este año, y como respaldo de la circular 002-GCHSO/2023. Durante el período de ausencia queda en apoyo a mis funciones ' . $row['cargo1'] . ',' . $row['cargo2'] . '. Por lo que asuntos ya relacionados a mi persona, en mi regreso se están dando respuesta.'), 0);
        $pdf->Ln(6);
        $pdf->Cell(12);
        $pdf->MultiCell(170, 5, utf8_decode('Sin más por el momento y en espera de poder contar con su apoyo, ¡Saludos!'), 0);
        $pdf->Ln(10);
        $pdf->Cell(12);
        $pdf->MultiCell(170, 5, utf8_decode('Atentamente:'), 0);
        $pdf->Ln(15);
        $pdf->Cell(12);
        $pdf->Cell(30, 7, utf8_decode($row['solicitante']), '0', 1, 'L');
        //firmas
        $solicitante = $row['solicitante'];
        $query_c = "SELECT * FROM destinatarios WHERE nombre LIKE '%$solicitante%'";
        $resultado_c = mysql_query($query_c, $conexion) or die("Error: " . mysql_error());

        if (!$resultado_c) {
            printf("Errormessage: %s\n", mysql_error($conexion));
        } else {
            while ($row2 = mysql_fetch_array($resultado_c)) {
                $pdf->Cell(12);
                $pdf->Cell(70, 7, utf8_decode($row2['cargo']), '0', 1, 'L');
                $pdf->Cell(12);
                $pdf->Cell(70, 7, utf8_decode('Solicita'), '0', 1, 'L');
                $pdf->Ln(15);
            }
        }
        $pdf->Cell(12);
        $pdf->Cell(30, 7, utf8_decode($row['jefe_inmediato']), '0', 1, 'L');
        //firmas
        $query_j = "SELECT * FROM destinatarios WHERE nombre = '" . $row['jefe_inmediato'] . "'";
        $resultado_j = mysql_query($query_j, $conexion) or die("Error: " . mysql_error());

        if (!$resultado_j) {
            printf("Errormessage: %s\n", mysql_error($conexion));
        } else {
            while ($rowj = mysql_fetch_array($resultado_j)) {
                $pdf->Cell(12);
                $pdf->Cell(70, 7, utf8_decode($rowj['cargo']), '0', 1, 'L');
                $pdf->Cell(12);
                $pdf->Cell(70, 7, utf8_decode('Autoriza'), '0', 1, 'L');
                $pdf->Ln(10);
            }
        }
        $pdf->Output();
    }
}
$pdf->Output();
