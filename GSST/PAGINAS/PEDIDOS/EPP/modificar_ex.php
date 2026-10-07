<?php
date_default_timezone_set("Mexico/General");
session_start();
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']) && !isset($_SESSION['user_epp']) && !isset($_SESSION['obra'])) {
    header('Location: ../../../index');
    exit();
}
include("../../../conexion/conexion.php");
$conexion = Conectarse();

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
        .rojo {
            background-color: #FF0000;
        }

        .azul {
            color: #0066FF;
        }

        .verde {
            color: #009900;
        }

        select {
            background-color: #FF66FF;
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
                    <?php if ($_SESSION['user_epp'] == 'sup') {
                        if ($_SESSION['usuario'] == "AYLIN") { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> ADM<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="nuevo_re?acronimo=ADM">Nuevo Reemplazo</a></li>
                                    <li><a href="nuevo_ex?acronimo=ADM">Nuevo Extraordinario</a></li>
                                    <li><a href="nuevo_tr?acronimo=ADM">Nuevo Trimestral</a></li>
                                    <li><a href="nuevo_rc?acronimo=ADM">Nuevo Ropa y Calzado</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> CON<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="nuevo_re?acronimo=CON">Nuevo Reemplazo</a></li>
                                    <li><a href="nuevo_ex?acronimo=CON">Nuevo Extraordinario</a></li>
                                    <li><a href="nuevo_tr?acronimo=CON">Nuevo Trimestral</a></li>
                                    <li><a href="nuevo_rc?acronimo=CON">Nuevo Ropa y Calzado</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> MTO<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="nuevo_re?acronimo=MTO">Nuevo Reemplazo</a></li>
                                    <li><a href="nuevo_ex?acronimo=MTO">Nuevo Extraordinario</a></li>
                                    <li><a href="nuevo_tr?acronimo=MTO">Nuevo Trimestral</a></li>
                                    <li><a href="nuevo_rc?acronimo=MTO">Nuevo Ropa y Calzado</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> CVE<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="nuevo_re?acronimo=CVE">Nuevo Reemplazo</a></li>
                                    <li><a href="nuevo_ex?acronimo=CVE">Nuevo Extraordinario</a></li>
                                    <li><a href="nuevo_tr?acronimo=CVE">Nuevo Trimestral</a></li>
                                    <li><a href="nuevo_rc?acronimo=CVE">Nuevo Ropa y Calzado</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> MYT<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="nuevo_re?acronimo=MYT">Nuevo Reemplazo</a></li>
                                    <li><a href="nuevo_ex?acronimo=MYT">Nuevo Extraordinario</a></li>
                                    <li><a href="nuevo_tr?acronimo=MYT">Nuevo Trimestral</a></li>
                                    <li><a href="nuevo_rc?acronimo=MYT">Nuevo Ropa y Calzado</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> TES<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="nuevo_re?acronimo=TES">Nuevo Reemplazo</a></li>
                                    <li><a href="nuevo_ex?acronimo=TES">Nuevo Extraordinario</a></li>
                                    <li><a href="nuevo_tr?acronimo=TES">Nuevo Trimestral</a></li>
                                    <li><a href="nuevo_rc?acronimo=TES">Nuevo Ropa y Calzado</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> MZF<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="nuevo_re?acronimo=MZF">Nuevo Reemplazo</a></li>
                                    <li><a href="nuevo_ex?acronimo=MZF">Nuevo Extraordinario</a></li>
                                    <li><a href="nuevo_tr?acronimo=MZF">Nuevo Trimestral</a></li>
                                    <li><a href="nuevo_rc?acronimo=MZF">Nuevo Ropa y Calzado</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> MPE<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="nuevo_re?acronimo=MPE">Nuevo Reemplazo</a></li>
                                    <li><a href="nuevo_ex?acronimo=MPE">Nuevo Extraordinario</a></li>
                                    <li><a href="nuevo_tr?acronimo=MPE">Nuevo Trimestral</a></li>
                                    <li><a href="nuevo_rc?acronimo=MPE">Nuevo Ropa y Calzado</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> TOC<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="nuevo_re?acronimo=TOC">Nuevo Reemplazo</a></li>
                                    <li><a href="nuevo_ex?acronimo=TOC">Nuevo Extraordinario</a></li>
                                    <li><a href="nuevo_tr?acronimo=TOC">Nuevo Trimestral</a></li>
                                    <li><a href="nuevo_rc?acronimo=TOC">Nuevo Ropa y Calzado</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
                                </a>
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
                        <?php } else { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Nuevo<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="nuevo_re">Reemplazo</a></li>
                                    <li><a href="nuevo_ex">Extraordinario</a></li>
                                    <li><a href="nuevo_tr">Trimestral</a></li>
                                    <li><a href="nuevo_rc">Ropa y Calzado</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
                                </a>
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
                    <?php
                        }
                    } ?>
                    <?php if ($_SESSION['user_epp'] == 'sasst') { ?>
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
                    <?php } else if ($_SESSION['user_epp'] == 'alm') { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="historial_tr">Trimestral</a></li>
                                <li><a href="historial_rc">Ropa y Calzado</a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="reportes" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
                        </li><?php } else if ($_SESSION['user_epp'] == 'gerseg') { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="historial_re">Reemplazo</a></li>
                                <li><a href="historial_ex">Extraordinario</a></li>
                                <li><a href="historial_tr">Trimestral</a></li>
                                <li><a href="historial_rc">Ropa y Calzado</a></li>
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
                    <p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido " . ucwords($_SESSION['usuario']) . " | "; ?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
                </ul>
            </div>
        </nav>
        <div class="panel panel-default" style="margin-top: 5px;">
            <div align="center" class="panel-heading">Modificar Pedido Extraordinario de EPP</div>
            <div class="panel-body">
                <?php
                header("Content-Type: text/html;charset=utf-8");
                error_reporting(E_ALL ^ E_NOTICE);
                mysql_query("SET NAMES 'utf8'");
                $fecha_hoy = new DateTime('now', new DateTimeZone('America/Mazatlan'));
                $date = $fecha_hoy->format('Y-m-d');
                if (isset($_POST["submit"])) {
                    $obra = $_POST['obra'];
                    if ($obra == "Administrativo") {
                        $fol_ob = "ADM";
                        // $correo_residente = "karina_rodriguez@grupocavi.com.mx";
                        $correo_residente = "maricruz_flores@grupocavi.com.mx";
                        $correo_gerob = "maricruz_flores@grupocavi.com.mx";
                    } else if ($obra == "Concretos Cavi") {
                        $fol_ob = "CON";
                        $correo_residente = "abelardo_amador@grupocavi.com.mx";
                        $correo_gerob = "antonio_ulloa@grupocavi.com.mx";
                    } else if ($obra == "Proyectos de Construcción Concretos") {
                        $fol_ob = "PCC";
                        $correo_residente = "eric_aldaba@grupocavi.com.mx";
                        $correo_gerob = "vinicio_bustos@grupocavi.com.mx";
                    } else if ($obra == "Sucursal MyT Control Vehicular") {
                        $fol_ob = "CVE";
                        $correo_residente = "jesus_valdez@grupocavi.com.mx";
                        $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Herradura") {
                        $fol_ob = "HER";
                        $correo_residente = "crispin_rivera@grupocavi.com.mx";
                        $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Sucursal MyT Maquinaria Pesada") {
                        $fol_ob = "MPE";
                        $correo_residente = "jaime_vela@grupocavi.com.mx";
                        $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Mantenimiento Multifuncional") {
                        $fol_ob = "MTO";
                        $correo_residente = "eric_aldaba@grupocavi.com.mx";
                        $correo_gerob = "vinicio_bustos@grupocavi.com.mx";
                    } else if ($obra == "Sucursal MyT Administración") {
                        $fol_ob = "MYT";
                        $correo_residente = "lorena_mena@grupocavi.com.mx";
                        $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Sucursal MyT Mecánicos Zona Foránea") {
                        $fol_ob = "MZF";
                        $correo_residente = "jesus_valdez@grupocavi.com.mx";
                        $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Proyecto San Julián") {
                        $fol_ob = "PSJ";
                        $correo_residente = "eduardo_gonzalez@grupocavi.com.mx";
                        $correo_gerob = "moises_fernandez@grupocavi.com.mx";
                    } else if ($obra == "Reclutamiento") {
                        $fol_ob = "REC";
                        $correo_residente = "";
                        $correo_gerob = "";
                    } else if ($obra == "Sabinas") {
                        $fol_ob = "SAB";
                        $correo_residente = "francisco_borjon@grupocavi.com.mx";
                        $correo_gerob = "moises_fernandez@grupocavi.com.mx";
                    } else if ($obra == "Saucito") {
                        $fol_ob = "SAU";
                        $correo_residente = "javier_favela@grupocavi.com.mx";
                        $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos") {
                        $fol_ob = "SPP";
                        $correo_residente = "adolfo_flores@grupocavi.com.mx";
                        $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Sucursal MyT Transporte Especial") {
                        $fol_ob = "TES";
                        $correo_residente = "jaime_vela@grupocavi.com.mx";
                        $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Tocayos Agosto 2019") {
                        $fol_ob = "TOC";
                        $correo_residente = "eric_aldaba@grupocavi.com.mx";
                        $correo_gerob = "vinicio_bustos@grupocavi.com.mx";
                    } else if ($_SESSION['obra'] == "Juanicipio") {
                        $fol_ob = "JNC";
                        $correo_residente = "carlos_castrejon@grupocavi.com.mx";
                        $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                    } else {
                        $fol_ob = $_GET['acronimo'];
                    }
                    $query = "UPDATE epp_ex SET motivo='" . $_POST["motivo"] . "',
                        justificacion='" . $_POST["justificacion"] . "', cant1='" . $_POST["cant1"] . "', equipo1='" . $_POST["equipo1"] . "',
                        codigo1='" . $_POST["codigo1"] . "',marca1='" . $_POST["marca1"] . "',nombre1='" . $_POST["nombre1"] . "', 
                        cant2='" . $_POST["cant2"] . "', equipo2='" . $_POST["equipo2"] . "',
                        codigo2='" . $_POST["codigo2"] . "',marca2='" . $_POST["marca2"] . "',nombre2='" . $_POST["nombre2"] . "',
                        cant3='" . $_POST["cant3"] . "', equipo3='" . $_POST["equipo3"] . "',
                        codigo3='" . $_POST["codigo3"] . "',marca3='" . $_POST["marca3"] . "',nombre3='" . $_POST["nombre3"] . "',
                        cant4='" . $_POST["cant4"] . "', equipo4='" . $_POST["equipo4"] . "',
                        codigo4='" . $_POST["codigo4"] . "',marca4='" . $_POST["marca4"] . "',nombre4='" . $_POST["nombre4"] . "',
                        cant5='" . $_POST["cant5"] . "', equipo5='" . $_POST["equipo5"] . "',
                        codigo5='" . $_POST["codigo5"] . "',marca5='" . $_POST["marca5"] . "',nombre5='" . $_POST["nombre5"] . "',observaciones_sup='" . $_POST["observaciones_sup"] . "' WHERE folio ='" . $_POST["folio"] . "'";
                    $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                    echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                    location.href='historial_ex?id=tw_redireccion';
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
                    $mail->AddAddress($correo_residente);

                    $mail->WordWrap = 50;
                    $mail->IsHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->Subject = "Sistema de Pedidos de EPP | GRUPO CAVI";
                    $mail->Body = "<h2>|  Nuevo Pedido de EPP Extraordinario|</h2><br><p>Estimado (a) residente de " . $obra . ":</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

                    if (!$mail->Send()) {
                        echo "Fallo";
                    }
                } else if (isset($_POST["aut1s"])) {
                    $fecha_hoy = new DateTime('now', new DateTimeZone('America/Mazatlan'));
                    $date = $fecha_hoy->format('Y-m-d');
                    if ($_FILES["adjuntos"]["error"] == 4) {
                        $query = "UPDATE epp_ex SET autorizado_sasst='Autorizado',observaciones_sasst='" . $_POST["observaciones_sasst"] . "',fecha_autorizado_sasst='" . $date . "' WHERE folio ='" . $_POST["folio"] . "'";
                        $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                        echo "<script languaje='javascript'>
                                    alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                        location.href='historial_ex?id=tw_redireccion';
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
                        $correo_glp = "karina_hinojoza@grupocavi.com.mx";
                        $mail->AddAddress($correo_glp);

                        $mail->WordWrap = 50;
                        $mail->IsHTML(true);
                        $mail->CharSet = 'UTF-8';
                        $mail->Subject = "Sistema de Pedidos de EPP | GRUPO CAVI";
                        $mail->Body = "<h2>|  Nuevo Pedido de EPP Extraordinario|</h2><br><p>Estimado(a) encargada de contratos:</p><p>Te informamos que tienes un nuevo pedido de EPP por verificar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

                        if (!$mail->Send()) {
                            echo "Fallo";
                        }
                    } else {
                        $fecha_hoy = new DateTime('now', new DateTimeZone('America/Mazatlan'));
                        $date = $fecha_hoy->format('Y-m-d');
                        $obra = $_POST['obral'];
                        if ($obra == "Administrativo") {
                            $fol_ob = "ADM";
                            // $correo_residente = "karina_rodriguez@grupocavi.com.mx";
                            $correo_residente = "maricruz_flores@grupocavi.com.mx";
                            $correo_gerob = "maricruz_flores@grupocavi.com.mx";
                        } else if ($obra == "Concretos Cavi") {
                            $fol_ob = "CON";
                            $correo_residente = "abelardo_amador@grupocavi.com.mx";
                            $correo_gerob = "antonio_ulloa@grupocavi.com.mx";
                        } else if ($obra == "Proyectos de Construcción Concretos") {
                            $fol_ob = "PCC";
                            $correo_residente = "eric_aldaba@grupocavi.com.mx";
                            $correo_gerob = "vinicio_bustos@grupocavi.com.mx";
                        } else if ($obra == "Sucursal MyT Control Vehicular") {
                            $fol_ob = "CVE";
                            $correo_residente = "jesus_valdez@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        } else if ($obra == "Herradura") {
                            $fol_ob = "HER";
                            $correo_residente = "crispin_rivera@grupocavi.com.mx";
                            $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                        } else if ($obra == "Sucursal MyT Maquinaria Pesada") {
                            $fol_ob = "MPE";
                            $correo_residente = "jaime_vela@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        } else if ($obra == "Mantenimiento Multifuncional") {
                            $fol_ob = "MTO";
                            $correo_residente = "eric_aldaba@grupocavi.com.mx";
                            $correo_gerob = "vinicio_bustos@grupocavi.com.mx";
                        } else if ($obra == "Sucursal MyT Administración") {
                            $fol_ob = "MYT";
                            $correo_residente = "lorena_mena@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        } else if ($obra == "Sucursal MyT Mecánicos Zona Foránea") {
                            $fol_ob = "MZF";
                            $correo_residente = "jesus_valdez@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        } else if ($obra == "Proyecto San Julián") {
                            $fol_ob = "PSJ";
                            $correo_residente = "eduardo_gonzalez@grupocavi.com.mx";
                            $correo_gerob = "moises_fernandez@grupocavi.com.mx";
                        } else if ($obra == "Reclutamiento") {
                            $fol_ob = "REC";
                            $correo_residente = "";
                            $correo_gerob = "";
                        } else if ($obra == "Sabinas") {
                            $fol_ob = "SAB";
                            $correo_residente = "francisco_borjon@grupocavi.com.mx";
                            $correo_gerob = "moises_fernandez@grupocavi.com.mx";
                        } else if ($obra == "Saucito") {
                            $fol_ob = "SAU";
                            $correo_residente = "javier_favela@grupocavi.com.mx";
                            $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                        } else if ($obra == "Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos") {
                            $fol_ob = "SPP";
                            $correo_residente = "adolfo_flores@grupocavi.com.mx";
                            $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                        } else if ($obra == "Sucursal MyT Transporte Especial") {
                            $fol_ob = "TES";
                            $correo_residente = "jaime_vela@grupocavi.com.mx";
                            $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                        } else if ($obra == "Tocayos Agosto 2019") {
                            $fol_ob = "TOC";
                            $correo_residente = "eric_aldaba@grupocavi.com.mx";
                            $correo_gerob = "vinicio_bustos@grupocavi.com.mx";
                        } else if ($_SESSION['obra'] == "Juanicipio") {
                            $fol_ob = "JNC";
                            $correo_residente = "carlos_castrejon@grupocavi.com.mx";
                            $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                        } else {
                            $fol_ob = $_GET['acronimo'];
                        }
                        $carpeta = "adjuntos/";
                        opendir($carpeta);
                        copy($_FILES['adjuntos']['tmp_name'], $carpeta . $_FILES['adjuntos']['name']);
                        $adjunto = $_FILES['adjuntos']['name'];

                        $query = "UPDATE epp_ex SET autorizado_sasst='Autorizado',observaciones_sasst='" . $_POST["observaciones_sasst"] . "',adjuntos='" . $adjunto . "',fecha_autorizado_sasst='" . $date . "' WHERE folio ='" . $_POST["folio"] . "'";
                        $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                        echo "<script languaje='javascript'>
                                    alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                        location.href='historial_ex?id=tw_redireccion';
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
                        $correo_gerseg = 'maricruz_flores@grupocavi.com.mx';
                        $mail->AddAddress($correo_gerseg);

                        $mail->WordWrap = 50;
                        $mail->IsHTML(true);
                        $mail->CharSet = 'UTF-8';
                        $mail->Subject = "Sistema de Pedidos de EPP | GRUPO CAVI";
                        $mail->Body = "<h2>|  Nuevo Pedido de EPP Extraordinario|</h2><br><p>Estimadas Gerencia de Seguridad:</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

                        if (!$mail->Send()) {
                            echo "Fallo";
                        }
                    }
                } else if (isset($_POST["aut2s"])) {
                    $fecha_hoy = new DateTime('now', new DateTimeZone('America/Mazatlan'));
                    $date = $fecha_hoy->format('Y-m-d');
                    $query = "UPDATE epp_ex SET autorizado_sasst='No autorizado',autorizado_residente='No autorizado',observaciones_sasst='" . $_POST["observaciones_sasst"] . "',fecha_autorizado_sasst='" . $date . "' WHERE folio ='" . $_POST["folio"] . "'";
                    $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                    echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                    location.href='historial_ex?id=tw_redireccion';
                            </script>";
                } else if (isset($_POST["aut1g"])) {
                    $obra = $_POST['obrag'];
                    if ($obra == "Administrativo") {
                        $fol_ob = "ADM";
                        // $correo_residente = "karina_rodriguez@grupocavi.com.mx";
                        $correo_residente = "maricruz_flores@grupocavi.com.mx";
                        $correo_gerob = "maricruz_flores@grupocavi.com.mx";
                    } else if ($obra == "Concretos Cavi") {
                        $fol_ob = "CON";
                        $correo_residente = "abelardo_amador@grupocavi.com.mx";
                        $correo_gerob = "antonio_ulloa@grupocavi.com.mx";
                    } else if ($obra == "Proyectos de Construcción Concretos") {
                        $fol_ob = "PCC";
                        $correo_residente = "eric_aldaba@grupocavi.com.mx";
                        $correo_gerob = "vinicio_bustos@grupocavi.com.mx";
                    } else if ($obra == "Sucursal MyT Control Vehicular") {
                        $fol_ob = "CVE";
                        $correo_residente = "jesus_valdez@grupocavi.com.mx";
                        $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Herradura") {
                        $fol_ob = "HER";
                        $correo_residente = "crispin_rivera@grupocavi.com.mx";
                        $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Sucursal MyT Maquinaria Pesada") {
                        $fol_ob = "MPE";
                        $correo_residente = "jaime_vela@grupocavi.com.mx";
                        $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Mantenimiento Multifuncional") {
                        $fol_ob = "MTO";
                        $correo_residente = "eric_aldaba@grupocavi.com.mx";
                        $correo_gerob = "vinicio_bustos@grupocavi.com.mx";
                    } else if ($obra == "Sucursal MyT Administración") {
                        $fol_ob = "MYT";
                        $correo_residente = "lorena_mena@grupocavi.com.mx";
                        $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Sucursal MyT Mecánicos Zona Foránea") {
                        $fol_ob = "MZF";
                        $correo_residente = "jesus_valdez@grupocavi.com.mx";
                        $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Proyecto San Julián") {
                        $fol_ob = "PSJ";
                        $correo_residente = "eduardo_gonzalez@grupocavi.com.mx";
                        $correo_gerob = "moises_fernandez@grupocavi.com.mx";
                    } else if ($obra == "Reclutamiento") {
                        $fol_ob = "REC";
                        $correo_residente = "";
                        $correo_gerob = "";
                    } else if ($obra == "Sabinas") {
                        $fol_ob = "SAB";
                        $correo_residente = "francisco_borjon@grupocavi.com.mx";
                        $correo_gerob = "moises_fernandez@grupocavi.com.mx";
                    } else if ($obra == "Saucito") {
                        $fol_ob = "SAU";
                        $correo_residente = "javier_favela@grupocavi.com.mx";
                        $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos") {
                        $fol_ob = "SPP";
                        $correo_residente = "adolfo_flores@grupocavi.com.mx";
                        $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Sucursal MyT Transporte Especial") {
                        $fol_ob = "TES";
                        $correo_residente = "jaime_vela@grupocavi.com.mx";
                        $correo_gerob = "luisadrian_castrejon@grupocavi.com.mx";
                    } else if ($obra == "Tocayos Agosto 2019") {
                        $fol_ob = "TOC";
                        $correo_residente = "eric_aldaba@grupocavi.com.mx";
                        $correo_gerob = "vinicio_bustos@grupocavi.com.mx";
                    } else if ($_SESSION['obra'] == "Juanicipio") {
                        $fol_ob = "JNC";
                        $correo_residente = "carlos_castrejon@grupocavi.com.mx";
                        $correo_gerob = "arturo_castrejon@grupocavi.com.mx";
                    } else {
                        $fol_ob = $_GET['acronimo'];
                    }
                    $fecha_hoy = new DateTime('now', new DateTimeZone('America/Mazatlan'));
                    $date = $fecha_hoy->format('Y-m-d');
                    $query = "UPDATE epp_ex SET autorizado_gerseg='Autorizado',observaciones_gerseg='" . $_POST["observaciones_gerseg"] . "',fecha_autorizado_gerseg='" . $date . "' WHERE folio ='" . $_POST["folio"] . "'";
                    $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                    echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                    location.href='historial_ex?id=tw_redireccion';
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
                    $mail->Body = "<h2>|  Nuevo Pedido de EPP Extraordinario|</h2><br><p>Estimada Director de Operaciones:</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

                    if (!$mail->Send()) {
                        echo "Fallo";
                    }
                } else if (isset($_POST["aut2g"])) {
                    $fecha_hoy = new DateTime('now', new DateTimeZone('America/Mazatlan'));
                    $date = $fecha_hoy->format('Y-m-d');
                    $query = "UPDATE epp_ex SET autorizado_gerseg='No autorizado',autorizado_residente='No autorizado',autorizado_sasst='No autorizado',observaciones_gerseg='" . $_POST["observaciones_gerseg"] . "',fecha_autorizado_gerseg='" . $date . "' WHERE folio ='" . $_POST["folio"] . "'";
                    $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                    echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                    location.href='historial_ex?id=tw_redireccion';
                            </script>";
                } else {
                    $id_pedido = $_GET['id_pedido'];
                    $sql_query = "SELECT * FROM epp_ex WHERE id='" . $id_pedido . "'";
                    $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());
                    if (mysql_num_rows($resultado) > 0) {
                        while ($Rs = mysql_fetch_array($resultado)) {
                            if ($_SESSION['user_epp'] == "sup") {
                ?>
                                <form action="modificar_ex" method="post">
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label blue-distinct"><i>Folio</i></label>
                                            <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?> ">
                                        </div>
                                        <div class="col-xs-5">
                                            <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                            <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label blue-distinct"><i>Motivo</i></label>
                                            <select name='motivo' class='form-control input-sm'>
                                                <option selected><?php echo $Rs['motivo']; ?></option>
                                                <option value="EPP Alto Costo">EPP Alto Costo</option>
                                                <option value="Necesidad de Obra">Necesidad de Obra</option>
                                                <option value="Solicitud del Cliente">Solicitud del Cliente</option>
                                                <option value="Termino EPP Trimestral">Termino EPP Trimestral</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label blue-distinct"><i>Obra</i></label>
                                            <select name='obra' class='form-control input-sm' readonly>
                                                <option selected><?php echo $Rs['obra']; ?></option>
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
                                        <div class="col-xs-5">
                                            <label class="control-label blue-distinct"><i>Justificación</i></label>
                                            <input name="justificacion" type="text" class="form-control input-sm" value="<?php echo $Rs['justificacion']; ?>">
                                        </div>
                                    </div>
                                    <br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant1" value="<?php echo $Rs['cant1']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo1" value="<?php echo $Rs['equipo1']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo1" value="<?php echo $Rs['codigo1']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca1" value="<?php echo $Rs['marca1']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre1" value="<?php echo $Rs['nombre1']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato1' class='form-control input-sm resaltado' disabled id="contrato1">
                                                <option selected><?php echo $Rs['contrato1']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio1" id="precio1" readonly value="<?php echo $Rs['precio1']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones1" id="observaciones1" readonly value="<?php echo $Rs['observaciones1']; ?>">
                                        </div>
                                    </div><br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant2" value="<?php echo $Rs['cant2']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo2" value="<?php echo $Rs['equipo2']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo2" value="<?php echo $Rs['codigo2']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca2" value="<?php echo $Rs['marca2']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre2" value="<?php echo $Rs['nombre2']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato2' class='form-control input-sm resaltado' disabled id="contrato2">
                                                <option selected><?php echo $Rs['contrato2']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio2" id="precio2" readonly value="<?php echo $Rs['precio2']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones2" id="observaciones2" readonly value="<?php echo $Rs['observaciones2']; ?>">
                                        </div>
                                    </div><br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant3" value="<?php echo $Rs['cant3']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo3" value="<?php echo $Rs['equipo3']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo3" value="<?php echo $Rs['codigo3']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca3" value="<?php echo $Rs['marca3']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre3" value="<?php echo $Rs['nombre3']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato3' class='form-control input-sm resaltado' disabled id="contrato3">
                                                <option selected><?php echo $Rs['contrato3']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio3" id="precio3" readonly value="<?php echo $Rs['precio3']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones3" id="observaciones3" readonly value="<?php echo $Rs['observaciones3']; ?>">
                                        </div>
                                    </div><br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant4" value="<?php echo $Rs['cant4']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo4" value="<?php echo $Rs['equipo4']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo4" value="<?php echo $Rs['codigo4']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca4" value="<?php echo $Rs['marca4']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre4" value="<?php echo $Rs['nombre4']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato4' class='form-control input-sm resaltado' disabled id="contrato4">
                                                <option selected><?php echo $Rs['contrato4']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio4" id="precio4" readonly value="<?php echo $Rs['precio4']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones4" id="observaciones4" readonly value="<?php echo $Rs['observaciones4']; ?>">
                                        </div>
                                    </div><br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant5" value="<?php echo $Rs['cant5']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo5" value="<?php echo $Rs['equipo5']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo5" value="<?php echo $Rs['codigo5']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca5" value="<?php echo $Rs['marca5']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre5" value="<?php echo $Rs['nombre5']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato5' class='form-control input-sm resaltado' disabled id="contrato5">
                                                <option selected><?php echo $Rs['contrato5']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio5" id="precio5" readonly value="<?php echo $Rs['precio5']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones5" id="observaciones5" readonly value="<?php echo $Rs['observaciones5']; ?>">
                                        </div>
                                    </div><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Supervisor</label>
                                            <textarea name="observaciones_sup" class="form-control "><?php echo $Rs['observaciones_sup']; ?> </textarea>
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Residente</label>
                                            <textarea name="observaciones_res" class="form-control " readonly><?php echo $Rs['observaciones_res']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones SASST</label>
                                            <textarea name="observaciones_sasst" class="form-control " readonly><?php echo $Rs['observaciones_sasst']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Gerencia de Seguridad</label>
                                            <textarea name="observaciones_gerseg" class="form-control " readonly><?php echo $Rs['observaciones_gerseg']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Director de Operaciones</label>
                                            <textarea name="observaciones_gerob" class="form-control " readonly><?php echo $Rs['observaciones_gerob']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Dirección</label>
                                            <textarea name="observaciones_dir" class="form-control " readonly><?php echo $Rs['observaciones_dir']; ?> </textarea>
                                        </div>
                                    </div><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-5">
                                        </div>
                                        <div id="btn-form" class="col-xs-2">
                                            <input class="btn form-btn btn-primary" type="submit" name="submit" value="Modificar Pedido">
                                        </div>
                                    </div>
                                </form>
                            <?php
                            }
                            if ($_SESSION['user_epp'] == "sasst") { ?>
                                <form action="modificar_ex" method="post" enctype="multipart/form-data">
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label blue-distinct"><i>Folio</i></label>
                                            <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?> ">
                                        </div>
                                        <div class="col-xs-5">
                                            <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                            <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label blue-distinct"><i>Motivo</i></label>
                                            <select name='motivo' class='form-control input-sm' disabled>
                                                <option selected><?php echo $Rs['motivo']; ?></option>
                                                <option value="EPP Alto Costo">EPP Alto Costo</option>
                                                <option value="Necesidad de Obra">Necesidad de Obra</option>
                                                <option value="Solicitud del Cliente">Solicitud del Cliente</option>
                                                <option value="Termino EPP Trimestral">Termino EPP Trimestral</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label blue-distinct"><i>Obra</i></label>
                                            <select name='obral' class='form-control input-sm' readonly>
                                                <option selected><?php echo $Rs['obra']; ?></option>
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
                                        <div class="col-xs-5">
                                            <label class="control-label blue-distinct"><i>Justificación</i></label>
                                            <input name="justificacion" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['justificacion']; ?>">
                                        </div>
                                    </div>
                                    <br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant1" disabled value="<?php echo $Rs['cant1']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo1" disabled value="<?php echo $Rs['equipo1']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo1" disabled value="<?php echo $Rs['codigo1']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca1" disabled value="<?php echo $Rs['marca1']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre1" disabled value="<?php echo $Rs['nombre1']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato1' class='form-control input-sm resaltado' disabled id="contrato1">
                                                <option selected><?php echo $Rs['contrato1']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio1" id="precio1" readonly value="<?php echo $Rs['precio1']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones1" id="observaciones1" readonly value="<?php echo $Rs['observaciones1']; ?>">
                                        </div>
                                    </div><br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant2" disabled value="<?php echo $Rs['cant2']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo2" disabled value="<?php echo $Rs['equipo2']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo2" disabled value="<?php echo $Rs['codigo2']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca2" disabled value="<?php echo $Rs['marca2']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre2" disabled value="<?php echo $Rs['nombre2']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato2' class='form-control input-sm resaltado' disabled id="contrato2">
                                                <option selected><?php echo $Rs['contrato2']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio2" id="precio2" readonly value="<?php echo $Rs['precio2']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones2" id="observaciones2" readonly value="<?php echo $Rs['observaciones2']; ?>">
                                        </div>
                                    </div><br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant3" disabled value="<?php echo $Rs['cant3']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo3" disabled value="<?php echo $Rs['equipo3']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo3" disabled value="<?php echo $Rs['codigo3']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca3" disabled value="<?php echo $Rs['marca3']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre3" disabled value="<?php echo $Rs['nombre3']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato3' class='form-control input-sm resaltado' disabled id="contrato3">
                                                <option selected><?php echo $Rs['contrato3']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio3" id="precio3" readonly value="<?php echo $Rs['precio3']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones3" id="observaciones3" readonly value="<?php echo $Rs['observaciones3']; ?>">
                                        </div>
                                    </div><br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant4" disabled value="<?php echo $Rs['cant4']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo4" disabled value="<?php echo $Rs['equipo4']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo4" disabled value="<?php echo $Rs['codigo4']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca4" disabled value="<?php echo $Rs['marca4']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre4" disabled value="<?php echo $Rs['nombre4']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato4' class='form-control input-sm resaltado' disabled id="contrato4">
                                                <option selected><?php echo $Rs['contrato4']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio4" id="precio4" readonly value="<?php echo $Rs['precio4']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones4" id="observaciones4" readonly value="<?php echo $Rs['observaciones4']; ?>">
                                        </div>
                                    </div><br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant5" disabled value="<?php echo $Rs['cant5']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo5" disabled value="<?php echo $Rs['equipo5']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo5" disabled value="<?php echo $Rs['codigo5']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca5" disabled value="<?php echo $Rs['marca5']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre5" disabled value="<?php echo $Rs['nombre5']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato5' class='form-control input-sm resaltado' disabled id="contrato5">
                                                <option selected><?php echo $Rs['contrato5']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio5" id="precio5" readonly value="<?php echo $Rs['precio5']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones5" id="observaciones5" readonly value="<?php echo $Rs['observaciones5']; ?>">
                                        </div>
                                    </div><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Supervisor</label>
                                            <textarea name="observaciones_sup" class="form-control " readonly><?php echo $Rs['observaciones_sup']; ?> </textarea>
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Residente</label>
                                            <textarea name="observaciones_res" class="form-control " readonly><?php echo $Rs['observaciones_res']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones SASST</label>
                                            <textarea name="observaciones_sasst" class="form-control "><?php echo $Rs['observaciones_sasst']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal" style="text-align:center;">
                                        <div class="col-xs-4"></div>
                                        <div class="col-xs-4">
                                            <label class="control-label">Adjuntar oficios</label>
                                            <input class="form-control input-sm" type="file" name="adjuntos" accept=".pdf">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Gerencia de Seguridad</label>
                                            <textarea name="observaciones_gerseg" class="form-control " readonly><?php echo $Rs['observaciones_gerseg']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Director de Operaciones</label>
                                            <textarea name="observaciones_gerob" class="form-control " readonly><?php echo $Rs['observaciones_gerob']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Dirección</label>
                                            <textarea name="observaciones_dir" class="form-control " readonly><?php echo $Rs['observaciones_dir']; ?> </textarea>
                                        </div>
                                    </div><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="btn form-btn btn-success" type="submit" name="aut1s" value="Autorizar">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="btn form-btn btn-danger" type="submit" name="aut2s" value="No autorizar">
                                        </div>
                                    </div>
                                </form>
                            <?php } else if ($_SESSION['user_epp'] == "gerseg") { ?>

                                <form action="modificar_ex" method="post">
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label blue-distinct"><i>Folio</i></label>
                                            <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?> ">
                                        </div>
                                        <div class="col-xs-5">
                                            <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                            <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label blue-distinct"><i>Motivo</i></label>
                                            <select name='motivo' class='form-control input-sm' disabled>
                                                <option selected><?php echo $Rs['motivo']; ?></option>
                                                <option value="EPP Alto Costo">EPP Alto Costo</option>
                                                <option value="Necesidad de Obra">Necesidad de Obra</option>
                                                <option value="Solicitud del Cliente">Solicitud del Cliente</option>
                                                <option value="Termino EPP Trimestral">Termino EPP Trimestral</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label blue-distinct"><i>Obra</i></label>
                                            <select name='obrag' class='form-control input-sm' readonly>
                                                <option selected><?php echo $Rs['obra']; ?></option>
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
                                        <div class="col-xs-5">
                                            <label class="control-label blue-distinct"><i>Justificación</i></label>
                                            <input name="justificacion" type="text" class="form-control input-sm" disabled value="<?php echo $Rs['justificacion']; ?>">
                                        </div>
                                    </div>
                                    <br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant1" disabled value="<?php echo $Rs['cant1']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo1" disabled value="<?php echo $Rs['equipo1']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo1" disabled value="<?php echo $Rs['codigo1']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca1" disabled value="<?php echo $Rs['marca1']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre1" disabled value="<?php echo $Rs['nombre1']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato1' class='form-control input-sm resaltado' disabled id="contrato1">
                                                <option selected><?php echo $Rs['contrato1']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio1" id="precio1" readonly value="<?php echo $Rs['precio1']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones1" id="observaciones1" readonly value="<?php echo $Rs['observaciones1']; ?>">
                                        </div>
                                    </div><br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant2" disabled value="<?php echo $Rs['cant2']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo2" disabled value="<?php echo $Rs['equipo2']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo2" disabled value="<?php echo $Rs['codigo2']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca2" disabled value="<?php echo $Rs['marca2']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre2" disabled value="<?php echo $Rs['nombre2']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato2' class='form-control input-sm resaltado' disabled id="contrato2">
                                                <option selected><?php echo $Rs['contrato2']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio2" id="precio2" readonly value="<?php echo $Rs['precio2']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones2" id="observaciones2" readonly value="<?php echo $Rs['observaciones2']; ?>">
                                        </div>
                                    </div><br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant3" disabled value="<?php echo $Rs['cant3']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo3" disabled value="<?php echo $Rs['equipo3']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo3" disabled value="<?php echo $Rs['codigo3']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca3" disabled value="<?php echo $Rs['marca3']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre3" disabled value="<?php echo $Rs['nombre3']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato3' class='form-control input-sm resaltado' disabled id="contrato3">
                                                <option selected><?php echo $Rs['contrato3']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio3" id="precio3" readonly value="<?php echo $Rs['precio3']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones3" id="observaciones3" readonly value="<?php echo $Rs['observaciones3']; ?>">
                                        </div>
                                    </div><br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant4" disabled value="<?php echo $Rs['cant4']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo4" disabled value="<?php echo $Rs['equipo4']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo4" disabled value="<?php echo $Rs['codigo4']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca4" disabled value="<?php echo $Rs['marca4']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre4" disabled value="<?php echo $Rs['nombre4']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato4' class='form-control input-sm resaltado' disabled id="contrato4">
                                                <option selected><?php echo $Rs['contrato4']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio4" id="precio4" readonly value="<?php echo $Rs['precio4']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones4" id="observaciones4" readonly value="<?php echo $Rs['observaciones4']; ?>">
                                        </div>
                                    </div><br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad (pzas/par)</label>
                                            <input class="form-control input-sm" type="text" name="cant5" disabled value="<?php echo $Rs['cant5']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Equipo</label>
                                            <input class="form-control input-sm" type="text" name="equipo5" disabled value="<?php echo $Rs['equipo5']; ?>" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo5" disabled value="<?php echo $Rs['codigo5']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca5" disabled value="<?php echo $Rs['marca5']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label">Nombre a quien se le asigna</label>
                                            <input class="form-control input-sm" type="text" name="nombre5" disabled value="<?php echo $Rs['nombre5']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">¿Dentro de Contrato?</label>
                                            <select name='contrato5' class='form-control input-sm resaltado' disabled id="contrato5">
                                                <option selected><?php echo $Rs['contrato5']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio5" id="precio5" readonly value="<?php echo $Rs['precio5']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones5" id="observaciones5" readonly value="<?php echo $Rs['observaciones5']; ?>">
                                        </div>
                                    </div><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-5">
                                        </div>
                                        <?php $adj = "./adjuntos/" . $Rs['adjuntos']; ?>
                                        <div class="col-xs-4"><a class='btn form-btn btn-primary glyphicon glyphicon-paperclip' href=<?php echo $adj; ?> target="_blank"> ADJUNTOS</a></div>
                                    </div><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Supervisor</label>
                                            <textarea name="observaciones_sup" class="form-control " readonly><?php echo $Rs['observaciones_sup']; ?> </textarea>
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Residente</label>
                                            <textarea name="observaciones_res" class="form-control " readonly><?php echo $Rs['observaciones_res']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones SASST</label>
                                            <textarea name="observaciones_sasst" class="form-control " readonly><?php echo $Rs['observaciones_sasst']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Gerencia de Seguridad</label>
                                            <textarea name="observaciones_gerseg" class="form-control "><?php echo $Rs['observaciones_gerseg']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Director de Operaciones</label>
                                            <textarea name="observaciones_gerob" class="form-control " readonly><?php echo $Rs['observaciones_gerob']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Dirección</label>
                                            <textarea name="observaciones_dir" class="form-control " readonly><?php echo $Rs['observaciones_dir']; ?> </textarea>
                                        </div>
                                    </div><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="btn form-btn btn-success" type="submit" name="aut1g" value="Autorizar">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="btn form-btn btn-danger" type="submit" name="aut2g" value="No autorizar">
                                        </div>
                                    </div>
                                </form>
                <?php }
                        }
                    } else {
                        echo "<script languaje='javascript'>
									alert('No fue posible realizar la operacion solicitada al pedido con ID" . $id_pedido . "')
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