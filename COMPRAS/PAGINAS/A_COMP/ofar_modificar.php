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
		<title>Modificar</title>
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
							<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
 					if(isset($_POST["submit"]))
 					{
		              	$query = "UPDATE oficios_rutas SET fecha_creacion='".$_POST["fecha"]."',
                        ruta='".$_POST["ruta"]."',
                        chofer='".$_POST["chofer"]."',
						folio_ac1='".$_POST["folio_ac1"]."',
						folio_ac2='".$_POST["folio_ac2"]."',
						folio_ac3='".$_POST["folio_ac3"]."',
						folio_ac4='".$_POST["folio_ac4"]."',
						folio_ac5='".$_POST["folio_ac5"]."',
						folio_ac6='".$_POST["folio_ac6"]."',
						folio_ac7='".$_POST["folio_ac7"]."',
						folio_ac8='".$_POST["folio_ac8"]."',
						folio_ac9='".$_POST["folio_ac9"]."',
						folio_ac10='".$_POST["folio_ac10"]."',
						tipo1='".$_POST["tipo1"]."',
						tipo2='".$_POST["tipo2"]."',
						tipo3='".$_POST["tipo3"]."',
						tipo4='".$_POST["tipo4"]."',
						tipo5='".$_POST["tipo5"]."',
						tipo6='".$_POST["tipo6"]."',
						tipo7='".$_POST["tipo7"]."',
						tipo8='".$_POST["tipo8"]."',
						tipo9='".$_POST["tipo9"]."',
						tipo10='".$_POST["tipo10"]."',
                        carta_porte1='".$_POST["carta_porte1"]."',
						carta_porte2='".$_POST["carta_porte2"]."',
						carta_porte3='".$_POST["carta_porte3"]."',
						carta_porte4='".$_POST["carta_porte4"]."',
						carta_porte5='".$_POST["carta_porte5"]."',
						carta_porte6='".$_POST["carta_porte6"]."',
						carta_porte7='".$_POST["carta_porte7"]."',
						carta_porte8='".$_POST["carta_porte8"]."',
						carta_porte9='".$_POST["carta_porte9"]."',
						carta_porte10='".$_POST["carta_porte10"]."',
                        factura1='".$_POST["factura1"]."',
						factura2='".$_POST["factura2"]."',
						factura3='".$_POST["factura3"]."',
						factura4='".$_POST["factura4"]."',
						factura5='".$_POST["factura5"]."',
						factura6='".$_POST["factura6"]."',
						factura7='".$_POST["factura7"]."',
						factura8='".$_POST["factura8"]."',
						factura9='".$_POST["factura9"]."',
						factura10='".$_POST["factura10"]."',
                        no_recoleccion1='".$_POST["no_recoleccion1"]."',
						no_recoleccion2='".$_POST["no_recoleccion2"]."',
						no_recoleccion3='".$_POST["no_recoleccion3"]."',
						no_recoleccion4='".$_POST["no_recoleccion4"]."',
						no_recoleccion5='".$_POST["no_recoleccion5"]."',
						no_recoleccion6='".$_POST["no_recoleccion6"]."',
						no_recoleccion7='".$_POST["no_recoleccion7"]."',
						no_recoleccion8='".$_POST["no_recoleccion8"]."',
						no_recoleccion9='".$_POST["no_recoleccion9"]."',
						no_recoleccion10='".$_POST["no_recoleccion10"]."',
                        observaciones1='".$_POST["observaciones1"]."',
						observaciones2='".$_POST["observaciones2"]."',
						observaciones3='".$_POST["observaciones3"]."',
						observaciones4='".$_POST["observaciones4"]."',
						observaciones5='".$_POST["observaciones5"]."',
						observaciones6='".$_POST["observaciones6"]."',
						observaciones7='".$_POST["observaciones7"]."',
						observaciones8='".$_POST["observaciones8"]."',
						observaciones9='".$_POST["observaciones9"]."',
						observaciones10='".$_POST["observaciones10"]."' WHERE id='".$_POST["id"]."'";
            		$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
          
           			 echo "<script languaje='javascript'>
                    alert('Asignacion de Ruta Modificada')
        			location.href='historial_ofar';
                  </script>";		
				}
				else
				{
					$id_m=$_GET['id_m'];
					$sql_query="SELECT * FROM oficios_rutas WHERE id='".$id_m."'";
					$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0)
						{
							while($Rs=mysql_fetch_array($resultado)) 
							{
				?>
				<div class="element">
					<form action="ofar_modificar" method="post">
						<div class="row form-horizontal">
							<div class="col-xs-3">
								<label class="control-label">Folio</label>
								<input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?>">
							</div>
							<div class="col-xs-3">
									<label class="control-label">Fecha</label>
									<input name="fecha" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_creacion']; ?>">
							</div>
							<div class="col-xs-3">
								<label class="control-label">Ruta</label>
								<input type="text" name="ruta" class="form-control input-sm" value="<?php echo $Rs['ruta']; ?>"/>
							</div>
							<div class="col-xs-3">
								<label class="control-label">Chofer encargado</label>
								<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from destinatarios ORDER BY nombre ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='chofer' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>".$Rs['chofer']."</option>";
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
									<select class='form-control input-sm' name="tipo1">
										<option selected><?php echo $Rs['tipo1']; ?></option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <label class="control-label">Aviso de Compra</label>
                                    <input id="folio_ac1" name="folio_ac1" type="text" class="form-control input-sm" readonly autocomplete="off" value="<?php echo $Rs['folio_ac1']; ?>">
								</div>
                                <div class="col-xs-2">
									<label class="control-label">Carta Porte</label>
									<select class='form-control input-sm' name="carta_porte1">
										<option selected><?php echo $Rs['carta_porte1']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<label class="control-label">Factura</label>
									<select class='form-control input-sm' name="factura1">
										<option selected><?php echo $Rs['factura1']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<label class="control-label">No. de Recolección</label>
									<input type="text" name="no_recoleccion1" class="form-control input-sm" value="<?php echo $Rs['no_recoleccion1']; ?>"/>
								</div>
								<div class="col-xs-4">
									<label class="control-label">Observaciones</label>
									<input type="text" name="observaciones1" class="form-control input-sm" value="<?php echo $Rs['observaciones1']; ?>"/>
								</div>
							</div>
							<br>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo2">
										<option selected><?php echo $Rs['tipo2']; ?></option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac2" name="folio_ac2" type="text" class="form-control input-sm" readonly autocomplete="off" value="<?php echo $Rs['folio_ac2']; ?>">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte2">
										<option selected><?php echo $Rs['carta_porte2']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura2">
										<option selected><?php echo $Rs['factura2']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion2" class="form-control input-sm" value="<?php echo $Rs['no_recoleccion2']; ?>"/>
								</div>
								<div class="col-xs-4">
								<input type="text" name="observaciones2" class="form-control input-sm" value="<?php echo $Rs['observaciones2']; ?>"/>
								</div>
							</div>
							<br>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo3">
										<option selected><?php echo $Rs['tipo3']; ?></option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac3" name="folio_ac3" type="text" class="form-control input-sm" readonly autocomplete="off" value="<?php echo $Rs['folio_ac3']; ?>">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte3">
										<option selected><?php echo $Rs['carta_porte3']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura3">
										<option selected><?php echo $Rs['factura3']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion3" class="form-control input-sm" value="<?php echo $Rs['no_recoleccion3']; ?>"/>
								</div>
								<div class="col-xs-4">
								<input type="text" name="observaciones3" class="form-control input-sm" value="<?php echo $Rs['observaciones3']; ?>"/>
								</div>
							</div>
							<br>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo4">
										<option selected><?php echo $Rs['tipo4']; ?></option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac4" name="folio_ac4" type="text" class="form-control input-sm" readonly autocomplete="off" value="<?php echo $Rs['folio_ac4']; ?>">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte4">
										<option selected><?php echo $Rs['carta_porte4']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura4">
										<option selected><?php echo $Rs['factura4']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion4" class="form-control input-sm" value="<?php echo $Rs['no_recoleccion4']; ?>"/>
								</div>
								<div class="col-xs-4">
								<input type="text" name="observaciones4" class="form-control input-sm" value="<?php echo $Rs['observaciones4']; ?>"/>
								</div>
							</div>
							<br>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo5">
										<option selected><?php echo $Rs['tipo5']; ?></option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac5" name="folio_ac5" type="text" class="form-control input-sm" readonly autocomplete="off" value="<?php echo $Rs['folio_ac5']; ?>">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte5">
										<option selected><?php echo $Rs['carta_porte5']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura5">
										<option selected><?php echo $Rs['factura5']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion5" class="form-control input-sm" value="<?php echo $Rs['no_recoleccion5']; ?>"/>
								</div>
								<div class="col-xs-4">
								<input type="text" name="observaciones5" class="form-control input-sm" value="<?php echo $Rs['observaciones5']; ?>"/>
								</div>
							</div>
							<br>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo6">
										<option selected><?php echo $Rs['tipo6']; ?></option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac6" name="folio_ac6" type="text" class="form-control input-sm" readonly autocomplete="off" value="<?php echo $Rs['folio_ac6']; ?>">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte6">
										<option selected><?php echo $Rs['carta_porte6']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura6">
										<option selected><?php echo $Rs['factura6']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion6" class="form-control input-sm" value="<?php echo $Rs['no_recoleccion6']; ?>"/>
								</div>
								<div class="col-xs-4">
								<input type="text" name="observaciones6" class="form-control input-sm" value="<?php echo $Rs['observaciones6']; ?>"/>
								</div>
							</div>
							<br>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo7">
										<option selected><?php echo $Rs['tipo7']; ?></option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac7" name="folio_ac7" type="text" class="form-control input-sm" readonly autocomplete="off" value="<?php echo $Rs['folio_ac7']; ?>">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte7">
										<option selected><?php echo $Rs['carta_porte7']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura7">
										<option selected><?php echo $Rs['factura7']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion7" class="form-control input-sm" value="<?php echo $Rs['no_recoleccion7']; ?>"/>
								</div>
								<div class="col-xs-4">
								<input type="text" name="observaciones7" class="form-control input-sm" value="<?php echo $Rs['observaciones7']; ?>"/>
								</div>
							</div>
							<br>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo8">
										<option selected><?php echo $Rs['tipo8']; ?></option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac8" name="folio_ac8" type="text" class="form-control input-sm" readonly autocomplete="off" value="<?php echo $Rs['folio_ac8']; ?>">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte8">
										<option selected><?php echo $Rs['carta_porte8']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura8">
										<option selected><?php echo $Rs['factura8']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion8" class="form-control input-sm" value="<?php echo $Rs['no_recoleccion8']; ?>"/>
								</div>
								<div class="col-xs-4">
								<input type="text" name="observaciones8" class="form-control input-sm" value="<?php echo $Rs['observaciones8']; ?>"/>
								</div>
							</div>
							<br>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo9">
										<option selected><?php echo $Rs['tipo9']; ?></option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac9" name="folio_ac9" type="text" class="form-control input-sm" readonly autocomplete="off" value="<?php echo $Rs['folio_ac9']; ?>">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte9">
										<option selected><?php echo $Rs['carta_porte9']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura9">
										<option selected><?php echo $Rs['factura9']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion9" class="form-control input-sm" value="<?php echo $Rs['no_recoleccion9']; ?>"/>
								</div>
								<div class="col-xs-4">
								<input type="text" name="observaciones9" class="form-control input-sm" value="<?php echo $Rs['observaciones9']; ?>"/>
								</div>
							</div>
							<br>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<select class='form-control input-sm' name="tipo10">
										<option selected><?php echo $Rs['tipo10']; ?></option>
										<option value="avisos_ordinarios">avisos_ordinarios</option>
										<option value="avisos_rg">avisos_rg</option>
										<option value="solicitudes_anticipo">solicitudes_anticipo</option>
									</select>
								</div>
							    <div class="col-xs-2">
                                    <input id="folio_ac10" name="folio_ac10" type="text" class="form-control input-sm" readonly autocomplete="off" value="<?php echo $Rs['folio_ac10']; ?>">
								</div>
                                <div class="col-xs-2">
									<select class='form-control input-sm' name="carta_porte10">
										<option selected><?php echo $Rs['carta_porte10']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
                                <div class="col-xs-1">
									<select class='form-control input-sm' name="factura10">
										<option selected><?php echo $Rs['factura10']; ?></option>
										<option value="Si">Si</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input type="text" name="no_recoleccion10" class="form-control input-sm" value="<?php echo $Rs['no_recoleccion10']; ?>"/>
								</div>
								<div class="col-xs-4">
									<input type="text" name="observaciones10" class="form-control input-sm" value="<?php echo $Rs['observaciones10']; ?>"/>
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
                              		<input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id']; ?>" size="17" />
                  				</div>
	          	 			</div>
                  			</div>
						</form>
						<?php   		
				}
			}
			else
			{
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