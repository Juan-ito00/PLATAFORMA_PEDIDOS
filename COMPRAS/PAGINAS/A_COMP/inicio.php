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
		<title>Inicio</title>
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
						<li><a href="historial_ofcir23">Historial Circulares 2023</a></li>
                        <li><a href="historial_ofcir24">Historial Circulares 2024</a></li>
						<li><a href="ofar_nuevo">Nueva Asignación de Ruta</a></li>
						<li><a href="historial_ofar">Historial Asignaciones de Ruta</a></li>
						<li><a href="ofv_nuevo">Nuevo Oficio Vacaciones</a></li>
						<li><a href="historial_ofv">Historial Oficios Vacaciones</a></li>
						<li><a href="ofcc_nuevo">Nuevo Oficio Comisión Choferes</a></li>
						<li><a href="historial_ofcc">Historial Oficios Comisión Choferes</a></li>
						<li><a href="ofscvac_nuevo">Nuevo Oficio Permiso a Cuenta de Vacaciones</a></li>
						<li><a href="historial_ofscvac">Historial Permisos a Cuenta de Vacaciones</a></li>
									</ul>
								</li>
							<?php
							}
							else if($_SESSION['usuario']=='ACCYNTHIA')
							{?>
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
											<span class="dropdown-header" href="#">Aviso de Compra</span>
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
						<li><a href="ofcc_nuevo">Nuevo Oficio Comisión Choferes</a></li>
						<li><a href="historial_ofcc">Historial Oficios Comisión Choferes</a></li>
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
						<?php
						if($_SESSION['usuario']=='AVISOS')
						{?>
			  			<h4>HISTORIAL AVISOS</h4>
			  			<div class="row">
			              	<div class="col-sm-4 col-md-2">
			                  	<a href="historial_ordinario" class="thumbnail">
			                      <img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
			                        <h6 align="center">AC Ordinario</h6>
			                  	</a>
			                </div>
  							<div class="col-sm-4 col-md-2">
    							<a href="historial_requisicion" class="thumbnail">
      								<img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">AC Requisición General</h6>
    							</a>
  							</div>
			                <div class="col-sm-4 col-md-2">
			                  <a href="historial_datos" class="thumbnail">
			                      <img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
			                        <h6 align="center">Datos de Proveedor</h6>
			                  </a>
			                </div>
							  <div class="col-sm-4 col-md-2">
    							<a href="historial_prodNC" class="thumbnail">
      								<img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Producto no Conforme</h6>
    							</a>
  							</div>
			  			</div>
			  			<hr>
			  			<h4>BD PROVEEDORES</h4>
			  			<div class="row">
  							<div class="col-sm-4 col-md-2">
    							<a href="proveedor_nuevo" class="thumbnail">
      								<img src="../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Proveedor Nuevo</h6>
    							</a>
  							</div>
  							<div class="col-sm-4 col-md-2">
    							<a href="historial_proveedores" class="thumbnail">
      								<img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Historial Proveedores</h6>
    							</a>
  							</div>
							  <div class="col-sm-4 col-md-2">
    							<a href="prod_ser_nuevo" class="thumbnail">
      								<img src="../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">ProductoServicio Nuevo</h6>
    							</a>
  							</div>
  							<div class="col-sm-4 col-md-2">
    							<a href="historial_prod_ser" class="thumbnail">
      								<img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Historial Productos/Servicios</h6>
    							</a>
  							</div>
							  <div class="col-sm-4 col-md-2">
    							<a href="usuarios_p" class="thumbnail">
      								<img src="../../img/usuario.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Usuarios para Proveedores</h6>
    							</a>
  							</div>
			  			</div>
			  			<hr>
			  			<h4>REPORTES</h4>
			  			<div class="row">
  							<div class="col-sm-4 col-md-2">
    							<a href="reporte_vigencia" class="thumbnail">
      								<img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Vigencia Proveedor</h6>
    							</a>
  							</div>
  							<div class="col-sm-4 col-md-2">
    							<a href="reporte_avisos" class="thumbnail">
      								<img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Avisos de Compra</h6>
    							</a>
  							</div>
  							<div class="col-sm-4 col-md-2">
    							<a href="reporte_historial" class="thumbnail">
      								<img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Historial de Aviso</h6>
    							</a>
  							</div>
			  			</div>
			  			<h4>OFICIOS GENERALES</h4>
			  			<div class="row">
  							<div class="col-sm-4 col-md-2">
    							<a href="destinatario_nuevo" class="thumbnail">
      								<img src="../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Destinatario Nuevo</h6>
    							</a>
  							</div>
  							<div class="col-sm-4 col-md-2">
    							<a href="historial_destinatarios" class="thumbnail">
      								<img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Destinatarios en Sistema</h6>
    							</a>
  							</div>
							  <div class="col-sm-4 col-md-2">
    							<a href="elaboro_nuevo" class="thumbnail">
      								<img src="../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Elaboró Nuevo</h6>
    							</a>
  							</div>
  							<div class="col-sm-4 col-md-2">
    							<a href="historial_elaboro" class="thumbnail">
      								<img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Elaboró en Sistema</h6>
    							</a>
  							</div>
  							<div class="col-sm-4 col-md-2">
    							<a href="ofg_nuevo" class="thumbnail">
      								<img src="../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Oficio Nuevo</h6>
    							</a>
  							</div>
  							<div class="col-sm-4 col-md-2">
    							<a href="historial_ofg" class="thumbnail">
      								<img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Historial de Oficios</h6>
    							</a>
  							</div>
			  			</div>
			  			<hr>
			  			<?php
						}
						else if($_SESSION['usuario']=='ACCYNTHIA')
						{?>
						<h4>HISTORIAL AVISOS</h4>
			  			<div class="row">
			              	<div class="col-sm-4 col-md-2">
			                  	<a href="historial_ordinario" class="thumbnail">
			                      <img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
			                        <h6 align="center">AC Ordinario</h6>
			                  	</a>
			                </div>
  							<div class="col-sm-4 col-md-2">
    							<a href="historial_requisicion" class="thumbnail">
      								<img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">AC Requisición General</h6>
    							</a>
  							</div>
			  			</div>
			  			<?php
						}
						else
						{?>
						<h4>NUEVO</h4>
						<div class="row">
			              	<div class="col-sm-4 col-md-2">
			                  	<a href="ordinario_nuevo" class="thumbnail">
			                      <img src="../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
			                        <h6 align="center">AC Ordinario</h6>
			                  	</a>
			                </div>
  							<div class="col-sm-4 col-md-2">
    							<a href="requisicion_nuevo" class="thumbnail">
      								<img src="../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">AC Requisición General</h6>
    							</a>
  							</div>
			                <div class="col-sm-4 col-md-2">
			                  <a href="datos_nuevo" class="thumbnail">
			                      <img src="../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
			                        <h6 align="center">Datos de Proveedor</h6>
			                  </a>
			                </div>
			  			</div>
			  			<hr>
			  			<h4>HISTORIAL AVISOS</h4>
			  			<div class="row">
			              	<div class="col-sm-4 col-md-2">
			                  	<a href="historial_ordinario" class="thumbnail">
			                      <img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
			                        <h6 align="center">AC Ordinario</h6>
			                  	</a>
			                </div>
  							<div class="col-sm-4 col-md-2">
    							<a href="historial_requisicion" class="thumbnail">
      								<img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">AC Requisición General</h6>
    							</a>
  							</div>
			                <div class="col-sm-4 col-md-2">
			                  <a href="historial_datos" class="thumbnail">
			                      <img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
			                        <h6 align="center">Datos de Proveedor</h6>
			                  </a>
			                </div>
			  			</div>
			  			<hr>
			  			<h4>BD PROVEEDORES</h4>
			  			<div class="row">
  							<div class="col-sm-4 col-md-2">
    							<a href="proveedor_nuevo" class="thumbnail">
      								<img src="../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Proveedor Nuevo</h6>
    							</a>
  							</div>
  							<div class="col-sm-4 col-md-2">
    							<a href="historial_proveedores" class="thumbnail">
      								<img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Proveedores en Sistema</h6>
    							</a>
  							</div>
			  			</div>
			  			<hr>
			  			<h4>REPORTES</h4>
			  			<div class="row">
  							<div class="col-sm-4 col-md-2">
    							<a href="reporte_vigencia" class="thumbnail">
      								<img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Vigencia Proveedor</h6>
    							</a>
  							</div>
  							<div class="col-sm-4 col-md-2">
    							<a href="reporte_avisos" class="thumbnail">
      								<img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Avisos de Compra</h6>
    							</a>
  							</div>
  							<div class="col-sm-4 col-md-2">
    							<a href="reporte_historial" class="thumbnail">
      								<img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                            		<h6 align="center">Historial de Aviso</h6>
    							</a>
  							</div>
			  			</div>
			  			<?php
						}
						?>
					</div>
			</div>
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../../js/bootstrap.min.js"></script>
	</body>
</html>