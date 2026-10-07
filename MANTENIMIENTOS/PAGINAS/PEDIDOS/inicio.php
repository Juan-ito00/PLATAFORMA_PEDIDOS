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

  use PHPMailer\PHPMailer\PHPMailer;
  require_once('../../autoload.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
 		<p align="center" style="color: white; margin-top: 12px; font-size: 18px;">SISTEMA DE PEDIDOS</p>
  	</nav>
   	<div class="container" style="padding-top: 1em;">
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div class="panel-body">
            	<div style="margin-top: 30px;text-align: center;">
              	<ol class="breadcrumb" >
        						<?php echo " ¡Bienvenido ".ucwords($_SESSION['usuario'])." ! ";?><a href="../../logout"></a>
      					</ol>
          		</div>
                <br>
                <!--Menu de la Pagina de Inicio-->
                <br>
            <div class="row">
              <?php if($_SESSION['usuario'] == 'SUPMTTO'){ ?>
              <div class="col-sm-4 col-md-4">
                <a href="historial_mtto_s" class="thumbnail">
                  <img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            <h6 align="center">Historial Mantenimientos</h6>
                </a>
              </div>
              <?php } else { ?>
                <div class="col-sm-4 col-md-4">
                <a href="historial_mtto_g" class="thumbnail">
                  <img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            <h6 align="center">Historial Mantenimientos</h6>
                </a>
              </div>
              <?php } ?>
              <div class="col-sm-4 col-md-4">
                <a href="reportes" class="thumbnail">
                    <img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                              <h6 align="center">Reportes</h6>
                </a>
              </div>
            </div>
  			</div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>
  </body>
</html>