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
                    <li><a href="historial_gerencia_alm">Pedidos a Almacén</a></li>
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
						$query = "UPDATE pedidos_alm SET autorizado='Autorizado' WHERE id_pedido='".$_POST["id_pedido"]."'";
						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
					
						echo "<script languaje='javascript'>
  									alert('Se ha autorizado el pedido con folio ".$_POST["folio_a"]."')
				location.href='historial_gerencia_alm?id=tw_redireccion';
			  					</script>";

				}
				else if(isset($_POST["submit2"]))
 					{
						$query = "UPDATE pedidos_alm SET autorizado='No Autorizado' WHERE id_pedido='".$_POST["id_pedido"]."'";
						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
					
						echo "<script languaje='javascript'>
  									alert('No se ha autorizado el pedido con folio ".$_POST["folio_a"]."')
				location.href='historial_gerencia_alm?id=tw_redireccion';
			  					</script>";

				}
        else
        {
            $id_pedido=$_GET['id_pedido'];
            $sql_query="SELECT * FROM pedidos_alm WHERE id_pedido='".$id_pedido."'";
            $resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
            if(mysql_num_rows($resultado) > 0){
              while($Rs=mysql_fetch_array($resultado)) {
        ?>
          <form method="post" name=frm action="autorizar_alm">
					<div class="row form-horizontal">
						<!--Campo Folio-->
  						<div class="col-xs-2">
                			<label class="control-label">Folio</label>
    						<input readonly align="right" name="folio_a" class="form-control input-sm" value="<?php echo $Rs["folio"]?> " >
  						</div>
  						<!--Campo Supervisor-->
						<div class="col-xs-3">
        				<label class="control-label">Solicitante</label>
						<input readonly name="supervisor_a" type="text" class="form-control input-sm" value="<?php echo $Rs["supervisor"]; ?>">
						</div>
              <!--Campo Proyecto-->
				<div class="col-xs-5">
				<label class="control-label">Proyecto</label>
					<?php
	 					mysql_query("SET NAMES 'UTF8'");
						$consulta_mysql='select * from obras ORDER BY nombre ASC';
						$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
							echo "<select name='proyecto_a' class='form-control input-sm' disabled>";
						while($fila=mysql_fetch_array($resultado_consulta_mysql)){
							echo "<option value='".$fila['nombre']."'>".$Rs['proyecto']."</option>";
						}
						echo "</select>";
					?>
				</div>
        <div class="col-xs-2">
            <input type="hidden" name="id_pedido" class="form-control input-sm" value="<?php echo $Rs["id_pedido"]?> " >
          </div>
        </div>
						<!--divs cantidad unidad descripcion-->
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
                				<label class="control-label">Cantidad</label>
								<input name="cantidad1_a" type="text" class="form-control input-sm" readonly value="<?php echo $Rs["cant1"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
               	  				<label class="control-label">Unidad</label>
    							<input type="text" name="unidad1_a" class="form-control input-sm" readonly value="<?php echo $Rs["unid1"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
                				<label class="control-label">Descripcion</label>
    							<input type="text" class="form-control input-sm" name="descripcion1_a" readonly value="<?php echo $Rs["desc1"]; ?>">
  							</div>
                <!--Campo Código-->
                <div class="col-xs-3">
                        <label class="control-label">Código</label>
                  <input type="text" class="form-control input-sm" name="codigo1" readonly value="<?php echo $Rs["codigo1"]; ?>">
                </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad2_a" readonly value="<?php echo $Rs["cant2"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad2_a" readonly value="<?php echo $Rs["unid2"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion2_a" readonly value="<?php echo $Rs["desc2"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo2" readonly value="<?php echo $Rs["codigo2"]; ?>">
              </div>
					</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad3_a" readonly value="<?php echo $Rs["cant3"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad3_a" readonly value="<?php echo $Rs["unid3"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion3_a" readonly value="<?php echo $Rs["desc3"]; ?>">
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo3" readonly value="<?php echo $Rs["codigo3"]; ?>">
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad4_a" readonly value="<?php echo $Rs["cant4"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad4_a" readonly value="<?php echo $Rs["unid4"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion4_a" readonly value="<?php echo $Rs["desc4"]; ?>">
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo4" readonly value="<?php echo $Rs["codigo4"]; ?>">
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad5_a" readonly value="<?php echo $Rs["cant5"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad5_a" readonly value="<?php echo $Rs["unid5"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion5_a" readonly value="<?php echo $Rs["desc5"]; ?>">
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo5" readonly value="<?php echo $Rs["codigo5"]; ?>">
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad6_a" readonly value="<?php echo $Rs["cant6"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad6_a" readonly value="<?php echo $Rs["unid6"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion6_a" readonly value="<?php echo $Rs["desc6"]; ?>">
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo6" readonly value="<?php echo $Rs["codigo6"]; ?>">
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad7_a" readonly value="<?php echo $Rs["cant7"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad7_a" readonly value="<?php echo $Rs["unid7"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion7_a" readonly value="<?php echo $Rs["desc7"]; ?>">
							</div>
              <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo7" readonly value="<?php echo $Rs["codigo7"]; ?>">
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
								<input type="text" class="form-control input-sm" name="cantidad8_a" readonly value="<?php echo $Rs["cant8"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad8_a" readonly value="<?php echo $Rs["unid8"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion8_a" readonly value="<?php echo $Rs["desc8"]; ?>">
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo8" readonly value="<?php echo $Rs["codigo8"]; ?>">
              </div>
						</div>
						<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad9_a" readonly value="<?php echo $Rs["cant9"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad9_a" readonly value="<?php echo $Rs["unid9"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion9_a" readonly value="<?php echo $Rs["desc9"]; ?>">
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo9" readonly value="<?php echo $Rs["codigo9"]; ?>">
              </div>	
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
								<input type="text" class="form-control input-sm" name="cantidad10_a" readonly value="<?php echo $Rs["cant10"]; ?>">
							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad10_a" readonly value="<?php echo $Rs["unid10"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion10_a" readonly value="<?php echo $Rs["desc10"]; ?>">
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo10" readonly value="<?php echo $Rs["codigo10"]; ?>">
              </div>
						</div>
           		 		<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad11_a" readonly value="<?php echo $Rs["cant11"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad11_a" readonly value="<?php echo $Rs["unid11"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion11_a" readonly value="<?php echo $Rs["desc11"]; ?>">
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo11" readonly value="<?php echo $Rs["codigo11"]; ?>">
              </div>
						</div>
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad12_a" readonly value="<?php echo $Rs["cant12"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad12_a" readonly value="<?php echo $Rs["unid12"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    							<input type="text" class="form-control input-sm" name="descripcion12_a" readonly value="<?php echo $Rs["desc12"]; ?>">
  							</div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo12" readonly value="<?php echo $Rs["codigo12"]; ?>">
              </div>
						</div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad13_a" readonly value="<?php echo $Rs["cant13"]; ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad13_a" readonly value="<?php echo $Rs["unid13"]; ?>">
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion13_a" readonly value="<?php echo $Rs["desc13"]; ?>">
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo13" readonly value="<?php echo $Rs["codigo13"]; ?>">
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad14_a" readonly value="<?php echo $Rs["cant14"]; ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad14_a" readonly value="<?php echo $Rs["unid14"]; ?>">
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion14_a" readonly value="<?php echo $Rs["desc14"]; ?>">
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo14" readonly value="<?php echo $Rs["codigo14"]; ?>">
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad15_a" readonly value="<?php echo $Rs["cant15"]; ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad15_a" readonly value="<?php echo $Rs["unid15"]; ?>">
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion15_a" readonly value="<?php echo $Rs["desc15"]; ?>">
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo15" readonly value="<?php echo $Rs["codigo15"]; ?>">
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad16_a" readonly value="<?php echo $Rs["cant16"]; ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad16_a" readonly value="<?php echo $Rs["unid16"]; ?>">
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion16_a" readonly value="<?php echo $Rs["desc16"]; ?>">
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo16" readonly value="<?php echo $Rs["codigo16"]; ?>">
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad17_a" readonly value="<?php echo $Rs["cant17"]; ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad17_a" readonly value="<?php echo $Rs["unid17"]; ?>">
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion17_a" readonly value="<?php echo $Rs["desc17"]; ?>">
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo17" readonly value="<?php echo $Rs["codigo17"]; ?>">
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad18_a" readonly value="<?php echo $Rs["cant18"]; ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad18_a" readonly value="<?php echo $Rs["unid18"]; ?>">
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion18_a" readonly value="<?php echo $Rs["desc18"]; ?>">
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo18" readonly value="<?php echo $Rs["codigo18"]; ?>">
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad19_a" readonly value="<?php echo $Rs["cant19"]; ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad19_a" readonly value="<?php echo $Rs["unid19"]; ?>">
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion19_a" readonly value="<?php echo $Rs["desc19"]; ?>">
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo19" readonly value="<?php echo $Rs["codigo19"]; ?>">
              </div>
            </div>
            <div class="row form-horizontal">
              <!--Campo Cantidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="cantidad20_a" readonly value="<?php echo $Rs["cant20"]; ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" class="form-control input-sm" name="unidad20_a" readonly value="<?php echo $Rs["unid20"]; ?>">
                </div>
              <!--Campo Descripcion-->
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion20_a" readonly value="<?php echo $Rs["desc20"]; ?>">
                </div>
                <!--Campo codigo-->
                <div class="col-xs-3 col">
                <input type="text" class="form-control input-sm" name="codigo20" readonly value="<?php echo $Rs["codigo20"]; ?>">
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