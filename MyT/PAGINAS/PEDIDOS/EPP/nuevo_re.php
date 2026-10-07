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

                    <?php if ($_SESSION['usuario'] == 'JESUSV') { ?>
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
                    <?php } else { ?>
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
                    <p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido " . ucwords($_SESSION['usuario']) . " | "; ?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
                </ul>
            </div>
        </nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default " style="margin-top: 5px;">
            <div class="panel-body">
                <div class="element">
                    <form action="insertar_re" method="post" enctype="multipart/form-data">
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label blue-distinct"><i>Folio</i></label>
                                <input readonly align="right" name="folio" class="form-control input-sm" value="<?php
                                                                                                                if ($_SESSION['obra'] == "Administrativo") {
                                                                                                                    $fol_ob = "ADM";
                                                                                                                } else if ($_SESSION['obra'] == "Proyectos de Construcción Concretos") {
                                                                                                                    $fol_ob = "PCC";
                                                                                                                } else if ($_SESSION['obra'] == "Concretos Cavi") {
                                                                                                                    $fol_ob = "CON";
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
                                                                                                                $result = mysql_query("SELECT id FROM epp_re_folios ORDER BY id DESC LIMIT 1", $conexion);
                                                                                                                if ($row = mysql_fetch_array($result)) {
                                                                                                                    do {
                                                                                                                        $folio = strtoupper("SH-RE-" . $fol_ob . "-" . str_pad($row["id"] + 1, 3, '0', STR_PAD_LEFT) . date("/y"));
                                                                                                                        echo $folio;
                                                                                                                    } while ($row = mysql_fetch_array($result));
                                                                                                                } else {
                                                                                                                    $currY = date("y");
                                                                                                                    echo "SH-RE- -001/" . $currY;
                                                                                                                }
                                                                                                                ?> ">
                            </div>
                            <div class="col-xs-5">
                                <label class="control-label blue-distinct"><i>Supervisor Solicitante</i></label>
                                <input readonly name="supervisor_sol" type="text" class="form-control input-sm" required value="<?php echo $_SESSION["nombre"]; ?>">
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Motivo</i></label>
                                <select name='motivo' class='form-control input-sm'>
                                    <option selected disabled>-- Selecciona --</option>
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
                                <input name="trabajador" type="text" class="form-control input-sm" required>
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label blue-distinct"><i>Fecha de Ingreso</i></label>
                                <input name="fecha_ingreso" type="date" class="form-control input-sm" required>
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label blue-distinct"><i>Obra</i></label>
                                <select name='obra' class='form-control input-sm'>
                                    <option selected disabled>-- Selecciona --</option>
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
                                <input name="categoria" type="text" class="form-control input-sm" required>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp1' class='form-control input-sm' id="epp1" onchange="e1()">
                                    <option selected disabled>-- Selecciona --</option>
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
                            <div class="col-xs-2">
                                <label class="control-label">Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp1">
                            </div>
                            <div class="col-xs-2">
                                <label class="control-label">Talla Solicitada</label>
                                <input class="form-control input-sm" type="text" name="talla_epp1">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp2' class='form-control input-sm' id="epp2" onchange="e2()">
                                    <option selected disabled>-- Selecciona --</option>
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
                            <div class="col-xs-2">
                                <label class="control-label">Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp2">
                            </div>
                            <div class="col-xs-2">
                                <label class="control-label">Talla Solicitada</label>
                                <input class="form-control input-sm" type="text" name="talla_epp2">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp3' class='form-control input-sm' id="epp3" onchange="e3()">
                                    <option selected disabled>-- Selecciona --</option>
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
                            <div class="col-xs-2">
                                <label class="control-label">Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp3">
                            </div>
                            <div class="col-xs-2">
                                <label class="control-label">Talla Solicitada</label>
                                <input class="form-control input-sm" type="text" name="talla_epp3">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp4' class='form-control input-sm' id="epp4" onchange="e4()">
                                    <option selected disabled>-- Selecciona --</option>
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
                            <div class="col-xs-2">
                                <label class="control-label">Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp4">
                            </div>
                            <div class="col-xs-2">
                                <label class="control-label">Talla Solicitada</label>
                                <input class="form-control input-sm" type="text" name="talla_epp4">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp5' class='form-control input-sm' id="epp5" onchange="e5()">
                                    <option selected disabled>-- Selecciona --</option>
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
                            <div class="col-xs-2">
                                <label class="control-label">Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp5">
                            </div>
                            <div class="col-xs-2">
                                <label class="control-label">Talla Solicitada</label>
                                <input class="form-control input-sm" type="text" name="talla_epp5">
                            </div>
                        </div><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-2" style="text-align:center;">
                                <label class="control-label">Equipo</label>
                                <select name='epp6' class='form-control input-sm' id="epp6" onchange="e6()">
                                    <option selected disabled>-- Selecciona --</option>
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
                            <div class="col-xs-2">
                                <label class="control-label">Última Entrega</label>
                                <input class="form-control input-sm" type="date" name="fut_epp6">
                            </div>
                            <div class="col-xs-2">
                                <label class="control-label">Talla Solicitada</label>
                                <input class="form-control input-sm" type="text" name="talla_epp6">
                            </div>
                        </div><br><br>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                            </div>
                            <div class="col-xs-8" style="text-align:center;">
                                <label class="control-label">Evidencia Fotográfica del Reemplazo</label>
                                <input class="form-control input-sm" type="file" accept="image/jpeg" name="foto_ev1">
                                <input class="form-control input-sm" type="file" accept="image/jpeg" name="foto_ev2">
                                <input class="form-control input-sm" type="file" accept="image/jpeg" name="foto_ev3">
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
        <script>
            function e1() {
                let ep1 = document.getElementById("epp1").value;
                if (ep1 == "OTROS") {
                    document.getElementById("otro1").hidden = false;
                } else {
                    document.getElementById("otro1").hidden = true;
                }
            }

            function e2() {
                let ep2 = document.getElementById("epp2").value;
                if (ep2 == "OTROS") {
                    document.getElementById("otro2").hidden = false;
                } else {
                    document.getElementById("otro2").hidden = true;
                }
            }

            function e3() {
                let ep3 = document.getElementById("epp3").value;
                if (ep3 == "OTROS") {
                    document.getElementById("otro3").hidden = false;
                } else {
                    document.getElementById("otro3").hidden = true;
                }
            }

            function e4() {
                let ep4 = document.getElementById("epp4").value;
                if (ep4 == "OTROS") {
                    document.getElementById("otro4").hidden = false;
                } else {
                    document.getElementById("otro4").hidden = true;
                }
            }

            function e5() {
                let ep5 = document.getElementById("epp5").value;
                if (ep5 == "OTROS") {
                    document.getElementById("otro5").hidden = false;
                } else {
                    document.getElementById("otro5").hidden = true;
                }
            }

            function e6() {
                let ep6 = document.getElementById("epp6").value;
                if (ep6 == "OTROS") {
                    document.getElementById("otro6").hidden = false;
                } else {
                    document.getElementById("otro6").hidden = true;
                }
            }
        </script>
</body>

</html>