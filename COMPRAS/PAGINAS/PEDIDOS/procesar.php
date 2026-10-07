<?php
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
	{
		header('Location: ../../index');
		exit();
	}
  include("../../conexion/conexion.php"); 
   $conexion=Conectarse();
   mysql_query("SET NAMES 'utf8'");
   $nombre=$_GET['nombre'];     
   mysql_query("insert into obras (nombre) values ('$nombre')",$conexion); 
    
   header("Location:obras"); 
?>