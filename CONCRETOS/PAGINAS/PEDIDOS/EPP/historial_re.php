<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']) && !isset($_SESSION['user_epp']))
	{
		header('Location: ../../../index');
		exit();
	}
	include("../../../conexion/conexion.php"); 
  $conexion=Conectarse();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historial EPP</title>
    <!-- Bootstrap -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
		.rojo {background-color:#FF0000;}
		.azul {color:#0066FF;}
		.verde {color:#009900;}
		select{
			background-color:#FF66FF;
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
      			</ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
      			</ul>
    		</div>
        </nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">EPP Pedidos de Reemplazo</div>
            <div class="panel-body">
            	<?php  
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'UTF8'");
					mysql_query("SET lc_time_names = 'es_MX'");
					$buscar=$_GET['buscar'];
					//Paginacion
					$currentPage = $_SERVER["PHP_SELF"];
					$maxRows_folio = 10;
					$pageNum_folio = 0;
					if (isset($_GET['pageNum_folio'])) {
  						$pageNum_folio = $_GET['pageNum_folio'];
					}
					$startRow_folio = $pageNum_folio * $maxRows_folio;
          $currentdate = new DateTime('now', new DateTimeZone('America/Mazatlan'));

          $date = $currentdate->format('Y-m-d');
          $time = $currentdate->format('H:i:s');
          $dayOfWeek = date("l", strtotime($date));

          $splitDate = explode('-', $date);
          $a = $splitDate[0];
          if($_SESSION['user_epp']=='res')
					{
					  $query= "SELECT id,folio, date_format(fecha,'%d %M %Y') AS fecha_modificada, supervisor_sol, obra,autorizado_residente,date_format(fecha_autorizado_residente,'%d %M %Y') AS fecha_residente, autorizado_sasst,date_format(fecha_autorizado_sasst,'%d %M %Y') AS fecha_sasst, autorizado_gerseg,date_format(fecha_autorizado_gerseg,'%d %M %Y') AS fecha_gerseg,autorizado_gerob,date_format(fecha_autorizado_gerob,'%d %M %Y') AS fecha_gerob, logistica FROM epp_re WHERE year = '".$a."' AND obra='Concretos Cavi' ORDER BY folio ASC";
          }
          else if($_SESSION['user_epp']=='gerob')
					{
					  $query= "SELECT id,folio, date_format(fecha,'%d %M %Y') AS fecha_modificada, supervisor_sol, obra,autorizado_residente,date_format(fecha_autorizado_residente,'%d %M %Y') AS fecha_residente, autorizado_sasst,date_format(fecha_autorizado_sasst,'%d %M %Y') AS fecha_sasst, autorizado_gerseg,date_format(fecha_autorizado_gerseg,'%d %M %Y') AS fecha_gerseg,autorizado_gerob,date_format(fecha_autorizado_gerob,'%d %M %Y') AS fecha_gerob, logistica FROM epp_re WHERE autorizado_gerseg='Autorizado' AND year = '".$a."' AND obra='Concretos Cavi' ORDER BY folio ASC";
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
					$totalPages_folio = ceil($totalRows_folio/$maxRows_folio)-1;
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
                <?php 
					if($_SESSION['user_epp']=='sup')
					{
				?>
    				<table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
    					<thead>
      						<tr class="blue-distinct">
                                <th><strong>Folio</strong></th>
                                <th><strong>Fecha</strong></th>
                                <th><strong>Supervisor</strong></th>
                                <th><strong>Obra</strong></th>
                                <th><strong>Residente</strong></th>
                                <th><strong>SASST</strong></th>
                                <th><strong>Ger.Seguridad</strong></th>
                                <th><strong>Dir. Op</strong></th>
                                <th><strong>Logística</strong></th>
                                <th><strong>Editar/Ver</strong></th>
      						</tr>
                    	</thead>
                    <tbody>
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

  				$vacio=mysql_query($query) or die (mysql_error());
                do {
                    if ($row_folio["autorizado_residente"]=='Autorizado' && $row_folio["autorizado_sasst"]=='Autorizado' && $row_folio["autorizado_gerseg"]=='Autorizado' && $row_folio["autorizado_gerob"]=='Autorizado')
                    {
                        echo"<tr>".
                                "<td style='font-size:12px;' class='success'>".$row_folio["folio"]."</td>".
                                "<td style='font-size:12px;' class='success'>".ucwords($row_folio["fecha_modificada"])."</td>".
                                "<td style='font-size:12px;' class='success'>".$row_folio["supervisor_sol"]."</td>".
                                "<td style='font-size:12px;' class='success'>".$row_folio["obra"]."</td>".
                                "<td style='font-size:12px;' class='success'>".$row_folio["autorizado_residente"]."<br>".$row_folio["fecha_residente"]."</td>".
                                "<td style='font-size:12px;' class='success'>".$row_folio["autorizado_sasst"]."<br>".$row_folio["fecha_sasst"]."</td>".
                                "<td style='font-size:12px;' class='success'>".$row_folio["autorizado_gerseg"]."<br>".$row_folio["fecha_gerseg"]."</td>".
                                "<td style='font-size:12px;' class='success'>".$row_folio["autorizado_gerob"]."<br>".$row_folio["fecha_gerob"]."</td>".
                                "<td style='font-size:12px;' class='success'>".$row_folio["logistica"]."</td>".
                                "<td style='font-size:12px;' class='success' align='center'><a class='glyphicon glyphicon-pencil' href=./ver_re?id_pedido=".$row_folio["id"]."></a></td>".
                                "</tr>";
                    }
                    else
                    {
                        echo"<tr>".
                                "<td style='font-size:12px;' class='warning'>".$row_folio["folio"]."</td>".
                                "<td style='font-size:12px;' class='warning'>".ucwords($row_folio["fecha_modificada"])."</td>".
                                "<td style='font-size:12px;' class='warning'>".$row_folio["supervisor_sol"]."</td>".
                                "<td style='font-size:12px;' class='warning'>".$row_folio["obra"]."</td>".
                                "<td style='font-size:12px;' class='warning'>".$row_folio["autorizado_residente"]."<br>".$row_folio["fecha_residente"]."</td>".
                                "<td style='font-size:12px;' class='warning'>".$row_folio["autorizado_sasst"]."<br>".$row_folio["fecha_sasst"]."</td>".
                                "<td style='font-size:12px;' class='warning'>".$row_folio["autorizado_gerseg"]."<br>".$row_folio["fecha_gerseg"]."</td>".
                                "<td style='font-size:12px;' class='warning'>".$row_folio["autorizado_gerob"]."<br>".$row_folio["fecha_gerob"]."</td>".
                                "<td style='font-size:12px;' class='warning'>".$row_folio["logistica"]."</td>".
                                "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar_re?id_pedido=".$row_folio["id"]."></a></td>".
                                "</tr>";
                    }
							}while($row_folio=mysql_fetch_array($folio));		
						?>
						</tbody>
      				</table>
              
                        <?php
					}
					else{
						?>  
      					<table class="table table-bordered table-hover">
        					<tbody>
          						<tr>
                                    <th><strong>Folio</strong></th>
                                    <th><strong>Fecha</strong></th>
                                    <th><strong>Supervisor</strong></th>
                                    <th><strong>Obra</strong></th>
                                    <th><strong>Residente</strong></th>
                                    <th><strong>SASST</strong></th>
                                    <th><strong>Ger.Seguridad</strong></th>
                                    <th><strong>Dir. Op</strong></th>
                                    <th><strong>Logística</strong></th>
                                    <th><strong>Editar/Ver</strong></th>
          						</tr>
         				<?php 
		  					$vacio=mysql_query($query) or die (mysql_error());
 							do {
                if ($row_folio["autorizado_residente"]=='Autorizado' && $row_folio["autorizado_sasst"]=='Autorizado' && $row_folio["autorizado_gerseg"]=='Autorizado' && $row_folio["autorizado_gerob"]=='Autorizado')
                    {
                                echo"<tr>".
                                "<td style='font-size:12px;'>".$row_folio["folio"]."</td>".
                                "<td style='font-size:12px;'>".ucwords($row_folio["fecha_modificada"])."</td>".
                                "<td style='font-size:12px;'>".$row_folio["supervisor_sol"]."</td>".
                                "<td style='font-size:12px;'>".$row_folio["obra"]."</td>".
                                "<td style='font-size:12px;'>".$row_folio["autorizado_residente"]."<br>".$row_folio["fecha_residente"]."</td>".
                                "<td style='font-size:12px;'>".$row_folio["autorizado_sasst"]."<br>".$row_folio["fecha_sasst"]."</td>".
                                "<td style='font-size:12px;'>".$row_folio["autorizado_gerseg"]."<br>".$row_folio["fecha_gerseg"]."</td>".
                                "<td style='font-size:12px;'>".$row_folio["autorizado_gerob"]."<br>".$row_folio["fecha_gerob"]."</td>".
                                "<td style='font-size:12px;'>".$row_folio["logistica"]."</td>".
                                "<td style='font-size:12px;' align='center'><a class='glyphicon glyphicon-pencil' href=./ver_re?id_pedido=".$row_folio["id"]."></a></td>".
                                "</tr>";
                    }
                    else {
                      {
                        echo"<tr>".
                        "<td style='font-size:12px;'>".$row_folio["folio"]."</td>".
                        "<td style='font-size:12px;'>".ucwords($row_folio["fecha_modificada"])."</td>".
                        "<td style='font-size:12px;'>".$row_folio["supervisor_sol"]."</td>".
                        "<td style='font-size:12px;'>".$row_folio["obra"]."</td>".
                        "<td style='font-size:12px;'>".$row_folio["autorizado_residente"]."<br>".$row_folio["fecha_residente"]."</td>".
                        "<td style='font-size:12px;'>".$row_folio["autorizado_sasst"]."<br>".$row_folio["fecha_sasst"]."</td>".
                        "<td style='font-size:12px;'>".$row_folio["autorizado_gerseg"]."<br>".$row_folio["fecha_gerseg"]."</td>".
                        "<td style='font-size:12px;'>".$row_folio["autorizado_gerob"]."<br>".$row_folio["fecha_gerob"]."</td>".
                        "<td style='font-size:12px;'>".$row_folio["logistica"]."</td>".
                        "<td style='font-size:12px;' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar_re?id_pedido=".$row_folio["id"]."></a></td>".
                        "</tr>";
            }
                    }
							}
              while($row_folio=mysql_fetch_array($folio));		
						?>
                        	</tbody>
      					</table>
      					<?php
					}
						?>	
                        <div align="center">
                
                Registros totales: <?php echo $totalRows_folio ?>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../../../js/jquery-3.3.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/jquery.dataTables.min.js"></script>
    <script src="../../../js/dataTables.bootstrap.min.js"></script>
    <script src="../../../js/dataTables.fixedColumns.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() 
      {
        var table = $('#example').DataTable( {
            scrollY:        "300px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            fixedColumns:   true
        } );
      });
    </script>
  </body>
</html>