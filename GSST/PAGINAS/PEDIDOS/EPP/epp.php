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
                  <?php if($_SESSION['user_epp'] == 'sup'){ 
                    if($_SESSION['usuario'] == "AYLIN"){?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> PCC<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="nuevo_re?acronimo=PCC">Nuevo Reemplazo</a></li>
                                <li><a href="nuevo_ex?acronimo=PCC">Nuevo Extraordinario</a></li>
                                <li><a href="nuevo_tr?acronimo=PCC">Nuevo Trimestral</a></li>
                                <li><a href="nuevo_rc?acronimo=PCC">Nuevo Ropa y Calzado</a></li>
                            </ul>
        			    </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> ADM<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="nuevo_re?acronimo=ADM">Nuevo Reemplazo</a></li>
                                <li><a href="nuevo_ex?acronimo=ADM">Nuevo Extraordinario</a></li>
                                <li><a href="nuevo_tr?acronimo=ADM">Nuevo Trimestral</a></li>
                                <li><a href="nuevo_rc?acronimo=ADM">Nuevo Ropa y Calzado</a></li>
                            </ul>
        			    </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> CON<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="nuevo_re?acronimo=CON">Nuevo Reemplazo</a></li>
                                <li><a href="nuevo_ex?acronimo=CON">Nuevo Extraordinario</a></li>
                                <li><a href="nuevo_tr?acronimo=CON">Nuevo Trimestral</a></li>
                                <li><a href="nuevo_rc?acronimo=CON">Nuevo Ropa y Calzado</a></li>
                            </ul>
        			    </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> MTO<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="nuevo_re?acronimo=MTO">Nuevo Reemplazo</a></li>
                                <li><a href="nuevo_ex?acronimo=MTO">Nuevo Extraordinario</a></li>
                                <li><a href="nuevo_tr?acronimo=MTO">Nuevo Trimestral</a></li>
                                <li><a href="nuevo_rc?acronimo=MTO">Nuevo Ropa y Calzado</a></li>
                            </ul>
        			    </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> CVE<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="nuevo_re?acronimo=CVE">Nuevo Reemplazo</a></li>
                                <li><a href="nuevo_ex?acronimo=CVE">Nuevo Extraordinario</a></li>
                                <li><a href="nuevo_tr?acronimo=CVE">Nuevo Trimestral</a></li>
                                <li><a href="nuevo_rc?acronimo=CVE">Nuevo Ropa y Calzado</a></li>
                            </ul>
        			    </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> MYT<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="nuevo_re?acronimo=MYT">Nuevo Reemplazo</a></li>
                                <li><a href="nuevo_ex?acronimo=MYT">Nuevo Extraordinario</a></li>
                                <li><a href="nuevo_tr?acronimo=MYT">Nuevo Trimestral</a></li>
                                <li><a href="nuevo_rc?acronimo=MYT">Nuevo Ropa y Calzado</a></li>
                            </ul>
        			    </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> TES<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="nuevo_re?acronimo=TES">Nuevo Reemplazo</a></li>
                                <li><a href="nuevo_ex?acronimo=TES">Nuevo Extraordinario</a></li>
                                <li><a href="nuevo_tr?acronimo=TES">Nuevo Trimestral</a></li>
                                <li><a href="nuevo_rc?acronimo=TES">Nuevo Ropa y Calzado</a></li>
                            </ul>
        			    </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> MZF<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="nuevo_re?acronimo=MZF">Nuevo Reemplazo</a></li>
                                <li><a href="nuevo_ex?acronimo=MZF">Nuevo Extraordinario</a></li>
                                <li><a href="nuevo_tr?acronimo=MZF">Nuevo Trimestral</a></li>
                                <li><a href="nuevo_rc?acronimo=MZF">Nuevo Ropa y Calzado</a></li>
                            </ul>
        			    </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> MPE<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="nuevo_re?acronimo=MPE">Nuevo Reemplazo</a></li>
                                <li><a href="nuevo_ex?acronimo=MPE">Nuevo Extraordinario</a></li>
                                <li><a href="nuevo_tr?acronimo=MPE">Nuevo Trimestral</a></li>
                                <li><a href="nuevo_rc?acronimo=MPE">Nuevo Ropa y Calzado</a></li>
                            </ul>
        			    </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> TOC<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="nuevo_re?acronimo=TOC">Nuevo Reemplazo</a></li>
                                <li><a href="nuevo_ex?acronimo=TOC">Nuevo Extraordinario</a></li>
                                <li><a href="nuevo_tr?acronimo=TOC">Nuevo Trimestral</a></li>
                                <li><a href="nuevo_rc?acronimo=TOC">Nuevo Ropa y Calzado</a></li>
                            </ul>
        			    </li>
                        <?php }
                        else {?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Nuevo<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="nuevo_re">Reemplazo</a></li>
                                    <li><a href="nuevo_ex">Extraordinario</a></li>
                                    <li><a href="nuevo_tr">Trimestral</a></li>
                                    <li><a href="nuevo_rc">Ropa y Calzado</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
	          			</a>
	          			<ul class="dropdown-menu">
                            <li><a href="historial_re">Reemplazo</a></li>
                            <li><a href="historial_ex">Extraordinario</a></li>
                            <li><a href="historial_tr">Trimestral</a></li>
                            <li><a href="historial_rc">Ropa y Calzado</a></li>
	          			</ul>
	                </li>
                            <?php
                        }
                    } ?>
                    <?php if($_SESSION['user_epp'] == 'sasst'){ ?>
        			<li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial SASST<b class="caret"></b>
	          			</a>
                        <ul class="dropdown-menu">
                            <li><a href="historial_re">Reemplazo</a></li>
                            <li><a href="historial_ex">Extraordinario</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial ADM<b class="caret"></b>
	          			</a>
                        <ul class="dropdown-menu">
                            <li><a href="historial_re_obras">Reemplazo</a></li>
                            <li><a href="historial_ex_obras">Extraordinario</a></li>
                            <li><a href="historial_tr_obras">Trimestral</a></li>
                            <li><a href="historial_rc_obras">Ropa y Calzado</a></li>
                        </ul>
                    </li>
                    <?php }
                    else if($_SESSION['user_epp'] == 'alm'){ ?>
                    <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
	          			</a>
                      <ul class="dropdown-menu">
                            <li><a href="historial_tr">Trimestral</a></li>
                            <li><a href="historial_rc">Ropa y Calzado</a></li>
                            <li><a href="historial_ni">Nuevo Ingreso</a></li>
                      </ul>
                    </li><?php }
                    else if($_SESSION['user_epp'] == 'gerseg'){ ?>
                    <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
	          			</a>
	          			<ul class="dropdown-menu">
                            <li><a href="historial_re">Reemplazo</a></li>
                            <li><a href="historial_ex">Extraordinario</a></li>
                            <li><a href="historial_tr">Trimestral</a></li>
                            <li><a href="historial_rc">Ropa y Calzado</a></li>
                            <li><a href="historial_ni">Nuevo Ingreso</a></li>
	          			</ul>
	                </li>
                    <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial ADM<b class="caret"></b>
	          			</a>
                        <ul class="dropdown-menu">
                            <li><a href="historial_re_obras">Reemplazo</a></li>
                            <li><a href="historial_ex_obras">Extraordinario</a></li>
                            <li><a href="historial_tr_obras">Trimestral</a></li>
                            <li><a href="historial_rc_obras">Ropa y Calzado</a></li>
                        </ul>
                    </li>
                    <?php } ?>
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
                    if($_SESSION['user_epp']=='sup' && $_SESSION['usuario']=='AYLIN')
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
                        <h4 style="text-align:center;">ADMINISTRATIVO</h4>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_re?acronimo=ADM" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Reemplazo</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_ex?acronimo=ADM" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Extraordinario</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_tr?acronimo=ADM" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Trimestral</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_rc?acronimo=ADM" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Ropa y Calzado</h6>
                            </a>
                        </div>
                        <h4 style="text-align:center;">CONCRETOS</h4>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_re?acronimo=CON" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Reemplazo</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_ex?acronimo=CON" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Extraordinario</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_tr?acronimo=CON" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Trimestral</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_rc?acronimo=CON" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Ropa y Calzado</h6>
                            </a>
                        </div>
                        
                        <h4 style="text-align:center;">PROYECTOS DE CONSTRUCCIÓN CONCRETOS</h4>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_re?acronimo=PCC" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Reemplazo</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_ex?acronimo=PCC" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Extraordinario</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_tr?acronimo=PCC" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Trimestral</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_rc?acronimo=PCC" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Ropa y Calzado</h6>
                            </a>
                        </div>
                        <h4 style="text-align:center;">MANTENIMIENTO MULTIFUNCIONAL</h4>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_re?acronimo=MTO" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Reemplazo</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_ex?acronimo=MTO" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Extraordinario</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_tr?acronimo=MTO" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Trimestral</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_rc?acronimo=MTO" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Ropa y Calzado</h6>
                            </a>
                        </div>
                        <h4 style="text-align:center;">SUCURSAL MYT CONTROL VEHICULAR</h4>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_re?acronimo=CVE" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Reemplazo</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_ex?acronimo=CVE" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Extraordinario</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_tr?acronimo=CVE" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Trimestral</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_rc?acronimo=CVE" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Ropa y Calzado</h6>
                            </a>
                        </div>
                        <h4 style="text-align:center;">SUCURSAL MYT ADMINISTRACIÓN</h4>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_re?acronimo=MYT" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Reemplazo</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_ex?acronimo=MYT" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Extraordinario</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_tr?acronimo=MYT" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Trimestral</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_rc?acronimo=MYT" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Ropa y Calzado</h6>
                            </a>
                        </div>
                        <h4 style="text-align:center;">SUCURSAL MYT TRANSPORTE ESPECIAL</h4>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_re?acronimo=TES" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Reemplazo</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_ex?acronimo=TES" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Extraordinario</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_tr?acronimo=TES" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Trimestral</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_rc?acronimo=TES" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Ropa y Calzado</h6>
                            </a>
                        </div>
                        <h4 style="text-align:center;">SUCURSAL MYT MECÁNICOS ZONA FORÁNEA</h4>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_re?acronimo=MZF" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Reemplazo</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_ex?acronimo=MZF" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Extraordinario</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_tr?acronimo=MZF" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Trimestral</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_rc?acronimo=MZF" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Ropa y Calzado</h6>
                            </a>
                        </div><h4 style="text-align:center;">SUCURSAL MYT MAQUINARIA PESADA</h4>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_re?acronimo=MPE" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Reemplazo</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_ex?acronimo=MPE" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Extraordinario</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_tr?acronimo=MPE" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Trimestral</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_rc?acronimo=MPE" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Ropa y Calzado</h6>
                            </a>
                        </div>
                        <h4 style="text-align:center;">TOCAYOS AGOSTO 2019</h4>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_re?acronimo=TOC" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Reemplazo</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_ex?acronimo=TOC" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Extraordinario</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_tr?acronimo=TOC" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Trimestral</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="nuevo_rc?acronimo=TOC" class="thumbnail">
                                <img src="../../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Nuevo Ropa y Calzado</h6>
                            </a>
                        </div>
                <?php 
                    }
					else if($_SESSION['user_epp']=='sup')
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
                    else if($_SESSION['user_epp']=='sasst')
					{
				    ?>
                        <h4 style="text-align:center;">PEDIDOS RESIDENTE OBRA ADMINISTRATIVO</h4>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_re_obras" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Reemplazos</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_ex_obras" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Extraordinarios</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_tr_obras" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Trimestrales</h6>
                            </a>
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_rc_obras" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Ropa y Calzado</h6>
                            </a>
                        </div>
                        <h4 style="text-align:center;">SASST</h4>
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
                        </div>
                        <div class="col-sm-4 col col-md-3" align="justify">
                        </div>
                <?php 
					}
                    else if($_SESSION['user_epp']=='alm')
					{
				    ?>
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
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_ni" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Nuevo Ingreso</h6>
                            </a>
                        </div>
                <?php 
					}
                    else
					{
				    ?>
                    <h4 style="text-align:center;">PEDIDOS GERENTE DE OBRA ADMINISTRATIVO</h4>
                    <div class="col-sm-4 col col-md-3" align="justify">
                        <a href="historial_re_obras" class="thumbnail">
                            <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            <h6 align="center">Historial Reemplazos</h6>
                        </a>
                    </div>
                    <div class="col-sm-4 col col-md-3" align="justify">
                        <a href="historial_ex_obras" class="thumbnail">
                            <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            <h6 align="center">Historial Extraordinarios</h6>
                        </a>
                    </div>
                    <div class="col-sm-4 col col-md-3" align="justify">
                        <a href="historial_tr_obras" class="thumbnail">
                            <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            <h6 align="center">Historial Trimestrales</h6>
                        </a>
                    </div>
                    <div class="col-sm-4 col col-md-3" align="justify">
                        <a href="historial_rc_obras" class="thumbnail">
                            <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                            <h6 align="center">Historial Ropa y Calzado</h6>
                        </a>
                    </div>
                        <h4 style="text-align:center;">PEDIDOS QUE APRUEBA GERENCIA DE SEGURIDAD</h4>
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
                        <div class="col-sm-4 col col-md-3" align="justify">
                            <a href="historial_ni" class="thumbnail">
                                <img src="../../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                                <h6 align="center">Historial Nuevo Ingreso</h6>
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