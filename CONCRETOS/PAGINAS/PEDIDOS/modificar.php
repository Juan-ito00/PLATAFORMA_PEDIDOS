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
              $query = "UPDATE pedidos SET empresa='".$_POST["empresa"]."',cancelar='".$_POST["cancelar"]."',folio='".$_POST["folio"]."', ".
    "proyecto='".$_POST["proyecto"]."', supervisor='".$_POST["supervisor"]."',tipo_compra='".$_POST["tipo_compra"]."', "."ubicacion='".$_POST["ubicacion"]."',"."cant1='".$_POST["cantidad"]."',"."unid1='".$_POST["unidad"]."',"."desc1='".$_POST["descripcion"]."',"."uso1='".$_POST["uso"]."',"."cant2='".$_POST["cantidad2"]."',"."unid2='".$_POST["unidad2"]."',"."desc2='".$_POST["descripcion2"]."',"."uso2='".$_POST["uso2"]."',"."cant3='".$_POST["cantidad3"]."',"."unid3='".$_POST["unidad3"]."',"."desc3='".$_POST["descripcion3"]."',"."uso3='".$_POST["uso3"]."',"."cant4='".$_POST["cantidad4"]."',"."unid4='".$_POST["unidad4"]."',"."desc4='".$_POST["descripcion4"]."',"."uso4='".$_POST["uso4"]."',"."cant5='".$_POST["cantidad5"]."',"."unid5='".$_POST["unidad5"]."',"."desc5='".$_POST["descripcion5"]."',"."uso5='".$_POST["uso5"]."',"."cant6='".$_POST["cantidad6"]."',"."unid6='".$_POST["unidad6"]."',"."desc6='".$_POST["descripcion6"]."',"."uso6='".$_POST["uso6"]."',"."cant7='".$_POST["cantidad7"]."',"."unid7='".$_POST["unidad7"]."',"."desc7='".$_POST["descripcion7"]."',"."uso7='".$_POST["uso7"]."',"."cant8='".$_POST["cantidad8"]."',"."unid8='".$_POST["unidad8"]."',"."desc8='".$_POST["descripcion8"]."',"."uso8='".$_POST["uso8"]."',"."cant9='".$_POST["cantidad9"]."',"."unid9='".$_POST["unidad9"]."',"."desc9='".$_POST["descripcion9"]."',"."uso9='".$_POST["uso9"]."',"."cant10='".$_POST["cantidad10"]."',"."unid10='".$_POST["unidad10"]."',"."desc10='".$_POST["descripcion10"]."',"."uso10='".$_POST["uso10"]."',"."cant11='".$_POST["cantidad11"]."',"."unid11='".$_POST["unidad11"]."',"."desc11='".$_POST["descripcion11"]."',"."uso11='".$_POST["uso11"]."',"."cant12='".$_POST["cantidad12"]."',"."unid12='".$_POST["unidad12"]."',"."desc12='".$_POST["descripcion12"]."',"."uso12='".$_POST["uso12"]."',"."cant13='".$_POST["cantidad13"]."',"."unid13='".$_POST["unidad13"]."',"."desc13='".$_POST["descripcion13"]."',"."uso13='".$_POST["uso13"]."',"."cant14='".$_POST["cantidad14"]."',"."unid14='".$_POST["unidad14"]."',"."desc14='".$_POST["descripcion14"]."',"."uso14='".$_POST["uso14"]."',"."cant15='".$_POST["cantidad15"]."',"."unid15='".$_POST["unidad15"]."',"."desc15='".$_POST["descripcion15"]."',"."uso15='".$_POST["uso15"]."',"."cant16='".$_POST["cantidad16"]."',"."unid16='".$_POST["unidad16"]."',"."desc16='".$_POST["descripcion16"]."',"."uso16='".$_POST["uso16"]."',"."cant17='".$_POST["cantidad17"]."',"."unid17='".$_POST["unidad17"]."',"."desc17='".$_POST["descripcion17"]."',"."uso17='".$_POST["uso17"]."',"."cant18='".$_POST["cantidad18"]."',"."unid18='".$_POST["unidad18"]."',"."desc18='".$_POST["descripcion18"]."',"."uso18='".$_POST["uso18"]."',"."cant19='".$_POST["cantidad19"]."',"."unid19='".$_POST["unidad19"]."',"."desc19='".$_POST["descripcion19"]."',"."uso19='".$_POST["uso19"]."',"."cant20='".$_POST["cantidad20"]."',"."unid20='".$_POST["unidad20"]."',"."desc20='".$_POST["descripcion20"]."',"."uso20='".$_POST["uso20"]."',"."cant21='".$_POST["cantidad21"]."',"."unid21='".$_POST["unidad21"]."',"."desc21='".$_POST["descripcion21"]."',"."uso21='".$_POST["uso21"]."',"."cant22='".$_POST["cantidad22"]."',"."unid22='".$_POST["unidad22"]."',"."desc22='".$_POST["descripcion22"]."',"."uso22='".$_POST["uso22"]."',"."cant23='".$_POST["cantidad23"]."',"."unid23='".$_POST["unidad23"]."',"."desc23='".$_POST["descripcion23"]."',"."uso23='".$_POST["uso23"]."',"."cant24='".$_POST["cantidad24"]."',"."unid24='".$_POST["unidad24"]."',"."desc24='".$_POST["descripcion24"]."',"."uso24='".$_POST["uso24"]."',"."cant25='".$_POST["cantidad25"]."',"."unid25='".$_POST["unidad25"]."',"."desc25='".$_POST["descripcion25"]."',"."uso25='".$_POST["uso25"]."',"."cant26='".$_POST["cantidad26"]."',"."unid26='".$_POST["unidad26"]."',"."desc26='".$_POST["descripcion26"]."',"."uso26='".$_POST["uso26"]."',"."cant27='".$_POST["cantidad27"]."',"."unid27='".$_POST["unidad27"]."',"."desc27='".$_POST["descripcion27"]."',"."uso27='".$_POST["uso27"]."',"."cant28='".$_POST["cantidad28"]."',"."unid28='".$_POST["unidad28"]."',"."desc28='".$_POST["descripcion28"]."',"."uso28='".$_POST["uso28"]."',"."cant29='".$_POST["cantidad29"]."',"."unid29='".$_POST["unidad29"]."',"."desc29='".$_POST["descripcion29"]."',"."uso29='".$_POST["uso29"]."',"."cant30='".$_POST["cantidad30"]."',"."unid30='".$_POST["unidad30"]."',"."desc30='".$_POST["descripcion30"]."',"."uso30='".$_POST["uso30"]."',"."autorizado='Pendiente',"."notas_seguimiento='".$_POST["notas_seguimiento"]."' WHERE id_pedido='".$_POST["id"]."' AND gerencia='CONCRETOS' AND supervisor='".$_SESSION['nombre']."'";
            $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
          
            echo "<script languaje='javascript'>
                    alert('Se han modificado los datos del pedido con folio ".$_POST["folio"]."')
        location.href='historial_gen?id=tw_redireccion';
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

            $nom_gerente = "Antonio Alberto";
            $supervisor = $_POST['supervisor'];
              $mailto = "antonio_ulloa@grupocavi.com.mx";
                     
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
						$sql_query="SELECT * FROM pedidos WHERE id_pedido='".$id_pedido."' AND gerencia='CONCRETOS'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
				?>
            					<form method="post" name=frm action="modificar">
         				<div class="row form-horizontal">
                        	
							       <!--Tipo de Compra-->
                      <div class="col-xs-2">
                        <label class="control-label" for="tipo_compra">Tipo de Compra</label>
                        <select name="tipo_compra" class="form-control input-sm " id="">
                                <option class="form-control input-sm" id="" name=uno><?php echo $Rs['tipo_compra']; ?></option>
                                <option value="Almacén" class="form-control input-sm" >Almacén</option>
                                <option value="General" class="form-control input-sm">General</option>
                                <option value="Papelería" class="form-control input-sm" >Papelería</option>
                                <option value="Productos" class="form-control input-sm" >Productos de Limpieza</option>
                      </div>
                      <!--Campo Área-->
                      <div class="col-xs-2">
                        <label class="control-label"></label></div>
                    <div class="col-xs-4">
                      <label class="control-label" for="supervisor">Supervisor</label>
                        <input class="form-control input-sm" readonly name="supervisor" type="text" required value="<?php echo $Rs['supervisor']; ?>" size="50" />
                    </div>
                    <div class="col-xs-2">
                    <label class="control-label" for="fecha">Fecha</label>
                        <input class="form-control input-sm" name="fecha" type="date" readonly value="<?php echo $Rs['fecha']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <label class="control-label" for="folio">Folio</label>
                          <input name="folio" readonly type="text" class="form-control input-sm" required value="<?php echo $Rs['folio']; ?>" size="17" />
                  </div>
                  <div class="col-xs-2">
                              <input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id_pedido']; ?>" size="17" />
                  </div>
                        </div>
                        <div class="row form-horizontal">
                          <div class="col-xs-4">
                              <label class="control-label" for="folio">Empresa</label>
                                <select name="empresa" class="form-control input-sm">
                                  <option class="form-control input-sm"><?php  echo $Rs['empresa']; ?></option>
                            <option class="form-control input-sm" name=uno value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
                  <option class="form-control input-sm" name=dos value="CAVI DE SOMBRERETE">CAVI DE SOMBRERETE</option>
                  <option class="form-control input-sm" name=tres value="CONCRETOS CAVI S.A. de C.V.">CONCRETOS CAVI S.A. de C.V.</option>
                  <option class="form-control input-sm" name=tres value="RENTA DE MAQUINARIA Y TRANSPORTE GRUPO CAVI">RENTA DE MAQUINARIA Y TRANSPORTE GRUPO CAVI</option>
                          </select>
                    </div>
                    <div class="col-xs-4">
                    <label class="control-label" for="ubicacion">Ubicación</label>
                        <input class="form-control input-sm" name="ubicacion" type="text" value="<?php echo $Rs['ubicacion']; ?>"  size="17" />
                    </div>
                        
                        	<div class="col-xs-4">
            					<label class="control-label" for="proyecto">Proyecto</label>
                            	<?php
					 				mysql_query("SET NAMES 'UTF8'");
									$consulta_mysql='select * from obras ORDER BY nombre ASC';
									$resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
									echo "<select name='proyecto' class='form-control input-sm'>";
									echo "<option> {$Rs['proyecto']}</option>";
									while($fila=mysql_fetch_array($resultado_consulta_mysql)){
    									echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
									}
									echo "</select>";
								?>
                			</div>
                      </div>
          				<div class="row form-horizontal">
  							<div class="col-xs-2">
          						<label class="control-label" for="cantidad">Cantidad</label>
                				<input name="cantidad" class="form-control input-sm" type="text" value="<?php echo $Rs['cant1']; ?>"  size="15"  />
          					</div>
          					<div class="col-xs-2">
          						<label class="control-label" for="unidad">Unidad</label>
            					<input name="unidad" class="form-control input-sm" type="text" value="<?php echo $Rs['unid1']; ?>"  size="15"  />
          					</div>
          					<div class="col-xs-4">
          						<label class="control-label" for="descripcion">Descripción</label>
           						<input name="descripcion" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc1']); ?>"  size="87"  />
          					</div>
                    <div class="col-xs-4">
                      <label class="control-label" for="uso">Uso</label>
                      <input name="uso" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso1']); ?>"  size="87"  />
                    </div>
          				</div>
                        <div class="row form-horizontal">
  							<div class="col-xs-2">
          						<input name="cantidad2" class="form-control input-sm" type="text" value="<?php echo $Rs['cant2']; ?>" size="15" />
          					</div>
                            <div class="col-xs-2">
          						<input name="unidad2" class="form-control input-sm" type="text" value="<?php echo $Rs['unid2']; ?>" size="15" />
          					</div>
                            <div class="col-xs-4">
          						<input name="descripcion2" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc2']); ?>" size="87" />
          					</div>
                    <div class="col-xs-4">
                      <input name="uso2" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso2']); ?>" size="87" />
                    </div>
          				</div>
          				<div class="row form-horizontal">
  							<div class="col-xs-2">
          						<input name="cantidad3" type="text" class="form-control input-sm" value="<?php echo $Rs['cant3']; ?>" size="15" />
          					</div>
         					<div class="col-xs-2">
          						<input name="unidad3" type="text" class="form-control input-sm" value="<?php echo $Rs['unid3']; ?>" size="15" />	
          					</div>
          					<div class="col-xs-4">
          						<input name="descripcion3" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['desc3']); ?>" size="87" />
          					</div>
                    <div class="col-xs-4">
                      <input name="uso3" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso3']); ?>" size="87" />
                    </div>
          				</div>
          				<div class="row form-horizontal">
  							<div class="col-xs-2">
          						<input name="cantidad4" type="text" class="form-control input-sm" value="<?php echo $Rs['cant4']; ?>" size="15" />
          					</div>
							<div class="col-xs-2">
								<input name="unidad4" type="text" class="form-control input-sm" value="<?php echo $Rs['unid4']; ?>" size="15" />
          					</div>
                            <div class="col-xs-4">
          						<input name="descripcion4" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['desc4']); ?>" size="87" />
          					</div>
                    <div class="col-xs-4">
                      <input name="uso4" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso4']); ?>" size="87" />
                    </div>
                       </div>
                        <div class="row form-horizontal">
  							<div class="col-xs-2">
          						<input name="cantidad5" type="text" class="form-control input-sm" value="<?php echo $Rs['cant5']; ?>" size="15" />
          					</div>
                            <div class="col-xs-2">
          						<input name="unidad5" type="text" class="form-control input-sm" value="<?php echo $Rs['unid5']; ?>" size="15" />
          					</div>
                            <div class="col-xs-4">
								<input name="descripcion5" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc5']); ?>" size="87" />
          					</div>
                    <div class="col-xs-4">
                      <input name="uso5" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso5']); ?>" size="87" />
                    </div>
          				</div>
          				<div class="row form-horizontal">
  							<div class="col-xs-2">
          						<input name="cantidad6" class="form-control input-sm" type="text" value="<?php echo $Rs['cant6']; ?>" size="15" />
          					</div>
          					<div class="col-xs-2">
								<input name="unidad6" class="form-control input-sm" type="text" value="<?php echo $Rs['unid6']; ?>" size="15" />
          					</div>
                            <div class="col-xs-4">
								<input name="descripcion6" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc6']); ?>" size="87" />
          					</div>
                    <div class="col-xs-4">
                      <input name="uso6" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso6']); ?>" size="87" />
                    </div>
          				</div>
          				<div class="row form-horizontal">
  							<div class="col-xs-2">
          						<input name="cantidad7" class="form-control input-sm" type="text" value="<?php echo $Rs['cant7']; ?>" size="15" />
          					</div>
          					<div class="col-xs-2">
          						<input name="unidad7" class="form-control input-sm" type="text" value="<?php echo $Rs['unid7']; ?>" size="15" />
          					</div>
                            <div class="col-xs-4">
          						<input name="descripcion7" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc7']); ?>" size="87" />
          					</div>
                    <div class="col-xs-4">
                      <input name="uso7" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso7']); ?>" size="87" />
                    </div>
          				</div>
          				<div class="row form-horizontal">
  							<div class="col-xs-2">
          						<input name="cantidad8" class="form-control input-sm" type="text" value="<?php echo $Rs['cant8']; ?>" size="15" />
          					</div>
          					<div class="col-xs-2">
								<input name="unidad8" class="form-control input-sm" type="text" value="<?php echo $Rs['unid8']; ?>" size="15" />
          					</div>
                            <div class="col-xs-4">
          						<input name="descripcion8" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc8']); ?>" size="87" />
          					</div>
                    <div class="col-xs-4">
                      <input name="uso8" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso8']); ?>" size="87" />
                    </div>
          				</div>
                        <div class="row form-horizontal">
  							<div class="col-xs-2">
          						<input name="cantidad9" class="form-control input-sm" type="text" value="<?php echo $Rs['cant9']; ?>" size="15" />
          					</div>
          					<div class="col-xs-2">
          						<input name="unidad9" class="form-control input-sm" type="text" value="<?php echo $Rs['unid9']; ?>" size="15" />
          					</div>
                            <div class="col-xs-4">
          						<input name="descripcion9" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc9']); ?>" size="87" />
          					</div>
                    <div class="col-xs-4">
                      <input name="uso9" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso9']); ?>" size="87" />
                    </div>
          				</div>
                        <div class="row form-horizontal">
  							<div class="col-xs-2">
          						<input name="cantidad10" class="form-control input-sm" type="text" value="<?php echo $Rs['cant10']; ?>" size="15" />
          					</div>
          					<div class="col-xs-2">
          						<input name="unidad10" class="form-control input-sm" type="text" value="<?php echo $Rs['unid10']; ?>" size="15" />
          					</div>
                            <div class="col-xs-4">
								<input name="descripcion10" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc10']); ?>" size="87" />
          					</div>
                    <div class="col-xs-4">
                      <input name="uso10" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso10']); ?>" size="87" />
                    </div>
          				</div>
          				<div class="row form-horizontal">
  							<div class="col-xs-2">
          						<input name="cantidad11" class="form-control input-sm" type="text" value="<?php echo $Rs['cant11']; ?>" size="15" />
          					</div>
          					<div class="col-xs-2">
          						<input name="unidad11" class="form-control input-sm" type="text" value="<?php echo $Rs['unid11']; ?>" size="15" />
          					</div>
                            <div class="col-xs-4">
          						<input name="descripcion11" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc11']); ?>" size="87" />
          					</div>
                    <div class="col-xs-4">
                      <input name="uso11" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso11']); ?>" size="87" />
                    </div>
          				</div>
          				<div class="row form-horizontal">
  							<div class="col-xs-2">
          						<input name="cantidad12" class="form-control input-sm" type="text" value="<?php echo $Rs['cant12']; ?>" size="15" />
          					</div>
          					<div class="col-xs-2">
          						<input name="unidad12" class="form-control input-sm" type="text" value="<?php echo $Rs['unid12']; ?>" size="15" />
          					</div>
                            <div class="col-xs-4">
          						<input name="descripcion12" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc12']); ?>" size="87" />
          					</div>
                    <div class="col-xs-4">
                      <input name="uso12" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso12']); ?>" size="87" />
                    </div>
          				</div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad13" class="form-control input-sm" type="text" value="<?php echo $Rs['cant13']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad13" class="form-control input-sm" type="text" value="<?php echo $Rs['unid13']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion13" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc13']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso13" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso13']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad14" class="form-control input-sm" type="text" value="<?php echo $Rs['cant14']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad14" class="form-control input-sm" type="text" value="<?php echo $Rs['unid14']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion14" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc14']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso14" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso14']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad15" class="form-control input-sm" type="text" value="<?php echo $Rs['cant15']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad15" class="form-control input-sm" type="text" value="<?php echo $Rs['unid15']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion15" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc15']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso15" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso15']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad16" class="form-control input-sm" type="text" value="<?php echo $Rs['cant16']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad16" class="form-control input-sm" type="text" value="<?php echo $Rs['unid16']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion16" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc16']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso16" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso16']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad17" class="form-control input-sm" type="text" value="<?php echo $Rs['cant17']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad17" class="form-control input-sm" type="text" value="<?php echo $Rs['unid17']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion17" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc17']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso17" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso17']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad18" class="form-control input-sm" type="text" value="<?php echo $Rs['cant18']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad18" class="form-control input-sm" type="text" value="<?php echo $Rs['unid18']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion18" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc18']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso18" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso18']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad19" class="form-control input-sm" type="text" value="<?php echo $Rs['cant19']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad19" class="form-control input-sm" type="text" value="<?php echo $Rs['unid19']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion19" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc19']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso19" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso19']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad20" class="form-control input-sm" type="text" value="<?php echo $Rs['cant20']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad20" class="form-control input-sm" type="text" value="<?php echo $Rs['unid20']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion20" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc20']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso20" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso20']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad21" class="form-control input-sm" type="text" value="<?php echo $Rs['cant21']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad21" class="form-control input-sm" type="text" value="<?php echo $Rs['unid21']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion21" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc21']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso21" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso21']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad22" class="form-control input-sm" type="text" value="<?php echo $Rs['cant22']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad22" class="form-control input-sm" type="text" value="<?php echo $Rs['unid22']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion22" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc22']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso22" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso22']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad23" class="form-control input-sm" type="text" value="<?php echo $Rs['cant23']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad23" class="form-control input-sm" type="text" value="<?php echo $Rs['unid23']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion23" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc23']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso23" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso23']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad24" class="form-control input-sm" type="text" value="<?php echo $Rs['cant24']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad24" class="form-control input-sm" type="text" value="<?php echo $Rs['unid24']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion24" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc24']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso24" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso24']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad25" class="form-control input-sm" type="text" value="<?php echo $Rs['cant25']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad25" class="form-control input-sm" type="text" value="<?php echo $Rs['unid25']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion25" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc25']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso25" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso25']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad26" class="form-control input-sm" type="text" value="<?php echo $Rs['cant26']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad26" class="form-control input-sm" type="text" value="<?php echo $Rs['unid26']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion26" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc26']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso26" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso26']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad27" class="form-control input-sm" type="text" value="<?php echo $Rs['cant27']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad27" class="form-control input-sm" type="text" value="<?php echo $Rs['unid27']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion27" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc27']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso27" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso27']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad28" class="form-control input-sm" type="text" value="<?php echo $Rs['cant28']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad28" class="form-control input-sm" type="text" value="<?php echo $Rs['unid28']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion28" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc28']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso28" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso28']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad29" class="form-control input-sm" type="text" value="<?php echo $Rs['cant29']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad29" class="form-control input-sm" type="text" value="<?php echo $Rs['unid29']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion29" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc29']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso29" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso29']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad30" class="form-control input-sm" type="text" value="<?php echo $Rs['cant30']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad30" class="form-control input-sm" type="text" value="<?php echo $Rs['unid30']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion30" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['desc30']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso30" class="form-control input-sm" type="text" value="<?php echo htmlspecialchars($Rs['uso30']); ?>" size="87" />
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