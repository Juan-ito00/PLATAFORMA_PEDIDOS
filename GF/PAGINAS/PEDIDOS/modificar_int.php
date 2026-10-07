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
                      <li><a href="historial_gen">Compras</a></li>
                            <li><a href="historial_int">Servicios Internos</a></li>
                            <li><a href="historial_mtto">Mantenimientos</a></li>
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
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".$_SESSION['usuario']." ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Modificar Pedido</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
 					if(isset($_POST["submit"])){
            if ($_POST["supervisor"] == $_SESSION['nombre']) 
            {
              $fecha_entrega1=$_POST['fecha_entrega1'];
              $fecha_entrega2=$_POST['fecha_entrega2'];
              $fecha_entrega3=$_POST['fecha_entrega3'];
              $fecha_devolucion1=$_POST['fecha_devolucion1'];
              $fecha_devolucion2=$_POST['fecha_devolucion2'];
              $fecha_devolucion3=$_POST['fecha_devolucion3'];
            
              $query = "UPDATE pedidos_int SET cancelar='".$_POST["cancelar"]."',folio='".$_POST["folio"]."',fecha_solicitud='".$_POST["fecha_solicitud"]."',"."proyecto='".$_POST["proyecto"]."', supervisor='".$_POST["supervisor"]."', tipo_servicio='".$_POST["tipo_servicio"]."', "."ubicacion='".$_POST["ubicacion"]."',"."servicio1='".$_POST["servicio1"]."',"."servicio2='".$_POST["servicio2"]."',"."servicio3='".$_POST["servicio3"]."',"."fecha_entrega1=" . ($fecha_entrega1==NULL ? "NULL" : "'$fecha_entrega1'") . ","."fecha_entrega2=" . ($fecha_entrega2==NULL ? "NULL" : "'$fecha_entrega2'") . ","."fecha_entrega3=" . ($fecha_entrega3==NULL ? "NULL" : "'$fecha_entrega3'") . ","."fecha_devolucion1=" . ($fecha_devolucion1==NULL ? "NULL" : "'$fecha_devolucion1'") . ","."fecha_devolucion2=" . ($fecha_devolucion2==NULL ? "NULL" : "'$fecha_devolucion2'") . ","."fecha_devolucion3=" . ($fecha_devolucion3==NULL ? "NULL" : "'$fecha_devolucion3'") . ","."autorizado='Pendiente',"."notas_seguimiento='".$_POST["notas_seguimiento"]."' WHERE id_pedido='".$_POST["id"]."' AND gerencia='GF' AND supervisor='".$_SESSION['nombre']."'";
            $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
          
            echo "<script languaje='javascript'>
                    alert('Se han modificado los datos del pedido con folio ".$_POST["folio"]."')
        location.href='historial_int?id=tw_redireccion';
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

            $nom_gerente = "Cecilia";
            $supervisor = $_POST['supervisor'];
            $mailto = "cecilia_castrejon@grupocavi.com.mx";
                     
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
            }
            else
            {
              echo "<script languaje='javascript'>
                    alert('No tienes autorización para realizar esta acción')
        location.href='historial_gen?id=tw_redireccion';
                  </script>";
            }
						

				}else{
						$id_pedido=$_GET['id_pedido'];
						$sql_query="SELECT * FROM pedidos_int WHERE id_pedido='".$id_pedido."' AND gerencia='GF'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
				?>
            					<form method="post" name=frm action="modificar_int">
         				<div class="row form-horizontal"> 
                     <!--Tipo de Compra-->
                      <div class="col-xs-2">
                        <label class="control-label" for="tipo_compra">Tipo de Servicio</label>
                        <select name="tipo_servicio" class="form-control input-sm " id="">
  <option value="<?php echo $Rs['tipo_servicio']; ?>" class="form-control input-sm" id="" ><?php echo $Rs['tipo_servicio']; ?></option>
    <option value="Maquinaria" class="form-control input-sm" id="" >Maquinaria</option>
    <option value="Transporte Especial" class="form-control input-sm" id="" >Transporte Especial</option>
    <option value="Vehículos" class="form-control input-sm" >Vehículos</option>
    <option value="Mantenimiento" class="form-control input-sm" >Mantenimiento</option> 
</select>
                      </div>
                      <div class="col-xs-6"></div>
                      <div class="col-xs-2">
                        <input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id_pedido']; ?>" size="17" />
                      </div>
                      <div class="col-xs-2">
                      <label class="control-label" for="folio">Folio</label>
                          <input name="folio" readonly type="text" class="form-control input-sm" required value="<?php echo $Rs['folio']; ?>" size="17" />
                  </div>
                </div>
                <div class="row form-horizontal">
                  <div class="col-xs-2">
                    <label class="control-label" for="fecha">Fecha</label>
                        <input class="form-control input-sm" name="fecha_solicitud" type="date" readonly required value="<?php echo $Rs['fecha_solicitud']; ?>" size="15" />
                    </div>
                    <div class="col-xs-5">
                      <label class="control-label" for="proyecto">Proyecto</label>
                              <?php
                  mysql_query("SET NAMES 'UTF8'");
                  $consulta_mysql='select * from obras ORDER BY nombre ASC';
                  $resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
                  echo "<select name='proyecto'  class='form-control input-sm'>";
                  echo "<option> {$Rs['proyecto']}</option>";
                  while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                      echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
                  }
                  echo "</select>";
                ?>
                      </div>
                    <div class="col-xs-3">
                      <label class="control-label" for="supervisor">Supervisor</label>
                        <input class="form-control input-sm" name="supervisor" type="text" required value="<?php echo $Rs['supervisor']; ?>" size="50" />
                    </div>
                    <div class="col-xs-2">
                      <label class="control-label" for="ubicacion">Ubicación</label>
                      <input class="form-control input-sm" name="ubicacion" type="text" value="<?php echo $Rs['ubicacion']; ?>"  size="17" />
                    </div>   
                    </div>
                  <div class="row form-horizontal">
                <div class="col-xs-8">
                      <label class="control-label" for="descripcion1">Descripción del Servicio</label>
                      <textarea name="servicio1" class="form-control"><?php echo htmlspecialchars($Rs['servicio1']); ?></textarea>
                    </div>
                    <div class="col-xs-4" style="text-align: center;">
                      <label class="control-label" for="rango_fechas">Rango de Fechas</label>
                    </div>
                    <div class="col-xs-2">
                      <input name="fecha_entrega1" class="form-control input-sm" type="date" value="<?php echo $Rs['fecha_entrega1']; ?>"/>
                    </div>
                    <div class="col-xs-2">
                      <input name="fecha_devolucion1" class="form-control input-sm" type="date" value="<?php echo $Rs['fecha_devolucion1']; ?>"/>
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-8">
                      <label class="control-label"></label>
                      <textarea name="servicio2" class="form-control"><?php echo htmlspecialchars($Rs['servicio2']); ?></textarea>
                      </div>
                      <div class="col-xs-4" style="text-align: center;">
                        <label class="control-label"></label>
                      </div>
                      <div class="col-xs-2">
                        <input name="fecha_entrega2" class="form-control input-sm" type="date" value="<?php echo $Rs['fecha_entrega2']; ?>"/>
                      </div>
                      <div class="col-xs-2">
                        <input name="fecha_devolucion2" class="form-control input-sm" type="date" value="<?php echo $Rs['fecha_devolucion2']; ?>"/>
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-8">
                      <label class="control-label"></label>
                      <textarea name="servicio3" class="form-control" ><?php echo htmlspecialchars($Rs['servicio3']); ?></textarea>
                      </div>
                      <div class="col-xs-4" style="text-align: center;">
                        <label class="control-label"></label>
                      </div>
                      <div class="col-xs-2">
                        <input name="fecha_entrega3" class="form-control input-sm" type="date"  value="<?php echo $Rs['fecha_entrega3']; ?>"/>
                      </div>
                      <div class="col-xs-2">
                        <input name="fecha_devolucion3" class="form-control input-sm" type="date" value="<?php echo $Rs['fecha_devolucion3']; ?>"/>
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <label class="control-label">Notas</label>
                      <textarea name="notas_seguimiento" class="form-control "><?php echo htmlspecialchars($Rs['notas_seguimiento']); ?></textarea>
                      </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-10 col">
                <label class="control-label">Notas para autorización de pedido</label>
                <textarea  name="notas_autorizacion" class="form-control " maxlength="150" readonly=""><?php echo htmlspecialchars($Rs['notas_autorizacion']); ?></textarea>
                </div>
              </div>
          				<br>
           				<div id="btn-form">
          	 				<input class="btn form-btn btn-primary" type="submit" name="submit" value="Modificar Pedido">
         	 			</div>
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