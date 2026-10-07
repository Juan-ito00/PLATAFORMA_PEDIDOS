<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
	{
		header('Location: ../../../index');
		exit();
	}
	include("../../../conexion/conexion.php"); 
	$conexion=Conectarse();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Oficio Asig Modificar</title>
		<!-- Bootstrap -->
		<link href="../../../css/bootstrap.min.css" rel="stylesheet">
		<style type="text/css">
		.rojo {background-color:#FF0000;}
		.azul {color:#0066FF;}
		.verde {color:#009900;}
		select{
			background-color:#FF66FF;
		}
	</style>
<script type="text/javascript" src="../../../js/jquery.js"></script>
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
						<a class="navbar-brand" href="../inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
				</div>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
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
              <li><a href="ofar_nuevo">Nueva Asignación de Ruta</a></li>
              <li><a href="historial_ofar">Historial Asignaciones de Ruta</a></li>
              <li><a href="ofcc_nuevo">Nuevo Oficio Comisión Choferes</a></li>
              <li><a href="historial_ofcc">Historial Oficios Comisión Choferes</a></li>
              <li><a href="ofdlya_nuevo">Nuevo Oficio de DLyA</a></li>
              <li><a href="historial_ofdlya">Historial Oficios de DLyA</a></li>
			  <li><a href="prodNC_nuevo">Nuevo PNC</a></li>
              <li><a href="historial_prodNC">Historial PNC</a></li>
            </ul>
          </li>
						<li><a href="reporte_rutas"><span class="glyphicon glyphicon-book"> </span> Reporte Asignaciones de Ruta</a></li>
						</ul>
					<ul class="nav navbar-nav navbar-right">
							<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
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
						$cot_ad =$_POST["ca1"].' $'.$_POST["ca1m"].' - '.$_POST["ca2"].' $'.$_POST["ca2m"].' - '.$_POST["ca3"].' $'.$_POST["ca3m"];
		              	$query = "UPDATE oficios_asignacion SET asunto='".$_POST["asunto"]."',
						cargos_grales='".$_POST["cargos_grales"]."',
						dirigido1='".$_POST["dirigido1"]."',
						firma1='".$_POST["firma1"]."',
						dirigido2='".$_POST["dirigido2"]."',
						firma2='".$_POST["firma2"]."',
						dirigido3='".$_POST["dirigido3"]."',
						firma3='".$_POST["firma3"]."',
						dirigido4='".$_POST["dirigido4"]."',
						firma4='".$_POST["firma4"]."',
						dirigido5='".$_POST["dirigido5"]."',
						firma5='".$_POST["firma5"]."',
						dirigido6='".$_POST["dirigido6"]."',
						firma6='".$_POST["firma6"]."',
						dirigido7='".$_POST["dirigido7"]."',
						firma7='".$_POST["firma7"]."',
						dirigido8='".$_POST["dirigido8"]."',
						firma8='".$_POST["firma8"]."',
						firma_gercomp='".$_POST["firma_gercomp"]."',
						proveedor='".$_POST["proveedor"]."',
						precio='".$_POST["precio"]."',
						calidad='".$_POST["calidad"]."',
						tiempo_entrega='".$_POST["tiempo_entrega"]."',
						disponibilidad='".$_POST["disponibilidad"]."',
						observaciones='".$_POST["observaciones"]."',
						cot_adquiridas='".$cot_ad."' WHERE id='".$_POST["id"]."'";
            		$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
          
           			 echo "<script languaje='javascript'>
                    alert('Modificado')
        			location.href='historial_ofac';
                  </script>";		
				}
				else
				{
					$id_m=$_GET['id_m'];
					$sql_query="SELECT * FROM oficios_asignacion WHERE id='".$id_m."'";
					$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0)
						{
							while($Rs=mysql_fetch_array($resultado)) 
							{
				?>
				<div class="element">
					<form action="ofac_modificar" method="post">
						<div class="row form-horizontal">
							<div class="col-xs-2">
								<label class="control-label">Folio</label>
								<input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?>">
							</div>
							<div class="col-xs-2">
								<label class="control-label">Fecha</label>
								<input name="fecha" type="date" class="form-control input-sm" readonly value="<?php echo $Rs['fecha']; ?>">
							</div>
							<div class="col-xs-2">
								<label class="control-label">Folio Compras</label>
								<input id="folio_compras" name="folio_compras" type="text" class="form-control input-sm" required value="<?php echo $Rs['folio_compras']; ?>">
							</div>
						</div>
						<br><br>
							<div class="row form-horizontal">
								<div class="col-xs-12">
									<label class="control-label">Asunto</label>
									<textarea name="asunto" class="form-control input-sm" style="resize: none;"><?php echo $Rs['asunto']; ?></textarea>
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-3">
									<label class="control-label">Dirigido a:</label>
								</div>
							</div>
							<br>
							<div class="row form-horizontal">
								<div class="col-xs-5">
									<input name="cargos_grales" type="text" class="form-control input-sm" value="<?php echo $Rs['cargos_grales']; ?>">
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-5">
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from destinatarios ORDER BY nombre ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='dirigido1' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>".$Rs['dirigido1']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
										}
										echo "</select>";
									?>
								</div>
								<div class="col-xs-2">
									<select class='form-control input-sm' name="firma1" disabled>
										<option selected><?php echo $Rs['firma1'];?></option>
										<option value="Elaboró">Elaboró</option>
										<option value="Recibió">Recibió</option>
										<option value="Enterado">Enterado</option>
										<option value="Autorizado">Autorizado</option>
									</select>
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-5">
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from destinatarios ORDER BY nombre ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='dirigido2' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>".$Rs['dirigido2']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
										}
										echo "</select>";
									?>
								</div>
								<div class="col-xs-2">
									<select class='form-control input-sm' name="firma2" disabled>
										<option selected><?php echo $Rs['firma2'];?></option>
										<option value="Elaboró">Elaboró</option>
										<option value="Recibió">Recibió</option>
										<option value="Enterado">Enterado</option>
										<option value="Autorizado">Autorizado</option>
									</select>
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-5">
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from destinatarios ORDER BY nombre ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='dirigido3' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>".$Rs['dirigido3']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
										}
										echo "</select>";
									?>
								</div>
								<div class="col-xs-2">
									<select class='form-control input-sm' name="firma3" disabled>
										<option selected><?php echo $Rs['firma3'];?></option>
										<option value="Elaboró">Elaboró</option>
										<option value="Recibió">Recibió</option>
										<option value="Enterado">Enterado</option>
										<option value="Autorizado">Autorizado</option>
									</select>
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-5">
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from destinatarios ORDER BY nombre ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='dirigido4' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>".$Rs['dirigido4']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
										}
										echo "</select>";
									?>
								</div>
								<div class="col-xs-2">
									<select class='form-control input-sm' name="firma4" disabled>
										<option selected><?php echo $Rs['firma4'];?></option>
										<option value="Elaboró">Elaboró</option>
										<option value="Recibió">Recibió</option>
										<option value="Enterado">Enterado</option>
										<option value="Autorizado">Autorizado</option>
									</select>
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-5">
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from destinatarios ORDER BY nombre ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='dirigido5' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>".$Rs['dirigido5']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
										}
										echo "</select>";
									?>
								</div>
								<div class="col-xs-2">
									<select class='form-control input-sm' name="firma5" disabled>
										<option selected><?php echo $Rs['firma5'];?></option>
										<option value="Elaboró">Elaboró</option>
										<option value="Recibió">Recibió</option>
										<option value="Enterado">Enterado</option>
										<option value="Autorizado">Autorizado</option>
									</select>
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-5">
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from destinatarios ORDER BY nombre ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='dirigido6' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>".$Rs['dirigido6']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
										}
										echo "</select>";
									?>
								</div>
								<div class="col-xs-2">
									<select class='form-control input-sm' name="firma6" disabled>
										<option selected><?php echo $Rs['firma6'];?></option>
										<option value="Elaboró">Elaboró</option>
										<option value="Recibió">Recibió</option>
										<option value="Enterado">Enterado</option>
										<option value="Autorizado">Autorizado</option>
									</select>
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-5">
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from destinatarios ORDER BY nombre ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='dirigido7' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>".$Rs['dirigido7']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
										}
										echo "</select>";
									?>
								</div>
								<div class="col-xs-2">
									<select class='form-control input-sm' name="firma7" disabled>
										<option selected><?php echo $Rs['firma7'];?></option>
										<option value="Elaboró">Elaboró</option>
										<option value="Recibió">Recibió</option>
										<option value="Enterado">Enterado</option>
										<option value="Autorizado">Autorizado</option>
									</select>
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-5">
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from destinatarios ORDER BY nombre ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='dirigido8' class='form-control input-sm'>";
											echo "<option selected class='form-control input-sm'>".$Rs['dirigido8']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
										}
										echo "</select>";
									?>
								</div>
								<div class="col-xs-2">
									<select class='form-control input-sm' name="firma8" disabled>
										<option selected><?php echo $Rs['firma8'];?></option>
										<option value="Elaboró">Elaboró</option>
										<option value="Recibió">Recibió</option>
										<option value="Enterado">Enterado</option>
										<option value="Autorizado">Autorizado</option>
									</select>
								</div>
							</div>
							<div class="row form-horizontal">
                            <div class="col-xs-5">
                                <label class="control-label">Proveedor:</label>
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from proveedores ORDER BY razon_social ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='proveedor' class='form-control input-sm'>";
											echo "<option disabled selected class='form-control input-sm'>".$Rs['proveedor']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";
										}
										echo "</select>";
									?>
								</div>
							</div>
                            <div class="row form-horizontal">
								<div class="col-xs-3">
									<label class="control-label">Basada la decisión en:</label>
									<select name="decision" id="decision_en" class='form-control input-sm' disabled>
										<option disabled selected></option>
										<option value="precio">Precio</option>
										<option value="calidad">Calidad</option>
                                        <option value="tiempo">Tiempo de entrega</option>
                                        <option value="disponibilidad">Disponibilidad</option>
									</select>
								</div>
							</div>
							<br>
							<div class="row form-horizontal" id="o_precio">
								<div class="col-xs-6">
                                    <label class="control-label">Precio > con un monto total con IVA de:</label>
									<input name="precio" type="text" class="form-control input-sm" value="<?php echo $Rs['precio'];?>">
								</div>
							</div>
                            <div class="row form-horizontal" id="o_calidad">
								<div class="col-xs-6">
                                    <label class="control-label">Calidad > debido a:</label>
									<input name="calidad" type="text" class="form-control input-sm" value="<?php echo $Rs['calidad'];?>">
								</div>
							</div>
                            <div class="row form-horizontal" id="o_tiempo">
								<div class="col-xs-6">
                                    <label class="control-label">Tiempo de entrega > con un tiempo máximo de:</label>
									<input name="tiempo_entrega" type="text" class="form-control input-sm" value="<?php echo $Rs['tiempo_entrega'];?>">
								</div>
							</div>
                            <div class="row form-horizontal" id="o_disponibilidad">
								<div class="col-xs-6">
                                    <label class="control-label">Disponibilidad > debido a:</label>
									<input name="disponibilidad" type="text" class="form-control input-sm" value="<?php echo $Rs['disponibilidad'];?>">
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-12">
									<label class="control-label">Observaciones</label>
									<textarea name="observaciones" class="form-control input-sm" maxlength="500"><?php echo $Rs['observaciones'];?></textarea>
								</div>
							</div>
							<br>
							<label class="control-label">Cotizaciones adquiridas:</label>
							<div class="row form-horizontal">
								<div class="col-xs-10">
									<input type="text" class="form-control input-sm" readonly value="<?php echo $Rs['cot_adquiridas'];?>">
								</div>
							</div><br>
							<div class="row form-horizontal">
                            	<div class="col-xs-5">
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from proveedores ORDER BY razon_social ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='ca1' class='form-control input-sm'>";
											echo "<option disabled selected class='form-control input-sm'>".$Rs['ca1']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";
										}
										echo "</select>";
									?>
								</div>
								<div class="col-xs-2">
									<input name="ca1m" type="number" class="form-control input-sm" value="<?php echo $Rs['ca1m'];?>">
								</div>
							</div>
							<div class="row form-horizontal">
                            	<div class="col-xs-5">
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from proveedores ORDER BY razon_social ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='ca2' class='form-control input-sm'>";
											echo "<option disabled selected class='form-control input-sm'>".$Rs['ca2']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";
										}
										echo "</select>";
									?>
								</div>
								<div class="col-xs-2">
									<input name="ca2m" type="number" class="form-control input-sm" value="<?php echo $Rs['ca2m'];?>">
								</div>
							</div>
							<div class="row form-horizontal">
                            	<div class="col-xs-5">
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from proveedores ORDER BY razon_social ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='ca3' class='form-control input-sm'>";
											echo "<option disabled selected class='form-control input-sm'>".$Rs['ca3']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";
										}
										echo "</select>";
									?>
								</div>
								<div class="col-xs-2">
									<input name="ca3m" type="number" class="form-control input-sm" value="<?php echo $Rs['ca3m'];?>">
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
		<script src="../../../js/bootstrap.min.js"></script>
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
				$consulta_mysql = 'SELECT folio_af FROM pedidos WHERE (estado != "Cancelado" AND estado != "Enviado" AND estado != "Revisar Notas" AND year="'.$currY.'") ORDER BY folio_af ASC';

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