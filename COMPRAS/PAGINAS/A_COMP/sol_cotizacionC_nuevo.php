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
					<form action="sol_cotizacionC_insertar" method="post">
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
										<label class="control-label">Folio Cotización</label>
										<input id="folio_compras" name="folio_compras" type="text" class="form-control input-sm" required autocomplete="off" onkeyup="GetDetail(this.value)">
									</div>
								</div>
							<br>
                <div class="row form-horizontal">
                    <div class="col-xs-3">
                      <label class="control-label" for="supervisor">Solicitante</label>
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
                    <div class="col-xs-3">
                    <label class="control-label" for="ubicacion">Gerencia</label>
                        <input class="form-control input-sm" name="ubicacion" id="ubicacion" readonly ="text" value=""  size="17" />
                    </div>
                  <div class="col-xs-2">
                              <input  name="id" type="hidden" class="form-control input-sm" required value="" size="17" />
                  </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-4">
                      <label class="control-label" for="proyecto">Proyecto</label>
                      <input class="form-control input-sm" name="proyecto" id="proyecto" readonly ="text" value=""  size="17" />
                      </div>
                        </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <label class="control-label" for="unidad">Unidad</label>
                      <input name="unidad" id="unidad" class="form-control input-sm" type="text" readonly value="" size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <label class="control-label" for="descripcion">Descripción</label>
                      <input name="descripcion" id="descripcion" class="form-control input-sm" type="text" readonly value=""  size="87"  />
                    </div>
                    <div class="col-xs-1">
                      <label class="control-label" for="descripcion">Partida</label>
                      <input name="partida1" id="partida1" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                      <input id="unidad2" name="unidad2" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion2" name="descripcion2" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida2" id="partida2" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                  <div class="col-xs-2">
                      <input id="unidad3" name="unidad3" type="text" class="form-control input-sm" readonly value="" size="15" />  
                    </div>
                    <div class="col-xs-4">
                      <input id="descripcion3" name="descripcion3" type="text" class="form-control input-sm" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida3" id="partida3" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
              <div class="col-xs-2">
                <input id="unidad4" name="unidad4" type="text" class="form-control input-sm" readonly value="" size="15" />
                    </div>
                    <div class="col-xs-4">
                      <input id="descripcion4" name="descripcion4" type="text" class="form-control input-sm" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida4" id="partida4" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                       </div>
              <div class="row form-horizontal">
                      <div class="col-xs-2">
                      <input id="unidad5" name="unidad5" type="text" class="form-control input-sm" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                <input id="descripcion5" name="descripcion5" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida5" id="partida5" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                <input id="unidad6" name="unidad6" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                <input id="descripcion6" name="descripcion6" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida6" id="partida6" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <input id="unidad7" name="unidad7" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion7" name="descripcion7" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida7" id="partida7" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                <input id="unidad8" name="unidad8" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion8" name="descripcion8" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida8" id="partida8" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                        <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <input id="unidad9" name="unidad9" class="form-control input-sm" type="text" readonly value=""size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion9" name="descripcion9" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida9" id="partida9" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                        <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <input id="unidad10" name="unidad10" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                <input id="descripcion10" name="descripcion10" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida10" id="partida10" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <input id="unidad11" name="unidad11" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion11" name="descripcion11" class="form-control input-sm" type="text" readonly value="" size="87" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida11" id="partida11" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <input id="unidad12" name="unidad12" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion12" name="descripcion12" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida12" id="partida12" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <input id="unidad13" name="unidad13" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion13" name="descripcion13" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida13" id="partida13" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <input id="unidad14" name="unidad14" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion14" name="descripcion14" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida14" id="partida14" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <input id="unidad15" name="unidad15" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion15" name="descripcion15" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida15" id="partida15" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <input id="unidad16" name="unidad16" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion16" name="descripcion16" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida16" id="partida16" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <input id="unidad17" name="unidad17" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion17" name="descripcion17" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida17" id="partida17" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                    </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <input id="unidad18" name="unidad18" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion18" name="descripcion18" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida18" id="partida18" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <input id="unidad19" name="unidad19" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion19"name="descripcion19" class="form-control input-sm" type="text" readonly value="" />
                    </div>
                    <div class="col-xs-1">
                      <input name="partida19" id="partida19" class="form-control input-sm" type="text" value=""  size="2"  />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <input id="unidad20" name="unidad20" class="form-control input-sm" type="text" readonly value="" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input id="descripcion20" name="descripcion20" class="form-control input-sm" type="text" readonly value="" />
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
			$consulta_mysql = 'SELECT folio_compras FROM cotizaciones WHERE estado ="Recibido" AND year="'.$currY.'" ORDER BY folio_compras ASC';

			$resultado = mysql_query($consulta_mysql,$conexion);

			$fls = array(); 
			while($row = mysql_fetch_assoc($resultado))
			{ 
				$fls[]= $row['folio_compras'];
			}
			$out = array_values($fls);
		?>
		var folios = <?php echo json_encode($out); ?>;
		autocomplete(document.getElementById("folio_compras"), folios);
		</script>
    <script>
      function GetDetail(str) {
          if (str.length == 0) {
              document.getElementById("supervisor").value = "";
              document.getElementById("fecha").value = ""
              document.getElementById("folio").value = "";
              document.getElementById("ubicacion").value = "";
              document.getElementById("proyecto").value = "";
              document.getElementById("unidad").value = "";
              document.getElementById("descripcion").value = "";
              document.getElementById("unidad2").value = "";
              document.getElementById("descripcion2").value = "";
              document.getElementById("unidad3").value = "";
              document.getElementById("descripcion3").value = "";
              document.getElementById("unidad4").value = "";
              document.getElementById("descripcion4").value = "";
              document.getElementById("unidad5").value = "";
              document.getElementById("descripcion5").value = "";
              document.getElementById("unidad6").value = "";
              document.getElementById("descripcion6").value = "";
              document.getElementById("unidad7").value = "";
              document.getElementById("descripcion7").value = "";
              document.getElementById("unidad8").value = "";
              document.getElementById("descripcion8").value = "";
              document.getElementById("unidad9").value = "";
              document.getElementById("descripcion9").value = "";
              document.getElementById("unidad10").value = "";
              document.getElementById("descripcion10").value = "";
              document.getElementById("unidad11").value = "";
              document.getElementById("descripcion11").value = "";
              document.getElementById("unidad12").value = "";
              document.getElementById("descripcion12").value = "";
              document.getElementById("unidad13").value = "";
              document.getElementById("descripcion13").value = "";
              document.getElementById("unidad14").value = "";
              document.getElementById("descripcion14").value = "";
              document.getElementById("unidad15").value = "";
              document.getElementById("descripcion15").value = "";
              document.getElementById("unidad16").value = "";
              document.getElementById("descripcion16").value = "";
              document.getElementById("unidad17").value = "";
              document.getElementById("descripcion17").value = "";
              document.getElementById("unidad18").value = "";
              document.getElementById("descripcion18").value = "";
              document.getElementById("unidad19").value = "";
              document.getElementById("descripcion19").value = "";
              document.getElementById("unidad20").value = "";
              document.getElementById("descripcion20").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById(
                          "supervisor").value = myObj[0];
                      document.getElementById(
                      "fecha").value = myObj[1];
                      document.getElementById(
                      "folio").value = myObj[2];
                      document.getElementById(
                      "ubicacion").value = myObj[3];
                      document.getElementById(
                      "proyecto").value = myObj[4];
                      document.getElementById(
                      "unidad").value = myObj[5];
                      document.getElementById(
                      "descripcion").value = myObj[6];
                      document.getElementById(
                      "unidad2").value = myObj[7];
                      document.getElementById(
                      "descripcion2").value = myObj[8];
                      document.getElementById(
                      "unidad3").value = myObj[9];
                      document.getElementById(
                      "descripcion3").value = myObj[10];
                      document.getElementById(
                      "unidad4").value = myObj[11];
                      document.getElementById(
                      "descripcion4").value = myObj[12];
                      document.getElementById(
                      "unidad5").value = myObj[13];
                      document.getElementById(
                      "descripcion5").value = myObj[14];
                      document.getElementById(
                      "unidad6").value = myObj[15];
                      document.getElementById(
                      "descripcion6").value = myObj[16];
                      document.getElementById(
                      "unidad7").value = myObj[17];
                      document.getElementById(
                      "descripcion7").value = myObj[18];
                      document.getElementById(
                      "unidad8").value = myObj[19];
                      document.getElementById(
                      "descripcion8").value = myObj[20];
                      document.getElementById(
                      "unidad9").value = myObj[21];
                      document.getElementById(
                      "descripcion9").value = myObj[22];
                      document.getElementById(
                      "unidad10").value = myObj[23];
                      document.getElementById(
                      "descripcion10").value = myObj[24];
                      document.getElementById(
                      "unidad11").value = myObj[25];
                      document.getElementById(
                      "descripcion11").value = myObj[26];
                      document.getElementById(
                      "unidad12").value = myObj[27];
                      document.getElementById(
                      "descripcion12").value = myObj[28];
                      document.getElementById(
                      "unidad13").value = myObj[29];
                      document.getElementById(
                      "descripcion13").value = myObj[30];
                      document.getElementById(
                      "unidad14").value = myObj[31];
                      document.getElementById(
                      "descripcion14").value = myObj[32];
                      document.getElementById(
                      "unidad15").value = myObj[33];
                      document.getElementById(
                      "descripcion15").value = myObj[34];
                      document.getElementById(
                      "unidad16").value = myObj[35];
                      document.getElementById(
                      "descripcion16").value = myObj[36];
                      document.getElementById(
                      "unidad17").value = myObj[37];
                      document.getElementById(
                      "descripcion17").value = myObj[38];
                      document.getElementById(
                      "unidad18").value = myObj[39];
                      document.getElementById(
                      "descripcion18").value = myObj[40];
                      document.getElementById(
                      "unidad19").value = myObj[41];
                      document.getElementById(
                      "descripcion19").value = myObj[42];
                      document.getElementById(
                      "unidad20").value = myObj[43];
                      document.getElementById(
                      "descripcion20").value = myObj[44];
                      
                  }
              };
              xmlhttp.open("GET", "sol_buscarC.php?folio_compr=" + str, true);
              xmlhttp.send();
          }
      }
    </script>
	</body>
</html>