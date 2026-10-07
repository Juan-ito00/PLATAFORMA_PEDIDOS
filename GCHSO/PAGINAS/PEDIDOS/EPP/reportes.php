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
    <title>Reporte EPP</title>
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
					<form action="../../../../GSST/PAGINAS/PEDIDOS/EPP/PDF/genrep_ni" method="post" enctype="multipart/form-data">
             			<div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label"><strong>EPP NUEVO INGRESO</strong></label><br>
                                <label class="control-label blue-distinct"><i>Elaboró</i></label>
                                <select name='obra' class='form-control input-sm'>
                                    <option selected disabled>-- Selecciona --</option>
                                    <option value="Reclutamiento">Reclutamiento</option>
                                </select>
                            </div>
						</div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Desde</i></label>
                                <input type="date" class="form-control" name="desde" >
                            </div>
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Hasta</i></label>
                                <input type="date" class="form-control" name="hasta" >
                            </div>
                        </div><br>
            			<input class="btn btn-success" TYPE="submit" NAME="accion" VALUE="Generar Reporte">
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