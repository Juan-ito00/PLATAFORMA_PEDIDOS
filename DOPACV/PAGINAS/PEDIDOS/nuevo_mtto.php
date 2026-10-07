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
	<title>Nuevo Pedido</title>
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
			<!-- El logotipo y el icono que despliega el menú se agrupan
        para mostrarlos mejor en los dispositivos móviles -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Desplegar navegación</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
			</div>
			<!-- Agrupar los enlaces de navegación, los formularios y cualquier
         	otro elemento que se pueda ocultar al minimizar la barra -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Nuevo Pedido<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="nuevo">Compras</a></li>
							<li><a href="nuevo_int">Servicios Internos</a></li>
							<li><a href="nuevo_mtto">Mantenimientos</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="historial_gen">Compras</a></li>
							<li><a href="historial_int">Servicios Internos</a></li>
							<li><a href="historial_mtto">Mantenimientos</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"> </span> Reporte<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="reporte_general">Compras</a></li>
							<li><a href="reporte_general_int">Servicios Internos</a></li>
						</ul>
					</li>
					<li><a href="obras"><span class="glyphicon glyphicon-road"> </span> Obras</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido " . $_SESSION['usuario'] . " | "; ?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
				</ul>
			</div>
		</nav>
		<!--Panel con el titulo de la pagina y contenido-->
		<div class="panel panel-default " style="margin-top: 5px;">
			<div class="panel-body">
				<div class="element">
					<form action="insertar_mtto" method="post">
						<div class="row form-horizontal">
							<div class="col-xs-2">
								<label class="control-label">Fecha</label>
								<input name="fecha" type="date" class="form-control input-sm" required readonly value="<?php echo date('Y-m-d'); ?>">
							</div>
							<div class="col-xs-1"></div>
							<div class="col-xs-2">
								<label class="control-label">Folio Ger. Solicitante</label>
								<input required readonly align="right" name="folio_ger" class="form-control input-sm" value="<?php

																																mysql_query("SET NAMES 'utf8'");
																																$result = mysql_query("SELECT id FROM folios_dopacv_mttos ORDER BY id DESC LIMIT 1", $conexion);
																																if ($row = mysql_fetch_array($result)) {
																																	do {
																																		$folio = strtoupper(("DOFM SIE-MTTO ") . str_pad($row["id"] + 1, 3, '0', STR_PAD_LEFT) . date("/ y"));
																																		echo $folio;
																																	} while ($row = mysql_fetch_array($result));
																																} else {
																																	$year = date("y");
																																	echo "DOFM SIE-MTTO 01/ " . $year;
																																}
																																?> ">
							</div>
							<div class="col-xs-4">
								<label class="control-label">Solicitante</label>
								<input name="solicitante" type="text" class="form-control input-sm" required readonly value='<?php echo $_SESSION['nombre'] ?>'>
							</div>
						</div>
						<div class="row form-horizontal">
							<div class="col-xs-5">
								<label class="control-label">Gerencia que Solicita</label>
								<input name="gerencia" type="text" class="form-control input-sm" readonly required value="Dirección de Fabricación y Mantenimientos en Soldadura Industrial y Enlainados">
							</div>
							<div class="col-xs-5">
								<label class="control-label">Departamento</label>
								<input name="departamento" type="text" class="form-control input-sm" required>
							</div>
						</div>
						<div class="row form-horizontal">
							<div class="col-xs-10">
								<label class="control-label">Lugar de Realización</label>
								<input name="lugar" type="text" class="form-control input-sm" required>
							</div>
						</div>
						<div class="row form-horizontal">
							<div class="col-xs-10">
								<label class="control-label">Descripción</label>
								<textarea name="descripcion" class="form-control "></textarea>
							</div>
						</div>
						<div class="row form-horizontal">
							<!--Caja de notas-->
							<div class="col-xs-10">
								<label class="control-label">Notas</label>
								<textarea name="notas" class="form-control "></textarea>
							</div>
						</div>
						<br>
						<!--Boton crear-->
						<div style="margin-top: 5px; margin-bottom:5px;">
							<button class="btn btn-primary">Crear</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../../js/bootstrap.min.js"></script>
</body>

</html>