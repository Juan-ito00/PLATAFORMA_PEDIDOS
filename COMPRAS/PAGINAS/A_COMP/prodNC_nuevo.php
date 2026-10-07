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
		<title>Producto no Conforme</title>
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
											<li><a href="prodNC_nuevo">Producto no Conforme Ordinario</a></li>
											<li><a href="prodNC_nuevo_rg">Producto no Conforme Requisición General</a></li>
											<li><a href="prodNC_nuevo_sa">Producto no Conforme Solicitud de Anticipo</a></li>
										</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										  <li><a href="historial_prodNC">Producto no Conforme</a></li>
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
                        <li><a href="ofar_nuevo">Nueva Asignación de Ruta</a></li>
						<li><a href="historial_ofar">Historial Asignaciones de Ruta</a></li>
						<li><a href="ofv_nuevo">Nuevo Oficio Vacaciones</a></li>
						<li><a href="historial_ofv">Historial Oficios Vacaciones</a></li>
						<li><a href="ofscvac_nuevo">Nuevo Oficio Permiso a Cuenta de Vacaciones</a></li>
						<li><a href="historial_ofscvac">Historial Permisos a Cuenta de Vacaciones</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book"> </span> Reportes<b class="caret"></b>
						</a>
					<ul class="dropdown-menu">
						<li><a href="reporte_rutas">Reporte Asignaciones de Ruta</a></li>
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
					<form action="prodNC_registrar" method="post">
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<label class="control-label">Folio</label>
									<input name="folio" type="text" class="form-control input-sm" required disabled value="<?php 
								mysql_query("SET NAMES 'utf8'");
								$result = mysql_query("SELECT id FROM folios_pnc ORDER BY id DESC LIMIT 1", $conexion); 								
								if ($row = mysql_fetch_array($result)){ 
									do {  
										$folio = strtoupper(("PNC GCOMP ").str_pad($row["id"]+1,3,'0',STR_PAD_LEFT).date("/ y"));
										echo $folio;
									} while ($row = mysql_fetch_array($result)); 
					
								} else {
									$currY = date("y");
									echo "PNC GCOMP 001/ ".$currY;
								} 
							?> ">
								</div>
								<div class="col-xs-2">
									<label class="control-label">Fecha</label>
									<input name="fecha" type="date" class="form-control input-sm" required value="<?php echo date('d/m/Y'); ?>">
								</div>
                            </div>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<label class="control-label">Aviso de Compra</label>
									<input id="folio_aviso" name="folio_aviso" type="text" class="form-control input-sm" required autocomplete="off" onkeyup="GetDetail(this.value)" required>
								</div>
                                <div class="col-xs-2">
									<label class="control-label">Pedido</label>
									<input id="pedido" name="pedido" type="text" class="form-control input-sm" readonly>
								</div>
                                <div class="col-xs-4">
									<label class="control-label">Proveedor</label>
									<input id="proveedor" name="proveedor" type="text" class="form-control input-sm" readonly>
								</div>
                                <div class="col-xs-4">
                                    <label class="control-label">Recibió</label>
                                    <input id="recibio" name="recibio" type="text" class="form-control input-sm" readonly>
                                </div>
							</div>
							<div class="row form-horizontal">
                                <div class="col-xs-2">
									<label class="control-label">Folio de Factura</label>
									<input id="folio_factura" name="folio_factura" type="text" required class="form-control input-sm">
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-12">
									<label class="control-label">Descripción de no conformidad:</label>
									<textarea name="descripcion" class="form-control input-sm" rows="4" required style="resize: none;"></textarea>
								</div>
							</div>
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
			$consulta_mysql = 'SELECT folio_compras FROM avisos_ordinarios WHERE estado != "Cancelado" AND year="'.$currY.'" ORDER BY folio_compras ASC';

			$resultado = mysql_query($consulta_mysql,$conexion);

			$fls = array(); 
			while($row = mysql_fetch_assoc($resultado))
			{ 
				$fls[]= $row['folio_compras'];
			}
			$out = array_values($fls);
		?>
		var folios = <?php echo json_encode($out); ?>;
		autocomplete(document.getElementById("folio_aviso"), folios);
		</script>
        <script>
      function GetDetail(str) {
          if (str.length == 0) {
              document.getElementById("pedido").value = "";
              document.getElementById("proveedor").value = ""
              document.getElementById("recibio").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById(
                          "pedido").value = myObj[0];
                      document.getElementById(
                      "proveedor").value = myObj[1];
                      document.getElementById(
                      "recibio").value = myObj[2];
                  }
              };
              xmlhttp.open("GET", "pnc_buscar.php?folio_aviso=" + str, true);
              xmlhttp.send();
          }
      }
    </script>
	</body>
</html>