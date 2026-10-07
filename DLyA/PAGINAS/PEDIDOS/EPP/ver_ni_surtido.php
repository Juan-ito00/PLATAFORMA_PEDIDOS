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
        .almacen-fields {
            background-color: #a7e7d5;
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
                        <li><a href="historial_ni">Nuevo Ingreso</a></li>
                        </ul>
                    </li>
      			</ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
      			</ul>
    		</div>
        </nav>
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Modificar Pedido Nuevo Ingreso de EPP</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
                    if(isset($_POST["aut1su"])) {
                        $query = "UPDATE epp_ni SET estatus_entrega='".$_POST["e_entrega1"]."',fecha_entrega='".$_POST["f_entrega1"]."',obal1='".$_POST["obal1"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_ni?id=tw_redireccion';
                            </script>";
				    }
                    else {
						$id_pedido=$_GET['id_pedido'];
						$sql_query="SELECT * FROM epp_ni WHERE id='".$id_pedido."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {?>
                            <form action="ver_ni_surtido" method="post">
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
                                        <select name='motivo' class='form-control input-sm' readonly>
                                            <option selected ><?php echo $Rs['motivo'];?></option>
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
                                        <input name="nombre" type="text" class="form-control input-sm" value="<?php echo $Rs['nombre'];?> "readonly>
                                    </div>
                                    <div class="col-xs-4">
                                        <label class="control-label blue-distinct"><i>Obra</i></label>
                                        <select name='obra' class='form-control input-sm' readonly>
                                            <option selected><?php echo $Rs['obra'];?></option>
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
                                    <div class="col-xs-4">
                                        <label class="control-label blue-distinct"><i>Categoría</i></label>
                                        <input name="categoria" type="text" class="form-control input-sm" value="<?php echo $Rs['puesto'];?> "readonly>
                                    </div>
                                </div>
                                <div class="row form-horizontal">
                                    <div class="col-xs-2">
                                        <label class="control-label blue-distinct"><i>Talla Calzado</i></label>
                                        <input class="form-control input-sm" type="text" name="talla_calzado" value="<?php echo $Rs['talla_calzado'];?> "readonly>
                                    </div>
                                    <div class="col-xs-2">
                                        <label class="control-label blue-distinct"><i>Talla Camisa</i></label>
                                        <input class="form-control input-sm" type="text" name="talla_camisa" value="<?php echo $Rs['talla_camisa'];?> "readonly>
                                    </div>
                                    <div class="col-xs-2">
                                        <label class="control-label blue-distinct"><i>Talla Pantalón</i></label>
                                        <input class="form-control input-sm" type="text" name="talla_pantalon" value="<?php echo $Rs['talla_pantalon'];?> "readonly>
                                    </div>
                                    <div class="col-xs-2">
                                        <label class="control-label blue-distinct"><i>Estatura</i></label>
                                        <input class="form-control input-sm" type="text" name="estatura" value="<?php echo $Rs['estatura'];?> "readonly>
                                    </div>
                                    <div class="col-xs-2">
                                        <label class="control-label blue-distinct"><i>Peso</i></label>
                                        <input class="form-control input-sm" type="text" name="peso" value="<?php echo $Rs['peso'];?> "readonly>
                                    </div>
                                    <div class="col-xs-2">
                                        <label class="control-label blue-distinct"><i>Superficie/Interior</i></label>
                                        <select name='sup_int' class='form-control input-sm'readonly>
                                            <option selected><?php echo $Rs['sup_int'];?></option>
                                            <option value="Superficie">Superficie</option>
                                            <option value="Interior Mina">Interior Mina</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="row form-horizontal">
                            <div class="col-xs-2">
                				<label class="control-label">Estatus</label>
    							<select name='e_entrega1' class='form-control input-sm almacen-fields'>
                                    <option selected><?php echo $Rs['estatus_entrega'];?></option>
                                    <option value="En proceso de surtir">En proceso de surtir</option>
                                    <option value="Surtido parcial">Surtido parcial</option>
                                    <option value="En almacén">En almacén</option>
                                    <option value="Surtido">Surtido</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
  							</div>
                            <div class="col-xs-8">
                				<label class="control-label green-distinct">Observaciones del Almacén</label>
    							<input class="form-control input-sm resaltado almacen-fields" type="text" name="obal1" id="obal1" value="<?php echo $Rs['obal1'];?>">
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label">Fecha Estatus</label>
    							<input name="f_entrega1" type="date" class="form-control input-sm almacen-fields" value=<?php echo strftime('%d-%m-%Y',strtotime($Rs["fecha_entrega"]));?> >
  							</div>
                        </div><br>

                                <div class="row form-horizontal">
                                    <div class="col-xs-8" style="text-align:center;">
                                        <label class="control-label blue-distinct"><i>Observaciones Supervisor</i></label>
                                        <textarea  name="observaciones_sup" class="form-control "readonly><?php echo $Rs['observaciones_sup'];?></textarea>
                                    </div>
                                </div>
                                <div class="row form-horizontal">
                                    <div class="col-xs-8" style="text-align:center;">
                                        <label class="control-label blue-distinct"><i>Observaciones Almacén</i></label>
                                        <textarea  name="observaciones_almacen" class="form-control " disabled><?php echo $Rs['observaciones_almacen'];?></textarea>
                                    </div>
                                </div><br><br>
                                <div class="row form-horizontal">
                            <div class="col-xs-5">
                                
                            </div><div class="col-xs-2">
    <input class="btn form-btn btn-success" type="submit" name="aut1su" value="Guardar">
</div>
                        </div>
                            </form>
                                            <?php
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