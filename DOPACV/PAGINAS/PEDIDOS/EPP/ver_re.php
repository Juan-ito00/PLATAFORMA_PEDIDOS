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
                  <li class="dropdown">
	                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b></a>
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
      			</ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
      			</ul>
    		</div>
        </nav>
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Modificar Pedido Reemplazo de EPP</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");

                    if(isset($_POST["aut1go"])) {
                        $query = "UPDATE epp_re SET autorizado_gerob='Autorizado',observaciones_gerob='".$_POST["observaciones_gerob"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_re?id=tw_redireccion';
                            </script>";
				    }
                    else if(isset($_POST["aut2go"])) {
                        $query = "UPDATE epp_re SET autorizado_gerob='No autorizado',observaciones_gerob='".$_POST["observaciones_gerob"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_re?id=tw_redireccion';
                            </script>";
				    }
                    else if(isset($_POST["aut1r"])) {
                        $query = "UPDATE epp_re SET autorizado_residente='Autorizado',observaciones_res='".$_POST["observaciones_res"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_re?id=tw_redireccion';
                            </script>";
				    }
                    else if(isset($_POST["aut2r"])) {
                        $query = "UPDATE epp_re SET autorizado_residente='No autorizado',observaciones_res='".$_POST["observaciones_res"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_re?id=tw_redireccion';
                            </script>";
				    }
                    else {
						$id_pedido=$_GET['id_pedido'];
						$sql_query="SELECT * FROM epp_re WHERE id='".$id_pedido."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
                                if($_SESSION['user_epp'] == "res") { ?>

                                    <form method="post" name=frm action="modificar_re" enctype="multipart/form-data">
                                <div class="row form-horizontal">
                                <div class="col-xs-2">
                                    <label class="control-label blue-distinct"><i>Folio</i></label>
                                    <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?> " >
                                </div>
                                <div class="col-xs-5">
                                    <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                    <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol'];?> ">
                                </div>
                                <div class="col-xs-3">
                                    <label class="control-label blue-distinct"><i>Motivo</i></label>
                                    <select name='motivo' class='form-control input-sm' readonly>
                                        <option selected ><?php echo $Rs['motivo'];?></option>
                                        <option value="Defecto de Fabricación">Defecto de Fabricación</option>
                                        <option value="Desgaste">Desgaste</option>
                                        <option value="Extravío">Extravío</option>
                                        <option value="Pérdida Accidental">Pérdida Accidental</option>
                                        <option value="Reducción de Talla">Reducción de Talla</option>
                                        <option value="Robo">Robo</option>
                                        <option value="Ruptura">Ruptura</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-horizontal">
                                <div class="col-xs-2">
                                </div>
                                <div class="col-xs-5">
                                    <label class="control-label blue-distinct"><i>Nombre del Trabajador</i></label>
                                    <input name="trabajador" type="text" class="form-control input-sm" value="<?php echo $Rs['trabajador'];?>"readonly>
                                </div>
                                <div class="col-xs-3">
                                    <label class="control-label blue-distinct"><i>Fecha de Ingreso</i></label>
                                    <input name="fecha_ingreso" type="date" readonly class="form-control input-sm" value=<?php echo strftime('%Y-%m-%d',strtotime($Rs["fecha_ingreso"]));?> >
                                </div>
                            </div>
                            <div class="row form-horizontal">
                                <div class="col-xs-2">
                                </div>
                                <div class="col-xs-4">
                                    <label class="control-label blue-distinct"><i>Obra</i></label>
                                    <select name='obra' class='form-control input-sm' readonly>
                                        <option selected><?php echo $Rs['obra'];?></option>
                                        <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
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
                                <div class="col-xs-4">
                                    <label class="control-label blue-distinct"><i>Categoría</i></label>
                                    <input name="categoria" type="text" class="form-control input-sm" value="<?php echo $Rs['categoria'];?> "readonly>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="row form-horizontal">
                                  <div class="col-xs-2" style="text-align:center;">
                                    <label class="control-label">Equipo</label>
                                    <select name='epp1' class='form-control input-sm' id="epp1" onchange="e1()" readonly>
                                        <option selected><?php echo $Rs['epp1'];?></option>
                                        <option value="Bota">Bota</option>
                                        <option value="Camisa">Camisa</option>
                                        <option value="Casco">Casco</option>
                                        <option value="Chaleco">Chaleco</option>
                                        <option value="Overol">Overol</option>
                                        <option value="Pantalón">Pantalón</option>
                                        <option value="Zapato">Zapato</option>
                                        <option value="OTROS">OTROS</option>
                                    </select>
                                  </div>
                                <div class="col-xs-3">
                                    <label class="control-label">Fecha de Última Entrega</label>
                                    <input class="form-control input-sm" type="date" name="fut_epp1" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp1']));?> >
                                </div>
                                  <div class="col-xs-3">
                                    <label class="control-label">Talla Solicitada</label>
                                    <input class="form-control input-sm" type="text" name="talla_epp1" readonly value="<?php echo $Rs['talla_epp1'];?> ">
                                  </div>
                            </div><br>
                            <div class="row form-horizontal">
                                  <div class="col-xs-2" style="text-align:center;">
                                    <label class="control-label">Equipo</label>
                                    <select name='epp2' class='form-control input-sm' id="epp2" onchange="e2()" readonly>
                                        <option selected><?php echo $Rs['epp2'];?></option>
                                        <option value="Bota">Bota</option>
                                        <option value="Camisa">Camisa</option>
                                        <option value="Casco">Casco</option>
                                        <option value="Chaleco">Chaleco</option>
                                        <option value="Overol">Overol</option>
                                        <option value="Pantalón">Pantalón</option>
                                        <option value="Zapato">Zapato</option>
                                        <option value="OTROS">OTROS</option>
                                    </select>
                                  </div>
                                <div class="col-xs-3">
                                    <label class="control-label">Fecha de Última Entrega</label>
                                    <input class="form-control input-sm" type="date" name="fut_epp2" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp2']));?> >
                                </div>
                                  <div class="col-xs-3">
                                    <label class="control-label">Talla Solicitada</label>
                                    <input class="form-control input-sm" type="text" name="talla_epp2" readonly value="<?php echo $Rs['talla_epp2'];?> ">
                                  </div>
                            </div><br>
                            <div class="row form-horizontal">
                                  <div class="col-xs-2" style="text-align:center;">
                                    <label class="control-label">Equipo</label>
                                    <select name='epp3' class='form-control input-sm' id="epp3" onchange="e3()" readonly>
                                        <option selected><?php echo $Rs['epp3'];?></option>
                                        <option value="Bota">Bota</option>
                                        <option value="Camisa">Camisa</option>
                                        <option value="Casco">Casco</option>
                                        <option value="Chaleco">Chaleco</option>
                                        <option value="Overol">Overol</option>
                                        <option value="Pantalón">Pantalón</option>
                                        <option value="Zapato">Zapato</option>
                                        <option value="OTROS">OTROS</option>
                                    </select>
                                  </div>
                                <div class="col-xs-3">
                                    <label class="control-label">Fecha de Última Entrega</label>
                                    <input class="form-control input-sm" type="date" name="fut_epp3" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp3']));?> >
                                </div>
                                  <div class="col-xs-3">
                                    <label class="control-label">Talla Solicitada</label>
                                    <input class="form-control input-sm" type="text" name="talla_epp3" readonly value="<?php echo $Rs['talla_epp3'];?> ">
                                  </div>
                            </div><br>
                            <div class="row form-horizontal">
                                  <div class="col-xs-2" style="text-align:center;">
                                    <label class="control-label">Equipo</label>
                                    <select name='epp4' class='form-control input-sm' id="epp4" onchange="e4()" readonly>
                                        <option selected><?php echo $Rs['epp4'];?></option>
                                        <option value="Bota">Bota</option>
                                        <option value="Camisa">Camisa</option>
                                        <option value="Casco">Casco</option>
                                        <option value="Chaleco">Chaleco</option>
                                        <option value="Overol">Overol</option>
                                        <option value="Pantalón">Pantalón</option>
                                        <option value="Zapato">Zapato</option>
                                        <option value="OTROS">OTROS</option>
                                    </select>
                                  </div>
                                <div class="col-xs-3">
                                    <label class="control-label">Fecha de Última Entrega</label>
                                    <input class="form-control input-sm" type="date" name="fut_epp4" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp4']));?> >
                                </div>
                                  <div class="col-xs-3">
                                    <label class="control-label">Talla Solicitada</label>
                                    <input class="form-control input-sm" type="text" name="talla_epp4" readonly value="<?php echo $Rs['talla_epp4'];?> ">
                                  </div>
                            </div><br>
                            <div class="row form-horizontal">
                                  <div class="col-xs-2" style="text-align:center;">
                                    <label class="control-label">Equipo</label>
                                    <select name='epp5' class='form-control input-sm' id="epp5" onchange="e5()" readonly>
                                        <option selected><?php echo $Rs['epp5'];?></option>
                                        <option value="Bota">Bota</option>
                                        <option value="Camisa">Camisa</option>
                                        <option value="Casco">Casco</option>
                                        <option value="Chaleco">Chaleco</option>
                                        <option value="Overol">Overol</option>
                                        <option value="Pantalón">Pantalón</option>
                                        <option value="Zapato">Zapato</option>
                                        <option value="OTROS">OTROS</option>
                                    </select>
                                  </div>
                                <div class="col-xs-3">
                                    <label class="control-label">Fecha de Última Entrega</label>
                                    <input class="form-control input-sm" type="date" name="fut_epp5" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp5']));?> >
                                </div>
                                  <div class="col-xs-3">
                                    <label class="control-label">Talla Solicitada</label>
                                    <input class="form-control input-sm" type="text" name="talla_epp5" readonly value="<?php echo $Rs['talla_epp5'];?> ">
                                  </div>
                            </div><br>
                            <div class="row form-horizontal">
                                  <div class="col-xs-2" style="text-align:center;">
                                    <label class="control-label">Equipo</label>
                                    <select name='epp6' class='form-control input-sm' id="epp6" onchange="e6()" readonly>
                                        <option selected><?php echo $Rs['epp6'];?></option>
                                        <option value="Bota">Bota</option>
                                        <option value="Camisa">Camisa</option>
                                        <option value="Casco">Casco</option>
                                        <option value="Chaleco">Chaleco</option>
                                        <option value="Overol">Overol</option>
                                        <option value="Pantalón">Pantalón</option>
                                        <option value="Zapato">Zapato</option>
                                        <option value="OTROS">OTROS</option>
                                    </select>
                                  </div>
                                <div class="col-xs-3">
                                    <label class="control-label">Fecha de Última Entrega</label>
                                    <input class="form-control input-sm" type="date" name="fut_epp6" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp6']));?> >
                                </div>
                                  <div class="col-xs-3">
                                    <label class="control-label">Talla Solicitada</label>
                                    <input class="form-control input-sm" type="text" name="talla_epp6" readonly value="<?php echo $Rs['talla_epp6'];?> ">
                                  </div>
                            </div><br><br>
                            <div class="row form-horizontal">
                                <div class="col-xs-2">
                                </div>
                                <div class="col-xs-8" style="text-align:center;">
                                    <label class="control-label">Evidencia Fotográfica del Reemplazo</label>
                                    <img src="../../../../GSST/PAGINAS/PEDIDOS/EPP/evidencia/<?php echo $Rs['foto_ev1'];?>" alt="<?php echo $Rs['foto_ev1'];?>" width="200"/>
                                    <img src="../../../../GSST/PAGINAS/PEDIDOS/EPP/evidencia/<?php echo $Rs['foto_ev2'];?>" alt="<?php echo $Rs['foto_ev2'];?>" width="200"/>
                                    <img src="../../../../GSST/PAGINAS/PEDIDOS/EPP/evidencia/<?php echo $Rs['foto_ev3'];?>" alt="<?php echo $Rs['foto_ev3'];?>" width="200"/>
                                </div>
                            </div><br>
                            <div class="row form-horizontal">
                                <div class="col-xs-2">
                                </div>
                                <div class="col-xs-8" style="text-align:center;">
                                    <label class="control-label">Observaciones Supervisor</label>
                                    <textarea  name="observaciones_sup" class="form-control " readonly><?php echo $Rs['observaciones_sup'];?> </textarea>
                                </div>
                            </div>
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
                        </form>
                                <?php }	
                                else if($_SESSION['user_epp'] == "gerob") { ?>

                                <form method="post" name=frm action="modificar_re" enctype="multipart/form-data">
                            <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?> " >
                            </div>
                            <div class="col-xs-5">
                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol'];?> ">
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Motivo</i></label>
                                <select name='motivo' class='form-control input-sm' readonly>
                                    <option selected ><?php echo $Rs['motivo'];?></option>
                                    <option value="Defecto de Fabricación">Defecto de Fabricación</option>
                                    <option value="Desgaste">Desgaste</option>
                                    <option value="Extravío">Extravío</option>
                                    <option value="Pérdida Accidental">Pérdida Accidental</option>
                                    <option value="Reducción de Talla">Reducción de Talla</option>
                                    <option value="Robo">Robo</option>
                                    <option value="Ruptura">Ruptura</option>
                                </select>
                            </div>
                	    </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-5">
                                <label class="control-label blue-distinct"><i>Nombre del Trabajador</i></label>
                                <input name="trabajador" type="text" class="form-control input-sm" value="<?php echo $Rs['trabajador'];?>"readonly>
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Fecha de Ingreso</i></label>
                                <input name="fecha_ingreso" type="date" readonly class="form-control input-sm" value=<?php echo strftime('%Y-%m-%d',strtotime($Rs["fecha_ingreso"]));?> >
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['obra'];?></option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
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
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Categoría</i></label>
                                <input name="categoria" type="text" class="form-control input-sm" value="<?php echo $Rs['categoria'];?> "readonly>
                            </div>
						</div>
                        <br><br><br>
                        <div class="row form-horizontal">
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp1' class='form-control input-sm' id="epp1" onchange="e1()" readonly>
                                    <option selected><?php echo $Rs['epp1'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp1" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp1']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp1" readonly value="<?php echo $Rs['talla_epp1'];?> ">
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
    							<input name="f_entrega1" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega1"]));?> >
  							</div>
                        </div><br>
                        </div><br>
            			<div class="row form-horizontal">
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp2' class='form-control input-sm' id="epp2" onchange="e2()" readonly>
                                    <option selected><?php echo $Rs['epp2'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp2" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp2']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp2" readonly value="<?php echo $Rs['talla_epp2'];?> ">
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
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp3' class='form-control input-sm' id="epp3" onchange="e3()" readonly>
                                    <option selected><?php echo $Rs['epp3'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp3" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp3']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp3" readonly value="<?php echo $Rs['talla_epp3'];?> ">
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
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp4' class='form-control input-sm' id="epp4" onchange="e4()" readonly>
                                    <option selected><?php echo $Rs['epp4'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp4" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp4']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp4" readonly value="<?php echo $Rs['talla_epp4'];?> ">
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
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp5' class='form-control input-sm' id="epp5" onchange="e5()" readonly>
                                    <option selected><?php echo $Rs['epp5'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp5" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp5']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp5" readonly value="<?php echo $Rs['talla_epp5'];?> ">
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
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp6' class='form-control input-sm' id="epp6" onchange="e6()" readonly>
                                    <option selected><?php echo $Rs['epp6'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp6" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp6']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp6" readonly value="<?php echo $Rs['talla_epp6'];?> ">
  							</div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Evidencia Fotográfica del Reemplazo</label>
                                <img src="../../../../GSST/PAGINAS/PEDIDOS/EPP/evidencia/<?php echo $Rs['foto_ev1'];?>" alt="<?php echo $Rs['foto_ev1'];?>" width="200"/>
                                <img src="../../../../GSST/PAGINAS/PEDIDOS/EPP/evidencia/<?php echo $Rs['foto_ev2'];?>" alt="<?php echo $Rs['foto_ev2'];?>" width="200"/>
                                <img src="../../../../GSST/PAGINAS/PEDIDOS/EPP/evidencia/<?php echo $Rs['foto_ev3'];?>" alt="<?php echo $Rs['foto_ev3'];?>" width="200"/>
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Supervisor</label>
                                <textarea  name="observaciones_sup" class="form-control " readonly><?php echo $Rs['observaciones_sup'];?> </textarea>
                            </div>
                        </div>
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