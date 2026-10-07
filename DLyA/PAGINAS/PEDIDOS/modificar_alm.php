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
                      <li><a href="historial_alm">Pedidos a Almacén</a></li>
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
			  <li><a href="almacen_gen"><span class="glyphicon glyphicon-th"> </span> Pedidos a Almacen</a></li>
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
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".$_SESSION['usuario']." ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Modificar Pedido de Almacén</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
 					if(isset($_POST["submit"])){
            if ($_POST["supervisor"] == $_SESSION['nombre']) 
            {
              $query = "UPDATE pedidos_alm SET proyecto='".$_POST["proyecto"]."', cant1='".$_POST["cantidad1"]."', 
              unid1='".$_POST["unidad1"]."', desc1='".$_POST["descripcion1"]."',
               codigo1='".$_POST["codigo1"]."', cant2='".$_POST["cantidad2"]."', unid2='".$_POST["unidad2"]."',
               desc2='".$_POST["descripcion2"]."', codigo2='".$_POST["codigo2"]."', cant3='".$_POST["cantidad3"]."',
               unid3='".$_POST["unidad3"]."', desc3='".$_POST["descripcion3"]."', codigo3='".$_POST["codigo3"]."',
               cant4='".$_POST["cantidad4"]."', unid4='".$_POST["unidad4"]."', desc4='".$_POST["descripcion4"]."',
               codigo4='".$_POST["codigo4"]."', cant5='".$_POST["cantidad5"]."', unid5='".$_POST["unidad5"]."',
               desc5='".$_POST["descripcion5"]."', codigo5='".$_POST["codigo5"]."', cant6='".$_POST["cantidad6"]."',
               unid6='".$_POST["unidad6"]."', desc6='".$_POST["descripcion6"]."', codigo6='".$_POST["codigo6"]."',
               cant7='".$_POST["cantidad7"]."', unid7='".$_POST["unidad7"]."', desc7='".$_POST["descripcion7"]."',
               codigo7='".$_POST["codigo7"]."', cant8='".$_POST["cantidad8"]."', unid8='".$_POST["unidad8"]."',
               desc8='".$_POST["descripcion8"]."', codigo8='".$_POST["codigo8"]."', cant9='".$_POST["cantidad9"]."',
               unid9='".$_POST["unidad9"]."', desc9='".$_POST["descripcion9"]."', codigo9='".$_POST["codigo9"]."',
               cant10='".$_POST["cantidad10"]."', unid10='".$_POST["unidad10"]."', desc10='".$_POST["descripcion10"]."',
               codigo10='".$_POST["codigo10"]."', cant11='".$_POST["cantidad11"]."', unid11='".$_POST["unidad11"]."',
               desc11='".$_POST["descripcion11"]."', codigo11='".$_POST["codigo11"]."', cant12='".$_POST["cantidad12"]."',
               unid12='".$_POST["unidad12"]."', desc12='".$_POST["descripcion12"]."', codigo12='".$_POST["codigo12"]."',
               cant13='".$_POST["cantidad13"]."', unid13='".$_POST["unidad13"]."', desc13='".$_POST["descripcion13"]."',
               codigo13='".$_POST["codigo13"]."', cant14='".$_POST["cantidad14"]."', unid14='".$_POST["unidad14"]."',
               desc14='".$_POST["descripcion14"]."', codigo14='".$_POST["codigo14"]."', cant15='".$_POST["cantidad15"]."',
               unid15='".$_POST["unidad15"]."', desc15='".$_POST["descripcion15"]."', codigo15='".$_POST["codigo15"]."',
               cant16='".$_POST["cantidad16"]."', unid16='".$_POST["unidad16"]."', desc16='".$_POST["descripcion16"]."',
               codigo16='".$_POST["codigo16"]."', cant17='".$_POST["cantidad17"]."', unid17='".$_POST["unidad17"]."',
               desc17='".$_POST["descripcion17"]."', codigo17='".$_POST["codigo17"]."', cant18='".$_POST["cantidad18"]."',
               unid18='".$_POST["unidad18"]."', desc18='".$_POST["descripcion18"]."', codigo18='".$_POST["codigo18"]."',
               cant19='".$_POST["cantidad19"]."', unid19='".$_POST["unidad19"]."', desc19='".$_POST["descripcion19"]."',
               codigo19='".$_POST["codigo19"]."', cant20='".$_POST["cantidad20"]."', unid20='".$_POST["unidad20"]."',
               desc20='".$_POST["descripcion20"]."', codigo20='".$_POST["codigo20"]."' WHERE folio='".$_POST["folio"]."'";
            $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
          
            echo "<script languaje='javascript'>
                    alert('Se han modificado los datos del pedido con folio ".$_POST["folio"]."')
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

            $nom_gerente = "Airam Alonso";
            $supervisor = $_POST['supervisor'];
              $mailto = "airam_ramirez@grupocavi.com.mx";
                     
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
            }
            else
            {
              echo "<script languaje='javascript'>
                    alert('No tienes autorización para realizar esta acción')
        location.href='historial_alm?id=tw_redireccion';
                  </script>";
            }
						

				}else{
						$id_pedido=$_GET['id_pedido'];
						$sql_query="SELECT * FROM pedidos_alm WHERE id_pedido='".$id_pedido."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
				?>
          <form method="post" name=frm action="modificar_alm">
					<div class="row form-horizontal">
						<!--Campo Folio-->
  						<div class="col-xs-2">
                	<label class="control-label">Folio</label>
    						  <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?> " >
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
							echo "<select name='proyecto' class='form-control input-sm'>".
              "<option selected value='".$Rs['proyecto']."'>".$Rs['proyecto']."</option>";
						while($fila=mysql_fetch_array($resultado_consulta_mysql)){
							echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
						}
						echo "</select>";
					?>
				</div>
						</div>
						<!--divs cantidad unidad descripcion-->
            			<div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
                				<label class="control-label">Cantidad</label>
								<input name="cantidad1" type="text" class="form-control input-sm" value="<?php echo $Rs["cant1"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
               	  				<label class="control-label">Unidad</label>
    							<input type="text" name="unidad1" class="form-control input-sm" value="<?php echo $Rs["unid1"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
                				<label class="control-label">Descripcion</label>
    							<input type="text" class="form-control input-sm" name="descripcion1" value="<?php echo $Rs["desc1"]; ?>">
  							</div>
                <!--Campo Código-->
                <div class="col-xs-3">
                        <label class="control-label">Código</label>
                  <input type="text" class="form-control input-sm" name="codigo1" value="<?php echo $Rs["codigo1"]; ?>">
                </div>
						</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad2" value="<?php echo $Rs["cant2"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad2" value="<?php echo $Rs["unid2"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion2" value="<?php echo $Rs["desc2"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo2" value="<?php echo $Rs["codigo2"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad3" value="<?php echo $Rs["cant3"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad3" value="<?php echo $Rs["unid3"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion3" value="<?php echo $Rs["desc3"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo3" value="<?php echo $Rs["codigo3"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad4" value="<?php echo $Rs["cant4"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad4" value="<?php echo $Rs["unid4"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion4" value="<?php echo $Rs["desc4"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo4" value="<?php echo $Rs["codigo4"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad5" value="<?php echo $Rs["cant5"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad5" value="<?php echo $Rs["unid5"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion5" value="<?php echo $Rs["desc5"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo5" value="<?php echo $Rs["codigo5"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad6" value="<?php echo $Rs["cant6"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad6" value="<?php echo $Rs["unid6"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion6" value="<?php echo $Rs["desc6"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo6" value="<?php echo $Rs["codigo6"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad7" value="<?php echo $Rs["cant7"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad7" value="<?php echo $Rs["unid7"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion7" value="<?php echo $Rs["desc7"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo7" value="<?php echo $Rs["codigo7"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad8" value="<?php echo $Rs["cant8"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad8" value="<?php echo $Rs["unid8"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion8" value="<?php echo $Rs["desc8"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo8" value="<?php echo $Rs["codigo8"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad9" value="<?php echo $Rs["cant9"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad9" value="<?php echo $Rs["unid9"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion9" value="<?php echo $Rs["desc9"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo9" value="<?php echo $Rs["codigo9"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad10" value="<?php echo $Rs["cant10"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad10" value="<?php echo $Rs["unid10"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion10" value="<?php echo $Rs["desc10"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo10" value="<?php echo $Rs["codigo10"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad11" value="<?php echo $Rs["cant11"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad11" value="<?php echo $Rs["unid11"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion11" value="<?php echo $Rs["desc11"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo11" value="<?php echo $Rs["codigo11"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad12" value="<?php echo $Rs["cant12"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad12" value="<?php echo $Rs["unid12"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion12" value="<?php echo $Rs["desc12"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo12" value="<?php echo $Rs["codigo12"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad13" value="<?php echo $Rs["cant13"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad13" value="<?php echo $Rs["unid13"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion13" value="<?php echo $Rs["desc13"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo13" value="<?php echo $Rs["codigo13"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad14" value="<?php echo $Rs["cant14"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad14" value="<?php echo $Rs["unid14"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion14" value="<?php echo $Rs["desc14"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo14" value="<?php echo $Rs["codigo14"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad15" value="<?php echo $Rs["cant15"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad15" value="<?php echo $Rs["unid15"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion15" value="<?php echo $Rs["desc15"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo15" value="<?php echo $Rs["codigo15"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad16" value="<?php echo $Rs["cant16"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad16" value="<?php echo $Rs["unid16"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion16" value="<?php echo $Rs["desc16"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo16" value="<?php echo $Rs["codigo16"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad17" value="<?php echo $Rs["cant17"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad17" value="<?php echo $Rs["unid17"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion17" value="<?php echo $Rs["desc17"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo17" value="<?php echo $Rs["codigo17"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad18" value="<?php echo $Rs["cant18"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad18" value="<?php echo $Rs["unid18"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion18" value="<?php echo $Rs["desc18"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo18" value="<?php echo $Rs["codigo18"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad19" value="<?php echo $Rs["cant19"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad19" value="<?php echo $Rs["unid19"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion19" value="<?php echo $Rs["desc19"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo19" value="<?php echo $Rs["codigo19"]; ?>">
              </div>
					</div>
          <div class="row form-horizontal">
							<!--Campo Cantidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="cantidad20" value="<?php echo $Rs["cant20"]; ?>">
  							</div>
							<!--Campo Unidad-->
  							<div class="col-xs-2">
    							<input type="text" class="form-control input-sm" name="unidad20" value="<?php echo $Rs["unid20"]; ?>">
  							</div>
							<!--Campo Descripcion-->
  							<div class="col-xs-5">
    						<input type="text" class="form-control input-sm" name="descripcion20" value="<?php echo $Rs["desc20"]; ?>">
  						</div>
              <!--Campo Uso-->
                <div class="col-xs-3">
                <input type="text" class="form-control input-sm" name="codigo20" value="<?php echo $Rs["codigo20"]; ?>">
              </div>
					</div>
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