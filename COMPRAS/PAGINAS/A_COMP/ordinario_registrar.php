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
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ordinario Registrar</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
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
											<li><a href="historial_proveedores">Proveedores en Sistema</a></li>
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
                        <li><a href="sol_cotizacion_nuevo">Nueva Solicitud Cotización</a></li>
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
					</ul>
				</li>
						</ul>
					<ul class="nav navbar-nav navbar-right">
							<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
						</ul>
				</div>
			</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading"><?php echo "Registrar Requisición";?></div>
            <div class="panel-body">
            	<?php
					if ($_POST) 
					{
						mysql_query("SET NAMES 'UTF8'");
						mysql_query("SET lc_time_names = 'es_MX'");
						
						$folio=$_POST['folio'];
						$fecha=$_POST['fecha'];
						$folio_compras=$_POST['folio_compras'];
			            $empresa=$_POST['empresa'];
			            $monto_total=$_POST['monto_total'];
			            $moneda=$_POST['moneda'];
						$observaciones=$_POST['observaciones'];
						$proveedor=$_POST['proveedor'];
						$coordinador = $_SESSION['nombre'];
						$agente_ventas = $_POST['agente_ventas'];
						/*$variacion=$_POST['variacion'];
						$cantidad=$_POST['cantidad'];
						$precio=$_POST['precio'];
						$moneda_precio=$_POST['moneda_precio'];
						$total_deposito=$_POST['total_deposito'];
						$moneda_total=$_POST['moneda_total'];*/
						$pedidos_incluidos = $_POST['pedidos_incluidos'];
						$justificacion=ucwords(strtolower($_POST['justificacion']));

						$consulta_mysql = "SELECT folio,supervisor,proyecto,gerencia FROM pedidos WHERE folio_af='".$folio_compras."'";
						$resultado_consulta_mysql = mysql_query($consulta_mysql,$conexion);
						while($fila=mysql_fetch_array($resultado_consulta_mysql))
						  {
							$folio_gerencia = $fila['folio'];
							$supervisor = $fila['supervisor'];
							$proyecto = $fila['proyecto'];
							$gerencia = $fila['gerencia'];
						  }

						$consulta2_mysql = "SELECT correo FROM supervisor WHERE nombre='".$supervisor."'";
						$resultado_consulta2_mysql = mysql_query($consulta2_mysql,$conexion);
						while($fila2=mysql_fetch_array($resultado_consulta2_mysql))
						  {
							$correo_sup = $fila2['correo'];
						  }

						$consulta3_mysql = "SELECT desc_bs FROM proveedores WHERE razon_social='".$proveedor."'";
						$resultado_consulta3_mysql = mysql_query($consulta3_mysql,$conexion);
						while($fila3=mysql_fetch_array($resultado_consulta3_mysql))
						  {
							$desc_bs = $fila3['desc_bs'];
						  }

			            $sql_id = "INSERT INTO folios_ordinarios SET idsdgg='0'";
			            $result_id = mysql_query($sql_id) or die(mysql_error());
			            $id_id = mysql_insert_id();
			            $folio_id =  strtoupper(str_pad($id_id,3,'0',STR_PAD_LEFT).date("/ y"));
			            $sql = "UPDATE folios_ordinarios SET folio='".$folio_id."' WHERE id='".$id_id."'";
			            $result = mysql_query($sql) or die(mysql_error());

						$sql ="INSERT INTO avisos_ordinarios(folio,fecha,folio_compras,folio_gerencia,proyecto,empresa,monto_total,
						moneda,observaciones,pedidos_incluidos,justificacion,proveedor,coordinador,supervisor,correo,agente_ventas) VALUES ('".$folio_id."',
						'".$fecha."','".$folio_compras."','".$folio_gerencia."','".$proyecto."','".$empresa."','".$monto_total."','".$moneda."',
						'".$observaciones."','".$pedidos_incluidos."','".$justificacion."','".$proveedor."','".$coordinador."',
						'".$supervisor."','".$correo_sup."','".$agente_ventas."')";
						$result = mysql_query($sql) or die(mysql_error());

						$consulta_mysql5 = "SELECT id FROM avisos_ordinarios WHERE folio='".$folio_id."'";
						$resultado_consulta_mysql5 = mysql_query($consulta_mysql5,$conexion);
						while($fila5=mysql_fetch_array($resultado_consulta_mysql5))
						  {
							$id5 = $fila5['id'];
						  }

						//---------- SECCIÓN INSERCIÓN DE ARCHIVOS ADJUNTOS ---------------//
						$countfiles = count($_FILES['file']['name']);
						$totalFileUploaded = 0;

						for($i=0;$i<$countfiles;$i++) {
							$filename = $_FILES['file']['name'][$i];
							## Insert to DataBase
							$sql_files ="INSERT INTO expediente_documentos(tipo_aviso,id_aviso,documento) VALUES ('ORD','".$id5."','".$filename."')";
							$result_files = mysql_query($sql_files) or die(mysql_error());

							## Location
							$location = "uploads/".$filename;
							$extension = pathinfo($location,PATHINFO_EXTENSION);
							$extension = strtolower($extension);

							## File upload allowed extensions
							$valid_extensions = array("jpg","jpeg","png","pdf","docx");

							$response = 0;
							## Check file extension
							if(in_array(strtolower($extension), $valid_extensions)) {
								## Upload file
								if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$location)){
									$totalFileUploaded++;
								}
							}
						}
						$msg="Archivos Cargados : ".$totalFileUploaded.".";
							echo "<script languaje='javascript'>
								alert($msg)
								location.href='historial_ordinario';
							</script>";
						//----------- FIN DE SECCIÓN ARCHIVOS ADJUNTOS---------------------//
						 
						echo "<br>";
						echo "<br>";
						echo "<script languaje='javascript'>
                    			alert('Registrado')
        						location.href='historial_ordinario';
        						window.open('pdf/ordinario_pdf.php?folio=".$id5."', '_blank');
                  			</script>";
				?>
                	<br><br>
             	<?php
                   }
                  else
                  {
					$resultado = "Acceso incorrecto";
     			  }
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