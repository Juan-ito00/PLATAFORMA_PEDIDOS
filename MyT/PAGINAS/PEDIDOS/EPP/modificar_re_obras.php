<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']) && !isset($_SESSION['user_epp']) && !isset($_SESSION['obra']))
	{
		header('Location: ../../../index');
		exit();
	}
	include("../../../conexion/conexion.php"); 
  $conexion=Conectarse();

  use PHPMailer\PHPMailer\PHPMailer;
  require_once('../../../autoload.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modificar EPP</title>
    <!-- Bootstrap -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
		.rojo {background-color:#FF0000;}
		.azul {color:#0066FF;}
		.verde {color:#009900;}
		select{
			background-color:#FF66FF;
		}

        .blue-distinct {
            color: #104e9d;
        }
	</style>
<script type="text/javascript" src="../../../js/jquery.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation" style="background-color:#31456a;border-color:#31456a;">
 		<p align="center" style="color: white; margin-top: 12px; font-size: 18px;">PEDIDOS EPP</p>
  	</nav>
   	<div class="container" style="padding-top: 1px;">
       <nav class="navbar navbar-default nav" style="margin-top:5px;" role="navigation">
   			<div class="navbar-header">
      			<a class="navbar-brand" href="../inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
    		</div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
      			<ul class="nav navbar-nav">
                  <?php if($_SESSION['usuario'] == 'JESUSV'){ ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Nuevo EPP Vehículos<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="nuevo_re">Reemplazo</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
	                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial EPP Vehículos<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="historial_re_obras">Reemplazo</a></li>
                        </ul>
                    </li>
        			<li class="dropdown">
	                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        <li><a href="historial_re">Reemplazo</a></li>
                        <li><a href="historial_ex">Extraordinario</a></li>
                        <li><a href="historial_tr">Trimestral</a></li>
                        <li><a href="historial_rc">Ropa y Calzado</a></li>
                        </ul>
                    </li>
                    <li class="">
	                    <a href="reportes" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
	                </li>
                    <?php }
                    else{ ?>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b></a>
                          <ul class="dropdown-menu">
                          <li><a href="historial_re">Reemplazo</a></li>
                          <li><a href="historial_ex">Extraordinario</a></li>
                          <li><a href="historial_tr">Trimestral</a></li>
                          <li><a href="historial_rc">Ropa y Calzado</a></li>
                          </ul>
                      </li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial EPP Vehículos<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="historial_re_obras">Reemplazo</a></li>
                            </ul>
                        </li>
                    <li class="">
	                    <a href="reportes" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
	                </li>
                    <?php } ?>
      			</ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
      			</ul>
    		</div>
        </nav>
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Modificar Pedido Reemplazo de EPP</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");

                    if(empty($_POST['otro_epp1'])){$epp1 = $_POST['epp1'];}
                    else{$epp1 = $_POST['otro_epp1'];}
                    if(empty($_POST['otro_epp2'])){$epp2 = $_POST['epp2'];}
                    else{$epp2 = $_POST['otro_epp2'];}
                    if(empty($_POST['otro_epp3'])){$epp3 = $_POST['epp3'];}
                    else{$epp3 = $_POST['otro_epp3'];}
                    if(empty($_POST['otro_epp4'])){$epp4 = $_POST['epp4'];}
                    else{$epp4 = $_POST['otro_epp4'];}
                    if(empty($_POST['otro_epp5'])){$epp5 = $_POST['epp5'];}
                    else{$epp5 = $_POST['otro_epp5'];}
                    if(empty($_POST['otro_epp6'])){$epp6 = $_POST['epp6'];}
                    else{$epp6 = $_POST['otro_epp6'];}
                    
                    $fecha_hoy = new DateTime('now', new DateTimeZone('America/Mazatlan'));
                        $date = $fecha_hoy->format('Y-m-d');
 					if(isset($_POST["submit"])) {
                        $obra= $_POST['obra'];
                        if($obra == "Administrativo"){
                            $fol_ob = "ADM";
                            $correo_residente = "karina_rodriguez@grupocavi.com.mx";
                            $correo_gerob = "maricruz_flores@grupocavi.com.mx";
                        }
                        else if($obra == "Concretos Cavi"){
                            $fol_ob = "CON";
                            $correo_residente = "abelardo_amador@grupocavi.com.mx";
                            $correo_gerob = "antonio_ulloa@grupocavi.com.mx";
                        }
                        else if($obra == "Sucursal MyT Control Vehicular"){
                            $fol_ob = "CVE";
                            $correo_residente = "jesus_valdez@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Herradura"){
                            $fol_ob = "HER";
                            $correo_residente = "crispin_rivera@grupocavi.com.mx";
                            $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Sucursal MyT Maquinaria Pesada"){
                            $fol_ob = "MPE";
                            $correo_residente = "jaime_vela@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Mantenimiento Multifuncional"){
                            $fol_ob = "MTO";
                            $correo_residente = "eric_aldaba@grupocavi.com.mx";
                            $correo_gerob = "carlos_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Sucursal MyT Administración"){
                            $fol_ob = "MYT";
                            $correo_residente = "lorena_mena@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Sucursal MyT Mecánicos Zona Foránea"){
                            $fol_ob = "MZF";
                            $correo_residente = "jesus_valdez@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Proyecto San Julián"){
                            $fol_ob = "PSJ";
                            $correo_residente = "eduardo_gonzalez@grupocavi.com.mx";
                            $correo_gerob = "moises_fernandez@grupocavi.com.mx";
                        }
                        else if($obra == "Reclutamiento"){
                            $fol_ob = "REC";
                            $correo_residente = "";
                            $correo_gerob = "";
                        }
                        else if($obra == "Sabinas"){
                            $fol_ob = "SAB";
                            $correo_residente = "francisco_borjon@grupocavi.com.mx";
                            $correo_gerob = "moises_fernandez@grupocavi.com.mx";
                        }
                        else if($obra == "Saucito"){
                            $fol_ob = "SAU";
                            $correo_residente = "javier_favela@grupocavi.com.mx";
                            $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos"){
                            $fol_ob = "SPP";
                            $correo_residente = "adolfo_flores@grupocavi.com.mx";
                            $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Sucursal MyT Transporte Especial"){
                            $fol_ob = "SPP";
                            $correo_residente = "jaime_vela@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Tocayos Agosto 2019"){
                            $fol_ob = "TOC";
                            $correo_residente = "eric_aldaba@grupocavi.com.mx";
                            $correo_gerob = "carlos_castrejon@grupocavi.com.mx";
                        }
                        else{
                            $fol_ob =$_GET['acronimo'];
                        }
                        $query = "UPDATE epp_re SET motivo='".$_POST["motivo"]."',trabajador='".$_POST["trabajador"]."',
                        fecha_ingreso='".$_POST["fecha_ingreso"]."', categoria='".$_POST["categoria"]."',
                        epp1='".$epp1."', fut_epp1='".$_POST["fut_epp1"]."',talla_epp1='".$_POST["talla_epp1"]."',
                        epp2='".$epp2."', fut_epp2='".$_POST["fut_epp2"]."',talla_epp2='".$_POST["talla_epp2"]."',
                        epp3='".$epp3."', fut_epp3='".$_POST["fut_epp3"]."',talla_epp3='".$_POST["talla_epp3"]."',
                        epp4='".$epp4."', fut_epp4='".$_POST["fut_epp4"]."',talla_epp4='".$_POST["talla_epp4"]."',
                        epp5='".$epp5."', fut_epp5='".$_POST["fut_epp5"]."',talla_epp5='".$_POST["talla_epp5"]."',
                        epp6='".$epp6."', fut_epp6='".$_POST["fut_epp6"]."',talla_epp6='".$_POST["talla_epp6"]."',
                        observaciones_sup='".$_POST["observaciones_sup"]."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_re_obras?id=tw_redireccion';
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
                            $mail->setFrom('soporte@grupocavi.com.mx', 'PEDIDOS DE EPP');
                            $mail->AddAddress('karina_rodriguez@grupocavi.com.mx');
    
                            $mail->WordWrap = 50;
                            $mail->IsHTML(true);
                            $mail->CharSet = 'UTF-8';
                            $mail->Subject = "Sistema de Pedidos de EPP | GRUPO CAVI";
                            $mail->Body = "<h2>|  Nuevo Pedido de EPP Reemplazo|</h2><br><p>Estimado (a) SASST:</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
    
                            if(!$mail->Send())
                            {
                              echo "Fallo";
                            }
				    }
                    else if(isset($_POST["aut1m"])) {
                        $fecha_hoy = new DateTime('now', new DateTimeZone('America/Mazatlan'));
                        $date = $fecha_hoy->format('Y-m-d');
                        
                        $obra= $_POST['obra'];
                        if($obra == "Administrativo"){
                            $fol_ob = "ADM";
                            $correo_residente = "karina_rodriguez@grupocavi.com.mx";
                            $correo_gerob = "maricruz_flores@grupocavi.com.mx";
                        }
                        else if($obra == "Concretos Cavi"){
                            $fol_ob = "CON";
                            $correo_residente = "abelardo_amador@grupocavi.com.mx";
                            $correo_gerob = "antonio_ulloa@grupocavi.com.mx";
                        }
                        else if($obra == "Sucursal MyT Control Vehicular"){
                            $fol_ob = "CVE";
                            $correo_residente = "jesus_valdez@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Herradura"){
                            $fol_ob = "HER";
                            $correo_residente = "crispin_rivera@grupocavi.com.mx";
                            $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Sucursal MyT Maquinaria Pesada"){
                            $fol_ob = "MPE";
                            $correo_residente = "jaime_vela@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Mantenimiento Multifuncional"){
                            $fol_ob = "MTO";
                            $correo_residente = "eric_aldaba@grupocavi.com.mx";
                            $correo_gerob = "carlos_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Sucursal MyT Administración"){
                            $fol_ob = "MYT";
                            $correo_residente = "lorena_mena@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Sucursal MyT Mecánicos Zona Foránea"){
                            $fol_ob = "MZF";
                            $correo_residente = "jesus_valdez@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Proyecto San Julián"){
                            $fol_ob = "PSJ";
                            $correo_residente = "eduardo_gonzalez@grupocavi.com.mx";
                            $correo_gerob = "moises_fernandez@grupocavi.com.mx";
                        }
                        else if($obra == "Reclutamiento"){
                            $fol_ob = "REC";
                            $correo_residente = "";
                            $correo_gerob = "";
                        }
                        else if($obra == "Sabinas"){
                            $fol_ob = "SAB";
                            $correo_residente = "francisco_borjon@grupocavi.com.mx";
                            $correo_gerob = "moises_fernandez@grupocavi.com.mx";
                        }
                        else if($obra == "Saucito"){
                            $fol_ob = "SAU";
                            $correo_residente = "javier_favela@grupocavi.com.mx";
                            $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos"){
                            $fol_ob = "SPP";
                            $correo_residente = "adolfo_flores@grupocavi.com.mx";
                            $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Sucursal MyT Transporte Especial"){
                            $fol_ob = "SPP";
                            $correo_residente = "jaime_vela@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        }
                        else if($obra == "Tocayos Agosto 2019"){
                            $fol_ob = "TOC";
                            $correo_residente = "eric_aldaba@grupocavi.com.mx";
                            $correo_gerob = "carlos_castrejon@grupocavi.com.mx";
                        }
                        else{
                            $fol_ob =$_GET['acronimo'];
                        }
                        $query = "UPDATE epp_re SET autorizado_myt='Autorizado',fecha_autorizado_myt='".$date."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_re_obras?id=tw_redireccion';
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
                            $mail->setFrom('soporte@grupocavi.com.mx', 'PEDIDOS DE EPP');
                            $mail->AddAddress($correo_gerob);
    
                            $mail->WordWrap = 50;
                            $mail->IsHTML(true);
                            $mail->CharSet = 'UTF-8';
                            $mail->Subject = "Sistema de Pedidos de EPP | GRUPO CAVI";
                            $mail->Body = "<h2>|  Nuevo Pedido de EPP Reemplazo|</h2><br><p>Estimado Director de Operaciones:</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
    
                            if(!$mail->Send())
                            {
                              echo "Fallo";
                            }
				    }
                    else if(isset($_POST["aut2m"])) {
                        $fecha_hoy = new DateTime('now', new DateTimeZone('America/Mazatlan'));
                        $date = $fecha_hoy->format('Y-m-d');
                        $query = "UPDATE epp_re SET autorizado_myt='No autorizado',autorizado_gerseg='No autorizado',autorizado_sasst='No autorizado',fecha_autorizado_myt='".$date."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_re_obras?id=tw_redireccion';
                            </script>";
				    }
                    else {
						$id_pedido=$_GET['id_pedido'];
						$sql_query="SELECT * FROM epp_re WHERE id='".$id_pedido."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
                                if($_SESSION['usuario'] == "JESUSV") {
				?>
            			<form method="post" name=frm action="modificar_re_obras" enctype="multipart/form-data">
                            <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?> " >
                            </div>
                            <div class="col-xs-5">
                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol'];?> ">
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Motivo</i></label>
                                <select name='motivo' class='form-control input-sm'>
                                    <option selected ><?php echo $Rs['motivo'];?></option>
                                    <option value="Defecto de Fabricación">Defecto de Fabricación</option>
                                    <option value="Desgaste">Desgaste</option>
                                    <option value="Extravío">Extravío</option>
                                    <option value="Pérdida Accidental">Pérdida Accidental</option>
                                    <option value="Reducción de Talla">Reducción de Talla</option>
                                    <option value="Robo">Robo</option>
                                    <option value="Ruptura">Ruptura</option>
                                </select>
                            </div>
                	    </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-5">
                                <label class="control-label blue-distinct"><i>Nombre del Trabajador</i></label>
                                <input name="trabajador" type="text" class="form-control input-sm" value="<?php echo $Rs['trabajador'];?> ">
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Fecha de Ingreso</i></label>
                                <input name="fecha_ingreso" type="date" class="form-control input-sm" value=<?php echo strftime('%Y-%m-%d',strtotime($Rs["fecha_ingreso"]));?> >
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['obra'];?></option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
                                    <option value="Sucursal MyT Control Vehicular">Sucursal MyT Control Vehicular</option>
                                    <option value="Herradura">Herradura</option>
                                    <option value="Sucursal MyT Maquinaria Pesada">Sucursal MyT Maquinaria Pesada</option>
                                    <option value="Mantenimiento Multifuncional">Mantenimiento Multifuncional</option>
                                    <option value="Sucursal MyT Administración">Sucursal MyT Administración</option>
                                    <option value="Sucursal MyT Mecánicos Zona Foránea">Sucursal MyT Mecánicos Zona Foránea</option>
                                    <option value="Proyecto San Julián">Proyecto San Julián</option>
                                    <option value="Reclutamiento">Reclutamiento</option>
                                    <option value="Sabinas">Sabinas</option>
                                    <option value="Saucito">Saucito</option>
                                    <option value="Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos">Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos</option>
                                    <option value="Sucursal MyT Transporte Especial">Sucursal MyT Transporte Especial</option>
                                    <option value="Tocayos Agosto 2019">Tocayos Agosto 2019</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Categoría</i></label>
                                <input name="categoria" type="text" class="form-control input-sm" value="<?php echo $Rs['categoria'];?> ">
                            </div>
						</div>
                        <br><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp1' class='form-control input-sm' id="epp1" onchange="e1()">
                                    <option selected><?php echo $Rs['epp1'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-2" id="otro1" hidden>
                				<label class="control-label">Otro Equipo</label>
    							<input class="form-control input-sm" type="text" name="otro_epp1">
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp1" value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp1']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp1" value="<?php echo $Rs['talla_epp1'];?> ">
  							</div>
                        </div><br>
            			<div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp2' class='form-control input-sm' id="epp2" onchange="e2()">
                                    <option selected><?php echo $Rs['epp2'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-2" id="otro2" hidden>
                				<label class="control-label">Otro Equipo</label>
    							<input class="form-control input-sm" type="text" name="otro_epp2">
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp2" value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp2']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp2" value="<?php echo $Rs['talla_epp2'];?> ">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp3' class='form-control input-sm' id="epp3" onchange="e3()">
                                    <option selected><?php echo $Rs['epp3'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-2" id="otro3" hidden>
                				<label class="control-label">Otro Equipo</label>
    							<input class="form-control input-sm" type="text" name="otro_epp3">
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp3" value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp3']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp3" value="<?php echo $Rs['talla_epp3'];?> ">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp4' class='form-control input-sm' id="epp4" onchange="e4()">
                                    <option selected><?php echo $Rs['epp4'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-2" id="otro4" hidden>
                				<label class="control-label">Otro Equipo</label>
    							<input class="form-control input-sm" type="text" name="otro_epp4">
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp4" value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp4']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp4" value="<?php echo $Rs['talla_epp4'];?> ">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp5' class='form-control input-sm' id="epp5" onchange="e5()">
                                    <option selected><?php echo $Rs['epp5'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-2" id="otro5" hidden>
                				<label class="control-label">Otro Equipo</label>
    							<input class="form-control input-sm" type="text" name="otro_epp5">
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp5" value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp5']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp5" value="<?php echo $Rs['talla_epp5'];?> ">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp6' class='form-control input-sm' id="epp6" onchange="e6()">
                                    <option selected><?php echo $Rs['epp6'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-2" id="otro6" hidden>
                				<label class="control-label">Otro Equipo</label>
    							<input class="form-control input-sm" type="text" name="otro_epp6">
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp6" value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp6']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp6" value="<?php echo $Rs['talla_epp6'];?> ">
  							</div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Evidencia Fotográfica del Reemplazo</label><br>
                                <img src="evidencia/<?php echo $Rs['foto_ev1'];?>" alt="<?php echo $Rs['foto_ev1'];?>" width="200"/>
                                <img src="evidencia/<?php echo $Rs['foto_ev2'];?>" alt="<?php echo $Rs['foto_ev2'];?>" width="200"/>
                                <img src="evidencia/<?php echo $Rs['foto_ev3'];?>" alt="<?php echo $Rs['foto_ev3'];?>" width="200"/>
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Supervisor</label>
                                <textarea  name="observaciones_sup" class="form-control "><?php echo $Rs['observaciones_sup'];?> </textarea>
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones SASST</label>
                                <textarea  name="observaciones_sasst" class="form-control " readonly><?php echo $Rs['observaciones_sasst'];?> </textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Gerencia de Seguridad</label>
                                <textarea  name="observaciones_gerseg" class="form-control " readonly><?php echo $Rs['observaciones_gerseg'];?> </textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Director de Operaciones</label>
                                <textarea  name="observaciones_gerob" class="form-control " readonly><?php echo $Rs['observaciones_gerob'];?> </textarea>
                            </div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-5">
                            </div>
                            <div id="btn-form"  class="col-xs-2">
                            <input class="btn form-btn btn-primary" type="submit" name="submit" value="Modificar Pedido">
                            </div>
                        </div>
        			</form>
                    <?php
                                }
                                if($_SESSION['usuario'] == "MyT") { ?>

                                <form method="post" name=frm action="modificar_re_obras" enctype="multipart/form-data">
                            <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?> " >
                            </div>
                            <div class="col-xs-5">
                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol'];?> ">
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Motivo</i></label>
                                <select name='motivo' class='form-control input-sm' readonly>
                                    <option selected ><?php echo $Rs['motivo'];?></option>
                                    <option value="Defecto de Fabricación">Defecto de Fabricación</option>
                                    <option value="Desgaste">Desgaste</option>
                                    <option value="Extravío">Extravío</option>
                                    <option value="Pérdida Accidental">Pérdida Accidental</option>
                                    <option value="Reducción de Talla">Reducción de Talla</option>
                                    <option value="Robo">Robo</option>
                                    <option value="Ruptura">Ruptura</option>
                                </select>
                            </div>
                	    </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-5">
                                <label class="control-label blue-distinct"><i>Nombre del Trabajador</i></label>
                                <input name="trabajador" type="text" class="form-control input-sm" value="<?php echo $Rs['trabajador'];?>"readonly>
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Fecha de Ingreso</i></label>
                                <input name="fecha_ingreso" type="date" readonly class="form-control input-sm" value=<?php echo strftime('%Y-%m-%d',strtotime($Rs["fecha_ingreso"]));?> >
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obral' class='form-control input-sm' readonly>
                                    <option selected><?php echo $Rs['obra'];?></option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
                                    <option value="Sucursal MyT Control Vehicular">Sucursal MyT Control Vehicular</option>
                                    <option value="Herradura">Herradura</option>
                                    <option value="Sucursal MyT Maquinaria Pesada">Sucursal MyT Maquinaria Pesada</option>
                                    <option value="Mantenimiento Multifuncional">Mantenimiento Multifuncional</option>
                                    <option value="Sucursal MyT Administración">Sucursal MyT Administración</option>
                                    <option value="Sucursal MyT Mecánicos Zona Foránea">Sucursal MyT Mecánicos Zona Foránea</option>
                                    <option value="Proyecto San Julián">Proyecto San Julián</option>
                                    <option value="Reclutamiento">Reclutamiento</option>
                                    <option value="Sabinas">Sabinas</option>
                                    <option value="Saucito">Saucito</option>
                                    <option value="Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos">Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos</option>
                                    <option value="Sucursal MyT Transporte Especial">Sucursal MyT Transporte Especial</option>
                                    <option value="Tocayos Agosto 2019">Tocayos Agosto 2019</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Categoría</i></label>
                                <input name="categoria" type="text" class="form-control input-sm" value="<?php echo $Rs['categoria'];?> "readonly>
                            </div>
						</div>
                        <br><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp1' class='form-control input-sm' id="epp1" onchange="e1()" readonly>
                                    <option selected><?php echo $Rs['epp1'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp1" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp1']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp1" readonly value="<?php echo $Rs['talla_epp1'];?> ">
  							</div>
                        </div><br>
            			<div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
  							<div class="col-xs-2" style="text-align:center;">
                              <label class="control-label">Equipo</label>
                                    <select name='epp2' class='form-control input-sm' id="epp2" onchange="e2()" readonly>
                                    <option selected><?php echo $Rs['epp2'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp2" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp2']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp2" readonly value="<?php echo $Rs['talla_epp2'];?> ">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp3' class='form-control input-sm' id="epp3" onchange="e3()" readonly>
                                    <option selected><?php echo $Rs['epp3'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp3" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp3']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp3" readonly value="<?php echo $Rs['talla_epp3'];?> ">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp4' class='form-control input-sm' id="epp4" onchange="e4()" readonly>
                                    <option selected><?php echo $Rs['epp4'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp4" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp4']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp4" readonly value="<?php echo $Rs['talla_epp4'];?> ">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp5' class='form-control input-sm' id="epp5" onchange="e5()" readonly>
                                    <option selected><?php echo $Rs['epp5'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp5" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp5']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp5" readonly value="<?php echo $Rs['talla_epp5'];?> ">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
  							<div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp6' class='form-control input-sm' id="epp6" onchange="e6()" readonly>
                                    <option selected><?php echo $Rs['epp6'];?></option>
                                    <option value="Bota">Bota</option>
                                    <option value="Camisa">Camisa</option>
                                    <option value="Casco">Casco</option>
                                    <option value="Chaleco">Chaleco</option>
                                    <option value="Overol">Overol</option>
                                    <option value="Pantalón">Pantalón</option>
                                    <option value="Zapato">Zapato</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
  							</div>
                            <div class="col-xs-3">
                                <label class="control-label">Fecha de Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp6" readonly value=<?php echo strftime('%Y-%m-%d',strtotime($Rs['fut_epp6']));?> >
                            </div>
  							<div class="col-xs-3">
                				<label class="control-label">Talla Solicitada</label>
    							<input class="form-control input-sm" type="text" name="talla_epp6" readonly value="<?php echo $Rs['talla_epp6'];?> ">
  							</div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Evidencia Fotográfica del Reemplazo</label><br>
                                <img src="../../../../GSST/PAGINAS/PEDIDOS/EPP/evidencia/<?php echo $Rs['foto_ev1'];?>" alt="<?php echo $Rs['foto_ev1'];?>" width="200"/>
                                <img src="../../../../GSST/PAGINAS/PEDIDOS/EPP/evidencia/<?php echo $Rs['foto_ev2'];?>" alt="<?php echo $Rs['foto_ev2'];?>" width="200"/>
                                <img src="../../../../GSST/PAGINAS/PEDIDOS/EPP/evidencia/<?php echo $Rs['foto_ev3'];?>" alt="<?php echo $Rs['foto_ev3'];?>" width="200"/>
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Supervisor</label>
                                <textarea  name="observaciones_sup" class="form-control " readonly><?php echo $Rs['observaciones_sup'];?> </textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones SASST</label>
                                <textarea  readonly name="observaciones_sasst" class="form-control "><?php echo $Rs['observaciones_sasst'];?> </textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Gerencia de Seguridad</label>
                                <textarea  name="observaciones_gerseg" class="form-control " readonly><?php echo $Rs['observaciones_gerseg'];?> </textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Director de Operaciones</label>
                                <textarea  name="observaciones_gerob" class="form-control " readonly><?php echo $Rs['observaciones_gerob'];?> </textarea>
                            </div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-2">
                                <input class="btn form-btn btn-success" type="submit" name="aut1m" value="Autorizar">
                            </div>
                            <div class="col-xs-2">
                                <input class="btn form-btn btn-danger" type="submit" name="aut2m" value="No autorizar">
                            </div>
                        </div>
        			</form>
                            <?php }	
                            
							}
						}
                        else{
							echo "<script languaje='javascript'>
									alert('No fue posible realizar la operacion solicitada al pedido con ID".$id_pedido."')
							javascript:history.go(-1)
  									</script>";
						}				
					}
					mysql_close($conexion);
					?>
               </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script>
        function e1(){
            let ep1 = document.getElementById("epp1").value;
            if(ep1 == "OTROS"){
                document.getElementById("otro1").hidden=false;
            }
            else{document.getElementById("otro1").hidden=true;}
        }
        function e2(){
            let ep2 = document.getElementById("epp2").value;
            if(ep2 == "OTROS"){
                document.getElementById("otro2").hidden=false;
            }
            else{document.getElementById("otro2").hidden=true;}
        }
        function e3(){
            let ep3 = document.getElementById("epp3").value;
            if(ep3 == "OTROS"){
                document.getElementById("otro3").hidden=false;
            }
            else{document.getElementById("otro3").hidden=true;}
        }
        function e4(){
            let ep4 = document.getElementById("epp4").value;
            if(ep4 == "OTROS"){
                document.getElementById("otro4").hidden=false;
            }
            else{document.getElementById("otro4").hidden=true;}
        }
        function e5(){
            let ep5 = document.getElementById("epp5").value;
            if(ep5 == "OTROS"){
                document.getElementById("otro5").hidden=false;
            }
            else{document.getElementById("otro5").hidden=true;}
        }
        function e6(){
            let ep6 = document.getElementById("epp6").value;
            if(ep6 == "OTROS"){
                document.getElementById("otro6").hidden=false;
            }
            else{document.getElementById("otro6").hidden=true;}
        }
    </script>
  </body>
</html>