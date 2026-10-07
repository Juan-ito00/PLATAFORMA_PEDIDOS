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
								<li><a href="historial_alm">Pedidos a Almacén</a></li>
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
						mysql_query("SET NAMES 'UTF8'");
						mysql_query("SET lc_time_names = 'es_MX'");

            			$tipo_compra=$_POST["tipo_compra"];

						if($tipo_compra != "Almacén") {
							$proyecto=$_POST['proyecto'];
							$supervisor=$_POST['supervisor'];
							$ubicacion=$_POST['ubicacion'];
							$empresa=$_POST['empresa'];
							$lugar="Compras";
							$notas_seguimiento=$_POST["notas_seguimiento"];

							$cantidad1=$_POST['cantidad1'];
							$cantidad2=$_POST['cantidad2'];
							$cantidad3=$_POST['cantidad3'];
							$cantidad4=$_POST['cantidad4'];
							$cantidad5=$_POST['cantidad5'];
							$cantidad6=$_POST['cantidad6'];
							$cantidad7=$_POST['cantidad7'];
							$cantidad8=$_POST['cantidad8'];
							$cantidad9=$_POST['cantidad9'];
							$cantidad10=$_POST['cantidad10'];
							$cantidad11=$_POST['cantidad11'];
							$cantidad12=$_POST['cantidad12'];
							$cantidad13=$_POST['cantidad13'];
							$cantidad14=$_POST['cantidad14'];
							$cantidad15=$_POST['cantidad15'];
							$cantidad16=$_POST['cantidad16'];
							$cantidad17=$_POST['cantidad17'];
							$cantidad18=$_POST['cantidad18'];
							$cantidad19=$_POST['cantidad19'];
							$cantidad20=$_POST['cantidad20'];
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
							$uso1=$_POST['uso1'];
							$uso2=$_POST['uso2'];
							$uso3=$_POST['uso3'];
							$uso4=$_POST['uso4'];
							$uso5=$_POST['uso5'];
							$uso6=$_POST['uso6'];
							$uso7=$_POST['uso7'];
							$uso8=$_POST['uso8'];
							$uso9=$_POST['uso9'];
							$uso10=$_POST['uso10'];
							$uso11=$_POST['uso11'];
							$uso12=$_POST['uso12'];
							$uso13=$_POST['uso13'];
							$uso14=$_POST['uso14'];
							$uso15=$_POST['uso15'];
							$uso16=$_POST['uso16'];
							$uso17=$_POST['uso17'];
							$uso18=$_POST['uso18'];
							$uso19=$_POST['uso19'];
							$uso20=$_POST['uso20'];

							$currY = date('y');
							$sql = "INSERT INTO folios_goc SET idsdgg='0'";
							$result = mysql_query($sql) or die(mysql_error());
							$id = mysql_insert_id();
							$folio = strtoupper( "GOC ".str_pad($id,3,'0',STR_PAD_LEFT).date("/ y"));
							$gerencia = "GOC";
							//insertamos datos a la tabla pedido
							$sql ="INSERT INTO pedidos(year,gerencia,folio,proyecto,supervisor,ubicacion,empresa,lugar,tipo_compra,cant1,unid1,desc1,uso1,cant2,unid2,desc2,uso2,cant3,unid3,desc3,uso3,cant4,unid4,desc4,uso4,cant5,unid5,desc5,uso5,cant6,unid6,desc6,uso6,cant7,unid7,desc7,uso7,cant8,unid8,desc8,uso8,cant9,unid9,desc9,uso9,cant10,unid10,desc10,uso10,cant11,unid11,desc11,uso11,cant12,unid12,desc12,uso12,cant13,unid13,desc13,uso13,cant14,unid14,desc14,uso14,cant15,unid15,desc15,uso15,cant16,unid16,desc16,uso16,cant17,unid17,desc17,uso17,cant18,unid18,desc18,uso18,cant19,unid19,desc19,uso19,cant20,unid20,desc20,uso20,notas_seguimiento) VALUES ('".$currY."','".$gerencia."','".$folio."','".$proyecto."','".$supervisor."','".$ubicacion."','".$empresa."','".$lugar."','".$tipo_compra."','".$cantidad1."','".$unidad1."','".$descripcion1."','".$uso1."','".$cantidad2."','".$unidad2."','".$descripcion2."','".$uso2."','".$cantidad3."','".$unidad3."','".$descripcion3."','".$uso3."','".$cantidad4."','".$unidad4."','".$descripcion4."','".$uso4."','".$cantidad5."','".$unidad5."','".$descripcion5."','".$uso5."','".$cantidad6."','".$unidad6."','".$descripcion6."','".$uso6."','".$cantidad7."','".$unidad7."','".$descripcion7."','".$uso7."','".$cantidad8."','".$unidad8."','".$descripcion8."','".$uso8."','".$cantidad9."','".$unidad9."','".$descripcion9."','".$uso9."','".$cantidad10."','".$unidad10."','".$descripcion10."','".$uso10."','".$cantidad11."','".$unidad11."','".$descripcion11."','".$uso11."','".$cantidad12."','".$unidad12."','".$descripcion12."','".$uso12."','".$cantidad13."','".$unidad13."','".$descripcion13."','".$uso13."','".$cantidad14."','".$unidad14."','".$descripcion14."','".$uso14."','".$cantidad15."','".$unidad15."','".$descripcion15."','".$uso15."','".$cantidad16."','".$unidad16."','".$descripcion16."','".$uso16."','".$cantidad17."','".$unidad17."','".$descripcion17."','".$uso17."','".$cantidad18."','".$unidad18."','".$descripcion18."','".$uso18."','".$cantidad19."','".$unidad19."','".$descripcion19."','".$uso19."','".$cantidad20."','".$unidad20."','".$descripcion20."','".$uso20."','".$notas_seguimiento."')";
							$result = mysql_query($sql) or die(mysql_error());


				$sql = "UPDATE folios_goc SET folio='".$folio."' WHERE id='".$id."'";
				$result = mysql_query($sql) or die(mysql_error());
							echo "<br>";
							echo "<br>";
							echo "Se ha creado el pedido ".$folio." satisfactoriamente!!";

							$mail = new PHPMailer();
							$mail->IsSMTP();
							$mail->SMTPAuth = true;
							$mail->SMTPSecure = "ssl"; 
							$mail->Host = "mut.hosting-mexico.net";
							$mail->Port       = 465;
							$mail->SMTPOptions = array(
														'ssl' => array(
															'verify_peer' => false,
															'verify_peer_name' => false,
															'allow_self_signed' => true
														)
													);
							$mail->Username = "soporte@grupocavi.com.mx";
							$mail->Password = "e@r0)_H2C@s{";

							$mail->setFrom('soporte@grupocavi.com.mx', 'SISTEMA DE PEDIDOS');

							$nom_gerente = "Vinicio Bustos";
					  		$mailto = "vinicio_bustos@grupocavi.com.mx";
								
							$mail->AddAddress($mailto);

							$mail->WordWrap = 50;
							$mail->IsHTML(true);
							$mail->CharSet = 'UTF-8';
							$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Nuevo Pedido";
							$mail->Body = "<h3>|  NUEVO PEDIDO  |</h3><br><p>Estimado (a) ".$nom_gerente.":</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar enviado por: ".$supervisor.".</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
								Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

							if(!$mail->Send())
							{
							echo "Fallo";
							}
					?>
						<br>
						<br>
					<?php
					}
					else if($tipo_compra == "Almacén"){
						$proyecto=$_POST['proyecto_a'];
						$supervisor=$_POST['supervisor_a'];
						$notas_seguimiento=$_POST["notas_seguimiento_a"];

						$cantidad1=$_POST['cantidad1_a'];
						$cantidad2=$_POST['cantidad2_a'];
						$cantidad3=$_POST['cantidad3_a'];
						$cantidad4=$_POST['cantidad4_a'];
						$cantidad5=$_POST['cantidad5_a'];
						$cantidad6=$_POST['cantidad6_a'];
						$cantidad7=$_POST['cantidad7_a'];
						$cantidad8=$_POST['cantidad8_a'];
						$cantidad9=$_POST['cantidad9_a'];
						$cantidad10=$_POST['cantidad10_a'];
						$cantidad11=$_POST['cantidad11_a'];
						$cantidad12=$_POST['cantidad12_a'];
						$cantidad13=$_POST['cantidad13_a'];
						$cantidad14=$_POST['cantidad14_a'];
						$cantidad15=$_POST['cantidad15_a'];
						$cantidad16=$_POST['cantidad16_a'];
						$cantidad17=$_POST['cantidad17_a'];
						$cantidad18=$_POST['cantidad18_a'];
						$cantidad19=$_POST['cantidad19_a'];
						$cantidad20=$_POST['cantidad20_a'];
						$unidad1=$_POST['unidad1_a'];
						$unidad2=$_POST['unidad2_a'];
						$unidad3=$_POST['unidad3_a'];
						$unidad4=$_POST['unidad4_a'];
						$unidad5=$_POST['unidad5_a'];
						$unidad6=$_POST['unidad6_a'];
						$unidad7=$_POST['unidad7_a'];
						$unidad8=$_POST['unidad8_a'];
						$unidad9=$_POST['unidad9_a'];
						$unidad10=$_POST['unidad10_a'];
						$unidad11=$_POST['unidad11_a'];
						$unidad12=$_POST['unidad12_a'];
						$unidad13=$_POST['unidad13_a'];
						$unidad14=$_POST['unidad14_a'];
						$unidad15=$_POST['unidad15_a'];
						$unidad16=$_POST['unidad16_a'];
						$unidad17=$_POST['unidad17_a'];
						$unidad18=$_POST['unidad18_a'];
						$unidad19=$_POST['unidad19_a'];
						$unidad20=$_POST['unidad20_a'];
						$descripcion1=$_POST['descripcion1_a'];
						$descripcion2=$_POST['descripcion2_a'];
						$descripcion3=$_POST['descripcion3_a'];
						$descripcion4=$_POST['descripcion4_a'];
						$descripcion5=$_POST['descripcion5_a'];
						$descripcion6=$_POST['descripcion6_a'];
						$descripcion7=$_POST['descripcion7_a'];
						$descripcion8=$_POST['descripcion8_a'];
						$descripcion9=$_POST['descripcion9_a'];
						$descripcion10=$_POST['descripcion10_a'];
						$descripcion11=$_POST['descripcion11_a'];
						$descripcion12=$_POST['descripcion12_a'];
						$descripcion13=$_POST['descripcion13_a'];
						$descripcion14=$_POST['descripcion14_a'];
						$descripcion15=$_POST['descripcion15_a'];
						$descripcion16=$_POST['descripcion16_a'];
						$descripcion17=$_POST['descripcion17_a'];
						$descripcion18=$_POST['descripcion18_a'];
						$descripcion19=$_POST['descripcion19_a'];
						$descripcion20=$_POST['descripcion20_a'];
						$codigo1=$_POST['codigo1'];
						$codigo2=$_POST['codigo2'];
						$codigo3=$_POST['codigo3'];
						$codigo4=$_POST['codigo4'];
						$codigo5=$_POST['codigo5'];
						$codigo6=$_POST['codigo6'];
						$codigo7=$_POST['codigo7'];
						$codigo8=$_POST['codigo8'];
						$codigo9=$_POST['codigo9'];
						$codigo10=$_POST['codigo10'];
						$codigo11=$_POST['codigo11'];
						$codigo12=$_POST['codigo12'];
						$codigo13=$_POST['codigo13'];
						$codigo14=$_POST['codigo14'];
						$codigo15=$_POST['codigo15'];
						$codigo16=$_POST['codigo16'];
						$codigo17=$_POST['codigo17'];
						$codigo18=$_POST['codigo18'];
						$codigo19=$_POST['codigo19'];
						$codigo20=$_POST['codigo20'];

						$currY = date('y');
						$sql = "INSERT INTO folios_goc_alm SET idsdgg='0'";
						$result = mysql_query($sql) or die(mysql_error());
						$id = mysql_insert_id();
						$folio = strtoupper( "GOC-ALM ".str_pad($id,3,'0',STR_PAD_LEFT).date("/ y"));
						$gerencia = "GOC";

						//insertamos datos a la tabla pedido
						$sql ="INSERT INTO pedidos_alm(year,gerencia,folio,proyecto,supervisor,
						cant1,unid1,desc1,codigo1,cant2,unid2,desc2,codigo2,cant3,unid3,desc3,codigo3,
						cant4,unid4,desc4,codigo4,cant5,unid5,desc5,codigo5,cant6,unid6,desc6,codigo6,
						cant7,unid7,desc7,codigo7,cant8,unid8,desc8,codigo8,cant9,unid9,desc9,codigo9,
						cant10,unid10,desc10,codigo10,cant11,unid11,desc11,codigo11,cant12,unid12,desc12,codigo12,
						cant13,unid13,desc13,codigo13,cant14,unid14,desc14,codigo14,cant15,unid15,desc15,codigo15,
						cant16,unid16,desc16,codigo16,cant17,unid17,desc17,codigo17,cant18,unid18,desc18,codigo18,
						cant19,unid19,desc19,codigo19,cant20,unid20,desc20,codigo20) VALUES ('".$currY."','".$gerencia."','".$folio."','".$proyecto."',
						'".$supervisor."','".$cantidad1."','".$unidad1."','".$descripcion1."','".$codigo1."',
						'".$cantidad2."','".$unidad2."','".$descripcion2."','".$codigo2."','".$cantidad3."','".$unidad3."','".$descripcion3."','".$codigo3."',
						'".$cantidad4."','".$unidad4."','".$descripcion4."','".$codigo4."','".$cantidad5."','".$unidad5."','".$descripcion5."','".$codigo5."',
						'".$cantidad6."','".$unidad6."','".$descripcion6."','".$codigo6."','".$cantidad7."','".$unidad7."','".$descripcion7."','".$codigo7."',
						'".$cantidad8."','".$unidad8."','".$descripcion8."','".$codigo8."','".$cantidad9."','".$unidad9."','".$descripcion9."','".$codigo9."',
						'".$cantidad10."','".$unidad10."','".$descripcion10."','".$codigo10."','".$cantidad11."','".$unidad11."','".$descripcion11."','".$codigo11."',
						'".$cantidad12."','".$unidad12."','".$descripcion12."','".$codigo12."','".$cantidad13."','".$unidad13."','".$descripcion13."','".$codigo13."',
						'".$cantidad14."','".$unidad14."','".$descripcion14."','".$codigo14."','".$cantidad15."','".$unidad15."','".$descripcion15."','".$codigo15."',
						'".$cantidad16."','".$unidad16."','".$descripcion16."','".$codigo16."','".$cantidad17."','".$unidad17."','".$descripcion17."','".$codigo17."',
						'".$cantidad18."','".$unidad18."','".$descripcion18."','".$codigo18."','".$cantidad19."','".$unidad19."','".$descripcion19."','".$codigo19."',
						'".$cantidad20."','".$unidad20."','".$descripcion20."','".$codigo20."')";
						$result = mysql_query($sql) or die(mysql_error());


						$sql = "UPDATE folios_goc_alm SET folio='".$folio."' WHERE id='".$id."'";
						$result = mysql_query($sql) or die(mysql_error());
						echo "<script languaje='javascript'>
                    alert('Se ha creado el pedido ".$folio." satisfactoriamente!!')
        location.href='historial_alm?id=tw_redireccion';
                  </script>";

						$mail = new PHPMailer();
						$mail->IsSMTP();
						$mail->SMTPAuth = true;
						$mail->SMTPSecure = "ssl"; 
						$mail->Host = "mut.hosting-mexico.net";
						$mail->Port       = 465;
						$mail->SMTPOptions = array(
													'ssl' => array(
														'verify_peer' => false,
														'verify_peer_name' => false,
														'allow_self_signed' => true
													)
												);
						$mail->Username = "soporte@grupocavi.com.mx";
						$mail->Password = "e@r0)_H2C@s{";

						$mail->setFrom('soporte@grupocavi.com.mx', 'SISTEMA DE PEDIDOS');

						$nom_gerente = "Vinicio Bustos";
					  	$mailto = "vinicio_bustos@grupocavi.com.mx";
							
						$mail->AddAddress($mailto);

						$mail->WordWrap = 50;
						$mail->IsHTML(true);
						$mail->CharSet = 'UTF-8';
						$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Nuevo Pedido";
						$mail->Body = "<h3>|  NUEVO PEDIDO  |</h3><br><p>Estimado (a) ".$nom_gerente.":</p><p>Te informamos que tienes un nuevo pedido a almacén pendiente de autorizar enviado por: ".$supervisor.".</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
							Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

						if(!$mail->Send())
						{
						echo "Fallo";
						}
				?>
					<br>
					<br>
				<?php
				}
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