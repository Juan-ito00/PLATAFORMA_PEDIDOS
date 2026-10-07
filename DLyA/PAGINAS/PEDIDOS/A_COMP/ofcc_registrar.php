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
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar</title>
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
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
						$dirigido_a=$_POST['dirigido_a'];
						$comision=$_POST['comision'];
						$ciudad_destino=$_POST['ciudad_destino'];
						$oficio_solicitante=$_POST['oficio_solicitante'];
						$emite_oficio=$_POST['emite_oficio'];
						$fecha_oficio=$_POST['fecha_oficio'];
						$vehiculo_comision=$_POST['vehiculo_comision'];
						$fecha_inicio=$_POST['fecha_inicio'];
						$hora_inicio=$_POST['hora_inicio'];
                        $fecha_termino=$_POST['fecha_termino'];
						$hora_termino=$_POST['hora_termino'];
						$dias=$_POST['dias'];

			            $sql_id = "INSERT INTO folios_ofcc SET idsdgg='0'";
			            $result_id = mysql_query($sql_id) or die(mysql_error());
			            $id_id = mysql_insert_id();
			            $folio_id =  strtoupper(("GCOMP COM ").str_pad($id_id,3,'0',STR_PAD_LEFT).date("/ y"));
			            $sql = "UPDATE folios_ofcc SET folio='".$folio_id."' WHERE id='".$id_id."'";
			            $result = mysql_query($sql) or die(mysql_error());

						$sql ="INSERT INTO oficios_comisiones(folio,fecha,asunto,dirigido_a,comision,ciudad_destino,emite_oficio,vehiculo_comision,oficio_solicitante,
						fecha_oficio,fecha_inicio,hora_inicio,fecha_termino,hora_termino,dias) VALUES ('".$folio_id."','".$fecha."','".$asunto."','".$dirigido_a."',
						'".$comision."','".$ciudad_destino."','".$emite_oficio."','".$vehiculo_comision."','".$oficio_fecha_termino."','".$fecha_oficio."','".$fecha_inicio."','".$hora_inicio."',
						'".$_SESSION['nombre']."','".$hora_termino."','".$dias."')";
						$result = mysql_query($sql) or die(mysql_error());
						echo "<br>";
						echo "<br>";
						echo "<script languaje='javascript'>
                    			alert('Oficio de Comisión Choferes creado!')
        						location.href='historial_ofcc';
        						window.open('pdf/of_pdf.php?id_f=".$id_id."', '_blank');
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
    <script src="../../../js/bootstrap.min.js"></script>
  </body>
</html>