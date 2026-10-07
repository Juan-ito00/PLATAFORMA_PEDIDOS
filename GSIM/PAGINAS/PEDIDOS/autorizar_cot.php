<?php
date_default_timezone_set("Mexico/General");
session_start();
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario'])) {
  header('Location: ../../index');
  exit();
}
include("../../conexion/conexion.php");
$conexion = Conectarse();

use PHPMailer\PHPMailer\PHPMailer;

require_once('../../autoload.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modificar Pedido</title>
  <!-- Bootstrap -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <!--Barra de titulo-->
  <nav class="navbar navbar-inverse" role="navigation">
    <p align="center" style="color: white; margin-top: 12px; font-size: 18px;">SISTEMA DE PEDIDOS</p>
  </nav>
  <!--Barra de pie de pagina
  	<nav class="navbar navbar-inverse navbar-fixed-bottom">
  		<div align="center"><img class="img-responsive" height="55" width="165" src="../img/cavi.png"> </img></div>
  	</nav>-->
  <!--Contenedor donde va todo el contenido de la pagina-->
  <div class="container" style="padding-top: 1px;">

    <!--Menu horizontal de la parte superior-->
    <nav class="navbar navbar-default nav" style="margin-top:5px;" role="navigation">
      <!-- El logotipo y el icono que despliega el menú se agrupan
        para mostrarlos mejor en los dispositivos móviles -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Desplegar navegación</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
      </div>
      <!-- Agrupar los enlaces de navegación, los formularios y cualquier
         	otro elemento que se pueda ocultar al minimizar la barra -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right">
          <p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido " . $_SESSION['usuario'] . " "; ?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
        </ul>
      </div>
    </nav>
    <!--Panel con el titulo de la pagina y contenido-->
    <div class="panel panel-default" style="margin-top: 5px;">
      <div align="center" class="panel-heading">Autorizar Cotización</div>
      <div class="panel-body">
        <?php
        header("Content-Type: text/html;charset=utf-8");
        error_reporting(E_ALL ^ E_NOTICE);
        mysql_query("SET NAMES 'utf8'");
        if (isset($_POST["submit"])) {
          $query = "UPDATE cotizaciones SET estado='Autorizado' WHERE id_pedido='" . $_POST["id"] . "' AND gerencia='GTI'";
          $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

          echo "<script languaje='javascript'>
                                     alert('Se ha autorizado el pedido con folio " . $_POST["folio"] . "')
               location.href='historial_gerencia_cot?id=tw_redireccion';
                                 </script>";
        } else if (isset($_POST["submit2"])) {
          $query = "UPDATE cotizaciones SET estado='No Autorizado' WHERE id_pedido='" . $_POST["id"] . "' AND gerencia='GTI'";
          $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

          echo "<script languaje='javascript'>
                                     alert('No se ha autorizado el pedido con folio " . $_POST["folio"] . "')
               location.href='historial_gerencia_cot?id=tw_redireccion';
                                 </script>";
        } else {
          $id_pedido = $_GET['id_pedido'];
          $sql_query = "SELECT * FROM cotizaciones WHERE id_pedido='" . $id_pedido . "'";
          $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());
          if (mysql_num_rows($resultado) > 0) {
            while ($Rs = mysql_fetch_array($resultado)) {
        ?>
              <form method="post" name=frm action="autorizar_cot">
                <div class="row form-horizontal">
                  <!--Campo Tipo de Compra-->
                  <div class="col-xs-3">
                    <label class="control-label">Tipo de Cotización</label>
                    <select name="tipo_cotizacion" class="form-control input-sm " readonly>
                      <option class="form-control input-sm"><?php echo $Rs['tipo_cotizacion']; ?></option>
                      <option value="Exámenes Médicos" class="form-control input-sm" id="">Exámenes Médicos</option>
                      <option value="Materiales" class="form-control input-sm">Materiales</option>
                      <option value="EPP" class="form-control input-sm">EPP</option>
                      <option value="Herramientas" class="form-control input-sm">Herramientas</option>
                      <option value="Alimentos" class="form-control input-sm">Alimentos</option>
                      <option value="Hospedaje" class="form-control input-sm">Hospedaje</option>
                      <option value="Equipos" class="form-control input-sm">Equipos</option>
                    </select>
                  </div>
                  <div class="col-xs-2">
                    <label class="control-label">Fecha Requerida</label>
                    <input readonly name="fecha_requerido" type="date" class="form-control input-sm" value="<?php echo $Rs['fecha_requerido']; ?>">
                  </div>
                  <!--Campo Supervisor-->
                  <div class="col-xs-3">
                    <label class="control-label">Solicitante</label>
                    <input readonly name="solicitante" type="text" class="form-control input-sm" value="<?php echo $Rs['solicitante']; ?>">
                  </div>
                  <!--Campo Folio-->
                  <div class="col-xs-2">
                    <label class="control-label">Folio Gerencia</label>
                    <input readonly align="right" name="folio_gerencia" class="form-control input-sm" value="<?php echo $Rs['folio_gerencia']; ?>">
                  </div>
                  <div class="col-xs-2">
                    <label class="control-label">Folio Compras</label>
                    <input readonly align="right" name="folio_compras" class="form-control input-sm" value="<?php echo $Rs['folio_compras']; ?>">
                  </div>
                </div>
                <!--Div fecha, proyecto,supervisor, ubicacion-->
                <!--Campo Ubicacion-->
                <div class="row form-horizontal">
                  <div class="col-xs-4">
                    <label class="control-label">Ubicación de Obra</label>
                    <input readonly name="ubicacion_obra" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['ubicacion_obra']); ?>">
                  </div>
                  <div class="col-xs-4">
                    <label class="control-label">Lugar de Cotización</label>
                    <input readonly name="lugar_cotizacion" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['lugar_cotizacion']); ?>">
                  </div>
                  <div class="col-xs-4">
                    <label class="control-label">Proyecto</label>
                    <input readonly name="proyecto" type="text" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['proyecto']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <div class="col-xs-10">
                    <input name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id_pedido']; ?>" size="17" />
                  </div>
                </div>
                <!--divs cantidad unidad descripcion-->
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1"><br>
                    <label class="control-label">1.</label>
                  </div>
                  <div class="col-xs-5">
                    <label class="control-label">Descripcion</label>
                    <input readonly type="text" class="form-control input-sm" name="descripcion1" value="<?php echo htmlspecialchars($Rs['desc1']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <label class="control-label">Unidad</label>
                    <input readonly type="text" name="unidad1" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid1']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <label class="control-label">Firma de Recepción en Parcialidades</label>
                    <input readonly type="text" class="form-control input-sm" name="firma_rp1" value="<?php echo htmlspecialchars($Rs['firma_rp1']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">2.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion2" value="<?php echo htmlspecialchars($Rs['desc2']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad2" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid2']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp2" value="<?php echo htmlspecialchars($Rs['firma_rp2']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">3.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion3" value="<?php echo htmlspecialchars($Rs['desc3']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad3" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid3']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp3" value="<?php echo htmlspecialchars($Rs['firma_rp3']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">4.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion4" value="<?php echo htmlspecialchars($Rs['desc4']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad4" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid4']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp4" value="<?php echo htmlspecialchars($Rs['firma_rp4']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">5.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion5" value="<?php echo htmlspecialchars($Rs['desc5']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad5" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid5']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp5" value="<?php echo htmlspecialchars($Rs['firma_rp5']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">6.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion6" value="<?php echo htmlspecialchars($Rs['desc6']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad6" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid6']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp6" value="<?php echo htmlspecialchars($Rs['firma_rp6']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">7.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion7" value="<?php echo htmlspecialchars($Rs['desc7']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad7" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid7']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp7" value="<?php echo htmlspecialchars($Rs['firma_rp7']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">8.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion8" value="<?php echo htmlspecialchars($Rs['desc8']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad8" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid8']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp8" value="<?php echo htmlspecialchars($Rs['firma_rp8']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">9.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion9" value="<?php echo htmlspecialchars($Rs['desc9']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad9" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid9']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp9" value="<?php echo htmlspecialchars($Rs['firma_rp9']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">10.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion10" value="<?php echo htmlspecialchars($Rs['desc10']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad10" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid10']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp10" value="<?php echo htmlspecialchars($Rs['firma_rp10']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">11.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion11" value="<?php echo htmlspecialchars($Rs['desc11']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad11" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid11']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp11" value="<?php echo htmlspecialchars($Rs['firma_rp11']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">12.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion12" value="<?php echo htmlspecialchars($Rs['desc12']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad12" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid12']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp12" value="<?php echo htmlspecialchars($Rs['firma_rp12']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">13.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion13" value="<?php echo htmlspecialchars($Rs['desc13']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad13" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid13']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp13" value="<?php echo htmlspecialchars($Rs['firma_rp13']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">14.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion14" value="<?php echo htmlspecialchars($Rs['desc14']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad14" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid14']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp14" value="<?php echo htmlspecialchars($Rs['firma_rp14']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">15.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion15" value="<?php echo htmlspecialchars($Rs['desc15']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad15" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid15']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp15" value="<?php echo htmlspecialchars($Rs['firma_rp15']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">16.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion16" value="<?php echo htmlspecialchars($Rs['desc16']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad16" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid16']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp16" value="<?php echo htmlspecialchars($Rs['firma_rp16']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">17.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion17" value="<?php echo htmlspecialchars($Rs['desc17']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad17" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid17']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp17" value="<?php echo htmlspecialchars($Rs['firma_rp17']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">18.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion18" value="<?php echo htmlspecialchars($Rs['desc18']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad18" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid18']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp18" value="<?php echo htmlspecialchars($Rs['firma_rp18']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">19.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion19" value="<?php echo htmlspecialchars($Rs['desc19']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad19" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid19']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp19" value="<?php echo htmlspecialchars($Rs['firma_rp19']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Campo Descripcion-->
                  <div class="col-xs-1">
                    <label class="control-label">20.</label>
                  </div>
                  <div class="col-xs-5">
                    <input readonly type="text" class="form-control input-sm" name="descripcion20" value="<?php echo htmlspecialchars($Rs['desc20']); ?>">
                  </div>
                  <!--Campo Unidad-->
                  <div class="col-xs-2">
                    <input readonly type="text" name="unidad20" class="form-control input-sm" value="<?php echo htmlspecialchars($Rs['unid20']); ?>">
                  </div>
                  <!--Campo Uso-->
                  <div class="col-xs-4">
                    <input readonly type="text" class="form-control input-sm" name="firma_rp20" value="<?php echo htmlspecialchars($Rs['firma_rp20']); ?>">
                  </div>
                </div>
                <div class="row form-horizontal">
                  <!--Caja de notas-->
                  <div class="col-xs-12">
                    <label class="control-label">Notas</label>
                    <textarea readonly name="notas" class="form-control "><?php echo htmlspecialchars($Rs['notas']); ?></textarea>
                  </div>
                </div>
                <br>
                <div id="btn-form">
                  <input class="btn form-btn btn-primary" type="submit" name="submit" value="Autorizar">
                  <input class="btn form-btn btn-primary" type="submit" name="submit2" value="No Autorizar">
                </div>
              </form>
        <?php
            }
          } else {
            echo "<script languaje='javascript'>
                            alert('No fue posible realizar la operacion solicitada al pedido con ID" . $id_pedido . "')
                    javascript:history.go(-2)
                              </script>";
          }
        }
        // Cerramos la conexión
        mysql_close($conexion);
        ?>
      </div>
    </div>
  </div>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../../js/bootstrap.min.js"></script>
</body>

</html>