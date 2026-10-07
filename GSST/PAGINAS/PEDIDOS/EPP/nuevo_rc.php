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
                    <form action="insertar_rc" method="post">
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
                                                                                                                $result = mysql_query("SELECT id FROM epp_rc_folios ORDER BY id DESC LIMIT 1", $conexion);
                                                                                                                if ($row = mysql_fetch_array($result)) {
                                                                                                                    do {
                                                                                                                        $folio = strtoupper("SH-RC-" . $fol_ob . "-" . str_pad($row["id"] + 1, 3, '0', STR_PAD_LEFT) . date("/y"));
                                                                                                                        echo $folio;
                                                                                                                    } while ($row = mysql_fetch_array($result));
                                                                                                                } else {
                                                                                                                    $currY = date("y");
                                                                                                                    echo "SH-RC-" . $fol_ob . "-001/" . $currY;
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
                                    <option selected disabled>-- Selecciona --</option>
                                    <option value="Cavi de Sombrerete S.A. de C.V.">Cavi de Sombrerete S.A. de C.V.</option>
                                    <option value="Concretos Cavi S.A. de C.V.">Concretos Cavi S.A. de C.V.</option>
                                    <option value="Montajes y Estructuras de Zacatecas S.A. de C.V.">Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                    <option value="Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.">Sucursal Montajes y Estructuras de Zacatecas S.A. de C.V.</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' id="obras" class='form-control input-sm' required>
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
                            <div class="col-xs-4">
                                <label class="control-label">Nombre</label>
                                <input class="form-control input-sm" type="text" name="nombre1">
                            </div>
                            <div class="col-xs-1">
                                <label class="control-label">T.Overol</label>
                                <input class="form-control input-sm" type="text" name="talla_overol1" />
                            </div>
                            <div class="col-xs-1">
                                <label class="control-label">T.Zapato</label>
                                <input class="form-control input-sm" type="text" name="talla_zapato1">
                            </div>
                            <div class="col-xs-1" id="b1">
                                <label class="control-label">T.Bota</label>
                                <input class="form-control input-sm" type="text" name="talla_bota1">
                            </div>
                            <div class="col-xs-1">
                                <label class="control-label">T.Camisa</label>
                                <input class="form-control input-sm" type="text" name="talla_camisa1">
                            </div>
                            <div class="col-xs-1" id="p1">
                                <label class="control-label">T.Pantalón</label>
                                <input class="form-control input-sm" type="text" name="talla_pantalon1">
                            </div>
                            <div class="col-xs-1">
                                <label class="control-label">T.Chaleco</label>
                                <input class="form-control input-sm" type="text" name="talla_chaleco1">
                            </div>
                            <div class="col-xs-1">
                                <label class="control-label">T.Bata</label>
                                <input class="form-control input-sm" type="text" name="talla_bata1">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre2">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol2" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato2">
                            </div>
                            <div class="col-xs-1" id="b2">
                                <input class="form-control input-sm" type="text" name="talla_bota2">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa2">
                            </div>
                            <div class="col-xs-1" id="p2">
                                <input class="form-control input-sm" type="text" name="talla_pantalon2">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco2">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata2">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre3">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol3" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato3">
                            </div>
                            <div class="col-xs-1" id="b3">
                                <input class="form-control input-sm" type="text" name="talla_bota3">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa3">
                            </div>
                            <div class="col-xs-1" id="p3">
                                <input class="form-control input-sm" type="text" name="talla_pantalon3">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco3">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata3">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre4">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol4" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato4">
                            </div>
                            <div class="col-xs-1" id="b4">
                                <input class="form-control input-sm" type="text" name="talla_bota4">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa4">
                            </div>
                            <div class="col-xs-1" id="p4">
                                <input class="form-control input-sm" type="text" name="talla_pantalon4">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco4">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata4">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre5">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol5" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato5">
                            </div>
                            <div class="col-xs-1" id="b5">
                                <input class="form-control input-sm" type="text" name="talla_bota5">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa5">
                            </div>
                            <div class="col-xs-1" id="p5">
                                <input class="form-control input-sm" type="text" name="talla_pantalon5">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco5">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata5">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre6">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol6" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato6">
                            </div>
                            <div class="col-xs-1" id="b6">
                                <input class="form-control input-sm" type="text" name="talla_bota6">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa6">
                            </div>
                            <div class="col-xs-1" id="p6">
                                <input class="form-control input-sm" type="text" name="talla_pantalon6">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco6">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata6">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre7">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol7" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato7">
                            </div>
                            <div class="col-xs-1" id="b7">
                                <input class="form-control input-sm" type="text" name="talla_bota7">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa7">
                            </div>
                            <div class="col-xs-1" id="p7">
                                <input class="form-control input-sm" type="text" name="talla_pantalon7">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco7">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata7">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre8">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol8" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato8">
                            </div>
                            <div class="col-xs-1" id="b8">
                                <input class="form-control input-sm" type="text" name="talla_bota8">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa8">
                            </div>
                            <div class="col-xs-1" id="p8">
                                <input class="form-control input-sm" type="text" name="talla_pantalon8">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco8">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata8">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre9">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol9" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato9">
                            </div>
                            <div class="col-xs-1" id="b9">
                                <input class="form-control input-sm" type="text" name="talla_bota9">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa9">
                            </div>
                            <div class="col-xs-1" id="p9">
                                <input class="form-control input-sm" type="text" name="talla_pantalon9">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco9">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata9">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre10">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol10" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato10">
                            </div>
                            <div class="col-xs-1" id="b10">
                                <input class="form-control input-sm" type="text" name="talla_bota10">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa10">
                            </div>
                            <div class="col-xs-1" id="p10">
                                <input class="form-control input-sm" type="text" name="talla_pantalon10">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco10">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata10">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre11">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol11" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato11">
                            </div>
                            <div class="col-xs-1" id="b11">
                                <input class="form-control input-sm" type="text" name="talla_bota11">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa11">
                            </div>
                            <div class="col-xs-1" id="p11">
                                <input class="form-control input-sm" type="text" name="talla_pantalon11">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco11">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata11">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre12">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol12" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato12">
                            </div>
                            <div class="col-xs-1" id="b12">
                                <input class="form-control input-sm" type="text" name="talla_bota12">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa12">
                            </div>
                            <div class="col-xs-1" id="p12">
                                <input class="form-control input-sm" type="text" name="talla_pantalon12">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco12">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata12">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre13">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol13" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato13">
                            </div>
                            <div class="col-xs-1" id="b13">
                                <input class="form-control input-sm" type="text" name="talla_bota13">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa13">
                            </div>
                            <div class="col-xs-1" id="p13">
                                <input class="form-control input-sm" type="text" name="talla_pantalon13">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco13">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata13">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre14">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol14" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato14">
                            </div>
                            <div class="col-xs-1" id="b14">
                                <input class="form-control input-sm" type="text" name="talla_bota14">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa14">
                            </div>
                            <div class="col-xs-1" id="p14">
                                <input class="form-control input-sm" type="text" name="talla_pantalon14">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco14">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata14">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre15">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol15" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato15">
                            </div>
                            <div class="col-xs-1" id="b15">
                                <input class="form-control input-sm" type="text" name="talla_bota15">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa15">
                            </div>
                            <div class="col-xs-1" id="p15">
                                <input class="form-control input-sm" type="text" name="talla_pantalon15">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco15">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata15">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre16">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol16" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato16">
                            </div>
                            <div class="col-xs-1" id="b16">
                                <input class="form-control input-sm" type="text" name="talla_bota16">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa16">
                            </div>
                            <div class="col-xs-1" id="p16">
                                <input class="form-control input-sm" type="text" name="talla_pantalon16">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco16">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata16">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre17">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol17" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato17">
                            </div>
                            <div class="col-xs-1" id="b17">
                                <input class="form-control input-sm" type="text" name="talla_bota17">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa17">
                            </div>
                            <div class="col-xs-1" id="p17">
                                <input class="form-control input-sm" type="text" name="talla_pantalon17">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco17">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata17">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre18">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol18" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato18">
                            </div>
                            <div class="col-xs-1" id="b18">
                                <input class="form-control input-sm" type="text" name="talla_bota18">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa18">
                            </div>
                            <div class="col-xs-1" id="p18">
                                <input class="form-control input-sm" type="text" name="talla_pantalon18">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco18">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata18">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre19">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol19" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato19">
                            </div>
                            <div class="col-xs-1" id="b19">
                                <input class="form-control input-sm" type="text" name="talla_bota19">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa19">
                            </div>
                            <div class="col-xs-1" id="p19">
                                <input class="form-control input-sm" type="text" name="talla_pantalon19">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco19">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata19">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-4">
                                <input class="form-control input-sm" type="text" name="nombre20">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_overol20" />
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_zapato20">
                            </div>
                            <div class="col-xs-1" id="b20">
                                <input class="form-control input-sm" type="text" name="talla_bota20">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_camisa20">
                            </div>
                            <div class="col-xs-1" id="p20">
                                <input class="form-control input-sm" type="text" name="talla_pantalon20">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_chaleco20">
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control input-sm" type="text" name="talla_bata20">
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
        <script type="text/javascript">
            document.getElementById('obras').addEventListener('change', function(e) {
                if (e.target.value === "Herradura") {
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
                }
            });
        </script>
</body>

</html>