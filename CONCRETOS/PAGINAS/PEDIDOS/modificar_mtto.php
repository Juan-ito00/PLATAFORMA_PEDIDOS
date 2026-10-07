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
   			<div class="navbar-header">
      			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        			<span class="sr-only">Desplegar navegación</span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
      			</button>
      			<a class="navbar-brand" href="inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
    		</div>
    		<div class="collapse navbar-collapse navbar-ex1-collapse">
      			<ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Nuevo Pedido<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="nuevo">Compras</a></li>
                          <li><a href="nuevo_int">Servicios Internos</a></li>
                          <li><a href="nuevo_mtto">Mantenimientos</a></li>
                  </ul>
              </li>
              <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="historial_gen">Compras</a></li>
                            <li><a href="historial_int">Servicios Internos</a></li>
                            <li><a href="historial_mtto">Mantenimientos</a></li>
                    </ul>
                </li>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"> </span> Reporte<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="reporte_general">Compras</a></li>
                            <li><a href="reporte_general_int">Servicios Internos</a></li>
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
        	<div align="center" class="panel-heading">Modificar Pedido</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
 					if(isset($_POST["submit"])){
                        if ($_POST["solicitante"] == $_SESSION['nombre']) 
                        {
                            $query = "UPDATE mantenimientos SET departamento='".$_POST["departamento"]."', lugar='".$_POST["lugar"]."',
                             descripcion='".$_POST["descripcion"]."', notas='".$_POST["notas"]."' WHERE id_pedido='".$_POST["id"]."'";
                            $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                        
                            echo "<script languaje='javascript'>
                                    alert('Se han modificado los datos del pedido con folio ".$_POST["folio_ger"]."')
                            location.href='historial_mtto?id=tw_redireccion';
                                </script>";
                        }
                        else
                        {
                            echo "<script languaje='javascript'>
                                    alert('No tienes autorización para realizar esta acción')
                                location.href='historial_mtto?id=tw_redireccion';
                                </script>";
                        }
				    }
                    else {
						$id_pedido=$_GET['id_pedido'];
						$sql_query="SELECT * FROM mantenimientos WHERE id_pedido='".$id_pedido."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
				?>
            	<form method="post" name=frm action="modificar_mtto">
                <div class="row form-horizontal">
                         <div class="col-xs-2">
  							<label class="control-label">Fecha</label>
  							<input name="fecha" type="date" class="form-control input-sm" readonly value="<?php echo $Rs['fecha']; ?>">
  						</div>
                        <div class="col-xs-1">
                        <input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id_pedido']; ?>" size="17" />
                        </div>
                        <div class="col-xs-2">
                			<label class="control-label">Folio Ger. Solicitante</label>
    						<input readonly align="right" name="folio_ger" class="form-control input-sm" value="<?php echo $Rs['folio_ger']; ?>">
  						</div>
						<div class="col-xs-4">
        				    <label class="control-label">Solicitante</label>
						    <input name="solicitante" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['solicitante']; ?>">
						</div>
                    </div>
                    <div class="row form-horizontal">
                        <div class="col-xs-5">
                            <label class="control-label">Gerencia que Solicita</label>
                            <input name="gerencia" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['gerencia']; ?>">
                        </div>
                        <div class="col-xs-5">
        				    <label class="control-label">Departamento</label>
						    <input name="departamento" type="text" class="form-control input-sm" value="<?php echo $Rs['departamento']; ?>">
						</div>
                    </div>
                    <div class="row form-horizontal">
						<div class="col-xs-10">
        				    <label class="control-label">Lugar de Realización</label>
						    <input name="lugar" type="text" class="form-control input-sm" value="<?php echo $Rs['lugar']; ?>">
						</div>
                	</div>
					<div class="row form-horizontal">
                        <div class="col-xs-10">
                            <label class="control-label">Descripción</label>
                            <textarea  name="descripcion" class="form-control "><?php echo $Rs['descripcion']; ?></textarea>
                        </div>
                    </div>
                    <div class="row form-horizontal">
                        <div class="col-xs-10">
                            <label class="control-label">Notas</label>
                            <textarea  name="notas" class="form-control "><?php echo $Rs['notas']; ?></textarea>
                        </div>
                    </div>
                    <br>
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