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
        				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Nuevo Pedido<b class="caret"></b>
          				</a>
          				<ul class="dropdown-menu">
            				<li><a href="nuevo">Compras</a></li>
                        	<li><a href="nuevo_int">Servicios Internos</a></li>
							<li><a href="nuevo_mtto">Mantenimientos</a></li>
          				</ul>
        			</li>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="historial_gerencia">Compras</a></li>
                    <li><a href="historial_gerencia_alm">Pedidos a Almacén</a></li>
                    <li><a href="historial_gerencia_int">Servicios Internos</a></li>
                    <li><a href="historial_gerencia_mtto">Mantenimientos</a></li>
                  </ul>
              </li>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"> </span> Reporte<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="reporte_general_g">General Compras</a></li>
                    <li><a href="reporte_general_g_int">General Servicios Internos</a></li>
                    <li><a href="reporte_obra">Por Obra Compras</a></li>
                    <li><a href="reporte_obra_int">Por Obra Servicios</a></li>
                  </ul>
              </li>
              <li><a href="almacen_gen"><span class="glyphicon glyphicon-th"> </span> Pedidos a Almacen</a></li>
              <li><a href="compras_gen"><span class="glyphicon glyphicon-th"> </span> Pedidos Compras</a></li>
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
			  <li><a href="A_COMP/prodNC_nuevo">Nuevo PNC</a></li>
              <li><a href="A_COMP/historial_prodNC">Historial PNC</a></li>
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
				<div class="panel panel-default" style="margin-top: 5px; overflow: auto;white-space: nowrap;">
					<div align="center" class="panel-heading">Modificar Pedido</div>
							<div class="panel-body">
							<?php
							header("Content-Type: text/html;charset=utf-8");
							error_reporting(E_ALL ^ E_NOTICE);
							mysql_query("SET NAMES 'utf8'");
                            
							$folio = $_POST['folio'];
							$supervisor_nom = $_POST['supervisor'];

							$result = mysql_query("SELECT * FROM supervisor WHERE nombre='$supervisor_nom'");

							while($rowS = mysql_fetch_array($result))
							{
								$mail_sup = $rowS['correo'];
							}

							$result2 = mysql_query("SELECT * FROM pedidos_alm WHERE folio='$folio'");
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
							else if($mail_ger == 'GCOMP') //Correo del gerente correspondiente
							{
								$mailcc = 'zeida_quiroz@grupocavi.com.mx';
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

							//$folio = nl2br($_POST['folio']); //Folio del pedido
							$estatus = nl2br($_POST['estado']); //Estatus del pedido
                            
							$estado = $_POST['estado'];
					if(isset($_POST["submit"]) AND $estado == 'Recibido')
					{
						$sql_id = "INSERT INTO folios_alm SET idsdgg='0'";
						$result_id = mysql_query($sql_id) or die(mysql_error());
						$id_id = mysql_insert_id();
						$folio_id =  strtoupper( "ALM ".str_pad($id_id,3,'0',STR_PAD_LEFT).date("/ y"));

						$sql = "UPDATE folios_alm SET folio='".$folio_id."' WHERE id='".$id_id."'";
						$result = mysql_query($sql) or die(mysql_error());

						$query = "UPDATE pedidos_alm SET estado='Recibido', fecha='".$_POST["fecha_seguimiento"]."', fecha_recibido='".$_POST["fecha_seguimiento"]."', folio_alm='".$folio_id."' WHERE id_pedido='".$_POST["id"]."'";
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
								$mail->Username = "airam_ramirez@grupocavi.com.mx";
								$mail->Password = "x85;cfr-#UL~";
								$mail->setFrom('airam_ramirez@grupocavi.com.mx', 'ALMACÉN');           
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';
								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido a almacén ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
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
						$query = "UPDATE pedidos_alm SET estado='Surtido', fecha_surtido='".$_POST["fecha_seguimiento"]."' WHERE id_pedido='".$_POST["id"]."'";
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

								$mail->Username = "airam_ramirez@grupocavi.com.mx";
								$mail->Password = "x85;cfr-#UL~";
								$mail->setFrom('airam_ramirez@grupocavi.com.mx', 'ALMACÉN');          
								$mail->AddAddress($mailto);
								$mail->WordWrap = 50;
								$mail->IsHTML(true);
								$mail->CharSet = 'UTF-8';
								$mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
								$mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado ".$supervisor_nom.":</p><p>Te informamos que tu pedido a almacén ".$folio.", tiene el siguiente estatus: ".$estatus.".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
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
				else
				{
						$id_pedido=$_GET['id_pedido'];
						$sql_query="SELECT * FROM pedidos_alm WHERE id_pedido='".$id_pedido."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());

						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
				?>
							<form method="post" name=frm action="">
								<div class="row form-horizontal">
									
  						<div class="col-xs-2">
                	            <label class="control-label">Folio Gerencia</label>
    						  <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?> " >
  						</div>
                          <div class="col-xs-2">
                	            <label class="control-label">Folio Almacén</label>
    						  <input readonly align="right" name="folio_alm" class="form-control input-sm" value="<?php echo $Rs['folio_alm'];?> " >
  						</div>
  						<!--Campo Supervisor-->
						<div class="col-xs-3">
        				<label class="control-label">Solicitante</label>
						<input readonly name="supervisor" type="text" class="form-control input-sm" value="<?php echo $Rs["supervisor"]; ?>">
						</div>
              <!--Campo Proyecto-->
				<div class="col-xs-5">
				<label class="control-label">Proyecto</label>
					<?php
	 					mysql_query("SET NAMES 'UTF8'");
						$consulta_mysql='select * from obras ORDER BY nombre ASC';
						$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
							echo "<select readonly name='proyecto' class='form-control input-sm'>".
              "<option selected value='".$Rs['proyecto']."'>".$Rs['proyecto']."</option>";
						while($fila=mysql_fetch_array($resultado_consulta_mysql)){
							echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
						}
						echo "</select>";
					?>
				</div>
			</div>
                    <div class="row form-horizontal">
                    <div class="col-xs-6">
                    <input name="id" type="hidden" class="form-control input-sm" value="<?php echo $Rs['id_pedido']; ?>" />
                    </div>
                        <div class="col-xs-2">
                            <label class="control-label">Fecha Recibido</label>
                            <input name="fecha" type="date" class="form-control input-sm" readonly type="text" value="<?php echo $Rs['fecha']; ?>" />
                        </div>
                        <div class="col-xs-2">
                            <label class="control-label">Estado</label>
                            <select name="estado" class="form-control input-sm" required disabled>
                                <option class="form-control input-sm"><?php  echo $Rs['estado']; ?></option>
                                <option class="form-control input-sm" name=uno value="Recibido">Recibido</option>
                                <option class='form-control input-sm' name=uno value='Surtido'>Surtido</option>
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <label class="control-label">Fecha</label>
                            <input name="fecha_seguimiento" type="date" disabled class="form-control input-sm" required type="text" value="<?php echo date("d/m/Y"); ?>" />
                        </div>
                    </div>
						<!--divs cantidad unidad descripcion-->
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
                				<label class="control-label">Cantidad</label>
								<input name="cantidad1" type="text" class="form-control input-sm" readonly value="<?php echo $Rs["cant1"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
               	  				<label class="control-label">Unidad</label>
    							<input type="text" name="unidad1" class="form-control input-sm" readonly value="<?php echo $Rs["unid1"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
                				<label class="control-label">Descripcion</label>
    							<input type="text" class="form-control input-sm" name="descripcion1" readonly value="<?php echo $Rs["desc1"]; ?>">
  							</div>
                <!--Campo Código-->
                <div class="col-xs-3">
                        <label class="control-label">Código</label>
                  <input type="text" class="form-control input-sm" name="codigo1" readonly value="<?php echo $Rs["codigo1"]; ?>">
                </div>
						</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad2" readonly value="<?php echo $Rs["cant2"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad2" readonly value="<?php echo $Rs["unid2"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion2" readonly value="<?php echo $Rs["desc2"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo2" readonly value="<?php echo $Rs["codigo2"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad3" readonly value="<?php echo $Rs["cant3"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad3" readonly value="<?php echo $Rs["unid3"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion3" readonly value="<?php echo $Rs["desc3"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo3" readonly value="<?php echo $Rs["codigo3"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad4" readonly value="<?php echo $Rs["cant4"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad4" readonly value="<?php echo $Rs["unid4"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion4" readonly value="<?php echo $Rs["desc4"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo4" readonly value="<?php echo $Rs["codigo4"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad5" readonly value="<?php echo $Rs["cant5"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad5" readonly value="<?php echo $Rs["unid5"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion5" readonly value="<?php echo $Rs["desc5"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo5" readonly value="<?php echo $Rs["codigo5"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad6" readonly value="<?php echo $Rs["cant6"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad6" readonly value="<?php echo $Rs["unid6"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion6" readonly value="<?php echo $Rs["desc6"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo6" readonly value="<?php echo $Rs["codigo6"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad7" readonly value="<?php echo $Rs["cant7"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad7" readonly value="<?php echo $Rs["unid7"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion7" readonly value="<?php echo $Rs["desc7"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo7" readonly value="<?php echo $Rs["codigo7"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad8" readonly value="<?php echo $Rs["cant8"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad8" readonly value="<?php echo $Rs["unid8"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion8" readonly value="<?php echo $Rs["desc8"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo8" readonly value="<?php echo $Rs["codigo8"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad9" readonly value="<?php echo $Rs["cant9"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad9" readonly value="<?php echo $Rs["unid9"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion9" readonly value="<?php echo $Rs["desc9"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo9" readonly value="<?php echo $Rs["codigo9"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad10" readonly value="<?php echo $Rs["cant10"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad10" readonly value="<?php echo $Rs["unid10"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion10" readonly value="<?php echo $Rs["desc10"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo10" readonly value="<?php echo $Rs["codigo10"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad11" readonly value="<?php echo $Rs["cant11"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad11" readonly value="<?php echo $Rs["unid11"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion11" readonly value="<?php echo $Rs["desc11"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo11" readonly value="<?php echo $Rs["codigo11"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad12" readonly value="<?php echo $Rs["cant12"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad12" readonly value="<?php echo $Rs["unid12"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion12" readonly value="<?php echo $Rs["desc12"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo12" readonly value="<?php echo $Rs["codigo12"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad13" readonly value="<?php echo $Rs["cant13"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad13" readonly value="<?php echo $Rs["unid13"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion13" readonly value="<?php echo $Rs["desc13"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo13" readonly value="<?php echo $Rs["codigo13"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad14" readonly value="<?php echo $Rs["cant14"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad14" readonly value="<?php echo $Rs["unid14"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion14" readonly value="<?php echo $Rs["desc14"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo14" readonly value="<?php echo $Rs["codigo14"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad15" readonly value="<?php echo $Rs["cant15"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad15" readonly value="<?php echo $Rs["unid15"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion15" readonly value="<?php echo $Rs["desc15"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo15" readonly value="<?php echo $Rs["codigo15"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad16" readonly value="<?php echo $Rs["cant16"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad16" readonly value="<?php echo $Rs["unid16"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion16" readonly value="<?php echo $Rs["desc16"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo16" readonly value="<?php echo $Rs["codigo16"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad17" readonly value="<?php echo $Rs["cant17"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad17" readonly value="<?php echo $Rs["unid17"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion17" readonly value="<?php echo $Rs["desc17"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo17" readonly value="<?php echo $Rs["codigo17"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad18" readonly value="<?php echo $Rs["cant18"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad18" readonly value="<?php echo $Rs["unid18"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion18" readonly value="<?php echo $Rs["desc18"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo18" readonly value="<?php echo $Rs["codigo18"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad19" readonly value="<?php echo $Rs["cant19"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad19" readonly value="<?php echo $Rs["unid19"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion19" readonly value="<?php echo $Rs["desc19"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo19" readonly value="<?php echo $Rs["codigo19"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad20" readonly value="<?php echo $Rs["cant20"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad20" readonly value="<?php echo $Rs["unid20"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion20" readonly value="<?php echo $Rs["desc20"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo20" readonly value="<?php echo $Rs["codigo20"]; ?>">
              </div>
					</div>
									<br>
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
	<script type="text/javascript">
		document.getElementById('surtido1').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp1').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp1').prop('readonly',true);
		  }
		});
		document.getElementById('surtido2').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp2').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp2').prop('readonly',true);
		  }
		});
		document.getElementById('surtido3').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp3').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp3').prop('readonly',true);
		  }
		});
		document.getElementById('surtido4').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp4').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp4').prop('readonly',true);
		  }
		});
		document.getElementById('surtido5').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp5').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp5').prop('readonly',true);
		  }
		});
		document.getElementById('surtido6').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp6').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp6').prop('readonly',true);
		  }
		});
		document.getElementById('surtido7').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp7').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp7').prop('readonly',true);
		  }
		});
		document.getElementById('surtido8').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp8').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp8').prop('readonly',true);
		  }
		});
		document.getElementById('surtido9').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp9').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp9').prop('readonly',true);
		  }
		});
		document.getElementById('surtido10').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp10').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp10').prop('readonly',true);
		  }
		});
		document.getElementById('surtido11').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp11').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp11').prop('readonly',true);
		  }
		});
		document.getElementById('surtido12').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp12').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp12').prop('readonly',true);
		  }
		});
		document.getElementById('surtido13').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp13').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp13').prop('readonly',true);
		  }
		});
		document.getElementById('surtido14').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp14').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp14').prop('readonly',true);
		  }
		});
		document.getElementById('surtido15').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp15').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp15').prop('readonly',true);
		  }
		});
		document.getElementById('surtido16').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp16').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp16').prop('readonly',true);
		  }
		});
		document.getElementById('surtido17').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp17').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp17').prop('readonly',true);
		  }
		});
		document.getElementById('surtido18').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp18').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp18').prop('readonly',true);
		  }
		});
		document.getElementById('surtido19').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp19').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp19').prop('readonly',true);
		  }
		});
		document.getElementById('surtido20').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp20').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp20').prop('readonly',true);
		  }
		});
		document.getElementById('surtido21').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp21').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp21').prop('readonly',true);
		  }
		});
		document.getElementById('surtido22').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp22').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp22').prop('readonly',true);
		  }
		});
		document.getElementById('surtido23').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp23').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp23').prop('readonly',true);
		  }
		});
		document.getElementById('surtido24').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp24').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp24').prop('readonly',true);
		  }
		});
		document.getElementById('surtido25').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp25').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp25').prop('readonly',true);
		  }
		});
		document.getElementById('surtido26').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp26').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp26').prop('readonly',true);
		  }
		});
		document.getElementById('surtido27').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp27').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp27').prop('readonly',true);
		  }
		});
		document.getElementById('surtido28').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp28').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp28').prop('readonly',true);
		  }
		});
		document.getElementById('surtido29').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp29').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp29').prop('readonly',true);
		  }
		});
		document.getElementById('surtido30').addEventListener('change', function (e)
	  	{
		  if (e.target.value === "Surtido Parcial")
		  {
		    $('#sp30').prop('readonly',false);
		  }
		  else
		  {
		  	$('#sp30').prop('readonly',true);
		  }
		});
	  </script>
	</body>
</html>