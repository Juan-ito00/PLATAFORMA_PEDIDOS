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

        .green-distinct {
            color: #048125;
        }

        .resaltado {
            border: solid 1px black;
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
                    <?php if ($_SESSION['user_epp'] == 'res') { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
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
                    <?php } else if ($_SESSION['user_epp'] == 'glp') { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial Extraordinarios<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="historial_exk">Extraordinario</a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="reportesk" class="" data-toggle=""><span class="glyphicon glyphicon-list-alt"> </span> Reportes</a>
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

                if (isset($_POST["autG"])) {
                    $fecha_info = date('Y-m-d');
                    $query = "UPDATE epp_ex SET contrato1='" . $_POST["contrato1"] . "',contrato2='" . $_POST["contrato2"] . "',
                        contrato3='" . $_POST["contrato3"] . "',contrato4='" . $_POST["contrato4"] . "',
                        contrato5='" . $_POST["contrato5"] . "',precio1='" . $_POST["precio1"] . "',
                        precio2='" . $_POST["precio2"] . "',precio3='" . $_POST["precio3"] . "',
                        precio4='" . $_POST["precio4"] . "',precio5='" . $_POST["precio5"] . "',
                        observaciones1='" . $_POST["observaciones1"] . "',observaciones2='" . $_POST["observaciones2"] . "',
                        observaciones3='" . $_POST["observaciones3"] . "',observaciones4='" . $_POST["observaciones4"] . "',
                        observaciones5='" . $_POST["observaciones5"] . "',autorizado_gcp='Información',fecha_autorizado_gcp='" . $fecha_info . "' WHERE folio ='" . $_POST["folio"] . "'";
                    $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

                    echo "<script languaje='javascript'>
                                alert('Se ha modificado el pedido con folio " . $_POST["folio"] . "')
                    location.href='historial_exk?id=tw_redireccion';
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
                    // $correo_sasst = "karina_rodriguez@grupocavi.com.mx";
                    $correo_sasst = "maricruz_flores@grupocavi.com.mx";
                    $mail->AddAddress($correo_sasst);
                    $folp = $_POST['folio'];

                    $mail->WordWrap = 50;
                    $mail->IsHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->Subject = "Sistema de Pedidos de EPP | GRUPO CAVI";
                    $mail->Body = "<h2>|  Pedido de EPP Extraordinario revisado por GLP |</h2><br><p>Estimado (a) encargado de SASST:</p><p>Te informamos que el pedido " . $folp . " ya fue revisado por Gerencia de Licitaciones.</p><p>¡Saludos!</p><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                                Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico: soporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";

                    if (!$mail->Send()) {
                        echo "Fallo";
                    }
                } else {
                    $id_pedido = $_GET['id_pedido'];
                    $sql_query = "SELECT * FROM epp_ex WHERE id='" . $id_pedido . "'";
                    $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());
                    if (mysql_num_rows($resultado) > 0) {
                        while ($Rs = mysql_fetch_array($resultado)) {
                            if ($_SESSION['user_epp'] == "glp") { ?>

                                <form action="modificar_exk" method="post">
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
                                            <select name='obra' class='form-control input-sm' disabled>
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
                                            <select name='contrato1' class='form-control input-sm resaltado'>
                                                <option selected><?php echo $Rs['contrato1']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio1" value="<?php echo $Rs['precio1']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones1" value="<?php echo $Rs['observaciones1']; ?>">
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
                                            <select name='contrato2' class='form-control input-sm resaltado'>
                                                <option selected><?php echo $Rs['contrato2']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio2" value="<?php echo $Rs['precio2']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones2" value="<?php echo $Rs['observaciones2']; ?>">
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
                                            <select name='contrato3' class='form-control input-sm resaltado'>
                                                <option selected><?php echo $Rs['contrato3']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio3" value="<?php echo $Rs['precio3']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones3" value="<?php echo $Rs['observaciones3']; ?>">
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
                                            <select name='contrato4' class='form-control input-sm resaltado'>
                                                <option selected><?php echo $Rs['contrato4']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio4" value="<?php echo $Rs['precio4']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones4" value="<?php echo $Rs['observaciones4']; ?>">
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
                                            <select name='contrato5' class='form-control input-sm resaltado'>
                                                <option selected><?php echo $Rs['contrato5']; ?></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="control-label green-distinct">Precio</label>
                                            <input class="form-control input-sm resaltado" type="text" name="precio5" value="<?php echo $Rs['precio5']; ?>">
                                        </div>
                                        <div class="col-xs-8">
                                            <label class="control-label green-distinct">Observaciones</label>
                                            <input class="form-control input-sm resaltado" type="text" name="observaciones5" value="<?php echo $Rs['observaciones5']; ?>">
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
                                    </div><br>
                                    <div class="row form-horizontal">
                                        <div class="col-xs-5">
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="btn form-btn btn-success" type="submit" name="autG" value="Modificar">
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