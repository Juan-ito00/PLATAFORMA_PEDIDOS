<?php
session_start();
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario'])) {
  header('Location: ../../index');
  exit();
}
include("../../conexion/conexion.php");
$conexion = Conectarse();

use PHPMailer\PHPMailer\PHPMailer;

require_once('../../autoload.php');

$supervisor_nom = $_GET['supervisor'];
$lugar = $_GET['lugar'];
$id_pedido = $_GET['id_pedido'];

mysql_query("SET NAMES 'utf8'");
$query = "UPDATE pedidos SET enviado='Enviado', estado='Enviado' WHERE id_pedido='" . $id_pedido . "' AND gerencia='GF'";
$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

echo "<script languaje='javascript'>
					alert('¡Se ha enviado el pedido!')
	location.href='historial_gen?id=tw_redireccion';
				</script>";

$mail = new PHPMailer();
$mail->IsSMTP();
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
$mail->Username = "soporte@grupocavi.com.mx";
$mail->Password = "e@r0)_H2C@s{";

$mail->setFrom('soporte@grupocavi.com.mx', 'SISTEMA DE PEDIDOS');

if ($lugar == "Activo Fijo") {
  $nom_compras = "Diana Acevedo";
  $mailto = "claudia_ibarra@grupocavi.com.mx";
  $mailcc = "claudia_ibarra@grupocavi.com.mx";
} else if ($lugar == "Compras") {
  $nom_compras = "Raquel Grijalva";
  $mailto = "compras@grupocavi.com.mx";
  $mailcc = "raquel_grijalva@grupocavi.com.mx";
} else {
  echo "No hay destinatario.";
}
$mail->AddAddress($mailto);

$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Nuevo Pedido";
$mail->Body = "<h3>|  NUEVO PEDIDO  |</h3><br><p>Estimado (a) " . $nom_compras . ":</p><p>Te informamos que has recibido un nuevo pedido enviado por: " . $supervisor_nom . ".</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
    	Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
$mail->AddCC($mailcc);

if (!$mail->Send()) {
  echo "Fallo";
} else {
  echo "Éxito";
}
