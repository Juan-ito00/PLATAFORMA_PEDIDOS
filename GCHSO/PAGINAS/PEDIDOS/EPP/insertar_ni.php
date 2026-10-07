<?php
date_default_timezone_set("Mexico/General");
session_start();
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario'])) {
	header('Location: ../../../index');
	exit();
}
include("../../../conexion/conexion.php");
$conexion = Conectarse();

use PHPMailer\PHPMailer\PHPMailer;

require_once('../../../autoload.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Insertar EPP</title>
	<!-- Bootstrap -->
	<link href="../../../css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
		.rojo {
			background-color: #FF0000;
		}

		.azul {
			color: #0066FF;
		}

		.verde {
			color: #009900;
		}

		select {
			background-color: #FF66FF;
		}

		.blue-distinct {
			color: #104e9d;
		}
	</style>
	<script type="text/javascript" src="../../../js/jquery.js"></script>
</head>

<body>
	<nav class="navbar navbar-inverse" role="navigation" style="background-color:#31456a;border-color:#31456a;">
		<p align="center" style="color: white; margin-top: 12px; font-size: 18px;">PEDIDOS EPP</p>
	</nav>
	<div class="container" style="padding-top: 1px;">
		<nav class="navbar navbar-default nav" style="margin-top:5px;" role="navigation">
			<div class="navbar-header">
				<a class="navbar-brand" href="../../inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Nuevo<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="nuevo_ni">Nuevo Ingreso</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="historial_ni">Nuevo Ingreso</a></li>
						</ul>
					</li>
					<li class="">
						<a href="reportes" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido " . ucwords($_SESSION['usuario']) . " | "; ?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
				</ul>
			</div>
		</nav>
		<div class="panel panel-default" style="margin-top: 5px;">
			<div align="center" class="panel-heading"><?php echo "Insertar Pedido"; ?></div>
			<div class="panel-body">
				<?php
				if ($_POST) {
					mysql_query("SET NAMES 'UTF8'");
					mysql_query("SET lc_time_names = 'es_MX'");

					$supervisor_sol = $_POST['supervisor_sol'];
					$motivo = $_POST['motivo'];
					$nombre = $_POST['nombre'];
					$obra = $_POST['obra'];
					$categoria = $_POST['categoria'];
					$talla_calzado = $_POST['talla_calzado'];
					$talla_camisa = $_POST['talla_camisa'];
					$talla_pantalon = $_POST['talla_pantalon'];
					$estatura = $_POST['estatura'];
					$peso = $_POST['peso'];
					$sup_int = $_POST['sup_int'];
					$observaciones_sup = $_POST["observaciones_sup"];

					$sql = "INSERT INTO epp_ni_folios SET idsdgg='0'";
					$result = mysql_query($sql) or die(mysql_error());
					$id = mysql_insert_id();
					$folio = strtoupper("SH-NI-REC-" . str_pad($id, 3, '0', STR_PAD_LEFT) . date("/ y"));

					$currentdate = new DateTime('now', new DateTimeZone('America/Mazatlan'));
					$date = $currentdate->format('Y-m-d');
					$time = $currentdate->format('H:i:s');
					$dayOfWeek = date("l", strtotime($date));

					$splitDate = explode('-', $date);
					$a = $splitDate[0];

					$sql = "INSERT INTO epp_ni(`year`,folio,`datef`,supervisor_sol,motivo,nombre,obra,puesto,
                        talla_calzado,talla_camisa,talla_pantalon,estatura,peso,sup_int,observaciones_sup) VALUES ('" . $a . "','" . $folio . "','" . $date . "','" . $supervisor_sol . "','" . $motivo . "',
                        '" . $nombre . "','" . $obra . "','" . $categoria . "',
                        '" . $talla_calzado . "','" . $talla_camisa . "','" . $talla_pantalon . "','" . $estatura . "','" . $peso . "',
                        '" . $sup_int . "','" . $observaciones_sup . "')";
					$result = mysql_query($sql) or die(mysql_error());


					$sql = "UPDATE epp_ni_folios SET folio='" . $folio . "' WHERE id='" . $id . "'";
					$result = mysql_query($sql) or die(mysql_error());
					echo "<br>";
					echo "<br>";
					echo "<script languaje='javascript'>
                            alert('Se ha enviado el pedido " . $folio . "')
                            location.href='historial_ni?id=tw_redireccion';
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
					$mail->setFrom('soporte@grupocavi.com.mx', 'PEDIDOS DE EPP');
					$mail->AddAddress('luis_segovia@grupocavi.com.mx');
					$mail->addCC("airam_ramirez@grupocavi.com.mx");

					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Sistema de Pedidos de EPP | GRUPO CAVI";
					$mail->Body = "<h2>|  Nuevo Pedido de EPP Nuevo Ingreso |</h2><br><p>Estimado encargado de Almacén:</p><p>Te informamos que tienes un nuevo pedido.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
					    	Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

					if (!$mail->Send()) {
						echo "Fallo";
					}
				?>
					<br>
					<br>
				<?php
				} else {
					$resultado = "ERROR DE PROCESO";
				}
				?>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../../../js/bootstrap.min.js"></script>
</body>

</html>