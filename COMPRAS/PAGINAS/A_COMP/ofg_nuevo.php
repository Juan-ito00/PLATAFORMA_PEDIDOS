<?php
date_default_timezone_set("Mexico/General");
session_start();
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario'])) {
	header('Location: ../../index');
	exit();
}
include("../../conexion/conexion.php");
$conexion = Conectarse();
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Oficio Gral Nuevo</title>
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
				<a class="navbar-brand" href="inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
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
				<div class="element">
					<form action="ofg_registrar" method="post">
						<div class="row form-horizontal">
							<div class="col-xs-2">
								<label class="control-label">Folio</label>
								<input readonly align="right" name="folio" class="form-control input-sm" value="<?php

																												mysql_query("SET NAMES 'utf8'");
																												$result = mysql_query("SELECT id FROM folios_ofg ORDER BY id DESC LIMIT 1", $conexion);
																												if ($row = mysql_fetch_array($result)) {
																													do {
																														$folio = strtoupper(("GCOMP ") . str_pad($row["id"] + 1, 3, '0', STR_PAD_LEFT) . date("/ y"));
																														echo $folio;
																													} while ($row = mysql_fetch_array($result));
																												} else {
																													$currY = date("y");
																													echo "GCOMP 001/ " . $currY;
																												}
																												?> ">
							</div>
							<div class="col-xs-2">
								<label class="control-label">Fecha</label>
								<input name="fecha" type="date" class="form-control input-sm" required>
							</div>
						</div>
						<br><br>
						<div class="row form-horizontal">
							<div class="col-xs-12">
								<label class="control-label">Asunto</label>
								<textarea name="asunto" class="form-control input-sm" style="resize: none;" required></textarea>
							</div>
						</div>
						<div class="row form-horizontal">
							<div class="col-xs-3">
								<label class="control-label">Dirigido a:</label>
								<select name="dirigido_a" id="dirigido" class='form-control input-sm'>
									<option disabled selected>- Selecciona -</option>
									<option value="cg">Cargos Generales</option>
									<option value="dest">Insertar Destinatarios</option>
								</select>
							</div>
						</div>
						<br>
						<div class="row form-horizontal" style="display: none;" id="ocg">
							<div class="col-xs-6">
								<input name="cargos_grales" type="text" class="form-control input-sm" placeholder="Escribe los Cargos Generales">
							</div>
						</div>
						<div class="row form-horizontal" style="display: none;" id="odest1">
							<div class="col-xs-5">
								<?php
								mysql_query("SET NAMES 'UTF8'");
								$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
								$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
								echo "<select name='destinatario1' class='form-control input-sm'>";
								echo "<option disabled selected class='form-control input-sm'>" . "- Selecciona-" . "</option>";
								while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
									echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
								}
								echo "</select>";
								?>
							</div>
							<div class="col-xs-2">
								<select class='form-control input-sm' name="firma1" disabled>
									<option disabled selected>- Firma -</option>
									<option value="Elaboró">Elaboró</option>
									<option value="Recibió">Recibió</option>
									<option value="Enterado">Enterado</option>
									<option value="Autorizado">Autorizado</option>
								</select>
							</div>
						</div>
						<div class="row form-horizontal" style="display: none;" id="odest2">
							<div class="col-xs-5">
								<?php
								mysql_query("SET NAMES 'UTF8'");
								$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
								$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
								echo "<select name='destinatario2' class='form-control input-sm'>";
								echo "<option disabled selected class='form-control input-sm'>" . "- Selecciona-" . "</option>";
								while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
									echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
								}
								echo "</select>";
								?>
							</div>
							<div class="col-xs-2">
								<select class='form-control input-sm' name="firma2" disabled>
									<option disabled selected>- Firma -</option>
									<option value="Elaboró">Elaboró</option>
									<option value="Recibió">Recibió</option>
									<option value="Enterado">Enterado</option>
									<option value="Autorizado">Autorizado</option>
								</select>
							</div>
						</div>
						<div class="row form-horizontal" style="display: none;" id="odest3">
							<div class="col-xs-5">
								<?php
								mysql_query("SET NAMES 'UTF8'");
								$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
								$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
								echo "<select name='destinatario3' class='form-control input-sm'>";
								echo "<option disabled selected class='form-control input-sm'>" . "- Selecciona-" . "</option>";
								while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
									echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
								}
								echo "</select>";
								?>
							</div>
							<div class="col-xs-2">
								<select class='form-control input-sm' name="firma3" disabled>
									<option disabled selected>- Firma -</option>
									<option value="Elaboró">Elaboró</option>
									<option value="Recibió">Recibió</option>
									<option value="Enterado">Enterado</option>
									<option value="Autorizado">Autorizado</option>
								</select>
							</div>
						</div>
						<div class="row form-horizontal" style="display: none;" id="odest4">
							<div class="col-xs-5">
								<?php
								mysql_query("SET NAMES 'UTF8'");
								$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
								$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
								echo "<select name='destinatario4' class='form-control input-sm'>";
								echo "<option disabled selected class='form-control input-sm'>" . "- Selecciona-" . "</option>";
								while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
									echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
								}
								echo "</select>";
								?>
							</div>
							<div class="col-xs-2">
								<select class='form-control input-sm' name="firma4" disabled>
									<option disabled selected>- Firma -</option>
									<option value="Elaboró">Elaboró</option>
									<option value="Recibió">Recibió</option>
									<option value="Enterado">Enterado</option>
									<option value="Autorizado">Autorizado</option>
								</select>
							</div>
						</div>
						<div class="row form-horizontal" style="display: none;" id="odest5">
							<div class="col-xs-5">
								<?php
								mysql_query("SET NAMES 'UTF8'");
								$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
								$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
								echo "<select name='destinatario5' class='form-control input-sm'>";
								echo "<option disabled selected class='form-control input-sm'>" . "- Selecciona-" . "</option>";
								while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
									echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
								}
								echo "</select>";
								?>
							</div>
							<div class="col-xs-2">
								<select class='form-control input-sm' name="firma5" disabled>
									<option disabled selected>- Firma -</option>
									<option value="Elaboró">Elaboró</option>
									<option value="Recibió">Recibió</option>
									<option value="Enterado">Enterado</option>
									<option value="Autorizado">Autorizado</option>
								</select>
							</div>
						</div>
						<div class="row form-horizontal" style="display: none;" id="odest6">
							<div class="col-xs-5">
								<?php
								mysql_query("SET NAMES 'UTF8'");
								$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
								$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
								echo "<select name='destinatario6' class='form-control input-sm'>";
								echo "<option disabled selected class='form-control input-sm'>" . "- Selecciona-" . "</option>";
								while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
									echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
								}
								echo "</select>";
								?>
							</div>
							<div class="col-xs-2">
								<select class='form-control input-sm' name="firma6" disabled>
									<option disabled selected>- Firma -</option>
									<option value="Elaboró">Elaboró</option>
									<option value="Recibió">Recibió</option>
									<option value="Enterado">Enterado</option>
									<option value="Autorizado">Autorizado</option>
								</select>
							</div>
						</div>
						<div class="row form-horizontal" style="display: none;" id="odest7">
							<div class="col-xs-5">
								<?php
								mysql_query("SET NAMES 'UTF8'");
								$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
								$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
								echo "<select name='destinatario7' class='form-control input-sm'>";
								echo "<option disabled selected class='form-control input-sm'>" . "- Selecciona-" . "</option>";
								while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
									echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
								}
								echo "</select>";
								?>
							</div>
							<div class="col-xs-2">
								<select class='form-control input-sm' name="firma7" disabled>
									<option disabled selected>- Firma -</option>
									<option value="Elaboró">Elaboró</option>
									<option value="Recibió">Recibió</option>
									<option value="Enterado">Enterado</option>
									<option value="Autorizado">Autorizado</option>
								</select>
							</div>
						</div>
						<div class="row form-horizontal" style="display: none;" id="odest8">
							<div class="col-xs-5">
								<?php
								mysql_query("SET NAMES 'UTF8'");
								$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
								$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
								echo "<select name='destinatario8' class='form-control input-sm'>";
								echo "<option disabled selected class='form-control input-sm'>" . "- Selecciona-" . "</option>";
								while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
									echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
								}
								echo "</select>";
								?>
							</div>
							<div class="col-xs-2">
								<select class='form-control input-sm' name="firma8" disabled>
									<option disabled selected>- Firma -</option>
									<option value="Elaboró">Elaboró</option>
									<option value="Recibió">Recibió</option>
									<option value="Enterado">Enterado</option>
									<option value="Autorizado">Autorizado</option>
								</select>
							</div>
						</div>
						<div class="row form-horizontal">
							<div class="col-xs-3">
								<label class="control-label">Firma Ing. Raquel Grijalva</label>
								<select class='form-control input-sm' name="firma_gercomp">
									<option disabled selected>- Firma -</option>
									<option value="Elaboró">Elaboró</option>
									<option value="Recibió">Recibió</option>
									<option value="Enterado">Enterado</option>
									<option value="Autorizado">Autorizado</option>
								</select>
							</div>
						</div>
						<div class="row form-horizontal">
							<div class="col-xs-12">
								<label class="control-label">Cuerpo del Mensaje</label>
								<textarea name="cuerpo" class="form-control input-sm" required></textarea>
							</div>
						</div>
						<div class="row form-horizontal">
							<div class="col-xs-5">
								<label class="control-label">Elaboró:</label>
								<?php
								mysql_query("SET NAMES 'UTF8'");
								$consulta_mysql = 'select * from elaboro_oficio ORDER BY nombre ASC';
								$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
								echo "<select name='elaboro_nom' class='form-control input-sm'>";
								echo "<option disabled selected class='form-control input-sm'>" . "- Selecciona-" . "</option>";
								while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
									echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
								}
								echo "</select>";
								?>
							</div>
						</div>
						<br>
						<div style="margin-top: 5px; margin-bottom:5px;">
							<button class="btn btn-primary">Crear</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="../../js/bootstrap.min.js"></script>
	<script type="text/javascript">
		document.getElementById('dirigido').addEventListener('change', function(e) {
			if (e.target.value === "cg") {
				$("#odest1").hide();
				$("#odest2").hide();
				$("#odest3").hide();
				$("#odest4").hide();
				$("#odest5").hide();
				$("#odest6").hide();
				$("#odest7").hide();
				$("#odest8").hide();
				$("#ocg").show();
			} else if (e.target.value === "dest") {
				$("#odest1").show();
				$("#odest2").show();
				$("#odest3").show();
				$("#odest4").show();
				$("#odest5").show();
				$("#odest6").show();
				$("#odest7").show();
				$("#odest8").show();
				$("#ocg").hide();
			}
		});
	</script>
</body>

</html>