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
						<ul class="nav navbar-nav">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Pedidos<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="epp_gen">EPP</a></li>
                    <li><a href="examenes_gen">Exámenes Médicos</a></li>
                    <li><a href="insumos_gen">Insumos Méd/Lab</a></li>
                    <li><a href="papeleria_gen">Papelería</a></li>
                    <li><a href="material_gen">Generales</a></li>
                    <li><a href="productos_gen">Prod. Limpieza</a></li>
                    <li><a href="agencias_gen">Serv. Agencia</a></li>
                    <li><a href="toner_gen">Toner</a></li>
                  </ul>
              </li>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"> </span> Reportes<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="reporte_general">General</a></li>
                    <li><a href="reporte_gerencia">Gerencia</a></li>
                          <li><a href="reporte_obra">Obra</a></li>
                  </ul>
              </li>
      			</ul>
					<ul class="nav navbar-nav navbar-right">
							<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".$_SESSION['usuario']." ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
						</ul>
				</div>
			</nav>
				<!--Panel con el titulo de la pagina y contenido-->
				<div class="panel panel-default" style="margin-top: 5px; overflow: auto;white-space: nowrap;">
					<div align="center" class="panel-heading">Modificar Pedido</div>
							<div class="panel-body">
							<?php
							header("Content-Type: text/html;charset=utf-8");
							error_reporting(E_ALL ^ E_NOTICE);
							mysql_query("SET NAMES 'utf8'");
							$estado = $_POST['estado'];
							$folio = $_POST['folio_gerencia'];
							$supervisor_nom = $_POST['solicitante'];
							$result = mysql_query("SELECT * FROM supervisor WHERE nombre='$supervisor_nom'");

							while($rowS = mysql_fetch_array($result))
							{
								$mailto = $rowS['correo'];
							}

					if(isset($_POST["submit"]) AND $estado == 'Revisar Notas')
					{
						$query = "UPDATE cotizaciones SET estado='".$_POST["estado"]."', notas='".$_POST["notas"]."' WHERE id_pedido='".$_POST["id"]."'";
						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
						echo "<script languaje='javascript'>
										alert('Se han modificado los datos del pedido con folio ".$_POST["folio_gerencia"]."')
				javascript:history.go(-2)
									</script>";
					}
					else if(isset($_POST["submit"]) AND $estado == 'Recibido' AND !empty($_POST["folio_compras"]))
					{
						$fecha_recibido = date('Y-m-d H:i:s');
						$query = "UPDATE cotizaciones SET estado='".$_POST["estado"]."', fecha_recibido='".$fecha_recibido."'
						, notas='".$_POST["notas"]."', cotizaciones_entregadas='".$_POST["cotizaciones_entregadas"]."'
						, prov_contact1='".$_POST["prov_contact1"]."', prov_contact2='".$_POST["prov_contact2"]."', prov_contact3='".$_POST["prov_contact3"]."'
						, prov_contact4='".$_POST["prov_contact4"]."', prov_contact5='".$_POST["prov_contact5"]."' WHERE id_pedido='".$_POST["id"]."'";
						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
						echo "<script languaje='javascript'>
										alert('Se han modificado los datos del pedido con folio ".$_POST["folio_gerencia"]."')
				javascript:history.go(-2)
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

								$mail->Username = "compras@grupocavi.com.mx";
								$mail->Password = ")Cl5l4!ALD]A";
								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS');           
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';

								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido de cotización ".$folio.", tiene el siguiente estatus: ".$estado.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 

									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								if(!$mail->Send())
								{
									echo "Fallo";
								}

								else 
								{
									echo "Éxito";
								}
					}

					else if(isset($_POST["submit"]) AND $estado == 'Recibido')
					{
						$fecha_recibido = date('Y-m-d H:i:s');
						$sql_id = "INSERT INTO folios_cot SET idsdgg='0'";
						$result_id = mysql_query($sql_id) or die(mysql_error());
						$id_id = mysql_insert_id();
						$folio_id =  strtoupper( "GCOMP ".str_pad($id_id,3,'0',STR_PAD_LEFT).date("/ y"));
						$sql = "UPDATE folios_cot SET folio='".$folio_id."' WHERE id='".$id_id."'";
						$result = mysql_query($sql) or die(mysql_error());
						$query = "UPDATE cotizaciones SET estado='".$_POST["estado"]."', fecha_recibido='".$fecha_recibido."', notas='".$_POST["notas"]."'
						, cotizaciones_entregadas='".$_POST["cotizaciones_entregadas"]."'
						, prov_contact1='".$_POST["prov_contact1"]."', prov_contact2='".$_POST["prov_contact2"]."', prov_contact3='".$_POST["prov_contact3"]."'
						, prov_contact4='".$_POST["prov_contact4"]."', prov_contact5='".$_POST["prov_contact5"]."', folio_compras='".$folio_id."' WHERE id_pedido='".$_POST["id"]."'";
						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
						echo "<script languaje='javascript'>
										alert('Se han modificado los datos del pedido con folio ".$folio_id."')
				javascript:history.go(-2)
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

								$mail->Username = "compras@grupocavi.com.mx";
								$mail->Password = ")Cl5l4!ALD]A";
								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS');           
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';

								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido de cotización ".$folio.", tiene el siguiente estatus: ".$estado.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 

									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								if(!$mail->Send())
								{
									echo "Fallo";
								}

								else 
								{
									echo "Éxito";
								}
					}
					else if(isset($_POST["submit"]) AND $estado == 'Cotizando Parcial')

					{
						$query = "UPDATE cotizaciones SET estado='".$_POST["estado"]."', notas='".$_POST["notas"]."', cotizaciones_entregadas='".$_POST["cotizaciones_entregadas"]."'
						, prov_contact1='".$_POST["prov_contact1"]."', prov_contact2='".$_POST["prov_contact2"]."', prov_contact3='".$_POST["prov_contact3"]."'
						, prov_contact4='".$_POST["prov_contact4"]."', prov_contact5='".$_POST["prov_contact5"]."' WHERE id_pedido='".$_POST["id"]."'";

						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
						echo "<script languaje='javascript'>
										alert('Se han modificado los datos del pedido con folio ".$_POST["folio_gerencia"]."')
				javascript:history.go(-2)
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

								$mail->Username = "compras@grupocavi.com.mx";
								$mail->Password = ")Cl5l4!ALD]A";
								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS');           
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';

								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estado.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 

									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								if(!$mail->Send())
								{
									echo "Fallo";
								}

								else 
								{
									echo "Éxito";
								}
					}

					else if(isset($_POST["submit"]) AND $estado == 'Cotizado')
					{
						$query = "UPDATE cotizaciones SET estado='".$_POST["estado"]."', notas='".$_POST["notas"]."', cotizaciones_entregadas='".$_POST["cotizaciones_entregadas"]."'
						, prov_contact1='".$_POST["prov_contact1"]."', prov_contact2='".$_POST["prov_contact2"]."', prov_contact3='".$_POST["prov_contact3"]."'
						, prov_contact4='".$_POST["prov_contact4"]."', prov_contact5='".$_POST["prov_contact5"]."' WHERE id_pedido='".$_POST["id"]."'";
						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());

						echo "<script languaje='javascript'>
										alert('Se han modificado los datos del pedido con folio ".$_POST["folio"]."')
				javascript:history.go(-2)
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

								$mail->Username = "compras@grupocavi.com.mx";
								$mail->Password = ")Cl5l4!ALD]A";
								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS');          
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';
								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estado.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 

									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
								if(!$mail->Send())
								{
									echo "Fallo";
								}
								else 
								{
									echo "Éxito";
								}
					}
					else if(isset($_POST["submit"]) AND $estado == 'Entregado Parcial')
					{
						$query = "UPDATE cotizaciones SET estado='".$_POST["estado"]."', notas='".$_POST["notas"]."', cotizaciones_entregadas='".$_POST["cotizaciones_entregadas"]."'
						, prov_contact1='".$_POST["prov_contact1"]."', prov_contact2='".$_POST["prov_contact2"]."', prov_contact3='".$_POST["prov_contact3"]."'
						, prov_contact4='".$_POST["prov_contact4"]."', prov_contact5='".$_POST["prov_contact5"]."', 
						entregado1='".$_POST["entregado1"]."', fecha_r1='".$_POST["fecha_r1"]."',
						entregado2='".$_POST["entregado2"]."', fecha_r2='".$_POST["fecha_r2"]."',
						entregado3='".$_POST["entregado3"]."', fecha_r3='".$_POST["fecha_r3"]."',
						entregado4='".$_POST["entregado4"]."', fecha_r4='".$_POST["fecha_r4"]."',
						entregado5='".$_POST["entregado5"]."', fecha_r5='".$_POST["fecha_r5"]."',
						entregado6='".$_POST["entregado6"]."', fecha_r6='".$_POST["fecha_r6"]."',
						entregado7='".$_POST["entregado7"]."', fecha_r7='".$_POST["fecha_r7"]."',
						entregado8='".$_POST["entregado8"]."', fecha_r8='".$_POST["fecha_r8"]."',
						entregado9='".$_POST["entregado9"]."', fecha_r9='".$_POST["fecha_r9"]."',
						entregado10='".$_POST["entregado10"]."', fecha_r10='".$_POST["fecha_r10"]."',
						entregado11='".$_POST["entregado11"]."', fecha_r11='".$_POST["fecha_r11"]."',
						entregado12='".$_POST["entregado12"]."', fecha_r12='".$_POST["fecha_r12"]."',
						entregado13='".$_POST["entregado13"]."', fecha_r13='".$_POST["fecha_r13"]."',
						entregado14='".$_POST["entregado14"]."', fecha_r14='".$_POST["fecha_r14"]."',
						entregado15='".$_POST["entregado15"]."', fecha_r15='".$_POST["fecha_r15"]."',
						entregado16='".$_POST["entregado16"]."', fecha_r16='".$_POST["fecha_r16"]."',
						entregado17='".$_POST["entregado17"]."', fecha_r17='".$_POST["fecha_r17"]."',
						entregado18='".$_POST["entregado18"]."', fecha_r18='".$_POST["fecha_r18"]."',
						entregado19='".$_POST["entregado19"]."', fecha_r19='".$_POST["fecha_r19"]."',
						entregado20='".$_POST["entregado20"]."', fecha_r20='".$_POST["fecha_r20"]."' WHERE id_pedido='".$_POST["id"]."'";
						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());

						echo "<script languaje='javascript'>
										alert('Se han modificado los datos del pedido con folio ".$_POST["folio"]."')
				javascript:history.go(-2)
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

								$mail->Username = "compras@grupocavi.com.mx";
								$mail->Password = ")Cl5l4!ALD]A";
								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS');          
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';
								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estado.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 

									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								if(!$mail->Send())
								{
									echo "Fallo";
								}

								else 
								{
									echo "Éxito";
								}
					}
					else if(isset($_POST["submit"]) AND $estado == 'Entregado')
					{
						$query = "UPDATE cotizaciones SET estado='".$_POST["estado"]."', notas='".$_POST["notas"]."'
						, cotizaciones_entregadas='".$_POST["cotizaciones_entregadas"]."'
						, prov_contact1='".$_POST["prov_contact1"]."', prov_contact2='".$_POST["prov_contact2"]."', prov_contact3='".$_POST["prov_contact3"]."'
						, prov_contact4='".$_POST["prov_contact4"]."', prov_contact5='".$_POST["prov_contact5"]."',
						entregado1='".$_POST["entregado1"]."', fecha_r1='".$_POST["fecha_r1"]."',
						entregado2='".$_POST["entregado2"]."', fecha_r2='".$_POST["fecha_r2"]."',
						entregado3='".$_POST["entregado3"]."', fecha_r3='".$_POST["fecha_r3"]."',
						entregado4='".$_POST["entregado4"]."', fecha_r4='".$_POST["fecha_r4"]."',
						entregado5='".$_POST["entregado5"]."', fecha_r5='".$_POST["fecha_r5"]."',
						entregado6='".$_POST["entregado6"]."', fecha_r6='".$_POST["fecha_r6"]."',
						entregado7='".$_POST["entregado7"]."', fecha_r7='".$_POST["fecha_r7"]."',
						entregado8='".$_POST["entregado8"]."', fecha_r8='".$_POST["fecha_r8"]."',
						entregado9='".$_POST["entregado9"]."', fecha_r9='".$_POST["fecha_r9"]."',
						entregado10='".$_POST["entregado10"]."', fecha_r10='".$_POST["fecha_r10"]."',
						entregado11='".$_POST["entregado11"]."', fecha_r11='".$_POST["fecha_r11"]."',
						entregado12='".$_POST["entregado12"]."', fecha_r12='".$_POST["fecha_r12"]."',
						entregado13='".$_POST["entregado13"]."', fecha_r13='".$_POST["fecha_r13"]."',
						entregado14='".$_POST["entregado14"]."', fecha_r14='".$_POST["fecha_r14"]."',
						entregado15='".$_POST["entregado15"]."', fecha_r15='".$_POST["fecha_r15"]."',
						entregado16='".$_POST["entregado16"]."', fecha_r16='".$_POST["fecha_r16"]."',
						entregado17='".$_POST["entregado17"]."', fecha_r17='".$_POST["fecha_r17"]."',
						entregado18='".$_POST["entregado18"]."', fecha_r18='".$_POST["fecha_r18"]."',
						entregado19='".$_POST["entregado19"]."', fecha_r19='".$_POST["fecha_r19"]."',
						entregado20='".$_POST["entregado20"]."', fecha_r20='".$_POST["fecha_r20"]."' WHERE id_pedido='".$_POST["id"]."'";
						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());

						echo "<script languaje='javascript'>
										alert('Se han modificado los datos del pedido con folio ".$_POST["folio"]."')
				javascript:history.go(-2)
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

								$mail->Username = "compras@grupocavi.com.mx";
								$mail->Password = ")Cl5l4!ALD]A";
								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS');          
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';

								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estado.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 

									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								if(!$mail->Send())
								{
									echo "Fallo";
								}

								else 
								{
									echo "Éxito";
								}
					}

				else

				{
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
                <select name="tipo_cotizacion" class="form-control input-sm "readonly>
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
  							<input readonly name="fecha_requerido" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_requerido']; ?>">
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
                <input readonly name="ubicacion" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['ubicacion_obra']); ?>">
              </div>
            <div class="col-xs-4">
							<label class="control-label">Lugar de Cotización</label>
		           <input readonly name="lugar_cotizacion" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['lugar_cotizacion']); ?>">
						</div>
				<div class="col-xs-4">
					<label class="control-label">Proyecto</label>
           <input readonly name="proyecto" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['proyecto']); ?>">
				</div>
						</div>
						<div class="row form-horizontal">
						<div class="col-xs-10">
							<input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id_pedido']; ?>" size="17" />
						</div>
										<div class="col-xs-2">
												<label class="control-label">Estado</label>
													<select name="estado" class="form-control input-sm" required>
														<option class="form-control input-sm"><?php  echo $Rs['estado']; ?></option>
														<option class="form-control input-sm" name=uno value="Recibido">Recibido</option>
														<option class="form-control input-sm" name=uno value="Revisar Notas">Revisar Notas</option>
														<option class="form-control input-sm" name=uno value="Cotizando Parcial">Cotizando Parcial</option>
														<option class="form-control input-sm" name=uno value="Entregado Parcial">Entregado Parcial</option>
														<option class="form-control input-sm" name=uno value="Entregado">Entregado</option>
													</select>
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
    							<input readonly type="text" class="form-control input-sm" name="descripcion1" value="<?php echo htmlspecialchars($Rs['desc1']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
               	  				<label class="control-label">Unidad</label>
    							<input readonly type="text" name="unidad1" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid1']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
                        <label class="control-label">Entregado</label>
						<select name="entregado1" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado1']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
  							<label class="control-label">Fecha</label>
  							<input name="fecha_r1" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r1']; ?>">
  						</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">2.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion2" value="<?php echo htmlspecialchars($Rs['desc2']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad2" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid2']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado2" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado2']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r2" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r2']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">3.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion3" value="<?php echo htmlspecialchars($Rs['desc3']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad3" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid3']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado3" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado3']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r3" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r3']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">4.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion4"value="<?php echo htmlspecialchars($Rs['desc4']); ?>" >
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad4" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid4']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado4" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado4']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r4" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r4']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">5.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion5" value="<?php echo htmlspecialchars($Rs['desc5']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad5" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid5']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado5" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado5']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r5" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r5']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">6.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion6" value="<?php echo htmlspecialchars($Rs['desc6']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad6" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid6']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado6" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado6']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r6" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r6']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">7.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion7" value="<?php echo htmlspecialchars($Rs['desc7']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad7" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid7']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado7" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado7']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r7" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r7']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">8.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion8" value="<?php echo htmlspecialchars($Rs['desc8']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad8" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid8']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado8" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado8']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r8" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r8']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">9.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion9" value="<?php echo htmlspecialchars($Rs['desc9']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad9" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid9']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado9" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado9']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r9" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r9']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">10.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion10" value="<?php echo htmlspecialchars($Rs['desc10']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad10" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid10']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado10" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado10']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r10" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r10']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">11.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion11" value="<?php echo htmlspecialchars($Rs['desc11']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad11" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid11']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado11" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado11']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r11" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r11']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">12.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion12" value="<?php echo htmlspecialchars($Rs['desc12']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad12" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid12']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado12" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado12']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r12" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r12']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">13.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion13" value="<?php echo htmlspecialchars($Rs['desc13']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad13" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid13']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado13" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado13']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r13" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r13']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">14.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion14" value="<?php echo htmlspecialchars($Rs['desc14']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad14" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid14']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado14" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado14']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r14" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r14']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">15.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion15" value="<?php echo htmlspecialchars($Rs['desc15']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad15" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid15']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entreado15" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado15']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r15" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r15']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">16.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion16" value="<?php echo htmlspecialchars($Rs['desc16']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad16" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid16']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado16" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado16']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r16" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r16']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">17.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion17" value="<?php echo htmlspecialchars($Rs['desc17']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad17" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid17']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado17" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado17']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r17" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r17']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">18.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion18" value="<?php echo htmlspecialchars($Rs['desc18']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad18" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid18']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado18" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado18']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r18" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r18']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">19.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion19" value="<?php echo htmlspecialchars($Rs['desc19']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad19" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid19']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado19" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado19']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r19" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r19']; ?>">
				</div>
						</div>
						<div class="row form-horizontal">	
							<!--Campo Descripcion-->
              <div class="col-xs-1">
                    <label class="control-label">20.</label>
                  </div>
  							<div class="col-xs-5">
    							<input readonly type="text" class="form-control input-sm" name="descripcion20" value="<?php echo htmlspecialchars($Rs['desc20']); ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input readonly type="text" name="unidad20" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid20']); ?>">
  							</div>
                <!--Campo Uso-->
                <div class="col-xs-2">
				<select name="entregado20" class="form-control input-sm">
							<option class="form-control input-sm"><?php  echo $Rs['entregado20']; ?></option>
							<option class="form-control input-sm" name=uno value="Si">Si</option>
							<option class="form-control input-sm" name=uno value="No">No</option>
						</select>
                </div>
				<div class="col-xs-2">
					<input name="fecha_r20" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_r20']; ?>">
				</div>
						</div>
            <div class="row form-horizontal">
            <!--Caja de notas-->
              <div class="col-xs-12">
                <label class="control-label">Notas</label>
                <textarea  name="notas" class="form-control "><?php echo htmlspecialchars($Rs['notas']); ?></textarea>
              </div>
            </div>
			<div class="row form-horizontal">
              	<div class="col-xs-2">
                    <label class="control-label">Cotizaciones Entregadas</label>
                	<input name="cotizaciones_entregadas" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['cotizaciones_entregadas']); ?>">
              	</div>
			</div>
			<div class="row form-horizontal">
              	<div class="col-xs-5">
					<label class="control-label">Proveedores Contactados</label>
                	<?php
						mysql_query("SET NAMES 'UTF8'");
						$consulta_mysql='select * from proveedores ORDER BY razon_social ASC';
						$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
						echo "<select name='prov_contact1' class='form-control input-sm'>";
						echo "<option> {$Rs['prov_contact1']}</option>";
						while($fila=mysql_fetch_array($resultado_consulta_mysql)){
								echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";

						}

						echo "</select>";

					?>
					<?php
						mysql_query("SET NAMES 'UTF8'");
						$consulta_mysql='select * from proveedores ORDER BY razon_social ASC';
						$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
						echo "<select name='prov_contact2' class='form-control input-sm'>";
						echo "<option> {$Rs['prov_contact2']}</option>";
						while($fila=mysql_fetch_array($resultado_consulta_mysql)){
								echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";

						}

						echo "</select>";

					?>
					<?php
						mysql_query("SET NAMES 'UTF8'");
						$consulta_mysql='select * from proveedores ORDER BY razon_social ASC';
						$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
						echo "<select name='prov_contact3' class='form-control input-sm'>";
						echo "<option> {$Rs['prov_contact3']}</option>";
						while($fila=mysql_fetch_array($resultado_consulta_mysql)){
								echo "<option value='".$fila['razon_social']."'>".$fila['razon_social']."</option>";

						}

						echo "</select>";

					?>
					<input name="prov_contact4" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['prov_contact4']); ?>">
					<input name="prov_contact5" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['prov_contact5']); ?>">
              	</div>
			</div>
			<br>
									<div id="btn-form">
										<input class="btn form-btn btn-primary" type="submit" name="submit" value="Guardar">
								</div>

								<br>

							</form>

								<?php       

							}

						}
						else{

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