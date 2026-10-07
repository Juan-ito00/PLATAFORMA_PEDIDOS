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
        				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Nuevo<b class="caret"></b>
          				</a>
          				<ul class="dropdown-menu">
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
        	<div align="center" class="panel-heading">Modificar Pedido Trimestral de EPP</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
                    if(isset($_POST["aut1r"])) {
                        $query = "UPDATE epp_tr SET autorizado_residente='Autorizado',observaciones_res='".$_POST["observaciones_res"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_tr?id=tw_redireccion';
                            </script>";
				    }
                    else if(isset($_POST["aut2r"])) {
                        $query = "UPDATE epp_tr SET autorizado_residente='No autorizado',observaciones_res='".$_POST["observaciones_res"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_tr?id=tw_redireccion';
                            </script>";
				    }
                    else if(isset($_POST["aut1go"])) {
                        $query = "UPDATE epp_tr SET autorizado_gerob='Autorizado',observaciones_gerob='".$_POST["observaciones_gerob"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_tr?id=tw_redireccion';
                            </script>";
				    }
                    else if(isset($_POST["aut2go"])) {
                        $query = "UPDATE epp_tr SET autorizado_gerob='No autorizado',observaciones_gerob='".$_POST["observaciones_gerob"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_tr?id=tw_redireccion';
                            </script>";
				    }
                    else {
						$id_pedido=$_GET['id_pedido'];
						$sql_query="SELECT * FROM epp_tr WHERE id='".$id_pedido."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
                                if($_SESSION['user_epp'] == "res") { ?>

                                    <form action="modificar_tr" method="post">
                                         <div class="row form-horizontal">
                                            <div class="col-xs-2">
                                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?>" >
                                            </div>
                                            <div class="col-xs-3">
                                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm"  value="<?php echo $Rs['supervisor_sol']; ?>">
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
                                            <div class="col-xs-2">
                                                <label class="control-label">Cantidad Unidad</label>
                                                <input class="form-control input-sm" type="text" name="cant_unid1" readonly value="<?php echo $Rs['cant_unid1'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <label class="control-label">Descripcion</label>
                                                <input class="form-control input-sm" type="text" name="desc1" readonly value="<?php echo $Rs['desc1'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <label class="control-label">Código</label>
                                                <input class="form-control input-sm" type="text" name="codigo1" readonly value="<?php echo $Rs['codigo1'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <label class="control-label">Marca</label>
                                                <input class="form-control input-sm" type="text" name="marca1" readonly value="<?php echo $Rs['marca1'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <label class="control-label">Color</label>
                                                <input class="form-control input-sm" type="text" name="color1" readonly value="<?php echo $Rs['color1'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <label class="control-label">Medidas</label>
                                                <input class="form-control input-sm" type="text" name="medidas1" readonly value="<?php echo $Rs['medidas1'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <label class="control-label">Clase</label>
                                                <input class="form-control input-sm" type="text" name="clase1" readonly value="<?php echo $Rs['clase1'];?>">
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
                                            <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid2" readonly value="<?php echo $Rs['cant_unid2'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc2" readonly value="<?php echo $Rs['desc2'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo2" readonly value="<?php echo $Rs['codigo2'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca2" readonly value="<?php echo $Rs['marca2'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color2" readonly value="<?php echo $Rs['color2'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas2" readonly value="<?php echo $Rs['medidas2'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase2" readonly value="<?php echo $Rs['clase2'];?>">
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
                                            <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid3" readonly value="<?php echo $Rs['cant_unid3'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc3" readonly value="<?php echo $Rs['desc3'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo3" readonly value="<?php echo $Rs['codigo3'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca3" readonly value="<?php echo $Rs['marca3'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color3" readonly value="<?php echo $Rs['color3'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas3" readonly value="<?php echo $Rs['medidas3'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase3" readonly value="<?php echo $Rs['clase3'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid4" readonly value="<?php echo $Rs['cant_unid4'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc4" readonly value="<?php echo $Rs['desc4'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo4" readonly value="<?php echo $Rs['codigo4'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca4" readonly value="<?php echo $Rs['marca4'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color4" readonly value="<?php echo $Rs['color4'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas4" readonly value="<?php echo $Rs['medidas4'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase4" readonly value="<?php echo $Rs['clase4'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid5" readonly value="<?php echo $Rs['cant_unid5'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc5" readonly value="<?php echo $Rs['desc5'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo5" readonly value="<?php echo $Rs['codigo5'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca5" readonly value="<?php echo $Rs['marca5'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color5" readonly value="<?php echo $Rs['color5'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas5" readonly value="<?php echo $Rs['medidas5'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase5" readonly value="<?php echo $Rs['clase5'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid6" readonly value="<?php echo $Rs['cant_unid6'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc6" readonly value="<?php echo $Rs['desc6'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo6" readonly value="<?php echo $Rs['codigo6'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca6" readonly value="<?php echo $Rs['marca6'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color6" readonly value="<?php echo $Rs['color6'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas6" readonly value="<?php echo $Rs['medidas6'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase6" readonly value="<?php echo $Rs['clase6'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid7" readonly value="<?php echo $Rs['cant_unid7'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc7" readonly value="<?php echo $Rs['desc7'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo7" readonly value="<?php echo $Rs['codigo7'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca7" readonly value="<?php echo $Rs['marca7'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color7" readonly value="<?php echo $Rs['color7'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas7" readonly value="<?php echo $Rs['medidas7'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase7" readonly value="<?php echo $Rs['clase7'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid8" readonly value="<?php echo $Rs['cant_unid8'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc8" readonly value="<?php echo $Rs['desc8'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo8" readonly value="<?php echo $Rs['codigo8'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca8" readonly value="<?php echo $Rs['marca8'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color8" readonly value="<?php echo $Rs['color8'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas8" readonly value="<?php echo $Rs['medidas8'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase8" readonly value="<?php echo $Rs['clase8'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid9" readonly value="<?php echo $Rs['cant_unid9'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc9" readonly value="<?php echo $Rs['desc9'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo9" readonly value="<?php echo $Rs['codigo9'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca9" readonly value="<?php echo $Rs['marca9'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color9" readonly value="<?php echo $Rs['color9'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas9" readonly value="<?php echo $Rs['medidas9'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase9" readonly value="<?php echo $Rs['clase9'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid10" readonly value="<?php echo $Rs['cant_unid10'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc10" readonly value="<?php echo $Rs['desc10'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo10" readonly value="<?php echo $Rs['codigo10'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca10" readonly value="<?php echo $Rs['marca10'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color10" readonly value="<?php echo $Rs['color10'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas10" readonly value="<?php echo $Rs['medidas10'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase10" readonly value="<?php echo $Rs['clase10'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid11" readonly value="<?php echo $Rs['cant_unid11'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc11" readonly value="<?php echo $Rs['desc11'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo11" readonly value="<?php echo $Rs['codigo11'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca11" readonly value="<?php echo $Rs['marca11'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color11" readonly value="<?php echo $Rs['color11'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas11" readonly value="<?php echo $Rs['medidas11'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase11" readonly value="<?php echo $Rs['clase11'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid12" readonly value="<?php echo $Rs['cant_unid12'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc12" readonly value="<?php echo $Rs['desc12'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo12" readonly value="<?php echo $Rs['codigo12'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca12" readonly value="<?php echo $Rs['marca12'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color12" readonly value="<?php echo $Rs['color12'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas12" readonly value="<?php echo $Rs['medidas12'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase12" readonly value="<?php echo $Rs['clase12'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid13" readonly value="<?php echo $Rs['cant_unid13'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc13" readonly value="<?php echo $Rs['desc13'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo13" readonly value="<?php echo $Rs['codigo13'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca13" readonly value="<?php echo $Rs['marca13'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color13" readonly value="<?php echo $Rs['color13'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas13" readonly value="<?php echo $Rs['medidas13'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase13" readonly value="<?php echo $Rs['clase13'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid14" readonly value="<?php echo $Rs['cant_unid14'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc14" readonly value="<?php echo $Rs['desc14'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo14" readonly value="<?php echo $Rs['codigo14'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca14" readonly value="<?php echo $Rs['marca14'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color14" readonly value="<?php echo $Rs['color14'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas14" readonly value="<?php echo $Rs['medidas14'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase14" readonly value="<?php echo $Rs['clase14'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid15" readonly value="<?php echo $Rs['cant_unid15'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc15" readonly value="<?php echo $Rs['desc15'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo15" readonly value="<?php echo $Rs['codigo15'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca15" readonly value="<?php echo $Rs['marca15'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color15" readonly value="<?php echo $Rs['color15'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas15" readonly value="<?php echo $Rs['medidas15'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase15" readonly value="<?php echo $Rs['clase15'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid16" readonly value="<?php echo $Rs['cant_unid16'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc16" readonly value="<?php echo $Rs['desc16'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo16" readonly value="<?php echo $Rs['codigo16'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca16" readonly value="<?php echo $Rs['marca16'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color16" readonly value="<?php echo $Rs['color16'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas16" readonly value="<?php echo $Rs['medidas16'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase16" readonly value="<?php echo $Rs['clase16'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid17" readonly value="<?php echo $Rs['cant_unid17'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc17" readonly value="<?php echo $Rs['desc17'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo17" readonly value="<?php echo $Rs['codigo17'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca17" readonly value="<?php echo $Rs['marca17'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color17" readonly value="<?php echo $Rs['color17'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas17" readonly value="<?php echo $Rs['medidas17'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase17" readonly value="<?php echo $Rs['clase17'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid18" readonly value="<?php echo $Rs['cant_unid18'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc18" readonly value="<?php echo $Rs['desc18'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo18" readonly value="<?php echo $Rs['codigo18'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca18" readonly value="<?php echo $Rs['marca18'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color18" readonly value="<?php echo $Rs['color18'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas18" readonly value="<?php echo $Rs['medidas18'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase18" readonly value="<?php echo $Rs['clase18'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid19" readonly value="<?php echo $Rs['cant_unid19'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc19" readonly value="<?php echo $Rs['desc19'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo19" readonly value="<?php echo $Rs['codigo19'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca19" readonly value="<?php echo $Rs['marca19'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color19" readonly value="<?php echo $Rs['color19'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas19" readonly value="<?php echo $Rs['medidas19'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase19" readonly value="<?php echo $Rs['clase19'];?>">
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
                                        <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="cant_unid20" readonly value="<?php echo $Rs['cant_unid20'];?>">
                                            </div>
                                              <div class="col-xs-4">
                                                <input class="form-control input-sm" type="text" name="desc20" readonly value="<?php echo $Rs['desc20'];?>"/>
                                              </div>
                                            <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="codigo20" readonly value="<?php echo $Rs['codigo20'];?>">
                                            </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="marca20" readonly value="<?php echo $Rs['marca20'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="color20" readonly value="<?php echo $Rs['color20'];?>">
                                              </div>
                                              <div class="col-xs-2">
                                                <input class="form-control input-sm" type="text" name="medidas20" readonly value="<?php echo $Rs['medidas20'];?>">
                                              </div>
                                              <div class="col-xs-1">
                                                <input class="form-control input-sm" type="text" name="clase20" readonly value="<?php echo $Rs['clase20'];?>">
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
                                                <label class="control-label">Observaciones</label>
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

                    <form action="modificar_tr" method="post">
             			<div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?>" >
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm"  value="<?php echo $Rs['supervisor_sol']; ?>">
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
                            <div class="col-xs-2">
                                <label class="control-label">Cantidad Unidad</label>
    							<input class="form-control input-sm" type="text" name="cant_unid1" readonly value="<?php echo $Rs['cant_unid1'];?>">
                            </div>
  							<div class="col-xs-4">
                                <label class="control-label">Descripcion</label>
                                <input class="form-control input-sm" type="text" name="desc1" readonly value="<?php echo $Rs['desc1'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <label class="control-label">Código</label>
                                <input class="form-control input-sm" type="text" name="codigo1" readonly value="<?php echo $Rs['codigo1'];?>">
                            </div>
  							<div class="col-xs-1">
                				<label class="control-label">Marca</label>
    							<input class="form-control input-sm" type="text" name="marca1" readonly value="<?php echo $Rs['marca1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">Color</label>
    							<input class="form-control input-sm" type="text" name="color1" readonly value="<?php echo $Rs['color1'];?>">
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Medidas</label>
    							<input class="form-control input-sm" type="text" name="medidas1" readonly value="<?php echo $Rs['medidas1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">Clase</label>
    							<input class="form-control input-sm" type="text" name="clase1" readonly value="<?php echo $Rs['clase1'];?>">
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
                            <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid2" readonly value="<?php echo $Rs['cant_unid2'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc2" readonly value="<?php echo $Rs['desc2'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo2" readonly value="<?php echo $Rs['codigo2'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca2" readonly value="<?php echo $Rs['marca2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color2" readonly value="<?php echo $Rs['color2'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas2" readonly value="<?php echo $Rs['medidas2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase2" readonly value="<?php echo $Rs['clase2'];?>">
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
                            <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid3" readonly value="<?php echo $Rs['cant_unid3'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc3" readonly value="<?php echo $Rs['desc3'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo3" readonly value="<?php echo $Rs['codigo3'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca3" readonly value="<?php echo $Rs['marca3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color3" readonly value="<?php echo $Rs['color3'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas3" readonly value="<?php echo $Rs['medidas3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase3" readonly value="<?php echo $Rs['clase3'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid4" readonly value="<?php echo $Rs['cant_unid4'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc4" readonly value="<?php echo $Rs['desc4'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo4" readonly value="<?php echo $Rs['codigo4'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca4" readonly value="<?php echo $Rs['marca4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color4" readonly value="<?php echo $Rs['color4'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas4" readonly value="<?php echo $Rs['medidas4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase4" readonly value="<?php echo $Rs['clase4'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid5" readonly value="<?php echo $Rs['cant_unid5'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc5" readonly value="<?php echo $Rs['desc5'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo5" readonly value="<?php echo $Rs['codigo5'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca5" readonly value="<?php echo $Rs['marca5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color5" readonly value="<?php echo $Rs['color5'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas5" readonly value="<?php echo $Rs['medidas5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase5" readonly value="<?php echo $Rs['clase5'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid6" readonly value="<?php echo $Rs['cant_unid6'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc6" readonly value="<?php echo $Rs['desc6'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo6" readonly value="<?php echo $Rs['codigo6'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca6" readonly value="<?php echo $Rs['marca6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color6" readonly value="<?php echo $Rs['color6'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas6" readonly value="<?php echo $Rs['medidas6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase6" readonly value="<?php echo $Rs['clase6'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid7" readonly value="<?php echo $Rs['cant_unid7'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc7" readonly value="<?php echo $Rs['desc7'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo7" readonly value="<?php echo $Rs['codigo7'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca7" readonly value="<?php echo $Rs['marca7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color7" readonly value="<?php echo $Rs['color7'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas7" readonly value="<?php echo $Rs['medidas7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase7" readonly value="<?php echo $Rs['clase7'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid8" readonly value="<?php echo $Rs['cant_unid8'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc8" readonly value="<?php echo $Rs['desc8'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo8" readonly value="<?php echo $Rs['codigo8'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca8" readonly value="<?php echo $Rs['marca8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color8" readonly value="<?php echo $Rs['color8'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas8" readonly value="<?php echo $Rs['medidas8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase8" readonly value="<?php echo $Rs['clase8'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid9" readonly value="<?php echo $Rs['cant_unid9'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc9" readonly value="<?php echo $Rs['desc9'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo9" readonly value="<?php echo $Rs['codigo9'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca9" readonly value="<?php echo $Rs['marca9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color9" readonly value="<?php echo $Rs['color9'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas9" readonly value="<?php echo $Rs['medidas9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase9" readonly value="<?php echo $Rs['clase9'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid10" readonly value="<?php echo $Rs['cant_unid10'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc10" readonly value="<?php echo $Rs['desc10'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo10" readonly value="<?php echo $Rs['codigo10'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca10" readonly value="<?php echo $Rs['marca10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color10" readonly value="<?php echo $Rs['color10'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas10" readonly value="<?php echo $Rs['medidas10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase10" readonly value="<?php echo $Rs['clase10'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid11" readonly value="<?php echo $Rs['cant_unid11'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc11" readonly value="<?php echo $Rs['desc11'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo11" readonly value="<?php echo $Rs['codigo11'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca11" readonly value="<?php echo $Rs['marca11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color11" readonly value="<?php echo $Rs['color11'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas11" readonly value="<?php echo $Rs['medidas11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase11" readonly value="<?php echo $Rs['clase11'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid12" readonly value="<?php echo $Rs['cant_unid12'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc12" readonly value="<?php echo $Rs['desc12'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo12" readonly value="<?php echo $Rs['codigo12'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca12" readonly value="<?php echo $Rs['marca12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color12" readonly value="<?php echo $Rs['color12'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas12" readonly value="<?php echo $Rs['medidas12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase12" readonly value="<?php echo $Rs['clase12'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid13" readonly value="<?php echo $Rs['cant_unid13'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc13" readonly value="<?php echo $Rs['desc13'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo13" readonly value="<?php echo $Rs['codigo13'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca13" readonly value="<?php echo $Rs['marca13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color13" readonly value="<?php echo $Rs['color13'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas13" readonly value="<?php echo $Rs['medidas13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase13" readonly value="<?php echo $Rs['clase13'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid14" readonly value="<?php echo $Rs['cant_unid14'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc14" readonly value="<?php echo $Rs['desc14'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo14" readonly value="<?php echo $Rs['codigo14'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca14" readonly value="<?php echo $Rs['marca14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color14" readonly value="<?php echo $Rs['color14'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas14" readonly value="<?php echo $Rs['medidas14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase14" readonly value="<?php echo $Rs['clase14'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid15" readonly value="<?php echo $Rs['cant_unid15'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc15" readonly value="<?php echo $Rs['desc15'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo15" readonly value="<?php echo $Rs['codigo15'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca15" readonly value="<?php echo $Rs['marca15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color15" readonly value="<?php echo $Rs['color15'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas15" readonly value="<?php echo $Rs['medidas15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase15" readonly value="<?php echo $Rs['clase15'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid16" readonly value="<?php echo $Rs['cant_unid16'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc16" readonly value="<?php echo $Rs['desc16'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo16" readonly value="<?php echo $Rs['codigo16'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca16" readonly value="<?php echo $Rs['marca16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color16" readonly value="<?php echo $Rs['color16'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas16" readonly value="<?php echo $Rs['medidas16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase16" readonly value="<?php echo $Rs['clase16'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid17" readonly value="<?php echo $Rs['cant_unid17'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc17" readonly value="<?php echo $Rs['desc17'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo17" readonly value="<?php echo $Rs['codigo17'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca17" readonly value="<?php echo $Rs['marca17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color17" readonly value="<?php echo $Rs['color17'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas17" readonly value="<?php echo $Rs['medidas17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase17" readonly value="<?php echo $Rs['clase17'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid18" readonly value="<?php echo $Rs['cant_unid18'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc18" readonly value="<?php echo $Rs['desc18'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo18" readonly value="<?php echo $Rs['codigo18'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca18" readonly value="<?php echo $Rs['marca18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color18" readonly value="<?php echo $Rs['color18'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas18" readonly value="<?php echo $Rs['medidas18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase18" readonly value="<?php echo $Rs['clase18'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid19" readonly value="<?php echo $Rs['cant_unid19'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc19" readonly value="<?php echo $Rs['desc19'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo19" readonly value="<?php echo $Rs['codigo19'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca19" readonly value="<?php echo $Rs['marca19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color19" readonly value="<?php echo $Rs['color19'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas19" readonly value="<?php echo $Rs['medidas19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase19" readonly value="<?php echo $Rs['clase19'];?>">
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
                        <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="cant_unid20" readonly value="<?php echo $Rs['cant_unid20'];?>">
                            </div>
  							<div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc20" readonly value="<?php echo $Rs['desc20'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo20" readonly value="<?php echo $Rs['codigo20'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="marca20" readonly value="<?php echo $Rs['marca20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="color20" readonly value="<?php echo $Rs['color20'];?>">
  							</div>
                              <div class="col-xs-2">
    							<input class="form-control input-sm" type="text" name="medidas20" readonly value="<?php echo $Rs['medidas20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="clase20" readonly value="<?php echo $Rs['clase20'];?>">
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
                                <label class="control-label">Observaciones</label>
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