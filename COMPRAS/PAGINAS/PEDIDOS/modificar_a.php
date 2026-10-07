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
                    <li><a href="epp_gen_a">EPP</a></li>
                    <li><a href="examenes_gen_a">Exámenes Médicos</a></li>
                    <li><a href="insumos_gen_a">Insumos Méd/Lab</a></li>
                    <li><a href="papeleria_gen_a">Papelería</a></li>
                    <li><a href="material_gen_a">Generales</a></li>
                    <li><a href="productos_gen_a">Prod. Limpieza</a></li>
                    <li><a href="agencias_gen_a">Serv. Agencia</a></li>
                    <li><a href="toner_gen_a">Toner</a></li>
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
							$folio = $_POST['folio'];
							$enviado = "No enviado";
							$autorizado='No Autorizado';
							$supervisor_nom = $_POST['supervisor'];
							$result = mysql_query("SELECT * FROM supervisor WHERE nombre='$supervisor_nom'");

							while($rowS = mysql_fetch_array($result))
							{
								$mail_sup = $rowS['correo'];
							}

							$result2 = mysql_query("SELECT * FROM pedidos WHERE folio='$folio'");
						while($rowS2 = mysql_fetch_array($result2))
						{
							$mail_ger = $rowS2['gerencia'];
						}

							$mailto = $mail_sup; //Correo del destinatario

							if($mail_ger == 'GCHSO') //Correo del gerente correspondiente
							{
								$mailcc = 'diana_marisela_hinojoza@grupocavi.com.mx';
							}

							else if($mail_ger == 'GCI') //Correo del gerente correspondiente
							{
								$mailcc = 'yasmin_gonzalez@grupocavi.com.mx';
							}
							else if($mail_ger == 'DLyA') //Correo del gerente correspondiente
							{
								$mailcc = 'airam_ramirez@grupocavi.com.mx';
							}

							else if($mail_ger == 'NOMINAS') //Correo del gerente correspondiente
							{
								$mailcc = 'angeles_ortiz@grupocavi.com.mx';
							}

							else if($mail_ger == 'GCSO1') //Correo del gerente correspondiente
							{
								$mailcc = 'moises_fernandez@grupocavi.com.mx';
							}

							else if($mail_ger == 'GCSO2') //Correo del gerente correspondiente
							{
								$mailcc = 'arturo_castrejon@grupocavi.com.mx';
							}

							else if($mail_ger == 'GF') //Correo del gerente correspondiente
							{
								$mailcc = 'rocio_martinez@grupocavi.com.mx';
							}

							else if($mail_ger == 'GLP') //Correo del gerente correspondiente
							{
								$mailcc = 'elizabeth_gomez@grupocavi.com.mx';
							}

							else if($mail_ger == 'GOAF') //Correo del gerente correspondiente
							{
								$mailcc = 'luisadrian_castrejon@grupocavi.com.mx';
							}

							else if($mail_ger == 'GSIM') //Correo del gerente correspondiente
							{
								$mailcc = 'segovia_manuel@grupocavi.com.mx';
							}

							else if($mail_ger == 'GSST') //Correo del gerente correspondiente
							{
								$mailcc = 'maricruz_flores@grupocavi.com.mx';
							}

							else if($mail_ger == 'CONCRETOS') //Correo del gerente correspondiente
							{
								$mailcc = 'antonio_ulloa@grupocavi.com.mx';
							}
							else if($mail_ger == 'GOC') //Correo del gerente correspondiente
							{
								$mailcc = 'carlos_castrejon@grupocavi.com.mx';
							}

							$folio = nl2br($_POST['folio']); //Folio del pedido
							$estatus = nl2br($_POST['estado']); //Estatus del pedido

					if(isset($_POST["submit"]) AND $estado == 'Revisar Notas')
					{
						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', fecha_revision='".$_POST["fecha_seguimiento"]."', notas_seguimiento='".$_POST["notas_seguimiento"]."', enviado='$enviado', autorizado='$autorizado' WHERE id_pedido='".$_POST["id"]."'";

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
								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS AF');           
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';
								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
								$mail->AddCC($mailcc);
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
						$sql_id = "INSERT INTO folios_af SET idsdgg='0'";
						$result_id = mysql_query($sql_id) or die(mysql_error());
						$id_id = mysql_insert_id();
						$folio_id =  strtoupper( "GER-C ".str_pad($id_id,3,'0',STR_PAD_LEFT).date("/ y"));
						$sql = "UPDATE folios_af SET folio='".$folio_id."' WHERE id='".$id_id."'";
						$result = mysql_query($sql) or die(mysql_error());
						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', fecha='".$_POST["fecha_seguimiento"]."', fecha_recibido='".$_POST["fecha_seguimiento"]."', notas_seguimiento='".$_POST["notas_seguimiento"]."', observaciones='".$_POST["observaciones"]."', folio_af='".$folio_id."' WHERE id_pedido='".$_POST["id"]."'";
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
								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS AF');           
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';
								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								$mail->AddCC($mailcc);
								if(!$mail->Send())
								{
									echo "Fallo";
								}
								else 
								{
									echo "Éxito";
								}
					}
					else if(isset($_POST["submit"]) AND $estado == 'Revisión Solicitante')
					{
						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', fecha_rev_sol='".$_POST["fecha_seguimiento"]."', notas_seguimiento='".$_POST["notas_seguimiento"]."', observaciones='".$_POST["observaciones"]."',folio_af='".$_POST["folio_af"]."' WHERE id_pedido='".$_POST["id"]."'";

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
								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS AF');           
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';
								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
								$mail->AddCC($mailcc);
								if(!$mail->Send())
								{
									echo "Fallo";
								}

								else 
								{
									echo "Éxito";
								}
					}
					else if(isset($_POST["submit"]) AND $estado == 'Detenido')
					{
						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', fecha_detenido='".$_POST["fecha_seguimiento"]."', notas_seguimiento='".$_POST["notas_seguimiento"]."', observaciones='".$_POST["observaciones"]."',folio_af='".$_POST["folio_af"]."' WHERE id_pedido='".$_POST["id"]."'";

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
								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS AF');           
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';
								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
								$mail->AddCC($mailcc);
								if(!$mail->Send())
								{
									echo "Fallo";
								}

								else 
								{
									echo "Éxito";
								}
					}
					else if(isset($_POST["submit"]) AND $estado == 'Surtido en Almacen')
					{
						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', notas_seguimiento='".$_POST["notas_seguimiento"]."', observaciones='".$_POST["observaciones"]."',folio_af='".$_POST["folio_af"]."' WHERE id_pedido='".$_POST["id"]."'";

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

								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								$mail->AddCC($mailcc);
								if(!$mail->Send())
								{
									echo "Fallo";
								}
								else 
								{
									echo "Éxito";
								}
					}
					else if(isset($_POST["submit"]) AND $estado == 'Solicitud Surtido')
					{
						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', notas_seguimiento='".$_POST["notas_seguimiento"]."', observaciones='".$_POST["observaciones"]."',folio_af='".$_POST["folio_af"]."' WHERE id_pedido='".$_POST["id"]."'";

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

								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								$mail->AddCC($mailcc);
								if(!$mail->Send())
								{
									echo "Fallo";
								}
								else 
								{
									echo "Éxito";
								}
					}
					else if(isset($_POST["submit"]) AND $estado == 'En Almacen')
					{
						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', fecha_enalmacen='".$_POST["fecha_seguimiento"]."', notas_seguimiento='".$_POST["notas_seguimiento"]."', observaciones='".$_POST["observaciones"]."',folio_af='".$_POST["folio_af"]."' WHERE id_pedido='".$_POST["id"]."'";

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
								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS AF');           
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';
								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";

								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								$mail->AddCC($mailcc);
								if(!$mail->Send())
								{
									echo "Fallo";
								}

								else 
								{
									echo "Éxito";
								}
					}

					else if(isset($_POST["submit"]) AND $estado == 'Recabando doctos')
					{
						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', fecha_rev_proveedor='".$_POST["fecha_seguimiento"]."', notas_seguimiento='".$_POST["notas_seguimiento"]."', observaciones='".$_POST["observaciones"]."',folio_af='".$_POST["folio_af"]."' WHERE id_pedido='".$_POST["id"]."'";

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
								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS AF');           
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';
								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";

								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								$mail->AddCC($mailcc);



								if(!$mail->Send())

								{

									echo "Fallo";

								}

								else 

								{

									echo "Éxito";

								}

					}

					else if(isset($_POST["submit"]) AND $estado == 'Cotizando')

					{

						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', fecha_cotizando='".$_POST["fecha_seguimiento"]."', notas_seguimiento='".$_POST["notas_seguimiento"]."', observaciones='".$_POST["observaciones"]."',folio_af='".$_POST["folio_af"]."' WHERE id_pedido='".$_POST["id"]."'";

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



								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS AF');           

								$mail->AddAddress($mailto);



								$mail->WordWrap = 50;

								$mail->IsHTML(true);

								$mail->CharSet = 'UTF-8';



								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";

								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 

									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								$mail->AddCC($mailcc);



								if(!$mail->Send())

								{

									echo "Fallo";

								}

								else 

								{

									echo "Éxito";

								}

					}

					 else if(isset($_POST["submit"]) AND $estado == 'En proceso de surtir')

					{

						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', fecha_proceso_surtir='".$_POST["fecha_seguimiento"]."', tiempo_espera1='".$_POST["tiempo_espera1"]."', tiempo_espera2='".$_POST["tiempo_espera2"]."', tiempo_espera3='".$_POST["tiempo_espera3"]."', tiempo_espera4='".$_POST["tiempo_espera4"]."', tiempo_espera5='".$_POST["tiempo_espera5"]."', tiempo_espera6='".$_POST["tiempo_espera6"]."', tiempo_espera7='".$_POST["tiempo_espera7"]."', tiempo_espera8='".$_POST["tiempo_espera8"]."', tiempo_espera9='".$_POST["tiempo_espera9"]."', tiempo_espera10='".$_POST["tiempo_espera10"]."', tiempo_espera11='".$_POST["tiempo_espera11"]."', tiempo_espera12='".$_POST["tiempo_espera12"]."',tiempo_espera13='".$_POST["tiempo_espera13"]."', tiempo_espera14='".$_POST["tiempo_espera14"]."', tiempo_espera15='".$_POST["tiempo_espera15"]."', tiempo_espera16='".$_POST["tiempo_espera16"]."', tiempo_espera17='".$_POST["tiempo_espera17"]."', tiempo_espera18='".$_POST["tiempo_espera18"]."', tiempo_espera19='".$_POST["tiempo_espera19"]."', tiempo_espera20='".$_POST["tiempo_espera20"]."', tiempo_espera21='".$_POST["tiempo_espera21"]."', tiempo_espera22='".$_POST["tiempo_espera22"]."', tiempo_espera23='".$_POST["tiempo_espera23"]."', tiempo_espera24='".$_POST["tiempo_espera24"]."', tiempo_espera25='".$_POST["tiempo_espera25"]."', tiempo_espera26='".$_POST["tiempo_espera26"]."', tiempo_espera27='".$_POST["tiempo_espera27"]."', tiempo_espera28='".$_POST["tiempo_espera28"]."', tiempo_espera29='".$_POST["tiempo_espera29"]."', tiempo_espera30='".$_POST["tiempo_espera30"]."', tiempo_espera31='".$_POST["tiempo_espera31"]."', tiempo_espera32='".$_POST["tiempo_espera32"]."', tiempo_espera33='".$_POST["tiempo_espera33"]."', tiempo_espera34='".$_POST["tiempo_espera34"]."', tiempo_espera35='".$_POST["tiempo_espera35"]."', tiempo_espera36='".$_POST["tiempo_espera36"]."', tiempo_espera37='".$_POST["tiempo_espera37"]."', tiempo_espera38='".$_POST["tiempo_espera38"]."', tiempo_espera39='".$_POST["tiempo_espera39"]."', tiempo_espera40='".$_POST["tiempo_espera40"]."', tiempo_espera41='".$_POST["tiempo_espera41"]."', tiempo_espera42='".$_POST["tiempo_espera42"]."', tiempo_espera43='".$_POST["tiempo_espera43"]."', tiempo_espera44='".$_POST["tiempo_espera44"]."', tiempo_espera45='".$_POST["tiempo_espera45"]."', tiempo_espera46='".$_POST["tiempo_espera46"]."', tiempo_espera47='".$_POST["tiempo_espera47"]."', tiempo_espera48='".$_POST["tiempo_espera48"]."', tiempo_espera49='".$_POST["tiempo_espera49"]."', tiempo_espera50='".$_POST["tiempo_espera50"]."', notas_seguimiento='".$_POST["notas_seguimiento"]."', observaciones='".$_POST["observaciones"]."', folio_af='".$_POST["folio_af"]."' WHERE id_pedido='".$_POST["id"]."'";

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



								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS AF');           

								$mail->AddAddress($mailto);



								$mail->WordWrap = 50;

								$mail->IsHTML(true);

								$mail->CharSet = 'UTF-8';



								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";

								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 

									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								$mail->AddCC($mailcc);



								if(!$mail->Send())

								{

									echo "Fallo";

								}

								else 

								{

									echo "Éxito";

								}

					}

					else if(isset($_POST["submit"]) AND $estado == 'Autorizado para Compra')

					{

						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', fecha_pagado='".$_POST["fecha_seguimiento"]."', tiempo_espera1='".$_POST["tiempo_espera1"]."', tiempo_espera2='".$_POST["tiempo_espera2"]."', tiempo_espera3='".$_POST["tiempo_espera3"]."', tiempo_espera4='".$_POST["tiempo_espera4"]."', tiempo_espera5='".$_POST["tiempo_espera5"]."', tiempo_espera6='".$_POST["tiempo_espera6"]."', tiempo_espera7='".$_POST["tiempo_espera7"]."', tiempo_espera8='".$_POST["tiempo_espera8"]."', tiempo_espera9='".$_POST["tiempo_espera9"]."', tiempo_espera10='".$_POST["tiempo_espera10"]."', tiempo_espera11='".$_POST["tiempo_espera11"]."', tiempo_espera12='".$_POST["tiempo_espera12"]."',tiempo_espera13='".$_POST["tiempo_espera13"]."', tiempo_espera14='".$_POST["tiempo_espera14"]."', tiempo_espera15='".$_POST["tiempo_espera15"]."', tiempo_espera16='".$_POST["tiempo_espera16"]."', tiempo_espera17='".$_POST["tiempo_espera17"]."', tiempo_espera18='".$_POST["tiempo_espera18"]."', tiempo_espera19='".$_POST["tiempo_espera19"]."', tiempo_espera20='".$_POST["tiempo_espera20"]."', tiempo_espera21='".$_POST["tiempo_espera21"]."', tiempo_espera22='".$_POST["tiempo_espera22"]."', tiempo_espera23='".$_POST["tiempo_espera23"]."', tiempo_espera24='".$_POST["tiempo_espera24"]."', tiempo_espera25='".$_POST["tiempo_espera25"]."', tiempo_espera26='".$_POST["tiempo_espera26"]."', tiempo_espera27='".$_POST["tiempo_espera27"]."', tiempo_espera28='".$_POST["tiempo_espera28"]."', tiempo_espera29='".$_POST["tiempo_espera29"]."', tiempo_espera30='".$_POST["tiempo_espera30"]."', tiempo_espera31='".$_POST["tiempo_espera31"]."', tiempo_espera32='".$_POST["tiempo_espera32"]."', tiempo_espera33='".$_POST["tiempo_espera33"]."', tiempo_espera34='".$_POST["tiempo_espera34"]."', tiempo_espera35='".$_POST["tiempo_espera35"]."', tiempo_espera36='".$_POST["tiempo_espera36"]."', tiempo_espera37='".$_POST["tiempo_espera37"]."', tiempo_espera38='".$_POST["tiempo_espera38"]."', tiempo_espera39='".$_POST["tiempo_espera39"]."', tiempo_espera40='".$_POST["tiempo_espera40"]."', tiempo_espera41='".$_POST["tiempo_espera41"]."', tiempo_espera42='".$_POST["tiempo_espera42"]."', tiempo_espera43='".$_POST["tiempo_espera43"]."', tiempo_espera44='".$_POST["tiempo_espera44"]."', tiempo_espera45='".$_POST["tiempo_espera45"]."', tiempo_espera46='".$_POST["tiempo_espera46"]."', tiempo_espera47='".$_POST["tiempo_espera47"]."', tiempo_espera48='".$_POST["tiempo_espera48"]."', tiempo_espera49='".$_POST["tiempo_espera49"]."', tiempo_espera50='".$_POST["tiempo_espera50"]."', credito1='".$_POST["credito1"]."', credito2='".$_POST["credito2"]."', credito3='".$_POST["credito3"]."', credito4='".$_POST["credito4"]."', credito5='".$_POST["credito5"]."', credito6='".$_POST["credito6"]."', credito7='".$_POST["credito7"]."', credito8='".$_POST["credito8"]."', credito9='".$_POST["credito9"]."', credito10='".$_POST["credito10"]."', credito11='".$_POST["credito11"]."', credito12='".$_POST["credito12"]."',credito13='".$_POST["credito13"]."', credito14='".$_POST["credito14"]."', credito15='".$_POST["credito15"]."', credito16='".$_POST["credito16"]."', credito17='".$_POST["credito17"]."', credito18='".$_POST["credito18"]."', credito19='".$_POST["credito19"]."', credito20='".$_POST["credito20"]."', credito21='".$_POST["credito21"]."', credito22='".$_POST["credito22"]."', credito23='".$_POST["credito23"]."', credito24='".$_POST["credito24"]."', credito25='".$_POST["credito25"]."', credito26='".$_POST["credito26"]."', credito27='".$_POST["credito27"]."', credito28='".$_POST["credito28"]."', credito29='".$_POST["credito29"]."', credito30='".$_POST["credito30"]."', credito31='".$_POST["credito31"]."', credito32='".$_POST["credito32"]."', credito33='".$_POST["credito33"]."', credito34='".$_POST["credito34"]."', credito35='".$_POST["credito35"]."', credito36='".$_POST["credito36"]."', credito37='".$_POST["credito37"]."', credito38='".$_POST["credito38"]."', credito39='".$_POST["credito39"]."', credito40='".$_POST["credito40"]."', credito41='".$_POST["credito41"]."', credito42='".$_POST["credito42"]."', credito43='".$_POST["credito43"]."', credito44='".$_POST["credito44"]."', credito45='".$_POST["credito45"]."', credito46='".$_POST["credito46"]."', credito47='".$_POST["credito47"]."', credito48='".$_POST["credito48"]."', credito49='".$_POST["credito49"]."', credito50='".$_POST["credito50"]."', notas_seguimiento='".$_POST["notas_seguimiento"]."', observaciones='".$_POST["observaciones"]."', monto_credito='".$_POST["monto_credito"]."', monto_mxn='".$_POST["monto_mxn"]."',  folio_af='".$_POST["folio_af"]."' WHERE id_pedido='".$_POST["id"]."'";

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



								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS AF');           

								$mail->AddAddress($mailto);



								$mail->WordWrap = 50;

								$mail->IsHTML(true);

								$mail->CharSet = 'UTF-8';



								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";

								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 

									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								$mail->AddCC($mailcc);



								if(!$mail->Send())

								{

									echo "Fallo";

								}

								else 

								{

									echo "Éxito";

								}

					}

					else if(isset($_POST["submit"]) AND $estado == 'Surtido Parcial')

					{

						$parts = explode('-', $_POST['fecha_seguimiento']);

						$date  = "$parts[2]-$parts[1]-$parts[0]";



						$parts1 = explode('-', $_POST['fecha_pago_1']);

						$date1  = "$parts1[2]-$parts1[1]-$parts1[0]";

						$parts2 = explode('-', $_POST['fecha_pago_2']);

						$date2  = "$parts2[2]-$parts2[1]-$parts2[0]";

						$parts3 = explode('-', $_POST['fecha_pago_3']);

						$date3  = "$parts3[2]-$parts3[1]-$parts3[0]";

						$parts4 = explode('-', $_POST['fecha_pago_4']);

						$date4  = "$parts4[2]-$parts4[1]-$parts4[0]";

						$parts5 = explode('-', $_POST['fecha_pago_5']);

						$date5  = "$parts5[2]-$parts5[1]-$parts5[0]";

						$parts6 = explode('-', $_POST['fecha_pago_6']);

						$date6  = "$parts6[2]-$parts6[1]-$parts6[0]";

						$parts7 = explode('-', $_POST['fecha_pago_7']);

						$date7  = "$parts7[2]-$parts7[1]-$parts7[0]";

						$parts8 = explode('-', $_POST['fecha_pago_8']);

						$date8  = "$parts8[2]-$parts8[1]-$parts8[0]";

						$parts9 = explode('-', $_POST['fecha_pago_9']);

						$date9  = "$parts9[2]-$parts9[1]-$parts9[0]";

						$parts10 = explode('-', $_POST['fecha_pago_10']);

						$date10  = "$parts10[2]-$parts10[1]-$parts10[0]";

						$parts11 = explode('-', $_POST['fecha_pago_11']);

						$date11  = "$parts11[2]-$parts11[1]-$parts11[0]";

						$parts12 = explode('-', $_POST['fecha_pago_12']);

						$date12  = "$parts12[2]-$parts12[1]-$parts12[0]";

						$parts13 = explode('-', $_POST['fecha_pago_13']);

						$date13  = "$parts13[2]-$parts13[1]-$parts13[0]";

						$parts14 = explode('-', $_POST['fecha_pago_14']);

						$date14  = "$parts14[2]-$parts14[1]-$parts14[0]";

						$parts15 = explode('-', $_POST['fecha_pago_15']);

						$date15  = "$parts15[2]-$parts15[1]-$parts15[0]";

						$parts16 = explode('-', $_POST['fecha_pago_16']);

						$date16  = "$parts16[2]-$parts16[1]-$parts16[0]";

						$parts17 = explode('-', $_POST['fecha_pago_17']);

						$date17  = "$parts17[2]-$parts17[1]-$parts17[0]";

						$parts18 = explode('-', $_POST['fecha_pago_18']);

						$date18  = "$parts18[2]-$parts18[1]-$parts18[0]";

						$parts19 = explode('-', $_POST['fecha_pago_19']);

						$date19  = "$parts19[2]-$parts19[1]-$parts19[0]";

						$parts20 = explode('-', $_POST['fecha_pago_20']);

						$date20  = "$parts20[2]-$parts20[1]-$parts20[0]";

						$parts21 = explode('-', $_POST['fecha_pago_21']);

						$date21  = "$parts21[2]-$parts21[1]-$parts21[0]";

						$parts22 = explode('-', $_POST['fecha_pago_22']);

						$date22  = "$parts22[2]-$parts22[1]-$parts22[0]";

						$parts23 = explode('-', $_POST['fecha_pago_23']);

						$date23  = "$parts23[2]-$parts23[1]-$parts23[0]";

						$parts24 = explode('-', $_POST['fecha_pago_24']);

						$date24  = "$parts24[2]-$parts24[1]-$parts24[0]";

						$parts25 = explode('-', $_POST['fecha_pago_25']);

						$date25  = "$parts25[2]-$parts25[1]-$parts25[0]";

						$parts26 = explode('-', $_POST['fecha_pago_26']);

						$date26  = "$parts26[2]-$parts26[1]-$parts26[0]";

						$parts27 = explode('-', $_POST['fecha_pago_27']);

						$date27  = "$parts27[2]-$parts27[1]-$parts27[0]";

						$parts28 = explode('-', $_POST['fecha_pago_28']);

						$date28  = "$parts28[2]-$parts28[1]-$parts28[0]";

						$parts29 = explode('-', $_POST['fecha_pago_29']);

						$date29  = "$parts29[2]-$parts29[1]-$parts29[0]";

						$parts30 = explode('-', $_POST['fecha_pago_30']);

						$date30  = "$parts30[2]-$parts30[1]-$parts30[0]";

						$parts31 = explode('-', $_POST['fecha_pago_31']);

						$date31  = "$parts31[2]-$parts31[1]-$parts31[0]";

						$parts32 = explode('-', $_POST['fecha_pago_32']);

						$date32  = "$parts32[2]-$parts32[1]-$parts32[0]";

						$parts33 = explode('-', $_POST['fecha_pago_33']);

						$date33  = "$parts33[2]-$parts33[1]-$parts33[0]";

						$parts34 = explode('-', $_POST['fecha_pago_34']);

						$date34  = "$parts34[2]-$parts34[1]-$parts34[0]";

						$parts35 = explode('-', $_POST['fecha_pago_35']);

						$date35  = "$parts35[2]-$parts35[1]-$parts35[0]";

						$parts36 = explode('-', $_POST['fecha_pago_36']);

						$date36  = "$parts36[2]-$parts36[1]-$parts36[0]";

						$parts37 = explode('-', $_POST['fecha_pago_37']);

						$date37  = "$parts37[2]-$parts37[1]-$parts37[0]";

						$parts38 = explode('-', $_POST['fecha_pago_38']);

						$date38  = "$parts38[2]-$parts38[1]-$parts38[0]";

						$parts39 = explode('-', $_POST['fecha_pago_39']);

						$date39  = "$parts39[2]-$parts39[1]-$parts39[0]";

						$parts40 = explode('-', $_POST['fecha_pago_40']);

						$date40  = "$parts40[2]-$parts40[1]-$parts40[0]";

						$parts41 = explode('-', $_POST['fecha_pago_41']);

						$date41  = "$parts41[2]-$parts41[1]-$parts41[0]";

						$parts42 = explode('-', $_POST['fecha_pago_42']);

						$date42  = "$parts42[2]-$parts42[1]-$parts42[0]";

						$parts43 = explode('-', $_POST['fecha_pago_43']);

						$date43  = "$parts43[2]-$parts43[1]-$parts43[0]";

						$parts44 = explode('-', $_POST['fecha_pago_44']);

						$date44  = "$parts44[2]-$parts44[1]-$parts44[0]";

						$parts45 = explode('-', $_POST['fecha_pago_45']);

						$date45  = "$parts45[2]-$parts45[1]-$parts45[0]";

						$parts46 = explode('-', $_POST['fecha_pago_46']);

						$date46  = "$parts46[2]-$parts46[1]-$parts46[0]";

						$parts47 = explode('-', $_POST['fecha_pago_47']);

						$date47  = "$parts47[2]-$parts47[1]-$parts47[0]";

						$parts48 = explode('-', $_POST['fecha_pago_48']);

						$date48  = "$parts48[2]-$parts48[1]-$parts48[0]";

						$parts49 = explode('-', $_POST['fecha_pago_49']);

						$date49  = "$parts49[2]-$parts49[1]-$parts49[0]";

						$parts50 = explode('-', $_POST['fecha_pago_50']);

						$date50  = "$parts50[2]-$parts50[1]-$parts50[0]";



						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', fecha_surtido_parcial='$date',monto_credito='".$_POST["monto_credito"]."', monto_mxn='".$_POST["monto_mxn"]."',  folio_af='".$_POST["folio_af"]."', surtido1='".$_POST["surtido1"]."', surtido2='".$_POST["surtido2"]."', surtido3='".$_POST["surtido3"]."', surtido4='".$_POST["surtido4"]."', surtido5='".$_POST["surtido5"]."', surtido6='".$_POST["surtido6"]."', surtido7='".$_POST["surtido7"]."', surtido8='".$_POST["surtido8"]."', surtido9='".$_POST["surtido9"]."', surtido10='".$_POST["surtido10"]."', surtido11='".$_POST["surtido11"]."', surtido12='".$_POST["surtido12"]."', surtido13='".$_POST["surtido13"]."', surtido14='".$_POST["surtido14"]."', surtido15='".$_POST["surtido15"]."', surtido16='".$_POST["surtido16"]."', surtido17='".$_POST["surtido17"]."', surtido18='".$_POST["surtido18"]."', surtido19='".$_POST["surtido19"]."', surtido20='".$_POST["surtido20"]."', surtido21='".$_POST["surtido21"]."', surtido22='".$_POST["surtido22"]."', surtido23='".$_POST["surtido23"]."', surtido24='".$_POST["surtido24"]."', surtido25='".$_POST["surtido25"]."', surtido26='".$_POST["surtido26"]."', surtido27='".$_POST["surtido27"]."', surtido28='".$_POST["surtido28"]."', surtido29='".$_POST["surtido29"]."', surtido30='".$_POST["surtido30"]."', surtido31='".$_POST["surtido31"]."', surtido32='".$_POST["surtido32"]."', surtido33='".$_POST["surtido33"]."', surtido34='".$_POST["surtido34"]."', surtido35='".$_POST["surtido35"]."', surtido36='".$_POST["surtido36"]."', surtido37='".$_POST["surtido37"]."', surtido38='".$_POST["surtido38"]."', surtido39='".$_POST["surtido39"]."', surtido40='".$_POST["surtido40"]."', surtido41='".$_POST["surtido41"]."', surtido42='".$_POST["surtido42"]."', surtido43='".$_POST["surtido43"]."', surtido44='".$_POST["surtido44"]."', surtido45='".$_POST["surtido45"]."', surtido46='".$_POST["surtido46"]."', surtido47='".$_POST["surtido47"]."', surtido48='".$_POST["surtido48"]."', surtido49='".$_POST["surtido49"]."', surtido50='".$_POST["surtido50"]."',tiempo_espera1='".$_POST["tiempo_espera1"]."', tiempo_espera2='".$_POST["tiempo_espera2"]."', tiempo_espera3='".$_POST["tiempo_espera3"]."', tiempo_espera4='".$_POST["tiempo_espera4"]."', tiempo_espera5='".$_POST["tiempo_espera5"]."', tiempo_espera6='".$_POST["tiempo_espera6"]."', tiempo_espera7='".$_POST["tiempo_espera7"]."', tiempo_espera8='".$_POST["tiempo_espera8"]."', tiempo_espera9='".$_POST["tiempo_espera9"]."', tiempo_espera10='".$_POST["tiempo_espera10"]."', tiempo_espera11='".$_POST["tiempo_espera11"]."', tiempo_espera12='".$_POST["tiempo_espera12"]."', tiempo_espera13='".$_POST["tiempo_espera13"]."', tiempo_espera14='".$_POST["tiempo_espera14"]."', tiempo_espera15='".$_POST["tiempo_espera15"]."', tiempo_espera16='".$_POST["tiempo_espera16"]."', tiempo_espera17='".$_POST["tiempo_espera17"]."', tiempo_espera18='".$_POST["tiempo_espera18"]."', tiempo_espera19='".$_POST["tiempo_espera19"]."', tiempo_espera20='".$_POST["tiempo_espera20"]."', tiempo_espera21='".$_POST["tiempo_espera21"]."', tiempo_espera22='".$_POST["tiempo_espera22"]."', tiempo_espera23='".$_POST["tiempo_espera23"]."', tiempo_espera24='".$_POST["tiempo_espera24"]."', tiempo_espera25='".$_POST["tiempo_espera25"]."', tiempo_espera26='".$_POST["tiempo_espera26"]."', tiempo_espera27='".$_POST["tiempo_espera27"]."', tiempo_espera28='".$_POST["tiempo_espera28"]."', tiempo_espera29='".$_POST["tiempo_espera29"]."', tiempo_espera30='".$_POST["tiempo_espera30"]."', tiempo_espera31='".$_POST["tiempo_espera31"]."', tiempo_espera32='".$_POST["tiempo_espera32"]."', tiempo_espera33='".$_POST["tiempo_espera33"]."', tiempo_espera34='".$_POST["tiempo_espera34"]."', tiempo_espera35='".$_POST["tiempo_espera35"]."', tiempo_espera36='".$_POST["tiempo_espera36"]."', tiempo_espera37='".$_POST["tiempo_espera37"]."', tiempo_espera38='".$_POST["tiempo_espera38"]."', tiempo_espera39='".$_POST["tiempo_espera39"]."', tiempo_espera40='".$_POST["tiempo_espera40"]."', tiempo_espera41='".$_POST["tiempo_espera41"]."', tiempo_espera42='".$_POST["tiempo_espera42"]."', tiempo_espera43='".$_POST["tiempo_espera43"]."', tiempo_espera44='".$_POST["tiempo_espera44"]."', tiempo_espera45='".$_POST["tiempo_espera45"]."', tiempo_espera46='".$_POST["tiempo_espera46"]."', tiempo_espera47='".$_POST["tiempo_espera47"]."', tiempo_espera48='".$_POST["tiempo_espera48"]."', tiempo_espera49='".$_POST["tiempo_espera49"]."', tiempo_espera50='".$_POST["tiempo_espera50"]."',credito1='".$_POST["credito1"]."', credito2='".$_POST["credito2"]."', credito3='".$_POST["credito3"]."', credito4='".$_POST["credito4"]."', credito5='".$_POST["credito5"]."', credito6='".$_POST["credito6"]."', credito7='".$_POST["credito7"]."', credito8='".$_POST["credito8"]."', credito9='".$_POST["credito9"]."', credito10='".$_POST["credito10"]."', credito11='".$_POST["credito11"]."', credito12='".$_POST["credito12"]."', credito13='".$_POST["credito13"]."', credito14='".$_POST["credito14"]."', credito15='".$_POST["credito15"]."', credito16='".$_POST["credito16"]."', credito17='".$_POST["credito17"]."', credito18='".$_POST["credito18"]."', credito19='".$_POST["credito19"]."', credito20='".$_POST["credito20"]."', credito21='".$_POST["credito21"]."', credito22='".$_POST["credito22"]."', credito23='".$_POST["credito23"]."', credito24='".$_POST["credito24"]."', credito25='".$_POST["credito25"]."', credito26='".$_POST["credito26"]."', credito27='".$_POST["credito27"]."', credito28='".$_POST["credito28"]."', credito29='".$_POST["credito29"]."', credito30='".$_POST["credito30"]."', credito31='".$_POST["credito31"]."', credito32='".$_POST["credito32"]."', credito33='".$_POST["credito33"]."', credito34='".$_POST["credito34"]."', credito35='".$_POST["credito35"]."', credito36='".$_POST["credito36"]."', credito37='".$_POST["credito37"]."', credito38='".$_POST["credito38"]."', credito39='".$_POST["credito39"]."', credito40='".$_POST["credito40"]."', credito41='".$_POST["credito41"]."', credito42='".$_POST["credito42"]."', credito43='".$_POST["credito43"]."', credito44='".$_POST["credito44"]."', credito45='".$_POST["credito45"]."', credito46='".$_POST["credito46"]."', credito47='".$_POST["credito47"]."', credito48='".$_POST["credito48"]."', credito49='".$_POST["credito49"]."', credito50='".$_POST["credito50"]."',fecha_pago_1='$date1', fecha_pago_2='$date2', fecha_pago_3='$date3', fecha_pago_4='$date4', fecha_pago_5='$date5', fecha_pago_6='$date6', fecha_pago_7='$date7', fecha_pago_8='$date8', fecha_pago_9='$date9', fecha_pago_10='$date10', fecha_pago_11='$date11', fecha_pago_12='$date12', fecha_pago_13='$date13', fecha_pago_14='$date14', fecha_pago_15='$date15', fecha_pago_16='$date16', fecha_pago_17='$date17', fecha_pago_18='$date18', fecha_pago_19='$date19', fecha_pago_20='$date20', fecha_pago_21='$date21', fecha_pago_22='$date22', fecha_pago_23='$date23', fecha_pago_24='$date24', fecha_pago_25='$date25', fecha_pago_26='$date26', fecha_pago_27='$date27', fecha_pago_28='$date28', fecha_pago_29='$date29', fecha_pago_30='$date30', fecha_pago_31='$date31', fecha_pago_32='$date32', fecha_pago_33='$date33', fecha_pago_34='$date34', fecha_pago_35='$date35', fecha_pago_36='$date36', fecha_pago_37='$date37', fecha_pago_38='$date38', fecha_pago_39='$date39', fecha_pago_40='$date40', fecha_pago_41='$date41', fecha_pago_42='$date42', fecha_pago_43='$date43', fecha_pago_44='$date44', fecha_pago_45='$date45', fecha_pago_46='$date46', fecha_pago_47='$date47', fecha_pago_48='$date48', fecha_pago_49='$date49', fecha_pago_50='$date50',entrega_1='".$_POST["entrega_1"]."', entrega_2='".$_POST["entrega_2"]."', entrega_3='".$_POST["entrega_3"]."', entrega_4='".$_POST["entrega_4"]."', entrega_5='".$_POST["entrega_5"]."', entrega_6='".$_POST["entrega_6"]."', entrega_7='".$_POST["entrega_7"]."', entrega_8='".$_POST["entrega_8"]."', entrega_9='".$_POST["entrega_9"]."', entrega_10='".$_POST["entrega_10"]."', entrega_11='".$_POST["entrega_11"]."', entrega_12='".$_POST["entrega_12"]."', entrega_13='".$_POST["entrega_13"]."', entrega_14='".$_POST["entrega_14"]."', entrega_15='".$_POST["entrega_15"]."', entrega_16='".$_POST["entrega_16"]."', entrega_17='".$_POST["entrega_17"]."', entrega_18='".$_POST["entrega_18"]."', entrega_19='".$_POST["entrega_19"]."', entrega_20='".$_POST["entrega_20"]."', entrega_21='".$_POST["entrega_21"]."', entrega_22='".$_POST["entrega_22"]."', entrega_23='".$_POST["entrega_23"]."', entrega_24='".$_POST["entrega_24"]."', entrega_25='".$_POST["entrega_25"]."', entrega_26='".$_POST["entrega_26"]."', entrega_27='".$_POST["entrega_27"]."', entrega_28='".$_POST["entrega_28"]."', entrega_29='".$_POST["entrega_29"]."', entrega_30='".$_POST["entrega_30"]."', entrega_31='".$_POST["entrega_31"]."', entrega_32='".$_POST["entrega_32"]."', entrega_33='".$_POST["entrega_33"]."', entrega_34='".$_POST["entrega_34"]."', entrega_35='".$_POST["entrega_35"]."', entrega_36='".$_POST["entrega_36"]."', entrega_37='".$_POST["entrega_37"]."', entrega_38='".$_POST["entrega_38"]."', entrega_39='".$_POST["entrega_39"]."', entrega_40='".$_POST["entrega_40"]."', entrega_41='".$_POST["entrega_41"]."', entrega_42='".$_POST["entrega_42"]."', entrega_43='".$_POST["entrega_43"]."', entrega_44='".$_POST["entrega_44"]."', entrega_45='".$_POST["entrega_45"]."', entrega_46='".$_POST["entrega_46"]."', entrega_47='".$_POST["entrega_47"]."', entrega_48='".$_POST["entrega_48"]."', entrega_49='".$_POST["entrega_49"]."', entrega_50='".$_POST["entrega_50"]."',recibe_1='".$_POST["recibe_1"]."', recibe_2='".$_POST["recibe_2"]."', recibe_3='".$_POST["recibe_3"]."', recibe_4='".$_POST["recibe_4"]."', recibe_5='".$_POST["recibe_5"]."', recibe_6='".$_POST["recibe_6"]."', recibe_7='".$_POST["recibe_7"]."', recibe_8='".$_POST["recibe_8"]."', recibe_9='".$_POST["recibe_9"]."', recibe_10='".$_POST["recibe_10"]."', recibe_11='".$_POST["recibe_11"]."', recibe_12='".$_POST["recibe_12"]."', recibe_13='".$_POST["recibe_13"]."', recibe_14='".$_POST["recibe_14"]."', recibe_15='".$_POST["recibe_15"]."', recibe_16='".$_POST["recibe_16"]."', recibe_17='".$_POST["recibe_17"]."', recibe_18='".$_POST["recibe_18"]."', recibe_19='".$_POST["recibe_19"]."', recibe_20='".$_POST["recibe_20"]."', recibe_21='".$_POST["recibe_21"]."', recibe_22='".$_POST["recibe_22"]."', recibe_23='".$_POST["recibe_23"]."', recibe_24='".$_POST["recibe_24"]."', recibe_25='".$_POST["recibe_25"]."', recibe_26='".$_POST["recibe_26"]."', recibe_27='".$_POST["recibe_27"]."', recibe_28='".$_POST["recibe_28"]."', recibe_29='".$_POST["recibe_29"]."', recibe_30='".$_POST["recibe_30"]."', recibe_31='".$_POST["recibe_31"]."', recibe_32='".$_POST["recibe_32"]."', recibe_33='".$_POST["recibe_33"]."', recibe_34='".$_POST["recibe_34"]."', recibe_35='".$_POST["recibe_35"]."', recibe_36='".$_POST["recibe_36"]."', recibe_37='".$_POST["recibe_37"]."', recibe_38='".$_POST["recibe_38"]."', recibe_39='".$_POST["recibe_39"]."', recibe_40='".$_POST["recibe_40"]."', recibe_41='".$_POST["recibe_41"]."', recibe_42='".$_POST["recibe_42"]."', recibe_43='".$_POST["recibe_43"]."', recibe_44='".$_POST["recibe_44"]."', recibe_45='".$_POST["recibe_45"]."', recibe_46='".$_POST["recibe_46"]."', recibe_47='".$_POST["recibe_47"]."', recibe_48='".$_POST["recibe_48"]."', recibe_49='".$_POST["recibe_49"]."', recibe_50='".$_POST["recibe_50"]."' WHERE id_pedido='".$_POST["id"]."'";

						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());



						$queryd = "UPDATE pedidos SET folio_af='".$_POST["folio_af"]."', firmado_1='".$_POST["firmado_1"]."', firmado_2='".$_POST["firmado_2"]."', firmado_3='".$_POST["firmado_3"]."', firmado_4='".$_POST["firmado_4"]."', firmado_5='".$_POST["firmado_5"]."', firmado_6='".$_POST["firmado_6"]."', firmado_7='".$_POST["firmado_7"]."', firmado_8='".$_POST["firmado_8"]."', firmado_9='".$_POST["firmado_9"]."', firmado_10='".$_POST["firmado_10"]."', firmado_11='".$_POST["firmado_11"]."', firmado_12='".$_POST["firmado_12"]."', firmado_13='".$_POST["firmado_13"]."', firmado_14='".$_POST["firmado_14"]."', firmado_15='".$_POST["firmado_15"]."', firmado_16='".$_POST["firmado_16"]."', firmado_17='".$_POST["firmado_17"]."', firmado_18='".$_POST["firmado_18"]."', firmado_19='".$_POST["firmado_19"]."', firmado_20='".$_POST["firmado_20"]."', firmado_21='".$_POST["firmado_21"]."', firmado_22='".$_POST["firmado_22"]."', firmado_23='".$_POST["firmado_23"]."', firmado_24='".$_POST["firmado_24"]."', firmado_25='".$_POST["firmado_25"]."', firmado_26='".$_POST["firmado_26"]."', firmado_27='".$_POST["firmado_27"]."', firmado_28='".$_POST["firmado_28"]."', firmado_29='".$_POST["firmado_29"]."', firmado_30='".$_POST["firmado_30"]."', firmado_31='".$_POST["firmado_31"]."', firmado_32='".$_POST["firmado_32"]."', firmado_33='".$_POST["firmado_33"]."', firmado_34='".$_POST["firmado_34"]."', firmado_35='".$_POST["firmado_35"]."', firmado_36='".$_POST["firmado_36"]."', firmado_37='".$_POST["firmado_37"]."', firmado_38='".$_POST["firmado_38"]."', firmado_39='".$_POST["firmado_39"]."', firmado_40='".$_POST["firmado_40"]."', firmado_41='".$_POST["firmado_41"]."', firmado_42='".$_POST["firmado_42"]."', firmado_43='".$_POST["firmado_43"]."', firmado_44='".$_POST["firmado_44"]."', firmado_45='".$_POST["firmado_45"]."', firmado_46='".$_POST["firmado_46"]."', firmado_47='".$_POST["firmado_47"]."', firmado_48='".$_POST["firmado_48"]."', firmado_49='".$_POST["firmado_49"]."', firmado_50='".$_POST["firmado_50"]."', no_firmado1='".$_POST["no_firmado1"]."', no_firmado2='".$_POST["no_firmado2"]."', no_firmado3='".$_POST["no_firmado3"]."', no_firmado4='".$_POST["no_firmado4"]."', no_firmado5='".$_POST["no_firmado5"]."', no_firmado6='".$_POST["no_firmado6"]."', no_firmado7='".$_POST["no_firmado7"]."', no_firmado8='".$_POST["no_firmado8"]."', no_firmado9='".$_POST["no_firmado9"]."', no_firmado10='".$_POST["no_firmado10"]."', no_firmado11='".$_POST["no_firmado11"]."', no_firmado12='".$_POST["no_firmado12"]."', no_firmado13='".$_POST["no_firmado13"]."', no_firmado14='".$_POST["no_firmado14"]."', no_firmado15='".$_POST["no_firmado15"]."', no_firmado16='".$_POST["no_firmado16"]."', no_firmado17='".$_POST["no_firmado17"]."', no_firmado18='".$_POST["no_firmado18"]."', no_firmado19='".$_POST["no_firmado19"]."', no_firmado20='".$_POST["firmado_20"]."' WHERE id_pedido='".$_POST["id"]."'";

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



								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS AF');           

								$mail->AddAddress($mailto);



								$mail->WordWrap = 50;

								$mail->IsHTML(true);

								$mail->CharSet = 'UTF-8';



								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";

								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 

									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								$mail->AddCC($mailcc);



								if(!$mail->Send())

								{

									echo "Fallo";

								}

								else 

								{

									echo "Éxito";

								}

					}

					else if(isset($_POST["submit"]) AND $estado == 'Surtido')

					{

						$parts = explode('-', $_POST['fecha_seguimiento']);

						$date  = "$parts[2]-$parts[1]-$parts[0]";



						$parts1 = explode('-', $_POST['fecha_pago_1']);

						$date1  = "$parts1[2]-$parts1[1]-$parts1[0]";

						$parts2 = explode('-', $_POST['fecha_pago_2']);

						$date2  = "$parts2[2]-$parts2[1]-$parts2[0]";

						$parts3 = explode('-', $_POST['fecha_pago_3']);

						$date3  = "$parts3[2]-$parts3[1]-$parts3[0]";

						$parts4 = explode('-', $_POST['fecha_pago_4']);

						$date4  = "$parts4[2]-$parts4[1]-$parts4[0]";

						$parts5 = explode('-', $_POST['fecha_pago_5']);

						$date5  = "$parts5[2]-$parts5[1]-$parts5[0]";

						$parts6 = explode('-', $_POST['fecha_pago_6']);

						$date6  = "$parts6[2]-$parts6[1]-$parts6[0]";

						$parts7 = explode('-', $_POST['fecha_pago_7']);

						$date7  = "$parts7[2]-$parts7[1]-$parts7[0]";

						$parts8 = explode('-', $_POST['fecha_pago_8']);

						$date8  = "$parts8[2]-$parts8[1]-$parts8[0]";

						$parts9 = explode('-', $_POST['fecha_pago_9']);

						$date9  = "$parts9[2]-$parts9[1]-$parts9[0]";

						$parts10 = explode('-', $_POST['fecha_pago_10']);

						$date10  = "$parts10[2]-$parts10[1]-$parts10[0]";

						$parts11 = explode('-', $_POST['fecha_pago_11']);

						$date11  = "$parts11[2]-$parts11[1]-$parts11[0]";

						$parts12 = explode('-', $_POST['fecha_pago_12']);

						$date12  = "$parts12[2]-$parts12[1]-$parts12[0]";

						$parts13 = explode('-', $_POST['fecha_pago_13']);

						$date13  = "$parts13[2]-$parts13[1]-$parts13[0]";

						$parts14 = explode('-', $_POST['fecha_pago_14']);

						$date14  = "$parts14[2]-$parts14[1]-$parts14[0]";

						$parts15 = explode('-', $_POST['fecha_pago_15']);

						$date15  = "$parts15[2]-$parts15[1]-$parts15[0]";

						$parts16 = explode('-', $_POST['fecha_pago_16']);

						$date16  = "$parts16[2]-$parts16[1]-$parts16[0]";

						$parts17 = explode('-', $_POST['fecha_pago_17']);

						$date17  = "$parts17[2]-$parts17[1]-$parts17[0]";

						$parts18 = explode('-', $_POST['fecha_pago_18']);

						$date18  = "$parts18[2]-$parts18[1]-$parts18[0]";

						$parts19 = explode('-', $_POST['fecha_pago_19']);

						$date19  = "$parts19[2]-$parts19[1]-$parts19[0]";

						$parts20 = explode('-', $_POST['fecha_pago_20']);

						$date20  = "$parts20[2]-$parts20[1]-$parts20[0]";

						$parts21 = explode('-', $_POST['fecha_pago_21']);

						$date21  = "$parts21[2]-$parts21[1]-$parts21[0]";

						$parts22 = explode('-', $_POST['fecha_pago_22']);

						$date22  = "$parts22[2]-$parts22[1]-$parts22[0]";

						$parts23 = explode('-', $_POST['fecha_pago_23']);

						$date23  = "$parts23[2]-$parts23[1]-$parts23[0]";

						$parts24 = explode('-', $_POST['fecha_pago_24']);

						$date24  = "$parts24[2]-$parts24[1]-$parts24[0]";

						$parts25 = explode('-', $_POST['fecha_pago_25']);

						$date25  = "$parts25[2]-$parts25[1]-$parts25[0]";

						$parts26 = explode('-', $_POST['fecha_pago_26']);

						$date26  = "$parts26[2]-$parts26[1]-$parts26[0]";

						$parts27 = explode('-', $_POST['fecha_pago_27']);

						$date27  = "$parts27[2]-$parts27[1]-$parts27[0]";

						$parts28 = explode('-', $_POST['fecha_pago_28']);

						$date28  = "$parts28[2]-$parts28[1]-$parts28[0]";

						$parts29 = explode('-', $_POST['fecha_pago_29']);

						$date29  = "$parts29[2]-$parts29[1]-$parts29[0]";

						$parts30 = explode('-', $_POST['fecha_pago_30']);

						$date30  = "$parts30[2]-$parts30[1]-$parts30[0]";

						$parts31 = explode('-', $_POST['fecha_pago_31']);

						$date31  = "$parts31[2]-$parts31[1]-$parts31[0]";

						$parts32 = explode('-', $_POST['fecha_pago_32']);

						$date32  = "$parts32[2]-$parts32[1]-$parts32[0]";

						$parts33 = explode('-', $_POST['fecha_pago_33']);

						$date33  = "$parts33[2]-$parts33[1]-$parts33[0]";

						$parts34 = explode('-', $_POST['fecha_pago_34']);

						$date34  = "$parts34[2]-$parts34[1]-$parts34[0]";

						$parts35 = explode('-', $_POST['fecha_pago_35']);

						$date35  = "$parts35[2]-$parts35[1]-$parts35[0]";

						$parts36 = explode('-', $_POST['fecha_pago_36']);

						$date36  = "$parts36[2]-$parts36[1]-$parts36[0]";

						$parts37 = explode('-', $_POST['fecha_pago_37']);

						$date37  = "$parts37[2]-$parts37[1]-$parts37[0]";

						$parts38 = explode('-', $_POST['fecha_pago_38']);

						$date38  = "$parts38[2]-$parts38[1]-$parts38[0]";

						$parts39 = explode('-', $_POST['fecha_pago_39']);

						$date39  = "$parts39[2]-$parts39[1]-$parts39[0]";

						$parts40 = explode('-', $_POST['fecha_pago_40']);

						$date40  = "$parts40[2]-$parts40[1]-$parts40[0]";

						$parts41 = explode('-', $_POST['fecha_pago_41']);

						$date41  = "$parts41[2]-$parts41[1]-$parts41[0]";

						$parts42 = explode('-', $_POST['fecha_pago_42']);

						$date42  = "$parts42[2]-$parts42[1]-$parts42[0]";

						$parts43 = explode('-', $_POST['fecha_pago_43']);

						$date43  = "$parts43[2]-$parts43[1]-$parts43[0]";

						$parts44 = explode('-', $_POST['fecha_pago_44']);

						$date44  = "$parts44[2]-$parts44[1]-$parts44[0]";

						$parts45 = explode('-', $_POST['fecha_pago_45']);

						$date45  = "$parts45[2]-$parts45[1]-$parts45[0]";

						$parts46 = explode('-', $_POST['fecha_pago_46']);

						$date46  = "$parts46[2]-$parts46[1]-$parts46[0]";

						$parts47 = explode('-', $_POST['fecha_pago_47']);

						$date47  = "$parts47[2]-$parts47[1]-$parts47[0]";

						$parts48 = explode('-', $_POST['fecha_pago_48']);

						$date48  = "$parts48[2]-$parts48[1]-$parts48[0]";

						$parts49 = explode('-', $_POST['fecha_pago_49']);

						$date49  = "$parts49[2]-$parts49[1]-$parts49[0]";

						$parts50 = explode('-', $_POST['fecha_pago_50']);

						$date50  = "$parts50[2]-$parts50[1]-$parts50[0]";



						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', fecha_surtido_parcial='$date',monto_credito='".$_POST["monto_credito"]."', monto_mxn='".$_POST["monto_mxn"]."',  folio_af='".$_POST["folio_af"]."', surtido1='".$_POST["surtido1"]."', surtido2='".$_POST["surtido2"]."', surtido3='".$_POST["surtido3"]."', surtido4='".$_POST["surtido4"]."', surtido5='".$_POST["surtido5"]."', surtido6='".$_POST["surtido6"]."', surtido7='".$_POST["surtido7"]."', surtido8='".$_POST["surtido8"]."', surtido9='".$_POST["surtido9"]."', surtido10='".$_POST["surtido10"]."', surtido11='".$_POST["surtido11"]."', surtido12='".$_POST["surtido12"]."', surtido13='".$_POST["surtido13"]."', surtido14='".$_POST["surtido14"]."', surtido15='".$_POST["surtido15"]."', surtido16='".$_POST["surtido16"]."', surtido17='".$_POST["surtido17"]."', surtido18='".$_POST["surtido18"]."', surtido19='".$_POST["surtido19"]."', surtido20='".$_POST["surtido20"]."', surtido21='".$_POST["surtido21"]."', surtido22='".$_POST["surtido22"]."', surtido23='".$_POST["surtido23"]."', surtido24='".$_POST["surtido24"]."', surtido25='".$_POST["surtido25"]."', surtido26='".$_POST["surtido26"]."', surtido27='".$_POST["surtido27"]."', surtido28='".$_POST["surtido28"]."', surtido29='".$_POST["surtido29"]."', surtido30='".$_POST["surtido30"]."', surtido31='".$_POST["surtido31"]."', surtido32='".$_POST["surtido32"]."', surtido33='".$_POST["surtido33"]."', surtido34='".$_POST["surtido34"]."', surtido35='".$_POST["surtido35"]."', surtido36='".$_POST["surtido36"]."', surtido37='".$_POST["surtido37"]."', surtido38='".$_POST["surtido38"]."', surtido39='".$_POST["surtido39"]."', surtido40='".$_POST["surtido40"]."', surtido41='".$_POST["surtido41"]."', surtido42='".$_POST["surtido42"]."', surtido43='".$_POST["surtido43"]."', surtido44='".$_POST["surtido44"]."', surtido45='".$_POST["surtido45"]."', surtido46='".$_POST["surtido46"]."', surtido47='".$_POST["surtido47"]."', surtido48='".$_POST["surtido48"]."', surtido49='".$_POST["surtido49"]."', surtido50='".$_POST["surtido50"]."',tiempo_espera1='".$_POST["tiempo_espera1"]."', tiempo_espera2='".$_POST["tiempo_espera2"]."', tiempo_espera3='".$_POST["tiempo_espera3"]."', tiempo_espera4='".$_POST["tiempo_espera4"]."', tiempo_espera5='".$_POST["tiempo_espera5"]."', tiempo_espera6='".$_POST["tiempo_espera6"]."', tiempo_espera7='".$_POST["tiempo_espera7"]."', tiempo_espera8='".$_POST["tiempo_espera8"]."', tiempo_espera9='".$_POST["tiempo_espera9"]."', tiempo_espera10='".$_POST["tiempo_espera10"]."', tiempo_espera11='".$_POST["tiempo_espera11"]."', tiempo_espera12='".$_POST["tiempo_espera12"]."', tiempo_espera13='".$_POST["tiempo_espera13"]."', tiempo_espera14='".$_POST["tiempo_espera14"]."', tiempo_espera15='".$_POST["tiempo_espera15"]."', tiempo_espera16='".$_POST["tiempo_espera16"]."', tiempo_espera17='".$_POST["tiempo_espera17"]."', tiempo_espera18='".$_POST["tiempo_espera18"]."', tiempo_espera19='".$_POST["tiempo_espera19"]."', tiempo_espera20='".$_POST["tiempo_espera20"]."', tiempo_espera21='".$_POST["tiempo_espera21"]."', tiempo_espera22='".$_POST["tiempo_espera22"]."', tiempo_espera23='".$_POST["tiempo_espera23"]."', tiempo_espera24='".$_POST["tiempo_espera24"]."', tiempo_espera25='".$_POST["tiempo_espera25"]."', tiempo_espera26='".$_POST["tiempo_espera26"]."', tiempo_espera27='".$_POST["tiempo_espera27"]."', tiempo_espera28='".$_POST["tiempo_espera28"]."', tiempo_espera29='".$_POST["tiempo_espera29"]."', tiempo_espera30='".$_POST["tiempo_espera30"]."', tiempo_espera31='".$_POST["tiempo_espera31"]."', tiempo_espera32='".$_POST["tiempo_espera32"]."', tiempo_espera33='".$_POST["tiempo_espera33"]."', tiempo_espera34='".$_POST["tiempo_espera34"]."', tiempo_espera35='".$_POST["tiempo_espera35"]."', tiempo_espera36='".$_POST["tiempo_espera36"]."', tiempo_espera37='".$_POST["tiempo_espera37"]."', tiempo_espera38='".$_POST["tiempo_espera38"]."', tiempo_espera39='".$_POST["tiempo_espera39"]."', tiempo_espera40='".$_POST["tiempo_espera40"]."', tiempo_espera41='".$_POST["tiempo_espera41"]."', tiempo_espera42='".$_POST["tiempo_espera42"]."', tiempo_espera43='".$_POST["tiempo_espera43"]."', tiempo_espera44='".$_POST["tiempo_espera44"]."', tiempo_espera45='".$_POST["tiempo_espera45"]."', tiempo_espera46='".$_POST["tiempo_espera46"]."', tiempo_espera47='".$_POST["tiempo_espera47"]."', tiempo_espera48='".$_POST["tiempo_espera48"]."', tiempo_espera49='".$_POST["tiempo_espera49"]."', tiempo_espera50='".$_POST["tiempo_espera50"]."',credito1='".$_POST["credito1"]."', credito2='".$_POST["credito2"]."', credito3='".$_POST["credito3"]."', credito4='".$_POST["credito4"]."', credito5='".$_POST["credito5"]."', credito6='".$_POST["credito6"]."', credito7='".$_POST["credito7"]."', credito8='".$_POST["credito8"]."', credito9='".$_POST["credito9"]."', credito10='".$_POST["credito10"]."', credito11='".$_POST["credito11"]."', credito12='".$_POST["credito12"]."', credito13='".$_POST["credito13"]."', credito14='".$_POST["credito14"]."', credito15='".$_POST["credito15"]."', credito16='".$_POST["credito16"]."', credito17='".$_POST["credito17"]."', credito18='".$_POST["credito18"]."', credito19='".$_POST["credito19"]."', credito20='".$_POST["credito20"]."', credito21='".$_POST["credito21"]."', credito22='".$_POST["credito22"]."', credito23='".$_POST["credito23"]."', credito24='".$_POST["credito24"]."', credito25='".$_POST["credito25"]."', credito26='".$_POST["credito26"]."', credito27='".$_POST["credito27"]."', credito28='".$_POST["credito28"]."', credito29='".$_POST["credito29"]."', credito30='".$_POST["credito30"]."', credito31='".$_POST["credito31"]."', credito32='".$_POST["credito32"]."', credito33='".$_POST["credito33"]."', credito34='".$_POST["credito34"]."', credito35='".$_POST["credito35"]."', credito36='".$_POST["credito36"]."', credito37='".$_POST["credito37"]."', credito38='".$_POST["credito38"]."', credito39='".$_POST["credito39"]."', credito40='".$_POST["credito40"]."', credito41='".$_POST["credito41"]."', credito42='".$_POST["credito42"]."', credito43='".$_POST["credito43"]."', credito44='".$_POST["credito44"]."', credito45='".$_POST["credito45"]."', credito46='".$_POST["credito46"]."', credito47='".$_POST["credito47"]."', credito48='".$_POST["credito48"]."', credito49='".$_POST["credito49"]."', credito50='".$_POST["credito50"]."',fecha_pago_1='$date1', fecha_pago_2='$date2', fecha_pago_3='$date3', fecha_pago_4='$date4', fecha_pago_5='$date5', fecha_pago_6='$date6', fecha_pago_7='$date7', fecha_pago_8='$date8', fecha_pago_9='$date9', fecha_pago_10='$date10', fecha_pago_11='$date11', fecha_pago_12='$date12', fecha_pago_13='$date13', fecha_pago_14='$date14', fecha_pago_15='$date15', fecha_pago_16='$date16', fecha_pago_17='$date17', fecha_pago_18='$date18', fecha_pago_19='$date19', fecha_pago_20='$date20', fecha_pago_21='$date21', fecha_pago_22='$date22', fecha_pago_23='$date23', fecha_pago_24='$date24', fecha_pago_25='$date25', fecha_pago_26='$date26', fecha_pago_27='$date27', fecha_pago_28='$date28', fecha_pago_29='$date29', fecha_pago_30='$date30', fecha_pago_31='$date31', fecha_pago_32='$date32', fecha_pago_33='$date33', fecha_pago_34='$date34', fecha_pago_35='$date35', fecha_pago_36='$date36', fecha_pago_37='$date37', fecha_pago_38='$date38', fecha_pago_39='$date39', fecha_pago_40='$date40', fecha_pago_41='$date41', fecha_pago_42='$date42', fecha_pago_43='$date43', fecha_pago_44='$date44', fecha_pago_45='$date45', fecha_pago_46='$date46', fecha_pago_47='$date47', fecha_pago_48='$date48', fecha_pago_49='$date49', fecha_pago_50='$date50',entrega_1='".$_POST["entrega_1"]."', entrega_2='".$_POST["entrega_2"]."', entrega_3='".$_POST["entrega_3"]."', entrega_4='".$_POST["entrega_4"]."', entrega_5='".$_POST["entrega_5"]."', entrega_6='".$_POST["entrega_6"]."', entrega_7='".$_POST["entrega_7"]."', entrega_8='".$_POST["entrega_8"]."', entrega_9='".$_POST["entrega_9"]."', entrega_10='".$_POST["entrega_10"]."', entrega_11='".$_POST["entrega_11"]."', entrega_12='".$_POST["entrega_12"]."', entrega_13='".$_POST["entrega_13"]."', entrega_14='".$_POST["entrega_14"]."', entrega_15='".$_POST["entrega_15"]."', entrega_16='".$_POST["entrega_16"]."', entrega_17='".$_POST["entrega_17"]."', entrega_18='".$_POST["entrega_18"]."', entrega_19='".$_POST["entrega_19"]."', entrega_20='".$_POST["entrega_20"]."', entrega_21='".$_POST["entrega_21"]."', entrega_22='".$_POST["entrega_22"]."', entrega_23='".$_POST["entrega_23"]."', entrega_24='".$_POST["entrega_24"]."', entrega_25='".$_POST["entrega_25"]."', entrega_26='".$_POST["entrega_26"]."', entrega_27='".$_POST["entrega_27"]."', entrega_28='".$_POST["entrega_28"]."', entrega_29='".$_POST["entrega_29"]."', entrega_30='".$_POST["entrega_30"]."', entrega_31='".$_POST["entrega_31"]."', entrega_32='".$_POST["entrega_32"]."', entrega_33='".$_POST["entrega_33"]."', entrega_34='".$_POST["entrega_34"]."', entrega_35='".$_POST["entrega_35"]."', entrega_36='".$_POST["entrega_36"]."', entrega_37='".$_POST["entrega_37"]."', entrega_38='".$_POST["entrega_38"]."', entrega_39='".$_POST["entrega_39"]."', entrega_40='".$_POST["entrega_40"]."', entrega_41='".$_POST["entrega_41"]."', entrega_42='".$_POST["entrega_42"]."', entrega_43='".$_POST["entrega_43"]."', entrega_44='".$_POST["entrega_44"]."', entrega_45='".$_POST["entrega_45"]."', entrega_46='".$_POST["entrega_46"]."', entrega_47='".$_POST["entrega_47"]."', entrega_48='".$_POST["entrega_48"]."', entrega_49='".$_POST["entrega_49"]."', entrega_50='".$_POST["entrega_50"]."',recibe_1='".$_POST["recibe_1"]."', recibe_2='".$_POST["recibe_2"]."', recibe_3='".$_POST["recibe_3"]."', recibe_4='".$_POST["recibe_4"]."', recibe_5='".$_POST["recibe_5"]."', recibe_6='".$_POST["recibe_6"]."', recibe_7='".$_POST["recibe_7"]."', recibe_8='".$_POST["recibe_8"]."', recibe_9='".$_POST["recibe_9"]."', recibe_10='".$_POST["recibe_10"]."', recibe_11='".$_POST["recibe_11"]."', recibe_12='".$_POST["recibe_12"]."', recibe_13='".$_POST["recibe_13"]."', recibe_14='".$_POST["recibe_14"]."', recibe_15='".$_POST["recibe_15"]."', recibe_16='".$_POST["recibe_16"]."', recibe_17='".$_POST["recibe_17"]."', recibe_18='".$_POST["recibe_18"]."', recibe_19='".$_POST["recibe_19"]."', recibe_20='".$_POST["recibe_20"]."', recibe_21='".$_POST["recibe_21"]."', recibe_22='".$_POST["recibe_22"]."', recibe_23='".$_POST["recibe_23"]."', recibe_24='".$_POST["recibe_24"]."', recibe_25='".$_POST["recibe_25"]."', recibe_26='".$_POST["recibe_26"]."', recibe_27='".$_POST["recibe_27"]."', recibe_28='".$_POST["recibe_28"]."', recibe_29='".$_POST["recibe_29"]."', recibe_30='".$_POST["recibe_30"]."', recibe_31='".$_POST["recibe_31"]."', recibe_32='".$_POST["recibe_32"]."', recibe_33='".$_POST["recibe_33"]."', recibe_34='".$_POST["recibe_34"]."', recibe_35='".$_POST["recibe_35"]."', recibe_36='".$_POST["recibe_36"]."', recibe_37='".$_POST["recibe_37"]."', recibe_38='".$_POST["recibe_38"]."', recibe_39='".$_POST["recibe_39"]."', recibe_40='".$_POST["recibe_40"]."', recibe_41='".$_POST["recibe_41"]."', recibe_42='".$_POST["recibe_42"]."', recibe_43='".$_POST["recibe_43"]."', recibe_44='".$_POST["recibe_44"]."', recibe_45='".$_POST["recibe_45"]."', recibe_46='".$_POST["recibe_46"]."', recibe_47='".$_POST["recibe_47"]."', recibe_48='".$_POST["recibe_48"]."', recibe_49='".$_POST["recibe_49"]."', recibe_50='".$_POST["recibe_50"]."' WHERE id_pedido='".$_POST["id"]."'";

						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());



						$queryd = "UPDATE pedidos SET firmado_1='".$_POST["firmado_1"]."', firmado_2='".$_POST["firmado_2"]."', firmado_3='".$_POST["firmado_3"]."', firmado_4='".$_POST["firmado_4"]."', firmado_5='".$_POST["firmado_5"]."', firmado_6='".$_POST["firmado_6"]."', firmado_7='".$_POST["firmado_7"]."', firmado_8='".$_POST["firmado_8"]."', firmado_9='".$_POST["firmado_9"]."', firmado_10='".$_POST["firmado_10"]."', firmado_11='".$_POST["firmado_11"]."', firmado_12='".$_POST["firmado_12"]."', firmado_13='".$_POST["firmado_13"]."', firmado_14='".$_POST["firmado_14"]."', firmado_15='".$_POST["firmado_15"]."', firmado_16='".$_POST["firmado_16"]."', firmado_17='".$_POST["firmado_17"]."', firmado_18='".$_POST["firmado_18"]."', firmado_19='".$_POST["firmado_19"]."', firmado_20='".$_POST["firmado_20"]."', firmado_21='".$_POST["firmado_21"]."', firmado_22='".$_POST["firmado_22"]."', firmado_23='".$_POST["firmado_23"]."', firmado_24='".$_POST["firmado_24"]."', firmado_25='".$_POST["firmado_25"]."', firmado_26='".$_POST["firmado_26"]."', firmado_27='".$_POST["firmado_27"]."', firmado_28='".$_POST["firmado_28"]."', firmado_29='".$_POST["firmado_29"]."', firmado_30='".$_POST["firmado_30"]."', firmado_31='".$_POST["firmado_31"]."', firmado_32='".$_POST["firmado_32"]."', firmado_33='".$_POST["firmado_33"]."', firmado_34='".$_POST["firmado_34"]."', firmado_35='".$_POST["firmado_35"]."', firmado_36='".$_POST["firmado_36"]."', firmado_37='".$_POST["firmado_37"]."', firmado_38='".$_POST["firmado_38"]."', firmado_39='".$_POST["firmado_39"]."', firmado_40='".$_POST["firmado_40"]."', firmado_41='".$_POST["firmado_41"]."', firmado_42='".$_POST["firmado_42"]."', firmado_43='".$_POST["firmado_43"]."', firmado_44='".$_POST["firmado_44"]."', firmado_45='".$_POST["firmado_45"]."', firmado_46='".$_POST["firmado_46"]."', firmado_47='".$_POST["firmado_47"]."', firmado_48='".$_POST["firmado_48"]."', firmado_49='".$_POST["firmado_49"]."', firmado_50='".$_POST["firmado_50"]."', no_firmado1='".$_POST["no_firmado1"]."', no_firmado2='".$_POST["no_firmado2"]."', no_firmado3='".$_POST["no_firmado3"]."', no_firmado4='".$_POST["no_firmado4"]."', no_firmado5='".$_POST["no_firmado5"]."', no_firmado6='".$_POST["no_firmado6"]."', no_firmado7='".$_POST["no_firmado7"]."', no_firmado8='".$_POST["no_firmado8"]."', no_firmado9='".$_POST["no_firmado9"]."', no_firmado10='".$_POST["no_firmado10"]."', no_firmado11='".$_POST["no_firmado11"]."', no_firmado12='".$_POST["no_firmado12"]."', no_firmado13='".$_POST["no_firmado13"]."', no_firmado14='".$_POST["no_firmado14"]."', no_firmado15='".$_POST["no_firmado15"]."', no_firmado16='".$_POST["no_firmado16"]."', no_firmado17='".$_POST["no_firmado17"]."', no_firmado18='".$_POST["no_firmado18"]."', no_firmado19='".$_POST["no_firmado19"]."', no_firmado20='".$_POST["firmado_20"]."' WHERE id_pedido='".$_POST["id"]."'";

						$resultd=mysql_query($queryd,$conexion) or die("Error: ".mysql_error());

					

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



								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS AF');          

								$mail->AddAddress($mailto);



								$mail->WordWrap = 50;

								$mail->IsHTML(true);

								$mail->CharSet = 'UTF-8';



								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";

								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 

									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								$mail->AddCC($mailcc);



								if(!$mail->Send())

								{

									echo "Fallo";

								}

								else 

								{

									echo "Éxito";

								}

					}

					else if(isset($_POST["submit"]) AND $estado == 'Cancelado')

					{

						$query = "UPDATE pedidos SET estado='".$_POST["estado"]."', fecha_cancelado='".$_POST["fecha_seguimiento"]."', notas_seguimiento='".$_POST["notas_seguimiento"]."', observaciones='".$_POST["observaciones"]."' WHERE id_pedido='".$_POST["id"]."'";

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



								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS AF');          

								$mail->AddAddress($mailto);



								$mail->WordWrap = 50;

								$mail->IsHTML(true);

								$mail->CharSet = 'UTF-8';



								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";

								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 

									Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

								$mail->AddCC($mailcc);



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
						$sql_query="SELECT * FROM pedidos WHERE id_pedido='".$id_pedido."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());

						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
				?>
											<form method="post" name=frm action="modificar">
								<div class="row form-horizontal">
										 <!--Tipo de Compra-->
											<div class="col-xs-2">
												<label class="control-label" for="tipo_compra">Tipo de Compra</label>
												<input class="form-control input-sm" readonly name="tipo_compra" type="text" value="<?php echo $Rs['tipo_compra']; ?>"  size="17" />
											</div>
										<div class="col-xs-3">
										<label class="control-label" for="ubicacion">Ubicación</label>
												<input class="form-control input-sm" readonly name="ubicacion" type="text" value="<?php echo $Rs['ubicacion']; ?>"  size="17" />
										</div>
										<div class="col-xs-3">
											<label class="control-label" for="supervisor">Supervisor</label>
												<input class="form-control input-sm" readonly name="supervisor" type="text" required value="<?php echo $Rs['supervisor']; ?>" size="50" />
										</div>
										<div class="col-xs-2">
											<label class="control-label">Folio Gerencia</label>
													<input name="folio" readonly type="text" class="form-control input-sm" required value="<?php echo $Rs['folio']; ?>" size="17" />
									</div>
									<div class="col-xs-2">
											<label class="control-label">Folio Compras</label>
												<input name="folio_af" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['folio_af']; ?>" />
										 </div>
									<div class="col-xs-2">
															<input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id_pedido']; ?>" size="17" />
									</div>
												</div>
												<div class="row form-horizontal">
													<div class="col-xs-4">
															<label class="control-label" for="folio">Empresa</label>
																<select disabled="true" name="empresa" class="form-control input-sm">
																	<option class="form-control input-sm"><?php  echo $Rs['empresa']; ?></option>
														<option class="form-control input-sm" name=uno value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
									<option class="form-control input-sm" name=dos value="CAVI DE SOMBRERETE">CAVI DE SOMBRERETE</option>
									<option class="form-control input-sm" name=uno value="SUCURSAL MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">SUCURSAL MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
													</select>
										</div>
										<div class="col-xs-4">
											<label class="control-label" for="proyecto">Proyecto</label>
															<?php

									mysql_query("SET NAMES 'UTF8'");
									$consulta_mysql='select * from obras ORDER BY nombre ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
									echo "<select disabled='true' name='proyecto' class='form-control input-sm'>";
									echo "<option> {$Rs['proyecto']}</option>";
									while($fila=mysql_fetch_array($resultado_consulta_mysql)){
											echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";

									}

									echo "</select>";

								?>
											</div>
										<div class="col-xs-2">
												<label class="control-label">Estado</label>
													<select name="estado" class="form-control input-sm" required disabled>
														<option class="form-control input-sm"><?php  echo $Rs['estado']; ?></option>
														<option class="form-control input-sm" name=uno value="Revisar Notas">Revisar Notas</option>
														<option class="form-control input-sm" name=uno value="Recibido">Recibido</option>
														<option class="form-control input-sm" name=uno value="Revisión Solicitante">Revisión Solicitante</option>
														<option class="form-control input-sm" name=uno value="Recabando doctos">Recabando doctos</option>
														<option class="form-control input-sm" name=uno value="Cotizando">Cotizando</option>
														<option class="form-control input-sm" name=uno value="En proceso de surtir">En proceso de surtir</option>
														<option class="form-control input-sm" name=uno value="Autorizado para Compra">Autorizado para Compra</option>
														<option class="form-control input-sm" name=uno value="Surtido Parcial">Surtido Parcial</option>
														<option class="form-control input-sm" name=uno value="Surtido en Almacen">Surtido en Almacén</option>
														<option class="form-control input-sm" name=uno value="Solicitud Surtido">Solicitar Surtido</option>
														<?php 
															if($Rs['estado'] == "Aceptado")
															{
																echo"<option class='form-control input-sm' name=uno value='Surtido'>Surtido</option>";
															}
														?>
														<option class="form-control input-sm" name=uno value="Detenido">Detenido</option>
														<option class="form-control input-sm" name=uno value="En Almacen">En Almacén</option>
														<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
													</select>
										</div>
										<div class="col-xs-2">
											<label class="control-label">Fecha</label>
												<input disabled name="fecha_seguimiento" type="date" class="form-control input-sm" required type="text" value="<?php echo date("d/m/Y"); ?>" />
										 </div>
												</div>
									<div class="row form-horizontal" style="width: 2500px;">
										 <div class="col-xs-1" style="width: 4.333333%;">
											<label class="control-label" for="cantidad">Cantidad</label>
												<input name="cantidad" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant1']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1" style="width: 4.333333%;">
											<label class="control-label" for="unidad">Unidad</label>
											<input name="unidad" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid1']; ?>"  size="15"  />
										</div>
										<div class="col-xs-2">
											<label class="control-label" for="descripcion">Descripción</label>
											<input name="descripcion" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc1']); ?>"  size="87"  />
										</div>
										<div class="col-xs-2">
											<label class="control-label" for="uso1">Uso</label>
											<input name="uso1" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso1']); ?>"  size="87"  />
										</div>
										<div class="col-xs-1" style="width: 4.333333%;">
											<label class="control-label" for="surtido1">Surtido</label>
											 <select disabled name="surtido1" class="form-control input-sm">
													<option class="form-control input-sm"><?php  echo $Rs['surtido1']; ?></option>
													<option class="form-control input-sm" name=uno value="Sí">Sí</option>
													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>
										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<label class="control-label" for="cantidad">Pzas</label>
											<input id="sp1" name="s1" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s1']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">
											<label class="control-label" for="tiempo_espera1">Tiempo Espera Proveedor</label>
											<input disabled name="tiempo_espera1" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera1']; ?>"  size="87"  />
										</div>
										<div class="col-xs-1" style="width: 4.333333%;">
											<label class="control-label" for="credito1">A crédito</label>
											 <select disabled name="credito1" class="form-control input-sm">
													<option class="form-control input-sm"><?php  echo $Rs['credito1']; ?></option>
													<option class="form-control input-sm" name=uno value="Sí">Sí</option>
													<option class="form-control input-sm" name=uno value="No">No</option>
												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

											<label class="control-label">Fecha de Pago</label>

												<input disabled name="fecha_pago_1" type="date" class="form-control input-sm" type="text" value="<?php $pfp1 = explode('-', $Rs['fecha_pago_1']);

													 $fp1  = "$pfp1[2]-$pfp1[1]-$pfp1[0]";echo $fp1; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<label class="control-label" for="entrega_1">Entrega</label>
											<select disabled name="entrega_1" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_1']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<label class="control-label" for="recibe_1">Recibe</label>

											<input disabled name="recibe_1" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_1']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 6.333333%;">

											<label class="control-label" for="firmado_1">Documento Firmado</label>

											<select disabled name="firmado_1" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_1']; ?></option>
							<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											<label class="control-label" for="no_firmado1">Num. Documento</label>
											 <input disabled name="no_firmado1" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado1']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad2" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant2']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad2" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid2']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion2" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc2']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso2" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso2']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido2" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido2']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp2" name="s2" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s2']; ?>"  size="15"  />
										 </div>

										<div class="col-xs-1">

											<input disabled name="tiempo_espera2" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera2']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito2" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito2']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_2" type="date" class="form-control input-sm" type="text" value="<?php $pfp2 = explode('-', $Rs['fecha_pago_2']);

													 $fp2  = "$pfp2[2]-$pfp2[1]-$pfp2[0]";echo $fp2; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_2" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_2']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_2" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_2']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_2" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_2']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado2" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado2']; ?>"  size="87"  />
										</div>

									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad3" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant3']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad3" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid3']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion3" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc3']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso3" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso3']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido3" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido3']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp3" name="s3" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s3']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera3" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera3']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito3" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito3']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_3" type="date" class="form-control input-sm" type="text" value="<?php $pfp3 = explode('-', $Rs['fecha_pago_3']);

													 $fp3  = "$pfp3[2]-$pfp3[1]-$pfp3[0]";echo $fp3; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_3" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_3']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_3" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_3']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_3" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_3']; ?></option>

													<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado3" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado3']; ?>"  size="87"  />
										</div>

									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad4" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant4']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad4" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid4']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion4" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc4']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso4" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso4']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido4" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido4']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp4" name="s4" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s4']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera4" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera4']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito4" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito4']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_4" type="date" class="form-control input-sm" type="text" value="<?php $pfp4 = explode('-', $Rs['fecha_pago_4']);

													 $fp4  = "$pfp4[2]-$pfp4[1]-$pfp4[0]";echo $fp4; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_4" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_4']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_4" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_4']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_4" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_4']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado4" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado4']; ?>"  size="87"  />
										</div>

									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad5" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant5']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad5" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid5']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion5" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc5']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso5" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso5']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido5" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido5']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp5" name="s5" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s5']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera5" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera5']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito5" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito5']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_5" type="date" class="form-control input-sm" type="text" value="<?php $pfp5 = explode('-', $Rs['fecha_pago_5']);

													 $fp5  = "$pfp5[2]-$pfp5[1]-$pfp5[0]";echo $fp5; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_5" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_5']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_5" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_5']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_5" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_5']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado5" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado5']; ?>"  size="87"  />
										</div>

									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad6" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant6']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad6" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid6']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion6" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc6']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso6" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso6']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido6" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido6']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp6" name="s6" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s6']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera6" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera6']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito6" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito6']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_6" type="date" class="form-control input-sm" type="text" value="<?php $pfp6 = explode('-', $Rs['fecha_pago_6']);

													 $fp6  = "$pfp6[2]-$pfp6[1]-$pfp6[0]";echo $fp6; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_6" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_6']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_6" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_6']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_6" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_6']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado6" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado6']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad7" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant7']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad7" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid7']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion7" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc7']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso7" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso7']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido7" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido7']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp7" name="s7" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s7']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera7" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera7']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito7" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito7']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_7" type="date" class="form-control input-sm" type="text" value="<?php $pfp7 = explode('-', $Rs['fecha_pago_7']);

													 $fp7  = "$pfp7[2]-$pfp7[1]-$pfp7[0]";echo $fp7; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_7" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_7']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_7" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_7']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_7" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_7']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado7" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado7']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad8" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant8']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad8" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid8']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion8" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc8']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso8" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso8']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido8" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido8']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp8" name="s8" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s8']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera8" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera8']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito8" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito8']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_8" type="date" class="form-control input-sm" type="text" value="<?php $pfp8 = explode('-', $Rs['fecha_pago_8']);

													 $fp8  = "$pfp8[2]-$pfp8[1]-$pfp8[0]";echo $fp8; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_8" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_8']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_8" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_8']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_8" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_8']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado8" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado8']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad9" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant9']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad9" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid9']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion9" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc9']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso9" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso9']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido9" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido9']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp9" name="s9" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s9']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera9" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera9']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito9" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito9']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_9" type="date" class="form-control input-sm" type="text" value="<?php $pfp9 = explode('-', $Rs['fecha_pago_9']);

													 $fp9  = "$pfp9[2]-$pfp9[1]-$pfp9[0]";echo $fp9; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_9" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_9']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_9" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_9']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_9" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_9']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado9" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado9']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad10" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant10']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad10" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid10']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion10" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc10']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso10" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso10']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido10" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido10']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp10" name="s10" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s10']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera10" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera10']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito10" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito10']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_10" type="date" class="form-control input-sm" type="text" value="<?php $pfp10 = explode('-', $Rs['fecha_pago_10']);

													 $fp10  = "$pfp10[2]-$pfp10[1]-$pfp10[0]";echo $fp10; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_10" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_10']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_10" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_10']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_10" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_10']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado10" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado10']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad11" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant11']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad11" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid11']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion11" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc11']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso11" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso11']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido11" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido11']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp11" name="s11" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s11']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera11" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera11']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito11" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito11']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_11" type="date" class="form-control input-sm" type="text" value="<?php $pfp11 = explode('-', $Rs['fecha_pago_11']);

													 $fp11  = "$pfp11[2]-$pfp11[1]-$pfp11[0]";echo $fp11; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_11" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_11']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_11" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_11']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_11" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_11']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado11" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado11']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad12" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant12']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad12" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid12']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion12" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc12']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso12" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso12']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido12" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido12']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp12" name="s12" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s12']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera12" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera12']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito12" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito12']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_12" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_12']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_12" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_12']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_12" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_12']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_12" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_12']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado12" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado12']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad13" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant13']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad13" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid13']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion13" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc13']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso13" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso13']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido13" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido13']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp13" name="s13" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s13']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera13" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera13']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito13" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito13']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_13" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_13']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_13" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_13']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_13" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_13']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_13" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_13']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado13" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado13']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad14" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant14']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad14" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid14']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion14" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc14']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso14" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso14']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido14" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido14']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp14" name="s14" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s14']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera14" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera14']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito14" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito14']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_14" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_14']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_14" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_14']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_14" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_14']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_14" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_14']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado14" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado14']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad15" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant15']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad15" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid15']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion15" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc15']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso15" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso15']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido15" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido15']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp15" name="s15" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s15']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera15" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera15']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito15" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito15']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_15" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_15']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_15" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_15']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_15" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_15']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_15" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_15']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado15" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado15']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad16" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant16']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad16" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid16']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion16" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc16']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso16" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso16']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido16" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido16']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp16" name="s16" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s16']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera16" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera16']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito16" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito16']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_16" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_16']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_16" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_16']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_16" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_16']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_16" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_16']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado16" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado16']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad17" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant17']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad17" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid17']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion17" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc17']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso17" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso17']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido17" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido17']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp17" name="s17" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s17']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera17" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera17']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito17" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito17']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_17" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_17']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_17" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_17']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_17" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_17']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_17" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_17']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado17" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado17']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad18" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant18']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad18" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid18']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion18" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc18']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso18" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso18']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido18" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido18']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp18" name="s18" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s18']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera18" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera18']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito18" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito18']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_18" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_18']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_18" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_18']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input disabled name="recibe_18" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_18']; ?>"  size="87"  />

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_18" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_18']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado18" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado18']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad19" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant19']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad19" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid19']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion19" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc19']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso19" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso19']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="surtido19" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido19']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp19" name="s19" class="form-control input-sm" type="number" disabled value="<?php echo $Rs['s19']; ?>"  size="15"  />
										 </div>
										<div class="col-xs-1">

											<input disabled name="tiempo_espera19" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera19']; ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito19" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito19']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input disabled name="fecha_pago_19" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_19']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_19" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_19']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input name="recibe_19" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_19']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_19" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_19']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input name="no_firmado19" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado19']; ?>"  size="87" readonly />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad20" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant20']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad20" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid20']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion20" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc20']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso20" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso20']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled id="surtido20" name="surtido20" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido20']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												<option class="form-control input-sm" name=uno value="Surtido Parcial">Surt. Parcial</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp20" name="s20" class="form-control input-sm" type="number" readonly value="<?php echo $Rs['s20']; ?>"  size="15"  />
										 </div>

										<div class="col-xs-1">

											<input name="tiempo_espera20" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera20']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito20" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito20']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input readonly name="fecha_pago_20" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_20']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_20" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_20']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input name="recibe_20" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_20']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_20" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_20']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input name="no_firmado20" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado20']; ?>"  size="87"  readonly/>
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad21" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant21']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad21" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid21']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion21" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc21']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso21" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso21']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled id="surtido21" name="surtido21" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido21']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												<option class="form-control input-sm" name=uno value="Surtido Parcial">Surt. Parcial</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp21" name="s21" class="form-control input-sm" type="number" readonly value="<?php echo $Rs['s21']; ?>"  size="15"  />
										 </div>

										<div class="col-xs-1">

											<input name="tiempo_espera21" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera21']; ?>"  size="87" readonly />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito21" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito21']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input readonly name="fecha_pago_21" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_21']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_21" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_21']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input name="recibe_21" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_21']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_21" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_21']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado21" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado21']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad22" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant22']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad22" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid22']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion22" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc22']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso22" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso22']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled id="surtido22" name="surtido22" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido22']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												<option class="form-control input-sm" name=uno value="Surtido Parcial">Surt. Parcial</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp22" name="s22" class="form-control input-sm" type="number" readonly value="<?php echo $Rs['s22']; ?>"  size="15"  />
										 </div>

										<div class="col-xs-1">

											<input name="tiempo_espera22" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera22']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito22" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito22']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input readonly name="fecha_pago_22" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_22']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_22" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_22']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input name="recibe_22" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_22']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_22" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_22']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado22" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado22']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad23" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant23']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad23" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid23']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion23" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc23']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso23" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso23']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled id="surtido23" name="surtido23" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido23']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												<option class="form-control input-sm" name=uno value="Surtido Parcial">Surt. Parcial</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp23" name="s23" class="form-control input-sm" type="number" readonly value="<?php echo $Rs['s23']; ?>"  size="15" readonly />
										 </div>

										<div class="col-xs-1">

											<input name="tiempo_espera23" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera23']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito23" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito23']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input readonly name="fecha_pago_23" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_23']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_23" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_23']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input name="recibe_23" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_23']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_23" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_23']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado23" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado23']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad24" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant24']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad24" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid24']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion24" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc24']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso24" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso24']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled id="surtido24" name="surtido24" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido24']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												<option class="form-control input-sm" name=uno value="Surtido Parcial">Surt. Parcial</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp24" name="s24" class="form-control input-sm" type="number" readonly value="<?php echo $Rs['s24']; ?>"  size="15" readonly />
										 </div>

										<div class="col-xs-1">

											<input name="tiempo_espera24" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera24']; ?>"  size="87" readonly />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito24" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito24']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input readonly name="fecha_pago_24" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_24']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_24" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_24']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input name="recibe_24" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_24']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_24" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_24']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado24" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado24']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad25" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant25']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad25" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid25']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion25" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc25']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso25" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso25']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled id="surtido25" name="surtido25" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido25']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												<option class="form-control input-sm" name=uno value="Surtido Parcial">Surt. Parcial</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp25" name="s25" class="form-control input-sm" type="number" readonly value="<?php echo $Rs['s25']; ?>"  size="15"  />
										 </div>

										<div class="col-xs-1">

											<input name="tiempo_espera25" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera25']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito25" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito25']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input readonly name="fecha_pago_25" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_25']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_25" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_25']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input name="recibe_25" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_25']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_25" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_25']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado25" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado25']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad26" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant26']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad26" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid26']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion26" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc26']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso26" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso26']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled id="surtido26" name="surtido26" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido26']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												<option class="form-control input-sm" name=uno value="Surtido Parcial">Surt. Parcial</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp26" name="s26" class="form-control input-sm" type="number" readonly value="<?php echo $Rs['s26']; ?>"  size="15"  />
										 </div>

										<div class="col-xs-1">

											<input name="tiempo_espera26" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera26']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito26" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito26']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input readonly name="fecha_pago_26" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_26']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_26" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_26']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input name="recibe_26" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_26']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_26" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_26']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado26" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado26']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad27" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant27']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad27" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid27']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion27" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc27']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso27" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso27']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled id="surtido27" name="surtido27" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido27']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												<option class="form-control input-sm" name=uno value="Surtido Parcial">Surt. Parcial</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp27" name="s27" class="form-control input-sm" type="number" readonly value="<?php echo $Rs['s27']; ?>"  size="15"  />
										 </div>

										<div class="col-xs-1">

											<input name="tiempo_espera27" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera27']; ?>"  size="87" readonly />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito27" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito27']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input readonly name="fecha_pago_27" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_27']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_27" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_27']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input name="recibe_27" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_27']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_27" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_27']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado27" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado27']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad28" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant28']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad28" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid28']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion28" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc28']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso28" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso28']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled id="surtido28" name="surtido28" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido28']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												<option class="form-control input-sm" name=uno value="Surtido Parcial">Surt. Parcial</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp28" name="s28" class="form-control input-sm" type="number" readonly value="<?php echo $Rs['s28']; ?>"  size="15"  />
										 </div>

										<div class="col-xs-1">

											<input name="tiempo_espera28" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera28']; ?>"  size="87" readonly />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito28" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito28']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input readonly name="fecha_pago_28" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_28']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_28" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_28']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input name="recibe_28" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_28']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_28" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_28']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado28" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado28']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad29" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant29']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad29" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid29']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion29" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc29']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso29" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso29']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled id="surtido29" name="surtido29" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido29']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												<option class="form-control input-sm" name=uno value="Surtido Parcial">Surt. Parcial</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp29" name="s29" class="form-control input-sm" type="number" readonly value="<?php echo $Rs['s29']; ?>"  size="15"  />
										 </div>

										<div class="col-xs-1">

											<input name="tiempo_espera29" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera29']; ?>"  size="87" readonly />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito29" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito29']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input readonly name="fecha_pago_29" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_29']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_29" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_29']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input name="recibe_29" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_29']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_29" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_29']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado29" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado29']; ?>"  size="87"  />
										</div>
									</div>

									<div class="row form-horizontal" style="width: 2500px;">

										 <div class="col-xs-1" style="width: 4.333333%;">

												<input name="cantidad30" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['cant30']; ?>"  size="15"  />

										 </div>

										<div class="col-xs-1" style="width: 4.333333%;">

											<input name="unidad30" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['unid30']; ?>"  size="15"  />

										</div>

										<div class="col-xs-2">

											<input name="descripcion30" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['desc30']); ?>"  size="87"  />

										</div>

										<div class="col-xs-2">

											<input name="uso30" class="form-control input-sm" readonly type="text" value="<?php echo htmlspecialchars($Rs['uso30']); ?>"  size="87"  />

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled id="surtido30" name="surtido30" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['surtido30']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>
													<option class="form-control input-sm" name=uno value="Cancelado">Cancelado</option>
												<option class="form-control input-sm" name=uno value="Surtido Parcial">Surt. Parcial</option>
												</select>

										 </div>
										 <div class="col-xs-1" style="width: 4.333333%;">
											<input id="sp30" name="s30" class="form-control input-sm" type="number" readonly value="<?php echo $Rs['s30']; ?>"  size="15"  />
										 </div>

										<div class="col-xs-1">

											<input name="tiempo_espera30" class="form-control input-sm" type="text" value="<?php echo $Rs['tiempo_espera30']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-1" style="width: 4.333333%;">

											 <select disabled name="credito30" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['credito30']; ?></option>

													<option class="form-control input-sm" name=uno value="Sí">Sí</option>

													<option class="form-control input-sm" name=uno value="No">No</option>

												</select>

										 </div>

										 <div class="col-xs-1" style="width: 7.333333%;">

												<input readonly name="fecha_pago_30" type="date" class="form-control input-sm" type="text" value="<?php $pfp12 = explode('-', $Rs['fecha_pago_30']);

													 $fp12  = "$pfp12[2]-$pfp12[1]-$pfp12[0]";echo $fp12; ?>" />

										 </div>

										 <div class="col-xs-1" style="width: 179px;">
											<select disabled name="entrega_30" class="form-control input-sm">
												<option class="form-control input-sm"><?php  echo $Rs['entrega_30']; ?></option>
												<option class="form-control input-sm" name=uno value="Almacén">Almacén</option>
												<option class="form-control input-sm" name=uno value="Proveedor">Proveedor</option>
											</select>
										</div>

										<div class="col-xs-1" style="width: 179px;">

											<input name="recibe_30" class="form-control input-sm" type="text" value="<?php echo $Rs['recibe_30']; ?>"  size="87"  readonly/>

										</div>

										<div class="col-xs-2" style="width: 6.333333%;">

											<select disabled name="firmado_30" class="form-control input-sm">

													<option class="form-control input-sm"><?php  echo $Rs['firmado_30']; ?></option>
