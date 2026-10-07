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
  <link href="../../css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../../css/fixedColumns.bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-inverse" role="navigation">
    <p align="center" style="color: white; margin-top: 12px; font-size: 18px;">SISTEMA DE PEDIDOS</p>
  </nav>
  <div class="container" style="padding-top: 1em;">
    <div class="panel-body">
      <?php
      error_reporting(E_ALL ^ E_NOTICE);
      mysql_query("SET NAMES 'UTF8'");
      mysql_query("SET lc_time_names = 'es_MX'");
      $buscar = $_GET['buscar'];
      //Paginacion
      $currentPage = $_SERVER["PHP_SELF"];
      $maxRows_folio = 10;
      $pageNum_folio = 0;
      if (isset($_GET['pageNum_folio'])) {
        $pageNum_folio = $_GET['pageNum_folio'];
      }
      $currY = date("y");
      $currM = date("n");
      $startRow_folio = $pageNum_folio * $maxRows_folio;
      if ($currM == 1) {
        $query = "SELECT folio, date_format(fecha,'%d %M %Y') AS fecha_modificada, supervisor, proyecto, id_pedido,estado, folio_af FROM pedidos WHERE estado!='Surtido' AND enviado='Enviado' AND estado!='Solicitud Surtido' AND estado!='Surtido en Almacen' AND estado!='Cancelado' AND year=($currY) ORDER BY fecha ASC";
      } else {
        $query = "SELECT folio, date_format(fecha,'%d %M %Y') AS fecha_modificada, supervisor, proyecto, id_pedido,estado, folio_af FROM pedidos WHERE (enviado='Enviado' AND year=$currY) 
            OR (estado!='Surtido' AND enviado='Enviado' AND estado!='Solicitud Surtido' AND estado!='Surtido en Almacen' AND estado!='Cancelado' AND year=($currY-1)) ORDER BY fecha ASC";
      }
      //$query_limit = sprintf("%s LIMIT %d, %d", $query, $startRow_folio,$maxRows_folio );
      $folio = mysql_query($query) or die(mysql_error());
      $row_folio = mysql_fetch_assoc($folio);
      if (isset($_GET['totalRows_folio'])) {
        $totalRows_folio = $_GET['totalRows_folio'];
      } else {
        $all_folio = mysql_query($query);
        $totalRows_folio = mysql_num_rows($all_folio);
      }
      $totalPages_folio = ceil($totalRows_folio / $maxRows_folio) - 1;
      $queryString_folio = "";
      if (!empty($_SERVER['QUERY_STRING'])) {
        $params = explode("&", $_SERVER['QUERY_STRING']);
        $newParams = array();
        foreach ($params as $param) {
          if (stristr($param, "pageNum_folio") == false && stristr($param, "totalRows_folio") == false) {
            array_push($newParams, $param);
          }
        }
        if (count($newParams) != 0) {
          $queryString_folio = "&" . htmlentities(implode("&", $newParams));
        }
      }
      $queryString_folio = sprintf("&totalRows_folio=%d%s", $totalRows_folio, $queryString_folio);
      //GENERA LA TABLA PARA MOSTRAR LOS DATOS
      ?>
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
      if ($_SESSION['usuario'] == 'COMPRADORC1' || $_SESSION['usuario'] == 'CINTHIAC') {
      ?>
        <div class="row">
          <div class="col-sm-4 col-md-3">
            <a href="papeleria_gen_a" class="thumbnail">
              <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
              <h6 align="center">Papelería</h6>
            </a>
          </div>
          <div class="col-sm-4 col-md-3">
            <a href="material_gen_a" class="thumbnail">
              <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
              <h6 align="center">Material</h6>
            </a>
          </div>
          <div class="col-sm-4 col-md-3">
            <a href="agencias_gen_a" class="thumbnail">
              <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
              <h6 align="center">Agencias</h6>
            </a>
          </div>
          <div class="col-sm-4 col-md-3">
            <a href="cotizaciones_gen_a" class="thumbnail">
              <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
              <h6 align="center">Cotizaciones</h6>
            </a>
          </div>
        </div>
      <?php
      } else if ($_SESSION['tipo_usuario'] == 'compras') {
      ?>
        <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
          <thead>
            <tr>
              <th><strong>FECHA</strong></th>
              <th><strong>SUPERVISOR</strong></th>
              <th><strong>PROYECTO</strong></th>
              <th><strong>FOLIO</strong></th>
              <th><strong>FOLIO COMPRAS</strong></th>
              <th><strong>ESTADO</strong></th>
              <th><strong>EDITAR</strong></th>
              <th><strong>GENERAR</strong></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $vacio = mysql_query($query) or die(mysql_error());
            do {
              if ($row_folio["estado"] == 'Enviado') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='danger'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='danger'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='danger'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='danger'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='danger'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='danger' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='danger' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' class='danger' align='center'></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'Recibido') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='warning'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' class='warning' align='center'></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'Revisión Solicitante') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='warning'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' class='warning' align='center'></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'Recabando doctos') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='warning'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' class='warning' align='center'></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'Detenido') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='warning'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' class='warning' align='center'></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'En Almacen') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='warning'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' class='warning' align='center'></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'Revisando al proveedor') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='warning'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' class='warning' align='center'></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'Cotizando') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='warning'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' class='warning'align='center'><a class='glyphicon glyphicon-floppy-save' href=./REPORTES/genpedidoexcel?id_pedido=" . $row_folio["id_pedido"] . "&lug=" . $_SESSION["tipo_usuario"] . "></a></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'En proceso de surtir') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='warning'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-floppy-save' href=./REPORTES/genpedidoexcel?id_pedido=" . $row_folio["id_pedido"] . "&lug=" . $_SESSION["tipo_usuario"] . "></a></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'Surtido en Almacen') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='warning'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-floppy-save' href=./REPORTES/genpedidoexcel?id_pedido=" . $row_folio["id_pedido"] . "&lug=" . $_SESSION["tipo_usuario"] . "></a></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'Solicitud Surtido') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='warning'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-floppy-save' href=./REPORTES/genpedidoexcel?id_pedido=" . $row_folio["id_pedido"] . "&lug=" . $_SESSION["tipo_usuario"] . "></a></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'Autorizado para Compra') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='warning'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='warning'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-floppy-save' href=./REPORTES/genpedidoexcel?id_pedido=" . $row_folio["id_pedido"] . "&lug=" . $_SESSION["tipo_usuario"] . "></a></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'Surtido Parcial' || $row_folio["estado"] == 'Aceptado') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='success'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='success'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='success'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='success'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='success'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='success' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='success' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' class='success' align='center'><a class='glyphicon glyphicon-floppy-save' href=./REPORTES/genpedidoexcel?id_pedido=" . $row_folio["id_pedido"] . "&lug=" . $_SESSION["tipo_usuario"] . "></a></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'Surtido') {
                echo "<tr>" .
                  "<td style='font-size:12px;'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar?id_pedido=" . $row_folio["id_pedido"] . "></a></td>" .
                  "<td style='font-size:12px;' align='center'><a class='glyphicon glyphicon-floppy-save' href=./REPORTES/genpedidoexcel?id_pedido=" . $row_folio["id_pedido"] . "&lug=" . $_SESSION["tipo_usuario"] . "></a></td>" .

                  "</tr>";
              } else if ($row_folio["estado"] == 'Cancelado') {
                echo "<tr>" .
                  "<td style='font-size:12px;' class='danger'>" . ucwords($row_folio["fecha_modificada"]) . "</td>" .
                  "<td style='font-size:12px;' class='danger'>" . $row_folio["supervisor"] . "</td>" .
                  "<td style='font-size:12px;' class='danger'>" . $row_folio["proyecto"] . "</td>" .
                  "<td style='font-size:12px;' class='danger'>" . $row_folio["folio"] . "</td>" .
                  "<td style='font-size:12px;' class='danger'>" . $row_folio["folio_af"] . "</td>" .
                  "<td style='font-size:12px;' class='danger' align='center'>" . $row_folio["estado"] . "</td>" .
                  "<td style='font-size:12px;' class='danger' align='center'></td>" .
                  "<td style='font-size:12px;' class='danger' align='center'></td>" .

                  "</tr>";
              }
            } while ($row_folio = mysql_fetch_array($folio));
            ?>
          </tbody>
        </table>
        <div class="row">
          <div class="col-sm-4 col-md-3">
            <?php
            $sql_query = "SELECT * FROM pedidos WHERE enviado='Enviado' AND estado='Enviado' AND estado!='Cancelado' AND tipo_compra='EPP'";
            $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());

            if (mysql_num_rows($resultado) > 0) {
            ?>
              <a href="epp_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: #e92b2b; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">EPP</h6>
              </a>
            <?php
            } else {
            ?>
              <a href="epp_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: transparent; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">EPP</h6>
              </a>
            <?php
            }
            ?>
          </div>
          <div class="col-sm-4 col-md-3">
            <?php
            $sql_query = "SELECT * FROM pedidos WHERE enviado='Enviado' AND estado='Enviado' AND estado!='Cancelado' AND tipo_compra='Examen Médico'";
            $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());

            if (mysql_num_rows($resultado) > 0) {
            ?>
              <a href="examenes_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: #e92b2b; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Exámenes Médico</h6>
              </a>
            <?php
            } else {
            ?>
              <a href="examenes_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: transparent; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Exámenes Médico</h6>
              </a>
            <?php
            }
            ?>
          </div>
          <div class="col-sm-4 col-md-3">
            <?php
            $sql_query = "SELECT * FROM pedidos WHERE enviado='Enviado' AND estado='Enviado' AND estado!='Cancelado' AND tipo_compra='Insumos'";
            $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());

            if (mysql_num_rows($resultado) > 0) {
            ?>
              <a href="insumos_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: #e92b2b; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Insumos Médicos/Laboratorio</h6>
              </a>
            <?php
            } else {
            ?>
              <a href="insumos_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: transparent; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Insumos Médicos/Laboratorio</h6>
              </a>
            <?php
            }
            ?>
          </div>
          <div class="col-sm-4 col-md-3">
            <?php
            $sql_query = "SELECT * FROM pedidos WHERE enviado='Enviado' AND estado='Enviado' AND estado!='Cancelado' AND tipo_compra='Papelería'";
            $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());

            if (mysql_num_rows($resultado) > 0) {
            ?>
              <a href="papeleria_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: #e92b2b; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Papelería</h6>
              </a>
            <?php
            } else {
            ?>
              <a href="papeleria_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: transparent; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Papelería</h6>
              </a>
            <?php
            }
            ?>
          </div>
          <div class="col-sm-4 col-md-3">
            <?php
            $sql_query = "SELECT * FROM pedidos WHERE enviado='Enviado' AND estado='Enviado' AND estado!='Cancelado' AND tipo_compra='General'";
            $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());

            if (mysql_num_rows($resultado) > 0) {
            ?>
              <a href="material_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: #e92b2b; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Pedidos Generales</h6>
              </a>
            <?php
            } else {
            ?>
              <a href="material_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: transparent; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Pedidos Generales</h6>
              </a>
            <?php
            }
            ?>
          </div>
          <div class="col-sm-4 col-md-3">
            <?php
            $sql_query = "SELECT * FROM pedidos WHERE enviado='Enviado' AND estado='Enviado' AND estado!='Cancelado' AND tipo_compra='Productos'";
            $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());

            if (mysql_num_rows($resultado) > 0) {
            ?>
              <a href="productos_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: #e92b2b; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Prod. Limpieza</h6>
              </a>
            <?php
            } else {
            ?>
              <a href="productos_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: transparent; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Prod. Limpieza</h6>
              </a>
            <?php
            }
            ?>
          </div>
          <div class="col-sm-4 col-md-3">
            <?php
            $sql_query = "SELECT * FROM pedidos WHERE enviado='Enviado' AND estado='Enviado' AND estado!='Cancelado' AND tipo_compra='Agencias'";
            $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());

            if (mysql_num_rows($resultado) > 0) {
            ?>
              <a href="agencias_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: #e92b2b; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Servicios de Agencia</h6>
              </a>
            <?php
            } else {
            ?>
              <a href="agencias_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: transparent; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Servicios de Agencia</h6>
              </a>
            <?php
            }
            ?>
          </div>
          <div class="col-sm-4 col-md-3">
            <?php
            $sql_query = "SELECT * FROM pedidos WHERE enviado='Enviado' AND estado='Enviado' AND estado!='Cancelado' AND tipo_compra='Toner'";
            $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());

            if (mysql_num_rows($resultado) > 0) {
            ?>
              <a href="toner_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: #e92b2b; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Toner</h6>
              </a>
            <?php
            } else {
            ?>
              <a href="toner_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: transparent; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Toner</h6>
              </a>
            <?php
            }
            ?>
          </div>
          <div class="col-sm-4 col-md-3">
            <?php
            $sql_query = "SELECT * FROM cotizaciones WHERE estado='Enviado_comp'";
            $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());

            if (mysql_num_rows($resultado) > 0) {
            ?>
              <a href="cotizaciones_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: #e92b2b; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Cotizaciones</h6>
              </a>
            <?php
            } else {
            ?>
              <a href="cotizaciones_gen" class="thumbnail"><span class="glyphicon glyphicon-bookmark" style="color: transparent; font-size: 20px;"></span>
                <img src="../../img/material.png" alt="..." data-src="" style="width: 140px;">
                <h6 align="center">Cotizaciones</h6>
              </a>
            <?php
            }
            ?>
          </div>
          <div class="col-sm-4 col-md-3">
            <a href="REPORTES/reporte_cot" class="thumbnail">
              <img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
              <h6 align="center">Reporte Cotizaciones</h6>
            </a>
          </div>
          <div class="col-sm-4 col-md-3">
            <a href="reportes" class="thumbnail">
              <img src="../../img/generar.png" alt="..." data-src="" style="width: 140px;">
              <h6 align="center">Reportes Pedidos</h6>
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
  <script src="../../js/jquery.dataTables.min.js"></script>
  <script src="../../js/dataTables.bootstrap.min.js"></script>
  <script src="../../js/dataTables.fixedColumns.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#example').DataTable({
        scrollY: "300px",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: true
      });
    });
  </script>
</body>

</html>