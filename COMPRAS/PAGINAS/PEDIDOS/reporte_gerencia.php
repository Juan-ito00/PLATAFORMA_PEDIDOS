<?php
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
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte por Gerencia</title>
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
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Pedidos<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="epp_gen">EPP</a></li>
                    <li><a href="examenes_gen">Exámenes Médicos</a></li>
                    <li><a href="insumos_gen">Insumos Méd/Lab</a></li>
                    <li><a href="papeleria_gen">Papelería</a></li>
                    <li><a href="material_gen">Generales</a></li>
                    <li><a href="productos_gen">Prod. Limpieza</a></li>
                    <li><a href="agencias_gen">Serv. Agencia</a></li>
                    <li><a href="toner_gen">Toner</a></li>
                  </ul>
              </li>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"> </span> Reportes<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="reporte_general">General</a></li>
                    <li><a href="reporte_gerencia">Gerencia</a></li>
                          <li><a href="reporte_obra">Obra</a></li>
                  </ul>
              </li>
            </ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".$_SESSION['usuario']." | ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Reporte por Gerencia</div>
            <div class="panel-body">
            	<div class="center-block">
            		<div class="col-lg-6">
                    	<br>
            			<form action="REPORTES/genrepger"class="form-horizontal">
						      <label for="proyecto">Gerencia</label>
            					 <select class='form-control input-sm' name='gerencia'>
                        <option value='CONCRETOS'>Concretos</option>
                        <option value='GCHSO'>Gerencia de Capital Humano y Salud Ocupacional</option>
                        <option value='GCI'>Gerencia de Contabilidad e Impuestos</option>
                        <option value='GCSO1'>Gerencia de Control y Seguimiento de Obra 1</option>
                        <option value='GCSO2'>Gerencia de Control y Seguimiento de Obra 2</option>
                        <option value='GCSO3'>Gerencia de Control y Seguimiento de Obra 3</option>
                        <option value='GF'>Gerencia de Finanzas</option>
                        <option value='GLP'>Gerencia de Licitaciones y Proyectos</option>
                        <option value='GOAF'>Gerencia de Operaciones de Activo Fijo</option>
                        <option value='GSST'>Gerencia de Seguridad y Salud en el Trabajo</option>
                        <option value='GSIM'>Gerencia de Sistemas de Información y Mercadotecnia</option>
                        <option value='SUBDIR'>Subdirección</option>
									     </select>
                       <br>
                       <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0 text-center">
                          <label>Desde</label>
                          <input type="date" class="form-control" name="desde" >
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0 text-center">
                          <label>Hasta</label>
                          <input type="date" class="form-control" name="hasta" >
                        </div>
                      </div> 
                            	<br>
                              <input type="hidden" name="ucuc" value="<?php echo $_SESSION['tipo_usuario'];?>">
							<input class="btn btn-primary" TYPE="submit" NAME="accion" VALUE="Generar"> 
                         
					  </form> 
                        <br>
                    </div>
                  </div>
                    
            </div>
       	
    </div>
   
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>
  </body>
</html>