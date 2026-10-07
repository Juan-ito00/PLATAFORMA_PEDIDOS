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
      			<a class="navbar-brand" href="../inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
    		</div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
      			<ul class="nav navbar-nav">
            <?php if($_SESSION['user_epp'] == 'sup'){
                if($_SESSION['usuario'] == "AYLIN"){?>
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
                    <?php }
                        else {?>
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
                    <?php if($_SESSION['user_epp'] == 'sasst'){ ?>
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
                    <?php }
                    else if($_SESSION['user_epp'] == 'alm'){ ?>
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
	                </li><?php }
                    else if($_SESSION['user_epp'] == 'gerseg'){ ?>
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
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../../logout"></a></p>
      			</ul>
    		</div>
        </nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">EPP Pedidos Nuevo Ingreso</div>
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

          if($_SESSION['user_epp'] == 'alm'){
            $query= "SELECT id,folio, date_format(fecha,'%d %M %Y') AS fecha_modificada, supervisor_sol, obra, autorizado_almacen,date_format(fecha_autorizado_almacen,'%d %M %Y') AS fecha_almacen, logistica FROM epp_ni WHERE year = '".$a."' ORDER BY folio ASC";
          }
          else if($_SESSION['user_epp'] == 'gerseg'){
					  $query= "SELECT id,folio, date_format(fecha,'%d %M %Y') AS fecha_modificada, supervisor_sol, obra, autorizado_almacen,date_format(fecha_autorizado_almacen,'%d %M %Y') AS fecha_almacen, logistica FROM epp_ni WHERE autorizado_almacen='Autorizado' AND year = '".$a."' ORDER BY folio ASC";
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
                if($_SESSION['user_epp']=='alm')
					{
				?>
    				<table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
    					<thead>
      						<tr class="blue-distinct">
                                <th><strong>Folio</strong></th>
                                <th><strong>Fecha</strong></th>
                                <th><strong>Supervisor</strong></th>
                                <th><strong>Obra</strong></th>
                                <th><strong>Almacén</strong></th>
                                <th><strong>Logística</strong></th>
                                <th><strong>Editar/Ver</strong></th>
      						</tr>
                    	</thead>
                    <tbody>
          				<?php

  				$vacio=mysql_query($query) or die (mysql_error());
                do {
                    if ($row_folio["autorizado_almacen"]=='Autorizado')
                    {
                        echo"<tr>".
                            "<td style='font-size:12px;' class='success'>".$row_folio["folio"]."</td>".
                            "<td style='font-size:12px;' class='success'>".ucwords($row_folio["fecha_modificada"])."</td>".
                            "<td style='font-size:12px;' class='success'>".$row_folio["supervisor_sol"]."</td>".
                            "<td style='font-size:12px;' class='success'>".$row_folio["obra"]."</td>".
                            "<td style='font-size:12px;' class='success'>".$row_folio["autorizado_almacen"]."<br>".$row_folio["fecha_almacen"]."</td>".
                            "<td style='font-size:12px;' class='success'>".$row_folio["logistica"]."</td>".
                            "<td style='font-size:12px;' class='success' align='center'><a class='glyphicon glyphicon-pencil' href=./ver_ni?id_pedido=".$row_folio["id"]."></a></td>".
                            "</tr>";
                    }
                    else
                    {
                            echo"<tr>".
                                    "<td style='font-size:12px;' class='warning'>".$row_folio["folio"]."</td>".
                                    "<td style='font-size:12px;' class='warning'>".ucwords($row_folio["fecha_modificada"])."</td>".
                                    "<td style='font-size:12px;' class='warning'>".$row_folio["supervisor_sol"]."</td>".
                                    "<td style='font-size:12px;' class='warning'>".$row_folio["obra"]."</td>".
                                    "<td style='font-size:12px;' class='warning'>".$row_folio["autorizado_almacen"]."<br>".$row_folio["fecha_almacen"]."</td>".
                                    "<td style='font-size:12px;' class='warning'>".$row_folio["logistica"]."</td>".
                                    "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./modificar_ni?id_pedido=".$row_folio["id"]."></a></td>".
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
                                    <th><strong>Almacén</strong></th>
                                <th><strong>Logística</strong></th>
                                    <th><strong>Editar/Ver</strong></th>
          						</tr>
         				<?php 
		  					$vacio=mysql_query($query) or die (mysql_error());
 							do {
                      echo"<tr>".
                      "<td style='font-size:12px;' class='warning'>".$row_folio["folio"]."</td>".
                      "<td style='font-size:12px;' class='warning'>".ucwords($row_folio["fecha_modificada"])."</td>".
                      "<td style='font-size:12px;' class='warning'>".$row_folio["supervisor_sol"]."</td>".
                      "<td style='font-size:12px;' class='warning'>".$row_folio["obra"]."</td>".
                      "<td style='font-size:12px;' class='warning'>".$row_folio["autorizado_almacen"]."<br>".$row_folio["fecha_almacen"]."</td>".
                      "<td style='font-size:12px;' class='warning'>".$row_folio["logistica"]."</td>".
                      "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./ver_ni?id_pedido=".$row_folio["id"]."></a></td>".
                  "</tr>";
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