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

  use PHPMailer\PHPMailer\PHPMailer;
  require_once('../../../autoload.php');
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
                            <li><a href="historial_ni">Nuevo Ingreso</a></li>
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
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Modificar Pedido Nuevo Ingreso de EPP</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
                    $fecha_hoy = date('Y-m-d');
                    if(isset($_POST["aut1s"])) {
                            $query = "UPDATE epp_ni SET fecha='".$fecha_hoy."',autorizado_almacen='Autorizado',logistica='Recibido para Abastecimiento',observaciones_almacen='".$_POST["observaciones_almacen"]."',fecha_autorizado_almacen='".$fecha_hoy."' WHERE folio ='".$_POST["folio"]."'";
                            $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                        
                            echo "<script languaje='javascript'>
                                    alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                        location.href='historial_ni?id=tw_redireccion';
                                </script>";
				    }
                    else if(isset($_POST["aut2s"])) {
                        $query = "UPDATE epp_ni SET autorizado_almacen='No autorizado',observaciones_almacen='".$_POST["observaciones_almacen"]."',fecha_autorizado_almacen='".$fecha_hoy."' WHERE folio ='".$_POST["folio"]."'";
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

                    <form action="modificar_ni" method="post">
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
                                <select name='motivo' class='form-control input-sm'disabled>
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
                                <input name="nombre" type="text" class="form-control input-sm" value="<?php echo $Rs['nombre'];?> "disabled>
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm'disabled>
                                    <option selected><?php echo $Rs['obra'];?></option>
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
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Categoría</i></label>
                                <input name="categoria" type="text" class="form-control input-sm" value="<?php echo $Rs['puesto'];?> "disabled>
                            </div>
						</div>
                        <div class="row form-horizontal">
  							<div class="col-xs-2">
                				<label class="control-label blue-distinct"><i>Talla Calzado</i></label>
    							<input class="form-control input-sm" type="text" name="talla_calzado" value="<?php echo $Rs['talla_calzado'];?> "disabled>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label blue-distinct"><i>Talla Camisa</i></label>
    							<input class="form-control input-sm" type="text" name="talla_camisa" value="<?php echo $Rs['talla_camisa'];?> "disabled>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label blue-distinct"><i>Talla Pantalón</i></label>
    							<input class="form-control input-sm" type="text" name="talla_pantalon" value="<?php echo $Rs['talla_pantalon'];?> "disabled>
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label blue-distinct"><i>Estatura</i></label>
    							<input class="form-control input-sm" type="text" name="estatura" value="<?php echo $Rs['estatura'];?> "disabled>
  							</div>
                            <div class="col-xs-2">
                				<label class="control-label blue-distinct"><i>Peso</i></label>
    							<input class="form-control input-sm" type="text" name="peso" value="<?php echo $Rs['peso'];?> "disabled>
  							</div>
                              <div class="col-xs-2">
                				<label class="control-label blue-distinct"><i>Superficie/Interior</i></label>
    							<select name='sup_int' class='form-control input-sm'disabled>
                                    <option selected><?php echo $Rs['sup_int'];?></option>
                                    <option value="Superficie">Superficie</option>
                                    <option value="Interior Mina">Interior Mina</option>
                                    <option value="N/A">N/A</option>
                                </select>
  							</div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label blue-distinct"><i>Observaciones Supervisor</i></label>
                                <textarea  name="observaciones_sup" class="form-control "disabled><?php echo $Rs['observaciones_sup'];?></textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label blue-distinct"><i>Observaciones Almacén</i></label>
                                <textarea  name="observaciones_almacen" class="form-control "><?php echo $Rs['observaciones_almacen'];?></textarea>
                            </div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-2">
                                <input class="btn form-btn btn-success" type="submit" name="aut1s" value="Autorizar">
                            </div>
                            <div class="col-xs-2">
                                <input class="btn form-btn btn-danger" type="submit" name="aut2s" value="No autorizar">
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