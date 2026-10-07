<?php
date_default_timezone_set("Mexico/General");
session_start();
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario'])) {
  header('Location: ../../index');
  exit();
}
include("../../conexion/conexion.php");
$conexion = Conectarse();
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
    <div class="panel-body">
      <!--panel con el mensaje de bienvenida-->
      <div style="margin-top: 30px;text-align: center;">
        <ol class="breadcrumb">
          <?php echo " ¡Bienvenido " . ucwords($_SESSION['usuario']) . "! "; ?><a href="../../logout"></a>
        </ol>
      </div>
      <br>
      <!--Menu de la Pagina de Inicio-->
      <br>
      <?php
      if ($_SESSION['tipo_usuario'] == 'maquinaria') {
      ?>
        <div class="row">
          <div class="col-sm-4 col-md-3">
            <a href="maquinaria_gen" class="thumbnail">
              <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
              <h6 align="center">Maquinaria Pesada</h6>
            </a>
          </div>
          <div class="col-sm-4 col-md-3">
            <a href="transporte_gen" class="thumbnail">
              <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
              <h6 align="center">Transporte Especial</h6>
            </a>
          </div>
          <div class="col-sm-4 col-md-3">
            <a href="vehiculos_gen" class="thumbnail">
              <img src="../../img/material.png" alt="..." style="width: 140px;">
              <h6 align="center">Vehículos</h6>
            </a>
          </div>
          <div class="col-sm-4 col-md-3">
            <a href="reportes_maq" class="thumbnail">
              <img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
              <h6 align="center">Reportes</h6>
            </a>
          </div>
          <div class="col-sm-4 col-md-3">
            <a href="reportes_mec" class="thumbnail">
              <img src="../../img/generar.png" alt="..." style="width: 140px;">
              <h6 align="center">Reportes Vehículos</h6>
            </a>
          </div>

        </div>
      <?php
      } else if ($_SESSION['tipo_usuario'] == 'mecanicos') {
      ?>

        <div class="row">

          <?php
          if ($_SESSION['usuario'] == 'MECANICOSVM') {
          ?>
            <div class="col-sm-4 col-md-3">
              <a href="vehiculos_gen" class="thumbnail">
                <img src="../../img/material.png" alt="..." style="width: 140px;">
                <h6 align="center">Vehículos</h6>
              </a>
            </div>
          <?php
          }

          if ($_SESSION['usuario'] == 'MECANICOSVE') {
          ?>
            <div class="col-sm-4 col-md-3">
              <a href="mantenimientos_gen" class="thumbnail">
                <img src="../../img/material.png" alt="..." style="width: 140px;">
                <h6 align="center">Mantenimientos</h6>
              </a>
            </div>
          <?php
          }
          ?>

          <!-- Este lo ven los dos -->
          <div class="col-sm-4 col-md-3">
            <a href="reportes_mec" class="thumbnail">
              <img src="../../img/generar.png" alt="..." style="width: 140px;">
              <h6 align="center">Reportes</h6>
            </a>
          </div>

        </div>

      <?php
      } else {
        echo "No tiene acceso.";
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