<?php
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']) && !isset($_SESSION['correo']))
	{
		header('Location: ../../index');
		exit();
	}
  	include("../../conexion/conexion.php"); 
  	$conexion=Conectarse();

  	use PHPMailer\PHPMailer\PHPMailer;
  	require_once('../../autoload.php');

    $id_sol = $_GET['folio']; 

   mysql_query("SET NAMES 'utf8'");
    $result2 = mysql_query("SELECT * FROM sol_cotizaciones WHERE id='$id_sol'");

        while($row2 = mysql_fetch_array($result2))
        {
            $prov = $row2['proveedor'];
        }
    $result = mysql_query("SELECT * FROM proveedores WHERE razon_social='$prov'");

        while($rowS = mysql_fetch_array($result))
        {
            $mail_prov = $rowS['agente_ventas'];
        }

    $mail = new PHPMailer();
    //$mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl"; 
    $mail->Host = "mut.hosting-mexico.net";
    $mail->Port       = 465;
    $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        ); 
    
    if($_SESSION['correo'] == "monserrat_villegas@grupocavi.com.mx") {
        $pw_sender = "cjdc72;Jik;K";
        $firma = "../../../../FIRMAS/monserrat villegas.png";
    }
    else if($_SESSION['correo'] == "guadalupe_castaneda@grupocavi.com.mx") {
        $pw_sender = "[TZ0Sf;Zp75j";
        $firma = "../../../../FIRMAS/guadalupe castaneda.png";
    }
    else if($_SESSION['correo'] == "jose_quintero@grupocavi.com.mx") {
        $pw_sender = "Zhd)_j[R&UKu";
        $firma = "../../../../FIRMAS/jose quintero.png";
    }
    $ml_sender = $_SESSION['correo'];

    $mail->Username = $ml_sender;
    $mail->Password = $pw_sender;

    $mail->setFrom($ml_sender, 'COTIZACIÓN');

	
    $mailto = $mail_prov;
    $mailcc = $ml_sender;
  	       
    $mail->AddAddress($mailto);

    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = "COMPRAS GRUPO CAVI | Solicitud de Cotización";
    $mail->AddEmbeddedImage($firma, 'firma');
    $mail->Body = "<h3>|  SOLICITUD DE COTIZACIÓN  |</h3><br><p>Estimado proveedor: ".$prov."</p><p>Adjunto encontrará una nueva solicitud de cotización de una subsidiaria de Grupo Cavi.</p><p>Les solicitamos atentamente acusar recibo de este mensaje indicando la fecha en que nos enviarán su cotización.</p><p>¡Saludos!</p><img src='cid:firma' /><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
					Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
    $mail->AddCC($mailcc);
    $mail->AddAttachment('pdf/cotizaciones/cotizacion'.$id_sol.'.pdf', 'cotizacion'.$id_sol.'.pdf');

    if(!$mail->Send())
    {
      echo "Fallo";
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    else 
    {
      ?>
        <script language="javascript">
        alert("Enviado");
        location.href="sol_cotizaciones_historial.php";
        </script>
        <?php
    }
?>