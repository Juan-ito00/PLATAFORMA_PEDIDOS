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
	use PHPMailer\PHPMailer\PHPMailer;
	require_once('../../autoload.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Solicitud Ver</title>
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

					$id=$_GET['folio'];
					$sql_query="SELECT * FROM sol_cotizaciones WHERE id='".$id."'";
					$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0)
						{
							while($Rs=mysql_fetch_array($resultado)) 
							{
				?>
				<div class="element">
                <form action="" method="post">
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<label class="control-label">Folio</label>
									<input name="folio" type="text" class="form-control input-sm" required disabled value="<?php echo $Rs['folio']; ?>">
								</div>
								<div class="col-xs-5">
									<label class="control-label">Proveedor</label>
									<?php
									  mysql_query("SET NAMES 'UTF8'");
									  $consulta_mysql = 'SELECT razon_social FROM proveedores ORDER BY razon_social ASC';
									  $resultado_consulta_mysql = mysql_query($consulta_mysql,$conexion);
									  echo "<select disabled name='proveedor' class='form-control input-sm'>";
									  echo "<option> {$Rs['proveedor']}</option>";
									  while($fila=mysql_fetch_array($resultado_consulta_mysql))
									  {
										echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";
									  }
									  echo "</select>";
									?>
								</div>
								<div class="col-xs-3">
									<label class="control-label">Tipo de Proveedor</label>
									<select disabled name="tipo_proveedor" class="form-control input-sm">
										<option selected><?php echo $Rs['tipo_proveedor']; ?></option>
										<option value="Proveedor Nuevo">Proveedor Nuevo</option>
										<option value="Proveedor en Sistema">Proveedor en Sistema</option>
									</select>
								</div>
								<div class="col-xs-2">
									<label class="control-label">Fecha Límite</label>
									<input disabled name="fecha_limite" type="date" class="form-control input-sm" required value="<?php echo $Rs['fecha_limite']; ?>">
								</div>
							</div>
							<br><br>
							<div class="row form-horizontal">
								<div class="col-xs-2">
										<label class="control-label">Folio Compras</label>
										<input disabled id="folio_compras" name="folio_compras" type="text" class="form-control input-sm" value="<?php echo $Rs['folio_compras']; ?>">
									</div>
								</div>
							<br>
                        <div class="row form-horizontal">
                          <div class="col-xs-4">
                              <label class="control-label" for="folio">Empresa</label>
                                <select name="empresa" id="empresa" class="form-control input-sm" readonly>
                                  <option class="form-control input-sm"><?php echo $Rs['empresa']; ?></option>
                                    <option class="form-control input-sm" name=uno value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
                                    <option class="form-control input-sm" name=dos value="CAVI DE SOMBRERETE">CAVI DE SOMBRERETE</option>
                                     <option class="form-control input-sm" name=tres value="SUCURSAL MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">SUCURSAL MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
                                </select>
                            </div>
                        </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <label class="control-label" for="cantidad">Cantidad</label>
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad1']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <label class="control-label" for="unidad">Unidad</label>
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad1']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <label class="control-label" for="descripcion">Descripción</label>
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc1']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <label class="control-label" for="descripcion">Uso</label>
                      <input name="uso" id="uso" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso1']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <label class="control-label" for="descripcion">Partida</label>
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida1']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad2']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad2']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc2']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso2']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida2']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad3']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad3']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc3']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso3']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida3']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad4']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad4']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc4']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso4']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida4']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad5']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad5']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc5']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso5']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida5']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad6']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad6']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc6']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso6']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida6']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad7']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad7']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc7']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso7']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida7']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad8']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad8']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc8']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso8']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida8']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad9']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad9']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc9']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso9']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida9']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad10']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad10']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc10']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso10']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida10']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad11']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad11']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc11']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso11']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida11']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad12']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad12']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc12']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso12']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida12']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad13']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad13']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc13']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso13']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida13']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad14']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad14']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc14']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso14']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida14']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad15']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad15']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc15']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso15']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida15']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad16']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad16']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc16']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso16']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida16']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad17']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad17']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc17']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso17']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida17']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad18']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad18']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc18']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso18']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida18']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad19']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad19']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc19']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso19']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida19']; ?>"  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cantidad20']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unidad20']; ?>" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['desc20']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['uso20']; ?>"  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" disabled value="<?php echo $Rs['partida20']; ?>"  size="2"  />
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
			document.getElementById('at1').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Sí")
		  {
		    $('#pt1').prop('readonly',false);
		  }
		  else
		  {
		  	$('#pt1').prop('readonly',true);
		  }
		});
		document.getElementById('at2').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Sí")
		  {
		    $('#pt2').prop('readonly',false);
		  }
		  else
		  {
		  	$('#pt2').prop('readonly',true);
		  }
		});
		document.getElementById('at3').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Sí")
		  {
		    $('#pt3').prop('readonly',false);
		  }
		  else
		  {
		  	$('#pt3').prop('readonly',true);
		  }
		});
		document.getElementById('at4').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Sí")
		  {
		    $('#pt4').prop('readonly',false);
		  }
		  else
		  {
		  	$('#pt4').prop('readonly',true);
		  }
		});
		document.getElementById('at5').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Sí")
		  {
		    $('#pt5').prop('readonly',false);
		  }
		  else
		  {
		  	$('#pt5').prop('readonly',true);
		  }
		});
		document.getElementById('at6').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Sí")
		  {
		    $('#pt6').prop('readonly',false);
		  }
		  else
		  {
		  	$('#pt6').prop('readonly',true);
		  }
		});
		document.getElementById('at7').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Sí")
		  {
		    $('#pt7').prop('readonly',false);
		  }
		  else
		  {
		  	$('#pt7').prop('readonly',true);
		  }
		});
		document.getElementById('at8').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Sí")
		  {
		    $('#pt8').prop('readonly',false);
		  }
		  else
		  {
		  	$('#pt8').prop('readonly',true);
		  }
		});
		document.getElementById('at9').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Sí")
		  {
		    $('#pt9').prop('readonly',false);
		  }
		  else
		  {
		  	$('#pt9').prop('readonly',true);
		  }
		});
		document.getElementById('at10').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Sí")
		  {
		    $('#pt10').prop('readonly',false);
		  }
		  else
		  {
		  	$('#pt10').prop('readonly',true);
		  }
		});
		</script>
	</body>
</html>