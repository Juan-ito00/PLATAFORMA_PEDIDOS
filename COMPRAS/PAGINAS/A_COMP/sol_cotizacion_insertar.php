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
	<title>Solicitud Registrar</title>
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
						</ul>
					<ul class="nav navbar-nav navbar-right">
							<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
						</ul>
				</div>
			</nav>
		<!--Panel con el titulo de la pagina y contenido-->
		<div class="panel panel-default" style="margin-top: 5px;">
			<div align="center" class="panel-heading"><?php echo "Registrar Solicitud Cotización";?></div>
			<div class="panel-body">
				<?php
					if ($_POST) 
					{
						mysql_query("SET NAMES 'UTF8'");
						mysql_query("SET lc_time_names = 'es_MX'");
						
						//$folio=$_POST['folio'];
						$proveedor=$_POST['proveedor'];
						$tipo_proveedor=$_POST['tipo_proveedor'];
						$fecha_limite=$_POST['fecha_limite'];
                        $folio_compras=$_POST['folio_compras'];
                        $empresa=$_POST['empresa'];

                        //CHECKBOXES PARA PARTIDAS
                        $pt1 = $_POST['partida1'];
                        $pt2 = $_POST['partida2'];
                        $pt3 = $_POST['partida3'];
                        $pt4 = $_POST['partida4'];
                        $pt5 = $_POST['partida5'];
                        $pt6 = $_POST['partida6'];
                        $pt7 = $_POST['partida7'];
                        $pt8 = $_POST['partida8'];
                        $pt9 = $_POST['partida9'];
                        $pt10 = $_POST['partida10'];
                        $pt11 = $_POST['partida11'];
                        $pt12 = $_POST['partida12'];
                        $pt13 = $_POST['partida13'];
                        $pt14 = $_POST['partida14'];
                        $pt15 = $_POST['partida15'];
                        $pt16 = $_POST['partida16'];
                        $pt17 = $_POST['partida17'];
                        $pt18 = $_POST['partida18'];
                        $pt19 = $_POST['partida19'];
                        $pt20 = $_POST['partida20'];
						
						$coordinador = $_SESSION['nombre'];
						$fecha = $date = date('Y-m-d');

						$sql_id = "INSERT INTO folios_sol_cot SET idsdgg='0'";
						$result_id = mysql_query($sql_id) or die(mysql_error());
						$id_id = mysql_insert_id();
						$folio_id =  strtoupper(str_pad($id_id,3,'0',STR_PAD_LEFT).date("/ y"));
						$sql = "UPDATE folios_sol_cot SET folio='".$folio_id."' WHERE id='".$id_id."'";
						$result = mysql_query($sql) or die(mysql_error());

                        $fields_insert = 'folio, fecha, proveedor, tipo_proveedor, fecha_limite, folio_compras, empresa, coordinador';
                        $fields_values_insert = '"'.$folio_id.'","'.$fecha.'","'.$proveedor.'","'.$tipo_proveedor.'","'.$fecha_limite.'","'.$folio_compras.'","'.$empresa.'","'.$coordinador.'"';

                        //CHECAR ARTÍCULOS SELECCIONADOS Y AGREGAR AL QUERY
                        if(!empty($pt1))
                        {
                            $fields_insert .= ',cantidad1, unidad1, desc1, uso1, partida1';
                            $fields_values_insert .= ',"'.$_POST['cantidad'].'","'.$_POST['unidad'].'","'.$_POST['descripcion'].'","'.$_POST['uso'].'","'.$pt1.'"';
                        }
                        if(!empty($pt2))
                        {
                            $fields_insert .= ',cantidad2, unidad2, desc2, uso2, partida2';
                            $fields_values_insert .= ',"'.$_POST['cantidad2'].'","'.$_POST['unidad2'].'","'.$_POST['descripcion2'].'","'.$_POST['uso2'].'","'.$pt2.'"';
                        }
                        if(!empty($pt3))
                        {
                            $fields_insert .= ',cantidad3, unidad3, desc3, uso3, partida3';
                            $fields_values_insert .= ',"'.$_POST['cantidad3'].'","'.$_POST['unidad3'].'","'.$_POST['descripcion3'].'","'.$_POST['uso3'].'","'.$pt3.'"';
                        }
                        if(!empty($pt4))
                        {
                            $fields_insert .= ',cantidad4, unidad4, desc4, uso4, partida4';
                            $fields_values_insert .= ',"'.$_POST['cantidad4'].'","'.$_POST['unidad4'].'","'.$_POST['descripcion4'].'","'.$_POST['uso4'].'","'.$pt4.'"';
                        }
                        if(!empty($pt5))
                        {
                            $fields_insert .= ',cantidad5, unidad5, desc5, uso5, partida5';
                            $fields_values_insert .= ',"'.$_POST['cantidad5'].'","'.$_POST['unidad5'].'","'.$_POST['descripcion5'].'","'.$_POST['uso5'].'","'.$pt5.'"';
                        }
						if(!empty($pt6))
                        {
                            $fields_insert .= ',cantidad6, unidad6, desc6, uso6, partida6';
                            $fields_values_insert .= ',"'.$_POST['cantidad6'].'","'.$_POST['unidad6'].'","'.$_POST['descripcion6'].'","'.$_POST['uso6'].'","'.$pt6.'"';
                        }
						if(!empty($pt7))
                        {
                            $fields_insert .= ',cantidad7, unidad7, desc7, uso7, partida7';
                            $fields_values_insert .= ',"'.$_POST['cantidad7'].'","'.$_POST['unidad7'].'","'.$_POST['descripcion7'].'","'.$_POST['uso7'].'","'.$pt7.'"';
                        }
						if(!empty($pt8))
                        {
                            $fields_insert .= ',cantidad8, unidad8, desc8, uso8, partida8';
                            $fields_values_insert .= ',"'.$_POST['cantidad8'].'","'.$_POST['unidad8'].'","'.$_POST['descripcion8'].'","'.$_POST['uso8'].'","'.$pt8.'"';
                        }
						if(!empty($pt9))
                        {
                            $fields_insert .= ',cantidad9, unidad9, desc9, uso9, partida9';
                            $fields_values_insert .= ',"'.$_POST['cantidad9'].'","'.$_POST['unidad9'].'","'.$_POST['descripcion9'].'","'.$_POST['uso9'].'","'.$pt9.'"';
                        }
						if(!empty($pt10))
                        {
                            $fields_insert .= ',cantidad10, unidad10, desc10, uso10, partida10';
                            $fields_values_insert .= ',"'.$_POST['cantidad10'].'","'.$_POST['unidad10'].'","'.$_POST['descripcion10'].'","'.$_POST['uso10'].'","'.$pt10.'"';
                        }
						if(!empty($pt11))
                        {
                            $fields_insert .= ',cantidad11, unidad11, desc11, uso11, partida11';
                            $fields_values_insert .= ',"'.$_POST['cantidad11'].'","'.$_POST['unidad11'].'","'.$_POST['descripcion11'].'","'.$_POST['uso11'].'","'.$pt11.'"';
                        }
						if(!empty($pt12))
                        {
                            $fields_insert .= ',cantidad12, unidad12, desc12, uso12, partida12';
                            $fields_values_insert .= ',"'.$_POST['cantidad12'].'","'.$_POST['unidad12'].'","'.$_POST['descripcion12'].'","'.$_POST['uso12'].'","'.$pt12.'"';
                        }
						if(!empty($pt13))
                        {
                            $fields_insert .= ',cantidad13, unidad13, desc13, uso13, partida13';
                            $fields_values_insert .= ',"'.$_POST['cantidad13'].'","'.$_POST['unidad13'].'","'.$_POST['descripcion13'].'","'.$_POST['uso13'].'","'.$pt13.'"';
                        }
						if(!empty($pt14))
                        {
                            $fields_insert .= ',cantidad14, unidad14, desc14, uso14, partida14';
                            $fields_values_insert .= ',"'.$_POST['cantidad14'].'","'.$_POST['unidad14'].'","'.$_POST['descripcion14'].'","'.$_POST['uso14'].'","'.$pt14.'"';
                        }
						if(!empty($pt15))
                        {
                            $fields_insert .= ',cantidad15, unidad15, desc15, uso15, partida15';
                            $fields_values_insert .= ',"'.$_POST['cantidad15'].'","'.$_POST['unidad15'].'","'.$_POST['descripcion15'].'","'.$_POST['uso15'].'","'.$pt15.'"';
                        }
						if(!empty($pt16))
                        {
                            $fields_insert .= ',cantidad16, unidad16, desc16, uso16, partida16';
                            $fields_values_insert .= ',"'.$_POST['cantidad16'].'","'.$_POST['unidad16'].'","'.$_POST['descripcion16'].'","'.$_POST['uso16'].'","'.$pt16.'"';
                        }
						if(!empty($pt17))
                        {
                            $fields_insert .= ',cantidad17, unidad17, desc17, uso17, partida17';
                            $fields_values_insert .= ',"'.$_POST['cantidad17'].'","'.$_POST['unidad17'].'","'.$_POST['descripcion17'].'","'.$_POST['uso17'].'","'.$pt17.'"';
                        }
						if(!empty($pt18))
                        {
                            $fields_insert .= ',cantidad18, unidad18, desc18, uso18, partida18';
                            $fields_values_insert .= ',"'.$_POST['cantidad18'].'","'.$_POST['unidad18'].'","'.$_POST['descripcion18'].'","'.$_POST['uso18'].'","'.$pt18.'"';
                        }
						if(!empty($pt19))
                        {
                            $fields_insert .= ',cantidad19, unidad19, desc19, uso19, partida19';
                            $fields_values_insert .= ',"'.$_POST['cantidad19'].'","'.$_POST['unidad19'].'","'.$_POST['descripcion19'].'","'.$_POST['uso19'].'","'.$pt19.'"';
                        }
						if(!empty($pt20))
                        {
                            $fields_insert .= ',cantidad20, unidad20, desc20, uso20, partida20';
                            $fields_values_insert .= ',"'.$_POST['cantidad20'].'","'.$_POST['unidad20'].'","'.$_POST['descripcion20'].'","'.$_POST['uso20'].'","'.$pt20.'"';
                        }

						$sql ="INSERT INTO sol_cotizaciones($fields_insert) VALUES ($fields_values_insert)";
						$result = mysql_query($sql) or die(mysql_error());

						echo "<br>";
						echo "<br>";
						echo "<script languaje='javascript'>
								alert('SOLICITUD CREADA')
								location.href='sol_cotizaciones_historial';
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