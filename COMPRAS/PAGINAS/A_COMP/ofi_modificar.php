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
	<title>Oficio Inc Modificar</title>
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
				<?php
				header("Content-Type: text/html;charset=utf-8");
				error_reporting(E_ALL ^ E_NOTICE);
				mysql_query("SET NAMES 'utf8'");
				if (isset($_POST["submit"])) {
					$query = "UPDATE oficios_incidencias SET asunto='" . $_POST["asunto"] . "',cargos_grales='" . $_POST["cargos_grales"] . "',dirigido1='" . $_POST["dirigido1"] . "',firma1='" . $_POST["firma1"] . "',dirigido2='" . $_POST["dirigido2"] . "',firma2='" . $_POST["firma2"] . "',dirigido3='" . $_POST["dirigido3"] . "',firma3='" . $_POST["firma3"] . "',dirigido4='" . $_POST["dirigido4"] . "',firma4='" . $_POST["firma4"] . "',dirigido5='" . $_POST["dirigido5"] . "',firma5='" . $_POST["firma5"] . "',dirigido6='" . $_POST["dirigido6"] . "',firma6='" . $_POST["firma6"] . "',dirigido7='" . $_POST["dirigido7"] . "',firma7='" . $_POST["firma7"] . "',dirigido8='" . $_POST["dirigido8"] . "',firma8='" . $_POST["firma8"] . "',firma_gercomp='" . $_POST["firma_gercomp"] . "',cuerpo='" . $_POST["cuerpo"] . "',elaboro='" . $_POST["elaboro_nom"] . "' WHERE id='" . $_POST["id"] . "'";
					$result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

					echo "<script languaje='javascript'>
                    alert('Modificado')
        			location.href='historial_ofi';
                  </script>";
				} else {
					$id_m = $_GET['id_m'];
					$sql_query = "SELECT * FROM oficios_incidencias WHERE id='" . $id_m . "'";
					$resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());
					if (mysql_num_rows($resultado) > 0) {
						while ($Rs = mysql_fetch_array($resultado)) {
				?>
							<div class="element">
								<form action="ofi_modificar" method="post">
									<div class="row form-horizontal">
										<div class="col-xs-2">
											<label class="control-label">Folio</label>
											<input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?>">
										</div>
										<div class="col-xs-2">
											<label class="control-label">Fecha</label>
											<input name="fecha" type="date" class="form-control input-sm" readonly value="<?php echo $Rs['fecha']; ?>">
										</div>
									</div>
									<br><br>
									<div class="row form-horizontal">
										<div class="col-xs-12">
											<label class="control-label">Asunto</label>
											<textarea name="asunto" class="form-control input-sm" style="resize: none;"><?php echo $Rs['asunto']; ?></textarea>
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-3">
											<label class="control-label">Dirigido a:</label>
										</div>
									</div>
									<br>
									<div class="row form-horizontal">
										<div class="col-xs-5">
											<input name="cargos_grales" type="text" class="form-control input-sm" value="<?php echo $Rs['cargos_grales']; ?>">
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-5">
											<?php
											mysql_query("SET NAMES 'UTF8'");
											$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
											$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
											echo "<select name='dirigido1' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>" . $Rs['dirigido1'] . "</option>";
											while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
												echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
											}
											echo "</select>";
											?>
										</div>
										<div class="col-xs-2">
											<select class='form-control input-sm' name="firma1">
												<option selected><?php echo $Rs['firma1']; ?></option>
												<option value="Elaboró">Elaboró</option>
												<option value="Recibió">Recibió</option>
												<option value="Enterado">Enterado</option>
												<option value="Autorizado">Autorizado</option>
											</select>
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-5">
											<?php
											mysql_query("SET NAMES 'UTF8'");
											$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
											$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
											echo "<select name='dirigido2' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>" . $Rs['dirigido2'] . "</option>";
											while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
												echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
											}
											echo "</select>";
											?>
										</div>
										<div class="col-xs-2">
											<select class='form-control input-sm' name="firma2">
												<option selected><?php echo $Rs['firma2']; ?></option>
												<option value="Elaboró">Elaboró</option>
												<option value="Recibió">Recibió</option>
												<option value="Enterado">Enterado</option>
												<option value="Autorizado">Autorizado</option>
											</select>
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-5">
											<?php
											mysql_query("SET NAMES 'UTF8'");
											$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
											$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
											echo "<select name='dirigido3' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>" . $Rs['dirigido3'] . "</option>";
											while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
												echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
											}
											echo "</select>";
											?>
										</div>
										<div class="col-xs-2">
											<select class='form-control input-sm' name="firma3">
												<option selected><?php echo $Rs['firma3']; ?></option>
												<option value="Elaboró">Elaboró</option>
												<option value="Recibió">Recibió</option>
												<option value="Enterado">Enterado</option>
												<option value="Autorizado">Autorizado</option>
											</select>
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-5">
											<?php
											mysql_query("SET NAMES 'UTF8'");
											$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
											$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
											echo "<select name='dirigido4' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>" . $Rs['dirigido4'] . "</option>";
											while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
												echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
											}
											echo "</select>";
											?>
										</div>
										<div class="col-xs-2">
											<select class='form-control input-sm' name="firma4">
												<option selected><?php echo $Rs['firma4']; ?></option>
												<option value="Elaboró">Elaboró</option>
												<option value="Recibió">Recibió</option>
												<option value="Enterado">Enterado</option>
												<option value="Autorizado">Autorizado</option>
											</select>
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-5">
											<?php
											mysql_query("SET NAMES 'UTF8'");
											$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
											$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
											echo "<select name='dirigido5' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>" . $Rs['dirigido5'] . "</option>";
											while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
												echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
											}
											echo "</select>";
											?>
										</div>
										<div class="col-xs-2">
											<select class='form-control input-sm' name="firma5">
												<option selected><?php echo $Rs['firma5']; ?></option>
												<option value="Elaboró">Elaboró</option>
												<option value="Recibió">Recibió</option>
												<option value="Enterado">Enterado</option>
												<option value="Autorizado">Autorizado</option>
											</select>
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-5">
											<?php
											mysql_query("SET NAMES 'UTF8'");
											$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
											$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
											echo "<select name='dirigido6' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>" . $Rs['dirigido6'] . "</option>";
											while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
												echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
											}
											echo "</select>";
											?>
										</div>
										<div class="col-xs-2">
											<select class='form-control input-sm' name="firma6">
												<option selected><?php echo $Rs['firma6']; ?></option>
												<option value="Elaboró">Elaboró</option>
												<option value="Recibió">Recibió</option>
												<option value="Enterado">Enterado</option>
												<option value="Autorizado">Autorizado</option>
											</select>
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-5">
											<?php
											mysql_query("SET NAMES 'UTF8'");
											$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
											$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
											echo "<select name='dirigido7' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>" . $Rs['dirigido7'] . "</option>";
											while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
												echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
											}
											echo "</select>";
											?>
										</div>
										<div class="col-xs-2">
											<select class='form-control input-sm' name="firma7">
												<option selected><?php echo $Rs['firma7']; ?></option>
												<option value="Elaboró">Elaboró</option>
												<option value="Recibió">Recibió</option>
												<option value="Enterado">Enterado</option>
												<option value="Autorizado">Autorizado</option>
											</select>
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-5">
											<?php
											mysql_query("SET NAMES 'UTF8'");
											$consulta_mysql = 'select * from destinatarios ORDER BY nombre ASC';
											$resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
											echo "<select name='dirigido8' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>" . $Rs['dirigido8'] . "</option>";
											while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
												echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
											}
											echo "</select>";
											?>
										</div>
										<div class="col-xs-2">
											<select class='form-control input-sm' name="firma8">
												<option selected><?php echo $Rs['firma8']; ?></option>
												<option value="Elaboró">Elaboró</option>
												<option value="Recibió">Recibió</option>
												<option value="Enterado">Enterado</option>
												<option value="Autorizado">Autorizado</option>
											</select>
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-2">
											<label class="control-label">Firma Ing. Raquel Grijalva</label>
											<select class='form-control input-sm' name="firma_gercomp">
												<option selected><?php echo $Rs['firma_gercomp']; ?></option>
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
											<textarea name="cuerpo" class="form-control input-sm"><?php echo $Rs['cuerpo']; ?></textarea>
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
											echo "<option disabled selected class='form-control input-sm'>" . $Rs['elaboro'] . "</option>";
											while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
												echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
											}
											echo "</select>";
											?>
										</div>
									</div>
									<br>
									<div class="row form-horizontal">
										<div class="col-xs-2">
											<div id="btn-form" style="margin-top: 25px;">
												<input class="btn form-btn btn-primary" type="submit" name="submit" value="Modificar">
											</div>
										</div>
										<div class="col-xs-1">
											<input name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id']; ?>" size="17" />
										</div>
									</div>
							</div>
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
</body>

</html>