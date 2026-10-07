<?php
date_default_timezone_set("Mexico/General");
session_start();
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']) && !isset($_SESSION['obra'])) {
    header('Location: ../../../index');
    exit();
}
include("../../../conexion/conexion.php");
$conexion = Conectarse();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuevo EPP</title>
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
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default " style="margin-top: 5px;">
            <div class="panel-body">
                <div class="element">
                    <form action="insertar_tr" method="post">
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php
                                                                                                                if ($_SESSION['obra'] == "Administrativo") {
                                                                                                                    $fol_ob = "ADM";
                                                                                                                } else if ($_SESSION['obra'] == "Concretos Cavi") {
                                                                                                                    $fol_ob = "CON";
                                                                                                                } else if ($_SESSION['obra'] == "Proyectos de Construcción Concretos") {
                                                                                                                    $fol_ob = "PCC";
                                                                                                                } else if ($_SESSION['obra'] == "Sucursal MyT Control Vehicular") {
                                                                                                                    $fol_ob = "CVE";
                                                                                                                } else if ($_SESSION['obra'] == "Herradura") {
                                                                                                                    $fol_ob = "HER";
                                                                                                                } else if ($_SESSION['obra'] == "Sucursal MyT Maquinaria Pesada") {
                                                                                                                    $fol_ob = "MPE";
                                                                                                                } else if ($_SESSION['obra'] == "Mantenimiento Multifuncional") {
                                                                                                                    $fol_ob = "MTO";
                                                                                                                } else if ($_SESSION['obra'] == "Sucursal MyT Administración") {
                                                                                                                    $fol_ob = "MYT";
                                                                                                                } else if ($_SESSION['obra'] == "Sucursal MyT Mecánicos Zona Foránea") {
                                                                                                                    $fol_ob = "MZF";
                                                                                                                } else if ($_SESSION['obra'] == "Proyecto San Julián") {
                                                                                                                    $fol_ob = "PSJ";
                                                                                                                } else if ($_SESSION['obra'] == "Reclutamiento") {
                                                                                                                    $fol_ob = "REC";
                                                                                                                } else if ($_SESSION['obra'] == "Sabinas") {
                                                                                                                    $fol_ob = "SAB";
                                                                                                                } else if ($_SESSION['obra'] == "Saucito") {
                                                                                                                    $fol_ob = "SAU";
                                                                                                                } else if ($_SESSION['obra'] == "Sucursal Planta de Pailería, Soldadura y Blindaje de Molinos") {
                                                                                                                    $fol_ob = "SPP";
                                                                                                                } else if ($_SESSION['obra'] == "Sucursal MyT Transporte Especial") {
                                                                                                                    $fol_ob = "TES";
                                                                                                                } else if ($_SESSION['obra'] == "Tocayos Agosto 2019") {
                                                                                                                    $fol_ob = "TOC";
                                                                                                                } else if ($_SESSION['obra'] == "Juanicipio") {
                                                                                                                    $fol_ob = "JNC";
                                                                                                                } else {
                                                                                                                    $fol_ob = $_GET['acronimo'];
                                                                                                                }

                                                                                                                mysql_query("SET NAMES 'utf8'");
                                                                                                                $result = mysql_query("SELECT id FROM epp_tr_folios ORDER BY id DESC LIMIT 1", $conexion);
                                                                                                                if ($row = mysql_fetch_array($result)) {
                                                                                                                    do {
                                                                                                                        $folio = strtoupper("SH-TR-" . $fol_ob . "-" . str_pad($row["id"] + 1, 3, '0', STR_PAD_LEFT) . date("/y"));
                                                                                                                        echo $folio;
                                                                                                                    } while ($row = mysql_fetch_array($result));
                                                                                                                } else {
                                                                                                                    $currY = date("y");
                                                                                                                    echo "SH-TR-" . $fol_ob . "-001/" . $currY;
                                                                                                                }
                                                                                                                ?> ">
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm" required value="<?php echo $_SESSION["nombre"]; ?>">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Empresa</i></label>
                                <select name='empresa' class='form-control input-sm' required>
                                    <option value="" selected disabled>-- Selecciona --</option>
                                    <option value="Cavi de Sombrerete S.A. de C.V.">Cavi de Sombrerete S.A. de C.V.</option>
                                    <option value="Concretos Cavi S.A. de C.V.">Concretos Cavi S.A. de C.V.</option>
                                    <option value="Montajes y Estructuras de Zacatecas S.A. de C.V.">Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                    <option value="Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.">Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm' required>
                                    <option value="" selected disabled>-- Selecciona --</option>
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
                                <input class="form-control input-sm" type="text" name="cant_unid1">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label">Descripcion</label>
                                <input class="form-control input-sm" type="text" name="desc1" />
                            </div>
                            <div class="col-xs-1">
                                <label class="control-label">Código</label>
                                <input class="form-control input-sm" type="text" name="codigo1">
                            </div>
                            <div class="col-xs-1">
                                <label class="control-label">Marca</label>
                                <input class="form-control input-sm" type="text" name="marca1">
                            </div>
                            <div class="col-xs-1">
                                <label class="control-label">Color</label>
                                <input class="form-control input-sm" type="text" name="color1">
                            </div>
                            <div class="col-xs-2">
                                <label class="control-label">Medidas</label>
                                <input class="form-control input-sm" type="text" name="medidas1">
                            </div>
                            <div class="col-xs-1">
                                <label class="control-label">Clase</label>
                                <input class="form-control input-sm" type="text" name="clase1">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid2">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc2" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo2">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca2">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color2">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas2">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase2">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid3">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc3" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo3">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca3">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color3">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas3">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase3">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid4">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc4" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo4">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca4">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color4">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas4">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase4">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid5">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc5" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo5">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca5">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color5">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas5">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase5">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid6">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc6" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo6">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca6">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color6">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas6">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase6">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid7">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc7" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo7">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca7">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color7">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas7">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase7">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid8">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc8" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo8">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca8">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color8">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas8">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase8">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid9">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc9" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo9">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca9">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color9">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas9">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase9">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid10">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc10" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo10">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca10">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color10">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas10">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase10">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid11">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc11" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo11">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca11">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color11">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas11">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase11">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid12">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc12" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo12">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca12">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color12">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas12">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase12">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid13">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc13" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo13">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca13">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color13">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas13">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase13">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid14">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc14" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo14">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca14">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color14">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas14">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase14">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid15">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc15" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo15">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca15">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color15">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas15">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase15">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid16">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc16" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo16">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca16">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color16">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas16">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase16">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid17">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc17" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo17">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca17">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color17">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas17">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase17">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid18">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc18" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo18">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca18">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color18">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas18">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase18">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid19">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc19" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo19">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca19">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color19">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas19">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase19">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="cant_unid20">
                            </div>
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="desc20" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="codigo20">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="marca20">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="color20">
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-sm" type="text" name="medidas20">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="clase20">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Observaciones</label>
                                <textarea name="observaciones_sup" class="form-control "></textarea>
                            </div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-5">
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-success">ENVIAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../../../js/bootstrap.min.js"></script>
</body>

</html>