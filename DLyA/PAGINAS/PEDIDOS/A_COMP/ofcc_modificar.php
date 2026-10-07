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
		<title>Modificar</title>
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
		              	$query = "UPDATE oficios_comisiones SET fecha='".$_POST["fecha"]."',asunto='".$_POST["asunto"]."',dirigido_a='".$_POST["dirigido_a"]."',
						comision='".$_POST["comision"]."',ciudad_destino='".$_POST["ciudad_destino"]."',emite_oficio='".$_POST["emite_oficio"]."',vehiculo_comision='".$_POST["vehiculo_comision"]."',oficio_solicitante='".$_POST["oficio_solicitante"]."',fecha_oficio='".$_POST["fecha_oficio"]."',
						fecha_inicio='".$_POST["fecha_inicio"]."',hora_inicio='".$_POST["hora_inicio"]."',fecha_termino='".$_POST["fecha_termino"]."',hora_termino='".$_POST["hora_termino"]."',dias='".$_POST["dias"]."' WHERE id='".$_POST["id"]."'";
            		$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
          
           			 echo "<script languaje='javascript'>
                    alert('Oficio de Comisión Chofer Modificado')
        			location.href='historial_ofcc';
                  </script>";		
				}
				else
				{
					$id_m=$_GET['id_m'];
					$sql_query="SELECT * FROM oficios_comisiones WHERE id='".$id_m."'";
					$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0)
						{
							while($Rs=mysql_fetch_array($resultado)) 
							{
				?>
				<div class="element">
					<form action="ofcc_modificar" method="post">
						<div class="row form-horizontal">
							<div class="col-xs-3">
								<label class="control-label">Folio</label>
								<input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?>">
							</div>
							<div class="col-xs-2">
								<label class="control-label">Fecha</label>
								<input name="fecha" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha']; ?>">
							</div>
						    <div class="col-xs-6">
									<label class="control-label">Asunto</label>
									<input name="asunto" type="text" class="form-control input-sm" style="resize: none;" value="<?php echo $Rs['asunto']; ?>">
								</div>
							</div>
                            <div class="row form-horizontal">
								<div class="col-xs-4">
                                    <label class="control-label">Dirigido a:</label>
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from destinatarios ORDER BY nombre ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='dirigido_a' class='form-control input-sm'>";
											echo "<option disabled selected class='form-control input-sm' value='".$Rs['dirigido_a']."'>".$Rs['dirigido_a']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
										}
										echo "</select>";
									?>
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-10">
									<label class="control-label">Comisión</label>
									<textarea name="comision" class="form-control input-sm" rows="4" style="resize: none;"><?php echo $Rs['comision']; ?></textarea>
								</div>
							</div>
							<div class="row form-horizontal">
								<div class="col-xs-4">
									<label class="control-label">Ciudad Destino</label>
									<input name="ciudad_destino" type="text" class="form-control input-sm" style="resize: none;" value="<?php echo $Rs['ciudad_destino']; ?>">
								</div>
							</div>
							<div class="row form-horizontal">
                                <div class="col-xs-2">
									<label class="control-label">Oficio Solicitante</label>
									<input name="oficio_solicitante" type="text" class="form-control input-sm" value="<?php echo $Rs['oficio_solicitante']; ?>">
								</div>
								<div class="col-xs-4">
                                    <label class="control-label">Emitió</label>
									<?php
					 					mysql_query("SET NAMES 'UTF8'");
										$consulta_mysql='select * from destinatarios ORDER BY nombre ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='emite_oficio' class='form-control input-sm'>";
											echo "<option disabled selected class='form-control input-sm' value='".$Rs['emite_oficio']."'>".$Rs['dirigido_a']."</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
										}
										echo "</select>";
									?>
								</div>
								<div class="col-xs-2">
									<label class="control-label">Fecha de Oficio</label>
									<input name="fecha_oficio" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_oficio']; ?>">
								</div>
								<div class="col-xs-2">
									<label class="control-label">Vehículo</label>
									<input name="vehiculo_comision" type="text" class="form-control input-sm" value="<?php echo $Rs['vehiculo_comision']; ?>">
								</div>
                            </div><br>
							<div class="row form-horizontal">
								<div class="col-xs-2">
									<label class="control-label">Inicio de Comisión</label>
									<input name="fecha_inicio" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_inicio']; ?>">
                                    <input name="hora_inicio" type="time" class="form-control input-sm" value="<?php echo $Rs['hora_inicio']; ?>">
								</div>
								<div class="col-xs-2">
									<label class="control-label">Fin de Comisión</label>
									<input name="fecha_termino" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_termino']; ?>">
                                    <input name="hora_termino" type="time" class="form-control input-sm" value="<?php echo $Rs['hora_termino']; ?>">
								</div>
                            </div>
							<div class="row form-horizontal">
                                <div class="col-xs-1"></div>
								<div class="col-xs-2">
									<label class="control-label">Días de Comisión</label>
									<input name="dias" type="number" class="form-control input-sm" value="<?php echo $Rs['dias']; ?>">
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
	</body>
</html>