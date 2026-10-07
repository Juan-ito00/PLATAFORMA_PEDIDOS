<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']))
	{
		header('Location: index');
		exit();
	}
	include("conexion/conexion.php"); 
	$conexion=Conectarse();

	use PHPMailer\PHPMailer\PHPMailer;
  	require_once('autoload.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Proveedor Modificar</title>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<style type="text/css">
		.rojo {background-color:#FF0000;}
		.azul {color:#0066FF;}
		.verde {color:#009900;}
		select{
			background-color:#FF66FF;
		}
	</style>
<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<p align="center" style="color: white; margin-top: 12px; font-size: 18px;">SISTEMA DE PEDIDOS</p>
		</nav>
		<div class="container" style="padding-top: 1px;">
			<nav class="navbar navbar-default nav" style="margin-top:5px;" role="navigation">
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav navbar-right">
							<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="logout"></a></p>
						</ul>
				</div>
			</nav>
				<!--Panel con el titulo de la pagina y contenido-->
				<div class="panel panel-default " style="margin-top: 5px;">
						<div class="panel-body">
							<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
 					if(isset($_POST["submit"]))
 					{
						$P_ID = $_POST['rfc'];
						$query = "UPDATE proveedores SET razon_social='".$_POST["razon_social"]."',rfc='".$_POST["rfc"]."',
						direccion='".$_POST["direccion"]."',curp='".$_POST["curp"]."', telefono='".$_POST["telefono"]."',
						correo='".$_POST["correo"]."', "."contacto='".$_POST["contacto"]."',"."area='".$_POST["area"]."',
						"."nombre_banco='".$_POST["nombre_banco"]."',"."cuenta='".$_POST["cuenta"]."',"."clabe='".$_POST["clabe"]."',
						ps1='".$_POST["ps1"]."',ps2='".$_POST["ps2"]."',ps3='".$_POST["ps3"]."' WHERE id='".$_POST["id"]."'";
		              	
            			$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
          
						echo "<script languaje='javascript'>
						alert('Datos Modificados')
						location.href='usuario_prov_mod?prov=$P_ID';
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
					$mail->setFrom('soporte@grupocavi.com.mx', 'NOTIFICACIÓN PROVEEDORES');
					$mail->AddAddress("compras@grupocavi.com.mx");
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->Subject = "Notificación | Actividad de Proveedor";
					$mail->Body = "<p>Te informamos que el proveedor: ".$_POST["razon_social"]." ha cargado su opinión de cumplimiento.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
						Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
					$mail->AddCC($mailcc);

					if(!$mail->Send())
					{
					echo "Fallo";
					}
					else 
					{
					echo "Éxito";
					}

					//---------- SECCIÓN INSERCIÓN DE ARCHIVOS ADJUNTOS ---------------//
					$countfiles = count($_FILES['file']['name']);
					$totalFileUploaded = 0;

					for($i=0;$i<$countfiles;$i++) {
						$filename = $_FILES['file']['name'][$i];
						## Insert to DataBase
						$sql_files ="UPDATE proveedores SET opinion_cumplimiento='".$filename."' WHERE rfc='".$_POST['rfc']."'";
						$result_files = mysql_query($sql_files) or die(mysql_error());

						## Location
						$location = "opiniones/".$filename;
						$extension = pathinfo($location,PATHINFO_EXTENSION);
						$extension = strtolower($extension);

						## File upload allowed extensions
						$valid_extensions = array("pdf");

						$response = 0;
						## Check file extension
						if(in_array(strtolower($extension), $valid_extensions)) {
							## Upload file
							if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$location)){
								$totalFileUploaded++;
							}
						}
					}
					//----------- FIN DE SECCIÓN ARCHIVOS ADJUNTOS---------------------//	
				}
				else if(isset($_POST["submitC"]))
 					{
						$P_ID = $_SESSION['usuario'];

						$countfiles = count($_FILES['file']['name']);
						$totalFileUploaded = 0;

						for($i=0;$i<$countfiles;$i++) {
							$filename = $_FILES['file']['name'][$i];
							## Insert to DataBase
							$sql_files ="UPDATE proveedores SET inf_contrato='".$filename."' WHERE rfc='".$P_ID."'";
							$result_files = mysql_query($sql_files) or die(mysql_error());

							## Location
							$location = "opiniones/contratos/".$filename;
							$extension = pathinfo($location,PATHINFO_EXTENSION);
							$extension = strtolower($extension);

							## File upload allowed extensions
							$valid_extensions = array("pdf");

							$response = 0;
							## Check file extension
							if(in_array(strtolower($extension), $valid_extensions)) {
								## Upload file
								if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$location)){
									$totalFileUploaded++;
								}
							}
						}
			
						echo "<script languaje='javascript'>
						alert('Datos Adjuntados')
						location.href='usuario_prov_mod?prov=$P_ID';
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
						$mail->setFrom('soporte@grupocavi.com.mx', 'NOTIFICACIÓN PROVEEDORES');
						$mail->AddAddress("compras@grupocavi.com.mx");
						$mail->WordWrap = 50;
						$mail->IsHTML(true);
						$mail->CharSet = 'UTF-8';
						$mail->Subject = "Notificación | Actividad de Proveedor";
						$mail->Body = "<p>Te informamos que el proveedor: ".$P_ID." ha cargado información de contratos.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
							Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
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
					else if(isset($_POST["submitI"]))
 					{
						$P_ID = $_SESSION['usuario'];

						$countfiles = count($_FILES['file']['name']);
						$totalFileUploaded = 0;

						for($i=0;$i<$countfiles;$i++) {
							$filename = $_FILES['file']['name'][$i];
							## Insert to DataBase
							$sql_files ="UPDATE proveedores SET inf_impuestos='".$filename."' WHERE rfc='".$P_ID."'";
							$result_files = mysql_query($sql_files) or die(mysql_error());

							## Location
							$location = "opiniones/impuestos/".$filename;
							$extension = pathinfo($location,PATHINFO_EXTENSION);
							$extension = strtolower($extension);

							## File upload allowed extensions
							$valid_extensions = array("pdf");

							$response = 0;
							## Check file extension
							if(in_array(strtolower($extension), $valid_extensions)) {
								## Upload file
								if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$location)){
									$totalFileUploaded++;
								}
							}
						}
			
						echo "<script languaje='javascript'>
						alert('Datos Adjuntados')
						location.href='usuario_prov_mod?prov=$P_ID';
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
						$mail->setFrom('soporte@grupocavi.com.mx', 'NOTIFICACIÓN PROVEEDORES');
						$mail->AddAddress("compras@grupocavi.com.mx");
						$mail->WordWrap = 50;
						$mail->IsHTML(true);
						$mail->CharSet = 'UTF-8';
						$mail->Subject = "Notificación | Actividad de Proveedor";
						$mail->Body = "<p>Te informamos que el proveedor: ".$P_ID." ha cargado información de impuestos.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
							Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
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
                    $prov_s= $_GET['prov'];
					$sql_query="SELECT * FROM proveedores WHERE rfc='".$prov_s."'";
					$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0)
						{
							while($Rs=mysql_fetch_array($resultado)) 
							{ ?>
								<div class="element">
								<form action="usuario_prov_mod" method="post" enctype='multipart/form-data'>
									<div class="row form-horizontal">
										<div class="col-xs-6">
											<label class="control-label">Razón Social</label>
											<input name="razon_social" type="text" class="form-control input-sm" required value="<?php echo $Rs['razon_social']; ?>">
										</div>
										<div class="col-xs-3">
											<label class="control-label">RFC</label>
											<input name="rfc" size="13" type="text" class="form-control input-sm" required value="<?php echo $Rs['rfc']; ?>">
										</div>
										<div class="col-xs-3">
											<label class="control-label">CURP</label>
											<input name="curp" size="18" type="text" class="form-control input-sm" value="<?php echo $Rs['curp']; ?>">
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-6">
											<label class="control-label">Dirección</label>
											<input name="direccion" type="text" class="form-control input-sm" required value="<?php echo $Rs['direccion']; ?>">
										</div>
										<div class="col-xs-3">
											<label class="control-label">Teléfono</label>
											<input name="telefono" size="18" type="text" class="form-control input-sm" required value="<?php echo $Rs['telefono']; ?>">
										</div>
										<div class="col-xs-3">
											<label class="control-label">Correo</label>
											<input name="correo" type="email" class="form-control input-sm" required value="<?php echo $Rs['correo']; ?>">
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-6">
											<label class="control-label">Contacto</label>
											<input name="contacto" type="text" class="form-control input-sm" required value="<?php echo $Rs['contacto']; ?>">
										</div>
										<div class="col-xs-6">
											<label class="control-label">Área</label>
											<input name="area" type="text" class="form-control input-sm" required value="<?php echo $Rs['area']; ?>">
										</div>
										<div class="col-xs-2">
											<input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id']; ?>" size="17" />
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-6">
											<label class="control-label">Nombre del Banco</label>
											<input name="nombre_banco" type="text" class="form-control input-sm" required value="<?php echo $Rs['nombre_banco']; ?>">
										</div>
										<div class="col-xs-3">
											<label class="control-label">Cuenta Bancaria</label>
											<input name="cuenta" size="11" type="number" class="form-control input-sm" required value="<?php echo $Rs['cuenta']; ?>">
										</div>
										<div class="col-xs-3">
											<label class="control-label">Clabe Interbancaria</label>
											<input name="clabe" size="18" type="number" class="form-control input-sm" required value="<?php echo $Rs['clabe']; ?>">
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-12" style="text-align:center;">
											<label class="control-label">Productos/Servicios que ofrece</label>
										</div>
									</div>
									<div class="row form-horizontal">
										<div class="col-xs-4">
											<?php
											mysql_query("SET NAMES 'UTF8'");
											$consulta_mysql = 'SELECT * FROM productos_servicios ORDER BY descripcion ASC';
											$resultado_consulta_mysql = mysql_query($consulta_mysql,$conexion);
											echo "<select name='ps1' class='form-control input-sm'>";
											echo "<option> {$Rs['ps1']}</option>";
											while($fila=mysql_fetch_array($resultado_consulta_mysql))
											{
												echo "<option value='".$fila['descripcion']."'>".$fila['descripcion']."</option>";
											}
											echo "</select>";
											?>
										</div>
										<div class="col-xs-4">
											<?php
											mysql_query("SET NAMES 'UTF8'");
											$consulta_mysql = 'SELECT * FROM productos_servicios ORDER BY descripcion ASC';
											$resultado_consulta_mysql = mysql_query($consulta_mysql,$conexion);
											echo "<select name='ps2' class='form-control input-sm'>";
											echo "<option> {$Rs['ps2']}</option>";
											while($fila=mysql_fetch_array($resultado_consulta_mysql))
											{
												echo "<option value='".$fila['descripcion']."'>".$fila['descripcion']."</option>";
											}
											echo "</select>";
											?>
										</div>
										<div class="col-xs-4">
											<?php
											mysql_query("SET NAMES 'UTF8'");
											$consulta_mysql = 'SELECT * FROM productos_servicios ORDER BY descripcion ASC';
											$resultado_consulta_mysql = mysql_query($consulta_mysql,$conexion);
											echo "<select name='ps3' class='form-control input-sm'>";
											echo "<option> {$Rs['ps3']}</option>";
											while($fila=mysql_fetch_array($resultado_consulta_mysql))
											{
												echo "<option value='".$fila['descripcion']."'>".$fila['descripcion']."</option>";
											}
											echo "</select>";
											?>
										</div>
									</div>
									<br>
									<label class="control-label">Adjuntar Opinion de Cumplimiento</label>
									<input type="file" name="file[]" id="file" accept="application/pdf">
									<br>
									<div id="btn-form">
										<input class="btn form-btn btn-primary" type="submit" name="submit" value="Modificar">
										<br><br>
										<?php 
											$sql_doc="SELECT * FROM proveedores WHERE rfc='".$prov_s."' AND opinion_cumplimiento IS NOT NULL";
											$res_doc=mysql_query($sql_doc,$conexion) or die("Error: ".mysql_error());
											if(mysql_num_rows($res_doc) > 0)
											{
												while($Rsd=mysql_fetch_array($res_doc)) 
												{
													echo"<a href='opiniones/".$Rsd['opinion_cumplimiento']."'><img src='icon_pdf.jpg' alt='".$Rsd['opinion_cumplimiento']."' width='30' height='30'><label style='font-size:11px'>".$Rsd['opinion_cumplimiento']."</label></a>";
												}
											}
										?>
									</div>
								</form>
								<br><br><br>
								<?php
								if($Rs['tipo_contrato'] == "REPSE")
								{ ?>
									<form action="usuario_prov_mod" method="post" enctype='multipart/form-data'>
										<label class="control-label">ACTUALIZAR INFORMACIÓN RELATIVA SOBRE CONTRATO VIGENTE</label>
										<p style="color:gray;"><i>Adjunte información relativa a su contrato vigente, conforme a lo establecido en el artículo 15-A de la Ley del Seguro Social y al artículo 29 Bis de la Ley del Instituto del Fondo Nacional de la Vivienda para los Trabajadores.</i></p>
										<input type="file" name="file[]" id="file" accept="application/pdf">
										<br>
										<div id="btn-form">
											<input class="btn form-btn btn-success" type="submit" name="submitC" value="Cargar">
											<br><br>
											<?php 
												$sql_doc="SELECT * FROM proveedores WHERE rfc='".$prov_s."' AND inf_contrato IS NOT NULL";
												$res_doc=mysql_query($sql_doc,$conexion) or die("Error: ".mysql_error());
												if(mysql_num_rows($res_doc) > 0)
												{
													while($Rsd=mysql_fetch_array($res_doc)) 
													{
														echo"<a href='opiniones/contratos/".$Rsd['inf_contrato']."'><img src='icon_pdf.jpg' alt='".$Rsd['inf_contrato']."' width='30' height='30'><label style='font-size:11px'>".$Rsd['inf_contrato']."</label></a>";
													}
												}
											?>
										</div>
									</form><br><br><br>
							<?php } ?>
								<?php
								if($Rs['tipo_contrato'] == "REPSE")
								{ ?>
									<form action="usuario_prov_mod" method="post" enctype='multipart/form-data'>
										<label class="control-label">ACTUALIZAR INFORMACIÓN RELATIVA A IMPUESTOS</label>
										<p style="color:gray;"><i>Adjunte los comprobantes y toda la información requerida para dar cumplimiento a la Ley del Impuesto sobre la Renta y la Ley del Impuesto al Valor Agregado, cuando se efectúe el pago de la contraprestación por el Servicio Especializado recibido.</i></p>
										<input type="file" name="file[]" id="file" accept="application/pdf">
										<br>
										<div id="btn-form">
											<input class="btn form-btn btn-info" type="submit" name="submitI" value="Cargar">
											<br><br>
											<?php 
												$sql_doc="SELECT * FROM proveedores WHERE rfc='".$prov_s."' AND inf_impuestos IS NOT NULL";
												$res_doc=mysql_query($sql_doc,$conexion) or die("Error: ".mysql_error());
												if(mysql_num_rows($res_doc) > 0)
												{
													while($Rsd=mysql_fetch_array($res_doc)) 
													{
														echo"<a href='opiniones/impuestos/".$Rsd['inf_impuestos']."'><img src='icon_pdf.jpg' alt='".$Rsd['inf_impuestos']."' width='30' height='30'><label style='font-size:11px'>".$Rsd['inf_impuestos']."</label></a>";
													}
												}
											?>
										</div>
									</form>
							<?php } ?>
						<?php   		
				}
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
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>