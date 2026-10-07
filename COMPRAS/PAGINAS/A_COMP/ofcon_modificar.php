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
		<title>Oficio Contrato Modificar</title>
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
                        if($_POST['tipo'] == "Compra Venta") {
                            $query = "UPDATE oficios_contratos SET empresa='".$_POST["empresa"]."',
                            proveedor='".$_POST["proveedor"]."',
                            productos='".$_POST["productos"]."',monto_total='".$_POST["monto_total"]."',
                            iva='".$_POST["ivaCV"]."',monto='".$_POST["monto"]."',porcentaje='".$_POST["porcentaje"]."',
                            factura='".$_POST["factura"]."',
                            folio_factura='".$_POST["folio_factura"]."',resto_pagara='".$_POST["resto_pagara"]."',
                            fecha_entrega='".$_POST["fecha_entrega"]."',notificacion='".$_POST["notificacion"]."',
                            descuento='".$_POST["descuento"]."',fecha_firma='".$_POST["fecha_firma"]."' WHERE id='".$_POST["id"]."'";
                            $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
            
                            echo "<script languaje='javascript'>
                            alert('Contrato Compra Venta Modificado')
                            location.href='historial_ofcon';
                            </script>";
                        }
                        else if($_POST['tipo'] == "REPSE") {
                            $query = "UPDATE oficios_contratos SET empresa='".$_POST["empresa"]."',
                            proveedor='".$_POST["proveedor"]."',
                            productos='".$_POST["productos"]."',
                            ob_social_ctt='".$_POST["objeto_social_ctt"]."',
                            identificacion='".$_POST["identificacion"]."',
                            ob_social_cts='".$_POST["objeto_social_cts"]."',
                            repse='".$_POST["reg_repse"]."',
                            folio_actividad='".$_POST["folio_actividad"]."',
                            actividad='".$_POST["actividad"]."',
                            actividad_realizar='".$_POST["actividad_realizar"]."',
                            vigencia='".$_POST["vigencia"]."',
                            fecha_inicio='".$_POST["fecha_inicio"]."',
                            fecha_termino='".$_POST["fecha_termino"]."',
                            servicio_prestado='".$_POST["servicio_prestado"]."',
                            precio='".$_POST["precio"]."',
                            iva='".$_POST["iva"]."',
                            total='".$_POST["total"]."',
                            observaciones='".$_POST["observaciones"]."',
                            pago_servicio='".$_POST["pago"]."',
                            correos_contacto='".$_POST["correos"]."',
                            terminacion='".$_POST["terminacion"]."',
                            contacto_contratante='".$_POST["contacto"]."',
                            fecha_firma='".$_POST["fecha_firma"]."' WHERE id='".$_POST["id"]."'";
                            $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
            
                            echo "<script languaje='javascript'>
                            alert('Contrato REPSE Modificado')
                            location.href='historial_ofcon';
                            </script>";
                        }		
				    }
                    else
                    {
                        $id_m=$_GET['id_m'];
                        $sql_query="SELECT * FROM oficios_contratos WHERE id='".$id_m."'";
                        $resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
                        if(mysql_num_rows($resultado) > 0)
                        {
                            while($Rs=mysql_fetch_array($resultado)) 
                            {
                                ?>
                                <div class="element">
                                <?php
                                if($Rs['tipo'] == "Compra Venta") {
                                    ?>
                                    <form action="ofcon_modificar" method="post">
                                        <div class="row form-horizontal">
                                            <input type="hidden" name="id" class="form-control input-sm" value="<?php echo $Rs['id']; ?>">
                                            <input type="hidden" name="tipo" class="form-control input-sm" value="<?php echo $Rs['tipo']; ?>">
                                            <div class="col-xs-2">
                                                <label class="control-label">Folio</label>
                                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?>">
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="control-label">Cliente</label>
                                                <?php
                                                    mysql_query("SET NAMES 'UTF8'");
                                                    $consulta_mysql='select * from empresas ORDER BY razon_social ASC';
                                                    $resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
                                                        echo "<select name='empresa' class='form-control input-sm'>";
                                                        echo "<option selected class='form-control input-sm'>". $Rs['empresa']."</option>";
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
                                                        echo "<option selected class='form-control input-sm'>". $Rs['proveedor']."</option>";
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
                                                <textarea name="productos" class="form-control input-sm" style="resize: none;" rows="4" maxlength="2000"><?php echo $Rs['productos']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-2">
                                                <label class="control-label">Monto Total</label>
                                                <input name="monto_total" type="text" class="form-control input-sm" value="<?php echo $Rs['monto_total']; ?>">
                                            </div>
                                            <div class="col-xs-2">
                                                <label class="control-label">I.V.A.</label>
                                                <input name="ivaCV" type="text" class="form-control input-sm" value="<?php echo $Rs['iva']; ?>">
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="control-label"><i>SEGUNDA</i></h4>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-4">
                                                <label class="control-label">Factura por Desplegar</label>
                                                <select class="form-control input-sm" name="factura" id="tipo_factura" value="<?php echo $Rs['factura']; ?>">
                                                    <option selected><?php echo $Rs['factura']; ?></option>
                                                    <option value="Anticipo">Anticipo</option>
                                                    <option value="Monto Total">Monto Total</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-2">
                                                <label class="control-label">Monto</label>
                                                <input name="monto" type="text" class="form-control input-sm" value="<?php echo $Rs['monto']; ?>">
                                            </div>
                                            <div class="col-xs-2">
                                                <label class="control-label">Porcentaje</label>
                                                <input name="porcentaje" type="text" class="form-control input-sm" value="<?php echo $Rs['porcentaje']; ?>">
                                            </div>
                                            <div class="col-xs-2">
                                                <label class="control-label">Folio</label>
                                                <input name="folio_factura" type="text" class="form-control input-sm" value="<?php echo $Rs['folio_factura']; ?>">
                                            </div>
                                        </div>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-6">
                                                <label class="control-label">Resto se pagará:</label>
                                                <textarea name="resto_pagara" class="form-control input-sm" style="resize: none;" rows="4" maxlength="150"><?php echo $Rs['resto_pagara']; ?></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="control-label"><i>TERCERA</i></h4>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-6">
                                                <label class="control-label">Fecha de Entrega</label>
                                                <textarea name="fecha_entrega" class="form-control input-sm" style="resize: none;" rows="4" maxlength="300"><?php echo $Rs['fecha_entrega']; ?></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <div id="clausula_anticipo">
                                            <h4 class="control-label"><i>CUARTA</i></h4>
                                            <div class="row form-horizontal">
                                                <div class="col-xs-3">
                                                    <label class="control-label">Notificación</label>
                                                    <input name="notificacion" type="text" class="form-control input-sm" value="<?php echo $Rs['notificacion']; ?>"> 
                                                </div>
                                                <div class="col-xs-3">
                                                    <label class="control-label">Descuento</label>
                                                    <input name="descuento" type="text" class="form-control input-sm" value="<?php echo $Rs['descuento']; ?>"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-4">
                                                <label class="control-label">Fecha de Firma de Contrato</label>
                                                <input name="fecha_firma" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_firma']; ?>">
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div style="margin-top: 5px; margin-bottom:5px;">
                                            <input type="submit" class="btn btn-success" name="submit" value="Guardar Cambios">
                                        </div>
                                        </form>
                                    </div>
                                <?php 
                                }
                                else if($Rs['tipo'] == "REPSE") {
                                    ?>
                                    <form action="ofcon_modificar" method="post">
                                        <div class="row form-horizontal">
                                            <input type="hidden" name="id" class="form-control input-sm" value="<?php echo $Rs['id']; ?>">
                                            <input type="hidden" name="tipo" class="form-control input-sm" value="<?php echo $Rs['tipo']; ?>">
                                            <div class="col-xs-2">
                                                <label class="control-label">Folio</label>
                                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?>">
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="control-label">Contratante</label>
                                                <?php
                                                    mysql_query("SET NAMES 'UTF8'");
                                                    $consulta_mysql='select * from empresas ORDER BY razon_social ASC';
                                                    $resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
                                                        echo "<select name='empresa' class='form-control input-sm'>";
                                                        echo "<option selected class='form-control input-sm'>".$Rs['empresa']."</option>";
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
                                                        echo "<option selected class='form-control input-sm'>".$Rs['proveedor']."</option>";
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
                                                <textarea name="objeto_social_ctt" class="form-control input-sm" style="resize: none;" rows="4" maxlength="300"><?php echo $Rs['ob_social_ctt']; ?></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="control-label"><i>POR PARTE DEL CONTRATISTA</i></h4>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-6">
                                                <label class="control-label">Objeto Social</label>
                                                <textarea name="objeto_social_cts" class="form-control input-sm" style="resize: none;" rows="4" maxlength="300"><?php echo $Rs['ob_social_cts']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-4">
                                                <label class="control-label">Identificación</label>
                                                <input name="identificacion" type="text" class="form-control input-sm" value="<?php echo $Rs['identificacion']; ?>">
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="control-label">Registro REPSE</label>
                                                <input name="reg_repse" type="text" class="form-control input-sm" value="<?php echo $Rs['repse']; ?>">
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="control-label">Folio de Actividad</label>
                                                <input name="folio_actividad" type="text" class="form-control input-sm" value="<?php echo $Rs['folio_actividad']; ?>">
                                            </div>
                                        </div>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-6">
                                                <label class="control-label">Actividad</label>
                                                <textarea name="actividad" class="form-control input-sm" style="resize: none;" rows="4" maxlength="300"><?php echo $Rs['actividad']; ?></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <h3 class="control-label" style="font-size:22px; text-align:center;">C L Á U S U L A S</h3>
                                        <br>
                                        <h4 class="control-label"><i>PRIMERA</i></h4>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-6">
                                                <label class="control-label">Actividad para Realizar</label>
                                                <textarea name="actividad_realizar" class="form-control input-sm" style="resize: none;" rows="4" maxlength="100"><?php echo $Rs['actividad_realizar']; ?></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="control-label"><i>SEGUNDA</i></h4>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-4">
                                                <label class="control-label">Vigencia</label>
                                                <input name="vigencia" type="text" class="form-control input-sm" value="<?php echo $Rs['vigencia']; ?>">
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="control-label">Inicio de Vigencia</label>
                                                <input name="fecha_inicio" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_inicio']; ?>">
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="control-label">Término de Vigencia</label>
                                                <input name="fecha_termino" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_termino']; ?>">
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="control-label"><i>TERCERA</i></h4>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-6">
                                                <label class="control-label">Servicio Prestado</label>
                                                <textarea name="servicio_prestado" class="form-control input-sm" style="resize: none;" rows="3" maxlength="100"><?php echo $Rs['servicio_prestado']; ?></textarea>
                                            </div>
                                            <div class="col-xs-2">
                                                <label class="control-label">Precio</label>
                                                <input name="precio" type="text" class="form-control input-sm" value="<?php echo $Rs['precio']; ?>">
                                            </div>
                                            <div class="col-xs-2">
                                                <label class="control-label">I.V.A.</label>
                                                <input name="iva" type="text" class="form-control input-sm" value="<?php echo $Rs['iva']; ?>">
                                            </div>
                                            <div class="col-xs-2">
                                                <label class="control-label">Total</label>
                                                <input name="total" type="text" class="form-control input-sm" value="<?php echo $Rs['total']; ?>">
                                            </div>
                                        </div>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-6">
                                                <label class="control-label">Observaciones</label>
                                                <textarea name="observaciones" class="form-control input-sm" style="resize: none;" rows="5" maxlength="500"><?php echo $Rs['observaciones']; ?></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="control-label"><i>CUARTA</i></h4>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-4">
                                                <label class="control-label">Pago de Servicio</label>
                                                <input name="pago" type="text" class="form-control input-sm" value="<?php echo $Rs['pago_servicio']; ?>">
                                            </div>
                                            <div class="col-xs-6">
                                                <label class="control-label">Correos de Contacto</label>
                                                <textarea name="correos" class="form-control input-sm" style="resize: none;" rows="3" maxlength="100"><?php echo $Rs['correos_contacto']; ?></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="control-label"><i>OCTAVA</i></h4>
                                        <div class="row form-horizontal">
                                            <div class="col-xs-4">
                                                <label class="control-label">Terminación</label>
                                                <input name="terminacion" type="text" class="form-control input-sm" value="<?php echo $Rs['terminacion']; ?>">
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
                                                        echo "<option selected class='form-control input-sm'>".$Rs['contacto_contratante']."</option>";
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
                                                <input name="fecha_firma" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_firma']; ?>">
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div style="margin-top: 5px; margin-bottom:5px;">
                                        <input type="submit" class="btn btn-success" name="submit" value="Guardar Cambios">
                                        </div>
                                        </form>
                                    </div>
                                <?php 
                                }
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
        <script type="text/javascript">
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