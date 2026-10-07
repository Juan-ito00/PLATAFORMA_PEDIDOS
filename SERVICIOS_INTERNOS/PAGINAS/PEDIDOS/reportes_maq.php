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
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reportes</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
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
                  <a href="vehiculos_gen"><span class="glyphicon glyphicon-list"> </span> Vehículos
                  </a>
              </li>
              <li class="dropdown">
                  <a href="mantenimientos_gen"><span class="glyphicon glyphicon-list"> </span> Mantenimientos
                  </a>
              </li>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"> </span> Reportes<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="reporte_general_mec">General</a></li>
                    <li><a href="reporte_gerencia_mec">Gerencia</a></li>
                          <li><a href="reporte_obra_mec">Obra</a></li>
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
          <div align="center" class="panel-heading">Reportes</div>
            <div class="panel-body">
              
              <div class="row">
                  <br>
                    <br>
                    <div class="col-sm-6 col-md-3">
              <a href="reporte_general_maq" class="thumbnail">
                  <img src="../../img/estatus.png" alt="..." data-src="" style="width: 140px;">
                            <h6 align="center">General</h6>
              </a>
          </div>
                    <div class="col-sm-6 col-md-3">
              <a href="reporte_gerencia_maq" class="thumbnail">
                  <img src="../../img/supervisor.png" alt="..." data-src="" style="width: 140px;">
                            <h6 align="center">Por Gerencia</h6>
              </a>
          </div>
                  <div class="col-sm-6 col col-md-3" align="justify">
            <a href="reporte_obra_maq" class="thumbnail">
                  <img src="../../img/obras.png" alt="..." data-src="" style="width: 140px;">
                            <h6 align="center">Por Obra</h6>
            </a>
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