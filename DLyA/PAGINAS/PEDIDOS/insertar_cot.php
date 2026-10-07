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
                    <li><a href="almacen_gen"><span class="glyphicon glyphicon-th"> </span> Pedidos a Almacen</a></li>
					<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Oficios<b class="caret"></b>
              </a>
            <ul class="dropdown-menu">
              <li><a href="A_COMP/ofg_nuevo">Nuevo Oficio General</a></li>
              <li><a href="A_COMP/historial_ofg">Historial Oficios Generales</a></li>
              <li><a href="A_COMP/ofi_nuevo">Nuevo Oficio Incidencia</a></li>
              <li><a href="A_COMP/historial_ofi">Historial Oficios Incidencias</a></li>
              <li><a href="A_COMP/ofac_nuevo">Nuevo Oficio Asignación</a></li>
              <li><a href="A_COMP/historial_ofac">Historial Oficios Asignación</a></li>
              <li><a href="A_COMP/ofar_nuevo">Nueva Asignación de Ruta</a></li>
              <li><a href="A_COMP/historial_ofar">Historial Asignaciones de Ruta</a></li>
              <li><a href="A_COMP/ofcc_nuevo">Nuevo Oficio Comisión Choferes</a></li>
              <li><a href="A_COMP/historial_ofcc">Historial Oficios Comisión Choferes</a></li>
              <li><a href="A_COMP/ofdlya_nuevo">Nuevo Oficio de DLyA</a></li>
              <li><a href="A_COMP/historial_ofdlya">Historial Oficios de DLyA</a></li>
            </ul>
          </li>
						<li><a href="A_COMP/reporte_rutas"><span class="glyphicon glyphicon-book"> </span> Reporte Asignaciones de Ruta</a></li>
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
						//datos de la tabla pedido
						$fecha_requerido=$_POST['fecha_requerido'];
						$proyecto=$_POST['proyecto'];
						$solicitante=$_POST['solicitante'];
						$ubicacion_obra=$_POST['ubicacion_obra'];
						$lugar_cotizacion=$_POST["lugar_cotizacion"];
            			$tipo_cotizacion=$_POST["tipo_cotizacion"];
            			$notas=$_POST["notas"];
						//datos de la tabla contenido del pedido
						$unidad1=$_POST['unidad1'];
						$unidad2=$_POST['unidad2'];
						$unidad3=$_POST['unidad3'];
						$unidad4=$_POST['unidad4'];
						$unidad5=$_POST['unidad5'];
						$unidad6=$_POST['unidad6'];
						$unidad7=$_POST['unidad7'];
						$unidad8=$_POST['unidad8'];
						$unidad9=$_POST['unidad9'];
						$unidad10=$_POST['unidad10'];
						$unidad11=$_POST['unidad11'];
						$unidad12=$_POST['unidad12'];
						$unidad13=$_POST['unidad13'];
						$unidad14=$_POST['unidad14'];
						$unidad15=$_POST['unidad15'];
						$unidad16=$_POST['unidad16'];
						$unidad17=$_POST['unidad17'];
						$unidad18=$_POST['unidad18'];
						$unidad19=$_POST['unidad19'];
						$unidad20=$_POST['unidad20'];
						$descripcion1=$_POST['descripcion1'];
						$descripcion2=$_POST['descripcion2'];
						$descripcion3=$_POST['descripcion3'];
						$descripcion4=$_POST['descripcion4'];
						$descripcion5=$_POST['descripcion5'];
						$descripcion6=$_POST['descripcion6'];
						$descripcion7=$_POST['descripcion7'];
						$descripcion8=$_POST['descripcion8'];
						$descripcion9=$_POST['descripcion9'];
						$descripcion10=$_POST['descripcion10'];
						$descripcion11=$_POST['descripcion11'];
						$descripcion12=$_POST['descripcion12'];
						$descripcion13=$_POST['descripcion13'];
						$descripcion14=$_POST['descripcion14'];
						$descripcion15=$_POST['descripcion15'];
						$descripcion16=$_POST['descripcion16'];
						$descripcion17=$_POST['descripcion17'];
						$descripcion18=$_POST['descripcion18'];
						$descripcion19=$_POST['descripcion19'];
						$descripcion20=$_POST['descripcion20'];

						$currY = date('y');
						$sql = "INSERT INTO folios_dlya_cot SET idsdgg='0'";
						$result = mysql_query($sql) or die(mysql_error());
						$id = mysql_insert_id();
						$folio = strtoupper( "DLyA-COT ".str_pad($id,3,'0',STR_PAD_LEFT).date("/ y"));
						$gerencia = "DLyA";
						$fecha_solicitud = date('Y-m-d H:i:s');
						$estado = "Enviado";
						//insertamos datos a la tabla pedido
						$sql ="INSERT INTO cotizaciones(year,gerencia,folio_gerencia,fecha_solicitud,fecha_requerido,proyecto,solicitante,ubicacion_obra,lugar_cotizacion,tipo_cotizacion,unid1,desc1,unid2,desc2,unid3,desc3,unid4,desc4,unid5,desc5,unid6,desc6,unid7,desc7,unid8,desc8,unid9,desc9,unid10,desc10,unid11,desc11,unid12,desc12,unid13,desc13,unid14,desc14,unid15,desc15,unid16,desc16,unid17,desc17,unid18,desc18,unid19,desc19,unid20,desc20,notas,estado) VALUES ('".$currY."','".$gerencia."','".$folio."','".$fecha_solicitud."','".$fecha_requerido."','".$proyecto."','".$solicitante."','".$ubicacion_obra."','".$lugar_cotizacion."','".$tipo_cotizacion."','".$unidad1."','".$descripcion1."','".$unidad2."','".$descripcion2."','".$unidad3."','".$descripcion3."','".$unidad4."','".$descripcion4."','".$unidad5."','".$descripcion5."','".$unidad6."','".$descripcion6."','".$unidad7."','".$descripcion7."','".$unidad8."','".$descripcion8."','".$unidad9."','".$descripcion9."','".$unidad10."','".$descripcion10."','".$unidad11."','".$descripcion11."','".$unidad12."','".$descripcion12."','".$unidad13."','".$descripcion13."','".$unidad14."','".$descripcion14."','".$unidad15."','".$descripcion15."','".$unidad16."','".$descripcion16."','".$unidad17."','".$descripcion17."','".$unidad18."','".$descripcion18."','".$unidad19."','".$descripcion19."','".$unidad20."','".$descripcion20."','".$notas."','".$estado."')";
						$result = mysql_query($sql) or die(mysql_error());


            $sql = "UPDATE folios_dlya_cot SET folio='".$folio."' WHERE id='".$id."'";
            $result = mysql_query($sql) or die(mysql_error());
						echo "<script languaje='javascript'>
                    alert('Se ha creado el pedido".$folio." satisfactoriamente!')
        location.href='historial_cot?id=tw_redireccion';
                  </script>";
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