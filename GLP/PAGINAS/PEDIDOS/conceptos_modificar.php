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

  use PHPMailer\PHPMailer\PHPMailer;
  require_once('../../autoload.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modificar Concepto</title>
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
  				<ul class="nav navbar-nav navbar-right">
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".$_SESSION['usuario']." ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Modificar Concepto</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
 					if(isset($_POST["submit"])){
                        $query = "UPDATE conceptos_gcp SET codigo='".$_POST["codigo"]."', unidad='".$_POST["unidad"]."', catalogo='".$_POST["catalogo"]."',descripcion='".$_POST["descripcion"]."' WHERE id='".$_POST["id"]."'";
                        $result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
          
                        echo "<script languaje='javascript'>
                                alert('Se ha modificado el concepto')
                        location.href='conceptos_bd?id=tw_redireccion';
                            </script>";
				    }
                    else {
						$id_c=$_GET['id_c'];
						$sql_query="SELECT * FROM conceptos_gcp WHERE id='".$id_c."'";
						$resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
						if(mysql_num_rows($resultado) > 0){
							while($Rs=mysql_fetch_array($resultado)) {
				?>
                <form action="conceptos_modificar" method="post">
             			<div class="row form-horizontal">
                            <div class="col-xs-2">
                                <label class="control-label">Código</label>
                                <input name="codigo" type="text" class="form-control input-sm" value="<?php echo $Rs['codigo']; ?>">
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-xs-2">
                                    <label class="control-label">Unidad</label>
                                <input name="unidad" type="text" class="form-control input-sm" value="<?php echo $Rs['unidad']; ?>">
                            </div>
						</div>
						<div class="row form-horizontal">
  							<div class="col-xs-4">
                              <label class="control-label">Catálogo</label>
                              	<select name="catalogo" class="form-control input-sm">
								  	<option value="<?php echo $Rs['catalogo']; ?>" class="form-control input-sm" id="" ><?php echo $Rs['catalogo']; ?></option>
									<option value="Alimentación" class="form-control input-sm" id="" >Alimentación</option>
									<option value="Consumibles" class="form-control input-sm" >Consumibles</option>
									<option value="EPP" class="form-control input-sm" >EPP</option>
									<option value="Exámenes Médicos" class="form-control input-sm" >Exámenes Médicos</option>
									<option value="Herramienta" class="form-control input-sm" >Herramienta</option>
									<option value="Hospedaje" class="form-control input-sm" >Hospedaje</option>
									<option value="Materiales" class="form-control input-sm" >Materiales</option>
								</select>
  							</div>
						</div>
            			<div class="row form-horizontal">
  							<div class="col-xs-10">
                              <label class="control-label">Descripción</label>
                              <textarea  name="descripcion" class="form-control "><?php echo $Rs['descripcion']; ?></textarea>
  							</div>
                            <div class="col-xs-1">
                                <input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id']; ?>" size="17" />
                            </div>
						</div>
                        <br>
           				<div id="btn-form">
          	 				<input class="btn form-btn btn-primary" type="submit" name="submit" value="Modificar">
         	 			</div>
                	</form>
                <?php   		
							}
						}else{
							echo "<script languaje='javascript'>
									alert('No fue posible realizar la operacion solicitada')
							javascript:history.go(-2)
  									</script>";
						}				
					}
					// Cerramos la conexión
					mysql_close($conexion);
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