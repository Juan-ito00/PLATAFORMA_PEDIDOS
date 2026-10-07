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
    <title>Oficio Gral Registrar</title>
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
        	<div align="center" class="panel-heading"><?php echo "Registrar Oficio General";?></div>
            <div class="panel-body">
            	<?php
					if ($_POST) 
					{
						mysql_query("SET NAMES 'UTF8'");
						mysql_query("SET lc_time_names = 'es_MX'");
						
						$folio=$_POST['folio'];
						$fecha=$_POST['fecha'];
						$asunto=$_POST['asunto'];
						$cargos_grales=$_POST['cargos_grales'];
						$destinatario1=$_POST['destinatario1'];
						$firma1=$_POST['firma1'];
						$destinatario2=$_POST['destinatario2'];
						$firma2=$_POST['firma2'];
						$destinatario3=$_POST['destinatario3'];
						$firma3=$_POST['firma3'];
						$destinatario4=$_POST['destinatario4'];
						$firma4=$_POST['firma4'];
						$destinatario5=$_POST['destinatario5'];
						$firma5=$_POST['firma5'];
						$destinatario6=$_POST['destinatario6'];
						$firma6=$_POST['firma6'];
						$destinatario7=$_POST['destinatario7'];
						$firma7=$_POST['firma7'];
						$destinatario8=$_POST['destinatario8'];
						$firma8=$_POST['firma8'];
						$firma_gercomp=$_POST['firma_gercomp'];
						$cuerpo=$_POST['cuerpo'];
						$elaboro_nom=$_POST['elaboro_nom'];

			            $sql_id = "INSERT INTO folios_ofg SET idsdgg='0'";
			            $result_id = mysql_query($sql_id) or die(mysql_error());
			            $id_id = mysql_insert_id();
			            $folio_id =  strtoupper(("GCOMP ").str_pad($id_id,3,'0',STR_PAD_LEFT).date("/ y"));
			            $sql = "UPDATE folios_ofg SET folio='".$folio_id."' WHERE id='".$id_id."'";
			            $result = mysql_query($sql) or die(mysql_error());

						$sql ="INSERT INTO oficios_generales(folio,fecha,asunto,cargos_grales,dirigido1,dirigido2,dirigido3,dirigido4,dirigido5,dirigido6,dirigido7,dirigido8,firma1,firma2,firma3,firma4,firma5,firma6,firma7,firma8,firma_gercomp,cuerpo,elaboro) VALUES ('".$folio_id."','".$fecha."','".$asunto."','".$cargos_grales."','".$destinatario1."','".$destinatario2."','".$destinatario3."','".$destinatario4."','".$destinatario5."','".$destinatario6."','".$destinatario7."','".$destinatario8."','".$firma1."','".$firma2."','".$firma3."','".$firma4."','".$firma5."','".$firma6."','".$firma7."','".$firma8."','".$firma_gercomp."','".$cuerpo."','".$elaboro_nom."')";
						$result = mysql_query($sql) or die(mysql_error());
						echo "<br>";
						echo "<br>";
						echo "<script languaje='javascript'>
                    			alert('Creado')
        						location.href='historial_ofg';
        						window.open('pdf/ofg_pdf.php?id_f=".$id_id."', '_blank');
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