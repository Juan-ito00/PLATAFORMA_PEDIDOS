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
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Historial de Oficios</title>
		<!-- Bootstrap -->
		<link href="../../css/bootstrap.min.css" rel="stylesheet">
		<link href="../../css/dataTables.bootstrap.min.css" rel="stylesheet">
		<link href="../../css/fixedColumns.bootstrap.min.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>
<body>
	<!--Barra de titulo-->
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
							else if($_SESSION['usuario']=='ACCYNTHIA')
							{?>
								
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
				<div class="panel panel-default" style="margin-top: 5px;">
					<div align="center" class="panel-heading">Historial de Oficios Contratos</div>
						<div class="panel-body">
							<?php  
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'UTF8'");
					mysql_query("SET lc_time_names = 'es_MX'");
					$buscar=$_GET['buscar'];
					//Paginacion
					$currentPage = $_SERVER["PHP_SELF"];
					$maxRows_folio = 10;
					$pageNum_folio = 0;
					if (isset($_GET['pageNum_folio'])) {
							$pageNum_folio = $_GET['pageNum_folio'];
					}
					$currY = date("Y");
					$startRow_folio = $pageNum_folio * $maxRows_folio;
					$query= "SELECT * FROM oficios_contratos WHERE year(fecha_firma) = $currY ORDER BY folio ASC";
					//$query_limit = sprintf("%s LIMIT %d, %d", $query, $startRow_folio,$maxRows_folio );
					$folio = mysql_query($query) or die(mysql_error());
					$row_folio = mysql_fetch_assoc($folio);
					if (isset($_GET['totalRows_folio'])) {
							$totalRows_folio = $_GET['totalRows_folio'];
					} else {
							$all_folio = mysql_query($query);
							$totalRows_folio = mysql_num_rows($all_folio);
					}
					$totalPages_folio = ceil($totalRows_folio/$maxRows_folio)-1;
					$queryString_folio = "";
					if (!empty($_SERVER['QUERY_STRING'])) {
							$params = explode("&", $_SERVER['QUERY_STRING']);
							$newParams = array();
							foreach ($params as $param) {
								if (stristr($param, "pageNum_folio") == false && stristr($param, "totalRows_folio") == false) {
										array_push($newParams, $param);
								}
							}
							if (count($newParams) != 0) {
								$queryString_folio = "&" . htmlentities(implode("&", $newParams));
							}
					}
					$queryString_folio = sprintf("&totalRows_folio=%d%s", $totalRows_folio, $queryString_folio);
					//GENERA LA TABLA PARA MOSTRAR LOS DATOS
				?>
				<?php
				?>
						<table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
							<thead>
								<tr>
									<th><strong>Folio</strong></th>
									<th><strong>Tipo</strong></th>
									<th><strong>Cliente</strong></th>
                                    <th><strong>Proveedor</strong></th>
                                    <th><strong>Inicio</strong></th>
                                    <th><strong>Termino</strong></th>
									<th><strong>Estado</strong></th>
									<th style="text-align: center;"><strong>EDITAR</strong></th>
									<th style="text-align: center;"><strong>CANCELAR</strong></th>
									<th style="text-align: center;"><strong>PDF</strong></th>
								</tr>
							</thead>
							<tbody>
									<?php
						$vacio=mysql_query($query) or die (mysql_error());
						do {
							if($row_folio["fecha_inicio"] == NULL && $row_folio["fecha_termino"] == NULL) {
								$f_inicio= " ";
								$f_termino  = " ";
							}
							else {
								$f_inicio = date("d-m-Y",strtotime($row_folio["fecha_inicio"]));
								$f_termino = date("d-m-Y",strtotime($row_folio["fecha_termino"]));
							}
							echo"<tr>".
								"<td style='font-size:12px;'>".$row_folio["folio"]."</td>".
								"<td style='font-size:12px;'>".$row_folio["tipo"]."</td>".
                                "<td style='font-size:12px;'>".$row_folio["empresa"]."</td>".
                                "<td style='font-size:12px;'>".$row_folio["proveedor"]."</td>".
								"<td style='font-size:12px;'>".$f_inicio."</td>".
                                "<td style='font-size:12px;'>".$f_termino."</td>".
								"<td style='font-size:12px;'>".$row_folio["estado"]."</td>".
								"<td style='font-size:12px;' align='center'><a class='glyphicon glyphicon-pencil' href=./ofcon_modificar?id_m=".$row_folio["id"]."></a></td>".
								"<td style='font-size:12px;' align='center'><a class='glyphicon glyphicon-remove' href=./ofcon_cancelar?folio=".$row_folio["id"]."></a></td>".
								"<td style='font-size:12px;' align='center'><a class='glyphicon glyphicon-save' target='_blank' href=./pdf/ofcon_pdf?est=".$row_folio["estado"]."&id_f=".$row_folio["id"]."></a></td>".
							"</tr>";
							}
							while($row_folio=mysql_fetch_array($folio));		
						?>
						</tbody>
							</table>
												<?php
						?>	
												<div align="center">
								
								Registros totales: <?php echo $totalRows_folio ?>
						</div>
				</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="../../js/jquery-3.3.1.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../../js/jquery.dataTables.min.js"></script>
		<script src="../../js/dataTables.bootstrap.min.js"></script>
		<script src="../../js/dataTables.fixedColumns.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() 
			{
				var table = $('#example').DataTable( {
						scrollY:        "300px",
						scrollX:        true,
						scrollCollapse: true,
						paging:         false,
						fixedColumns:   true
				} );
			});
		</script>
	</body>
</html>