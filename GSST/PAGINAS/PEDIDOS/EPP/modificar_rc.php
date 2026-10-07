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
                    $query = "UPDATE epp_rc SET empresa='" . $_POST["empresa"] . "',
                        nombre1='" . $_POST["nombre1"] . "', talla_overol1='" . $_POST["talla_overol1"] . "',talla_zapato1='" . $_POST["talla_zapato1"] . "',
                        talla_bota1='" . $_POST["talla_bota1"] . "',talla_camisa1='" . $_POST["talla_camisa1"] . "',talla_pantalon1='" . $_POST["talla_pantalon1"] . "',
                        talla_chaleco1='" . $_POST["talla_chaleco1"] . "',talla_bata1='" . $_POST["talla_bata1"] . "', 
                        nombre2='" . $_POST["nombre2"] . "', talla_overol2='" . $_POST["talla_overol2"] . "',talla_zapato2='" . $_POST["talla_zapato2"] . "',
                        talla_bota2='" . $_POST["talla_bota2"] . "',talla_camisa2='" . $_POST["talla_camisa2"] . "',talla_pantalon2='" . $_POST["talla_pantalon2"] . "',
                        talla_chaleco2='" . $_POST["talla_chaleco2"] . "',talla_bata2='" . $_POST["talla_bata2"] . "',  
                        nombre3='" . $_POST["nombre3"] . "', talla_overol3='" . $_POST["talla_overol3"] . "',talla_zapato3='" . $_POST["talla_zapato3"] . "',
                        talla_bota3='" . $_POST["talla_bota3"] . "',talla_camisa3='" . $_POST["talla_camisa3"] . "',talla_pantalon3='" . $_POST["talla_pantalon3"] . "',
                        talla_chaleco3='" . $_POST["talla_chaleco3"] . "',talla_bata3='" . $_POST["talla_bata3"] . "',  
                        nombre4='" . $_POST["nombre4"] . "', talla_overol4='" . $_POST["talla_overol4"] . "',talla_zapato4='" . $_POST["talla_zapato4"] . "',
                        talla_bota4='" . $_POST["talla_bota4"] . "',talla_camisa4='" . $_POST["talla_camisa4"] . "',talla_pantalon4='" . $_POST["talla_pantalon4"] . "',
                        talla_chaleco4='" . $_POST["talla_chaleco4"] . "',talla_bata4='" . $_POST["talla_bata4"] . "',  
                        nombre5='" . $_POST["nombre5"] . "', talla_overol5='" . $_POST["talla_overol5"] . "',talla_zapato5='" . $_POST["talla_zapato5"] . "',
                        talla_bota5='" . $_POST["talla_bota5"] . "',talla_camisa5='" . $_POST["talla_camisa5"] . "',talla_pantalon5='" . $_POST["talla_pantalon5"] . "',
                        talla_chaleco5='" . $_POST["talla_chaleco5"] . "',talla_bata5='" . $_POST["talla_bata5"] . "',  
                        nombre6='" . $_POST["nombre6"] . "', talla_overol6='" . $_POST["talla_overol6"] . "',talla_zapato6='" . $_POST["talla_zapato6"] . "',
                        talla_bota6='" . $_POST["talla_bota6"] . "',talla_camisa6='" . $_POST["talla_camisa6"] . "',talla_pantalon6='" . $_POST["talla_pantalon6"] . "',
                        talla_chaleco6='" . $_POST["talla_chaleco6"] . "',talla_bata6='" . $_POST["talla_bata6"] . "',  
                        nombre7='" . $_POST["nombre7"] . "', talla_overol7='" . $_POST["talla_overol7"] . "',talla_zapato7='" . $_POST["talla_zapato7"] . "',
                        talla_bota7='" . $_POST["talla_bota7"] . "',talla_camisa7='" . $_POST["talla_camisa7"] . "',talla_pantalon7='" . $_POST["talla_pantalon7"] . "',
                        talla_chaleco7='" . $_POST["talla_chaleco7"] . "',talla_bata7='" . $_POST["talla_bata7"] . "',  
                        nombre8='" . $_POST["nombre8"] . "', talla_overol8='" . $_POST["talla_overol8"] . "',talla_zapato8='" . $_POST["talla_zapato8"] . "',
                        talla_bota8='" . $_POST["talla_bota8"] . "',talla_camisa8='" . $_POST["talla_camisa8"] . "',talla_pantalon8='" . $_POST["talla_pantalon8"] . "',
                        talla_chaleco8='" . $_POST["talla_chaleco8"] . "',talla_bata8='" . $_POST["talla_bata8"] . "',  
                        nombre9='" . $_POST["nombre9"] . "', talla_overol9='" . $_POST["talla_overol9"] . "',talla_zapato9='" . $_POST["talla_zapato9"] . "',
                        talla_bota9='" . $_POST["talla_bota9"] . "',talla_camisa9='" . $_POST["talla_camisa9"] . "',talla_pantalon9='" . $_POST["talla_pantalon9"] . "',
                        talla_chaleco9='" . $_POST["talla_chaleco9"] . "',talla_bata9='" . $_POST["talla_bata9"] . "',  
                        nombre10='" . $_POST["nombre10"] . "', talla_overol10='" . $_POST["talla_overol10"] . "',talla_zapato10='" . $_POST["talla_zapato10"] . "',
                        talla_bota10='" . $_POST["talla_bota10"] . "',talla_camisa10='" . $_POST["talla_camisa10"] . "',talla_pantalon10='" . $_POST["talla_pantalon10"] . "',
                        talla_chaleco10='" . $_POST["talla_chaleco10"] . "',talla_bata10='" . $_POST["talla_bata10"] . "',  
                        nombre11='" . $_POST["nombre11"] . "', talla_overol11='" . $_POST["talla_overol11"] . "',talla_zapato11='" . $_POST["talla_zapato11"] . "',
                        talla_bota11='" . $_POST["talla_bota11"] . "',talla_camisa11='" . $_POST["talla_camisa11"] . "',talla_pantalon11='" . $_POST["talla_pantalon11"] . "',
                        talla_chaleco11='" . $_POST["talla_chaleco11"] . "',talla_bata11='" . $_POST["talla_bata11"] . "',  
                        nombre12='" . $_POST["nombre12"] . "', talla_overol12='" . $_POST["talla_overol12"] . "',talla_zapato12='" . $_POST["talla_zapato12"] . "',
                        talla_bota12='" . $_POST["talla_bota12"] . "',talla_camisa12='" . $_POST["talla_camisa12"] . "',talla_pantalon12='" . $_POST["talla_pantalon12"] . "',
                        talla_chaleco12='" . $_POST["talla_chaleco12"] . "',talla_bata12='" . $_POST["talla_bata12"] . "',  
                        nombre13='" . $_POST["nombre13"] . "', talla_overol13='" . $_POST["talla_overol13"] . "',talla_zapato13='" . $_POST["talla_zapato13"] . "',
                        talla_bota13='" . $_POST["talla_bota13"] . "',talla_camisa13='" . $_POST["talla_camisa13"] . "',talla_pantalon13='" . $_POST["talla_pantalon13"] . "',
                        talla_chaleco13='" . $_POST["talla_chaleco13"] . "',talla_bata13='" . $_POST["talla_bata13"] . "',  
                        nombre14='" . $_POST["nombre14"] . "', talla_overol14='" . $_POST["talla_overol14"] . "',talla_zapato14='" . $_POST["talla_zapato14"] . "',
                        talla_bota14='" . $_POST["talla_bota14"] . "',talla_camisa14='" . $_POST["talla_camisa14"] . "',talla_pantalon14='" . $_POST["talla_pantalon14"] . "',
                        talla_chaleco14='" . $_POST["talla_chaleco14"] . "',talla_bata14='" . $_POST["talla_bata14"] . "',  
                        nombre15='" . $_POST["nombre15"] . "', talla_overol15='" . $_POST["talla_overol15"] . "',talla_zapato15='" . $_POST["talla_zapato15"] . "',
                        talla_bota15='" . $_POST["talla_bota15"] . "',talla_camisa15='" . $_POST["talla_camisa15"] . "',talla_pantalon15='" . $_POST["talla_pantalon15"] . "',
                        talla_chaleco15='" . $_POST["talla_chaleco15"] . "',talla_bata15='" . $_POST["talla_bata15"] . "',  
                        nombre16='" . $_POST["nombre16"] . "', talla_overol16='" . $_POST["talla_overol16"] . "',talla_zapato16='" . $_POST["talla_zapato16"] . "',
                        talla_bota16='" . $_POST["talla_bota16"] . "',talla_camisa16='" . $_POST["talla_camisa16"] . "',talla_pantalon16='" . $_POST["talla_pantalon16"] . "',
                        talla_chaleco16='" . $_POST["talla_chaleco16"] . "',talla_bata16='" . $_POST["talla_bata16"] . "',  
                        nombre17='" . $_POST["nombre17"] . "', talla_overol17='" . $_POST["talla_overol17"] . "',talla_zapato17='" . $_POST["talla_zapato17"] . "',
                        talla_bota17='" . $_POST["talla_bota17"] . "',talla_camisa17='" . $_POST["talla_camisa17"] . "',talla_pantalon17='" . $_POST["talla_pantalon17"] . "',
                        talla_chaleco17='" . $_POST["talla_chaleco17"] . "',talla_bata17='" . $_POST["talla_bata17"] . "',  
                        nombre18='" . $_POST["nombre18"] . "', talla_overol18='" . $_POST["talla_overol18"] . "',talla_zapato18='" . $_POST["talla_zapato18"] . "',
                        talla_bota18='" . $_POST["talla_bota18"] . "',talla_camisa18='" . $_POST["talla_camisa18"] . "',talla_pantalon18='" . $_POST["talla_pantalon18"] . "',
                        talla_chaleco18='" . $_POST["talla_chaleco18"] . "',talla_bata18='" . $_POST["talla_bata18"] . "',  
                        nombre19='" . $_POST["nombre19"] . "', talla_overol19='" . $_POST["talla_overol19"] . "',talla_zapato19='" . $_POST["talla_zapato19"] . "',
                        talla_bota19='" . $_POST["talla_bota19"] . "',talla_camisa19='" . $_POST["talla_camisa19"] . "',talla_pantalon19='" . $_POST["talla_pantalon19"] . "',
                        talla_chaleco19='" . $_POST["talla_chaleco19"] . "',talla_bata19='" . $_POST["talla_bata19"] . "',  
                        nombre20='" . $_POST["nombre20"] . "', talla_overol20='" . $_POST["talla_overol20"] . "',talla_zapato20='" . $_POST["talla_zapato20"] . "',
                        talla_bota20='" . $_POST["talla_bota20"] . "',talla_camisa20='" . $_POST["talla_camisa20"] . "',talla_pantalon20='" . $_POST["talla_pantalon20"] . "',
                        talla_chaleco20='" . $_POST["talla_chaleco20"] . "',talla_bata20='" . $_POST["talla_bata20"] . "', observaciones_sup='" . $_POST["observaciones_sup"] . "'  WHERE folio ='" . $_POST["folio"] . "'";
                    $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                    echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
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
                } else if (isset($_POST["aut1s"])) {
                    if ($d <= '27') {

                        $query = "UPDATE epp_rc SET autorizado_almacen='Autorizado',observaciones_almacen='" . $_POST["observaciones_almacen"] . "',fecha_autorizado_almacen='" . $fecha_hoy . "' WHERE folio ='" . $_POST["folio"] . "'";
                        $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                        echo "<script languaje='javascript'>
                                    alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
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
                        $correo_gerseg = "maricruz_flores@grupocavi.com.mx";
                        $mail->AddAddress($correo_gerseg);

                        $mail->WordWrap = 50;
                        $mail->IsHTML(true);
                        $mail->CharSet = 'UTF-8';
                        $mail->Subject = "Sistema de Pedidos de EPP | GRUPO CAVI";
                        $mail->Body = "<h2>|  Nuevo Pedido de EPP Ropa y Calzado|</h2><br><p>Estimada Gerencia de Seguridad:</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
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
                    $query = "UPDATE epp_rc SET autorizado_almacen='No autorizado',autorizado_residente='No autorizado',observaciones_almacen='" . $_POST["observaciones_almacen"] . "',fecha_autorizado_almacen='" . $fecha_hoy . "' WHERE folio ='" . $_POST["folio"] . "'";
                    $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                    echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                    location.href='historial_rc?id=tw_redireccion';
                            </script>";
                } else if (isset($_POST["aut1g"])) {
                    if ($d <= '27') {
                        $obra = $_POST['obrag'];
                        if ($obra == "Administrativo") {
                            $fol_ob = "ADM";
                            $correo_residente = "karina_rodriguez@grupocavi.com.mx";
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
                        $query = "UPDATE epp_rc SET autorizado_gerseg='Autorizado',observaciones_gerseg='" . $_POST["observaciones_gerseg"] . "',fecha_autorizado_gerseg='" . $date . "' WHERE folio ='" . $_POST["folio"] . "'";
                        $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                        echo "<script languaje='javascript'>
                                    alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
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
                        $mail->AddAddress($correo_gerob);

                        $mail->WordWrap = 50;
                        $mail->IsHTML(true);
                        $mail->CharSet = 'UTF-8';
                        $mail->Subject = "Sistema de Pedidos de EPP | GRUPO CAVI";
                        $mail->Body = "<h2>|  Nuevo Pedido de EPP Ropa y Calzado|</h2><br><p>Estimada Director de Operaciones:</p><p>Te informamos que tienes un nuevo pedido pendiente de autorizar.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
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
                    $query = "UPDATE epp_rc SET autorizado_gerseg='No autorizado',autorizado_almacen='No autorizado',autorizado_residente='No autorizado',observaciones_gerseg='" . $_POST["observaciones_gerseg"] . "',fecha_autorizado_gerseg='" . $fecha_hoy . "' WHERE folio ='" . $_POST["folio"] . "'";
                    $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                    echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                    location.href='historial_rc?id=tw_redireccion';
                            </script>";
                } else {
                    $id_pedido = $_GET['id_pedido'];
                    $sql_query = "SELECT * FROM epp_rc WHERE id='" . $id_pedido . "'";
                    $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());
                    if (mysql_num_rows($resultado) > 0) {
                        while ($Rs = mysql_fetch_array($resultado)) {
                            if ($_SESSION['user_epp'] == "sup") {
                ?>
                                <form action="modificar_rc" method="post">
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label blue-distinct"><i>Folio</i></label>
                                            <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?> ">
                                        </div>
                                        <div class="col-xs-3">
                                            <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                            <input readonly name="supervisor_sol" type="text" class="form-control input-sm" value="<?php echo $Rs['supervisor_sol']; ?>">
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
                                            <select name='obra' id="obras" class='form-control input-sm' readonly>
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
                                        <div class="col-xs-4">
                                            <label class="control-label">Nombre</label>
                                            <input class="form-control input-sm" type="text" name="nombre1" value="<?php echo $Rs['nombre1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Overol</label>
                                            <input class="form-control input-sm" type="text" name="talla_overol1" value="<?php echo $Rs['talla_overol1']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Zapato</label>
                                            <input class="form-control input-sm" type="text" name="talla_zapato1" value="<?php echo $Rs['talla_zapato1']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b1">
                                            <label class="control-label">T.Bota</label>
                                            <input class="form-control input-sm" type="text" name="talla_bota1" value="<?php echo $Rs['talla_bota1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Camisa</label>
                                            <input class="form-control input-sm" type="text" name="talla_camisa1" value="<?php echo $Rs['talla_camisa1']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p1">
                                            <label class="control-label">T.Pantalón</label>
                                            <input class="form-control input-sm" type="text" name="talla_pantalon1" value="<?php echo $Rs['talla_pantalon1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Chaleco</label>
                                            <input class="form-control input-sm" type="text" name="talla_chaleco1" value="<?php echo $Rs['talla_chaleco1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Bata</label>
                                            <input class="form-control input-sm" type="text" name="talla_bata1" value="<?php echo $Rs['talla_bata1']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre2" value="<?php echo $Rs['nombre2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol2" value="<?php echo $Rs['talla_overol2']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato2" value="<?php echo $Rs['talla_zapato2']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b2">
                                            <input class="form-control input-sm" type="text" name="talla_bota2" value="<?php echo $Rs['talla_bota2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa2" value="<?php echo $Rs['talla_camisa2']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p2">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon2" value="<?php echo $Rs['talla_pantalon2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco2" value="<?php echo $Rs['talla_chaleco2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata2" value="<?php echo $Rs['talla_bata2']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre3" value="<?php echo $Rs['nombre3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol3" value="<?php echo $Rs['talla_overol3']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato3" value="<?php echo $Rs['talla_zapato3']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b3">
                                            <input class="form-control input-sm" type="text" name="talla_bota3" value="<?php echo $Rs['talla_bota3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa3" value="<?php echo $Rs['talla_camisa3']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p3">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon3" value="<?php echo $Rs['talla_pantalon3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco3" value="<?php echo $Rs['talla_chaleco3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata3" value="<?php echo $Rs['talla_bata3']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre4" value="<?php echo $Rs['nombre4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol4" value="<?php echo $Rs['talla_overol4']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato4" value="<?php echo $Rs['talla_zapato4']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b4">
                                            <input class="form-control input-sm" type="text" name="talla_bota4" value="<?php echo $Rs['talla_bota4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa4" value="<?php echo $Rs['talla_camisa4']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p4">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon4" value="<?php echo $Rs['talla_pantalon4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco4" value="<?php echo $Rs['talla_chaleco4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata4" value="<?php echo $Rs['talla_bata4']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre5" value="<?php echo $Rs['nombre5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol5" value="<?php echo $Rs['talla_overol5']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato5" value="<?php echo $Rs['talla_zapato5']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b5">
                                            <input class="form-control input-sm" type="text" name="talla_bota5" value="<?php echo $Rs['talla_bota5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa5" value="<?php echo $Rs['talla_camisa5']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p5">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon5" value="<?php echo $Rs['talla_pantalon5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco5" value="<?php echo $Rs['talla_chaleco5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata5" value="<?php echo $Rs['talla_bata5']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre6" value="<?php echo $Rs['nombre6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol6" value="<?php echo $Rs['talla_overol6']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato6" value="<?php echo $Rs['talla_zapato6']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b6">
                                            <input class="form-control input-sm" type="text" name="talla_bota6" value="<?php echo $Rs['talla_bota6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa6" value="<?php echo $Rs['talla_camisa6']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p6">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon6" value="<?php echo $Rs['talla_pantalon6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco6" value="<?php echo $Rs['talla_chaleco6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata6" value="<?php echo $Rs['talla_bata6']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre7" value="<?php echo $Rs['nombre7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol7" value="<?php echo $Rs['talla_overol7']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato7" value="<?php echo $Rs['talla_zapato7']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b7">
                                            <input class="form-control input-sm" type="text" name="talla_bota7" value="<?php echo $Rs['talla_bota7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa7" value="<?php echo $Rs['talla_camisa7']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p7">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon7" value="<?php echo $Rs['talla_pantalon7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco7" value="<?php echo $Rs['talla_chaleco7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata7" value="<?php echo $Rs['talla_bata7']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre8" value="<?php echo $Rs['nombre8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol8" value="<?php echo $Rs['talla_overol8']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato8" value="<?php echo $Rs['talla_zapato8']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b8">
                                            <input class="form-control input-sm" type="text" name="talla_bota8" value="<?php echo $Rs['talla_bota8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa8" value="<?php echo $Rs['talla_camisa8']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p8">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon8" value="<?php echo $Rs['talla_pantalon8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco8" value="<?php echo $Rs['talla_chaleco8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata8" value="<?php echo $Rs['talla_bata8']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre9" value="<?php echo $Rs['nombre9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol9" value="<?php echo $Rs['talla_overol9']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato9" value="<?php echo $Rs['talla_zapato9']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b9">
                                            <input class="form-control input-sm" type="text" name="talla_bota9" value="<?php echo $Rs['talla_bota9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa9" value="<?php echo $Rs['talla_camisa9']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p9">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon9" value="<?php echo $Rs['talla_pantalon9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco9" value="<?php echo $Rs['talla_chaleco9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata9" value="<?php echo $Rs['talla_bata9']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre10" value="<?php echo $Rs['nombre10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol10" value="<?php echo $Rs['talla_overol10']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato10" value="<?php echo $Rs['talla_zapato10']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b10">
                                            <input class="form-control input-sm" type="text" name="talla_bota10" value="<?php echo $Rs['talla_bota10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa10" value="<?php echo $Rs['talla_camisa10']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p10">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon10" value="<?php echo $Rs['talla_pantalon10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco10" value="<?php echo $Rs['talla_chaleco10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata10" value="<?php echo $Rs['talla_bata10']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre11" value="<?php echo $Rs['nombre11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol11" value="<?php echo $Rs['talla_overol11']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato11" value="<?php echo $Rs['talla_zapato11']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b11">
                                            <input class="form-control input-sm" type="text" name="talla_bota11" value="<?php echo $Rs['talla_bota11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa11" value="<?php echo $Rs['talla_camisa11']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p11">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon11" value="<?php echo $Rs['talla_pantalon11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco11" value="<?php echo $Rs['talla_chaleco11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata11" value="<?php echo $Rs['talla_bata11']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre12" value="<?php echo $Rs['nombre12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol12" value="<?php echo $Rs['talla_overol12']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato12" value="<?php echo $Rs['talla_zapato12']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b12">
                                            <input class="form-control input-sm" type="text" name="talla_bota12" value="<?php echo $Rs['talla_bota12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa12" value="<?php echo $Rs['talla_camisa12']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p12">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon12" value="<?php echo $Rs['talla_pantalon12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco12" value="<?php echo $Rs['talla_chaleco12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata12" value="<?php echo $Rs['talla_bata12']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre13" value="<?php echo $Rs['nombre13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol13" value="<?php echo $Rs['talla_overol13']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato13" value="<?php echo $Rs['talla_zapato13']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b13">
                                            <input class="form-control input-sm" type="text" name="talla_bota13" value="<?php echo $Rs['talla_bota13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa13" value="<?php echo $Rs['talla_camisa13']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p13">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon13" value="<?php echo $Rs['talla_pantalon13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco13" value="<?php echo $Rs['talla_chaleco13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata13" value="<?php echo $Rs['talla_bata13']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre14" value="<?php echo $Rs['nombre14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol14" value="<?php echo $Rs['talla_overol14']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato14" value="<?php echo $Rs['talla_zapato14']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b14">
                                            <input class="form-control input-sm" type="text" name="talla_bota14" value="<?php echo $Rs['talla_bota14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa14" value="<?php echo $Rs['talla_camisa14']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p14">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon14" value="<?php echo $Rs['talla_pantalon14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco14" value="<?php echo $Rs['talla_chaleco14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata14" value="<?php echo $Rs['talla_bata14']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre15" value="<?php echo $Rs['nombre15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol15" value="<?php echo $Rs['talla_overol15']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato15" value="<?php echo $Rs['talla_zapato15']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b15">
                                            <input class="form-control input-sm" type="text" name="talla_bota15" value="<?php echo $Rs['talla_bota15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa15" value="<?php echo $Rs['talla_camisa15']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p15">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon15" value="<?php echo $Rs['talla_pantalon15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco15" value="<?php echo $Rs['talla_chaleco15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata15" value="<?php echo $Rs['talla_bata15']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre16" value="<?php echo $Rs['nombre16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol16" value="<?php echo $Rs['talla_overol16']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato16" value="<?php echo $Rs['talla_zapato16']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b16">
                                            <input class="form-control input-sm" type="text" name="talla_bota16" value="<?php echo $Rs['talla_bota16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa16" value="<?php echo $Rs['talla_camisa16']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p16">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon16" value="<?php echo $Rs['talla_pantalon16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco16" value="<?php echo $Rs['talla_chaleco16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata16" value="<?php echo $Rs['talla_bata16']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre17" value="<?php echo $Rs['nombre17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol17" value="<?php echo $Rs['talla_overol17']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato17" value="<?php echo $Rs['talla_zapato17']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b17">
                                            <input class="form-control input-sm" type="text" name="talla_bota17" value="<?php echo $Rs['talla_bota17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa17" value="<?php echo $Rs['talla_camisa17']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p17">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon17" value="<?php echo $Rs['talla_pantalon17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco17" value="<?php echo $Rs['talla_chaleco17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata17" value="<?php echo $Rs['talla_bata17']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre18" value="<?php echo $Rs['nombre18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol18" value="<?php echo $Rs['talla_overol18']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato18" value="<?php echo $Rs['talla_zapato18']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b18">
                                            <input class="form-control input-sm" type="text" name="talla_bota18" value="<?php echo $Rs['talla_bota18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa18" value="<?php echo $Rs['talla_camisa18']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p18">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon18" value="<?php echo $Rs['talla_pantalon18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco18" value="<?php echo $Rs['talla_chaleco18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata18" value="<?php echo $Rs['talla_bata18']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre19" value="<?php echo $Rs['nombre19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol19" value="<?php echo $Rs['talla_overol19']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato19" value="<?php echo $Rs['talla_zapato19']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b19">
                                            <input class="form-control input-sm" type="text" name="talla_bota19" value="<?php echo $Rs['talla_bota19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa19" value="<?php echo $Rs['talla_camisa19']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p19">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon19" value="<?php echo $Rs['talla_pantalon19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco19" value="<?php echo $Rs['talla_chaleco19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata19" value="<?php echo $Rs['talla_bata19']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre20" value="<?php echo $Rs['nombre20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol20" value="<?php echo $Rs['talla_overol20']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato20" value="<?php echo $Rs['talla_zapato20']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="b20">
                                            <input class="form-control input-sm" type="text" name="talla_bota20" value="<?php echo $Rs['talla_bota20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa20" value="<?php echo $Rs['talla_camisa20']; ?>">
                                        </div>
                                        <div class="col-xs-1" id="p20">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon20" value="<?php echo $Rs['talla_pantalon20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco20" value="<?php echo $Rs['talla_chaleco20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata20" value="<?php $Rs['talla_bata20']; ?>">
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
                                <form action="modificar_rc" method="post">
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label blue-distinct"><i>Folio</i></label>
                                            <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?> ">
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
                                            <select name='obra' class='form-control input-sm' disabled>
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
                                        <div class="col-xs-4">
                                            <label class="control-label">Nombre</label>
                                            <input class="form-control input-sm" type="text" name="nombre1" readonly value="<?php echo $Rs['nombre1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Overol</label>
                                            <input class="form-control input-sm" type="text" name="talla_overol1" readonly value="<?php echo $Rs['talla_overol1']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Zapato</label>
                                            <input class="form-control input-sm" type="text" name="talla_zapato1" readonly value="<?php echo $Rs['talla_zapato1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Bota</label>
                                            <input class="form-control input-sm" type="text" name="talla_bota1" readonly value="<?php echo $Rs['talla_bota1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Camisa</label>
                                            <input class="form-control input-sm" type="text" name="talla_camisa1" readonly value="<?php echo $Rs['talla_camisa1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Pantalón</label>
                                            <input class="form-control input-sm" type="text" name="talla_pantalon1" readonly value="<?php echo $Rs['talla_pantalon1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Chaleco</label>
                                            <input class="form-control input-sm" type="text" name="talla_chaleco1" readonly value="<?php echo $Rs['talla_chaleco1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Bata</label>
                                            <input class="form-control input-sm" type="text" name="talla_bata1" readonly value="<?php echo $Rs['talla_bata1']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre2" readonly value="<?php echo $Rs['nombre2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol2" readonly value="<?php echo $Rs['talla_overol2']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato2" readonly value="<?php echo $Rs['talla_zapato2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota2" readonly value="<?php echo $Rs['talla_bota2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa2" readonly value="<?php echo $Rs['talla_camisa2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon2" readonly value="<?php echo $Rs['talla_pantalon2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco2" readonly value="<?php echo $Rs['talla_chaleco2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata2" readonly value="<?php echo $Rs['talla_bata2']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre3" readonly value="<?php echo $Rs['nombre3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol3" readonly value="<?php echo $Rs['talla_overol3']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato3" readonly value="<?php echo $Rs['talla_zapato3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota3" readonly value="<?php echo $Rs['talla_bota3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa3" readonly value="<?php echo $Rs['talla_camisa3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon3" readonly value="<?php echo $Rs['talla_pantalon3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco3" readonly value="<?php echo $Rs['talla_chaleco3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata3" readonly value="<?php echo $Rs['talla_bata3']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre4" readonly value="<?php echo $Rs['nombre4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol4" readonly value="<?php echo $Rs['talla_overol4']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato4" readonly value="<?php echo $Rs['talla_zapato4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota4" readonly value="<?php echo $Rs['talla_bota4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa4" readonly value="<?php echo $Rs['talla_camisa4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon4" readonly value="<?php echo $Rs['talla_pantalon4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco4" readonly value="<?php echo $Rs['talla_chaleco4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata4" readonly value="<?php echo $Rs['talla_bata4']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre5" readonly value="<?php echo $Rs['nombre5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol5" readonly value="<?php echo $Rs['talla_overol5']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato5" readonly value="<?php echo $Rs['talla_zapato5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota5" readonly value="<?php echo $Rs['talla_bota5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa5" readonly value="<?php echo $Rs['talla_camisa5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon5" readonly value="<?php echo $Rs['talla_pantalon5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco5" readonly value="<?php echo $Rs['talla_chaleco5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata5" readonly value="<?php echo $Rs['talla_bata5']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre6" readonly value="<?php echo $Rs['nombre6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol6" readonly value="<?php echo $Rs['talla_overol6']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato6" readonly value="<?php echo $Rs['talla_zapato6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota6" readonly value="<?php echo $Rs['talla_bota6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa6" readonly value="<?php echo $Rs['talla_camisa6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon6" readonly value="<?php echo $Rs['talla_pantalon6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco6" readonly value="<?php echo $Rs['talla_chaleco6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata6" readonly value="<?php echo $Rs['talla_bata6']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre7" readonly value="<?php echo $Rs['nombre7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol7" readonly value="<?php echo $Rs['talla_overol7']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato7" readonly value="<?php echo $Rs['talla_zapato7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota7" readonly value="<?php echo $Rs['talla_bota7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa7" readonly value="<?php echo $Rs['talla_camisa7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon7" readonly value="<?php echo $Rs['talla_pantalon7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco7" readonly value="<?php echo $Rs['talla_chaleco7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata7" readonly value="<?php echo $Rs['talla_bata7']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre8" readonly value="<?php echo $Rs['nombre8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol8" readonly value="<?php echo $Rs['talla_overol8']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato8" readonly value="<?php echo $Rs['talla_zapato8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota8" readonly value="<?php echo $Rs['talla_bota8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa8" readonly value="<?php echo $Rs['talla_camisa8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon8" readonly value="<?php echo $Rs['talla_pantalon8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco8" readonly value="<?php echo $Rs['talla_chaleco8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata8" readonly value="<?php echo $Rs['talla_bata8']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre9" readonly value="<?php echo $Rs['nombre9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol9" readonly value="<?php echo $Rs['talla_overol9']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato9" readonly value="<?php echo $Rs['talla_zapato9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota9" readonly value="<?php echo $Rs['talla_bota9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa9" readonly value="<?php echo $Rs['talla_camisa9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon9" readonly value="<?php echo $Rs['talla_pantalon9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco9" readonly value="<?php echo $Rs['talla_chaleco9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata9" readonly value="<?php echo $Rs['talla_bata9']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre10" readonly value="<?php echo $Rs['nombre10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol10" readonly value="<?php echo $Rs['talla_overol10']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato10" readonly value="<?php echo $Rs['talla_zapato10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota10" readonly value="<?php echo $Rs['talla_bota10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa10" readonly value="<?php echo $Rs['talla_camisa10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon10" readonly value="<?php echo $Rs['talla_pantalon10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco10" readonly value="<?php echo $Rs['talla_chaleco10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata10" readonly value="<?php echo $Rs['talla_bata10']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre11" readonly value="<?php echo $Rs['nombre11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol11" readonly value="<?php echo $Rs['talla_overol11']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato11" readonly value="<?php echo $Rs['talla_zapato11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota11" readonly value="<?php echo $Rs['talla_bota11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa11" readonly value="<?php echo $Rs['talla_camisa11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon11" readonly value="<?php echo $Rs['talla_pantalon11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco11" readonly value="<?php echo $Rs['talla_chaleco11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata11" readonly value="<?php echo $Rs['talla_bata11']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre12" readonly value="<?php echo $Rs['nombre12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol12" readonly value="<?php echo $Rs['talla_overol12']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato12" readonly value="<?php echo $Rs['talla_zapato12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota12" readonly value="<?php echo $Rs['talla_bota12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa12" readonly value="<?php echo $Rs['talla_camisa12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon12" readonly value="<?php echo $Rs['talla_pantalon12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco12" readonly value="<?php echo $Rs['talla_chaleco12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata12" readonly value="<?php echo $Rs['talla_bata12']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre13" readonly value="<?php echo $Rs['nombre13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol13" readonly value="<?php echo $Rs['talla_overol13']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato13" readonly value="<?php echo $Rs['talla_zapato13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota13" readonly value="<?php echo $Rs['talla_bota13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa13" readonly value="<?php echo $Rs['talla_camisa13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon13" readonly value="<?php echo $Rs['talla_pantalon13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco13" readonly value="<?php echo $Rs['talla_chaleco13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata13" readonly value="<?php echo $Rs['talla_bata13']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre14" readonly value="<?php echo $Rs['nombre14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol14" readonly value="<?php echo $Rs['talla_overol14']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato14" readonly value="<?php echo $Rs['talla_zapato14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota14" readonly value="<?php echo $Rs['talla_bota14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa14" readonly value="<?php echo $Rs['talla_camisa14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon14" readonly value="<?php echo $Rs['talla_pantalon14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco14" readonly value="<?php echo $Rs['talla_chaleco14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata14" readonly value="<?php echo $Rs['talla_bata14']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre15" readonly value="<?php echo $Rs['nombre15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol15" readonly value="<?php echo $Rs['talla_overol15']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato15" readonly value="<?php echo $Rs['talla_zapato15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota15" readonly value="<?php echo $Rs['talla_bota15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa15" readonly value="<?php echo $Rs['talla_camisa15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon15" readonly value="<?php echo $Rs['talla_pantalon15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco15" readonly value="<?php echo $Rs['talla_chaleco15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata15" readonly value="<?php echo $Rs['talla_bata15']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre16" readonly value="<?php echo $Rs['nombre16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol16" readonly value="<?php echo $Rs['talla_overol16']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato16" readonly value="<?php echo $Rs['talla_zapato16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota16" readonly value="<?php echo $Rs['talla_bota16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa16" readonly value="<?php echo $Rs['talla_camisa16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon16" readonly value="<?php echo $Rs['talla_pantalon16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco16" readonly value="<?php echo $Rs['talla_chaleco16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata16" readonly value="<?php echo $Rs['talla_bata16']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre17" readonly value="<?php echo $Rs['nombre17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol17" readonly value="<?php echo $Rs['talla_overol17']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato17" readonly value="<?php echo $Rs['talla_zapato17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota17" readonly value="<?php echo $Rs['talla_bota17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa17" readonly value="<?php echo $Rs['talla_camisa17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon17" readonly value="<?php echo $Rs['talla_pantalon17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco17" readonly value="<?php echo $Rs['talla_chaleco17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata17" readonly value="<?php echo $Rs['talla_bata17']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre18" readonly value="<?php echo $Rs['nombre18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol18" readonly value="<?php echo $Rs['talla_overol18']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato18" readonly value="<?php echo $Rs['talla_zapato18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota18" readonly value="<?php echo $Rs['talla_bota18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa18" readonly value="<?php echo $Rs['talla_camisa18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon18" readonly value="<?php echo $Rs['talla_pantalon18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco18" readonly value="<?php echo $Rs['talla_chaleco18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata18" readonly value="<?php echo $Rs['talla_bata18']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre19" readonly value="<?php echo $Rs['nombre19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol19" readonly value="<?php echo $Rs['talla_overol19']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato19" readonly value="<?php echo $Rs['talla_zapato19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota19" readonly value="<?php echo $Rs['talla_bota19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa19" readonly value="<?php echo $Rs['talla_camisa19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon19" readonly value="<?php echo $Rs['talla_pantalon19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco19" readonly value="<?php echo $Rs['talla_chaleco19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata19" readonly value="<?php echo $Rs['talla_bata19']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre20" readonly value="<?php echo $Rs['nombre20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol20" readonly value="<?php echo $Rs['talla_overol20']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato20" readonly value="<?php echo $Rs['talla_zapato20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota20" readonly value="<?php echo $Rs['talla_bota20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa20" readonly value="<?php echo $Rs['talla_camisa20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon20" readonly value="<?php echo $Rs['talla_pantalon20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco20" readonly value="<?php echo $Rs['talla_chaleco20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata20" readonly value="<?php echo $Rs['talla_bata20']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Supervisor</label>
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

                                <form action="modificar_rc" method="post">
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                            <label class="control-label blue-distinct"><i>Folio</i></label>
                                            <input readonly align="right" name="folio" class="form-control input-sm" value="<?php echo $Rs['folio']; ?> ">
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
                                            <select name='obra' class='form-control input-sm' readonly>
                                                <option selected><?php echo $Rs['obrag']; ?></option>
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
                                            <input class="form-control input-sm" type="text" name="nombre1" readonly value="<?php echo $Rs['nombre1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Overol</label>
                                            <input class="form-control input-sm" type="text" name="talla_overol1" readonly value="<?php echo $Rs['talla_overol1']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Zapato</label>
                                            <input class="form-control input-sm" type="text" name="talla_zapato1" readonly value="<?php echo $Rs['talla_zapato1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Bota</label>
                                            <input class="form-control input-sm" type="text" name="talla_bota1" readonly value="<?php echo $Rs['talla_bota1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Camisa</label>
                                            <input class="form-control input-sm" type="text" name="talla_camisa1" readonly value="<?php echo $Rs['talla_camisa1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Pantalón</label>
                                            <input class="form-control input-sm" type="text" name="talla_pantalon1" readonly value="<?php echo $Rs['talla_pantalon1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Chaleco</label>
                                            <input class="form-control input-sm" type="text" name="talla_chaleco1" readonly value="<?php echo $Rs['talla_chaleco1']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <label class="control-label">T.Bata</label>
                                            <input class="form-control input-sm" type="text" name="talla_bata1" readonly value="<?php echo $Rs['talla_bata1']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre2" readonly value="<?php echo $Rs['nombre2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol2" readonly value="<?php echo $Rs['talla_overol2']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato2" readonly value="<?php echo $Rs['talla_zapato2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota2" readonly value="<?php echo $Rs['talla_bota2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa2" readonly value="<?php echo $Rs['talla_camisa2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon2" readonly value="<?php echo $Rs['talla_pantalon2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco2" readonly value="<?php echo $Rs['talla_chaleco2']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata2" readonly value="<?php echo $Rs['talla_bata2']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre3" readonly value="<?php echo $Rs['nombre3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol3" readonly value="<?php echo $Rs['talla_overol3']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato3" readonly value="<?php echo $Rs['talla_zapato3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota3" readonly value="<?php echo $Rs['talla_bota3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa3" readonly value="<?php echo $Rs['talla_camisa3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon3" readonly value="<?php echo $Rs['talla_pantalon3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco3" readonly value="<?php echo $Rs['talla_chaleco3']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata3" readonly value="<?php echo $Rs['talla_bata3']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre4" readonly value="<?php echo $Rs['nombre4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol4" readonly value="<?php echo $Rs['talla_overol4']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato4" readonly value="<?php echo $Rs['talla_zapato4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota4" readonly value="<?php echo $Rs['talla_bota4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa4" readonly value="<?php echo $Rs['talla_camisa4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon4" readonly value="<?php echo $Rs['talla_pantalon4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco4" readonly value="<?php echo $Rs['talla_chaleco4']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata4" readonly value="<?php echo $Rs['talla_bata4']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre5" readonly value="<?php echo $Rs['nombre5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol5" readonly value="<?php echo $Rs['talla_overol5']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato5" readonly value="<?php echo $Rs['talla_zapato5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota5" readonly value="<?php echo $Rs['talla_bota5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa5" readonly value="<?php echo $Rs['talla_camisa5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon5" readonly value="<?php echo $Rs['talla_pantalon5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco5" readonly value="<?php echo $Rs['talla_chaleco5']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata5" readonly value="<?php echo $Rs['talla_bata5']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre6" readonly value="<?php echo $Rs['nombre6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol6" readonly value="<?php echo $Rs['talla_overol6']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato6" readonly value="<?php echo $Rs['talla_zapato6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota6" readonly value="<?php echo $Rs['talla_bota6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa6" readonly value="<?php echo $Rs['talla_camisa6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon6" readonly value="<?php echo $Rs['talla_pantalon6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco6" readonly value="<?php echo $Rs['talla_chaleco6']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata6" readonly value="<?php echo $Rs['talla_bata6']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre7" readonly value="<?php echo $Rs['nombre7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol7" readonly value="<?php echo $Rs['talla_overol7']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato7" readonly value="<?php echo $Rs['talla_zapato7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota7" readonly value="<?php echo $Rs['talla_bota7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa7" readonly value="<?php echo $Rs['talla_camisa7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon7" readonly value="<?php echo $Rs['talla_pantalon7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco7" readonly value="<?php echo $Rs['talla_chaleco7']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata7" readonly value="<?php echo $Rs['talla_bata7']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre8" readonly value="<?php echo $Rs['nombre8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol8" readonly value="<?php echo $Rs['talla_overol8']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato8" readonly value="<?php echo $Rs['talla_zapato8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota8" readonly value="<?php echo $Rs['talla_bota8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa8" readonly value="<?php echo $Rs['talla_camisa8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon8" readonly value="<?php echo $Rs['talla_pantalon8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco8" readonly value="<?php echo $Rs['talla_chaleco8']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata8" readonly value="<?php echo $Rs['talla_bata8']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre9" readonly value="<?php echo $Rs['nombre9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol9" readonly value="<?php echo $Rs['talla_overol9']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato9" readonly value="<?php echo $Rs['talla_zapato9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota9" readonly value="<?php echo $Rs['talla_bota9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa9" readonly value="<?php echo $Rs['talla_camisa9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon9" readonly value="<?php echo $Rs['talla_pantalon9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco9" readonly value="<?php echo $Rs['talla_chaleco9']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata9" readonly value="<?php echo $Rs['talla_bata9']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre10" readonly value="<?php echo $Rs['nombre10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol10" readonly value="<?php echo $Rs['talla_overol10']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato10" readonly value="<?php echo $Rs['talla_zapato10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota10" readonly value="<?php echo $Rs['talla_bota10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa10" readonly value="<?php echo $Rs['talla_camisa10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon10" readonly value="<?php echo $Rs['talla_pantalon10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco10" readonly value="<?php echo $Rs['talla_chaleco10']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata10" readonly value="<?php echo $Rs['talla_bata10']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre11" readonly value="<?php echo $Rs['nombre11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol11" readonly value="<?php echo $Rs['talla_overol11']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato11" readonly value="<?php echo $Rs['talla_zapato11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota11" readonly value="<?php echo $Rs['talla_bota11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa11" readonly value="<?php echo $Rs['talla_camisa11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon11" readonly value="<?php echo $Rs['talla_pantalon11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco11" readonly value="<?php echo $Rs['talla_chaleco11']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata11" readonly value="<?php echo $Rs['talla_bata11']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre12" readonly value="<?php echo $Rs['nombre12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol12" readonly value="<?php echo $Rs['talla_overol12']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato12" readonly value="<?php echo $Rs['talla_zapato12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota12" readonly value="<?php echo $Rs['talla_bota12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa12" readonly value="<?php echo $Rs['talla_camisa12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon12" readonly value="<?php echo $Rs['talla_pantalon12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco12" readonly value="<?php echo $Rs['talla_chaleco12']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata12" readonly value="<?php echo $Rs['talla_bata12']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre13" readonly value="<?php echo $Rs['nombre13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol13" readonly value="<?php echo $Rs['talla_overol13']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato13" readonly value="<?php echo $Rs['talla_zapato13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota13" readonly value="<?php echo $Rs['talla_bota13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa13" readonly value="<?php echo $Rs['talla_camisa13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon13" readonly value="<?php echo $Rs['talla_pantalon13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco13" readonly value="<?php echo $Rs['talla_chaleco13']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata13" readonly value="<?php echo $Rs['talla_bata13']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre14" readonly value="<?php echo $Rs['nombre14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol14" readonly value="<?php echo $Rs['talla_overol14']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato14" readonly value="<?php echo $Rs['talla_zapato14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota14" readonly value="<?php echo $Rs['talla_bota14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa14" readonly value="<?php echo $Rs['talla_camisa14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon14" readonly value="<?php echo $Rs['talla_pantalon14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco14" readonly value="<?php echo $Rs['talla_chaleco14']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata14" readonly value="<?php echo $Rs['talla_bata14']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre15" readonly value="<?php echo $Rs['nombre15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol15" readonly value="<?php echo $Rs['talla_overol15']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato15" readonly value="<?php echo $Rs['talla_zapato15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota15" readonly value="<?php echo $Rs['talla_bota15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa15" readonly value="<?php echo $Rs['talla_camisa15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon15" readonly value="<?php echo $Rs['talla_pantalon15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco15" readonly value="<?php echo $Rs['talla_chaleco15']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata15" readonly value="<?php echo $Rs['talla_bata15']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre16" readonly value="<?php echo $Rs['nombre16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol16" readonly value="<?php echo $Rs['talla_overol16']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato16" readonly value="<?php echo $Rs['talla_zapato16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota16" readonly value="<?php echo $Rs['talla_bota16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa16" readonly value="<?php echo $Rs['talla_camisa16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon16" readonly value="<?php echo $Rs['talla_pantalon16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco16" readonly value="<?php echo $Rs['talla_chaleco16']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata16" readonly value="<?php echo $Rs['talla_bata16']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre17" readonly value="<?php echo $Rs['nombre17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol17" readonly value="<?php echo $Rs['talla_overol17']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato17" readonly value="<?php echo $Rs['talla_zapato17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota17" readonly value="<?php echo $Rs['talla_bota17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa17" readonly value="<?php echo $Rs['talla_camisa17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon17" readonly value="<?php echo $Rs['talla_pantalon17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco17" readonly value="<?php echo $Rs['talla_chaleco17']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata17" readonly value="<?php echo $Rs['talla_bata17']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre18" readonly value="<?php echo $Rs['nombre18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol18" readonly value="<?php echo $Rs['talla_overol18']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato18" readonly value="<?php echo $Rs['talla_zapato18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota18" readonly value="<?php echo $Rs['talla_bota18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa18" readonly value="<?php echo $Rs['talla_camisa18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon18" readonly value="<?php echo $Rs['talla_pantalon18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco18" readonly value="<?php echo $Rs['talla_chaleco18']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata18" readonly value="<?php echo $Rs['talla_bata18']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre19" readonly value="<?php echo $Rs['nombre19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol19" readonly value="<?php echo $Rs['talla_overol19']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato19" readonly value="<?php echo $Rs['talla_zapato19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota19" readonly value="<?php echo $Rs['talla_bota19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa19" readonly value="<?php echo $Rs['talla_camisa19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon19" readonly value="<?php echo $Rs['talla_pantalon19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco19" readonly value="<?php echo $Rs['talla_chaleco19']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata19" readonly value="<?php echo $Rs['talla_bata19']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-4">
                                            <input class="form-control input-sm" type="text" name="nombre20" readonly value="<?php echo $Rs['nombre20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_overol20" readonly value="<?php echo $Rs['talla_overol20']; ?>" />
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_zapato20" readonly value="<?php echo $Rs['talla_zapato20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bota20" readonly value="<?php echo $Rs['talla_bota20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_camisa20" readonly value="<?php echo $Rs['talla_camisa20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_pantalon20" readonly value="<?php echo $Rs['talla_pantalon20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_chaleco20" readonly value="<?php echo $Rs['talla_chaleco20']; ?>">
                                        </div>
                                        <div class="col-xs-1">
                                            <input class="form-control input-sm" type="text" name="talla_bata20" readonly value="<?php echo $Rs['talla_bata20']; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-2">
                                        </div>
                                        <div class="col-xs-8" style="text-align:center;">
                                            <label class="control-label">Observaciones Supervisor</label>
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
    <script type="text/javascript">
        if (document.getElementById('obras').value === "Herradura") {
            $("#b1").hide();
            $("#b2").hide();
            $("#b3").hide();
            $("#b4").hide();
            $("#b5").hide();
            $("#b6").hide();
            $("#b7").hide();
            $("#b8").hide();
            $("#b9").hide();
            $("#b10").hide();
            $("#b11").hide();
            $("#b12").hide();
            $("#b13").hide();
            $("#b14").hide();
            $("#b15").hide();
            $("#b16").hide();
            $("#b17").hide();
            $("#b18").hide();
            $("#b19").hide();
            $("#b20").hide();

            $("#p1").hide();
            $("#p2").hide();
            $("#p3").hide();
            $("#p4").hide();
            $("#p5").hide();
            $("#p6").hide();
            $("#p7").hide();
            $("#p8").hide();
            $("#p9").hide();
            $("#p10").hide();
            $("#p11").hide();
            $("#p12").hide();
            $("#p13").hide();
            $("#p14").hide();
            $("#p15").hide();
            $("#p16").hide();
            $("#p17").hide();
            $("#p18").hide();
            $("#p19").hide();
            $("#p20").hide();
        } else {
            $("#b1").show();
            $("#b2").show();
            $("#b3").show();
            $("#b4").show();
            $("#b5").show();
            $("#b6").show();
            $("#b7").show();
            $("#b8").show();
            $("#b9").show();
            $("#b10").show();
            $("#b11").show();
            $("#b12").show();
            $("#b13").show();
            $("#b14").show();
            $("#b15").show();
            $("#b16").show();
            $("#b17").show();
            $("#b18").show();
            $("#b19").show();
            $("#b20").show();

            $("#p1").show();
            $("#p2").show();
            $("#p3").show();
            $("#p4").show();
            $("#p5").show();
            $("#p6").show();
            $("#p7").show();
            $("#p8").show();
            $("#p9").show();
            $("#p10").show();
            $("#p11").show();
            $("#p12").show();
            $("#p13").show();
            $("#p14").show();
            $("#p15").show();
            $("#p16").show();
            $("#p17").show();
            $("#p18").show();
            $("#p19").show();
            $("#p20").show();
        };
    </script>
</body>

</html>