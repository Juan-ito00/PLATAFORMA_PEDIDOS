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
                    if ($d >= '15' && $d <= '20') {
                        if ($m == '01' | $m == '04' | $m == '07' | $m == '10') {
                            mysql_query("SET NAMES 'UTF8'");
                            mysql_query("SET lc_time_names = 'es_MX'");

                            $supervisor_sol = $_POST['supervisor_sol'];
                            $empresa = $_POST['empresa'];
                            $obra = $_POST['obra'];

                            $cant_unid1 = $_POST["cant_unid1"];
                            $desc1 = $_POST["desc1"];
                            $codigo1 = $_POST['codigo1'];
                            $marca1 = $_POST['marca1'];
                            $color1 = $_POST['color1'];
                            $medidas1 = $_POST['medidas1'];
                            $clase1 = $_POST['clase1'];

                            $cant_unid2 = $_POST["cant_unid2"];
                            $desc2 = $_POST["desc2"];
                            $codigo2 = $_POST['codigo2'];
                            $marca2 = $_POST['marca2'];
                            $color2 = $_POST['color2'];
                            $medidas2 = $_POST['medidas2'];
                            $clase2 = $_POST['clase2'];

                            $cant_unid3 = $_POST["cant_unid3"];
                            $desc3 = $_POST["desc3"];
                            $codigo3 = $_POST['codigo3'];
                            $marca3 = $_POST['marca3'];
                            $color3 = $_POST['color3'];
                            $medidas3 = $_POST['medidas3'];
                            $clase3 = $_POST['clase3'];

                            $cant_unid4 = $_POST["cant_unid4"];
                            $desc4 = $_POST["desc4"];
                            $codigo4 = $_POST['codigo4'];
                            $marca4 = $_POST['marca4'];
                            $color4 = $_POST['color4'];
                            $medidas4 = $_POST['medidas4'];
                            $clase4 = $_POST['clase4'];

                            $cant_unid5 = $_POST["cant_unid5"];
                            $desc5 = $_POST["desc5"];
                            $codigo5 = $_POST['codigo5'];
                            $marca5 = $_POST['marca5'];
                            $color5 = $_POST['color5'];
                            $medidas5 = $_POST['medidas5'];
                            $clase5 = $_POST['clase5'];

                            $cant_unid6 = $_POST["cant_unid6"];
                            $desc6 = $_POST["desc6"];
                            $codigo6 = $_POST['codigo6'];
                            $marca6 = $_POST['marca6'];
                            $color6 = $_POST['color6'];
                            $medidas6 = $_POST['medidas6'];
                            $clase6 = $_POST['clase6'];

                            $cant_unid7 = $_POST["cant_unid7"];
                            $desc7 = $_POST["desc7"];
                            $codigo7 = $_POST['codigo7'];
                            $marca7 = $_POST['marca7'];
                            $color7 = $_POST['color7'];
                            $medidas7 = $_POST['medidas7'];
                            $clase7 = $_POST['clase7'];

                            $cant_unid8 = $_POST["cant_unid8"];
                            $desc8 = $_POST["desc8"];
                            $codigo8 = $_POST['codigo8'];
                            $marca8 = $_POST['marca8'];
                            $color8 = $_POST['color8'];
                            $medidas8 = $_POST['medidas8'];
                            $clase8 = $_POST['clase8'];

                            $cant_unid9 = $_POST["cant_unid9"];
                            $desc9 = $_POST["desc9"];
                            $codigo9 = $_POST['codigo9'];
                            $marca9 = $_POST['marca9'];
                            $color9 = $_POST['color9'];
                            $medidas9 = $_POST['medidas9'];
                            $clase9 = $_POST['clase9'];

                            $cant_unid10 = $_POST["cant_unid10"];
                            $desc10 = $_POST["desc10"];
                            $codigo10 = $_POST['codigo10'];
                            $marca10 = $_POST['marca10'];
                            $color10 = $_POST['color10'];
                            $medidas10 = $_POST['medidas10'];
                            $clase10 = $_POST['clase10'];

                            $cant_unid11 = $_POST["cant_unid11"];
                            $desc11 = $_POST["desc11"];
                            $codigo11 = $_POST['codigo11'];
                            $marca11 = $_POST['marca11'];
                            $color11 = $_POST['color11'];
                            $medidas11 = $_POST['medidas11'];
                            $clase11 = $_POST['clase11'];

                            $cant_unid12 = $_POST["cant_unid12"];
                            $desc12 = $_POST["desc12"];
                            $codigo12 = $_POST['codigo12'];
                            $marca12 = $_POST['marca12'];
                            $color12 = $_POST['color12'];
                            $medidas12 = $_POST['medidas12'];
                            $clase12 = $_POST['clase12'];

                            $cant_unid13 = $_POST["cant_unid13"];
                            $desc13 = $_POST["desc13"];
                            $codigo13 = $_POST['codigo13'];
                            $marca13 = $_POST['marca13'];
                            $color13 = $_POST['color13'];
                            $medidas13 = $_POST['medidas13'];
                            $clase13 = $_POST['clase13'];

                            $cant_unid14 = $_POST["cant_unid14"];
                            $desc14 = $_POST["desc14"];
                            $codigo14 = $_POST['codigo14'];
                            $marca14 = $_POST['marca14'];
                            $color14 = $_POST['color14'];
                            $medidas14 = $_POST['medidas14'];
                            $clase14 = $_POST['clase14'];

                            $cant_unid15 = $_POST["cant_unid15"];
                            $desc15 = $_POST["desc15"];
                            $codigo15 = $_POST['codigo15'];
                            $marca15 = $_POST['marca15'];
                            $color15 = $_POST['color15'];
                            $medidas15 = $_POST['medidas15'];
                            $clase15 = $_POST['clase15'];

                            $cant_unid16 = $_POST["cant_unid16"];
                            $desc16 = $_POST["desc16"];
                            $codigo16 = $_POST['codigo16'];
                            $marca16 = $_POST['marca16'];
                            $color16 = $_POST['color16'];
                            $medidas16 = $_POST['medidas16'];
                            $clase16 = $_POST['clase16'];

                            $cant_unid17 = $_POST["cant_unid17"];
                            $desc17 = $_POST["desc17"];
                            $codigo17 = $_POST['codigo17'];
                            $marca17 = $_POST['marca17'];
                            $color17 = $_POST['color17'];
                            $medidas17 = $_POST['medidas17'];
                            $clase17 = $_POST['clase17'];

                            $cant_unid18 = $_POST["cant_unid18"];
                            $desc18 = $_POST["desc18"];
                            $codigo18 = $_POST['codigo18'];
                            $marca18 = $_POST['marca18'];
                            $color18 = $_POST['color18'];
                            $medidas18 = $_POST['medidas18'];
                            $clase18 = $_POST['clase18'];

                            $cant_unid19 = $_POST["cant_unid19"];
                            $desc19 = $_POST["desc19"];
                            $codigo19 = $_POST['codigo19'];
                            $marca19 = $_POST['marca19'];
                            $color19 = $_POST['color19'];
                            $medidas19 = $_POST['medidas19'];
                            $clase19 = $_POST['clase19'];

                            $cant_unid20 = $_POST["cant_unid20"];
                            $desc20 = $_POST["desc20"];
                            $codigo20 = $_POST['codigo20'];
                            $marca20 = $_POST['marca20'];
                            $color20 = $_POST['color20'];
                            $medidas20 = $_POST['medidas20'];
                            $clase20 = $_POST['clase20'];

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

                            $sql = "INSERT INTO epp_tr_folios SET idsdgg='0'";
                            $result = mysql_query($sql) or die(mysql_error());
                            $id = mysql_insert_id();
                            $folio = strtoupper("SH-TR-" . $fol_ob . "-" . str_pad($id, 3, '0', STR_PAD_LEFT) . date("/ y"));

                            $currentdate = new DateTime('now', new DateTimeZone('America/Mazatlan'));

                            $date = $currentdate->format('Y-m-d');
                            $time = $currentdate->format('H:i:s');
                            $dayOfWeek = date("l", strtotime($date));

                            $splitDate = explode('-', $date);
                            $a = $splitDate[0];

                            $sql = "INSERT INTO epp_tr(year,datef,folio,supervisor_sol,empresa,obra,
                                cant_unid1,cant_unid2,cant_unid3,cant_unid4,cant_unid5,cant_unid6,cant_unid7,cant_unid8,cant_unid9,cant_unid10,cant_unid11,cant_unid12,cant_unid13,cant_unid14,cant_unid15,cant_unid16,cant_unid17,cant_unid18,cant_unid19,cant_unid20,
                                desc1,desc2,desc3,desc4,desc5,desc6,desc7,desc8,desc9,desc10,desc11,desc12,desc13,desc14,desc15,desc16,desc17,desc18,desc19,desc20,
                                codigo1,codigo2,codigo3,codigo4,codigo5,codigo6,codigo7,codigo8,codigo9,codigo10,codigo11,codigo12,codigo13,codigo14,codigo15,codigo16,codigo17,codigo18,codigo19,codigo20,
                                marca1,marca2,marca3,marca4,marca5,marca6,marca7,marca8,marca9,marca10,marca11,marca12,marca13,marca14,marca15,marca16,marca17,marca18,marca19,marca20,
                                color1,color2,color3,color4,color5,color6,color7,color8,color9,color10,color11,color12,color13,color14,color15,color16,color17,color18,color19,color20,
                                medidas1,medidas2,medidas3,medidas4,medidas5,medidas6,medidas7,medidas8,medidas9,medidas10,medidas11,medidas12,medidas13,medidas14,medidas15,medidas16,medidas17,medidas18,medidas19,medidas20,
                                clase1,clase2,clase3,clase4,clase5,clase6,clase7,clase8,clase9,clase10,clase11,clase12,clase13,clase14,clase15,clase16,clase17,clase18,clase19,clase20,observaciones_sup) VALUES ('" . $a . "','" . $date . "','" . $folio . "','" . $supervisor_sol . "','" . $empresa . "','" . $obra . "',
                                '" . $cant_unid1 . "','" . $cant_unid2 . "','" . $cant_unid3 . "','" . $cant_unid4 . "','" . $cant_unid5 . "','" . $cant_unid6 . "','" . $cant_unid7 . "','" . $cant_unid8 . "','" . $cant_unid9 . "','" . $cant_unid10 . "','" . $cant_unid11 . "','" . $cant_unid12 . "','" . $cant_unid13 . "','" . $cant_unid14 . "','" . $cant_unid15 . "','" . $cant_unid16 . "','" . $cant_unid17 . "','" . $cant_unid18 . "','" . $cant_unid19 . "','" . $cant_unid20 . "',
                                '" . $desc1 . "','" . $desc2 . "','" . $desc3 . "','" . $desc4 . "','" . $desc5 . "','" . $desc6 . "','" . $desc7 . "','" . $desc8 . "','" . $desc9 . "','" . $desc10 . "','" . $desc11 . "','" . $desc12 . "','" . $desc13 . "','" . $desc14 . "','" . $desc15 . "','" . $desc16 . "','" . $desc17 . "','" . $desc18 . "','" . $desc19 . "','" . $desc20 . "',
                                '" . $codigo1 . "','" . $codigo2 . "','" . $codigo3 . "','" . $codigo4 . "','" . $codigo5 . "','" . $codigo6 . "','" . $codigo7 . "','" . $codigo8 . "','" . $codigo9 . "','" . $codigo10 . "','" . $codigo11 . "','" . $codigo12 . "','" . $codigo13 . "','" . $codigo14 . "','" . $codigo15 . "','" . $codigo16 . "','" . $codigo17 . "','" . $codigo18 . "','" . $codigo19 . "','" . $codigo20 . "',
                                '" . $marca1 . "','" . $marca2 . "','" . $marca3 . "','" . $marca4 . "','" . $marca5 . "','" . $marca6 . "','" . $marca7 . "','" . $marca8 . "','" . $marca9 . "','" . $marca10 . "','" . $marca11 . "','" . $marca12 . "','" . $marca13 . "','" . $marca14 . "','" . $marca15 . "','" . $marca16 . "','" . $marca17 . "','" . $marca18 . "','" . $marca19 . "','" . $marca20 . "',
                                '" . $color1 . "','" . $color2 . "','" . $color3 . "','" . $color4 . "','" . $color5 . "','" . $color6 . "','" . $color7 . "','" . $color8 . "','" . $color9 . "','" . $color10 . "','" . $color11 . "','" . $color12 . "','" . $color13 . "','" . $color14 . "','" . $color15 . "','" . $color16 . "','" . $color17 . "','" . $color18 . "','" . $color19 . "','" . $color20 . "',
                                '" . $medidas1 . "','" . $medidas2 . "','" . $medidas3 . "','" . $medidas4 . "','" . $medidas5 . "','" . $medidas6 . "','" . $medidas7 . "','" . $medidas8 . "','" . $medidas9 . "','" . $medidas10 . "','" . $medidas11 . "','" . $medidas12 . "','" . $medidas13 . "','" . $medidas14 . "','" . $medidas15 . "','" . $medidas16 . "','" . $medidas17 . "','" . $medidas18 . "','" . $medidas19 . "','" . $medidas20 . "',
                                '" . $clase1 . "','" . $clase2 . "','" . $clase3 . "','" . $clase4 . "','" . $clase5 . "','" . $clase6 . "','" . $clase7 . "','" . $clase8 . "','" . $clase9 . "','" . $clase10 . "','" . $clase11 . "','" . $clase12 . "','" . $clase13 . "','" . $clase14 . "','" . $clase15 . "','" . $clase16 . "','" . $clase17 . "','" . $clase18 . "','" . $clase19 . "','" . $clase20 . "',
                                '" . $observaciones_sup . "')";
                            $result = mysql_query($sql) or die(mysql_error());


                            $sql = "UPDATE epp_tr_folios SET folio='" . $folio . "' WHERE id='" . $id . "'";
                            $result = mysql_query($sql) or die(mysql_error());
                            echo "<br>";
                            echo "<br>";
                            echo "<script languaje='javascript'>
                                    alert('Se ha enviado el pedido " . $folio . "')
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
                        }
                    } else {
                        echo "<script languaje='javascript'>
                                alert('Sólo puede generar pedidos trimestrales en los días 15 al 20.')
                                location.href='historial_tr?id=tw_redireccion';
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