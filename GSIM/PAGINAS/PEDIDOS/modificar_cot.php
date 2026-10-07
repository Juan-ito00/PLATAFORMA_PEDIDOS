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

  use PHPMailer\PHPMailer\PHPMailer;
  require_once('../../autoload.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modificar Pedido</title>
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
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".$_SESSION['usuario']." ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Modificar Pedido</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
 					if(isset($_POST["submit"])){
            if ($_POST["solicitante"] == $_SESSION['nombre']) 
            {
              $query = "UPDATE cotizaciones SET estado='Enviado', tipo_cotizacion='".$_POST["tipo_cotizacion"]."', fecha_requerido='".$_POST["fecha_requerido"]."', ubicacion_obra='".$_POST["ubicacion_obra"]."', lugar_cotizacion='".$_POST["lugar_cotizacion"]."', proyecto='".$_POST["proyecto"]."', desc1='".$_POST["descripcion1"]."', unid1='".$_POST["unidad1"]."', desc2='".$_POST["descripcion2"]."', unid2='".$_POST["unidad2"]."', desc3='".$_POST["descripcion3"]."', unid3='".$_POST["unidad3"]."', desc4='".$_POST["descripcion4"]."', unid4='".$_POST["unidad4"]."', desc5='".$_POST["descripcion5"]."', unid5='".$_POST["unidad5"]."', desc6='".$_POST["descripcion6"]."', unid6='".$_POST["unidad6"]."', desc7='".$_POST["descripcion7"]."', unid7='".$_POST["unidad7"]."', desc8='".$_POST["descripcion8"]."', unid8='".$_POST["unidad8"]."', desc9='".$_POST["descripcion9"]."', unid9='".$_POST["unidad9"]."', desc10='".$_POST["descripcion10"]."', unid10='".$_POST["unidad10"]."', desc11='".$_POST["descripcion11"]."', unid11='".$_POST["unidad11"]."', desc12='".$_POST["descripcion12"]."', unid12='".$_POST["unidad12"]."', desc13='".$_POST["descripcion13"]."', unid13='".$_POST["unidad13"]."', desc14='".$_POST["descripcion14"]."', unid14='".$_POST["unidad14"]."', desc15='".$_POST["descripcion15"]."', unid15='".$_POST["unidad15"]."', desc16='".$_POST["descripcion16"]."', unid16='".$_POST["unidad16"]."', desc17='".$_POST["descripcion17"]."', unid17='".$_POST["unidad17"]."', desc18='".$_POST["descripcion18"]."', unid18='".$_POST["unidad18"]."', desc19='".$_POST["descripcion19"]."', unid19='".$_POST["unidad19"]."', desc20='".$_POST["descripcion20"]."', unid20='".$_POST["unidad20"]."', notas='".$_POST["notas"]."' WHERE id_pedido='".$_POST["id"]."'";
            $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
          
            echo "<script languaje='javascript'>
                    alert('Se han modificado los datos del pedido con folio ".$_POST["folio_gerencia"]."')
        location.href='historial_cot?id=tw_redireccion';
                  </script>";
            }
            else
            {
              echo "<script languaje='javascript'>
                    alert('No tienes autorización para realizar esta acción')
        location.href='historial_cot?id=tw_redireccion';
                  </script>";
            }
						

				}
        else {
						$id_pedido=$_GET['id_pedido'];
						$sql_query="SELECT * FROM cotizaciones WHERE id_pedido='".$id_pedido."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
				?>
            	<form method="post" name=frm action="modificar_cot">
         				<div class="row form-horizontal">
              <!--Campo Tipo de Compra-->
              <div class="col-xs-3">
                <label class="control-label">Tipo de Cotización</label>
                <select name="tipo_cotizacion" class="form-control input-sm ">
                  <option class="form-control input-sm"><?php echo $Rs['tipo_cotizacion']; ?></option>
                  <option value="Exámenes Médicos" class="form-control input-sm" id="" >Exámenes Médicos</option>
                  <option value="Materiales" class="form-control input-sm" >Materiales</option>
                  <option value="EPP" class="form-control input-sm" >EPP</option>
                  <option value="Herramientas" class="form-control input-sm" >Herramientas</option>
                  <option value="Alimentos" class="form-control input-sm" >Alimentos</option>
                  <option value="Hospedaje" class="form-control input-sm" >Hospedaje</option>
                  <option value="Equipos" class="form-control input-sm" >Equipos</option>
                </select>
              </div>
              <div class="col-xs-2">
                <label class="control-label">Fecha Requerida</label>
                <input name="fecha_requerido" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_requerido']; ?>">
              </div>
              <!--Campo Supervisor-->
            <div class="col-xs-3">
                <label class="control-label">Solicitante</label>
            <input readonly name="solicitante" type="text" class="form-control input-sm" value="<?php echo $Rs['solicitante']; ?>">
            </div>
            <!--Campo Folio-->
              <div class="col-xs-2">
                      <label class="control-label">Folio Gerencia</label>
                <input readonly align="right" name="folio_gerencia" class="form-control input-sm" value="<?php echo $Rs['folio_gerencia']; ?>">
              </div>
              <div class="col-xs-2">
                      <label class="control-label">Folio Compras</label>
                <input readonly align="right" name="folio_compras" class="form-control input-sm" value="<?php echo $Rs['folio_compras']; ?>">
              </div>
                  </div>
            <!--Div fecha, proyecto,supervisor, ubicacion-->
            <!--Campo Ubicacion-->
            <div class="row form-horizontal">
              <div class="col-xs-4">
                      <label class="control-label">Ubicación de Obra</label>
                <input name="ubicacion_obra" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['ubicacion_obra']); ?>">
              </div>
            <div class="col-xs-4">
              <label class="control-label">Lugar de Cotización</label>
               <input name="lugar_cotizacion" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['lugar_cotizacion']); ?>">
            </div>
        <div class="col-xs-4">
          <label class="control-label">Proyecto</label>
           <input name="proyecto" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['proyecto']); ?>">
        </div>
            </div>
            <div class="row form-horizontal">
            <div class="col-xs-10">
              <input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id_pedido']; ?>" size="17" />
                  </div>
                </div>
            <!--divs cantidad unidad descripcion-->
                  <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1"><br>
                    <label class="control-label">1.</label>
                  </div>
                <div class="col-xs-5">
                        <label class="control-label">Descripcion</label>
                  <input type="text" class="form-control input-sm" name="descripcion1" value="<?php echo htmlspecialchars($Rs['desc1']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                          <label class="control-label">Unidad</label>
                  <input type="text" name="unidad1" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid1']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">2.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion2" value="<?php echo htmlspecialchars($Rs['desc2']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad2" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid2']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">3.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion3" value="<?php echo htmlspecialchars($Rs['desc3']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad3" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid3']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">4.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion4"value="<?php echo htmlspecialchars($Rs['desc4']); ?>" >
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad4" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid4']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">5.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion5" value="<?php echo htmlspecialchars($Rs['desc5']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad5" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid5']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">6.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion6" value="<?php echo htmlspecialchars($Rs['desc6']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad6" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid6']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">7.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion7" value="<?php echo htmlspecialchars($Rs['desc7']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad7" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid7']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">8.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion8" value="<?php echo htmlspecialchars($Rs['desc8']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad8" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid8']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">9.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion9" value="<?php echo htmlspecialchars($Rs['desc9']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad9" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid9']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">10.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion10" value="<?php echo htmlspecialchars($Rs['desc10']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad10" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid10']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">11.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion11" value="<?php echo htmlspecialchars($Rs['desc11']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad11" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid11']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">12.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion12" value="<?php echo htmlspecialchars($Rs['desc12']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad12" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid12']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">13.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion13" value="<?php echo htmlspecialchars($Rs['desc13']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad13" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid13']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">14.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion14" value="<?php echo htmlspecialchars($Rs['desc14']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad14" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid14']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">15.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion15" value="<?php echo htmlspecialchars($Rs['desc15']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad15" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid15']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">16.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion16" value="<?php echo htmlspecialchars($Rs['desc16']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad16" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid16']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">17.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion17" value="<?php echo htmlspecialchars($Rs['desc17']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad17" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid17']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">18.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion18" value="<?php echo htmlspecialchars($Rs['desc18']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad18" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid18']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">19.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion19" value="<?php echo htmlspecialchars($Rs['desc19']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad19" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid19']); ?>">
                </div>
            </div>
            <div class="row form-horizontal"> 
              <!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">20.</label>
                  </div>
                <div class="col-xs-5">
                  <input type="text" class="form-control input-sm" name="descripcion20" value="<?php echo htmlspecialchars($Rs['desc20']); ?>">
                </div>
              <!--Campo Unidad-->
                <div class="col-xs-2">
                  <input type="text" name="unidad20" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid20']); ?>">
                </div>
            </div>
            <div class="row form-horizontal">
            <!--Caja de notas-->
              <div class="col-xs-12">
                <label class="control-label">Notas</label>
                <textarea  name="notas" class="form-control "><?php echo htmlspecialchars($Rs['notas']); ?></textarea>
              </div>
            </div>
          				<br>
           				<div id="btn-form">
          	 				<input class="btn form-btn btn-primary" type="submit" name="submit" value="Modificar Pedido">
         	 			</div>
        			</form>
                <?php   		
							}
						}else{
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