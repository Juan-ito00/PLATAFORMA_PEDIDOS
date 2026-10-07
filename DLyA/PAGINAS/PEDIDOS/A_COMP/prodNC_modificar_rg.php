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
	use PHPMailer\PHPMailer\PHPMailer;
	require_once('../../../autoload.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Producto no Conforme Modificar</title>
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
					$query = "UPDATE avisos_pnc SET aviso_compra='".$_POST["folio_aviso"]."',
					folio_compras='".$_POST["pedido"]."',proveedor='".$_POST["proveedor"]."',
					coordinador_aviso='".$_POST["recibio"]."',folio_factura='".$_POST["folio_factura"]."',
					descripcion='".$_POST["descripcion"]."' WHERE id='".$_POST['id']."'";
					$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
		
						echo "<script languaje='javascript'>
					alert('Modificado')
								location.href='historial_prodNC';
					</script>";
				}
				else
				{
					$id=$_GET['id'];
					$sql_query="SELECT * FROM avisos_pnc WHERE id='".$id."'";
					$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0)
						{
							while($Rs=mysql_fetch_array($resultado)) 
							{
				?>
				<div class="element">
					<form action="prodNC_modificar" method="post" enctype='multipart/form-data'>
						<?php
						if($_SESSION['usuario']=='AVISOS')
              {?>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<label class="control-label">Folio</label>
									<input name="folio" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['folio']; ?>">
								</div>
								<div class="col-xs-2">
									<label class="control-label">Fecha</label>
									<input name="fecha" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha']; ?>">
								</div>
                                <div class="col-xs-2">
                              		<input  name="id" type="hidden" class="form-control input-sm" value="<?php echo $Rs['id']; ?>" size="17" />
                  				</div>
                            </div>
                            <div class="row form-horizontal">
								<div class="col-xs-2">
									<label class="control-label">Aviso de Compra</label>
									<input id="folio_aviso" name="folio_aviso" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['aviso_compra']; ?>">
								</div>
                                <div class="col-xs-2">
									<label class="control-label">Pedido</label>
									<input id="pedido" name="pedido" type="text" class="form-control input-sm" value="<?php echo $Rs['folio_compras']; ?>" readonly>
								</div>
                                <div class="col-xs-4">
									<label class="control-label">Proveedor</label>
									<input id="proveedor" name="proveedor" type="text" class="form-control input-sm" value="<?php echo $Rs['proveedor']; ?>" readonly>
								</div>
                                <div class="col-xs-4">
                                    <label class="control-label">Recibió</label>
                                    <input id="recibio" name="recibio" type="text" class="form-control input-sm" value="<?php echo $Rs['coordinador_aviso']; ?>" readonly>
                                </div>
							</div>
							<div class="row form-horizontal">
                                <div class="col-xs-2">
									<label class="control-label">Folio de Factura</label>
									<input id="folio_factura" name="folio_factura" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['folio_factura']; ?>">
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-12">
									<label class="control-label">Descripción de no conformidad:</label>
									<textarea name="descripcion" class="form-control input-sm" rows="4" style="resize: none;" readonly><?php echo $Rs['descripcion']; ?></textarea>
								</div>
							</div>
							</div>
							<?php
        	 		}
							else
              {?>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<label class="control-label">Folio</label>
									<input name="folio" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['folio']; ?>">
								</div>
								<div class="col-xs-2">
									<label class="control-label">Fecha</label>
									<input name="fecha" type="date" class="form-control input-sm" disabled value="<?php echo $Rs['fecha']; ?>">
								</div>
                                <div class="col-xs-2">
                              		<input  name="id" type="hidden" class="form-control input-sm" value="<?php echo $Rs['id']; ?>" size="17" />
                  				</div>
                            </div>
                            <div class="row form-horizontal">
								<div class="col-xs-2">
									<label class="control-label">Aviso de Compra</label>
									<input id="folio_aviso" name="folio_aviso" type="text" class="form-control input-sm" required autocomplete="off" onkeyup="GetDetail(this.value)" value="<?php echo $Rs['aviso_compra']; ?>" required>
								</div>
                                <div class="col-xs-2">
									<label class="control-label">Pedido</label>
									<input id="pedido" name="pedido" type="text" class="form-control input-sm" value="<?php echo $Rs['folio_compras']; ?>" readonly>
								</div>
                                <div class="col-xs-4">
									<label class="control-label">Proveedor</label>
									<input id="proveedor" name="proveedor" type="text" class="form-control input-sm" value="<?php echo $Rs['proveedor']; ?>" readonly>
								</div>
                                <div class="col-xs-4">
                                    <label class="control-label">Recibió</label>
                                    <input id="recibio" name="recibio" type="text" class="form-control input-sm" value="<?php echo $Rs['coordinador_aviso']; ?>" readonly>
                                </div>
							</div>
							<div class="row form-horizontal">
                                <div class="col-xs-2">
									<label class="control-label">Folio de Factura</label>
									<input id="folio_factura" name="folio_factura" type="text" required class="form-control input-sm" value="<?php echo $Rs['folio_factura']; ?>">
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-12">
									<label class="control-label">Descripción de no conformidad:</label>
									<textarea name="descripcion" class="form-control input-sm" rows="4" required style="resize: none;"><?php echo $Rs['descripcion']; ?></textarea>
								</div>
							</div>
							<br>
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
			$consulta_mysql = 'SELECT folio_compras FROM avisos_rg WHERE estado != "Cancelado" AND year="'.$currY.'" ORDER BY folio_compras ASC';

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
              xmlhttp.open("GET", "pnc_buscar_rg.php?folio_aviso=" + str, true);
              xmlhttp.send();
          }
      }
    </script>
	</body>
</html>