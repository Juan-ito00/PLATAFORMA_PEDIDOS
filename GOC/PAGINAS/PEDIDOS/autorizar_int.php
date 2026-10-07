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
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Autorizar Pedido</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<!--Barra de titulo-->
	<nav class="navbar navbar-inverse" role="navigation">
 		<p align="center" style="color: white; margin-top: 12px; font-size: 18px;">SISTEMA DE PEDIDOS</p>
  	</nav>
    <!--Barra de pie de pagina
  	<nav class="navbar navbar-inverse navbar-fixed-bottom">
  		<div align="center"><img class="img-responsive" height="55" width="165" src="../img/cavi.png"> </img></div>
  	</nav>-->
    <!--Contenedor donde va todo el contenido de la pagina-->
   	<div class="container" style="padding-top: 1px;">
    
    	<!--Menu horizontal de la parte superior-->
  		<nav class="navbar navbar-default nav" style="margin-top:5px;" role="navigation">
    	<!-- El logotipo y el icono que despliega el menú se agrupan
        para mostrarlos mejor en los dispositivos móviles -->
   			<div class="navbar-header">
      			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        			<span class="sr-only">Desplegar navegación</span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
      			</button>
      			<a class="navbar-brand" href="inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
    		</div>
  			<!-- Agrupar los enlaces de navegación, los formularios y cualquier
         	otro elemento que se pueda ocultar al minimizar la barra -->
    		<div class="collapse navbar-collapse navbar-ex1-collapse">
      			<ul class="nav navbar-nav">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="historial_gerencia">Compras</a></li>
                    <li><a href="historial_gerencia_int">Servicios Internos</a></li>
                    <li><a href="historial_mtto">Mantenimientos</a></li>
                  </ul>
              </li>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"> </span> Reporte<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="reporte_general_g">General Compras</a></li>
                    <li><a href="reporte_general_g_int">General Servicios Internos</a></li>
                    <li><a href="reporte_obra">Por Obra Compras</a></li>
                    <li><a href="reporte_obra_int">Por Obra Servicios</a></li>
                  </ul>
              </li>
            </ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".$_SESSION['usuario']." ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Autorizar Pedido</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
 					if(isset($_POST["submit"]))
 					{
						$query = "UPDATE pedidos_int SET autorizado='Autorizado', notas_autorizacion='".$_POST['notas_autorizacion']."' WHERE id_pedido='".$_POST["id"]."' AND gerencia='GOC'";
						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
					
						echo "<script languaje='javascript'>
  									alert('Se ha autorizado el pedido con folio ".$_POST["folio"]."')
				location.href='historial_gerencia_int?id=tw_redireccion';
			  					</script>";

				}
				else if(isset($_POST["submit2"]))
 					{
						$query = "UPDATE pedidos_int SET autorizado='No Autorizado', notas_autorizacion='".$_POST['notas_autorizacion']."' WHERE id_pedido='".$_POST["id"]."' AND gerencia='GOC'";
						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
					
						echo "<script languaje='javascript'>
  									alert('No se ha autorizado el pedido con folio ".$_POST["folio"]."')
				location.href='historial_gerencia_int?id=tw_redireccion';
			  					</script>";

				}
        else
        {
            $id_pedido=$_GET['id_pedido'];
            $sql_query="SELECT * FROM pedidos_int WHERE id_pedido='".$id_pedido."' AND gerencia='GOC'";
            $resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
            if(mysql_num_rows($resultado) > 0){
              while($Rs=mysql_fetch_array($resultado)) {
        ?>
                      <form method="post" name=frm action="autorizar_int">
                      <div class="row form-horizontal"> 
                     <!--Tipo de Compra-->
                      <div class="col-xs-2">
                        <label class="control-label" for="tipo_compra">Tipo de Servicio</label>
                        <input class="form-control input-sm" readonly name="tipo_servicio" type="text" value="<?php echo $Rs['tipo_servicio']; ?>"  size="17" />
                      </div>
                      <div class="col-xs-6"></div>
                      <div class="col-xs-2">
                        <input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id_pedido']; ?>" size="17" />
                      </div>
                      <div class="col-xs-2">
                      <label class="control-label" for="folio">Folio</label>
                          <input name="folio" readonly type="text" class="form-control input-sm" required value="<?php echo $Rs['folio']; ?>" size="17" />
                  </div>
                </div>
                <div class="row form-horizontal">
                  <div class="col-xs-2">
                    <label class="control-label" for="fecha">Fecha</label>
                        <input class="form-control input-sm" name="fecha_solicitud" type="date" readonly required value="<?php echo $Rs['fecha_solicitud']; ?>" size="15" />
                    </div>
                    <div class="col-xs-5">
                      <label class="control-label" for="proyecto">Proyecto</label>
                              <?php
                  mysql_query("SET NAMES 'UTF8'");
                  $consulta_mysql='select * from obras ORDER BY nombre ASC';
                  $resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
                  echo "<select name='proyecto' disabled class='form-control input-sm'>";
                  echo "<option> {$Rs['proyecto']}</option>";
                  while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                      echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
                  }
                  echo "</select>";
                ?>
                      </div>
                    <div class="col-xs-3">
                      <label class="control-label" for="supervisor">Supervisor</label>
                        <input class="form-control input-sm" readonly name="supervisor" type="text" required value="<?php echo $Rs['supervisor']; ?>" size="50" />
                    </div>
                    <div class="col-xs-2">
                      <label class="control-label" for="ubicacion">Ubicación</label>
                      <input class="form-control input-sm" name="ubicacion" readonly type="text" value="<?php echo $Rs['ubicacion']; ?>"  size="17" />
                    </div>   
                    </div>
                  <div class="row form-horizontal">
                <div class="col-xs-8">
                      <label class="control-label" for="descripcion1">Descripción del Servicio</label>
                      <textarea name="servicio1" class="form-control" readonly><?php echo htmlspecialchars($Rs['servicio1']); ?></textarea>
                    </div>
                    <div class="col-xs-4" style="text-align: center;">
                      <label class="control-label" for="rango_fechas">Rango de Fechas</label>
                    </div>
                    <div class="col-xs-2">
                      <input name="fecha_entrega1" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['fecha_entrega1']; ?>"/>
                    </div>
                    <div class="col-xs-2">
                      <input name="fecha_devolucion1" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['fecha_devolucion1']; ?>"/>
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-8">
                      <label class="control-label"></label>
                      <textarea name="servicio2" class="form-control" readonly><?php echo htmlspecialchars($Rs['servicio2']); ?></textarea>
                      </div>
                      <div class="col-xs-4" style="text-align: center;">
                        <label class="control-label"></label>
                      </div>
                      <div class="col-xs-2">
                        <input name="fecha_entrega2" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['fecha_entrega2']; ?>"/>
                      </div>
                      <div class="col-xs-2">
                        <input name="fecha_devolucion2" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['fecha_devolucion2']; ?>"/>
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-8">
                      <label class="control-label"></label>
                      <textarea name="servicio3" class="form-control" readonly><?php echo htmlspecialchars($Rs['servicio3']); ?></textarea>
                      </div>
                      <div class="col-xs-4" style="text-align: center;">
                        <label class="control-label"></label>
                      </div>
                      <div class="col-xs-2">
                        <input name="fecha_entrega3" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['fecha_entrega3']; ?>"/>
                      </div>
                      <div class="col-xs-2">
                        <input name="fecha_devolucion3" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['fecha_devolucion3']; ?>"/>
                    </div>
                    <br>
                  </div>
                  <div class="row form-horizontal">
                  <div class="col-xs-2">
                      <label class="control-label">Notas</label>
                      <textarea name="notas_seguimiento" class="form-control " readonly=""><?php echo htmlspecialchars($Rs['notas_seguimiento']); ?></textarea>
                      </div>
                <div class="col-xs-10 col">
                <label class="control-label">Notas para autorización de pedido</label>
                <textarea  name="notas_autorizacion" class="form-control " maxlength="150" ><?php echo htmlspecialchars($Rs['notas_autorizacion']); ?></textarea>
                </div>
              </div>
              <br>
                  <div id="btn-form">
                    <input class="btn form-btn btn-primary" type="submit" name="submit" value="Autorizar">
                    <input class="btn form-btn btn-primary" type="submit" name="submit2" value="No Autorizar">
                </div>
              </form>
                <?php       
              }
            }
            else
            {
              echo "<script languaje='javascript'>
                  alert('No fue posible realizar la operacion solicitada al pedido con ID".$id_pedido."')
              javascript:history.go(-2)
                    </script>";
            }       
          }
          // Cerramos la conexión
          mysql_close($conexion);
          ?>
               </div>
        </div>
    </div>
   

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>
  </body>
</html>