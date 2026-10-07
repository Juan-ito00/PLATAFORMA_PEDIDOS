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
    <title>Nuevo Pedido</title>
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
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default " style="margin-top: 5px;">
            <div class="panel-body">
				<div class="element">
					<form action="insertar_cot" method="post">
             			<div class="row form-horizontal">
						<!--Campo Tipo de Compra-->
						<div class="col-xs-4">
							<label class="control-label">Tipo de Cotización</label>
							<input name="tipo_cotizacion" type="text" class="form-control input-sm" readonly value="<?php echo $_GET['cat'];?>">
						</div>
  						<div class="col-xs-3">
  							<label class="control-label">Fecha Requerida</label>
  							<input name="fecha_requerido" type="date" class="form-control input-sm" required">
  						</div>
  						<!--Campo Supervisor-->
						<div class="col-xs-3">
        				<label class="control-label">Solicitante</label>
						<input readonly name="solicitante" type="text" class="form-control input-sm" required value="<?php echo $_SESSION["nombre"]; ?>">
						</div>
						<!--Campo Folio-->
  						<div class="col-xs-2">
                			<label class="control-label">Folio</label>
    						<input readonly align="right" name="folio" class="form-control input-sm" value="<?php 
								
								mysql_query("SET NAMES 'utf8'");
								$result = mysql_query("SELECT id FROM folios_glp_cot ORDER BY id DESC LIMIT 1", $conexion); 								if ($row = mysql_fetch_array($result)){ 
   									do {  
										$folio = strtoupper( ("GLP-COT ").str_pad($row["id"]+1,3,'0',STR_PAD_LEFT).date("/ y"));
										echo $folio;
   									} while ($row = mysql_fetch_array($result)); 
   					
								} else {
									$year = date("y");
									echo "GLP-COT 01/ ".$year; 
								} 
							?> " >
  						</div>
                	</div>
						<!--Div fecha, proyecto,supervisor, ubicacion-->
            <!--Campo Ubicacion-->
            <div class="row form-horizontal">
              <div class="col-xs-4">
                      <label class="control-label">Ubicación de Obra</label>
                <input name="ubicacion_obra" required type="text" class="form-control input-sm" >
              </div>
            <div class="col-xs-4">
							<label class="control-label">Lugar de Cotización</label>
		           <input name="lugar_cotizacion" required type="text" class="form-control input-sm" >
						</div>
				<div class="col-xs-4">
					<label class="control-label">Proyecto</label>
           <input name="proyecto" required type="text" class="form-control input-sm" >
				</div>
						</div>
            			<div class="row form-horizontal">
            			<div class="col-xs-1"><br>
            				<label class="control-label">1.</label>
            			</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-3">
								<label class="control-label">Código de Concepto</label>
									<?php
										mysql_query("SET NAMES 'UTF8'");
										
  										$catalogo=$_GET['cat'];
										$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
										$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
											echo "<select name='codigo1' id='cod1' class='form-control input-sm select-beast'>";
										echo "<option value='' selected disabled>Selecciona</option>";
											while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
										}
										echo "</select>";
									?>
  							</div>
							<div class="col-xs-5">
								<label class="control-label">Descripción</label>
								<input readonly type="text" class="form-control input-sm" id="descripcion1" value="">
							</div>
							<div class="col-xs-2">
								<label class="control-label">Unidad</label>
								<input readonly type="text" id="unidad1" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">
							<div class="col-xs-1">
            				<label class="control-label">2.</label>
            			</div>
  							<div class="col-xs-3">
							  	<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo2' id='cod2' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion2" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad2" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">3.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo3' id='cod3' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion3" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad3" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">4.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo4' id='cod4' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion4" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad4" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">5.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo5' id='cod5' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion5" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad5" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">6.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo6' id='cod6' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion6" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad6" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">7.</label>
            				</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo7' id='cod7' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion7" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad7" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">8.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo8' id='cod8' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion8" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad8" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">9.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo9' id='cod9' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion9" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad9" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">10.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo10' id='cod10' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion10" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad10" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">11.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo11' id='cod11' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion11" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad11" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">12.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo12' id='cod12' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion12" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad12" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">13.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo13' id='cod13' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion13" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad13" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">14.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo14' id='cod14' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion14" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad14" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">15.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo15' id='cod15' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion15" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad15" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">16.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo16' id='cod16' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion16" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad16" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">17.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo17' id='cod17' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion17" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad17" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">18.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo18' id='cod18' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion18" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad18" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">19.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo19' id='cod19' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion19" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad19" class="form-control input-sm" value="">
							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">20.</label>
            			</div>
  							<div class="col-xs-3">
							  								<?php
									mysql_query("SET NAMES 'UTF8'");
									$catalogo=$_GET['cat'];
									$consulta_mysql='select * from conceptos_gcp WHERE catalogo="'.$catalogo.'" ORDER BY codigo ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
										echo "<select name='codigo20' id='cod20' class='form-control input-sm select-beast'>";
									echo "<option value='' selected disabled>Selecciona</option>";
										while($fila=mysql_fetch_array($resultado_consulta_mysql)){
										echo "<option value='".$fila['codigo']."'>".$fila['codigo']."</option>";
									}
									echo "</select>";
								?>
  							</div>
							<div class="col-xs-5">
								<input readonly type="text" class="form-control input-sm" id="descripcion20" value="">
							</div>
							<div class="col-xs-2">
								<input readonly type="text" id="unidad20" class="form-control input-sm" value="">
							</div>
						</div>
            <div class="row form-horizontal">
            <!--Caja de notas-->
              <div class="col-xs-12">
                <label class="control-label">Notas</label>
                <textarea  name="notas" class="form-control "></textarea>
              </div>
            </div>
         				<!--Boton crear-->
            			<div style="margin-top: 5px; margin-bottom:5px;">
            				<button class="btn btn-primary">Crear</button>
                      	</div>
                	</form>
				</div>
        	</div>
    	</div>
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	$(document).ready(function() {
		$('.select-beast').select2();
		$('#cod1').on('change', GetDetail1);
		$('#cod2').on('change', GetDetail2);
		$('#cod3').on('change', GetDetail3);
		$('#cod4').on('change', GetDetail4);
		$('#cod5').on('change', GetDetail5);
		$('#cod6').on('change', GetDetail6);
		$('#cod7').on('change', GetDetail7);
		$('#cod8').on('change', GetDetail8);
		$('#cod9').on('change', GetDetail9);
		$('#cod10').on('change', GetDetail10);
		$('#cod11').on('change', GetDetail11);
		$('#cod12').on('change', GetDetail12);
		$('#cod13').on('change', GetDetail13);
		$('#cod14').on('change', GetDetail14);
		$('#cod15').on('change', GetDetail15);
		$('#cod16').on('change', GetDetail16);
		$('#cod17').on('change', GetDetail17);
		$('#cod18').on('change', GetDetail18);
		$('#cod19').on('change', GetDetail19);
		$('#cod20').on('change', GetDetail20);
	});

		function GetDetail1() {
          if (document.getElementById('cod1').value.length == 0) {
              document.getElementById("descripcion1").value = ""
              document.getElementById("unidad1").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion1").value = myObj[0];
                      document.getElementById(
                          "unidad1").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod1').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail2() {
          if (document.getElementById('cod2').value.length == 0) {
              document.getElementById("descripcion2").value = ""
              document.getElementById("unidad2").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion2").value = myObj[0];
                      document.getElementById(
                          "unidad2").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod2').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail3() {
          if (document.getElementById('cod3').value.length == 0) {
              document.getElementById("descripcion3").value = ""
              document.getElementById("unidad3").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion3").value = myObj[0];
                      document.getElementById(
                          "unidad3").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod3').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail4() {
          if (document.getElementById('cod4').value.length == 0) {
              document.getElementById("descripcion4").value = ""
              document.getElementById("unidad4").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion4").value = myObj[0];
                      document.getElementById(
                          "unidad4").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod4').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail5() {
          if (document.getElementById('cod5').value.length == 0) {
              document.getElementById("descripcion5").value = ""
              document.getElementById("unidad5").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion5").value = myObj[0];
                      document.getElementById(
                          "unidad5").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod5').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail6() {
          if (document.getElementById('cod6').value.length == 0) {
              document.getElementById("descripcion6").value = ""
              document.getElementById("unidad6").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion6").value = myObj[0];
                      document.getElementById(
                          "unidad6").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod6').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail7() {
          if (document.getElementById('cod7').value.length == 0) {
              document.getElementById("descripcion7").value = ""
              document.getElementById("unidad7").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion7").value = myObj[0];
                      document.getElementById(
                          "unidad7").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod7').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail8() {
          if (document.getElementById('cod8').value.length == 0) {
              document.getElementById("descripcion8").value = ""
              document.getElementById("unidad8").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion8").value = myObj[0];
                      document.getElementById(
                          "unidad8").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod8').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail9() {
          if (document.getElementById('cod9').value.length == 0) {
              document.getElementById("descripcion9").value = ""
              document.getElementById("unidad9").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion9").value = myObj[0];
                      document.getElementById(
                          "unidad9").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod9').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail10() {
          if (document.getElementById('cod10').value.length == 0) {
              document.getElementById("descripcion10").value = ""
              document.getElementById("unidad10").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion10").value = myObj[0];
                      document.getElementById(
                          "unidad10").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod10').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail11() {
          if (document.getElementById('cod11').value.length == 0) {
              document.getElementById("descripcion11").value = ""
              document.getElementById("unidad11").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion11").value = myObj[0];
                      document.getElementById(
                          "unidad11").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod11').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail12() {
          if (document.getElementById('cod12').value.length == 0) {
              document.getElementById("descripcion12").value = ""
              document.getElementById("unidad12").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion12").value = myObj[0];
                      document.getElementById(
                          "unidad12").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod12').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail13() {
          if (document.getElementById('cod13').value.length == 0) {
              document.getElementById("descripcion13").value = ""
              document.getElementById("unidad13").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion13").value = myObj[0];
                      document.getElementById(
                          "unidad13").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod13').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail14() {
          if (document.getElementById('cod14').value.length == 0) {
              document.getElementById("descripcion14").value = ""
              document.getElementById("unidad14").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion14").value = myObj[0];
                      document.getElementById(
                          "unidad14").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod14').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail15() {
          if (document.getElementById('cod15').value.length == 0) {
              document.getElementById("descripcion15").value = ""
              document.getElementById("unidad15").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion15").value = myObj[0];
                      document.getElementById(
                          "unidad15").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod15').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail16() {
          if (document.getElementById('cod16').value.length == 0) {
              document.getElementById("descripcion16").value = ""
              document.getElementById("unidad16").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion16").value = myObj[0];
                      document.getElementById(
                          "unidad16").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod16').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail17() {
          if (document.getElementById('cod17').value.length == 0) {
              document.getElementById("descripcion17").value = ""
              document.getElementById("unidad17").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion17").value = myObj[0];
                      document.getElementById(
                          "unidad17").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod17').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail18() {
          if (document.getElementById('cod18').value.length == 0) {
              document.getElementById("descripcion18").value = ""
              document.getElementById("unidad18").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion18").value = myObj[0];
                      document.getElementById(
                          "unidad18").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod18').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail19() {
          if (document.getElementById('cod19').value.length == 0) {
              document.getElementById("descripcion19").value = ""
              document.getElementById("unidad19").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion19").value = myObj[0];
                      document.getElementById(
                          "unidad19").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod19').value, true);
              xmlhttp.send();
          }
      }

	  function GetDetail20() {
          if (document.getElementById('cod20').value.length == 0) {
              document.getElementById("descripcion20").value = ""
              document.getElementById("unidad20").value = "";
              return;
          }
          else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (this.readyState == 4 && 
                          this.status == 200) {
                      var myObj = JSON.parse(this.responseText);
                      document.getElementById
                          ("descripcion20").value = myObj[0];
                      document.getElementById(
                          "unidad20").value = myObj[1];
                      
                  }
              };
              xmlhttp.open("GET", "conceptos_buscar.php?codigo=" + document.getElementById('cod20').value, true);
              xmlhttp.send();
          }
      }
	</script>
  </body>
</html>