<?php
date_default_timezone_set("Mexico/General");
session_start();
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario'])) {
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
    <title>Insertar EPP</title>
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
                <a class="navbar-brand" href="../../inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <?php if ($_SESSION['user_epp'] == 'sup') {
                        if ($_SESSION['usuario'] == "AYLIN") { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> PCC<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="nuevo_re?acronimo=PCC">Nuevo Reemplazo</a></li>
                                    <li><a href="nuevo_ex?acronimo=PCC">Nuevo Extraordinario</a></li>
                                    <li><a href="nuevo_tr?acronimo=PCC">Nuevo Trimestral</a></li>
                                    <li><a href="nuevo_rc?acronimo=PCC">Nuevo Ropa y Calzado</a></li>
                                </ul>
                            </li>
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
                    <?php } else if ($_SESSION['user_epp'] == 'alm') { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="historial_tr">Trimestral</a></li>
                                <li><a href="historial_rc">Ropa y Calzado</a></li>
                            </ul>
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
                    <?php } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido " . ucwords($_SESSION['usuario']) . " | "; ?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
                </ul>
            </div>
        </nav>
        <div class="panel panel-default" style="margin-top: 5px;">
            <div align="center" class="panel-heading"><?php echo "Insertar Pedido"; ?></div>
            <div class="panel-body">
                <?php
                if ($_POST) {
                    mysql_query("SET NAMES 'UTF8'");
                    mysql_query("SET lc_time_names = 'es_MX'");

                    $supervisor_sol = $_POST['supervisor_sol'];
                    $motivo = $_POST['motivo'];
                    $trabajador = $_POST['trabajador'];
                    $fecha_ingreso = $_POST['fecha_ingreso'];
                    $obra = $_POST['obra'];
                    $categoria = $_POST['categoria'];

                    if (empty($_POST['otro_epp1'])) {
                        $epp1 = $_POST['epp1'];
                    } else {
                        $epp1 = $_POST['otro_epp1'];
                    }
                    $fut_epp1 = $_POST["fut_epp1"];
                    $talla_epp1 = $_POST['talla_epp1'];

                    if (empty($_POST['otro_epp2'])) {
                        $epp2 = $_POST['epp2'];
                    } else {
                        $epp2 = $_POST['otro_epp2'];
                    }
                    $fut_epp2 = $_POST["fut_epp2"];
                    $talla_epp2 = $_POST['talla_epp2'];

                    if (empty($_POST['otro_epp3'])) {
                        $epp3 = $_POST['epp3'];
                    } else {
                        $epp3 = $_POST['otro_epp3'];
                    }
                    $fut_epp3 = $_POST["fut_epp3"];
                    $talla_epp3 = $_POST['talla_epp3'];

                    if (empty($_POST['otro_epp4'])) {
                        $epp4 = $_POST['epp4'];
                    } else {
                        $epp4 = $_POST['otro_epp4'];
                    }
                    $fut_epp4 = $_POST["fut_epp4"];
                    $talla_epp4 = $_POST['talla_epp4'];

                    if (empty($_POST['otro_epp5'])) {
                        $epp5 = $_POST['epp5'];
                    } else {
                        $epp5 = $_POST['otro_epp5'];
                    }
                    $fut_epp5 = $_POST["fut_epp5"];
                    $talla_epp5 = $_POST['talla_epp5'];

                    if (empty($_POST['otro_epp6'])) {
                        $epp6 = $_POST['epp6'];
                    } else {
                        $epp6 = $_POST['otro_epp6'];
                    }
                    $fut_epp6 = $_POST["fut_epp6"];
                    $talla_epp6 = $_POST['talla_epp6'];

                    $observaciones_sup = $_POST["observaciones_sup"];

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
                    }

                    $sql = "INSERT INTO epp_re_folios SET idsdgg='0'";
                    $result = mysql_query($sql) or die(mysql_error());
                    $id = mysql_insert_id();
                    $folio = strtoupper("SH-RE-" . $fol_ob . "-" . str_pad($id, 3, '0', STR_PAD_LEFT) . date("/ y"));

                    $carpeta = "evidencia/";
                    opendir($carpeta);
                    copy($_FILES['foto_ev1']['tmp_name'], $carpeta . $_FILES['foto_ev1']['name']);
                    $foto_ev1 = $_FILES['foto_ev1']['name'];

                    copy($_FILES['foto_ev2']['tmp_name'], $carpeta . $_FILES['foto_ev2']['name']);
                    $foto_ev2 = $_FILES['foto_ev2']['name'];

                    copy($_FILES['foto_ev3']['tmp_name'], $carpeta . $_FILES['foto_ev3']['name']);
                    $foto_ev3 = $_FILES['foto_ev3']['name'];

                    $currentdate = new DateTime('now', new DateTimeZone('America/Mazatlan'));
                    $date = $currentdate->format('Y-m-d');
                    $time = $currentdate->format('H:i:s');
                    $dayOfWeek = date("l", strtotime($date));

                    $splitDate = explode('-', $date);
                    $a = $splitDate[0];

                    $sql = "INSERT INTO epp_re(year,datef,folio,supervisor_sol,motivo,trabajador,fecha_ingreso,obra,categoria,
                        epp1,fut_epp1,talla_epp1,epp2,fut_epp2,talla_epp2,epp3,fut_epp3,talla_epp3,
                        epp4,fut_epp4,talla_epp4,epp5,fut_epp5,talla_epp5,epp6,fut_epp6,talla_epp6,foto_ev1,foto_ev2,
                        foto_ev3,observaciones_sup) VALUES ('" . $a . "','" . $date . "','" . $folio . "','" . $supervisor_sol . "','" . $motivo . "',
                        '" . $trabajador . "','" . $fecha_ingreso . "','" . $obra . "','" . $categoria . "',
                        '" . $epp1 . "','" . $fut_epp1 . "','" . $talla_epp1 . "','" . $epp2 . "','" . $fut_epp2 . "','" . $talla_epp2 . "',
                        '" . $epp3 . "','" . $fut_epp3 . "','" . $talla_epp3 . "','" . $epp4 . "','" . $fut_epp4 . "','" . $talla_epp4 . "',
                        '" . $epp5 . "','" . $fut_epp5 . "','" . $talla_epp5 . "','" . $epp6 . "','" . $fut_epp6 . "','" . $talla_epp6 . "',
                        '" . $foto_ev1 . "','" . $foto_ev2 . "','" . $foto_ev3 . "','" . $observaciones_sup . "')";
                    $result = mysql_query($sql) or die(mysql_error());


                    $sql = "UPDATE epp_re_folios SET folio='" . $folio . "' WHERE id='" . $id . "'";
                    $result = mysql_query($sql) or die(mysql_error());
                    echo "<br>";
                    echo "<br>";
                    echo "<script languaje='javascript'>
                            alert('Se ha enviado el pedido " . $folio . "')
                            location.href='historial_re?id=tw_redireccion';
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
                    $mail->Body = "<h2>|  Nuevo Pedido de EPP Reemplazo|</h2><br><p>Estimado (a) residente de " . $obra . ":</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
					    	Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

                    if (!$mail->Send()) {
                        echo "Fallo";
                    }
                ?>
                    <br>
                    <br>
                <?php
                } else {
                    $resultado = "ERROR DE PROCESO";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
</body>

</html>