<option class="form-control input-sm" name=uno value="Vale de Sistema">Vale de Sistema</option>
													<option class="form-control input-sm" name=uno value="Vale 1013">Vale 1013</option>
													<option class="form-control input-sm" name=uno value="Factura">Factura</option>

												</select>

										</div>
										<div class="col-xs-1" style="width: 6.333333%;">
											 <input disabled name="no_firmado30" class="form-control input-sm" type="text" value="<?php echo $Rs['no_firmado30']; ?>"  size="87"  />
										</div>
									</div>
										<div class="row form-horizontal">

												<div class="col-xs-2">

													<label class="control-label">Crédito</label>

													<input name="monto_credito" class="form-control input-sm" type="number" step=".001" value="<?php echo $Rs['monto_credito']; ?>"/>

												</div>

												<div class="col-xs-2">

													<label class="control-label">Pago de Contado</label>

													<input name="monto_mxn" class="form-control input-sm" type="number" step=".001" value="<?php echo $Rs['monto_mxn']; ?>"/>

												</div>

												<div class="col-xs-2"></div>

												<div class="col-xs-2"></div>

										</div>

										<br>

										<div class="row form-horizontal">

										<div class="col-xs-2">

													<label class="control-label">Notas</label>

													<textarea name="notas_seguimiento" class="form-control "><?php echo $Rs['notas_seguimiento']; ?></textarea>

												</div>

										</div>

									<br>

									<div class="row form-horizontal">

										<div class="col-xs-2">

													<label class="control-label">Observaciones Compras</label>

													<textarea name="observaciones" class="form-control "><?php echo $Rs['observaciones']; ?></textarea>

												</div>

										</div>

									<br>

									<div id="btn-form">

										

								</div>

								<br>

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