 <?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
	{
		header('Location: ../../index');
		exit();
	}
  include("../../conexion/conexion.php"); 
  $conexion=Conectarse();
?>
<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="refresh" content="60">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historial de Pedidos</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../css/fixedColumns.bootstrap.min.css" rel="stylesheet">
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
      			<ul class="nav navbar-nav">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="historial_gerencia">Compras</a></li>
                    <li><a href="historial_gerencia_int">Servicios Internos</a></li>
					<li><a href="historial_mtto">Mantenimientos</a></li>
                  </ul>
              </li>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"> </span> Reporte<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="reporte_general_g">General Compras</a></li>
                    <li><a href="reporte_general_g_int">General Servicios Internos</a></li>
                    <li><a href="reporte_obra">Por Obra Compras</a></li>
                    <li><a href="reporte_obra_int">Por Obra Servicios</a></li>
                  </ul>
              </li>
            </ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".ucwords($_SESSION['usuario'])." | ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Historial de Pedidos</div>
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
					$currY = date("y");
					$startRow_folio = $pageNum_folio * $maxRows_folio;
					$query= "SELECT folio, date_format(fecha,'%d %M %Y') AS fecha_modificada, supervisor, proyecto, id_pedido,cancelar,tipo_compra,autorizado,estado,enviado FROM pedidos WHERE folio LIKE '%$buscar%' AND tipo_compra!='Agencias' AND gerencia='NOM' AND year=$currY ORDER BY folio DESC";
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
					if($_SESSION['tipo_usuario']=='gerencia')
					{
				?>
        				<table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        					<thead>
          						<tr>
            						<th><strong>FOLIO</strong></th>
            						<th><strong>FECHA</strong></th>
            						<th><strong>SUPERVISOR</strong></th>
            						<th><strong>PROYECTO</strong></th>
                        <th><strong>ESTADO</strong></th>
            						<th><strong>VER</strong></th>
                        <th></th>
          						</tr>
                    </thead>
                    <tbody>
          				<?php

                  $currentdate = new DateTime('now', new DateTimeZone('America/Monterrey'));

                  $date = $currentdate->format('Y-m-d');
                  $time = $currentdate->format('H:i:s');

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
								if($row_folio["cancelar"]=='Cancelado')
							{
								echo"<tr>".
      								"<td style='font-size:12px;'>".$row_folio["folio"]."</td>".
      								"<td style='font-size:12px;'>".ucwords($row_folio["fecha_modificada"])."</td>".
      								"<td style='font-size:12px;'>".$row_folio["supervisor"]."</td>".
      								"<td style='font-size:12px;'>".$row_folio["proyecto"]."</td>".
                      "<td style='font-size:12px;' align='center'>".$row_folio["cancelar"]."</td>".
    									"<td style='font-size:12px;' align='center'></td>".
                      "<td style='font-size:12px;' align='center'></td>".
        								"</tr>";
							}
              else if ($row_folio["autorizado"]=='Pendiente') 
              {
                echo"<tr class='warning'>".
                      "<td style='font-size:12px;' class='warning'>".$row_folio["folio"]."</td>".
                      "<td style='font-size:12px;' class='warning'>".ucwords($row_folio["fecha_modificada"])."</td>".
                      "<td style='font-size:12px;' class='warning'>".$row_folio["supervisor"]."</td>".
                      "<td style='font-size:12px;' class='warning'>".$row_folio["proyecto"]."</td>".
                      "<td style='font-size:12px;' class='warning' align='center'>".$row_folio["autorizado"]."</td>".
                      "<td style='font-size:12px;' class='warning' align='center'><a class='glyphicon glyphicon-pencil' href=./autorizar?id_pedido=".$row_folio["id_pedido"]."></a></td>".
                      "<td style='font-size:12px;' align='center'></td>".

                "</tr>";
              }
              else if ($row_folio["autorizado"]=='No Autorizado') 
              {
                echo"<tr class='danger'>".
                      "<td style='font-size:12px;' class='danger'>".$row_folio["folio"]."</td>".
                      "<td style='font-size:12px;' class='danger'>".ucwords($row_folio["fecha_modificada"])."</td>".
                      "<td style='font-size:12px;' class='danger'>".$row_folio["supervisor"]."</td>".
                      "<td style='font-size:12px;' class='danger'>".$row_folio["proyecto"]."</td>".
                      "<td style='font-size:12px;' class='danger' align='center'>".$row_folio["autorizado"]."</td>".
                      "<td style='font-size:12px;' class='danger' align='center'><a class='glyphicon glyphicon-pencil' href=./autorizar?id_pedido=".$row_folio["id_pedido"]."></a></td>".
                      "<td style='font-size:12px;' align='center'></td>".

                "</tr>";
              }
              else if ($row_folio["estado"]=='Recibido') 
              {
                echo"<tr class='success'>".
                      "<td style='font-size:12px;' class='success'>".$row_folio["folio"]."</td>".
                      "<td style='font-size:12px;' class='success'>".ucwords($row_folio["fecha_modificada"])."</td>".
                      "<td style='font-size:12px;' class='success'>".$row_folio["supervisor"]."</td>".
                      "<td style='font-size:12px;' class='success'>".$row_folio["proyecto"]."</td>".
                     "<td style='font-size:12px;' class='success' align='center'>".$row_folio["estado"]."</td>".
                     "<td style='font-size:12px;' class='success' align='center'><a class='glyphicon glyphicon-pencil' href=./visualizar_gerencia?id_pedido=".$row_folio["id_pedido"]."></a></td>".
                     "<td style='font-size:12px;' align='center'><a class='glyphicon glyphicon-floppy-save' href=./REPORTES/genpedidoexcel?id_pedido=".$row_folio["id_pedido"]."></a></td>".
                "</tr>";
              }
              else
							{
								echo"<tr class='success'>".
      								"<td style='font-size:12px;' class='success'>".$row_folio["folio"]."</td>".
      								"<td style='font-size:12px;' class='success'>".ucwords($row_folio["fecha_modificada"])."</td>".
      								"<td style='font-size:12px;' class='success'>".$row_folio["supervisor"]."</td>".
      								"<td style='font-size:12px;' class='success'>".$row_folio["proyecto"]."</td>".
                     "<td style='font-size:12px;' class='success' align='center'>".$row_folio["estado"]."</td>".
									   "<td style='font-size:12px;' class='success' align='center'><a class='glyphicon glyphicon-pencil' href=./visualizar_gerencia?id_pedido=".$row_folio["id_pedido"]."></a></td>".
                     "<td style='font-size:12px;' align='center'></td>".
    						"</tr>";
							}
							}while($row_folio=mysql_fetch_array($folio));		
						?>
                  </tbody>
      					</table>
                        <?php
					}
					else
          {
						?>  
      					<table class="table table-bordered table-hover">
        					<tbody>
          						<tr>
            						<td><strong>FOLIO</strong></td>
            						<td><strong>FECHA</strong></td>
            						<td><strong>SUPERVISOR</strong></td>
            						<td><strong>PROYECTO</strong></td>
          						</tr>
         				<?php 
		  					$vacio=mysql_query($query) or die (mysql_error());
 							do {
 								if($row_folio["cancelar"]=='Cancelado')
							{
								echo"<tr>".
      								"<td class='danger'>".$row_folio["folio"]."</td>".
      								"<td class='danger'>".ucwords($row_folio["fecha_modificada"])."</td>".
      								"<td class='danger'>".$row_folio["supervisor"]."</td>".
      								"<td class='danger'>".$row_folio["proyecto"]."</td>";
							}else{
								
								echo"<tr>".
      								"<td >".$row_folio["folio"]."</td>".
      								"<td >".ucwords($row_folio["fecha_modificada"])."</td>".
      								"<td >".$row_folio["supervisor"]."</td>".
      								"<td >".$row_folio["proyecto"]."</td>";
							}
							}while($row_folio=mysql_fetch_array($folio));		
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
    <script src="../../js/jquery-3.3.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/jquery.dataTables.min.js"></script>
    <script src="../../js/dataTables.bootstrap.min.js"></script>
    <script src="../../js/dataTables.fixedColumns.min.js"></script>
    
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