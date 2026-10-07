<?php
    date_default_timezone_set("Mexico/General");
    session_start();
    if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']) && !isset($_SESSION['user_epp']))
    {
        header('Location: ../../../index');
        exit();
    }
  include("../../../conexion/conexion.php"); 
  $conexion=Conectarse();
  use PHPMailer\PHPMailer\PHPMailer;
  require_once('../../../autoload.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EPP</title>
    <link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation" style="background-color:#31456a;border-color:#31456a;">
 		<p align="center" style="color: white; margin-top: 12px; font-size: 18px;">PEDIDOS EPP</p>
  	</nav>
   	<div class="container" style="padding-top: 1em;">
       <nav class="navbar navbar-default nav" style="margin-top:5px;" role="navigation">
   			<div class="navbar-header">
      			<a class="navbar-brand" href="../inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
    		</div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
      			<ul class="nav navbar-nav">
        			<li class="dropdown">
	                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        <li><a href="historial_re">Reemplazo</a></li>
                        <li><a href="historial_ex">Extraordinario</a></li>
                        <li><a href="historial_tr">Trimestral</a></li>
                        <li><a href="historial_rc">Ropa y Calzado</a></li>
                        </ul>
                    </li>
      			</ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
      			</ul>
    		</div>
        </nav>
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div class="panel-body">
                <br>
                <br>
                <?php 
					if($_SESSION['user_epp']=='sup')
					{
				    ?>
                		<div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_re" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Reemplazo</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_ex" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Extraordinario</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_tr" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Trimestral</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_rc" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Ropa y Calzado</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_re" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Reemplazos</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_ex" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Extraordinarios</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_tr" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Trimestrales</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_rc" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Ropa y Calzado</h6>
                            </a>
                        </div>
                <?php 
					}
                    else
					{
				    ?>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_re" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Reemplazos</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_ex" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Extraordinarios</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_tr" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Trimestrales</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_rc" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Ropa y Calzado</h6>
                            </a>
                        </div>
                <?php 
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