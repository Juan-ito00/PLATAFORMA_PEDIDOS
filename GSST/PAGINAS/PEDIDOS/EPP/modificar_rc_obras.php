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
                  <?php if($_SESSION['user_epp'] == 'sasst'){ ?>
        			<li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial SASST<b class="caret"></b>
	          			</a>
                        <ul class="dropdown-menu">
                            <li><a href="historial_re">Reemplazo</a></li>
                            <li><a href="historial_ex">Extraordinario</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial ADM<b class="caret"></b>
	          			</a>
                        <ul class="dropdown-menu">
                            <li><a href="historial_re_obras">Reemplazo</a></li>
                            <li><a href="historial_ex_obras">Extraordinario</a></li>
                            <li><a href="historial_tr_obras">Trimestral</a></li>
                            <li><a href="historial_rc_obras">Ropa y Calzado</a></li>
                        </ul>
                    </li>
                    <li class="">
	                    <a href="reportes" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
	                </li>
                    <?php }
                    else if($_SESSION['user_epp'] == 'alm'){ ?>
                    <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
	          			</a>
                      <ul class="dropdown-menu">
                            <li><a href="historial_tr">Trimestral</a></li>
                            <li><a href="historial_rc">Ropa y Calzado</a></li>
                            <li><a href="historial_ni">Nuevo Ingreso</a></li>
                      </ul>
                    </li>
                    <li class="">
	                    <a href="reportes" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
	                </li><?php }
                    else { ?>
                    <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
	          			</a>
	          			<ul class="dropdown-menu">
                            <li><a href="historial_re">Reemplazo</a></li>
                            <li><a href="historial_ex">Extraordinario</a></li>
                            <li><a href="historial_tr">Trimestral</a></li>
                            <li><a href="historial_rc">Ropa y Calzado</a></li>
                            <li><a href="historial_ni">Nuevo Ingreso</a></li>
	          			</ul>
	                </li>
                    <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial ADM<b class="caret"></b>
	          			</a>
                        <ul class="dropdown-menu">
                            <li><a href="historial_re_obras">Reemplazo</a></li>
                            <li><a href="historial_ex_obras">Extraordinario</a></li>
                            <li><a href="historial_tr_obras">Trimestral</a></li>
                            <li><a href="historial_rc_obras">Ropa y Calzado</a></li>
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
        	<div align="center" class="panel-heading">Modificar Pedido Ropa y Calzado de EPP</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
                    $currentdate = new DateTime('now', new DateTimeZone('America/Mazatlan'));

                    $date = $currentdate->format('Y-m-d');
                    $time = $currentdate->format('H:i:s');
                    $dayOfWeek = date("l", strtotime($date));

                    $splitDate = explode('-', $date);
                    $d = $splitDate[2];
                    $m = $splitDate[1];
                    $a = $splitDate[0];

                    $splitTime = explode(':', $time);
                    $H = $splitTime[0];
                    $i = $splitTime[1];
                    $s = $splitTime[2];
                    $fecha_hoy = date('Y-m-d');
                    if(isset($_POST["aut1go"])) {
                        $fecha_hoy = new DateTime('now', new DateTimeZone('America/Mazatlan'));
                        $date = $fecha_hoy->format('Y-m-d');
                        if ($d<= '27') 
                        {
                            $query = "UPDATE epp_rc SET autorizado_gerob='Autorizado',logistica='Recibido para Abastecimiento',fecha='".$date."',observaciones_gerob='".$_POST["observaciones_gerob"]."',fecha_autorizado_gerob='".$date."' WHERE folio ='".$_POST["folio"]."'";
                            $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                        
                            echo "<script languaje='javascript'>
                                    alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                        location.href='historial_rc_obras?id=tw_redireccion';
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
                                $correo_alm = "luis_segovia@grupocavi.com.mx";
                                $mail->AddAddress($correo_alm);
                                $mail->addCC('airam_ramirez@grupocavi.com.mx');
                                $foliop = $_POST['folio'];
        
                                $mail->WordWrap = 50;
                                $mail->IsHTML(true);
                                $mail->CharSet = 'UTF-8';
                                $mail->Subject = "Sistema de Pedidos de EPP | GRUPO CAVI";
                                $mail->Body = "<h2>|  Pedido de EPP Ropa y Calzado Completo|</h2><br><p>Estimado (a) encargado de Almacén:</p><p>Te informamos que el pedido ".$foliop." ya fue completado.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                    Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
        
                                if(!$mail->Send())
                                {
                                echo "Fallo";
                                }
                            }
                            else {
                              echo "<script languaje='javascript'>
                                  alert('No puede autorizar pedidos fuera de fecha.')
                      location.href='historial_tr?id=tw_redireccion';
                              </script>";
                            }
				    }
                    else if(isset($_POST["aut2go"])) {
                        $query = "UPDATE epp_rc SET autorizado_gerob='No autorizado',autorizado_gerseg='No autorizado',autorizado_almacen='No autorizado',autorizado_residente='No autorizado',observaciones_gerob='".$_POST["observaciones_gerob"]."',fecha_autorizado_gerob='".$fecha_hoy."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_rc_obras?id=tw_redireccion';
                            </script>";
				    }
                    else if(isset($_POST["aut1r"])) {
                        if ($d<= '27') 
                        {
                            $query = "UPDATE epp_rc SET autorizado_residente='Autorizado',observaciones_res='".$_POST["observaciones_res"]."',fecha_autorizado_residente='".$fecha_hoy."' WHERE folio ='".$_POST["folio"]."'";
                            $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                        
                            echo "<script languaje='javascript'>
                                    alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                        location.href='historial_rc_obras?id=tw_redireccion';
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
                                $correo_alm = "miguel_segovia@grupocavi.com.mx";
                                $mail->AddAddress($correo_alm);
        
                                $mail->WordWrap = 50;
                                $mail->IsHTML(true);
                                $mail->CharSet = 'UTF-8';
                                $mail->Subject = "Sistema de Pedidos de EPP | GRUPO CAVI";
                                $mail->Body = "<h2>|  Nuevo Pedido de EPP Ropa y Calzado|</h2><br><p>Estimado (a) encargado de Almacén:</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                    Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
        
                                if(!$mail->Send())
                                {
                                echo "Fallo";
                                }
                            }
                            else {
                              echo "<script languaje='javascript'>
                                  alert('No puede autorizar pedidos fuera de fecha.')
                      location.href='historial_tr?id=tw_redireccion';
                              </script>";
                            }
				    }
                    else if(isset($_POST["aut2r"])) {
                        $query = "UPDATE epp_rc SET autorizado_residente='No autorizado',observaciones_res='".$_POST["observaciones_res"]."',fecha_autorizado_residente='".$fecha_hoy."' WHERE folio ='".$_POST["folio"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
                    
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio ".$_POST["folio"]."')
                    location.href='historial_rc_obras?id=tw_redireccion';
                            </script>";
				    }
                    else {
						$id_pedido=$_GET['id_pedido'];
						$sql_query="SELECT * FROM epp_rc WHERE id='".$id_pedido."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
                    if($_SESSION['user_epp'] == "sasst") { ?>
                    <form action="modificar_rc_obras" method="post">
                    <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?> " >
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol']; ?>">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Empresa</i></label>
                                <select name='empresa' class='form-control input-sm' disabled>
                                    <option selected><?php echo $Rs['empresa'];?></option>
                                    <option value="Cavi de Sombrerete S.A. de C.V.">Cavi de Sombrerete S.A. de C.V.</option>
                                    <option value="Concretos Cavi S.A. de C.V.">Concretos Cavi S.A. de C.V.</option>
                                    <option value="Montajes y Estructuras de Zacatecas S.A. de C.V.">Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                    <option value="Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.">Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                            <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm' disabled>
                                <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
                                    <option value="Proyectos de Construcción Concretos">Proyectos de Construcción Concretos</option>
                                    <option value="Sucursal MyT Control Vehicular">Sucursal MyT Control Vehicular</option>
                                    <option value="Herradura">Herradura</option>
                                    <option value="Juanicipio">Juanicipio</option>
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
						</div>
                        <br><br><br>
            			<div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label">Nombre</label>
    							<input class="form-control input-sm" type="text" name="nombre1" readonly value="<?php echo $Rs['nombre1'];?>">
                            </div>
  							<div class="col-xs-1">
                                <label class="control-label">T.Overol</label>
                                <input class="form-control input-sm" type="text" name="talla_overol1" readonly value="<?php echo $Rs['talla_overol1'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <label class="control-label">T.Zapato</label>
                                <input class="form-control input-sm" type="text" name="talla_zapato1" readonly value="<?php echo $Rs['talla_zapato1'];?>">
                            </div>
  							<div class="col-xs-1">
                				<label class="control-label">T.Bota</label>
    							<input class="form-control input-sm" type="text" name="talla_bota1" readonly value="<?php echo $Rs['talla_bota1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Camisa</label>
    							<input class="form-control input-sm" type="text" name="talla_camisa1" readonly value="<?php echo $Rs['talla_camisa1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Pantalón</label>
    							<input class="form-control input-sm" type="text" name="talla_pantalon1" readonly value="<?php echo $Rs['talla_pantalon1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Chaleco</label>
    							<input class="form-control input-sm" type="text" name="talla_chaleco1" readonly value="<?php echo $Rs['talla_chaleco1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Bata</label>
    							<input class="form-control input-sm" type="text" name="talla_bata1" readonly value="<?php echo $Rs['talla_bata1'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre2" readonly value="<?php echo $Rs['nombre2'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol2" readonly value="<?php echo $Rs['talla_overol2'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato2" readonly value="<?php echo $Rs['talla_zapato2'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota2" readonly value="<?php echo $Rs['talla_bota2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa2" readonly value="<?php echo $Rs['talla_camisa2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon2" readonly value="<?php echo $Rs['talla_pantalon2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco2" readonly value="<?php echo $Rs['talla_chaleco2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata2" readonly value="<?php echo $Rs['talla_bata2'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre3" readonly value="<?php echo $Rs['nombre3'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol3" readonly value="<?php echo $Rs['talla_overol3'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato3" readonly value="<?php echo $Rs['talla_zapato3'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota3" readonly value="<?php echo $Rs['talla_bota3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa3" readonly value="<?php echo $Rs['talla_camisa3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon3" readonly value="<?php echo $Rs['talla_pantalon3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco3" readonly value="<?php echo $Rs['talla_chaleco3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata3" readonly value="<?php echo $Rs['talla_bata3'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre4" readonly value="<?php echo $Rs['nombre4'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol4" readonly value="<?php echo $Rs['talla_overol4'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato4" readonly value="<?php echo $Rs['talla_zapato4'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota4" readonly value="<?php echo $Rs['talla_bota4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa4" readonly value="<?php echo $Rs['talla_camisa4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon4" readonly value="<?php echo $Rs['talla_pantalon4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco4" readonly value="<?php echo $Rs['talla_chaleco4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata4" readonly value="<?php echo $Rs['talla_bata4'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre5" readonly value="<?php echo $Rs['nombre5'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol5" readonly value="<?php echo $Rs['talla_overol5'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato5" readonly value="<?php echo $Rs['talla_zapato5'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota5" readonly value="<?php echo $Rs['talla_bota5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa5" readonly value="<?php echo $Rs['talla_camisa5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon5" readonly value="<?php echo $Rs['talla_pantalon5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco5" readonly value="<?php echo $Rs['talla_chaleco5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata5" readonly value="<?php echo $Rs['talla_bata5'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre6" readonly value="<?php echo $Rs['nombre6'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol6" readonly value="<?php echo $Rs['talla_overol6'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato6" readonly value="<?php echo $Rs['talla_zapato6'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota6" readonly value="<?php echo $Rs['talla_bota6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa6" readonly value="<?php echo $Rs['talla_camisa6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon6" readonly value="<?php echo $Rs['talla_pantalon6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco6" readonly value="<?php echo $Rs['talla_chaleco6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata6" readonly value="<?php echo $Rs['talla_bata6'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre7" readonly value="<?php echo $Rs['nombre7'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol7" readonly value="<?php echo $Rs['talla_overol7'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato7" readonly value="<?php echo $Rs['talla_zapato7'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota7" readonly value="<?php echo $Rs['talla_bota7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa7" readonly value="<?php echo $Rs['talla_camisa7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon7" readonly value="<?php echo $Rs['talla_pantalon7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco7" readonly value="<?php echo $Rs['talla_chaleco7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata7" readonly value="<?php echo $Rs['talla_bata7'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre8" readonly value="<?php echo $Rs['nombre8'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol8" readonly value="<?php echo $Rs['talla_overol8'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato8" readonly value="<?php echo $Rs['talla_zapato8'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota8" readonly value="<?php echo $Rs['talla_bota8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa8" readonly value="<?php echo $Rs['talla_camisa8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon8" readonly value="<?php echo $Rs['talla_pantalon8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco8" readonly value="<?php echo $Rs['talla_chaleco8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata8" readonly value="<?php echo $Rs['talla_bata8'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre9" readonly value="<?php echo $Rs['nombre9'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol9" readonly value="<?php echo $Rs['talla_overol9'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato9" readonly value="<?php echo $Rs['talla_zapato9'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota9" readonly value="<?php echo $Rs['talla_bota9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa9" readonly value="<?php echo $Rs['talla_camisa9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon9" readonly value="<?php echo $Rs['talla_pantalon9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco9" readonly value="<?php echo $Rs['talla_chaleco9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata9" readonly value="<?php echo $Rs['talla_bata9'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre10" readonly value="<?php echo $Rs['nombre10'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol10" readonly value="<?php echo $Rs['talla_overol10'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato10" readonly value="<?php echo $Rs['talla_zapato10'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota10" readonly value="<?php echo $Rs['talla_bota10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa10" readonly value="<?php echo $Rs['talla_camisa10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon10" readonly value="<?php echo $Rs['talla_pantalon10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco10" readonly value="<?php echo $Rs['talla_chaleco10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata10" readonly value="<?php echo $Rs['talla_bata10'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre11" readonly value="<?php echo $Rs['nombre11'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol11" readonly value="<?php echo $Rs['talla_overol11'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato11" readonly value="<?php echo $Rs['talla_zapato11'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota11" readonly value="<?php echo $Rs['talla_bota11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa11" readonly value="<?php echo $Rs['talla_camisa11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon11" readonly value="<?php echo $Rs['talla_pantalon11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco11" readonly value="<?php echo $Rs['talla_chaleco11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata11" readonly value="<?php echo $Rs['talla_bata11'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre12" readonly value="<?php echo $Rs['nombre12'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol12" readonly value="<?php echo $Rs['talla_overol12'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato12" readonly value="<?php echo $Rs['talla_zapato12'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota12" readonly value="<?php echo $Rs['talla_bota12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa12" readonly value="<?php echo $Rs['talla_camisa12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon12" readonly value="<?php echo $Rs['talla_pantalon12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco12" readonly value="<?php echo $Rs['talla_chaleco12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata12" readonly value="<?php echo $Rs['talla_bata12'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre13" readonly value="<?php echo $Rs['nombre13'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol13" readonly value="<?php echo $Rs['talla_overol13'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato13" readonly value="<?php echo $Rs['talla_zapato13'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota13" readonly value="<?php echo $Rs['talla_bota13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa13" readonly value="<?php echo $Rs['talla_camisa13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon13" readonly value="<?php echo $Rs['talla_pantalon13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco13" readonly value="<?php echo $Rs['talla_chaleco13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata13" readonly value="<?php echo $Rs['talla_bata13'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre14" readonly value="<?php echo $Rs['nombre14'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol14" readonly value="<?php echo $Rs['talla_overol14'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato14" readonly value="<?php echo $Rs['talla_zapato14'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota14" readonly value="<?php echo $Rs['talla_bota14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa14" readonly value="<?php echo $Rs['talla_camisa14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon14" readonly value="<?php echo $Rs['talla_pantalon14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco14" readonly value="<?php echo $Rs['talla_chaleco14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata14" readonly value="<?php echo $Rs['talla_bata14'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre15" readonly value="<?php echo $Rs['nombre15'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol15" readonly value="<?php echo $Rs['talla_overol15'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato15" readonly value="<?php echo $Rs['talla_zapato15'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota15" readonly value="<?php echo $Rs['talla_bota15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa15" readonly value="<?php echo $Rs['talla_camisa15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon15" readonly value="<?php echo $Rs['talla_pantalon15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco15" readonly value="<?php echo $Rs['talla_chaleco15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata15" readonly value="<?php echo $Rs['talla_bata15'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre16" readonly value="<?php echo $Rs['nombre16'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol16" readonly value="<?php echo $Rs['talla_overol16'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato16" readonly value="<?php echo $Rs['talla_zapato16'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota16" readonly value="<?php echo $Rs['talla_bota16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa16" readonly value="<?php echo $Rs['talla_camisa16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon16" readonly value="<?php echo $Rs['talla_pantalon16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco16" readonly value="<?php echo $Rs['talla_chaleco16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata16" readonly value="<?php echo $Rs['talla_bata16'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre17" readonly value="<?php echo $Rs['nombre17'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol17" readonly value="<?php echo $Rs['talla_overol17'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato17" readonly value="<?php echo $Rs['talla_zapato17'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota17" readonly value="<?php echo $Rs['talla_bota17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa17" readonly value="<?php echo $Rs['talla_camisa17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon17" readonly value="<?php echo $Rs['talla_pantalon17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco17" readonly value="<?php echo $Rs['talla_chaleco17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata17" readonly value="<?php echo $Rs['talla_bata17'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre18" readonly value="<?php echo $Rs['nombre18'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol18" readonly value="<?php echo $Rs['talla_overol18'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato18" readonly value="<?php echo $Rs['talla_zapato18'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota18" readonly value="<?php echo $Rs['talla_bota18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa18" readonly value="<?php echo $Rs['talla_camisa18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon18" readonly value="<?php echo $Rs['talla_pantalon18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco18" readonly value="<?php echo $Rs['talla_chaleco18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata18" readonly value="<?php echo $Rs['talla_bata18'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre19" readonly value="<?php echo $Rs['nombre19'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol19" readonly value="<?php echo $Rs['talla_overol19'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato19" readonly value="<?php echo $Rs['talla_zapato19'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota19" readonly value="<?php echo $Rs['talla_bota19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa19" readonly value="<?php echo $Rs['talla_camisa19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon19" readonly value="<?php echo $Rs['talla_pantalon19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco19" readonly value="<?php echo $Rs['talla_chaleco19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata19" readonly value="<?php echo $Rs['talla_bata19'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre20" readonly value="<?php echo $Rs['nombre20'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol20" readonly value="<?php echo $Rs['talla_overol20'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato20" readonly value="<?php echo $Rs['talla_zapato20'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota20" readonly value="<?php echo $Rs['talla_bota20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa20" readonly value="<?php echo $Rs['talla_camisa20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon20" readonly value="<?php echo $Rs['talla_pantalon20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco20" readonly value="<?php echo $Rs['talla_chaleco20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata20" readonly value="<?php echo $Rs['talla_bata20'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Supervisor</label>
                                <textarea  name="observaciones_sup" class="form-control " readonly><?php echo $Rs['observaciones_sup'];?></textarea>
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Residente</label>
                                <textarea  name="observaciones_res" class="form-control "><?php echo $Rs['observaciones_res'];?> </textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Almacén</label>
                                <textarea  name="observaciones_almacen" class="form-control " readonly><?php echo $Rs['observaciones_almacen'];?> </textarea>
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
                                <input class="btn form-btn btn-success" type="submit" name="aut1r" value="Autorizar">
                            </div>
                            <div class="col-xs-2">
                                <input class="btn form-btn btn-danger" type="submit" name="aut2r" value="No autorizar">
                            </div>
                        </div>
        			</form>
                    <?php }	
                    else if($_SESSION['user_epp'] == "gerseg") { ?>

                <form action="modificar_rc_obras" method="post">
                    <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio'];?> " >
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol']; ?>">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Empresa</i></label>
                                <select name='empresa' class='form-control input-sm' disabled>
                                    <option selected><?php echo $Rs['empresa'];?></option>
                                    <option value="Cavi de Sombrerete S.A. de C.V.">Cavi de Sombrerete S.A. de C.V.</option>
                                    <option value="Concretos Cavi S.A. de C.V.">Concretos Cavi S.A. de C.V.</option>
                                    <option value="Montajes y Estructuras de Zacatecas S.A. de C.V.">Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                    <option value="Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.">Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                            <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm' disabled>
                                    <option selected><?php echo $Rs['obra'];?></option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Concretos Cavi">Concretos Cavi</option>
                                    <option value="Proyectos de Construcción Concretos">Proyectos de Construcción Concretos</option>
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
						</div>
                        <br><br><br>
            			<div class="row form-horizontal">
                            <div class="col-xs-4">
                                <label class="control-label">Nombre</label>
    							<input class="form-control input-sm" type="text" name="nombre1" readonly value="<?php echo $Rs['nombre1'];?>">
                            </div>
  							<div class="col-xs-1">
                                <label class="control-label">T.Overol</label>
                                <input class="form-control input-sm" type="text" name="talla_overol1" readonly value="<?php echo $Rs['talla_overol1'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <label class="control-label">T.Zapato</label>
                                <input class="form-control input-sm" type="text" name="talla_zapato1" readonly value="<?php echo $Rs['talla_zapato1'];?>">
                            </div>
  							<div class="col-xs-1">
                				<label class="control-label">T.Bota</label>
    							<input class="form-control input-sm" type="text" name="talla_bota1" readonly value="<?php echo $Rs['talla_bota1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Camisa</label>
    							<input class="form-control input-sm" type="text" name="talla_camisa1" readonly value="<?php echo $Rs['talla_camisa1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Pantalón</label>
    							<input class="form-control input-sm" type="text" name="talla_pantalon1" readonly value="<?php echo $Rs['talla_pantalon1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Chaleco</label>
    							<input class="form-control input-sm" type="text" name="talla_chaleco1" readonly value="<?php echo $Rs['talla_chaleco1'];?>">
  							</div>
                              <div class="col-xs-1">
                				<label class="control-label">T.Bata</label>
    							<input class="form-control input-sm" type="text" name="talla_bata1" readonly value="<?php echo $Rs['talla_bata1'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre2" readonly value="<?php echo $Rs['nombre2'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol2" readonly value="<?php echo $Rs['talla_overol2'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato2" readonly value="<?php echo $Rs['talla_zapato2'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota2" readonly value="<?php echo $Rs['talla_bota2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa2" readonly value="<?php echo $Rs['talla_camisa2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon2" readonly value="<?php echo $Rs['talla_pantalon2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco2" readonly value="<?php echo $Rs['talla_chaleco2'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata2" readonly value="<?php echo $Rs['talla_bata2'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre3" readonly value="<?php echo $Rs['nombre3'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol3" readonly value="<?php echo $Rs['talla_overol3'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato3" readonly value="<?php echo $Rs['talla_zapato3'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota3" readonly value="<?php echo $Rs['talla_bota3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa3" readonly value="<?php echo $Rs['talla_camisa3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon3" readonly value="<?php echo $Rs['talla_pantalon3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco3" readonly value="<?php echo $Rs['talla_chaleco3'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata3" readonly value="<?php echo $Rs['talla_bata3'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre4" readonly value="<?php echo $Rs['nombre4'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol4" readonly value="<?php echo $Rs['talla_overol4'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato4" readonly value="<?php echo $Rs['talla_zapato4'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota4" readonly value="<?php echo $Rs['talla_bota4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa4" readonly value="<?php echo $Rs['talla_camisa4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon4" readonly value="<?php echo $Rs['talla_pantalon4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco4" readonly value="<?php echo $Rs['talla_chaleco4'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata4" readonly value="<?php echo $Rs['talla_bata4'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre5" readonly value="<?php echo $Rs['nombre5'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol5" readonly value="<?php echo $Rs['talla_overol5'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato5" readonly value="<?php echo $Rs['talla_zapato5'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota5" readonly value="<?php echo $Rs['talla_bota5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa5" readonly value="<?php echo $Rs['talla_camisa5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon5" readonly value="<?php echo $Rs['talla_pantalon5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco5" readonly value="<?php echo $Rs['talla_chaleco5'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata5" readonly value="<?php echo $Rs['talla_bata5'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre6" readonly value="<?php echo $Rs['nombre6'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol6" readonly value="<?php echo $Rs['talla_overol6'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato6" readonly value="<?php echo $Rs['talla_zapato6'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota6" readonly value="<?php echo $Rs['talla_bota6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa6" readonly value="<?php echo $Rs['talla_camisa6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon6" readonly value="<?php echo $Rs['talla_pantalon6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco6" readonly value="<?php echo $Rs['talla_chaleco6'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata6" readonly value="<?php echo $Rs['talla_bata6'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre7" readonly value="<?php echo $Rs['nombre7'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol7" readonly value="<?php echo $Rs['talla_overol7'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato7" readonly value="<?php echo $Rs['talla_zapato7'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota7" readonly value="<?php echo $Rs['talla_bota7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa7" readonly value="<?php echo $Rs['talla_camisa7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon7" readonly value="<?php echo $Rs['talla_pantalon7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco7" readonly value="<?php echo $Rs['talla_chaleco7'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata7" readonly value="<?php echo $Rs['talla_bata7'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre8" readonly value="<?php echo $Rs['nombre8'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol8" readonly value="<?php echo $Rs['talla_overol8'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato8" readonly value="<?php echo $Rs['talla_zapato8'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota8" readonly value="<?php echo $Rs['talla_bota8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa8" readonly value="<?php echo $Rs['talla_camisa8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon8" readonly value="<?php echo $Rs['talla_pantalon8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco8" readonly value="<?php echo $Rs['talla_chaleco8'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata8" readonly value="<?php echo $Rs['talla_bata8'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre9" readonly value="<?php echo $Rs['nombre9'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol9" readonly value="<?php echo $Rs['talla_overol9'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato9" readonly value="<?php echo $Rs['talla_zapato9'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota9" readonly value="<?php echo $Rs['talla_bota9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa9" readonly value="<?php echo $Rs['talla_camisa9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon9" readonly value="<?php echo $Rs['talla_pantalon9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco9" readonly value="<?php echo $Rs['talla_chaleco9'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata9" readonly value="<?php echo $Rs['talla_bata9'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre10" readonly value="<?php echo $Rs['nombre10'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol10" readonly value="<?php echo $Rs['talla_overol10'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato10" readonly value="<?php echo $Rs['talla_zapato10'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota10" readonly value="<?php echo $Rs['talla_bota10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa10" readonly value="<?php echo $Rs['talla_camisa10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon10" readonly value="<?php echo $Rs['talla_pantalon10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco10" readonly value="<?php echo $Rs['talla_chaleco10'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata10" readonly value="<?php echo $Rs['talla_bata10'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre11" readonly value="<?php echo $Rs['nombre11'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol11" readonly value="<?php echo $Rs['talla_overol11'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato11" readonly value="<?php echo $Rs['talla_zapato11'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota11" readonly value="<?php echo $Rs['talla_bota11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa11" readonly value="<?php echo $Rs['talla_camisa11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon11" readonly value="<?php echo $Rs['talla_pantalon11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco11" readonly value="<?php echo $Rs['talla_chaleco11'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata11" readonly value="<?php echo $Rs['talla_bata11'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre12" readonly value="<?php echo $Rs['nombre12'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol12" readonly value="<?php echo $Rs['talla_overol12'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato12" readonly value="<?php echo $Rs['talla_zapato12'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota12" readonly value="<?php echo $Rs['talla_bota12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa12" readonly value="<?php echo $Rs['talla_camisa12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon12" readonly value="<?php echo $Rs['talla_pantalon12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco12" readonly value="<?php echo $Rs['talla_chaleco12'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata12" readonly value="<?php echo $Rs['talla_bata12'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre13" readonly value="<?php echo $Rs['nombre13'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol13" readonly value="<?php echo $Rs['talla_overol13'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato13" readonly value="<?php echo $Rs['talla_zapato13'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota13" readonly value="<?php echo $Rs['talla_bota13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa13" readonly value="<?php echo $Rs['talla_camisa13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon13" readonly value="<?php echo $Rs['talla_pantalon13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco13" readonly value="<?php echo $Rs['talla_chaleco13'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata13" readonly value="<?php echo $Rs['talla_bata13'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre14" readonly value="<?php echo $Rs['nombre14'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol14" readonly value="<?php echo $Rs['talla_overol14'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato14" readonly value="<?php echo $Rs['talla_zapato14'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota14" readonly value="<?php echo $Rs['talla_bota14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa14" readonly value="<?php echo $Rs['talla_camisa14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon14" readonly value="<?php echo $Rs['talla_pantalon14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco14" readonly value="<?php echo $Rs['talla_chaleco14'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata14" readonly value="<?php echo $Rs['talla_bata14'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre15" readonly value="<?php echo $Rs['nombre15'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol15" readonly value="<?php echo $Rs['talla_overol15'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato15" readonly value="<?php echo $Rs['talla_zapato15'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota15" readonly value="<?php echo $Rs['talla_bota15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa15" readonly value="<?php echo $Rs['talla_camisa15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon15" readonly value="<?php echo $Rs['talla_pantalon15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco15" readonly value="<?php echo $Rs['talla_chaleco15'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata15" readonly value="<?php echo $Rs['talla_bata15'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre16" readonly value="<?php echo $Rs['nombre16'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol16" readonly value="<?php echo $Rs['talla_overol16'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato16" readonly value="<?php echo $Rs['talla_zapato16'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota16" readonly value="<?php echo $Rs['talla_bota16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa16" readonly value="<?php echo $Rs['talla_camisa16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon16" readonly value="<?php echo $Rs['talla_pantalon16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco16" readonly value="<?php echo $Rs['talla_chaleco16'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata16" readonly value="<?php echo $Rs['talla_bata16'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre17" readonly value="<?php echo $Rs['nombre17'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol17" readonly value="<?php echo $Rs['talla_overol17'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato17" readonly value="<?php echo $Rs['talla_zapato17'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota17" readonly value="<?php echo $Rs['talla_bota17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa17" readonly value="<?php echo $Rs['talla_camisa17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon17" readonly value="<?php echo $Rs['talla_pantalon17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco17" readonly value="<?php echo $Rs['talla_chaleco17'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata17" readonly value="<?php echo $Rs['talla_bata17'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre18" readonly value="<?php echo $Rs['nombre18'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol18" readonly value="<?php echo $Rs['talla_overol18'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato18" readonly value="<?php echo $Rs['talla_zapato18'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota18" readonly value="<?php echo $Rs['talla_bota18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa18" readonly value="<?php echo $Rs['talla_camisa18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon18" readonly value="<?php echo $Rs['talla_pantalon18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco18" readonly value="<?php echo $Rs['talla_chaleco18'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata18" readonly value="<?php echo $Rs['talla_bata18'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre19" readonly value="<?php echo $Rs['nombre19'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol19" readonly value="<?php echo $Rs['talla_overol19'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato19" readonly value="<?php echo $Rs['talla_zapato19'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota19" readonly value="<?php echo $Rs['talla_bota19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa19" readonly value="<?php echo $Rs['talla_camisa19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon19" readonly value="<?php echo $Rs['talla_pantalon19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco19" readonly value="<?php echo $Rs['talla_chaleco19'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata19" readonly value="<?php echo $Rs['talla_bata19'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                        <div class="col-xs-4">
    							<input class="form-control input-sm" type="text" name="nombre20" readonly value="<?php echo $Rs['nombre20'];?>">
                            </div>
  							<div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol20" readonly value="<?php echo $Rs['talla_overol20'];?>"/>
  							</div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato20" readonly value="<?php echo $Rs['talla_zapato20'];?>">
                            </div>
  							<div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bota20" readonly value="<?php echo $Rs['talla_bota20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_camisa20" readonly value="<?php echo $Rs['talla_camisa20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_pantalon20" readonly value="<?php echo $Rs['talla_pantalon20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_chaleco20" readonly value="<?php echo $Rs['talla_chaleco20'];?>">
  							</div>
                              <div class="col-xs-1">
    							<input class="form-control input-sm" type="text" name="talla_bata20" readonly value="<?php echo $Rs['talla_bata20'];?>">
  							</div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Supervisor</label>
                                <textarea  name="observaciones_sup" class="form-control " readonly><?php echo $Rs['observaciones_sup'];?></textarea>
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Residente</label>
                                <textarea  name="observaciones_res" class="form-control " readonly><?php echo $Rs['observaciones_res'];?> </textarea>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones Almacén</label>
                                <textarea  name="observaciones_almacen" class="form-control " readonly><?php echo $Rs['observaciones_almacen'];?> </textarea>
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
                                <textarea  name="observaciones_gerob" class="form-control " ><?php echo $Rs['observaciones_gerob'];?> </textarea>
                            </div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-2">
                                <input class="btn form-btn btn-success" type="submit" name="aut1go" value="Autorizar">
                            </div>
                            <div class="col-xs-2">
                                <input class="btn form-btn btn-danger" type="submit" name="aut2go" value="No autorizar">
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
  </body>
</html>