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
                                <li><a href="historial_ni">Nuevo Ingreso</a></li>
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
                    <p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido " . ucwords($_SESSION['usuario']) . " | "; ?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
                </ul>
            </div>
        </nav>
        <div class="panel panel-default" style="margin-top: 5px;">
            <div align="center" class="panel-heading">Modificar Pedido Trimestral de EPP</div>
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
                    } else {
                        $fol_ob = $_GET['acronimo'];
                    }

                    $query = "UPDATE epp_tr SET empresa='" . $_POST["empresa"] . "',
                        cant_unid1='" . $_POST["cant_unid1"] . "', desc1='" . $_POST["desc1"] . "',codigo1='" . $_POST["codigo1"] . "',
                        marca1='" . $_POST["marca1"] . "',color1='" . $_POST["color1"] . "',medidas1='" . $_POST["medidas1"] . "', 
                        cant_unid2='" . $_POST["cant_unid2"] . "', desc2='" . $_POST["desc2"] . "',codigo2='" . $_POST["codigo2"] . "',
                        marca2='" . $_POST["marca2"] . "',color2='" . $_POST["color2"] . "',medidas2='" . $_POST["medidas2"] . "', 
                        cant_unid3='" . $_POST["cant_unid3"] . "', desc3='" . $_POST["desc3"] . "',codigo3='" . $_POST["codigo3"] . "',
                        marca3='" . $_POST["marca3"] . "',color3='" . $_POST["color3"] . "',medidas3='" . $_POST["medidas3"] . "', 
                        cant_unid4='" . $_POST["cant_unid4"] . "', desc4='" . $_POST["desc4"] . "',codigo4='" . $_POST["codigo4"] . "',
                        marca4='" . $_POST["marca4"] . "',color4='" . $_POST["color4"] . "',medidas4='" . $_POST["medidas4"] . "', 
                        cant_unid5='" . $_POST["cant_unid5"] . "', desc5='" . $_POST["desc5"] . "',codigo5='" . $_POST["codigo5"] . "',
                        marca5='" . $_POST["marca5"] . "',color5='" . $_POST["color5"] . "',medidas5='" . $_POST["medidas5"] . "', 
                        cant_unid6='" . $_POST["cant_unid6"] . "', desc6='" . $_POST["desc6"] . "',codigo6='" . $_POST["codigo6"] . "',
                        marca6='" . $_POST["marca6"] . "',color6='" . $_POST["color6"] . "',medidas6='" . $_POST["medidas6"] . "', 
                        cant_unid7='" . $_POST["cant_unid7"] . "', desc7='" . $_POST["desc7"] . "',codigo7='" . $_POST["codigo7"] . "',
                        marca7='" . $_POST["marca7"] . "',color7='" . $_POST["color7"] . "',medidas7='" . $_POST["medidas7"] . "', 
                        cant_unid8='" . $_POST["cant_unid8"] . "', desc8='" . $_POST["desc8"] . "',codigo8='" . $_POST["codigo8"] . "',
                        marca8='" . $_POST["marca8"] . "',color8='" . $_POST["color8"] . "',medidas8='" . $_POST["medidas8"] . "', 
                        cant_unid9='" . $_POST["cant_unid9"] . "', desc9='" . $_POST["desc9"] . "',codigo9='" . $_POST["codigo9"] . "',
                        marca9='" . $_POST["marca9"] . "',color9='" . $_POST["color9"] . "',medidas9='" . $_POST["medidas9"] . "', 
                        cant_unid10='" . $_POST["cant_unid10"] . "', desc10='" . $_POST["desc10"] . "',codigo10='" . $_POST["codigo10"] . "',
                        marca10='" . $_POST["marca10"] . "',color10='" . $_POST["color10"] . "',medidas10='" . $_POST["medidas10"] . "', 
                        cant_unid11='" . $_POST["cant_unid11"] . "', desc11='" . $_POST["desc11"] . "',codigo11='" . $_POST["codigo11"] . "',
                        marca11='" . $_POST["marca11"] . "',color11='" . $_POST["color11"] . "',medidas11='" . $_POST["medidas11"] . "', 
                        cant_unid12='" . $_POST["cant_unid12"] . "', desc12='" . $_POST["desc12"] . "',codigo12='" . $_POST["codigo12"] . "',
                        marca12='" . $_POST["marca12"] . "',color12='" . $_POST["color12"] . "',medidas12='" . $_POST["medidas12"] . "', 
                        cant_unid13='" . $_POST["cant_unid13"] . "', desc13='" . $_POST["desc13"] . "',codigo13='" . $_POST["codigo13"] . "',
                        marca13='" . $_POST["marca13"] . "',color13='" . $_POST["color13"] . "',medidas13='" . $_POST["medidas13"] . "', 
                        cant_unid14='" . $_POST["cant_unid14"] . "', desc14='" . $_POST["desc14"] . "',codigo14='" . $_POST["codigo14"] . "',
                        marca14='" . $_POST["marca14"] . "',color14='" . $_POST["color14"] . "',medidas14='" . $_POST["medidas14"] . "', 
                        cant_unid15='" . $_POST["cant_unid15"] . "', desc15='" . $_POST["desc15"] . "',codigo15='" . $_POST["codigo15"] . "',
                        marca15='" . $_POST["marca15"] . "',color15='" . $_POST["color15"] . "',medidas15='" . $_POST["medidas15"] . "', 
                        cant_unid16='" . $_POST["cant_unid16"] . "', desc16='" . $_POST["desc16"] . "',codigo16='" . $_POST["codigo16"] . "',
                        marca16='" . $_POST["marca16"] . "',color16='" . $_POST["color16"] . "',medidas16='" . $_POST["medidas16"] . "', 
                        cant_unid17='" . $_POST["cant_unid17"] . "', desc17='" . $_POST["desc17"] . "',codigo17='" . $_POST["codigo17"] . "',
                        marca17='" . $_POST["marca17"] . "',color17='" . $_POST["color17"] . "',medidas17='" . $_POST["medidas17"] . "', 
                        cant_unid18='" . $_POST["cant_unid18"] . "', desc18='" . $_POST["desc18"] . "',codigo18='" . $_POST["codigo18"] . "',
                        marca18='" . $_POST["marca18"] . "',color18='" . $_POST["color18"] . "',medidas18='" . $_POST["medidas18"] . "', 
                        cant_unid19='" . $_POST["cant_unid19"] . "', desc19='" . $_POST["desc19"] . "',codigo19='" . $_POST["codigo19"] . "',
                        marca19='" . $_POST["marca19"] . "',color19='" . $_POST["color19"] . "',medidas19='" . $_POST["medidas19"] . "', 
                        cant_unid20='" . $_POST["cant_unid20"] . "', desc20='" . $_POST["desc20"] . "',codigo20='" . $_POST["codigo20"] . "',
                        marca20='" . $_POST["marca20"] . "',color20='" . $_POST["color20"] . "',medidas20='" . $_POST["medidas20"] . "',observaciones_sup='" . $_POST["observaciones_sup"] . "'  WHERE folio ='" . $_POST["folio"] . "'";
                    $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                    echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                    location.href='historial_tr?id=tw_redireccion';
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
                    $mail->Body = "<h2>|  Nuevo Pedido de EPP Trimestral|</h2><br><p>Estimado (a) residente de " . $obra . ":</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

                    if (!$mail->Send()) {
                        echo "Fallo";
                    }
                } else if (isset($_POST["aut1s"])) {
                    if ($d <= '27') {
                        $query = "UPDATE epp_tr SET autorizado_almacen='Autorizado',observaciones_almacen='" . $_POST["observaciones_almacen"] . "',fecha_autorizado_almacen='" . $fecha_hoy . "' WHERE folio ='" . $_POST["folio"] . "'";
                        $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                        echo "<script languaje='javascript'>
                                    alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                        location.href='historial_tr?id=tw_redireccion';
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
                        $correo_gerseg = "maricruz_flores@grupocavi.com.mx";
                        $mail->AddAddress($correo_gerseg);

                        $mail->WordWrap = 50;
                        $mail->IsHTML(true);
                        $mail->CharSet = 'UTF-8';
                        $mail->Subject = "Sistema de Pedidos de EPP | GRUPO CAVI";
                        $mail->Body = "<h2>|  Nuevo Pedido de EPP Trimestral|</h2><br><p>Estimada Gerencia de Seguridad:</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                    Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

                        if (!$mail->Send()) {
                            echo "Fallo";
                        }
                    } else {
                        echo "<script languaje='javascript'>
                                  alert('No puede autorizar pedidos fuera de fecha.')
                      location.href='historial_tr?id=tw_redireccion';
                              </script>";
                    }
                } else if (isset($_POST["aut2s"])) {
                    $query = "UPDATE epp_tr SET autorizado_almacen='No autorizado',autorizado_residente='No autorizado',observaciones_almacen='" . $_POST["observaciones_almacen"] . "',fecha_autorizado_almacen='" . $fecha_hoy . "' WHERE folio ='" . $_POST["folio"] . "'";
                    $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                    echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                    location.href='historial_tr?id=tw_redireccion';
                            </script>";
                } else if (isset($_POST["aut1g"])) {

                    if ($d <= '27') {
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
                        $query = "UPDATE epp_tr SET autorizado_gerseg='Autorizado',observaciones_gerseg='" . $_POST["observaciones_gerseg"] . "',fecha_autorizado_gerseg='" . $fecha_hoy . "' WHERE folio ='" . $_POST["folio"] . "'";
                        $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                        echo "<script languaje='javascript'>
                                    alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                        location.href='historial_tr?id=tw_redireccion';
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
                        $mail->Body = "<h2>|  Nuevo Pedido de EPP Trimestral|</h2><br><p>Estimada Director de Operaciones:</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                    Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

                        if (!$mail->Send()) {
                            echo "Fallo";
                        }
                    } else {
                        echo "<script languaje='javascript'>
                                  alert('No puede autorizar pedidos fuera de fecha.')
                      location.href='historial_tr?id=tw_redireccion';
                              </script>";
                    }
                } else if (isset($_POST["aut2g"])) {
                    $query = "UPDATE epp_tr SET autorizado_gerseg='No autorizado',autorizado_almacen='No autorizado',autorizado_residente='No autorizado',observaciones_gerseg='" . $_POST["observaciones_gerseg"] . "',fecha_autorizado_gerseg='" . $fecha_hoy . "' WHERE folio ='" . $_POST["folio"] . "'";
                    $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                    echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                    location.href='historial_tr?id=tw_redireccion';
                            </script>";
                } else {
                    $id_pedido = $_GET['id_pedido'];
                    $sql_query = "SELECT * FROM epp_tr WHERE id='" . $id_pedido . "'";
                    $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());
                    if (mysql_num_rows($resultado) > 0) {
                        while ($Rs = mysql_fetch_array($resultado)) {
                            if ($_SESSION['user_epp'] == "sup") {
                ?>
                                <form action="modificar_tr" method="post">
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label blue-distinct"><i>Folio</i></label>
                                            <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                            <input readonly name="supervisor_sol" type="text" class="form-control input-sm" required value="<?php echo $Rs['supervisor_sol']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="control-label blue-distinct"><i>Empresa</i></label>
                                            <select name='empresa' class='form-control input-sm'>
                                                <option selected><?php echo $Rs['empresa']; ?></option>
                                                <option value="Cavi de Sombrerete S.A. de C.V.">Cavi de Sombrerete S.A. de C.V.</option>
                                                <option value="Concretos Cavi S.A. de C.V.">Concretos Cavi S.A. de C.V.</option>
                                                <option value="Montajes y Estructuras de Zacatecas S.A. de C.V.">Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                                <option value="Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.">Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                            </select>
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
                                    </div>
                                    <br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad Unidad</label>
                                            <input class="form-control input-sm" type="text" name="cant_unid1" value="<?php echo $Rs['cant_unid1']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="control-label">Descripcion</label>
                                            <input class="form-control input-sm" type="text" name="desc1" value="<?php echo $Rs['desc1']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo1" value="<?php echo $Rs['codigo1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca1" value="<?php echo $Rs['marca1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">Color</label>
                                            <input class="form-control input-sm" type="text" name="color1" value="<?php echo $Rs['color1']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Medidas</label>
                                            <input class="form-control input-sm" type="text" name="medidas1" value="<?php echo $Rs['medidas1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">Clase</label>
                                            <input class="form-control input-sm" type="text" name="clase1" value="<?php echo $Rs['clase1']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid2" value="<?php echo $Rs['cant_unid2']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc2" value="<?php echo $Rs['desc2']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo2" value="<?php echo $Rs['codigo2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca2" value="<?php echo $Rs['marca2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color2" value="<?php echo $Rs['color2']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas2" value="<?php echo $Rs['medidas2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase2" value="<?php echo $Rs['clase2']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid3" value="<?php echo $Rs['cant_unid3']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc3" value="<?php echo $Rs['desc3']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo3" value="<?php echo $Rs['codigo3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca3" value="<?php echo $Rs['marca3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color3" value="<?php echo $Rs['color3']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas3" value="<?php echo $Rs['medidas3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase3" value="<?php echo $Rs['clase3']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid4" value="<?php echo $Rs['cant_unid4']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc4" value="<?php echo $Rs['desc4']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo4" value="<?php echo $Rs['codigo4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca4" value="<?php echo $Rs['marca4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color4" value="<?php echo $Rs['color4']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas4" value="<?php echo $Rs['medidas4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase4" value="<?php echo $Rs['clase4']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid5" value="<?php echo $Rs['cant_unid5']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc5" value="<?php echo $Rs['desc5']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo5" value="<?php echo $Rs['codigo5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca5" value="<?php echo $Rs['marca5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color5" value="<?php echo $Rs['color5']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas5" value="<?php echo $Rs['medidas5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase5" value="<?php echo $Rs['clase5']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid6" value="<?php echo $Rs['cant_unid6']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc6" value="<?php echo $Rs['desc6']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo6" value="<?php echo $Rs['codigo6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca6" value="<?php echo $Rs['marca6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color6" value="<?php echo $Rs['color6']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas6" value="<?php echo $Rs['medidas6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase6" value="<?php echo $Rs['clase6']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid7" value="<?php echo $Rs['cant_unid7']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc7" value="<?php echo $Rs['desc7']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo7" value="<?php echo $Rs['codigo7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca7" value="<?php echo $Rs['marca7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color7" value="<?php echo $Rs['color7']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas7" value="<?php echo $Rs['medidas7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase7" value="<?php echo $Rs['clase7']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid8" value="<?php echo $Rs['cant_unid8']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc8" value="<?php echo $Rs['desc8']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo8" value="<?php echo $Rs['codigo8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca8" value="<?php echo $Rs['marca8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color8" value="<?php echo $Rs['color8']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas8" value="<?php echo $Rs['medidas8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase8" value="<?php echo $Rs['clase8']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid9" value="<?php echo $Rs['cant_unid9']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc9" value="<?php echo $Rs['desc9']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo9" value="<?php echo $Rs['codigo9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca9" value="<?php echo $Rs['marca9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color9" value="<?php echo $Rs['color9']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas9" value="<?php echo $Rs['medidas9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase9" value="<?php echo $Rs['clase9']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid10" value="<?php echo $Rs['cant_unid10']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc10" value="<?php echo $Rs['desc10']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo10" value="<?php echo $Rs['codigo10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca10" value="<?php echo $Rs['marca10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color10" value="<?php echo $Rs['color10']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas10" value="<?php echo $Rs['medidas10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase10" value="<?php echo $Rs['clase10']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid11" value="<?php echo $Rs['cant_unid11']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc11" value="<?php echo $Rs['desc11']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo11" value="<?php echo $Rs['codigo11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca11" value="<?php echo $Rs['marca11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color11" value="<?php echo $Rs['color11']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas11" value="<?php echo $Rs['medidas11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase11" value="<?php echo $Rs['clase11']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid12" value="<?php echo $Rs['cant_unid12']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc12" value="<?php echo $Rs['desc12']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo12" value="<?php echo $Rs['codigo12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca12" value="<?php echo $Rs['marca12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color12" value="<?php echo $Rs['color12']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas12" value="<?php echo $Rs['medidas12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase12" value="<?php echo $Rs['clase12']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid13" value="<?php echo $Rs['cant_unid13']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc13" value="<?php echo $Rs['desc13']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo13" value="<?php echo $Rs['codigo13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca13" value="<?php echo $Rs['marca13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color13" value="<?php echo $Rs['color13']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas13" value="<?php echo $Rs['medidas13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase13" value="<?php echo $Rs['clase13']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid14" value="<?php echo $Rs['cant_unid14']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc14" value="<?php echo $Rs['desc14']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo14" value="<?php echo $Rs['codigo14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca14" value="<?php echo $Rs['marca14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color14" value="<?php echo $Rs['color14']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas14" value="<?php echo $Rs['medidas14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase14" value="<?php echo $Rs['clase14']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid15" value="<?php echo $Rs['cant_unid15']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc15" value="<?php echo $Rs['desc15']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo15" value="<?php echo $Rs['codigo15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca15" value="<?php echo $Rs['marca15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color15" value="<?php echo $Rs['color15']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas15" value="<?php echo $Rs['medidas15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase15" value="<?php echo $Rs['clase15']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid16" value="<?php echo $Rs['cant_unid16']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc16" value="<?php echo $Rs['desc16']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo16" value="<?php echo $Rs['codigo16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca16" value="<?php echo $Rs['marca16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color16" value="<?php echo $Rs['color16']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas16" value="<?php echo $Rs['medidas16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase16" value="<?php echo $Rs['clase16']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid17" value="<?php echo $Rs['cant_unid17']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc17" value="<?php echo $Rs['desc17']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo17" value="<?php echo $Rs['codigo17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca17" value="<?php echo $Rs['marca17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color17" value="<?php echo $Rs['color17']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas17" value="<?php echo $Rs['medidas17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase17" value="<?php echo $Rs['clase17']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid18" value="<?php echo $Rs['cant_unid18']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc18" value="<?php echo $Rs['desc18']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo18" value="<?php echo $Rs['codigo18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca18" value="<?php echo $Rs['marca18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color18" value="<?php echo $Rs['color18']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas18" value="<?php echo $Rs['medidas18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase18" value="<?php echo $Rs['clase18']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid19" value="<?php echo $Rs['cant_unid19']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc19" value="<?php echo $Rs['desc19']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo19" value="<?php echo $Rs['codigo19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca19" value="<?php echo $Rs['marca19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color19" value="<?php echo $Rs['color19']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas19" value="<?php echo $Rs['medidas19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase19" value="<?php echo $Rs['clase19']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid20" value="<?php echo $Rs['cant_unid20']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc20" value="<?php echo $Rs['desc20']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo20" value="<?php echo $Rs['codigo20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca20" value="<?php echo $Rs['marca20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color20" value="<?php echo $Rs['color20']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas20" value="<?php echo $Rs['medidas20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase20" value="<?php echo $Rs['clase20']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Supervisor</label>
                                            <textarea name="observaciones_sup" class="form-control "><?php echo $Rs['observaciones_sup']; ?></textarea>
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
                                            <label class="control-label">Observaciones Almacén</label>
                                            <textarea name="observaciones_almacen" class="form-control " readonly><?php echo $Rs['observaciones_almacen']; ?> </textarea>
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
                            if ($_SESSION['user_epp'] == "alm") { ?>
                                <form action="modificar_tr" method="post">
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label blue-distinct"><i>Folio</i></label>
                                            <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                            <input readonly name="supervisor_sol" type="text" class="form-control input-sm" required value="<?php echo $Rs['supervisor_sol']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="control-label blue-distinct"><i>Empresa</i></label>
                                            <select name='empresa' class='form-control input-sm' disabled>
                                                <option selected><?php echo $Rs['empresa']; ?></option>
                                                <option value="Cavi de Sombrerete S.A. de C.V.">Cavi de Sombrerete S.A. de C.V.</option>
                                                <option value="Concretos Cavi S.A. de C.V.">Concretos Cavi S.A. de C.V.</option>
                                                <option value="Montajes y Estructuras de Zacatecas S.A. de C.V.">Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                                <option value="Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.">Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                            </select>
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
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad Unidad</label>
                                            <input class="form-control input-sm" type="text" name="cant_unid1" readonly value="<?php echo $Rs['cant_unid1']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="control-label">Descripcion</label>
                                            <input class="form-control input-sm" type="text" name="desc1" readonly value="<?php echo $Rs['desc1']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo1" readonly value="<?php echo $Rs['codigo1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca1" readonly value="<?php echo $Rs['marca1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">Color</label>
                                            <input class="form-control input-sm" type="text" name="color1" readonly value="<?php echo $Rs['color1']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Medidas</label>
                                            <input class="form-control input-sm" type="text" name="medidas1" readonly value="<?php echo $Rs['medidas1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">Clase</label>
                                            <input class="form-control input-sm" type="text" name="clase1" readonly value="<?php echo $Rs['clase1']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid2" readonly value="<?php echo $Rs['cant_unid2']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc2" readonly value="<?php echo $Rs['desc2']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo2" readonly value="<?php echo $Rs['codigo2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca2" readonly value="<?php echo $Rs['marca2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color2" readonly value="<?php echo $Rs['color2']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas2" readonly value="<?php echo $Rs['medidas2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase2" readonly value="<?php echo $Rs['clase2']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid3" readonly value="<?php echo $Rs['cant_unid3']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc3" readonly value="<?php echo $Rs['desc3']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo3" readonly value="<?php echo $Rs['codigo3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca3" readonly value="<?php echo $Rs['marca3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color3" readonly value="<?php echo $Rs['color3']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas3" readonly value="<?php echo $Rs['medidas3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase3" readonly value="<?php echo $Rs['clase3']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid4" readonly value="<?php echo $Rs['cant_unid4']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc4" readonly value="<?php echo $Rs['desc4']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo4" readonly value="<?php echo $Rs['codigo4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca4" readonly value="<?php echo $Rs['marca4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color4" readonly value="<?php echo $Rs['color4']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas4" readonly value="<?php echo $Rs['medidas4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase4" readonly value="<?php echo $Rs['clase4']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid5" readonly value="<?php echo $Rs['cant_unid5']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc5" readonly value="<?php echo $Rs['desc5']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo5" readonly value="<?php echo $Rs['codigo5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca5" readonly value="<?php echo $Rs['marca5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color5" readonly value="<?php echo $Rs['color5']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas5" readonly value="<?php echo $Rs['medidas5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase5" readonly value="<?php echo $Rs['clase5']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid6" readonly value="<?php echo $Rs['cant_unid6']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc6" readonly value="<?php echo $Rs['desc6']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo6" readonly value="<?php echo $Rs['codigo6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca6" readonly value="<?php echo $Rs['marca6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color6" readonly value="<?php echo $Rs['color6']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas6" readonly value="<?php echo $Rs['medidas6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase6" readonly value="<?php echo $Rs['clase6']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid7" readonly value="<?php echo $Rs['cant_unid7']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc7" readonly value="<?php echo $Rs['desc7']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo7" readonly value="<?php echo $Rs['codigo7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca7" readonly value="<?php echo $Rs['marca7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color7" readonly value="<?php echo $Rs['color7']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas7" readonly value="<?php echo $Rs['medidas7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase7" readonly value="<?php echo $Rs['clase7']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid8" readonly value="<?php echo $Rs['cant_unid8']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc8" readonly value="<?php echo $Rs['desc8']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo8" readonly value="<?php echo $Rs['codigo8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca8" readonly value="<?php echo $Rs['marca8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color8" readonly value="<?php echo $Rs['color8']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas8" readonly value="<?php echo $Rs['medidas8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase8" readonly value="<?php echo $Rs['clase8']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid9" readonly value="<?php echo $Rs['cant_unid9']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc9" readonly value="<?php echo $Rs['desc9']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo9" readonly value="<?php echo $Rs['codigo9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca9" readonly value="<?php echo $Rs['marca9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color9" readonly value="<?php echo $Rs['color9']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas9" readonly value="<?php echo $Rs['medidas9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase9" readonly value="<?php echo $Rs['clase9']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid10" readonly value="<?php echo $Rs['cant_unid10']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc10" readonly value="<?php echo $Rs['desc10']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo10" readonly value="<?php echo $Rs['codigo10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca10" readonly value="<?php echo $Rs['marca10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color10" readonly value="<?php echo $Rs['color10']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas10" readonly value="<?php echo $Rs['medidas10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase10" readonly value="<?php echo $Rs['clase10']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid11" readonly value="<?php echo $Rs['cant_unid11']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc11" readonly value="<?php echo $Rs['desc11']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo11" readonly value="<?php echo $Rs['codigo11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca11" readonly value="<?php echo $Rs['marca11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color11" readonly value="<?php echo $Rs['color11']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas11" readonly value="<?php echo $Rs['medidas11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase11" readonly value="<?php echo $Rs['clase11']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid12" readonly value="<?php echo $Rs['cant_unid12']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc12" readonly value="<?php echo $Rs['desc12']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo12" readonly value="<?php echo $Rs['codigo12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca12" readonly value="<?php echo $Rs['marca12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color12" readonly value="<?php echo $Rs['color12']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas12" readonly value="<?php echo $Rs['medidas12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase12" readonly value="<?php echo $Rs['clase12']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid13" readonly value="<?php echo $Rs['cant_unid13']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc13" readonly value="<?php echo $Rs['desc13']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo13" readonly value="<?php echo $Rs['codigo13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca13" readonly value="<?php echo $Rs['marca13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color13" readonly value="<?php echo $Rs['color13']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas13" readonly value="<?php echo $Rs['medidas13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase13" readonly value="<?php echo $Rs['clase13']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid14" readonly value="<?php echo $Rs['cant_unid14']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc14" readonly value="<?php echo $Rs['desc14']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo14" readonly value="<?php echo $Rs['codigo14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca14" readonly value="<?php echo $Rs['marca14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color14" readonly value="<?php echo $Rs['color14']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas14" readonly value="<?php echo $Rs['medidas14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase14" readonly value="<?php echo $Rs['clase14']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid15" readonly value="<?php echo $Rs['cant_unid15']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc15" readonly value="<?php echo $Rs['desc15']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo15" readonly value="<?php echo $Rs['codigo15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca15" readonly value="<?php echo $Rs['marca15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color15" readonly value="<?php echo $Rs['color15']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas15" readonly value="<?php echo $Rs['medidas15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase15" readonly value="<?php echo $Rs['clase15']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid16" readonly value="<?php echo $Rs['cant_unid16']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc16" readonly value="<?php echo $Rs['desc16']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo16" readonly value="<?php echo $Rs['codigo16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca16" readonly value="<?php echo $Rs['marca16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color16" readonly value="<?php echo $Rs['color16']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas16" readonly value="<?php echo $Rs['medidas16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase16" readonly value="<?php echo $Rs['clase16']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid17" readonly value="<?php echo $Rs['cant_unid17']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc17" readonly value="<?php echo $Rs['desc17']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo17" readonly value="<?php echo $Rs['codigo17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca17" readonly value="<?php echo $Rs['marca17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color17" readonly value="<?php echo $Rs['color17']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas17" readonly value="<?php echo $Rs['medidas17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase17" readonly value="<?php echo $Rs['clase17']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid18" readonly value="<?php echo $Rs['cant_unid18']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc18" readonly value="<?php echo $Rs['desc18']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo18" readonly value="<?php echo $Rs['codigo18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca18" readonly value="<?php echo $Rs['marca18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color18" readonly value="<?php echo $Rs['color18']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas18" readonly value="<?php echo $Rs['medidas18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase18" readonly value="<?php echo $Rs['clase18']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid19" readonly value="<?php echo $Rs['cant_unid19']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc19" readonly value="<?php echo $Rs['desc19']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo19" readonly value="<?php echo $Rs['codigo19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca19" readonly value="<?php echo $Rs['marca19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color19" readonly value="<?php echo $Rs['color19']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas19" readonly value="<?php echo $Rs['medidas19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase19" readonly value="<?php echo $Rs['clase19']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid20" readonly value="<?php echo $Rs['cant_unid20']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc20" readonly value="<?php echo $Rs['desc20']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo20" readonly value="<?php echo $Rs['codigo20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca20" readonly value="<?php echo $Rs['marca20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color20" readonly value="<?php echo $Rs['color20']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas20" readonly value="<?php echo $Rs['medidas20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase20" readonly value="<?php echo $Rs['clase20']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones</label>
                                            <textarea name="observaciones_sup" class="form-control " readonly><?php echo $Rs['observaciones_sup']; ?></textarea>
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
                                            <label class="control-label">Observaciones Almacén</label>
                                            <textarea name="observaciones_almacen" class="form-control "><?php echo $Rs['observaciones_almacen']; ?> </textarea>
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

                                <form action="modificar_tr" method="post">
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label blue-distinct"><i>Folio</i></label>
                                            <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?>">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                            <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="control-label blue-distinct"><i>Empresa</i></label>
                                            <select name='empresa' class='form-control input-sm' disabled>
                                                <option selected><?php echo $Rs['empresa']; ?></option>
                                                <option value="Cavi de Sombrerete S.A. de C.V.">Cavi de Sombrerete S.A. de C.V.</option>
                                                <option value="Concretos Cavi S.A. de C.V.">Concretos Cavi S.A. de C.V.</option>
                                                <option value="Montajes y Estructuras de Zacatecas S.A. de C.V.">Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                                <option value="Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.">Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                            </select>
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
                                    </div>
                                    <br><br><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label">Cantidad Unidad</label>
                                            <input class="form-control input-sm" type="text" name="cant_unid1" readonly value="<?php echo $Rs['cant_unid1']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="control-label">Descripcion</label>
                                            <input class="form-control input-sm" type="text" name="desc1" readonly value="<?php echo $Rs['desc1']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">Código</label>
                                            <input class="form-control input-sm" type="text" name="codigo1" readonly value="<?php echo $Rs['codigo1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">Marca</label>
                                            <input class="form-control input-sm" type="text" name="marca1" readonly value="<?php echo $Rs['marca1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">Color</label>
                                            <input class="form-control input-sm" type="text" name="color1" readonly value="<?php echo $Rs['color1']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label">Medidas</label>
                                            <input class="form-control input-sm" type="text" name="medidas1" readonly value="<?php echo $Rs['medidas1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">Clase</label>
                                            <input class="form-control input-sm" type="text" name="clase1" readonly value="<?php echo $Rs['clase1']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid2" readonly value="<?php echo $Rs['cant_unid2']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc2" readonly value="<?php echo $Rs['desc2']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo2" readonly value="<?php echo $Rs['codigo2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca2" readonly value="<?php echo $Rs['marca2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color2" readonly value="<?php echo $Rs['color2']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas2" readonly value="<?php echo $Rs['medidas2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase2" readonly value="<?php echo $Rs['clase2']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid3" readonly value="<?php echo $Rs['cant_unid3']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc3" readonly value="<?php echo $Rs['desc3']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo3" readonly value="<?php echo $Rs['codigo3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca3" readonly value="<?php echo $Rs['marca3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color3" readonly value="<?php echo $Rs['color3']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas3" readonly value="<?php echo $Rs['medidas3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase3" readonly value="<?php echo $Rs['clase3']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid4" readonly value="<?php echo $Rs['cant_unid4']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc4" readonly value="<?php echo $Rs['desc4']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo4" readonly value="<?php echo $Rs['codigo4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca4" readonly value="<?php echo $Rs['marca4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color4" readonly value="<?php echo $Rs['color4']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas4" readonly value="<?php echo $Rs['medidas4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase4" readonly value="<?php echo $Rs['clase4']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid5" readonly value="<?php echo $Rs['cant_unid5']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc5" readonly value="<?php echo $Rs['desc5']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo5" readonly value="<?php echo $Rs['codigo5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca5" readonly value="<?php echo $Rs['marca5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color5" readonly value="<?php echo $Rs['color5']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas5" readonly value="<?php echo $Rs['medidas5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase5" readonly value="<?php echo $Rs['clase5']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid6" readonly value="<?php echo $Rs['cant_unid6']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc6" readonly value="<?php echo $Rs['desc6']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo6" readonly value="<?php echo $Rs['codigo6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca6" readonly value="<?php echo $Rs['marca6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color6" readonly value="<?php echo $Rs['color6']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas6" readonly value="<?php echo $Rs['medidas6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase6" readonly value="<?php echo $Rs['clase6']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid7" readonly value="<?php echo $Rs['cant_unid7']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc7" readonly value="<?php echo $Rs['desc7']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo7" readonly value="<?php echo $Rs['codigo7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca7" readonly value="<?php echo $Rs['marca7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color7" readonly value="<?php echo $Rs['color7']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas7" readonly value="<?php echo $Rs['medidas7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase7" readonly value="<?php echo $Rs['clase7']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid8" readonly value="<?php echo $Rs['cant_unid8']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc8" readonly value="<?php echo $Rs['desc8']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo8" readonly value="<?php echo $Rs['codigo8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca8" readonly value="<?php echo $Rs['marca8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color8" readonly value="<?php echo $Rs['color8']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas8" readonly value="<?php echo $Rs['medidas8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase8" readonly value="<?php echo $Rs['clase8']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid9" readonly value="<?php echo $Rs['cant_unid9']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc9" readonly value="<?php echo $Rs['desc9']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo9" readonly value="<?php echo $Rs['codigo9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca9" readonly value="<?php echo $Rs['marca9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color9" readonly value="<?php echo $Rs['color9']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas9" readonly value="<?php echo $Rs['medidas9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase9" readonly value="<?php echo $Rs['clase9']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid10" readonly value="<?php echo $Rs['cant_unid10']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc10" readonly value="<?php echo $Rs['desc10']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo10" readonly value="<?php echo $Rs['codigo10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca10" readonly value="<?php echo $Rs['marca10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color10" readonly value="<?php echo $Rs['color10']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas10" readonly value="<?php echo $Rs['medidas10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase10" readonly value="<?php echo $Rs['clase10']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid11" readonly value="<?php echo $Rs['cant_unid11']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc11" readonly value="<?php echo $Rs['desc11']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo11" readonly value="<?php echo $Rs['codigo11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca11" readonly value="<?php echo $Rs['marca11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color11" readonly value="<?php echo $Rs['color11']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas11" readonly value="<?php echo $Rs['medidas11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase11" readonly value="<?php echo $Rs['clase11']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid12" readonly value="<?php echo $Rs['cant_unid12']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc12" readonly value="<?php echo $Rs['desc12']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo12" readonly value="<?php echo $Rs['codigo12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca12" readonly value="<?php echo $Rs['marca12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color12" readonly value="<?php echo $Rs['color12']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas12" readonly value="<?php echo $Rs['medidas12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase12" readonly value="<?php echo $Rs['clase12']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid13" readonly value="<?php echo $Rs['cant_unid13']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc13" readonly value="<?php echo $Rs['desc13']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo13" readonly value="<?php echo $Rs['codigo13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca13" readonly value="<?php echo $Rs['marca13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color13" readonly value="<?php echo $Rs['color13']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas13" readonly value="<?php echo $Rs['medidas13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase13" readonly value="<?php echo $Rs['clase13']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid14" readonly value="<?php echo $Rs['cant_unid14']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc14" readonly value="<?php echo $Rs['desc14']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo14" readonly value="<?php echo $Rs['codigo14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca14" readonly value="<?php echo $Rs['marca14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color14" readonly value="<?php echo $Rs['color14']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas14" readonly value="<?php echo $Rs['medidas14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase14" readonly value="<?php echo $Rs['clase14']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid15" readonly value="<?php echo $Rs['cant_unid15']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc15" readonly value="<?php echo $Rs['desc15']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo15" readonly value="<?php echo $Rs['codigo15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca15" readonly value="<?php echo $Rs['marca15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color15" readonly value="<?php echo $Rs['color15']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas15" readonly value="<?php echo $Rs['medidas15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase15" readonly value="<?php echo $Rs['clase15']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid16" readonly value="<?php echo $Rs['cant_unid16']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc16" readonly value="<?php echo $Rs['desc16']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo16" readonly value="<?php echo $Rs['codigo16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca16" readonly value="<?php echo $Rs['marca16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color16" readonly value="<?php echo $Rs['color16']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas16" readonly value="<?php echo $Rs['medidas16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase16" readonly value="<?php echo $Rs['clase16']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid17" readonly value="<?php echo $Rs['cant_unid17']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc17" readonly value="<?php echo $Rs['desc17']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo17" readonly value="<?php echo $Rs['codigo17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca17" readonly value="<?php echo $Rs['marca17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color17" readonly value="<?php echo $Rs['color17']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas17" readonly value="<?php echo $Rs['medidas17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase17" readonly value="<?php echo $Rs['clase17']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid18" readonly value="<?php echo $Rs['cant_unid18']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc18" readonly value="<?php echo $Rs['desc18']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo18" readonly value="<?php echo $Rs['codigo18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca18" readonly value="<?php echo $Rs['marca18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color18" readonly value="<?php echo $Rs['color18']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas18" readonly value="<?php echo $Rs['medidas18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase18" readonly value="<?php echo $Rs['clase18']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid19" readonly value="<?php echo $Rs['cant_unid19']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc19" readonly value="<?php echo $Rs['desc19']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo19" readonly value="<?php echo $Rs['codigo19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca19" readonly value="<?php echo $Rs['marca19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color19" readonly value="<?php echo $Rs['color19']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas19" readonly value="<?php echo $Rs['medidas19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase19" readonly value="<?php echo $Rs['clase19']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="cant_unid20" readonly value="<?php echo $Rs['cant_unid20']; ?>">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="desc20" readonly value="<?php echo $Rs['desc20']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="codigo20" readonly value="<?php echo $Rs['codigo20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="marca20" readonly value="<?php echo $Rs['marca20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="color20" readonly value="<?php echo $Rs['color20']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control input-sm" type="text" name="medidas20" readonly value="<?php echo $Rs['medidas20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="clase20" readonly value="<?php echo $Rs['clase20']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones</label>
                                            <textarea name="observaciones_sup" class="form-control " readonly><?php echo $Rs['observaciones_sup']; ?></textarea>
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
                                            <label class="control-label">Observaciones Almacén</label>
                                            <textarea name="observaciones_almacen" class="form-control " readonly><?php echo $Rs['observaciones_almacen']; ?> </textarea>
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