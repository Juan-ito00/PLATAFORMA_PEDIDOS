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
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Autorizar Pedido</title>
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
        			<p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido ".$_SESSION['usuario']." ";?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
      			</ul>
    		</div>
  		</nav>
        <!--Panel con el titulo de la pagina y contenido-->
        <div class="panel panel-default" style="margin-top: 5px;">
        	<div align="center" class="panel-heading">Autorizar Pedido</div>
            	<div class="panel-body">
            	<?php  
					header("Content-Type: text/html;charset=utf-8");
					error_reporting(E_ALL ^ E_NOTICE);
					mysql_query("SET NAMES 'utf8'");
 					if(isset($_POST["submit"]))
 					{
						$query = "UPDATE pedidos SET autorizado='Autorizado', notas_autorizacion='".$_POST['notas_autorizacion']."' WHERE id_pedido='".$_POST["id"]."' AND gerencia='GSST'";
						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
					
						echo "<script languaje='javascript'>
  									alert('Se ha autorizado el pedido con folio ".$_POST["folio"]."')
				location.href='historial_gerencia?id=tw_redireccion';
			  					</script>";

				}
				else if(isset($_POST["submit2"]))
 					{
						$query = "UPDATE pedidos SET autorizado='No Autorizado', notas_autorizacion='".$_POST['notas_autorizacion']."' WHERE id_pedido='".$_POST["id"]."' AND gerencia='GSST'";
						$result=mysql_query($query,$conexion) or die("Error: ".mysql_error());
					
						echo "<script languaje='javascript'>
  									alert('No se ha autorizado el pedido con folio ".$_POST["folio"]."')
				location.href='historial_gerencia?id=tw_redireccion';
			  					</script>";

				}
        else
        {
            $id_pedido=$_GET['id_pedido'];
            $sql_query="SELECT * FROM pedidos WHERE id_pedido='".$id_pedido."' AND gerencia='GSST'";
            $resultado=mysql_query($sql_query,$conexion) or die("Error: ".mysql_error());
            if(mysql_num_rows($resultado) > 0){
              while($Rs=mysql_fetch_array($resultado)) {
        ?>
                      <form method="post" name=frm action="autorizar">
                <div class="row form-horizontal">
                          
                     <!--Tipo de Compra-->
                      <div class="col-xs-2">
                        <label class="control-label" for="tipo_compra">Tipo de Compra</label>
                        <input class="form-control input-sm" readonly name="tipo_compra" type="text" value="<?php echo $Rs['tipo_compra']; ?>"  size="17" />
                      </div>
                      <!--Campo Área-->
                      <div class="col-xs-2"></div>
                    <div class="col-xs-4">
                      <label class="control-label" for="supervisor">Supervisor</label>
                        <input class="form-control input-sm" readonly name="supervisor" type="text" required value="<?php echo $Rs['supervisor']; ?>" size="50" />
                    </div>
                            <div class="col-xs-2">
                    <label class="control-label" for="fecha">Fecha</label>
                        <input class="form-control input-sm" name="fecha" type="date" readonly required value="<?php echo $Rs['fecha']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <label class="control-label" for="folio">Folio</label>
                          <input name="folio" readonly type="text" class="form-control input-sm" required value="<?php echo $Rs['folio']; ?>" size="17" />
                  </div>
                  <div class="col-xs-2">
                              <input  name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id_pedido']; ?>" size="17" />
                  </div>
                        </div>
                        <div class="row form-horizontal">
                          <div class="col-xs-4">
                              <label class="control-label" for="folio">Empresa</label>
                                <select name="empresa" class="form-control input-sm" disabled>
                                  <option class="form-control input-sm"><?php  echo $Rs['empresa']; ?></option>
                            <option class="form-control input-sm" name=uno value="MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
                  <option class="form-control input-sm" name=dos value="CAVI DE SOMBRERETE">CAVI DE SOMBRERETE</option>
                  <option class="form-control input-sm" name=tres value="SUCURSAL MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.">SUCURSAL MONTAJES Y ESTRUCTURAS DE ZACATECAS S.A. de C.V.</option>
                          </select>
                    </div>
                    <div class="col-xs-4">
                    <label class="control-label" for="ubicacion">Ubicación</label>
                        <input class="form-control input-sm" name="ubicacion" readonly ="text" value="<?php echo $Rs['ubicacion']; ?>"  size="17" />
                    </div>
                    <div class="col-xs-4">
                      <label class="control-label" for="proyecto">Proyecto</label>
                              <?php
                  mysql_query("SET NAMES 'UTF8'");
                  $consulta_mysql='select * from obras ORDER BY nombre ASC';
                  $resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);
                  echo "<select name='proyecto' disabled class='form-control input-sm'>";
                  echo "<option> {$Rs['proyecto']}</option>";
                  while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                      echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
                  }
                  echo "</select>";
                ?>
                      </div>
                        </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <label class="control-label" for="cantidad">Cantidad</label>
                        <input name="cantidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant1']; ?>"  size="15"  />
                    </div>
                    <div class="col-xs-2">
                      <label class="control-label" for="unidad">Unidad</label>
                      <input name="unidad" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid1']; ?>"  size="15"  />
                    </div>
                    <div class="col-xs-4">
                      <label class="control-label" for="descripcion">Descripción</label>
                      <input name="descripcion" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc1']); ?>"  size="87"  />
                    </div>
                    <div class="col-xs-4">
                      <label class="control-label" for="uso">Uso</label>
                      <input name="uso" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso1']); ?>"  size="87"  />
                    </div>
                  </div>
                        <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad2" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant2']; ?>" size="15" />
                    </div>
                            <div class="col-xs-2">
                      <input name="unidad2" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid2']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion2" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc2']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso2" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso2']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad3" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['cant3']; ?>" size="15" />
                    </div>
                  <div class="col-xs-2">
                      <input name="unidad3" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['unid3']; ?>" size="15" />  
                    </div>
                    <div class="col-xs-4">
                      <input name="descripcion3" type="text" class="form-control input-sm" readonly value="<?php echo htmlspecialchars($Rs['desc3']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso3" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso3']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad4" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['cant4']; ?>" size="15" />
                    </div>
              <div class="col-xs-2">
                <input name="unidad4" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['unid4']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion4" type="text" class="form-control input-sm" readonly value="<?php echo htmlspecialchars($Rs['desc4']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso4" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso4']); ?>" size="87" />
                    </div>
                       </div>
                        <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad5" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['cant5']; ?>" size="15" />
                    </div>
                            <div class="col-xs-2">
                      <input name="unidad5" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['unid5']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                <input name="descripcion5" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc5']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso5" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso5']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad6" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant6']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                <input name="unidad6" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid6']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                <input name="descripcion6" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc6']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso6" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso6']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad7" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant7']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad7" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid7']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion7" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc7']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso7" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso7']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad8" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant8']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                <input name="unidad8" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid8']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion8" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc8']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso8" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso8']); ?>" size="87" />
                    </div>
                  </div>
                        <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad9" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant9']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad9" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid9']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion9" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc9']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso9" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso9']); ?>" size="87" />
                    </div>
                  </div>
                        <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad10" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant10']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad10" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid10']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                <input name="descripcion10" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc10']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso10" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso10']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad11" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant11']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad11" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid11']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion11" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc11']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso11" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso11']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad12" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant12']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad12" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid12']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion12" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc12']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso12" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso12']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad13" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant13']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad13" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid13']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion13" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc13']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso13" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso13']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad14" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant14']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad14" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid14']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion14" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc14']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso14" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso14']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad15" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant15']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad15" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid15']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion15" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc15']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso15" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso15']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad16" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant16']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad16" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid16']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion16" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc16']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso16" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso16']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad17" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant17']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad17" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid17']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion17" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc17']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso17" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso17']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad18" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant18']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad18" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid18']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion18" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc18']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso18" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso18']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad19" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant19']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad19" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid19']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion19" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc19']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso19" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso19']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad20" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant20']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad20" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid20']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion20" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc20']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso20" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso20']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad21" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant21']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad21" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid21']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion21" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc21']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso21" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso21']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad22" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant22']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad22" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid22']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion22" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc22']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso22" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso22']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad23" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant23']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad23" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid23']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion23" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc23']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso23" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso23']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad24" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant24']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad24" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid24']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion24" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc24']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso24" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso24']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad25" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant25']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad25" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid25']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion25" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc25']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso25" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso25']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad26" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant26']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad26" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid26']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion26" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc26']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso26" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso26']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad27" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant27']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad27" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid27']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion27" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc27']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso27" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso27']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad28" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant28']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad28" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid28']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion28" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc28']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso28" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso28']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad29" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant29']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad29" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid29']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion29" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc29']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso29" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso29']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad30" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant30']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad30" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid30']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion30" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc30']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso30" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso30']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad31" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant31']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad31" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid31']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion31" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc31']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso31" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso31']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad32" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant32']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad32" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid32']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion32" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc32']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso32" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso32']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad33" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant33']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad33" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid33']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion33" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc33']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso33" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso33']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad34" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant34']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad34" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid34']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion34" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc34']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso34" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso34']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad35" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant35']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad35" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid35']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion35" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc35']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso35" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso35']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad36" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant36']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad36" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid36']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion36" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc36']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso36" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso36']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad37" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant37']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad37" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid37']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion37" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc37']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso37" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso37']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad38" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant38']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad38" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid38']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion38" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc38']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso38" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso38']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad39" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant39']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad39" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid39']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion39" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc39']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso39" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso39']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad40" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant40']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad40" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid40']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion40" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc40']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso40" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso40']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad41" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant41']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad41" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid41']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion41" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc41']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso41" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso41']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad42" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant42']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad42" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid42']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion42" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc42']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso42" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso42']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad43" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant43']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad43" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid43']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion43" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc43']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso43" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso43']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad44" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant44']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad44" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid44']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion44" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc44']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso44" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso44']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad45" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant45']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad45" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid45']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion45" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc45']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso45" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso45']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad46" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant46']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad46" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid46']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion46" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc46']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso46" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso46']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad47" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant47']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad47" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid47']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion47" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc47']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso47" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso47']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad48" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant48']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad48" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid48']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion48" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc48']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso48" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso48']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad49" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant49']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad49" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid49']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion49" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc49']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso49" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso49']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                <div class="col-xs-2">
                      <input name="cantidad50" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['cant50']; ?>" size="15" />
                    </div>
                    <div class="col-xs-2">
                      <input name="unidad50" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['unid50']; ?>" size="15" />
                    </div>
                            <div class="col-xs-4">
                      <input name="descripcion50" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['desc50']); ?>" size="87" />
                    </div>
                    <div class="col-xs-4">
                      <input name="uso50" class="form-control input-sm" type="text" readonly value="<?php echo htmlspecialchars($Rs['uso50']); ?>" size="87" />
                    </div>
                  </div>
                  <div class="row form-horizontal">
                    <div class="col-xs-2">
                      <label class="control-label">Notas</label>
                      <textarea name="notas_seguimiento" class="form-control " readonly=""><?php echo htmlspecialchars($Rs['notas_seguimiento']); ?></textarea>
                      </div>
                    </div>
                <div class="row form-horizontal">
                <div class="col-xs-10 col">
	              <label class="control-label">Notas para autorización de pedido</label>
	              <textarea  name="notas_autorizacion" class="form-control " maxlength="150"><?php echo htmlspecialchars($Rs['notas_autorizacion']); ?></textarea>
              	</div>
              </div>
              <br>
                  <div id="btn-form">
                    <input class="btn form-btn btn-primary" type="submit" name="submit" value="Autorizar">
                    <input class="btn form-btn btn-primary" type="submit" name="submit2" value="No Autorizar">
                </div>
              </form>
                <?php       
              }
            }
            else
            {
              echo "<script languaje='javascript'>
                  alert('No fue posible realizar la operacion solicitada al pedido con ID".$id_pedido."')
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