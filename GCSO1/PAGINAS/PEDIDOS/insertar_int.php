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
						$fecha_solicitud=$_POST['fecha_solicitud'];
						$proyecto=$_POST['proyecto'];
						$supervisor=$_POST['supervisor'];
						$ubicacion=$_POST['ubicacion'];
						$lugar="Servicios Internos";
            			$tipo_servicio=$_POST["tipo_servicio"];
            			$notas_seguimiento=$_POST["notas_seguimiento"];
						$servicio1=$_POST['servicio1'];
						$servicio2=$_POST['servicio2'];
						$servicio3=$_POST['servicio3'];
						$fecha_entrega1=$_POST['fecha_entrega1'];
						$fecha_entrega2=$_POST['fecha_entrega2'];
						$fecha_entrega3=$_POST['fecha_entrega3'];
						$fecha_devolucion1=$_POST['fecha_devolucion1'];
						$fecha_devolucion2=$_POST['fecha_devolucion2'];
						$fecha_devolucion3=$_POST['fecha_devolucion3'];
						
						$currY = date("y");
						$sql = "INSERT INTO folios_gcso1_int SET idsdgg='0'";
						$result = mysql_query($sql) or die(mysql_error());
						$id = mysql_insert_id();
						$folio = strtoupper( "GCSO1-INT ".str_pad($id,3,'0',STR_PAD_LEFT).date("/ y"));
						$gerencia = "GCSO1";
						//insertamos datos a la tabla pedido
						$sql ="INSERT INTO pedidos_int(year,gerencia,folio,fecha_solicitud,proyecto,supervisor,ubicacion,lugar,tipo_servicio,servicio1,fecha_entrega1,fecha_devolucion1,servicio2,fecha_entrega2,fecha_devolucion2,servicio3,fecha_entrega3,fecha_devolucion3,notas_seguimiento) VALUES ('".$currY."','".$gerencia."','".$folio."','".$fecha_solicitud."','".$proyecto."','".$supervisor."','".$ubicacion."','".$lugar."','".$tipo_servicio."','".$servicio1."'," . ($fecha_entrega1==NULL ? "NULL" : "'$fecha_entrega1'") . "," . ($fecha_devolucion1==NULL ? "NULL" : "'$fecha_devolucion1'") . ",'".$servicio2."'," . ($fecha_entrega2==NULL ? "NULL" : "'$fecha_entrega2'") . "," . ($fecha_devolucion2==NULL ? "NULL" : "'$fecha_devolucion2'") . ",'".$servicio3."'," . ($fecha_entrega3==NULL ? "NULL" : "'$fecha_entrega3'") . "," . ($fecha_devolucion3==NULL ? "NULL" : "'$fecha_devolucion3'") . ",'".$notas_seguimiento."')";
						$result = mysql_query($sql) or die(mysql_error());


            $sql = "UPDATE folios_gcso1_int SET folio='".$folio."' WHERE id='".$id."'";
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

						$nom_gerente = "Moisés";
					  	$mailto = "moises_fernandez@grupocavi.com.mx";
					  	       
					    $mail->AddAddress($mailto);

					    $mail->WordWrap = 50;
					    $mail->IsHTML(true);
					    $mail->CharSet = 'UTF-8';
					    $mail->Subject = "Sistema de Pedidos GRUPO CAVI | Nuevo Pedido";
					    $mail->Body = "<h3>|  NUEVO PEDIDO  |</h3><br><p>Estimado (a) ".$nom_gerente.":</p><p>Te informamos que tienes un nuevo pedido de Servicios Internos pendiente de autorizar enviado por: ".$supervisor.".</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
					    	Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

					    if(!$mail->Send())
					    {
					      echo "Fallo";
					    }
				?>
                	<br>
                    <br>
             	<?php
                  }else {
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