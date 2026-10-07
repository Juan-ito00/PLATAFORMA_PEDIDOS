<?php
	session_start();
	date_default_timezone_set("Mexico/General");
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
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cancelar Pedido</title>
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
      			<ul class="nav navbar-nav">
        			<li><a active href="nuevo"><span class="glyphicon glyphicon-file"> </span> Nuevo Pedido</a></li>
        			<li class="dropdown">
          				<a href="historial_gen"><span class="glyphicon glyphicon-list"> </span> Historial</a>
        			</li>
                	<li class="dropdown">
          				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"> </span> Reporte<b class="caret"></b>
          				</a>
          				<ul class="dropdown-menu">
            				<li><a href="REPORTES/genregen">General</a></li>
            				<li><a href="REPORTES/genrepsup">Supervisor</a></li>
                        	<li><a href="reporte_obra">Obra</a></li>
          				</ul>
        			</li>
                    <li><a href="almacen_gen"><span class="glyphicon glyphicon-th"> </span> Pedidos a Almacen</a></li>
					<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Oficios<b class="caret"></b>
              </a>
            <ul class="dropdown-menu">
              <li><a href="A_COMP/ofg_nuevo">Nuevo Oficio General</a></li>
              <li><a href="A_COMP/historial_ofg">Historial Oficios Generales</a></li>
              <li><a href="A_COMP/ofi_nuevo">Nuevo Oficio Incidencia</a></li>
              <li><a href="A_COMP/historial_ofi">Historial Oficios Incidencias</a></li>
              <li><a href="A_COMP/ofac_nuevo">Nuevo Oficio Asignación</a></li>
              <li><a href="A_COMP/historial_ofac">Historial Oficios Asignación</a></li>
              <li><a href="A_COMP/ofar_nuevo">Nueva Asignación de Ruta</a></li>
              <li><a href="A_COMP/historial_ofar">Historial Asignaciones de Ruta</a></li>
              <li><a href="A_COMP/ofcc_nuevo">Nuevo Oficio Comisión Choferes</a></li>
              <li><a href="A_COMP/historial_ofcc">Historial Oficios Comisión Choferes</a></li>
              <li><a href="A_COMP/ofdlya_nuevo">Nuevo Oficio de DLyA</a></li>
              <li><a href="A_COMP/historial_ofdlya">Historial Oficios de DLyA</a></li>
            </ul>
          </li>
						<li><a href="A_COMP/reporte_rutas"><span class="glyphicon glyphicon-book"> </span> Reporte Asignaciones de Ruta</a></li>
      			</ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo "Bienvenido ".$_SESSION['usuario']." ";?><a class="glyphicon glyphicon-off" href="file:///C|/wamp/www/logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading"><?php echo "Cancelar Pedido"?></div>
            <div class="panel-body">
            	<?php
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
					$id_pedido=$_GET['id_pedido'];
					$sql_query="UPDATE pedidos_int SET cancelar='Cancelado' WHERE id_pedido='".$id_pedido."' AND gerencia='DLyA'";
					$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
					echo "<script languaje='javascript'>
  							alert('Se ha cancelado el pedido')
							location.href='historial_int?id=tw_redireccion';
  						  </script>";
	
	?> 
            	
            </div>
       	
    </div>
   	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="file:///C|/wamp/www/js/bootstrap.min.js"></script>
  </body>
</html>