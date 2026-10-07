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
                    <li class="">
	                    <a href="reportes" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
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
                    <li class="">
	                    <a href="reportes" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
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
                    <li class="">
	                    <a href="reportes" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
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
                    </li>
                    <li class="">
	                    <a href="reportes" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
	                </li>
                    <?php }
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
                    <li class="">
	                    <a href="reportes" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
	                </li>
                    <?php } ?>
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
					<form action="PDF/genrep_re" method="post" enctype="multipart/form-data">
             			<div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label"><strong>EPP REEMPLAZO</strong></label><br>
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm'>
                                    <option selected disabled>-- Selecciona --</option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
                                    <option value="Proyectos de Construcción Concretos">Proyectos de Construcción Concretos</option>
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
                    <hr>
                    <form action="PDF/genrep_ex" method="post" enctype="multipart/form-data">
             			<div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label"><strong>EPP EXTRAORDINARIO</strong></label><br>
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm'>
                                    <option selected disabled>-- Selecciona --</option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
                                    <option value="Proyectos de Construcción Concretos">Proyectos de Construcción Concretos</option>
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
                    <hr>
                    <form action="PDF/genrep_tr" method="post" enctype="multipart/form-data">
             			<div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label"><strong>EPP TRIMESTRAL</strong></label><br>
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm'>
                                    <option selected disabled>-- Selecciona --</option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
                                    <option value="Proyectos de Construcción Concretos">Proyectos de Construcción Concretos</option>
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
                    <hr>
                    <form action="PDF/genrep_rc" method="post" enctype="multipart/form-data">
             			<div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label"><strong>EPP ROPA Y CALZADO</strong></label><br>
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm'>
                                    <option selected disabled>-- Selecciona --</option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
                                    <option value="Proyectos de Construcción Concretos">Proyectos de Construcción Concretos</option>
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
                    <hr>
                    <form action="PDF/genrep_ni" method="post" enctype="multipart/form-data">
             			<div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label"><strong>EPP NUEVO INGRESO</strong></label><br>
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm'>
                                    <option selected disabled>-- Selecciona --</option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
                                    <option value="Proyectos de Construcción Concretos">Proyectos de Construcción Concretos</option>
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