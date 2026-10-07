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
	<title>Nuevo Concepto</title>
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
				<ul class="nav navbar-nav navbar-right">
					<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido " . ucwords($_SESSION['usuario']) . " | "; ?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
				</ul>
			</div>
		</nav>
		<!--Panel con el titulo de la pagina y contenido-->
		<div class="panel panel-default " style="margin-top: 5px;">
			<div class="panel-body">
				<div class="element">
					<form action="concepto_insertar" method="post">
						<div class="row form-horizontal">
							<div class="col-xs-2">
								<label class="control-label">Código</label>
								<input name="codigo" type="text" class="form-control input-sm" required>
							</div>
						</div>
						<div class="row form-horizontal">
							<div class="col-xs-2">
								<label class="control-label">Unidad</label>
								<input name="unidad" required type="text" class="form-control input-sm">
							</div>
						</div>
						<div class="row form-horizontal">
							<div class="col-xs-4">
								<label class="control-label">Catálogo</label>
								<select name="catalogo" class="form-control input-sm" required>
									<option value="Alimentación" class="form-control input-sm" id="">Alimentación</option>
									<option value="Consumibles" class="form-control input-sm">Consumibles</option>
									<option value="EPP" class="form-control input-sm">EPP</option>
									<option value="Exámenes Médicos" class="form-control input-sm">Exámenes Médicos</option>
									<option value="Herramienta" class="form-control input-sm">Herramienta</option>
									<option value="Hospedaje" class="form-control input-sm">Hospedaje</option>
									<option value="Materiales" class="form-control input-sm">Materiales</option>
									<option value="Servicios" class="form-control input-sm">Servicios</option>
								</select>
							</div>
						</div>
						<div class="row form-horizontal">
							<div class="col-xs-10">
								<label class="control-label">Descripción</label>
								<textarea name="descripcion" class="form-control " required></textarea>
							</div>
						</div>
						<div style="margin-top: 5px; margin-bottom:5px;">
							<button class="btn btn-success">Guardar</button>
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