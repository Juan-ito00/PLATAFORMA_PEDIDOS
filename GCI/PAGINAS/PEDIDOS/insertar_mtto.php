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
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Insertar</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
 		<p align="center" style="color: white; margin-top: 12px; font-size: 18px;">SISTEMA DE PEDIDOS</p>
  	</nav>
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
          				</ul>
        			</li>
        			<li class="dropdown">
	                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
	          				</a>
	          				<ul class="dropdown-menu">
	            				<li><a href="historial_gen">Compras</a></li>
	                        	<li><a href="historial_int">Servicios Internos</a></li>
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
                    <li><a href="obras"><span class="glyphicon glyphicon-road"> </span> Obras</a></li>
      			</ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".$_SESSION['usuario']." | ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading"><?php echo "Generar Pedido";?></div>
            <div class="panel-body">
            	<?php
					if ($_POST) {
						//conexion a la base de datos
						mysql_query("SET NAMES 'UTF8'");
						mysql_query("SET lc_time_names = 'es_MX'");

						$currentdate = new DateTime('now', new DateTimeZone('America/Monterrey'));

						$date = $currentdate->format('Y-m-d');
						$time = $currentdate->format('H:i:s');
						$dayOfWeek = date("l", strtotime($date));
		  
						$splitDate = explode('-', $date);
						$d = $splitDate[2];
						$m = $splitDate[1];
						$a = $splitDate[0];
		  
						$splitTime = explode(':', $time);
						$H = $splitTime[0];
						$i = $splitTime[1];
						$s = $splitTime[2];
						if($H <= '15'){
							$fecha=$_POST['fecha'];
							$solicitante=$_POST['solicitante'];
							$gerencia=$_POST['gerencia'];
							$departamento=$_POST["departamento"];
							$folio_ger=$_POST["folio_ger"];
							$lugar=$_POST["lugar"];
							$descripcion=$_POST['descripcion'];
							$notas=$_POST['notas'];

							$currY = date('y');
							$sql = "INSERT INTO folios_gci_mttos SET idsdgg='0'";
							$result = mysql_query($sql) or die(mysql_error());
							$id = mysql_insert_id();
							$folio = strtoupper( "GCI-MTTO ".str_pad($id,3,'0',STR_PAD_LEFT).date("/ y"));

							$sql ="INSERT INTO mantenimientos(year,fecha,solicitante,gerencia,departamento,folio_ger,
							lugar,descripcion,notas) VALUES ('".$currY."','".$fecha."','".$solicitante."','".$gerencia."',
							'".$departamento."','".$folio."','".$lugar."','".$descripcion."','".$notas."')";
							$result = mysql_query($sql) or die(mysql_error());


							$sql = "UPDATE folios_gci_mttos SET folio='".$folio."' WHERE id='".$id."'";
							$result = mysql_query($sql) or die(mysql_error());
										echo "<script languaje='javascript'>
									alert('Se ha creado el pedido".$folio." satisfactoriamente!')
						location.href='historial_mtto?id=tw_redireccion';
								</script>";
						}
						else{
							echo "<script languaje='javascript'>
							alert('El pedido no se enviará porque está fuera de horario.')
						location.href='nuevo_mtto?id=tw_redireccion';
						</script>";
						}
				?>
                	<br>
                    <br>
             	<?php
                  }
                  else {
					$resultado = "-No se entro adecuadamente-";
     			}
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