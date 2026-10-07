<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']) && !isset($_SESSION['user_epp']) && !isset($_SESSION['obra']))
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
    <title>Modificar EPP</title>
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
                      </ul>
                    </li>
                    <li class="">
	                    <a href="reportes" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
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
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Modificar Pedido Extraordinario de EPP</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");

 					if(isset($_POST["aut1su"])) {
                        $query = "UPDATE epp_ex SET estatus_entrega1='".$_POST["e_entrega1"]."',fecha_entrega1='".$_POST["f_entrega1"]."',
                        estatus_entrega2='".$_POST["e_entrega2"]."',fecha_entrega2='".$_POST["f_entrega2"]."',
                        estatus_entrega3='".$_POST["e_entrega3"]."',fecha_entrega3='".$_POST["f_entrega3"]."',
                        estatus_entrega4='".$_POST["e_entrega4"]."',fecha_entrega4='".$_POST["f_entrega4"]."',
                        estatus_entrega5='".$_POST["e_entrega5"]."',fecha_entrega5='".$_POST["f_entrega5"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_ex?id=tw_redireccion';
                            </script>";
				    }
                    else {
						$id_pedido=$_GET['id_pedido'];
						$sql_query="SELECT * FROM epp_ex WHERE id='".$id_pedido."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
                    if($_SESSION['user_epp'] == "sasst") { ?>
                    <form action="ver_ex_surtido" method="post">
             			<div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?> " >
                            </div>
                            <div class="col-xs-5">
                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol']; ?>">
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Motivo</i></label>
                                <select name='motivo' class='form-control input-sm' disabled>
                                    <option selected ><?php echo $Rs['motivo'];?></option>
                                    <option value="EPP Alto Costo">EPP Alto Costo</option>
                                    <option value="Necesidad de Obra">Necesidad de Obra</option>
                                    <option value="Solicitud del Cliente">Solicitud del Cliente</option>
                                    <option value="Termino EPP Trimestral">Termino EPP Trimestral</option>
                                </select>
                            </div>
                	    </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm' disabled>
                                    <option selected ><?php echo $Rs['obra'];?></option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
                                    <option value="Proyectos de Construcción Concretos">Proyectos de Construcción Concretos</option>
                                    <option value="Sucursal MyT Control Vehicular">Sucursal MyT Control Vehicular</option>
                                    <option value="Herradura">Herradura</option>
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
                            <div class="col-xs-5">
                                <label class="control-label blue-distinct"><i>Justificación</i></label>
                                <input name="justificacion" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['justificacion'];?>">
                            </div>
						</div>
                        <br><br><br>
            			<div class="row form-horizontal">
                        <div class="col-xs-2">
                                <label class="control-label">Cantidad (pzas/par)</label>
    							<input class="form-control input-sm" type="text" name="cant1" disabled value="<?php echo $Rs['cant1'];?>">
                            </div>
  							<div class="col-xs-3">
                                <label class="control-label">Equipo</label>
                                <input class="form-control input-sm" type="text" name="equipo1" disabled value="<?php echo $Rs['equipo1'];?>"/>
  							</div>
                            <div class="col-xs-2">
                                <label class="control-label">Código</label>
                                <input class="form-control input-sm" type="text" name="codigo1" disabled value="<?php echo $Rs['codigo1'];?>">
                            </div>
  							<div class="col-xs-2">
                				<label class="control-label">Marca</label>
    							<input class="form-control input-sm" type="text" name="marca1" disabled value="<?php echo $Rs['marca1'];?>">
  							</div>
                            <div class="col-xs-3">
                				<label class="control-label">Nombre a quien se le asigna</label>
    							<input class="form-control input-sm" type="text" name="nombre1" disabled value="<?php echo $Rs['nombre1'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                <select name='contrato1' class='form-control input-sm resaltado' disabled id="contrato1">
                                    <option selected ><?php echo $Rs['contrato1'];?></option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">Precio</label>
    							<input class="form-control input-sm resaltado" type="text" name="precio1" id="precio1" readonly value="<?php echo $Rs['precio1'];?>">
  							</div>
                              <div class="col-xs-8">
                				<label class="control-label green-distinct">Observaciones</label>
    							<input class="form-control input-sm resaltado" type="text" name="observaciones1" id="observaciones1" readonly value="<?php echo $Rs['observaciones1'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega1' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega1'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega1" type="date" class="form-control input-sm"  readonlyvalue=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega1"]));?> >
  							</div>
                        </div><br><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            <label class="control-label">Cantidad (pzas/par)</label>
    							<input class="form-control input-sm" type="text" name="cant2" disabled value="<?php echo $Rs['cant2'];?>">
                            </div>
  							<div class="col-xs-3">
                              <label class="control-label">Equipo</label>
                                <input class="form-control input-sm" type="text" name="equipo2" disabled value="<?php echo $Rs['equipo2'];?>"/>
  							</div>
                            <div class="col-xs-2">
                            <label class="control-label">Código</label>
                                <input class="form-control input-sm" type="text" name="codigo2" disabled value="<?php echo $Rs['codigo2'];?>">
                            </div>
  							<div class="col-xs-2">
                              <label class="control-label">Marca</label>
    							<input class="form-control input-sm" type="text" name="marca2" disabled value="<?php echo $Rs['marca2'];?>">
  							</div>
                              <div class="col-xs-3">
                              <label class="control-label">Nombre a quien se le asigna</label>
    							<input class="form-control input-sm" type="text" name="nombre2" disabled value="<?php echo $Rs['nombre2'];?>">
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                <select name='contrato2' class='form-control input-sm resaltado' disabled id="contrato2">
                                    <option selected ><?php echo $Rs['contrato2'];?></option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">Precio</label>
    							<input class="form-control input-sm resaltado" type="text" name="precio2" id="precio2" readonly value="<?php echo $Rs['precio2'];?>">
  							</div>
                              <div class="col-xs-8">
                				<label class="control-label green-distinct">Observaciones</label>
    							<input class="form-control input-sm resaltado" type="text" name="observaciones2" id="observaciones2" readonly value="<?php echo $Rs['observaciones2'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega2' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega2'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega2" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega2"]));?> >
  							</div>
                        </div><br><br><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-2">
                            <label class="control-label">Cantidad (pzas/par)</label>
    							<input class="form-control input-sm" type="text" name="cant3" disabled value="<?php echo $Rs['cant3'];?>">
                            </div>
  							<div class="col-xs-3">
                              <label class="control-label">Equipo</label>
                                <input class="form-control input-sm" type="text" name="equipo3" disabled value="<?php echo $Rs['equipo3'];?>"/>
  							</div>
                            <div class="col-xs-2">
                            <label class="control-label">Código</label>
                                <input class="form-control input-sm" type="text" name="codigo3" disabled value="<?php echo $Rs['codigo3'];?>">
                            </div>
  							<div class="col-xs-2">
                              <label class="control-label">Marca</label>
    							<input class="form-control input-sm" type="text" name="marca3" disabled value="<?php echo $Rs['marca3'];?>">
  							</div>
                              <div class="col-xs-3">
                              <label class="control-label">Nombre a quien se le asigna</label>
    							<input class="form-control input-sm" type="text" name="nombre3" disabled value="<?php echo $Rs['nombre3'];?>">
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                <select name='contrato3' class='form-control input-sm resaltado' disabled id="contrato3">
                                    <option selected ><?php echo $Rs['contrato3'];?></option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">Precio</label>
    							<input class="form-control input-sm resaltado" type="text" name="precio3" id="precio3" readonly value="<?php echo $Rs['precio3'];?>">
  							</div>
                              <div class="col-xs-8">
                				<label class="control-label green-distinct">Observaciones</label>
    							<input class="form-control input-sm resaltado" type="text" name="observaciones3" id="observaciones3" readonly value="<?php echo $Rs['observaciones3'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega3' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega3'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega3" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega3"]));?> >
  							</div>
                        </div><br><br><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-2">
                            <label class="control-label">Cantidad (pzas/par)</label>
    							<input class="form-control input-sm" type="text" name="cant4" disabled value="<?php echo $Rs['cant4'];?>">
                            </div>
  							<div class="col-xs-3">
                              <label class="control-label">Equipo</label>
                                <input class="form-control input-sm" type="text" name="equipo4" disabled value="<?php echo $Rs['equipo4'];?>"/>
  							</div>
                            <div class="col-xs-2">
                            <label class="control-label">Código</label>
                                <input class="form-control input-sm" type="text" name="codigo4" disabled value="<?php echo $Rs['codigo4'];?>">
                            </div>
  							<div class="col-xs-2">
                              <label class="control-label">Marca</label>
    							<input class="form-control input-sm" type="text" name="marca4" disabled value="<?php echo $Rs['marca4'];?>">
  							</div>
                              <div class="col-xs-3">
                              <label class="control-label">Nombre a quien se le asigna</label>
    							<input class="form-control input-sm" type="text" name="nombre4" disabled value="<?php echo $Rs['nombre4'];?>">
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                <select name='contrato4' class='form-control input-sm resaltado' disabled id="contrato4">
                                    <option selected ><?php echo $Rs['contrato4'];?></option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">Precio</label>
    							<input class="form-control input-sm resaltado" type="text" name="precio4" id="precio4" readonly value="<?php echo $Rs['precio4'];?>">
  							</div>
                              <div class="col-xs-8">
                				<label class="control-label green-distinct">Observaciones</label>
    							<input class="form-control input-sm resaltado" type="text" name="observaciones4" id="observaciones4" readonly value="<?php echo $Rs['observaciones4'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega4' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega4'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega4" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega4"]));?> >
  							</div>
                        </div><br><br><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-2">
                            <label class="control-label">Cantidad (pzas/par)</label>
    							<input class="form-control input-sm" type="text" name="cant5" disabled value="<?php echo $Rs['cant5'];?>">
                            </div>
  							<div class="col-xs-3">
                              <label class="control-label">Equipo</label>
                                <input class="form-control input-sm" type="text" name="equipo5" disabled value="<?php echo $Rs['equipo5'];?>"/>
  							</div>
                            <div class="col-xs-2">
                            <label class="control-label">Código</label>
                                <input class="form-control input-sm" type="text" name="codigo5" disabled value="<?php echo $Rs['codigo5'];?>">
                            </div>
  							<div class="col-xs-2">
                              <label class="control-label">Marca</label>
    							<input class="form-control input-sm" type="text" name="marca5" disabled value="<?php echo $Rs['marca5'];?>">
  							</div>
                              <div class="col-xs-3">
                              <label class="control-label">Nombre a quien se le asigna</label>
    							<input class="form-control input-sm" type="text" name="nombre5" disabled value="<?php echo $Rs['nombre5'];?>">
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                <select name='contrato5' class='form-control input-sm resaltado' disabled id="contrato5">
                                    <option selected ><?php echo $Rs['contrato5'];?></option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">Precio</label>
    							<input class="form-control input-sm resaltado" type="text" name="precio5" id="precio5" readonly value="<?php echo $Rs['precio5'];?>">
  							</div>
                              <div class="col-xs-8">
                				<label class="control-label green-distinct">Observaciones</label>
    							<input class="form-control input-sm resaltado" type="text" name="observaciones5" id="observaciones5" readonly value="<?php echo $Rs['observaciones5'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega5' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega5'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega5" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega5"]));?> >
  							</div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-5">
                            </div>
                            <?php $adj = "./adjuntos/".$Rs['adjuntos'];?>
                            <div class="col-xs-4"><a class='btn form-btn btn-primary glyphicon glyphicon-paperclip' href=<?php echo $adj; ?> target="_blank"> ADJUNTOS</a></div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Supervisor</label>
                                <textarea  name="observaciones_sup" class="form-control "readonly ><?php echo $Rs['observaciones_sup'];?> </textarea>
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Residente</label>
                                <textarea  name="observaciones_res" class="form-control " readonly><?php echo $Rs['observaciones_res'];?> </textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones SASST</label>
                                <textarea  name="observaciones_sasst" class="form-control "readonly ><?php echo $Rs['observaciones_sasst'];?> </textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Gerencia de Seguridad</label>
                                <textarea  name="observaciones_gerseg" class="form-control " readonly><?php echo $Rs['observaciones_gerseg'];?> </textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Director de Operaciones</label>
                                <textarea  name="observaciones_gerob" class="form-control " readonly><?php echo $Rs['observaciones_gerob'];?> </textarea>
                            </div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                            </div>
                        </div>
        			</form>
                            <?php }	
                            else if($_SESSION['user_epp'] == "gerseg") { ?>

<form action="modificar_ex" method="post">
             			<div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?> " >
                            </div>
                            <div class="col-xs-5">
                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol']; ?>">
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Motivo</i></label>
                                <select name='motivo' class='form-control input-sm' disabled>
                                    <option selected ><?php echo $Rs['motivo'];?></option>
                                    <option value="EPP Alto Costo">EPP Alto Costo</option>
                                    <option value="Necesidad de Obra">Necesidad de Obra</option>
                                    <option value="Solicitud del Cliente">Solicitud del Cliente</option>
                                    <option value="Termino EPP Trimestral">Termino EPP Trimestral</option>
                                </select>
                            </div>
                	    </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm' disabled>
                                    <option selected ><?php echo $Rs['obra'];?></option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
                                    <option value="Proyectos de Construcción Concretos">Proyectos de Construcción Concretos</option>
                                    <option value="Sucursal MyT Control Vehicular">Sucursal MyT Control Vehicular</option>
                                    <option value="Herradura">Herradura</option>
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
                            <div class="col-xs-5">
                                <label class="control-label blue-distinct"><i>Justificación</i></label>
                                <input name="justificacion" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['justificacion'];?>">
                            </div>
						</div>
                        <br><br><br>
            			<div class="row form-horizontal">
                        <div class="col-xs-2">
                                <label class="control-label">Cantidad (pzas/par)</label>
    							<input class="form-control input-sm" type="text" name="cant1" disabled value="<?php echo $Rs['cant1'];?>">
                            </div>
  							<div class="col-xs-3">
                                <label class="control-label">Equipo</label>
                                <input class="form-control input-sm" type="text" name="equipo1" disabled value="<?php echo $Rs['equipo1'];?>"/>
  							</div>
                            <div class="col-xs-2">
                                <label class="control-label">Código</label>
                                <input class="form-control input-sm" type="text" name="codigo1" disabled value="<?php echo $Rs['codigo1'];?>">
                            </div>
  							<div class="col-xs-2">
                				<label class="control-label">Marca</label>
    							<input class="form-control input-sm" type="text" name="marca1" disabled value="<?php echo $Rs['marca1'];?>">
  							</div>
                            <div class="col-xs-3">
                				<label class="control-label">Nombre a quien se le asigna</label>
    							<input class="form-control input-sm" type="text" name="nombre1" disabled value="<?php echo $Rs['nombre1'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                <select name='contrato1' class='form-control input-sm resaltado' disabled id="contrato1">
                                    <option selected ><?php echo $Rs['contrato1'];?></option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">Precio</label>
    							<input class="form-control input-sm resaltado" type="text" name="precio1" id="precio1" readonly value="<?php echo $Rs['precio1'];?>">
  							</div>
                              <div class="col-xs-8">
                				<label class="control-label green-distinct">Observaciones</label>
    							<input class="form-control input-sm resaltado" type="text" name="observaciones1" id="observaciones1" readonly value="<?php echo $Rs['observaciones1'];?>">
  							</div>
                        </div><br><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            <label class="control-label">Cantidad (pzas/par)</label>
    							<input class="form-control input-sm" type="text" name="cant2" disabled value="<?php echo $Rs['cant2'];?>">
                            </div>
  							<div class="col-xs-3">
                              <label class="control-label">Equipo</label>
                                <input class="form-control input-sm" type="text" name="equipo2" disabled value="<?php echo $Rs['equipo2'];?>"/>
  							</div>
                            <div class="col-xs-2">
                            <label class="control-label">Código</label>
                                <input class="form-control input-sm" type="text" name="codigo2" disabled value="<?php echo $Rs['codigo2'];?>">
                            </div>
  							<div class="col-xs-2">
                              <label class="control-label">Marca</label>
    							<input class="form-control input-sm" type="text" name="marca2" disabled value="<?php echo $Rs['marca2'];?>">
  							</div>
                              <div class="col-xs-3">
                              <label class="control-label">Nombre a quien se le asigna</label>
    							<input class="form-control input-sm" type="text" name="nombre2" disabled value="<?php echo $Rs['nombre2'];?>">
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                <select name='contrato2' class='form-control input-sm resaltado' disabled id="contrato2">
                                    <option selected ><?php echo $Rs['contrato2'];?></option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">Precio</label>
    							<input class="form-control input-sm resaltado" type="text" name="precio2" id="precio2" readonly value="<?php echo $Rs['precio2'];?>">
  							</div>
                              <div class="col-xs-8">
                				<label class="control-label green-distinct">Observaciones</label>
    							<input class="form-control input-sm resaltado" type="text" name="observaciones2" id="observaciones2" readonly value="<?php echo $Rs['observaciones2'];?>">
  							</div>
                        </div><br><br><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-2">
                            <label class="control-label">Cantidad (pzas/par)</label>
    							<input class="form-control input-sm" type="text" name="cant3" disabled value="<?php echo $Rs['cant3'];?>">
                            </div>
  							<div class="col-xs-3">
                              <label class="control-label">Equipo</label>
                                <input class="form-control input-sm" type="text" name="equipo3" disabled value="<?php echo $Rs['equipo3'];?>"/>
  							</div>
                            <div class="col-xs-2">
                            <label class="control-label">Código</label>
                                <input class="form-control input-sm" type="text" name="codigo3" disabled value="<?php echo $Rs['codigo3'];?>">
                            </div>
  							<div class="col-xs-2">
                              <label class="control-label">Marca</label>
    							<input class="form-control input-sm" type="text" name="marca3" disabled value="<?php echo $Rs['marca3'];?>">
  							</div>
                              <div class="col-xs-3">
                              <label class="control-label">Nombre a quien se le asigna</label>
    							<input class="form-control input-sm" type="text" name="nombre3" disabled value="<?php echo $Rs['nombre3'];?>">
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                <select name='contrato3' class='form-control input-sm resaltado' disabled id="contrato3">
                                    <option selected ><?php echo $Rs['contrato3'];?></option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">Precio</label>
    							<input class="form-control input-sm resaltado" type="text" name="precio3" id="precio3" readonly value="<?php echo $Rs['precio3'];?>">
  							</div>
                              <div class="col-xs-8">
                				<label class="control-label green-distinct">Observaciones</label>
    							<input class="form-control input-sm resaltado" type="text" name="observaciones3" id="observaciones3" readonly value="<?php echo $Rs['observaciones3'];?>">
  							</div>
                        </div><br><br><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-2">
                            <label class="control-label">Cantidad (pzas/par)</label>
    							<input class="form-control input-sm" type="text" name="cant4" disabled value="<?php echo $Rs['cant4'];?>">
                            </div>
  							<div class="col-xs-3">
                              <label class="control-label">Equipo</label>
                                <input class="form-control input-sm" type="text" name="equipo4" disabled value="<?php echo $Rs['equipo4'];?>"/>
  							</div>
                            <div class="col-xs-2">
                            <label class="control-label">Código</label>
                                <input class="form-control input-sm" type="text" name="codigo4" disabled value="<?php echo $Rs['codigo4'];?>">
                            </div>
  							<div class="col-xs-2">
                              <label class="control-label">Marca</label>
    							<input class="form-control input-sm" type="text" name="marca4" disabled value="<?php echo $Rs['marca4'];?>">
  							</div>
                              <div class="col-xs-3">
                              <label class="control-label">Nombre a quien se le asigna</label>
    							<input class="form-control input-sm" type="text" name="nombre4" disabled value="<?php echo $Rs['nombre4'];?>">
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                <select name='contrato4' class='form-control input-sm resaltado' disabled id="contrato4">
                                    <option selected ><?php echo $Rs['contrato4'];?></option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">Precio</label>
    							<input class="form-control input-sm resaltado" type="text" name="precio4" id="precio4" readonly value="<?php echo $Rs['precio4'];?>">
  							</div>
                              <div class="col-xs-8">
                				<label class="control-label green-distinct">Observaciones</label>
    							<input class="form-control input-sm resaltado" type="text" name="observaciones4" id="observaciones4" readonly value="<?php echo $Rs['observaciones4'];?>">
  							</div>
                        </div><br><br><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-2">
                            <label class="control-label">Cantidad (pzas/par)</label>
    							<input class="form-control input-sm" type="text" name="cant5" disabled value="<?php echo $Rs['cant5'];?>">
                            </div>
  							<div class="col-xs-3">
                              <label class="control-label">Equipo</label>
                                <input class="form-control input-sm" type="text" name="equipo5" disabled value="<?php echo $Rs['equipo5'];?>"/>
  							</div>
                            <div class="col-xs-2">
                            <label class="control-label">Código</label>
                                <input class="form-control input-sm" type="text" name="codigo5" disabled value="<?php echo $Rs['codigo5'];?>">
                            </div>
  							<div class="col-xs-2">
                              <label class="control-label">Marca</label>
    							<input class="form-control input-sm" type="text" name="marca5" disabled value="<?php echo $Rs['marca5'];?>">
  							</div>
                              <div class="col-xs-3">
                              <label class="control-label">Nombre a quien se le asigna</label>
    							<input class="form-control input-sm" type="text" name="nombre5" disabled value="<?php echo $Rs['nombre5'];?>">
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                <select name='contrato5' class='form-control input-sm resaltado' disabled id="contrato5">
                                    <option selected ><?php echo $Rs['contrato5'];?></option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label green-distinct">Precio</label>
    							<input class="form-control input-sm resaltado" type="text" name="precio5" id="precio5" readonly value="<?php echo $Rs['precio5'];?>">
  							</div>
                              <div class="col-xs-8">
                				<label class="control-label green-distinct">Observaciones</label>
    							<input class="form-control input-sm resaltado" type="text" name="observaciones5" id="observaciones5" readonly value="<?php echo $Rs['observaciones5'];?>">
  							</div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-5">
                            </div>
                            <?php $adj = "./adjuntos/".$Rs['adjuntos'];?>
                            <div class="col-xs-4"><a class='btn form-btn btn-primary glyphicon glyphicon-paperclip' href=<?php echo $adj; ?> target="_blank"> ADJUNTOS</a></div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Supervisor</label>
                                <textarea  name="observaciones_sup" class="form-control "readonly ><?php echo $Rs['observaciones_sup'];?> </textarea>
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Residente</label>
                                <textarea  name="observaciones_res" class="form-control " readonly><?php echo $Rs['observaciones_res'];?> </textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones SASST</label>
                                <textarea  name="observaciones_sasst" class="form-control " readonly><?php echo $Rs['observaciones_sasst'];?> </textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Gerencia de Seguridad</label>
                                <textarea  name="observaciones_gerseg" class="form-control "readonly ><?php echo $Rs['observaciones_gerseg'];?> </textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Director de Operaciones</label>
                                <textarea  name="observaciones_gerob" class="form-control " readonly><?php echo $Rs['observaciones_gerob'];?> </textarea>
                            </div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-2">
                                <input class="btn form-btn btn-success" type="submit" name="aut1su" value="Guardar">
                            </div>
                        </div>
        			</form>
                            <?php }	
							}
						}
                        else{
							echo "<script languaje='javascript'>
									alert('No fue posible realizar la operacion solicitada al pedido con ID".$id_pedido."')
							javascript:history.go(-1)
  									</script>";
						}				
					}
					mysql_close($conexion);
					?>
               </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
  </body>
</html>