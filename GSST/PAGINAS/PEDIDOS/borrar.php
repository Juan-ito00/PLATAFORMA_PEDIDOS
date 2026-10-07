<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
	{
		header('Location: ../../index');
		exit();
	}include("../../conexion/conexion.php"); 
   $conexion=Conectarse(); 
   mysql_query("SET NAMES 'utf8'");
   $id=$_GET['id']; 
   mysql_query("delete from obras where id= $id",$conexion); 
    
   header("Location: obras"); 
?>