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
											<span class="dropdown-header" href="#">Aviso de Compra</span>
											<li><a href="historial_ordinario">Aviso de Compra Ordinario</a></li>
											<li><a href="historial_ordinario_sem">Aviso de Compra Semanal</a></li>
											<li><a href="historial_ordinario_ext">Aviso de Compra Extraordinario</a></li>
											<hr>
											<li><a href="historial_anticipo">Aviso de Compra Requiere Anticipo</a></li>
											<li><a href="historial_requisicion">Aviso de Compra Requisición General</a></li>
											<hr>
											<li><a href="historial_datos">Datos de Proveedor</a></li>
											<li><a href="historial_solicitud">Solicitud de Anticipo</a></li>
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
										<li><a href="reporte_solicitud">Reporte Solicitudes de Anticipo</a></li>
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
									<span class="dropdown-header" href="#">Aviso de Compra</span>
									<li><a href="ordinario_nuevo">Aviso de Compra Ordinario</a></li>
									<li><a href="ordinario_sem_nuevo">Aviso de Compra Semanal</a></li>
									<li><a href="ordinario_ext_nuevo">Aviso de Compra Extraordinario</a></li>
									<hr>
									<li><a href="anticipo_nuevo">Aviso de Compra Requiere Anticipo</a></li>
									<li><a href="requisicion_nuevo">Aviso de Compra Requisición General</a></li>
									<hr>
									<li><a href="datos_nuevo">Datos de Proveedor</a></li>
									<li><a href="solicitud_nuevo">Solicitud de Anticipo</a></li>
								</ul>
							</li>
							<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
										</a>
										<ul class="dropdown-menu">
											<span class="dropdown-header" href="#">Aviso de Compra</span>
											<li><a href="historial_ordinario">Aviso de Compra Ordinario</a></li>
											<li><a href="historial_ordinario_sem">Aviso de Compra Semanal</a></li>
											<li><a href="historial_ordinario_ext">Aviso de Compra Extraordinario</a></li>
											<hr>
											<li><a href="historial_anticipo">Aviso de Compra Requiere Anticipo</a></li>
											<li><a href="historial_requisicion">Aviso de Compra Requisición General</a></li>
											<hr>
											<li><a href="historial_datos">Datos de Proveedor</a></li>
											<li><a href="historial_solicitud">Solicitud de Anticipo</a></li>
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
										<li><a href="reporte_solicitud">Reporte Solicitudes de Anticipo</a></li>
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
                    $query = "UPDATE evaluaciones SET empresa='".$_POST["empresa"]."',meses='".$_POST["meses"]."',
                    razon_social='".$_POST["razon_social"]."',califica='".$_POST["califica"]."', rfc='".$_POST["rfc"]."',
                    direccion='".$_POST["direccion"]."', "."contacto='".$_POST["contacto"]."',"."prod_serv='".$_POST["prod_serv"]."',
                    compras_realizadas='".$_POST["compras_realizadas"]."' WHERE id='".$_POST["id"]."'";
		              	
            		$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
          
           			 echo "<script languaje='javascript'>
						alert('Modificada')
						location.href='evaluaciones';
					</script>";		
				}
				else
				{
					$id_eval=$_GET['id_ev'];
					$sql_query="SELECT * FROM evaluaciones WHERE id='".$id_eval."'";
					$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0)
						{
							while($Rs=mysql_fetch_array($resultado)) 
							{
				?>
                    <div class="element">
                        <form action="evaluacion_modificar" method="post">
                            <div class="row form-horizontal">
								<div class="col-xs-2">
									<label class="control-label">Folio</label>
									<input name="folio" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['folio'];?> ">
								</div>
                                <div class="col-xs-2">
									<label class="control-label">Fecha</label>
									<input name="fecha" type="text" class="form-control input-sm" readonly value="<?php echo date('d-m-Y', strtotime($Rs['fecha']));?> ">
								</div>
								<div class="col-xs-3">
									<label class="control-label">Empresa que evalúa</label>
									<select name="empresa" class="form-control input-sm" required>
                                        <option><?php echo $Rs['empresa']; ?></option>
										<option value="Montajes y Estructuras de Zacatecas">Montajes y Estructuras de Zacatecas</option>
										<option value="Cavi de Sombrerete">Cavi de Sombrerete</option>
										<option value="Concretos Cavi">Concretos Cavi</option>
									</select>
								</div>
                                <div class="col-xs-2">
									<label class="control-label">Momento de evaluación</label>
									<input name="momento" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['momento'];?> ">
								</div>
                                <div class="col-xs-3">
									<label class="control-label">Meses que evaluar</label>
									<select name="meses" class="form-control input-sm" required>
                                        <option><?php echo $Rs['meses']; ?></option>
										<option value="Enero-Marzo">Enero-Marzo</option>
										<option value="Abril-Junio">Abril-Junio</option>
										<option value="Julio-Septiembre">Julio-Septiembre</option>
                                        <option value="Octubre-Diciembre">Octubre-Diciembre</option>
									</select>
								</div>
							</div><br><br>
							<div class="row form-horizontal">
                                <div class="col-xs-4">
									<label class="control-label">Razón Social</label>
									<?php
									  mysql_query("SET NAMES 'UTF8'");
									  $consulta_mysql = 'SELECT razon_social FROM proveedores ORDER BY razon_social ASC';
									  $resultado_consulta_mysql = mysql_query($consulta_mysql,$conexion);
									  echo "<select name='razon_social' class='form-control input-sm' required onchange='GetDetail(this.value)'>";
									  echo "<option> {$Rs['razon_social']}</option>";
									  while($fila=mysql_fetch_array($resultado_consulta_mysql))
									  {
										echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";
									  }
									  echo "</select>";
									?>
								</div>
								<div class="col-xs-4">
									<label class="control-label">Persona que califica</label>
									<select name="califica" class="form-control input-sm" required>
										<option><?php echo $Rs['califica']; ?></option>
										<option value="DO Fabricación y Venta de Concreto Premezclado">DO Fabricación y Venta de Concreto Premezclado</option>
										<option value="DO Renta de Maquinaria Pesada y Transporte">DO Renta de Maquinaria Pesada y Transporte</option>
										<option value="DO Mantenimientos Predictivos, Preventivos y Correctivos">DO Mantenimientos Predictivos, Preventivos y Correctivos</option>
                                        <option value="DO Fabricación y Mantenimientos en Soldadura Industrial y Enlainados">DO Fabricación y Mantenimientos en Soldadura Industrial y Enlainados</option>
                                        <option value="Gerencia de Finanzas">Gerencia de Finanzas</option>
									</select>
								</div>
								<div class="col-xs-1">
									<input name="id" type="hidden" class="form-control input-sm" value="<?php echo $Rs['id'];?> ">
								</div>
							</div>
							<div class="row form-horizontal">
                                    <!--obtener RFC, DIRECCIÓN, CONTACTO,PROD_SERV y rellenas automáticamente-->
								<div class="col-xs-4"> 
									<label class="control-label">RFC</label>
									<input name="rfc" id="rfc" size="13" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['rfc'];?> ">
								</div>
                            </div>
							<div class="row form-horizontal">
								<div class="col-xs-4">
									<label class="control-label">Dirección</label>
									<input name="direccion" id="direccion" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['direccion'];?> ">
								</div>
                            </div>
                            <div class="row form-horizontal">
								<div class="col-xs-4">
									<label class="control-label">Contacto</label>
									<input name="contacto" id="contacto" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['contacto'];?> ">
								</div>
                            </div>
                            <div class="row form-horizontal">
								<div class="col-xs-4">
									<label class="control-label">Producto o Servicio</label>
									<input name="prod_serv" id="prod_serv" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['prod_serv'];?> ">
								</div>
                            </div>
                            <div class="row form-horizontal">
                            <!--hacer SELECT para contar-->
								<div class="col-xs-4">
									<label class="control-label">Compras realizadas en el trimestre</label>
									<input name="compras_realizadas" id="compras_realizadas" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['compras_realizadas'];?> ">
								</div>
							</div>
							<br>
							<div id="btn-form">
	          	 				<input class="btn form-btn btn-primary" type="submit" name="submit" value="Modificar">
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
        <script>
            function GetDetail(str) {
                if (str.length == 0) {
                    document.getElementById("rfc").value = ""
                    document.getElementById("direccion").value = "";
                    document.getElementById("contacto").value = ""
                    document.getElementById("prod_serv").value = "";
                    document.getElementById("compras_realizadas").value = "";
                    return;
                }
                else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && 
                                this.status == 200) {
                            var myObj = JSON.parse(this.responseText);
                            document.getElementById("rfc").value = myObj[0];
                            document.getElementById("direccion").value = myObj[1];
                            document.getElementById("contacto").value = myObj[2];
                            document.getElementById("prod_serv").value = myObj[3];
                            document.getElementById("compras_realizadas").value = myObj[4];
                            
                        }
                    };
                    xmlhttp.open("GET", "eval_buscar.php?razon=" + str, true);
                    xmlhttp.send();
                }
            }
        </script>
	</body>
</html>