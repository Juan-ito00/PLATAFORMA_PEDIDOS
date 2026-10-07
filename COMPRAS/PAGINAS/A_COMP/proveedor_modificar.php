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
		<title>Proveedor Modificar</title>
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
 						if ($_POST["vigencia_sat"] == NULL)
 						{
 							$query = "UPDATE proveedores SET razon_social='".$_POST["razon_social"]."',rfc='".$_POST["rfc"]."',
							direccion='".$_POST["direccion"]."',curp='".$_POST["curp"]."', telefono='".$_POST["telefono"]."',
							correo='".$_POST["correo"]."',agente_ventas='".$_POST["agente_ventas"]."', "."contacto='".$_POST["contacto"]."',"."area='".$_POST["area"]."',
							"."nombre_banco='".$_POST["nombre_banco"]."',"."cuenta='".$_POST["cuenta"]."',"."clabe='".$_POST["clabe"]."',
							"."tipo_pago='".$_POST["tipo_pago"]."',opinion_sat='".$_POST["opinion_sat"]."',"."tipo_contrato='".$_POST["tipo_contrato"]."',"."fecha_vencimiento='".$_POST["fecha_vencimiento"]."',
							"."monto_credito='".$_POST["monto_credito"]."',"."tiempo_credito='".$_POST["tiempo_credito"]."',ps1='".$_POST["ps1"]."',
							ps2='".$_POST["ps2"]."',ps3='".$_POST["ps3"]."' WHERE id='".$_POST["id"]."'";
 						}
 						else
 						{
		 					$vencimiento = date('Y-m-d', strtotime($_POST['vigencia_sat']. ' + 1 month'));
		              		$query = "UPDATE proveedores SET razon_social='".$_POST["razon_social"]."',rfc='".$_POST["rfc"]."',
							direccion='".$_POST["direccion"]."',curp='".$_POST["curp"]."', telefono='".$_POST["telefono"]."',
							correo='".$_POST["correo"]."',agente_ventas='".$_POST["agente_ventas"]."', "."contacto='".$_POST["contacto"]."',"."area='".$_POST["area"]."',
							"."nombre_banco='".$_POST["nombre_banco"]."',"."cuenta='".$_POST["cuenta"]."',"."clabe='".$_POST["clabe"]."',
							"."tipo_pago='".$_POST["tipo_pago"]."',opinion_sat='".$_POST["opinion_sat"]."',
							vigencia_sat='".$_POST["vigencia_sat"]."',vencimiento='".$vencimiento."',"."tipo_contrato='".$_POST["tipo_contrato"]."',"."fecha_vencimiento='".$_POST["fecha_vencimiento"]."',
							"."monto_credito='".$_POST["monto_credito"]."',"."tiempo_credito='".$_POST["tiempo_credito"]."',ps1='".$_POST["ps1"]."',
							ps2='".$_POST["ps2"]."',ps3='".$_POST["ps3"]."' WHERE id='".$_POST["id"]."'";
		              	}
            		$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
          
           			 echo "<script languaje='javascript'>
                    alert('Modificado')
        			location.href='historial_proveedores';
                  </script>";		
				}
				else
				{
					$id_p=$_GET['id_p'];
					$sql_query="SELECT * FROM proveedores WHERE id='".$id_p."'";
					$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0)
						{
							while($Rs=mysql_fetch_array($resultado)) 
							{
				?>
				<div class="element">
					<form action="proveedor_modificar" method="post">
							<div class="row form-horizontal">
								<div class="col-xs-6">
									<label class="control-label">Razón Social</label>
									<input name="razon_social" type="text" class="form-control input-sm" required value="<?php echo $Rs['razon_social']; ?>">
								</div>
								<div class="col-xs-3">
									<label class="control-label">RFC</label>
									<input name="rfc" size="13" type="text" class="form-control input-sm" required value="<?php echo $Rs['rfc']; ?>">
								</div>
								<div class="col-xs-3">
									<label class="control-label">CURP</label>
									<input name="curp" size="18" type="text" class="form-control input-sm" value="<?php echo $Rs['curp']; ?>">
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-6">
									<label class="control-label">Dirección</label>
									<input name="direccion" type="text" class="form-control input-sm" required value="<?php echo $Rs['direccion']; ?>">
								</div>
								<div class="col-xs-3">
									<label class="control-label">Teléfono</label>
									<input name="telefono" size="18" type="text" class="form-control input-sm" required value="<?php echo $Rs['telefono']; ?>">
								</div>
								<div class="col-xs-3">
									<label class="control-label">Correo</label>
									<input name="correo" type="email" class="form-control input-sm" required value="<?php echo $Rs['correo']; ?>">
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-6">
									<label class="control-label">Contacto</label>
									<input name="contacto" type="text" class="form-control input-sm" required value="<?php echo $Rs['contacto']; ?>">
								</div>
								<div class="col-xs-3">
									<label class="control-label">Área</label>
									<input name="area" type="text" class="form-control input-sm" required value="<?php echo $Rs['area']; ?>">
								</div>
								<div class="col-xs-3">
									<label class="control-label">Agente de Ventas</label>
									<input name="agente_ventas" type="email" class="form-control input-sm" required value="<?php echo $Rs['agente_ventas']; ?>">
								</div>
								<div class="col-xs-1">
                              		<input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id']; ?>" size="17" />
                  				</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-6">
									<label class="control-label">Nombre del Banco</label>
									<input name="nombre_banco" type="text" class="form-control input-sm" required value="<?php echo $Rs['nombre_banco']; ?>">
								</div>
								<div class="col-xs-3">
									<label class="control-label">Cuenta Bancaria</label>
									<input name="cuenta" size="11" type="number" class="form-control input-sm" required value="<?php echo $Rs['cuenta']; ?>">
								</div>
								<div class="col-xs-3">
									<label class="control-label">Clabe Interbancaria</label>
									<input name="clabe" size="18" type="number" class="form-control input-sm" required value="<?php echo $Rs['clabe']; ?>">
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-12" style="text-align:center;">
									<label class="control-label">Productos/Servicios</label>
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-4">
									<?php
									  mysql_query("SET NAMES 'UTF8'");
									  $consulta_mysql = 'SELECT * FROM productos_servicios ORDER BY descripcion ASC';
									  $resultado_consulta_mysql = mysql_query($consulta_mysql,$conexion);
									  echo "<select name='ps1' class='form-control input-sm'>";
									  echo "<option> {$Rs['ps1']}</option>";
									  while($fila=mysql_fetch_array($resultado_consulta_mysql))
									  {
										echo "<option value='".$fila['descripcion']."'>".$fila['descripcion']."</option>";
									  }
									  echo "</select>";
									?>
								</div>
								<div class="col-xs-4">
									<?php
									  mysql_query("SET NAMES 'UTF8'");
									  $consulta_mysql = 'SELECT * FROM productos_servicios ORDER BY descripcion ASC';
									  $resultado_consulta_mysql = mysql_query($consulta_mysql,$conexion);
									  echo "<select name='ps2' class='form-control input-sm'>";
									  echo "<option> {$Rs['ps2']}</option>";
									  while($fila=mysql_fetch_array($resultado_consulta_mysql))
									  {
										echo "<option value='".$fila['descripcion']."'>".$fila['descripcion']."</option>";
									  }
									  echo "</select>";
									?>
								</div>
								<div class="col-xs-4">
									<?php
									  mysql_query("SET NAMES 'UTF8'");
									  $consulta_mysql = 'SELECT * FROM productos_servicios ORDER BY descripcion ASC';
									  $resultado_consulta_mysql = mysql_query($consulta_mysql,$conexion);
									  echo "<select name='ps3' class='form-control input-sm'>";
									  echo "<option> {$Rs['ps3']}</option>";
									  while($fila=mysql_fetch_array($resultado_consulta_mysql))
									  {
										echo "<option value='".$fila['descripcion']."'>".$fila['descripcion']."</option>";
									  }
									  echo "</select>";
									?>
								</div>
							</div>
							<br><br>
							<div class="row form-horizontal">
								<div class="col-xs-3">
									<label class="control-label">Tipo de Contrato</label>
									<select name="tipo_contrato" class="form-control input-sm" required>
										<option><?php echo $Rs['tipo_contrato']; ?></option>
										<option value="Arrendamiento">Arrendamiento</option>
										<option value="Compra venta">Compra venta</option>
										<option value="REPSE">REPSE</option>
										<option value="Servicios">Servicios</option>
										<option value="N/A">N/A</option>
									</select>
								</div>
								<div class="col-xs-3">
									<label class="control-label">Tipo de Pago</label>
									<select name="tipo_pago" class="form-control input-sm" required>
										<option><?php echo $Rs['tipo_pago']; ?></option>
										<option value="Anticipado">Anticipado</option>
										<option value="Anticipo">Anticipo</option>
										<option value="Contado/Crédito">Contado/Crédito</option>
										<option value="Contado">Contado</option>
										<option value="Crédito">Crédito</option>
									</select>
								</div>
								<div class="col-xs-3">
									<label class="control-label">Opinión ante el SAT</label>
									<select name="opinion_sat" class="form-control input-sm" required>
										<option><?php echo $Rs['opinion_sat']; ?></option>
										<option value="N/A">N/A</option>
										<option value="Negativa">Negativa</option>
										<option value="Positiva">Positiva</option>
									</select>
								</div>
								<div class="col-xs-3">
									<label class="control-label">Fecha</label>
									<input name="vigencia_sat" type="date" class="form-control input-sm" value="<?php echo $Rs['vigencia_sat']; ?>">
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-3">
									<label class="control-label">Fecha Vencimiento de Contrato</label>
									<input name="fecha_vencimiento" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_vencimiento']; ?>">
								</div>
								<div class="col-xs-3">
									<label class="control-label">Monto de crédito</label>
									<input name="monto_credito" type="text" class="form-control input-sm" required value="<?php echo $Rs['monto_credito']; ?>">
								</div>
								<div class="col-xs-3">
									<label class="control-label">Tiempo de crédito</label>
									<input name="tiempo_credito" type="text" class="form-control input-sm" required value="<?php echo $Rs['tiempo_credito']; ?>">
								</div>
							</div>
							<br>
							<div id="btn-form">
	          	 				<input class="btn form-btn btn-primary" type="submit" name="submit" value="Modificar">
								<br><br>
								<?php 
									$sql_doc1="SELECT * FROM proveedores WHERE rfc='".$Rs['rfc']."' AND opinion_cumplimiento IS NOT NULL";
									$res_doc1=mysql_query($sql_doc1,$conexion) or die("Error: ".mysql_error());
									if(mysql_num_rows($res_doc1) > 0)
									{
										while($Rsd1=mysql_fetch_array($res_doc1)) 
										{
											echo"<a href='../../opiniones/".$Rsd1['opinion_cumplimiento']."'><img src='icon_pdf.jpg' alt='".$Rsd1['opinion_cumplimiento']."' width='30' height='30'><label style='font-size:11px'>".$Rsd1['opinion_cumplimiento']."</label></a>";
										}
									}
								?>
								<br><br>
								<?php 
									$sql_doc2="SELECT * FROM proveedores WHERE rfc='".$Rs['rfc']."' AND inf_contrato IS NOT NULL";
									$res_doc2=mysql_query($sql_doc2,$conexion) or die("Error: ".mysql_error());
									if(mysql_num_rows($res_doc2) > 0)
									{
										while($Rsd2=mysql_fetch_array($res_doc2)) 
										{
											echo"<a href='../../opiniones/contrato/".$Rsd2['inf_contrato']."'><img src='icon_pdf.jpg' alt='".$Rsd2['inf_contrato']."' width='30' height='30'><label style='font-size:11px'>".$Rsd2['inf_contrato']."</label></a>";
										}
									}
								?>
								<br><br>
								<?php 
									$sql_doc="SELECT * FROM proveedores WHERE rfc='".$Rs['rfc']."' AND inf_impuestos IS NOT NULL";
									$res_doc=mysql_query($sql_doc,$conexion) or die("Error: ".mysql_error());
									if(mysql_num_rows($res_doc) > 0)
									{
										while($Rsd=mysql_fetch_array($res_doc)) 
										{
											echo"<a href='../../opiniones/impuestos/".$Rsd['inf_impuestos']."'><img src='icon_pdf.jpg' alt='".$Rsd['inf_impuestos']."' width='30' height='30'><label style='font-size:11px'>".$Rsd['inf_impuestos']."</label></a>";
										}
									}
								?>
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