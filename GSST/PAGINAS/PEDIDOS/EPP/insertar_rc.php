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
                if ($_POST) {
                    if ($d >= '10' && $d <= '15') {
                        mysql_query("SET NAMES 'UTF8'");
                        mysql_query("SET lc_time_names = 'es_MX'");

                        $supervisor_sol = $_POST['supervisor_sol'];
                        $empresa = $_POST['empresa'];
                        $obra = $_POST['obra'];

                        $nombre1 = $_POST["nombre1"];
                        $talla_overol1 = $_POST["talla_overol1"];
                        $talla_zapato1 = $_POST['talla_zapato1'];
                        $talla_bota1 = $_POST['talla_bota1'];
                        $talla_camisa1 = $_POST['talla_camisa1'];
                        $talla_pantalon1 = $_POST['talla_pantalon1'];
                        $talla_chaleco1 = $_POST['talla_chaleco1'];
                        $talla_bata1 = $_POST['talla_bata1'];

                        $nombre2 = $_POST["nombre2"];
                        $talla_overol2 = $_POST["talla_overol2"];
                        $talla_zapato2 = $_POST['talla_zapato2'];
                        $talla_bota2 = $_POST['talla_bota2'];
                        $talla_camisa2 = $_POST['talla_camisa2'];
                        $talla_pantalon2 = $_POST['talla_pantalon2'];
                        $talla_chaleco2 = $_POST['talla_chaleco2'];
                        $talla_bata2 = $_POST['talla_bata2'];

                        $nombre3 = $_POST["nombre3"];
                        $talla_overol3 = $_POST["talla_overol3"];
                        $talla_zapato3 = $_POST['talla_zapato3'];
                        $talla_bota3 = $_POST['talla_bota3'];
                        $talla_camisa3 = $_POST['talla_camisa3'];
                        $talla_pantalon3 = $_POST['talla_pantalon3'];
                        $talla_chaleco3 = $_POST['talla_chaleco3'];
                        $talla_bata3 = $_POST['talla_bata3'];

                        $nombre4 = $_POST["nombre4"];
                        $talla_overol4 = $_POST["talla_overol4"];
                        $talla_zapato4 = $_POST['talla_zapato4'];
                        $talla_bota4 = $_POST['talla_bota4'];
                        $talla_camisa4 = $_POST['talla_camisa4'];
                        $talla_pantalon4 = $_POST['talla_pantalon4'];
                        $talla_chaleco4 = $_POST['talla_chaleco4'];
                        $talla_bata4 = $_POST['talla_bata4'];

                        $nombre5 = $_POST["nombre5"];
                        $talla_overol5 = $_POST["talla_overol5"];
                        $talla_zapato5 = $_POST['talla_zapato5'];
                        $talla_bota5 = $_POST['talla_bota5'];
                        $talla_camisa5 = $_POST['talla_camisa5'];
                        $talla_pantalon5 = $_POST['talla_pantalon5'];
                        $talla_chaleco5 = $_POST['talla_chaleco5'];
                        $talla_bata5 = $_POST['talla_bata5'];

                        $nombre6 = $_POST["nombre6"];
                        $talla_overol6 = $_POST["talla_overol6"];
                        $talla_zapato6 = $_POST['talla_zapato6'];
                        $talla_bota6 = $_POST['talla_bota6'];
                        $talla_camisa6 = $_POST['talla_camisa6'];
                        $talla_pantalon6 = $_POST['talla_pantalon6'];
                        $talla_chaleco6 = $_POST['talla_chaleco6'];
                        $talla_bata6 = $_POST['talla_bata6'];

                        $nombre7 = $_POST["nombre7"];
                        $talla_overol7 = $_POST["talla_overol7"];
                        $talla_zapato7 = $_POST['talla_zapato7'];
                        $talla_bota7 = $_POST['talla_bota7'];
                        $talla_camisa7 = $_POST['talla_camisa7'];
                        $talla_pantalon7 = $_POST['talla_pantalon7'];
                        $talla_chaleco7 = $_POST['talla_chaleco7'];
                        $talla_bata7 = $_POST['talla_bata7'];

                        $nombre8 = $_POST["nombre8"];
                        $talla_overol8 = $_POST["talla_overol8"];
                        $talla_zapato8 = $_POST['talla_zapato8'];
                        $talla_bota8 = $_POST['talla_bota8'];
                        $talla_camisa8 = $_POST['talla_camisa8'];
                        $talla_pantalon8 = $_POST['talla_pantalon8'];
                        $talla_chaleco8 = $_POST['talla_chaleco8'];
                        $talla_bata8 = $_POST['talla_bata8'];

                        $nombre9 = $_POST["nombre9"];
                        $talla_overol9 = $_POST["talla_overol9"];
                        $talla_zapato9 = $_POST['talla_zapato9'];
                        $talla_bota9 = $_POST['talla_bota9'];
                        $talla_camisa9 = $_POST['talla_camisa9'];
                        $talla_pantalon9 = $_POST['talla_pantalon9'];
                        $talla_chaleco9 = $_POST['talla_chaleco9'];
                        $talla_bata9 = $_POST['talla_bata9'];

                        $nombre10 = $_POST["nombre10"];
                        $talla_overol10 = $_POST["talla_overol10"];
                        $talla_zapato10 = $_POST['talla_zapato10'];
                        $talla_bota10 = $_POST['talla_bota10'];
                        $talla_camisa10 = $_POST['talla_camisa10'];
                        $talla_pantalon10 = $_POST['talla_pantalon10'];
                        $talla_chaleco10 = $_POST['talla_chaleco10'];
                        $talla_bata10 = $_POST['talla_bata10'];

                        $nombre11 = $_POST["nombre11"];
                        $talla_overol11 = $_POST["talla_overol11"];
                        $talla_zapato11 = $_POST['talla_zapato11'];
                        $talla_bota11 = $_POST['talla_bota11'];
                        $talla_camisa11 = $_POST['talla_camisa11'];
                        $talla_pantalon11 = $_POST['talla_pantalon11'];
                        $talla_chaleco11 = $_POST['talla_chaleco11'];
                        $talla_bata11 = $_POST['talla_bata11'];

                        $nombre12 = $_POST["nombre12"];
                        $talla_overol12 = $_POST["talla_overol12"];
                        $talla_zapato12 = $_POST['talla_zapato12'];
                        $talla_bota12 = $_POST['talla_bota12'];
                        $talla_camisa12 = $_POST['talla_camisa12'];
                        $talla_pantalon12 = $_POST['talla_pantalon12'];
                        $talla_chaleco12 = $_POST['talla_chaleco12'];
                        $talla_bata12 = $_POST['talla_bata12'];

                        $nombre13 = $_POST["nombre13"];
                        $talla_overol13 = $_POST["talla_overol13"];
                        $talla_zapato13 = $_POST['talla_zapato13'];
                        $talla_bota13 = $_POST['talla_bota13'];
                        $talla_camisa13 = $_POST['talla_camisa13'];
                        $talla_pantalon13 = $_POST['talla_pantalon13'];
                        $talla_chaleco13 = $_POST['talla_chaleco13'];
                        $talla_bata13 = $_POST['talla_bata13'];

                        $nombre14 = $_POST["nombre14"];
                        $talla_overol14 = $_POST["talla_overol14"];
                        $talla_zapato14 = $_POST['talla_zapato14'];
                        $talla_bota14 = $_POST['talla_bota14'];
                        $talla_camisa14 = $_POST['talla_camisa14'];
                        $talla_pantalon14 = $_POST['talla_pantalon14'];
                        $talla_chaleco14 = $_POST['talla_chaleco14'];
                        $talla_bata14 = $_POST['talla_bata14'];

                        $nombre15 = $_POST["nombre15"];
                        $talla_overol15 = $_POST["talla_overol15"];
                        $talla_zapato15 = $_POST['talla_zapato15'];
                        $talla_bota15 = $_POST['talla_bota15'];
                        $talla_camisa15 = $_POST['talla_camisa15'];
                        $talla_pantalon15 = $_POST['talla_pantalon15'];
                        $talla_chaleco15 = $_POST['talla_chaleco15'];
                        $talla_bata15 = $_POST['talla_bata15'];

                        $nombre16 = $_POST["nombre16"];
                        $talla_overol16 = $_POST["talla_overol16"];
                        $talla_zapato16 = $_POST['talla_zapato16'];
                        $talla_bota16 = $_POST['talla_bota16'];
                        $talla_camisa16 = $_POST['talla_camisa16'];
                        $talla_pantalon16 = $_POST['talla_pantalon16'];
                        $talla_chaleco16 = $_POST['talla_chaleco16'];
                        $talla_bata16 = $_POST['talla_bata16'];

                        $nombre17 = $_POST["nombre17"];
                        $talla_overol17 = $_POST["talla_overol17"];
                        $talla_zapato17 = $_POST['talla_zapato17'];
                        $talla_bota17 = $_POST['talla_bota17'];
                        $talla_camisa17 = $_POST['talla_camisa17'];
                        $talla_pantalon17 = $_POST['talla_pantalon17'];
                        $talla_chaleco17 = $_POST['talla_chaleco17'];
                        $talla_bata17 = $_POST['talla_bata17'];

                        $nombre18 = $_POST["nombre18"];
                        $talla_overol18 = $_POST["talla_overol18"];
                        $talla_zapato18 = $_POST['talla_zapato18'];
                        $talla_bota18 = $_POST['talla_bota18'];
                        $talla_camisa18 = $_POST['talla_camisa18'];
                        $talla_pantalon18 = $_POST['talla_pantalon18'];
                        $talla_chaleco18 = $_POST['talla_chaleco18'];
                        $talla_bata18 = $_POST['talla_bata18'];

                        $nombre19 = $_POST["nombre19"];
                        $talla_overol19 = $_POST["talla_overol19"];
                        $talla_zapato19 = $_POST['talla_zapato19'];
                        $talla_bota19 = $_POST['talla_bota19'];
                        $talla_camisa19 = $_POST['talla_camisa19'];
                        $talla_pantalon19 = $_POST['talla_pantalon19'];
                        $talla_chaleco19 = $_POST['talla_chaleco19'];
                        $talla_bata19 = $_POST['talla_bata19'];

                        $nombre20 = $_POST["nombre20"];
                        $talla_overol20 = $_POST["talla_overol20"];
                        $talla_zapato20 = $_POST['talla_zapato20'];
                        $talla_bota20 = $_POST['talla_bota20'];
                        $talla_camisa20 = $_POST['talla_camisa20'];
                        $talla_pantalon20 = $_POST['talla_pantalon20'];
                        $talla_chaleco20 = $_POST['talla_chaleco20'];
                        $talla_bata20 = $_POST['talla_bata20'];

                        $observaciones_sup = $_POST['observaciones_sup'];

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

                        $sql = "INSERT INTO epp_rc_folios SET idsdgg='0'";
                        $result = mysql_query($sql) or die(mysql_error());
                        $id = mysql_insert_id();
                        $folio = strtoupper("SH-RC-" . $fol_ob . "-" . str_pad($id, 3, '0', STR_PAD_LEFT) . date("/ y"));

                        $currentdate = new DateTime('now', new DateTimeZone('America/Mazatlan'));

                        $date = $currentdate->format('Y-m-d');
                        $time = $currentdate->format('H:i:s');
                        $dayOfWeek = date("l", strtotime($date));

                        $splitDate = explode('-', $date);
                        $a = $splitDate[0];

                        $sql = "INSERT INTO epp_rc(year,datef,folio,supervisor_sol,empresa,obra,
                            nombre1,nombre2,nombre3,nombre4,nombre5,nombre6,nombre7,nombre8,nombre9,nombre10,nombre11,nombre12,nombre13,nombre14,nombre15,nombre16,nombre17,nombre18,nombre19,nombre20,
                            talla_overol1,talla_overol2,talla_overol3,talla_overol4,talla_overol5,talla_overol6,talla_overol7,talla_overol8,talla_overol9,talla_overol10,talla_overol11,talla_overol12,talla_overol13,talla_overol14,talla_overol15,talla_overol16,talla_overol17,talla_overol18,talla_overol19,talla_overol20,
                            talla_zapato1,talla_zapato2,talla_zapato3,talla_zapato4,talla_zapato5,talla_zapato6,talla_zapato7,talla_zapato8,talla_zapato9,talla_zapato10,talla_zapato11,talla_zapato12,talla_zapato13,talla_zapato14,talla_zapato15,talla_zapato16,talla_zapato17,talla_zapato18,talla_zapato19,talla_zapato20,
                            talla_bota1,talla_bota2,talla_bota3,talla_bota4,talla_bota5,talla_bota6,talla_bota7,talla_bota8,talla_bota9,talla_bota10,talla_bota11,talla_bota12,talla_bota13,talla_bota14,talla_bota15,talla_bota16,talla_bota17,talla_bota18,talla_bota19,talla_bota20,
                            talla_camisa1,talla_camisa2,talla_camisa3,talla_camisa4,talla_camisa5,talla_camisa6,talla_camisa7,talla_camisa8,talla_camisa9,talla_camisa10,talla_camisa11,talla_camisa12,talla_camisa13,talla_camisa14,talla_camisa15,talla_camisa16,talla_camisa17,talla_camisa18,talla_camisa19,talla_camisa20,
                            talla_pantalon1,talla_pantalon2,talla_pantalon3,talla_pantalon4,talla_pantalon5,talla_pantalon6,talla_pantalon7,talla_pantalon8,talla_pantalon9,talla_pantalon10,talla_pantalon11,talla_pantalon12,talla_pantalon13,talla_pantalon14,talla_pantalon15,talla_pantalon16,talla_pantalon17,talla_pantalon18,talla_pantalon19,talla_pantalon20,
                            talla_chaleco1,talla_chaleco2,talla_chaleco3,talla_chaleco4,talla_chaleco5,talla_chaleco6,talla_chaleco7,talla_chaleco8,talla_chaleco9,talla_chaleco10,talla_chaleco11,talla_chaleco12,talla_chaleco13,talla_chaleco14,talla_chaleco15,talla_chaleco16,talla_chaleco17,talla_chaleco18,talla_chaleco19,talla_chaleco20,
                            talla_bata1,talla_bata2,talla_bata3,talla_bata4,talla_bata5,talla_bata6,talla_bata7,talla_bata8,talla_bata9,talla_bata10,talla_bata11,talla_bata12,talla_bata13,talla_bata14,talla_bata15,talla_bata16,talla_bata17,talla_bata18,talla_bata19,talla_bata20,observaciones_sup) VALUES ('" . $a . "','" . $date . "','" . $folio . "','" . $supervisor_sol . "','" . $empresa . "','" . $obra . "',
                            '" . $nombre1 . "','" . $nombre2 . "','" . $nombre3 . "','" . $nombre4 . "','" . $nombre5 . "','" . $nombre6 . "','" . $nombre7 . "','" . $nombre8 . "','" . $nombre9 . "','" . $nombre10 . "','" . $nombre11 . "','" . $nombre12 . "','" . $nombre13 . "','" . $nombre14 . "','" . $nombre15 . "','" . $nombre16 . "','" . $nombre17 . "','" . $nombre18 . "','" . $nombre19 . "','" . $nombre20 . "',
                            '" . $talla_overol1 . "','" . $talla_overol2 . "','" . $talla_overol3 . "','" . $talla_overol4 . "','" . $talla_overol5 . "','" . $talla_overol6 . "','" . $talla_overol7 . "','" . $talla_overol8 . "','" . $talla_overol9 . "','" . $talla_overol10 . "','" . $talla_overol11 . "','" . $talla_overol12 . "','" . $talla_overol13 . "','" . $talla_overol14 . "','" . $talla_overol15 . "','" . $talla_overol16 . "','" . $talla_overol17 . "','" . $talla_overol18 . "','" . $talla_overol19 . "','" . $talla_overol20 . "',
                            '" . $talla_zapato1 . "','" . $talla_zapato2 . "','" . $talla_zapato3 . "','" . $talla_zapato4 . "','" . $talla_zapato5 . "','" . $talla_zapato6 . "','" . $talla_zapato7 . "','" . $talla_zapato8 . "','" . $talla_zapato9 . "','" . $talla_zapato10 . "','" . $talla_zapato11 . "','" . $talla_zapato12 . "','" . $talla_zapato13 . "','" . $talla_zapato14 . "','" . $talla_zapato15 . "','" . $talla_zapato16 . "','" . $talla_zapato17 . "','" . $talla_zapato18 . "','" . $talla_zapato19 . "','" . $talla_zapato20 . "',
                            '" . $talla_bota1 . "','" . $talla_bota2 . "','" . $talla_bota3 . "','" . $talla_bota4 . "','" . $talla_bota5 . "','" . $talla_bota6 . "','" . $talla_bota7 . "','" . $talla_bota8 . "','" . $talla_bota9 . "','" . $talla_bota10 . "','" . $talla_bota11 . "','" . $talla_bota12 . "','" . $talla_bota13 . "','" . $talla_bota14 . "','" . $talla_bota15 . "','" . $talla_bota16 . "','" . $talla_bota17 . "','" . $talla_bota18 . "','" . $talla_bota19 . "','" . $talla_bota20 . "',
                            '" . $talla_camisa1 . "','" . $talla_camisa2 . "','" . $talla_camisa3 . "','" . $talla_camisa4 . "','" . $talla_camisa5 . "','" . $talla_camisa6 . "','" . $talla_camisa7 . "','" . $talla_camisa8 . "','" . $talla_camisa9 . "','" . $talla_camisa10 . "','" . $talla_camisa11 . "','" . $talla_camisa12 . "','" . $talla_camisa13 . "','" . $talla_camisa14 . "','" . $talla_camisa15 . "','" . $talla_camisa16 . "','" . $talla_camisa17 . "','" . $talla_camisa18 . "','" . $talla_camisa19 . "','" . $talla_camisa20 . "',
                            '" . $talla_pantalon1 . "','" . $talla_pantalon2 . "','" . $talla_pantalon3 . "','" . $talla_pantalon4 . "','" . $talla_pantalon5 . "','" . $talla_pantalon6 . "','" . $talla_pantalon7 . "','" . $talla_pantalon8 . "','" . $talla_pantalon9 . "','" . $talla_pantalon10 . "','" . $talla_pantalon11 . "','" . $talla_pantalon12 . "','" . $talla_pantalon13 . "','" . $talla_pantalon14 . "','" . $talla_pantalon15 . "','" . $talla_pantalon16 . "','" . $talla_pantalon17 . "','" . $talla_pantalon18 . "','" . $talla_pantalon19 . "','" . $talla_pantalon20 . "',
                            '" . $talla_chaleco1 . "','" . $talla_chaleco2 . "','" . $talla_chaleco3 . "','" . $talla_chaleco4 . "','" . $talla_chaleco5 . "','" . $talla_chaleco6 . "','" . $talla_chaleco7 . "','" . $talla_chaleco8 . "','" . $talla_chaleco9 . "','" . $talla_chaleco10 . "','" . $talla_chaleco11 . "','" . $talla_chaleco12 . "','" . $talla_chaleco13 . "','" . $talla_chaleco14 . "','" . $talla_chaleco15 . "','" . $talla_chaleco16 . "','" . $talla_chaleco17 . "','" . $talla_chaleco18 . "','" . $talla_chaleco19 . "','" . $talla_chaleco20 . "',
                            '" . $talla_bata1 . "','" . $talla_bata2 . "','" . $talla_bata3 . "','" . $talla_bata4 . "','" . $talla_bata5 . "','" . $talla_bata6 . "','" . $talla_bata7 . "','" . $talla_bata8 . "','" . $talla_bata9 . "','" . $talla_bata10 . "','" . $talla_bata11 . "','" . $talla_bata12 . "','" . $talla_bata13 . "','" . $talla_bata14 . "','" . $talla_bata15 . "','" . $talla_bata16 . "','" . $talla_bata17 . "','" . $talla_bata18 . "','" . $talla_bata19 . "','" . $talla_bata20 . "',
                            '" . $observaciones_sup . "')";
                        $result = mysql_query($sql) or die(mysql_error());


                        $sql = "UPDATE epp_rc_folios SET folio='" . $folio . "' WHERE id='" . $id . "'";
                        $result = mysql_query($sql) or die(mysql_error());
                        echo "<br>";
                        echo "<br>";
                        echo "<script languaje='javascript'>
                                alert('Se ha enviado el pedido " . $folio . "')
                                location.href='historial_rc?id=tw_redireccion';
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
                        $mail->Body = "<h2>|  Nuevo Pedido de EPP Ropa y Calzado|</h2><br><p>Estimado (a) residente de " . $obra . ":</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

                        if (!$mail->Send()) {
                            echo "Fallo";
                        }
                    } else {
                        echo "<script languaje='javascript'>
                                alert('Sólo puede generar pedidos en los días 10 al 15.')
                                location.href='historial_rc?id=tw_redireccion';
                            </script>";
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