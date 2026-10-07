<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']) && !isset($_SESSION['obra']))
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
    <title>Nuevo EPP</title>
    <!-- Bootstrap -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
		.rojo {background-color:#FF0000;}
		.azul {color:#0066FF;}
		.verde {color:#009900;}
		select{
			background-color:#FF66FF;
		}

        .blue-distinct {
            color: #104e9d;
        }
	</style>
<script type="text/javascript" src="../../../js/jquery.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation" style="background-color:#31456a;border-color:#31456a;">
 		<p align="center" style="color: white; margin-top: 12px; font-size: 18px;">PEDIDOS EPP</p>
  	</nav>
   	<div class="container" style="padding-top: 1px;">
       <nav class="navbar navbar-default nav" style="margin-top:5px;" role="navigation">
   			<div class="navbar-header">
      			<a class="navbar-brand" href="../inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
    		</div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Nuevo<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="nuevo_ni">Nuevo Ingreso</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
	                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="historial_ni">Nuevo Ingreso</a></li>
                        </ul>
                    </li>
                    <li class="">
	                    <a href="reportes" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
	                </li>
      			</ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
      			</ul>
    		</div>
        </nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default " style="margin-top: 5px;">
            <div class="panel-body">
				<div class="element">
					<form action="insertar_ni" method="post" enctype="multipart/form-data">
             			<div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php
                                    if($_SESSION['obra'] == "Administrativo"){
                                        $fol_ob = "ADM";
                                    }
                                    else if($_SESSION['obra'] == "Concretos Cavi"){
                                        $fol_ob = "CON";
                                    }
                                    else if($_SESSION['obra'] == "Sucursal MyT Control Vehicular"){
                                        $fol_ob = "CVE";
                                    }
                                    else if($_SESSION['obra'] == "Herradura"){
                                        $fol_ob = "HER";
                                    }
                                    else if($_SESSION['obra'] == "Sucursal MyT Maquinaria Pesada"){
                                        $fol_ob = "MPE";
                                    }
                                    else if($_SESSION['obra'] == "Mantenimiento Multifuncional"){
                                        $fol_ob = "MTO";
                                    }
                                    else if($_SESSION['obra'] == "Sucursal MyT Administración"){
                                        $fol_ob = "MYT";
                                    }
                                    else if($_SESSION['obra'] == "Sucursal MyT Mecánicos Zona Foránea"){
                                        $fol_ob = "MZF";
                                    }
                                    else if($_SESSION['obra'] == "Proyecto San Julián"){
                                        $fol_ob = "PSJ";
                                    }
                                    else if($_SESSION['obra'] == "Reclutamiento"){
                                        $fol_ob = "REC";
                                    }
                                    else if($_SESSION['obra'] == "Sabinas"){
                                        $fol_ob = "SAB";
                                    }
                                    else if($_SESSION['obra'] == "Saucito"){
                                        $fol_ob = "SAU";
                                    }
                                    else if($_SESSION['obra'] == "Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos"){
                                        $fol_ob = "SPP";
                                    }
                                    else if($_SESSION['obra'] == "Sucursal MyT Transporte Especial"){
                                        $fol_ob = "TES";
                                    }
                                    else if($_SESSION['obra'] == "Tocayos Agosto 2019"){
                                        $fol_ob = "TOC";
                                    }
                                    else if($_SESSION['obra'] == "Juanicipio"){
                                        $fol_ob = "JNC";
                                    }
                                    else{
                                        $fol_ob =$_GET['acronimo'];
                                    }
                                    mysql_query("SET NAMES 'utf8'");
                                    $result = mysql_query("SELECT id FROM epp_ni_folios ORDER BY id DESC LIMIT 1", $conexion); 								if ($row = mysql_fetch_array($result)){ 
                                        do {  
                                            $folio = strtoupper("SH-NI-".$fol_ob."-".str_pad($row["id"]+1,3,'0',STR_PAD_LEFT).date("/y"));
                                            echo $folio;
                                        } while ($row = mysql_fetch_array($result)); 
                        
                                    } else {
                                        $currY = date("y");
                                        echo "SH-NI-".$fol_ob."-001/".$currY; 
                                    } 
                                ?> " >
                            </div>
                            <div class="col-xs-5">
                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm" required value="<?php echo $_SESSION["nombre"]; ?>">
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Motivo</i></label>
                                <select name='motivo' class='form-control input-sm' required>
                                    <option selected disabled>-- Selecciona --</option>
                                    <option value="Reposición">Reposición</option>
                                    <option value="Cambio de Personal">Cambio de Personal</option>
                                    <option value="Nueva Creación">Nueva Creación</option>
                                    <option value="Cambio de Categoría">Cambio de Categoría</option>
                                    <option value="Cambio de Obra">Cambio de Obra</option>
                                </select>
                            </div>
                	    </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Nombre del Trabajador</i></label>
                                <input name="nombre" type="text" class="form-control input-sm" required>
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm' required>
                                    <option selected disabled>-- Selecciona --</option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
                                    <option value="Sucursal MyT Control Vehicular">Sucursal MyT Control Vehicular</option>
                                    <option value="Herradura">Herradura</option>
                                    <option value="Juanicipio">Juanicipio</option>
                                    <option value="Sucursal MyT Maquinaria Pesada">Sucursal MyT Maquinaria Pesada</option>
                                    <option value="Mantenimiento Multifuncional">Mantenimiento Multifuncional</option>
                                    <option value="Sucursal MyT Administración">Sucursal MyT Administración</option>
                                    <option value="Sucursal MyT Mecánicos Zona Foránea">Sucursal MyT Mecánicos Zona Foránea</option>
                                    <option value="Proyecto San Julián">Proyecto San Julián</option>
                                    <option value="Reclutamiento">Reclutamiento</option>
                                    <option value="Sabinas">Sabinas</option>
                                    <option value="Saucito">Saucito</option>
                                    <option value="Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos">Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos</option>
                                    <option value="Sucursal MyT Transporte Especial">Sucursal MyT Transporte Especial</option>
                                    <option value="Tocayos Agosto 2019">Tocayos Agosto 2019</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Categoría</i></label>
                                <input name="categoria" type="text" class="form-control input-sm" required>
                            </div>
						</div>
                        <div class="row form-horizontal">
  							<div class="col-xs-2">
                				<label class="control-label blue-distinct"><i>Talla Calzado</i></label>
    							<input class="form-control input-sm" type="text" name="talla_calzado" required>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label blue-distinct"><i>Talla Camisa</i></label>
    							<input class="form-control input-sm" type="text" name="talla_camisa" required>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label blue-distinct"><i>Talla Pantalón</i></label>
    							<input class="form-control input-sm" type="text" name="talla_pantalon" required>
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label blue-distinct"><i>Estatura</i></label>
    							<input class="form-control input-sm" type="text" name="estatura" required>
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label blue-distinct"><i>Peso</i></label>
    							<input class="form-control input-sm" type="text" name="peso" required>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label blue-distinct"><i>Superficie/Interior</i></label>
    							<select name='sup_int' class='form-control input-sm' required>
                                    <option selected disabled>-- Selecciona --</option>
                                    <option value="Superficie">Superficie</option>
                                    <option value="Interior Mina">Interior Mina</option>
                                    <option value="N/A">N/A</option>
                                </select>
  							</div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label blue-distinct"><i>Observaciones</i></label>
                                <textarea  name="observaciones_sup" class="form-control "></textarea>
                            </div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-5">
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-success">ENVIAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    	</div>
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../../js/bootstrap.min.js"></script>
  </body>
</html>