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
        	<div align="center" class="panel-heading">Modificar Pedido Ropa y Calzado de EPP</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
                    if(isset($_POST["aut1go"])) {
                        $query = "UPDATE epp_rc SET autorizado_gerob='Autorizado',observaciones_gerob='".$_POST["observaciones_gerob"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_rc?id=tw_redireccion';
                            </script>";
				    }
                    else if(isset($_POST["aut2go"])) {
                        $query = "UPDATE epp_rc SET autorizado_gerob='No autorizado',observaciones_gerob='".$_POST["observaciones_gerob"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_rc?id=tw_redireccion';
                            </script>";
				    }
                    else if(isset($_POST["aut1r"])) {
                        $query = "UPDATE epp_rc SET autorizado_residente='Autorizado',observaciones_res='".$_POST["observaciones_res"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_rc?id=tw_redireccion';
                            </script>";
				    }
                    else if(isset($_POST["aut2r"])) {
                        $query = "UPDATE epp_rc SET autorizado_residente='No autorizado',observaciones_res='".$_POST["observaciones_res"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_rc?id=tw_redireccion';
                            </script>";
				    }
                    else {
						$id_pedido=$_GET['id_pedido'];
						$sql_query="SELECT * FROM epp_rc WHERE id='".$id_pedido."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
                    if($_SESSION['user_epp'] == "res") { ?>
                    <form action="modificar_rc" method="post">
                    <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?> " >
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol']; ?>">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Empresa</i></label>
                                <select name='empresa' class='form-control input-sm' disabled>
                                    <option selected><?php echo $Rs['empresa'];?></option>
                                    <option value="Cavi de Sombrerete S.A. de C.V.">Cavi de Sombrerete S.A. de C.V.</option>
                                    <option value="Concretos Cavi S.A. de C.V.">Concretos Cavi S.A. de C.V.</option>
                                    <option value="Montajes y Estructuras de Zacatecas S.A. de C.V.">Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                    <option value="Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.">Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                            <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm' disabled>
                                    <option selected><?php echo $Rs['obra'];?></option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
                                    <option value="Herradura">Herradura</option>
                                    <option value="Mantenimiento Multifuncional">Mantenimiento Multifuncional</option>
                                    <option value="Planta de Pailería, Soldadura y Blindaje de Molinos">Planta de Pailería, Soldadura y Blindaje de Molinos</option>
                                    <option value="Proyecto San Julián">Proyecto San Julián</option>
                                    <option value="Sabinas">Sabinas</option>
                                    <option value="Saucito">Saucito</option>
                                    <option value="Sucursal de Autobuses">Sucursal de Autobuses</option>
                                    <option value="Sucursal Maquinaria">Sucursal Maquinaria</option>
                                    <option value="Taller Mecánico">Taller Mecánico</option>
                                    <option value="Tocayos Agosto 2019">Tocayos Agosto 2019</option>
                                </select>
                            </div>
						</div>
                        <br><br><br>
            			<div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label">Nombre</label>
    							<input class="form-control input-sm" type="text" name="nombre1" readonly value="<?php echo $Rs['nombre1'];?>">
                            </div>
  							<div class="col-xs-1">
                                <label class="control-label">T.Overol</label>
                                <input class="form-control input-sm" type="text" name="talla_overol1" readonly value="<?php echo $Rs['talla_overol1'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <label class="control-label">T.Zapato</label>
                                <input class="form-control input-sm" type="text" name="talla_zapato1" readonly value="<?php echo $Rs['talla_zapato1'];?>">
                            </div>
  							<div class="col-xs-1">
                				<label class="control-label">T.Bota</label>
    							<input class="form-control input-sm" type="text" name="talla_bota1" readonly value="<?php echo $Rs['talla_bota1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Camisa</label>
    							<input class="form-control input-sm" type="text" name="talla_camisa1" readonly value="<?php echo $Rs['talla_camisa1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Pantalón</label>
    							<input class="form-control input-sm" type="text" name="talla_pantalon1" readonly value="<?php echo $Rs['talla_pantalon1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Chaleco</label>
    							<input class="form-control input-sm" type="text" name="talla_chaleco1" readonly value="<?php echo $Rs['talla_chaleco1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Bata</label>
    							<input class="form-control input-sm" type="text" name="talla_bata1" readonly value="<?php echo $Rs['talla_bata1'];?>">
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
                            <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre2" readonly value="<?php echo $Rs['nombre2'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol2" readonly value="<?php echo $Rs['talla_overol2'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato2" readonly value="<?php echo $Rs['talla_zapato2'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota2" readonly value="<?php echo $Rs['talla_bota2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa2" readonly value="<?php echo $Rs['talla_camisa2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon2" readonly value="<?php echo $Rs['talla_pantalon2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco2" readonly value="<?php echo $Rs['talla_chaleco2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata2" readonly value="<?php echo $Rs['talla_bata2'];?>">
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
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre3" readonly value="<?php echo $Rs['nombre3'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol3" readonly value="<?php echo $Rs['talla_overol3'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato3" readonly value="<?php echo $Rs['talla_zapato3'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota3" readonly value="<?php echo $Rs['talla_bota3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa3" readonly value="<?php echo $Rs['talla_camisa3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon3" readonly value="<?php echo $Rs['talla_pantalon3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco3" readonly value="<?php echo $Rs['talla_chaleco3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata3" readonly value="<?php echo $Rs['talla_bata3'];?>">
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
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre4" readonly value="<?php echo $Rs['nombre4'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol4" readonly value="<?php echo $Rs['talla_overol4'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato4" readonly value="<?php echo $Rs['talla_zapato4'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota4" readonly value="<?php echo $Rs['talla_bota4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa4" readonly value="<?php echo $Rs['talla_camisa4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon4" readonly value="<?php echo $Rs['talla_pantalon4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco4" readonly value="<?php echo $Rs['talla_chaleco4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata4" readonly value="<?php echo $Rs['talla_bata4'];?>">
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
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre5" readonly value="<?php echo $Rs['nombre5'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol5" readonly value="<?php echo $Rs['talla_overol5'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato5" readonly value="<?php echo $Rs['talla_zapato5'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota5" readonly value="<?php echo $Rs['talla_bota5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa5" readonly value="<?php echo $Rs['talla_camisa5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon5" readonly value="<?php echo $Rs['talla_pantalon5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco5" readonly value="<?php echo $Rs['talla_chaleco5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata5" readonly value="<?php echo $Rs['talla_bata5'];?>">
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
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre6" readonly value="<?php echo $Rs['nombre6'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol6" readonly value="<?php echo $Rs['talla_overol6'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato6" readonly value="<?php echo $Rs['talla_zapato6'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota6" readonly value="<?php echo $Rs['talla_bota6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa6" readonly value="<?php echo $Rs['talla_camisa6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon6" readonly value="<?php echo $Rs['talla_pantalon6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco6" readonly value="<?php echo $Rs['talla_chaleco6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata6" readonly value="<?php echo $Rs['talla_bata6'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega6' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega6'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega6" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega6"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre7" readonly value="<?php echo $Rs['nombre7'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol7" readonly value="<?php echo $Rs['talla_overol7'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato7" readonly value="<?php echo $Rs['talla_zapato7'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota7" readonly value="<?php echo $Rs['talla_bota7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa7" readonly value="<?php echo $Rs['talla_camisa7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon7" readonly value="<?php echo $Rs['talla_pantalon7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco7" readonly value="<?php echo $Rs['talla_chaleco7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata7" readonly value="<?php echo $Rs['talla_bata7'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega7' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega7'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega7" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega7"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre8" readonly value="<?php echo $Rs['nombre8'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol8" readonly value="<?php echo $Rs['talla_overol8'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato8" readonly value="<?php echo $Rs['talla_zapato8'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota8" readonly value="<?php echo $Rs['talla_bota8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa8" readonly value="<?php echo $Rs['talla_camisa8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon8" readonly value="<?php echo $Rs['talla_pantalon8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco8" readonly value="<?php echo $Rs['talla_chaleco8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata8" readonly value="<?php echo $Rs['talla_bata8'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega8' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega8'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega8" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega8"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre9" readonly value="<?php echo $Rs['nombre9'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol9" readonly value="<?php echo $Rs['talla_overol9'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato9" readonly value="<?php echo $Rs['talla_zapato9'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota9" readonly value="<?php echo $Rs['talla_bota9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa9" readonly value="<?php echo $Rs['talla_camisa9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon9" readonly value="<?php echo $Rs['talla_pantalon9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco9" readonly value="<?php echo $Rs['talla_chaleco9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata9" readonly value="<?php echo $Rs['talla_bata9'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega9' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega9'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega9" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega9"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre10" readonly value="<?php echo $Rs['nombre10'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol10" readonly value="<?php echo $Rs['talla_overol10'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato10" readonly value="<?php echo $Rs['talla_zapato10'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota10" readonly value="<?php echo $Rs['talla_bota10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa10" readonly value="<?php echo $Rs['talla_camisa10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon10" readonly value="<?php echo $Rs['talla_pantalon10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco10" readonly value="<?php echo $Rs['talla_chaleco10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata10" readonly value="<?php echo $Rs['talla_bata10'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega10' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega10'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega10" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega10"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre11" readonly value="<?php echo $Rs['nombre11'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol11" readonly value="<?php echo $Rs['talla_overol11'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato11" readonly value="<?php echo $Rs['talla_zapato11'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota11" readonly value="<?php echo $Rs['talla_bota11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa11" readonly value="<?php echo $Rs['talla_camisa11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon11" readonly value="<?php echo $Rs['talla_pantalon11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco11" readonly value="<?php echo $Rs['talla_chaleco11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata11" readonly value="<?php echo $Rs['talla_bata11'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega11' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega11'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega11" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega11"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre12" readonly value="<?php echo $Rs['nombre12'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol12" readonly value="<?php echo $Rs['talla_overol12'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato12" readonly value="<?php echo $Rs['talla_zapato12'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota12" readonly value="<?php echo $Rs['talla_bota12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa12" readonly value="<?php echo $Rs['talla_camisa12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon12" readonly value="<?php echo $Rs['talla_pantalon12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco12" readonly value="<?php echo $Rs['talla_chaleco12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata12" readonly value="<?php echo $Rs['talla_bata12'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega12' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega12'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega12" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega12"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre13" readonly value="<?php echo $Rs['nombre13'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol13" readonly value="<?php echo $Rs['talla_overol13'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato13" readonly value="<?php echo $Rs['talla_zapato13'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota13" readonly value="<?php echo $Rs['talla_bota13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa13" readonly value="<?php echo $Rs['talla_camisa13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon13" readonly value="<?php echo $Rs['talla_pantalon13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco13" readonly value="<?php echo $Rs['talla_chaleco13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata13" readonly value="<?php echo $Rs['talla_bata13'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega13' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega13'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega13" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega13"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre14" readonly value="<?php echo $Rs['nombre14'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol14" readonly value="<?php echo $Rs['talla_overol14'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato14" readonly value="<?php echo $Rs['talla_zapato14'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota14" readonly value="<?php echo $Rs['talla_bota14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa14" readonly value="<?php echo $Rs['talla_camisa14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon14" readonly value="<?php echo $Rs['talla_pantalon14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco14" readonly value="<?php echo $Rs['talla_chaleco14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata14" readonly value="<?php echo $Rs['talla_bata14'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega14' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega14'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega14" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega14"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre15" readonly value="<?php echo $Rs['nombre15'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol15" readonly value="<?php echo $Rs['talla_overol15'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato15" readonly value="<?php echo $Rs['talla_zapato15'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota15" readonly value="<?php echo $Rs['talla_bota15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa15" readonly value="<?php echo $Rs['talla_camisa15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon15" readonly value="<?php echo $Rs['talla_pantalon15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco15" readonly value="<?php echo $Rs['talla_chaleco15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata15" readonly value="<?php echo $Rs['talla_bata15'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega15' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega15'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega15" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega15"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre16" readonly value="<?php echo $Rs['nombre16'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol16" readonly value="<?php echo $Rs['talla_overol16'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato16" readonly value="<?php echo $Rs['talla_zapato16'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota16" readonly value="<?php echo $Rs['talla_bota16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa16" readonly value="<?php echo $Rs['talla_camisa16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon16" readonly value="<?php echo $Rs['talla_pantalon16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco16" readonly value="<?php echo $Rs['talla_chaleco16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata16" readonly value="<?php echo $Rs['talla_bata16'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega16' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega16'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega16" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega16"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre17" readonly value="<?php echo $Rs['nombre17'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol17" readonly value="<?php echo $Rs['talla_overol17'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato17" readonly value="<?php echo $Rs['talla_zapato17'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota17" readonly value="<?php echo $Rs['talla_bota17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa17" readonly value="<?php echo $Rs['talla_camisa17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon17" readonly value="<?php echo $Rs['talla_pantalon17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco17" readonly value="<?php echo $Rs['talla_chaleco17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata17" readonly value="<?php echo $Rs['talla_bata17'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega17' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega17'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega17" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega17"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre18" readonly value="<?php echo $Rs['nombre18'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol18" readonly value="<?php echo $Rs['talla_overol18'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato18" readonly value="<?php echo $Rs['talla_zapato18'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota18" readonly value="<?php echo $Rs['talla_bota18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa18" readonly value="<?php echo $Rs['talla_camisa18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon18" readonly value="<?php echo $Rs['talla_pantalon18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco18" readonly value="<?php echo $Rs['talla_chaleco18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata18" readonly value="<?php echo $Rs['talla_bata18'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega18' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega18'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega18" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega18"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre19" readonly value="<?php echo $Rs['nombre19'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol19" readonly value="<?php echo $Rs['talla_overol19'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato19" readonly value="<?php echo $Rs['talla_zapato19'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota19" readonly value="<?php echo $Rs['talla_bota19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa19" readonly value="<?php echo $Rs['talla_camisa19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon19" readonly value="<?php echo $Rs['talla_pantalon19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco19" readonly value="<?php echo $Rs['talla_chaleco19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata19" readonly value="<?php echo $Rs['talla_bata19'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega19' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega19'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega19" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega19"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre20" readonly value="<?php echo $Rs['nombre20'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol20" readonly value="<?php echo $Rs['talla_overol20'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato20" readonly value="<?php echo $Rs['talla_zapato20'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota20" readonly value="<?php echo $Rs['talla_bota20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa20" readonly value="<?php echo $Rs['talla_camisa20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon20" readonly value="<?php echo $Rs['talla_pantalon20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco20" readonly value="<?php echo $Rs['talla_chaleco20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata20" readonly value="<?php echo $Rs['talla_bata20'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega20' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega20'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega20" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega20"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Supervisor</label>
                                <textarea  name="observaciones_sup" class="form-control " readonly><?php echo $Rs['observaciones_sup'];?></textarea>
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
                                <label class="control-label">Observaciones Almacén</label>
                                <textarea  name="observaciones_almacen" class="form-control " readonly><?php echo $Rs['observaciones_almacen'];?> </textarea>
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

                <form action="modificar_rc" method="post">
                    <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?> " >
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol']; ?>">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Empresa</i></label>
                                <select name='empresa' class='form-control input-sm' disabled>
                                    <option selected><?php echo $Rs['empresa'];?></option>
                                    <option value="Cavi de Sombrerete S.A. de C.V.">Cavi de Sombrerete S.A. de C.V.</option>
                                    <option value="Concretos Cavi S.A. de C.V.">Concretos Cavi S.A. de C.V.</option>
                                    <option value="Montajes y Estructuras de Zacatecas S.A. de C.V.">Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                    <option value="Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.">Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                            <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm' disabled>
                                    <option selected><?php echo $Rs['obra'];?></option>
                                    <option value="Campamento Zona Militar">Campamento Zona Militar</option>
                                    <option value="Herradura">Herradura</option>
                                    <option value="Planta de Pailería, Soldadura y Blindaje de Molinos">Planta de Pailería, Soldadura y Blindaje de Molinos</option>
                                    <option value="Proyecto San Julián">Proyecto San Julián</option>
                                    <option value="Sabinas">Sabinas</option>
                                    <option value="Saucito">Saucito</option>
                                </select>
                            </div>
						</div>
                        <br><br><br>
            			<div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label">Nombre</label>
    							<input class="form-control input-sm" type="text" name="nombre1" readonly value="<?php echo $Rs['nombre1'];?>">
                            </div>
  							<div class="col-xs-1">
                                <label class="control-label">T.Overol</label>
                                <input class="form-control input-sm" type="text" name="talla_overol1" readonly value="<?php echo $Rs['talla_overol1'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <label class="control-label">T.Zapato</label>
                                <input class="form-control input-sm" type="text" name="talla_zapato1" readonly value="<?php echo $Rs['talla_zapato1'];?>">
                            </div>
  							<div class="col-xs-1">
                				<label class="control-label">T.Bota</label>
    							<input class="form-control input-sm" type="text" name="talla_bota1" readonly value="<?php echo $Rs['talla_bota1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Camisa</label>
    							<input class="form-control input-sm" type="text" name="talla_camisa1" readonly value="<?php echo $Rs['talla_camisa1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Pantalón</label>
    							<input class="form-control input-sm" type="text" name="talla_pantalon1" readonly value="<?php echo $Rs['talla_pantalon1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Chaleco</label>
    							<input class="form-control input-sm" type="text" name="talla_chaleco1" readonly value="<?php echo $Rs['talla_chaleco1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Bata</label>
    							<input class="form-control input-sm" type="text" name="talla_bata1" readonly value="<?php echo $Rs['talla_bata1'];?>">
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
                            <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre2" readonly value="<?php echo $Rs['nombre2'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol2" readonly value="<?php echo $Rs['talla_overol2'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato2" readonly value="<?php echo $Rs['talla_zapato2'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota2" readonly value="<?php echo $Rs['talla_bota2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa2" readonly value="<?php echo $Rs['talla_camisa2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon2" readonly value="<?php echo $Rs['talla_pantalon2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco2" readonly value="<?php echo $Rs['talla_chaleco2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata2" readonly value="<?php echo $Rs['talla_bata2'];?>">
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
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre3" readonly value="<?php echo $Rs['nombre3'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol3" readonly value="<?php echo $Rs['talla_overol3'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato3" readonly value="<?php echo $Rs['talla_zapato3'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota3" readonly value="<?php echo $Rs['talla_bota3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa3" readonly value="<?php echo $Rs['talla_camisa3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon3" readonly value="<?php echo $Rs['talla_pantalon3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco3" readonly value="<?php echo $Rs['talla_chaleco3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata3" readonly value="<?php echo $Rs['talla_bata3'];?>">
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
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre4" readonly value="<?php echo $Rs['nombre4'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol4" readonly value="<?php echo $Rs['talla_overol4'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato4" readonly value="<?php echo $Rs['talla_zapato4'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota4" readonly value="<?php echo $Rs['talla_bota4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa4" readonly value="<?php echo $Rs['talla_camisa4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon4" readonly value="<?php echo $Rs['talla_pantalon4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco4" readonly value="<?php echo $Rs['talla_chaleco4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata4" readonly value="<?php echo $Rs['talla_bata4'];?>">
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
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre5" readonly value="<?php echo $Rs['nombre5'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol5" readonly value="<?php echo $Rs['talla_overol5'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato5" readonly value="<?php echo $Rs['talla_zapato5'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota5" readonly value="<?php echo $Rs['talla_bota5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa5" readonly value="<?php echo $Rs['talla_camisa5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon5" readonly value="<?php echo $Rs['talla_pantalon5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco5" readonly value="<?php echo $Rs['talla_chaleco5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata5" readonly value="<?php echo $Rs['talla_bata5'];?>">
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
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre6" readonly value="<?php echo $Rs['nombre6'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol6" readonly value="<?php echo $Rs['talla_overol6'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato6" readonly value="<?php echo $Rs['talla_zapato6'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota6" readonly value="<?php echo $Rs['talla_bota6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa6" readonly value="<?php echo $Rs['talla_camisa6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon6" readonly value="<?php echo $Rs['talla_pantalon6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco6" readonly value="<?php echo $Rs['talla_chaleco6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata6" readonly value="<?php echo $Rs['talla_bata6'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega6' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega6'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega6" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega6"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre7" readonly value="<?php echo $Rs['nombre7'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol7" readonly value="<?php echo $Rs['talla_overol7'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato7" readonly value="<?php echo $Rs['talla_zapato7'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota7" readonly value="<?php echo $Rs['talla_bota7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa7" readonly value="<?php echo $Rs['talla_camisa7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon7" readonly value="<?php echo $Rs['talla_pantalon7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco7" readonly value="<?php echo $Rs['talla_chaleco7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata7" readonly value="<?php echo $Rs['talla_bata7'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega7' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega7'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega7" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega7"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre8" readonly value="<?php echo $Rs['nombre8'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol8" readonly value="<?php echo $Rs['talla_overol8'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato8" readonly value="<?php echo $Rs['talla_zapato8'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota8" readonly value="<?php echo $Rs['talla_bota8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa8" readonly value="<?php echo $Rs['talla_camisa8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon8" readonly value="<?php echo $Rs['talla_pantalon8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco8" readonly value="<?php echo $Rs['talla_chaleco8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata8" readonly value="<?php echo $Rs['talla_bata8'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega8' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega8'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega8" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega8"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre9" readonly value="<?php echo $Rs['nombre9'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol9" readonly value="<?php echo $Rs['talla_overol9'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato9" readonly value="<?php echo $Rs['talla_zapato9'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota9" readonly value="<?php echo $Rs['talla_bota9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa9" readonly value="<?php echo $Rs['talla_camisa9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon9" readonly value="<?php echo $Rs['talla_pantalon9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco9" readonly value="<?php echo $Rs['talla_chaleco9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata9" readonly value="<?php echo $Rs['talla_bata9'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega9' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega9'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega9" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega9"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre10" readonly value="<?php echo $Rs['nombre10'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol10" readonly value="<?php echo $Rs['talla_overol10'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato10" readonly value="<?php echo $Rs['talla_zapato10'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota10" readonly value="<?php echo $Rs['talla_bota10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa10" readonly value="<?php echo $Rs['talla_camisa10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon10" readonly value="<?php echo $Rs['talla_pantalon10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco10" readonly value="<?php echo $Rs['talla_chaleco10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata10" readonly value="<?php echo $Rs['talla_bata10'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega10' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega10'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega10" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega10"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre11" readonly value="<?php echo $Rs['nombre11'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol11" readonly value="<?php echo $Rs['talla_overol11'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato11" readonly value="<?php echo $Rs['talla_zapato11'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota11" readonly value="<?php echo $Rs['talla_bota11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa11" readonly value="<?php echo $Rs['talla_camisa11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon11" readonly value="<?php echo $Rs['talla_pantalon11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco11" readonly value="<?php echo $Rs['talla_chaleco11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata11" readonly value="<?php echo $Rs['talla_bata11'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega11' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega11'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega11" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega11"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre12" readonly value="<?php echo $Rs['nombre12'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol12" readonly value="<?php echo $Rs['talla_overol12'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato12" readonly value="<?php echo $Rs['talla_zapato12'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota12" readonly value="<?php echo $Rs['talla_bota12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa12" readonly value="<?php echo $Rs['talla_camisa12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon12" readonly value="<?php echo $Rs['talla_pantalon12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco12" readonly value="<?php echo $Rs['talla_chaleco12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata12" readonly value="<?php echo $Rs['talla_bata12'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega12' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega12'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega12" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega12"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre13" readonly value="<?php echo $Rs['nombre13'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol13" readonly value="<?php echo $Rs['talla_overol13'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato13" readonly value="<?php echo $Rs['talla_zapato13'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota13" readonly value="<?php echo $Rs['talla_bota13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa13" readonly value="<?php echo $Rs['talla_camisa13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon13" readonly value="<?php echo $Rs['talla_pantalon13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco13" readonly value="<?php echo $Rs['talla_chaleco13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata13" readonly value="<?php echo $Rs['talla_bata13'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega13' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega13'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega13" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega13"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre14" readonly value="<?php echo $Rs['nombre14'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol14" readonly value="<?php echo $Rs['talla_overol14'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato14" readonly value="<?php echo $Rs['talla_zapato14'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota14" readonly value="<?php echo $Rs['talla_bota14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa14" readonly value="<?php echo $Rs['talla_camisa14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon14" readonly value="<?php echo $Rs['talla_pantalon14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco14" readonly value="<?php echo $Rs['talla_chaleco14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata14" readonly value="<?php echo $Rs['talla_bata14'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega14' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega14'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega14" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega14"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre15" readonly value="<?php echo $Rs['nombre15'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol15" readonly value="<?php echo $Rs['talla_overol15'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato15" readonly value="<?php echo $Rs['talla_zapato15'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota15" readonly value="<?php echo $Rs['talla_bota15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa15" readonly value="<?php echo $Rs['talla_camisa15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon15" readonly value="<?php echo $Rs['talla_pantalon15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco15" readonly value="<?php echo $Rs['talla_chaleco15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata15" readonly value="<?php echo $Rs['talla_bata15'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega15' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega15'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega15" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega15"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre16" readonly value="<?php echo $Rs['nombre16'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol16" readonly value="<?php echo $Rs['talla_overol16'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato16" readonly value="<?php echo $Rs['talla_zapato16'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota16" readonly value="<?php echo $Rs['talla_bota16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa16" readonly value="<?php echo $Rs['talla_camisa16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon16" readonly value="<?php echo $Rs['talla_pantalon16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco16" readonly value="<?php echo $Rs['talla_chaleco16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata16" readonly value="<?php echo $Rs['talla_bata16'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega16' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega16'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega16" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega16"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre17" readonly value="<?php echo $Rs['nombre17'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol17" readonly value="<?php echo $Rs['talla_overol17'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato17" readonly value="<?php echo $Rs['talla_zapato17'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota17" readonly value="<?php echo $Rs['talla_bota17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa17" readonly value="<?php echo $Rs['talla_camisa17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon17" readonly value="<?php echo $Rs['talla_pantalon17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco17" readonly value="<?php echo $Rs['talla_chaleco17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata17" readonly value="<?php echo $Rs['talla_bata17'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega17' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega17'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega17" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega17"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre18" readonly value="<?php echo $Rs['nombre18'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol18" readonly value="<?php echo $Rs['talla_overol18'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato18" readonly value="<?php echo $Rs['talla_zapato18'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota18" readonly value="<?php echo $Rs['talla_bota18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa18" readonly value="<?php echo $Rs['talla_camisa18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon18" readonly value="<?php echo $Rs['talla_pantalon18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco18" readonly value="<?php echo $Rs['talla_chaleco18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata18" readonly value="<?php echo $Rs['talla_bata18'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega18' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega18'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega18" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega18"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre19" readonly value="<?php echo $Rs['nombre19'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol19" readonly value="<?php echo $Rs['talla_overol19'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato19" readonly value="<?php echo $Rs['talla_zapato19'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota19" readonly value="<?php echo $Rs['talla_bota19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa19" readonly value="<?php echo $Rs['talla_camisa19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon19" readonly value="<?php echo $Rs['talla_pantalon19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco19" readonly value="<?php echo $Rs['talla_chaleco19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata19" readonly value="<?php echo $Rs['talla_bata19'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega19' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega19'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega19" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega19"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre20" readonly value="<?php echo $Rs['nombre20'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol20" readonly value="<?php echo $Rs['talla_overol20'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato20" readonly value="<?php echo $Rs['talla_zapato20'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota20" readonly value="<?php echo $Rs['talla_bota20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa20" readonly value="<?php echo $Rs['talla_camisa20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon20" readonly value="<?php echo $Rs['talla_pantalon20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco20" readonly value="<?php echo $Rs['talla_chaleco20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata20" readonly value="<?php echo $Rs['talla_bata20'];?>">
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega20' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['estatus_entrega20'];?></option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega20" type="date" class="form-control input-sm" readonly value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega20"]));?> >
  							</div>
                        </div><br>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Supervisor</label>
                                <textarea  name="observaciones_sup" class="form-control " readonly><?php echo $Rs['observaciones_sup'];?></textarea>
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
                                <label class="control-label">Observaciones Almacén</label>
                                <textarea  name="observaciones_almacen" class="form-control " readonly><?php echo $Rs['observaciones_almacen'];?> </textarea>
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