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
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inicio</title>
  <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body>
  <nav class="navbar navbar-inverse" role="navigation">
    <p align="center" style="color: white; margin-top: 12px; font-size: 18px;">SISTEMA DE PEDIDOS</p>
  </nav>
  <div class="container" style="padding-top: 1em;">
    <div class="panel panel-default" style="margin-top: 5px;">
      <div class="panel-body">
        <div style="margin-top: 30px;text-align: center;">
          <ol class="breadcrumb">
            <?php echo " ¡Bienvenido " . ucwords($_SESSION['usuario']) . " ! "; ?><a href="../../logout"></a>
          </ol>
        </div>
        <br>
        <!--Mensaje que muestra el ultimo folio utilizado-->
        <div align="center" class="row" style="margin-top: 5px;">
          <div align="center" class=" col-xs-12">
            <label>Ultimo Folio Utilizado</label>
            <ol class="breadcrumb">
              <?php
              mysql_query("SET NAMES 'utf8'");
              $result = mysql_query("SELECT pedidos.folio, pedidos.supervisor FROM pedidos INNER JOIN folios_subdir ON folios_subdir.folio=pedidos.folio WHERE pedidos.gerencia='SUBDIR' ORDER BY pedidos.id_pedido DESC LIMIT 1", $conexion);
              if ($row = mysql_fetch_array($result)) {
                do {
                  echo $row["folio"] . " POR " . $row["supervisor"];
                } while ($row = mysql_fetch_array($result));
              } else {
                echo "¡ No se ha encontrado ningún registro !";
              }
              ?>
            </ol>
          </div>
        </div>
        <br>
        <!--Menu de la Pagina de Inicio-->
        <br>
        <?php
        if ($_SESSION['tipo_usuario'] == 'superusuario') {
        ?>
          <div class="row">
            <div class="col-sm-6 col col-md-3" align="justify"></div>
            <div class="col-sm-6 col-md-3">
              <a href="historial_su" class="thumbnail">
                <img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Historial</h6>
              </a>
            </div>
            <div class="col-sm-6 col-md-3">
              <a href="historial_gerencia_alm" class="thumbnail">
                <img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Historial Almacén</h6>
              </a>
            </div>
            <div class="col-sm-4 col-md-3">
              <a href="reportes_su" class="thumbnail">
                <img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Reportes</h6>
              </a>
            </div>
          </div><br>
        <?php
        } elseif ($_SESSION['tipo_usuario'] == 'gerencia') {
        ?>
          <div class="row">
            <div class="col-sm-6 col-md-4">
              <a href="historial_gerencia" class="thumbnail">
                <img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Historial Compras</h6>
              </a>
            </div>
            <div class="col-sm-4 col-md-4">
              <a href="reporte_general_g" class="thumbnail">
                <img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Reporte General Compras</h6>
              </a>
            </div>
            <div class="col-sm-4 col-md-4">
              <a href="reporte_obra" class="thumbnail">
                <img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Reporte por Obra Compras</h6>
              </a>
            </div>
            <div class="col-sm-6 col-md-4">
              <a href="historial_gerencia_int" class="thumbnail">
                <img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Historial Servicios Internos</h6>
              </a>
            </div>
            <div class="col-sm-4 col-md-4">
              <a href="reporte_general_g_int" class="thumbnail">
                <img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Reporte General Servicios Internos</h6>
              </a>
            </div>
            <div class="col-sm-4 col-md-4">
              <a href="reporte_obra_int" class="thumbnail">
                <img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Reporte por Obra Servicios Internos</h6>
              </a>
            </div>
          </div>
        <?php
        } elseif ($_SESSION['tipo_usuario'] == 'user') {
        ?>
          <div class="row">
            <div class="col-sm-4 col col-md-3" align="justify">
              <a href="nuevocls" class="thumbnail">
                <img src="../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Nuevo Pedido Compras</h6>
              </a>
            </div>
            <div class="col-sm-4 col-md-3">
              <a href="historial_gen" class="thumbnail">
                <img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Historial Compras</h6>
              </a>
            </div>
            <div class="col-sm-4 col-md-3">
              <a href="reporte_general" class="thumbnail">
                <img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Reporte Compras</h6>
              </a>
            </div>
            <div class="col-sm-4 col-md-3">
              <a href="obras" class="thumbnail">
                <img src="../../img/obras.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Obras</h6>
              </a>
            </div>
            <div class="col-sm-4 col col-md-3" align="justify">
              <a href="nuevo_int" class="thumbnail">
                <img src="../../img/nuevop.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Nuevo Pedido Servicios Internos</h6>
              </a>
            </div>
            <div class="col-sm-4 col-md-3">
              <a href="historial_int" class="thumbnail">
                <img src="../../img/historial.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Historial Servicios Internos</h6>
              </a>
            </div>
            <div class="col-sm-4 col-md-3">
              <a href="reporte_general_int" class="thumbnail">
                <img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Reporte Servicios Internos</h6>
              </a>
            </div>
          </div>
        <?php
        }

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