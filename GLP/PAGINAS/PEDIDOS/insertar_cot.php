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
						//datos de la tabla pedido
						$fecha_requerido=$_POST['fecha_requerido'];
						$proyecto=$_POST['proyecto'];
						$solicitante=$_POST['solicitante'];
						$ubicacion_obra=$_POST['ubicacion_obra'];
						$lugar_cotizacion=$_POST["lugar_cotizacion"];
            			$tipo_cotizacion=$_POST["tipo_cotizacion"];
            			$notas=$_POST["notas"];
						//datos de la tabla contenido del pedido
						$codigo1=$_POST['codigo1'];
						$resultC1 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo1'");
						while($rowC1 = mysql_fetch_array($resultC1))
						{
							$u1 = $rowC1['unidad'];
							$d1 = $rowC1['descripcion'];
						}
						$codigo2=$_POST['codigo2'];
						$resultC2 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo2'");
						while($rowC2 = mysql_fetch_array($resultC2))
						{
							$u2 = $rowC2['unidad'];
							$d2 = $rowC2['descripcion'];
						}
						$codigo3=$_POST['codigo3'];
						$resultC3 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo3'");
						while($rowC3 = mysql_fetch_array($resultC3))
						{
							$u3 = $rowC3['unidad'];
							$d3 = $rowC3['descripcion'];
						}
						$codigo4=$_POST['codigo4'];
						$resultC4 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo4'");
						while($rowC4 = mysql_fetch_array($resultC4))
						{
							$u4 = $rowC4['unidad'];
							$d4 = $rowC4['descripcion'];
						}
						$codigo5=$_POST['codigo5'];
						$resultC5 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo5'");
						while($rowC5 = mysql_fetch_array($resultC5))
						{
							$u5 = $rowC5['unidad'];
							$d5 = $rowC5['descripcion'];
						}
						$codigo6=$_POST['codigo6'];
						$resultC6 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo6'");
						while($rowC6 = mysql_fetch_array($resultC6))
						{
							$u6 = $rowC6['unidad'];
							$d6 = $rowC6['descripcion'];
						}
						$codigo7=$_POST['codigo7'];
						$resultC7 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo7'");
						while($rowC7 = mysql_fetch_array($resultC7))
						{
							$u7 = $rowC7['unidad'];
							$d7 = $rowC7['descripcion'];
						}
						$codigo8=$_POST['codigo8'];
						$resultC8 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo8'");
						while($rowC8 = mysql_fetch_array($resultC8))
						{
							$u8 = $rowC8['unidad'];
							$d8 = $rowC8['descripcion'];
						}
						$codigo9=$_POST['codigo9'];
						$resultC9 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo9'");
						while($rowC9 = mysql_fetch_array($resultC9))
						{
							$u9 = $rowC9['unidad'];
							$d9 = $rowC9['descripcion'];
						}
						$codigo10=$_POST['codigo10'];
						$resultC10 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo10'");
						while($rowC10 = mysql_fetch_array($resultC10))
						{
							$u10 = $rowC10['unidad'];
							$d10 = $rowC10['descripcion'];
						}
						$codigo11=$_POST['codigo11'];
						$resultC11 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo11'");
						while($rowC11 = mysql_fetch_array($resultC11))
						{
							$u11 = $rowC11['unidad'];
							$d11 = $rowC11['descripcion'];
						}
						$codigo12=$_POST['codigo12'];
						$resultC12 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo12'");
						while($rowC12 = mysql_fetch_array($resultC12))
						{
							$u12 = $rowC12['unidad'];
							$d12 = $rowC12['descripcion'];
						}
						$codigo13=$_POST['codigo13'];
						$resultC13 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo13'");
						while($rowC13 = mysql_fetch_array($resultC13))
						{
							$u13 = $rowC13['unidad'];
							$d13 = $rowC13['descripcion'];
						}
						$codigo14=$_POST['codigo14'];
						$resultC14 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo14'");
						while($rowC14 = mysql_fetch_array($resultC14))
						{
							$u14 = $rowC14['unidad'];
							$d14 = $rowC14['descripcion'];
						}
						$codigo15=$_POST['codigo15'];
						$resultC15 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo15'");
						while($rowC15 = mysql_fetch_array($resultC15))
						{
							$u15 = $rowC15['unidad'];
							$d15 = $rowC15['descripcion'];
						}
						$codigo16=$_POST['codigo16'];
						$resultC16 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo16'");
						while($rowC16 = mysql_fetch_array($resultC16))
						{
							$u16 = $rowC16['unidad'];
							$d16 = $rowC16['descripcion'];
						}
						$codigo17=$_POST['codigo17'];
						$resultC17 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo17'");
						while($rowC17 = mysql_fetch_array($resultC17))
						{
							$u17 = $rowC17['unidad'];
							$d17 = $rowC17['descripcion'];
						}
						$codigo18=$_POST['codigo18'];
						$resultC18 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo18'");
						while($rowC18 = mysql_fetch_array($resultC18))
						{
							$u18 = $rowC18['unidad'];
							$d18 = $rowC18['descripcion'];
						}
						$codigo19=$_POST['codigo19'];
						$resultC19 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo19'");
						while($rowC19 = mysql_fetch_array($resultC19))
						{
							$u19 = $rowC19['unidad'];
							$d19 = $rowC19['descripcion'];
						}
						$codigo20=$_POST['codigo20'];
						$resultC20 = mysql_query("SELECT * FROM conceptos_gcp WHERE codigo='$codigo20'");
						while($rowC20 = mysql_fetch_array($resultC20))
						{
							$u20 = $rowC20['unidad'];
							$d20 = $rowC20['descripcion'];
						}

						$currY = date('y');
						$sql = "INSERT INTO folios_glp_cot SET idsdgg='0'";
						$result = mysql_query($sql) or die(mysql_error());
						$id = mysql_insert_id();
						$folio = strtoupper( "GLP-COT ".str_pad($id,3,'0',STR_PAD_LEFT).date("/ y"));
						$gerencia = "GLP";
						$fecha_solicitud = date('Y-m-d H:i:s');
						$estado = "Enviado";
						//insertamos datos a la tabla pedido
						$sql ="INSERT INTO cotizaciones(year,gerencia,folio_gerencia,fecha_solicitud,fecha_requerido,proyecto,solicitante,ubicacion_obra,lugar_cotizacion,tipo_cotizacion,unid1,desc1,unid2,desc2,
						unid3,desc3,unid4,desc4,unid5,desc5,unid6,desc6,unid7,desc7,unid8,desc8,unid9,desc9,unid10,desc10,unid11,desc11,unid12,desc12,unid13,
						desc13,unid14,desc14,unid15,desc15,unid16,desc16,unid17,desc17,unid18,desc18,unid19,desc19,unid20,desc20,
						notas,estado,cod1,cod2,cod3,cod4,cod5,cod6,cod7,cod8,cod9,cod10,cod11,cod12,cod13,cod14,cod15,cod16,cod17,
						cod18,cod19,cod20) VALUES ('".$currY."','".$gerencia."','".$folio."','".$fecha_solicitud."','".$fecha_requerido."',
						'".$proyecto."','".$solicitante."','".$ubicacion_obra."','".$lugar_cotizacion."','".$tipo_cotizacion."','".$u1."',
						'".$d1."','".$u2."','".$d2."','".$u3."','".$d3."','".$u4."','".$d4."',
						'".$u5."','".$d5."','".$u6."','".$d6."','".$u7."','".$d7."','".$u8."',
						'".$d8."','".$u9."','".$d9."','".$u10."','".$d10."','".$u11."','".$d11."',
						'".$u12."','".$d12."','".$u13."','".$d13."','".$u14."','".$d14."','".$u15."',
						'".$d15."','".$u16."','".$d16."','".$u17."','".$d17."','".$u18."','".$d18."',
						'".$u19."','".$d19."','".$u20."','".$d20."','".$notas."','".$estado."','".$codigo1."','".$codigo2."',
						'".$codigo3."','".$codigo4."','".$codigo5."','".$codigo6."','".$codigo7."','".$codigo8."','".$codigo9."',
						'".$codigo10."','".$codigo11."','".$codigo12."','".$codigo13."','".$codigo14."','".$codigo15."','".$codigo16."',
						'".$codigo17."','".$codigo18."','".$codigo19."','".$codigo20."')";
						$result = mysql_query($sql) or die(mysql_error());


            $sql = "UPDATE folios_glp_cot SET folio='".$folio."' WHERE id='".$id."'";
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