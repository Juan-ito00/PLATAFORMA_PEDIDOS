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
              <li >
                <?php if($_SESSION['usuario'] == 'SUPMTTO') { ?>
                  <a href="historial_mtto_s"><span class="glyphicon glyphicon-list"> </span> Historial
                  </a>
                  <?php } else { ?>
                  <a href="historial_mtto_g"><span class="glyphicon glyphicon-list"> </span> Historial
                  </a>
                  <?php } ?>
              </li>
                  <li class="dropdown">
                  <a href="reportes" ><span class="glyphicon glyphicon-list-alt"> </span> Reporte
                  </a>
              </li>
            </ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Visualizar Pedido</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
 					if(isset($_POST["submit"])){
              if ($_SESSION['usuario'] == 'SUPMTTO') 
              {
                  $query = "UPDATE mantenimientos SET surtido='Sí' WHERE id_pedido='".$_POST["id"]."'";
                  $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());

                  $resultc = mysql_query("SELECT * FROM supervisor WHERE nombre='".$_POST["solicitante"]."'");
                    while($rowS = mysql_fetch_array($resultc))
                    {
                        $mail_sup = $rowS['correo'];
                    }
              
                  echo "<script languaje='javascript'>
                          alert('Se ha surtido el pedido ".$_POST["folio_gpc"]."')
                  location.href='historial_mtto_s?id=tw_redireccion';
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
                            $mail->setFrom('soporte@grupocavi.com.mx', 'PEDIDOS DE MANTENIMIENTO');
                            $mail->AddAddress($mail_sup);
    
                            $mail->WordWrap = 50;
                            $mail->IsHTML(true);
                            $mail->CharSet = 'UTF-8';
                            $mail->Subject = "Sistema de Pedidos de MANTENIMIENTO | GRUPO CAVI";
                            $mail->Body = "<h2>|  Pedido de Mantenimiento Completo|</h2><br><p>Te informamos que tu pedido con folio ".$_POST['folio_ger']." ya fue surtido. 👍</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
    
                            if(!$mail->Send())
                            {
                              echo "Fallo";
                            }
              }
              else
              {
                  echo "<script languaje='javascript'>
                          alert('No tienes autorización para realizar esta acción')
                      location.href='historial_mtto_g?id=tw_redireccion';
                      </script>";
              }
				    }
                    else {
						$id_pedido=$_GET['id_pedido'];
						$sql_query="SELECT * FROM mantenimientos WHERE id_pedido='".$id_pedido."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
				?>
            	<form method="post" name=frm action="visualizar_mtto">
                <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <label class="control-label">Fecha</label>
                      <input name="fecha" type="date" class="form-control input-sm" readonly value="<?php echo $Rs['fecha']; ?>">
                    </div>
                        <div class="col-xs-2">
                			<label class="control-label">Folio GPC</label>
    						<input readonly align="right" name="folio_gpc" class="form-control input-sm" value="<?php echo $Rs['folio_gpc']; ?>">
  						</div>
                        <div class="col-xs-2">
                			<label class="control-label">Folio Ger. Solicitante</label>
    						<input readonly align="right" name="folio_ger" class="form-control input-sm" value="<?php echo $Rs['folio_ger']; ?>">
  						</div>
						<div class="col-xs-4">
        				    <label class="control-label">Solicitante</label>
						    <input name="solicitante" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['solicitante']; ?>">
						</div>
                        <div class="col-xs-1">
                        <input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id_pedido']; ?>" size="17" />
                        </div>
                    </div>
                    <div class="row form-horizontal">
                        <div class="col-xs-5">
                            <label class="control-label">Gerencia que Solicita</label>
                            <input name="gerencia" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['gerencia']; ?>">
                        </div>
                        <div class="col-xs-5">
        				    <label class="control-label">Departamento</label>
						    <input name="departamento" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['departamento']; ?>">
						</div>
                    </div>
                    <div class="row form-horizontal">
						<div class="col-xs-10">
        				    <label class="control-label">Lugar de Realización</label>
						    <input name="lugar" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['lugar']; ?>">
						</div>
                	</div>
					<div class="row form-horizontal">
                        <div class="col-xs-10">
                            <label class="control-label">Descripción</label>
                            <textarea  name="descripcion" class="form-control " readonly ><?php echo $Rs['descripcion']; ?></textarea>
                        </div>
                    </div>
                    <div class="row form-horizontal">
                        <div class="col-xs-10">
                            <label class="control-label">Notas</label>
                            <textarea  name="notas" class="form-control " readonly><?php echo $Rs['notas']; ?></textarea>
                        </div>
                    </div>
                    <div class="row form-horizontal">
                        <div class="col-xs-3">
                            <label class="control-label">¿Se cuenta con el material necesario?</label>
                            <select readonly name="material_necesario" class="form-control ">
                            <option selected><?php echo $Rs['material_necesario']; ?></option>
                              <option value="Sí">Sí</option>
                              <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-horizontal">
                        <div class="col-xs-10">
                            <label class="control-label">Material</label>
                            <textarea  name="material" class="form-control "readonly><?php echo $Rs['material']; ?></textarea>
                        </div>
                    </div>
                    <br>
                  <?php if($_SESSION['usuario'] == 'SUPMTTO') { ?>
                    <div id="btn-form">
                        <input class="btn form-btn btn-success" type="submit" name="submit" value="Surtido">
                </div>
                <?php } ?>
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