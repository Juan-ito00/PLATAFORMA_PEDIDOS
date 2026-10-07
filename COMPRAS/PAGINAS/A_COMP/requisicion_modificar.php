<?php
date_default_timezone_set("Mexico/General");
session_start();
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario'])) {
	header('Location: ../../index');
	exit();
}
include("../../conexion/conexion.php");
$conexion = Conectarse();

use PHPMailer\PHPMailer\PHPMailer;

require_once('../../autoload.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Requisición Modificar</title>
	<!-- Bootstrap -->
	<link href="../../css/bootstrap.min.css" rel="stylesheet">
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
	</style>
	<script type="text/javascript" src="../../js/jquery.js"></script>
</head>

<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<p align="center" style="color: white; margin-top: 12px; font-size: 18px;">SISTEMA DE PEDIDOS</p>
	</nav>
	<div class="container" style="padding-top: 1px;">
		<nav class="navbar navbar-default nav" style="margin-top:5px;" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Desplegar navegación</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php if ($_SESSION['usuario'] == 'GF' || $_SESSION['usuario'] == 'RAQUEL' || $_SESSION['usuario'] == 'VALERIA' || $_SESSION['usuario'] == 'ADRIANA') { ?>
					<a class="navbar-brand" href="../../../GF/PAGINAS/PEDIDOS/inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
				<?php } else if ($_SESSION['usuario'] == 'GCI' ||  $_SESSION['usuario'] == 'ELADIO') { ?>
					<a class="navbar-brand" href="../../../GCI/PAGINAS/PEDIDOS/inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
				<?php } else { ?>
					<a class="navbar-brand" href="inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
				<?php } ?>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<?php
					if ($_SESSION['usuario'] == 'AVISOS') { ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="historial_ordinario">Aviso de Compra Ordinario</a></li>
								<li><a href="historial_requisicion">Aviso de Compra Requisición General</a></li>
								<li><a href="historial_datos">Datos de Proveedor</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-briefcase"> </span> Proveedores<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="proveedor_nuevo">Nuevo Proveedor</a></li>
								<li><a href="historial_proveedores">Historial Proveedores</a></li>
								<hr>
								<li><a href="prod_ser_nuevo">Nuevo Producto/Servicio</a></li>
								<li><a href="historial_prod_ser">Historial Productos y Servicios</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book"> </span> Reportes<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="reporte_ofac">Reporte Oficios Asignación</a></li>
								<li><a href="reporte_vigencia">Reporte Vigencia Proveedor</a></li>
								<li><a href="reporte_avisos">Reporte Avisos de Compra</a></li>
								<li><a href="reporte_historial">Reporte Historial de Avisos</a></li>
								<li><a href="reporte_rutas">Reporte Asignaciones de Ruta</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-comment"> </span> Destinatarios<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="destinatario_nuevo">Nuevo Destinatario</a></li>
								<li><a href="historial_destinatarios">Destinatarios en Sistema</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-comment"> </span> Elaboró<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="elaboro_nuevo">Nuevo Elaboró</a></li>
								<li><a href="historial_elaboro">Elaboró en Sistema</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Oficios<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="ofg_nuevo">Nuevo Oficio General</a></li>
								<li><a href="historial_ofg">Historial Oficios Generales</a></li>
								<li><a href="ofi_nuevo">Nuevo Oficio Incidencia</a></li>
								<li><a href="historial_ofi">Historial Oficios Incidencias</a></li>
								<li><a href="ofac_nuevo">Nuevo Oficio Asignación</a></li>
								<li><a href="historial_ofac">Historial Oficios Asignación</a></li>
								<li><a href="ofcon_nuevo">Nuevo Oficio Contrato</a></li>
								<li><a href="historial_ofcon">Historial Oficios Contratos</a></li>
								<li><a href="ofcomu_nuevo">Nuevo Comunicado</a></li>
								<li><a href="historial_ofcomu">Historial Comunicados</a></li>
								<li><a href="ofcir_nuevo">Nueva Circular</a></li>
								<li><a href="historial_ofcir">Historial Circulares</a></li>
								<li><a href="ofac_nuevo">Nuevo Oficio Asignación</a></li>
								<li><a href="historial_ofac">Historial Oficios Asignación</a></li>
								<li><a href="ofv_nuevo">Nuevo Oficio Vacaciones</a></li>
								<li><a href="historial_ofv">Historial Oficios Vacaciones</a></li>
								<li><a href="ofscvac_nuevo">Nuevo Oficio Permiso a Cuenta de Vacaciones</a></li>
								<li><a href="historial_ofscvac">Historial Permisos a Cuenta de Vacaciones</a></li>
							</ul>
						</li>
					<?php
					} else if ($_SESSION['usuario'] == 'ACCYNTHIA') { ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="historial_ordinario">Aviso de Compra Ordinario</a></li>
								<li><a href="historial_requisicion">Aviso de Compra Requisición General</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Oficios<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="ofg_nuevo">Nuevo Oficio General</a></li>
								<li><a href="historial_ofg">Historial Oficios Generales</a></li>
								<li><a href="ofi_nuevo">Nuevo Oficio Incidencia</a></li>
								<li><a href="historial_ofi">Historial Oficios Incidencias</a></li>
								<li><a href="ofac_nuevo">Nuevo Oficio Asignación</a></li>
								<li><a href="historial_ofac">Historial Oficios Asignación</a></li>
								<li><a href="ofv_nuevo">Nuevo Oficio Vacaciones</a></li>
								<li><a href="historial_ofv">Historial Oficios Vacaciones</a></li>
								<li><a href="ofcc_nuevo">Nuevo Oficio Comisión Choferes</a></li>
								<li><a href="historial_ofcc">Historial Oficios Comisión Choferes</a></li>
								<li><a href="ofscvac_nuevo">Nuevo Oficio Permiso a Cuenta de Vacaciones</a></li>
								<li><a href="historial_ofscvac">Historial Permisos a Cuenta de Vacaciones</a></li>
							</ul>
						</li>
					<?php
					} else if ($_SESSION['usuario'] == 'GF' || $_SESSION['usuario'] == 'RAQUEL' || $_SESSION['usuario'] == 'VALERIA' || $_SESSION['usuario'] == 'ADRIANA') { ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="historial_ordinario">Aviso de Compra Ordinario</a></li>
								<li><a href="historial_requisicion">Aviso de Compra Requisición General</a></li>
							</ul>
						</li>
					<?php
					} else if ($_SESSION['usuario'] == 'GCI' || $_SESSION['usuario'] == 'ELADIO') { ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="historial_ordinario">Aviso de Compra Ordinario</a></li>
								<li><a href="historial_requisicion">Aviso de Compra Requisición General</a></li>
							</ul>
						</li>
					<?php
					} else { ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Nuevo<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="ordinario_nuevo">Aviso de Compra Ordinario</a></li>
								<li><a href="requisicion_nuevo">Aviso de Compra Requisición General</a></li>
								<li><a href="datos_nuevo">Datos de Proveedor</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="historial_ordinario">Aviso de Compra Ordinario</a></li>
								<li><a href="historial_requisicion">Aviso de Compra Requisición General</a></li>
								<li><a href="historial_datos">Datos de Proveedor</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-briefcase"> </span> Proveedores<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="proveedor_nuevo">Nuevo Proveedor</a></li>
								<li><a href="historial_proveedores">Historial Proveedores</a></li>
								<hr>
								<li><a href="prod_ser_nuevo">Nuevo Producto/Servicio</a></li>
								<li><a href="historial_prod_ser">Historial Productos y Servicios</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book"> </span> Reportes<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="reporte_vigencia">Reporte Vigencia Proveedor</a></li>
								<li><a href="reporte_avisos">Reporte Avisos de Compra</a></li>
								<li><a href="reporte_historial">Reporte Historial de Avisos</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-tasks"> </span> Solicitudes Cotizaciones<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="sol_cotizacion_nuevo">Nueva Solicitud Cot. Pedidos</a></li>
								<li><a href="sol_cotizacionC_nuevo">Nueva Solicitud Cot. Cotizaciones</a></li>
								<li><a href="sol_cotizaciones_historial">Historial Solicitudes Cotización</a></li>
								<li><a href="sol_cotizaciones_reporte">Reporte Solicitudes Cotización</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Oficios<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="ofg_nuevo">Nuevo Oficio General</a></li>
								<li><a href="historial_ofg">Historial Oficios Generales</a></li>
								<li><a href="ofi_nuevo">Nuevo Oficio Incidencia</a></li>
								<li><a href="historial_ofi">Historial Oficios Incidencias</a></li>
								<li><a href="ofac_nuevo">Nuevo Oficio Asignación</a></li>
								<li><a href="historial_ofac">Historial Oficios Asignación</a></li>
								<li><a href="ofv_nuevo">Nuevo Oficio Vacaciones</a></li>
								<li><a href="historial_ofv">Historial Oficios Vacaciones</a></li>
								<li><a href="ofscvac_nuevo">Nuevo Oficio Permiso a Cuenta de Vacaciones</a></li>
								<li><a href="historial_ofscvac">Historial Permisos a Cuenta de Vacaciones</a></li>
							</ul>
						</li>
					<?php
					} ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido " . ucwords($_SESSION['usuario']) . " | "; ?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
				</ul>
			</div>
		</nav>
		<!--Panel con el titulo de la pagina y contenido-->
		<div class="panel panel-default " style="margin-top: 5px;">
			<div class="panel-body">
				<?php
				header("Content-Type: text/html;charset=utf-8");
				error_reporting(E_ALL ^ E_NOTICE);
				mysql_query("SET NAMES 'utf8'");
				//botones cynthia
				if (isset($_POST['sol_aut_oc'])) {
					$query = "UPDATE avisos_rg SET b_sol_aut_oc='Solicitado " . $_SESSION['nombre'] . "' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					//---------- SECCIÓN INSERCIÓN DE ARCHIVOS ADJUNTOS ---------------//
					$countfiles = count($_FILES['file']['name']);
					$totalFileUploaded = 0;

					for ($i = 0; $i < $countfiles; $i++) {
						$filename = $_FILES['file']['name'][$i];
						## Insert to DataBase
						$sql_files = "INSERT INTO expediente_documentos(tipo_aviso,id_aviso,documento) VALUES ('RG','" . $_POST["id"] . "','" . $filename . "')";
						$result_files = mysql_query($sql_files) or die(mysql_error());

						## Location
						$location = "uploads/" . $filename;
						$extension = pathinfo($location, PATHINFO_EXTENSION);
						$extension = strtolower($extension);

						## File upload allowed extensions
						$valid_extensions = array("jpg", "jpeg", "png", "pdf", "docx");

						$response = 0;
						## Check file extension
						if (in_array(strtolower($extension), $valid_extensions)) {
							## Upload file
							if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $location)) {
								$totalFileUploaded++;
							}
						}
					}
					//----------- FIN DE SECCIÓN ARCHIVOS ADJUNTOS---------------------//

					$getMail = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS = mysql_fetch_array($getMail)) {
						$mail_sup = $rowS['correo'];
						$mailpass_sup = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup;
					$mail->Password = $mailpass_sup;
					$mail->setFrom($mail_sup, $_SESSION['nombre']);

					$mail->AddAddress('compras@grupocavi.com.mx');
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos que has recibido una orden de compra de requisición para autorización con folio " . $_POST['folio'] . ".</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('Autorización OC Solicitada')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['sol_factura_rec'])) {
					$query = "UPDATE avisos_rg SET b_factura_rec='Solicitado " . $_SESSION['nombre'] . "' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					//---------- SECCIÓN INSERCIÓN DE ARCHIVOS ADJUNTOS ---------------//
					$countfiles = count($_FILES['file']['name']);
					$totalFileUploaded = 0;

					for ($i = 0; $i < $countfiles; $i++) {
						$filename = $_FILES['file']['name'][$i];
						## Insert to DataBase
						$sql_files = "INSERT INTO expediente_documentos(tipo_aviso,id_aviso,documento) VALUES ('RG','" . $_POST["id"] . "','" . $filename . "')";
						$result_files = mysql_query($sql_files) or die(mysql_error());

						## Location
						$location = "uploads/" . $filename;
						$extension = pathinfo($location, PATHINFO_EXTENSION);
						$extension = strtolower($extension);

						## File upload allowed extensions
						$valid_extensions = array("jpg", "jpeg", "png", "pdf", "docx");

						$response = 0;
						## Check file extension
						if (in_array(strtolower($extension), $valid_extensions)) {
							## Upload file
							if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $location)) {
								$totalFileUploaded++;
							}
						}
					}
					//----------- FIN DE SECCIÓN ARCHIVOS ADJUNTOS---------------------//

					$getMail = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS = mysql_fetch_array($getMail)) {
						$mail_sup = $rowS['correo'];
						$mailpass_sup = $rowS['correo_pass'];
					}



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
					$mail->Username = $mail_sup;
					$mail->Password = $mailpass_sup;
					$mail->setFrom($mail_sup, $_SESSION['nombre']);

					$mail->AddAddress('yasmin_gonzalez@grupocavi.com.mx');
					$mail->AddCC('eladio_mata@grupocavi.com.mx');
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos que has recibido una factura recuperada del número de aviso o requisición con folio " . $_POST['folio'] . " para autorización.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('Autorización Factura Recuperada Solicitada')
                                location.href='historial_requisicion';
                                </script>";
				}
				//botones GUADALUPE JOSEMARIA
				else if (isset($_POST['sol_aut_rg'])) {
					$query = "UPDATE avisos_rg SET b_sol_aut_rg='Solicitado COMPRADOR' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					$getMail = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS = mysql_fetch_array($getMail)) {
						$mail_sup = $rowS['correo'];
						$mailpass_sup = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup;
					$mail->Password = $mailpass_sup;
					$mail->setFrom($mail_sup, $_SESSION['nombre']);

					$mail->AddAddress('compras@grupocavi.com.mx');
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos que que has recibido un nuevo aviso de compra o requisición para autorización con folio " . $_POST['folio'] . ".</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('Autorización AC Solicitada')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['sol_procesamiento'])) {
					$query = "UPDATE avisos_rg SET b_procesamiento='Solicitado COMPRADOR' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					echo "<script languaje='javascript'>
                                alert('Procesamiento Solicitado')
                                location.href='historial_requisicion';
                                </script>";
				}

				//botones acciones AVISOS
				else if (isset($_POST['No_autorizado_rg'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET b_sol_aut_rg='No autorizado avisos' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					$getMail = mysql_query("SELECT * FROM supervisor WHERE nombre='" . $_POST['coordinador'] . "'");

					while ($rowS = mysql_fetch_array($getMail)) {
						$mail_sup = $rowS['correo'];
					}

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
					$mail->Username = "compras@grupocavi.com.mx";
					$mail->Password = ")Cl5l4!ALD]A";
					$mail->setFrom('compras@grupocavi.com.mx');

					$mail->AddAddress($mail_sup);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos tu requisición con folio " . $_POST['folio'] . " no ha sido autorizado.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('No autorizado RG')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['autorizado_rg'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET autorizado_fin_g='" . $faut . "',b_sol_aut_rg='Autorizado avisos' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					$getMail = mysql_query("SELECT * FROM supervisor WHERE nombre='" . $_POST['coordinador'] . "'");

					while ($rowS = mysql_fetch_array($getMail)) {
						$mail_sup = $rowS['correo'];
					}

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
					$mail->Username = "compras@grupocavi.com.mx";
					$mail->Password = ")Cl5l4!ALD]A";
					$mail->setFrom('compras@grupocavi.com.mx');

					$mail->AddAddress($mail_sup);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos tu requisición con folio " . $_POST['folio'] . " ha sido autorizado.</p>";

					if (!$mail->Send()) {
						echo "Fallo";
					}

					$currentdate = new DateTime('now', new DateTimeZone('America/Monterrey'));

					$date = $currentdate->format('Y-m-d');
					$time = $currentdate->format('H:i:s');
					$dayOfWeek = date("l", strtotime($date));

					$splitDate = explode('-', $date);
					$d = $splitDate[2];
					$m = $splitDate[1];
					$a = $splitDate[0];

					$splitTime = explode(':', $time);
					$H = $splitTime[0];
					$i = $splitTime[1];
					$s = $splitTime[2];

					if (($H >= '11' && $H <= '12' && $m >= '30') || ($H >= '11' && $H <= '12' && $m <= '30')) {
						if ($dayOfWeek == 'Monday' | $dayOfWeek == 'Tuesday' | $dayOfWeek == 'Wednesday' | $dayOfWeek == 'Thursday' | $dayOfWeek == 'Friday') {
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
							$mail->Username = "compras@grupocavi.com.mx";
							$mail->Password = ")Cl5l4!ALD]A";
							$mail->setFrom('compras@grupocavi.com.mx');

							$mail->AddAddress('rocio_martinez@grupocavi.com.mx');
							$mail->AddCC('raquel_grijalva@grupocavi.com.mx');
							$mail->WordWrap = 50;
							$mail->IsHTML(true);
							$mail->CharSet = 'UTF-8';
							$mail->Subject = "Notificación";
							$mail->Body = "<p>Estimado(a)</p><p>Te informamos que has recibido una nueva requisición para autorización con folio " . $_POST['folio'] . ".</p>";
							if (!$mail->Send()) {
								echo "Fallo";
							}
						}
					}

					echo "<script languaje='javascript'>
                                alert('Autorizado RG')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['No_autorizado_oc'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET b_sol_aut_oc='No autorizado avisos' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					$getMail = mysql_query("SELECT * FROM supervisor WHERE nombre='" . $_POST['coordinador'] . "'");

					while ($rowS = mysql_fetch_array($getMail)) {
						$mail_sup = $rowS['correo'];
					}

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
					$mail->Username = "compras@grupocavi.com.mx";
					$mail->Password = ")Cl5l4!ALD]A";
					$mail->setFrom('compras@grupocavi.com.mx');

					$mail->AddAddress($mail_sup);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos su requisición de orden de compra con folio " . $_POST['folio'] . " no ha sido autorizado.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('No autorizado OC')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['autorizado_oc'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET fecha_orden_contabilidad1='" . $faut . "',fecha_orden_contabilidad2='" . $faut . "',
						fecha_orden_contabilidad3='" . $faut . "',fecha_orden_contabilidad4='" . $faut . "',fecha_orden_contabilidad5='" . $faut . "',
						fecha_orden_contabilidad6='" . $faut . "',fecha_orden_contabilidad8='" . $faut . "',fecha_orden_contabilidad9='" . $faut . "',
						fecha_orden_contabilidad9='" . $faut . "',fecha_orden_contabilidad10='" . $faut . "',b_sol_aut_oc='Autorizado avisos' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					$getMail = mysql_query("SELECT * FROM supervisor WHERE nombre='" . $_POST['coordinador'] . "'");

					while ($rowS = mysql_fetch_array($getMail)) {
						$mail_sup = $rowS['correo'];
					}

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
					$mail->Username = "compras@grupocavi.com.mx";
					$mail->Password = ")Cl5l4!ALD]A";
					$mail->setFrom('compras@grupocavi.com.mx');

					$mail->AddAddress($mail_sup);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos su requisición de orden de compra con folio " . $_POST['folio'] . " ha sido autorizado.</p>";

					if (!$mail->Send()) {
						echo "Fallo";
					}

					$currentdate = new DateTime('now', new DateTimeZone('America/Monterrey'));

					$date = $currentdate->format('Y-m-d');
					$time = $currentdate->format('H:i:s');
					$dayOfWeek = date("l", strtotime($date));

					$splitDate = explode('-', $date);
					$d = $splitDate[2];
					$m = $splitDate[1];
					$a = $splitDate[0];

					$splitTime = explode(':', $time);
					$H = $splitTime[0];
					$i = $splitTime[1];
					$s = $splitTime[2];

					if ($H >= '10' && $H <= '11') {
						if ($dayOfWeek == 'Monday' | $dayOfWeek == 'Tuesday' | $dayOfWeek == 'Wednesday' | $dayOfWeek == 'Thursday' | $dayOfWeek == 'Friday') {
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
							$mail->Username = "compras@grupocavi.com.mx";
							$mail->Password = ")Cl5l4!ALD]A";
							$mail->setFrom('compras@grupocavi.com.mx');

							$mail->AddAddress('yasmin_gonzalez@grupocavi.com.mx');
							$mail->AddCC('eladio_mata@grupocavi.com.mx');
							$mail->WordWrap = 50;
							$mail->IsHTML(true);
							$mail->CharSet = 'UTF-8';
							$mail->Subject = "Notificación";
							$mail->Body = "<p>Estimado(a)</p><p>Te informamos que has recibido una orden de compra de requisición para autorización con folio " . $_POST['folio'] . " de la empresa " . $_POST['empresa_por'] . ".</p>";
							if (!$mail->Send()) {
								echo "Fallo";
							}
						}
					}

					echo "<script languaje='javascript'>
                                alert('Autorizado OC')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['sol_aut_ant'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET b_sol_aut_ant='Solicitado avisos' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

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
					$mail->Username = "compras@grupocavi.com.mx";
					$mail->Password = ")Cl5l4!ALD]A";
					$mail->setFrom('compras@grupocavi.com.mx');

					$mail->AddAddress('valeria_nava@grupocavi.com.mx');
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos tienes un pago anticipado que autorizar de la requisición con folio " . $_POST['folio'] . ".</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('Autorización anticipada RG Solicitada')
                                location.href='historial_requisicion';
                                </script>";
				}
				//botones acciones GF RAQUEL
				else if (isset($_POST['No_autorizado_rg_fin'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET notas='" . $_POST['notas'] . "', b_sol_aut_rg='No autorizado finanzas' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					$getMail = mysql_query("SELECT * FROM supervisor WHERE nombre='" . $_POST['coordinador'] . "'");

					while ($rowS = mysql_fetch_array($getMail)) {
						$mail_sup = $rowS['correo'];
					}

					$getMail2 = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS2 = mysql_fetch_array($getMail2)) {
						$mail_sup2 = $rowS['correo'];
						$mailpass_sup2 = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup2;
					$mail->Password = $mailpass_sup2;
					$mail->setFrom($mail_sup2, $_SESSION['nombre']);

					$mail->AddAddress('compras@grupocavi.com.mx');
					$mail->AddCC($mail_sup);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos su requisición con folio " . $_POST['folio'] . " no ha sido autorizado.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('No autorizado RG')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['autorizado_rg_fin'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET notas='" . $_POST['notas'] . "',fecha_autorizacion='" . $faut . "',b_sol_aut_rg='Autorizado finanzas' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					//---------- SECCIÓN INSERCIÓN DE ARCHIVOS ADJUNTOS ---------------//
					$countfiles = count($_FILES['file']['name']);
					$totalFileUploaded = 0;

					for ($i = 0; $i < $countfiles; $i++) {
						$filename = $_FILES['file']['name'][$i];
						## Insert to DataBase
						$sql_files = "INSERT INTO expediente_documentos(tipo_aviso,id_aviso,documento) VALUES ('RG','" . $_POST["id"] . "','" . $filename . "')";
						$result_files = mysql_query($sql_files) or die(mysql_error());

						## Location
						$location = "uploads/" . $filename;
						$extension = pathinfo($location, PATHINFO_EXTENSION);
						$extension = strtolower($extension);

						## File upload allowed extensions
						$valid_extensions = array("jpg", "jpeg", "png", "pdf", "docx");

						$response = 0;
						## Check file extension
						if (in_array(strtolower($extension), $valid_extensions)) {
							## Upload file
							if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $location)) {
								$totalFileUploaded++;
							}
						}
					}
					//----------- FIN DE SECCIÓN ARCHIVOS ADJUNTOS---------------------//

					$getMail = mysql_query("SELECT * FROM supervisor WHERE nombre='" . $_POST['coordinador'] . "'");

					while ($rowS = mysql_fetch_array($getMail)) {
						$mail_sup = $rowS['correo'];
					}

					$getMail2 = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS2 = mysql_fetch_array($getMail2)) {
						$mail_sup2 = $rowS['correo'];
						$mailpass_sup2 = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup2;
					$mail->Password = $mailpass_sup2;
					$mail->setFrom($mail_sup2, $_SESSION['nombre']);

					$mail->AddAddress('compras@grupocavi.com.mx');
					$mail->AddCC($mail_sup);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos su requisición con folio " . $_POST['folio'] . " ha sido autorizado.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('Autorizado RG')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['No_autorizado_oc_fin'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET notas='" . $_POST['notas'] . "',b_sol_aut_oc='No autorizado finanzas' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					$getMail = mysql_query("SELECT * FROM supervisor WHERE nombre='" . $_POST['coordinador'] . "'");

					while ($rowS = mysql_fetch_array($getMail)) {
						$mail_sup = $rowS['correo'];
					}

					$getMail2 = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS2 = mysql_fetch_array($getMail2)) {
						$mail_sup2 = $rowS['correo'];
						$mailpass_sup2 = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup2;
					$mail->Password = $mailpass_sup2;
					$mail->setFrom($mail_sup2, $_SESSION['nombre']);

					$mail->AddAddress('compras@grupocavi.com.mx');
					$mail->AddCC($mail_sup);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos su requisición orden de compra con folio " . $_POST['folio'] . " no ha sido autorizado.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}


					echo "<script languaje='javascript'>
                                alert('No autorizado OC')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['autorizado_oc_fin'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET notas='" . $_POST['notas'] . "',fecha_pago='" . $faut . "',pagar_por='" . $_POST['pagar_por'] . "',empresa_por='" . $_POST['empresa_por'] . "',b_sol_aut_oc='Autorizado finanzas' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					//---------- SECCIÓN INSERCIÓN DE ARCHIVOS ADJUNTOS ---------------//
					$countfiles = count($_FILES['file']['name']);
					$totalFileUploaded = 0;

					for ($i = 0; $i < $countfiles; $i++) {
						$filename = $_FILES['file']['name'][$i];
						## Insert to DataBase
						$sql_files = "INSERT INTO expediente_documentos(tipo_aviso,id_aviso,documento) VALUES ('RG','" . $_POST["id"] . "','" . $filename . "')";
						$result_files = mysql_query($sql_files) or die(mysql_error());

						## Location
						$location = "uploads/" . $filename;
						$extension = pathinfo($location, PATHINFO_EXTENSION);
						$extension = strtolower($extension);

						## File upload allowed extensions
						$valid_extensions = array("jpg", "jpeg", "png", "pdf", "docx");

						$response = 0;
						## Check file extension
						if (in_array(strtolower($extension), $valid_extensions)) {
							## Upload file
							if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $location)) {
								$totalFileUploaded++;
							}
						}
					}
					//----------- FIN DE SECCIÓN ARCHIVOS ADJUNTOS---------------------//

					$getMail = mysql_query("SELECT * FROM supervisor WHERE nombre='" . $_POST['coordinador'] . "'");

					while ($rowS = mysql_fetch_array($getMail)) {
						$mail_sup = $rowS['correo'];
					}

					$getMail2 = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS2 = mysql_fetch_array($getMail2)) {
						$mail_sup2 = $rowS['correo'];
						$mailpass_sup2 = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup2;
					$mail->Password = $mailpass_sup2;
					$mail->setFrom($mail_sup2, $_SESSION['nombre']);

					$mail->AddAddress($mail_sup);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos su requisición de orden de compra con folio " . $_POST['folio'] . " ha sido autorizado.</p>";

					if (!$mail->Send()) {
						echo "Fallo";
					}

					$getMail3 = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_POST['pagar_por'] . "'");

					while ($rowS3 = mysql_fetch_array($getMail3)) {
						$mail_sup3 = $rowS['correo'];
					}

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
					$mail->Username = $mail_sup2;
					$mail->Password = $mailpass_sup2;
					$mail->setFrom($mail_sup2, $_SESSION['nombre']);

					$mail->AddAddress($mail_sup3);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos que tienes una orden de compra (requisición general) autorizada para pago con folio " . $_POST['folio'] . " de la empresa " . $_POST['empresa_por'] . ".</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('Autorizado OC')
                                location.href='historial_requisicion';
                                </script>";
				}
				//botones acciones VALERIA ADRIANA
				else if (isset($_POST['pago_no_aut'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET notas='" . $_POST['notas'] . "', b_pago='No autorizado' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					$getMail = mysql_query("SELECT * FROM supervisor WHERE nombre='" . $_POST['coordinador'] . "'");

					while ($rowS = mysql_fetch_array($getMail)) {
						$mail_sup = $rowS['correo'];
					}

					$getMail2 = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS2 = mysql_fetch_array($getMail2)) {
						$mail_sup2 = $rowS['correo'];
						$mailpass_sup2 = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup2;
					$mail->Password = $mailpass_sup2;
					$mail->setFrom($mail_sup2, $_SESSION['nombre']);

					$mail->AddAddress('rocio_martinez@grupocavi.com.mx');
					$mail->AddCC('raquel_grijalva@grupocavi.com.mx');
					$mail->AddCC('compras@grupocavi.com.mx');
					$mail->AddCC($mail_sup);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos que no ha sido autorizado el pago de la requisición de compra con folio " . $_POST['folio'] . ".</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('Pago no autorizado')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['pago_realizado'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET notas='" . $_POST['notas'] . "',pago_compra='" . $faut . "',b_pago='Realizado' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					//---------- SECCIÓN INSERCIÓN DE ARCHIVOS ADJUNTOS ---------------//
					$countfiles = count($_FILES['file']['name']);
					$totalFileUploaded = 0;

					for ($i = 0; $i < $countfiles; $i++) {
						$filename = $_FILES['file']['name'][$i];
						## Insert to DataBase
						$sql_files = "INSERT INTO expediente_documentos(tipo_aviso,id_aviso,documento) VALUES ('RG','" . $_POST["id"] . "','" . $filename . "')";
						$result_files = mysql_query($sql_files) or die(mysql_error());

						## Location
						$location = "uploads/" . $filename;
						$extension = pathinfo($location, PATHINFO_EXTENSION);
						$extension = strtolower($extension);

						## File upload allowed extensions
						$valid_extensions = array("jpg", "jpeg", "png", "pdf", "docx");

						$response = 0;
						## Check file extension
						if (in_array(strtolower($extension), $valid_extensions)) {
							## Upload file
							if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $location)) {
								$totalFileUploaded++;
							}
						}
					}
					//----------- FIN DE SECCIÓN ARCHIVOS ADJUNTOS---------------------//

					$getMail = mysql_query("SELECT * FROM supervisor WHERE nombre='" . $_POST['coordinador'] . "'");

					while ($rowS = mysql_fetch_array($getMail)) {
						$mail_sup = $rowS['correo'];
					}

					$getMail2 = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS2 = mysql_fetch_array($getMail2)) {
						$mail_sup2 = $rowS['correo'];
						$mailpass_sup2 = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup2;
					$mail->Password = $mailpass_sup2;
					$mail->setFrom($mail_sup2, $_SESSION['nombre']);

					$mail->AddAddress('monserrat_villegas@grupocavi.com.mx');
					$mail->AddCC('raquel_grijalva@grupocavi.com.mx');
					$mail->AddCC($mail_sup);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos la compra de la requisición con folio " . $_POST['folio'] . " ha sido finalizada.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('Pago realizado')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['No_autorizado_ant_pagos'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET notas='" . $_POST['notas'] . "',b_sol_aut_ant='No autorizado pagos' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					$getMail2 = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS2 = mysql_fetch_array($getMail2)) {
						$mail_sup2 = $rowS['correo'];
						$mailpass_sup2 = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup2;
					$mail->Password = $mailpass_sup2;
					$mail->setFrom($mail_sup2, $_SESSION['nombre']);

					$mail->AddAddress('compras@grupocavi.com.mx');
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos que pago anticipado de la requisición con folio " . $_POST['folio'] . " no ha sido autorizado.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}


					echo "<script languaje='javascript'>
                                alert('No autorizado anticipado')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['autorizado_ant_pagos'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET notas='" . $_POST['notas'] . "',b_sol_aut_ant='Autorizado pagos' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					//---------- SECCIÓN INSERCIÓN DE ARCHIVOS ADJUNTOS ---------------//
					$countfiles = count($_FILES['file']['name']);
					$totalFileUploaded = 0;

					for ($i = 0; $i < $countfiles; $i++) {
						$filename = $_FILES['file']['name'][$i];
						## Insert to DataBase
						$sql_files = "INSERT INTO expediente_documentos(tipo_aviso,id_aviso,documento) VALUES ('RG','" . $_POST["id"] . "','" . $filename . "')";
						$result_files = mysql_query($sql_files) or die(mysql_error());

						## Location
						$location = "uploads/" . $filename;
						$extension = pathinfo($location, PATHINFO_EXTENSION);
						$extension = strtolower($extension);

						## File upload allowed extensions
						$valid_extensions = array("jpg", "jpeg", "png", "pdf", "docx");

						$response = 0;
						## Check file extension
						if (in_array(strtolower($extension), $valid_extensions)) {
							## Upload file
							if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $location)) {
								$totalFileUploaded++;
							}
						}
					}
					//----------- FIN DE SECCIÓN ARCHIVOS ADJUNTOS---------------------//

					$getMail2 = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS2 = mysql_fetch_array($getMail2)) {
						$mail_sup2 = $rowS['correo'];
						$mailpass_sup2 = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup2;
					$mail->Password = $mailpass_sup2;
					$mail->setFrom($mail_sup2, $_SESSION['nombre']);

					$mail->AddAddress('compras@grupocavi.com.mx');
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos que pago anticipado de la requisición con folio " . $_POST['folio'] . " ha sido autorizado.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('Autorizado anticipado')
                                location.href='historial_requisicion';
                                </script>";
				}
				//botones acciones GCI ELADIO
				else if (isset($_POST['No_autorizado_oc_conta'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET notas='" . $_POST['notas'] . "', b_sol_aut_oc='No autorizado conta' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					$getMail2 = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS2 = mysql_fetch_array($getMail2)) {
						$mail_sup2 = $rowS['correo'];
						$mailpass_sup2 = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup2;
					$mail->Password = $mailpass_sup2;
					$mail->setFrom($mail_sup2, $_SESSION['nombre']);

					$mail->AddAddress('compras@grupocavi.com.mx');
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos su orden de compra de requisición con folio " . $_POST['folio'] . " no ha sido autorizada.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('No autorizado OC')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['autorizado_oc_conta'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET notas='" . $_POST['notas'] . "',fecha_orden='" . $faut . "',b_sol_aut_oc='Autorizado conta' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					//---------- SECCIÓN INSERCIÓN DE ARCHIVOS ADJUNTOS ---------------//
					$countfiles = count($_FILES['file']['name']);
					$totalFileUploaded = 0;

					for ($i = 0; $i < $countfiles; $i++) {
						$filename = $_FILES['file']['name'][$i];
						## Insert to DataBase
						$sql_files = "INSERT INTO expediente_documentos(tipo_aviso,id_aviso,documento) VALUES ('RG','" . $_POST["id"] . "','" . $filename . "')";
						$result_files = mysql_query($sql_files) or die(mysql_error());

						## Location
						$location = "uploads/" . $filename;
						$extension = pathinfo($location, PATHINFO_EXTENSION);
						$extension = strtolower($extension);

						## File upload allowed extensions
						$valid_extensions = array("jpg", "jpeg", "png", "pdf", "docx");

						$response = 0;
						## Check file extension
						if (in_array(strtolower($extension), $valid_extensions)) {
							## Upload file
							if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $location)) {
								$totalFileUploaded++;
							}
						}
					}
					//----------- FIN DE SECCIÓN ARCHIVOS ADJUNTOS---------------------//

					$getMail2 = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS2 = mysql_fetch_array($getMail2)) {
						$mail_sup2 = $rowS['correo'];
						$mailpass_sup2 = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup2;
					$mail->Password = $mailpass_sup2;
					$mail->setFrom($mail_sup2, $_SESSION['nombre']);

					$mail->AddAddress('compras@grupocavi.com.mx');
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos su orden de compra de la requisición con folio " . $_POST['folio'] . " ha sido autorizada.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					$currentdate = new DateTime('now', new DateTimeZone('America/Monterrey'));

					$date = $currentdate->format('Y-m-d');
					$time = $currentdate->format('H:i:s');
					$dayOfWeek = date("l", strtotime($date));

					$splitDate = explode('-', $date);
					$d = $splitDate[2];
					$m = $splitDate[1];
					$a = $splitDate[0];

					$splitTime = explode(':', $time);
					$H = $splitTime[0];
					$i = $splitTime[1];
					$s = $splitTime[2];

					if (($H >= '11' && $H <= '12' && $m >= '30') || ($H >= '11' && $H <= '12' && $m <= '30')) {
						if ($dayOfWeek == 'Monday' | $dayOfWeek == 'Tuesday' | $dayOfWeek == 'Wednesday' | $dayOfWeek == 'Thursday' | $dayOfWeek == 'Friday') {
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
							$mail->Username = "compras@grupocavi.com.mx";
							$mail->Password = ")Cl5l4!ALD]A";
							$mail->setFrom('compras@grupocavi.com.mx');

							$mail->AddAddress('rocio_martinez@grupocavi.com.mx');
							$mail->AddCC('raquel_grijalva@grupocavi.com.mx');
							$mail->WordWrap = 50;
							$mail->IsHTML(true);
							$mail->CharSet = 'UTF-8';
							$mail->Subject = "Notificación";
							$mail->Body = "<p>Estimado(a)</p><p>Te informamos que has recibido una orden de compra de requisición para autorización con folio " . $_POST['folio'] . ".</p>";
							if (!$mail->Send()) {
								echo "Fallo";
							}
						}
					}

					echo "<script languaje='javascript'>
                                alert('Autorizado OC')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['No_autorizado_fac_rec'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET notas='" . $_POST['notas'] . "',b_factura_rec='No autorizado conta' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					$getMail2 = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS2 = mysql_fetch_array($getMail2)) {
						$mail_sup2 = $rowS['correo'];
						$mailpass_sup2 = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup2;
					$mail->Password = $mailpass_sup2;
					$mail->setFrom($mail_sup2, $_SESSION['nombre']);

					$mail->AddAddress('compras@grupocavi.com.mx');
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos tu factura recuperada de requisición con folio " . $_POST['folio'] . " no ha sido autorizada.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

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
					$mail->Username = "compras@grupocavi.com.mx";
					$mail->Password = ")Cl5l4!ALD]A";
					$mail->setFrom('compras@grupocavi.com.mx');

					$mail->AddAddress('valeria_nava@grupocavi.com.mx');
					$mail->AddCC('bertha_favela@grupocavi.com.mx');
					$mail->AddCC('compras@grupocavi.com.mx');
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos tienes una factura recuperada de la requisición con folio " . $_POST['folio'] . " autorizada.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('No autorizado factura recuperada')
                                location.href='historial_requisicion';
                                </script>";
				} else if (isset($_POST['autorizado_fac_rec'])) {
					$faut = date();
					$query = "UPDATE avisos_rg SET notas='" . $_POST['notas'] . "',b_factura_rec='Autorizado conta' WHERE id='" . $_POST['id'] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					//---------- SECCIÓN INSERCIÓN DE ARCHIVOS ADJUNTOS ---------------//
					$countfiles = count($_FILES['file']['name']);
					$totalFileUploaded = 0;

					for ($i = 0; $i < $countfiles; $i++) {
						$filename = $_FILES['file']['name'][$i];
						## Insert to DataBase
						$sql_files = "INSERT INTO expediente_documentos(tipo_aviso,id_aviso,documento) VALUES ('RG','" . $_POST["id"] . "','" . $filename . "')";
						$result_files = mysql_query($sql_files) or die(mysql_error());

						## Location
						$location = "uploads/" . $filename;
						$extension = pathinfo($location, PATHINFO_EXTENSION);
						$extension = strtolower($extension);

						## File upload allowed extensions
						$valid_extensions = array("jpg", "jpeg", "png", "pdf", "docx");

						$response = 0;
						## Check file extension
						if (in_array(strtolower($extension), $valid_extensions)) {
							## Upload file
							if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $location)) {
								$totalFileUploaded++;
							}
						}
					}
					//----------- FIN DE SECCIÓN ARCHIVOS ADJUNTOS---------------------//

					$getMail2 = mysql_query("SELECT * FROM supervisor WHERE usuario='" . $_SESSION['usuario'] . "'");

					while ($rowS2 = mysql_fetch_array($getMail2)) {
						$mail_sup2 = $rowS['correo'];
						$mailpass_sup2 = $rowS['correo_pass'];
					}

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
					$mail->Username = $mail_sup2;
					$mail->Password = $mailpass_sup2;
					$mail->setFrom($mail_sup2, $_SESSION['nombre']);

					$mail->AddAddress('compras@grupocavi.com.mx');
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación";
					$mail->Body = "<p>Estimado(a)</p><p>Te informamos tu factura recuperada de la requisición con folio " . $_POST['folio'] . " ha sido autorizada.</p>";
					if (!$mail->Send()) {
						echo "Fallo";
					}

					echo "<script languaje='javascript'>
                                alert('Autorizado factura recuperada')
                                location.href='historial_requisicion';
                                </script>";
				}
				if (isset($_POST["submit"])) {
					$consulta_mysql = "SELECT folio,proyecto FROM pedidos WHERE folio_af='" . $_POST["folio_compras"] . "'";
					$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
					while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
						$folio_gerencia = $fila['folio'];
						$proyecto = $fila['proyecto'];
					}

					if ($_SESSION['usuario'] == 'AVISOS') {
						$query = "UPDATE avisos_rg SET aut_fin_g='" . $_POST["aut_fin_g"] . "',fecha_aut_g='" . $_POST["fecha_aut_g"] . "',partida1='" . $_POST["partida1"] . "', partida2='" . $_POST["partida2"] . "',
					   partida3='" . $_POST["partida3"] . "', partida4='" . $_POST["partida4"] . "', partida5='" . $_POST["partida5"] . "',
					    partida6='" . $_POST["partida6"] . "', partida7='" . $_POST["partida7"] . "', partida8='" . $_POST["partida8"] . "',
						 partida9='" . $_POST["partida9"] . "', partida10='" . $_POST["partida10"] . "',pago_compra='" . $_POST["pago_compra"] . "'
							   pago_compra2='" . $_POST["pago_compra2"] . "', pago_compra3='" . $_POST["pago_compra3"] . "',
							    pago_compra4='" . $_POST["pago_compra4"] . "', pago_compra5='" . $_POST["pago_compra5"] . "',
								 pago_compra6='" . $_POST["pago_compra6"] . "', pago_compra7='" . $_POST["pago_compra7"] . "',
								  pago_compra8='" . $_POST["pago_compra8"] . "', pago_compra9='" . $_POST["pago_compra9"] . "',
								   pago_compra10='" . $_POST["pago_compra10"] . "',fecha_orden='" . $_POST["fecha_orden"] . "',
								    fecha_orden2='" . $_POST["fecha_orden2"] . "', fecha_orden3='" . $_POST["fecha_orden3"] . "', fecha_orden4='" . $_POST["fecha_orden4"] . "',
									 fecha_orden5='" . $_POST["fecha_orden5"] . "', fecha_orden6='" . $_POST["fecha_orden6"] . "', fecha_orden7='" . $_POST["fecha_orden7"] . "',
									  fecha_orden8='" . $_POST["fecha_orden8"] . "', fecha_orden9='" . $_POST["fecha_orden9"] . "', fecha_orden10='" . $_POST["fecha_orden10"] . "',
									  fecha_orden_contabilidad1='" . $_POST["fecha_orden_contabilidad1"] . "',fecha_orden_contabilidad2='" . $_POST["fecha_orden_contabilidad2"] . "',
									  fecha_orden_contabilidad3='" . $_POST["fecha_orden_contabilidad3"] . "', fecha_orden_contabilidad4='" . $_POST["fecha_orden_contabilidad4"] . "',
									 fecha_orden_contabilidad5='" . $_POST["fecha_orden_contabilidad5"] . "', fecha_orden_contabilidad6='" . $_POST["fecha_orden_contabilidad6"] . "', fecha_orden_contabilidad7='" . $_POST["fecha_orden_contabilidad7"] . "',
									  fecha_orden_contabilidad8='" . $_POST["fecha_orden_contabilidad8"] . "', fecha_orden_contabilidad9='" . $_POST["fecha_orden_contabilidad9"] . "', fecha_orden_contabilidad10='" . $_POST["fecha_orden_contabilidad10"] . "',
									  fecha_pago='" . $_POST["fecha_pago"] . "', fecha_pago2='" . $_POST["fecha_pago2"] . "', fecha_pago3='" . $_POST["fecha_pago3"] . "',
									   fecha_pago4='" . $_POST["fecha_pago4"] . "', fecha_pago5='" . $_POST["fecha_pago5"] . "', fecha_pago6='" . $_POST["fecha_pago6"] . "',
									    fecha_pago7='" . $_POST["fecha_pago7"] . "', fecha_pago8='" . $_POST["fecha_pago8"] . "', fecha_pago9='" . $_POST["fecha_pago9"] . "',
										 fecha_pago10='" . $_POST["fecha_pago10"] . "', pedido_completo='" . $_POST["pedido_completo"] . "',  agente_ventas='" . $_POST["agente_ventas"] . "' WHERE id='" . $_POST['id'] . "'";
						$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

						echo "<script languaje='javascript'>
              alert('Modificado')
      				location.href='historial_requisicion';
              </script>";
						//---------- SECCIÓN INSERCIÓN DE ARCHIVOS ADJUNTOS ---------------//
						$countfiles = count($_FILES['file']['name']);
						$totalFileUploaded = 0;

						for ($i = 0; $i < $countfiles; $i++) {
							$filename = $_FILES['file']['name'][$i];
							## Insert to DataBase
							$sql_files = "INSERT INTO expediente_documentos(tipo_aviso,id_aviso,documento) VALUES ('RG','" . $_POST["id"] . "','" . $filename . "')";
							$result_files = mysql_query($sql_files) or die(mysql_error());

							## Location
							$location = "uploads/" . $filename;
							$extension = pathinfo($location, PATHINFO_EXTENSION);
							$extension = strtolower($extension);

							## File upload allowed extensions
							$valid_extensions = array("jpg", "jpeg", "png", "pdf", "docx");

							$response = 0;
							## Check file extension
							if (in_array(strtolower($extension), $valid_extensions)) {
								## Upload file
								if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $location)) {
									$totalFileUploaded++;
								}
							}
						}
						$msg = "Archivos Cargados : " . $totalFileUploaded . ".";
						echo "<script languaje='javascript'>
				   alert($msg)
				   location.href='historial_requisicion';
			   </script>";
						//----------- FIN DE SECCIÓN ARCHIVOS ADJUNTOS---------------------//
					} else {
						$query = "UPDATE avisos_rg SET folio_compras='" . $_POST["folio_compras"] . "',folio_gerencia='" . $folio_gerencia . "',
					proyecto='" . $proyecto . "',empresa='" . $_POST["empresa"] . "',cotizacion='" . $_POST["cotizacion"] . "',
					 monto_total='" . $_POST["monto_total"] . "', moneda='" . $_POST["moneda"] . "', observaciones='" . $_POST["observaciones"] . "',
					  proveedor='" . $_POST["proveedor"] . "',aut_fin_g='" . $_POST["aut_fin_g"] . "',fecha_aut_g='" . $_POST["fecha_aut_g"] . "',pago_compra='" . $_POST["pago_compra"] . "'
							   pago_compra2='" . $_POST["pago_compra2"] . "', pago_compra3='" . $_POST["pago_compra3"] . "',
							    pago_compra4='" . $_POST["pago_compra4"] . "', pago_compra5='" . $_POST["pago_compra5"] . "',
								 pago_compra6='" . $_POST["pago_compra6"] . "', pago_compra7='" . $_POST["pago_compra7"] . "',
								  pago_compra8='" . $_POST["pago_compra8"] . "', pago_compra9='" . $_POST["pago_compra9"] . "',
								   pago_compra10='" . $_POST["pago_compra10"] . "',fecha_orden='" . $_POST["fecha_orden"] . "',
								    fecha_orden2='" . $_POST["fecha_orden2"] . "', fecha_orden3='" . $_POST["fecha_orden3"] . "', fecha_orden4='" . $_POST["fecha_orden4"] . "',
									 fecha_orden5='" . $_POST["fecha_orden5"] . "', fecha_orden6='" . $_POST["fecha_orden6"] . "', fecha_orden7='" . $_POST["fecha_orden7"] . "',
									  fecha_orden8='" . $_POST["fecha_orden8"] . "', fecha_orden9='" . $_POST["fecha_orden9"] . "', fecha_orden10='" . $_POST["fecha_orden10"] . "',
									  fecha_orden_contabilidad1='" . $_POST["fecha_orden_contabilidad1"] . "',fecha_orden_contabilidad2='" . $_POST["fecha_orden_contabilidad2"] . "',
									  fecha_orden_contabilidad3='" . $_POST["fecha_orden_contabilidad3"] . "', fecha_orden_contabilidad4='" . $_POST["fecha_orden_contabilidad4"] . "',
									 fecha_orden_contabilidad5='" . $_POST["fecha_orden_contabilidad5"] . "', fecha_orden_contabilidad6='" . $_POST["fecha_orden_contabilidad6"] . "', fecha_orden_contabilidad7='" . $_POST["fecha_orden_contabilidad7"] . "',
									  fecha_orden_contabilidad8='" . $_POST["fecha_orden_contabilidad8"] . "', fecha_orden_contabilidad9='" . $_POST["fecha_orden_contabilidad9"] . "', fecha_orden_contabilidad10='" . $_POST["fecha_orden_contabilidad10"] . "',
									  fecha_pago='" . $_POST["fecha_pago"] . "', fecha_pago2='" . $_POST["fecha_pago2"] . "', fecha_pago3='" . $_POST["fecha_pago3"] . "',
									   fecha_pago4='" . $_POST["fecha_pago4"] . "', fecha_pago5='" . $_POST["fecha_pago5"] . "', fecha_pago6='" . $_POST["fecha_pago6"] . "',
									    fecha_pago7='" . $_POST["fecha_pago7"] . "', fecha_pago8='" . $_POST["fecha_pago8"] . "', fecha_pago9='" . $_POST["fecha_pago9"] . "',
										 fecha_pago10='" . $_POST["fecha_pago10"] . "', pedido_completo='" . $_POST["pedido_completo"] . "', agente_ventas='" . $_POST["agente_ventas"] . "' WHERE id='" . $_POST['id'] . "'";
						$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

						echo "<script languaje='javascript'>
              alert('Modificado')
      				location.href='historial_requisicion';
              </script>";

						//---------- SECCIÓN INSERCIÓN DE ARCHIVOS ADJUNTOS ---------------//
						$countfiles = count($_FILES['file']['name']);
						$totalFileUploaded = 0;

						for ($i = 0; $i < $countfiles; $i++) {
							$filename = $_FILES['file']['name'][$i];
							## Insert to DataBase
							$sql_files = "INSERT INTO expediente_documentos(tipo_aviso,id_aviso,documento) VALUES ('RG','" . $_POST["id"] . "','" . $filename . "')";
							$result_files = mysql_query($sql_files) or die(mysql_error());

							## Location
							$location = "uploads/" . $filename;
							$extension = pathinfo($location, PATHINFO_EXTENSION);
							$extension = strtolower($extension);

							## File upload allowed extensions
							$valid_extensions = array("jpg", "jpeg", "png", "pdf", "docx");

							$response = 0;
							## Check file extension
							if (in_array(strtolower($extension), $valid_extensions)) {
								## Upload file
								if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $location)) {
									$totalFileUploaded++;
								}
							}
						}
						$msg = "Archivos Cargados : " . $totalFileUploaded . ".";
						echo "<script languaje='javascript'>
				  alert($msg)
				  location.href='historial_requisicion';
			  </script>";
						//----------- FIN DE SECCIÓN ARCHIVOS ADJUNTOS---------------------//

					}
				} else {
					$id = $_GET['folio'];
					$sql_query = "SELECT * FROM avisos_rg WHERE id='" . $id . "'";
					$resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());
					if (mysql_num_rows($resultado) > 0) {
						while ($Rs = mysql_fetch_array($resultado)) {
				?>
							<div class="element">
								<form action="requisicion_modificar" method="post" enctype='multipart/form-data'>
									<?php
									if ($_SESSION['usuario'] == 'ACCYNTHIA') { ?>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<div class="col-xs-2">
													<input name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id']; ?>" size="17" />
												</div>
												<div class="col-xs-2">
													<input name="coordinador" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['coordinador']; ?>" size="17" />
												</div>
												<label class="control-label">Folio</label>
												<input name="folio" type="text" class="form-control input-sm" required readonly value="<?php echo $Rs['folio']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha</label>
												<input name="fecha" type="date" class="form-control input-sm" required disabled value="<?php echo $Rs['fecha']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Folio Compras</label>
												<input name="folio_compras" type="text" class="form-control input-sm" required disabled value="<?php echo $Rs['folio_compras']; ?>">
											</div>
											<div class="col-xs-6">
												<label class="control-label">Empresa que Solicita</label>
												<select name="empresa" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['empresa']; ?></option>
													<option value="CAVI DE SOMBRERETE S.A. de C.V.">CAVI DE SOMBRERETE S.A. de C.V.</option>
													<option value="CONCRETOS CAVI S.A. de C.V.">CONCRETOS CAVI S.A. de C.V.</option>
													<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
													<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)</option>
												</select>
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">No. de Cotización</label>
												<input name="cotizacion" type="text" class="form-control input-sm" required disabled value="<?php echo $Rs['cotizacion']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Monto Total con I.V.A.</label>
												<input name="monto_total" type="number" step="0.01" class="form-control input-sm" required disabled value="<?php echo $Rs['monto_total']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Moneda</label>
												<select name="moneda" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['moneda']; ?></option>
													<option value="MXN">MXN</option>
													<option value="DLLS">DLLS</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Observaciones</label>
												<select name="observaciones" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['observaciones']; ?></option>
													<option value="Se surtirá en parcialidades">Se surtirá en parcialidades</option>
													<option value="Se surtirá conforme se presente el personal">Se surtirá conforme se presente el personal</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Proveedor</label>
												<?php
												mysql_query("SET NAMES 'UTF8'");
												$consulta_mysql = 'SELECT razon_social FROM proveedores ORDER BY razon_social ASC';
												$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
												echo "<select name='proveedor' class='form-control input-sm' disabled>";
												echo "<option> {$Rs['proveedor']}</option>";
												while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
													echo "<option value='" . $fila['razon_social'] . "'>" . $fila['razon_social'] . "</option>";
												}
												echo "</select>";
												?>
											</div>
											<div class="col-xs-4">
												<label class="control-label">Proyecto</label>
												<input name="proyecto" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['proyecto']; ?>">
											</div>
											<div class="col-xs-4">
												<label class="control-label">Agente de Ventas</label>
												<input name="agente_ventas" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['agente_ventas']; ?>">
											</div>

										</div>
										<div class="row form-horizontal">
											<div class="col-xs-3">
												<label class="control-label">Autorización RG Compras</label>
												<input name="aut_fin_g" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['aut_fin_g']; ?>">
											</div>
											<div class="col-xs-3">
												<label class="control-label">Autorización RG Finanzas</label>
												<input name="fecha_aut_g" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_aut_g']; ?>">
											</div>
										</div><br>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 1</label>
												<input id="pt1" name="partida1" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida1']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad1" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad1']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 2</label>
												<input id="pt2" name="partida2" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra2']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 3</label>
												<input id="pt3" name="partida3" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra3']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 4</label>
												<input id="pt4" name="partida4" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra4']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 5</label>
												<input id="pt5" name="partida5" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra5']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 6</label>
												<input id="pt6" name="partida6" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra6']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 7</label>
												<input id="pt7" name="partida7" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra7']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 8</label>
												<input id="pt8" name="partida8" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra8']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 9</label>
												<input id="pt9" name="partida9" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra9']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 10</label>
												<input id="pt10" name="partida10" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra10']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-12">
												<label class="control-label">Notas</label>
												<textarea name="notas" class="form-control input-sm" disabled style="resize: none;"><?php echo $Rs['notas']; ?></textarea>
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Pedido Completo</label>
												<select name="pedido_completo" class="form-control input-sm" disabled>
													<option><?php echo $Rs['pedido_completo']; ?></option>
													<option value="Sí">Sí</option>
													<option value="No">No</option>
												</select>
											</div>
										</div><br>
										<input type="file" name="file[]" id="file" multiple>
										<br><br>
										<div style="height: 200px; overflow-x: auto">
											<?php
											$sql_doc = "SELECT * FROM expediente_documentos WHERE id_aviso='" . $id . "' AND tipo_aviso ='RG'";
											$res_doc = mysql_query($sql_doc, $conexion) or die("Error: " . mysql_error());
											?>
											<table class="table table-striped table-bordered nowrap">
												<thead>
													<tr>
														<th>Archivo</th>
														<th>Borrar</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if (mysql_num_rows($res_doc) > 0) {
														while ($Rsd = mysql_fetch_array($res_doc)) {
															echo "<tr><td><a target='_blank' href='uploads/" . $Rsd['documento'] . "'><img src='icon_pdf.jpg' alt='" . $Rsd['documento'] . "' width='30' height='30'><label style='font-size:11px'>" . $Rsd['documento'] . "</label></a><td><a class='glyphicon glyphicon-remove' href=./adjunto_requisicion_eliminar?id_adj=" . $Rsd["id"] . "></a></td></tr>";
														}
													}
													?>
												</tbody>
											</table>
										</div><br>
										<div id="btn-form">
											<input class="btn form-btn btn-info" type="submit" name="sol_aut_oc" value="Sol Autorización OC">
											<input class="btn form-btn btn-info" type="submit" name="sol_factura_rec" value="Factura recuperada">
										</div>
									<?php
									}
									if ($_SESSION['usuario'] == 'GF' || $_SESSION['usuario'] == 'RAQUEL') { ?>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<div class="col-xs-2">
													<input name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id']; ?>" size="17" />
												</div>
												<div class="col-xs-2">
													<input name="coordinador" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['coordinador']; ?>" size="17" />
												</div>
												<label class="control-label">Folio</label>
												<input name="folio" type="text" class="form-control input-sm" required readonly value="<?php echo $Rs['folio']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha</label>
												<input name="fecha" type="date" class="form-control input-sm" required disabled value="<?php echo $Rs['fecha']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Folio Compras</label>
												<input name="folio_compras" type="text" class="form-control input-sm" required disabled value="<?php echo $Rs['folio_compras']; ?>">
											</div>
											<div class="col-xs-6">
												<label class="control-label">Empresa que Solicita</label>
												<select name="empresa" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['empresa']; ?></option>
													<option value="CAVI DE SOMBRERETE S.A. de C.V.">CAVI DE SOMBRERETE S.A. de C.V.</option>
													<option value="CONCRETOS CAVI S.A. de C.V.">CONCRETOS CAVI S.A. de C.V.</option>
													<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
													<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)</option>
												</select>
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">No. de Cotización</label>
												<input name="cotizacion" type="text" class="form-control input-sm" required disabled value="<?php echo $Rs['cotizacion']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Monto Total con I.V.A.</label>
												<input name="monto_total" type="number" step="0.01" class="form-control input-sm" required disabled value="<?php echo $Rs['monto_total']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Moneda</label>
												<select name="moneda" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['moneda']; ?></option>
													<option value="MXN">MXN</option>
													<option value="DLLS">DLLS</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Observaciones</label>
												<select name="observaciones" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['observaciones']; ?></option>
													<option value="Se surtirá en parcialidades">Se surtirá en parcialidades</option>
													<option value="Se surtirá conforme se presente el personal">Se surtirá conforme se presente el personal</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Proveedor</label>
												<?php
												mysql_query("SET NAMES 'UTF8'");
												$consulta_mysql = 'SELECT razon_social FROM proveedores ORDER BY razon_social ASC';
												$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
												echo "<select name='proveedor' class='form-control input-sm' disabled>";
												echo "<option> {$Rs['proveedor']}</option>";
												while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
													echo "<option value='" . $fila['razon_social'] . "'>" . $fila['razon_social'] . "</option>";
												}
												echo "</select>";
												?>
											</div>
											<div class="col-xs-4">
												<label class="control-label">Proyecto</label>
												<input name="proyecto" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['proyecto']; ?>">
											</div>
											<div class="col-xs-4">
												<label class="control-label">Agente de Ventas</label>
												<input name="agente_ventas" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['agente_ventas']; ?>">
											</div>

										</div>
										<div class="row form-horizontal">
											<div class="col-xs-3">
												<label class="control-label">Autorización RG Compras</label>
												<input name="aut_fin_g" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['aut_fin_g']; ?>">
											</div>
											<div class="col-xs-3">
												<label class="control-label">Autorización RG Finanzas</label>
												<input name="fecha_aut_g" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_aut_g']; ?>">
											</div>
										</div><br>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 1</label>
												<input id="pt1" name="partida1" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida1']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad1" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad1']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 2</label>
												<input id="pt2" name="partida2" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra2']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 3</label>
												<input id="pt3" name="partida3" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra3']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 4</label>
												<input id="pt4" name="partida4" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra4']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 5</label>
												<input id="pt5" name="partida5" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra5']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 6</label>
												<input id="pt6" name="partida6" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra6']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 7</label>
												<input id="pt7" name="partida7" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra7']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 8</label>
												<input id="pt8" name="partida8" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra8']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 9</label>
												<input id="pt9" name="partida9" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra9']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 10</label>
												<input id="pt10" name="partida10" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra10']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-12">
												<label class="control-label">Notas</label>
												<textarea name="notas" class="form-control input-sm" style="resize: none;"><?php echo $Rs['notas']; ?></textarea>
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Pedido Completo</label>
												<select name="pedido_completo" class="form-control input-sm" disabled>
													<option><?php echo $Rs['pedido_completo']; ?></option>
													<option value="Sí">Sí</option>
													<option value="No">No</option>
												</select>
											</div>
										</div><br>
										<input type="file" name="file[]" id="file" multiple>
										<br><br>
										<div style="height: 200px; overflow-x: auto">
											<?php
											$sql_doc = "SELECT * FROM expediente_documentos WHERE id_aviso='" . $id . "' AND tipo_aviso ='RG'";
											$res_doc = mysql_query($sql_doc, $conexion) or die("Error: " . mysql_error());
											?>
											<table class="table table-striped table-bordered nowrap">
												<thead>
													<tr>
														<th>Archivo</th>
														<th>Borrar</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if (mysql_num_rows($res_doc) > 0) {
														while ($Rsd = mysql_fetch_array($res_doc)) {
															echo "<tr><td><a target='_blank' href='uploads/" . $Rsd['documento'] . "'><img src='icon_pdf.jpg' alt='" . $Rsd['documento'] . "' width='30' height='30'><label style='font-size:11px'>" . $Rsd['documento'] . "</label></a><td><a class='glyphicon glyphicon-remove' href=./adjunto_requisicion_eliminar?id_adj=" . $Rsd["id"] . "></a></td></tr>";
														}
													}
													?>
												</tbody>
											</table>
										</div><br><br>
										<input class="btn form-btn btn-success" type="submit" name="autorizado_rg_fin" value="Autorizado RG">
										<input class="btn form-btn btn-danger" type="submit" name="No_autorizado_rg_fin" value="No autorizado RG">
										<br>
										<div class="row form-horizontal">
											<div class="col-xs-3">
												<label class="control-label">Pagar por:</label>
												<select name="pagar_por" class="form-control input-sm">
													<option><?php echo $Rs['pagar_por']; ?></option>
													<option value="VALERIA">VALERIA</option>
													<option value="ADRIANA">ADRIANA</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Empresa:</label>
												<select name="empresa_por" class="form-control input-sm">
													<option><?php echo $Rs['empresa_por']; ?></option>
													<option value="Cavi">Cavi</option>
													<option value="Concretos">Concretos</option>
													<option value="Montajes">Montajes</option>
													<option value="Sucursal Concretos">Sucursal Concretos</option>
													<option value="Sucursal Montajes">Sucursal Montajes</option>
												</select>
											</div>
										</div>
										<br>
										<div id="btn-form">
											<input class="btn form-btn btn-success" type="submit" name="autorizado_oc_fin" value="Autorizado OC">
											<input class="btn form-btn btn-danger" type="submit" name="No_autorizado_oc_fin" value="No autorizado OC">
										</div>
									<?php
									}
									if ($_SESSION['usuario'] == 'VALERIA' || $_SESSION['usuario'] == 'ADRIANA') { ?>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<div class="col-xs-2">
													<input name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id']; ?>" size="17" />
												</div>
												<div class="col-xs-2">
													<input name="coordinador" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['coordinador']; ?>" size="17" />
												</div>
												<label class="control-label">Folio</label>
												<input name="folio" type="text" class="form-control input-sm" required readonly value="<?php echo $Rs['folio']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha</label>
												<input name="fecha" type="date" class="form-control input-sm" required disabled value="<?php echo $Rs['fecha']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Folio Compras</label>
												<input name="folio_compras" type="text" class="form-control input-sm" required disabled value="<?php echo $Rs['folio_compras']; ?>">
											</div>
											<div class="col-xs-6">
												<label class="control-label">Empresa que Solicita</label>
												<select name="empresa" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['empresa']; ?></option>
													<option value="CAVI DE SOMBRERETE S.A. de C.V.">CAVI DE SOMBRERETE S.A. de C.V.</option>
													<option value="CONCRETOS CAVI S.A. de C.V.">CONCRETOS CAVI S.A. de C.V.</option>
													<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
													<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)</option>
												</select>
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">No. de Cotización</label>
												<input name="cotizacion" type="text" class="form-control input-sm" required disabled value="<?php echo $Rs['cotizacion']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Monto Total con I.V.A.</label>
												<input name="monto_total" type="number" step="0.01" class="form-control input-sm" required disabled value="<?php echo $Rs['monto_total']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Moneda</label>
												<select name="moneda" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['moneda']; ?></option>
													<option value="MXN">MXN</option>
													<option value="DLLS">DLLS</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Observaciones</label>
												<select name="observaciones" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['observaciones']; ?></option>
													<option value="Se surtirá en parcialidades">Se surtirá en parcialidades</option>
													<option value="Se surtirá conforme se presente el personal">Se surtirá conforme se presente el personal</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Proveedor</label>
												<?php
												mysql_query("SET NAMES 'UTF8'");
												$consulta_mysql = 'SELECT razon_social FROM proveedores ORDER BY razon_social ASC';
												$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
												echo "<select name='proveedor' class='form-control input-sm' disabled>";
												echo "<option> {$Rs['proveedor']}</option>";
												while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
													echo "<option value='" . $fila['razon_social'] . "'>" . $fila['razon_social'] . "</option>";
												}
												echo "</select>";
												?>
											</div>
											<div class="col-xs-4">
												<label class="control-label">Proyecto</label>
												<input name="proyecto" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['proyecto']; ?>">
											</div>
											<div class="col-xs-4">
												<label class="control-label">Agente de Ventas</label>
												<input name="agente_ventas" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['agente_ventas']; ?>">
											</div>

										</div>
										<div class="row form-horizontal">
											<div class="col-xs-3">
												<label class="control-label">Autorización RG Compras</label>
												<input name="aut_fin_g" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['aut_fin_g']; ?>">
											</div>
											<div class="col-xs-3">
												<label class="control-label">Autorización RG Finanzas</label>
												<input name="fecha_aut_g" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_aut_g']; ?>">
											</div>
										</div><br>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 1</label>
												<input id="pt1" name="partida1" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida1']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad1" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad1']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 2</label>
												<input id="pt2" name="partida2" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra2']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 3</label>
												<input id="pt3" name="partida3" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra3']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 4</label>
												<input id="pt4" name="partida4" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra4']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 5</label>
												<input id="pt5" name="partida5" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra5']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 6</label>
												<input id="pt6" name="partida6" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra6']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 7</label>
												<input id="pt7" name="partida7" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra7']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 8</label>
												<input id="pt8" name="partida8" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra8']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 9</label>
												<input id="pt9" name="partida9" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra9']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 10</label>
												<input id="pt10" name="partida10" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra10']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-12">
												<label class="control-label">Notas</label>
												<textarea name="notas" class="form-control input-sm" style="resize: none;"><?php echo $Rs['notas']; ?></textarea>
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Pedido Completo</label>
												<select name="pedido_completo" class="form-control input-sm" disabled>
													<option><?php echo $Rs['pedido_completo']; ?></option>
													<option value="Sí">Sí</option>
													<option value="No">No</option>
												</select>
											</div>
										</div><br>
										<input type="file" name="file[]" id="file" multiple>
										<br><br>
										<div style="height: 200px; overflow-x: auto">
											<?php
											$sql_doc = "SELECT * FROM expediente_documentos WHERE id_aviso='" . $id . "' AND tipo_aviso ='RG'";
											$res_doc = mysql_query($sql_doc, $conexion) or die("Error: " . mysql_error());
											?>
											<table class="table table-striped table-bordered nowrap">
												<thead>
													<tr>
														<th>Archivo</th>
														<th>Borrar</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if (mysql_num_rows($res_doc) > 0) {
														while ($Rsd = mysql_fetch_array($res_doc)) {
															echo "<tr><td><a target='_blank' href='uploads/" . $Rsd['documento'] . "'><img src='icon_pdf.jpg' alt='" . $Rsd['documento'] . "' width='30' height='30'><label style='font-size:11px'>" . $Rsd['documento'] . "</label></a><td><a class='glyphicon glyphicon-remove' href=./adjunto_requisicion_eliminar?id_adj=" . $Rsd["id"] . "></a></td></tr>";
														}
													}
													?>
												</tbody>
											</table>
										</div>
										<br>
										<div id="btn-form">
											<input class="btn form-btn btn-success" type="submit" name="pago_no_aut" value="Pago no autorizado">
											<input class="btn form-btn btn-info" type="submit" name="pago_realizado" value="Pago realizado">
											<input class="btn form-btn btn-success" type="submit" name="autorizado_ant_pagos" value="Autorizado anticipado">
											<input class="btn form-btn btn-danger" type="submit" name="No_autorizado_ant_pagos" value="No autorizado anticipado">
										</div>
									<?php
									}
									if ($_SESSION['usuario'] == 'GCI' || $_SESSION['usuario'] == 'ELADIO') { ?>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<div class="col-xs-2">
													<input name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id']; ?>" size="17" />
												</div>
												<div class="col-xs-2">
													<input name="coordinador" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['coordinador']; ?>" size="17" />
												</div>
												<label class="control-label">Folio</label>
												<input name="folio" type="text" class="form-control input-sm" required readonly value="<?php echo $Rs['folio']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha</label>
												<input name="fecha" type="date" class="form-control input-sm" required disabled value="<?php echo $Rs['fecha']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Folio Compras</label>
												<input name="folio_compras" type="text" class="form-control input-sm" required disabled value="<?php echo $Rs['folio_compras']; ?>">
											</div>
											<div class="col-xs-6">
												<label class="control-label">Empresa que Solicita</label>
												<select name="empresa" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['empresa']; ?></option>
													<option value="CAVI DE SOMBRERETE S.A. de C.V.">CAVI DE SOMBRERETE S.A. de C.V.</option>
													<option value="CONCRETOS CAVI S.A. de C.V.">CONCRETOS CAVI S.A. de C.V.</option>
													<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
													<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)</option>
												</select>
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">No. de Cotización</label>
												<input name="cotizacion" type="text" class="form-control input-sm" required disabled value="<?php echo $Rs['cotizacion']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Monto Total con I.V.A.</label>
												<input name="monto_total" type="number" step="0.01" class="form-control input-sm" required disabled value="<?php echo $Rs['monto_total']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Moneda</label>
												<select name="moneda" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['moneda']; ?></option>
													<option value="MXN">MXN</option>
													<option value="DLLS">DLLS</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Observaciones</label>
												<select name="observaciones" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['observaciones']; ?></option>
													<option value="Se surtirá en parcialidades">Se surtirá en parcialidades</option>
													<option value="Se surtirá conforme se presente el personal">Se surtirá conforme se presente el personal</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Proveedor</label>
												<?php
												mysql_query("SET NAMES 'UTF8'");
												$consulta_mysql = 'SELECT razon_social FROM proveedores ORDER BY razon_social ASC';
												$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
												echo "<select name='proveedor' class='form-control input-sm' disabled>";
												echo "<option> {$Rs['proveedor']}</option>";
												while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
													echo "<option value='" . $fila['razon_social'] . "'>" . $fila['razon_social'] . "</option>";
												}
												echo "</select>";
												?>
											</div>
											<div class="col-xs-4">
												<label class="control-label">Proyecto</label>
												<input name="proyecto" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['proyecto']; ?>">
											</div>
											<div class="col-xs-4">
												<label class="control-label">Agente de Ventas</label>
												<input name="agente_ventas" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['agente_ventas']; ?>">
											</div>

										</div>
										<div class="row form-horizontal">
											<div class="col-xs-3">
												<label class="control-label">Autorización RG Compras</label>
												<input name="aut_fin_g" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['aut_fin_g']; ?>">
											</div>
											<div class="col-xs-3">
												<label class="control-label">Autorización RG Finanzas</label>
												<input name="fecha_aut_g" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_aut_g']; ?>">
											</div>
										</div><br>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 1</label>
												<input id="pt1" name="partida1" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida1']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad1" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad1']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 2</label>
												<input id="pt2" name="partida2" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra2" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra2']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 3</label>
												<input id="pt3" name="partida3" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra3" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra3']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 4</label>
												<input id="pt4" name="partida4" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra4" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra4']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 5</label>
												<input id="pt5" name="partida5" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra5" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra5']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 6</label>
												<input id="pt6" name="partida6" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra6" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra6']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 7</label>
												<input id="pt7" name="partida7" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra7" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra7']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 8</label>
												<input id="pt8" name="partida8" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra8" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra8']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 9</label>
												<input id="pt9" name="partida9" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra9" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra9']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 10</label>
												<input id="pt10" name="partida10" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden_contabilidad10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_orden10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha_pago10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra10" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['pago_compra10']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-12">
												<label class="control-label">Notas</label>
												<textarea name="notas" class="form-control input-sm" style="resize: none;"><?php echo $Rs['notas']; ?></textarea>
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Pedido Completo</label>
												<select name="pedido_completo" class="form-control input-sm" disabled>
													<option><?php echo $Rs['pedido_completo']; ?></option>
													<option value="Sí">Sí</option>
													<option value="No">No</option>
												</select>
											</div>
										</div><br>
										<input type="file" name="file[]" id="file" multiple>
										<br><br>
										<div style="height: 200px; overflow-x: auto">
											<?php
											$sql_doc = "SELECT * FROM expediente_documentos WHERE id_aviso='" . $id . "' AND tipo_aviso ='RG'";
											$res_doc = mysql_query($sql_doc, $conexion) or die("Error: " . mysql_error());
											?>
											<table class="table table-striped table-bordered nowrap">
												<thead>
													<tr>
														<th>Archivo</th>
														<th>Borrar</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if (mysql_num_rows($res_doc) > 0) {
														while ($Rsd = mysql_fetch_array($res_doc)) {
															echo "<tr><td><a target='_blank' href='uploads/" . $Rsd['documento'] . "'><img src='icon_pdf.jpg' alt='" . $Rsd['documento'] . "' width='30' height='30'><label style='font-size:11px'>" . $Rsd['documento'] . "</label></a><td><a class='glyphicon glyphicon-remove' href=./adjunto_requisicion_eliminar?id_adj=" . $Rsd["id"] . "></a></td></tr>";
														}
													}
													?>
												</tbody>
											</table>
										</div>
										<br>
										<div id="btn-form">
											<input class="btn form-btn btn-success" type="submit" name="autorizado_oc_conta" value="Autorizado OC">
											<input class="btn form-btn btn-danger" type="submit" name="No_autorizado_oc_conta" value="No autorizado OC">
											<input class="btn form-btn btn-success" type="submit" name="autorizado_fac_rec" value="Autorizado Fac Rec">
											<input class="btn form-btn btn-danger" type="submit" name="No_autorizado_fac_rec" value="No autorizado Fac Rec">
										</div>
									<?php
									} else if ($_SESSION['usuario'] != 'AVISOS') { ?>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<div class="col-xs-2">
													<input name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id']; ?>" size="17" />
												</div>
												<label class="control-label">Folio</label>
												<input name="folio" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['folio']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha</label>
												<input name="fecha" type="date" class="form-control input-sm" required disabled value="<?php echo $Rs['fecha']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Folio Compras</label>
												<input name="folio_compras" type="text" class="form-control input-sm" required value="<?php echo $Rs['folio_compras']; ?>">
											</div>
											<div class="col-xs-6">
												<label class="control-label">Empresa que Solicita</label>
												<select name="empresa" class="form-control input-sm" required>
													<option><?php echo $Rs['empresa']; ?></option>
													<option value="CAVI DE SOMBRERETE S.A. de C.V.">CAVI DE SOMBRERETE S.A. de C.V.</option>
													<option value="CONCRETOS CAVI S.A. de C.V.">CONCRETOS CAVI S.A. de C.V.</option>
													<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
													<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)</option>
												</select>
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">No. de Cotización</label>
												<input name="cotizacion" type="text" class="form-control input-sm" required value="<?php echo $Rs['cotizacion']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Monto Total con I.V.A.</label>
												<input name="monto_total" type="number" step="0.01" class="form-control input-sm" required value="<?php echo $Rs['monto_total']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Moneda</label>
												<select name="moneda" class="form-control input-sm" required>
													<option><?php echo $Rs['moneda']; ?></option>
													<option value="MXN">MXN</option>
													<option value="DLLS">DLLS</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Observaciones</label>
												<select name="observaciones" class="form-control input-sm" required>
													<option><?php echo $Rs['observaciones']; ?></option>
													<option value="Se surtirá en parcialidades">Se surtirá en parcialidades</option>
													<option value="Se surtirá conforme se presente el personal">Se surtirá conforme se presente el personal</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Proveedor</label>
												<?php
												mysql_query("SET NAMES 'UTF8'");
												$consulta_mysql = 'SELECT razon_social FROM proveedores ORDER BY razon_social ASC';
												$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
												echo "<select name='proveedor' class='form-control input-sm'>";
												echo "<option> {$Rs['proveedor']}</option>";
												while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
													echo "<option value='" . $fila['razon_social'] . "'>" . $fila['razon_social'] . "</option>";
												}
												echo "</select>";
												?>
											</div>
											<div class="col-xs-4">
												<label class="control-label">Proyecto</label>
												<input name="proyecto" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['proyecto']; ?>">
											</div>
											<div class="col-xs-4">
												<label class="control-label">Agente de Ventas</label>
												<input name="agente_ventas" type="text" class="form-control input-sm" value="<?php echo $Rs['agente_ventas']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-3">
												<label class="control-label">Autorización RG Compras</label>
												<input name="aut_fin_g" type="date" class="form-control input-sm" value="<?php echo $Rs['aut_fin_g']; ?>">
											</div>
											<div class="col-xs-3">
												<label class="control-label">Autorización RG Finanzas</label>
												<input name="fecha_aut_g" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_aut_g']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 1</label>
												<input name="partida1" type="number" step="0.01" class="form-control input-sm" disabled value="<?php echo $Rs['partida1']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad1" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad1']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 2</label>
												<input name="partida2" type="number" step="0.01" class="form-control input-sm" disabled value="<?php echo $Rs['partida2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad2" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad1¿2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden2" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago2" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra2" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra2']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 3</label>
												<input name="partida3" type="number" step="0.01" class="form-control input-sm" disabled value="<?php echo $Rs['partida3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad3" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden3" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago3" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra3" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra3']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 4</label>
												<input name="partida4" type="number" step="0.01" class="form-control input-sm" disabled value="<?php echo $Rs['partida4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad4" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden4" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago4" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra4" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra4']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 5</label>
												<input name="partida5" type="number" step="0.01" class="form-control input-sm" disabled value="<?php echo $Rs['partida5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad5" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden5" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago5" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra5" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra5']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 6</label>
												<input name="partida6" type="number" step="0.01" class="form-control input-sm" disabled value="<?php echo $Rs['partida6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad6" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden6" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago6" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra6" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra6']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 7</label>
												<input name="partida7" type="number" step="0.01" class="form-control input-sm" disabled value="<?php echo $Rs['partida7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad7" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden7" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago7" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra7" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra7']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 8</label>
												<input name="partida8" type="number" step="0.01" class="form-control input-sm" disabled value="<?php echo $Rs['partida8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad8" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden8" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago8" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra8" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra8']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 9</label>
												<input name="partida9" type="number" step="0.01" class="form-control input-sm" disabled value="<?php echo $Rs['partida9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad9" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden9" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago9" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra9" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra9']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 10</label>
												<input name="partida10" type="number" step="0.01" class="form-control input-sm" disabled value="<?php echo $Rs['partida10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad10" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden10" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago10" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra10" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra10']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Pedido Completo</label>
												<select name="pedido_completo" class="form-control input-sm">
													<option><?php echo $Rs['pedido_completo']; ?></option>
													<option value="Sí">Sí</option>
													<option value="No">No</option>
												</select>
											</div>
											<!--div class="col-xs-2">
									<label class="control-label">Archivo Digitalizado</label>
									<select name="digitalizado" class="form-control input-sm">
										<option><?php //echo $Rs['digitalizado']; 
												?></option>
										<option value="Sí">Sí</option>
										<option value="No">No</option>
									</select>
									</div-->
										</div><br>
										<input type="file" name="file[]" id="file" multiple>
										<br><br>
										<div style="height: 200px; overflow-x: auto">
											<?php
											$sql_doc = "SELECT * FROM expediente_documentos WHERE id_aviso='" . $id . "' AND tipo_aviso ='RG'";
											$res_doc = mysql_query($sql_doc, $conexion) or die("Error: " . mysql_error());
											?>
											<table class="table table-striped table-bordered nowrap">
												<thead>
													<tr>
														<th>Archivo</th>
														<th>Borrar</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if (mysql_num_rows($res_doc) > 0) {
														while ($Rsd = mysql_fetch_array($res_doc)) {
															echo "<tr><td><a target='_blank' href='uploads/" . $Rsd['documento'] . "'><img src='icon_pdf.jpg' alt='" . $Rsd['documento'] . "' width='30' height='30'><label style='font-size:11px'>" . $Rsd['documento'] . "</label></a><td><a class='glyphicon glyphicon-remove' href=./adjunto_requisicion_eliminar?id_adj=" . $Rsd["id"] . "></a></td></tr>";
														}
													}
													?>
												</tbody>
											</table>
										</div><br>
										<div id="btn-form">
											<input class="btn form-btn btn-primary" type="submit" name="submit" value="Modificar">
											<input class="btn form-btn btn-info" type="submit" name="sol_aut_rg" value="Sol Autorización RG">
											<input class="btn form-btn btn-info" type="submit" name="sol_aut_oc" value="Sol Autorización OC">
											<input class="btn form-btn btn-info" type="submit" name="sol_factura_rec" value="Factura recuperada">
											<!-- <input class="btn form-btn btn-info" type="submit" name="sol_procesamiento" value="Procesamiento" disable> -->
										</div>
									<?php
									} else { ?>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<div class="col-xs-2">
													<input name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id']; ?>" size="17" />
												</div>
												<div class="col-xs-2">
													<input name="coordinador" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['coordinador']; ?>" size="17" />
												</div>
												<label class="control-label">Folio</label>
												<input name="folio" type="text" class="form-control input-sm" required readonly value="<?php echo $Rs['folio']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha</label>
												<input name="fecha" type="date" class="form-control input-sm" required disabled value="<?php echo $Rs['fecha']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Folio Compras</label>
												<input name="folio_compras" type="text" class="form-control input-sm" required disabled value="<?php echo $Rs['folio_compras']; ?>">
											</div>
											<div class="col-xs-6">
												<label class="control-label">Empresa que Solicita</label>
												<select name="empresa" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['empresa']; ?></option>
													<option value="CAVI DE SOMBRERETE S.A. de C.V.">CAVI DE SOMBRERETE S.A. de C.V.</option>
													<option value="CONCRETOS CAVI S.A. de C.V.">CONCRETOS CAVI S.A. de C.V.</option>
													<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
													<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)</option>
												</select>
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">No. de Cotización</label>
												<input name="cotizacion" type="text" class="form-control input-sm" required disabled value="<?php echo $Rs['cotizacion']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Monto Total con I.V.A.</label>
												<input name="monto_total" type="number" step="0.01" class="form-control input-sm" required disabled value="<?php echo $Rs['monto_total']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Moneda</label>
												<select name="moneda" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['moneda']; ?></option>
													<option value="MXN">MXN</option>
													<option value="DLLS">DLLS</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Observaciones</label>
												<select name="observaciones" class="form-control input-sm" required disabled>
													<option><?php echo $Rs['observaciones']; ?></option>
													<option value="Se surtirá en parcialidades">Se surtirá en parcialidades</option>
													<option value="Se surtirá conforme se presente el personal">Se surtirá conforme se presente el personal</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Proveedor</label>
												<?php
												mysql_query("SET NAMES 'UTF8'");
												$consulta_mysql = 'SELECT razon_social FROM proveedores ORDER BY razon_social ASC';
												$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
												echo "<select name='proveedor' class='form-control input-sm' disabled>";
												echo "<option> {$Rs['proveedor']}</option>";
												while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
													echo "<option value='" . $fila['razon_social'] . "'>" . $fila['razon_social'] . "</option>";
												}
												echo "</select>";
												?>
											</div>
											<div class="col-xs-4">
												<label class="control-label">Proyecto</label>
												<input name="proyecto" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['proyecto']; ?>">
											</div>
											<div class="col-xs-4">
												<label class="control-label">Agente de Ventas</label>
												<input name="agente_ventas" type="text" class="form-control input-sm" value="<?php echo $Rs['agente_ventas']; ?>">
											</div>
											<div class="col-xs-2">
												<input name="coordinador" type="hidden" class="form-control input-sm" value="<?php echo $Rs['coordinador']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-3">
												<label class="control-label">Autorización RG Compras</label>
												<input name="aut_fin_g" type="date" class="form-control input-sm" value="<?php echo $Rs['aut_fin_g']; ?>">
											</div>
											<div class="col-xs-3">
												<label class="control-label">Autorización RG Finanzas</label>
												<input name="fecha_aut_g" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_aut_g']; ?>">
											</div>
										</div>

										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 1</label>
												<input id="pt1" name="partida1" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida1']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad1" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad1']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 2</label>
												<input id="pt2" name="partida2" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad2" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden2" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago2" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago2']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra2" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra2']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 3</label>
												<input id="pt3" name="partida3" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad3" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden3" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago3" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago3']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra3" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra3']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 4</label>
												<input id="pt4" name="partida4" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad4" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden4" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago4" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago4']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra4" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra4']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 5</label>
												<input id="pt5" name="partida5" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad5" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden5" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago5" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago5']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra5" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra5']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 6</label>
												<input id="pt6" name="partida6" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad6" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden6" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago6" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago6']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra6" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra6']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 7</label>
												<input id="pt7" name="partida7" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad7" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden7" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago7" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago7']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra7" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra7']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 8</label>
												<input id="pt8" name="partida8" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad8" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden8" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago8" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago8']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra8" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra8']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 9</label>
												<input id="pt9" name="partida9" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad9" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden9" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago9" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago9']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra9" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra9']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Partida 10</label>
												<input id="pt10" name="partida10" type="number" step="0.01" class="form-control input-sm" readonly value="<?php echo $Rs['partida10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Compras</label>
												<input name="fecha_orden_contabilidad10" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden_contabilidad10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Contabilidad</label>
												<input name="fecha_orden10" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_orden10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Autorización OC Finanzas</label>
												<input name="fecha_pago10" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_pago10']; ?>">
											</div>
											<div class="col-xs-2">
												<label class="control-label">Fecha de Pago de Compra</label>
												<input name="pago_compra10" type="date" class="form-control input-sm" value="<?php echo $Rs['pago_compra10']; ?>">
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-12">
												<label class="control-label">Notas</label>
												<textarea name="notas" class="form-control input-sm" style="resize: none;"><?php echo $Rs['notas']; ?></textarea>
											</div>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-2">
												<label class="control-label">Pedido Completo</label>
												<select name="pedido_completo" class="form-control input-sm">
													<option><?php echo $Rs['pedido_completo']; ?></option>
													<option value="Sí">Sí</option>
													<option value="No">No</option>
												</select>
											</div>
										</div>
										<input type="file" name="file[]" id="file" multiple>
										<br><br>
										<div style="height: 200px; overflow-x: auto">
											<?php
											$sql_doc = "SELECT * FROM expediente_documentos WHERE id_aviso='" . $id . "' AND tipo_aviso ='RG'";
											$res_doc = mysql_query($sql_doc, $conexion) or die("Error: " . mysql_error());
											?>
											<table class="table table-striped table-bordered nowrap">
												<thead>
													<tr>
														<th>Archivo</th>
														<th>Borrar</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if (mysql_num_rows($res_doc) > 0) {
														while ($Rsd = mysql_fetch_array($res_doc)) {
															echo "<tr><td><a target='_blank' href='uploads/" . $Rsd['documento'] . "'><img src='icon_pdf.jpg' alt='" . $Rsd['documento'] . "' width='30' height='30'><label style='font-size:11px'>" . $Rsd['documento'] . "</label></a><td><a class='glyphicon glyphicon-remove' href=./adjunto_requisicion_eliminar?id_adj=" . $Rsd["id"] . "></a></td></tr>";
														}
													}
													?>
												</tbody>
											</table>
										</div>
										<div class="row form-horizontal">
											<div class="col-xs-3">
												<label class="control-label">Autorizada por:</label>
												<select name="autorizado_por_rg" class="form-control input-sm">
													<option><?php echo $Rs['autorizado_por_rg']; ?></option>
													<option value="COMPRADOR 2">COMPRADOR 2</option>
													<option value="COMPRADOR 1">COMPRADOR 1</option>
													<option value="Raquel Grijalva">Raquel Grijalva</option>
												</select>
											</div>
										</div><br>
										<input class="btn form-btn btn-success" type="submit" name="autorizado_rg" value="Autorizado RG">
										<input class="btn form-btn btn-danger" type="submit" name="No_autorizado_rg" value="No autorizado RG">
										<br>
										<div class="row form-horizontal">
											<div class="col-xs-3">
												<label class="control-label">Autorizada por:</label>
												<select name="autorizado_por_oc" class="form-control input-sm">
													<option><?php echo $Rs['autorizado_por_oc']; ?></option>
													<option value="COMPRADOR 2">COMPRADOR 2</option>
													<option value="COMPRADOR 1">COMPRADOR 1</option>
													<option value="Raquel Grijalva">Raquel Grijalva</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label class="control-label">Empresa:</label>
												<select name="empresa_por" class="form-control input-sm">
													<option><?php echo $Rs['empresa_por']; ?></option>
													<option value="Cavi">Cavi</option>
													<option value="Concretos">Concretos</option>
													<option value="Montajes">Montajes</option>
													<option value="Sucursal Concretos">Sucursal Concretos</option>
													<option value="Sucursal Montajes">Sucursal Montajes</option>
												</select>
											</div>
										</div>
										<br>
										<div id="btn-form">
											<input class="btn form-btn btn-success" type="submit" name="autorizado_oc" value="Autorizado OC">
											<input class="btn form-btn btn-danger" type="submit" name="No_autorizado_oc" value="No autorizado OC">
											<br><br>
											<input class="btn form-btn btn-info" type="submit" name="sol_aut_ant" value="Sol autorización anticipada">
											<br><br>
											<input class="btn form-btn btn-primary" type="submit" name="submit" value="Modificar">
										</div>
									<?php
									}
									?>
								</form>
					<?php
						}
					} else {
						echo "<script languaje='javascript'>
						alert('No fue posible realizar la operacion solicitada')
					javascript:history.go(-2)
							</script>";
					}
				}
				// Cerramos la conexión
				mysql_close($conexion);
					?>
							</div>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../../js/bootstrap.min.js"></script>
		<script type="text/javascript">
			document.getElementById('at1').addEventListener('change', function(e) {
				if (e.target.value === "Sí") {
					$('#pt1').prop('readonly', false);
				} else {
					$('#pt1').prop('readonly', true);
				}
			});
			document.getElementById('at2').addEventListener('change', function(e) {
				if (e.target.value === "Sí") {
					$('#pt2').prop('readonly', false);
				} else {
					$('#pt2').prop('readonly', true);
				}
			});
			document.getElementById('at3').addEventListener('change', function(e) {
				if (e.target.value === "Sí") {
					$('#pt3').prop('readonly', false);
				} else {
					$('#pt3').prop('readonly', true);
				}
			});
			document.getElementById('at4').addEventListener('change', function(e) {
				if (e.target.value === "Sí") {
					$('#pt4').prop('readonly', false);
				} else {
					$('#pt4').prop('readonly', true);
				}
			});
			document.getElementById('at5').addEventListener('change', function(e) {
				if (e.target.value === "Sí") {
					$('#pt5').prop('readonly', false);
				} else {
					$('#pt5').prop('readonly', true);
				}
			});
			document.getElementById('at6').addEventListener('change', function(e) {
				if (e.target.value === "Sí") {
					$('#pt6').prop('readonly', false);
				} else {
					$('#pt6').prop('readonly', true);
				}
			});
			document.getElementById('at7').addEventListener('change', function(e) {
				if (e.target.value === "Sí") {
					$('#pt7').prop('readonly', false);
				} else {
					$('#pt7').prop('readonly', true);
				}
			});
			document.getElementById('at8').addEventListener('change', function(e) {
				if (e.target.value === "Sí") {
					$('#pt8').prop('readonly', false);
				} else {
					$('#pt8').prop('readonly', true);
				}
			});
			document.getElementById('at9').addEventListener('change', function(e) {
				if (e.target.value === "Sí") {
					$('#pt9').prop('readonly', false);
				} else {
					$('#pt9').prop('readonly', true);
				}
			});
			document.getElementById('at10').addEventListener('change', function(e) {
				if (e.target.value === "Sí") {
					$('#pt10').prop('readonly', false);
				} else {
					$('#pt10').prop('readonly', true);
				}
			});
		</script>
</body>

</html>