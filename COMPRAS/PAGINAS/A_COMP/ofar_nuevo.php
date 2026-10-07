<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
	{
		header('Location: ../../index');
		exit();
	}
	include("../../conexion/conexion.php"); 
	$conexion=Conectarse();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Asignación de Ruta Nueva</title>
		<!-- Bootstrap -->
		<link href="../../css/bootstrap.min.css" rel="stylesheet">
		<style type="text/css">
		.rojo {background-color:#FF0000;}
		.azul {color:#0066FF;}
		.verde {color:#009900;}
		select{
			background-color:#FF66FF;
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
							if($_SESSION['usuario']=='AVISOS')
							{?>
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
                        <li><a href="ofar_nuevo">Nueva Asignación de Ruta</a></li>
						<li><a href="historial_ofar">Historial Asignaciones de Ruta</a></li>
						<li><a href="ofv_nuevo">Nuevo Oficio Vacaciones</a></li>
						<li><a href="historial_ofv">Historial Oficios Vacaciones</a></li>
						<li><a href="ofscvac_nuevo">Nuevo Oficio Permiso a Cuenta de Vacaciones</a></li>
						<li><a href="historial_ofscvac">Historial Permisos a Cuenta de Vacaciones</a></li>
					</ul>
				</li>
							<?php
							}
							else if($_SESSION['usuario']=='ACCYNTHIA')
							{?>
								
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
							}
							else
							{?>
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
							}?>
						</ul>
					<ul class="nav navbar-nav navbar-right">
							<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
						</ul>
				</div>
			</nav>
				<!--Panel con el titulo de la pagina y contenido-->
				<div class="panel panel-default " style="margin-top: 5px;">
						<div class="panel-body">
				<div class="element">
					<form action="ofar_registrar" method="post">
							<div class="row form-horizontal">
								<div class="col-xs-3">
									<label class="control-label">Folio</label>
									<input readonly align="right" name="folio" class="form-control input-sm" value="<?php 
								
								mysql_query("SET NAMES 'utf8'");
								$result = mysql_query("SELECT id FROM folios_rutas ORDER BY id DESC LIMIT 1", $conexion); 								
								if ($row = mysql_fetch_array($result)){ 
   									do {  
										$folio = strtoupper( ("ASIGNACION DE RUTA ").str_pad($row["id"]+1,3,'0',STR_PAD_LEFT).date("/ y"));
										echo $folio;
   									} while ($row = mysql_fetch_array($result)); 
   					
								} else {
									$currY = date("y");
									echo "ASIGNACION DE RUTA 001/ ".$currY; 
								} 
							?> " >
								</div>
								<div class="col-xs-3">
									<label class="control-label">Fecha</label>
									<input name="fecha" type="date" class="form-control input-sm" required>
								</div>
                                <div class="col-xs-3">
									<label class="control-label">Ruta</label>
									<input type="text" name="ruta" class="form-control input-sm" required/>
								</div>
								<div class="col-xs-3">
									<label class="control-label">Chofer encargado</label>
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from destinatarios ORDER BY nombre ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='chofer' class='form-control input-sm'>";
											echo "<option disabled selected class='form-control input-sm'>"."- Selecciona-"."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
										}
										echo "</select>";
									?>
								</div>
                            </div>
                            <br><br>
                            <div class="row form-horizontal">
								<div class="col-xs-2">
									<label class="control-label">Tipo</label>
									<select class='form-control input-sm' name="tipo1" required>
										<option selected>--</option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <label class="control-label">Aviso de Compra</label>
                                    <input id="folio_ac1" name="folio_ac1" type="text" class="form-control input-sm" required autocomplete="off">
								</div>
                                <div class="col-xs-2">
									<label class="control-label">Carta Porte</label>
									<select class='form-control input-sm' name="carta_porte1" required>
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<label class="control-label">Factura</label>
									<select class='form-control input-sm' name="factura1" required>
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<label class="control-label">#Recolecc.</label>
									<input type="text" name="no_recoleccion1" class="form-control input-sm" required/>
								</div>
								<div class="col-xs-4">
									<label class="control-label">Observaciones</label>
									<input type="text" name="observaciones1" maxlength="50" class="form-control input-sm"/>
								</div>
							</div>
                            <br>
                            <div class="row form-horizontal">
								<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo2">
										<option selected>--</option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac2" name="folio_ac2" type="text" class="form-control input-sm" autocomplete="off">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte2" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura2" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion2" class="form-control input-sm" />
								</div>
								<div class="col-xs-4">
									<input type="text" name="observaciones2" maxlength="50" class="form-control input-sm"/>
								</div>
							</div>
                            <br>
                            <div class="row form-horizontal">
							<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo3">
										<option selected>--</option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac3" name="folio_ac3" type="text" class="form-control input-sm" autocomplete="off">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte3" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura3" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion3" class="form-control input-sm" />
								</div>
								<div class="col-xs-4">
									<input type="text" name="observaciones3" maxlength="50" class="form-control input-sm"/>
								</div>
							</div>
                            <br>
                            <div class="row form-horizontal">
							<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo4">
										<option selected>--</option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac4" name="folio_ac4" type="text" class="form-control input-sm" autocomplete="off">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte4" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura4" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion4" class="form-control input-sm" />
								</div>
								<div class="col-xs-4">
									<input type="text" name="observaciones4" maxlength="50" class="form-control input-sm"/>
								</div>
							</div>
                            <br>
                            <div class="row form-horizontal">
							<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo5">
										<option selected>--</option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac5" name="folio_ac5" type="text" class="form-control input-sm" autocomplete="off">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte5" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura5" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion5" class="form-control input-sm" />
								</div>
								<div class="col-xs-4">
									<input type="text" name="observaciones5" maxlength="50" class="form-control input-sm"/>
								</div>
							</div>
                            <br>
                            <div class="row form-horizontal">
							<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo6">
										<option selected>--</option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac6" name="folio_ac6" type="text" class="form-control input-sm" autocomplete="off">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte6" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura6" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion6" class="form-control input-sm" />
								</div>
								<div class="col-xs-4">
									<input type="text" name="observaciones6" maxlength="50" class="form-control input-sm"/>
								</div>
							</div>
                            <br>
                            <div class="row form-horizontal">
							<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo7">
										<option selected>--</option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac7" name="folio_ac7" type="text" class="form-control input-sm" autocomplete="off">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte7" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura7" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion7" class="form-control input-sm" />
								</div>
								<div class="col-xs-4">
									<input type="text" name="observaciones7" maxlength="50" class="form-control input-sm"/>
								</div>
							</div>
                            <br>
                            <div class="row form-horizontal">
							<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo8">
										<option selected>--</option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac8" name="folio_ac8" type="text" class="form-control input-sm" autocomplete="off">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte8" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura8" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion8" class="form-control input-sm" />
								</div>
								<div class="col-xs-4">
									<input type="text" name="observaciones8" maxlength="50" class="form-control input-sm"/>
								</div>
							</div>
                            <br>
                            <div class="row form-horizontal">
							<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo9">
										<option selected>--</option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac9" name="folio_ac9" type="text" class="form-control input-sm" autocomplete="off">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte9" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura9" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion9" class="form-control input-sm" />
								</div>
								<div class="col-xs-4">
									<input type="text" name="observaciones9" maxlength="50" class="form-control input-sm"/>
								</div>
							</div>
                            <br>
                            <div class="row form-horizontal">
							<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo10">
										<option selected>--</option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac10" name="folio_ac10" type="text" class="form-control input-sm" autocomplete="off">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte10" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura10" >
										<option selected>--</option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion10" class="form-control input-sm"/>
								</div>
								<div class="col-xs-4">
									<input type="text" name="observaciones10" maxlength="50" class="form-control input-sm"/>
								</div>
							</div>
							<br>
							<div style="margin-top: 5px; margin-bottom:5px;">
								<button class="btn btn-primary">Crear</button></div>
						</form>
				</div>
			</div>
		</div>
		</div>
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../../js/bootstrap.min.js"></script>
		<script>/*
		function autocomplete(inp, arr) {
		  var currentFocus;
		  inp.addEventListener("input", function(e) {
			  var a, b, i, val = this.value;
			  closeAllLists();
			  if (!val) { return false;}
			  currentFocus = -1;
			  a = document.createElement("DIV");
			  a.setAttribute("id", this.id + "autocomplete-list");
			  a.setAttribute("class", "autocomplete-items");
			  this.parentNode.appendChild(a);
			  for (i = 0; i < arr.length; i++) {
				if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
				  b = document.createElement("DIV");
				  b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
				  b.innerHTML += arr[i].substr(val.length);
				  b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
				  b.addEventListener("click", function(e) {
					  inp.value = this.getElementsByTagName("input")[0].value;
					  closeAllLists();
				  });
				  a.appendChild(b);
				}
			  }
		  });
		  inp.addEventListener("keydown", function(e) {
			  var x = document.getElementById(this.id + "autocomplete-list");
			  if (x) x = x.getElementsByTagName("div");
			  if (e.keyCode == 40) {
				currentFocus++;
				addActive(x);
			  } else if (e.keyCode == 38) {
				currentFocus--;
				addActive(x);
			  } else if (e.keyCode == 13) {
				e.preventDefault();
				if (currentFocus > -1) {
				  if (x) x[currentFocus].click();
				}
			  }
		  });
		  function addActive(x) {
			if (!x) return false;
			removeActive(x);
			if (currentFocus >= x.length) currentFocus = 0;
			if (currentFocus < 0) currentFocus = (x.length - 1);
			x[currentFocus].classList.add("autocomplete-active");
		  }
		  function removeActive(x) {
			for (var i = 0; i < x.length; i++) {
			  x[i].classList.remove("autocomplete-active");
			}
		  }
		  function closeAllLists(elmnt) {
			var x = document.getElementsByClassName("autocomplete-items");
			for (var i = 0; i < x.length; i++) {
			  if (elmnt != x[i] && elmnt != inp) {
				x[i].parentNode.removeChild(x[i]);
			  }
			}
		  }
		  document.addEventListener("click", function (e) {
			  closeAllLists(e.target);
		  });
		}*/
		<?php
		/*
			//folios ordinarios
			$currY = date('y');
			mysql_query("SET NAMES 'UTF8'");
			$consulta_mysql = 'SELECT folio FROM avisos_ordinarios WHERE folio LIKE "%'.$currY.'%" ORDER BY folio ASC';
			$resultado = mysql_query($consulta_mysql,$conexion);
			$fls = array(); 
			while($row = mysql_fetch_assoc($resultado))
			{ 
				$fls[]= $row['folio'];
			}
			$out = array_values($fls);

			//req general
			$consulta_mysqlG = 'SELECT folio FROM avisos_rg WHERE folio LIKE "%'.$currY.'%" ORDER BY folio ASC';
			$resultadoG = mysql_query($consulta_mysqlG,$conexion);
			$flsG = array(); 
			while($rowG = mysql_fetch_assoc($resultadoG))
			{ 
				$flsG[]= $rowG['folio'];
			}
			$outG = array_values($flsG);

			//sol anticipo
			$consulta_mysqlS = 'SELECT folio FROM solicitudes_anticipo WHERE folio LIKE "%'.$currY.'%" ORDER BY folio ASC';
			$resultadoS = mysql_query($consulta_mysqlS,$conexion);
			$flsS = array(); 
			while($rowS = mysql_fetch_assoc($resultadoS))
			{ 
				$flsS[]= $rowS['folio'];
			}
			$outS = array_values($flsS);*/
		?>
		/*var folios = <?php //echo json_encode($out); ?>;
		autocomplete(document.getElementById("folio_ac1"), folios);
        autocomplete(document.getElementById("folio_ac2"), folios);
        autocomplete(document.getElementById("folio_ac3"), folios);
        autocomplete(document.getElementById("folio_ac4"), folios);
        autocomplete(document.getElementById("folio_ac5"), folios);
        autocomplete(document.getElementById("folio_ac6"), folios);
        autocomplete(document.getElementById("folio_ac7"), folios);
        autocomplete(document.getElementById("folio_ac8"), folios);
        autocomplete(document.getElementById("folio_ac9"), folios);
        autocomplete(document.getElementById("folio_ac10"), folios);*/
		</script>
	</body>
</html>