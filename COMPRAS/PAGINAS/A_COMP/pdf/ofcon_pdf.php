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
$query = "SELECT * FROM oficios_contratos WHERE id='" . $id_f . "'";
$resultado = mysql_query($query, $conexion) or die("Error: " . mysql_error());

if (!$resultado) {
    printf("Errormessage: %s\n", mysql_error($conexion));
} else {
    while ($row = mysql_fetch_array($resultado)) {
        $no_contrato = $row['folio'];
        $tipo_contrato = $row['tipo'];

        if ($tipo_contrato == "Compra Venta") {
            class PDF extends FPDF
            {
                function Header()
                {
                    $est = $_GET['est'];
                    if ($est == 'Cancelado') {
                        $im = '../../../img/membrete_blanco_cancelado.jpg';
                    } else {
                        $im = '../../../img/membrete_blanco.jpg';
                    }
                    $this->Image($im, 0, 0, 215);
                    $this->SetFont('Arial', '', 11);
                    $this->Ln(25);
                    $this->Cell(12);
                    $this->Cell(170, 10, utf8_decode('CONTRATO DE COMPRAVENTA'), 0, 0, 'C');
                    $this->Ln(10);
                    $this->Cell(184, 10, utf8_decode('Contrato No. ' . $GLOBALS['no_contrato']), 0, 0, 'R');
                }
            }

            $pdf = new PDF('p', 'mm', 'Letter');
            $pdf->SetTopMargin(10);
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFillColor(232, 232, 232);
            $pdf->Ln(15);
            $pdf->SetFont('Arial', '', 10);

            //datos empresa
            $query_e = "SELECT * FROM empresas WHERE razon_social='" . $row['empresa'] . "'";
            $resultado_e = mysql_query($query_e, $conexion) or die("Error: " . mysql_error());

            if (!$resultado_e) {
                printf("Errormessage: %s\n", mysql_error($conexion));
            } else {
                while ($rowe = mysql_fetch_array($resultado_e)) {
                    $rfc_empresa = $rowe['rfc'];
                }
            }
            //datos proveedor
            $query_p = "SELECT * FROM proveedores WHERE razon_social='" . $row['proveedor'] . "'";
            $resultado_p = mysql_query($query_p, $conexion) or die("Error: " . mysql_error());

            if (!$resultado_p) {
                printf("Errormessage: %s\n", mysql_error($conexion));
            } else {
                while ($rowp = mysql_fetch_array($resultado_p)) {
                    $rfc_proveedor = $rowp['rfc'];
                    $domicilio_proveedor = $rowp['direccion'];
                }
            }
            //formato de fecha de firma
            $splitTimeStamp = explode("-", $row['fecha_firma']);

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

            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Contrato de compraventa de productos que establece los términos y condiciones que celebran por una parte ' . $row['empresa'] . ', con RFC ' . $rfc_empresa . ', con domicilio en calle Benemérito de las Américas, # 137, colonia López Mateos, Sombrerete, Zacatecas, C. P. 99102, en su carácter de cliente y por otra parte ' . $row['proveedor'] . ' como proveedor de servicio, con RFC ' . $rfc_proveedor . ', con domicilio en ' . $domicilio_proveedor . '.'), 0);
            $pdf->Ln(5);

            //cuerpo
            $pdf->Cell(12);
            $pdf->Cell(170, 5, utf8_decode('C L Á U S U L A S'), '0', '0', 'C');
            $pdf->Ln(10);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('PRIMERA. El proveedor se obliga a la entrega de ' . $row['productos'] . ' propiedad del cliente, con un monto total de ' . $row['monto_total'] . ' que incluye IVA del ' . $row['iva'] . ' %.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('SEGUNDA. El cliente se obliga a pagar mediante transferencia el monto de ' . $row['factura'] . ' de ' . $row['monto'] . ' correspondiente al ' . $row['porcentaje'] . '% solicitado por el proveedor, con folio de factura ' . $row['folio_factura'] . ', acordando que el resto se pagará ' . $row['resto_pagara'] . '.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('TERCERA. La entrega de los productos será el dia ' . $row['fecha_entrega'] . '.'), 0);
            if ($row['factura'] == "Anticipo") {
                $pdf->Ln(3);
                $pdf->Cell(12);
                $pdf->MultiCell(170, 5, utf8_decode('CUARTA. Se establece como garantía de entrega en la fecha estipulada en su totalidad los productos o servicios del presente contrato, en caso de no cumplir en la fecha se debe notificar al cliente con ' . $row['notificacion'] . ' días hábiles de anticipación para su conocimiento, y así aplicar un descuento del ' . $row['descuento'] . '% del monto a depositar en el último pago del presente contrato, una vez entregado el producto y/o servicio, esto manejándose como descuento. En caso de afectar la operación de la obra se procederá a realizar un anexo al contrato.'), 0);
                $pdf->Ln(3);
                $pdf->Cell(12);
                $pdf->MultiCell(170, 5, utf8_decode('QUINTA. El vendedor debe pagar los gastos de aquellas operaciones de verificación, comprobar la calidad de la mercancía, medida, peso y recuento.'));
                $pdf->Ln(3);
                $pdf->Cell(12);
                $pdf->MultiCell(170, 5, utf8_decode('SEXTA. En caso de no cumplir con la fecha estipulada en el anexo al contrato, se procede a rescindir el contrato establecido, obligándose al proveedor a regresar al 100% el monto transferido.'));
            }
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('El presente contrato se firma de conformidad, por el ambas partes comprometiéndose cada una de ellas a cumplirlo cabalmente, el dia ' . $d . ' de ' . $mes . ' de ' . $a . ' en la cuidad de Sombrerete, Zacatecas'), 0);
            $pdf->Ln(5);

            //firmas
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(12);
            $pdf->Cell(85, 7, utf8_decode($row['proveedor']), '0', '0', 'C');
            $pdf->Cell(85, 7, utf8_decode('Ing. Raquel Grijalva Álvarez'), '0', '0', 'C');
            $pdf->Ln(7);
            $pdf->Cell(12);
            $pdf->Cell(85, 7, utf8_decode('Proveedor'), '0', '0', 'C');
            $pdf->Cell(85, 7, utf8_decode($row['empresa']), '0', '0', 'C');
            $pdf->Ln(7);
            $pdf->Cell(97);
            $pdf->Cell(85, 7, utf8_decode('Cliente'), '0', '0', 'C');
            $pdf->Output();
        } else if ($row['tipo'] == "REPSE") {
            class PDF extends FPDF
            {
                function Header()
                {
                    $this->Image('../../../img/membrete_blanco.jpg', 0, 0, 215);
                    $this->SetFont('Arial', '', 11);
                    $this->Ln(25);
                }
            }

            $pdf = new PDF('p', 'mm', 'Letter');
            $pdf->SetTopMargin(10);
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFillColor(232, 232, 232);
            $pdf->Cell(12);
            $pdf->Cell(170, 10, utf8_decode('CONTRATO REPSE'), 0, 0, 'C');
            $pdf->Ln(10);
            $pdf->Cell(184, 10, utf8_decode('Contrato No. ' . $GLOBALS['no_contrato']), 0, 0, 'R');
            $pdf->Ln(15);

            //datos empresa
            $query_e = "SELECT * FROM empresas WHERE razon_social='" . $row['empresa'] . "'";
            $resultado_e = mysql_query($query_e, $conexion) or die("Error: " . mysql_error());

            if (!$resultado_e) {
                printf("Errormessage: %s\n", mysql_error($conexion));
            } else {
                while ($rowe = mysql_fetch_array($resultado_e)) {
                    $rfc_empresa = $rowe['rfc'];
                }
            }
            //datos proveedor
            $query_p = "SELECT * FROM proveedores WHERE razon_social='" . $row['proveedor'] . "'";
            $resultado_p = mysql_query($query_p, $conexion) or die("Error: " . mysql_error());

            if (!$resultado_p) {
                printf("Errormessage: %s\n", mysql_error($conexion));
            } else {
                while ($rowp = mysql_fetch_array($resultado_p)) {
                    $rfc_proveedor = $rowp['rfc'];
                    $domicilio_proveedor = $rowp['direccion'];
                    $tel_proveedor = $rowp['telefono'];
                    $correo_proveedor = $rowp['correo'];
                }
            }
            //formato de fecha de firma
            $splitTimeStampi = explode("-", $row['fecha_inicio']);
            $splitTimeStamp = explode("-", $row['fecha_termino']);
            $splitTimeStampf = explode("-", $row['fecha_firma']);

            $di = $splitTimeStampi[2];
            $mi = $splitTimeStampi[1];
            $ai = $splitTimeStampi[0];

            $d = $splitTimeStamp[2];
            $m = $splitTimeStamp[1];
            $a = $splitTimeStamp[0];

            $df = $splitTimeStampf[2];
            $mf = $splitTimeStampf[1];
            $af = $splitTimeStampf[0];

            switch ($mi) {
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
            switch ($mf) {
                case '01':
                    $mesf = "Enero";
                    break;
                case '02':
                    $mesf = "Febrero";
                    break;
                case '03':
                    $mesf = "Marzo";
                    break;
                case '04':
                    $mesf = "Abril";
                    break;
                case '05':
                    $mesf = "Mayo";
                    break;
                case '06':
                    $mesf = "Junio";
                    break;
                case '07':
                    $mesf = "Julio";
                    break;
                case '08':
                    $mesf = "Agosto";
                    break;
                case '09':
                    $mesf = "Septiembre";
                    break;
                case '10':
                    $mesf = "Octubre";
                    break;
                case '11':
                    $mesf = "Noviembre";
                    break;
                case '12':
                    $mesf = "Diciembre";
                    break;
            }

            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Contrato de presentación de servicios que celebran, por una parte, ' . $row['empresa'] . ' (en lo sucesivo "EL CONTRATANTE"), representada en este acto como Gerente de compras Raquel Grijalva Álvarez y por otra parte, ' . $row['proveedor'] . ' (en lo sucesivo "EL CONTRATISTA"), al tenor de las siguientes declaraciones y cláusulas:'), 0);
            $pdf->Ln(5);

            //cuerpo
            $pdf->Cell(12);
            $pdf->Cell(170, 5, utf8_decode('D E C L A R A C I O N E S'), '0', '0', 'C');
            $pdf->Ln(10);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('I.   Declara EL CONTRATANTE, que:'), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('a)	Su clave de Registro Federal de Contribuyentes es ' . $rfc_empresa . '.'), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('b)	Su domicilio fiscal es el ubicado en Calle Benemérito de las Américas No 137. Col: Lopez Mateos, Sombrerete, Zacatecas.'), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('c)	Requiere que EL CONTRATISTA, le preste los servicios que se describen en la cláusula primera de este contrato.'), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('d)	Objeto Social: ' . $row['ob_social_ctt'] . '.'), 0);
            $pdf->Ln(10);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('II.   Declara EL CONTRATISTA, que:'), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('a)	Identificado con su credencial de elector No. ' . $row['identificacion'] . '.'), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('b)	Dentro de su objeto social se encuentran, entre otras actividades ' . $row['ob_social_cts'] . '.'), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('c)	Su clave de Registro Federal de Contribuyentes es ' . $rfc_proveedor . '.'), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('d)	Número de Registro de Prestadoras de Servicios Especializados y obras Especializadas ' . $row['repse'] . '.'), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('e)	Folio que contiene la actividad u obra especializada de ' . $row['folio_actividad'] . ', Actividad: ' . $row['actividad'] . '.'), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('f)	Su domicilio fiscal es el ubicado en ' . $domicilio_proveedor . '.'), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('g)	Teléfono de contacto es: ' . $tel_proveedor . ''), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('h)	Correo electrónico: ' . $correo_proveedor . ''), 0);
            $pdf->Ln(10);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('III.  Declaran EL CONTRATANTE y EL CONTRATISTA, en adelante "LAS PARTES" que:'), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('a)	Se reconocen mutuamente la personalidad con la que comparecen a la celebración del presente contrato.'), 0);
            $pdf->Cell(18);
            $pdf->MultiCell(164, 5, utf8_decode('b)	Es su deseo celebrar el presente contrato por así convenir a sus respectivos intereses.'), 0);
            $pdf->Ln(10);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Expuestas las Declaración precedentes, LAS PARTES convienen en otorgar las siguientes:'), 0);
            $pdf->Ln(10);
            $pdf->Cell(12);
            $pdf->Cell(170, 5, utf8_decode('C L Á U S U L A S'), '0', '0', 'C');
            $pdf->Ln(10);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('PRIMERA. OBJETO DEL CONTRATO.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('EL CONTRATISTA se obliga a realizar a favor de EL CONTRATANTE, el consistente en ' . $row['actividad_realizar'] . ' En lo sucesivo y para todos los efectos del presente contrato, a los servicios descritos en esta cláusula se les denominará simplemente como LOS SERVICIOS.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('SEGUNDA. PLAZO DEL CONTRATO.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('El presente contrato tendrá una vigencia por ' . $row['vigencia'] . ' contratados a partir de la firma del presente contrato, es decir, el contrato iniciará su vigencia del día ' . $di . ' de ' . $mesi . ' de ' . $ai . ' terminará el día ' . $d . ' de ' . $mes . ' de ' . $a . '. Dicha vigencia podrá ser prorrogada siempre que EL CONTRATANTE lo solicite por escrito a EL CONTRATISTA.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('TERCERA. CONTRAPRESTACIÓN. Los servicios prestados son:'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('' . $row['servicio_prestado'] . ' EL CONTRATANTE pagara a EL CONTRATISTA por la prestación de LOS SERVICIOS la cantidad total de:'), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Precio: ' . $row['precio']), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('IV.A.: ' . $row['iva']), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Total: ' . $row['total']), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode($row['observaciones']), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('CUARTA. CONDICIONES DE PAGO.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('El pago de LOS SERVICIOS ejecutado se realizará dentro de los ' . $row['pago_servicio'] . ', contados a partir de que EL CONTRATANTE reciba la factura que refleje LOS SERVICIOS prestados, debiendo cumplir dicha factura con los requisitos fiscales que establecen o establezcan las leyes de la materia.'), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Toda factura deberá llenarse con la siguiente información: ' . $row['empresa'] . ', y el registro Federal de contribuyentes ' . $rfc_empresa . ' y ser enviada a la siguiente dirección de correo electrónico: 
                '), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode($row['correos_contacto']), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('El pago de la contraprestación se realizará por medio de transferencia electrónica en la cuenta bancaria que para tal efecto señale EL CONTRATISTA'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('QUINTA. OBLIGACIONES LABORALES DE EL CONTRATISTA.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('EL CONTRATISTA se obliga bajo su más estricta responsabilidad, a poner a EL CONTRATANTE, así como a cualquiera de sus subsidiarias y afiliadas, en un plazo máximo de cuatro meses, libre y a salvo de cualquier reclamación relacionada con la Ley Federal del Trabajo; la Ley del Seguro Social; la Legislación del INFONAVIT o cualquier otta disposición legal vigente en la cual se encuentre involucrada la persona o personas físicas que bajo su dependencia y subordinación, ejecuten LOS SERVICIOS objeto del presente contrato, ya que no existirá de ninguna manera relación individual de trabajo; contrato individual de trabajo; subordinación jurídica, ni vínculo alguno de derecho laboral entre EL CONTRATANTE, sus subsidiarias y afiladas y la persona o personas físicas que ejecuten LOS SERVICIOS objeto del presente contrato; por lo mismo, queda expresamente establecido que dicha persona o personas físicas son trabajadores exclusivo al servicio y subordinación de EL CONTRATISTA y por ello la totalidad de los sueldos o salarios, prestaciones laborales y demás prestaciones o indemnizaciones a que esta persona o personas físicas tuvieren derecho, serán responsabilidad única y exclusivamente de EL CONTRATISTA quien será el único patrón y el único responsable frente a la persona o personas físicas mencionadas, toda vez que cuenta con elementos propios y suficientes para realizar el objeto del presente contrato y hacer frente a las obligaciones laborales que pudiese llegar a tener derivadas de la celebración de este instrumento.'), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('EL CONTRATISTA se obliga a cumplir puntualmente con las obligaciones a su cargo, derivadas de los ordenamientos legales anteriormente citados, asimismo se obliga a mantener afiliados a sus trabajadores ante el Instituto Mexicano del Seguro Social, desde antes de que empiece la ejecución de LOS SERVICIOS objeto del presente contrato, y a q mantenerlos durante todo el tiempo que dure el presente contrato, con derechos vigentes en el Régimen Obligatorio de Seguridad Social, cotizando con los salarios reales, obligándose a demostrar lo anterior con la entrega de la documentación respectiva a solicitud verbal o por escrito de EL CONTRATANTE, quien tendrá derecho a recibir de forma electrónica o impresa dicha documentación en el momento y bajo las condiciones que lo requiera. La violación a lo aquí dispuesto es causa de rescisión inmediata de este contrato.'), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Acuerdan LAS PARTES que el plazo establecido en el primer párrafo de la presente clausula podrá ser prorrogado a juicio de EL CONTRATANTE.'), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('En ningún momento EL CONTRATANTE, sus subsidiarias, afiliadas o alguno de sus representantes dará ordenes o instrucciones de trabajo a los trabajadores al servicio y subordinación de EL CONTRATISTA y por ello en ningún momento existirá subordinación jurídica, relación de trabajo, contrato de trabajo ni vínculo alguno de derecho laboral entre EL CONTRATANTE, sus subsidiaria y afiliadas y los trabajadores de EL CONTRATISTA, por ello la totalidad de sus sueldos o salarios, prestaciones laborales y demás prestaciones o indemnizaciones a que esta persona o personas físicas tuvieren derecho serán responsabilidad única y exclusiva de EL CONTRATISTA.'), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('En caso de que, eventualmente por un litigio o cualquier procedimiento contencioso administrativo, donde fuera involucrado EL CONTRATANTE que le imponga una condena económica o sanción administrativa derivada de cualquier reclamación de los trabajadores de EL CONTRATISTA con los que ejecute los servicios contratados objeto del presente contrato, EL CONTRATISTA se obliga a cubrir cualquier cantidad en dinero y resarcir económicamente el daño en su totalidad, que se generaré o que se le imponga a EL CONTRATANTE, además de pagar los costos que por honorarios por abogados, asesores, gestores y cualquier otro que realice EL CONTRATANTE para su adecuada defensa.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('SEXTA. OBLIGACIONES FISCALES DE LS PARTES.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('LAS PARTES se obligan a cumplir puntualmente con las obligaciones a su cargo derivadas de los ordenamientos fiscales vinculados con el presente contrato. En virtud de lo anterior, EL CONTRATISTA autoriza a EL CONTRATANTE a realizar todas las retenciones que, por cualquier impuesto federal, estatal o municipal, como es el caso de los aplicables conforme a la Ley de pago de la contraprestación por LOS SERVICIOS. Asimismo EL CONTRATANTE se obliga a entregar a EL CONTRATISTA, en términos de las disposiciones fiscales aplicables, lo comprobantes de dichas retenciones.'), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('En caso de que EL CONTRATISTA aparezca en la publicación emitida por el Servicio de Administración Tributaria en términos del artículo 69 del Código Fiscal de la Federación EL CONTRATANTE retendrá los pagos pendientes por la prestación de LOS SERVICIOS; hasta en tanto EL CONTRATISTA no haya resuelto su situación fiscal y el Servicio de Administración Tributaria lo elimine de la lista en la que fue publicado.'), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Por su parte, en caso de que EL CONTRATISTA sea señalado en cualquiera de las publicaciones emitidas por el Servicio de Administración Tributaria en términos del artículo 69-B del Código Fiscal de la Federación:'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('a)	EL CONTRATANTE podrá dar por terminado el presente contrato sin responsabilidad para éste, bastando notificación por escrito a EL CONTRATISTA y retendrá todos los pagos pendientes que se hubieran generado por la prestación de LOS SERVICIOS, hasta en tanto EL CONTRATISTA no haya resuelto su situación fiscal y el Servicio de Administración Tributaria publique su nombre o denominación social en el listado de contribuyentes que desvirtuaron la presunción de inexistencia de operaciones, en el Diario Oficial de la Federación o, en su caso, emita un oficio en donde considera que los montos pagados por EL CONTRATANTE a EL CONTRATISTA, cumplen todos los requisitos fiscales para que se consideren deducibles.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('b)	EL CONTRATISTA se obliga a entregar a EL CONTRATANTE toda la información que sea necesaria para que éste pueda demostrar, a satisfacción de la autoridad fiscal, la efectiva prestación de LOS SERVICIOS a fin de hacer deducible el monto pagado y/o acreditar el Impuesto al Valor Agregado pagado.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('c)	En caso de que la autoridad discal resuelva que no es deducible el monto pagado por LOS SERVICIOS y/o no acreditable el Impuesto al Valor Agregado pagado por el mismo concepto, EL CONTRATISTA se obliga a responder por los daños y perjuicios que genere a EL CONTRATANTE.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('SÉPTIMA. ENTREGA DE INFORMACIÓN FISCAL.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Con el objeto de poder comprobar la materialidad de LOS SERVICIOS que ampara el presente contrato, EL CONTRATISTA se obligara a entregar a EL CONTRATANTE la siguiente documentación, siendo esta solicitada mediante oficio:'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('a)	Los comprobantes fiscales de pago de salarios a sus trabajadores que hayan realizado LOS SERVICIOS, debiendo cuidar que dichos comprobantes cuenten con los requisitos fiscales que establecen las disposiciones fiscales y con el RFC de EL CONTRATISTA en su carácter de emisor.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('b)	Los acuses de recibo de los citados comprobantes fiscales de los trabajadores de EL CONTRATISTA.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('c)	La declaración de entero de las retenciones de impuesto efectuadas a dichos trabajadores.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('d)	Los comprobantes de pago al Instituto Mexicano del Seguro Social de las cuotas obrero-patronales.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('La entrega de la documentación antes mencionada será de forma electrónica y/o de cualquier otra forma que EL CONTRATANTE le requiera de manera verbal o por escrito a EL CONTRATISTA.'), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('LAS PARTES acuerdan que ante cualquier requerimiento del Servicio de Administración Tributaria a EL CONTRATANTE en relación con LOS SERVICIOS que ampara este contrato. EL CONTRATISTA se obliga a proporcionarle a EL CONTRATANTE de forma inmediata, cualquier informacion o documentación que sea necesaria y/o suficiente para cumplir con dicho requerimiento.'), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Adicionalmente se requerirá que EL CONTRATANTE solicitará información a EL CONTRATISTA en base a lo señalado en el párrafo primero de la fracción II, del Fundamento legar Articulo 5º. De la Ley del impuesto al valor Agregado, , cuando se trate de servicios especializados o de la ejecución de obras especializadas a que se refiere el Artículo 15-D, tercer párrafo del Código Fiscal de la Federación, cuando se efectué el pago de la contraprestación por el servicio recibido, el contratante deberá verificar que el contratista cuente con el registro a que se refiere el articulo 15 de la Ley Federal del Trabajo, asimismo., deberá obtener del contratista copia de la declaración del impuesto al valor agregado y acuse de recibo del pago correspondiente al periodo en que el contratant6e efectuó el pago de la contraprestación y del impuesto al valor agregado que le fue trasladado. A su vez, el contratista estará obligado a proporcional al contratante copia de la documentación mencionada, la cual deberá entregarse a más tardar el ultimo día del mes siguiente a aquel en el que el contratante haya efectuado el pago de la contraprestación por el servicio recibido y el impuesto al valor agregado a que se refiere esta fracción ene le plazo señalado, deberá presentar declaración complementaria en la cual disminuya los montos que hubiera acreditado por dicho concepto.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('OCTAVA. TERMINACIÓN.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('EL CONTRATANTE se reserva la facultad de dar por terminado anticipadamente el presente contrato en cualquier tiempo, de forma unilateral, por así convenir a sus intereses, sin necesidad de recabar y obtener el consentimiento o autorización de la otra parte y sin necesidad de obtener resolución de los tribunales; bastando con notificación por escrito que sea entregada a EL CONTRATISTA con ' . $row['terminacion'] . ', en el entendido de que en tal supuesto, la única responsabilidad a cargo de EL CONTRATANTE será el pago de LOS SERVICIOS efectivamente prestados hasta la fecha de terminación señalada en la notificación a que se refiere esta cláusula.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('NOVENA. CONTACTOS, DOMICILIOS Y NOTIFICACIONES.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Con el propósito de facilitar la comunicación de LAS PARTES, en virtud del presente contrato, las personas que se mencionan a continuación serán los contactos entre LAS PARTES, en el entendido de que LAS PARTES podrán designar, en su caso, a otras personas que las sustituyan, debiendo dar aviso por escrito a la otra parte en los términos del presente contrato. Asimismo, todas las notificación que deban hacerse LAS PARTES en relación con el presente contrato, serán por escrito, dirigidas a los domicilios que igualmente se señalan a continuación y entregadas personalmente o por correo certificado con acuse de recibo.'), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Por EL CONTRATANTE:'), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode($row['contacto_contratante']), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Por EL CONTRATISTA:'), 0);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode($row['proveedor']), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('En el caso de que alguna de LAS PARTES cambie su domicilio deberá notificarlo por escrito a la otra parte con anticipación de 15 (quince) días calendario; en caso contrario, la notificación se tendrá por hecha si es entregada en el domicilio que aparece en las declaraciones del presente Contrato.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('DÉCIMA. LEYES APLICABLES Y JURISDICCIÓN.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Este contrato se celebra al amparo del código de comercio, código civil Federal y demás ordenamientos aplicables, por lo mismo para todo aquello que no se encuentre expresamente pactado en el presente contrato. LAS PARTES estarán a las disposiciones de los referidos ordenamientos, en cuanto resulten aplicables y para el caso de conflicto relacionado con la validez, interpretación, cumplimiento o ejecución del presente contrato, LAS PARTES se someten a la jurisdicción de los tribunales competentes de la ciudad Sombrerete, Zacatecas renunciando expresamente a cualquier otro fuero o jurisdicción que por razón de domicilio presente o futuro, pudiera corresponderles.'), 0);
            $pdf->Ln(3);
            $pdf->Cell(12);
            $pdf->MultiCell(170, 5, utf8_decode('Una vez leído el presente contrato por LAS PARTES y enteradas del contenido y alcance legal de todas y cada una de las cláusulas que lo componen y sus respectivos anexos, declaran que no existen vicios del consentimiento que pudieren invalidad o nulificarlo y lo firman de conformidad el día ' . $df . ' de ' . $mesf . ' de ' . $af . ' en la ciudad de Sombrerete, Zacatecas.'), 0);
            $pdf->Ln(5);

            //firmas
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(12);
            $pdf->Cell(85, 7, utf8_decode($row['proveedor']), '0', '0', 'C');
            $pdf->Cell(85, 7, utf8_decode('Ing. Raquel Grijalva Álvarez'), '0', '0', 'C');
            $pdf->Ln(7);
            $pdf->Cell(12);
            $pdf->Cell(85, 7, utf8_decode('CONTRATISTA'), '0', '0', 'C');
            $pdf->Cell(85, 7, utf8_decode($row['empresa']), '0', '0', 'C');
            $pdf->Ln(7);
            $pdf->Cell(97);
            $pdf->Cell(85, 7, utf8_decode('CONTRATANTE'), '0', '0', 'C');
            $pdf->Ln(35);
            $pdf->Cell(12);
            $pdf->Cell(85, 7, utf8_decode('TESTIGO'), '0', '0', 'C');
            $pdf->Cell(85, 7, utf8_decode($row['contacto_contratante']), '0', '0', 'C');
            $pdf->Ln(7);
            $pdf->Cell(97);
            $pdf->Cell(85, 7, utf8_decode('Coordinador de Compras'), '0', '0', 'C');
            $pdf->Ln(7);
            $pdf->Cell(97);
            $pdf->Cell(85, 7, utf8_decode('TESTIGO'), '0', '0', 'C');
            $pdf->Output();
        }
    }
}
