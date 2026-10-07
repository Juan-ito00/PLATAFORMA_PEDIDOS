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
                <select name="tipo_cotizacion" class="form-control input-sm " id="" required>
                  <option value="Exámenes Médicos" class="form-control input-sm" id="" >Exámenes Médicos</option>
                  <option value="Materiales" class="form-control input-sm" >Materiales</option>
                  <option value="EPP" class="form-control input-sm" >EPP</option>
                  <option value="Herramientas" class="form-control input-sm" >Herramientas</option>
                  <option value="Alimentos" class="form-control input-sm" >Alimentos</option>
                  <option value="Hospedaje" class="form-control input-sm" >Hospedaje</option>
                  <option value="Equipos" class="form-control input-sm" >Equipos</option>
                </select>
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
								$result = mysql_query("SELECT id FROM folios_gsst_cot ORDER BY id DESC LIMIT 1", $conexion); 								if ($row = mysql_fetch_array($result)){ 
   									do {  
										$folio = strtoupper( ("GSST-COT ").str_pad($row["id"]+1,3,'0',STR_PAD_LEFT).date("/ y"));
										echo $folio;
   									} while ($row = mysql_fetch_array($result)); 
   					
								} else {
									$year = date("y");
									echo "GSST-COT 01/ ".$year; 
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
						<!--divs cantidad unidad descripcion-->
            			<div class="row form-horizontal">
            			<div class="col-xs-1"><br>
            				<label class="control-label">1.</label>
            			</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
                				<label class="control-label">Descripcion</label>
    							<input type="text" class="form-control input-sm" name="descripcion1" required >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
               	  				<label class="control-label">Unidad</label>
    							<input type="text" name="unidad1" required class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">2.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion2" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad2" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">3.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion3" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad3" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">4.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion4" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad4" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">5.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion5" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad5" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">6.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion6" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad6" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">7.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion7" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad7" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">8.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion8" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad8" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">9.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion9" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad9" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">10.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion10" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad10" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">11.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion11" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad11" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">12.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion12" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad12" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">13.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion13" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad13" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">14.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion14" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad14" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">15.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion15" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad15" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">16.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion16" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad16" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">17.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion17" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad17" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">18.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion18" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad18" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">19.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion19" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad19" class="form-control input-sm" >
  							</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
							<div class="col-xs-1">
            				<label class="control-label">20.</label>
            			</div>
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion20" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" name="unidad20" class="form-control input-sm" >
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
  </body>
</html>