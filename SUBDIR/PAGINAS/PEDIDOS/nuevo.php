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
          				</ul>
        			</li>
        			<li class="dropdown">
	                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
	          				</a>
	          				<ul class="dropdown-menu">
	            				<li><a href="historial_gen">Compras</a></li>
	                        	<li><a href="historial_int">Servicios Internos</a></li>
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
                <label class="control-label">Tipo de Compra</label>
                <select name="tipo_compra" class="form-control input-sm " id="">
                  <option value="General" class="form-control input-sm" id="" >General</option>
                  <option value="Papelería" class="form-control input-sm" >Papelería</option>
                </select>
              </div>
  						<div class="col-xs-5"></div>
  						<!--Campo Supervisor-->
						<div class="col-xs-3">
        				<label class="control-label">Supervisor</label>
						<input readonly name="supervisor" type="text" class="form-control input-sm" required value="<?php echo $_SESSION["nombre"]; ?>">
						</div>
						<!--Campo Folio-->
  						<div class="col-xs-2">
                			<label class="control-label">Folio</label>
    						<input readonly align="right" name="folio" class="form-control input-sm" value="<?php 
								
								mysql_query("SET NAMES 'utf8'");
								$result = mysql_query("SELECT id FROM folios_subdir ORDER BY id DESC LIMIT 1", $conexion); 								if ($row = mysql_fetch_array($result)){ 
   									do {  
										$folio = strtoupper( ("SUBDIR ").str_pad($row["id"]+1,3,'0',STR_PAD_LEFT).date("/ y"));
										echo $folio;
   									} while ($row = mysql_fetch_array($result)); 
   					
								} else { 
									echo "SUBDIR 01/ 23"; 
								} 
							?> " >
  						</div>
                	</div>
						<!--Div fecha, proyecto,supervisor, ubicacion-->
            <!--Campo Ubicacion-->
            <div class="row form-horizontal">
              <div class="col-xs-2">
                      <label class="control-label">Ubicación</label>
                <input name="ubicacion" required value="SOMBRERETE" type="text" class="form-control input-sm" >
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
							  <option class="form-control input-sm" name=tres value="RENTA DE MAQUINARIA Y TRANSPORTE GRUPO CAVI">RENTA DE MAQUINARIA Y TRANSPORTE GRUPO CAVI</option>
            			</select>
  							</div>
						</div>
						<!--divs cantidad unidad descripcion-->
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
                				<label class="control-label">Cantidad</label>
    							<input required name="cantidad1" type="text" class="form-control input-sm" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
               	  				<label class="control-label">Unidad</label>
    							<input type="text" name="unidad1" required class="form-control input-sm" >
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-4">
                				<label class="control-label">Descripcion</label>
    							<input type="text" class="form-control input-sm" name="descripcion1" required >
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-4">
                        <label class="control-label">Uso</label>
                  <input type="text" class="form-control input-sm" name="uso1" required >
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
              <div class="col-xs-2">
                <label class="control-label">Notas</label>
                <textarea  name="notas_seguimiento" class="form-control "></textarea>
              </div>
            </div>
         				<!--Boton crear-->
            			<div style="margin-top: 5px; margin-bottom:5px;">
            				<button class="btn btn-primary">Crear Pedido</button>
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