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
      			<ul class="nav navbar-nav">
        			<li class="dropdown">
        				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Nuevo Pedido<b class="caret"></b>
          				</a>
          				<ul class="dropdown-menu">
            				<li><a href="nuevo">Compras</a></li>
                        	<li><a href="nuevo_int">Servicios Internos</a></li>
							<li><a href="nuevo_mtto">Mantenimientos</a></li>
          				</ul>
        			</li>
        			<li class="dropdown">
	                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
	          				</a>
	          				<ul class="dropdown-menu">
	            				<li><a href="historial_gen">Compras</a></li>
								<li><a href="historial_alm">Pedidos a Almacén</a></li>
	                        	<li><a href="historial_int">Servicios Internos</a></li>
								<li><a href="historial_mtto">Mantenimientos</a></li>
	          				</ul>
	              </li>
                	<li class="dropdown">
          				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"> </span> Reporte<b class="caret"></b>
	          				</a>
	          				<ul class="dropdown-menu">
	            				<li><a href="reporte_general">Compras</a></li>
	                        	<li><a href="reporte_general_int">Servicios Internos</a></li>
	          				</ul>
        			</li>
                    <li><a href="obras"><span class="glyphicon glyphicon-road"> </span> Obras</a></li>
      			</ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default " style="margin-top: 5px;">
            <div class="panel-body">
				<div class="element">
					<form action="insertar" method="post">
					<div class="row form-horizontal">
						<!--Campo Tipo de Compra-->
						<div class="col-xs-2">
							<label class="control-label">Tipo de Pedido</label>
							<select name="tipo_compra" class="form-control input-sm " id="tipos">
								<option value="" disabled selected class="form-control input-sm" >-- Selecciona --</option>
								<option value="Agencias" class="form-control input-sm" >Agencias</option>
								<option value="Almacén" class="form-control input-sm" >Almacén</option>
								<option value="General" class="form-control input-sm">General</option>
								<option value="Insumos" class="form-control input-sm">Insumos Médicos</option>
								<option value="Papelería" class="form-control input-sm" >Papelería</option>
								<option value="Productos" class="form-control input-sm" >Productos de Limpieza</option>
							</select>
						</div>
					</div>
					<div id="form_compras" style="display:none;">
             			<div class="row form-horizontal">
						<!--Campo Folio-->
  						<div class="col-xs-2">
                			<label class="control-label">Folio</label>
    						<input readonly align="right" name="folio" class="form-control input-sm" value="<?php 
								
								mysql_query("SET NAMES 'utf8'");
								$result = mysql_query("SELECT id FROM folios_myt ORDER BY id DESC LIMIT 1", $conexion); 								if ($row = mysql_fetch_array($result)){ 
   									do {  
										$folio = strtoupper( ("MyT ").str_pad($row["id"]+1,3,'0',STR_PAD_LEFT).date("/ y"));
										echo $folio;
   									} while ($row = mysql_fetch_array($result)); 
   					
								} else {
									$year = date("y");
									echo "MyT 01/ ".$year; 
								} 
							?> " >
  						</div>
						<div class="col-xs-3">
        				<label class="control-label">Supervisor</label>
						<input readonly name="supervisor" type="text" class="form-control input-sm" value="<?php echo $_SESSION["nombre"]; ?>">
						</div>
                	</div>
						<!--Div fecha, proyecto,supervisor, ubicacion-->
            <!--Campo Ubicacion-->
            <div class="row form-horizontal">
              <div class="col-xs-2">
                      <label class="control-label">Ubicación</label>
                <input name="ubicacion" value="SOMBRERETE" type="text" class="form-control input-sm" >
              </div>
              <!--Campo Proyecto-->
				<div class="col-xs-5">
				<label class="control-label">Proyecto</label>
					<?php
	 					mysql_query("SET NAMES 'UTF8'");
						$consulta_mysql='select * from obras ORDER BY nombre ASC';
						$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
							echo "<select name='proyecto' class='form-control input-sm'>";
						while($fila=mysql_fetch_array($resultado_consulta_mysql)){
							echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
						}
						echo "</select>";
					?>
				</div>
							<!--Campo Empresa-->
            		<div class="col-xs-5">
        				<label class="control-label">Empresa</label>
        					<select name="empresa" class="form-control input-sm">
                    <option class="form-control input-sm" name=uno value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
        					  <option class="form-control input-sm" name=dos value="CAVI DE SOMBRERETE">CAVI DE SOMBRERETE</option>
							  <option class="form-control input-sm" name=dos value="CONCRETOS CAVI S.A. de C.V.">CONCRETOS CAVI S.A. de C.V.</option>
							  <option class="form-control input-sm" name=tres value="RENTA DE MAQUINARIA Y TRANSPORTE GRUPO CAVI">RENTA DE MAQUINARIA Y TRANSPORTE GRUPO CAVI</option>
            			</select>
  							</div>
						</div>
						<!--divs cantidad unidad descripcion-->
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
                				<label class="control-label">Cantidad</label>
    							<input name="cantidad1" type="text" class="form-control input-sm" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
               	  				<label class="control-label">Unidad</label>
    							<input type="text" name="unidad1" class="form-control input-sm" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-4">
                				<label class="control-label">Descripcion</label>
    							<input type="text" class="form-control input-sm" name="descripcion1" >
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-4">
                        <label class="control-label">Uso</label>
                  <input type="text" class="form-control input-sm" name="uso1" >
                </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad2" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad2" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-4">
    						<input type="text" class="form-control input-sm" name="descripcion2" >
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-4">
                <input type="text" class="form-control input-sm" name="uso2" >
              </div>
					</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad3" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad3" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-4">
    							<input type="text" class="form-control input-sm" name="descripcion3" >
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-4">
                <input type="text" class="form-control input-sm" name="uso3" >
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad4" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad4" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-4">
    							<input type="text" class="form-control input-sm" name="descripcion4" >
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-4">
                <input type="text" class="form-control input-sm" name="uso4" >
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad5" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad5" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-4">
    							<input type="text" class="form-control input-sm" name="descripcion5" >
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-4">
                <input type="text" class="form-control input-sm" name="uso5" >
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad6" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad6" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-4">
    							<input type="text" class="form-control input-sm" name="descripcion6" >
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-4">
                <input type="text" class="form-control input-sm" name="uso6" >
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad7" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad7" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-4">
    							<input type="text" class="form-control input-sm" name="descripcion7" >
							</div>
              <!--Campo Uso-->
                <div class="col-xs-4">
                <input type="text" class="form-control input-sm" name="uso7" >
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
								<input type="text" class="form-control input-sm" name="cantidad8" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad8" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-4">
    							<input type="text" class="form-control input-sm" name="descripcion8" >
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-4">
                <input type="text" class="form-control input-sm" name="uso8" >
              </div>
						</div>
						<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad9" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad9" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-4">
    							<input type="text" class="form-control input-sm" name="descripcion9" >
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-4">
                <input type="text" class="form-control input-sm" name="uso9" >
              </div>	
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
								<input type="text" class="form-control input-sm" name="cantidad10" >
							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad10" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-4">
    							<input type="text" class="form-control input-sm" name="descripcion10" >
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-4">
                <input type="text" class="form-control input-sm" name="uso10" >
              </div>
						</div>
           		 		<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad11" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad11" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-4">
    							<input type="text" class="form-control input-sm" name="descripcion11" >
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-4">
                <input type="text" class="form-control input-sm" name="uso11" >
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad12" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad12" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-4">
    							<input type="text" class="form-control input-sm" name="descripcion12" >
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-4 col">
                <input type="text" class="form-control input-sm" name="uso12" >
              </div>
						</div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad13" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad13" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-4">
                  <input type="text" class="form-control input-sm" name="descripcion13" >
                </div>
                <!--Campo Uso-->
                <div class="col-xs-4 col">
                <input type="text" class="form-control input-sm" name="uso13" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad14" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad14" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-4">
                  <input type="text" class="form-control input-sm" name="descripcion14" >
                </div>
                <!--Campo Uso-->
                <div class="col-xs-4 col">
                <input type="text" class="form-control input-sm" name="uso14" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad15" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad15" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-4">
                  <input type="text" class="form-control input-sm" name="descripcion15" >
                </div>
                <!--Campo Uso-->
                <div class="col-xs-4 col">
                <input type="text" class="form-control input-sm" name="uso15" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad16" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad16" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-4">
                  <input type="text" class="form-control input-sm" name="descripcion16" >
                </div>
                <!--Campo Uso-->
                <div class="col-xs-4 col">
                <input type="text" class="form-control input-sm" name="uso16" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad17" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad17" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-4">
                  <input type="text" class="form-control input-sm" name="descripcion17" >
                </div>
                <!--Campo Uso-->
                <div class="col-xs-4 col">
                <input type="text" class="form-control input-sm" name="uso17" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad18" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad18" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-4">
                  <input type="text" class="form-control input-sm" name="descripcion18" >
                </div>
                <!--Campo Uso-->
                <div class="col-xs-4 col">
                <input type="text" class="form-control input-sm" name="uso18" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad19" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad19" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-4">
                  <input type="text" class="form-control input-sm" name="descripcion19" >
                </div>
                <!--Campo Uso-->
                <div class="col-xs-4 col">
                <input type="text" class="form-control input-sm" name="uso19" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad20" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad20" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-4">
                  <input type="text" class="form-control input-sm" name="descripcion20" >
                </div>
                <!--Campo Uso-->
                <div class="col-xs-4 col">
                <input type="text" class="form-control input-sm" name="uso20" >
              </div>
            </div>
            <div class="row form-horizontal">
            <!--Caja de notas-->
              <div class="col-xs-4">
                <label class="control-label">Notas</label>
                <textarea  name="notas_seguimiento" class="form-control "></textarea>
              </div>
			  <!--Boton crear-->
			  <div style="margin-top: 5px; margin-bottom:5px;">
            				<button class="btn btn-primary">Crear Pedido</button>
                      	</div>
            </div>
					</div>
					<div id="form_alm" style="display:none;">
					<div class="row form-horizontal">
						<!--Campo Folio-->
  						<div class="col-xs-2">
                			<label class="control-label">Folio</label>
    						<input readonly align="right" name="folio_a" class="form-control input-sm" value="<?php 
								
								mysql_query("SET NAMES 'utf8'");
								$result = mysql_query("SELECT id FROM folios_myt_alm ORDER BY id DESC LIMIT 1", $conexion); 								if ($row = mysql_fetch_array($result)){ 
   									do {  
										$folio = strtoupper( ("MyT-ALM ").str_pad($row["id"]+1,3,'0',STR_PAD_LEFT).date("/ y"));
										echo $folio;
   									} while ($row = mysql_fetch_array($result)); 
   					
								} else { 
									echo "MyT-ALM 001/ 23"; 
								} 
							?> " >
  						</div>
  						<!--Campo Supervisor-->
						<div class="col-xs-3">
        				<label class="control-label">Solicitante</label>
						<input readonly name="supervisor_a" type="text" class="form-control input-sm" value="<?php echo $_SESSION["nombre"]; ?>">
						</div>
              <!--Campo Proyecto-->
				<div class="col-xs-5">
				<label class="control-label">Proyecto</label>
					<?php
	 					mysql_query("SET NAMES 'UTF8'");
						$consulta_mysql='select * from obras ORDER BY nombre ASC';
						$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
							echo "<select name='proyecto_a' class='form-control input-sm'>";
						while($fila=mysql_fetch_array($resultado_consulta_mysql)){
							echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
						}
						echo "</select>";
					?>
				</div>
						</div>
						<!--divs cantidad unidad descripcion-->
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
                				<label class="control-label">Cantidad</label>
								<input name="cantidad1_a" type="text" class="form-control input-sm" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
               	  				<label class="control-label">Unidad</label>
    							<input type="text" name="unidad1_a" class="form-control input-sm" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
                				<label class="control-label">Descripcion</label>
    							<input type="text" class="form-control input-sm" name="descripcion1_a" >
  							</div>
                <!--Campo Código-->
                <div class="col-xs-3">
                        <label class="control-label">Código</label>
                  <input type="text" class="form-control input-sm" name="codigo1" >
                </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad2_a" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad2_a" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion2_a" >
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo2" >
              </div>
					</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad3_a" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad3_a" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion3_a" >
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo3" >
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad4_a" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad4_a" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion4_a" >
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo4" >
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad5_a" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad5_a" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion5_a" >
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo5" >
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad6_a" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad6_a" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion6_a" >
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo6" >
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad7_a" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad7_a" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion7_a" >
							</div>
              <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo7" >
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
								<input type="text" class="form-control input-sm" name="cantidad8_a" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad8_a" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion8_a" >
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo8" >
              </div>
						</div>
						<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad9_a" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad9_a" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion9_a" >
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo9" >
              </div>	
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
								<input type="text" class="form-control input-sm" name="cantidad10_a" >
							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad10_a" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion10_a" >
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo10" >
              </div>
						</div>
           		 		<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad11_a" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad11_a" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion11_a" >
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo11" >
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad12_a" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad12_a" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion12_a" >
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo12" >
              </div>
						</div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad13_a" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad13_a" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion13_a" >
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo13" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad14_a" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad14_a" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion14_a" >
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo14" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad15_a" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad15_a" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion15_a" >
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo15" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad16_a" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad16_a" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion16_a" >
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo16" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad17_a" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad17_a" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion17_a" >
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo17" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad18_a" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad18_a" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion18_a" >
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo18" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad19_a" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad19_a" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion19_a" >
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo19" >
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad20_a" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad20_a" >
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion20_a" >
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo20" >
              </div>
            </div>
			<!--Boton crear-->
			<div style="margin-top: 5px; margin-bottom:5px;">
            				<button class="btn btn-primary">Crear Pedido</button>
                      	</div>
					</div>
		</form>
				</div>
        	</div>
    	</div>
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>
	<script type="text/javascript">
  	document.getElementById('tipos').addEventListener('change', function (e)
  	{
	  if (e.target.value === "Almacén")
	  {
	  	$("#form_compras").hide();
	    $("#form_alm").show();
	  }
	  else
	  {
	  	$("#form_compras").show();
	    $("#form_alm").hide();
	  }
	});
  </script>
  </body>
</html>