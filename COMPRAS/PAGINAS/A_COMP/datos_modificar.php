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
		<title>Datos Modificar</title>
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
						<li><a href="historial_ofi">Historial <?php
function Conectarse()
{
	$link = mysql_connect("localhost", "root", "");

	if (!$link) {
		die("Error conectando: " . mysql_error());
	}

	if (!mysql_select_db("grupocav_pedidos_plataforma_21", $link)) {
		die("Error seleccionando la base de datos: " . mysql_error());
	}

	return $link;
}
 Incidencias</a></li>
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
              			$query = "UPDATE datos_proveedores SET id_proveedor='".$_POST["id_proveedor"]."',observaciones='".$_POST["observaciones"]."', pago='".$_POST["pago"]."',tiempo_entrega='".$_POST["tiempo_entrega"]."',metodo_entrega='".$_POST["metodo_entrega"]."', empresa='".$_POST["empresa"]."' WHERE id='".$_POST['id']."'";
            			$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
          
           			 echo "<script languaje='javascript'>
                    alert('Modificado')
        			location.href='historial_datos';
                  </script>";		
				}
				else
				{
					$id=$_GET['folio'];
					$sql_query="SELECT datos_proveedores.id,datos_proveedores.folio,datos_proveedores.fecha,datos_proveedores.observaciones,datos_proveedores.id_proveedor,datos_proveedores.pago,datos_proveedores.tiempo_entrega,datos_proveedores.metodo_entrega,datos_proveedores.empresa,proveedores.razon_social,proveedores.opinion_sat,proveedores.vigencia_sat,proveedores.vencimiento FROM datos_proveedores JOIN proveedores ON datos_proveedores.id_proveedor = proveedores.id WHERE datos_proveedores.folio='".$id."'";
					$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0)
						{
							while($Rs=mysql_fetch_array($resultado)) 
							{
				?>
				<div class="element">
					<form action="datos_modificar" method="post">
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<div class="col-xs-2">
                              		<input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id']; ?>" size="17" />
                  				</div>
									<label class="control-label">Folio</label>
									<input name="folio" type="text" class="form-control input-sm" required disabled value="<?php echo $Rs['folio']; ?>">
								</div>
								<div class="col-xs-2">
									<label class="control-label">Fecha</label>
									<input name="fecha" type="date" class="form-control input-sm" required disabled value="<?php echo $Rs['fecha']; ?>">
								</div>
								<div class="col-xs-3">
									<label class="control-label">Observaciones</label>
									<select name="observaciones" class="form-control input-sm" required>
										<option><?php echo $Rs['observaciones'];?></option>
										<option value="Proveedor en Sistema">Proveedor en Sistema</option>
										<option value="Proveedor Nuevo">Proveedor Nuevo</option>
									</select>
								</div>
								<div class="col-xs-5">
									<label class="control-label">Proveedor</label>
									<?php
									  mysql_query("SET NAMES 'UTF8'");
									  $consulta_mysql = 'SELECT * FROM proveedores WHERE TIMESTAMPDIFF(month, vencimiento, Now()) < 3 ORDER BY razon_social ASC';
									  $resultado_consulta_mysql = mysql_query($consulta_mysql,$conexion);
									  echo "<select name='id_proveedor' class='form-control input-sm'>";
									  echo "<option value='{$Rs['id_proveedor']}'> {$Rs['razon_social']}</option>";
									  while($fila=mysql_fetch_array($resultado_consulta_mysql))
									  {
										if($fila['opinion_sat'] == 'Positiva')
									  	{
										echo "<option class='alert-success' value='".$fila['id']."'>".$fila['razon_social']."</option>";
										}
										else
										{
											echo "<option class='alert-danger' value='".$fila['id']."'>".$fila['razon_social']."</option>";
										}
									  }
									  echo "</select>";
									?>
								</div>
								<div class="col-xs-2">
									<label class="control-label">Pago</label>
									<select name="pago" class="form-control input-sm" required>
										<option><?php echo $Rs['pago']; ?></option>
										<option value="Anticipado">Anticipado</option>
										<option value="Anticipo">Anticipo</option>
										<option value="Contado/Crédito">Contado/Crédito</option>
										<option value="Contado">Contado</option>
										<option value="Crédito">Crédito</option>
									</select>
								</div>
								<div class="col-xs-2">
									<label class="control-label">Tiempo de Entrega</label>
									<input name="tiempo_entrega" type="text" class="form-control input-sm" required value="<?php echo $Rs['tiempo_entrega']; ?>">
								</div>
								<div class="col-xs-3">
									<label class="control-label">Método de Entrega</label>
									<select name="metodo_entrega" class="form-control input-sm" required>
										<option><?php echo $Rs['metodo_entrega']; ?></option>
										<option value="Paquetería">Paquetería</option>
										<option value="Entrega Establecimiento">Entrega Establecimiento</option>
										<option value="Entrega Almacén">Entrega Almacén</option>
										<option value="Servicio">Servicio</option>
									</select>
								</div>
								<div class="col-xs-5">
									<label class="control-label">Empresa que Solicita</label>
									<select name="empresa" class="form-control input-sm" required>
										<option><?php echo $Rs['empresa']; ?></option>
										<option value="CAVI DE SOMBRERETE S.A. de C.V.">CAVI DE SOMBRERETE S.A. de C.V.</option>
										<option value="CONCRETOS CAVI S.A. de C.V.">CONCRETOS CAVI S.A. de C.V.</option>
										<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
										<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)</option>
									</select>
								</div>
							</div>
							<br><br>
							<div class="row form-horizontal">
								<div class="col-xs-6"></div>
								<div class="col-xs-3">
									<label class="control-label">Opinión ante el SAT</label>
									<select name="opinion_sat" class="form-control input-sm" disabled>
										<option><?php echo $Rs['opinion_sat']; ?></option>
										<option value="Negativa">Negativa</option>
										<option value="Positiva">Positiva</option>
									</select>
								</div>
								<div class="col-xs-3">
									<label class="control-label">Vigencia</label>
									<input name="vencimiento" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['vencimiento']; ?>">
								</div>
							</div>
							<br>
							<?php
							if($_SESSION['usuario']!='AVISOS')
              {?>
							<div id="btn-form">
	          	 				<input class="btn form-btn btn-primary" type="submit" name="submit" value="Modificar">
	          	 			</div>
	          	 			<?php
	          	 		}
	          	 		?>
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