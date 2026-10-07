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
	<title>Registrar Usuario</title>
	<link href="../../css/bootstrap.min.css" rel="stylesheet">
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
						<a class="navbar-brand" href="inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
				</div>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Nuevo<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
									<li><a href="ordinario_nuevo">Aviso de Compra Ordinario</a></li>
									<li><a href="requisicion_nuevo">Aviso de Compra Requisición General</a></li>
									<li><a href="datos_nuevo">Datos de Proveedor</a></li>
								</ul>
							</li>
							<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
										</a>
										<ul class="dropdown-menu">
											<li><a href="historial_ordinario">Aviso de Compra Ordinario</a></li>
											  <li><a href="historial_requisicion">Aviso de Compra Requisición General</a></li>
											  <li><a href="historial_datos">Datos de Proveedor</a></li>
										</ul>
								</li>
								<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-briefcase"> </span> Proveedores<b class="caret"></b>
										</a>
										<ul class="dropdown-menu">
											<li><a href="proveedor_nuevo">Nuevo Proveedor</a></li>
											<li><a href="historial_proveedores">Proveedores en Sistema</a></li>
										</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book"> </span> Reportes<b class="caret"></b>
										</a>
									<ul class="dropdown-menu">
										<li><a href="reporte_vigencia">Reporte Vigencia Proveedor</a></li>
										<li><a href="reporte_avisos">Reporte Avisos de Compra</a></li>
										<li><a href="reporte_historial">Reporte Historial de Avisos</a></li>
									</ul>
								</li>
								<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-tasks"> </span> Solicitudes Cotizaciones<b class="caret"></b>
                        </a>
                    <ul class="dropdown-menu">
                        <li><a href="sol_cotizacion_nuevo">Nueva Solicitud Cotización</a></li>
                        <li><a href="sol_cotizaciones_historial">Historial Solicitudes Cotización</a></li>
                        <li><a href="sol_cotizaciones_reporte">Reporte Solicitudes Cotización</a></li>
                    </ul>
                </li>
						</ul>
					<ul class="nav navbar-nav navbar-right">
							<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
						</ul>
				</div>
			</nav>
		<!--Panel con el titulo de la pagina y contenido-->
		<div class="panel panel-default" style="margin-top: 5px;">
			<div align="center" class="panel-heading"><?php echo "Registrar Usuario";?></div>
			<div class="panel-body">
				<?php
					if ($_POST) 
					{
						mysql_query("SET NAMES 'UTF8'");
						mysql_query("SET lc_time_names = 'es_MX'");

						$proveedor=$_POST['proveedor'];

                        //Revisa si el proveedor ya tiene cuenta
                        $consulta_mysqlp = "SELECT * FROM usuarios_proveedores WHERE usuario='".$proveedor."'";
						$resultadop = mysql_query($consulta_mysqlp,$conexion);
                        if(mysql_num_rows($resultadop) > 0)
						{
                            echo "<script languaje='javascript'>
								alert('Este usuario ya tiene cuenta.')
								location.href='usuarios_p';
							</script>";
                        }
                        else
                        {
                            $consulta_mysql = "SELECT id,correo,razon_social FROM proveedores WHERE rfc='".$proveedor."'";
                            $resultado_consulta_mysql = mysql_query($consulta_mysql,$conexion);
                            while($fila=mysql_fetch_array($resultado_consulta_mysql))
                            {
                                $correo_prov = $fila['correo'];
                                $id_prov = $fila['id'];
                                $razon_prov = $fila['razon_social'];
                            }

                            //Generar password segura
                            $key = "";
                            $pattern = "1234567890abcdefghijklmñnopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ.-_*/=[]{}#@~&()?¿";
                            $max = strlen($pattern)-1;
                            for($i = 0; $i < 9; $i++){
                                $key .= substr($pattern, mt_rand(0,$max), 1);
                            }  

                            $sql ="INSERT INTO usuarios_proveedores(usuario,pass,id_proveedor) VALUES ('".$proveedor."','".$key."','".$id_prov."')";
                            $result = mysql_query($sql) or die(mysql_error());

							$query2 = "UPDATE proveedores SET registrado='Si' WHERE id='".$id_prov."'";
		              	    $result2=mysql_query($query2,$conexion) or die("Error: ".mysql_error());

                            echo "<br>";
                            echo "<script languaje='javascript'>
                                    alert('Usuario registrado, se enviaron los datos de acceso al proveedor.')
                                    location.href='usuarios_p';
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
								$mail->setFrom('compras@grupocavi.com.mx', 'COMPRAS GRUPO CAVI');           
								$mail->AddAddress($correo_prov);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';
								$mail->Subject = "Departamento de Compras de Grupo Cavi -> Datos para plataforma de proveedores";
								$mail->Body = "<h3>PLATAFORMA DE PROVEEDORES</h3><br><p>Estimado <strong>".$razon_prov."</strong>, le damos a conocer sus credenciales de acceso a nuestra plataforma de datos de proveedores:</p><p><strong>SITIO: </strong>https://grupocavi.net/PLATAFORMA_PEDIDOS/COMPRAS</p><p><strong>USUARIO: </strong>".$proveedor."</p><p><strong>CONTRASEÑA: </strong>".utf8_decode($key)."</p><p>¡Saludos!</p><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
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
	<script src="../../js/bootstrap.min.js"></script>
  </body>
</html>