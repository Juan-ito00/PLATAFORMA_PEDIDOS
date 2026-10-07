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
		<title>Requisición General</title>
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
					<form action="requisicion_registrar" method="post">
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<label class="control-label">Folio</label>
									<input name="folio" type="text" class="form-control input-sm" required disabled value="<?php 
								mysql_query("SET NAMES 'utf8'");
								$result = mysql_query("SELECT id FROM folios_rg ORDER BY id DESC LIMIT 1", $conexion); 								
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
								<div class="col-xs-2">
									<label class="control-label">Fecha</label>
									<input name="fecha" type="date" class="form-control input-sm" required value="<?php echo date('d/m/Y'); ?>">
								</div>
								<div class="col-xs-2">
									<label class="control-label">Folio Compras</label>
									<input id="folio_compras" name="folio_compras" type="text" class="form-control input-sm" required autocomplete="off">
								</div>
								<div class="col-xs-6">
									<label class="control-label">Empresa que Solicita</label>
									<select name="empresa" class="form-control input-sm" required>
										<option disabled selected></option>
										<option value="CAVI DE SOMBRERETE S.A. de C.V.">CAVI DE SOMBRERETE S.A. de C.V.</option>
										<option value="CONCRETOS CAVI S.A. de C.V.">CONCRETOS CAVI S.A. de C.V.</option>
										<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
										<option value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V. (Sucursal)</option>
									</select>
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<label class="control-label">No. de Cotización</label>
									<input name="cotizacion" type="text" class="form-control input-sm" required>
								</div>
								<div class="col-xs-2">
									<label class="control-label">Monto Total con I.V.A.</label>
									<input name="monto_total" type="number" step="0.01" class="form-control input-sm" required>
								</div>
								<div class="col-xs-2">
									<label class="control-label">Moneda</label>
									<select name="moneda" class="form-control input-sm" required>
										<option disabled selected></option>
										<option value="MXN">MXN</option>
										<option value="DLLS">DLLS</option>
									</select>
								</div>
								<div class="col-xs-3">
									<label class="control-label">Observaciones</label>
									<select name="observaciones" class="form-control input-sm" required>
										<option disabled selected></option>
										<option value="Se surtirá en parcialidades">Se surtirá en parcialidades</option>
										<option value="Se surtirá conforme se presente el personal">Se surtirá conforme se presente el personal</option>
									</select>
								</div>
								<div class="col-xs-3">
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
								<div class="col-xs-4">
									<label class="control-label">Agente de Ventas</label>
									<input name="agente_ventas" type="text" class="form-control input-sm">
								</div>
							</div>
							<input type="file" name="file[]" id="file" multiple>
							<br>
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
			$consulta_mysql = 'SELECT folio_af FROM pedidos WHERE estado != "Surtido" AND estado != "Cancelado" AND estado != "Enviado" AND estado != "Revisar Notas" AND year="'.$currY.'" ORDER BY folio_af ASC';

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
	</body>
</html>