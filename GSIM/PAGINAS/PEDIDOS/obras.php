<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
	{
		header('Location: ../../index');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catálago de Obras</title>
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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-file"> </span> Nuevo Pedido<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="nuevo">Compras</a></li>
                          <li><a href="nuevo_int">Servicios Internos</a></li>
						  <li><a href="nuevo_mtto">Mantenimientos</a></li>
                  </ul>
              </li>
              <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"> </span> Historial<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="historial_gen">Compras</a></li>
					  <li><a href="historial_alm">Pedidos a Almacén</a></li>
                            <li><a href="historial_int">Servicios Internos</a></li>
							<li><a href="historial_mtto">Mantenimientos</a></li>
                    </ul>
                </li>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"> </span> Reporte<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="reporte_general">Compras</a></li>
                            <li><a href="reporte_general_int">Servicios Internos</a></li>
                    </ul>
              </li>
                    <li><a href="obras"><span class="glyphicon glyphicon-road"> </span> Obras</a></li>
            </ul>
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".$_SESSION['usuario']." | ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Catálago de Obras</div>
            <div class="panel-body">
            	<form action="procesar"> 
           
					<table class="table table-hover table-condensed"> 
						<tr>
                       	  <td></td>
                        	<td></td>
                            <td></td>
                        	<td></td>
                            <td></td>
                        	<td></td>
                            <td></td>
                        	<td></td>
                            <td></td>
                        	<td></td>
                            <td></td>
                        	<td></td>
							<td></td>
                            <td></td>
                        	<td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        	<td></td>
                            <td></td>
                        	<td></td>
                            <td></td>
                        	<td></td>
                            <td></td>
                        	<td></td>
                            <td></td>
                        	<td></td>
                  </tr> 
					
					
				</form> 
                <?php 
 					error_reporting(E_ALL ^ E_NOTICE);
 					include("../../conexion/conexion.php"); 
   					$conexion=Conectarse(); 
					mysql_query("SET NAMES 'UTF8'");
					$noRegistros =10; //Registros por página
					$pagina = 1; //Por default, página = 1
					if($_GET["pagina"]) //Si hay página por ?pagina=valor, lo asigna
    					$pagina = $_GET["pagina"];
 					//Utilizo el comando LIMIT para seleccionar registros
					$sSQL = "SELECT * FROM obras ORDER BY nombre ASC LIMIT ".($pagina-1)*$noRegistros.",$noRegistros";
					$result = mysql_query($sSQL) or die(mysql_error());
				?> 	
                
      				<tr>
                    	<td></td>
                    	<td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        	<td></td>
                            <td></td>
                        	<td></td>
                            <td></td>
                        	<td></td>
      					<td><B>No </B></td>
        				<td><B> Obras</B></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        	<td></td>
                            <td></td>
                        	<td></td>
                            <td></td>
                        	<td></td>
      				</tr>
                  
				<?php
					$j=1;
					while($row = mysql_fetch_array($result)) { //Exploracion comun de registros
						echo"<tr>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
	  						"<td>".$j."</td>".
	  						"<td>".$row["nombre"]."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>".
							"<td>"."</td>
							</tr> "
							
							; 
	  						$j++;
					}
 					//Imprimiendo páginas
					$sSQL = "SELECT count(*) FROM obras"; //Cuento el total de registros
					$result = mysql_query($sSQL);
					$row = mysql_fetch_array($result);
					$totalRegistros = $row["count(*)"]; //Almaceno el total en una variable
 					mysql_free_result($result); 
   					mysql_close($conexion);    
				?> 
				</table> 
				<?php
 					echo "Pag : ";
 					$noPaginas = $totalRegistros/$noRegistros; //Determino la cantidad de páginas
					for($i=1; $i<$noPaginas+1; $i++) { //Imprimo las páginas
    					if($i == $pagina)
        					echo "$i "; //A la página actual no le pongo link
    					else
        					echo "<a href=\"?pagina=".$i."\">".$i."</a> ";
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