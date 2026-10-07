<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
	{
		header('Location: ../../../index');
		exit();
	}
  include("../../../conexion/conexion.php"); 
  $conexion=Conectarse();
?>
<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar</title>
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<p align="center" style="color: white; margin-top: 12px; font-size: 18px;">SISTEMA DE PEDIDOS</p>
		</nav>
		<div class="container" style="padding-top: 1px;">
			<nav class="navbar navbar-default nav" style="margin-top:5px;" role="navigation">
				<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Desplegar navegación</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="../inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
				</div>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
						<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Oficios<b class="caret"></b>
              </a>
            <ul class="dropdown-menu">
              <li><a href="ofg_nuevo">Nuevo Oficio General</a></li>
              <li><a href="historial_ofg">Historial Oficios Generales</a></li>
              <li><a href="ofi_nuevo">Nuevo Oficio Incidencia</a></li>
              <li><a href="historial_ofi">Historial Oficios Incidencias</a></li>
              <li><a href="ofac_nuevo">Nuevo Oficio Asignación</a></li>
              <li><a href="historial_ofac">Historial Oficios Asignación</a></li>
              <li><a href="ofar_nuevo">Nueva Asignación de Ruta</a></li>
              <li><a href="historial_ofar">Historial Asignaciones de Ruta</a></li>
              <li><a href="ofcc_nuevo">Nuevo Oficio Comisión Choferes</a></li>
              <li><a href="historial_ofcc">Historial Oficios Comisión Choferes</a></li>
              <li><a href="ofdlya_nuevo">Nuevo Oficio de DLyA</a></li>
              <li><a href="historial_ofdlya">Historial Oficios de DLyA</a></li>
			  <li><a href="prodNC_nuevo">Nuevo PNC</a></li>
              <li><a href="historial_prodNC">Historial PNC</a></li>
            </ul>
          </li>
						<li><a href="reporte_rutas"><span class="glyphicon glyphicon-book"> </span> Reporte Asignaciones de Ruta</a></li>
						</ul>
					<ul class="nav navbar-nav navbar-right">
							<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
						</ul>
				</div>
			</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading"><?php echo "Registrar Asignación de Ruta";?></div>
            <div class="panel-body">
            	<?php
					if ($_POST) 
					{
						mysql_query("SET NAMES 'UTF8'");
						mysql_query("SET lc_time_names = 'es_MX'");
						
						$folio=$_POST['folio'];
						$fecha=$_POST['fecha'];
						$ruta=$_POST['ruta'];
                        $chofer=$_POST['chofer'];

						$tipo1=$_POST['tipo1'];
						$folio_ac1=$_POST['folio_ac1'];
                        $carta_porte1=$_POST['carta_porte1'];
                        $factura1=$_POST['factura1'];
                        $no_recoleccion1=$_POST['no_recoleccion1'];
                        $observaciones1=$_POST['observaciones1'];

						$tipo2=$_POST['tipo2'];
						$folio_ac2=$_POST['folio_ac2'];
                        $carta_porte2=$_POST['carta_porte2'];
                        $factura2=$_POST['factura2'];
                        $no_recoleccion2=$_POST['no_recoleccion2'];
                        $observaciones2=$_POST['observaciones2'];

						$tipo3=$_POST['tipo3'];
						$folio_ac3=$_POST['folio_ac3'];
                        $carta_porte3=$_POST['carta_porte3'];
                        $factura3=$_POST['factura3'];
                        $no_recoleccion3=$_POST['no_recoleccion3'];
                        $observaciones3=$_POST['observaciones3'];

						$tipo4=$_POST['tipo4'];
						$folio_ac4=$_POST['folio_ac4'];
                        $carta_porte4=$_POST['carta_porte4'];
                        $factura4=$_POST['factura4'];
                        $no_recoleccion4=$_POST['no_recoleccion4'];
                        $observaciones4=$_POST['observaciones4'];

						$tipo5=$_POST['tipo5'];
						$folio_ac5=$_POST['folio_ac5'];
                        $carta_porte5=$_POST['carta_porte5'];
                        $factura5=$_POST['factura5'];
                        $no_recoleccion5=$_POST['no_recoleccion5'];
                        $observaciones5=$_POST['observaciones5'];

						$tipo6=$_POST['tipo6'];
						$folio_ac6=$_POST['folio_ac6'];
                        $carta_porte6=$_POST['carta_porte6'];
                        $factura6=$_POST['factura6'];
                        $no_recoleccion6=$_POST['no_recoleccion6'];
                        $observaciones6=$_POST['observaciones6'];

						$tipo7=$_POST['tipo7'];
						$folio_ac7=$_POST['folio_ac7'];
                        $carta_porte7=$_POST['carta_porte7'];
                        $factura7=$_POST['factura7'];
                        $no_recoleccion7=$_POST['no_recoleccion7'];
                        $observaciones7=$_POST['observaciones7'];

						$tipo8=$_POST['tipo8'];
						$folio_ac8=$_POST['folio_ac8'];
                        $carta_porte8=$_POST['carta_porte8'];
                        $factura8=$_POST['factura8'];
                        $no_recoleccion8=$_POST['no_recoleccion8'];
                        $observaciones8=$_POST['observaciones8'];

						$tipo9=$_POST['tipo9'];
						$folio_ac9=$_POST['folio_ac9'];
                        $carta_porte9=$_POST['carta_porte9'];
                        $factura9=$_POST['factura9'];
                        $no_recoleccion9=$_POST['no_recoleccion9'];
                        $observaciones9=$_POST['observaciones9'];

						$tipo10=$_POST['tipo10'];
						$folio_ac10=$_POST['folio_ac10'];
                        $carta_porte10=$_POST['carta_porte10'];
                        $factura10=$_POST['factura10'];
                        $no_recoleccion10=$_POST['no_recoleccion10'];
                        $observaciones10=$_POST['observaciones10'];

			            $sql_id = "INSERT INTO folios_rutas SET idsdgg='0'";
			            $result_id = mysql_query($sql_id) or die(mysql_error());
			            $id_id = mysql_insert_id();
			            $folio_id =  strtoupper(("ASIGNACION DE RUTA ").str_pad($id_id,3,'0',STR_PAD_LEFT).date("/ y"));
			            $sql = "UPDATE folios_rutas SET folio='".$folio_id."' WHERE id='".$id_id."'";
			            $result = mysql_query($sql) or die(mysql_error());

						$sql ="INSERT INTO oficios_rutas(folio,
						fecha_creacion,
						ruta,
						chofer,
						folio_ac1,folio_ac2,folio_ac3,folio_ac4,folio_ac5,folio_ac6,folio_ac7,folio_ac8,folio_ac9,folio_ac10,
						tipo1,tipo2,tipo3,tipo4,tipo5,tipo6,tipo7,tipo8,tipo9,tipo10,
						carta_porte1,carta_porte2,carta_porte3,carta_porte4,carta_porte5,carta_porte6,carta_porte7,carta_porte8,carta_porte9,carta_porte10,
						factura1,factura2,factura3,factura4,factura5,factura6,factura7,factura8,factura9,factura10,
						no_recoleccion1,no_recoleccion2,no_recoleccion3,no_recoleccion4,no_recoleccion5,no_recoleccion6,no_recoleccion7,no_recoleccion8,no_recoleccion9,no_recoleccion10,
						observaciones1,observaciones2,observaciones3,observaciones4,observaciones5,observaciones6,observaciones7,observaciones8,observaciones9,observaciones10) VALUES ('".$folio_id."',
						'".$fecha."',
						'".$ruta."',
						'".$chofer."',
						'".$folio_ac1."',
						'".$folio_ac2."',
						'".$folio_ac3."',
						'".$folio_ac4."',
						'".$folio_ac5."',
						'".$folio_ac6."',
						'".$folio_ac7."',
						'".$folio_ac8."',
						'".$folio_ac9."',
						'".$folio_ac10."',
						'".$tipo1."',
						'".$tipo2."',
						'".$tipo3."',
						'".$tipo4."',
						'".$tipo5."',
						'".$tipo6."',
						'".$tipo7."',
						'".$tipo8."',
						'".$tipo9."',
						'".$tipo10."',
						'".$carta_porte1."',
						'".$carta_porte2."',
						'".$carta_porte3."',
						'".$carta_porte4."',
						'".$carta_porte5."',
						'".$carta_porte6."',
						'".$carta_porte7."',
						'".$carta_porte8."',
						'".$carta_porte9."',
						'".$carta_porte10."',
						'".$factura1."',
						'".$factura2."',
						'".$factura3."',
						'".$factura4."',
						'".$factura5."',
						'".$factura6."',
						'".$factura7."',
						'".$factura8."',
						'".$factura9."',
						'".$factura10."',
						'".$no_recoleccion1."',
						'".$no_recoleccion2."',
						'".$no_recoleccion3."',
						'".$no_recoleccion4."',
						'".$no_recoleccion5."',
						'".$no_recoleccion6."',
						'".$no_recoleccion7."',
						'".$no_recoleccion8."',
						'".$no_recoleccion9."',
						'".$no_recoleccion10."',
						'".$observaciones1."',
						'".$observaciones2."',
						'".$observaciones3."',
						'".$observaciones4."',
						'".$observaciones5."',
						'".$observaciones6."',
						'".$observaciones7."',
						'".$observaciones8."',
						'".$observaciones9."',
						'".$observaciones10."')";
						$result = mysql_query($sql) or die(mysql_error());
						$idm = $id_id -1;
						echo "<br>";
						echo "<br>";
						echo "<script languaje='javascript'>
                    			alert('Asignacion de Ruta Creada')
        						location.href='historial_ofar';
        						window.open('pdf/ofar_pdf?id_f=".$idm."', '_blank');
                  			</script>";
				?>
                	<br><br>
             	<?php
                   }
                  else
                  {
					$resultado = "Acceso incorrecto";
     			  }
			    ?>
            </div>
        </div>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../../js/bootstrap.min.js"></script>
  </body>
</html>