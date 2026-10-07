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
		<title>Solicitud</title>
		<!-- Bootstrap -->
		<link href="../../css/bootstrap.min.css" rel="stylesheet">
		<style type="text/css">
			.rojo {background-color:#FF0000;}
			.azul {color:#0066FF;}
			.verde {color:#009900;}
			select{
				background-color:#FF66FF;
			}
			.autocomplete-items
			{
			  position: absolute;
			  border: 1px solid #d4d4d4;
			  border-bottom: none;
			  border-top: none;
			  z-index: 99;
			  top: 100%;
			  left: 0;
			  right: 0;
			}

			.autocomplete-items div
			{
			  padding: 10px;
			  cursor: pointer;
			  background-color: #fff; 
			  border-bottom: 1px solid #d4d4d4; 
			}

			.autocomplete-items div:hover
			{
			  background-color: #e9e9e9; 
			}

			.autocomplete-active {
			  background-color: DodgerBlue !important; 
			  color: #ffffff; 
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
					<form action="sol_cotizacion_insertar" method="post">
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<label class="control-label">Folio</label>
									<input name="folio" type="text" class="form-control input-sm" required disabled value="<?php 
								mysql_query("SET NAMES 'utf8'");
								$result = mysql_query("SELECT id FROM folios_sol_cot ORDER BY id DESC LIMIT 1", $conexion); 								
								if ($row = mysql_fetch_array($result)){ 
									do {  
										$folio = strtoupper(str_pad($row["id"]+1,3,'0',STR_PAD_LEFT).date("/ y"));
										echo $folio;
									} while ($row = mysql_fetch_array($result)); 
					
								} else {
                  $currY = date("y");
									echo "001/ ".$currY; 
								} 
							?> ">
								</div>
								<div class="col-xs-5">
									<label class="control-label">Proveedor</label>
									<?php
									  mysql_query("SET NAMES 'UTF8'");
									  $consulta_mysql = 'SELECT razon_social FROM proveedores ORDER BY razon_social ASC';
									  $resultado_consulta_mysql = mysql_query($consulta_mysql,$conexion);
									  echo "<select name='proveedor' class='form-control input-sm'>";
									  echo "<option> {$Rs['razon_social']}</option>";
									  while($fila=mysql_fetch_array($resultado_consulta_mysql))
									  {
										echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";
									  }
									  echo "</select>";
									?>
								</div>
								<div class="col-xs-3">
									<label class="control-label">Tipo de Proveedor</label>
									<select name="tipo_proveedor" class="form-control input-sm">
										<option selected>-- Selecciona --</option>
										<option value="Proveedor Nuevo">Proveedor Nuevo</option>
										<option value="Proveedor en Sistema">Proveedor en Sistema</option>
									</select>
								</div>
								<div class="col-xs-2">
									<label class="control-label">Fecha Límite</label>
									<input name="fecha_limite" type="date" class="form-control input-sm" required value="<?php echo date('d/m/Y'); ?>">
								</div>
							</div>
							<br><br>
							<div class="row form-horizontal">
								<div class="col-xs-2">
										<label class="control-label">Folio Compras</label>
										<input id="folio_compras" name="folio_compras" type="text" class="form-control input-sm" required autocomplete="off" onkeyup="GetDetail(this.value)">
									</div>
								</div>
							<br>
                <div class="row form-horizontal">
                     <!--Tipo de Compra-->
                      <div class="col-xs-2">
                        <label class="control-label" for="tipo_compra">Tipo de Compra</label>
                        <input class="form-control input-sm" readonly name="tipo_compra" id="tipo_compra" type="text" value=""  size="17" />
                      </div>
                      <!--Campo Área-->
                      <div class="col-xs-2"></div>
                    <div class="col-xs-4">
                      <label class="control-label" for="supervisor">Supervisor</label>
                        <input class="form-control input-sm" readonly name="supervisor" id="supervisor" type="text" required value="" size="50" />
                    </div>
                            <div class="col-xs-2">
                    <label class="control-label" for="fecha">Fecha</label>
                        <input class="form-control input-sm" name="fecha" id="fecha" type="date" readonly required value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <label class="control-label" for="folio">Folio</label>
                          <input id="folio" readonly type="text" class="form-control input-sm" required value="" size="17" />
                  </div>
                  <div class="col-xs-2">
                              <input  name="id" type="hidden" class="form-control input-sm" required value="" size="17" />
                  </div>
                        </div>
                        <div class="row form-horizontal">
                          <div class="col-xs-4">
                              <label class="control-label" for="folio">Empresa</label>
                                <select name="empresa" id="empresa" class="form-control input-sm" readonly>
                                  <option class="form-control input-sm"></option>
                            <option class="form-control input-sm" name=uno value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
                  <option class="form-control input-sm" name=dos value="CAVI DE SOMBRERETE">CAVI DE SOMBRERETE</option>
                  <option class="form-control input-sm" name=tres value="SUCURSAL MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">SUCURSAL MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
                          </select>
                    </div>
                    <div class="col-xs-4">
                    <label class="control-label" for="ubicacion">Ubicación</label>
                        <input class="form-control input-sm" name="ubicacion" id="ubicacion" readonly ="text" value=""  size="17" />
                    </div>
                    <div class="col-xs-4">
                      <label class="control-label" for="proyecto">Proyecto</label>
                              <?php
                  mysql_query("SET NAMES 'UTF8'");
                  $consulta_mysql='select * from obras ORDER BY nombre ASC';
                  $resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
                  echo "<select name='proyecto' id='proyecto' disabled class='form-control input-sm'>";
                  echo "<option></option>";
                  while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                      echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
                  }
                  echo "</select>";
                ?>
                      </div>
                        </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <label class="control-label" for="cantidad">Cantidad</label>
                        <input name="cantidad" id="cantidad" class="form-control input-sm" type="text" readonly value="" size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <label class="control-label" for="unidad">Unidad</label>
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <label class="control-label" for="descripcion">Descripción</label>
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value=""  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <label class="control-label" for="descripcion">Uso</label>
                      <input name="uso" id="uso" class="form-control input-sm" type="text" readonly value=""  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <label class="control-label" for="descripcion">Partida</label>
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                        <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad2" name="cantidad2" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-2">
                      <input id="unidad2" name="unidad2" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion2" name="descripcion2" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso2" name="uso2" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida2" id="partida2" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad3" name="cantidad3" type="text" class="form-control input-sm" readonly value="" size="15" />
                    </div>
                  <div class="col-xs-2">
                      <input id="unidad3" name="unidad3" type="text" class="form-control input-sm" readonly value="" size="15" />  
                    </div>
                    <div class="col-xs-4">
                      <input id="descripcion3" name="descripcion3" type="text" class="form-control input-sm" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso3" name="uso3" type="text" class="form-control input-sm" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida3" id="partida3" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad4" name="cantidad4" type="text" class="form-control input-sm" readonly value="" size="15" />
                </div>
              <div class="col-xs-2">
                <input id="unidad4" name="unidad4" type="text" class="form-control input-sm" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-4">
                      <input id="descripcion4" name="descripcion4" type="text" class="form-control input-sm" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso4" name="uso4" type="text" class="form-control input-sm" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida4" id="partida4" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                       </div>
              <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad5" name="cantidad5" type="text" class="form-control input-sm" readonly value="" size="15" />
                    </div>
                      <div class="col-xs-2">
                      <input id="unidad5" name="unidad5" type="text" class="form-control input-sm" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                <input id="descripcion5" name="descripcion5" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-4">
                <input id="uso5" name="uso5" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida5" id="partida5" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad6" name="cantidad6" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                <input id="unidad6" name="unidad6" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                <input id="descripcion6" name="descripcion6" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-4">
                <input id="uso6" name="uso6" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida6" id="partida6" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad7" name="cantidad7" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input id="unidad7" name="unidad7" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion7" name="descripcion7" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso7" name="uso7" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida7" id="partida7" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad8" name="cantidad8" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                <input id="unidad8" name="unidad8" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion8" name="descripcion8" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso8" name="uso8" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida8" id="partida8" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                        <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad9" name="cantidad9" class="form-control input-sm" type="text" readonly value=""size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input id="unidad9" name="unidad9" class="form-control input-sm" type="text" readonly value=""size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion9" name="descripcion9" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso9" name="uso9" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida9" id="partida9" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                        <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad10" name="cantidad10" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input id="unidad10" name="unidad10" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                <input id="descripcion10" name="descripcion10" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-4">
                <input id="uso10" name="uso10" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida10" id="partida10" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad11" name="cantidad11" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input id="unidad11" name="unidad11" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion11" name="descripcion11" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso11" name="uso11" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida11" id="partida11" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad12" name="cantidad12" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input id="unidad12" name="unidad12" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion12" name="descripcion12" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso12" name="uso12" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida12" id="partida12" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad13" name="cantidad13" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input id="unidad13" name="unidad13" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion13" name="descripcion13" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso13" name="uso13" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida13" id="partida13" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad14" name="cantidad14" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input id="unidad14" name="unidad14" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion14" name="descripcion14" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso14" name="uso14" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida14" id="partida14" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad15" name="cantidad15" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input id="unidad15" name="unidad15" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion15" name="descripcion15" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso15" name="uso15" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida15" id="partida15" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad16" name="cantidad16" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input id="unidad16" name="unidad16" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion16" name="descripcion16" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso16" name="uso16" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida16" id="partida16" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad17" name="cantidad17" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input id="unidad17" name="unidad17" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion17" name="descripcion17" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso17" name="uso17" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida17" id="partida17" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                    </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad18" name="cantidad18" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input id="unidad18" name="unidad18" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion18" name="descripcion18" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso18" name="uso18" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida18" id="partida18" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad19" name="cantidad19" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input id="unidad19" name="unidad19" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion19"name="descripcion19" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso19"name="uso19" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida19" id="partida19" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-1">
                      <input id="cantidad20" name="cantidad20" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input id="unidad20" name="unidad20" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion20" name="descripcion20" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-4">
                      <input id="uso20" name="uso20" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida20" id="partida20" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
							<div style="margin-top: 5px; margin-bottom:5px;">
								<button class="btn btn-primary">Crear</button></div>
						</form>
				</div>
			</div>
		</div>
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../../js/bootstrap.min.js"></script>
		<script>
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
		}
		<?php
    $currY = date('y');
			mysql_query("SET NAMES 'UTF8'");
			$consulta_mysql = 'SELECT folio_af FROM pedidos WHERE estado != "Cancelado" AND estado != "Enviado" AND estado != "Revisar Notas" AND year="'.$currY.'" ORDER BY folio_af ASC';

			$resultado = mysql_query($consulta_mysql,$conexion);

			$fls = array(); 
			while($row = mysql_fetch_assoc($resultado))
			{ 
				$fls[]= $row['folio_af'];
			}
			$out = array_values($fls);
		?>
		var folios = <?php echo json_encode($out); ?>;
		autocomplete(document.getElementById("folio_compras"), folios);
		</script>
    <script>
      function GetDetail(str) {
          if (str.length == 0) {
              document.getElementById("tipo_compra").value = ""
              document.getElementById("supervisor").value = "";
              document.getElementById("fecha").value = ""
              document.getElementById("folio").value = "";
              document.getElementById("empresa").value = "";
              document.getElementById("ubicacion").value = "";
              document.getElementById("proyecto").value = "";
              document.getElementById("cantidad").value = "";
              document.getElementById("unidad").value = "";
              document.getElementById("descripcion").value = "";
              document.getElementById("uso").value = "";
              document.getElementById("cantidad2").value = "";
              document.getElementById("unidad2").value = "";
              document.getElementById("descripcion2").value = "";
              document.getElementById("uso2").value = "";
              document.getElementById("cantidad3").value = "";
              document.getElementById("unidad3").value = "";
              document.getElementById("descripcion3").value = "";
              document.getElementById("uso3").value = "";
              document.getElementById("cantidad4").value = "";
              document.getElementById("unidad4").value = "";
              document.getElementById("descripcion4").value = "";
              document.getElementById("uso4").value = "";
              document.getElementById("cantidad5").value = "";
              document.getElementById("unidad5").value = "";
              document.getElementById("descripcion5").value = "";
              document.getElementById("uso5").value = "";
              document.getElementById("cantidad6").value = "";
              document.getElementById("unidad6").value = "";
              document.getElementById("descripcion6").value = "";
              document.getElementById("uso6").value = "";
              document.getElementById("cantidad7").value = "";
              document.getElementById("unidad7").value = "";
              document.getElementById("descripcion7").value = "";
              document.getElementById("uso7").value = "";
              document.getElementById("cantidad8").value = "";
              document.getElementById("unidad8").value = "";
              document.getElementById("descripcion8").value = "";
              document.getElementById("uso8").value = "";
              document.getElementById("cantidad9").value = "";
              document.getElementById("unidad9").value = "";
              document.getElementById("descripcion9").value = "";
              document.getElementById("uso9").value = "";
              document.getElementById("cantidad10").value = "";
              document.getElementById("unidad10").value = "";
              document.getElementById("descripcion10").value = "";
              document.getElementById("uso10").value = "";
              document.getElementById("cantidad11").value = "";
              document.getElementById("unidad11").value = "";
              document.getElementById("descripcion11").value = "";
              document.getElementById("uso11").value = "";
              document.getElementById("cantidad12").value = "";
              document.getElementById("unidad12").value = "";
              document.getElementById("descripcion12").value = "";
              document.getElementById("uso12").value = "";
              document.getElementById("cantidad13").value = "";
              document.getElementById("unidad13").value = "";
              document.getElementById("descripcion13").value = "";
              document.getElementById("uso13").value = "";
              document.getElementById("cantidad14").value = "";
              document.getElementById("unidad14").value = "";
              document.getElementById("descripcion14").value = "";
              document.getElementById("uso14").value = "";
              document.getElementById("cantidad15").value = "";
              document.getElementById("unidad15").value = "";
              document.getElementById("descripcion15").value = "";
              document.getElementById("uso15").value = "";
              document.getElementById("cantidad16").value = "";
              document.getElementById("unidad16").value = "";
              document.getElementById("descripcion16").value = "";
              document.getElementById("uso16").value = "";
              document.getElementById("cantidad17").value = "";
              document.getElementById("unidad17").value = "";
              document.getElementById("descripcion17").value = "";
              document.getElementById("uso17").value = "";
              document.getElementById("cantidad18").value = "";
              document.getElementById("unidad18").value = "";
              document.getElementById("descripcion18").value = "";
              document.getElementById("uso18").value = "";
              document.getElementById("cantidad19").value = "";
              document.getElementById("unidad19").value = "";
              document.getElementById("descripcion19").value = "";
              document.getElementById("uso19").value = "";
              document.getElementById("cantidad20").value = "";
              document.getElementById("unidad20").value = "";
              document.getElementById("descripcion20").value = "";
              document.getElementById("uso20").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("tipo_compra").value = myObj[0];
                      document.getElementById(
                          "supervisor").value = myObj[1];
                      document.getElementById(
                      "fecha").value = myObj[2];
                      document.getElementById(
                      "folio").value = myObj[3];
                      document.getElementById(
                      "empresa").value = myObj[4];
                      document.getElementById(
                      "ubicacion").value = myObj[5];
                      document.getElementById(
                      "proyecto").value = myObj[6];
                      document.getElementById(
                      "cantidad").value = myObj[7];
                      document.getElementById(
                      "unidad").value = myObj[8];
                      document.getElementById(
                      "descripcion").value = myObj[9];
                      document.getElementById(
                      "uso").value = myObj[10];
                      document.getElementById(
                      "cantidad2").value = myObj[11];
                      document.getElementById(
                      "unidad2").value = myObj[12];
                      document.getElementById(
                      "descripcion2").value = myObj[13];
                      document.getElementById(
                      "uso2").value = myObj[14];
                      document.getElementById(
                      "cantidad3").value = myObj[15];
                      document.getElementById(
                      "unidad3").value = myObj[16];
                      document.getElementById(
                      "descripcion3").value = myObj[17];
                      document.getElementById(
                      "uso3").value = myObj[18];
                      document.getElementById(
                      "cantidad4").value = myObj[19];
                      document.getElementById(
                      "unidad4").value = myObj[20];
                      document.getElementById(
                      "descripcion4").value = myObj[21];
                      document.getElementById(
                      "uso4").value = myObj[22];
                      document.getElementById(
                      "cantidad5").value = myObj[23];
                      document.getElementById(
                      "unidad5").value = myObj[24];
                      document.getElementById(
                      "descripcion5").value = myObj[25];
                      document.getElementById(
                      "uso5").value = myObj[26];
                      document.getElementById(
                      "cantidad6").value = myObj[27];
                      document.getElementById(
                      "unidad6").value = myObj[28];
                      document.getElementById(
                      "descripcion6").value = myObj[29];
                      document.getElementById(
                      "uso6").value = myObj[30];
                      document.getElementById(
                      "cantidad7").value = myObj[31];
                      document.getElementById(
                      "unidad7").value = myObj[32];
                      document.getElementById(
                      "descripcion7").value = myObj[33];
                      document.getElementById(
                      "uso7").value = myObj[34];
                      document.getElementById(
                      "cantidad8").value = myObj[35];
                      document.getElementById(
                      "unidad8").value = myObj[36];
                      document.getElementById(
                      "descripcion8").value = myObj[37];
                      document.getElementById(
                      "uso8").value = myObj[38];
                      document.getElementById(
                      "cantidad9").value = myObj[39];
                      document.getElementById(
                      "unidad9").value = myObj[40];
                      document.getElementById(
                      "descripcion9").value = myObj[41];
                      document.getElementById(
                      "uso9").value = myObj[42];
                      document.getElementById(
                      "cantidad10").value = myObj[43];
                      document.getElementById(
                      "unidad10").value = myObj[44];
                      document.getElementById(
                      "descripcion10").value = myObj[45];
                      document.getElementById(
                      "uso10").value = myObj[46];
                      document.getElementById(
                      "cantidad11").value = myObj[47];
                      document.getElementById(
                      "unidad11").value = myObj[48];
                      document.getElementById(
                      "descripcion11").value = myObj[49];
                      document.getElementById(
                      "uso11").value = myObj[50];
                      document.getElementById(
                      "cantidad12").value = myObj[51];
                      document.getElementById(
                      "unidad12").value = myObj[52];
                      document.getElementById(
                      "descripcion12").value = myObj[53];
                      document.getElementById(
                      "uso12").value = myObj[54];
                      document.getElementById(
                      "cantidad13").value = myObj[55];
                      document.getElementById(
                      "unidad13").value = myObj[56];
                      document.getElementById(
                      "descripcion13").value = myObj[57];
                      document.getElementById(
                      "uso13").value = myObj[58];
                      document.getElementById(
                      "cantidad14").value = myObj[59];
                      document.getElementById(
                      "unidad14").value = myObj[60];
                      document.getElementById(
                      "descripcion14").value = myObj[61];
                      document.getElementById(
                      "uso14").value = myObj[62];
                      document.getElementById(
                      "cantidad15").value = myObj[63];
                      document.getElementById(
                      "unidad15").value = myObj[64];
                      document.getElementById(
                      "descripcion15").value = myObj[65];
                      document.getElementById(
                      "uso15").value = myObj[66];
                      document.getElementById(
                      "cantidad16").value = myObj[67];
                      document.getElementById(
                      "unidad16").value = myObj[68];
                      document.getElementById(
                      "descripcion16").value = myObj[69];
                      document.getElementById(
                      "uso16").value = myObj[70];
                      document.getElementById(
                      "cantidad17").value = myObj[71];
                      document.getElementById(
                      "unidad17").value = myObj[72];
                      document.getElementById(
                      "descripcion17").value = myObj[73];
                      document.getElementById(
                      "uso17").value = myObj[74];
                      document.getElementById(
                      "cantidad18").value = myObj[75];
                      document.getElementById(
                      "unidad18").value = myObj[76];
                      document.getElementById(
                      "descripcion18").value = myObj[77];
                      document.getElementById(
                      "uso18").value = myObj[78];
                      document.getElementById(
                      "cantidad19").value = myObj[79];
                      document.getElementById(
                      "unidad19").value = myObj[80];
                      document.getElementById(
                      "descripcion19").value = myObj[81];
                      document.getElementById(
                      "uso19").value = myObj[82];
                      document.getElementById(
                      "cantidad20").value = myObj[83];
                      document.getElementById(
                      "unidad20").value = myObj[84];
                      document.getElementById(
                      "descripcion20").value = myObj[85];
                      document.getElementById(
                      "uso20").value = myObj[86];
                      
                  }
              };
              xmlhttp.open("GET", "sol_buscar.php?folio_compr=" + str, true);
              xmlhttp.send();
          }
      }
    </script>
	</body>
</html>