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
		<title>Oficio Contratos</title>
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
                    <div class="row form-horizontal">
						<div class="col-xs-2">
                            <select class="form-control input-sm" id="contratos" name="contratos" required>
                                <option disabled selected>- Tipo de Contrato -</option>
                                <option value="Compra Venta">Compra Venta</option>
                                <option value="REPSE">REPSE</option>
                            </select>
                        </div>
                    </div>
                <form id="form_compraventa" style="display: none;" action="ofconCV_registrar" method="post">
                    <div class="row form-horizontal">
                        <div class="col-xs-2">
                            <label class="control-label">Folio</label>
                            <input readonly name="folio" class="form-control input-sm" value="<?php 
                                mysql_query("SET NAMES 'utf8'");
                                $result = mysql_query("SELECT id FROM folios_ofcon ORDER BY id DESC LIMIT 1", $conexion); 								
                                if ($row = mysql_fetch_array($result)){ 
                                    do {  
                                        $folio = strtoupper( ("GCOMP ").str_pad($row["id"]+1,3,'0',STR_PAD_LEFT).date("/ y"));
                                        echo $folio;
                                    } while ($row = mysql_fetch_array($result)); 
                    
                                } else {
                                    $currY = date("y");
                                    echo "GCOMP 001/ ".$currY; 
                                } 
                            ?> " >
                        </div>
                        <div class="col-xs-4">
                            <label class="control-label">Cliente</label>
                            <?php
                                mysql_query("SET NAMES 'UTF8'");
                                $consulta_mysql='select * from empresas ORDER BY razon_social ASC';
                                $resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
                                    echo "<select name='empresa' class='form-control input-sm'>";
                                    echo "<option disabled selected class='form-control input-sm'>"."- Selecciona-"."</option>";
                                while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                                    echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";
                                }
                                echo "</select>";
                            ?>
                        </div>
                        <div class="col-xs-4">
                            <label class="control-label">Proveedor</label>
                            <?php
                                mysql_query("SET NAMES 'UTF8'");
                                $consulta_mysql='select * from proveedores ORDER BY razon_social ASC';
                                $resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
                                    echo "<select name='proveedor' class='form-control input-sm'>";
                                    echo "<option disabled selected class='form-control input-sm'>"."- Selecciona-"."</option>";
                                while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                                    echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";
                                }
                                echo "</select>";
                            ?>
                        </div>
                    </div>
                    <br>
                    <h3 class="control-label" style="font-size:22px; text-align:center;">C L Á U S U L A S</h3>
                    <br>
                    <h4 class="control-label"><i>PRIMERA</i></h4>
                    <div class="row form-horizontal">
                        <div class="col-xs-6">
                            <label class="control-label">Nombre de Productos</label>
                            <textarea name="productos" class="form-control input-sm" style="resize: none;" rows="4" maxlength="2000"></textarea>
                        </div>
                    </div>
                    <div class="row form-horizontal">
                        <div class="col-xs-2">
                            <label class="control-label">Monto Total</label>
                            <input name="monto_total" type="text" class="form-control input-sm">
                        </div>
                        <div class="col-xs-2">
                            <label class="control-label">I.V.A.</label>
                            <input name="ivaCV" type="text" class="form-control input-sm">
                        </div>
                    </div>
                    <br>
                    <h4 class="control-label"><i>SEGUNDA</i></h4>
                    <div class="row form-horizontal">
                        <div class="col-xs-4">
                            <label class="control-label">Factura por Desplegar</label>
                            <select class="form-control input-sm" name="factura" id="tipo_factura">
                                <option disabled selected>- Selecciona -</option>
                                <option value="Anticipo">Anticipo</option>
                                <option value="Monto Total">Monto Total</option>
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <label class="control-label">Monto</label>
                            <input name="monto" type="text" class="form-control input-sm">
                        </div>
                        <div class="col-xs-2">
                            <label class="control-label">Porcentaje</label>
                            <input name="porcentaje" type="text" class="form-control input-sm">
                        </div>
                        <div class="col-xs-2">
                            <label class="control-label">Folio</label>
                            <input name="folio_factura" type="text" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="row form-horizontal">
                        <div class="col-xs-6">
                            <label class="control-label">Resto se pagará:</label>
                            <textarea name="resto_pagara" class="form-control input-sm" style="resize: none;" rows="4" maxlength="150"></textarea>
                        </div>
                    </div>
                    <br>
                    <h4 class="control-label"><i>TERCERA</i></h4>
                    <div class="row form-horizontal">
                        <div class="col-xs-6">
                            <label class="control-label">Fecha de Entrega</label>
                            <textarea name="fecha_entrega" class="form-control input-sm" style="resize: none;" rows="4" maxlength="300"></textarea>
                        </div>
                    </div>
                    <br>
                    <div id="clausula_anticipo" style="display:none;">
                        <h4 class="control-label"><i>CUARTA</i></h4>
                        <div class="row form-horizontal">
                            <div class="col-xs-3">
                                <label class="control-label">Notificación</label>
                                <input name="notificacion" type="text" class="form-control input-sm"> 
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label">Descuento</label>
                                <input name="descuento" type="text" class="form-control input-sm"> 
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label">Fecha de Firma de Contrato</label>
                                <input name="fecha_firma" type="date" class="form-control input-sm">
                            </div>
                        </div>
                    <br>
                    <br>
                    <div style="margin-top: 5px; margin-bottom:5px;">
                        <button class="btn btn-success">Crear</button>
                    </div>
                </form>
                <form id="form_repse" style="display: none;" action="ofconRE_registrar" method="post">
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label">Folio</label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php 
                                    mysql_query("SET NAMES 'utf8'");
                                    $result = mysql_query("SELECT id FROM folios_ofcon ORDER BY id DESC LIMIT 1", $conexion); 								
                                    if ($row = mysql_fetch_array($result)){ 
                                        do {  
                                            $folio = strtoupper( ("GCOMP ").str_pad($row["id"]+1,3,'0',STR_PAD_LEFT).date("/ y"));
                                            echo $folio;
                                        } while ($row = mysql_fetch_array($result)); 
                        
                                    } else { 
                                        echo "GCOMP 001/ 23"; 
                                    } 
                                ?> " >
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label">Contratante</label>
                                <?php
                                    mysql_query("SET NAMES 'UTF8'");
                                    $consulta_mysql='select * from empresas ORDER BY razon_social ASC';
                                    $resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
                                        echo "<select name='empresa' class='form-control input-sm'>";
                                        echo "<option disabled selected class='form-control input-sm'>"."- Selecciona-"."</option>";
                                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                                        echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";
                                    }
                                    echo "</select>";
                                ?>
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label">Contratista</label>
                                <?php
                                    mysql_query("SET NAMES 'UTF8'");
                                    $consulta_mysql='select * from proveedores ORDER BY razon_social ASC';
                                    $resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
                                        echo "<select name='proveedor' class='form-control input-sm'>";
                                        echo "<option disabled selected class='form-control input-sm'>"."- Selecciona-"."</option>";
                                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                                        echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";
                                    }
                                    echo "</select>";
                                ?>
                            </div>
                        </div>
                        <br>
                        <h3 class="control-label" style="font-size:22px; text-align:center;">D E C L A R A C I O N E S</h3>
                        <br>
                        <h4 class="control-label"><i>POR PARTE DEL CONTRATANTE</i></h4>
                        <div class="row form-horizontal">
                            <div class="col-xs-6">
                                <label class="control-label">Objeto Social</label>
                                <textarea name="objeto_social_ctt" class="form-control input-sm" style="resize: none;" rows="4" maxlength="300"></textarea>
                            </div>
                        </div>
                        <br>
                        <h4 class="control-label"><i>POR PARTE DEL CONTRATISTA</i></h4>
                        <div class="row form-horizontal">
                            <div class="col-xs-6">
                                <label class="control-label">Objeto Social</label>
                                <textarea name="objeto_social_cts" class="form-control input-sm" style="resize: none;" rows="4" maxlength="300"></textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label">Identificación</label>
                                <input name="identificacion" type="text" class="form-control input-sm">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label">Registro REPSE</label>
                                <input name="reg_repse" type="text" class="form-control input-sm">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label">Folio de Actividad</label>
                                <input name="folio_actividad" type="text" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-6">
                                <label class="control-label">Actividad</label>
                                <textarea name="actividad" class="form-control input-sm" style="resize: none;" rows="4" maxlength="300"></textarea>
                            </div>
                        </div>
                        <br>
                        <h3 class="control-label" style="font-size:22px; text-align:center;">C L Á U S U L A S</h3>
                        <br>
                        <h4 class="control-label"><i>PRIMERA</i></h4>
                        <div class="row form-horizontal">
                            <div class="col-xs-6">
                                <label class="control-label">Actividad para Realizar</label>
                                <textarea name="actividad_realizar" class="form-control input-sm" style="resize: none;" rows="4" maxlength="100"></textarea>
                            </div>
                        </div>
                        <br>
                        <h4 class="control-label"><i>SEGUNDA</i></h4>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label">Vigencia</label>
                                <input name="vigencia" type="text" class="form-control input-sm">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label">Inicio de Vigencia</label>
                                <input name="fecha_inicio" type="date" class="form-control input-sm">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label">Término de Vigencia</label>
                                <input name="fecha_termino" type="date" class="form-control input-sm">
                            </div>
                        </div>
                        <br>
                        <h4 class="control-label"><i>TERCERA</i></h4>
                        <div class="row form-horizontal">
                            <div class="col-xs-6">
                                <label class="control-label">Servicio Prestado</label>
                                <textarea name="servicio_prestado" class="form-control input-sm" style="resize: none;" rows="3" maxlength="100"></textarea>
                            </div>
                            <div class="col-xs-2">
                                <label class="control-label">Precio</label>
                                <input name="precio" type="text" class="form-control input-sm">
                            </div>
                            <div class="col-xs-2">
                                <label class="control-label">I.V.A.</label>
                                <input name="iva" type="text" class="form-control input-sm">
                            </div>
                            <div class="col-xs-2">
                                <label class="control-label">Total</label>
                                <input name="total" type="text" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-6">
                                <label class="control-label">Observaciones</label>
                                <textarea name="observaciones" class="form-control input-sm" style="resize: none;" rows="5" maxlength="500"></textarea>
                            </div>
                        </div>
                        <br>
                        <h4 class="control-label"><i>CUARTA</i></h4>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label">Pago de Servicio</label>
                                <input name="pago" type="text" class="form-control input-sm">
                            </div>
                            <div class="col-xs-6">
                                <label class="control-label">Correos de Contacto</label>
                                <textarea name="correos" class="form-control input-sm" style="resize: none;" rows="3" maxlength="100"></textarea>
                            </div>
                        </div>
                        <br>
                        <h4 class="control-label"><i>OCTAVA</i></h4>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label">Terminación</label>
                                <input name="terminacion" type="text" class="form-control input-sm">
                            </div>
                        </div>
                        <br>
                        <h4 class="control-label"><i>NOVENA</i></h4>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label">Contacto de Contratante</label>
                                <?php
                                    mysql_query("SET NAMES 'UTF8'");
                                    $consulta_mysql='select * from elaboro_oficio ORDER BY nombre ASC';
                                    $resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
                                        echo "<select name='contacto' class='form-control input-sm'>";
                                        echo "<option disabled selected class='form-control input-sm'>"."- Selecciona-"."</option>";
                                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                                        echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
                                    }
                                    echo "</select>";
                                ?>
                            </div>
                        </div>
                        <br>
                        <h4 class="control-label"><i>DÉCIMA</i></h4>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label">Fecha de firma de Contrato</label>
                                <input name="fecha_firma" type="date" class="form-control input-sm">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div style="margin-top: 5px; margin-bottom:5px;">
                            <button class="btn btn-success">Crear</button>
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
            document.getElementById('contratos').addEventListener('change', function (e)
            {
            if (e.target.value === "Compra Venta")
            {
                $("#form_compraventa").show();
                $("#form_repse").hide();
            }
            else if (e.target.value === "REPSE")
            {
                $("#form_compraventa").hide();
                $("#form_repse").show();
            }
            });

            document.getElementById('tipo_factura').addEventListener('change', function (e)
            {
            if (e.target.value === "Anticipo")
            {
                $("#clausula_anticipo").show();
            }
            else
            {
                $("#clausula_anticipo").hide();
            }
            });
		</script>
	</body>
</html>